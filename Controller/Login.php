<?php

require_once '../Model/UserModel.php';

class LoginController {
	
	public function index() {
		include '../View/HTML/Login.html';
	}
	
	public function authenticate() {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$userModel = new UserModel();
		$user = $userModel->getUserByUsernameAndPassword($username, $password);
		
		if ($user) {
			session_start();
			$_SESSION['user_id'] = $user['id'];
			header('Location: ../View/HTML/HomePage.html');
		} else {
			header('Location: ../View/HTML/Login.html');
		}
	}
	
}

$loginController = new LoginController();

if (isset($_POST['username']) && isset($_POST['password'])) {
	$loginController->authenticate();
} else {
	$loginController->index();
}
