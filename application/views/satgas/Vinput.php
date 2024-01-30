<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Ankutan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>








    <div class="baseUrl" data-url="<?= base_url(); ?>"></div>
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
    <div class="container mt-3">
        <div class="row">
            <div class="col text-center">

                <h5>Form Input Angkutan</h5>
            </div>
        </div>
        <hr class="mb-4">

        <form class="form_inp_angkutan">


            <div class="row mb-3 shadow-sm">
                <div class="col">
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div>
            </div>

            <div class="mb-3 shadow-sm">
                <select class="form-select" id="namaSopir" name="namaSopir">
                    <option value="0" selected>Nama Sopir</option>
                    <?php
                    foreach ($sprs as $key => $spr) {
                    ?>

                        <option value='<?= json_encode($spr); ?>'><?= $spr->nama; ?></option>
                    <?php
                    }
                    ?>
                    <!-- Tambahkan opsi sopir sesuai kebutuhan -->
                </select>
            </div>

            <div class="mb-3 shadow-sm">
                <select class="form-select" id="jenisMaterial" name="jenisMaterial">
                    <option value="0" selected>Jenis Material</option>
                    <?php
                    foreach ($mtrs as $key => $mtr) {
                    ?>
                        <option value='<?= json_encode($mtr); ?>'><?= $mtr->namamat; ?></option>
                    <?php
                    }
                    ?>
                    <!-- Tambahkan opsi jenis material sesuai kebutuhan -->
                </select>
            </div>

            <div class="mb-3 shadow-sm">
                <select class="form-select" id="namaPic" name="namaPic">
                    <option value="0" selected>PIC / Customer (Penanggung Jawab)</option>
                    <?php
                    foreach ($pics as $key => $pic) {
                    ?>
                        <option value='<?= json_encode($pic); ?>'><?= $pic->nama; ?></option>
                    <?php
                    }
                    ?>
                    <!-- Tambahkan opsi jenis material sesuai kebutuhan -->
                </select>
            </div>

            <div class="mb-3 shadow-sm">
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



            <hr class="my-2">


            <div class="row">
                <div class="col ">

                </div>
                <div class="col text-end">

                    <a href="<?php echo base_url("satgas/Home") ?>" class="btn btn-secondary px-2 shadow-sm">
                        Back
                    </a>
                    <button type="button" class="btn btn-primary shadow-sm btn_submit ">Submit</button>
                </div>
            </div>
            <!-- <a href="<?= base_url("satgas/Home"); ?>" class="btn btn-secondary shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali ke Menu Utama
            </a> -->
        </form>
    </div>



    <script src="<?= base_url("assets/js/") ?>jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>


    <script>
        $(document).ready(function() {


            const baseUrl = $(".baseUrl").data("url");


            $(".btn_submit").on("click", function(e) {
                e.preventDefault()
                var tanggal = $("#tanggal").val();
                var namaSopir = $("#namaSopir").val();
                var jenisMaterial = $("#jenisMaterial").val();
                var namaPic = $("#namaPic").val();
                var tujuan = $("#tujuan").val();
                // alert(namasopir)





                if (namaSopir == 0 || jenisMaterial == 0 || namaPic == 0) {
                    alert("Bebera data Belum Diisi !!! ")
                    return
                }

                var data = {

                    "tanggal": tanggal,
                    "namaSopir": namaSopir,
                    "jenisMaterial": jenisMaterial,
                    "namaPic": namaPic,
                    "tujuan": tujuan,
                }


                // URL endpoint yang dituju
                var url = baseUrl + "satgas/Cangkutan/submit";

                // Lakukan permintaan POST dengan $.post
                $.post(url, data, function(resp) {
                    var dataresp = JSON.parse(resp)



                    console.log(dataresp)
                    notif(dataresp)

                    // location.reload();
                    // }
                });

            });



            function notif(data) {
                if (data.pesan == "sukses") {
                    // alert(dataresp.pesan)

                    // Memisahkan tahun, bulan, dan hari
                    var tahun = data.tglang.substring(0, 4);
                    var bulan = data.tglang.substring(4, 6);
                    var hari = data.tglang.substring(6, 8);

                    // Menyusun ulang dalam format yang diinginkan
                    var tanggalAkhir = hari + "-" + bulan + "-" + tahun;

                    var kdang = ("000000" + data.kodeang);


                    // "pesan" => "sukses",
                    // "sopir" => $spr["nama"],
                    //     "material" => $mtr["namamat"],
                    //     "pic" => $pic["nama"],
                    //     "tujuan" => $tjn,
                    //     "tglang" => $tgl,
                    //     "inpid" => $_SESSION["id"],
                    //     "inpname" => $_SESSION["nama"],
                    //     "kodeang" => $this - > db - > insert_id(),

                    $("body").html(
                        `
                            <div class="baseUrl" data-url="<?= base_url(); ?>"></div>
                                <nav class="navbar navbar-expand-sm navbar-light bg-primary">
                                    <div class="container-fluid text-light fw-bold ">

                                        <a href="<?php echo base_url("satgas/Home") ?>" class="btn btn-primary px-2 shadow-sm">
                                            <i class="bi bi-arrow-left"></i> Back

                                        </a>

                                    </div>
                                </nav>
                                <div class="container mt-3">
                                    <div class="row">
                                        <div class="col text-center">

                                            <h4>ANGKUTAN</h4>

                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col text-center">
                                            <p> Tanggal : ${tanggalAkhir} <br>
                                                Nama Sopir : ${data.sopir} <br>
                                                Material : ${data.material}<br>
                                                PIC / Customer : ${data.pic}<br>
                                                Tujuan : ${data.tujuan}

                                            </p>
                                            <h5 class="text-success">Berhasil Diinput </h5>
                                            <h5>Kode: ${kdang.substring(kdang.length - 6)}</h5>
                                            <p class="text-danger fw-bold">Simpan Kode angkutan dengan baik </p>
                                            <hr>
                                            <p>
                                                Petugas Lapangan : ${data.inpid +"-"+ data.inpname}
                                            </p>
                                            <a href="<?php echo base_url("satgas/Cangkutan/input") ?>" class="btn btn-primary px-2 shadow-sm">
                                                Input Kembali
                                            </a>
                                        </div>
                                    </div>
                                </div>


`

                    )

                } else {

                }
            }

        });
    </script>

</body>

</html>