<?php

require_once __DIR__ . '/Database.php';

class ProductsModel
{
    public function getProducts()
    {
        $db = new Database();
        $connection = $db->getConnection();

        $query = "SELECT * FROM products";
        $result = $connection->query($query);

        $products = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        $connection->close();

        return $products;
    }

    public function getProductDetailsById($productID)
    {
        $db = new Database();
        $connection = $db->getConnection();

        $query = "SELECT * FROM products WHERE ProductID = '$productID'";
        $result = $connection->query($query);

        $productDetails = null;

        if ($result && $result->num_rows > 0) {
            $productDetails = $result->fetch_assoc();
        }

        $connection->close();

        return $productDetails;
    }
}
