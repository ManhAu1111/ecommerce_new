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

}
