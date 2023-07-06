<?php
require_once __DIR__ . '/../Model/AdminModel.php';
class CreateAdminController
{
    public function index(){}
	public function getSellerByEmail($email)
    {
        $adminshop = new AdminModel();
        return $adminshop->getSellerByEmail($email);
    }

	public function getShopName($sellerID)
    {
        $shopname = new AdminModel();
        return $shopname->getShopName($sellerID);
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
		
		$Admin = new AdminModel();
		$admin = $Admin->getSellerByEmail($email);
		if ($admin) {
			echo '<script>alert("Email exsited.");window.location.href="../View/HTML/SignUp.html";</script>';
		}else{
			if ($password == $cpassword) {
				$_SESSION['password'] = $hashedPassword;
                $createadmin = $Admin->CreateAccount($email,$hashedPassword);
				$admin = $Admin->getSellerByEmail($email);
	            $_SESSION['SellerID']  = $admin['SellerID'];
                header('Location: ../View/HTML/InforSeller.php');
			} else {
				echo '<script>alert("Invalid confirmation password.");window.location.href="../View/HTML/SignUp.html";</script>';
				exit;
			}			
		}
	}
}

$AdminController = new CreateAdminController();

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['cpassword'])) {
	$AdminController->authenticateaccount();
	$_SESSION['email'] = $_POST['email'];
	//header('Location: ../View/HTML/SignUpInformation.php');
} else {
	$AdminController->index();
}

?>
