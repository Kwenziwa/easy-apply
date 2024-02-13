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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">National Senior Certificate</h4>
                <p class="card-title-desc">
                    Please note that all the resuls must match your certificate.
                </p>
                <!-- Create Button -->
                <a href="{{ route('subject.create') }}" class="btn btn-primary" style="float: right;">Add Subject</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Percentage</th>
                                <th>Achiement Level</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $subject)
                            <tr>
                                <th scope="row">{{ $subject->id }}</th>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->code }}</td>
                                <td>{{ $subject->pivot->result }}</td>
                                <td>{{ $subject->pivot->level }}</td>
                                <td class="text-right">
                                    <form id="delete-form-{{ $subject->id }}"
                                        action="{{ route('user.subject.delete', $subject->id) }}" method="POST">

                                        
                                        <a href="{{ route('user.editsubject',$subject->id) }}"
                                            class="btn btn-warning btn-sm d-inline"><i
                                                class=" bx bx-pencil"></i></a>

                                        @csrf {{-- CSRF token for security --}}
                                        @method('DELETE') {{-- Method spoofing to send a DELETE request --}}
                                        <button type="button" class="btn btn-danger btn-block btn-sm d-inline"
                                            onclick="confirmDelete({{ $subject->id }})"><i
                                                class="bx bx-trash-alt"></i></button>
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
