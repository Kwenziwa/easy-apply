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
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Students</span>
                        <h4 class="mb-3">
                            <span class="counter-value"
                                data-target="{{ $count_data['students_counter'] ?? '0'}}">{{ $count_data['students_counter'] ?? '0'}}</span>
                        </h4>
                    </div>

                    <div class="col-6">
                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">All Students</span>
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
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Universities</span>
                        <h4 class="mb-3">
                            <span class="counter-value"
                                data-target="{{ $count_data['university_counter']?? '0'}}">{{ $count_data['university_counter']?? '0'}}</span>
                        </h4>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">All universities.</span>
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
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Programmes</span>
                        <h4 class="mb-3">
                            <span class="counter-value"
                                data-target="{{ $count_data['program_count']?? '0'}}">{{ $count_data['program_count']?? '0'}}</span>
                        </h4>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">All programmes </span>
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
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Subjects</span>
                        <h4 class="mb-3">
                            <span class="counter-value"
                                data-target="{{ $count_data['subject_count']?? '0'}}">{{ $count_data['subject_count']?? '0'}}</span>
                        </h4>
                    </div>

                    <div class="col-6">
                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">All subjects </span>
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
                <canvas id="userChart" width="400" height="400"></canvas>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-sm-6">
            <div class="card text-center">
                <canvas id="userTypeChart" width="400" height="400"></canvas>

            </div>
            <!-- end card -->
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card text-center">
                <canvas id="closingDateChart" width="400" height="400"></canvas>


            </div>
            <!-- end card -->
        </div>
    </div>
    <!-- end row -->

</div>


@endsection

@section('script')

<script>
    var ctx = document.getElementById('userChart').getContext('2d');
    var userChart = new Chart(ctx, {
        type: 'line', // or 'bar', 'pie', etc.
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Users per Month',
                data: @json($counts),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>

<script>
    var ctx = document.getElementById('userTypeChart').getContext('2d');
    var userTypeChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: @json($types),
            datasets: [{
                label: 'User Types',
                data: @json($type_counts),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'User Types Distribution'
                }
            }
        },
    });

</script>

<script>
    var ctx = document.getElementById('closingDateChart').getContext('2d');
    var closingDateChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Closed Application', 'Open Application'],
            datasets: [{
                label: 'Closing Dates',
                data: [@json($beforeNow), @json($afterNow)],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Distribution of Closing Dates'
                }
            }
        },
    });

</script>


@endsection
