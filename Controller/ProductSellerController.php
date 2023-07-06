<?php
//session_start();
require_once __DIR__ . '/../Model/AdminModel.php';

class ProductSellerController
{
    public function Add_Product()
    {   
        if ($_SERVER['REQUEST_METHOD']=="POST")
                {
                    if($_POST['submit'] == "Submit")
                    {
                        if(isset($_POST['sellerid']) && isset($_POST['shopID']) && isset($_POST['productname'])
                        && isset($_POST['category']) && isset($_POST['description']) && isset($_POST['price']) 
                        && isset($_POST['quantity']))    
                        {
                            $sellerID = $_POST['sellerid'];
                            $shopID = $_POST['shopID'];
                            $productname = $_POST['productname'];
                            $category = $_POST['category'];
                            $description = $_POST['description'];
                            $price = $_POST['price'];
                            $quantity = $_POST['quantity'];
                            $target_dir = "../uploadimg/";                  
                            $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);                       
                            $uploadOk = 1;
                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));                           
                            $check= getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                            if($check !== false)
                            {
                                $check["mime"];
                                $uploadOk = 1;
                                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file))
                                {
                                    $url=""; 
                                    $url = "/PROJECT_2/fashionWeb/uploadimg/".basename($_FILES["fileToUpload"]["name"]);                                                            
                                }
                                else
                                {
                                    echo "File is not an image.";
                                    $uploadOk=0;
                                }
                            } 
                           $products = new AdminModel();
                           
                           $add_product = $products->InsertProduct($productname, $description, $price, $quantity, $url);
                           $getCategoryName = $products->getCategoryNameByShopID($shopID);
                           foreach($getCategoryName as $categories)
                           {
                            if($category == $categories['CategoryName'])
                            {
                                $productID = $products->getProductIDLast();         
                               $save_product = $products->SaveProduct($categories['CategoryID'], $productID['ProductID']);
                               echo '<script>alert("Đã lưu.");window.location.href="../View/HTML/Shop_Admin.php";</script>';

                            }
                            else
                            {
                                $add_category = $products->InsertCategory($category);
                                $categoryID = $products->getCategoryIDLast();
                                $save_category = $products->SaveCategory($shopID, $categoryID['CategoryID']);
                                $productID = $products->getProductIDLast();
                                $save_product = $products->SaveProduct($categoryID['CategoryID'], $productID['ProductID']);
                                $_SESSION['notice'] = "Đã lưu";
                            }  
                           }
                           
                        }
                }
            }
    }
}
$newProducts = new ProductSellerController();

if(isset($_POST['sellerid']) && isset($_POST['shopID']) && isset($_POST['productname'])
&& isset($_POST['category']) && isset($_POST['description']) && isset($_POST['price']) 
&& isset($_POST['quantity'])) {
	$newProducts->Add_Product();
}
?>