<?php

require_once 'Database.php';

class UsersModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getUserByEmail($email) {        
        $stmt = $this->conn->prepare("SELECT * FROM Users WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            return $user;
        }

        return false;
    }

    public function getUserByEmailAndPassword($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM Users WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['Password'])) {
                return $user;
            }
        }
    
        return false;
    }

    public function createUser($email, $password, $name, $birthday, $phone, $address) {
        $stmt = $this->conn->prepare("INSERT INTO Users (Email, Password, FullName, Birthday, Phone, Address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $email, $password, $name, $birthday, $phone, $address);
        $result = $stmt->execute();

        if (!$result) {
            return false;
        }

        return true;
    }
}
