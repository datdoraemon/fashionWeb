<?php
session_start();
require_once '../../Controller/ShowCartController.php';
require_once '../../Controller/HomepageController.php';

$homepageController = new HomepageController();
$product = $homepageController->getProduct();
$categories = $homepageController->getCategories();
$showcartController = new ShowCartController();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['UserID']) || $_SESSION['UserID'] == 0) {
    echo 'Vui lòng đăng nhập để xem giỏ hàng';
    echo '<form action="Login.php" method="post">
        <i class=""></i>
        <button class="login_button">Oke </button>
        </form>';
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Style/HomePage.css">
</head>

<body>
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
                         echo '<div class="col-6"><form action="Loguot.html" method="post">
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
                    <a id="cart" href="Cart.php">
                        <h2 class="cart"><i class="bi bi-cart3"> Giỏ hàng</i></h2>
                    </a>
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
            <div class="row">
                <div class="col-9 mx-auto">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ProductID</th>
                        <th scope="col">Name of Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $showcart = $showcartController->GetShowCart($_SESSION['UserID']);
                            $Userid = $_SESSION['UserID'];
                            if($showcart == NULL)
                            {
                                echo "<tr>
                                    <td scope='row'>Không có sản phẩm trong giỏ hàng</td>
                                    </tr>";
                            }
                            if ($showcart != NULL) {
                                foreach ($showcart as $s) {
                                    echo "<tr>
                                    <td scope='row'>" . $s['ProductID'] . "</td>
                                    <td>" . $s['ProductName'] . "</td>
                                    <td class='price'>" . $s['Price'] . "</td>
                                    <td>" . $s['Quantity'] . "</td>
                                    <td class='total'>" . ($s['Price'] * $s['Quantity']) . "</td>
                                    <td>
                                        <input type='checkbox' name='selectedProducts[]' value='" . $s['ProductID'] . "'>
                                    </td>
                                    </tr>";
                                }
                            }                          
                        ?>
                        <?php 
                        
                        ?>
                    </tbody>
                </table>
                </div>
            </div>

            <!-- Hiển thị tổng số tiền, nút xóa và nút thanh toán -->
            <div class="row">
                <div class="col-9" style="margin-left: 12%;">
                <div class="total-amount-container">
                    <h3>Tổng số tiền: <span class="total-amount">0</span></h3>
                </div>

                <form id="remove-form" action="../../Controller/RemoveCartController.php" method="post">
                    <div class="form-group">
                    <input type="submit" name="checkout" value="Xóa" class="btn btn-danger">
                    </div>
                </form>
                <form id="checkout-form" action="ConfirmOrder.php" method="post">
                    <div class="form-group">
                    <input type="submit" name="checkout" value="Thanh toán" class="btn btn-primary">
                    </div>
                </form>
            </div>
            </div>
            </section>

        <footer class="container-fluid p-0 footer">
            <div class="row">
                <div class="col-8">
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
    
    <script>
        $(document).ready(function() {
            // Bắt sự kiện khi người dùng ấn nút "Thanh toán"
            $('#checkout-form').submit(function(e) {
                e.preventDefault(); // Ngăn chặn gửi form mặc định

                var selectedProducts = $('input[name="selectedProducts[]"]:checked').map(function() {
                    return this.value;
                }).get();

                if (selectedProducts.length > 0) {
                    // Tạo một input ẩn để lưu trữ danh sách sản phẩm được chọn
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'selectedProducts',
                        value: selectedProducts.join(',')
                    }).appendTo('#checkout-form');

                    // Gửi form để chuyển hướng đến trang ConfirmOrder.php
                    $('#checkout-form').get(0).submit();
                } else {
                    // Thông báo cho người dùng chọn ít nhất một sản phẩm
                    alert('Vui lòng chọn ít nhất một sản phẩm.');
                }
            });
        });

        $(document).ready(function() {
            // Bắt sự kiện khi người dùng ấn nút "Thanh toán"
            $('#remove-form').submit(function(e) {
                e.preventDefault(); // Ngăn chặn gửi form mặc định

                var selectedProducts = $('input[name="selectedProducts[]"]:checked').map(function() {
                    return this.value;
                }).get();

                if (selectedProducts.length > 0) {
                    // Tạo một input ẩn để lưu trữ danh sách sản phẩm được chọn
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'selectedProducts',
                        value: selectedProducts.join(',')
                    }).appendTo('#remove-form');

                    // Gửi form để chuyển hướng đến trang RemoveCartController.php
                    $('#remove-form').get(0).submit();
                } else {
                    // Thông báo cho người dùng chọn ít nhất một sản phẩm
                    alert('Vui lòng chọn ít nhất một sản phẩm.');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Bắt sự kiện khi checkbox được thay đổi
            $('input[type="checkbox"]').change(function() {
                // Tính tổng số tiền
                var total = 0;
                $('input[type="checkbox"]:checked').each(function() {
                    var price = parseFloat($(this).closest('tr').find('.total').text());
                    total += price;
                });

                // Hiển thị tổng số tiền
                $('.total-amount').text(total.toFixed(2));
            });
        });
    </script>