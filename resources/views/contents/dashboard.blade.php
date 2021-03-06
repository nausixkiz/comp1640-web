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
                            <p class="text-truncate mb-0"> Within this month</p>
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
                            <p class="mb-1">Views</p>
                            <h5 class="mb-3">{{ $view_idea_data['total_views_in_month'] }}</h5>
                            <p class="text-truncate mb-0"> Within this month</p>
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
                                    {!!  $visitor_data['returning_visitors']['type_icon'] !!}
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1">Returning Visitors</p>
                            <h5 class="mb-3">{{ $visitor_data['returning_visitors']['sessions'] }}</h5>
                            <p class="text-truncate mb-0"> Within this month</p>
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
                                    {!!  $visitor_data['new_visitors']['type_icon'] !!}
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1">New Visitors</p>
                            <h3 class="mb-3">{{ $visitor_data['new_visitors']['sessions'] }}</h3>
                            <p class="text-truncate mb-0"> Within this month</p>
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
                            <h5 class="card-title">Overview visitor</h5>
                        </div>
                    </div>

                    <div>
                        <div id="mixed-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex  align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title">Top Visitor by Browsers</h5>
                        </div>
                    </div>

                    <div>
                        <div id="top-browsers-chart" class="apex-charts" dir="ltr"></div>
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
                    <h4 class="card-title mb-4">User & Categories Chart</h4>

                    <div id="user_and_category_chart" class="apex-charts" dir="ltr"></div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Ideas & Categories Chart</h4>

                    <div id="idea_and_category_chart" class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Top Visitor by Country</h4>

                    <div class="pe-3" data-simplebar style="max-height: 287px;">
                        @foreach($top_countries as $country)
                            <a href="#" class="text-body d-block">
                                <div class="d-flex py-3">
                                    <div class="flex-shrink-0 me-3 align-self-center">
                                        {!! $country[2] !!}
                                    </div>

                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-14 mb-1">{{ $country[0] }}</h5>
                                    </div>
                                    <div class="flex-shrink-0 font-size-13">
                                        {{ $country[1] }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
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
            colors: ['#1c1cf0'],
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
            colors: ['#1c1cf0'],
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
        new ApexCharts(document.querySelector("#user_and_category_chart"), {
            chart: {
                height: 370,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                                // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                return {{ \App\Models\User::count() }}
                            }
                        }
                    }
                }
            },
            series: [{{ $user_and_category_data[0][1] }}, {{ $user_and_category_data[1][1] }}, {{ $user_and_category_data[2][1] }}, {{ $user_and_category_data[3][1] }}, {{ $user_and_category_data[4][1] }}],
            labels: ['{{ $user_and_category_data[0][0] }}', '{{ $user_and_category_data[1][0] }}', '{{ $user_and_category_data[2][0] }}', '{{ $user_and_category_data[3][0] }}', '{{ $user_and_category_data[4][0] }}'],
            colors: ['#3d8ef8', '#11c46e', '#f1b44c', '#fb4d53', '#6dc02f'],

        }).render();
        new ApexCharts(document.querySelector("#idea_and_category_chart"), {
            chart: {
                height: 370,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                                return {{ \App\Models\Post::count() }}
                            }
                        }
                    }
                }
            },
            series: [{{ $idea_and_category_data[0][1] }}, {{ $idea_and_category_data[1][1] }}, {{ $idea_and_category_data[2][1] }}, {{ $idea_and_category_data[3][1] }}, {{ $idea_and_category_data[4][1] }}],
            labels: ['{{ $idea_and_category_data[0][0] }}', '{{ $idea_and_category_data[1][0] }}', '{{ $idea_and_category_data[2][0] }}', '{{ $idea_and_category_data[3][0] }}', '{{ $idea_and_category_data[4][0] }}'],
            colors: ['#3d8ef8', '#11c46e', '#f1b44c', '#fb4d53', '#f099f4'],

        }).render();
        new ApexCharts(document.querySelector("#top-browsers-chart"), {
            chart: {
                height: 370,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                                return {{ $total_visitors }}
                            }
                        }
                    }
                }
            },
            series: [{{ $idea_and_category_data[2][1] }}, {{ $idea_and_category_data[3][1] }}, {{ $idea_and_category_data[4][1] }}],
            labels: ['{{ $idea_and_category_data[2][0] }}', '{{ $idea_and_category_data[3][0] }}', '{{ $idea_and_category_data[4][0] }}'],
            colors: ['#da67de', '#af7326', '#175c3c'],

        }).render();
        new ApexCharts(document.querySelector("#chart"), {
            series: [{
                name: 'Series 1',
                data: [80, 50, 30, 40, 100, 20],
            }, {
                name: 'Series 2',
                data: [20, 30, 40, 80, 20, 80],
            }, {
                name: 'Series 3',
                data: [44, 76, 78, 13, 43, 10],
            }],
            chart: {
                height: 350,
                type: 'radar',
                dropShadow: {
                    enabled: true,
                    blur: 1,
                    left: 1,
                    top: 1
                }
            },
            title: {
                text: 'Radar Chart - Multi Series'
            },
            stroke: {
                width: 2
            },
            fill: {
                opacity: 0.1
            },
            markers: {
                size: 0
            },
            xaxis: {
                categories: ['2011', '2012', '2013', '2014', '2015', '2016']
            }
        }).render();
        new ApexCharts(document.querySelector("#mixed-chart"), {
            chart: {
                height: 350,
                type: 'area',
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3,
            },
            series: [{
                name: 'Views',
                data: [34, 40, 28, 52, 42, 109, 100]
            },],
            colors: ['#3d8ef8'],
            xaxis: {
                type: 'datetime',
                categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00", "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00", "2018-09-19T06:30:00"],
            },
            grid: {
                borderColor: '#f1f1f1',
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            }
        }).render();
    </script>
@endpush
