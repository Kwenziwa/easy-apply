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
Add
@endslot
@endcomponent
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sizing</h4>
                <p class="card-title-desc">Set heights using classes like <code>.form-control-lg</code> and
                    <code>.form-control-sm</code>.</p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('subject.attachsubject') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select</label>
                        <select class="form-select" name="subject_id" id="subject_id" required>
                            <option value="">Select</option>
                            @foreach ($subjects as $subject)
                            <option value="{{ $subject['id'] }}" @selected(old('subject_id')==$subject['id'])>
                                {{ $subject['name'] }}</option>
                            @endforeach
                        </select>
                         @error('subject_id')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="form-sm-input">Results %</label>

                            <input type="number" class="form-control" value="{{ old('result') }}" name="result"
                                placeholder="" required>
                             @error('result')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                             @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Level</label>
                        <select class="form-select" name="level" id="level">
                            <option value="">Select Level</option>
                            <?php for ($i = 1; $i <= 7; $i++): ?>
                            <option value="<?php echo $i; ?>" @selected(old('level')==$i)><?php echo $i; ?>
                            </option>
                            <?php endfor; ?>
                        </select>
                         @error('level')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Add Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>

@endsection
