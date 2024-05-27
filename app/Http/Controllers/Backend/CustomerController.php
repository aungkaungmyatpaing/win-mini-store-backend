<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $results = Customer::query()
        ->when($request->keyword, function ($query, $keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })
        ->latest()
        ->paginate(15);

        return view('backend.customer.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Customer $customer)
    {
        return view('backend.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {

        $customer->name = $request->name;
        // Update other fields as needed
        $customer->phone = $request->phone;
        $customer->point = $request->point;
        $customer->is_banned = $request->is_banned;

        // Check if password is provided and update it if it is
        if ($request->password != null) {
            $customer->password = bcrypt($request->password); // Hash the password
        }

        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function banUser($id)
    {
        $customer = Customer::find($id);
        $customer->is_banned = 1;
        $customer->save();

        $customer->tokens()->delete();
        return 'success';
    }
}
