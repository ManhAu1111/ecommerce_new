<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use Inertia\Inertia;

class WishlistController extends Controller
{
    public function toggle(Request $request)
    {
        // 1️⃣ Bắt buộc đăng nhập
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }

        // 2️⃣ Validate
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $user = Auth::user();
        $productId = $request->product_id;

        // 3️⃣ Kiểm tra đã wishlist chưa
        $exists = Wishlist::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();

        if ($exists) {
            // Xoá wishlist
            Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->delete();

            $wishlisted = false;
        } else {
            // 4️⃣ Thêm wishlist
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $productId
            ]);

            $wishlisted = true;
        }

        // 🧠 CHỈ THÊM ĐOẠN NÀY – KHÔNG PHÁ LOGIC CŨ
        if ($request->inertia()) {
            return back()->with([
                'wishlisted' => $wishlisted
            ]);
        }

        return response()->json([
            'wishlisted' => $wishlisted
        ]);
    }


    public function index()
    {
        $wishlists = Wishlist::with([
            'product.primaryImage'
        ])
        ->where('user_id', Auth::id())
        ->get();

        return Inertia::render('Wishlist', [
            'wishlists' => $wishlists
        ]);
    }

    public function count()
    {
        return response()->json([
            'count' => Wishlist::where('user_id', Auth::id())->count()
        ]);
    }
}
