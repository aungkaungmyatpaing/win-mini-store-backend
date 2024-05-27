<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentAccountRequest;
use App\Http\Requests\UpdatePaymentAccountRequest;
use App\Models\Payment;
use App\Models\PaymentAccount;
use Illuminate\Http\Request;

class PaymentAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $results = PaymentAccount::query()
        ->with('payment')
        ->when($request->keyword, function ($query, $keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('account_name', 'like', "%{$keyword}%")
                    ->orWhere('account_number', 'like', "%{$keyword}%");
            });
        })
        ->latest()
        ->paginate(15);
        return view('backend.payments.account.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $payment = Payment::all();
        return view('backend.payments.account.create', compact('payment'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentAccountRequest $request)
    {
        $account = new PaymentAccount();
        $account->payment_id = $request->payment_id;
        $account->account_name = $request->account_name;
        $account->account_number = $request->account_number;
        $account->save();

        return redirect()->route('payment-accounts.index')->with('success', 'Payment account created successfully');

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
    public function edit(PaymentAccount $payment_account)
    {
        $payment = Payment::all();
        return view('backend.payments.account.edit', compact('payment','payment_account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentAccountRequest $request, PaymentAccount $payment_account)
    {
        $payment_account->payment_id = $request->payment_id;
        $payment_account->account_name = $request->account_name;
        $payment_account->account_number = $request->account_number;

        $payment_account->update();

        return redirect()->route('payment-accounts.index')->with('success', 'Account updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentAccount $payment_account)
    {
        $payment_account->delete();
        return 'success';
    }
}
