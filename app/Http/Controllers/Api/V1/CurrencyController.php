<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\ApiResponse;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Models\Currency;
use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyCollection;
use App\Http\Resources\CurrencyResource;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Contracts\Interfaces\Controllers\Api\V1\CurrencyControllerInterface;
use Illuminate\Http\Request;

class CurrencyController extends Controller implements CurrencyControllerInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::query()->paginate(config('settings.global.number_per_page'));
        return ApiResponse::message(__('currency.messages.currency_list_found_successfully'))
            ->data(new CurrencyCollection($currencies))
            ->send();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurrencyRequest $request)
    {
        $currency = auth()->user()->currencies()->create($request->all());
        return ApiResponse::message(__('currency.messages.currency_successfuly_created'))
            ->data(new CurrencyResource($currency))
            ->status(Response::HTTP_CREATED)
            ->send();
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        return ApiResponse::message(__('currency.messages.currency_successfuly_found'))
            ->data(new CurrencyResource($currency))
            ->send();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        //
    }

    public function active(Currency $currency)
    {
        if ($currency->is_active) {
            throw new BadRequestException(__('currency.errors.currency_already_actived'));
        }

        $currency->update([
            'is_active' => true
        ]);

        return ApiResponse::message(__('currency.messages.currency_was_successfully_actived'))
            ->data(new CurrencyResource($currency))
            ->send();
    }

    public function deactive(Currency $currency)
    {
        if (!$currency->is_active) {
            throw new BadRequestException(__('currency.errors.currency_already_deactived'));
        }

        $currency->update([
            'is_active' => false
        ]);

        return ApiResponse::message(__('currency.messages.currency_was_successfully_deactived'))
            ->data(new CurrencyResource($currency))
            ->send();
    }
}
