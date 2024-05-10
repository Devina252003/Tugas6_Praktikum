<?php
// Pastikan bahwa koneksi ke database telah dibuat sebelumnya
require_once 'database.php';

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lindungi input dari SQL Injection dengan menggunakan prepared statement
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $pemilik = mysqli_real_escape_string($conn, $_POST['pemilik']);

    // Buat dan jalankan query INSERT
    $query = "INSERT INTO contact (No_HP, Pemilik) VALUES ('$no_hp', '$pemilik')";

    if (mysqli_query($conn, $query)) {
        // Redirect kembali ke halaman utama jika penambahan berhasil
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="admin.php"><img src="akun.png" alt="account Icon">Admin</a></li>
            <li><a href="index.php"><img src="home.png" alt="home Icon"> Dashboard</a></li>
            <li><a href="tambah_data.php"><img src="tambah.png" alt="Add Account Icon"> Add Data</a></li>
            <li><a href="logout.php"><img src="logout.png" alt="Logout Icon"> Logout</a></li>
        </ul>
    </div>
    <div class="main">
        <h2>Add New Contact</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="no_hp">No HP:</label><br>
            <input type="text" id="no_hp" name="no_hp"><br>
            <label for="pemilik">Owner:</label><br>
            <input type="text" id="pemilik" name="pemilik"><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
