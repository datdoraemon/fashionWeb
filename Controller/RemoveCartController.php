<?php

require_once __DIR__ . '/../Model/UserProductsModel.php';

class RemoveCartController
{
    public function RemoveProduct()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if($_POST['submit'] == "Remove")
            {
                $UserID = $_POST['']
            }
        }
        $productModel = new UserProductsModel();
        $productDetails = $productModel-Remove($UserID,$ProductID);
        return $productDetails;
    }
}
