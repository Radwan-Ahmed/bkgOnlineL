<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = Product::query();

        // Search by name
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Prepare variables for Blade
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalAdmins = Admin::count();
        $totalUsers = User::count();
        $latestProducts = $query->latest()->paginate(5);

        return view('admin.dashboard', compact(
            'totalCategories',
            'totalProducts',
            'totalAdmins',
            'totalUsers',
            'latestProducts'
        ));
    }
}

