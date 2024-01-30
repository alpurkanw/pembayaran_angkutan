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

    <?php if ($show == "getParam") {
    ?>
        <nav class="navbar navbar-expand-sm navbar-light bg-primary">
            <div class="container-fluid text-light fw-bold ">


                <a href="<?php echo base_url("satgas/Home") ?>" class="btn btn-primary px-2 shadow-sm">
                    <i class="bi bi-arrow-left"></i> Back

                </a>

            </div>
        </nav>
        <div class="container mt-2">
            <h6>Periode </h6>
            <hr class="my-3">
            <form action="<?= base_url("satgas/Cangkutan/rptPeriodResult"); ?>" method="POST">
                <div class="mb-3">
                    <label for="tanggalAwal" class="form-label">Tanggal Awal:</label>
                    <input type="date" class="form-control" id="tanggalAwal" name="tanggalAwal" required>
                </div>
                <div class="mb-3">
                    <label for="tanggalAkhir" class="form-label">Tanggal Akhir:</label>
                    <input type="date" class="form-control" id="tanggalAkhir" name="tanggalAkhir" required>
                </div>
                <!-- <div class="mb-3 shadow-sm">
                    <label for="tanggalAkhir" class="form-label">Pilih Nama Sopir</label>
                    <select class="form-select" id="namaSopir" name="namaSopir" required>
                        <option value="" selected>Nama Sopir</option>
                        <?php
                        foreach ($sprs as $key => $spr) {
                        ?>

                            <option value='<?= $spr->nama; ?>'><?= $spr->nama; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div> -->
                <button type="submit" class="btn btn-primary float-end">Submit</button>
            </form>
        </div>
    <?php
    } ?>


    <?php if ($show == "result") {
    ?>
        <nav class="navbar navbar-expand-sm navbar-light bg-primary">
            <div class="container-fluid text-light fw-bold ">


                <a href="<?php echo base_url("satgas/Cangkutan/rptPeriodParam") ?>" class="btn btn-primary px-2 shadow-sm">
                    <i class="bi bi-arrow-left"></i> Back

                </a>

            </div>
        </nav>
        <div class="container mt-2">
            <h6>LAPORAN ANGKUTAN <br>
                Dari Tanggal <?= $tglAwal; ?><br>sampai Tanggal <?= $tglAkhir; ?> <br><?= $sopir; ?>
            </h6>
            <hr class="my-2">
            <div class="row mb-2">
                <div class="col">
                    <div class="card mx-auto border-primary shadow-sm custom-card">
                        <div class="card-body p-1 text-center text-light bg-primary text_sm">
                            <span class="h5"><?= $tot_ang->jum; ?></span> <br>
                            Total angkutan
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mb-2">
                <div class="col">
                    <div class="card mx-auto border-primary shadow-sm custom-card">
                        <div class="card-body p-1 text-center text-light bg-primary text_sm">
                            <span class="h5"><?= ($tot_ang->jum - $spr_not_pay->jum); ?></span> <br>
                            Sopir SUDAH Dibayar
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mx-auto border-primary shadow-sm custom-card"">
                    <div class=" card-body p-1 text-center text-light bg-info text_sm">
                        <span class="h5"><?= $spr_not_pay->jum; ?></span> <br>
                        Sopir BELUM Dibayar
                    </div>
                </div>
            </div>


        </div>


        <div class="row ">
            <div class="col">
                <h6>Detail angkutan</h6>
                <hr class="my-2">
            </div>
        </div>

        <div class="row">
            <div class="col">

                <?php
                foreach ($angks as $key => $ang) {
                ?>

                    <div class="card mb-2 shadow-sm ">
                        <div class="row g-0">

                            <div class="col">
                                <div class="card-body p-2">
                                    <h6 class="card-title"><?= substr($ang->tglangkut, 0, 4) . "-" . substr($ang->tglangkut, 4, 2) . "-" . substr($ang->tglangkut,  -2);; ?></h6>
                                    <p class="card-text small"><?= $ang->id; ?> | <?= $ang->namaspr; ?> | <?= $ang->namamat; ?> | <?= $ang->namapic; ?> | <?= $ang->tujuan; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <button class="btn btn-danger mb-2 mt-auto mx-2 btn_deleteAng" data-idang="<?= $ang->id; ?>">Del</button>
                                <button class="btn btn-warning mb-2 mt-auto btn_updateAng" data-idang="<?= $ang->id; ?>" data-namapic="<?= $ang->namapic; ?>" data-namaspr="<?= $ang->namaspr; ?>" data-tujuan="<?= $ang->tujuan; ?>" data-namamat="<?= $ang->namamat; ?>" data-tgl="<?= substr($ang->tglangkut, 0, 4) . "-" . substr($ang->tglangkut, 4, 2) . "-" . substr($ang->tglangkut,  -2); ?>">Edit</button>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>



            </div>
        </div>
    <?php
    }
    ?>




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
            $(".btn_updateAng").on("click", function() {
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

            $(".btn_deleteAng").on("click", function() {
                var idang = $(this).data("idang")
                // 
                // return
                if (confirm("Data dengan id " + idang + " Akan Di Delete?")) {

                    // Lakukan permintaan POST dengan $.post
                    var url = '<?= base_url("satgas/Cangkutan/deleteAng/"); ?>';
                    var data = [];
                    $.post(url + idang, data, function(resp) {
                        var dataresp = JSON.parse(resp)
                        // alert(dataresp.code)
                        // return
                        if (dataresp.code !== "1") {
                            alert("Delete Gagal,\n" + dataresp.pesan)
                        } else {
                            alert("Delete Berhasil")
                            location.href = '<?= base_url("satgas/Cangkutan/rptPeriodParam"); ?>';
                        }
                    });

                }
            });




        });
    </script>
</body>

</html>