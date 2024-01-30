<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-primary">
        <div class="container-fluid text-light fw-bold ">

            <h5>Response</h5>
            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarID" aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->

        </div>
    </nav>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body text-center">
                <?php print_r($_REQUEST); ?>

                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 8 8A8.001 8.001 0 0 0 8 0zm4.73 4.47a.25.25 0 0 1 0 .353l-7.782 7.78a.25.25 0 0 1-.354 0L3.182 9.97a.25.25 0 0 1 .354-.354l2.683 2.682 7.073-7.072a.25.25 0 0 1 .354 0z" />
                </svg>
                <h5 class="card-title mt-3">Transaksi Berhasil!</h5>
                <p class="card-text">Cek Transaksi anda di.</p>
                <a href="<?= base_url("satgas/Cangkutan/input"); ?>" class="btn btn-primary mt-3">Kembali ke Menu Input</a>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>