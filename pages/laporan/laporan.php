<?php
require '../../includes/functions.php';
$id_user = $_SESSION['id_userS'];

$transaksi = query("SELECT * FROM thtransaksi WHERE id_user = '$id_user' ORDER BY tanggal DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Toko Kasir</title>

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
                <h4 class="katabold p-3"> <span class="text-session fw-bold"><?= $_SESSION['usernameS']; ?></h4>
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
            <h2 class="katabold mb-4 fs-2">Laporan Penjualan Toko <span
                    class="text-session fw-bold"><?= $_SESSION['nama_tokoS'] ?>
                </span></h2>

            <?php if (empty($transaksi)) :
                echo "<p>Tidak ada transaksi yang ditemukan.</p>"; ?>
            <?php else :  ?>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">No Transaksi</th>
                            <th scope="col">Total</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>

                    <?php foreach ($transaksi as $trans) :
                        $notrans = $trans['no_trans']; ?>

                        <tbody>
                            <tr>
                                <td><?= $trans['no_trans']; ?></td>
                                <td><?= $trans['total']; ?></td>
                                <td><?= $trans['tanggal']; ?></td>
                                <td><a href='detail.php?no_trans=<?= $notrans; ?>'
                                        style="text-decoration: none; color: green;"><i class="fas fa-eye link-success"></i>
                                        Detail</a>
                                </td>
                            </tr>
                        </tbody>

                    <?php endforeach; ?>
                </table>




            <?php endif; ?>


        </div>
    </div>
</body>

<!-- JS Bootstrap -->
<script src=" ../../assets/styles/js/bootstrap.bundle.min.js">
</script>

<!-- JS Style -->
<script src="../../assets/styles/style.js"></script>

</html>