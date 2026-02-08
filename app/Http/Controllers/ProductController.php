<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with(['primaryImage', 'secondaryImage'])
            ->orderByDesc('avg_rating')
            ->limit(8)
            ->get();

        $popularProducts = Product::with(['primaryImage', 'secondaryImage'])
            ->orderByDesc('total_reviews')
            ->limit(8)
            ->get();

        $newProducts = Product::with(['primaryImage', 'secondaryImage'])
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();
        return Inertia::render('Home', [
            'featuredProducts' => $featuredProducts,
            'popularProducts'  => $popularProducts,
            'newProducts'      => $newProducts,
        ]);
    }
    // SHOP – HIỂN THỊ TẤT CẢ SẢN PHẨM
    public function shop()
    {
        $products = Product::with(['primaryImage', 'secondaryImage'])
            ->orderByDesc('created_at')
            ->paginate(12); // nên phân trang luôn

        return Inertia::render('Shop', [
            'products' => $products
        ]);
    }

    public function show($id)
    {
        $product = Product::with([
            'primaryImage',
            'images' => function ($q) {
                $q->orderBy('display_order');
            },
            'reviews',
            'categories',
        ])->findOrFail($id);

        return Inertia::render('Detail', [
            'product' => $product
        ]);
    }   

    public function relatedProducts($id)
    {
        // 1. Lấy product hiện tại (chỉ cần category)
        $product = Product::with('categories:id')->findOrFail($id);

        $categoryIds = $product->categories->pluck('id');

        // 2. Lấy 4 sản phẩm cùng category, loại trừ chính nó
        $relatedProducts = Product::with(['primaryImage', 'secondaryImage'])
            ->where('id', '!=', $id)
            ->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
            })
            ->inRandomOrder() // cho đỡ nhàm
            ->limit(4)
            ->get();

        return response()->json($relatedProducts);
    }

  

}
