<div class="modal fade" id="detailModalhelpdesk{{ $ticket->id }}" tabindex="-1" role="dialog">
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