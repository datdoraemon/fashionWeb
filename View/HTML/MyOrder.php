<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyOrder</title>
</head>
<body>
    <?php
        session_start();
        require_once __DIR__ . '/../../Controller/MyOrderController.php';

        // Tạo một đối tượng MyOrderController
        $myOrderController = new MyOrderController();

        // Lấy UserID từ session
        $userID = $_SESSION['UserID'];

        // Gọi các hàm trong MyOrderController và in ra thông tin Order theo Status
        $myOrderController->OrderProcessing($userID);
        $myOrderController->OrderConfirmed($userID);
        $myOrderController->OrderShipped($userID);
        $myOrderController->OrderDelivered($userID);
        $myOrderController->OrderCancelled($userID);
        $myOrderController->OrderReturned($userID);
    ?>
</body>
</html>
