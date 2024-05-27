@extends('backend.main')

@section('point')
    active
@endsection

@section('content')
<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Update Point</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form action="{{route('points.update', $point->id)}}" id="point_store" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">Amount</label>
                        <input type="number" class="form-control" id="validationCustom01" name="amount" value="{{ $point->amounts}}" required>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">Point</label>
                        <input type="number" class="form-control" id="validationCustom01" name="point" value="{{ $point->points}}" required>
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
{!! JsValidator::formRequest('App\Http\Requests\StorePointRequest', '#point_store') !!}
@endpush
