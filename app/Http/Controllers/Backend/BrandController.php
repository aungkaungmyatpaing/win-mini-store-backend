<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    protected $path = 'storage/images/brands/';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $results = Brand::query()
        ->when($request->keyword, function ($query, $keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })
            ->latest()
            ->paginate(15);
            // return $results;
        return view('backend.brands.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = new Brand();
        $brand->name = $request->name;
        if ($request->hasFile('image')) {
            $photoName = uniqid('gold') . '.' . $request->image[0]->extension();
            $brand->image = 'brands/'.$photoName;
            $request->image[0]->move(public_path($this->path), $photoName);
        }
        $brand->save();

        return redirect()->route('brands.index')->with('success', 'Brand created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('backend.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        // return $request->all();

        $brand->name = $request->name;
        if ($request->hasFile('image')) {
            if ($brand->image != '') {
                if (file_exists(public_path($this->path) . $brand->image)) {
                    unlink(public_path($this->path) . $brand->image);

                }
            }
            $photoName = uniqid('gold') . '.' . $request->image[0]->extension();
            $brand->image = 'brands/' . $photoName;
            $request->image[0]->move(public_path($this->path), $photoName);
        }
        $brand->update();

        return redirect()->route('brands.index')->with('success', 'Brand Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brandProductCount = Product::where('brand_id', $brand->id)->count();

        if ($brandProductCount > 0) {
            return response()->json(['message' => 'Cannot delete this because some products associated with this brand exist.'], 422);
        }
        if ($brand->image != '') {
            if (file_exists(public_path($this->path) . $brand->image)) {
                unlink(public_path($this->path) . $brand->image);
            }
        }
        $brand->delete();
        Session::put('success', 'Brand deleted successfully');
        return 'success';
    }
}
