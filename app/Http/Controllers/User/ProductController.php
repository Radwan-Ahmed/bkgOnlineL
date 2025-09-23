<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
public function index(Request $request)
{
    $query = $request->input('query');

    // If search query is given
    if ($query) {
        $products = Product::where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->paginate(12);
    } else {
        // Default all products
        $products = Product::paginate(12);
    }

    $categories = Category::all();

    return view('products.index', compact('products', 'categories'));
}


    public function show($id)
    {
        $product = Product::findOrFail($id);

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(12);

        $categories = Category::all(); // for filter if needed

        return view('user.products.index', compact('products', 'categories'));
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products()->latest()->paginate(12);
        return view('products.index', compact('products', 'category'));
    }
}
