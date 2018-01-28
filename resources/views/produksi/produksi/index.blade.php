@extends('layouts.produksiApp')

@section('konten')
    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-warning btn-fill btn-round btn-icon">
                        <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                        <i class="fa fa-navicon visible-on-sidebar-mini"></i>
                    </button>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand">Data Produksi</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown dropdown-with-icons">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-list"></i>
                                <p class="hidden-md hidden-lg">
                                    More
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <ul class="dropdown-menu dropdown-with-icons">
                                <li class="divider"></li>
                                <li>
                                    <a href="/logout" class="text-danger">
                                        <i class="pe-7s-close-circle"></i>
                                        Log out
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--Grafik Permintaan-->
        <div class="content wrapper">
            <div class="container-fluid">
                <div class="row">
                    <!-- Tabel jumlah produk -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">Daftar Produk</div>
                            <div class="content">
                                <div class="toolbar">
                                    <a href="/produksi/create"
                                       class="btn btn-primary" type="button">Tambah Data</a>
                                </div>
                                <div class="fresh-datatables">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <th>#</th>
                                        <th>Nama Produk</th>
                                        <th>Tgl Produksi</th>
                                        <th>Tgl Kedaluarsa</th>
                                        <th>Jumlah Produksi</th>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($productions as $production)
                                            @foreach($production->produk as $produk)
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $produk['nama_produk'] }}</td>
                                                <td>{{ $production->tanggal_produksi }}</td>
                                                <td>{{ $produk->pivot['tanggal_kedaluwarsa'] }}</td>
                                                <td>{{ $produk->pivot['jumlah_produksi'] }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tabel jumlah produk end -->
                </div>
            </div>
        </div>
        <!--Grafik Permintaan end-->
    </div>
@endsection