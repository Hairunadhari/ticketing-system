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
            Centralized ticket management system to monitor, process, and resolve every report more quickly and efficiently.
        </p>

        <!-- Button Add dengan style modern -->
        <div class="d-flex">
            <button class="btn btn-primary btn-icon icon-left shadow-primary mb-4 ml-auto" data-toggle="modal"
                data-target="#exampleModal">
                <i class="fas fa-plus"></i> Add New Ticket
            </button>
        </div>
        <div class="row">
            @foreach ($tickets as $ticket)
            <div class="col-12 mb-4">
                <div class="card card-primary shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center py-3">
                        <div>
                            <h4 class="text-dark mb-0" style="font-size: 1.25rem; font-weight: 700;">
                                {{ ucfirst($ticket->project_name) }}</h4>
                        </div>
                        <!-- Status Badge dari desain watermarked_img_1263451293621765473.png -->
                        <div class="card-header-action">
                            @if($ticket->status == 'TODO')
                            <span class="badge badge-secondary px-3 py-2 text-uppercase" style="border-radius: 20px;">
                                Status: {{ $ticket->status }}
                            </span>

                            @elseif($ticket->status == 'PROGRESS')
                            <span class="badge badge-primary px-3 py-2 text-uppercase" style="border-radius: 20px;">
                                Status: {{ $ticket->status }}
                            </span>

                            @elseif($ticket->status == 'PENDING')
                            <span class="badge badge-warning px-3 py-2 text-uppercase" style="border-radius: 20px;">
                                Status: {{ $ticket->status }}
                            </span>

                            @elseif($ticket->status == 'DONE')
                            <span class="badge badge-success px-3 py-2 text-uppercase" style="border-radius: 20px;">
                                Status: {{ $ticket->status }}
                            </span>

                            @else
                            <span class="badge badge-danger px-3 py-2 text-uppercase" style="border-radius: 20px;">
                                Status: NEED REVIEW
                            </span>
                            @endif

                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Metadata Row -->
                        <div class="row mb-3 text-muted" style="font-size: 0.9rem;">
                            <div class="col-auto mr-3">
                                <strong>Classification :</strong>
                                <span class="text-danger"><i class="fas fa-heartbeat mr-1"></i>
                                    {{ $ticket->classification }}</span>
                            </div>
                            <div class="col-auto mr-3 border-left pl-3">
                                <strong>Created :</strong> {{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y H:i:s') }}
                            </div>
                            @if ($ticket->status == 'DONE')
                                <div class="col-auto mr-3 border-left pl-3">
                                <strong>Finished :</strong> {{ \Carbon\Carbon::parse($ticket->finished_at)->format('d M Y H:i:s') }}
                            </div>
                            @endif
                            <div class="col-auto border-left pl-3">
                                <strong>Created By :</strong>
                                <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}"
                                    class="rounded-circle mr-1" width="20">
                                <span class="font-weight-600 text-dark">{{ $ticket->createdBy->name }}</span>
                            </div>

                            @if ($ticket->handled_by != null)

                            <div class="col-auto border-left pl-3">
                                <strong>Handled By :</strong>
                                <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}"
                                    class="rounded-circle mr-1" width="20">
                                <span class="font-weight-600 text-dark">{{ $ticket->handledBy->name }}</span>
                            </div>
                            @endif
                        </div>

                        <!-- Deskripsi Box -->
                        <div class="bg-light p-3 rounded d-flex justify-content-between align-items-center">
                            <p class="mb-0 text-dark" style="max-width: 70%;">
                                {{ $ticket->description ?? 'Write something here. The problem description goes in this detailed view...' }}
                            </p>

                            <!-- Tombol Aksi di samping deskripsi sesuai gambar -->
                            @if ($ticket->status != 'DONE')
                                
                            <div class="buttons">
                                @if ($ticket->status == 'PENDING')

                                <btn class="btn btn-sm btn-outline-warning px-3 shadow-none" data-toggle="modal"
                                    data-target="#checkReasonModal{{ $ticket->id }}">
                                    <i class="fas fa-info-circle mr-1"></i> Check Reason Pending
                                </btn>
                                @elseif ($ticket->status == 'TODO' && Auth::user()->role_id != 1)
                                <form action="{{ route('tickets.startWork', $ticket->id) }}" method="POST"
                                    class="d-inline form-start-work">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning btn-sm px-4 text-white">Start
                                        Work</button>
                                </form>
                                @elseif ($ticket->handled_by == Auth::id() && $ticket->status == 'PROGRESS')
                                <form action="{{ route('tickets.finishWork', $ticket->id) }}" method="POST"
                                   class="d-inline form-finish-ticket">
                                   @csrf
                                   <button type="submit" class="btn btn-sm  btn-outline-success px-3">Review
                                       Work</button>
                               </form>
                                <a href="#" class="btn btn-outline-info btn-sm px-3 shadow-none" data-toggle="modal"
                                    data-target="#setPendingModal{{ $ticket->id }}">
                                    <i class="fas fa-file-alt mr-1"></i> Set Pending
                                </a>
                                @endif
                                <a href="#" class="btn btn-outline-info btn-sm px-3 shadow-none" data-toggle="modal"
                                    data-target="#detailModal{{ $ticket->id }}">
                                    <i class="fas fa-eye mr-1"></i> Detail Ticket
                                </a>
                                @if ($ticket->created_by === Auth::id())
                                <a href="#" class="btn btn-outline-info btn-sm px-3 shadow-none" data-toggle="modal"
                                    data-target="#editModal{{ $ticket->id }}">
                                    <i class="fas fa-edit mr-1"></i> Edit Ticket
                                </a>
                                 <form action="{{ route('tickets.delete', $ticket->id) }}" method="POST"
                                    class="d-inline form-delete-ticket">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger btn-sm px-3">
                                       <i class="fas fa-trash"></i> Delete Ticket</button>
                                </form>
                                @if ($ticket->status == 'NEED_REVIEW')
                                    
                                <form action="{{ route('tickets.close', $ticket->id) }}" method="POST"
                                    class="d-inline form-close-ticket">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success btn-sm px-3"><i class="fas fa-check"></i> Close
                                        Ticket</button>
                                    </form>
                                    @endif
                                @endif
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination Section -->
        <div class="d-flex justify-content-center mt-4">
            {{ $tickets->links('pagination::bootstrap-4') }}
        </div>

    </div>
</section>
<script>
    $(document).on('submit', '.form-start-work', function (e) {
        e.preventDefault();

        let form = this;

        Swal.fire({
            title: 'Are you sure?',
            text: "Ticket will be processed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, proceed!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
    $(document).on('submit', '.form-delete-ticket', function (e) {
        e.preventDefault();

        let form = this;

        Swal.fire({
            title: 'Are you sure?',
            text: "Ticket will be deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
    $(document).on('submit', '.form-finish-ticket', function (e) {
        e.preventDefault();

        let form = this;

        Swal.fire({
            title: 'Are you sure?',
            text: "Ticket will be sent for review!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, send for review!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
    $(document).on('submit', '.form-close-ticket', function (e) {
        e.preventDefault();

        let form = this;

        Swal.fire({
            title: 'Are you sure?',
            text: "Ticket will be closed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, close ticket!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

</script>
@endsection

@section('modal')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <form method="POST" action="{{ route('tickets.create') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="ticket_for" value="2">
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
                                    <option value="pl">p1</option>
                                    <option value="p2">p2</option>
                                    <option value="p3">p3</option>
                                    <option value="p4">p4</option>
                                </select>
                            </div>
                        </div>

                        <!-- Status -->
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="Need Review">Need Review</option>
                                    <option value="Open">Open</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>
                        </div> --}}

                        <!-- Date Range -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" accept="image/*" name="image" class="form-control mb-2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description"></textarea>
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

@foreach ($tickets as $ticket)
<!-- Modal set pending -->
<div class="modal fade" id="setPendingModal{{ $ticket->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <form method="POST" action="{{ route('tickets.set-pending', ['id' => $ticket->id]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="modal-content">
                <!-- HEADER -->
                <div class="modal-header">
                    <h5 class="modal-title">Form Set Pending {{ $ticket->project_name }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <!-- BODY -->
                <div class="modal-body">
                    <!-- ROW 1 -->
                    <div class="row">
                        <!-- Date Range -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Pending Reason</label>
                                <textarea class="form-control" name="pending_reason"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" accept="image/*" name="image_pending_reason"
                                    class="form-control mb-2">
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

<!-- Modal reason pending -->
<div class="modal fade" id="checkReasonModal{{ $ticket->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <form method="POST" action="{{ route('tickets.set-pending', ['id' => $ticket->id]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="modal-content">
                <!-- HEADER -->
                <div class="modal-header">
                    <h5 class="modal-title">Form Reason Pending {{ $ticket->project_name }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <!-- BODY -->
                <div class="modal-body">
                    <!-- ROW 1 -->
                    <div class="row">
                        <!-- Date Range -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Pending Reason</label>
                                <textarea class="form-control" name="pending_reason"
                                    readonly>{{ $ticket->pending_reason }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Image</label>
                                <img src="{{ asset('storage/images/' . $ticket->image_pending_reason) }}"
                                    alt="Pending Reason Image" class="img-fluid mb-2">
                            </div>
                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- Modal detail -->
<div class="modal fade" id="detailModal{{ $ticket->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <form method="POST" action="#" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <!-- HEADER -->
                <div class="modal-header">
                    <h5 class="modal-title">Form Detail Ticket</h5>
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
                                <input type="text" class="form-control" name="company" value="{{ $ticket->company }}"
                                    readonly>
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" class="form-control" name="country" value="{{ $ticket->country }}"
                                    readonly>
                            </div>
                        </div>

                        <!-- Operator -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Operator</label>
                                <input type="text" class="form-control" name="operator" value="{{ $ticket->operator }}"
                                    readonly>
                            </div>
                        </div>

                        <!-- Service -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Service</label>
                                <input type="text" class="form-control" name="service" value="{{ $ticket->service }}"
                                    readonly>
                            </div>
                        </div>

                        <!-- Project -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Project</label>
                                <input type="text" class="form-control" name="project_name"
                                    value="{{ $ticket->project_name }}" readonly>
                            </div>
                        </div>

                        <!-- Classification -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Classification</label>
                                <input type="text" class="form-control" name="classification"
                                    value="{{ $ticket->classification }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description"
                                    readonly>{{ $ticket->description }}</textarea>
                            </div>
                        </div>
                        <!-- Date Range -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Image</label>
                                <img src="{{ asset('storage/images/' . $ticket->image) }}" alt="Ticket Image"
                                    class="img-fluid mt-2">
                            </div>
                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- Modal edit-->
<div class="modal fade" id="editModal{{ $ticket->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <!-- HEADER -->
                <div class="modal-header">
                    <h5 class="modal-title">Form Edit Ticket</h5>
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
                                    <option value="ClickMultimedia TH" {{ $ticket->company == 'ClickMultimedia TH' ? 'selected' : '' }}>ClickMultimedia TH</option>
                                    <option value="GetWellsoon" {{ $ticket->company == 'GetWellsoon' ? 'selected' : '' }}>GetWellsoon</option>
                                    <option value="Kreative BersamalD" {{ $ticket->company == 'Kreative BersamalD' ? 'selected' : '' }}>Kreative BersamalD</option>
                                    <option value="Kreative Bersama PH" {{ $ticket->company == 'Kreative Bersama PH' ? 'selected' : '' }}>Kreative Bersama PH</option>
                                    <option value="Kreative MultimediaVN" {{ $ticket->company == 'Kreative MultimediaVN' ? 'selected' : '' }}>Kreative MultimediaVN</option>
                                    <option value="LinkIT.7Star" {{ $ticket->company == 'LinkIT.7Star' ? 'selected' : '' }}>LinkIT.7Star</option>
                                </select>
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control" name="country" required>
                                    <option value="">Select Country</option>
                                    <option value="Algeria" {{ $ticket->country == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                                    <option value="Bahrain" {{ $ticket->country == 'Bahrain' ? 'selected' : '' }}>Bahrain</option>
                                    <option value="Bangladesh" {{ $ticket->country == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                    <option value="Cambodia" {{ $ticket->country == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
                                    <option value="Egypt" {{ $ticket->country == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                                    <option value="Ghana" {{ $ticket->country == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                    <option value="Haiti" {{ $ticket->country == 'Haiti' ? 'selected' : '' }}>Haiti</option>
                                    <option value="India" {{ $ticket->country == 'India' ? 'selected' : '' }}>India</option>
                                    <option value="Indonesia" {{ $ticket->country == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                    <option value="Iraq" {{ $ticket->country == 'Iraq' ? 'selected' : '' }}>Iraq</option>
                                    <option value="Kenya" {{ $ticket->country == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                    <option value="Kingdom Saudi Arabia" {{ $ticket->country == 'Kingdom Saudi Arabia' ? 'selected' : '' }}>Kingdom Saudi Arabia</option>
                                    <option value="Kuwait" {{ $ticket->country == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                                    <option value="Laos" {{ $ticket->country == 'Laos' ? 'selected' : '' }}>Laos</option>
                                    <option value="Malaysia" {{ $ticket->country == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                    <option value="Myanmar" {{ $ticket->country == 'Myanmar' ? 'selected' : '' }}>Myanmar</option>
                                    <option value="Nigeria" {{ $ticket->country == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                    <option value="Philippines" {{ $ticket->country == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                                    <option value="Senegal" {{ $ticket->country == 'Senegal' ? 'selected' : '' }}>Senegal</option>
                                    <option value="Sri Lanka" {{ $ticket->country == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                                    <option value="Thailand" {{ $ticket->country == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                                    <option value="Vietnam" {{ $ticket->country == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                </select>
                            </div>
                        </div>

                        <!-- Operator -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Operator</label>
                                <select class="form-control" name="operator" required>
                                    <option value="">Select Operator</option>
                                    <option value="Telkomsel" {{ $ticket->operator == 'Telkomsel' ? 'selected' : '' }}>Telkomsel</option>
                                    <option value="Indosat" {{ $ticket->operator == 'Indosat' ? 'selected' : '' }}>Indosat</option>
                                    <option value="Xlaxiata" {{ $ticket->operator == 'Xlaxiata' ? 'selected' : '' }}>Xlaxiata</option>
                                    <option value="Three" {{ $ticket->operator == 'Three' ? 'selected' : '' }}>Three</option>
                                    <option value="Smartfren" {{ $ticket->operator == 'Smartfren' ? 'selected' : '' }}>Smartfren</option>
                                    <option value="Axis" {{ $ticket->operator == 'Axis' ? 'selected' : '' }}>Axis</option>
                                </select>
                            </div>
                        </div>

                        <!-- Service -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Service</label>
                                <select class="form-control" name="service" required>
                                    <option value="">Select Service</option>
                                    <option value="CICILAN (SUBSCRIPTIONS)" {{ $ticket->service == 'CICILAN (SUBSCRIPTIONS)' ? 'selected' : '' }}>CICILAN (SUBSCRIPTIONS)</option>
                                    <option value="PULL (IOD)" {{ $ticket->service == 'PULL (IOD)' ? 'selected' : '' }}>PULL (IOD)</option>
                                    <option value="FUN (SUBSCRIPTIONS)" {{ $ticket->service == 'FUN (SUBSCRIPTIONS)' ? 'selected' : '' }}>FUN (SUBSCRIPTIONS)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Project -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Project</label>
                                <input type="text" class="form-control" name="project_name"
                                    placeholder="Enter project name" value="{{ $ticket->project_name }}">
                            </div>
                        </div>

                        <!-- Classification -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Classification</label>
                                <select class="form-control" name="classification" required>
                                    <option value="">Select classification</option>
                                    <option value="po" {{ $ticket->classification == 'po' ? 'selected' : '' }}>po</option>
                                    <option value="pl" {{ $ticket->classification == 'pl' ? 'selected' : '' }}>p1</option>
                                    <option value="p2" {{ $ticket->classification == 'p2' ? 'selected' : '' }}>p2</option>
                                    <option value="p3" {{ $ticket->classification == 'p3' ? 'selected' : '' }}>p3</option>
                                    <option value="p4" {{ $ticket->classification == 'p4' ? 'selected' : '' }}>p4</option>
                                </select>
                            </div>
                        </div>

                        <!-- Date Range -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" accept="image/*" name="image" class="form-control mb-2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description">{{ $ticket->description }}</textarea>
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
@endforeach

@endsection
