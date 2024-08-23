<?php
session_start();

require 'config.php';

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function queryUbah($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    return $row;
}


function tambah($data)
{
    global $conn;

    $id_user =  $_SESSION['id_userS'];
    $namabarang = htmlspecialchars($data['namabarang']);
    $hargaawal = htmlspecialchars($data['hargaawal']);
    $hargajual = htmlspecialchars($data['hargajual']);
    $stok = htmlspecialchars($data['stok']);
    $gambar = htmlspecialchars($data['gambar']);

    //upload gambar 
    $gambar = upload();
    if ($gambar  == false) {
        return false;
    }


    $querykode = mysqli_query($conn, "SELECT MAX(kd_barang) as maxKDB FROM tbarang");
    $data = mysqli_fetch_array($querykode);

    $kode = $data['maxKDB'];

    // Hapus bagian 'KDB' dari kode yang diambil
    $kodebaru = (int)substr($kode, 3);

    // Increment bagian numerik
    $kodebaru++;

    // Gabungkan kembali dengan 'KDB'
    $char = 'KDB';
    $kodeauto = $char . sprintf("%04s", $kodebaru);

    $kodeautofix = trim($kodeauto);


    // Debug isi dari $ekstensiGambar
    // echo "<pre>";
    // var_dump($kodeautofix);
    // echo "</pre>";

    // die;


    $query = "INSERT INTO tbarang VALUES ('$kodeautofix', $id_user, '$namabarang', $hargaawal, $hargajual, $stok, '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;

    $kd_barang = $data['kd_barang'];
    $gambarlama = $data['gambarlama'];
    $namabarang = htmlspecialchars($data['namabarang']);
    $hargaawal = htmlspecialchars($data['hargaawal']);
    $hargajual = htmlspecialchars($data['hargajual']);
    $stok = htmlspecialchars($data['stok']);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarlama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE tbarang SET nama = '$namabarang', hr_awal = '$hargaawal', hr_jual = '$hargajual', stok = '$stok', gambar = '$gambar' WHERE kd_barang = '$kd_barang'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($data)
{
    global $conn;

    $kd_barang = $data['kd_barang'];

    $query = "DELETE FROM tbarang WHERE kd_barang = '$kd_barang'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('pilih gambar terlebih dahulu');</script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('yang anda upload bukan gambar');</script>";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "<script>alert('yang anda upload terlalu besar');</script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, '../../uploads/' . $namaFileBaru);

    return $namaFileBaru;
}

function register($data)
{
    global $conn;
    //menangkap data dengan $_POST
    $username = htmlspecialchars($data['username']);
    $email = htmlspecialchars($data['email']);
    $namatoko = htmlspecialchars($data['namatoko']);
    $password = htmlspecialchars($data['password']);

    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO tuser VALUES ('', '$username', '$namatoko', '$email', '$hashedPass')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function login($data)
{
    global $conn;

    $email = mysqli_real_escape_string($conn, $data['email']);
    $password = $data['password'];

    // Cek apakah email terdaftar
    $query = "SELECT * FROM tuser WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Jika terjadi kesalahan dalam query
        return "Terjadi kesalahan pada query: " . mysqli_error($conn);
    }

    $cek = mysqli_num_rows($result);

    if ($cek == 1) {
        $datalogin = mysqli_fetch_assoc($result);

        // Verifikasi Password
        if (password_verify($password, $datalogin['password'])) {
            echo "Password berhasil diverifikasi!<br>";
            $_SESSION['id_userS'] = $datalogin['id_user'];
            $_SESSION['usernameS'] = $datalogin['username'];
            $_SESSION['nama_tokoS'] = $datalogin['nama_toko'];

            // Redirect ke halaman utama setelah login berhasil
            header('Location: pages/index.php');
            exit();
        } else {
            // echo "Password tidak cocok!<br>";
            return "Password salah";
        }
    } else {
        // echo "Email tidak ditemukan!<br>";
        return "Email tidak ditemukan";
    }
}

function sendToDB($data)
{
    global $conn;

    $total = $data['total'];
    $bayar =  $data['bayar'];
    $kembalian = $data['kembalian'];
    $id_user = $_SESSION['id_userS'];
    $tanggal = date('Y-m-d H:i:s');

    if ($bayar < $total) {
        echo "
        <script>
         alert('uang anda kurang');
         document.location.href = 'penjualan.php';
         </script>
        ";

        return false;
    }
    if (empty($_SESSION['keranjang'])) {
        echo "
        <script>
            alert('Keranjang kosong, tambahkan barang terlebih dahulu');
            document.location.href = 'penjualan.php';
        </script>";

        return false;
    }

    $querykode = mysqli_query($conn, "SELECT MAX(no_trans) as maxTRS FROM thtransaksi");
    $data = mysqli_fetch_array($querykode);

    $kode = $data['maxTRS'];

    // Hapus bagian 'KDB' dari kode yang diambil
    $kodebaru = (int)substr($kode, 3);

    // Increment bagian numerik
    $kodebaru++;

    // Gabungkan kembali dengan 'KDB'
    $char = 'TRS';
    $kodeauto = $char . sprintf("%04s", $kodebaru);

    $kodeautofix = trim($kodeauto);

    $querytrans = "INSERT INTO thtransaksi VALUES ('$kodeautofix', $id_user, '$tanggal', $total, $bayar, $kembalian)";
    mysqli_query($conn, $querytrans);

    foreach ($_SESSION['keranjang'] as $kd_barang => $detail) {
        $nama = $detail['nama'];
        $h_awal = $detail['h_awal'];
        $harga = $detail['harga'];
        $jumlah = $detail['jumlah'];
        $subtotal = $detail['subtotal'];

        $querydetail = "INSERT INTO thdetail VALUES (
            '', '$kodeautofix', '$kd_barang', '$nama', '$h_awal', '$harga', '$jumlah', '$subtotal'
        )";
        mysqli_query($conn, $querydetail);
    }

    return mysqli_affected_rows($conn);
}


function tambahKeKeranjang($data)
{
    global $conn;

    $kd_barang = $data['ambil_kd_barang'];
    $jumlah = $data['jumlah'];

    // Ambil detail barang berdasarkan kd_barang
    $barangDipilih = query("SELECT * FROM tbarang WHERE kd_barang = '$kd_barang'")[0];

    $h_awal = $barangDipilih['hr_awal'];
    $h_akhir = $barangDipilih['hr_jual'];
    $nama = $barangDipilih['nama'];
    $subtotal = $h_akhir * $jumlah;

    // Tambahkan barang ke dalam session keranjang
    if (isset($_SESSION['keranjang'][$kd_barang])) {
        // Jika barang sudah ada di keranjang, tambahkan jumlahnya
        $_SESSION['keranjang'][$kd_barang]['jumlah'] += $jumlah;
        $_SESSION['keranjang'][$kd_barang]['subtotal'] += $subtotal;
    } else {
        // Jika barang belum ada di keranjang, tambahkan barang baru
        $_SESSION['keranjang'][$kd_barang] = [
            'kd_barang' => $kd_barang,
            'nama' => $nama,
            'h_awal' => $h_awal,
            'harga' => $h_akhir,
            'jumlah' => $jumlah,
            'subtotal' => $subtotal
        ];
    }
}

function hapusKeKeranjang($data)
{
    $kd_barang = $data['kd_barang'];

    // Hapus barang dari session keranjang
    if (isset($_SESSION['keranjang'][$kd_barang])) {
        unset($_SESSION['keranjang'][$kd_barang]);

        // Jika keranjang kosong setelah penghapusan, hapus session keranjang
        if (empty($_SESSION['keranjang'])) {
            unset($_SESSION['keranjang']);
        }
    }
}

function kurangiStok($kd_barang, $jumlah)
{
    global $conn;
    $query = "UPDATE tbarang SET stok = stok - $jumlah WHERE kd_barang = '$kd_barang'";
    if (mysqli_query($conn, $query)) {
        echo "Stok barang dengan kode $kd_barang berhasil dikurangi sebanyak $jumlah.<br>";
    } else {
        echo "Gagal mengurangi stok untuk barang dengan kode $kd_barang. Error: " . mysqli_error($conn) . "<br>";
    }
}


function cari($keyword)
{
    $query = "SELECT * FROM tbarang 
              WHERE kd_barang LIKE '%$keyword%' 
              OR nama LIKE '%$keyword%' 
              OR hr_awal LIKE '%$keyword%' 
              OR hr_jual LIKE '%$keyword%' 
              OR stok LIKE '%$keyword%'";
    return query($query);
}
