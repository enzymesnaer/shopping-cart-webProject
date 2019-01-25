<html>
<head>

<script type="text/javascript">

		function deleteCart(value)
		{
			var xmlhttp= new XMLHttpRequest();
			xmlhttp.open("GET","deletecart.php?prod_id="+value,true);
			xmlhttp.send();
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState == 4)
				{
				document.getElementById('response').innerHTML=xmlhttp.responseText;
        }
			}
		}
</script>

</head>
<div id="response"></div>
<?php

session_start();
if(isset( $_SESSION['session_id']) and isset( $_SESSION['user_id'])){

echo '<h1>amazon</h1>';
echo '<div style="font-size:20px; font-family:Helvetica; float:right; padding-right:8px">
      <a href="index.php"><button><img src="ico/home.png" width="30" height="30"></button></a>&nbsp&nbsp
      <a href="cartbtn.php"><button><img src="ico/cart.png" width="30" height="30"></button></a>&nbsp&nbsp
      <a href="login.php">Login</a></div>';
}
else{
			die("Click here to<a href='login.php'>Login</a> or <a href='signup.php'>Signup</a>&nbsp&nbsp
			<a href='index.php'/>Back</a>");
		}
?>

<?php

$session_id= $_SESSION['session_id'];
$user_id= $_SESSION['user_id'];


$con= mysqli_connect('localhost','root','')	or die("<b>Sorry, cannot connect to your localhost</b>");
mysqli_select_db($con,'shop_cart_p2') or die("<b>Sorry, db not found.</b>");
$sql1="Select prod_id from reference where user_id='$user_id'";
$result1=mysqli_query($con,$sql1) or die(mysqli_error($con));

if(@mysqli_num_rows($result1)>0){
$message = "You Have Cart Contents";
echo "<script type='text/javascript'> alert('$message'); </script>";

$_SESSION['totalcost'] = 0;
$count=0;
echo "<table>";
	while($row = mysqli_fetch_assoc($result1)){

				echo "<td>";
				echo "<fieldset style='align-content:left'>";
				$prod_id= $row['prod_id'];
				$sql2="Select * from product where prod_id='$prod_id'";
				$result2=mysqli_query($con,$sql2) or die(mysqli_error($con));
				$column = mysqli_fetch_assoc($result2);

				//Start of prod_name div
				echo "<div style='font-family:Comic Sans MS;font-size:20;border-style: solid;border-color:green;text-align:center'>";
				echo $column['prod_name'];
				echo "</div>";
				echo "<br>";
				// Prod image
				echo '<img src="pics/'.$column['file'].'" height="200" ">';

        ////////// Prod Descr div & "SESSION var" Total cost
				echo "<div style='text-align:left;float:right; font-family:Comic Sans MS;font-size:20;padding-left: 5px; border-style: solid;border-color: red;max-width:300px;word-wrap:break-word;'>".$column['prod_descr'];
				echo "<br><br>";
				echo "Rs:". $column['cost'];
				$_SESSION['totalcost'] += $column['cost'];
				echo "<br><br>";
				echo "</div>";
				echo "<br><br>";
				//End of outer div

				echo "<div style='padding-left:5px;'>";
				echo "<a href='buy.php'><button>Buy</button></a>";
				echo "&nbsp&nbsp&nbsp";
				echo "<input type ='submit' value='Remove From Cart' onclick=deleteCart('$prod_id')>";
        echo "</div>";

				echo "</fieldset>";
				echo "</td>";

				$count++;
				if($count==1)
				{
				$count=0;
				echo "</tr>";
				}

	}

echo"</table>";
}
else{
		$message = "Cart empty. Add products.";
		echo "<script type='text/javascript'> alert('$message');</script>";
		echo "Click On Add To Cart To Add Contents.";
}
?>
</body>
</html>
