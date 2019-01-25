<html>
<head>
  <title>Welcome</title>
  <style type="text/css">
  .style1{
    width:180px;
    border:1px solid;
    border-radius:10px;
    background-color:#ffffff;
  }
  </style>
</head>
<body style="background-color:#afeeee;">

<?php
session_start();
if(isset($_SESSION['session_id']) AND isset($_SESSION['user_id'])){
  echo '<span style="float:left; padding-left:15px; font-size:30"><b><em>Welcome '.$_SESSION["user_name"].' to amazon</em></b></span>
  <span style="font-size:20px;font-family:Helvetica;float:right;padding-right:8px">

  <a href="index.php"><button><img src="ico/home.png"width="30" height="30" "></button></a>
  &nbsp &nbsp

  <a href="cartbtn.php"><button><img src="ico/cart.jpg"width="30" height="30" "></button></a>
  &nbsp &nbsp

  <a href="logout.php">logout</a>
  </span>';
}else{
	echo "<span style='float:left;padding-left:15;font-size:25'><em><b>Welcome to amazon</b></em></span>
	<span style='font-family:Helvetica;float:right;padding-right:10px;font-size:18;'>
	<a href='login.php'/>Login</a>&nbsp&nbsp<a href='signup.php'/>Signup</a>
	</span>";
}
echo "<br><br>";
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con,"shop_cart_p2") or die(mysqli_error($con)) ;

$query = "SELECT * FROM product";
$result = mysqli_query($con,$query);

$count=0;
echo "<table>";

while($row = mysqli_fetch_assoc($result)){   //Creates a loop to loop through results
$prod_id=$row['prod_id']; //unique product id

echo "<tr>";
echo "<td>";
echo "<fieldset class='style1'>";

echo "<div style='font-family:Helvetica;'>";
echo '<a href="description.php?prod_id='.$row['prod_id'].'" style="text-decoration:none">';
echo $row['prod_name'];
echo  '</a>';
echo "</div>";
echo "<br>";

//Passing information through hidden tag - it works similar to other tags
echo '<a href="description.php?prod_id='.$row['prod_id'].'">';
echo "<input type='hidden' name='prod_id' value='$prod_id'>";
echo '<img src="images/'.$row['file'].'"width="120" height="160" ">';
echo "</a>";

echo "<br>";
echo "Rs: ".$row['cost'];
echo "<br>";

echo "</fieldset>";
echo "</td>";

$count++;
if($count==6){
  $count=0;
  echo "</tr>";
}
}

echo "</table>";

//Make sure to close out the database connection
mysqli_close($con);

?>
</body>
</html>
