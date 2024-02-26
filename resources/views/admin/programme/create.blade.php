@extends('layouts.master')

@section('title')
Create Programme
@endsection
@section('css')

<!-- twitter-bootstrap-wizard css -->
<link rel="stylesheet" href="{{ URL::asset('build/libs/twitter-bootstrap-wizard/prettify.css') }}">

@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Subjects @endslot
@slot('title') Create @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Programme</h4>
                <p class="card-title-desc">Fill in all the information below and click Submit to create a new subject.
                </p>
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
                <form action="{{ route('programmes.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">University</label>
                                <select class="form-select" name="portfolio_id" id="portfolio_id" required>
                                    <option value="">Select</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->portfolio['id'] }}" @selected(old('portfolio_id')==$user->
                                        portfolio['id'])>
                                        {{ $user->portfolio['university_name'] }}</option>
                                    @endforeach
                                </select>
                                @error('portfolio_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label">Programme Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            </div>

                            <!-- Code -->
                            <div class="mb-3">
                                <label class="form-label">Code</label>
                                <input type="text" class="form-control" name="code" value="{{ old('code') }}" required>
                            </div>

                            <!-- Closing Date -->
                            <div class="mb-3">
                                <label class="form-label">Closing Date</label>
                                <input type="date" class="form-control" name="closing_date"
                                    value="{{ old('closing_date') }}" required>
                            </div>

                            <!-- Minimum Points -->
                            <div class="mb-3">
                                <label class="form-label">Minimum Points</label>
                                <input type="number" class="form-control" name="min_points"
                                    value="{{ old('min_points') }}" required>
                            </div>

                            <!-- Minimum Entry Requirements -->
                            <div class="mb-3">
                                <label class="form-label">Minimum Entry Requirements</label>
                                <textarea class="form-control"
                                    name="min_entry_requirements">{{ old('min_entry_requirements') }}</textarea>
                            </div>

                            <!-- Entry Term -->
                            <div class="mb-3">
                                <label class="form-label">Entry Term</label>
                                <input type="text" class="form-control" name="entry_term"
                                    value="{{ old('entry_term') }}" required>
                            </div>

                            <!-- Entry Term -->
                            <div class="mb-3">
                                <label class="form-label">Application Website</label>
                                <input type="text" class="form-control" name="application_url"
                                    value="{{ old('application_url') }}" required>
                            </div>

                            <!-- Course Duration -->
                            <div class="mb-3">
                                <label class="form-label">Course Duration</label>
                                <input type="number" class="form-control" name="course_duration"
                                    value="{{ old('course_duration') }}" required>
                            </div>

                            <!-- Access Route -->
                            <div class="mb-3">
                                <label class="form-label">Access Route</label>
                                <input type="text" class="form-control" name="access_route"
                                    value="{{ old('access_route') }}">
                            </div>

                            <!-- Notes -->
                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" name="notes">{{ old('notes') }}</textarea>
                            </div>

                            <div class="mb-8">

                                <label class="form-label">Subject Required for this programme: </label>
                                <table class="table table-bordered" id="dynamicTable">
                                    <tr>
                                        <th>Subject Required</th>
                                        <th>Level Required</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-select" name="addMore[0][subject_id]">
                                                <option value="">Select</option>
                                                @foreach ($subjects as $subject)
                                                <option value="{{ $subject['id'] }}"
                                                    @selected(old('subject_id')==$subject['id'])>
                                                    {{ $subject['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td>
                                            <select class="form-select" name="addMore[0][level]">
                                                <option value="">Select Level</option>
                                                <?php for ($i = 1; $i <= 7; $i++): ?>
                                                <option value="<?php echo $i; ?>" @selected(old('level')==$i)>
                                                    <?php echo $i; ?>
                                                </option>
                                                <?php endfor; ?>
                                            </select>
                                        </td>


                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add
                                                More Subject</button></td>
                                    </tr>
                                </table>

                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<!-- twitter-bootstrap-wizard js -->
<script src="{{ URL::asset('build/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/twitter-bootstrap-wizard/prettify.js') }}"></script>

<!-- form wizard init -->
<script src="{{ URL::asset('build/js/pages/form-wizard.init.js') }}"></script>

<script type="text/javascript">
    let subjectsOptions = '';


    // Fetch subjects when document is ready
    fetchSubjects();

    let i = 0; // Initial row number
    let levelsOptions = '<option value="">Select Level</option>';
    for (let level = 1; level <= 7; level++) {
        levelsOptions += '<option value="' + level + '">' + level + '</option>';
    }
    $("#add").click(function () {
        ++i;
        $("#dynamicTable").append('<tr><td><select name="addMore[' + i +
            '][subject_id]" class="form-control">' + subjectsOptions +
            '</select></td> <td><select name="addMore[' + i + '][level]" class="form-control">' +
            levelsOptions +
            '</select></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>'
        );
    });

    // Remove row
    $(document).on('click', '.remove-tr', function () {
        $(this).parents('tr').remove();
    });


    function fetchSubjects() {
        $.ajax({
            url: '/subjects', // Adjust the URL to your endpoint
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                subjectsOptions = '<option value="">Select Subject</option>';
                $.each(response, function (key, subject) {
                    subjectsOptions += '<option value="' + subject.id + '">' + subject.name +
                        '</option>';
                });
            }
        });
    }

</script>
@endsection
