<?php

require_once 'Database.php';

class ProductsModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    function getProducts()
    {
        $query = "SELECT * FROM products";
        $result = $this->conn->query($query);

        $products = array();
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;
    }

    function getProductDetailsById($productID)
    {
        $query = "SELECT * FROM Products WHERE ProductID = $productID";
        $result = $this->conn->query($query);
        return $result->fetch_assoc();

        if ($result->num_rows > 0) {
        } else {
            return null;
        }
    }
}
