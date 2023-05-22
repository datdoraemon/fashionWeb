<?php
require_once '../Model/Cart.php';
session_start();
$userID = $_SESSION['user_id'];
$productID = $_POST['product_id'];
$quantity = $_POST['quantity'];
$cart = new Cart();
$addCart = $cart->AddtoCart($userID, $productID, $quantity);
if ($addCart) {
    echo "Sản phẩm đã được thêm vào giỏ hàng.";
} else {
    echo "Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.";
}
?>
