@extends('layouts.master')

@section('title')
Edit Subject
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Subjects @endslot
@slot('title') Edit @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Subject</h4>
                <p class="card-title-desc">Modify the information and submit to update.</p>
            </div>
            <div class="card-body">
                {{-- Display All Validation Errors --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('school-subjects.update',$subject) }}" method="POST">
                     @csrf
                     @method('PUT')

                      <div class="col-md-6">

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Subject Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $subject->name }}" required>
                    </div>

                    <!-- Code -->
                    <div class="mb-3">
                        <label class="form-label">Code</label>
                        <input type="number" class="form-control" name="code" value="{{ $subject->code }}">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
