<?php session_start();
require_once __DIR__ . '/../Model/AdminModel.php';
class SignInSellerController
{
	public function SignIn()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			if($_POST['submit'] == "Sign In")
			{
				if(isset($_POST['email']) && isset($_POST['password']))
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
					$AdminModel = new AdminModel();
					$adminEmail = $AdminModel->getSellerByEmail($email);
					$admin = $AdminModel->getSellerByEmailAndPassword($email, $password);

					if ($adminEmail) {
						if ($admin) {
							$_SESSION['SellerID'] = $admin['SellerID'];
							$_SESSION['Email'] = $admin['Email'];
							header('Location: ../View/HTML/Shop_Admin.php');
						} else {
							echo '<script>alert("Incorrect password.");window.location.href="../View/HTML/Login.php";</script>';
						}
					} else {
						echo '<script>alert("Please enter a valid email address.");window.location.href="../View/HTML/Login.php";</script>';
					}
				}
			}
		}   
    }
}
$loginController = new SignInSellerController();

if (isset($_POST['email']) && isset($_POST['password'])) {
	$loginController->SignIn();
}
?>
