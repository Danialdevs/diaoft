@extends('layouts.admin-template')

@section('title', __('License Management'))

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{__('rates.title')}}</h1>

        <form method="GET" class="d-flex align-items-center">
            <input
                type="date"
                name="start_date"
                class="form-control me-2"
                style="height: 2.5rem;"
                placeholder="{{ __('Beginning of the period') }}"
                value="{{ $startDate->format('Y-m-d') }}"
                required
            >
            <input
                type="date"
                name="end_date"
                class="form-control me-2"
                style="height: 2.5rem;"
                placeholder="{{ __('End of period') }}"
                value="{{ $endDate->format('Y-m-d') }}"
                required
            >
            <button type="submit" class="btn btn-primary" style="height: 2.5rem;">{{ __("show") }}</button>
        </form>
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-start-info py-2 shadow">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-info fw-bold mb-1 text-xs">
                                <span>{{ __("rates.card.total") }}</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0">
                                <span>{{ $rates->count() }}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list-ul fa-2x text-gray-300" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Карточка: Плохие оценки -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-start-danger py-2 shadow">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-danger fw-bold mb-1 text-xs">
                                <span>{{ __("rates.card.bad") }}</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0">
                                <span>
                                    {{ $rates->where('score', '<', 50)->count() }}
                                    ({{ $rates->count() > 0 ? round(($rates->where('score', '<', 50)->count() / $rates->count()) * 100, 2) : 0 }}%)
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-thumbs-down fa-2x text-gray-300" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Карточка: Средние оценки -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-start-warning py-2 shadow">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-warning fw-bold mb-1 text-xs">
                                <span>{{ __("rates.card.good") }}</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0">
                                <span>
                                    {{ $rates->where('score', '>=', 50)->where('score', '<', 75)->count() }}
                                    ({{ $rates->count() > 0 ? round(($rates->where('score', '>=', 50)->where('score', '<', 75)->count() / $rates->count()) * 100, 2) : 0 }}%)
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-adjust fa-2x text-gray-300" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Карточка: Хорошие оценки -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-start-success py-2 shadow">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-success fw-bold mb-1 text-xs">
                                <span>{{ __("rates.card.perfectly") }}</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0">
                                <span>
                                    {{ $rates->where('score', '>=', 75)->count() }}
                                    ({{ $rates->count() > 0 ? round(($rates->where('score', '>=', 75)->count() / $rates->count()) * 100, 2) : 0 }}%)
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-thumbs-up fa-2x text-gray-300" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Таблица с данными -->
    <div class="row">
        <div class="col-8">
            <div class="card border-start-info py-2 shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __("rates.classes") }}</h5>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th rowspan="2">{{ __('grade') }}</th>
                            <th colspan="3">{{ __('quality') }}</th>
                            <th colspan="2">{{ __('total') }}</th>
                        </tr>
                        <tr>
                            <th>{{ __('bad') }}</th>
                            <th>{{ __('good') }}</th>
                            <th>{{ __('excellent') }}</th>
                            <th>{{ __('grades') }}</th>
                            <th>{{ __('percentage') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(range(1, 11) as $class)
                            <tr>
                                <td>{{ $class }} - {{ __('grade') }}</td>

                                <td>{{ $rates->whereBetween('score', [0, 50])->where('grade', $class)->count() }}</td>
                                <td>{{ $rates->whereBetween('score', [50, 75])->where('grade', $class)->count() }}</td>
                                <td>{{ $rates->whereBetween('score', [75, 100])->where('grade', $class)->count() }}</td>

                                <td>{{ $rates->where("grade", $class)->count() }}</td>
                                <td>{{ round($rates->where("grade", $class)->avg("score")  ?? 0, 2) }}%</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card mb-2 border-start-success py-2 shadow">
                <div class="card-body">
                    <div id="chart-demo-pie"></div>
                </div>
            </div>

            <div class="card border-start-info py-2 shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('reports') }}</h5>
                </div>

                <div class="card-body">
                    <p class="text-muted mb-3">
                        {{ __('choose_report_type') }}
                    </p>

                    <div class="mb-3">
                        <h6 class="text-primary">{{ __('report_by_classes') }}</h6>
                        <p class="text-muted">{{ __('report_by_classes_description') }}</p>
                        <a href="{{ route('rates-export', [
                            'type' => 'grade',
                            'file_type' => 'xlsx',
                            'start_date' => request('start_date', now()->startOfMonth()->format('Y-m-d')),
                            'end_date' => request('end_date', now()->format('Y-m-d'))
                        ]) }}" class="btn btn-outline-primary btn-sm">
                            {{ __('download') }}
                        </a>
                    </div>

                    <div>
                        <h6 class="text-primary">{{ __('all_grades_report') }}</h6>
                        <p class="text-muted">{{ __('all_grades_report_description') }}</p>
                        <a href="{{ route('rates-export', [
                            'type' => 'all',
                            'file_type' => 'xlsx',
                            'start_date' => request('start_date', now()->startOfMonth()->format('Y-m-d')),
                            'end_date' => request('end_date', now()->format('Y-m-d'))
                        ]) }}" class="btn btn-outline-primary btn-sm">
                            {{ __('download') }}
                        </a>
                    </div>
                </div>

                <div class="card-footer text-muted text-center">
                    <small>{{ __('choose_period_for_report') }}</small>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (window.ApexCharts) {
                const chartData = {
                    chart: {
                        type: "donut",
                        height: 240,
                        sparkline: {
                            enabled: true
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    fill: {
                        opacity: 1,
                    },
                    series: [
                        {{ $rates->where('score', '<', 50)->count() }},
                        {{ $rates->where('score', '>=', 50)->where('score', '<', 75)->count() }},
                        {{ $rates->where('score', '>=', 75)->count() }}
                    ],
                    labels: [
                        "{{ __('rates.card.bad') }}",
                        "{{ __('rates.card.good') }}",
                        "{{ __('rates.card.perfectly') }}"
                    ],
                    tooltip: {
                        theme: 'light',
                        fillSeriesColor: false
                    },
                    grid: {
                        strokeDashArray: 4,
                    },
                    colors: [
                        tabler.getColor("danger"),
                        tabler.getColor("orange", 0.8),
                        tabler.getColor("green", 0.6)
                    ],
                    legend: {
                        show: true,
                        position: 'bottom',
                        offsetY: 12,
                        markers: {
                            width: 10,
                            height: 10,
                            radius: 100,
                        },
                        itemMargin: {
                            horizontal: 8,
                            vertical: 8
                        },
                    }
                };

                const chartElement = document.getElementById('chart-demo-pie');
                const chart = new ApexCharts(chartElement, chartData);
                chart.render();
            }
        });
    </script>
@endsection
