<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
    ];

    /**
     * CartItem thuộc về User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * CartItem thuộc về Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
