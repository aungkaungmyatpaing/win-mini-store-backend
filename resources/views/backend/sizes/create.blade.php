@extends('backend.main')

@section('size')
    active
@endsection

@section('content')
<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Create Size</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form action="{{route('sizes.store')}}" id="color_store" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">English Name</label>
                        <input type="text" class="form-control" id="validationCustom01" name="english_name" value="-">
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">Myanmar Name</label>
                        <input type="text" class="form-control" id="validationCustom01" name="myanmar_name" value="-">
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
{!! JsValidator::formRequest('App\Http\Requests\StoreSizeRequest', '#size_store') !!}
@endpush
