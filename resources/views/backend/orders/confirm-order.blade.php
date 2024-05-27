@extends('backend.main')

@section('confirm-order')
    active
@endsection

@section('search-route')
    {{ route('confirm-order.index') }}
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Confirm List - {{$totalCount}}</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div id="table" class="table-editable">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Payment</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Grand Total</th>
                                    <th scope="col">Grand Total (Baht)</th>
                                    <th scope="col">Exchange Rate</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($results as $key => $item)
                                    <tr>
                                        <td scope="row">{{ ++$key }}</td>
                                        <td >
                                                {{ $item->customer ? $item->customer->name : 'Unknown'}}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#customerModal-{{$item->id}}">
                                                {{ $item->address ? $item->address->township ? $item->address->township->name : 'N/A' : 'N/A' }}
                                            </button>
                                            <!-- Modal -->
                                                <div class="modal fade" id="customerModal-{{$item->id}}" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="customerModalLabel">Address Detail</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex flex-column ">
                                                                <span><span class="text-primary">Address - </span>{{ $item->address->address }}</span>
                                                                <span><span class="text-primary">Name (not username) - </span>{{ $item->address->name }}</span>
                                                                <span><span class="text-primary">Phone - </span>{{ $item->address->phone }}</span>
                                                                <span><span class="text-primary">Township - </span>{{ $item->address->township->name }}</span>
                                                                <span><span class="text-primary">Region - </span>{{ $item->address->township->region->name }}</span>
                                                                <span><span class="text-primary">Delivery Fees - </span>{{ $item->address->township->delivery_fee }}</span>
                                                                <span><span class="text-primary">Duration Day - </span>{{ $item->address->township->duration }} </span>


                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            <!-- Modal -->
                                        </td>
                                        <td>
                                            @if($item->cod == 1)
                                                COD
                                            @else
                                                @if($item->paymentAccount && $item->paymentAccount->payment)
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal-{{ $item->id }}">
                                                        {{ $item->paymentAccount->payment->name }}
                                                    </button>
                                                @else
                                                    N/A
                                                @endif
                                            @endif
                                             <!-- Modal -->
                                                <div class="modal fade" id="paymentModal-{{$item->id}}" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="paymentModalLabel">Payment Detail</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex flex-column ">
                                                                @if($item->cod == 0 && $item->paymentAccount && $item->paymentAccount->payment)
                                                                    <span><span class="text-primary">Payment - </span>{{ $item->paymentAccount->payment->name }}</span>
                                                                    <span><span class="text-primary">Acc Number - </span>{{ $item->paymentAccount->account_number }}</span>
                                                                    <span><span class="text-primary">Acc Name - </span>{{ $item->paymentAccount->account_name }}</span>
                                                                    @if ($item->slip)
                                                                        <div class="rounded mt-1" style="width: 100%; overflow:hidden;">
                                                                            <img style="width: 100%; height: auto; object-fit: contain;" src="{{ asset('storage/images/' . $item->slip) }}" alt="slip">
                                                                        </div>

                                                                    @else
                                                                        <div class="rounded mt-1" style="width: 150px; height: 100px; overflow:hidden;">
                                                                            <img style="width: 100%; height: 100%; object-fit: cover; object-position: 50% 50%;"
                                                                            src="{{ asset('backend/assets/images/default.png') }}"
                                                                            alt="slip">
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            <!-- Modal -->
                                        </td>
                                        <td>{{ $item->total }}</td>
                                        <td>{{ $item->grand_total }}</td>
                                        <td>{{ $item->grand_total_exchange }}</td>
                                        <td>{{ $item->order_time_exchange_rate }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button"
                                                    class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="ri-settings-4-fill"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item"
                                                        href="{{ route('order-detail', $item->id) }}"><i class="ri-eye-line"></i> View Detail</a>
                                                        <button class="dropdown-item deliver_btn" data-id={{ $item->id }}><i class="ri-check-line"></i>Deliver</button>
                                                    <button class="dropdown-item cancel_btn" data-id={{ $item->id }}><i class="ri-close-circle-line"></i> Cancel</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">There is no item in table!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $results->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // function checkValue() {
        //     const search = document.querySelector('#search');
        //     if (search.value.length == 0) {
        //         window.location.href = "{{ URL::to('products') }}"
        //     }
        // }

        // function updateHandler($id) {
        //     window.location.href = `{{ URL::to('products/${$id}/edit') }}`;
        // }

        $(document).on('click', '.deliver_btn', function(e) {
            e.preventDefault();
            swal({
                    text: "Order Status Delivered",
                    icon: "info",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        let id = $(this).data('id');
                        console.log(id);
                        $.ajax({
                            url: `/orders/${id}/deliver`,
                            method: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                        }).done(function(res) {
                            window.location.href = "{{ URL::to('orders/confirm') }}"
                        })
                    }
                });
        })


        $(document).on('click', '.cancel_btn', function(e) {
            e.preventDefault();
            swal({
                    text: "Order Status Cancel",
                    icon: "info",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        let id = $(this).data('id');
                        console.log(id);
                        $.ajax({
                            url: `/orders/${id}/cancel`,
                            method: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                        }).done(function(res) {
                            window.location.href = "{{ URL::to('orders/pending') }}"
                        })
                    }
                });
        })
    </script>
@endpush
