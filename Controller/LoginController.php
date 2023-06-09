<?php session_start();

require_once __DIR__ . '/../Model/UsersModel.php';

class LoginController
{

	public function index()
	{
		echo '<script>alert("Please enter email and password.");window.location.href="../View/HTML/Login.html";</script>';
	}

	public function authenticate()
	{
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$email = htmlspecialchars($email);
		$password = htmlspecialchars($password);
		
		if (preg_match('/[\'"\\\\;]/', $email)) {
			echo '<script>alert("Please enter a valid email address.");window.location.href="../View/HTML/Login.php";</script>';
			exit;
		}

		if (preg_match('/[\'"\\\\;]/', $password)) {
			echo '<script>alert("Incorrect password.");window.location.href="../View/HTML/Login.php";</script>';
			exit;
		}


		$userModel = new UsersModel();
		$userEmail = $userModel->getUserByEmail($email);
		$user = $userModel->getUserByEmailAndPassword($email, $password);

		if ($userEmail) {
			if ($user) {
				$_SESSION['UserID'] = $user['UserID'];
				$_SESSION['Email'] = $user['Email'];
				header('Location: ../View/HTML/HomePage.php');
			} else {
				echo '<script>alert("Incorrect password.");window.location.href="../View/HTML/Login.php";</script>';
			}
		} else {
			echo '<script>alert("Please enter a valid email address.");window.location.href="../View/HTML/Login.php";</script>';
		}
	}
}

$loginController = new LoginController();

if (isset($_POST['email']) && isset($_POST['password'])) {
	$loginController->authenticate();
} else {
	$loginController->index();
}