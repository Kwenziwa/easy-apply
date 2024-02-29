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
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Subjects</span>
                        <h4 class="mb-3">
                            <span class="counter-value"
                                data-target="{{ $userWithSubjectsCount->subjects_count ?? '0'}}">{{ $userWithSubjectsCount->subjects_count ?? '0'}}</span>
                        </h4>
                    </div>

                    <div class="col-6">
                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">All subjects</span>
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
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Points</span>
                        <h4 class="mb-3">
                            <span class="counter-value"
                                data-target="{{ $userWithLevelSum->level_sum ?? '0'}}">{{ $userWithLevelSum->level_sum ?? '0'}}</span>
                        </h4>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">All your points excluding LO.</span>
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
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Available Courses</span>
                        <h4 class="mb-3">
                            <span class="counter-value"
                                data-target="{{$qualify_programmes->count()}}">({{$qualify_programmes->count() }})</span>
                        </h4>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">Courses Available for application </span>
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
    <!-- end page title -->

    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="mb-3">
                <h5 class="card-title">Course Available: <span
                        class="text-muted fw-normal ms-2">({{$qualify_programmes->count()}})</span></h5>
            </div>
        </div>


    </div>
    <!-- end row -->
</div>


@endsection
