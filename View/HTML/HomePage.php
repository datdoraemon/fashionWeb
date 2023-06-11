<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Style/HomePage.css">
</head>

<body>
    <?php
    require_once '../../Controller/HomepageController.php';

    $homepageController = new HomepageController();
    $product = $homepageController->getProduct();
    $categories = $homepageController->getCategories();
    ?>

    <div class="container-fluid p-0">
        <header id="header">
            <div class="row">     
                <?php
                    if (isset($_SESSION['UserID']) && $_SESSION['UserID'] != 0) {
                        $userInformation = $homepageController->getUserByEmail($_SESSION['Email']);
                        echo '<div class="col-6">
                               <h4><i class="bi bi-person icon"></i><a href="UpdateInformation.php" style="text-decoration: none; color: white; font-size: 25px;">'.$userInformation['FullName'].
                               '</a></h4></div>';
                        // Nếu $_SESSION['user_id'] tồn tại và khác 0
                        echo '<div class="col-3"><form action="MyOrder.php" method="post">
                        <i class=""></i>
                        <button class="login_button">My Order</button>
                        </form></div>';
                        echo '<div class="col-3"><form action="Loguot.html" method="post">
                        <i class=""></i>
                        <button class="login_button">Đăng xuất </button>
                        </form></div>';
                        } else {
                         // Nếu $_SESSION['user_id'] không tồn tại hoặc bằng 0
                         echo '<form action="Login.php" method="post">
                                <i class=""></i>
                                <button class="login_button">Đăng nhập </button>
                                 </form>';
                        }
                        ?>                       
            </div>
            <div class="row">
                <div class="col-3 brand">FASHION</div>
                <div class="col-6 bar_search_backgroud">
                        <form action="" method="post">                           
                            <input class="bar_search" type="search" placeholder="Tìm sản phẩm">                             
                            <div class="search_button">
                                <button type="submit" value="Tìm kiếm">
                                    <h1><i class="bi bi-search"></i></h1>
                                </button>
                            </div>                              
                        </form>
                </div>
                <div class="col-3"><!-- Thêm nút Giỏ hàng -->
                    <a id="cart" href="Cart.php"><h2 class="cart"><i class="bi bi-cart3">  Giỏ hàng</i></h2></a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="bar_background">
                        <ul class="ul">
                            <li class="li"><a class="a" href="HomePage.php">TRANG CHỦ</a></li>
                            <?php foreach ($categories as $c) : ?>
                                <li class="li"><a class="a" href=""><?php echo $c['CategoryName']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <section>
            <div class="container">
                <?php  
                    foreach($categories as $category) 
                    {   
                        $categoryID = $category['CategoryID']; 
                        echo "<div class='row'>
                                <div class='col-3 category_name'>".$category['CategoryName']."</div>
                              </div><br>";
                                   
                        $productsByCategory = $homepageController->getProductsByCategory($categoryID);   
                        echo "<div class='row'>";              
                        foreach($productsByCategory as $product)
                        {                             
                            $productID = $product['ProductID']; 
                            $productImg = $product['ProductImg'];                                
                            echo "<div class='col-3 card card_format' style='width: 18rem;'>  
                                    <img class='card-img-top' src='$productImg'>                            
                                    <div class='card-body'>
                                        <h5 class='card-title'>" .$product['ProductName']."</h5>
                                        <p class='card-text'>
                                            <form action='ProductDetails.php' method='post'>
                                                <input type='hidden' name='productID' value='$productID'>
                                                <button type='submit' name='submit' value='submit'>Xem chi tiết</button>
                                            </form>
                                        </p>
                                    </div>
                                </div>
                            ";
                        }
                        echo "</div><br><br>";
                    }
                ?>
            </div>
        </section>

        <footer class="container-fluid p-0 footer">
            <div class="row">
                <div class = "col-8">
                    <div class="footer_box">
                        <h2>Về chúng tôi</h2>
                        <p>Shop : fashionweb</p>
                        <p>Phone : 911</p>
                        <p>Email : fashion@gmail.com</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="footer_box">
                    <h2>Liên hệ</h2>
                    <h2><i class="bi bi-facebook icon"></i></h2>
                    <h2><i class="bi bi-instagram icon"></i></h2>
                    <h2><i class="bi bi-tiktok icon"></i></h2>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>