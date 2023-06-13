<?php
session_start();
require_once __DIR__ . '/../../Controller/ConfirmOrderController.php';
require_once __DIR__ . '/../../Controller/ShowCartController.php';
require_once __DIR__ . '/../../Controller/HomePageController.php';

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['UserID']) || $_SESSION['UserID'] == 0) {
    // Chuyển hướng người dùng đến trang đăng nhập nếu chưa đăng nhập
    header('Location: Login.php');
    exit();
}

// Kiểm tra xem đã nhận được dữ liệu từ trang Cart.php chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selectedProducts'])) {
    // Lấy danh sách sản phẩm được chọn từ POST data
    $selectedProducts = $_POST['selectedProducts'];

    // Xóa session để tránh việc lưu lại thông tin đơn hàng sau khi đã hoàn thành
    unset($_SESSION['selectedProducts']);
} else {
    // Nếu không nhận được dữ liệu từ trang Cart.php, chuyển hướng người dùng về trang Cart.php
    header('Location: Cart.php');
    exit();
}

$user = new ConfirmOrderController();
$homepageController = new HomepageController();
$userInfo = $user->UserConfirm($_SESSION['UserID']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Order</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Style/HomePage.css">
</head>

<body>
<div class="container-fluid p-0" style="height: 100vh;">
        <header id="header">
            <div class="row" style="margin-left: 0; margin-right: 0;">     
                <?php
                    if (isset($_SESSION['UserID']) && $_SESSION['UserID'] != 0) {
                        $userInformation = $homepageController->getUserByEmail($_SESSION['Email']);
                        echo '<div class="col-6" style="padding-left: 0; padđing-right: 0;">
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
            <div class="row" style="margin-left: 0; margin-right: 0;">
                <div class="col-3 brand">FASHION</div>
                <div class="col-6 bar_search_backgroud">
                        <form action="" method="post">                           
                            <input class="bar_search" type="search" placeholder="Tìm sản phẩm">                             
                            <div class="search_button">
                           <button type="submit" value="Tìm kiếm">
                           <h1> <i class="bi bi-search"></i></h1>
                            </button>                                 
                            </div>                              
                        </form>
                </div>
                <div class="col-3"><!-- Thêm nút Giỏ hàng -->
                    <a id="cart" href="Cart.php"><h2 class="cart"><i class="bi bi-cart3">  Giỏ hàng</i></h2></a>
                </div>
            </div>
            <div class="row" style="margin-left: 0; margin-right: 0;">
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
            <h1>XÁC NHẬN ĐƠN HÀNG</h1>

            <h2 style="font-weight: bold;">Thông tin người dùng:</h2>
            <p>Tên người dùng: <?php echo $userInfo['FullName']; ?></p>
            <p>Số điện thoại: <?php echo $userInfo['Phone']; ?></p>
            <p>Địa chỉ: <?php echo $userInfo['Address']; ?></p>

            <h2>Danh sách sản phẩm:</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ProductID</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                    </tr>
                </thead>
                <tbody>
                <?php $showcartController = new ShowCartController();
                $selectedProductsArray  = explode(',', $selectedProducts);
                ?>
                    <?php foreach ($selectedProductsArray as $productID) : ?>
                        <?php $productDetails = $showcartController->GetShowProductInCart($productID);?>
                        <tr>
                            <td><?php echo $productID; ?></td>
                            <td><?php echo $productDetails['ProductName']; ?></td>
                            <td><?php echo $productDetails['Quantity']; ?></td>
                            <td><?php echo $productDetails['Price']; ?></td>
                        </tr>
                        <?php $totalAmount = 0;
                            foreach ($selectedProductsArray as $productID) {
                                $productDetails = $showcartController->GetShowProductInCart($productID);
                                $totalAmount += $productDetails['Price'] * $productDetails['Quantity'];
                            }
                        ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2>Tổng số tiền: <?php echo $totalAmount; ?></h2>

            <form action="../../Controller/PayMentController.php" method="post">
                <input type="hidden" name="selectedProducts" value="<?php echo $selectedProducts; ?>">
                <input type="submit" value="Thanh toán">
            </form>
            </div>
        </section>

        <footer class="container-fluid p-0 footer" style="margin-left: 0; margin-right: 0;">
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
