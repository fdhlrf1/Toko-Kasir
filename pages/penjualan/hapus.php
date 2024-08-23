<?php
require '../../includes/functions.php';

// Pastikan kd_barang ada di URL
if (isset($_GET['kd_barang'])) {
    hapusKeKeranjang($_GET);
}

// Redirect kembali ke halaman penjualan
header("Location: penjualan.php");
exit;
