<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $cartItems = CartItem::where('user_id', $user->id)
            ->with('product.primaryImage')
            ->get();

        $total = $cartItems->sum(fn($item) => $item->price * $item->quantity);

        $defaultAddress = UserAddress::where('user_id', $user->id)
            ->orderByDesc('is_default')
            ->first();

        return inertia('Checkout', [
            'cartItems' => $cartItems,
            'total' => $total,
            'user' => $user,
            'defaultAddress' => $defaultAddress,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'receiver_email' => 'nullable|email|max:255',
            'province' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'ward' => 'required|string|max:100',
            'detail' => 'required|string|max:255',
            'note' => 'nullable|string',
            'payment_method' => 'required|in:cod,momo',
        ]);

        $cartItems = CartItem::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return back()->withErrors(['cart' => 'Giỏ hàng trống']);
        }

        DB::beginTransaction();

        try {
            $totalPrice = $cartItems->sum(fn($item) => $item->price * $item->quantity);
            $shippingFee = 0; // có thể tính sau

            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'total_price' => $totalPrice,
                'shipping_fee' => $shippingFee,
                'payment_method' => $request->payment_method,
                'receiver_name' => $request->receiver_name,
                'receiver_phone' => $request->receiver_phone,
                'receiver_email' => $request->receiver_email,
                'province' => $request->province,
                'district' => $request->district,
                'ward' => $request->ward,
                'detail' => $request->detail,
                'note' => $request->note,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                ]);
            }

            // Xóa cart sau khi đặt hàng
            CartItem::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Đặt hàng thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại']);
        }
    }
}
