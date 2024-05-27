<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateWholeSaleRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\WholeSaleProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class ProductController extends Controller
{
    public $productImageArray = [];
    protected $path = 'storage/images/products/';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $results = Product::query()
            ->with(['brand', 'category', 'image'])
            ->when($request->keyword, function ($query, $keyword) {
                return $query->where('name', 'like', "%{$keyword}%");
            })->latest()
            ->paginate(15);

        return view('backend.products.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $colors = Color::all();
        $sizes = Size::all();
        return view('backend.products.create', compact('brands', 'categories', 'colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // dd($request->all());
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'description' => $request->description,
            'price' => $request->price,
            'instock' => $request->instock,
            'redeemable' => $request->redeemable ?? 0,
            'instock_amount' => $request->instock_amount,
            'point' => $request->point ?? 0
        ]);

        if ($request->filled('whole_sale_quantity') && $request->filled('whole_sale_price')) {
            $quantityArray = json_decode($request->input('whole_sale_quantity'), true);
            $priceArray = json_decode($request->input('whole_sale_price'), true);

            if ($quantityArray !== null && $priceArray !== null) {
                if (count($quantityArray) === count($priceArray)) {
                    // Loop through the arrays and create WholeSaleProduct records
                    for ($i = 0; $i < count($quantityArray); $i++) {
                        WholeSaleProduct::create([
                            'product_id' => $product->id,
                            'quantity' => $quantityArray[$i],
                            'price' => $priceArray[$i],
                        ]);
                    }
                }
            }
        }

        if ($request->filled('colors')) {
            $colors = Color::whereIn('id', $request->colors)->get();
            $product->colors()->syncWithoutDetaching($colors);
        }

        if ($request->filled('sizes')) {
            $sizes = Size::whereIn('id', $request->sizes)->get();
            $product->sizes()->syncWithoutDetaching($sizes);
        }

        if ($request->hasFile('images')) {
            $this->_createProductImages($product->id, $request->file('images'));
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $colors = Color::all();
        $sizes = Size::all();
        $wholeSales = WholeSaleProduct::where('product_id', $product->id)->get();
        return view('backend.products.edit', compact('brands', 'categories', 'colors', 'sizes', 'product','wholeSales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

        if (empty($request->old) && empty($request->images)) {
            return redirect()->back()->with('fail', 'Product Image is required');
        }

        DB::beginTransaction();
        try {
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->instock_amount = $request->instock_amount;
            $product->point = $request->point ?? 0 ;

            if ($request->instock !== null) {
                $product->instock = 1;
            } else {
                $product->instock = 0;
            }

            if ($request->redeemable !== null) {
                $product->redeemable = 1;

            } else {
                $product->redeemable = 0;
            }


            // $colors = Color::whereIn('id', $request->colors)->get();
            $product->colors()->sync($request->colors);
            // $sizes = Size::whereIn('id', $request->sizes)->get();
            $product->sizes()->sync($request->sizes);

            $product->update();

            if ($request->filled('whole_sale_quantity') && $request->filled('whole_sale_price')) {
                $oldWholeSales = WholeSaleProduct::where('product_id', $product->id)->get();
                if ($oldWholeSales->isNotEmpty()) {
                    foreach ($oldWholeSales as $oldWholeSale) {
                        $oldWholeSale->delete();
                    }
                    $quantityArray = json_decode($request->input('whole_sale_quantity'), true);

                    $priceArray = json_decode($request->input('whole_sale_price'), true);

                    if ($quantityArray !== null && $priceArray !== null) {
                        if (count($quantityArray) === count($priceArray)) {
                            // Loop through the arrays and create WholeSaleProduct records
                            for ($i = 0; $i < count($quantityArray); $i++) {
                                WholeSaleProduct::create([
                                    'product_id' => $product->id,
                                    'quantity' => $quantityArray[$i],
                                    'price' => $priceArray[$i],
                                ]);
                            }
                        }
                    }
                }else{
                    $quantityArray = json_decode($request->input('whole_sale_quantity'), true);

                    $priceArray = json_decode($request->input('whole_sale_price'), true);

                    if ($quantityArray !== null && $priceArray !== null) {
                        if (count($quantityArray) === count($priceArray)) {
                            // Loop through the arrays and create WholeSaleProduct records
                            for ($i = 0; $i < count($quantityArray); $i++) {
                                WholeSaleProduct::create([
                                    'product_id' => $product->id,
                                    'quantity' => $quantityArray[$i],
                                    'price' => $priceArray[$i],
                                ]);
                            }
                        }
                    }
                }
            }

            if ($request->has('old') && !$request->has('images')) {
                $files = $product->images()->whereNotIn('id', $request->old)->get(); ## oldimg where not in request old
                if (count($files) > 0) { ## delete oldimg where not in request old
                    foreach ($files as $file) {
                        $oldPath = $file->getRawOriginal('path') ?? '';
                        Storage::delete($oldPath);
                    }

                    $product->images()->whereNotIn('id', $request->old)->delete();
                }
            }
            if ($request->has('old') && $request->has('images')) {
                $files = $product->images()->whereNotIn('id', $request->old)->get();
                if (count($files) > 0) {
                    foreach ($files as $file) {
                        $oldPath = $file->getRawOriginal('path') ?? '';
                        Storage::delete($oldPath);
                    }

                    $product->images()->where('product_id', $product->id)->delete();
                }
                if ($request->hasFile('images')) {
                    $this->_createProductImages($product->id, $request->file('images'));
                }
            }

            if (!$request->has('old') && $request->has('images')) {
                $files = $product->images()->where('product_id', $product->id)->get(); ## oldimg where in request old
                if (count($files) > 0) { ## delete oldimg where not in request old
                    foreach ($files as $file) {
                        $oldPath = $file->getRawOriginal('path') ?? '';
                        Storage::delete($oldPath);
                    }

                    $product->images()->where('product_id', $product->id)->delete();
                }
                if ($request->hasFile('images')) {
                    $this->_createProductImages($product->id, $request->file('images'));
                }
            }
            // if ($request->has('old')) {
            //     $files = $product->images()->whereNotIn('id', $request->old)->get();
            //     if (count($files) > 0) {
            //         foreach ($files as $file) {
            //             if (file_exists(public_path($this->path . $file))) {
            //                 unlink(public_path($this->path . $file));
            //             }
            //         }

            //         $product->images()->whereNotIn('id', $request->old)->delete();
            //     }
            // }

            // if ($request->hasFile('images')) {
            //     $this->_createProductImages($product->id, $request->file('images'));
            // }
            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $images = ProductImage::where('product_id', $product->id)->get();
        foreach ($images as $image) {
            $path = $image->getRawOriginal('path') ?? '';
            Storage::delete($path);
        }
        $colors = ProductColor::where('product_id', $product->id)->get();
        foreach ($colors as $color) {
            $color->delete();
        }
        $sizes = ProductSize::where('product_id', $product->id)->get();
        foreach ($sizes as $size) {
            $size->delete();
        }
        $product->delete();

        return 'success';
    }

    private function _createProductImages($productId, $files)
    {
        foreach ($files as $image) {
            $path = uniqid('gold') . '.' . $image->getClientOriginalExtension();
            $this->productImageArray[] = [
                'product_id' => $productId,
                'path' => 'products/' . $path,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $image->move(public_path($this->path), $path);
        }

        ProductImage::insert($this->productImageArray);
    }

    public function images(Product $product)
    {
        $oldImages = [];
        foreach ($product->images as $img) {
            $oldImages[] = [
                'id' => $img->id,
                'src' => asset('storage/images/' . $img->path),
            ];
        }

        return response()->json($oldImages);
    }

    // public function wholeSlaeUpdate(UpdateWholeSaleRequest $request){
    //     dd($request->all());
    // }
}
