<?php
session_start();
require_once __DIR__ . '/../../Controller/ConfirmOrderController.php';
require_once __DIR__ . '/../../Controller/ShowCartController.php';

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
$userInfo = $user->UserConfirm($_SESSION['UserID']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Order</title>
</head>

<body>
    <h1>Xác nhận đơn hàng</h1>

    <h2>Thông tin người dùng:</h2>
    <p>Tên người dùng: <?php echo $userInfo['FullName']; ?></p>
    <p>Số điện thoại: <?php echo $userInfo['Phone']; ?></p>
    <p>Địa chỉ: <?php echo $userInfo['Address']; ?></p>

    <h2>Danh sách sản phẩm:</h2>
    <table>
        <thead>
            <tr>
                <th>ProductID</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng cộng</th>
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
</body>

</html>
