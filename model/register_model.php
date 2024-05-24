<?php
require_once 'config/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_user = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_query = "SELECT * FROM tbl_users WHERE Email='$email'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO tbl_users (Nama, Email, Password) VALUES ('$nama_user', '$email', '$hashed_password')";
        if (mysqli_query($conn, $insert_query)) {
            header("Location:../view/auth_page/login.php");
            exit;
        } else {
            $error = "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
        }
    }
    mysqli_close($conn);
}
?>
