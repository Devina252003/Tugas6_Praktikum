<?php
require_once 'index.php';
require_once 'database.php';

class Contact {
    private static $koneksi;

    public static function setKoneksi($koneksi) {
        self::$koneksi = $koneksi;
    }

    public static function select() {
        $query = "SELECT * FROM contact";
        $result = mysqli_query(self::$koneksi, $query);
        if (!$result) {
            die("Query SELECT gagal: " . mysqli_error(self::$koneksi));
        }
        return $result;
    }

    public static function insert($No_HP, $Pemilik) {
        $query = "INSERT INTO contact (No_HP, Pemilik) VALUES (?, ?)";
        $stmt = self::$koneksi->prepare($query);
        $stmt->bind_param("ss", $No_HP, $Pemilik);
        $result = $stmt->execute();
        if (!$result) {
            die("Query INSERT gagal: " . $stmt->error);
        }
        return $result;
    }

    public static function delete($No_ID) {
        $query = "DELETE FROM contact WHERE No_ID = ?";
        $stmt = self::$koneksi->prepare($query);
        $stmt->bind_param("i", $No_ID);
        $result = $stmt->execute();
        if (!$result) {
            die("Query DELETE gagal: " . $stmt->error);
        }
        return $result;
    }

    public static function update($No_ID, $new_NO_HP, $new_Pemilik) {
        $query = "UPDATE contact SET No_HP = ?, Pemilik = ? WHERE No_ID = ?";
        $stmt = self::$koneksi->prepare($query);
        $stmt->bind_param("sss", $new_NO_HP, $new_Pemilik, $No_ID);
        $result = $stmt->execute();
        if (!$result) {
            die("Query UPDATE gagal: " . $stmt->error);
        }
        return $result;
    }
}
?>

