<?php
    require_once __DIR__ . '/../Model/UserProductsModel.php';
    class PayMentController
    {
        public function index(){
            header('Location: ../View/HTML/Cart.php');
        }

        public function PayMent(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selectedProducts'])) {
                // Lấy danh sách sản phẩm được chọn từ POST data
                $selectedProducts = $_POST['selectedProducts'];
        
            } else {
                // Nếu không nhận được dữ liệu từ trang Cart.php, chuyển hướng người dùng về trang Cart.php
                header('Location: ../View/HTML/Cart.php');
                exit();
            }
            session_start();
            $UserID = $_SESSION['UserID'];
            $Status = "Processing";
            $selectedProductsArray  = explode(',', $selectedProducts);
            $payMent = new OrderModel();
            foreach ($selectedProductsArray as $ProductID) {
                $payMent->updateStatus($UserID, $ProductID, $Status);
            }
        }
    }

    $ConfirmOrder = new PayMentController();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selectedProducts'])) {
        $ConfirmOrder->PayMent();
        header('Location: ../View/HTML/Cart.php');
    }else {
        $ConfirmOrder->index();
    }