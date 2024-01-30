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


            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarID" aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->

        </div>
    </nav>
    <div class="container mt-2">
        <h6>Lap. Angkutan hari ini (<?= date('Y-m-d'); ?>)</h6>
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

        <br>
        <h6>Detail angkutan</h6>
        <hr class="my-2">

        <div class="row">
            <div class="col">

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
                                    <p class="card-text small"><?= $ang->namaspr; ?> | <?= $ang->namamat; ?> | <?= $ang->namapic; ?> | <?= $ang->tujuan; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>



            </div>
        </div>

    </div>







    <!-- Modal -->
    <div class="modal fade" id="mdl_ang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="card card-outline card-primary text_sm">
                    <div class="card-header p-2 bg-primary text-light">
                        Detail Angkutan
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="form_update" action="<?= base_url("satgas/Cangkutan/update"); ?>" method="POST">
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
                                <label for="exampleInputPassword1">KUBIKASI</label>
                                <input type="text" name="kubikasi" class="form-control kubikasi" autocomplete="FALSE">
                            </div>
                            <div class=" form-group mb-3 shadow-sm">
                                <label for="exampleInputPassword1">TOTAL HARGA</label>
                                <input type="text" name="tot_harga" class="form-control tot_harga">
                                <input type="hidden" name="dari_form" class="form-control dari_form" value="reporttoday">
                            </div>



                            <div class=" form-group mb-3 shadow-sm">
                                <label for="namaPic" class="form-label">STATUS BAYAR SOPIR</label>
                                <input type="hidden" name="sts_sebelum" class="form-control sts_sebelum">
                                <select class="form-select " id="st_bayar_spr" name="st_bayar_spr">
                                    <option value="0">BELUM DIBAYAR</option>
                                    <option value="1">SUDAH DIBAYAR</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">BATAL</button>
                                </div>
                                <div class="col text-end">
                                    <button type="button" class="btn btn-primary btn_update_angkutan">UPDATE</button>
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
                // alert("")
                // $("#mdl_ang .idang").val($(this).data("idang"));
                // $("#mdl_ang .namamat").val($(this).data("material"));
                // $("#mdl_ang .namaspr").val($(this).data("sopir"));
                // $("#mdl_ang .namapic").val($(this).data("pic"));

                // $("#mdl_ang .kubikasi").val($(this).data("kubikasi"));
                // $("#mdl_ang .tot_harga").val($(this).data("tot_harga"));

                // $("#mdl_ang .sts_sebelum").val($(this).data("st_bayar_spr"));
                // $("#mdl_ang #st_bayar_spr").val($(this).data("st_bayar_spr"));
                // $("#mdl_ang").modal("toggle");
            });
            $(".btn_update_angkutan").on("click", function() {
                // alert("update")
                // return;
                var kubikasi = $(".kubikasi").val();
                var tot_harga = $(".tot_harga").val();
                if (kubikasi == "" || tot_harga == "" || kubikasi == 0.00 || tot_harga == 0.00) {
                    alert("Kubikasi dan Harga Harus DIISI")
                    return;
                }

                $("#form_update").submit()
                $("#mdl_ang").modal("toggle");
            });


        });
    </script>
</body>

</html>