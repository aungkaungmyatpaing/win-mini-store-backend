<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Http\Requests\StorePointRequest;
use App\Http\Requests\UpdatePointRequest;
use App\Models\Point;
use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $results = Point::query()
            ->when($request->keyboard, function ($query, $keyword) {
                return $query->orWhere('points', 'like', "%{$keyword}%")
                    ->orWhere('amounts', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(15);



        return view('backend.points.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.points.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePointRequest $request)
    {
        $point = new Point();
        $point->amounts = $request->amounts;
        $point->points = $request->points;
        $point->save();

        return redirect()->route('points.index')->with('success', 'Point created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Point $point)
    {
        return view('backend.points.edit', compact('point'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePointRequest $request, Point $point)
    {
        $point->amounts = $request->amount;
        $point->points = $request->point;
        $point->update();

        return redirect()->route('points.index')->with('success', 'Point updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Point $point)
    {
        $point->delete();

        return 'success';
    }
}
