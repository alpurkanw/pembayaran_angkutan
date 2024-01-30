<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .text_sm {
            /* Tentukan ukuran font yang lebih kecil dari H6 */
            font-size: 0.9rem;

        }

        .custom-card {
            height: 60px;
            /* Tentukan tinggi card */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-primary">
        <div class="container-fluid text-light fw-bold ">


            <a href="<?php echo base_url("satgas/Home") ?>" class="btn btn-primary px-2 shadow-sm">
                <i class="bi bi-arrow-left"></i> Back

            </a>



        </div>
    </nav>
    <div class="container mt-2">
        <h6>Cari Angkutan </h6>
        <hr class="my-2">

        <?= $this->session->flashdata('pesan'); ?>
        <form action="<?= base_url("satgas/Cangkutan/cari/submit"); ?>" method="post">
            <div class="input-group  shadow-sm">
                <input type="text" class="form-control" name="kata_kunci" placeholder="Ketik Nama Sopir" autofocus>
                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>


        <?php if ($show == "submit") {; ?>
            <br>
            <h6>List angkutan atas nama <?= $sopir; ?></h6>
            <hr class="my-2">

            <?php
            foreach ($angks as $key => $ang) {
            ?>

                <div class="card mb-2 shadow-sm item_angkutan" data-idang="<?= $ang->id; ?>" data-namapic="<?= $ang->namapic; ?>" data-namaspr="<?= $ang->namaspr; ?>" data-tujuan="<?= $ang->tujuan; ?>" data-namamat="<?= $ang->namamat; ?>" data-tgl="<?= substr($ang->tglangkut, 0, 4) . "-" . substr($ang->tglangkut, 4, 2) . "-" . substr($ang->tglangkut,  -2); ?>">
                    <div class="row g-0">
                        <div class="col-auto d-flex justify-content-center align-items-center">
                            <img src="<?= base_url("assets/img/gbr_truk.jpg"); ?>" class=" img  " height="70">
                        </div>
                        <div class="col-8">
                            <div class="card-body p-2">
                                <h6 class="card-title"><?= substr($ang->tglangkut, 0, 4) . "-" . substr($ang->tglangkut, 4, 2) . "-" . substr($ang->tglangkut,  -2);; ?></h6>
                                <p class="card-text small"><?= $ang->namaspr; ?>, <?= $ang->namamat; ?>, <?= $ang->namapic; ?>, <?= $ang->tujuan; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>


        <?php } ?>

        <hr class="my-2">


        <!-- Modal -->
        <div class="modal fade" id="mdl_updAng" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="card card-outline card-primary text_sm">
                        <div class="card-header p-2 bg-primary text-light">
                            Update Angkutan
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="form_update" action="<?= base_url("satgas/Cangkutan/updateAng"); ?>" method="POST">
                            <div class="card-body">

                                <div class=" form-group mb-3 shadow-sm">
                                    <label for="exampleInputEmail1">Tanggal Angkut</label>
                                    <input type="date" name="tglangkut" class="form-control tglangkut">
                                </div>
                                <div class=" form-group mb-3 shadow-sm">
                                    <label for="exampleInputEmail1">Material</label>
                                    <input type="hidden" name="idang" class="form-control idang">
                                    <!-- <input type="text" name="namamat" class="form-control namamat"> -->

                                    <select class="form-select" id="namamat" name="namamat">
                                        <option value="0" selected>Jenis Material</option>
                                        <?php
                                        foreach ($mtrs as $key => $mtr) {
                                        ?>
                                            <option value='<?= $mtr->namamat; ?>'><?= $mtr->namamat; ?></option>
                                        <?php
                                        }
                                        ?>
                                        <!-- Tambahkan opsi jenis material sesuai kebutuhan -->
                                    </select>
                                </div>
                                <div class=" form-group mb-3 shadow-sm">
                                    <label for="exampleInputPassword1">Sopir</label>
                                    <select class="form-select" id="namaspr" name="namaspr">
                                        <option value="0" selected>Nama Sopir</option>
                                        <?php
                                        foreach ($sprs as $key => $spr) {
                                        ?>

                                            <option value='<?= $spr->nama; ?>'><?= $spr->nama; ?></option>
                                        <?php
                                        }
                                        ?>
                                        <!-- Tambahkan opsi sopir sesuai kebutuhan -->
                                    </select>
                                </div>
                                <div class=" form-group mb-3 shadow-sm">
                                    <label for="exampleInputPassword1">PIC</label>
                                    <!-- <input type="text" name="namapic" class="form-control namapic"> -->

                                    <select class="form-select" id="namaPic" name="namaPic">
                                        <option value="0" selected>PIC / Customer (Penanggung Jawab)</option>
                                        <?php
                                        foreach ($pics as $key => $pic) {
                                        ?>
                                            <option value='<?= $pic->nama; ?>'><?= $pic->nama; ?></option>
                                        <?php
                                        }
                                        ?>
                                        <!-- Tambahkan opsi jenis material sesuai kebutuhan -->
                                    </select>
                                </div>
                                <div class=" form-group mb-3 shadow-sm">
                                    <label for="exampleInputPassword1">Tujuan</label>
                                    <!-- <input type="text" name="namapic" class="form-control namapic"> -->

                                    <select class="form-select" id="tujuan" name="tujuan">
                                        <option value="0" selected>Tujuan Pengankutan</option>
                                        <?php
                                        foreach ($tujuans as $key => $tjn) {
                                        ?>
                                            <option value='<?= $tjn->tujuan; ?>'><?= $tjn->tujuan; ?></option>
                                        <?php
                                        }
                                        ?>
                                        <!-- Tambahkan opsi jenis material sesuai kebutuhan -->
                                    </select>
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

        <!-- Skrip jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js">
        </script>


        <script>
            $(document).ready(function() {
                $(".item_angkutan").on("click", function() {
                    $("#mdl_updAng .idang").val($(this).data("idang"));
                    $("#mdl_updAng .tglangkut").val($(this).data("tgl"));

                    // $("#mdl_updAng .namamat").val($(this).data("namamat"));
                    $("#mdl_updAng #namamat").val($(this).data("namamat"));


                    $("#mdl_updAng #namaspr").val($(this).data("namaspr"));
                    $("#mdl_updAng #namaPic").val($(this).data("namapic"));
                    $("#mdl_updAng #tujuan").val($(this).data("tujuan"));


                    // $("#mdl_updAng .kubikasi").val($(this).data("kubikasi"));

                    $("#mdl_updAng").modal("toggle");
                });
                $(".btn_update_angkutan").on("click", function() {
                    // // alert("update")
                    // // return;
                    // var kubikasi = $(".kubikasi").val();
                    // var tot_harga = $(".tot_harga").val();
                    // if (kubikasi == "" || tot_harga == "" || kubikasi == 0.00 || tot_harga == 0.00) {
                    //     alert("Kubikasi dan Harga Harus DIISI")
                    //     return;
                    // }

                    // $("#form_update").submit()
                    // $("#mdl_ang").modal("toggle");
                });


            });
        </script>
</body>

</html>