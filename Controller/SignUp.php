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
		echo '<script>alert("Please enter email and password.");window.location.href="../View/HTML/SignUp.html";</script>';
	}
	
	public function authenticateaccount() {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];
		if ($password===$cpassword) {
			$userModel = new UserModel();
			$user = $userModel->getUserByEmail($email);
		
			if ($user) {
				echo '<div class="login-box">';
				echo '<script>alert("Please enter a valid email address.");window.location.href="../View/HTML/SignUp.html";</script>';
				echo '</div>';
			} else {
				header('Location: ../View/HTML/SignUpInformation.html');
			}
		} else {
			echo '<script>alert("Invalid confirmation password.");window.location.href="../View/HTML/SignUp.html";</script>';
			exit;
		}		
	}
	
}

$SignUpController = new SignUpController();

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['cpassword'])) {
	$SignUpController->authenticateaccount();
} else {
	$SignUpController->index();
}

?>
</body>
</html>