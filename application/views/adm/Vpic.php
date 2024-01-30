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
                <?php if ($show == "index") {; ?>
                    <div class="row mb-2">
                        <div class="col-12 text-right">

                            <a href="<?= base_url("adm/Cpic/Ftambah"); ?>" class="btn  btn-success bg-gradient">
                                <i class="fa-solid fa-square-plus"></i>
                                Tambah PIC</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-info">
                                <div class="card-header p-1">
                                    <h4>List PIC</h4>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-2">
                                    <?= $this->session->flashdata('pesan'); ?>

                                    <table id="list_user" class="table table-sm table-bordered table-striped  " role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th>ID</th>
                                                <th>Nama PIC</th>
                                                <!-- <th>Alamat</th>
                                                <th>Notelp</th>
                                                <th>Ket</th> -->
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pics as $key => $pic) {
                                            ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $pic->id; ?></td>
                                                    <td><?= $pic->nama; ?></td>
                                                    <!-- <td><?= $pic->alamat; ?></td>
                                                    <td><?= $pic->notelp; ?></td>
                                                    <td><?= $pic->ket; ?></td> -->
                                                    <td>


                                                        <a href="<?= base_url("adm/Cpic/delete/$pic->id") ?>" class="btn btn-sm btn-danger bg-gradient" onclick="return confirm('Konfirmasi Delete Kode PIC: <?= $pic->id;  ?>?')">Delete</a>
                                                        <a href="<?= base_url("adm/Cpic/fUpdate/$pic->id") ?>" class="btn btn-sm btn-warning bg-gradient">Update</a>




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
                <?php }
                if ($show == "form_tambah") {; ?>

                    <div class="row">
                        <div class="col-12">
                            <?= $this->session->flashdata('pesan'); ?>
                            <div class="card card-outline card-info">
                                <div class="card-header p-1">
                                    <h3>Tambah PIC</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-2">

                                    <form action="<?= base_url("adm/Cpic/addProc") ?>" method="POST">
                                        <div class="modal-body">

                                            <!-- <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label text-right">Kode PIC</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="kodelok" class="form-control" id="inputEmail3" placeholder="Kode PIC ">
                                                    
                                                </div>
                                            </div> -->

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label text-right">Nama PIC</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="nama" class="form-control" id="inputEmail3" placeholder="Nama PIC ">
                                                    <?= form_error('namalok', '<div class="text-danger pl-1">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label text-right">Alamat PIC</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="alamat" class="form-control" id="inputEmail3" placeholder="Alamat PIC ">
                                                    <?= form_error('namalok', '<div class="text-danger pl-1">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label text-right">Notelp PIC</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="notelp" class="form-control" id="inputEmail3" placeholder="Notelp PIC ">
                                                    <?= form_error('namalok', '<div class="text-danger pl-1">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label text-right">Keterangan</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="ket" class="form-control" id="inputEmail3" placeholder="Keterangan">
                                                </div>
                                            </div> -->


                                        </div>

                                        <div class="modal-footer ">
                                            <div class="row">
                                                <div class="col-12 ">

                                                    <a href="<?= base_url("adm/Cpic"); ?>" class="btn btn-info">Kembali</a>
                                                    <button type="submit" class="btn btn-success form_submit" name="form_submit">Tambahkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                    </div>
                <?php };
                if ($show == "f_update") {; ?>

                    <div class="row">
                        <div class="col-12">
                            <?= $this->session->flashdata('pesan'); ?>
                            <div class="card card-outline card-info">
                                <div class="card-header p-1">
                                    <h3>Update PIC</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-2">

                                    <form action="<?= base_url("adm/Cpic/updProc/") . $lok[0]->id; ?>" method="POST">
                                        <div class="modal-body">

                                            <!-- <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label text-right">Kode PIC</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="kodelok" class="form-control" value="<?= $lok[0]->kodelok; ?>" readonly>
                                                </div>
                                            </div> -->

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label text-right"> Nama PIC</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="nama" class="form-control" value="<?= $lok[0]->nama; ?>">
                                                </div>
                                            </div>
                                            <!-- <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label text-right"> Alamat PIC</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="alamat" class="form-control" value="<?= $lok[0]->alamat; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label text-right"> notelp PIC</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="notelp" class="form-control" value="<?= $lok[0]->notelp; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label text-right">Keterangan</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="ket" class="form-control" value="<?= $lok[0]->ket; ?>">
                                                </div>
                                            </div>
 -->

                                        </div>

                                        <div class="modal-footer ">
                                            <div class="row">
                                                <div class="col-12 ">

                                                    <a href="<?= base_url("adm/Cpic"); ?>" class="btn btn-info">Kembali</a>
                                                    <button type="submit" class="btn btn-success form_submit" name="form_submit">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                    </div>
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
            $("#list_user").DataTable();

            $('.btn_submit').click(function() {
                $('.form_submit').submit();

            });
        });
    </script>
</body>

</html>