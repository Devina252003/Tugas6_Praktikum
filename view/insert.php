<?php
require_once 'contact.php'; 

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

Contact::setKoneksi($conn);

$res = Contact::insert('087183920111', 'Ninik Rosmala'); 
echo $res; 

mysqli_close($conn);
?> 
