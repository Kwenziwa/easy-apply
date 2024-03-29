@extends('layouts.master')

@section('title')
Subjects
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1')
Subjects
@endslot
@slot('title')
Subjects
@endslot
@endcomponent

<div class="row">

    <div class="table-responsive mb-3">

        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row">
                <div class="card-header">
                    <h4 class="card-title">All Users </h4>
                    <p class="card-title-desc">
                        All Users in the system
                    </p>
                    <a href="{{ route('users.create') }}" class="btn btn-primary" style="float: right;">Add
                        User</a>
                </div>
                <div class="col-sm-12">

                    <br />
                    <table class="table align-middle datatable dt-responsive table-check nowrap dataTable no-footer"
                        style="border-collapse: collapse; border-spacing: 0px 8px; width: 100%;" id="DataTables_Table_0"
                        aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr>
                                <th scope="col" class="sorting sorting_desc" tabindex="0"
                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                    aria-label="ID: activate to sort column ascending" style="width: 10px;"
                                    aria-sort="descending">#</th>
                                <th scope="col" class="sorting sorting_desc" tabindex="0"
                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                    aria-label="Name: activate to sort column ascending" style="width: 122px;"
                                    aria-sort="descending">Name</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" aria-label="University: activate to sort column
                                    ascending" style="width: 125px;">Code </th>
                                <th style="width: 80px; min-width: 80px;" class="sorting" tabindex="0"
                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                    aria-label="Action: activate to sort column ascending">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($subjects as $subject)
                            <tr>
                                <th scope="row">{{ $subject->id }}</th>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->code }}</td>
                                <td class="text-right">
                                    <form id="delete-form-{{ $subject->id }}"
                                        action="{{ route('school-subjects.destroy', $subject->id) }}" method="POST">


                                        <a href="{{ route('school-subjects.edit',[$subject->id]) }}"
                                            class="btn btn-warning btn-sm d-inline" title="Edit Action"><i
                                                class="bx bx-pencil"></i></a>
                                        <a href="{{ route('school-subjects.show',$subject->id) }}"
                                            class="btn btn-warning btn-sm d-inline" title="Edit View"><i
                                                class="mdi mdi-eye"></i></a>


                                        @csrf {{-- CSRF token for security --}}
                                        @method('DELETE') {{-- Method spoofing to send a DELETE request --}}
                                        <button type="button" class="btn btn-danger btn-block btn-sm d-inline"
                                            onclick="confirmDelete({{ $subject->id }})" title="Delete Action"><i
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
