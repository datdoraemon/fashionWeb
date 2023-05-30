<!-- Đoạn mã HTML của trang Cart.php -->

<?php
session_start();
require_once __DIR__ . '/../../Controller/ShowCart.php';
?>

<!-- Tiêu đề trang -->
<h1>Giỏ hàng</h1>

<!-- Gọi hàm ShowCart với user_id từ SESSION -->
<?php
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  ShowCart($user_id);
} else {
  echo "Vui lòng đăng nhập để xem giỏ hàng.";
}
?>
