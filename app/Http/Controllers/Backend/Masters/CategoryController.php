<?php

namespace App\Http\Controllers\Backend\Masters;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function categoryForm()
    {
        return view('backend.admin.masters.category.categoryform');
    }

    public function categoryView(Request $request)
    {
        $search = $request->input('search');
        $sortColumn = $request->input('sort', 'cate_name'); // Default sorting column
        $sortDirection = $request->input('direction', 'asc'); // Default sorting order
        $perPage = $request->input('per_page', 25); // Default pagination length

        // Check if "Complete" is selected, then fetch all records
        if ($perPage == 'all') {
            $categories = Category::when($search, function ($query, $search) {
                return $query->where('cate_name', 'like', "%{$search}%");
            })
                ->orderBy($sortColumn, $sortDirection)
                ->get(); // Fetch all records without pagination
        } else {
            $categories = Category::when($search, function ($query, $search) {
                return $query->where('cate_name', 'like', "%{$search}%");
            })
                ->orderBy($sortColumn, $sortDirection)
                ->paginate($perPage);
        }

        return view('backend.admin.masters.category.list', compact('categories', 'search', 'sortColumn', 'sortDirection', 'perPage'));
    }

    public function storeCategory(Request $request)
    {
        // Log request data for debugging

        // Validate request data
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,cate_name',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle Image Upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Unique filename
            $imagePath = $image->storeAs('uploads/categories', $imageName, 'public'); // Store in public/uploads/categories
        }

        // Create a new category
        $category = new Category();
        $category->cate_name = $request->category_name;
        $category->cate_descript = $request->description ?? '';
        $category->cate_img_loc = $imagePath; // Save image path
        $category->status = $request->status ? 'Y' : 'N'; // Store as 'Y' or 'N'
        $category->save();

        // Return success message
        return redirect()->back()->with('success', 'Category created successfully!');
    }
    public function toggleStatus($id)
    {
        $category = Category::findOrFail($id);
        $category->status = $category->status == 1 ? 'N' : 'Y'; // Toggle between Y/N
        $category->save();

        return redirect()->back()->with('success', 'Category status updated successfully!');
    }
    public function editCategory($id)
    {
        $category = Category::findOrFail($id); // Fetch category by ID

        return view('backend.admin.masters.category.edit', compact('category'));
    }
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'cate_name' => 'required|string|max:255|unique:categories,cate_name,' . $id . ',cate_id',
            'description' => 'nullable|string',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::findOrFail($id);
        $category->cate_name = $request->cate_name;
        $category->cate_descript = $request->description ?? '';

        // Handle Image Upload
        if ($request->hasFile('category_image')) {
            // Delete old image if exists
            if ($category->cate_Ico) {
                Storage::delete('public/' . $category->cate_Ico);
            }

            $image = $request->file('category_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('uploads/categories', $imageName, 'public');
            $category->cate_img_loc = $imagePath;
        }

        $category->save();

        return redirect()->route('categoryView')->with('success', 'Category updated successfully!');
    }
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        // Delete Image if Exists
        if ($category->cate_Ico) {
            Storage::delete('public/' . $category->cate_Ico);
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}
