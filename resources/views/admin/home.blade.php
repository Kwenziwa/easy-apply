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
                            <span class="counter-value" data-target="0">0</span>
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
                <h5 class="card-title">Course List <span class="text-muted fw-normal ms-2">(834)</span></h5>
            </div>
        </div>


    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="dropdown text-end">
                        <a class="text-muted dropdown-toggle font-size-16" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </a>
                    </div>

                    <div class="mx-auto mb-4">
                        <img src="assets/images/users/avatar-2.jpg" alt=""
                            class="avatar-xl rounded-circle img-thumbnail">
                    </div>
                    <h5 class="font-size-16 mb-1"><a href="#" class="text-body">Phyllis Gatlin</a></h5>
                    <p class="text-muted mb-2">Full Stack Developer</p>

                </div>

                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-light text-truncate"><i class="uil uil-user me-1"></i>
                        Profile</button>
                    <button type="button" class="btn btn-outline-light text-truncate"><i
                            class="uil uil-envelope-alt me-1"></i> Message</button>

                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row g-0 align-items-center mb-4">
        <div class="col-sm-6">
            <div>
                <p class="mb-sm-0">Showing 1 to 10 of 57 entries</p>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="float-sm-end">
                <ul class="pagination mb-sm-0">
                    <li class="page-item disabled">
                        <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">1</a>
                    </li>
                    <li class="page-item active">
                        <a href="#" class="page-link">2</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">3</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">4</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">5</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end row -->

</div>


@endsection
