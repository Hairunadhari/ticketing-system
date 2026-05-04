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

            <!-- ===================== -->
            <!-- BUTTON TAMBAH MODAL -->
            <!-- ===================== -->
            <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">
                + Create Ticket
            </a>

            <!-- ===================== -->
            <!-- MODAL (BOOTSTRAP 4) -->
            <!-- ===================== -->
            <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Ticket</h5>

                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label>Nama Ticket</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nama ticket">
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <input type="text" class="form-control" placeholder="Masukkan deskripsi">
                                </div>

                                <button type="submit" class="btn btn-success btn-block">
                                    Simpan
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- ===================== -->
            <!-- CARD KAMU (TIDAK DIUBAH) -->
            <!-- ===================== -->
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
