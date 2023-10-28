<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = ['base_user_id', 'target_user_id', 'user_id', 'currency_key', 'amount'];

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_key', 'key');
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'base_user_id', 'id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'target_user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
