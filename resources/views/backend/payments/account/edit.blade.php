@extends('backend.main')

@section('payment-account')
    active
@endsection

@section('content')
<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Update Payment Account</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form action="{{route('payment-accounts.update',$payment_account->id)}}" id="payment_store" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="payment">Category</label>
                        <select name="payment_id" id="payment" class="form-control">
                            <option selected disabled>select payment</option>
                            @foreach ($payment as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == $payment_account->payment_id ? 'selected' : '' }}>{{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="account_name">Account Name</label>
                        <input type="text" class="form-control" id="account_name" name="account_name" value="{{ $payment_account->account_name }}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="account_number">Account Number</label>
                        <input type="text" class="form-control" id="account_number" name="account_number" value="{{ $payment_account->account_number }}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
{!! JsValidator::formRequest('App\Http\Requests\UpdatePaymentRequest', '#payment_store') !!}
<script>

</script>
@endpush
