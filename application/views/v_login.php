<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .container {
            display: flex;
            justify-content: center;
            /* Mengatur card di tengah secara horizontal */
            align-items: center;
            /* Mengatur card di tengah secara vertikal */
            min-height: 100vh;
            /* Membuat container setinggi tinggi viewport */
        }

        .card {
            width: 100%;
            /* Memastikan card tetap lebar penuh */
            max-width: 400px;
            /* Sesuaikan lebar maksimum card sesuai kebutuhan */
            /* Style card sesuai kebutuhan Anda */
        }
    </style>
</head>

<body class="bg-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow my-5 ">
            <div class="card-body px-2 py-4">
                <!-- Nested Row within Card Body -->
                <div class="row mb-4">
                    <div class="col text-center">
                        <img src="<?= base_url('assets/img/logo_lmm.jpg'); ?>" class="img img-thumbnail shadow w-50" alt="">
                    </div>
                </div>
                <hr>
                <div class="row">

                    <div class="col ">

                        <?= $this->session->flashdata('pesan'); ?>
                        <form action="<?= base_url("Auth/login"); ?>" class="form_submit" method="post">

                            <input type="hidden" id="lebar_layar" name="lebar_layar">
                            <div class="form-floating mb-4">
                                <input type="usernm" name="usernm" class="form-control" id="floatingInput" placeholder="name@example.com" autofocus>
                                <label for="floatingInput">Username</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="passwd" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>


                            <div class="d-grid gap-4">
                                <button type="submit" class="btn btn-primary">
                                    <h4>Log In</h4>
                                </button>
                            </div>


                        </form>
                        <!-- <div class="lebar-layar">sss</div> -->
                        <div class="text-center mt-4">
                            <!-- <a class="small" href="<?= base_url('Daftar'); ?>">Create an Account!</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // let elemen = document.querySelector('.lebar-layar');
            // console.log(elemen);
            let lebarScreen = window.innerWidth;
            let tinggiScreen = window.innerHeight;
            // $('#lebar_layar').val(lebarScreen)
            document.querySelector('#lebar_layar').value = lebarScreen
        });
    </script>
</body>

</html>