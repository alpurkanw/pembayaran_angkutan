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

                <!-- <div class="row mb-2">
                    <div class="col text-right">
                        <button class="btn btn-info -blue">TAMBAH</button>
                    </div>
                </div> -->
                <?php if ($page == "getparam") {; ?>
                    <h4>Laporan Pembayaran Sopir</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-info">
                                <div class="card-header p-2">
                                    <h5>Parameter</h5>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-2">

                                    <form action="<?= base_url("adm/Claporan/pemPerSopir/proses") ?>" method="POST">
                                        <div class="row">
                                            <div class="col">
                                                <input type="date" class="form-control" id="tglawal" name="tglawal">
                                            </div>
                                            <div class="col">
                                                <input type="date" class="form-control" id="tglakhir" name="tglakhir">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
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
                                        </div>
                                        <div class="row">

                                            <div class="col text-right">

                                                <button type="submit" class="btn btn-primary form_submit" name="form_submit">Submit</button>

                                            </div>
                                        </div>

                                    </form>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                    </div>


                <?php }
                if ($page == "respons") {; ?>


                    <div class="row mb-2">
                        <div class="col-12 text-right">

                            <a href="<?= base_url("adm/Claporan/pemPerSopir"); ?>" class="btn  btn-primary ">
                                Kembali</a>

                            <a href="#" class="btn  btn-primary btn_print " target="_blank">
                                Print</a>
                        </div>
                    </div>
                    <div class="row data_angkutan">
                        <div class="col-12">
                            <div class="card card-outline card-info">
                                <?php if (count($angks)  !== 0) { ?>
                                    <div class="card-header p-1">
                                        <h5>Laporan Pembayaran Angkutan Per Sopir<br> </h5>
                                        <h6>Nama Sopir : <strong><?= ($namaSpr == "0")? "SEMUA SOPIR":$namaSpr ;; ?></strong></h6>

                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-2">

                                        <table id="list_user" class="table table-sm table-bordered table-striped   " role="grid" aria-describedby="example1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>No </th>
                                                    <th>Kode Angkutan</th>
                                                    <th>Nama Sopir</th>
                                                    <th>Tanggal Angkutan</th>
                                                    <th>Nama PIC</th>
                                                    <th>material</th>
                                                    <th>Kubikasi</th>
                                                    <th>Harga Material Perkubik</th>
                                                    <th>Total Total Harga </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $subtotal = 0 ;
                                                $total = 0;
                                                foreach ($angks as $key => $ang) {
                                                $subtotal = $ang->jum_kubikasi * $ang->hargaperkubik;    
                                                ?>
                                                    <tr role="row" class="odd">
                                                        <td><?= $i; ?></td>
                                                        <td><?= substr("000000" . $ang->id, -6); ?></td>
                                                        <td><?= $ang->namaspr; ?></td>
                                                        <td><?= substr($ang->tglangkut, 0, 4) . "-" . substr($ang->tglangkut, 4, 2) . "-" . substr($ang->tglangkut,  -2); ?></td>
                                                        <td><?= $ang->namapic; ?></td>
                                                        <td><?= $ang->namamat; ?></td>
                                                        <td><?= (float)$ang->jum_kubikasi; ?></td>
                                                        <td><?= number_format( $ang->hargaperkubik); ?></td>
                                                        <td class="text-right"><?= number_format($subtotal); ?></td>


                                                    </tr>
                                                <?php
                                                    $total += $subtotal; 
                                                    $i++;
                                                }; ?>




                                            </tbody>
                                            <tfoot>
                                                <tr class="text-right">
                                                    <th colspan = "8" >
                                                        GRAND TOTAL
                                                    </th>
                                                    <th>
                                                        <?= number_format($total);?>
                                                    </th>
                                                </tr>
                                            </tfoot>

                                        </table>
                                    </div>

                                <?php } else {
                                ?>
                                    <div class="card-body">
                                        Data Tidak DITEMUKAN
                                    </div>
                                <?php
                                }; ?>
                                <!-- /.card-body -->
                            </div>
                        </div>

                    </div>

                <?php };
                if ($page == "f_update") {; ?>


                <?php }; ?>




                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

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
    <script>
        $(document).ready(function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            // alert(today)
            // return;
            $("#tglawal").val(today);
            $("#tglakhir").val(today);


            $(".btn_print").click(function() {

                var classToCopy = $(".data_angkutan").html()

                // Membuka jendela baru dan menambahkan elemen dengan class yang disalin
                var newWindow = window.open('', '_blank');
                newWindow.document.write(`<!DOCTYPE html>
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
                                            <!-- Site wrapper -->
                                            <div class="wrapper">
                                            
                                            `);
                newWindow.document.write(classToCopy);
                newWindow.document.write(` </div></body></html>`);
                newWindow.document.close();

            })



        });
    </script>
</body>

</html>