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


                <?php if ($show == "index") {; ?>

                    <div class="row mb-2">
                        <div class="col-12 text-right">

                            <a href="<?= base_url("adm/Cuser/Ftambah"); ?>" class="btn  btn-success bg-gradient">
                                <i class="fa-solid fa-square-plus"></i>
                                Tambah Petugas</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-info">
                                <div class="card-header p-1">
                                    <h4>List User</h4>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-2">
                                    <?= $this->session->flashdata('pesan'); ?>

                                    <table id="list_user" class="table table-sm table-bordered table-striped  " role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th>NIP</th>
                                                <th>Username</th>
                                                <th>Nama User</th>
                                                <th>Email</th>
                                                <th>Level</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($users as $key => $user) {
                                            ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $user->nip; ?></td>
                                                    <td><?= $user->usernm; ?></td>
                                                    <td><?= $user->nama; ?></td>
                                                    <td><?= $user->email; ?></td>

                                                    <td>
                                                        <?php
                                                        if ($user->level == 1) {
                                                        ?>Admin
                                                    <?php } else if ($user->level == 2) {
                                                    ?>
                                                        Approval
                                                    <?php } else
                                                        if ($user->level == 3) {
                                                    ?>
                                                        PIC
                                                    <?php } else
                                                        if ($user->level == 4) {
                                                    ?>
                                                        Maker
                                                    <?php } else { ?>
                                                        Not Register
                                                    <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?= ($user->sts_app == 1) ? "Active" : "Not Active"; ?>

                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url("adm/Cuser/delUser/$user->id") ?>" class="btn btn-sm btn-danger bg-gradient" onclick="return confirm('Konfirmasi Delete user: <?= $user->nama;  ?>?')">Delete</a>
                                                        <a href="<?= base_url("adm/Cuser/Fupdate/$user->id") ?>" class="btn btn-sm btn-warning bg-gradient">Update</a>

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
                if ($show == "Fupdate") {; ?>

                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-info">
                                <div class="card-header p-1">
                                    <h4>Update User </h4>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-8">

                                            <div class="card ">
                                                <div class="card-body box-profile">
                                                    <form action="<?= base_url("adm/Cuser/updUserProc/"); ?>" method="POST">

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Username</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="usernm" class="form-control" value="<?= $user[0]->usernm; ?>">
                                                                <?= form_error('usernm', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">NIP</label>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="id" class="form-control" value="<?= $user[0]->id; ?>">
                                                                <input type="text" name="nip" class="form-control" value="<?= $user[0]->nip; ?>">
                                                                <?= form_error('nip', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Nama</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="nama" class="form-control" value="<?= $user[0]->nama; ?>">
                                                                <?= form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Email</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="email" class="form-control" value="<?= $user[0]->email; ?>">
                                                                <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">No Telp</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="notelp" class="form-control" value="<?= $user[0]->notelp; ?>">
                                                                <?= form_error('notelp', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class=" form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Lokasi Penempatan</label>
                                                            <div class="col-sm-9">
                                                                <select name="lokid" id="lokasi" class="form-control">
                                                                    <option value="">.:Pilih Lokasi :.</option>
                                                                    <?php foreach ($loks as $key => $lok) { ?>

                                                                        <option value="<?= $lok->id; ?>" <?= ($lok->id == $user[0]->lokid) ? "selected" : ""; ?>><?= $lok->id . "-" . $lok->namalok; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <?= form_error('lokasi', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class=" form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Lenis Kelamin</label>
                                                            <div class="col-sm-9">
                                                                <select name="jk" id="level" class="form-control">
                                                                    <option value="">.:Pilih Jenis Kelamin :.</option>
                                                                    <option value="1" <?= (1 == $user[0]->jk) ? "selected" : ""; ?>>Laki - laki</option>
                                                                    <option value="2" <?= (2 == $user[0]->jk) ? "selected" : ""; ?>>Perempuan</option>
                                                                </select>
                                                                <?= form_error('jk', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class=" form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Status</label>
                                                            <div class="col-sm-9">
                                                                <select name="sts_app" id="level" class="form-control">
                                                                    <option value="">.:Pilih Aktif/ Non Aktif :.</option>
                                                                    <option value="1" <?= (1 == $user[0]->sts_app) ? "selected" : ""; ?>>Aktive</option>
                                                                    <option value="0" <?= (0 == $user[0]->sts_app) ? "selected" : ""; ?>>Non Aktive</option>
                                                                </select>
                                                                <?= form_error('jk', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class=" form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Jabatan</label>
                                                            <div class="col-sm-9">
                                                                <select name="level" id="level" class="form-control">
                                                                    <option value="">.:Pilih Jabatan :.</option>
                                                                    <option value="4" <?= ($user[0]->level == 4) ? "selected" : ""; ?>>Maker</option>
                                                                    <option value="3" <?= ($user[0]->level == 3) ? "selected" : ""; ?>>PIC</option>
                                                                    <option value="2" <?= ($user[0]->level == 2) ? "selected" : ""; ?>>Approval</option>
                                                                    <option value="1" <?= ($user[0]->level == 1) ? "selected" : ""; ?>>Admin</option>
                                                                </select>
                                                                <?= form_error('level', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Alamat </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="alamat" class="form-control" value="<?= $user[0]->alamat; ?>">
                                                                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>

                                                        <div class=" modal-footer ">
                                                            <div class=" row">
                                                                <div class="col-12 ">

                                                                    <a href="<?= base_url("adm/Cuser"); ?>" class="btn btn-info">Kembali</a>
                                                                    <button type="submit" class="btn btn-success form_submit" name="form_submit">Update</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>



                                        </div>
                                        <div class="col-4">
                                            <div class="card ">
                                                <div class="card-body box-profile">
                                                    <div class="text-center">
                                                        <img class="img img-bordered" style="max-width: 250px;" src="<?= base_url("assets/image/"); ?>blankUser.png">
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                    </div>


                <?php };
                if ($show == "ftambah") {; ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-info">
                                <div class="card-header p-1">
                                    <h4>Tambah User </h4>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-2">
                                    <?= $this->session->flashdata('pesan'); ?>
                                    <div class="row">

                                        <div class="col-8">

                                            <div class="card ">
                                                <div class="card-body box-profile">
                                                    <form action="<?= base_url("adm/Cuser/addUserProc/"); ?>" method="POST">

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Username</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="usernm" class="form-control" value="<?= set_value('usernm'); ?>">
                                                                <?= form_error('usernm', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">NIP</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="nip" class="form-control" value="<?= set_value('nip'); ?>">
                                                                <?= form_error('nip', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Nama</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="nama" class="form-control" value="<?= set_value('nama'); ?>">
                                                                <?= form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Email</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="email" class="form-control" value="<?= set_value('email'); ?>">
                                                                <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">No Telp</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="notelp" class="form-control" value="<?= set_value('notelp'); ?>">
                                                                <?= form_error('notelp', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class=" form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Lokasi Penempatan</label>
                                                            <div class="col-sm-9">
                                                                <select name="lokasi" id="lokasi" class="form-control">
                                                                    <option value="">.:Pilih Lokasi :.</option>
                                                                    <?php foreach ($loks as $key => $lok) { ?>

                                                                        <option value="<?= $lok->id; ?>" <?= ($lok->id == set_value('lokasi')) ? "selected" : ""; ?>><?= $lok->id . "-" . $lok->namalok; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <?= form_error('lokasi', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class=" form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Lenis Kelamin</label>
                                                            <div class="col-sm-9">
                                                                <select name="jk" id="level" class="form-control">
                                                                    <option value="">.:Pilih Jenis Kelamin :.</option>
                                                                    <option value="1" <?= (set_value('jk') == 1) ? "selected" : ""; ?>>Laki - laki</option>
                                                                    <option value="2" <?= (set_value('jk') == 2) ? "selected" : ""; ?>>Perempuan</option>
                                                                </select>
                                                                <?= form_error('jk', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>
                                                        <div class=" form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Jabatan</label>
                                                            <div class="col-sm-9">
                                                                <select name="level" id="level" class="form-control">
                                                                    <option value="">.:Pilih Jabatan :.</option>
                                                                    <option value="4" <?= (set_value('level') == 4) ? "selected" : ""; ?>>Maker</option>
                                                                    <option value="3" <?= (set_value('level') == 3) ? "selected" : ""; ?>>PIC </option>
                                                                    <option value="2" <?= (set_value('level') == 2) ? "selected" : ""; ?>>Approval</option>
                                                                    <option value="1" <?= (set_value('level') == 1) ? "selected" : ""; ?>>Admin</option>
                                                                </select>
                                                                <?= form_error('level', '<small class="text-danger pl-1">', '</small>'); ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label text-right">Alamat </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="alamat" class="form-control" value="<?= set_value('alamat'); ?>">
                                                                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                        </div>

                                                        <div class=" modal-footer ">
                                                            <div class=" row">
                                                                <div class="col-12 ">

                                                                    <a href="<?= base_url("adm/Cuser"); ?>" class="btn btn-info">Kembali</a>
                                                                    <button type="submit" class="btn btn-success form_submit" name="form_submit">Tambah</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>



                                        </div>
                                        <div class="col-4">
                                            <div class="card ">
                                                <div class="card-body box-profile">
                                                    <div class="text-center">
                                                        <img class="img img-bordered" style="max-width: 250px;" src="<?= base_url("assets/image/"); ?>blankUser.png">
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                    </div>

                <?php }; ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-header p-1">
                                <h4>Catatan Penting</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-2">
                                <p>Data Master tidak boleh sembarangan dihapus, karena akan terjadi ketidak sinkronan data dikemudian hari</p>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                </div>


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

            // $('.btn_submit').click(function() {
            //     $('.form_submit').submit();

            // });

            $('.updateRuangan').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the moda
                var namaruang = button.data('namaruang') // Extract info from data-* attributes
                var desk = button.data('desk') // Extract info from data-* attributes
                var id = button.data('id') // Extract info from data-* attributes
                var modal = $(this)
                modal.find('.card-body #namaruang').val(namaruang)
                modal.find('.card-body #desk').val(desk)
                modal.find('.card-body #id').val(id)
            })
        });
    </script>
</body>

</html>