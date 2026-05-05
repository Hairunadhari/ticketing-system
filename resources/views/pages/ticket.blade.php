@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tickets</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/tickets">Ticket</a></div>
            <div class="breadcrumb-item">List Ticket</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">List Ticket</h2>
        <p class="section-lead">
            Pusat pengelolaan tiket untuk memantau, memproses, dan menyelesaikan setiap laporan dengan lebih cepat dan
            efisien.
        </p>

        <button class="btn btn-primary my-2" data-toggle="modal" data-target="#exampleModal">+ Add Ticket</button>

        <div class="row">
            @foreach ($tickets as $ticket)

            <div class="col-12 col-md-12 col-lg-12">
                <div class="card" style="border-top: 3px solid #281D00;">
                    <div class="card-header">
                        <h4>{{ $ticket->project_name }}</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-primary">Set Pending</a>
                            <a href="#" class="btn btn-danger">Kerjakan</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Write something here</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endsection

@section('modal')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <form method="POST" action="{{ route('tickets.create') }}">
                    @csrf

            <div class="modal-content">
                <!-- HEADER -->
                <div class="modal-header">
                    <h5 class="modal-title">Form Create Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <!-- BODY -->
                <div class="modal-body">
                    <!-- ROW 1 -->
                    <div class="row">
                        <!-- Company -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company</label>
                                <select class="form-control" name="company" required>
                                    <option value="">Select Company</option>
                                    <option value="ClickMultimedia TH">ClickMultimedia TH</option>
                                    <option value="GetWellsoon">GetWellsoon</option>
                                    <option value="Kreative BersamalD">Kreative BersamalD</option>
                                    <option value="Kreative Bersama PH">Kreative Bersama PH</option>
                                    <option value="Kreative MultimediaVN">Kreative MultimediaVN</option>
                                    <option value="LinkIT.7Star">LinkIT.7Star</option>
                                </select>
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control" name="country" required>
                                    <option value="">Select Country</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kingdom Saudi Arabia">Kingdom Saudi Arabia</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Laos">Laos</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Vietnam">Vietnam</option>
                                </select>
                            </div>
                        </div>

                        <!-- Operator -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Operator</label>
                                <select class="form-control" name="operator" required>
                                    <option value="">Select Operator</option>
                                    <option value="Telkomsel">Telkomsel</option>
                                    <option value="Indosat">Indosat</option>
                                    <option value="Xlaxiata">Xlaxiata</option>
                                    <option value="Three">Three</option>
                                    <option value="Smartfren">Smartfren</option>
                                    <option value="Axis">Axis</option>
                                </select>
                            </div>
                        </div>

                        <!-- Service -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Service</label>
                                <select class="form-control" name="service" required>
                                    <option value="">Select Service</option>
                                    <option value="CICILAN (SUBSCRIPTIONS)">CICILAN (SUBSCRIPTIONS)</option>
                                    <option value="PULL (IOD)">PULL (IOD)</option>
                                    <option value="FUN (SUBSCRIPTIONS)">FUN (SUBSCRIPTIONS)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Project -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Project</label>
                                <input type="text" class="form-control" name="project_name"
                                    placeholder="Enter project name">
                            </div>
                        </div>

                        <!-- Classification -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Classification</label>
                                <select class="form-control" name="classification" required>
                                    <option value="">Select classification</option>
                                    <option value="po">po</option>
                                    <option value="pl">pl</option>
                                    <option value="p2">p2</option>
                                    <option value="p3">p3</option>
                                    <option value="p4">p4</option>
                                </select>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="Need Review">Need Review</option>
                                    <option value="Open">Open</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>
                        </div>

                        <!-- Date Range -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date Range</label>
                                <select class="form-control" name="date_range" required>
                                    <option value="">Select Date</option>
                                    <option value="today">Today</option>
                                    <option value="yesterday">Yesterday</option>
                                    <option value="this_week">This Week</option>
                                    <option value="last_7_days">Last 7 Days</option>
                                    <option value="last_30_days">Last 30 Days</option>
                                    <option value="this_month">This Month</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection
