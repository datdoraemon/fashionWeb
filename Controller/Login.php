<?php

require_once '../Model/UserModel.php';

class LoginController {
	
	public function index() {
		echo '<script>alert("Please enter email and password.");window.location.href="../View/HTML/Login.html";</script>';
	}
	
	public function authenticate() {
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$email = htmlspecialchars($email);
		$password = htmlspecialchars($password);
		if (preg_match('/[\'"\\\\;]/', $email)) {
			echo '<script>alert("Please enter a valid email address.");window.location.href="../View/HTML/Login.html";</script>';
			exit;
		}
		
		if (preg_match('/[\'"\\\\;]/', $password)) {
			echo '<script>alert("Incorrect password.");window.location.href="../View/HTML/Login.html";</script>';
			exit;
		}
		
		
		$userModel = new UserModel();
		$userEmail = $userModel->getUserByEmail($email);
		$user = $userModel->getUserByEmailAndPassword($email, $password);
		
		if ($userEmail) {
			if ($user) {
				session_start();
				$_SESSION['user_id'] = $user['id'];
				header('Location: ../View/HTML/HomePage.php');
			}
			else {
				echo '<script>alert("Incorrect password.");window.location.href="../View/HTML/Login.html";</script>';
			}
		} else {
			echo '<script>alert("Please enter a valid email address.");window.location.href="../View/HTML/Login.html";</script>';
		}
	}
}

$loginController = new LoginController();

if (isset($_POST['email']) && isset($_POST['password'])) {
	$loginController->authenticate();
} else {
	$loginController->index();
}
