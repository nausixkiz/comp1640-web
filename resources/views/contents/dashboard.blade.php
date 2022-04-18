@extends('layouts.main-layout')
@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex text-muted">
                        <div class="flex-shrink-0 me-3 align-self-center">
                            <div id="user-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1">Users</p>
                            <h5 class="mb-3">{{ $user_data['total_users_in_month'] }}</h5>

                            <p class="text-truncate mb-0">
                                <span class="text-success me-2"> {{ ceil($user_data['total_users_in_month'] / $user_data['total_users_in_previous_month'] * 100) }}%
                                    <i class="ri-arrow-right-up-line align-bottom ms-1"></i>
                                </span> From previous month
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3 align-self-center">
                            <div id="view-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1">Views per months</p>
                            <h5 class="mb-3">{{ $view_idea_data['total_views_in_month'] }}</h5>
                            <p class="text-truncate mb-0"><span class="text-success me-2"> 1.7%
                                    <i class="ri-arrow-right-up-line align-bottom ms-1"></i></span> From previous</p>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex text-muted">
                        <div class="flex-shrink-0 me-3 align-self-center">
                            <div id="radialchart-3" class="apex-charts" dir="ltr"></div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1">Returning Visitor</p>
                            <h5 class="mb-3">24.03 %</h5>
                            <p class="text-truncate mb-0"><span class="text-danger me-2"> 0.01% <i
                                        class="ri-arrow-right-down-line align-bottom ms-1"></i></span> From
                                previous</p>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex text-muted">
                        <div class="flex-shrink-0  me-3 align-self-center">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                    <i class="ri-group-line"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1">New Visitors</p>
                            <h5 class="mb-3">435</h5>
                            <p class="text-truncate mb-0"><span class="text-success me-2"> 0.01% <i
                                        class="ri-arrow-right-up-line align-bottom ms-1"></i></span> From
                                previous</p>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title">Overview</h5>
                        </div>
                        <div class="flex-shrink-0">
                            <div>
                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                    ALL
                                </button>
                                <button type="button" class="btn btn-soft-primary btn-sm">
                                    1M
                                </button>
                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                    6M
                                </button>
                                <button type="button" class="btn btn-soft-secondary btn-sm active">
                                    1Y
                                </button>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div id="mixed-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!-- end card-body -->

                <div class="card-body border-top">
                    <div class="text-muted text-center">
                        <div class="row">
                            <div class="col-4 border-end">
                                <div>
                                    <p class="mb-2">
                                        <i class="mdi mdi-circle font-size-12 text-primary me-1"></i> Expenses
                                    </p>
                                    <h5 class="font-size-16 mb-0">$ 8,524 <span
                                            class="text-success font-size-12">
                                                    <i class="mdi mdi-menu-up font-size-14 me-1"></i>1.2 %</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 border-end">
                                <div>
                                    <p class="mb-2"><i class="mdi mdi-circle font-size-12 text-light me-1"></i>
                                        Maintenance</p>
                                    <h5 class="font-size-16 mb-0">$ 8,524 <span
                                            class="text-success font-size-12"><i
                                                class="mdi mdi-menu-up font-size-14 me-1"></i>2.0 %</span></h5>
                                </div>
                            </div>
                            <div class="col-4">
                                <div>
                                    <p class="mb-2"><i class="mdi mdi-circle font-size-12 text-danger me-1"></i>
                                        Profit</p>
                                    <h5 class="font-size-16 mb-0">$ 8,524 <span
                                            class="text-success font-size-12"><i
                                                class="mdi mdi-menu-up font-size-14 me-1"></i>0.4 %</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex  align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title">Top Browsers</h5>
                        </div>
                    </div>

                    <div>
                        <div id="radialBar-chart" class="apex-charts" dir="ltr"></div>
                    </div>

                    <div class="row">
                        @foreach($top_browsers as $browser)
                            <div class="col-4">
                                <div class="social-source text-center mt-3">
                                    <div class="avatar-xs mx-auto mb-3">
                                     <span class="avatar-title rounded-circle bg-primary font-size-18">
                                         {!! $browser['browser_icon'] !!}
                                     </span>
                                    </div>
                                    <h5 class="font-size-15">{{ $browser['browser'] }}</h5>
                                    <p class="text-muted mb-0">{{ $browser['sessions'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Stats</h5>
                    <div>
                        <ul class="list-unstyled">
                            <li class="py-3">
                                <div class="d-flex">
                                    <div class="avatar-xs align-self-center me-3">
                                        <div
                                            class="avatar-title rounded-circle bg-light text-primary font-size-18">
                                            <i class="ri-checkbox-circle-line"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-2">Completed</p>
                                        <div class="progress progress-sm animated-progess">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                 style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="py-3">
                                <div class="d-flex">
                                    <div class="avatar-xs align-self-center me-3">
                                        <div
                                            class="avatar-title rounded-circle bg-light text-primary font-size-18">
                                            <i class="ri-calendar-2-line"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-2">Pending</p>
                                        <div class="progress progress-sm animated-progess">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                 style="width: 45%" aria-valuenow="45" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="py-3">
                                <div class="d-flex">
                                    <div class="avatar-xs align-self-center me-3">
                                        <div
                                            class="avatar-title rounded-circle bg-light text-primary font-size-18">
                                            <i class="ri-close-circle-line"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-2">Cancel</p>
                                        <div class="progress progress-sm animated-progess">
                                            <div class="progress-bar bg-danger" role="progressbar"
                                                 style="width: 19%" aria-valuenow="19" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <hr>

                    <div class="text-center">
                        <div class="row">
                            <div class="col-4">
                                <div class="mt-2">
                                    <p class="text-muted mb-2">Completed</p>
                                    <h5 class="font-size-16 mb-0">70</h5>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mt-2">
                                    <p class="text-muted mb-2">Pending</p>
                                    <h5 class="font-size-16 mb-0">45</h5>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mt-2">
                                    <p class="text-muted mb-2">Cancel</p>
                                    <h5 class="font-size-16 mb-0">19</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Notifications</h4>

                    <div class="pe-3" data-simplebar style="max-height: 287px;">
                        <a href="#" class="text-body d-block">
                            <div class="d-flex py-3">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <img class="rounded-circle avatar-xs" alt=""
                                         src="assets/images/users/avatar-2.jpg">
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-14 mb-1">Scott Elliott</h5>
                                    <p class="text-truncate mb-0">
                                        If several languages coalesce
                                    </p>
                                </div>
                                <div class="flex-shrink-0 font-size-13">
                                    20 min ago
                                </div>
                            </div>
                        </a>
                        <a href="#" class="text-body d-block">
                            <div class="d-flex py-3">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <div class="avatar-xs">
                                                            <span
                                                                class="avatar-title bg-soft-primary rounded-circle text-primary">
                                                                <i class="mdi mdi-account-supervisor"></i>
                                                            </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-14 mb-1">Team A</h5>
                                    <p class="text-truncate mb-0">
                                        Team A Meeting 9:15 AM
                                    </p>
                                </div>
                                <div class="flex-shrink-0 font-size-13">
                                    9:00 am
                                </div>
                            </div>
                        </a>
                        <a href="#" class="text-body d-block">
                            <div class="d-flex py-3">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <img class="rounded-circle avatar-xs" alt=""
                                         src="assets/images/users/avatar-3.jpg">
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-14 mb-1">Frank Martin</h5>
                                    <p class="text-truncate mb-0">
                                        Neque porro quisquam est
                                    </p>
                                </div>
                                <div class="flex-shrink-0 font-size-13">
                                    8:54 am
                                </div>
                            </div>
                        </a>
                        <a href="#" class="text-body d-block">
                            <div class="d-flex py-3">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <div class="avatar-xs">
                                                            <span
                                                                class="avatar-title bg-soft-primary rounded-circle text-primary">
                                                                <i class="mdi mdi-email-outline"></i>
                                                            </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-14 mb-1">Updates</h5>
                                    <p class="text-truncate mb-0">
                                        It will be as simple as fact
                                    </p>
                                </div>
                                <div class="flex-shrink-0 font-size-13">
                                    27-03-2020
                                </div>
                            </div>
                        </a>

                        <a href="#" class="text-body d-block">
                            <div class="d-flex py-3">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <img class="rounded-circle avatar-xs" alt=""
                                         src="assets/images/users/avatar-4.jpg">
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-14 mb-1">Terry Garrick</h5>
                                    <p class="text-truncate mb-0">
                                        At vero eos et accusamus et
                                    </p>
                                </div>
                                <div class="flex-shrink-0 font-size-13">
                                    27-03-2020
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Revenue by Location</h5>

                    <div>
                        <div id="usa" style="height: 226px"></div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="#" class="btn btn-primary btn-sm">View More</a>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Top 5 Idea Has Most View</h4>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 50px;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheckall">
                                        <label class="form-check-label" for="customCheckall"></label>
                                    </div>
                                </th>
                                <th scope="col">Name</th>
                                <th scope="col">View</th>
                                <th scope="col">Unique View</th>
                                <th scope="col">Created Date</th>
                                <th scope="col">Updated Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($top_ideas as $idea)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1"></label>
                                            </div>
                                        </td>
                                        <td>{{ $idea->name }}</td>
                                        <td>{{ views($idea)->count() }}</td>
                                        <td>{{ views($idea)->unique()->count() }}</td>
                                        <td>{{ $idea->created_at->diffforHumans() }}</td>
                                        <td>{{ $idea->created_at->diffforHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
@stop

@push('page-scripts')
    <script>
        new ApexCharts(document.querySelector("#user-chart"), {
            series: [{{ ceil($user_data['total_users_in_month'] / $user_data['total_users'] * 100) }}],
            chart: {
                type: 'radialBar',
                width: 72,
                height: 72,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ['#0ab39c'],
            stroke: {
                lineCap: 'round'
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 0,
                        size: '80%'
                    },
                    track: {
                        margin: 0,
                    },

                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            offsetY: 5,
                            show: true
                        }
                    }
                }
            }
        }).render();
        new ApexCharts(document.querySelector("#view-chart"), {
            series: [{{ round($view_idea_data['total_views_in_month'] / $view_idea_data['total_views'] * 100) }}],
            chart: {
                type: 'radialBar',
                width: 72,
                height: 72,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ['#0ab39c'],
            stroke: {
                lineCap: 'round'
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 0,
                            size: '80%'
                    },
                    track: {
                        margin: 0,
                    },

                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            offsetY: 5,
                            show: true
                        }
                    }
                }
            }
        }).render();
    </script>
@endpush
