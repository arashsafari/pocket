<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $fillable = ['entity', 'entity_id', 'approval_status', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
