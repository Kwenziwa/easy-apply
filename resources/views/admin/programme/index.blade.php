@extends('layouts.master')

@section('title')
Programmes
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1')
Programmes
@endslot
@slot('title')
Programmes
@endslot
@endcomponent


<div class="row">

    <div class="table-responsive mb-3">

        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row">
                <div class="card-header">
                    <h4 class="card-title">All Programmes </h4>
                    <p class="card-title-desc">
                        All Programmes in the system
                    </p>
                    <!-- Create Button -->
                    <a href="{{ route('programmes.create') }}" class="btn btn-primary" style="float: right;">Add
                        Programmes</a>
                </div>
                <div class="col-sm-12">

                    <table class="table align-middle datatable dt-responsive table-check nowrap dataTable no-footer"
                        style="border-collapse: collapse; border-spacing: 0px 8px; width: 100%;" id="DataTables_Table_0"
                        aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr>
                                <th scope="col" class="sorting sorting_desc" tabindex="0"
                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                    aria-label="ID: activate to sort column ascending" style="width: 22px;"
                                    aria-sort="descending">#</th>
                                <th scope="col" class="sorting sorting_desc" tabindex="0"
                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                    aria-label="Prigramme Name: activate to sort column ascending" style="width: 122px;"
                                    aria-sort="descending">Prigramme Name</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" aria-label="Institution : activate to sort column
                                    ascending" style="width: 125px;">Institution </th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" aria-label="Code: activate to sort column ascending"
                                    style="width: 153px;">Code</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" aria-label="closing_date: activate to sort column ascending"
                                    style="width: 153px;">Closing Date</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" aria-label="Mobile: activate to sort column ascending"
                                    style="width: 157px;">Minimum Points</th>
                                <th style="width: 80px; min-width: 80px;" class="sorting" tabindex="0"
                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                    aria-label="Action: activate to sort column ascending">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($programmes as $programme)
                            <tr class="odd">
                                <th scope="row">{{ $programme->id }}</th>
                                <td>{{ $programme->name }}</td>
                                <td>
                                    <img src="{{ url('storage/'.$programme->portfolio->logo) }} " alt=""
                                        class="avatar-sm rounded-circle me-2">
                                    {{ $programme->portfolio->university_name }}</td>
                                <td>{{ $programme->code }}</td>
                                <td>{{ $programme->closing_date }}</td>
                                <td>{{ $programme->min_points }}</td>
                                <td class="text-right">
                                    <form id="delete-form-{{ $programme->id }}"
                                        action="{{ route('programmes.destroy', $programme->id) }}" method="POST">


                                        <a href="{{ route('programmes.edit',[$programme->id]) }}"
                                            class="btn btn-warning btn-sm d-inline" title="Edit Action"><i
                                                class="bx bx-pencil"></i></a>
                                        <a href="{{ route('programmes.show',$programme->id) }}"
                                            class="btn btn-warning btn-sm d-inline" title="Edit View"><i
                                                class="mdi mdi-eye"></i></a>


                                        @csrf {{-- CSRF token for security --}}
                                        @method('DELETE') {{-- Method spoofing to send a DELETE request --}}
                                        <button type="button" class="btn btn-danger btn-block btn-sm d-inline"
                                            onclick="confirmDelete({{ $programme->id }})" title="Delete Action"><i
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
