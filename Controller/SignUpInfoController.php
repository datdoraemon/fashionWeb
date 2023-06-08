<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="../View/Style/Login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php

    require_once __DIR__ . '/../Model/UsersModel.php';

    class SignUpInformationController
    {
        public function index()
        {
            //echo '<script>alert("Please enter information.");window.location.href="../View/HTML/SignUpInformation.php";</script>';
        }
        public function getUserByEmail($email)
        {
            $User = new UsersModel();
            return $User->getUserByEmail($email);
        }

        public function SignUp()
        {
            session_start();
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
            echo $UserID,$name, $birthday, $phone;
            $userModel = new UsersModel();
            $userModel->updateUserInformation($UserID, $name, $birthday, $address, $phone);
            header('Location: ../View/HTML/Login.php');
        }
    }

    $SignUpInformationController = new SignUpInformationController();

    if (
        isset($_POST['name']) && isset($_POST['birthday'])
        && isset($_POST['phone']) && isset($_POST['address'])
    ) {
        $SignUpInformationController->SignUp();
    } else {
        $SignUpInformationController->index();
    }
    ?>
</body>

</html>