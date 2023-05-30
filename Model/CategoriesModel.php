<?php

require_once 'Database.php';

class CategoriesModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    function getCategories()
    {
        $query = "SELECT * FROM Categories";
        $result = $this->conn->query($query);

        $categories = array();
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        return $categories;
    }

    public function updateCategoryName($categoryID, $newCategoryName)
    {
        $stmt = $this->conn->prepare("UPDATE Categories SET CategoryName = ? WHERE CategoryID = ?");
        $stmt->bind_param("si", $newCategoryName, $categoryID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        }

        return false;
    }

    public function deleteCategory($categoryID)
    {
        $stmt1 = $this->conn->prepare("DELETE FROM Product_Categories WHERE CategoryID = ?");
        $stmt1->bind_param("i", $categoryID);
        $stmt1->execute();

        $stmt2 = $this->conn->prepare("DELETE FROM Categories WHERE CategoryID = ?");
        $stmt2->bind_param("i", $categoryID);
        $stmt2->execute();

        if ($stmt2->affected_rows > 0) {
            return true;
        }

        return false;
    }

    public function addCategory($categoryName)
    {
        $stmt = $this->conn->prepare("INSERT INTO Categories (CategoryName) VALUES (?)");
        $stmt->bind_param("s", $categoryName);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        }

        return false;
    }
}
