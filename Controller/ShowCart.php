<?php
require_once __DIR__ . '/../Model/UserProductsModel.php';

function ShowCart($user_id)
{
    // Tạo một đối tượng UserProductsModel
    $userProductsModel = new CartModel();

    // Gọi phương thức ShowCart để lấy danh sách giỏ hàng
    $cartItems = $userProductsModel->ShowCart($user_id);

    // Kiểm tra xem có sản phẩm trong giỏ hàng hay không
    if (!empty($cartItems)) {
        // Hiển thị danh sách sản phẩm trong giỏ hàng
        foreach ($cartItems as $item) {
            echo "Product ID: " . $item['ProductID'] . "<br>";
            echo "Product Name: " . $item['ProductName'] . "<br>";
            echo "Price: " . $item['Price'] . "<br>";
            echo "Quantity: " . $item['Quantity'] . "<br>";
            echo "<br>";
        }
    } else {
        echo "Giỏ hàng của bạn đang trống.";
    }
}
