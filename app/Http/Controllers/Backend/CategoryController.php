<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    protected $path = 'storage/images/category/';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $results = Category::query()
        ->when($request->keyword, function($query, $keyword){
            return $query->where('name', 'like', "%{$keyword}%");
        })
        ->latest()
        ->paginate(15);
        return view('backend.categories.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $cate = new Category();
        $cate->myanmar_name = $request->myanmar_name;
        $cate->english_name = $request->english_name;

        if($request->hasFile('image')){
            $cate->image = $request->image[0]->store('categories');
        }
        if ($request->hasFile('image')) {
            $photoName = uniqid('gold') . '.' . $request->image[0]->extension();
            $cate->image = 'category/' . $photoName;
            $request->image[0]->move(public_path($this->path), $photoName);
        }
        $cate->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->myanmar_name = $request->myanmar_name;
        $category->english_name = $request->english_name;

        if ($request->hasFile('image')) {
            if ($category->image != '') {
                if (file_exists(public_path($this->path) . $category->image)) {
                    unlink(public_path($this->path) . $category->image);
                }
            }
            $photoName = uniqid('gold') . '.' . $request->image[0]->extension();
            $category->image = 'category/' . $photoName;
            $request->image[0]->move(public_path($this->path), $photoName);
        }
        $category->update();

        return redirect()->route('categories.index')->with('success', 'Categories updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $categoryProductCount = Product::where('category_id', $category->id)->count();

        if ($categoryProductCount > 0) {
            return response()->json(['message' => 'Cannot delete this because some products associated with this brand exist.'], 422);
        }
        if ($category->image != '') {
            if (file_exists(public_path($this->path) . $category->image)) {
                unlink(public_path($this->path) . $category->image);
            }
        }
        $category->delete();
        Session::put('success', 'Category deleted successfully');
        return 'success';
    }
}
