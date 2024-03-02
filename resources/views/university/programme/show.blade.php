@extends('layouts.master')
@section('title') {{ $programme->name }} Detials @endsection
@section('content')



<!-- <body data-layout="horizontal"> -->

<!-- start page title -->
@component('components.breadcrumb')
@slot('li_1') Programmes @endslot
@slot('title') Programme Details @endslot
@endcomponent
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="invoice-title">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <div class="mb-4">
                                <span class="logo-txt">{{ $programme->name }}</span>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="mb-4">
                                <h4 class="float-end font-size-16">Programme Code: #{{ $programme->code }}</h4>
                            </div>
                        </div>
                    </div>


                    <p class="mb-1">
                        <img src="{{ url('storage/'.$programme->portfolio->logo) }} " alt=""
                            class="avatar-sm rounded-circle me-2">
                        <h4>{{ $programme->portfolio->university_name }}</h4>
                    </p>
                    <p class="mb-1"><i class="mdi mdi-email align-middle me-1"></i>
                        {{ $programme->portfolio->uni_email }}</p>
                    <p><i class="mdi mdi-phone align-middle me-1"></i> {{ $programme->portfolio->uni_phone_number }}</p>
                </div>
                <hr class="my-4">
                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <h5 class="font-size-15 mb-1">Minimum Entry Requirements:</h5>
                            <p class="mb-2">{{$programme->min_entry_requirements}}</p>
                            <h5 class="font-size-15 mb-1">Minimum Points:</h5>
                            <p class="mb-2">{{$programme->min_points}}</p>
                            <h5 class="font-size-15 mb-1">Course Duration:</h5>
                            <p class="mb-2">{{$programme->course_duration}}</p>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <div>
                                <h5 class="font-size-15 mb-1">Closing Date:</h5>
                                <p class="mb-2">{{ $programme->closing_date}}</p>
                                <h5 class="font-size-15 mb-1">Entry Term:</h5>
                                <p class="mb-2">{{ $programme->entry_term}}</p>
                                <h5 class="font-size-15 mb-1">Access Route:</h5>
                                <p class="mb-2"> {{ $programme->access_route }}</p>
                                <h5 class="font-size-15 mb-1">Application Website:</h5>
                                <p class="mb-2"><a  href="{{$programme->application_url}}">Link</a></p>
                            </div>
                        </div>
                    </div>

                    <h5 class="font-size-15 mb-1">Notes:</h5>
                    <p class="mb-2">{{$programme->notes}}</p>
                </div>

                <div class="py-2 mt-3">
                    <h5 class="font-size-15">Required Subjects</h5>
                </div>
                <div class="p-4 border rounded">
                    <div class="table-responsive">
                        <table class="table table-nowrap align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>ID.</th>
                                    <th>Subject</th>
                                    <th>Level</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($programme_subjects as $key =>$programme_subject)
                                <tr>
                                    <th scope="row">{{ $key }}</th>
                                    <td>

                                        {{ $programme_subject->subject->name }}

                                    </td>
                                    <td>{{$programme_subject->level}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-print-none mt-3">
                    <div class="float-end">
                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i
                                class="fa fa-print"></i></a>
                        <a href="#" class="btn btn-primary w-md waves-effect waves-light">Send</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
