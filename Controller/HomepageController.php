<?php
require_once __DIR__ . '/../Model/ProductsModel.php';
require_once __DIR__ . '/../Model/CategoriesModel.php';
require_once __DIR__ . '/../Model/ProductCategoriesModel.php';
require_once __DIR__ . '/../Model/ProductsModel.php';
require_once __DIR__ . '/../Model/UsersModel.php';


class HomepageController
{
    public function getProduct()
    {
        $productModel = new ProductsModel();
        return $productModel->getProducts();
    }

    public function getCategories()
    {
        $categoriesModel = new CategoriesModel();
        return $categoriesModel->getCategories();
    }
    
    public function getProductsByCategory($categoryID)
    {
        $productModel = new ProductCategoriesModel();
        return $productModel->getProductsByCategory($categoryID);
    }
    public function getProductDetailsById($productID)
    {
        $productdetail = new ProductsModel();
        return $productdetail->getProductDetailsById($productID);
    }
    public function getUserByEmail($email)
    {
        $User = new UsersModel();
        return $User->getUserByEmail($email);
    }
    public function Page($categoryID,$start,$limit)
    {
        $Page = new ProductsModel();
        return $Page->Page($categoryID,$start,$limit);
    }
    public function Search($productname)
    {
        $search = new ProductsModel();
        return $search->SearchProduct($productname);
    }
}
