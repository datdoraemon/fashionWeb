<!-- Đoạn mã HTML của trang Cart.php -->

<?php
session_start();
require_once __DIR__ . '/../../Controller/ShowCart.php';
?>

<!-- Tiêu đề trang -->
<h1>Giỏ hàng</h1>

<!-- Gọi hàm ShowCart với UserID từ SESSION -->
<?php
if (isset($_SESSION['UserID'])) {
  $UserID = $_SESSION['UserID'];
  ShowCart($UserID);
} else {
  echo "Vui lòng đăng nhập để xem giỏ hàng.";
}
?>
