@extends('backend.main')

@section('category')
    active
@endsection

@section('search-route')
    {{ route('categories.index') }}
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Category List</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div id="table" class="table-editable">
                    <span class="table-add float-right mb-3 mr-2">
                        <a href="{{ route('categories.create') }}" class="btn btn-sm iq-bg-success">
                            <i class="ri-add-fill">
                                <span class="pl-1">Create Category</span>
                            </i>
                        </a>
                    </span>
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Myanmar Name</th>
                                    <th scope="col">English Name</th>

                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($results as $key => $item)
                                    <tr>
                                        <td scope="row">{{ ++$key }}</td>
                                        <td align="center">
                                            @if ($item->image)
                                            <div class="rounded" style="width: 150px; height: 100px; overflow:hidden;">
                                                <img style="width: 100%; height: 100%; object-fit: cover; object-position: 50% 50%;"
                                                src="{{ asset('storage/images/' . $item->image) }}"
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
                                        <td>{{ $item->myanmar_name }}</td>
                                        <td>{{ $item->english_name }}</td>

                                        <td>
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button"
                                                    class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="ri-settings-4-fill"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item"
                                                        href="{{ route('categories.edit', $item->id) }}"><i
                                                            class="ri-pencil-line"></i> Edit</a>
                                                    <button class="dropdown-item delete_btn" data-id={{ $item->id }}><i
                                                            class="ri-delete-bin-line"></i> Delete</button>
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
            if (search.value.length == 0) {
                window.location.href = "{{ URL::to('categories') }}"
            }
        }

        function updateHandler($id) {
            window.location.href = `{{ URL::to('categories/${$id}/edit') }}`;
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
                            url: `/categories/${id}`,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                        }).done(function(res) {
                            window.location.href = "{{ URL::to('categories') }}"
                        }).fail(function(xhr, status, error) {
                            var errorMessage = JSON.parse(xhr.responseText).message;
                            swal("Warning", errorMessage, "warning");
                        })
                    }
                });
        })
    </script>
@endpush
