<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;


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
    public function shop(Request $request)
    {
        $categoryIds = $request->category;

        if ($categoryIds && !is_array($categoryIds)) {
            $categoryIds = [$categoryIds];
        }
        
        $query = Product::with([
        'primaryImage',
        'secondaryImage',
        'categories'
        ])->orderByDesc('created_at');

        if (!empty($categoryIds)) {
            $query->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
            });
        }

        // 🔍 SEARCH THEO TÊN
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter category (multi)
        if ($request->filled('category')) {
            $categoryIds = $request->category;

            if (!is_array($categoryIds)) {
                $categoryIds = [$categoryIds];
            }

            $query->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
            });
        }

        // Filter price
        if ($request->filled('price_min')) {
            $query->where('price', '>=', (int)$request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', (int)$request->price_max);
        }

        $products = $query->paginate(12)->withQueryString();

        return Inertia::render('Shop', [
            'products' => $products,
            'categories' => Category::orderBy('name')->get(),
            'filters' => [
                'search'    => $request->search ?? '',
                'category' => $categoryIds ?? [], // ✅ QUAN TRỌNG
                'price_min' => $request->price_min,
                'price_max' => $request->price_max,
            ],
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
