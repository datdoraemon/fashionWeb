<?php
session_start();
require_once __DIR__ . '/../Model/UserProductsModel.php';

if (!isset($_SESSION['UserID'])) {
  // Người dùng chưa đăng nhập, hiển thị thông báo và chuyển hướng đến trang đăng nhập
  $_SESSION['cart_message'] = "Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.";
  header("Location: ../View/HTML/Login.php");
  exit();
}

if (isset($_POST['productID'], $_POST['quantity'])) {
  // Xử lý và kiểm tra tính hợp lệ của dữ liệu đầu vào
  $UserID = $_SESSION['UserID'];
  $productID = (int) $_POST['productID'];
  $quantity = (int) $_POST['quantity'];

  // Sử dụng Prepared Statements để tránh SQL Injection
  $userProductsModel = new CartModel();
  $result = $userProductsModel->AddtoCart($UserID, $productID, $quantity);

  if ($result) {
    $_SESSION['cart_message'] = "Sản phẩm đã được thêm vào giỏ hàng.";
    $_SESSION['temp_productID'] = $_POST['productID'];
    header("Location: ../View/HTML/ProductDetails.php");
  } else {
    $_SESSION['cart_message'] = "Thêm vào giỏ hàng thất bại!";
    $_SESSION['temp_productID'] = $_POST['productID'];
    header("Location: ../View/HTML/ProductDetails.php");
  }
}
exit();
