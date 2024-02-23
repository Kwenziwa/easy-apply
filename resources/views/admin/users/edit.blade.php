@extends('layouts.master')

@section('title')
Edit User
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Users @endslot
@slot('title') Edit @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit User</h4>
                <p class="card-title-desc">Modify the information and submit to update.</p>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- First Name -->
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}"
                            required>
                    </div>

                    <!-- Middle Name -->
                    <div class="mb-3">
                        <label class="form-label">Middle Name (optional)</label>
                        <input type="text" class="form-control" name="middle_name" value="{{ $user->middle_name }}">
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}"
                            required>
                    </div>

                    <!-- National ID -->
                    <div class="mb-3">
                        <label class="form-label">National ID</label>
                        <input type="text" class="form-control" name="national_id" value="{{ $user->national_id }}"
                            required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="date_of_birth"
                            value="{{ $user->date_of_birth}}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" value="{{ $user->phone_number }}"
                            required>
                    </div>

                    <!-- Type -->
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select class="form-select" name="type" required>
                            <option value="0" @selected($user->type == 0)>User</option>
                            <option value="1" @selected($user->type == 1)>Admin</option>
                            <option value="2" @selected($user->type == 2)>University</option>
                        </select>
                    </div>

                    <!-- Email Verified -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="is_email_verified" id="is_email_verified"
                            {{ $user->is_email_verified ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_email_verified">Email Verified</label>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
