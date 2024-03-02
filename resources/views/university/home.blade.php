@extends('layouts.master')

@section('title')
@lang('translation.Dashboard')
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1')
Dashboard
@endslot
@slot('title')
Dashboard
@endslot
@endcomponent

<div class="row">
    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Programms</span>
                        <h4 class="mb-3">
                            <span class="counter-value"
                                data-target="{{ $total_programme ?? '0'}}">{{ $total_programme ?? '0'}}</span>
                        </h4>
                    </div>

                    <div class="col-6">
                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">All Programms</span>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Open Applications </span>
                        <h4 class="mb-3">
                            <span class="counter-value"
                                data-target="{{ $open_programmes ?? '0'}}">{{ $open_programmes ?? '0'}}</span>
                        </h4>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">All Open for application.</span>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Closed Application</span>
                        <h4 class="mb-3">
                            <span class="counter-value"
                                data-target="{{$closed_programmes}}">({{$closed_programmes }})</span>

                        </h4>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">All Closed for application. </span>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Notifications</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target="0">0</span>
                        </h4>
                    </div>

                    <div class="col-6">
                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">System Notifications</span>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Course Grid</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Course</a></li>
                        <li class="breadcrumb-item active">Course List</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="mb-3">
                <h5 class="card-title">Recent Added Programmes Available: <span
                        class="text-muted fw-normal ms-2">({{$total_programme}})</span></h5>
            </div>
        </div>


    </div>
    <!-- end row -->
    <div class="row">
        @foreach ($recent_programmes as $recent_programme)
        <div class="col-xl-3 col-sm-6">

            <div class="card text-center">
                <div class="card-body">
                    <div class="dropdown text-end">
                        <span class="bg-danger badge me-2">#{{ $recent_programme->code }}</span>
                    </div>

                    <div class="mx-auto mb-4">
                        <img src="{{ url('storage/'.$recent_programme->portfolio->logo) }}" alt=""
                            class="avatar-xl rounded-circle img-thumbnail">
                    </div>
                    <h5 class="font-size-16 mb-1"><a href="#" class="text-body">{{ $recent_programme->name }}</a></h5>
                    <p class="text-muted mb-2">{{ $recent_programme->portfolio->university_name }}</p>
                    <p class="text-muted mb-2">{{ $recent_programme->min_entry_requirements }}</p>
                    <p class="text-muted mb-2">Closing Date: <span
                            class="bg-warning badge me-2">{{ $recent_programme->closing_date}}</span> </p>
                    <p class="text-muted mb-2">Points:<span
                            class="bg-success badge me-2">{{$recent_programme->min_points}}</span>|| Entry Term:
                        <span class="bg-success badge me-2">{{$recent_programme->entry_term}}</span> || Duration:
                        <span class="bg-success badge me-2">{{$recent_programme->course_duration}}</span></p>


                </div>

                <div class="btn-group" role="group">
                    <a href="{{ route('my-programmes.show',$recent_programme->id) }}"
                        class="btn btn-outline-light btn-success text-white"><i class="uil uil-user me-1"></i>
                        View</a>


                </div>
            </div>
            <!-- end card -->
        </div>
        @endforeach
        <!-- end col -->
    </div>


</div>




@endsection
