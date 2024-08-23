<?php

require '../../includes/functions.php';
$id_user =  $_SESSION['id_userS'];
$databarang = query(
    "SELECT b.*, u.nama_toko
             FROM tbarang b 
                JOIN tuser u ON b.id_user = u.id_user 
                    WHERE b.id_user = '$id_user'"
);

//tombol cari di klik
if (isset($_POST["cari"])) {
    $databarang = cari($_POST["keyword"]);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang - Toko Kasir</title>

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="../../assets/styles/css/bootstrap.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/styles/style.css">

    <!-- Ikon font awesome -->
    <link rel="stylesheet" href="../../assets/fonts/fontawesome-free/css/all.min.css" type="text/css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../assets/icons/favicon-96x96.png">


    <style>
        .form-control {
            box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.2);
        }

        .search-container {
            max-width: 400px;
            /* Sesuaikan dengan lebar maksimum yang diinginkan */

        }

        .search-container .form-control {
            flex: 1;
            /* Membuat input mengambil sisa ruang yang tersedia */
        }
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
                <h4 class="katabold p-3"><span class="text-session fw-bold"> <?= $_SESSION['usernameS']; ?> </span></h4>
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
            <h2 class="katabold fs-2">Daftar Barang Toko <span
                    class="text-session fw-bold"><?= $_SESSION['nama_tokoS']; ?> </span></h2>

            <br>

            <a href="tambah.php" style="text-decoration: none; color: green;"><i
                    class="fas fa-plus icon link-success"></i> Tambah</a>

            <br><br>

            <form action="" method="post">
                <div class="search-container d-flex mb-3">
                    <input type="text" class="form-control" name="keyword" id="" placeholder="Cari Disini"
                        autocomplete="off" min="1">
                    <button type="submit" class="btn btn-primary" name="cari">Cari</button>

                </div>

            </form>
            <div class="table-responsive">


                <table class="table table-bordered">


                    <thead class="table-light">
                        <tr>
                            <th scope="col">No. </th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Harga Awal</th>
                            <th scope="col">Harga Akhir</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Aksi</th>

                        </tr>
                    </thead>

                    <tbody class="">
                        <?php $i = 1; ?>
                        <?php foreach ($databarang as $barang) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td>
                                    <img src="../../uploads/<?= $barang["gambar"]; ?>" width="100">
                                </td>
                                <td><?= $barang["nama"]; ?></td>
                                <td><?= $barang["kd_barang"]; ?></td>
                                <td><?= $barang["hr_awal"]; ?></td>
                                <td><?= $barang["hr_jual"]; ?></td>
                                <td><?= $barang["stok"]; ?></td>
                                <td>
                                    <a href="ubah.php?kd_barang=<?= $barang['kd_barang']; ?>"
                                        style="text-decoration: none; color: black;"><i
                                            class="fas fa-edit icon link-black"></i>
                                        Edit</a>
                                    <div class="mr-2"></div>
                                    <a href="hapus.php?kd_barang=<?= $barang['kd_barang']; ?>"
                                        onclick="return confirm('yakin?')" style="text-decoration: none; color: red;"><i
                                            class="fas fa-trash-alt icon link-danger"></i> Hapus</a>
                                </td>

                            </tr>
                    </tbody>
                    <?php $i++; ?>
                <?php endforeach; ?>
                </table>

            </div>


        </div>

    </div>








</body>

<!-- JS Bootstrap -->
<script src="../../assets/styles/js/bootstrap.bundle.min.js"></script>

<!-- JS Style -->
<script src="../../assets/styles/style.js"></script>

</html>