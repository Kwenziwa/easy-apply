@extends('layouts.master')

@section('title')
Users
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') User @endslot
@slot('title') Add @endslot
@endcomponent
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Adding New Record</h4>
                <p class="card-title-desc">Fill in the information below to add a new record.</p>
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
                {{-- Form Start --}}
                <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" class="row">
                    @csrf
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="{{ old('first_name') }}" required>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name"
                                value="{{ old('middle_name') }}">
                            @error('middle_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="{{ old('last_name') }}" required>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="national_id" class="form-label">National ID</label>
                            <input type="text" class="form-control" id="national_id" name="national_id"
                                value="{{ old('national_id') }}" required>
                            @error('national_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="is_email_verified" class="form-label">Is Email Verified?</label>
                            <select class="form-select" id="is_email_verified" name="is_email_verified" required>
                                <option value="0" @selected(old('is_email_verified')=='0' )>No</option>
                                <option value="1" @selected(old('is_email_verified')=='1' )>Yes</option>
                            </select>
                            @error('is_email_verified')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div id="hidden_div" style="display:none;">
                            <div class="mb-3">
                                <label for="uni_email" class="form-label">University Email</label>
                                <input type="email" class="form-control" id="uni_email" name="uni_email"
                                    value="{{ old('uni_email') }}" required>
                                @error('uni_email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="uni_phone_number" class="form-label">University Phone Number</label>
                                <input type="text" class="form-control" id="uni_phone_number" name="uni_phone_number"
                                    value="{{ old('uni_phone_number') }}" required>
                                @error('uni_phone_number')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="website_url" class="form-label">Website URL</label>
                                <input type="url" class="form-control" id="website_url" name="website_url"
                                    value="{{ old('website_url') }}" required>
                                @error('website_url')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                value="{{ old('date_of_birth') }}" required>
                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                required>
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                value="{{ old('phone_number') }}" required>
                            @error('phone_number')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type" onchange="showDiv(this)" required>
                                <option value="">Select Type</option>
                                <option value="0" @selected(old('type')=='user' )>User</option>
                                <option value="1" @selected(old('type')=='admin' )>Admin</option>
                                <option value="2" @selected(old('type')=='university' )>University</option>
                            </select>
                            @error('type')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div id="hidden_div2" style="display:none;">

                            <!-- New Fields for University Information -->
                            <div class="mb-3">
                                <label for="university_name" class="form-label">University Name</label>
                                <input type="text" class="form-control" id="university_name" name="university_name"
                                    value="{{ old('university_name') }}" required>
                                @error('university_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="logo" class="form-label">University Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo" required>
                                @error('logo')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Full Width Row -->
                    <div class="col-8">
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary w-100 waves-effect waves-light">Submit</button>
                        </div>

                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function showDiv(select) {
        if (select.value == 2) {
            document.getElementById('hidden_div').style.display = "block";
            document.getElementById('hidden_div2').style.display = "block";
        } else {
            document.getElementById('hidden_div').style.display = "none";
            document.getElementById('hidden_div2').style.display = "none";
        }
    }
</script>
@endsection
