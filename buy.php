<html>
<head>
<title>Transaction</title>
</head>
<style type="text/css">
	.border{ border:solid 1px;}
	.size{
		height:200px;
		width:200px;
		}
</style>
<body>

<?php

session_start();

if(!isset( $_SESSION['session_id']) or !isset( $_SESSION['user_id'])){
	echo "please login to continue..<br>";
	echo "Click here to <a href='login.php'>Login</a> or <a href='signup.php'>Signup</a>";

	echo '<div style="font-size:20px; font-family:Helvetica; float:right; padding-right:8px">
        <a href="index.php"><button><img src="ico/home.png" width="30" height="30"></button></a>&nbsp&nbsp
        <a href="cartbtn.php"><button><img src="ico/cart.png" width="30" height="30"></button></a>&nbsp&nbsp
        <a href="login.php">Login</a></div>';
}
else{

  echo '<span style="font-size:20px;font-family:Helvetica; float:right; padding-right:8px">
        <a href="index.php><button><img src="ico/home.png" width="30" height="30"></button></a>&nbsp&nbsp
        <a href="cartbtn.php"><button><img src="ico/cart.png" width="30" height="30"></button></a>&nbsp&nbsp
        <a href="logout.php">Logout</a></span>';

  echo '<div style="font-family:Helvetica; float:left; border:solid 1px; padding-left:10px;">
        <form style="float:left;" action="buyaction.php" method="post"><br>

        Enter the following details to complete this transaction.<br><br>
        <div style="font-family:Helvetica; float:left;">
        <fieldset>
        Shipping Details.<hr>
        First name: <input type="text" name="sfname" required /><br><br>
        Last name: <input type="text" name="slname" required /><br><br>
        Address: <input type="text" name="saddress" required /><br><br>
        Contact No: <input type="text" name="snumber" maxlength="10" required/><br><br>
        <label>Enter captcha code: </label><input type="text" name="code">&nbsp<img src="captcha.php">
        </fieldset><br><br>
        </div>

        <div style="font-family:Helvetica;float:right;">
        <fieldset>
        Billing Details.<hr>
        First name: <input type="text" name="bfname" required /><br><br>
        Last name: <input type="text" name="blname" required /><br><br>
        Address: <input type="text" name="baddress" required /><br><br>
        Contact No: <input type="text" name="bnumber" maxlength="10" required /><br><br>
        Card Number: <input type="text" name="cardno" maxlength="12" required /><br><br>
        Password: <input type="password" name="pass" maxlength="4" required /><br><br>
        <input type="submit" value="Confirm Transaction">
        </fieldset><br>
        </div>

        </form>
        </div>';
}
?>
