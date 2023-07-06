<?php session_start();
    
    require_once __DIR__ . '/../Model/AdminModel.php';
    class InforSellerController
    {
        public function UpdateInforSeller()
        { 
            if($_SERVER['REQUEST_METHOD'] == "POST")
            { 
                if($_POST['submit'] == "Submit")
                {  
                    if (
                        isset($_POST['name']) && isset($_POST['birthday'])
                        && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['sellerID'])
                    ){
                    $name = trim($_POST['name']);
                    $birthday = trim($_POST['birthday']);
                    $phone = trim($_POST['phone']);
                    $address = trim($_POST['address']);
                    $shopname = trim($_POST['shopname']);
                    $name = htmlspecialchars($name);
                    $birthday = htmlspecialchars($birthday);
                    $phone = htmlspecialchars($phone);
                    $address = htmlspecialchars($address);
                    $shopname = htmlspecialchars($shopname);
                    $name = stripslashes($name);
                    $birthday = stripslashes($birthday);
                    $phone = stripslashes($phone);
                    $address = stripslashes($address);
                    $shopname = stripslashes($shopname);
                    $SellerID = $_POST['sellerID'];
                    $AdminModel = new AdminModel();
                    $AdminModel->updateAdminInformation($SellerID, $name, $birthday, $address, $phone);
                    $AdminModel->CreateShop($shopname);
                    $shop = $AdminModel->getShopIDLast();
                    $shopID = $shop['ShopID'];
                    $AdminModel->SaveShop($SellerID, $shopID);
                    header('Location: ../View/HTML/LogIn_Admin.php'); 
                    }
                }
            }
        }
    }
    $InforSellerController = new InforSellerController();

    if (
        isset($_POST['name']) && isset($_POST['birthday'])
        && isset($_POST['phone']) && isset($_POST['address'])
    ) {
        $InforSellerController->UpdateInforSeller();
    }
?>