<?php

require_once __DIR__ . '/../Model/UserProductsModel.php';

class MyOrderController{
    public function OrderProcessing($UserID){
        $orderModel = new OrderModel();
        $Status = 'Processing';
        $orders = $orderModel->showOrder($UserID, $Status);

        if (!empty($orders)) {
            // In thông tin Order với Status là 'Processing'
            echo "<h1>Orders with Status 'Processing':</h1>";
            foreach ($orders as $order) {
                echo "Product Name: " . $order['ProductName'] . "<br>";
                echo "Quantity: " . $order['Quantity'] . "<br>";
                echo "Create Date: " . $order['CreateDate'] . "<br><br>";
            }
        }else{
            echo "<h1>Orders with Status 'Processing':</h1>";
            echo "Null</br>";
        }
    }

    public function OrderConfirmed($UserID){
        $orderModel = new OrderModel();
        $Status = 'Confirmed';
        $orders = $orderModel->showOrder($UserID, $Status);

        if (!empty($orders)) {
            // In thông tin Order với Status là 'Confirmed'
            echo "<h1>Orders with Status 'Confirmed':</h1>";
            foreach ($orders as $order) {
                echo "Product Name: " . $order['ProductName'] . "<br>";
                echo "Quantity: " . $order['Quantity'] . "<br>";
                echo "Create Date: " . $order['CreateDate'] . "<br><br>";
            }
        }else{
            echo "<h1>Orders with Status 'Confirmed':</h1>";
            echo "Null</br>";
        }
    }

    public function OrderShipped($UserID){
        $orderModel = new OrderModel();
        $Status = 'Shipped';
        $orders = $orderModel->ShowOrder($UserID, $Status);

        if (!empty($orders)) {
            // In thông tin Order với Status là 'Confirmed'
            echo "<h1>Orders with Status 'Shipped':</h1>";
            foreach ($orders as $order) {
                echo "Product Name: " . $order['ProductName'] . "<br>";
                echo "Quantity: " . $order['Quantity'] . "<br>";
                echo "Create Date: " . $order['CreateDate'] . "<br><br>";
            }
        }else{
            echo "<h1>Orders with Status 'Shipped':</h1>";
            echo "Null</br>";
        }
    }
    public function OrderDelivered($UserID){
        $orderModel = new OrderModel();
        $Status = 'Delivered';
        $orders = $orderModel->showOrder($UserID, $Status);

        if (!empty($orders)) {
            // In thông tin Order với Status là 'Confirmed'
            echo "<h1>Orders with Status 'Delivered':</h1>";
            foreach ($orders as $order) {
                echo "Product Name: " . $order['ProductName'] . "<br>";
                echo "Quantity: " . $order['Quantity'] . "<br>";
                echo "Create Date: " . $order['CreateDate'] . "<br><br>";
            }
        }else{
            echo "<h1>Orders with Status 'Delivered':</h1>";
            echo "Null</br>";
        }
    }
    public function OrderCancelled($UserID){
        $orderModel = new OrderModel();
        $Status = 'Cancelled';
        $orders = $orderModel->showOrder($UserID, $Status);

        if (!empty($orders)) {
            // In thông tin Order với Status là 'Confirmed'
            echo "<h1>Orders with Status 'Cancelled':</h1>";
            foreach ($orders as $order) {
                echo "Product Name: " . $order['ProductName'] . "<br>";
                echo "Quantity: " . $order['Quantity'] . "<br>";
                echo "Create Date: " . $order['CreateDate'] . "<br><br>";
            }
        }else{
            echo "<h1>Orders with Status 'Cancelled':</h1>";
            echo "Null</br>";
        }
    }
    public function OrderReturned($UserID){
        $orderModel = new OrderModel();
        $Status = 'Returned';
        $orders = $orderModel->showOrder($UserID, $Status);

        if (!empty($orders)) {
            // In thông tin Order với Status là 'Confirmed'
            echo "<h1>Orders with Status 'Returned':</h1>";
            foreach ($orders as $order) {
                echo "Product Name: " . $order['ProductName'] . "<br>";
                echo "Quantity: " . $order['Quantity'] . "<br>";
                echo "Create Date: " . $order['CreateDate'] . "<br><br>";
            }
        }else{
            echo "<h1>Orders with Status 'Returned':</h1>";
            echo "Null</br>";
        }
    }
}
/*$MyOrrder = new MyOrderController();
if(isset($_POST['userid']) && isset($_POST['productID']))
{
    $MyOrrder->OrderProcessing($_POST['userid']);
}*/