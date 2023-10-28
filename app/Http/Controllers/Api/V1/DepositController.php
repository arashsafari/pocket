<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepositTransferRequest;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DepositController extends Controller
{
    public function transfer(DepositTransferRequest $request){
        DB::beginTransaction();

        $baseUser = User::where('id', $request->base_user_id)->first();
        $targetUser = User::where('id', $request->target_user_id)->first();

        $currency = Currency::where('key', $request->currency_key)->first();
        $baseUserBalance = json_decode($baseUser->balance)->{$currency->key};

        if ($request->amount > $baseUserBalance) {
            throw new BadRequestException(__('transfer.errors.amount_must_be_smaller_than_your_balance'));
        }

        $baseUser->transactions()->lockForUpdate();
        $targetUser->transactions()->lockForUpdate();

        $baseUser->transactions()->create([
            'amount' => $request->amount * -1,
            'currency_key' => $currency->key,
        ]);

        $targetUser->transactions()->create([
            'amount' => $request->amount,
            'currency_key' => $currency->key,
        ]);

        auth()->user()->transfers()->create([
            'base_user_id' => $baseUser->id,
            'target_user_id' => $targetUser->id,
            'currency_key' => $currency->key,
            'amount' => $request->amount,
        ]);

        DB::commit();

        return ApiResponse::message(__('transfer.messages.the_transfer_was_successfully_approved'))
            ->send();
    }
}
