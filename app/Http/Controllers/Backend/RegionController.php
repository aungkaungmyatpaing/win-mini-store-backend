<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Models\Address;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $results = Region::query()
        ->when($request->keyword, function($query, $keyword){
            return $query->where('name', 'like', "%{$keyword}%");
        })
        ->latest()
        ->paginate(15);

        return view('backend.regions.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegionRequest $request)
    {
        // return $request->all();
        $region = new Region();
        $region->name = $request->name;
        $region->name_mm = $request->name_mm;
        if ($request->has('cod')) {
            $region->cod = 1;
        }else{
            $region->cod = 0;
        }
        $region->save();

        return redirect()->route('regions.index')->with('success', 'region created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        return view('backend.regions.edit',compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegionRequest $request, Region $region)
    {
        $region->name = $request->name;
        $region->name_mm = $request->name_mm;

        if (!$request->has('cod')) {
            $region->cod = 0;
        }else{
            $region->cod = $request->cod;
        }
        $region->save();

        return redirect()->route('regions.index')->with('success', 'region updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        $addressesCount = Address::whereHas('township', function ($query) use ($region) {
            $query->where('region_id', $region->id);
        })->count();

        if ($addressesCount > 0) {
            // If there are addresses associated with the region, return an error message
            return response()->json(['message' => 'Cannot delete this region because the addresses of some customers associated with this region exist.'], 422);
        }

        $region->delete();

        return 'success';
    }
}
