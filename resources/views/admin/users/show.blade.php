@extends('layouts.master')

@section('title')
User Details
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Users @endslot
@slot('title') View @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <!-- Adjusted for full width -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">User Details</h4>
                <p class="card-title-desc">Here you can view the user details.</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- First Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" value="{{ $user->first_name }}" readonly>
                    </div>
                    <!-- Middle Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Middle Name</label>
                        <input type="text" class="form-control" value="{{ $user->middle_name }}" readonly>
                    </div>
                    <!-- Last Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" value="{{ $user->last_name }}" readonly>
                    </div>
                    <!-- National ID -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">National ID</label>
                        <input type="text" class="form-control" value="{{ $user->national_id }}" readonly>
                    </div>
                    <!-- Date of Birth -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="text" class="form-control" value="{{ $user->date_of_birth}}"
                            readonly>
                    </div>
                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                    </div>
                    <!-- Phone Number -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" value="{{ $user->phone_number }}" readonly>
                    </div>
                    <!-- User Type -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Type</label>
                        <input type="text" class="form-control"
                            value="{{$user->type}}" readonly>
                    </div>
                    <!-- Email Verified -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email Verified</label>
                        <input type="text" class="form-control" value="{{ $user->is_email_verified ? 'Yes' : 'No' }}"
                            readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
