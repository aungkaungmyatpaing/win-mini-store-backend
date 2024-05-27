@extends('backend.main')

@section('deli')
    active
@endsection

@section('content')
<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Update Delivery Fee</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form action="{{route('deli-fees.udpate',$deliFee->id)}}" id="deli_store" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">Region</label>
                        <select name="region_id" class="form-control" id="">
                            @foreach ($regions as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $deliFee->region_id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">City</label>
                        <input type="text" class="form-control" id="validationCustom01" name="city" value="{{ $deliFee->city }}" required>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01"></label>
                        <input type="number" class="form-control" id="validationCustom01" name="fee" value="{{ $deliFee->fee }}" required>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
{!! JsValidator::formRequest('App\Http\Requests\StoreDeliFeeRequest', '#deli_store') !!}
@endpush
