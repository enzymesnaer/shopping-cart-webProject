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

$session_id = $_SESSION['session_id'];
$prod_id = @$_REQUEST['prod_id'];
$user_id = $_SESSION['user_id'];


$con= mysqli_connect('localhost','root','')	or die("<b>Sorry, cannot connect to your localhost</b>");
mysqli_select_db($con,'shop_cart_p2') or die("<b>Sorry, DB not found.</b>");

//////FOR ADD TO CART DUPLICATE ENTRY
$s="select prod_id from reference where prod_id='$prod_id' and user_id='$user_id'";
$re = mysqli_query($con,$s) or die(mysqli_error($con));

if(mysqli_num_rows($re)>0)
{

$s="DELETE from reference where prod_id='$prod_id' AND user_id='$user_id'";
$result = mysqli_query($con,$s) or die(mysqli_error($con));

$sql1="Select prod_id from reference where user_id='$user_id' and prod_id='$prod_id' ";
$result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
}

if(@mysqli_num_rows($result1)>0){
$message = "Product Can not be deleted.";
echo $message;
}
else{
$message = "Removed Successfully. Please Refresh.";
echo $message;
}
?>
