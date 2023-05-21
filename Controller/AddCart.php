<?php
    session_start();
    $userID = $_SESSION['user_id'];
    $productID = $_POST['product_id'];
    $quantity = $_POST['quantity'];