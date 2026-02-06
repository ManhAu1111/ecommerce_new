<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'price', 'quantity'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Quan hệ 1-1 với Review để đảm bảo mua rồi mới đánh giá
    public function review()
    {
        return $this->hasOne(ProductReview::class, 'order_item_id');
    }
}
