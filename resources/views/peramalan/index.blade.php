@extends('layouts.pimpinanApp')

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
                    <a class="navbar-brand">Data Peramalan</a>
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
                        <div class="card">
                            <div class="header">Ramal Produk</div>
                            <div class="content">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <select name="produk" id="produk" class="form-control" required>
                                                <option selected disabled>Pilih Salah Satu</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->nama_produk }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <button type="submit" value="submit" id="ramal"
                                                    class="btn btn-fill btn-info">Ramal
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Data Reseller end-->
                </div>
                <div class="row">
                    <!-- Tabel jumlah produk -->
                    <section id="data">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">Hasil Peramalan</div>
                                <div class="content">
                                    <div class="fresh-datatables">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                            <th>#</th>
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah Produk</th>
                                            </thead>
                                            <tbody id="tabelProduk">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Tabel jumlah produk end -->
                </div>
            </div>
        </div>
        <!--Grafik Permintaan end-->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            console.log('Ready');
            $('#produk').change(function () {
                var produk = $(this).val();
                console.log(produk);
                $.get("/peramalan/requestData/"+produk, function (msg) {
                    $('#tabelProduk').html(msg)
                });
            });
            $('#ramal').click(function () {
                console.log('Ramal');
                var produk = $('#produk').val();
                $.ajax({
                    type    :   'POST',
                    headers :   {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url     :   '/peramalan',
                    data    :   {
                        'produk_id' : produk
                    }
                }).done(function (data) {
                    console.log(data);
                    if (data == 'sukses'){
                        swal('Sukses', 'Data berhasil diinputkan', 'success');
                    } else {
                        swal('Maaf', 'Data telah ada', 'error');
                    }
                });
            });
        });
    </script>
@endsection