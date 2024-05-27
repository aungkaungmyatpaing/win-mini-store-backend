@extends('backend.main')

@section('deli')
    active
@endsection

@section('content')
<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Create Township Fee</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form action="{{route('township.store')}}" id="township" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="cod" value="1" checked>
                            <label class="custom-control-label" for="customCheck1">Cash On Delivery</label>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">Region</label>
                        <select name="region_id" class="form-control" id="">
                            @foreach ($regions as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom02">Township Name</label>
                        <input type="text" class="form-control" id="validationCustom02" name="name" placeholder="Bahan" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom07">Township Name MM</label>
                        <input type="text" class="form-control" id="validationCustom07" name="name_mm" placeholder="Bahan_mm" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom04">Delivery Fee</label>
                        <input type="number" class="form-control" id="validationCustom04" name="delivery_fee" placeholder="3000" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom05">Duration</label>
                        <input type="number" class="form-control" id="validationCustom05" placeholder="3" name="duration">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom06">Remark</label>
                        <input type="text" class="form-control" id="validationCustom06" placeholder="Remark something ..." name="remark">
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
{!! JsValidator::formRequest('App\Http\Requests\TownshipRequest', '#township') !!}
@endpush