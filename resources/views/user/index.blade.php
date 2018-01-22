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
                        <div class="card">
                            <div class="header">Data Pengguna</div>
                            <div class="content">
                                <div class="toolbar">
                                    <a href="/user/create"
                                       class="btn btn-primary" type="button">Tambah Data</a>
                                </div>
                                <div class="fresh-datatables">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>Jabatan</th>
                                        <th>Status</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <?php $no = 1; ?>
                                            @foreach ($data as $row)
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row['nama'] }}</td>
                                                <td>{{ $row['alamat'] }}</td>
                                                <td>{{ $row['email'] }}</td>
                                                <td>{{ $row['level'] }}</td>
                                                <td>{{ $row['statusUser'] }}</td>
                                                <td class="text-right">
                                                    <a class="btn btn-simple btn-warning btn-icon table-action edit"
                                                       rel="tooltip" title="Ubah"
                                                       href="/user/update/{{ $row['id'] }}"><i
                                                                class="fa fa-edit"></i></a>
                                                    <button class="btn btn-simple btn-warning btn-icon table-action delete"
                                                            rel="tooltip" title="Nonaktifkan" data-id="{{ $row['id'] }}"><i
                                                                class="fa fa-times"></i></button>
                                                </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Data Reseller end-->
                </div>
            </div>
        </div>
        <!--Grafik Permintaan end-->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            console.log('windows Ready');
            $('.delete').click(function () {
                var id = $(this).attr('data-id');
                swal('ARE YOU SURE ?', 'DELETE ' + id, 'error')
            });
        });
    </script>
@endsection