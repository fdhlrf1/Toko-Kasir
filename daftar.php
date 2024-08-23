<?php

require 'includes/config.php';
require 'includes/functions.php';


if (isset($_POST['kirim'])) {

    //cek apakah data berhasil ditambahkan atau tidak 
    if (register($_POST) > 0) {
        echo "
        <script>
         alert('data berhasil ditambahkan');
         document.location.href = 'index.php';
         </script>
        ";
    } else {
        echo "
        <script>
         alert('data gagal ditambahkan');
         document.location.href = 'index.php';
         </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Toko Kasir</title>

    <!-- CSS-->
    <link rel="stylesheet" href="assets/styles/css/bootstrap.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/icons/favicon-96x96.png">

    <script src="assets/styles/js/bootstrap.min.js"></script>


    <style>
        @font-face {
            font-family: opensansregular;
            src: url(assets/fonts/Open_Sans/static/OpenSans-Regular.ttf);
        }

        @font-face {
            font-family: opensansmedium;
            src: url(assets/fonts/Open_Sans/static/OpenSans-Medium.ttf);
        }

        @font-face {
            font-family: opensansbold;
            src: url(assets/fonts/Open_Sans/static/OpenSans-Bold.ttf);
        }

        .katabold {
            font-family: opensansbold;
        }

        .kataregular {
            font-family: opensansregular;
        }

        .katamedium {
            font-family: opensansmedium;
        }

        .card {
            background-color: #EDDFD4;
            border-color: #DBCCC3;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }

        .form-control {
            box-shadow: 8px 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background-color: #475058 !important;
            border-color: #475058 !important;
        }

        .btn-primary:hover {
            background-color: #23272b !important;
            border-color: #23272b !important;
        }

        .btn-primary:active {
            background-color: #121314 !important;
            border-color: #121314 !important;

        }


        .tautan {
            text-decoration: none;
        }
    </style>
</head>

<body>



    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-6 mt-5">
                    <img src="assets/images/kasir2.png" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-xl-4 mt-5">
                    <div class="card">
                        <div class="card-body p-5">
                            <form action="" method="post">
                                <div class="divider d-flex align-items-center my-3">
                                    <p class="text-center mx-1 mb-0 fs-2 katabold">Daftar</p>
                                </div>

                                <div class="form-outline mb-2">
                                    <label class="form-label kataregular" for="username">Username</label>
                                    <input type="text" id="username" class="form-control form-control-lg"
                                        placeholder="Masukkan username" name="username" required />
                                </div>


                                <div class="form-outline mb-2">
                                    <label class="form-label kataregular" for="email">Email</label>
                                    <input type="text" id="email" class="form-control form-control-lg"
                                        placeholder="Masukkan alamat email" name="email" required />
                                </div>

                                <div class="form-outline mb-2">
                                    <label class="form-label kataregular" for="namatoko">Nama Toko</label>
                                    <input type="text" id="namatoko" class="form-control form-control-lg"
                                        placeholder="Masukkan alamat namatoko" name="namatoko" required />
                                </div>

                                <div class="form-outline mb-2">
                                    <label class="form-label kataregular" for="password">Password</label>
                                    <input type="password" id="password" class="form-control form-control-lg"
                                        placeholder="Masukkan password" name="password" required />
                                </div>

                                <div class="text-center text-lg-start pt-2">
                                    <button type="submit" class="btn btn-primary btn-lg katamedium"
                                        style="padding-left: 2.5rem; padding-right: 2.5rem;"
                                        name="kirim">Daftar</button>
                                    <p class="small fw-bold mt-2 pt-1 mb-0 kataregular">Sudah Punya Akun? <a
                                            href="index.php" class="tautan">Masuk</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



</body>

</html>