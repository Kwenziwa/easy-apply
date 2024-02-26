@extends('layouts.master')

@section('title')
University
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1')
University
@endslot
@slot('title')
University
@endslot
@endcomponent
<div class="row">

    <div class="table-responsive mb-3">

        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ route('school-subjects.create') }}" class="btn btn-primary" >Add
                        Subject</a>
                    <br />
                    <table class="table align-middle datatable dt-responsive table-check nowrap dataTable no-footer"
                        style="border-collapse: collapse; border-spacing: 0px 8px; width: 100%;" id="DataTables_Table_0"
                        aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr>
                                <th scope="col" class="sorting sorting_desc" tabindex="0"
                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                    aria-label="ID: activate to sort column ascending" style="width: 122px;"
                                    aria-sort="descending">#</th>
                                <th scope="col" class="sorting sorting_desc" tabindex="0"
                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                    aria-label="Name: activate to sort column ascending" style="width: 122px;"
                                    aria-sort="descending">Name</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" aria-label="University: activate to sort column
                                    ascending" style="width: 125px;">University </th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending"
                                    style="width: 153px;">Email</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" aria-label="Website: activate to sort column ascending"
                                    style="width: 153px;">Website</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" aria-label="Mobile: activate to sort column ascending"
                                    style="width: 157px;">Mobile</th>
                                <th style="width: 80px; min-width: 80px;" class="sorting" tabindex="0"
                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                    aria-label="Action: activate to sort column ascending">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                            <tr class="odd">
                                <th scope="row" class="">
                                    {{$user->id}}
                                </th>
                                <td class="sorting_1">


                                    <a href="{{ route('universities.show', $user->id) }}"
                                        class="text-body">{{ $user->fullname }}</a>
                                </td>
                                <td>
                                    <img src="{{ url('storage/'.$user->portfolio->logo) }} " alt=""
                                        class="avatar-sm rounded-circle me-2">
                                    {{ $user->portfolio->university_name }}</td>
                                <td>{{ $user->portfolio->uni_email }}</td>
                                <td>
                                    <a href="{{$user->portfolio->website_url}}">{{$user->portfolio->website_url}}</a>
                                </td>
                                <td>{{ $user->portfolio->uni_phone_number }} </td>
                                <td>

                                    <form id="delete-form-{{ $user->id }}"
                                        action="{{ route('universities.destroy', $user->id) }}" method="POST">
                                        <a href="{{ route('universities.edit',$user->id) }}"
                                            class="btn btn-warning btn-sm d-inline" title="Edit Action"><i
                                                class="bx bx-pencil"></i></a>
                                        <a href="{{ route('universities.show',$user->id) }}"
                                            class="btn btn-warning btn-sm d-inline" title="Edit View"><i
                                                class="mdi mdi-eye"></i></a>
                                        @csrf {{-- CSRF token for security --}}
                                        @method('DELETE') {{-- Method spoofing to send a DELETE request --}}
                                        <button type="button" class="btn btn-danger btn-block btn-sm d-inline"
                                            onclick="confirmDelete({{ $user->id }})" title="Delete Action"><i
                                                class="mdi mdi-delete"></i></button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- end table -->
    </div>
</div>
<!-- end table responsive -->



@endsection


@section('script')
<!-- SweetAlert2 CDN -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    function confirmDelete(subjectId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form programmatically
                document.getElementById('delete-form-' + subjectId).submit();
            }
        })
    }
</script>

<!-- Required datatable js -->
<script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<!-- init js -->
<script src="{{ URL::asset('build/js/pages/datatable-pages.init.js') }}"></script>
@endsection
