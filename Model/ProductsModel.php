<?php
require_once 'Database.php';
class ProductsModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    function getProducts() {
        $query = "SELECT * FROM Products";
        $result = $this->conn->query($query);

        $products = array();
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;
    }

    function getProductDetailsById($id) {
        $query = "SELECT * FROM Products WHERE ProductID = $id";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function getCategories() {
        $query = "SELECT * FROM Categories";
        $result = $this->conn->query($query);

        $categories = array();
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        return $categories;
    }
}
