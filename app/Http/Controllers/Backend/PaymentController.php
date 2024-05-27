<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    protected $path = 'storage/images/payments/';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $results = Payment::query()
        ->when($request->keyword, function($query, $keyword){
            return $query->where('name', 'like', "%{$keyword}%");
        })
        ->latest()
        ->paginate(15);
        return view('backend.payments.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $payment = new Payment();
        $payment->name = $request->name;
        if ($request->hasFile('image')) {
            $photoName = uniqid('gold') . '.' . $request->image[0]->extension();
            $payment->payment_logo = 'payments/' . $photoName;
            $request->image[0]->move(public_path($this->path), $photoName);
        }
        $payment->save();

        return redirect()->route('payments.index')->with('success', 'Paymnet created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('backend.payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->name = $request->name;
        if ($request->hasFile('image')) {
            if ($payment->payment_logo != '') {
                if (file_exists(public_path($this->path) . $payment->payment_logo)) {
                    unlink(public_path($this->path) . $payment->payment_logo);
                }
            }
            $photoName = uniqid('gold') . '.' . $request->image[0]->extension();
            $payment->payment_logo = 'payments/' . $photoName;
            $request->image[0]->move(public_path($this->path), $photoName);
        }
        $payment->update();

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        if ($payment->payment_logo != '') {
            if (file_exists(public_path($this->path) . $payment->payment_logo)) {
                unlink(public_path($this->path) . $payment->payment_logo);
            }
        }

        $payment->delete();
        Session::put('success', 'Brand deleted successfully');
        return 'success';
    }
}
