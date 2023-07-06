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

        // Sử dụng Prepared Statement để tránh lỗi SQL Injection
        $query = "SELECT * FROM Products WHERE ProductID = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $productID);
        $stmt->execute();

        $result = $stmt->get_result();

        $productDetails = null;

        if ($result && $result->num_rows > 0) {
            $productDetails = $result->fetch_assoc();
        }

        $stmt->close();
        $connection->close();

        return $productDetails;
    }

    public function Page()
    {
        $db = new Database();
        $connection = $db->getConnection();
        $sql = "SELECT * FROM Products";
                    $result= $conn->query($sql);
                    if($result->num_rows > 0)
                    {
                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $limit = 6;
                        $total_results = $result->num_rows; 
                        
                        $total_page = ceil($total_results / $limit);
                        
                        
                        if ($current_page > $total_page){
                            $current_page = $total_page;
                        }
                        else if ($current_page < 1){
                            $current_page = 1;
                        }
                        
                        
                        $start = ($current_page - 1) * $limit;
                        $result = mysqli_query($conn, "SELECT * FROM Products LIMIT $start, $limit");
                    }
    }
}
