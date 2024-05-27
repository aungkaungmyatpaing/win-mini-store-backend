@extends('backend.main')

@section('dashboard')
    active
@endsection

@section('content')
<div class="col-sm-6 col-md-6 col-lg-4">
    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
       <div class="iq-card-body">
          <div class="d-flex align-items-center justify-content-between text-right">
             <div class="icon iq-icon-box rounded-circle bg-primary">
                <i class="ri-currency-fill"></i>
             </div>
             <div>
                <h5 class="mb-0">Today Sale</h5>
                <span class="h4 text-primary mb-0 counter d-inline-block w-100">30,290</span>
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="col-sm-6 col-md-6 col-lg-4">
    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
       <div class="iq-card-body">
          <div class="d-flex align-items-center justify-content-between text-right">
             <div class="icon iq-icon-box rounded-circle bg-success">
                <i class="ri-currency-fill"></i>
             </div>
             <div>
                <h5 class="mb-0">Today Income</h5>
                <span class="h4 text-success mb-0 counter d-inline-block w-100">25,281</span>
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="col-sm-6 col-md-6 col-lg-4">
    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
       <div class="iq-card-body">
          <div class="d-flex align-items-center justify-content-between text-right">
             <div class="icon iq-icon-box rounded-circle bg-danger">
                <i class="ri-vip-diamond-fill"></i>
             </div>
             <div>
                <h5 class="mb-0">Total Product</h5>
                <span class="h4 text-danger mb-0 counter d-inline-block w-100">12,396</span>
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="col-sm-6 col-md-6 col-lg-4">
    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
       <div class="iq-card-body iq-box-relative">
          <div class="d-flex align-items-center justify-content-between text-right">
             <div class="icon iq-icon-box rounded-circle bg-warning">
                <i class="ri-scan-fill"></i>
             </div>
             <div>
                <h5 class="mb-0">Total Category</h5>
                <span class="h4 text-warning mb-0 counter d-inline-block w-100">28,258</span>
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="col-sm-6 col-md-6 col-lg-4">
    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
       <div class="iq-card-body iq-box-relative">
          <div class="d-flex align-items-center justify-content-between text-right">
             <div class="icon iq-icon-box rounded-circle bg-info">
                <i class="ri-currency-fill"></i>
             </div>
             <div>
                <h5 class="mb-0">This Month Sale</h5>
                <span class="h4 text-info mb-0 counter d-inline-block w-100">29,302</span>
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="col-sm-6 col-md-6 col-lg-4">
    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
       <div class="iq-card-body iq-box-relative">
          <div class="d-flex align-items-center justify-content-between text-right">
             <div class="icon iq-icon-box rounded-circle bg-secondary">
                <i class="ri-currency-fill"></i>
             </div>
             <div>
                <h5 class="mb-0">Last Month Sale</h5>
                <span class="h4 text-secondary mb-0 counter d-inline-block w-100">15,287</span>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection
