<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum, redirect ke halaman login
    header("Location: login.php");
    exit();
}

// Sambungkan ke database dan ambil informasi pengguna
require_once 'database.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM tbl_users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Akun</title>
</head>
<body>
    <h1>Informasi Akun</h1>
    <p>Selamat datang, <?php echo htmlspecialchars($user['Fullname']); ?>!</p>
    <p>Informasi akun Anda:</p>
    <ul>
        <li><strong>Fullname:</strong> <?php echo htmlspecialchars($user['Fullname']); ?></li>
        <li><strong>Username:</strong> <?php echo htmlspecialchars($user['Username']); ?></li>
        <li><strong>Email:</strong> <?php echo htmlspecialchars($user['Email']); ?></li>
        <!-- Anda bisa menambahkan informasi akun lainnya sesuai kebutuhan -->
    </ul>
    <p><a href="edit_account.php">Edit Informasi Akun</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
