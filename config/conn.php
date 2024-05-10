<?php
require_once 'env.php';

$host = $_ENV['localhost'];
$username = $_ENV['root'];
$password = $_ENV[''];
$database = $_ENV['contact_owner'];

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}