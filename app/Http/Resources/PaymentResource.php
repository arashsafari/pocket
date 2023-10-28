<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'status' => $this->status,
            'status_updated_at' => $this->status_updated_at,
            'status_updated_by' => $this->status_updated_by,
            'unique_id' => $this->unique_id,
            'currency' => new CurrencyResource($this->currency),
            'user' => new UserResource($this->user),
            'transaction' => new TransactionResource($this->transaction),
        ];
    }
}
