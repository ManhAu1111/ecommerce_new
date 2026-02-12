<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id',
        'receiver_name',
        'receiver_phone',
        'province',
        'district',
        'ward',
        'detail',
        'full_address',
        'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
