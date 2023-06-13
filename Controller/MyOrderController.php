<?php

require_once __DIR__ . '/../Model/UserProductsModel.php';

class MyOrderController{
    public function OrderProcessing($UserID){
        $orderModel = new OrderModel();
        $orders = $orderModel->showOrder($UserID);
        header('Location: ../View/HTML/Cart.php');

        // In thông tin Order với Status là 'Processing'
        echo "<h1>Orders with Status 'Processing':</h1>";
        foreach ($orders as $order) {
            if ($order['Status'] === 'Processing') {
                echo "Product Name: " . $order['ProductName'] . "<br>";
                echo "Quantity: " . $order['Quantity'] . "<br>";
                echo "Create Date: " . $order['CreateDate'] . "<br><br>";
            }
        }
    }

    public function OrderConfirmed($UserID){
        $orderModel = new OrderModel();
        $orders = $orderModel->showOrder($UserID);

        // In thông tin Order với Status là 'Confirmed'
        echo "<h1>Orders with Status 'Confirmed':</h1>";
        foreach ($orders as $order) {
            if ($order['Status'] === 'Confirmed') {
                echo "Product Name: " . $order['ProductName'] . "<br>";
                echo "Quantity: " . $order['Quantity'] . "<br>";
                echo "Create Date: " . $order['CreateDate'] . "<br><br>";
            }
        }
    }

    // Tương tự cho các hàm OrderShipped, OrderDelivered, OrderCancelled, OrderReturned
    // ...

    public function OrderShipped($UserID){
        $orderModel = new OrderModel();
        $orders = $orderModel->showOrder($UserID);

        // In thông tin Order với Status là 'Confirmed'
        echo "<h1>Orders with Status 'Confirmed':</h1>";
        foreach ($orders as $order) {
            if ($order['Status'] === 'Shipped') {
                echo "Product Name: " . $order['ProductName'] . "<br>";
                echo "Quantity: " . $order['Quantity'] . "<br>";
                echo "Create Date: " . $order['CreateDate'] . "<br><br>";
            }
        }
    }
    public function OrderDelivered($UserID){
        $orderModel = new OrderModel();
        $orders = $orderModel->showOrder($UserID);

        // In thông tin Order với Status là 'Confirmed'
        echo "<h1>Orders with Status 'Confirmed':</h1>";
        foreach ($orders as $order) {
            if ($order['Status'] === 'Delivered') {
                echo "Product Name: " . $order['ProductName'] . "<br>";
                echo "Quantity: " . $order['Quantity'] . "<br>";
                echo "Create Date: " . $order['CreateDate'] . "<br><br>";
            }
        }
    }
    public function OrderCancelled($UserID){
        $orderModel = new OrderModel();
        $orders = $orderModel->showOrder($UserID);

        // In thông tin Order với Status là 'Confirmed'
        echo "<h1>Orders with Status 'Confirmed':</h1>";
        foreach ($orders as $order) {
            if ($order['Status'] === 'Cancelled') {
                echo "Product Name: " . $order['ProductName'] . "<br>";
                echo "Quantity: " . $order['Quantity'] . "<br>";
                echo "Create Date: " . $order['CreateDate'] . "<br><br>";
            }
        }
    }
    public function OrderReturned($UserID){
        $orderModel = new OrderModel();
        $orders = $orderModel->showOrder($UserID);

        // In thông tin Order với Status là 'Confirmed'
        echo "<h1>Orders with Status 'Confirmed':</h1>";
        foreach ($orders as $order) {
            if ($order['Status'] === 'Cancelled') {
                echo "Product Name: " . $order['ProductName'] . "<br>";
                echo "Quantity: " . $order['Quantity'] . "<br>";
                echo "Create Date: " . $order['CreateDate'] . "<br><br>";
            }
        }
    }
}
$MyOrrder = new MyOrderController();
if(isset($_POST['userid']) && isset($_POST['productID']))
{
    $MyOrrder->OrderProcessing($_POST['userid']);
}