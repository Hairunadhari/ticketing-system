<div class="modal fade" id="setPendingModalhelpdesk{{ $ticket->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <form method="POST" action="{{ route('tickets.heldepsk.set-pending', ['id' => $ticket->id]) }}"
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