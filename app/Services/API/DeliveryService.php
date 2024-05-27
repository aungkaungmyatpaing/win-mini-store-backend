<?php

namespace App\Services\API;

use App\Models\Payment;
use App\Models\Region;
use Illuminate\Database\Eloquent\Collection;

class DeliveryService
{
    public function getRegions(): Collection
    {
        $regions = Region::where('cod','1')->get();
        return $regions;
    }

    public function getTownships($regionId): Collection
    {
        $region = Region::findOrFail($regionId);
        return $region->townships;
    }

    public function getPayments(): Collection
    {
        $payments = Payment::all();
        return $payments;
    }

    public function getPaymentAccounts(int $id): Collection
    {
        $payment_accounts = Payment::find($id)->paymentAccounts;
        return $payment_accounts;
    }
}
