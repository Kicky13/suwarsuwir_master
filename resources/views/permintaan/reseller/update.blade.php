@extends('layouts.resellerApp')

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
                    <a class="navbar-brand">Data Permintaan</a>
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
                    <!-- form tambah jumlah produk-->
                    <form action="/permintaan/update/{{ $data['id'] }}" method="post">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">Tambah Permintaan</div>
                                <div class="content">
                                    <div class="form-group">
                                        <label>Produk</label>
                                        <select id="produk_id" name="produk_id" class="form-control" required>
                                            <option selected disabled>Pilih Salah Satu</option>
                                            @foreach($produk as $row)
                                                <option {{ ($data['produk_id'] == $row['id']) ? "selected" : "" }} value="{{ $row['id'] }}">{{ $row['nama_produk'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah (Kg)</label>
                                        <div class="input-group">
                                            <input value="{{ $data['jumlah_permintaan'] }}" type="number" name="jumlah_permintaan" id="jumlah_permintaan" placeholder="masukkan jumlah"
                                                   class="form-control" required>
                                            <div class="input-group-addon">
                                                <a>kg</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label></label>
                                        <button type="submit" id="submit" value="submit" class="btn btn-fill btn-info">
                                            Simpan
                                        </button>
                                        <a href="/permintaan" class="btn btn-danger btn-fill ">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- form tambah jumlah produk end-->
                </div>
            </div>
        </div>
        <!--Grafik Permintaan end-->
    </div>
@endsection