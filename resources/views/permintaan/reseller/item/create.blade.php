@extends('layouts.resellerApp')

@section('addedMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">Tambah Permintaan</div>
                            <div class="content">
                                <div class="form-group">
                                    <label>Produk</label>
                                    <select id="produk_id" class="form-control" required>
                                        <option selected disabled>Pilih Salah Satu</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product['id'] }}">{{ $product['nama_produk'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah (Kg)</label>
                                    <div class="input-group">
                                        <input type="number" id="jumlah_permintaan" placeholder="masukkan jumlah" class="form-control" required>
                                        <input type="hidden" id="permintaan_id" value="{{ $id }}">
                                        <div class="input-group-addon">
                                            <a>kg</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <button type="submit" id="submit" value="submit" class="btn btn-fill btn-info">Simpan
                                    </button>
                                    <a href="/permintaan" class="btn btn-danger btn-fill ">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- form tambah jumlah produk end-->
                </div>
            </div>
        </div>
        <!--Grafik Permintaan end-->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            console.log('ready');
            $('#submit').click(function () {
                console.log('submit');
                var permintaan_id = $('#permintaan_id').val();
                var produk_id = $('#produk_id').val();
                var jumlah_permintaan = $('#jumlah_permintaan').val();
                $.ajax({
                    type        :   'POST',
                    headers     :   {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url         :   '/permintaan/create',
                    data        :   {
                        '_token' : '{{ csrf_token() }}',
                        'permintaan_id' : permintaan_id,
                        'produk_id' : produk_id,
                        'jumlah_permintaan' : jumlah_permintaan
                    }
                }).done(function (data) {
                    console.log(data);
                    swal('SUKSES', 'Data berhasil di entry!!', 'success');
                    swal({
                            title: "SUKSES",
                            text: "Item berhasil ditambahkan",
                            type: "success"
                        },
                        function(){
                            window.location.replace('/permintaan/item/'+permintaan_id);
                        });
                });
            });
        });
    </script>
@endsection