<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product.primaryImage')
            ->get();

        $total = $cartItems->sum(fn($item) => $item->price * $item->quantity);

        return inertia('Checkout', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }
}
