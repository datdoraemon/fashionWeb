<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/2087e648a1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Style/HomePage.css">
</head>
<body>
    <div class="container-fluid p-0">
        <header id="header">
            <div class="row">
                <div class="text-center col-12">Chào mừng bạn đến với website</div>
            </div>
            <div class="row">
                <div class="logo col-2">

                </div>
                <div class="col-7">
                    <form action="" method="post">
                        <input type="search" placeholder="Tìm sản phẩm">
                        <button type="submit" value="Tìm kiếm" class="ux-search-submit submit-button secondary button icon mb-0">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
                <div class="col-3">
                    <ul class="">
                        <li class="">
                            <a href="#" title="Giỏ hàng" class="">
                                <span class="image-icon header-cart-icon" data-icon-label="0">
                                    <img class="cart-img-icon" alt="Giỏ hàng" src="http://balo.sharekhoahoc.vn/wp-content/uploads/2020/08/hd_mainmenu_icon_cart.png">
                                </span>
                                <span class="">Giỏ hàng </span>
                            </a>
                            <ul class="nav-dropdown">
                                <li class="">
                                    <div class="">
                                        <p class="">Chưa có sản phẩm trong giỏ hàng.</p>
                                    </div>
                                </li>
                            </ul>
                        </li>
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
        </header>

        <form action="ProductDetailsController.php" method="post">
        <input type="hidden" name="productID" value="<?php echo $productID; ?>">
        <button type="submit">Xem chi tiết</button>
        </form>

    </div>
</body>
</html>