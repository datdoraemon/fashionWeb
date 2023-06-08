<?php 
    
    require_once __DIR__ . '/../Model/UsersModel.php';
    class UpdateInformationController
    {
        public function getUserByEmail($email)
        {
            $User = new UsersModel();
            return $User->getUserByEmail($email);
        }
        public function Update()
        {
            if($_SERVER['REQUEST_METHOD'] == "POST")
            {
                if (
                    isset($_POST['name']) && isset($_POST['birthday']) && isset($_POST['email'])
                    && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['userid'])
                ){ //echo $_POST['name'];
                $name = trim($_POST['name']);
                $birthday = trim($_POST['birthday']);
                $phone = trim($_POST['phone']);
                $address = trim($_POST['address']);
                $name = htmlspecialchars($name);
                $birthday = htmlspecialchars($birthday);
                $phone = htmlspecialchars($phone);
                $address = htmlspecialchars($address);
                $name = stripslashes($name);
                $birthday = stripslashes($birthday);
                $phone = stripslashes($phone);
                $address = stripslashes($address);
                $UserID = $_POST['userid'];
                $userModel = new UsersModel();
                $userModel->updateUserInformation($UserID, $name, $birthday, $address, $phone);
                /*$UserID = $_SESSION['UserID'];
                $Email = $_POST['email'];
                $Email = $_SESSION['Email'];*/
                header('Location: ../View/HTML/UpdateInformation.php'); 
                }
            }
        }
    }
    $UpdateInformationController = new UpdateInformationController();

    if (
        isset($_POST['name']) && isset($_POST['birthday'])
        && isset($_POST['phone']) && isset($_POST['address'])
    ) {
        $UpdateInformationController->Update();
    }
?>