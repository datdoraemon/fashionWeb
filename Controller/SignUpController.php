<?php
require_once __DIR__ . '/../Model/UsersModel.php';
class SignUpController
{

	public function index()
	{
		echo '<script>alert("Please enter email and password.");window.location.href="../View/HTML/SignUp.html";</script>';
	}

	public function authenticateaccount()
	{
		session_start();
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$cpassword = trim($_POST['cpassword']);
		$email = htmlspecialchars($email);
		$password = htmlspecialchars($password);
		$cpassword = htmlspecialchars($cpassword);
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			
		if (preg_match('/[\'"\\\\;]/', $email)) {
			echo '<script>alert("Please enter a valid email address.");window.location.href="../View/HTML/SignUp.html";</script>';
			exit;
		}
		
		if (preg_match('/[\'"\\\\;]/', $password)) {
			echo '<script>alert("Incorrect password.");window.location.href="../View/HTML/Login.html";</script>';
			exit;
		}
		
		if (preg_match('/[\'"\\\\;]/', $cpassword)) {
			echo '<script>alert("Incorrect password.");window.location.href="../View/HTML/Login.html";</script>';
			exit;
		}
		
		$User = new UsersModel();
		$user = $User->getUserByEmail($email);
		if ($user) {
			echo '<script>alert("Please enter a valid email address.");window.location.href="../View/HTML/SignUp.html";</script>';
		}else{
			if ($password == $cpassword) {
				$_SESSION['password'] = $hashedPassword;
			} else {
				echo '<script>alert("Invalid confirmation password.");window.location.href="../View/HTML/SignUp.html";</script>';
				exit;
			}			
		}
	}
}

$SignUpController = new SignUpController();

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['cpassword'])) {
	$SignUpController->authenticateaccount();
	session_start();
	$_SESSION['email'] = $_POST['email'];
	header('Location: ../View/HTML/SignUpInformation.php');
} else {
	$SignUpController->index();
}

?>
