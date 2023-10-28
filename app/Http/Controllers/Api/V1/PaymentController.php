<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\Payment\PaymentStatusEnums;
use App\Events\ApprovedPaymentEvent;
use App\Events\RejectedPaymentEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\PaymentResource;
use App\Facades\ApiResponse;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Contracts\Interfaces\Controllers\Api\V1\PaymentControllerInterface;

class PaymentController extends Controller implements PaymentControllerInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::query()->paginate(config('settings.global.number_per_page'));

        return ApiResponse::message(__('payment.messages.payment_list_found_successfully'))
            ->data(new PaymentCollection($payments))
            ->send();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $limitCreationByMinutes = config('settings.payment.limit_creation_by_minutes');

        $lastSamePayment = auth()->user()->payments()->where([
            ['amount', $request->amount],
            ['currency_key', $request->currency_key],
            ['created_at', '>', Carbon::now()->subMinutes($limitCreationByMinutes)]
        ])->first();

        if ($lastSamePayment) {
            throw new BadRequestException(
                __('payment.errors.you_can_only_create_same_paymant_after_minutes', [
                    'minute' => $limitCreationByMinutes
                ])
            );
        }

        $payment = auth()->user()->payments()->create($request->all());
        return ApiResponse::message(__('payment.messages.payment_successfuly_created'))
            ->data(new PaymentResource($payment))
            ->status(Response::HTTP_CREATED)
            ->send();
    }
    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return ApiResponse::message(__('payment.messages.payment_successfuly_found'))
            ->data(new PaymentResource($payment))
            ->send();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        if (!in_array($payment->status, [PaymentStatusEnums::PENDING])) {
            throw new BadRequestException(__('payment.errors.payment_cant_delete'));
        }

        $payment->delete();

        return ApiResponse::message(__('payment.messages.payment_successfully_delete'))
            ->send();
    }

    public function reject(Payment $payment)
    {
        if ($payment->status == PaymentStatusEnums::REJECTED) {
            throw new BadRequestException(__('payment.errors.payment_already_rejected'));
        }

        if (!in_array($payment->status, [PaymentStatusEnums::PENDING])) {
            throw new BadRequestException(__('payment.errors.payment_cant_by_rejected'));
        }

        $payment->update([
            'status' => PaymentStatusEnums::REJECTED
        ]);

        RejectedPaymentEvent::dispatch($payment);

        return ApiResponse::message(__('payment.messages.the_payment_was_successfully_rejected'))
            ->data(new PaymentResource($payment))
            ->send();
    }

    public function approve(Payment $payment)
    {
        if ($payment->status == PaymentStatusEnums::APPROVED) {
            throw new BadRequestException(__('payment.errors.payment_already_approved'));
        }

        if (!in_array($payment->status, [PaymentStatusEnums::PENDING])) {
            throw new BadRequestException(__('payment.errors.payment_cant_by_approved'));
        }

        if ($payment->transaction()->exists()) {
            throw new BadRequestException(__('payment.errors.payment_has_transaction'));
        }

        if (!$payment->currency->is_active) {
            throw new BadRequestException(__('payment.errors.payment_currency_deactive'));
        }

        $payment->transaction()->create([
            'user_id' => $payment->user_id,
            'amount' => $payment->amount,
            'currency_key' => $payment->currency_key
        ]);

        $payment->update([
            'status' => PaymentStatusEnums::APPROVED,
            'status_updated_at' => Carbon::now(),
            'status_updated_by' => auth()->user()->id
        ]);

        ApprovedPaymentEvent::dispatch($payment);

        return ApiResponse::message(__('payment.messages.the_payment_was_successfully_approved'))
            ->data(new PaymentResource($payment))
            ->send();
    }
}
