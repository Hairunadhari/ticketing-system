@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tickets</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
            <div class="breadcrumb-item">Card</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">List Ticket</h2>
        <p class="section-lead">
            Pusat pengelolaan tiket untuk memantau, memproses, dan menyelesaikan setiap laporan dengan lebih cepat dan
            efisien.
        </p>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card" style="border-top: 3px solid #281D00;">
                    <div class="card-header">
                        <h4>Card Header</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-primary">View All</a>
                            <a href="#" class="btn btn-danger">Delete All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Write something here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
