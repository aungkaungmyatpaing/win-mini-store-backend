@extends('backend.main')

@section('customer')
    active
@endsection

@section('content')
<div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
               <div class="iq-header-title">
                  <h4 class="card-title">Edit Customer</h4>
               </div>
            </div>
            <div class="iq-card-body">
               <form action="{{route('customer.update',$customer->id)}}" id="customer_store" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">User Name</label>
                            <input type="text" class="form-control" id="validationCustom01" name="name" value="{{ $customer->name }}" required>
                            <div class="valid-feedback">
                            Looks good!
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Phone</label>
                            <input type="text" class="form-control" id="validationCustom01" name="phone" value="{{ $customer->phone }}" required>
                            <div class="valid-feedback">
                            Looks good!
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Point</label>
                            <input type="number" class="form-control" id="validationCustom01" name="point" value="{{ $customer->point }}" required>
                            <div class="valid-feedback">
                            Looks good!
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Is Banned</label>
                            <select class="form-control" id="validationCustom01" name="is_banned" required>
                                <option value="0" {{ $customer->is_banned == 0 ? 'selected' : '' }}>Active</option>
                                <option value="1" {{ $customer->is_banned == 1 ? 'selected' : '' }}>Banned</option>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Password</label>
                            <input type="password" class="form-control" id="validationCustom01" name="password" required>
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
{{-- {!! JsValidator::formRequest('App\Http\Requests\UpdateCustomerRequest', '#customer_store') !!} --}}
<script>

</script>
@endpush
