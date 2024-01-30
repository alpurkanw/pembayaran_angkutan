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
    <link rel="stylesheet" href="<?= base_url("assets/adminlte/"); ?>ionicons.min.css">
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
                        <button class="btn btn-info bg-gradient-blue">TAMBAH</button>
                    </div>
                </div> -->
                <?php if ($page == "index") {; ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-info">
                                <div class="card-header p-1">
                                    <h4>Update Angkutan</h4>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-2">

                                    <form action="<?= base_url("adm/CupdAng/searchAng") ?>" method="POST">




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
                                                        <button type="submit" class="btn btn-primary form_submit" name="form_submit">Cek Angkutan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                    </div>

                <?php

                } ?>



                <?php if ($page == "respons") {; ?>

                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-info">
                                <div class="card-header p-1">
                                    <h4>Update Angkutan</h4>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-2">

                                    <form action="<?= base_url("adm/CupdAng/searchAng") ?>" method="POST">




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
                                                        <button type="submit" class="btn btn-primary form_submit" name="form_submit">Cek Angkutan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-12">
                            <?= $this->session->flashdata('pesan'); ?>
                            <div class="card card-outline card-info">
                                <div class="card-header p-1">
                                    <h5>List Angkutan <br>Nama Sopir : <strong><?= $_SESSION["namaspr"]; ?></strong> </h5>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-2">

                                    <table id="list_user" class="table table-sm table-bordered table-striped  " role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Kode Angkutan</th>
                                                <th>Nama Sopir</th>
                                                <th>Tanggal Angkutan</th>
                                                <th>Nama PIC</th>
                                                <th>material</th>
                                                <th>Kubikasi</th>
                                                <th>Biaya Angkut Per Kubik</th>
                                                <th>Total biya Angk </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($angs as $key => $ang) {
                                            ?>
                                                <tr role="row" class="odd">
                                                    <td><?= substr("000000" . $ang->id, -6); ?></td>
                                                    <td><?= $ang->namaspr; ?></td>
                                                    <td><?= substr($ang->tglangkut, 0, 4) . "-" . substr($ang->tglangkut, 4, 2) . "-" . substr($ang->tglangkut,  -2); ?></td>
                                                    <td><?= $ang->namapic; ?></td>
                                                    <td><?= $ang->namamat; ?></td>
                                                    <td><?= (strpos($ang->jum_kubikasi, '.')) ? $ang->jum_kubikasi : number_format($ang->jum_kubikasi); ?></td>
                                                    <td><?= number_format($ang->upah_ang_per_kubik); ?></td>
                                                    <td><?= number_format($ang->jum_kubikasi * $ang->upah_ang_per_kubik); ?></td>
                                                    <td>


                                                        <a data-idang="<?= $ang->id; ?>" data-namapic="<?= $ang->namapic; ?>" data-namaspr="<?= $ang->namaspr; ?>" data-namamat="<?= $ang->namamat; ?>" data-kubikasi="<?= $ang->jum_kubikasi; ?>" data-tgl="<?= $ang->tglangkut; ?>" href="#" class="btn btn-sm btn-primary bg-gradient btn_open_mdl_updAng">Update Angkutan</a>

                                                    </td>


                                                </tr>
                                            <?php
                                            }; ?>




                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                    </div>

                <?php

                } ?>




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




    <!-- Modal -->
    <div class="modal fade" id="mdl_updAng" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="card card-outline card-primary text_sm">
                    <div class="card-header p-2 bg-primary text-light">
                        Detail Angkutan
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="form_update" action="<?= base_url("adm/CupdAng/prosesUpd"); ?>" method="POST">
                        <div class="card-body">

                            <div class=" form-group mb-3 shadow-sm">
                                <label for="exampleInputEmail1">MATERIAL</label>
                                <input type="hidden" name="idang" class="form-control idang" readonly>
                                <input type="text" name="namamat" class="form-control namamat" readonly>
                            </div>
                            <div class=" form-group mb-3 shadow-sm">
                                <label for="exampleInputPassword1">SOPIR</label>
                                <input type="text" name="namaspr" class="form-control namaspr" readonly>
                            </div>
                            <div class=" form-group mb-3 shadow-sm">
                                <label for="exampleInputPassword1">PIC</label>
                                <input type="text" name="namapic" class="form-control namapic" readonly>
                            </div>
                            <div class=" form-group mb-3 shadow-sm">
                                <label for="exampleInputPassword1">KUBIKASI</label> (Gunakan titik untuk menggganti koma)
                                <input type="text" name="kubikasi" class="form-control kubikasi" autocomplete="false" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                            </div>
                            <div class=" form-group mb-3 shadow-sm">
                                <label for="exampleInputPassword1">BIAYA ANGKUT PER KUBIK</label>
                                <input type="text" name="biaya_ang_per_kubik" class="form-control biaya_ang_per_kubik" autocomplete="off">
                            </div>
                            <div class=" form-group mb-3 shadow-sm">
                                <label for="exampleInputPassword1">TOTAL BIAYA ANGKUT</label>
                                <input type="text" name="tot_biaya_ang" class="form-control tot_biaya_ang" readonly>
                            </div>
                            <div class=" form-group mb-3 shadow-sm">
                                <label for="exampleInputPassword1">HARGA MATERIAL PER KUBIK</label>
                                <input type="text" name="harga_mat_per_kubik" class="form-control tot_harga" autocomplete="off">
                            </div>
                            <div class=" form-group mb-3 shadow-sm">
                                <label for="exampleInputPassword1">TOTAL HARGA METERIAL</label>
                                <input type="text" name="tot_harga_mat" class="form-control tot_harga_mar" readonly>
                            </div>



                            <div class="row ">
                                <div class="col">
                                </div>
                                <div class="col text-right">
                                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">BATAL</button>
                                    <button type="submit" class="btn btn-primary btn_update_angkutan">UPDATE</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>





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
            $("#list_user").DataTable();

            $('.btn_submit').click(function() {
                $('.form_submit').submit();

            });

            $(".btn_open_mdl_updAng").on("click", function() {

                $("#mdl_updAng .idang").val($(this).data("idang"));
                $("#mdl_updAng .namamat").val($(this).data("namamat"));
                $("#mdl_updAng .namaspr").val($(this).data("namaspr"));
                $("#mdl_updAng .namapic").val($(this).data("namapic"));


                $("#mdl_updAng .kubikasi").val($(this).data("kubikasi"));



                $("#mdl_updAng").modal("toggle");
            });

            $('#mdl_updAng').on('shown.bs.modal', function() {
                $("#mdl_updAng .kubikasi").focus()
                // $(".biaya_ang_per_kubik").attr('autocomplete', 'false');

                $(".biaya_ang_per_kubik").keyup(function() {
                    // alert($(this).val());
                    // return;

                    var kubikasi = ($(".kubikasi").val().includes(',')) ? $(".kubikasi").val().replace(/,/g, '.') : $(".kubikasi").val();
                    // alert(kubikasi)
                    // return
                    $(".tot_biaya_ang").val(number_formatjs((kubikasi * $(this).val())))
                });

                $(".tot_harga").keyup(function() {
                    // alert($(this).val());
                    // return;
                    var kubikasi = ($(".kubikasi").val().includes(',')) ? $(".kubikasi").val().replace(/,/g, '.') : $(".kubikasi").val();

                    $(".tot_harga_mar").val(number_formatjs(kubikasi * $(this).val()))
                });


                // $("#$("#mdl_updAng .namamat")")
                // console.log('Modal ditampilkan');
                // Tambahkan kode khusus setelah modal ditampilkan di sini
            });

            function number_formatjs(number) {
                // Menggunakan toLocaleString untuk memformat angka dengan penanda koma untuk ribuan
                const formattedNumber = number.toLocaleString('en-US');

                return formattedNumber;
            }

        });
    </script>
</body>

</html>