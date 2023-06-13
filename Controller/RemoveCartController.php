<?php 

require_once __DIR__ . '/../Model/UserProductsModel.php';

class RemoveCartController
{
    public function index()
    {
        header("Location: ../View/HTML/Cart.php");
    }
    public function RemoveProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selectedProducts'])) {
            // Lấy danh sách sản phẩm được chọn từ POST data
            $selectedProducts = $_POST['selectedProducts'];
    
            // Xóa session để tránh việc lưu lại thông tin đơn hàng sau khi đã hoàn thành
            unset($_SESSION['selectedProducts']);
        } else {
            // Nếu không nhận được dữ liệu từ trang Cart.php, chuyển hướng người dùng về trang Cart.php
            header('Location: Cart.php');
            exit();
        }

        session_start();
        $UserID = $_SESSION['UserID'];
        $selectedProducts = explode(',', $selectedProducts);
        $productModel = new CartModel();
        foreach ($selectedProducts as $ProductID) {
            $productModel->RemoveFromCart($UserID,$ProductID);
        }
        header("Location: ../View/HTML/Cart.php");
    }
}

$removeCart = new RemoveCartController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selectedProducts'])) {
	$removeCart->RemoveProduct();
}else {
    $removeCart->index();
}
