@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Ticket</h4>
                        </div>
                        <div class="card-body">
                            {{$total}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-secondary">
                        <i class="fas fa-list-ul"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ticket Todo</h4>
                        </div>
                        <div class="card-body">
                            {{$todo}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ticket Pending</h4>
                        </div>
                        <div class="card-body">
                            {{$pending}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-circle-notch fa-spin"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ticket Progress</h4>
                        </div>
                        <div class="card-body">
                            {{$progress}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ticket Need Review</h4>
                        </div>
                        <div class="card-body">
                            {{$needReview}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ticket Done</h4>
                        </div>
                        <div class="card-body">
                            {{$done}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Activities</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Code Ticket</th>
                                        <th>Activity</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($activities as $activity)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm mr-2">
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($activity->name) }}&background=4e73df&color=fff&size=32"
                                                            class="rounded-circle" width="32" height="32"
                                                            alt="{{ $activity->name }}">
                                                    </div>
                                                    <span>{{ $activity->name }}</span>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-light">{{ $activity->code_ticket }}</span></td>
                                            <td>{{ $activity->description }}</td>
                                            <td>{{ $activity->created_at->format('d M Y, H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No activities found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $activities->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>SLA Status Overview</h4>
                    <small class="text-muted">
        {{ $weekStart->format('d M Y') }} — {{ $weekEnd->format('d M Y') }}
    </small>

            </div>
            <div class="card-body">
                <canvas id="slaPieChart" height="300"></canvas>
            </div>
        </div>
    </div>

    {{-- Hitung total SLA dulu --}}
@php
    $slaTotal = $slaOnTrack + $slaAtRisk + $slaBreached;
@endphp

<div class="col-lg-6 col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>SLA Summary</h4>
            <small class="text-muted">
                {{ $weekStart->format('d M Y') }} — {{ $weekEnd->format('d M Y') }}
            </small>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Jumlah</th>
                        <th>Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge" style="background:#28a745">On Track</span></td>
                        <td>{{ $slaOnTrack }}</td>
                        <td>{{ $slaTotal > 0 ? round(($slaOnTrack / $slaTotal) * 100, 1) : 0 }}%</td>
                    </tr>
                    <tr>
                        <td><span class="badge" style="background:#ffc107">At Risk</span></td>
                        <td>{{ $slaAtRisk }}</td>
                        <td>{{ $slaTotal > 0 ? round(($slaAtRisk / $slaTotal) * 100, 1) : 0 }}%</td>
                    </tr>
                    <tr>
                        <td><span class="badge" style="background:#dc3545">Breached</span></td>
                        <td>{{ $slaBreached }}</td>
                        <td>{{ $slaTotal > 0 ? round(($slaBreached / $slaTotal) * 100, 1) : 0 }}%</td>
                    </tr>
                    <tr class="font-weight-bold">
                        <td>Total</td>
                        <td>{{ $slaTotal }}</td>
                        <td>100%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
    </section>
    @push('scripts')
<script>
    const ctx = document.getElementById('slaPieChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['On Track', 'At Risk', 'Breached'],
            datasets: [{
                data: [
                    {{ $slaOnTrack }},
                    {{ $slaAtRisk }},
                    {{ $slaBreached }}
                ],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                borderColor: ['#fff', '#fff', '#fff'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const pct = total > 0 ? ((context.raw / total) * 100).toFixed(1) : 0;
                            return ` ${context.label}: ${context.raw} (${pct}%)`;
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection