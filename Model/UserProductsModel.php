<?php

require_once 'Database.php';

class Cart {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function ShowCart($user_id) {
        $stmt = $this->conn->prepare("SELECT p.ProductName, up.Quantity, up.CreateDate FROM User_Products up INNER JOIN Products p ON up.ProductID = p.ProductID WHERE up.UserID = ? AND up.Status = 'Pending'");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $cartItems = array();
            while ($row = $result->fetch_assoc()) {
                $cartItems[] = $row;
            }
            return $cartItems;
        }
        
        return false;
    }
    

    public function AddtoCart($user_id, $product_id, $quantity) {
        $stmt = $this->conn->prepare("INSERT INTO User_Products (UserID, ProductID, Quantity, CreateDate) VALUES (?, ?, ?, CURRENT_TIMESTAMP)");
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            return true;
        }
        
        return false;
    }
    
    

    public function RemoveFromCart($user_id, $product_ids) {
        // Chuyển danh sách product_ids thành một chuỗi có dạng (?, ?, ?, ...)
        $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
    
        // Chuẩn bị câu truy vấn DELETE
        $stmt = $this->conn->prepare("DELETE FROM User_Products WHERE UserID = ? AND ProductID IN ($placeholders)");
        
        // Gắn các giá trị vào câu truy vấn
        $stmt->bind_param(str_repeat('i', count($product_ids) + 1), $user_id, ...$product_ids);
        
        // Thực thi câu truy vấn DELETE
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            return true;
        }
        
        return false;
    }
    
}
