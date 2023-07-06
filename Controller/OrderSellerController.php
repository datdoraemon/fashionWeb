<?php

require_once __DIR__ . '/../Model/AdminModel.php';

class OrderSellerController{
    public function OrderProcessing($ShopID)
    {
        $orderModel = new AdminModel();
        $orders = $orderModel->getOrderByProcessing($ShopID);

        return $orders;
    }

    public function ChangeConfirmed($orderid)
    {
        $orderModel = new AdminModel();
        $orders = $orderModel->ChangeConfirmed($orderid);

        return $orders;
    }

    public function OrderConfirmed($ShopID)
    {
        $orderModel = new AdminModel();
        $orders = $orderModel->getOrderByConfirmed($ShopID);

        return $orders;
    }

    public function ChangeShipped($orderid)
    {
        $orderModel = new AdminModel();
        $orders = $orderModel->ChangeShippped($orderid);

        return $orders;
    }

    public function OrderShipped($ShopID)
    {
        $orderModel = new AdminModel();
        $orders = $orderModel->getOrderByShipped($ShopID);

        return $orders;
    }

    public function ChangeDelivered($orderid)
    {
        $orderModel = new AdminModel();
        $orders = $orderModel->ChangeShippped($orderid);

        return $orders;
    }

    public function OrderDelivered($ShopID)
    {
        $orderModel = new AdminModel();
        $orders = $orderModel->getOrderByDelivered($ShopID);

        return $orders;
    }

    public function ChangeCancelled($orderid)
    {
        $orderModel = new AdminModel();
        $orders = $orderModel->ChangeCancelled($orderid);

        return $orders;
    }

    public function OrderCancelled($ShopID)
    {
        $orderModel = new AdminModel();
        $orders = $orderModel->getOrderByCancelled($ShopID);

        return $orders;
    }

    public function ChangeReturned($orderid)
    {
        $orderModel = new AdminModel();
        $orders = $orderModel->ChangeReturned($orderid);

        return $orders;
    }

    public function OrderReturned($ShopID)
    {
        $orderModel = new AdminModel();
        $orders = $orderModel->getOrderByReturned($ShopID);

        return $orders;
    }
}
$OderController = new OrderSellerController();
if($_SERVER['REQUEST_METHOD'] == "post")
{
    if($_POST['submit'] == "Confirmed")
    {
        if(isset($_POST['orderid']))
        {
            $orders = $OderController->ChangeConfirmed($_POST['orderid']);
            echo '<script>alert("Đã xác nhận đơn hàng.");window.location.href="../View/HTML/Shop_Admin.php";</script>';
        }
    }
    if($_POST['submit'] == "Shipped")
    {
        if(isset($_POST['orderid']))
        {
            $orders = $OderController->ChangeShipped($_POST['orderid']);
            echo '<script>alert("Đơn hàng đã được vận chuyển.");window.location.href="../View/HTML/Shop_Admin.php";</script>';
        }
    }
    if($_POST['submit'] == "Delivered")
    {
        if(isset($_POST['orderid']))
        {
            $orders = $OderController->ChangeDelivered($_POST['orderid']);
            echo '<script>alert("Đã giao.");window.location.href="../View/HTML/Shop_Admin.php";</script>';
        }
    }
    if($_POST['submit'] == "Cancelled")
    {
        if(isset($_POST['orderid']))
        {
            $orders = $OderController->ChangeCancelled($_POST['orderid']);
            echo '<script>alert("Đơn hàng bị hủy.");window.location.href="../View/HTML/Shop_Admin.php";</script>';
        }
    }
    if($_POST['submit'] == "Returned")
    {
        if(isset($_POST['orderid']))
        {
            $orders = $OderController->ChangeReturned($_POST['orderid']);
            echo '<script>alert("Đơn hàng bị trả lại.");window.location.href="../View/HTML/Shop_Admin.php";</script>';
        }
    }
}

?>
