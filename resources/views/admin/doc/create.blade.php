@extends('layouts.master')

@section('title')
Documents
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1')
Documents
@endslot
@slot('title')
Add
@endslot
@endcomponent
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Adding Subject</h4>
                <p class="card-title-desc">Fill in the information below to add a new Subject.
                    <code>.Please enter all information according to your certifcate</code>.</p>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('my-documents.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select</label>
                        <select class="form-select" name="doc_type" id="doc_type" required>
                            <option value="">Select</option>
                            <option value="Identity">Identity</option>
                            <option value="Certificate">Certificate</option>
                        </select>
                        @error('doc_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="form-sm-input">Document</label>

                        <input type="file" class="form-control" value="{{ old('path') }}" name="path" id="path"
                            placeholder="" required>
                        @error('path')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Add
                            Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>

@endsection
