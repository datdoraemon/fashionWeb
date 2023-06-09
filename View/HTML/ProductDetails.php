<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../Style/HomePage.css">
  <link rel="stylesheet" href="../Style/ProductDetail.css">
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  <title>ProductDetails</title>
</head>

<body>

  <?php
  require_once __DIR__ . '/../../Controller/ProductDetailsController.php';
  require_once __DIR__ . '/../../Controller/HomepageController.php';

  $homepageController = new HomepageController();
  $categories = $homepageController->getCategories();
  session_start();
  if (isset($_SESSION['temp_productID'])) {
    // Lấy giá trị productID từ SESSION
    $productID = $_SESSION['temp_productID'];

    unset($_SESSION['temp_productID']);
  } else {
    $productID = isset($_POST['productID']) ? $_POST['productID'] : null;
  }
  $productDetailController = new ProductDetailsController();
  $productDetails = $productDetailController->getProductDetails($productID);


  // Kiểm tra nếu có thông báo giỏ hàng, hiển thị thông báo và xóa khỏi session
  if (isset($_SESSION['cart_message'])) {
    echo "<p>" . $_SESSION['cart_message'] . "</p>";
    unset($_SESSION['cart_message']);
  }

  // Hiển thị các thông tin sản phẩm
  ?>
  <div class="container-fluid p-0">
    <header id="header">
      <div class="row">
      <?php
    if (isset($_SESSION['UserID']) && $_SESSION['UserID'] != 0) {
        $userInformation = $homepageController->getUserByEmail($_SESSION['Email']);
        echo '<div class="col-6" style="padding-left: 0; padđing-right: 0;">
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
              <li class="li"><a class="a" href="Homepage.php">TRANG CHỦ</a></li>
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
        <div class="col-3"></div>
        <div class="col-6">
          <div>
            <img src="<?php echo $productDetails['ProductImg']; ?>" style="width: 40%; height: 400px; float: left ;
                 margin-top: 25px; margin-right: 25px; margin-bottom: 50px;">
          </div>
          <div class="div_infor">
            <h1>Tên sản phẩm : <?php echo $productDetails['ProductName']; ?></h1>
            <p>Mô tả : <?php echo $productDetails['Description']; ?></p>
            <p>Giá: <?php echo $productDetails['Price']; ?></p>
            <!-- Hiển thị các thông tin khác của sản phẩm -->

            <form action="../../Controller/AddCartController.php" method="post">
              <input type="hidden" name="UserID" value="<?php echo $_SESSION['UserID']; ?>">
              <input type="hidden" name="productID" value="<?php echo $productID; ?>">
              <label for="quantity">Số lượng:</label>
              <div class="buttons_added">
                <input class="minus is-form" type="button" value="-">
                <input aria-label="quantity" class="input-qty" max="10" min="1" name="quantity" type="number" value="1">
                <input class="plus is-form" type="button" value="+">
                <script>
                  $('input.input-qty').each(function() {
                    var $this = $(this),
                      qty = $this.parent().find('.is-form'),
                      min = Number($this.attr('min')),
                      max = Number($this.attr('max'))
                    if (min == 0) {
                      var d = 0
                    } else d = min
                    $(qty).on('click', function() {
                      if ($(this).hasClass('minus')) {
                        if (d > min) d += -1
                      } else if ($(this).hasClass('plus')) {
                        var x = Number($this.val()) + 1
                        if (x <= max) d += 1
                      }
                      $this.attr('value', d).val(d)
                    })
                  })
                </script>
              </div><br><br>
              <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
            </form>
          </div>
        </div>
        <div class="col-3"></div>
      </div>
      <div class="col-3"></div>
  </div>
  </section>
  <footer class="container-fluid p-0 footer">
    <div class="row">
      <div class="col-8">
        <div class="footer_box">
          <h2>Về chúng tôi</h2>
          <p>Shop: fashionweb</p>
          <p>Phone: 911</p>
          <p>Email: fashion@gmail.com</p>
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