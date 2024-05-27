@extends('backend.main')

@section('color')
    active
@endsection

@section('search-route')
    {{route('colors.index')}}
@endsection

@section('content')
<div class="col-sm-12">
        <div class="iq-card">
              <div class="iq-card-header d-flex justify-content-between">
                 <div class="iq-header-title">
                    <h4 class="card-title">Color List</h4>
                 </div>
              </div>
              <div class="iq-card-body">
               <div id="table" class="table-editable">
                 <span class="table-add float-right mb-3 mr-2">
                    <a href="{{ route('colors.create') }}" class="btn btn-sm iq-bg-success">
                        <i class="ri-add-fill">
                            <span class="pl-1">Create Color</span>
                        </i>
                    </a>
                 </span>
                 <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                            <th scope="col">No.</th>
                            <th scope="col">English Name</th>
                            <th scope="col">Myanmar Name</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($results as $key => $item)
                                <tr>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td >{{ $item->english_name }}</td>
                                    <td >{{ $item->myanmar_name }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-settings-4-fill"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="{{route('colors.edit', $item->id)}}"><i class="ri-pencil-line"></i> Edit</a>
                                            <button class="dropdown-item delete_btn" data-id={{$item->id}}><i class="ri-delete-bin-line"></i> Delete</button>
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
        function checkValue() {
            const search = document.querySelector('#search');
            if(search.value.length == 0) {
                window.location.href = "{{URL::to('colors')}}"
            }
        }

        function updateHandler($id) {
            window.location.href = `{{URL::to('colors/${$id}/edit')}}`;
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
                url : `/colors/${id}`,
                method : 'DELETE',
                headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                }).done(function(res) {
                    window.location.href = "{{URL::to('colors')}}"
                })
            }
            });
        })
    </script>
@endpush
