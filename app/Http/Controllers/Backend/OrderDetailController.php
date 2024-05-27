<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Point;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = OrderDetail::query()
        ->with(['customer', 'orderLists', 'paymentAccount', 'address'])
        ->when($request->keyword, function ($query, $keyword) {
            $query->whereHas('customer', function ($subQuery) use ($keyword) {
                $subQuery->where('name', 'like', "%{$keyword}%");
            });
        })
        ->where('status', 'pending'); // Filter by status "pending"

        $totalCount = $query->count(); // Get the total count before pagination

        $results = $query->latest()
                        ->paginate(15);
        return view('backend.orders.pending-order', compact('results','totalCount'));
    }

    public function confirmIndex(Request $request)
    {
        $query = OrderDetail::query()
        ->with(['customer', 'orderLists', 'paymentAccount', 'address'])
        ->when($request->keyword, function ($query, $keyword) {
            $query->whereHas('customer', function ($subQuery) use ($keyword) {
                $subQuery->where('name', 'like', "%{$keyword}%");
            });
        })
        ->where('status', 'confirmed'); // Filter by status "pending"

        $totalCount = $query->count(); // Get the total count before pagination

        $results = $query->latest()
                        ->paginate(15);
        return view('backend.orders.confirm-order', compact('results','totalCount'));
    }

    public function deliverIndex(Request $request)
    {
        $query = OrderDetail::query()
        ->with(['customer', 'orderLists', 'paymentAccount', 'address'])
        ->when($request->keyword, function ($query, $keyword) {
            $query->whereHas('customer', function ($subQuery) use ($keyword) {
                $subQuery->where('name', 'like', "%{$keyword}%");
            });
        })
        ->where('status', 'delivered'); // Filter by status "pending"

        $totalCount = $query->count(); // Get the total count before pagination

        $results = $query->latest()
                        ->paginate(15);
        return view('backend.orders.deliver-order', compact('results','totalCount'));
    }

    public function completeIndex(Request $request)
    {
        $query = OrderDetail::query()
        ->with(['customer', 'orderLists', 'paymentAccount', 'address'])
        ->when($request->keyword, function ($query, $keyword) {
            $query->whereHas('customer', function ($subQuery) use ($keyword) {
                $subQuery->where('name', 'like', "%{$keyword}%");
            });
        })
        ->where('status', 'completed'); // Filter by status "pending"

        $totalCount = $query->count(); // Get the total count before pagination

        $results = $query->latest()
                        ->paginate(15);
        return view('backend.orders.complete-order', compact('results','totalCount'));
    }

    public function cancelIndex(Request $request)
    {
        $query = OrderDetail::query()
        ->with(['customer', 'orderLists', 'paymentAccount', 'address'])
        ->when($request->keyword, function ($query, $keyword) {
            $query->whereHas('customer', function ($subQuery) use ($keyword) {
                $subQuery->where('name', 'like', "%{$keyword}%");
            });
        })
        ->where('status', 'cancelled'); // Filter by status "pending"

        $totalCount = $query->count(); // Get the total count before pagination

        $results = $query->latest()
                        ->paginate(15);
        return view('backend.orders.cancel-order', compact('results','totalCount'));
    }

    public function orderDetail($id)
    {
        $results = OrderDetail::with(['customer','orderLists','paymentAccount','address'])->find($id);
        return view('backend.orders.detail', compact('results'));
    }

    public function orderConfirm($id)
    {
        $results = OrderDetail::find($id);
        $results->status = 'confirmed';
        $results->save();

        return 'success';
    }

    public function orderCancel($id)
    {
        $results = OrderDetail::find($id);
        $results->status = 'cancelled';
        $results->save();

        return 'success';
    }

    public function orderDeliver($id)
    {
        $results = OrderDetail::find($id);
        $results->status = 'delivered';
        $results->save();

        return 'success';
    }

    public function orderComplete($id)
    {

        $results = OrderDetail::with('customer')->find($id);
        $points = Point::where('amounts', '<=', $results->total)
        ->orderBy('amounts','desc')
        ->first();
        $results->status = 'completed';
        $results->save();
        if($points){
            $results->customer->point += $points->points;
            $results->customer->save();
        }

        return 'success';
    }
}
