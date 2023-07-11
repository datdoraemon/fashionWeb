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
        $orders = $orderModel->ChangeShipped($orderid);

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
        $orders = $orderModel->ChangeDelivered($orderid);

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
if(isset($_POST['orderidprocess']))
{
     $orders = $OderController->ChangeConfirmed($_POST['orderidprocess']);
     echo '<script>alert("Đã xác nhận đơn hàng.");window.location.href="../View/HTML/Shop_Admin.php";</script>';
}
if(isset($_POST['orderidconfirm']))
{
     $orders = $OderController->ChangeShipped($_POST['orderidconfirm']);
     echo '<script>alert("Đơn hàng đang được vận chuyển.");window.location.href="../View/HTML/Shop_Admin.php";</script>';
}
if(isset($_POST['orderidship']))
{
     $orders = $OderController->ChangeDelivered($_POST['orderidship']);
     echo '<script>alert("Đã giao.");window.location.href="../View/HTML/Shop_Admin.php";</script>';
}
if(isset($_POST['orderidcancel']))
{
     $orders = $OderController->ChangeCancelled($_POST['orderid']);
     echo '<script>alert("Đã hủy.");window.location.href="../View/HTML/Shop_Admin.php";</script>';
}
if(isset($_POST['orderidreturn']))
{
     $orders = $OderController->ChangeReturned($_POST['orderid']);
     echo '<script>alert("Đơn hàng đã bị trả lại.");window.location.href="../View/HTML/Shop_Admin.php";</script>';
}
?>
