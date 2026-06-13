@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header bg-white p-4 rounded shadow-sm mb-4">
        <div>
            <h1 class="text-dark font-weight-bold" style="font-size: 1.75rem; letter-spacing: -0.5px;">IT Helpdesk Tickets</h1>
            <p class="text-muted mb-0 mt-1">Centralized ticket management system to monitor, process, and resolve issues efficiently.</p>
        </div>
        <div class="section-header-breadcrumb ml-auto d-none d-sm-block">
            <div class="breadcrumb-item active"><a href="/tickets" class="text-primary font-weight-600">Ticket</a></div>
            <div class="breadcrumb-item text-muted">List Ticket</div>
        </div>
    </div>

    <div class="section-body">
        <!-- Action Header Row -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title my-0 text-dark font-weight-600" style="font-size: 1.25rem;"> active tickets</h2>
            <button class="btn btn-primary btn-icon icon-left btn-lg shadow-sm font-weight-600 px-4" style="border-radius: 8px;" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-plus mr-2"></i> Add New Ticket
            </button>
        </div>

        <div class="row">
            @foreach ($tickets as $ticket)
            <div class="col-12 mb-3">
                <!-- Premium Modern Card Layout -->
                <div class="card border-0 shadow-sm custom-ticket-card position-relative overflow-hidden" style="border-radius: 12px; border-left: 5px solid {{ $ticket->status == 'DONE' ? '#47c363' : ($ticket->status == 'PROGRESS' ? '#6777ef' : ($ticket->status == 'PENDING' ? '#ffa426' : '#cdd3d8')) }} !important;">
                    <div class="card-body p-4">
                        
                        <!-- Top Row: Title & Badges -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center border-bottom pb-3 mb-3">
                            <div class="mb-2 mb-md-0">
                                <span class="text-muted font-weight-600 small text-uppercase tracking-wider">Project</span>
                                <h4 class="text-dark font-weight-bold mb-0 mt-1" style="font-size: 1.3rem; letter-spacing: -0.3px;">
                                    {{ ucfirst($ticket->project_name) }}
                                </h4>
                            </div>
                            
                            <!-- Badges Status Modern -->
                            <div class="d-flex align-items-center bg-light p-1 rounded-pill px-2">
                                @if($ticket->status == 'TODO')
                                    <span class="badge badge-secondary px-3 py-2 rounded-pill font-weight-bold text-uppercase" style="font-size: 0.75rem;">TODO</span>
                                @elseif($ticket->status == 'PROGRESS')
                                    <span class="badge badge-primary px-3 py-2 rounded-pill font-weight-bold text-uppercase" style="font-size: 0.75rem; box-shadow: 0 2px 6px rgba(103,119,239,.3);">ON PROGRESS</span>
                                @elseif($ticket->status == 'PENDING')
                                    <span class="badge badge-warning px-3 py-2 rounded-pill font-weight-bold text-dark text-uppercase" style="font-size: 0.75rem; box-shadow: 0 2px 6px rgba(255,164,38,.3);">PENDING</span>
                                @elseif($ticket->status == 'DONE')
                                    <span class="badge badge-success px-3 py-2 rounded-pill font-weight-bold text-uppercase" style="font-size: 0.75rem; box-shadow: 0 2px 6px rgba(71,195,99,.3);">DONE</span>
                                @else
                                    <span class="badge badge-danger px-3 py-2 rounded-pill font-weight-bold text-uppercase" style="font-size: 0.75rem;">NEED REVIEW</span>
                                @endif
                            </div>
                        </div>

                        <!-- Middle Row: Description -->
                        <div class="mb-4">
                            <p class="text-dark font-weight-500 style-description mb-0 text-justify" style="line-height: 1.6; font-size: 0.95rem; color: #4a5568 !important;">
                                {{ $ticket->description ?? 'No details provided for this ticket. Click detail to view more information.' }}
                            </p>
                        </div>

                        <!-- Bottom Row: Meta Info & Actions -->
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center pt-2 gap-3">
                            
                            <!-- Meta Widgets Grid Layout -->
                            <div class="d-flex flex-wrap align-items-center text-muted gap-4" style="font-size: 0.85rem;">
                                <div class="meta-item py-1">
                                    <span class="d-block text-muted small font-weight-600">Classification</span>
                                    <span class="text-danger font-weight-bold"><i class="fas fa-bolt mr-1"></i> {{ $ticket->classification }}</span>
                                </div>
                                
                                <div class="meta-item border-left pl-3 py-1">
                                    <span class="d-block text-muted small font-weight-600">Created At</span>
                                    <span class="text-dark font-weight-600"><i class="far fa-calendar-alt mr-1 text-muted"></i> {{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y, H:i') }}</span>
                                </div>

                                @if ($ticket->status == 'DONE')
                                <div class="meta-item border-left pl-3 py-1">
                                    <span class="d-block text-muted small font-weight-600">Finished At</span>
                                    <span class="text-success font-weight-600"><i class="fas fa-check-circle mr-1"></i> {{ \Carbon\Carbon::parse($ticket->finished_at)->format('d M Y, H:i') }}</span>
                                </div>
                                @endif

                                <div class="meta-item border-left pl-3 py-1">
                                    <span class="d-block text-muted small font-weight-600">Reporter</span>
                                    <div class="d-flex align-items-center mt-1">
                                        <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-2 border shadow-sm" width="22">
                                        <span class="font-weight-600 text-dark">{{ $ticket->createdBy->name }}</span>
                                    </div>
                                </div>

                                @if ($ticket->handled_by != null)
                                <div class="meta-item border-left pl-3 py-1">
                                    <span class="d-block text-muted small font-weight-600">Assignee</span>
                                    <div class="d-flex align-items-center mt-1">
                                        <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-2.png') }}" class="rounded-circle mr-2 border shadow-sm" width="22">
                                        <span class="font-weight-600 text-dark">{{ $ticket->handledBy->name }}</span>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Interactive Actions Block -->
                            @if ($ticket->status != 'DONE')
                            <div class="action-buttons-group d-flex flex-wrap align-items-center gap-2 mt-3 mt-lg-0">
                                
                                @if ($ticket->status == 'PENDING')
                                    <button class="btn btn-sm btn-light text-warning font-weight-600 px-3 py-2 btn-action-hover" data-toggle="modal" data-target="#checkReasonModal{{ $ticket->id }}">
                                        <i class="fas fa-info-circle mr-1"></i> Reason Pending
                                    </button>
                                @elseif ($ticket->status == 'TODO' && Auth::user()->role_id != 1)
                                    <form action="{{ route('tickets.infra.startWork', $ticket->id) }}" method="POST" class="d-inline form-start-work-helpdesk">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning font-weight-bold text-white px-4 py-2 shadow-sm btn-action-hover">
                                            <i class="fas fa-play mr-1"></i> Start Work
                                        </button>
                                    </form>
                                @elseif ($ticket->handled_by == Auth::id() && $ticket->status == 'PROGRESS')
                                    <form action="{{ route('tickets.infra.finishWork', $ticket->id) }}" method="POST" class="d-inline form-finish-ticket">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success font-weight-bold px-3 py-2 shadow-sm btn-action-hover">
                                            <i class="fas fa-clipboard-check mr-1"></i> Review Work
                                        </button>
                                    </form>
                                    @if (Auth::user()->role_id != 2)
                                        
                                    <a href="#" class="btn btn-sm btn-outline-warning font-weight-600 px-3 py-2 btn-action-hover" data-toggle="modal" data-target="#setPendingModal{{ $ticket->id }}">
                                        <i class="fas fa-pause-circle mr-1"></i> Set Pending
                                    </a>
                                    @endif
                                @endif

                                <!-- Standard Action Triggers -->
                                <a href="#" class="btn btn-sm btn-outline-primary font-weight-600 px-3 py-2 btn-action-hover" data-toggle="modal" data-target="#detailModal{{ $ticket->id }}">
                                    <i class="fas fa-expand mr-1"></i> Detail
                                </a>

                                @if ($ticket->created_by === Auth::id())
                                    <a href="#" class="btn btn-sm btn-outline-info font-weight-600 px-3 py-2 btn-action-hover" data-toggle="modal" data-target="#editModal{{ $ticket->id }}">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('tickets.infra.delete', $ticket->id) }}" method="POST" class="d-inline form-delete-ticket-helpdesk">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger font-weight-600 px-3 py-2 btn-action-hover">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    
                                    @if ($ticket->status == 'NEED_REVIEW')
                                        <form action="{{ route('tickets.infra.close', $ticket->id) }}" method="POST" class="d-inline form-close-ticket-helpdesk">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success font-weight-bold px-4 py-2 shadow-sm btn-action-hover">
                                                <i class="fas fa-lock mr-1"></i> Close Ticket
                                            </button>
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
        <div class="d-flex justify-content-center mt-5">
            {{ $tickets->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>

<!-- CSS Helper tambahan untuk hasil maksimal -->
<style>
    .gap-2 { gap: 0.5rem; }
    .gap-3 { gap: 1rem; }
    .gap-4 { gap: 1.5rem; }
    .custom-ticket-card {
        background: #ffffff;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .custom-ticket-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.05) !important;
    }
    .btn-action-hover {
        border-radius: 6px;
        transition: all 0.2s;
    }
    .tracking-wider {
        letter-spacing: 0.05em;
        font-size: 0.7rem;
    }
    @media (max-width: 576px) {
        .meta-item {
            border-left: none !important;
            padding-left: 0 !important;
            width: 100%;
            margin-bottom: 0.5rem;
        }
    }
</style>

<script>
    // SweetAlert scripts tetap sama seperti logika bawaan Anda
    $(document).on('submit', '.form-start-work-helpdesk', function (e) {
        e.preventDefault();
        let form = this;
        Swal.fire({
            title: 'Are you sure?',
            text: "Ticket will be processed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6777ef',
            confirmButtonText: 'Yes, proceed!',
            cancelButtonText: 'Cancel'
        }).then((result) => { if (result.isConfirmed) form.submit(); });
    });

    $(document).on('submit', '.form-delete-ticket-helpdesk', function (e) {
        e.preventDefault();
        let form = this;
        Swal.fire({
            title: 'Are you sure?',
            text: "Ticket will be permanently deleted!",
            icon: 'danger',
            showCancelButton: true,
            confirmButtonColor: '#fc544b',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => { if (result.isConfirmed) form.submit(); });
    });

    $(document).on('submit', '.form-finish-ticket-helpdesk', function (e) {
        e.preventDefault();
        let form = this;
        Swal.fire({
            title: 'Finish working?',
            text: "Ticket will be sent for review!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#47c363',
            confirmButtonText: 'Yes, send for review!',
            cancelButtonText: 'Cancel'
        }).then((result) => { if (result.isConfirmed) form.submit(); });
    });

    $(document).on('submit', '.form-close-ticket-helpdesk', function (e) {
        e.preventDefault();
        let form = this;
        Swal.fire({
            title: 'Close this ticket?',
            text: "This ticket will be marked as completely resolved!",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#47c363',
            confirmButtonText: 'Yes, close it!',
            cancelButtonText: 'Cancel'
        }).then((result) => { if (result.isConfirmed) form.submit(); });
    });
</script>

@foreach ($tickets as $ticket)
    @include('pages.helpdesk.modal.detail', ['ticket' => $ticket])
    @include('pages.helpdesk.modal.edit', ['ticket' => $ticket])
    @include('pages.helpdesk.modal.reasonPending', ['ticket' => $ticket])
    @include('pages.helpdesk.modal.setPending', ['ticket' => $ticket])
@endforeach
@include('pages.helpdesk.modal.create')

@endsection