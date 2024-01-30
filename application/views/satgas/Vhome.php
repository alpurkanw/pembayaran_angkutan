<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


    <style>
        /* Aturan kustom untuk layar di atas 426px */
        @media (min-width: 426px) {
            .desktop {
                display: block;
            }

            .mobile {
                display: none;
            }
        }

        /* Aturan kustom untuk layar di bawah 426px */
        @media (max-width: 426px) {
            .desktop {
                display: none;
            }

            .mobile {
                display: block;
            }


        }
    </style>


</head>


<body>



    <div class="mobile">


        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12  ">
                <div class="card  mb-3 shadow ">
                    <div class="card-header bg-primary text-light fw-bold   ">
                        LOGAM MURNI MATERIAL
                    </div>

                </div>


                <div class="row mb-4">
                    <div class="col text-center">
                        <img src="<?= base_url('assets/img/logo_lmm.jpg'); ?>" class="img img-thumbnail shadow w-50" alt="">
                    </div>
                </div>
                <hr>


                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col text-center">
                            <div class="card shadow mn_input_angkutan">
                                <div class="card-body p-2">
                                    <img src="<?= base_url("assets/img/gbr_truk.jpg"); ?>" class="img " height="50" width="50"><br>

                                    <span class="text-dark">Input Angkutan</span>
                                </div>
                            </div>

                        </div>
                        <!-- <div class="col text-center">
                            <div class="card shadow mn_angkutantoday">
                                <div class="card-body p-2">
                                    <img src="<?= base_url("assets/img/gbr_truk.jpg"); ?>" class="img " height="50" width="50"><br>

                                    <span class="text-dark">Angkutan Hari ini</span>
                                </div>
                            </div>

                        </div> -->

                    </div>
                    <div class="row mb-2">
                        <!-- <div class="col text-center">
                            <div class="card shadow mn_input_angkutan">
                                <div class="card-body p-2">
                                    <img src="<?= base_url("assets/img/gbr_truk.jpg"); ?>" class="img " height="50" width="50"><br>

                                    <span class="text-dark">Input Angkutan</span>
                                </div>
                            </div>

                        </div> -->
                        <div class="col text-center">
                            <div class="card shadow mn_angkutantoday">
                                <div class="card-body p-2">
                                    <img src="<?= base_url("assets/img/gbr_truk.jpg"); ?>" class="img " height="50" width="50"><br>

                                    <span class="text-dark">Angkutan Hari ini</span>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col text-center">
                            <div class="card shadow 3 mn_rptSpr">
                                <div class="card-body p-2">
                                    <img src="<?= base_url("assets/img/gbr_truk.jpg"); ?>" class="img " height="50" width="50"><br>

                                    <span class="text-dark">Ang. Per Sopir</span>
                                </div>
                            </div>

                        </div>
                        <!-- <div class="col text-center">
                            <div class="card shadow mn_ang_perperiode">
                                <div class="card-body p-2">
                                    <img src="<?= base_url("assets/img/gbr_truk.jpg"); ?>" class="img " height="50" width="50"><br>

                                    <span class="text-dark">Angkutan Per Periode</span>
                                </div>
                            </div>

                        </div> -->

                    </div>
                    <div class="row">
                        <!-- <div class="col text-center">
                            <div class="card shadow mn_angpersopir">
                                <div class="card-body p-2">
                                    <img src="<?= base_url("assets/img/gbr_truk.jpg"); ?>" class="img " height="50" width="50"><br>

                                    <span class="text-dark">Ang. Per Sopir</span>
                                </div>
                            </div>

                        </div> -->
                        <div class="col text-center">
                            <div class="card shadow mn_ang_perperiode">
                                <div class="card-body p-2">
                                    <img src="<?= base_url("assets/img/gbr_truk.jpg"); ?>" class="img " height="50" width="50"><br>

                                    <span class="text-dark">Angkutan Per Periode</span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row mt-4">

                        <div class="col text-center justify-content-center ">
                            <br>
                            <a href="<?= base_url("Auth/Logout"); ?>" class="btn  shadow border p-1 ">

                                <h5 class="">Logout</h5>

                            </a>
                        </div>
                    </div>




                </div>

            </div>
        </div>
    </div>

    <div class="desktop text-center mt-5">
        Untuk User yang menggunakan Laptop, <br>untuk sementara masih belum bisa kami support, <br>
        Silahkan Gunakan HP anda
    </div>






    <div class="baseUrl" data-url="<?= base_url(); ?>"></div>
    <!-- Modal -->

    <script src="<?= base_url("assets/js/") ?>jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"> </script>
    <script src="<?= base_url('assets/js/kasir/'); ?>penjualan.js"> </script>

    <script>
        $(function() {


            $(".mn_input_angkutan").on("click", function() {
                window.location.href = $(".baseUrl").data("url") + "satgas/Cangkutan/input";
            })
            $(".mn_angkutantoday").on("click", function() {
                window.location.href = $(".baseUrl").data("url") + "satgas/Cangkutan/reportToDay";
            })
            $(".mn_updangkut").on("click", function() {
                window.location.href = $(".baseUrl").data("url") + "satgas/Cangkutan/cari";
            })
            $(".mn_rptSpr").on("click", function() {
                window.location.href = $(".baseUrl").data("url") + "satgas/Cangkutan/rptPerSprgetParam";
            })

            // kode JavaScript Anda di sini
            $(".mn_ang_perperiode").on("click", function() {
                window.location.href = $(".baseUrl").data("url") + "satgas/Cangkutan/rptPeriodParam";
            })

            // $(".mn_tes").on("click", function() {
            //     window.location.href = $(".baseUrl").data("url") + "kasir/tes";
            // })
        });
    </script>
</body>

</html>