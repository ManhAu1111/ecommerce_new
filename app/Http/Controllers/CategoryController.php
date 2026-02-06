<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::whereNull('parent_id')->get();
        // hoặc Category::all();
    }
}
