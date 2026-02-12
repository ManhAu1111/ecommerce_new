<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'public_id',
        'user_id',
        'status',
        'total_price',
        'shipping_fee',
        'payment_method',
        'receiver_name',
        'receiver_phone',
        'receiver_email',
        'province',
        'district',
        'ward',
        'detail',
        'full_address', // thêm dòng này
        'note',
    ];

    /**
     * Tự động tạo public_id khi tạo đơn
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {

            if (empty($order->public_id)) {

                do {
                    $publicId = 'ORD-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4));
                } while (self::where('public_id', $publicId)->exists());

                $order->public_id = $publicId;
            }
        });
    }

    /**
     * Quan hệ với OrderItem
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Quan hệ với User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
