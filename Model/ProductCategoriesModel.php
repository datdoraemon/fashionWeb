<?php

require_once 'Database.php';

class ProductCategoriesModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getProductsByCategory($categoryID)
{
    try {
        $stmt = $this->conn->prepare("SELECT p.ProductID, p.ProductName, p.Description, p.Price, p.Quantity, p.SoldQuantity, p.ProductImg FROM Products p INNER JOIN Product_Categories pc ON p.ProductID = pc.ProductID WHERE pc.CategoryID = ?");
        $stmt->bind_param("i", $categoryID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $products = array();
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
            return $products;
        }

        return false;
    } catch (Exception $e) {
        // Xử lý lỗi tại đây
        echo "Error: " . $e->getMessage();
    }
}



    public function getCategoriesByProductID($productID)
    {
        $stmt = $this->conn->prepare("SELECT c.CategoryName FROM Categories c INNER JOIN Product_Categories pc ON c.CategoryID = pc.CategoryID WHERE pc.ProductID = ?");
        $stmt->bind_param("i", $productID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $categories = array();
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row['CategoryName'];
            }
            return $categories;
        }

        return false;
    }

    public function addProductToCategories($productID, $categoryIDs)
    {
        $success = true;

        foreach ($categoryIDs as $categoryID) {
            $stmt = $this->conn->prepare("INSERT INTO Product_Categories (CategoryID, ProductID) VALUES (?, ?)");
            $stmt->bind_param("ii", $categoryID, $productID);
            if (!$stmt->execute()) {
                $success = false;
            }
        }

        return $success;
    }

    public function removeProductFromCategory($productID, $categoryID)
    {
        $stmt = $this->conn->prepare("DELETE FROM Product_Categories WHERE CategoryID = ? AND ProductID = ?");
        $stmt->bind_param("ii", $categoryID, $productID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        }

        return false;
    }
}
