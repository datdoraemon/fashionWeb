<?php

require_once 'Database.php';

class UsersModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
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

    public function checkPhoneNumberExists($phone) {
        $stmt = $this->conn->prepare("SELECT UserID FROM Users WHERE Phone = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            return true;
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

    public function deleteUser($userID) {
        $stmt = $this->conn->prepare("DELETE FROM Users WHERE UserID = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            return true;
        }
    
        return false;
    }
    
    public function changePassword($userID, $oldPassword, $newPassword) {
        $stmt = $this->conn->prepare("SELECT Password FROM Users WHERE UserID = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();
    
            if (password_verify($oldPassword, $hashedPassword)) {
                $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
                $updateStmt = $this->conn->prepare("UPDATE Users SET Password = ? WHERE UserID = ?");
                $updateStmt->bind_param("si", $newHashedPassword, $userID);
                $updateStmt->execute();
    
                if ($updateStmt->affected_rows > 0) {
                    return true;
                }
            }
        }
    
        return false;
    }
    
    public function updateUserInformation($userID, $fullname, $birthday, $address, $phone) {
        $stmt = $this->conn->prepare("UPDATE Users SET FullName = ?, Birthday = ?, Address = ?, Phone = ? WHERE UserID = ?");
        $stmt->bind_param("ssssi", $fullname, $birthday, $address, $phone, $userID);
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            return true;
        }
    
        return false;
    }
    
}