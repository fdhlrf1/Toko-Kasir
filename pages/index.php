<?php
require '../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Toko Kasir</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/styles/style.css">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="../assets/styles/css/bootstrap.min.css">


    <!-- Ikon font awesome -->
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free/css/all.min.css" type="text/css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/icons/favicon-96x96.png">

    <style>
        /* .text-session {
        color: #F39C12;
    } */
    </style>

</head>

<body>

    <!-- Toggle Button for Mobile -->
    <button class="btn toggle-sidebar d-lg-none">
        <i class="fas fa-bars"></i>
    </button>

    <div class="d-flex w-100">
        <!-- Sidebar -->
        <div class="sidebar p-3 w-35" id="sidebar">
            <div class="user-profile">
                <!-- <img src="assets/images/user-default.png" alt="User Profile"> -->
                <h4 class="katabold p-3"> <span class="text-session fw-bold"><?= $_SESSION['usernameS']; ?> </span></h4>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link active katamedium" href="index.php">
                    <i class="fas fa-tachometer-alt"></i>
                    Beranda
                </a>
                <a class="nav-link katamedium" href="barang/barang.php">
                    <i class="fas fa-box-open"></i>
                    Barang
                </a>
                <a class="nav-link katamedium" href="penjualan/penjualan.php">
                    <i class="fas fa-receipt"></i>
                    Penjualan
                </a>
                <a class="nav-link katamedium" href="laporan/laporan.php">
                    <i class="fas fa-file-alt"></i>
                    Laporan
                </a>
                <a class="nav-link katamedium" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </nav>
        </div>



        <!-- Main Content -->
        <div class="container p-4 w-65" id="content">
            <!-- Isi konten halaman Anda di sini -->

            <h1 class="katabold fs-2">Selamat Datang <span class="text-session fw-bold"> <?= $_SESSION['usernameS'];  ?>
                </span>
                di Toko Kasir</h1>

            <p class="kataregular">Pilih menu di samping untuk melanjutkan.</p>
        </div>
    </div>


</body>

<!-- JS Bootstrap -->
<script src="../assets/styles/js/bootstrap.bundle.min.js"></script>

<!-- JS Style -->
<script src="../assets/styles/style.js"></script>

</html>