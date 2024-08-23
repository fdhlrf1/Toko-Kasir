<?php
require '../../includes/functions.php';
$notrans = $_GET['no_trans'];


$details = query("SELECT * FROM thdetail WHERE no_trans = '$notrans'");


// var_dump($details);
// die;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - Toko Kasir</title>

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="../../assets/styles/css/bootstrap.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/styles/style.css">

    <!-- Ikon font awesome -->
    <link rel="stylesheet" href="../../assets/fonts/fontawesome-free/css/all.min.css" type="text/css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../assets/icons/favicon-96x96.png">
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
                <h4 class="katabold p-3"><span class="text-session fw-bold"><?= $_SESSION['usernameS']; ?> </span></h4>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link katamedium" href="../index.php">
                    <i class="fas fa-tachometer-alt"></i>
                    Beranda
                </a>
                <a class="nav-link katamedium" href="../barang/barang.php">
                    <i class="fas fa-box-open"></i>
                    Barang
                </a>
                <a class="nav-link katamedium" href="../penjualan/penjualan.php">
                    <i class="fas fa-receipt"></i>
                    Penjualan
                </a>
                <a class="nav-link active katamedium" href="laporan.php">
                    <i class="fas fa-file-alt"></i>
                    Laporan
                </a>
                <a class="nav-link katamedium" href="../logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </nav>
        </div>

        <div class="container p-4 w-65">
            <!-- Tombol Back -->
            <a href="laporan.php" class="btn btn-secondary mb-3 btnback">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="katabold1 fs-2">Detail Transaksi</h2>

            <p class="mb-3 katamedium fs-5">Transaksi: <span class="text-session fw-bold"><?= $notrans ?></span></p>

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga Awal</th>
                        <th scope="col">Harga Jual</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>

                <?php foreach ($details as $detail) : ?>
                    <tbody>
                        <tr>
                            <td><?= $detail['kd_barang']; ?></td>
                            <td><?= $detail['nama']; ?></td>
                            <td><?= number_format($detail['hr_awal'], 0, ',', '.'); ?></td>
                            <td><?= number_format($detail['hr_jual'], 0, ',', '.'); ?></td>
                            <td><?= $detail['qty']; ?></td>
                            <td><?= number_format($detail['subtotal'], 0, ',', '.'); ?></td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>

</body>
<!-- JS Bootstrap -->
<script src="../../assets/styles/js/bootstrap.bundle.min.js"></script>

<!-- JS Style -->
<script src="../../assets/styles/style.js"></script>


</html>