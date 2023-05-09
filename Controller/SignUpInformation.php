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

require_once '../Model/UserModel.php';

class SignUpInformationController{
	public function index() {
		include '../View/HTML/SignUpInformation.html';
	}

	public function authenticateaccount() {
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
		$email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $userModel = new UserModel();
        $userModel->createUser($email, $password, $name, $birthday, $phone, $address);
    }
}

$SignUpInformationController = new SignUpInformationController();

if (isset($_POST['birthday'])) {
	$SignUpInformationController->authenticateaccount();
}
?>
</body>
</html>