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
                                    <button>Đăng nhập </button>
                                    </form>';
                                }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="bar_search">
                        <form action="" method="post">
                            <input type="search" placeholder="Tìm sản phẩm">
                            <button type="submit" value="Tìm kiếm" class="ux-search-submit submit-button secondary button icon mb-0">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="bar_background"></div>
                </div>
            </div>
        </header>

        <!-- Hiển thị danh sách sản phẩm -->
        <h2>Products</h2>
        <ul>
            <?php foreach ($product as $p): ?>
                <li><?php echo $p['ProductName']; ?></li>
            <?php endforeach; ?>
        </ul>

        <!-- Hiển thị danh sách categories -->
        <h2>Categories</h2>
        <ul>
            <?php foreach ($categories as $c): ?>
                <li><?php echo $c['CategoryName']; ?></li>
            <?php endforeach; ?>
        </ul>

        <form action="../../Controller/ProductDetailsController.php" method="post">
        <input type="hidden" name="productID" value="<?php echo $productID; ?>">
        <button type="submit">Xem chi tiết</button>
        </form>

    </div>
</body>
</html>