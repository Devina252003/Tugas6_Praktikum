<?php
require_once "../config/conn.php";

class UserModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function authenticate($email, $password) {
        $query = "SELECT * FROM tbl_users WHERE Email=? AND Password=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows == 1;
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>
