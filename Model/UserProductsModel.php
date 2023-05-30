<?php

require_once 'Database.php';

class CartModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function ShowCart($user_id)
    {
        $stmt = $this->conn->prepare("SELECT p.ProductID, p.ProductName, p.Price, up.Quantity, up.CreateDate FROM User_Products up INNER JOIN Products p ON up.ProductID = p.ProductID WHERE up.UserID = ? AND up.Status = 'Pending'");
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

    public function AddtoCart($user_id, $product_id, $quantity)
    {
        $stmt = $this->conn->prepare("INSERT INTO User_Products (UserID, ProductID, Quantity, CreateDate) VALUES (?, ?, ?, CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE Quantity = Quantity + VALUES(Quantity)");
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        }

        return false;
    }





    public function RemoveFromCart($user_id, $product_ids)
    {
        $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
        $stmt = $this->conn->prepare("DELETE FROM User_Products WHERE UserID = ? AND ProductID IN ($placeholders)");
        $stmt->bind_param(str_repeat('i', count($product_ids) + 1), $user_id, ...$product_ids);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        }

        return false;
    }
}

class OrderModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function showOrder($userID)
    {
        $stmt = $this->conn->prepare("SELECT p.ProductName, up.Quantity, up.CreateDate FROM User_Products INNER JOIN Products ON User_Products.ProductID = Products.ProductID WHERE User_Products.UserID = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        $orderItems = array();
        while ($row = $result->fetch_assoc()) {
            $orderItems[] = $row;
        }

        return $orderItems;
    }

    public function updateStatus($userID, $productID, $status)
    {
        $stmt = $this->conn->prepare("UPDATE User_Products SET Status = ? WHERE UserID = ? AND ProductID = ?");
        $stmt->bind_param("sii", $status, $userID, $productID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        }

        return false;
    }
}
