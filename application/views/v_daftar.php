<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>

<body class="bg-info">

    <div class="container mt-5">




        <?php if ($page == "daftar") { ?>
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Form Pendaftaran</h4>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('pesan'); ?>
                            <form action="<?= base_url("Daftar/submit"); ?>" method="POST">

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    <!-- <?= form_error('email', '<div class="text-danger pl-1">', '</div>'); ?> -->
                                    <!-- <?= form_error('Email', '<small class="text-danger pl-1">', '</small>'); ?> -->
                                </div>


                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="pass1" name="pass1">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="pass2" name="pass2">
                                </div>

                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">Nomor Handphone</label>
                                    <input type="tel" class="form-control" id="no_hp" name="no_hp">
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <button type="button" class="btn btn-outline-secondary btn_batal">Login</button>
                                </div>

                            </form>



                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if ($page == "gagal") { ?>
            <div class="container d-flex align-items-center justify-content-center vh-100">
                <div class="col-xl-6 col-lg-12 col-md-9">

                    <div class="card shadow">

                        <div class="card-body">
                            <div class="text-center">
                                <img width="100" class="my-4" src="<?= base_url("assets/img/failed.gif"); ?>">
                                <br>
                                <h3 class="text-danger">Pendaftaran Gagal</h3> <br>
                                <p>
                                    Kemungkinan akun anda sudah pernah didaftarkan,
                                </p>
                                <p>
                                    Untuk info lebih lanjut hubungi kami di
                                    0895-1243-0334

                                </p>
                                <p>
                                    atau
                                    klik tombol Whatsapp
                                </p>
                                <br>
                                <?php $email = 'alpurkan@gmail.com'; ?>
                                <a class="btn btn-success" href="https://wa.me/629512430334" target="_blank">
                                    <i class="bi bi-whatsapp fs-5"></i> Whatsapp
                                </a>
                                <a class="btn btn-info" href="<?= base_url(); ?>" target="_blank">
                                    <i class="bi bi-login fs-5"></i> Lanjutkan Login
                                </a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        <?php } ?>
        <?php if ($page == "berhasil") { ?>
            <div class="container d-flex align-items-center justify-content-center vh-100">
                <div class="col-xl-6 col-lg-12 col-md-9">

                    <div class="card shadow">

                        <div class="card-body">
                            <div class="text-center">
                                <img width="100" class="my-4" src="<?= base_url("assets/img/success_2.gif"); ?>">
                                <br>
                                <h3 class="text-success">Pendaftaran Sukses</h3> <br>
                                <p>Silahkan Hubungi Admin kami untuk Pengaktifan Akun Anda
                                    di No 0895-12430334
                                    atau klik tombol Whatsapp.</p> <br>

                                <a class="btn btn-success" href="https://wa.me/629512430334?text=Halo+saya+ingin+mengaktifkan+akun+dengan+email:+<?= $email; ?>" target="_blank">
                                    <i class="bi bi-whatsapp fs-5"></i> Whatsapp
                                </a>
                                <a class="btn btn-info" href="<?= base_url(); ?>" target="_blank">
                                    <i class="bi bi-login fs-5"></i> Lanjutkan Login
                                </a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php } ?>




    </div>
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn_batal').on('click', function() {
                window.location = '<?= base_url(); ?>';
            })
        });
    </script>
</body>

</html>