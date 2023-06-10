<?php session_start();

require_once __DIR__ . '/../Model/UserProductsModel.php';

class RemoveCartController
{
    public function RemoveProduct()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if($_POST['submit'] == "Remove")
            {
                $UserID = $_POST['userid'];
                $ProductID = $_POST['productID'];
                $_SESSION['userid'] = $UserID;
                $_SESSION['productid'] = $ProductID;
                $productModel = new OrderModel();
                $productDetails = $productModel->Remove($UserID,$ProductID);
                header('Location: ../View/HTML/Cart.php');
            }
        }
    }
}
$RemoveController = new RemoveCartController();

    if (
        isset($_POST['userid']) && isset($_POST['productID'])
    ) {
        $RemoveController->RemoveProduct();
    }
?>
