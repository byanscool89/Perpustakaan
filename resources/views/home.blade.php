@extends('layout.main')
@section('title', 'Create')

@section('content')
    <div class="content">
        <div class="container">
            <div class="page-inner">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                    <div>
                        <h4>Welcome, {{ Auth::user()->name }}</h4>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6><b>Rekap </b></h6>
                                        <p class="text-muted">Total Buku Hilang dan Rusak</p>
                                    </div>
                                    <h4 class="text-info fw-bold">7</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6><b>Rekap Peminjaman</b></h6>
                                        <p class="text-muted">Total</p>
                                    </div>
                                    <h4 class="text-success fw-bold">12</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6><b>Rekap Pengembalian</b></h6>
                                        <p class="text-muted">Total</p>
                                    </div>
                                    <h4 class="text-danger fw-bold">15</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6><b>Total Anggota</b></h6>
                                        <p class="text-muted">Total</p>
                                    </div>
                                    <h4 class="text-secondary fw-bold">12</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
            <nav class="pull-left">
                <ul class="nav">

                </ul>
            </nav>
            <div class="copyright">
                &copy; 2024, made by <a href="http://www.instagram.com/smpn3karanglewas">SMP Negeri 3 Karanglewas</a>
            </div>
        </div>
    </footer>
@endsection
