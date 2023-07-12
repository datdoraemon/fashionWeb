<?php

require_once __DIR__ . '/../Model/ProductsModel.php';

class ProductDetailsController
{
    public function getProductDetails($productID)
    {
        $productModel = new ProductsModel();
        $productDetails = $productModel->getProductDetailsById($productID);
        return $productDetails;
    }
}
?>
