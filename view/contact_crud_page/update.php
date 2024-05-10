<?php
// Pastikan bahwa koneksi ke database telah dibuat sebelumnya
require_once 'database.php';

// Periksa apakah parameter id telah diberikan dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Periksa apakah form telah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lindungi input dari SQL Injection dengan menggunakan prepared statement
        $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
        $pemilik = mysqli_real_escape_string($conn, $_POST['pemilik']);

        // Buat dan jalankan query UPDATE
        $query = "UPDATE contact SET No_HP='$no_hp', Pemilik='$pemilik' WHERE No_ID=$id";

        if (mysqli_query($conn, $query)) {
            // Redirect kembali ke halaman utama jika pembaruan berhasil
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Ambil data kontak yang akan diupdate
    $query_select = "SELECT * FROM contact WHERE No_ID=$id";
    $result = mysqli_query($conn, $query_select);
    $contact = mysqli_fetch_assoc($result);
} else {
    echo "ID not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="#"><img src="akun.png" alt="account Icon">Admin</a></li>
            <li><a href="index.php"><img src="home.png" alt="home Icon"> Dashboard</a></li>
            <li><a href="tambah_data.php"><img src="tambah.png" alt="Add Account Icon"> Add Data</a></li>
            <li><a href="logout.php"><img src="logout.png" alt="Logout Icon"> Logout</a></li>
        </ul>
    </div>
    <div class="main2">
        <h2>Edit Contact</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>" method="post">
            <label for="no_hp">No HP:</label><br>
            <input type="text" id="no_hp" name="no_hp" value="<?php echo $contact['No_HP']; ?>"><br>
            <label for="pemilik">Owner:</label><br>
            <input type="text" id="pemilik" name="pemilik" value="<?php echo $contact['Pemilik']; ?>"><br><br>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
