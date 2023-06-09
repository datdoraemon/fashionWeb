<?php

require_once __DIR__ . '/../Model/UserProductsModel.php';
$MyOrder = new OrderModel();
class MyOrderController{
    public function OrderProcessing($UserID){
    }
    public function OrderConfirmed($UserID){
    }
    public function OrderShipped($UserID){
    }
    public function OrderDelivered($UserID){
    }
    public function OrderCancelled($UserID){
    }
    public function OrderReturned($UserID){
    }        
}