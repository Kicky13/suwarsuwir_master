@extends('layouts.kasirApp')

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

                    <!-- Tabel jumlah produk -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">Data Permintaan</div>
                            <div class="content">
                                <div class="fresh-datatables">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <th>#</th>
                                        <th>Nama Pemesan</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Jumlah Produk</th>
                                        <th>Status</th>
                                        <th class="disabled-sorting text-center">Actions</th>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $order->user['nama'] }}</td>
                                                <td>{{ $order->tanggal_permintaan }}</td>
                                                <td>{{ count($order->produk) }}</td>
                                                <td>{{ $order->validasi->status_validasi }}</td>
                                                <td class="text-center">
                                                    <section {{ ($order->validasi_id == 1) ? "" : "hidden" }}>
                                                        <a class="btn btn-simple btn-info btn-icon table-action view"
                                                           rel="tooltip" title="Lihat Detail"
                                                           href="/permintaan/item/{{ $order->id }}"><i class="fa fa-eye"></i></a>
                                                        <a class="btn btn-simple btn-danger btn-icon table-action edit"
                                                           rel="tooltip" title="Tolak Permintaan"
                                                           href="/permintaan/validasi/{{ $order->id }}/2"><i class="fa fa-times"></i></a>
                                                        <a class="btn btn-simple btn-success btn-icon table-action edit"
                                                           rel="tooltip" title="Validasi Permintaan"
                                                           href="/permintaan/validasi/{{ $order->id }}/3"><i class="fa fa-check"></i></a>
                                                    </section>
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

@section('script')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
            //Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
            //Money Euro
            $("[data-mask]").inputmask();

            //Date range picker
            $('#reservation').daterangepicker();
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                format: 'MM/DD/YYYY h:mm A'
            });
            //Date range as a button
            $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function (start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
            );

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });
            $('#datepicker2').datepicker({
                autoclose: true
            });
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            //Colorpicker
            $(".my-colorpicker1").colorpicker();
            //color picker with addon
            $(".my-colorpicker2").colorpicker();

            //Timepicker
            $(".timepicker").timepicker({
                showInputs: false
            });
        });
    </script>
@endsection