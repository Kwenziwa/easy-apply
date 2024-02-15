@extends('layouts.master')

@section('title')
Next of Kin
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Next of Kin @endslot
@slot('title') Add @endslot
@endcomponent

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Next of Kin Form</h4>
                <p class="card-title-desc">Fill in the information below to add a new Next of Kin.</p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('next-of-kin.store') }}">
                    <!-- Update the action route as needed -->
                    @csrf
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                            id="first_name" name="first_name" value="{{ $nextOfkin->first_name ?? old('first_name') }}"
                            required>
                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                            name="last_name" value="{{ $nextOfkin->last_name ?? old('last_name') }}" required>
                        @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ $nextOfkin->email ?? old('email') }}"" required>
                        @error('email')
                        <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>
            <div class="mb-3">
                <label for="relationship" class="form-label">Relationship</label>
                <select class="form-select @error('relationship') is-invalid @enderror" id="relationship"
                    name="relationship" required>
                    <option value="">Select Relationship</option>
                    <option value="Parent" @selected( $nextOfkin->relationship?? old('relationship')=='Parent'
                        )>Parent</option>
                    <option value="Sibling" @selected( $nextOfkin->relationship?? old('relationship')=='Sibling'
                        )>Sibling</option>
                    <option value="Spouse" @selected( $nextOfkin->relationship?? old('relationship')=='Spouse'
                        )>Spouse</option>
                    <option value="Child" @selected( $nextOfkin->relationship?? old('relationship')=='Child'
                        )>Child</option>
                    <option value="Friend" @selected( $nextOfkin->relationship?? old('relationship')=='Friend'
                        )>Friend</option>
                    <option value="Other" @selected( $nextOfkin->relationship?? old('relationship')=='Other'
                        )>Other</option>
                </select>
                @error('relationship')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                    >{{ $nextOfkin->address ?? old('address') }}</textarea>
                @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                    name="phone_number" value="{{ $nextOfkin->phone_number ?? old('phone_number') }}" required>
                @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Add Next of
                    Kin</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end col -->
</div>

@endsection
