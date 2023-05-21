<?php
class HomepageModel {
    private $db;

    function __construct($database) {
        $this->db = $database;
    }

    function getProducts() {
        $query = "SELECT * FROM product";
        $result = $this->db->query($query);

        $products = array();
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;
    }

    function getProductById($id) {
        $query = "SELECT * FROM product WHERE id = $id";
        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function getCategories() {
        $query = "SELECT * FROM category";
        $result = $this->db->query($query);

        $categories = array();
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        return $categories;
    }
}
