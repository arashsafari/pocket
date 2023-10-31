<?php

namespace App\Models;

use App\Enums\Payment\PaymentStatusEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Payment extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = ['amount', 'status', 'currency_key'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status'     => PaymentStatusEnums::class
    ];

    protected static function booted()
    {
        static::creating(function ($payment) {
            $payment->unique_id = static::generateUniqueNumber(10);
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'unique_id';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logUnguarded();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_key', 'key');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public static function generateUniqueNumber($length = 10)
    {
        $uniqueNumber = str_shuffle(time() . random_int(111111111, 999999999));

        $randomDigitNumber = '';
        for ($i = 0; $i < $length; $i++) {
            $randomDigit = substr($uniqueNumber, rand(0, strlen($uniqueNumber) - 1), 1);
            $randomDigitNumber .= $randomDigit;
        }


        return $randomDigitNumber;
    }
}
