@extends('backend.main')


@section('content')
<div class="col-sm-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Account Setting</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form action="{{route('admin.update')}}" id="admin_update" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">Name</label>
                        <input type="text" class="form-control" id="validationCustom01" name="name" value="{{ Auth::user()->name }}" required>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom02">Email</label>
                        <input type="email" class="form-control" id="validationCustom02" name="email" value="{{ Auth::user()->email }}" required>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom03">Password</label>
                        <input type="password" class="form-control" id="validationCustom03" name="password">
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
{!! JsValidator::formRequest('App\Http\Requests\ProfileUpdateRequest', '#admin_update') !!}
@endpush
