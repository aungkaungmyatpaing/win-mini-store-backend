@extends('backend.main')

@section('township')
    active
@endsection

@section('search-route')
    {{route('township.index')}}
@endsection

@section('content')
<div class="col-sm-12">
    <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                <h4 class="card-title">Township List</h4>
                </div>
            </div>
            <div class="iq-card-body">
            <div id="table" class="table-editable">
                <span class="table-add float-right mb-3 mr-2">
                <a href="{{ route('township.create') }}" class="btn btn-sm iq-bg-success">
                    <i class="ri-add-fill">
                        <span class="pl-1">Create TownShip</span>
                    </i>
                </a>
                </span>
                <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Region</th>
                        <th scope="col">Region MM</th>
                        <th scope="col">Name</th>
                        <th scope="col">Name MM</th>
                        <th scope="col">Delivery Fee</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Remark</th>
                        <th scope="col">Cash On Delivery</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($results as $key => $item)
                            <tr>
                                <td scope="row">{{ ++$key }}</td>
                                <td >{{ $item->region ? $item->region->name : 'N/A' }}</td>
                                <td >{{ $item->region ? $item->region->name_mm : 'N/A' }}</td>
                                <td >{{ $item->name }}</td>
                                <td >{{ $item->name_mm }}</td>
                                <td >{{ $item->delivery_fee }} MMK</td>
                                <td >{{ $item->duration ? $item->duration .'Day' : 'N/A' }}</td>
                                <td >{{ $item->remark ? $item->remark : 'N/A' }}</td>
                                <td >
                                    @if($item->cod == 1)
                                        <span class="badge badge-pill badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">No</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ri-settings-4-fill"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="{{route('township.edit', $item->id)}}"><i class="ri-pencil-line"></i> Edit</a>
                                        <button class="dropdown-item delete_btn" data-id={{$item->id}}><i class="ri-delete-bin-line"></i> Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">There is no item in table!</td>
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
                            url: `/township/${id}`,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                        }).done(function(res) {
                            window.location.href = "{{ URL::to('township') }}"
                        }).fail(function(xhr, status, error) {
                            var errorMessage = JSON.parse(xhr.responseText).message;
                            swal("Warning", errorMessage, "warning");
                        })
                    }
                });
        })
    </script>
@endpush
