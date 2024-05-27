<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $results = Color::query()
        ->when($request->keyword, function ($query, $keyword) {
            return $query->where('english_name', 'like', "%{$keyword}%")->orWhere('myanmar_name', 'like', "%{$keyword}%");
        })
        ->latest()
        ->paginate(15);

        return view('backend.colors.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColorRequest $request)
    {
        $color = new Color();
        $color->english_name = $request->english_name;
        $color->myanmar_name = $request->myanmar_name;
        $color->save();
        return redirect()->route('colors.index')->with('success', 'Color created succuessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        return view('backend.colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColorRequest $request, Color $color)
    {
        $color->english_name = $request->english_name;
        $color->myanmar_name = $request->myanmar_name;
        $color->update();

        return redirect()->route('colors.index')->with('success', 'Color updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        $color->delete();

        return 'success';
    }
}
