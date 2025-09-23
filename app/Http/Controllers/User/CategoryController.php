<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Show products under a category
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $category->id)->get();

        return view('categories.show', compact('category', 'products'));
    }
}
