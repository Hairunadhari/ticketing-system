<div class="modal fade" id="editModalhelpdesk{{ $ticket->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <form method="POST" action="{{ route('tickets.helpdesk.update', $ticket->id) }}" enctype="multipart/form-data">
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