<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'balance',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function currencies()
    {
        return $this->hasMany(Currency::class);
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }

    public function getTransfers()
    {
        return $this->hasMany(Transfer::class, 'id', 'target_user_id');
    }

    public function giveTransfers()
    {
        return $this->hasMany(Transfer::class, 'id', 'base_user_id');
    }

    public function updateBalance()
    {
        $balances = Transaction::query()
            ->select('currency_key', DB::raw('SUM(amount) as total_amount'))
            ->where('user_id', $this->id)
            ->groupBy('currency_key')
            ->pluck('total_amount', 'currency_key');

        $this->update([
            'balance' => $balances->toJson()
        ]);
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }
}
