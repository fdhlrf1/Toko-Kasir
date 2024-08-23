<?php
require '../../includes/functions.php';

date_default_timezone_set('Asia/Jakarta');

// Menghitung total harga
$total_harga = 0;
if (isset($_SESSION['keranjang'])) {

    foreach ($_SESSION['keranjang'] as $detail) {
        $total_harga += $detail['subtotal'];
    }
}

if (isset($_POST['keranjang'])) {
    $kd_barang = $_POST['ambil_kd_barang'];
    $jumlah = $_POST['jumlah'];

    // Ambil data stok barang dari database
    $result = query("SELECT stok FROM tbarang WHERE kd_barang = '$kd_barang'");
    $stok_tersedia = $result[0]['stok'];

    // Cek total jumlah barang yang sudah ada di keranjang untuk barang yang sama
    $jumlah_di_keranjang = 0;
    if (isset($_SESSION['keranjang'][$kd_barang])) {
        $jumlah_di_keranjang = $_SESSION['keranjang'][$kd_barang]['jumlah'];
    }

    // Hitung total jika ditambahkan dengan yang baru
    $total_jumlah = $jumlah_di_keranjang + $jumlah;

    // Cek apakah stok mencukupi
    if ($total_jumlah > $stok_tersedia) {
        echo "
        <script>
            alert('Gagal menambahkan ke keranjang. Sisa stok barang hanya $stok_tersedia.');
            document.location.href = 'penjualan.php';
        </script>";
    } else {
        // Tambahkan barang ke keranjang
        tambahKeKeranjang($_POST);
        header("Location: penjualan.php");
        exit;
    }
}




if (isset($_POST['submit'])) {
    if (sendToDB($_POST) > 0) {

        //kurangi stok barangs
        foreach ($_SESSION['keranjang'] as $kd_barang => $detail) {
            kurangiStok($kd_barang, $detail['jumlah']);
        }

        // Clear keranjang setelah transaksi berhasil disimpan
        unset($_SESSION['keranjang']);

        echo "
        <script>
         alert('transaksi berhasil');
         document.location.href = 'penjualan.php';
         </script>
        ";
        // header("Location: penjualan.php?status=sukses");
        exit;
    } else {
        echo "
        <script>
         alert('transaksi gagal');
         document.location.href = 'penjualan.php';
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
    <title>Penjualan - Toko Kasir</title>

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="../../assets/styles/css/bootstrap.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/styles/style.css">

    <!-- Ikon font awesome -->
    <link rel="stylesheet" href="../../assets/fonts/fontawesome-free/css/all.min.css" type="text/css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../assets/icons/favicon-96x96.png">
    <style>
        .formukuran {
            max-width: 500px;
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
                <h4 class="katabold p-3"> <span class="text-session fw-bold"> <?= $_SESSION['usernameS']; ?> </span>
                </h4>
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
                <a class="nav-link active katamedium" href="penjualan.php">
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
            <h2 class="katabold fs-2">Penjualan Toko <span class="text-session fw-bold"> <?= $_SESSION['nama_tokoS']; ?>
                </span>
            </h2>

            <form action="" method="post">
                <!-- sort untuk menampilkan barang apa saja yang dijual oleh user yang login -->

                <label for="barang" class="form-label">Barang</label>
                <select name="ambil_kd_barang" id="barang" class="form-select formukuran mb-3" required>
                    <?php
                    $id_user = $_SESSION['id_userS'];

                    $barang = query("SELECT kd_barang, nama, hr_awal, hr_jual FROM tbarang WHERE id_user = '$id_user'");

                    foreach ($barang as $item) : ?>
                        <option value="<?= $item['kd_barang']; ?>">
                            <?= $item['nama']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>


                <!-- input type number untuk memasukkan jumlah -->
                <label for="jumlah" class="form-label" min="1">Jumlah</label>
                <input type="number" class="form-control formukuran mb-4" name="jumlah" id="jumlah" min="1" required>

                <!-- button tambah barang ke keranjang-->
                <button type="submit" name="keranjang" class="btn btn-primary mb-4">Tambah ke Keranjang</button>

            </form>

            <!-- tabel keranjang -->
            <h2 class="mb-3 fs-2 katabold1">Keranjang</h2>
            <div class="table-responsive">
                <table class="table table-bordered">

                    <thead class="table-light">
                        <tr>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Sub Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>

                    <?php if (isset($_SESSION['keranjang'])) : ?>
                        <?php foreach ($_SESSION['keranjang'] as $kd_barang => $detail) : ?>

                            <tbody>
                                <tr>
                                    <td><?= $detail['kd_barang']; ?></td>
                                    <td><?= $detail['nama']; ?></td>
                                    <td><?= $detail['harga']; ?></td>
                                    <td><?= $detail['jumlah']; ?></td>
                                    <td><?= $detail['subtotal']; ?></td>
                                    <td><a href='hapus.php?kd_barang=<?= $kd_barang; ?>'
                                            style="text-decoration: none; color: red;"><i
                                                class="fas fa-trash-alt icon link-danger"></i> Hapus</a></td>
                                </tr>

                            </tbody>

                        <?php endforeach; ?>
                    <?php else :
                        echo "<tr><td colspan='6'>Keranjang kosong</td></tr>"; ?>
                    <?php endif; ?>
                </table>
            </div>


            <script>
                function hitungKembalian() {
                    var total = <?= $total_harga; ?>;
                    var bayar = document.getElementById('bayar').value;
                    var kembalian = bayar - total;

                    // Jika bayar kurang dari total, kembalian jadi 0
                    if (kembalian < 0) {
                        kembalian = 0;
                    }

                    // Update nilai di elemen input hidden
                    document.getElementById('kembalian').value = kembalian;

                    // Update tampilan kembalian ke elemen display
                    document.getElementById('kembalian_display').value = "Rp" + kembalian.toLocaleString('id-ID');
                }
            </script>

            <form action="" method="post">

                <label for="total" class="form-label">Total</label>
                <!-- <p>Rp</p> -->
                <input type="text" class="form-control formukuran"
                    value="<?= number_format($total_harga, 0, ',', '.') ?>" readonly>
                <input type="hidden" name="total" id="total" value="<?= $total_harga; ?>">


                <label for="bayar" class="form-label">Bayar</label>
                <input type="number" class="form-control formukuran" name="bayar" id="bayar" onkeyup="hitungKembalian()"
                    min="1" required>

                <label for="kembalian" class="form-label">Kembalian</label>
                <input type="text" class="form-control formukuran mb-4" id="kembalian_display" value="Rp0" readonly>
                <input type="hidden" name="kembalian" id="kembalian" value="0">


                <button type="submit" class="btn btn-success mb-4" name="submit">Submit</button>

            </form>

        </div>


    </div>


</body>

<!-- JS Bootstrap -->
<script src="../../assets/styles/js/bootstrap.bundle.min.js"></script>

<!-- JS Style -->
<script src="../../assets/styles/style.js"></script>

</html>