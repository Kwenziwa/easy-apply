@extends('layouts.master')

@section('title')
Users
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1')
Users
@endslot
@slot('title')
Users
@endslot
@endcomponent
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Users </h4>
                <p class="card-title-desc">
                    All Users in the system
                </p>
                <!-- Create Button -->
                <a href="{{ route('users.create') }}" class="btn btn-primary" style="float: right;">Add User</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Verified</th>
                                <th>Mobile Number</th>
                                <th>Type</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->fullname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(isset($user->email_verified_at))
                                    <img src="{{ URL::asset('build/images/icons/check.png') }}" alt="">
                                    @else
                                    <img src="{{ URL::asset('build/images/icons/remove.png') }}" alt="">
                                    @endif
                                </td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ customBadge($user->type) }}</td>
                                <td class="text-right">
                                    <form id="delete-form-{{ $user->id }}"
                                        action="{{ route('users.destroy', $user->id) }}" method="POST">


                                        <a href="{{ route('users.edit',$user->id) }}"
                                            class="btn btn-warning btn-sm d-inline" title="Edit Action"><i
                                                class="bx bx-pencil"></i></a>
                                        <a href="{{ route('users.show',$user->id) }}"
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
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>

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
@endsection
