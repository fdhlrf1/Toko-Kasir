<?php
require '../../includes/functions.php';

if (hapus($_GET) > 0) {
    echo "
        <script>
         alert('data berhasil dihapus');
         document.location.href = 'barang.php';
         </script>
        ";
} else {
    echo "
        <script>
         alert('data gagal dihapus');
         document.location.href = 'barang.php';
         </script>
        ";
}
