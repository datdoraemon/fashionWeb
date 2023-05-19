<?php

require_once 'Database.php';

class Cart {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function ShowCart(){

    }

    public function AddtoCart($user_id, $product_id, $quantity) {        
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            return $user;
        }

        return false;
    }

    public function RemovetoCart($user_id, $product_id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        }
    
        return false;
    }

    public function createUser($email, $password, $name, $birthday, $phone, $address) {
        $stmt = $this->conn->prepare("INSERT INTO users (email, password, name, birthday, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $email, $password, $name, $birthday, $phone, $address);
        $result = $stmt->execute();

        if (!$result) {
            // Xử lý lỗi khi chèn dữ liệu không thành công
            return false;
        }

        return true;
    }
}
