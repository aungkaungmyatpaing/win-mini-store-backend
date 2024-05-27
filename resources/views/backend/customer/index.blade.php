@extends('backend.main')

@section('customer')
    active
@endsection

@section('search-route')
    {{route('customer.index')}}
@endsection

@section('content')
<div class="col-sm-12">
    <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                <h4 class="card-title">Customer List</h4>
                </div>
            </div>
            <div class="iq-card-body">
            <div id="table" class="table-editable">
                {{-- <span class="table-add float-right mb-3 mr-2">
                <a href="{{ route('brands.create') }}" class="btn btn-sm iq-bg-success">
                    <i class="ri-add-fill">
                        <span class="pl-1">Create Brand</span>
                    </i>
                </a>
                </span> --}}
                <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Point</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($results as $key => $item)
                            <tr>
                                <td scope="row">{{ ++$key }}</td>
                                <td >{{ $item->name }}</td>
                                <td >{{ $item->phone }}</td>
                                <td >{{ $item->point }}</td>
                                <td >
                                    @if ($item->is_banned == 1)
                                        <span class="badge badge-danger">Banned</span>
                                    @else
                                        <span class="badge badge-primary">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ri-settings-4-fill"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="{{route('customer.edit', $item->id)}}"><i class="ri-pencil-line"></i> Edit</a>
                                        <button class="dropdown-item ban_btn" data-id={{$item->id}}><i class="ri-forbid-line"></i> Ban</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">There is no item in table!</td>
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
        $(document).on('click', '.ban_btn', function(e) {
            e.preventDefault();
            swal({
                text: "Are you sure to ban this user?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                let id = $(this).data('id');
                console.log(id);
                $.ajax({
                url : `/customer/${id}/ban`,
                method : 'POST',
                headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                }).done(function(res) {
                    window.location.href = "{{URL::to('customer')}}"
                })
            }
            });
        })
    </script>
@endpush
