<?php

require_once __DIR__ . '/../Model/UsersModel.php';
class ConfirmOrderController{
    public function UserConfirm($UserID){
        $userModel = new UsersModel();
        $user = $userModel->getUserByID($UserID);

        if ($user) {
            return $user;
        }
    }   
}