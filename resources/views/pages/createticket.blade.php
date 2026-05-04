@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Ticket</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>Ticket Form</h4>
                </div>

                <div class="card-body">

                    <form method="POST" action="#">
                        @csrf

                        <!-- ROW 1 -->
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Company</label>
                                    <select class="form-control">
                                        <option>Select Company</option>
                                        <option>ClickMultimedia TH</option>
                                        <option>GetWellsoon</option>
                                        <option>Kreative BersamalD</option>
                                        <option>Kreative Bersama PH</option>
                                        <option>Kreative MultimediaVN</option>
                                        <option>LinkIT.7Star</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control">
                                        <option>Select Country</option>

                                        <option>Algeria</option>
                                        <option>Bahrain</option>
                                        <option>Bangladesh</option>
                                        <option>Cambodia</option>
                                        <option>Egypt</option>
                                        <option>Ghana</option>
                                        <option>Haiti</option>
                                        <option>India</option>
                                        <option>Indonesia</option>
                                        <option>Iraq</option>
                                        <option>Kenya</option>
                                        <option>Kingdom Saudi Arabia</option>
                                        <option>Kuwait</option>
                                        <option>Laos</option>
                                        <option>Malaysia</option>
                                        <option>Myanmar</option>
                                        <option>Nigeria</option>
                                        <option>Philippines</option>
                                        <option>Senegal</option>
                                        <option>Sri Lanka</option>
                                        <option>Thailand</option>
                                        <option>Vietnam</option>
                                        <option>Czech Republic</option>
                                        <option>Ethiopia</option>
                                        <option>Gabon</option>
                                        <option>Greece</option>
                                        <option>Ivory Coast</option>
                                        <option>Jordan</option>
                                        <option>Mauritania</option>
                                        <option>Mexico</option>
                                        <option>Morocco</option>
                                        <option>Norway</option>
                                        <option>Timor Leste</option>
                                        <option>Sweden</option>
                                        <option>Sudan</option>
                                        <option>Switzerland</option>
                                        <option>United Arab Emirates</option>
                                        <option>South Africa</option>
                                        <option>Serbia</option>
                                        <option>Qatar</option>
                                        <option>Palestine</option>
                                        <option>Oman</option>
                                        <option>Pakistan</option>
                                        <option>United State America</option>
                                        <option>United Kingdom</option>
                                        <option>Poland</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Operator</label>
                                    <select class="form-control">
                                        <option>Select Operator</option>

                                        <option>Telkomsel</option>
                                        <option>Indosat</option>
                                        <option>Xlaxiata</option>
                                        <option>Three</option>
                                        <option>Smartfren</option>
                                        <option>Axis</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Service</label>
                                    <select class="form-control">
                                        <option>Select Service</option>

                                        <option>CICILAN (SUBSCRIPTIONS) (98876)</option>
                                        <option>CICILAN LINKIT41 KEC (SUBSCRIPTIONS) (98876)</option>
                                        <option>CICILAN LINKIT41 ADS (SUBSCRIPTIONS) (98876)</option>
                                        <option>CICILAN LINKIT41 OK (SUBSCRIPTIONS) (98876)</option>
                                        <option>PULL (IOD) (98876)</option>
                                        <option>FUN (SUBSCRIPTIONS) (98876)</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <!-- ROW 2 -->
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Project</label>
                                    <input type="text" class="form-control" placeholder="Enter project name">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Classification</label>
                                    <select class="form-control">
                                        <option>Select classification</option>

                                        <option>po</option>
                                        <option>pl</option>
                                        <option>p2</option>
                                        <option>p3</option>
                                        <option>p4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control">
                                        <option>Select Status</option>
                                        <option>Need Review</option>
                                        <option>Open</option>
                                        <option>Closed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date Range</label>
                                    <select class="form-control" name="date_range">
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

                        <!-- BUTTON -->
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>

                            <button type="reset" class="btn btn-light ml-2">
                                Reset
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </section>
@endsection
