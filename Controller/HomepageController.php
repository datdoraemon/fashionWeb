<?php
require_once __DIR__ . '/../Model/ProductsModel.php';
require_once __DIR__ . '/../Model/CategoriesModel.php';


class HomepageController{
    public function getProduct() {
        $productModel = new ProductsModel();
        return $productModel->getProducts();
    }
    
    public function getCategories() {
        $categoriesModel = new CategoriesModel();
        return $categoriesModel->getCategories();
    }    
}
?>
