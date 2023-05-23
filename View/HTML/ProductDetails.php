<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();

// Kiểm tra nếu có thông báo giỏ hàng, hiển thị thông báo và xóa khỏi session
if (isset($_SESSION['cart_message'])) {
  echo "<p>" . $_SESSION['cart_message'] . "</p>";
  unset($_SESSION['cart_message']);
}

// Hiển thị các thông tin sản phẩm
?>
<h1><?php echo $productDetails['productName']; ?></h1>
<p><?php echo $productDetails['description']; ?></p>
<p>Giá: <?php echo $productDetails['price']; ?></p>
<!-- Hiển thị các thông tin khác của sản phẩm -->
<form action="../../Controller/AddCart.php" method="post">
  <input type="hidden" name="productID" value="<?php echo $productID; ?>">
  <label for="quantity">Số lượng:</label>
  <input type="number" name="quantity" id="quantity" min="1" value="1">
  <button type="submit">Thêm vào giỏ hàng</button>
</form>

</form>
</body>
</html>