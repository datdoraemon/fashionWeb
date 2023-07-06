<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUpInformation</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,400i|Noto+Sans:400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    <link rel="stylesheet" href="../Style/InforSeller.css">
</head>
<body>
<div class="to">
 <div class="form">
 <h2>Sign Up Personal Information</h2>
 <form action="../../Controller/InforSellerController.php" method="post">
 <input type="hidden" name="sellerID" value="<?php echo $_SESSION['SellerID']; ?>">
 <label style="margin-left: -150px;">Full Name</label>
 <input type="text" name="name">
 <label style="margin-left: -150px;">Birthday</label>
 <input type="date" name="birthday"> 
 <label style="margin-left: -180px;">Phone</label>
 <input type="number" name="phone"> 
 <label style="margin-left: -180px;">Address</label>
 <input type="text" name="address"> 
 <label style="margin-left: -180px;">Shop Name</label>
 <input type="text" name="shopname"> 
 <input id="submit" type="submit" name="submit" value="Submit">
 </form>
 </div> 
 </div>
</body>
</html>