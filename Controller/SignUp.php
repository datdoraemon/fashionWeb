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

class SignUpController {
	
	public function index() {
		include '../View/HTML/SignUp.html';
	}
	
	public function authenticateaccount() {
		$email = $_POST['email'];
		
		$userModel = new UserModel();
		$user = $userModel->getUserByEmail($email);
		
		if ($user) {
            echo '<div class="login-box">';
            echo '<p>Email already in use!</p>';
            echo '<a class="px-3 py-2 border rounded d-inline-block" href="../View/HTML/Login.html">Login</a><p></p>';
            echo '<a class="px-3 py-2 border rounded mt-3 d-inline" href="../View/HTML/SignUp.html">SignUp</a>';
            echo '</div>';
		} else {
			header('Location: ../View/HTML/SignUpInformation.html');
		}
	}
	
}

$SignUpController = new SignUpController();

if (isset($_POST['email']) && isset($_POST['password'])) {
	$SignUpController->authenticateaccount();
} else {
	$SignUpController->index();
}
?>
</body>
</html>