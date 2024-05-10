<?php
require_once 'database.php';

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Periksa apakah formulir login disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir login
    $input_email = $_POST['email'];
    $input_password = $_POST['password'];

    // Periksa apakah email dan password cocok dengan data di database
    $sql = "SELECT * FROM tbl_users WHERE Email='$input_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Data pengguna ditemukan, periksa password
        $user = $result->fetch_assoc();
        if ($user['Password'] == $input_password) {
            // Password cocok, login berhasil
            echo "Login successful!";
            // Redirect ke halaman lain atau lakukan tindakan lainnya
        } else {
            // Password tidak cocok
            echo "Invalid password!";
        }
    } else {
        // Data pengguna tidak ditemukan
        echo "User not found!";
    }
}

// Tutup koneksi database
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center">Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="index.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" minlength="8" placeholder="Enter password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            <div class="link"> 
                                Don't have an account? <a href="register.php">Sign Up</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
