<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Nota Pembayaran Customer</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte/") ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte/") ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">



            <div class="row data_angkutan">
                <div class="col-12">
                    <div class="card card-outline card-info">
                        <?php if (count($trxangks)  !== 0) { ?>
                            <div class="card-header p-1">
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-auto">Tanggal :</div>
                                                <div class="col-auto"><?= $trxByrs[0]->tgltrx; ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-auto">User :</div>
                                                <div class="col-auto"><?= $trxByrs[0]->userinp; ?></div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="row">
                                                <div class="col  ">
                                                    <strong>NOTA PEMBAYARAN SOPIR</strong>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-auto">No Nota :</div>
                                                <div class="col-auto"><?= substr("000000" . $trxByrs[0]->id, -8);  ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-auto">SOPIR :</div>
                                                <div class="col-auto"><?= $trxangks[0]->namapic; ?></div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
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
                                            <th>Material Per Kubikasi</th>
                                            <th>Total Harga </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($trxangks as $key => $ang) {
                                        ?>
                                            <tr role="row" class="odd">
                                                <td><?= $i; ?></td>
                                                <td><?= substr("000000" . $ang->id, -6); ?></td>
                                                <td><?= $ang->namaspr; ?></td>
                                                <td><?= substr($ang->tglangkut, 0, 4) . "-" . substr($ang->tglangkut, 4, 2) . "-" . substr($ang->tglangkut,  -2); ?></td>
                                                <td><?= $ang->namapic; ?></td>
                                                <td><?= $ang->namamat; ?></td>
                                                <td><?= (float)$ang->jum_kubikasi; ?></td>
                                                <td><?= number_format($ang->hargaperkubik); ?></td>
                                                <td><?= number_format(($ang->jum_kubikasi * $ang->hargaperkubik), 2); ?></td>



                                            </tr>
                                        <?php
                                            $i++;
                                        }; ?>




                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="8" class="text-right">
                                                TOTAL BIAYA ANGKUT
                                            </th>
                                            <th><?=
                                                number_format(json_decode($trxByrs[0]->datatrx, FALSE)->total_harga, 2);
                                                ?></th>
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
        </div>
        <!-- /.content-wrapper -->


    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url("assets/adminlte/") ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url("assets/adminlte/") ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url("assets/adminlte/") ?>dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            // window.print();
        })
    </script>
</body>

</html>