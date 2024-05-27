<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $results = Size::query()
            ->when($request->keyword, function ($query, $keyword) {
                return $query->where('english_name', 'like', "%{$keyword}%")->where('myanmar_name', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(15);

        return view('backend.sizes.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSizeRequest $request)
    {
        $size = new Size();
        // $size->name = $request->name;
        $size->english_name = $request->english_name;
        $size->myanmar_name = $request->myanmar_name;
        $size->save();
        $size->save();

        return redirect()->route('sizes.index')->with('success', 'Size created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        return view('backend.sizes.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSizeRequest $request, Size $size)
    {
        $size->english_name = $request->english_name;
        $size->myanmar_name = $request->myanmar_name;
        $size->save();

        return redirect()->route('sizes.index')->with('success', 'Size update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        $size->delete();

        return 'success';
    }
}
