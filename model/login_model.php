<?php
session_start();
require_once "../../config/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM tbl_users WHERE Email='$email' AND Password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;

        header("Location:../index.php");
        exit;
    } else {
        // Authentication failed
        $error = "Email or password incorrect!";
    }

    // Close connection
    mysqli_close($conn);
}
?>
