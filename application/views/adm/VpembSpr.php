<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $judul; ?> </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte/") ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="<?= base_url("assets/adminlte/"); ?>ionicons.min.css"> -->
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte/") ?>dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte/") ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url("assets/adminlte/") ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="baseUrl" data-url="<?= base_url(); ?>"></div>
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php $this->load->view("adm/Tmp_navbar_top"); ?>
        <!-- /.navbar -->

        <?php $this->load->view("adm/Tmp_side_menu"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper pt-2">




            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col">
                        <h5>Transaksi Pembayaran Sopir</h5>
                    </div>
                </div>

                <div class="row">

                    <div class="col-8 dsp_8">

                        <div class="card card-outline card-primary card_barang">
                            <div class="card-header p-2">
                                Pilih Sopir
                            </div>
                            <div class="card-body p-2">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <div class="col-7">
                                                <div class="form-group">
                                                    <select class="form-control" id="namaSopir" name="namaSopir">
                                                        <option value="0" selected>SEMUA SOPIR</option>
                                                        <?php
                                                        foreach ($sprs as $key => $spr) {
                                                        ?>

                                                            <option value='<?= $spr->nama; ?>'><?= $spr->nama; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-primary btn_pilih_spr" name="form_submit">Ambil Angkutan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                        </div>


                        <div class="card card-outline card-primary card_barang">
                            <div class="card-header p-2">
                                List Angkutan
                            </div>
                            <div class="card-body p-2">

                                <!-- <div class="card">
                                    <div class="card-body py-2">
                                        sdsd
                                    </div>
                                </div> -->

                                <table id="list_lap_bar" class="table table-sm table-bordered   ">
                                    <thead class="bg-primary">
                                        <tr role="row" class="">
                                            <th>
                                                kode Angkutan
                                                <br>
                                                Tanggal Angkut
                                            </th>
                                            <th>Sopir </Br> PIC <br> Tujuan <br> Material</th>
                                            <th>Jumlah Kubikasi <br> Angkut Per Kubik <br>
                                                Material Per Kubik
                                            </th>
                                            <th>Total Biaya Angkut</th>
                                            <th>Total Harga Material</th>
                                        </tr>
                                    </thead>
                                    <tbody class="t_body">

                                        <tr>
                                            <td colspan="4">Pilih Sopir untuk melihat list angkutan

                                            </td>

                                        </tr>



                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->

                        </div>

                    </div>
                    <div class="col-4 dsp_4">
                        <div class="card card-outline card-primary">
                            <div class="card-header p-2">
                                Angkutan yang akan dibayar
                            </div>
                            <div class="card-body p-2">
                                <div class="info-box bg-primary shadow mb-2">

                                    <div class="info-box-content p-1">
                                        <div class="row">
                                            <div class="col">

                                            </div>
                                            <div class="col text-right">
                                                <span class="info-box-text">TOTAL</span>
                                                <span class="info-box-number h5">
                                                    0 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <div class="card card_list_angk">
                                    <div class="card-body p-2">
                                        <div class="row font-weight-bold">
                                            <div class="col"></div>
                                            <div class="col-3 text-right"></div>
                                        </div>
                                        Data Masih Kosong

                                    </div>
                                </div>

                                <button class="btn btn-primary btn-block ">Submit</button>
                            </div>
                            <!-- /.card-body -->

                        </div>
                    </div>

                </div>




            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Modal -->
        <div class="modal fade" id="mdl_pickupBar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card card-outline card-primary">
                        <div class="card-header p-2">
                            Form Tambah DO
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="quickForm" novalidate="novalidate">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">NAMA BARANG</label>
                                    <input type="hidden" name="idbar" class="form-control idbar" readonly>
                                    <input type="text" name="namabar" class="form-control namabar" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">HARGA JUAL</label>
                                    <input type="text" name="harga_jual" class="form-control harga_jual" readonly>
                                    <input type="hidden" name="harga_beli" class="form-control harga_beli" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">JUMLAH PERMINTAAN</label>
                                    <input type="number" name="jum_minta" class="form-control jum_minta " placeholder="Masukkan JUMLAH PERMINTAANsss" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">TOTAL HARGA</label>
                                    <input type="text" name="tot_harga" class="form-control tot_harga" readonly>
                                </div>
                                <!-- <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                        <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                                    </div>
                                </div> -->
                                <button type="button" class="btn btn-primary btn_sbmt_barang">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>



        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.5
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="<?= base_url("assets/adminlte/") ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url("assets/adminlte/") ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url("assets/adminlte/") ?>dist/js/adminlte.min.js"></script>
    <script src="<?= base_url("assets/adminlte/") ?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="<?= base_url("assets/adminlte/") ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url("assets/adminlte/") ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url("assets/adminlte/") ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url("assets/adminlte/") ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url("assets/adminlte/") ?>dist/js/demo.js"></script>

    <!-- custom by aal -->
    <script src="<?= base_url("assets/") ?>bayarspr.js"></script>
    <script>
        $(document).ready(function() {
            // $('.card_barang').show();
            // $('.card_cust').hide();


            // $('#list_lap_bar').DataTable();
            // $(".btn_show_bar").on("click", function() {
            //     $('.card_barang').show();
            //     $('.card_cust').hide();
            // })



            // $('#list_cust').DataTable();
            // $(".btn_show_cust").on("click", function() {
            //     $('.card_barang').hide();
            //     $('.card_cust').show()
            // })




            // $('.btn_submit').click(function() {
            //     $('.form_submit').submit();

            // });
        });
    </script>
</body>

</html>