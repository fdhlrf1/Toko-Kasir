<?php
require '../../includes/functions.php';

$kd_barang = $_GET['kd_barang'];

$barang = query("SELECT * FROM tbarang WHERE kd_barang='$kd_barang'")[0];



if (isset($_POST['kirim'])) {
    if (ubah($_POST) > 0) {
        echo "
        <script>
         alert('data berhasil diubah');
         document.location.href = 'barang.php';
         </script>
        ";
    } else {
        echo "
        <script>
         alert('data gagal diubah');
         document.location.href = 'ubah.php';
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
    <title>Ubah - Toko Kasir</title>

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
                <h4 class="katabold p-3"> <span class="text-session fw-bold"> <?= $_SESSION['usernameS']; ?> </span>
                </h4>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link katamedium" href="../index.php">
                    <i class="fas fa-tachometer-alt"></i>
                    Beranda
                </a>
                <a class="nav-link active katamedium" href="barang.php">
                    <i class="fas fa-box-open"></i>
                    Barang
                </a>
                <a class="nav-link katamedium" href="../penjualan/penjualan.php">
                    <i class="fas fa-receipt"></i>
                    Penjualan
                </a>
                <a class="nav-link katamedium" href="../laporan/laporan.php">
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
            <a href="barang.php" class="btn btn-secondary mb-3 btnback">
                <i class="fas fa-arrow-left"></i>
            </a>

            <h2 class="mb-4 fs-2 katabold1">Ubah Barang Toko <span class="text-session fw-bold">
                    <?= $_SESSION['nama_tokoS'] ?> </span></h2>

            <form action="" method="post" enctype="multipart/form-data">

                <input type="hidden" name="kd_barang" value="<?= $barang["kd_barang"]; ?>">
                <input type="hidden" name="gambarlama" value="<?= $barang["gambar"]; ?>">
                <input type="hidden" name="id_user" value="<?= $barang["id_user"]; ?>">

                <div class="form-outline mb-2">
                    <label for="namabarang" class="form-label kataregular">Nama Barang</label>
                    <input type="text" class="form-control formtambah" name="namabarang" id="namabarang"
                        value="<?= $barang['nama']; ?>" required>
                </div>
                <div class="form-outline mb-2">
                    <label for="hargaawal" class="form-label kataregular">Harga Awal</label>
                    <input type="number" class="form-control formtambah" name="hargaawal" id="hargaawal"
                        value="<?= $barang['hr_awal']; ?>" min="1" required>
                </div>
                <div class="form-outline mb-2">
                    <label for="hargajual" class="form-label kataregular">Harga Jual</label>
                    <input type="number" class="form-control formtambah" name="hargajual" id="hargajual"
                        value="<?= $barang['hr_jual']; ?>" min="1" required>
                </div>
                <div class="form-outline mb-0">
                    <label for="stok" class="form-label kataregular">Stok</label>
                    <input type="number" class="form-control formtambah" name="stok" id="stok"
                        value="<?= $barang['stok']; ?>" min="1" required>
                </div>
                <div class="form-outline mb-3">
                    <label for="gambar" class="form-label kataregular">Gambar</label>
                    <img src="../../uploads/<?= $barang['gambar']; ?>" width="150">
                    <input type="file" class="form-control formtambah" name="gambar" id="gambar">
                </div>


                <button type="submit" name="kirim" class="btn btn-success mb-2">Submit</button>



            </form>
        </div>

</body>

<script src="../../assets/styles/js/bootstrap.bundle.min.js"></script>

<!-- JS Style -->
<script src="../../assets/styles/style.js"></script>

</html>