<html>
<head>
<title>Add_To_Cart</title>
<style type="text/css">
.style1{
	width:180px;
}
</style>
</head>

<?php

session_start();
if(!isset( $_SESSION['session_id']) or !isset( $_SESSION['user_id'])){
		$message = "You are not logged in.";
		echo $message;
}
else{

$session_id= $_SESSION['session_id'];
$user_id= $_SESSION['user_id'];
$prod_id= $_REQUEST['prod_id'];

$con= mysqli_connect('localhost','root','')	or die("cannot connect to your localhost");
mysqli_select_db($con,'shop_cart_p2') or die("Sorry! db not found.");

/////////////////////////////////////////////////////////
//////////////-FOR "CART" DUPLICATE ENTRY-///////////////
/////////////////////////////////////////////////////////

$sql= "select prod_id from reference where prod_id='$prod_id' and user_id='$user_id'";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));

		if(mysqli_num_rows($result) == 0){
			//insert value into user table
			$sql1 = "Insert into reference VALUES('','$prod_id','$user_id')";
			//fire query over user_info table
			$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
			$sql2="Select prod_id from reference where user_id='$user_id'";
			$result2=mysqli_query($con,$sql2) or die(mysqli_error($con));
		}
			if(@mysqli_num_rows($result2)>0){
			$message = "Added To Cart Successfully.";
			echo $message;
		}
		else{
			$message = "Product already exists!";
			echo $message;
		}
}
?>
