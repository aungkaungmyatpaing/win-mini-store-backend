@extends('backend.main')

@section('order-detail')
    active
@endsection

{{-- @section('search-route')
    {{ route('order-detail') }}
@endsection --}}

@section('content')
    <div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Order Product Detail List</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div id="table" class="table-editable">
                    <span class="table-add float-right mb-3 mr-2">
                        <button class="btn btn-sm iq-bg-success" onclick="goBack()">
                            <span class="pl-1">Back</span>
                        </button>
                    </span>
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Pirce</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Pirce</th>
                                    <th scope="col">Redeem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($results->orderLists as $key => $item)
                                    <tr>
                                        <td scope="row">{{ ++$key }}</td>
                                        <td >
                                            {{ $item->product ? $item->product->brand->name : 'N/A'}}
                                        </td>
                                        <td >
                                            {{ $item->product ? $item->product->category->english_name : 'N/A'}}
                                        </td>
                                        <td >
                                            {{ $item->product ? $item->product->name : 'N/A'}}
                                        </td>
                                        <td>
                                            @if ($item->product->image)
                                            <div class="rounded" style="width: 150px; height: 100px; overflow:hidden;">
                                                <img style="width: 100%; height: 100%; object-fit: cover; object-position: 50% 50%;"
                                                src="{{ asset('storage/images/' . $item->product->image->path) }}"
                                                alt="{{ $item->product->name }}">
                                            </div>

                                            @else
                                            <div class="rounded" style="width: 150px; height: 100px; overflow:hidden;">
                                                <img style="width: 100%; height: 100%; object-fit: cover; object-position: 50% 50%;"
                                                src="{{ asset('backend/assets/images/default.png') }}"
                                                alt="{{ $item->product->name }}">
                                            </div>
                                            @endif

                                        </td>
                                        <td >
                                            {{ $item->product && $item->product->productColors && count($item->product->productColors) > 0 ? $item->product->productColors[0]['english_name'] : 'N/A' }}
                                        </td>
                                        <td >
                                            {{ $item->product && $item->product->productSizes && count($item->product->productSizes) > 0 ? $item->product->productSizes[0]['english_name'] : 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $item->price }}
                                        </td>
                                        <td>
                                            {{ $item->quantity }}
                                        </td>
                                        <td>
                                            {{ $item->total_price }}
                                        </td>
                                        <td>
                                            @if ($item->redeem == 1)
                                                <span class="badge badge-success">True</span>
                                            @else
                                                <span class="badge badge-danger">False</span>
                                            @endif
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
                    {{-- {{ $results->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function goBack() {
            window.history.back();
        }
        // function checkValue() {
        //     const search = document.querySelector('#search');
        //     if (search.value.length == 0) {
        //         window.location.href = "{{ URL::to('products') }}"
        //     }
        // }

        // function updateHandler($id) {
        //     window.location.href = `{{ URL::to('products/${$id}/edit') }}`;
        // }

        // $(document).on('click', '.delete_btn', function(e) {
        //     e.preventDefault();
        //     swal({
        //             text: "Are you sure?",
        //             icon: "info",
        //             buttons: true,
        //             dangerMode: true,
        //         })
        //         .then((willDelete) => {
        //             if (willDelete) {
        //                 let id = $(this).data('id');
        //                 console.log(id);
        //                 $.ajax({
        //                     url: `/products/${id}`,
        //                     method: 'DELETE',
        //                     headers: {
        //                         'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        //                     },
        //                 }).done(function(res) {
        //                     window.location.href = "{{ URL::to('products') }}"
        //                 })
        //             }
        //         });
        // })
    </script>
@endpush
