<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subscription;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Categories List';

        if ($request->ajax()) {
            $data = Category::with('subscriptions')->get();

            return DataTables::of($data)
                ->addColumn('image_display', function ($row) {
                    return '<img src="' . asset('storage/app/public/' . $row->image) . '" class="img-fluid" width="100">';
                })
                ->addColumn('subscriptions', function ($row) {
                    return implode(', ', $row->subscriptions->pluck('name')->toArray());
                })
                ->addColumn('action', function ($row) {
                    $buttons = '<div class="d-flex align-items-center list-action">';
                    $buttons .= '<a href="' . route('category.show', ['category' => $row->id]) . '" class="badge bg-info mr-2" data-toggle="tooltip" data-placement="top" title="View"><i class="ri-eye-line mr-0"></i></a>';
                    $buttons .= '<a href="' . route('category.edit', ['category' => $row->id]) . '" class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="ri-pencil-line mr-0"></i></a>';
                    $buttons .= '<button class="badge badge-warning mr-2 delete-user border-0" data-id="' . $row->id . '" data-model="category" data-toggle="modal" data-target="#deleteCategoryModal"><i class="ri-delete-bin-line mr-0"></i></button>';
                    $buttons .= '</div>';
                    return $buttons;
                })
                ->rawColumns(['image_display', 'action'])
                ->make(true);
        }

        return view('categories.index', compact('title'));
    }

    public function create()
    {
        $title = "Create Category";
        $subscriptions = Subscription::all();
        return view('categories.create', compact('title', 'subscriptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
            'subscription_id' => 'required|array',
            'subscription_id.*' => 'exists:subscriptions,id',
        ]);

        $data = $request->except('subscription_id');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images/categories/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $data['image'] = $imagePath;
        }

        $category = Category::create($data);
        $category->subscriptions()->sync($request->subscription_id);

        // return redirect()->route('category.index')->with('success', 'Category created successfully.');
        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully.',
        ]);
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $title = "Edit Category";
        $subscriptions = Subscription::all();
        return view('categories.edit', compact('category', 'title', 'subscriptions'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
            'subscription_id' => 'required|array',
            'subscription_id.*' => 'exists:subscriptions,id',
        ]);

        $data = $request->except(['subscription_id', '_token', '_method']);

        if ($request->hasFile('image')) {
            // Delete the old image file if it exists
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images/categories/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $data['image'] = $imagePath;
        }

        $category->update($data);

        // Sync subscriptions
        $category->subscriptions()->sync($request->subscription_id);

        // Return JSON for API requests
        if ($request->expectsJson() || $request->wantsJson()) {
            $category->load('subscriptions');
            return response()->json([
                'status' => 'success',
                'message' => 'Category updated successfully.',
                'category' => $category
            ]);
        }

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

       public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'status' => 'success', 
            'message' => 'Category deleted successfully.'
        ]);
    }
    // API method to get all categories
    public function getAllCategories()
    {
        $categories = Category::with('subscriptions')->get();

        return response()->json([
            'status' => 'success',
            'categories' => $categories,
            'message' => 'Categories fetched successfully'
        ]);
    }
}
