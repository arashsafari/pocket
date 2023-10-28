<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'currency_key', 'balance', 'user_id', 'payment_id'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_key', 'key');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function ($transaction) {
            $userSumBalance = Transaction::query()->where([['user_id', $transaction->user_id], ['currency_key', $transaction->currency_key]])->sum('amount');
            $transaction->update([
                'balance' => $userSumBalance
            ]);

            $transaction->user->updateBalance();
        });
    }
}
