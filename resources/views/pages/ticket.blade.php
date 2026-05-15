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
                            <span class="badge badge-light px-3 py-2 text-uppercase" style="border-radius: 20px;">
                                Status: {{ $ticket->status }}
                            </span>
                            @endif

                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Metadata Row -->
                        <div class="row mb-3 text-muted" style="font-size: 0.9rem;">
                            <div class="col-auto mr-3">
                                <strong>Priority:</strong>
                                <span class="text-danger"><i class="fas fa-heartbeat mr-1"></i>
                                    {{ $ticket->classification }}</span>
                            </div>
                            <div class="col-auto mr-3 border-left pl-3">
                                <strong>Created:</strong> {{ $ticket->created_at->diffForHumans() }}
                            </div>
                            <div class="col-auto border-left pl-3">
                                <strong>Handled By:</strong>
                                <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}"
                                    class="rounded-circle mr-1" width="20">
                                <span class="font-weight-600 text-dark">John D.</span>
                            </div>
                        </div>

                        <!-- Deskripsi Box -->
                        <div class="bg-light p-3 rounded d-flex justify-content-between align-items-center">
                            <p class="mb-0 text-dark" style="max-width: 70%;">
                                {{ $ticket->description ?? 'Write something here. The problem description goes in this detailed view...' }}
                            </p>

                            <!-- Tombol Aksi di samping deskripsi sesuai gambar -->
                            <div class="buttons">
                                @if($ticket->status != 'PENDING')
                                <a href="#" class="btn btn-outline-info btn-sm px-3 shadow-none" data-toggle="modal"
                                    data-target="#setPendingModal{{ $ticket->id }}">
                                    <i class="fas fa-file-alt mr-1"></i> Set Pending
                                </a>
                                @endif
                                 @if ($ticket->status == 'PENDING')

                                    <btn class="btn bt-sm btn-light text-uppercase"  data-toggle="modal"
                                    data-target="#checkReasonModal{{ $ticket->id }}" style="border-radius: 20px;">
                                    Check Reason Pending
                                </btn>
                                @endif
                                <form action="{{ route('tickets.startWork', $ticket->id) }}" method="POST" class="d-inline form-start-work">
    @csrf
    <button type="submit" class="btn btn-sm btn-warning btn-sm px-4 text-white">Start Work</button>
</form>
                            </div>
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
    $(document).on('submit', '.form-start-work', function(e) {
    e.preventDefault();

    let form = this;

    Swal.fire({
        title: 'Yakin?',
        text: "Ticket akan diproses!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, lanjut!',
        cancelButtonText: 'Batal'
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
        <form method="POST" action="{{ route('tickets.set-pending', ['id' => $ticket->id]) }}" enctype="multipart/form-data">
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
                                <input type="file" accept="image/*" name="image_pending_reason" class="form-control mb-2">
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
        <form method="POST" action="{{ route('tickets.set-pending', ['id' => $ticket->id]) }}" enctype="multipart/form-data">
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
                                <textarea class="form-control" name="pending_reason" readonly>{{ $ticket->pending_reason }}</textarea>
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
@endforeach

@endsection
