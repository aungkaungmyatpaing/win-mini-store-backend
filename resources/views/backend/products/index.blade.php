@extends('backend.main')

@section('product')
    active
@endsection

@section('search-route')
    {{ route('products.index') }}
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Prodcut List</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div id="table" class="table-editable">
                    <span class="table-add float-right mb-3 mr-2">
                        <a href="{{ route('products.create') }}" class="btn btn-sm iq-bg-success">
                            <i class="ri-add-fill">
                                <span class="pl-1">Create Products</span>
                            </i>
                        </a>
                    </span>
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Colors</th>
                                    <th scope="col">Sizes</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Instock</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Redeemable</th>
                                    <th scope="col">Point</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($results as $key => $item)
                                    @php
                                        $colors = $item->colors->pluck('english_name')->toArray();
                                        $sizes = $item->sizes->pluck('english_name')->toArray();
                                    @endphp
                                    <tr>
                                        <td scope="row">{{ ++$key }}</td>
                                        <td>
                                            @if ($item->image)
                                            <div class="rounded" style="width: 150px; height: 100px; overflow:hidden;">
                                                <img style="width: 100%; height: 100%; object-fit: cover; object-position: 50% 50%;"
                                                src="{{ asset('storage/images/' . $item->image->path) }}"
                                                alt="{{ $item->name }}">
                                            </div>

                                            @else
                                            <div class="rounded" style="width: 150px; height: 100px; overflow:hidden;">
                                                <img style="width: 100%; height: 100%; object-fit: cover; object-position: 50% 50%;"
                                                src="{{ asset('backend/assets/images/default.png') }}"
                                                alt="{{ $item->name }}">
                                            </div>
                                            @endif

                                        </td>
                                        <td>
                                            @if (session()->has('locale'))
                                                @if (session('locale') === 'my')
                                                    {{ $item->category->myanmar_name }}
                                                @else
                                                    {{ $item->category->english_name }}
                                                @endif
                                            @else
                                                {{ $item->category->english_name }}
                                            @endif
                                        </td>
                                        <td>{{ $item->brand->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ count($colors) > 0 ? implode(', ', $colors) : '---' }}</td>
                                        <td>{{ count($sizes) > 0 ? implode(', ', $sizes) : '---' }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td><span
                                                class="badge badge-pill {{ $item->instock == 1 ? 'badge-success' : 'badge-danger' }}">{{ $item->instock == 1 ? 'instock' : 'out of stock' }}</span>
                                        </td>
                                        <td>{{ $item->instock_amount }}</td>
                                        <td><span
                                                class="badge badge-pill {{ $item->redeemable == 1 ? 'badge-success' : 'badge-danger' }}">{{ $item->redeemable == 1 ? 'Yes' : 'No' }}</span>
                                        </td>
                                        <td>
                                            {{ $item->point }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button"
                                                    class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="ri-settings-4-fill"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item"
                                                        href="{{ route('products.edit', $item->id) }}"><i
                                                            class="ri-pencil-line"></i> Edit</a>
                                                    <button class="dropdown-item delete_btn" data-id={{ $item->id }}><i
                                                            class="ri-delete-bin-line"></i> Delete</button>
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
        function checkValue() {
            const search = document.querySelector('#search');
            if (search.value.length == 0) {
                window.location.href = "{{ URL::to('products') }}"
            }
        }

        function updateHandler($id) {
            window.location.href = `{{ URL::to('products/${$id}/edit') }}`;
        }

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            swal({
                    text: "Are you sure?",
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        let id = $(this).data('id');
                        console.log(id);
                        $.ajax({
                            url: `/products/${id}`,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                        }).done(function(res) {
                            window.location.href = "{{ URL::to('products') }}"
                        })
                    }
                });
        })
    </script>
@endpush
