<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10048',
        ]);

        try {
            // Generate unique slug
            $slug = Str::slug($request->name);
            $count = Category::where('slug', $slug)->count();
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }

            $data = [
                'name' => $request->name,
                'slug' => $slug,
                'admin_id' => auth()->guard('admin')->id(),
            ];

            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/categories'), $filename);
                $data['image'] = $filename;
            }

            Category::create($data);

            return redirect()->route('categories.index')
                ->with('success', 'Category added successfully!');

        } catch (QueryException $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.')
                ->withInput();
        }
    }


    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10048',
        ]);

        try {
            // Update slug if name changed
            $slug = Str::slug($request->name);
            $count = Category::where('slug', $slug)->where('id', '!=', $id)->count();
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }

            $category->name = $request->name;
            $category->slug = $slug;

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($category->image && file_exists(public_path('images/categories/' . $category->image))) {
                    unlink(public_path('images/categories/' . $category->image));
                }

                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/categories'), $filename);
                $category->image = $filename;
            }

            $category->save();

            return redirect()->route('categories.index')
                ->with('success', 'Category updated successfully!');

        } catch (QueryException $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.')
                ->withInput();
        }
    }


    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')
                ->with('success', 'Category deleted successfully!');
        } catch (QueryException $e) {
            return redirect()->back()
                ->with('error', 'Cannot delete this category.');
        }
    }

}
