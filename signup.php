<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="theme1.css">
  </head>
  <body style="margin:auto; background-color: #afeeee">
    <form action="" method="post" style="border:1px solid #ccc">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="username"><b>Username: </b></label>

    <input type="text" placeholder="please enter a unique username" name="username" id="username" required><br>

    <label for="email"><b>Email: </b></label>

    <input type="text" placeholder="Enter Email" name="email" required><br>

    <label for="password"><b>Password: </b></label>

    <input type="password" placeholder="minimum 6 characters" name="password" id="password" required><br>

    <label for="captcha"><b>Please enter Captcha Code: </b></label>

    <input type="text" placeholder="Enter code here" name="captcha" id="captcha" required>

    <img src="captcha.php"><br>


    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>
<!----------------------------------------------------------------------->
<!----------------------------------------------------------------------->
<?php
session_start();
if($_POST){
  //retriving details from html form
  $username = $_REQUEST['username'];
  $password = $_REQUEST['password'];
  $email = $_REQUEST['email'];

  //check length of the password
  if(strlen($password)<6){
    unset($_SESSION['vercode']);
    session_destroy();
    echo ("Click here to <a href='login.php'>Login</a> or <a href='signup.php'>Signup</a>");
    die("<b>Password length must be greater than 5</b>");
  }else {
    if($_POST['captcha'] != $_SESSION['vercode']){
      echo "<h4>Invalid captcha.</h4><br>";
      echo ("Click here to <a href='login.php'>Login</a> or <a href='signup.php'>Signup</a>");
      unset($_SESSION['vercode']);
      session_destroy();

    }else {
      unset($_SESSION['vercode']);
      session_destroy();

      //registering to DB
      $con = mysqli_connect('localhost','root','','shop_cart_p2');
      $sql = "INSERT INTO tbl_users(name,email,pwd) VALUES('$username','$email','$password')";

      //fire query over tbl_users table
      $result = mysqli_query($con, $sql) or die(mysqli_error($con));

      echo "<body><div style='width:1150px; height:60%; text-align:center; margin:100px; border:1px; border-style:solid; background-color:#afeeee;'>
      <div style='padding:100px; background-color:#ffffff;'>Signed up successfully <a href = 'login.php'/> Click here to login. </a></div></body>";

      mysqli_close($con);
    }
  }
}
 ?>
  </body>
</html>
