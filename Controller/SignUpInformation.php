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
		$name = $_POST['name'];
		$birthday = $_POST['birthday'];
        $email = $_POST['email'];
		echo $birthday;
        echo $email;
        echo $name;
	}
}

$SignUpInformationController = new SignUpInformationController();

if (isset($_POST['birthday'])) {
	$SignUpInformationController->authenticateaccount();
}
?>
</body>
</html>