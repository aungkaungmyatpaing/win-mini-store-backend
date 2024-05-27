@extends('backend.main')

@section('payment')
    active
@endsection

@section('content')
<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Create Payment</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form action="{{route('payments.store')}}" id="payment_store" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="name">Payment Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Image</label>
                        <div class="input-images"></div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
{!! JsValidator::formRequest('App\Http\Requests\StorePaymentRequest', '#payment_store') !!}
<script>
    $(document).ready(function() {
        $('.input-images').imageUploader({
            extensions: ['.JPG','.jpg','.jpeg','.png','.gif','.svg'],

            mimes: ['image/jpg','image/JPG','image/jpeg','image/png','image/gif','image/svg+xml'],

            maxFiles: 1,

            imagesInputName: 'image',
        });
    });
</script>
@endpush
