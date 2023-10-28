<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'key', 'symbol', 'iso_code', 'is_active'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('isActive', function (Builder $builder) {
            $builder->where('is_active', true);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymetns()
    {
        return $this->hasMany(Payments::class, 'key', 'currency_key');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'key', 'currency_key');
    }

    public function transfer()
    {
        return $this->hasMany(Transfer::class, 'key', 'currency_key');
    }
}
