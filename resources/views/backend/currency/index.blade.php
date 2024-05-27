@extends('backend.main')

@section('currency')
    active
@endsection

@section('search-route')
    {{ route('currency.index') }}
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">{{ __('lang.currency')}}</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div class="alert alert-success" id="successAlert">
                    Success
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        {{ __('lang.today_price')}}
                    </div>
                    <div class="col-sm-6">
                        <form>
                            @csrf
                            <div class="d-flex justify-content-around">
                                <input type="hidden" name='currencyId' value="{{ isset($currency->id) ? $currency->id : 0 }}">
                                <div class="mx-1 d-flex align-items-center">
                                    <label for="kyat" style="font-size: 14px; color:#a09e9e;">MMK</label>
                                    <input type="number" class="form-control mx-2" id="kyat" name="kyat" required
                                        value="{{ isset($currency->kyat) ? $currency->kyat : 0 }}">
                                </div>
                               <div class="mx-1 d-flex  align-items-center">
                                    <label for="baht" style="font-size: 14px; color:#a09e9e;">BHT</label>
                                    <input type="number" class="form-control mx-2" id="baht" name="baht" required
                                        value="{{ isset($currency->baht) ? $currency->baht : 0 }}">
                               </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-2 d-flex align-items-center">
                        <button class="btn btn-block btn-success" id='currencyBtn'>
                            @if (@isset($currency))
                                Update
                            @else
                                Add
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $("#successAlert").hide()
            $('#currencyBtn').on('click', () => {
                var kyat = $('#kyat').val()
                var baht = $('#baht').val()
                $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    url: '/currency',
                    data: {
                        _token: '{{ csrf_token() }}',
                        'kyat': kyat,
                        'baht': baht,
                        'currencyId': $('[name="currencyId"]').val()
                    },
                    success: (data) => {
                        $("#successAlert").show()
                        setInterval(() => {
                           window.location.reload()
                        }, 1000);
                    }
                })
            })
        });
    </script>
@endpush
