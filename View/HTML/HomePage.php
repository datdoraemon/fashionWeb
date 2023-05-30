<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/2087e648a1.js" crossorigin="anonymous"></script>
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
                <div class="col-12 top_header">
                    <ul class="ul">
                        <li class="">
                            <?php
                            session_start();
                            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != 0) {
                                // Nếu $_SESSION['user_id'] tồn tại và khác 0
                                echo '<form action="Loguot.html" method="post">
                                    <i class=""></i>
                                    <button>Đăng xuất </button>
                                    </form>';
                            } else {
                                // Nếu $_SESSION['user_id'] không tồn tại hoặc bằng 0
                                echo '<form action="Login.html" method="post">
                                    <i class=""></i>
                                    <button class="login_button">Đăng nhập </button>
                                    </form>';
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-3 brand">FASHION</div>
                <div class="col-6 bar_search_backgroud">
                        <form action="" method="post">
                            <input class="bar_search" type="search" placeholder="Tìm sản phẩm">
                            <button type="submit" value="Tìm kiếm">
                                <h1><i class="fa-solid fa-magnifying-glass search_button"></i></h1>
                            </button>
                        </form>
                </div>
                <div class="col-3"><!-- Thêm nút Giỏ hàng -->
                    <a href="Cart.php">Giỏ hàng</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="bar_background">
                        <?php 
                           include('../../Model/CategoriesModel.php');
                           $instance = new CategoriesModel();
                           $categorieslist = $instance.getCategories();
                           echo "<ul class=\"ul\">
                                     <li class=\"li\">
                                         <a class=\"a\">$categorieslist</a>
                                     </li>
                                 </ul>";
                        ?>
                    </div>
                </div>
            </div>
        </header>

        <!-- Hiển thị danh sách sản phẩm -->
        <h2>Products</h2>
        <ul>
            <?php foreach ($product as $p) : ?>
                <li><?php echo $p['ProductName']; ?></li>
                <form action="ProductDetails.php" method="post">
                    <input type="hidden" name="productID" value="<?php echo $p['ProductID']; ?>">
                    <?php echo $p['ProductID'];?>
                    <button type="submit">Xem chi tiết</button>
                </form>
            <?php endforeach; ?>
        </ul>

        <!-- Hiển thị danh sách categories -->
        <h2>Categories</h2>
        <ul>
            <?php foreach ($categories as $c) : ?>
                <li><?php echo $c['CategoryName']; ?></li>
            <?php endforeach; ?>
        </ul>

    </div>
</body>

</html>