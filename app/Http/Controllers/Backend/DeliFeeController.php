<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreDeliFeeRequest;
use App\Http\Requests\UpdateDeliFeeRequest;
use App\Models\DeliFee;
use App\Models\Region;
use App\Models\Township;
use Illuminate\Http\Request;

class DeliFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $results = Township::query()
        ->when($request->keyword, function ($query, $keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })
        ->latest()
        ->paginate(15);

        return view('backend.deli-fees.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        return view('backend.deli-fees.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeliFeeRequest $request)
    {
        $deliFee = new DeliFee();
        $deliFee->region_id = $request->region_id;
        $deliFee->city = $request->city;
        $deliFee->fee = $request->fee;
        $deliFee->save();

        return redirect()->route('deli-fees.index')->with('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliFee $deliFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeliFee $deliFee)
    {
        $regions = Region::all();
        return view('backend.deli-fees.edit',compact('regions','deliFee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeliFeeRequest $request, DeliFee $deliFee)
    {
        $deliFee->region_id = $request->region_id;
        $deliFee->city = $request->city;
        $deliFee->fee = $request->fee;
        $deliFee->save();

        return redirect()->route('deli-fees.index')->with('success', 'Deli Fee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliFee $deliFee)
    {
        $deliFee->delete();

        return 'success';
    }
}
