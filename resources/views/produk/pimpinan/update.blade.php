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
                                    <a href="/" class="text-danger">
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
                    <div class="col-md-12">
                        <div class="card">
                            <form action="/produk/update/{{ $data['id'] }}" method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="header">Tambah Produk</div>
                                <div class="content">
                                    <div class="form-group">
                                        <label>Nama Produk</label>
                                        <input type="text" name="nama_produk" value="{{ $data['nama_produk'] }}" placeholder="masukkan nama produk"
                                               class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga (Rp.)</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <a> Rp.</a>
                                            </div>
                                            <input type="text" name="harga" value="{{ $data['harga'] }}" placeholder="masukkan harga"
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label></label>
                                        <button type="submit" value="submit" class="btn btn-fill btn-info">Simpan
                                        </button>
                                        <a href="/produk" class="btn btn-danger btn-fill ">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Data Reseller end-->

                </div>
            </div>
        </div>
        <!--Grafik Permintaan end-->
    </div>
@endsection