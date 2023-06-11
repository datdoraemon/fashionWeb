<?php
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
    echo $selectedProducts;