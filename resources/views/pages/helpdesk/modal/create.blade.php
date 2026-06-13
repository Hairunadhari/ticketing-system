<div class="modal fade" id="exampleModalhelpdesk" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <form method="POST" action="{{ route('tickets.helpdesk.create') }}" enctype="multipart/form-data">
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
                                <small class="text-danger">*</small>
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
                                <small class="text-danger">*</small>
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
                                <small class="text-danger">*</small>
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
                                <small class="text-danger">*</small>
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
                                    <small class="text-danger">*</small>
                                <input type="text" class="form-control" name="project_name"
                                    placeholder="Enter project name">
                            </div>
                        </div>

                        <!-- Classification -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Classification</label>
                                <small class="text-danger">*</small>
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
                                <small class="text-danger">*</small>
                                <input type="file" accept="image/*" name="image" class="form-control mb-2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <small class="text-danger">*</small>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </div>
        </form>
    </div>
</div>