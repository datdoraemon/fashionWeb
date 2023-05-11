<?php
require_once('Model/HomepageModel.php');

class HomepageController {
    private $model;

    function __construct($model) {
        $this->model = $model;
    }

    function invoke() {
        $products = $this->model->getProducts();
        $categories = $this->model->getCategories();

        include 'View/HTML/Homepage.html';
    }

    function showProductDetail($id) {
        $product = $this->model->getProductById($id);

        if ($product != null) {
            include 'View/HTML/ProductDetail.html';
        } else {
            include 'View/HTML/404.html';
        }
    }
}
