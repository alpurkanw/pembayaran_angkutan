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


            <a href="<?php echo base_url("satgas/Cangkutan/rptPerSprgetParam") ?>" class="btn btn-primary px-2 shadow-sm">
                <i class="bi bi-arrow-left"></i> Back

            </a>


            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarID" aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->

        </div>
    </nav>
    <div class="container mt-2">
        <h6>Lap. Tot Angkutan Semua Sopir </h6>
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

                    <div class="card mb-2 shadow-sm item_angkutan" data-namaspr="<?= $ang->namaspr; ?>">
                        <div class="row g-0">
                            <div class="col-8">
                                <div class="card-body p-2">
                                    <h6 class="card-title"><?= $ang->namaspr; ?></h6>
                                    <p>

                                        <?= "Jumlah Angkutan : " . $ang->jum . "<br>Belum Dibayar: " . $ang->jumlah_belum_bayar . " <br> Sudah Dibayar: " . $ang->jumlah_sudah_bayar;; ?>
                                    </p>
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
                var namaspr = $(this).data("namaspr");
                // alert(namaspr)
                // return;
                var url = "<?= base_url("satgas/Cangkutan/reportAllSpr/"); ?>" + namaspr
                // alert(url)
                location.href = url;


            });
        });
    </script>
</body>

</html>