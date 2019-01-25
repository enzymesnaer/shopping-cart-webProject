<html>
<head>
  <script type="text/javascript">
  function AddToCart(value)
  {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","addtocart.php?prod_id="+value,true);
    xmlhttp.send();

    xmlhttp.onreadystatechange=function(){

      if (xmlhttp.readyState==4) {
        document.getElementById('response').innerHTML=xmlhttp.responseText;
      }
    }
  }
  </script>
  <style type="text/css">
  .style1{
    width:180px;
  }
  </style>
</head>
<h2>amazon</h2><br>
<h3 id="response"></h3>
<?php

  session_start();
  if (!isset($_SESSION['session_id']) or !isset($_SESSION['user_id'])) {

    echo '<span style="font-size:20px; font-family:Helvetica; float:right; padding-right:8px">
    <a href="index.php"><button><img src="ico/home.png" width="30" height="30"></button></a>&nbsp&nbsp
    <a href="cartbtn.php"><button><img src="ico/cart.png" width="30" height="30"></button></a>&nbsp&nbsp
    <a href="login.php">Login</a></span>';
  }
  else {
    echo '<span style="font-size:20px;font-family:Helvetica;float:right;padding-right:8px">
	        <a href="index.php"><button><img src="ico/home.png" width="30" height="30"></button></a>&nbsp&nbsp
    			<a href="cartbtn.php"><button><img src="ico/cart.jpg" width="30" height="30"></button></a>&nbsp&nbsp
    			<a href="logout.php">Logout</a></span>';
  }

$prod_id= @$_REQUEST['prod_id'];
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con,"shop_cart_p2") or die(mysqli_error($con));

$query = "SELECT * FROM product where prod_id='$prod_id'";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);

echo "<table>";
echo "<td>";

echo "<fieldset style='align-content:left'>";
echo "<div style='font-family:Helvetica; font-size:20; border-style: solid; border-color:green; text-align:center'>";
echo $row['prod_name'];
echo "</div>";
echo "<br>";

//echo image --
echo '<img src="images/'.$row['file'].'"height="300">';

//Inner Div
echo "<div style='text-align:left; float:right; font-family:Helvetica;font-size:20;padding-left:5px; border-style: solid; border-color:red; max-width:500px; word-wrap:break-word;'><br>".$row['prod_descr'];
echo "<br><br>";
echo "Rs.".$row['cost'];
echo "<br><br>";
echo "</div>";
//end Div
echo "<br><br>";

$prod_id=$row['prod_id'];
echo "<div style='padding-left:5px;'>";
echo "<input type='submit' value='Add To Cart' onclick=AddToCart('$prod_id')>";
echo "&nbsp &nbsp";

echo "<a href='buy.php'><button>Buy</button></a>";
echo "</div>";

echo "</fieldset>";
echo "</td>";
echo "</table>";

mysqli_close($con);
 ?>
