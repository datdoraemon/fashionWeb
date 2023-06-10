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

    public function ShowCart($UserID)
    {
        $stmt = $this->conn->prepare("SELECT p.ProductID, p.ProductName, p.Price, up.Quantity, up.CreateDate FROM User_Products up INNER JOIN Products p ON up.ProductID = p.ProductID WHERE up.UserID = ? AND up.Status = 'Pending'");
        $stmt->bind_param("i", $UserID);
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

    public function ShowProductInCart($ProductID)
    {
        $stmt = $this->conn->prepare("SELECT p.ProductID, p.ProductName, p.Price, up.Quantity, up.CreateDate FROM User_Products up INNER JOIN Products p ON up.ProductID = p.ProductID WHERE up.ProductID = ?");
        $stmt->bind_param("i", $ProductID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return false;
    }

    public function AddtoCart($UserID, $ProductID, $quantity)
    {
        $stmt = $this->conn->prepare("INSERT INTO User_Products (UserID, ProductID, Quantity, CreateDate) VALUES (?, ?, ?, CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE Quantity = Quantity + VALUES(Quantity)");
        $stmt->bind_param("iii", $UserID, $ProductID, $quantity);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        }

        return false;
    }

    public function RemoveFromCart($UserID, $ProductIDs)
    {
        $placeholders = implode(',', array_fill(0, count($ProductIDs), '?'));
        $stmt = $this->conn->prepare("DELETE FROM User_Products WHERE UserID = ? AND ProductID IN ($placeholders)");
        $stmt->bind_param(str_repeat('i', count($ProductIDs) + 1), $UserID, ...$ProductIDs);
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

    public function showOrder($UserID)
    {
        $stmt = $this->conn->prepare("SELECT p.ProductName, up.Quantity, up.CreateDate FROM User_Products INNER JOIN Products ON User_Products.ProductID = Products.ProductID WHERE User_Products.UserID = ?");
        $stmt->bind_param("i", $UserID);
        $stmt->execute();
        $result = $stmt->get_result();

        $orderItems = array();
        while ($row = $result->fetch_assoc()) {
            $orderItems[] = $row;
        }

        return $orderItems;
    }
    public function Remove($UserID,$ProductID)
    {
        $stmt = $this->conn->prepare("DELETE FROM User_Products WHERE UserID = ? AND ProductID = ?");
        $stmt->bind_param("ii", $UserID, $ProductID);
        $stmt->execute();
        $result = $stmt->get_result();

        /*$orderItems = array();
        while ($row = $result->fetch_assoc() > 0) {
            $orderItems[] = $row;
        }

        return $orderItems;*/
    }

    public function updateStatus($UserID, $productID, $status)
    {
        $stmt = $this->conn->prepare("UPDATE User_Products SET Status = ? WHERE UserID = ? AND ProductID = ?");
        $stmt->bind_param("sii", $status, $UserID, $productID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        }

        return false;
    }
}
