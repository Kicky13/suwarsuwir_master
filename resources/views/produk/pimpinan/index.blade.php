@extends('layouts.pimpinanApp')

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
                    <a class="navbar-brand">Data Produk</a>
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
                                    <a href="/produk/create"
                                       class="btn btn-primary" type="button">Tambah Data</a>
                                </div>
                                <div class="fresh-datatables">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <th>ID</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $product->nama_produk }}</td>
                                                <td>{{ $product->harga }}</td>
                                                <td class="text-right">
                                                    <a class="btn btn-simple btn-warning btn-icon table-action edit"
                                                       rel="tooltip" title="Ubah"
                                                       href="/produk/update/{{ $product->id }}"><i class="fa fa-edit"></i></a>
                                                    <a class="btn btn-simple btn-warning btn-icon table-action delete"
                                                       rel="tooltip" title="Hapus"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
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