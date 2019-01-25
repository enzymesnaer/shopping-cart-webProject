<html>
  <head>
    <title>Add product</title>
  </head>
  <body style='background-color: #afeeee'>
    <div style='font-family:Comics Sans MS; float:right; padding-right: 10px; font-size:18;border-radius: 25px;'>
      <a href="logout.php">Logout</a>&nbsp&nbsp
      <a href="index.php">Home</a>
    </div>
    <b><em><h1>Welcome</h1></em></b>
    <fieldset style="background-color:#ffffff; border-radius: 25px;">
    <legend>Add Products</legend>
    <div style='font-family:Helvetica; float:left; padding-top:10px; border:1px; padding-right:10px; border-radius: 25px; margin:0px 0px 0px 300px;'>
    <form action="" method="post" enctype="multipart/form-data">
      Product Name:<input type="text" name="prod_name" value=""/> (Must be unique otherwise gives duplicate entry error)
      <br><br>
      Product Category: <select name="prod_type" required>
        <option label=""></option>
        <option>Mobiles</option>
        <option>Mpods</option>
        <option>Accessories</option>
        <option>Others</option>
      </select><br><br>
      Vendor Name: <select name="brand_type" required>
        <option label=""></option>
        <option>Apple</option>
        <option>Samsung</option>
        <option>Sony</option>
        <option>Nintendo</option>
        <option>Others</option>
      </select><br><br>
      Product Image: <input type="file" name="file" required/><br><br>
      Product Description: <input type="text" name="prod_descr" required/><br><br>
      Cost: <input type="text" name="cost" required/><br><br>
      <input type="submit" value="Add"/><span>&nbsp&nbsp</span>
      <input type="reset"  value="Reset"/>
    </form>
  </div>
  </fieldset>

<?php
sleep(1);
if($_POST){
session_start();

//connect and select db
$con = mysqli_connect('localhost','root','','shop_cart_p2') or die(mysqli_connect_error()) or die(mysqli_error($con));

$prod_name = @$_REQUEST['prod_name'];
$prod_type = @$_REQUEST['prod_type'];
$brand_type = @$_REQUEST['brand_type'];
$file = @$_FILES['file']['name'];
$prod_descr = @$_REQUEST['prod_descr'];
$cost = @$_REQUEST['cost'];
@move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);

$sql = "INSERT INTO product VALUES ('','$prod_name','$prod_type','$brand_type','$file','$prod_descr','$cost')";

mysqli_query($con, $sql) or die(mysqli_error($con));

$sql1 = "SELECT * FROM product WHERE prod_name = '$prod_name'";

$result = mysqli_query($con, $sql1) or die(mysqli_error($con));

if (mysqli_num_rows($result) == 1) {
  echo "<br><b><em>Product inserted successfully</em></b><br>";
  echo "To insert another product <a href = 'addproduct.php'>click here</a>";
}else {
  echo mysqli_error($con);
}
mysqli_close($con);
}
?>
</body>
</html>
