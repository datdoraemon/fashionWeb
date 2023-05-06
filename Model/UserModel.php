<?php

require_once 'Database.php';

class UserModel {
    
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getUserByUsernameAndPassword($username, $password) {
        $conn = $this->db->getConnection();
        
        // $hashedPassword = md5($password);
        
        $sql = "SELECT * FROM user WHERE Email = '$username' AND Password = '$password'";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user;
        } else {
            return false;
        }
    }
    
}
