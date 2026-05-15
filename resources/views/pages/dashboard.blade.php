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
                            10
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ticket Pending</h4>
                        </div>
                        <div class="card-body">
                            42
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
                            42
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
                            1,201
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
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Activity</th>
                                        <th>Ticket</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=4e73df&color=fff&size=32"
                                                        class="rounded-circle" width="32" height="32"
                                                        alt="Budi Santoso">
                                                </div>
                                                <span>Budi Santoso</span>
                                            </div>
                                        </td>
                                        <td>Membuat tiket baru</td>
                                        <td><span class="badge badge-light">#TKT-001</span></td>
                                        <td><span class="badge badge-danger">Pending</span></td>
                                        <td>15 May 2026, 08:12</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <img src="https://ui-avatars.com/api/?name=Siti+Rahayu&background=1cc88a&color=fff&size=32"
                                                        class="rounded-circle" width="32" height="32"
                                                        alt="Siti Rahayu">
                                                </div>
                                                <span>Siti Rahayu</span>
                                            </div>
                                        </td>
                                        <td>Mengubah status tiket</td>
                                        <td><span class="badge badge-light">#TKT-002</span></td>
                                        <td><span class="badge badge-warning">In Progress</span></td>
                                        <td>15 May 2026, 09:05</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <img src="https://ui-avatars.com/api/?name=Andi+Wijaya&background=f6c23e&color=fff&size=32"
                                                        class="rounded-circle" width="32" height="32"
                                                        alt="Andi Wijaya">
                                                </div>
                                                <span>Andi Wijaya</span>
                                            </div>
                                        </td>
                                        <td>Menyelesaikan tiket</td>
                                        <td><span class="badge badge-light">#TKT-003</span></td>
                                        <td><span class="badge badge-success">Done</span></td>
                                        <td>15 May 2026, 10:30</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <img src="https://ui-avatars.com/api/?name=Dewi+Lestari&background=e74a3b&color=fff&size=32"
                                                        class="rounded-circle" width="32" height="32"
                                                        alt="Dewi Lestari">
                                                </div>
                                                <span>Dewi Lestari</span>
                                            </div>
                                        </td>
                                        <td>Menambahkan komentar</td>
                                        <td><span class="badge badge-light">#TKT-004</span></td>
                                        <td><span class="badge badge-warning">In Progress</span></td>
                                        <td>15 May 2026, 11:18</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <img src="https://ui-avatars.com/api/?name=Reza+Pratama&background=858796&color=fff&size=32"
                                                        class="rounded-circle" width="32" height="32"
                                                        alt="Reza Pratama">
                                                </div>
                                                <span>Reza Pratama</span>
                                            </div>
                                        </td>
                                        <td>Membuat tiket baru</td>
                                        <td><span class="badge badge-light">#TKT-005</span></td>
                                        <td><span class="badge badge-danger">Pending</span></td>
                                        <td>15 May 2026, 13:45</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <img src="https://ui-avatars.com/api/?name=Nina+Kusuma&background=36b9cc&color=fff&size=32"
                                                        class="rounded-circle" width="32" height="32"
                                                        alt="Nina Kusuma">
                                                </div>
                                                <span>Nina Kusuma</span>
                                            </div>
                                        </td>
                                        <td>Meng-assign tiket ke teknisi</td>
                                        <td><span class="badge badge-light">#TKT-006</span></td>
                                        <td><span class="badge badge-warning">In Progress</span></td>
                                        <td>15 May 2026, 14:20</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <img src="https://ui-avatars.com/api/?name=Hendra+Gunawan&background=4e73df&color=fff&size=32"
                                                        class="rounded-circle" width="32" height="32"
                                                        alt="Hendra Gunawan">
                                                </div>
                                                <span>Hendra Gunawan</span>
                                            </div>
                                        </td>
                                        <td>Menyelesaikan tiket</td>
                                        <td><span class="badge badge-light">#TKT-007</span></td>
                                        <td><span class="badge badge-success">Done</span></td>
                                        <td>15 May 2026, 15:55</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
