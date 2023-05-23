<?php
session_start();
require_once '../Model/UserProductsModel.php';

if (isset($_POST['productID'], $_POST['quantity'])) {
  $userID = $_SESSION['user_id'];
  $productID = $_POST['productID'];
  $quantity = $_POST['quantity'];

  $userProductsModel = new CartModel();
  $result = $userProductsModel->AddtoCart($userID, $productID, $quantity);

  if ($result) {
    $_SESSION['cart_message'] = "Sản phẩm đã được thêm vào giỏ hàng.";
  } else {
    $_SESSION['cart_message'] = "Thêm vào giỏ hàng thất bại!";
  }
}

header("Location: ProductDetails.php");
exit();
