<?php
// Pastikan bahwa koneksi ke database telah dibuat sebelumnya
require_once 'view/database.php';

// Periksa apakah parameter id telah diterima melalui URL
if (isset($_GET['id'])) {
    // Lindungi input dari SQL Injection dengan menggunakan prepared statement
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Buat dan jalankan query DELETE
    $query = "DELETE FROM contact WHERE No_ID = $id";

    if (mysqli_query($conn, $query)) {
        // Redirect kembali ke halaman utama jika penghapusan berhasil
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Redirect kembali ke halaman utama jika tidak ada parameter id yang diterima
    header("Location: index.php");
    exit();
}
?>
