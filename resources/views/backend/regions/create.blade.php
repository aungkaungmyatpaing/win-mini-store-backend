@extends('backend.main')

@section('region')
    active
@endsection

@section('content')
<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Create Region</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form action="{{route('regions.store')}}" id="region_store" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <div class="ms-3 form-check form-switch">
                            <input class="form-check-input" name="cod" type="checkbox" role="switch" id="flexSwitchCheckChecked" value="1" checked>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Available</label>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">Region</label>
                        <input type="text" class="form-control" id="validationCustom01" name="name" required>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom02">Region MM</label>
                        <input type="text" class="form-control" id="validationCustom02" name="name_mm" required>
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
{!! JsValidator::formRequest('App\Http\Requests\StoreRegionRequest', '#region_store') !!}
@endpush
