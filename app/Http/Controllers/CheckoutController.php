<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CheckoutStoreRequest;
use Illuminate\Support\Facades\Log;

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

    public function store(CheckoutStoreRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        // Lấy tên địa phương theo code
        $provinceName = DB::table('provinces')
            ->where('code', $data['province'])
            ->value('name');

        $districtName = DB::table('districts')
            ->where('code', $data['district'])
            ->value('name');

        $wardName = DB::table('wards')
            ->where('code', $data['ward'])
            ->value('name');

        // Nếu không tìm thấy địa phương → lỗi
        if (!$provinceName || !$districtName || !$wardName) {
            return back()->withErrors([
                'address' => 'Địa chỉ không hợp lệ. Vui lòng chọn lại.'
            ]);
        }

        $cartItems = CartItem::where('user_id', $user->id)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->withErrors([
                'cart' => 'Giỏ hàng của bạn đang trống.'
            ]);
        }

        // Check tồn kho
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return back()->withErrors([
                    'stock' => "Sản phẩm {$item->product->name} không đủ số lượng trong kho."
                ]);
            }
        }

        try {
            $order = DB::transaction(function () use (
                $user,
                $data,
                $cartItems,
                $provinceName,
                $districtName,
                $wardName
            ) {

                $totalPrice = $cartItems->sum(
                    fn($item) => $item->price * $item->quantity
                );

                $shippingFee = 0;

                $order = Order::create([
                    'user_id' => $user->id,
                    'status' => 'pending',
                    'total_price' => $totalPrice,
                    'shipping_fee' => $shippingFee,
                    'payment_method' => $data['payment_method'],

                    'receiver_name' => $data['receiver_name'],
                    'receiver_phone' => $data['receiver_phone'],
                    'receiver_email' => $data['receiver_email'] ?? null,

                    // LƯU TÊN THẬT
                    'province' => $provinceName,
                    'district' => $districtName,
                    'ward' => $wardName,

                    'detail' => $data['detail'],
                    'full_address' => $data['full_address'],
                    'note' => $data['note'] ?? null,
                ]);

                foreach ($cartItems as $item) {

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                    ]);

                    // Trừ tồn kho
                    $item->product->decrement('stock', $item->quantity);
                }

                // Xóa giỏ hàng
                CartItem::where('user_id', $user->id)->delete();

                return $order;
            });

            return redirect()
                ->route('orders.show', $order->id)
                ->with('success', 'Đặt hàng thành công');
        } catch (\Throwable $e) {

            Log::error('Checkout error: ' . $e->getMessage());

            return back()->withErrors([
                'error' => 'Có lỗi xảy ra trong quá trình đặt hàng. Vui lòng thử lại.'
            ]);
        }
    }
}
