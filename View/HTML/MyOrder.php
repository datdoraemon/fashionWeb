<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyOrder</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Style/HomePage.css">
</head>
<body>
    <?php
        session_start();
        require_once __DIR__ . '/../../Controller/MyOrderController.php';
        require_once __DIR__ .'/../../Controller/HomePageController.php';

        // Tạo một đối tượng MyOrderController
        $myOrderController = new MyOrderController();
        $homepageController = new HomePageController();
        $categories = $homepageController->getCategories();

        // Lấy UserID từ session
        $userID = $_SESSION['UserID'];
        
        // Gọi các hàm trong MyOrderController và in ra thông tin Order theo Status
    ?>
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
                <div class="row">
                    <div class= "status">
                    <ul class="ul">
                        <li class="li">
                            <a class="a">
                            <button type="button" class="btn btn-light" id="processing" value="processing" onclick="Processing()">Processing</button>
                            </a>
                        </li>
                        <li class="li">
                            <a class="a">
                            <button type="button" class="btn btn-light" id="confirmed" value="confirmed" onclick="Confirmed()">Confirmed</button>
                            </a>
                        </li>
                        <li class="li">
                            <a class="a">
                            <button type="button" class="btn btn-light" id="shipped" value="shipped" onclick="Ship()">Shipped</button>
                            </a>
                        </li>
                        <li class="li">
                            <a class="a">
                            <button type="button" class="btn btn-light" id="deliveried" value="deliveried" onclick="Delivery()">Delivered</button>
                            </a>
                        </li>
                        <li class="li">
                            <a class="a">
                            <button type="button" class="btn btn-light" id="canceled" value="canceled" onclick="Cancel()">Canceled</button>
                            </a>
                        </li>
                        <li class="li">
                            <a class="a">
                            <button type="button" class="btn btn-light" id="returned" value="returned" onclick="Return()">Returned</button>
                            </a>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="process">
                        <?php $myOrderController->OrderProcessing($userID); ?>
                    </div>
                    <div class="col-12" id="confirm">
                        <?php $myOrderController->OrderConfirmed($userID); ?>
                    </div>
                    <div class="col-12" id="ship">
                        <?php $myOrderController->OrderShipped($userID); ?>
                    </div>
                    <div class="col-12" id="delivery">
                        <?php $myOrderController->OrderDelivered($userID); ?>
                    </div>
                    <div class="col-12" id="cancel">
                        <?php $myOrderController->OrderCancelled($userID); ?>
                    </div>
                    <div class="col-12" id="return">
                        <?php $myOrderController->OrderCancelled($userID); ?>
                    </div>
                </div>
            </div>
            <script>
                     function Processing()
                      {
                        var x = document.getElementById("processing").value;
                        if(x == "processing")
                        {
                            $('#process').show();
                            $("#confirm").hide();
                            $("#ship").hide();
                            $("#delivery").hide();
                            $("#cancel").hide();
                            $("#return").hide();
                        }
                      }
                      function Confirmed()
                      {
                        var y = document.getElementById("confirmed").value;
                        if(y == "confirmed")
                        {
                            $("#confirm").show();
                            $('#process').hide();
                            $("#ship").hide();
                            $("#delivery").hide();
                            $("#cancel").hide();
                            $("#return").hide();
                        }
                      }
                      function Ship()
                      {
                        var y = document.getElementById("shipped").value;
                        if(y == "shipped")
                        {
                            $("#confirm").hide();
                            $('#process').hide();
                            $("#ship").show();
                            $("#delivery").hide();
                            $("#cancel").hide();
                            $("#return").hide();
                        }
                      }
                      function Delivery()
                      {
                        var y = document.getElementById("deliveried").value;
                        if(y == "deliveried")
                        {
                            $("#confirm").show();
                            $('#process').hide();
                            $("#ship").hide();
                            $("#delivery").hide();
                            $("#cancel").hide();
                            $("#return").hide();
                        }
                      }
                      function Cancel()
                      {
                        var y = document.getElementById("confirmed").value;
                        if(y == "confirmed")
                        {
                            $("#confirm").hide();
                            $('#process').hide();
                            $("#ship").hide();
                            $("#delivery").show();
                            $("#cancel").hide();
                            $("#return").hide();
                        }
                      }
                      function Return()
                      {
                        var y = document.getElementById("returned").value;
                        if(y == "returned")
                        {
                            $("#confirm").hide();
                            $('#process').hide();
                            $("#ship").hide();
                            $("#delivery").hide();
                            $("#cancel").hide();
                            $("#return").show();
                        }
                      }
            </script>
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
