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
                    <a class="navbar-brand">Data Pengguna</a>
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
                    <div class="col-md-12">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    <span>{{ $error }}</span>
                                </div>
                            @endforeach
                        @endif
                        <div class="card">
                            <form action="/user/update/{{ $data['id'] }}" method="post">
                                {{ csrf_field() }}
                                <div class="header">Tambah Pengguna</div>
                                <div class="content">
                                    <div class="form-group">
                                        <label>Nama Pengguna</label>
                                        <input type="text" name="nama" value="{{ $data['nama'] }}" placeholder="masukkan nama pengguna"
                                               class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" name="alamat" value="{{ $data['alamat'] }}" placeholder="masukkan alamat"
                                               class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" value="{{ $data['email'] }}" placeholder="masukkan email"
                                               class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" placeholder="Kosongi Password apabila tidak perlu dirubah"
                                               class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <select name="level" class="form-control" required>
                                            <option selected disabled>Pilih Salah Satu</option>
                                            @foreach ($level as $item)
                                                <option {{ ($data['idLevel'] == $item->id) ? "selected" : "" }} value="{{ $item->id }}">{{ $item->level }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label></label>
                                        <button type="submit" value="submit" class="btn btn-fill btn-info">Simpan
                                        </button>
                                        <a href="/user"
                                           class="btn btn-danger btn-fill ">Kembali</a>
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
