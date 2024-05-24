<?php
require_once 'admin.php';
require_once 'database.php';

class User {
    static function login($data=[]) {
        extract($data);
        global $conn;

        $result = $conn->query("SELECT * FROM tbl_users WHERE Email = '$email'");
        if ($result = $result->fetch_assoc()) {
            $hashedPassword = $result['Password'];
            $verify = password_verify($password, $hashedPassword);
            if ($verify) { return $result; }
            else { return false; }
        }
        else { return false; }
    }

    static function register($data=[]) {
        extract($data);
        global $conn;
        
        $inserted_at = date('Y-m-d H:i:s', strtotime('now'));
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO tbl_users SET Fullname = ?, Username = ?, Email = ?, Password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $fullname, $username, $email, $hashedPassword); // Changed $name to $fullname
        $stmt->execute();

        $result = $stmt->affected_rows > 0 ? true : false;
        return $result;
    }

    static function getPassword($email) { 
        global $conn;
        $sql = "SELECT Password FROM tbl_users WHERE Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->affected_rows > 0 ? true : false;
        return $result;
    }

    static function update($data=[]) {}

    static function delete($id='') {}
}
?>