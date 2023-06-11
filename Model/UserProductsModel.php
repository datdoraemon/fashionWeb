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
        $stmt = $this->conn->prepare("SELECT p.ProductID, p.ProductName, p.Price, up.Quantity, up.CreateDate FROM User_Products up INNER JOIN Products p ON up.ProductID = p.ProductID WHERE up.ProductID = ? AND up.Status = 'Pending'");
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
        $stmt = $this->conn->prepare("SELECT * FROM User_Products WHERE UserID = ? AND ProductID = ? AND Status = 'Pending'");
        $stmt->bind_param("ii", $UserID, $ProductID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Nếu đã tồn tại trong bảng, cộng thêm quantity
            $stmt = $this->conn->prepare("UPDATE User_Products SET Quantity = Quantity + ? WHERE UserID = ? AND ProductID = ? AND Status = 'Pending'");
            $stmt->bind_param("iii", $quantity, $UserID, $ProductID);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                return true;
            }
        } else {
            // Nếu chưa tồn tại trong bảng, thêm mới
            $stmt = $this->conn->prepare("INSERT INTO User_Products (UserID, ProductID, Quantity, CreateDate, Status) VALUES (?, ?, ?, CURRENT_TIMESTAMP, 'Pending')");
            $stmt->bind_param("iii", $UserID, $ProductID, $quantity);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                return true;
            }
        }

        return false;
    }

    public function RemoveFromCart($UserID, $ProductID)
    {
        $stmt = $this->conn->prepare("DELETE FROM User_Products WHERE UserID = ? AND ProductID = ?");
        $stmt->bind_param("ii", $UserID, $ProductID);
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

    public function ShowOrder($UserID, $Status)
    {
        $stmt = $this->conn->prepare("SELECT p.ProductID, p.ProductName, p.Price, up.Quantity, up.CreateDate FROM User_Products up INNER JOIN Products p ON up.ProductID = p.ProductID WHERE up.UserID = ? AND up.Status = ?");
        $stmt->bind_param("is", $UserID, $Status);
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
    public function Remove($UserID,$ProductID)
    {
        $stmt = $this->conn->prepare("DELETE FROM user_products WHERE UserID = ? AND ProducID = ?");
        $stmt->bind_param("ii", $UserID, $ProductID);
        $stmt->execute();
        $result = $stmt->get_result();

        $orderItems = array();
        while ($row = $result->fetch_assoc()) {
            $orderItems[] = $row;
        }

        return $orderItems;
    }

    public function updateStatus($UserID, $productID, $Status)
    {
        $stmt = $this->conn->prepare("UPDATE User_Products SET Status = ? WHERE UserID = ? AND ProductID = ? AND Status = 'Pending'");
        $stmt->bind_param("sii", $Status, $UserID, $productID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        }

        return false;
    }
}
