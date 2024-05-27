<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TownshipRequest;
use App\Http\Requests\UpdateTownshipRequest;
use App\Models\Address;
use App\Models\Region;
use App\Models\Township;
use Illuminate\Http\Request;

class TownshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $results = Township::query()
        ->with('region')
        ->when($request->keyword, function($query, $keyword) {
            $query->where('name', 'like', "%{$keyword}%")
                  ->orWhereHas('region', function ($subQuery) use ($keyword) {
                      $subQuery->where('name', 'like', "%{$keyword}%");
                  });
        })
        ->latest()
        ->paginate(15);

        return view('backend.townships.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        return view('backend.townships.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TownshipRequest $request)
    {
        $township = new Township();
        $township->region_id = $request->region_id;
        $township->name = $request->name;
        $township->name_mm = $request->name_mm;
        if ($request->has('cod')) {
            $township->cod = 1;
        } else {
            $township->cod = 0; // Default to 0 if 'cod' key is not present
        }
        $township->delivery_fee = $request->delivery_fee;
        $township->duration = $request->duration;
        $township->remark = $request->remark;
        $township->save();

        return redirect()->route('township.index')->with('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Township $township)
    {
        $regions = Region::all();
        return view('backend.townships.edit',compact('regions','township'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTownshipRequest $request, Township $township)
    {
        $township->name = $request->name;
        $township->name_mm = $request->name_mm;
        if ($request->has('cod')) {
            $township->cod = 1;
        } else {
            $township->cod = 0; // Default to 0 if 'cod' key is not present
        }
        $township->region_id = $request->region_id;
        $township->delivery_fee = $request->delivery_fee;
        $township->duration = $request->duration;
        $township->remark = $request->remark;
        $township->save();

        return redirect()->route('township.index')->with('success', 'region updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Township $township)
    {
        $addressesCount = Address::where('township_id', $township->id)->count();

        if ($addressesCount > 0) {
            return response()->json(['message' => 'Cannot delete this township because the addresses of some customers associated with this township exist.'], 422);
        }

        $township->delete();

        return 'success';
    }
}
