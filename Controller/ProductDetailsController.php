<?php
    // ProductDetailsController.php
    require_once '../Model/ProductsModel.php';

    if (isset($_POST['productID'])) {
    $productID = $_POST['productID'];
    $productModel = new ProductsModel();
    $productDetails = $productModel->getProductDetailsById($productID);

    // Chuyển dữ liệu về cho View
    require_once '../View/HTML/ProductDetails.php';
    }
