<?php
require_once 'config/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_user = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Anda harus melakukan validasi dan sanitasi input pengguna di sini

    // Periksa apakah email sudah terdaftar
    $check_query = "SELECT * FROM tbl_users WHERE Email='$email'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        // Enkripsi password sebelum disimpan ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Masukkan pengguna ke dalam database
        $insert_query = "INSERT INTO tbl_users (Nama, Email, Password) VALUES ('$nama_user', '$email', '$hashed_password')";
        if (mysqli_query($conn, $insert_query)) {
            // Registrasi berhasil, redirect ke halaman login
            header("Location:../view/auth_page/login.php");
            exit;
        } else {
            $error = "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
        }
    }

    // Tutup koneksi
    mysqli_close($conn);
}
?>
