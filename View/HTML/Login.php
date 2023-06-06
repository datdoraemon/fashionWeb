<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../View/Style/Login.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Style/Login.css">
</head>

<body>
    <?php
        session_start();
        if (isset($_SESSION['UserID']) && $_SESSION['UserID'] != 0) {
            header('Location: HomePage.php');
        }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-5">
                <p class="brand">FASHION</p>
                <div class="login-box">
                    <form method="POST" action="../../Controller/Login.php">
                        <h2>LOG IN</h2>
                        <label for="email">Email:</label><br>
                        <i class="bi bi-envelope icon"></i><span><input type="email" id="email" name="email"
                                placeholder="abc@gmail.com" required></span><br><br>
                        <label for="password">Password:</label><br>
                        <i class="fas fa-key icon"></i><input type="password" id="password" name="password"
                            placeholder="Mật khẩu phải ít nhất 8 kí tự (gồm cả chữ và số)" required><br><br>
                        <input type="submit" value="Login"><br><br>
                        <p class="m-0">You don't have an account? <a href="SignUp.html">Create an account.</a></p>
                    </form>
                </div>
            </div>
            <div class="col-7">
                <div class="background"></div>
            </div>
        </div>
    </div>
</body>

</html>