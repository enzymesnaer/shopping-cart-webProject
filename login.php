<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <style>
    body {font-family: Arial, Helvetica, sans-serif;}
    form {border: 3px solid #f1f1f1;}

    input[type=text], input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      opacity: 0.8;
    }

    .cancelbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }

    .container {
      padding: 16px;
    }

    span.password {
      float: right;
      padding-top: 16px;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
      span.password {
         display: block;
         float: none;
      }
      .cancelbtn {
         width: 100%;
      }
    }
    </style>
    <title></title>
  </head>
  <body>
    <br>
    <span style="font-family: Comic Sans MS;float:right;padding-right:8px;">
      <a href="cartbtn.php" style="border:1px; float:left;"><button style="border:1px; float:left; border-radius:115px;"><img src="ico/cart.png" width="30" height="30"></button></a>

      <a href="index.php" style="border:1px; float:left;"><button style="border:1px; border-radius:115px;"><img src="ico/home.png" width="30" height="30"></button></a>
    </span>

    <form action="" method="post"><br><br><br>
  <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
  </div>
  <div class="container" style="background-color:#f1f1f1">
    <button type="reset" class="cancelbtn">Cancel</button>
  </div>
</form><br>
New user? Not yet Registered!!<br>
click here to <a href="signup.php"><b>Signup</b></a>


<?php
if($_POST){
$con = mysqli_connect('localhost','root','','shop_cart_p2');
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$username = $_REQUEST['username'];

$sql = "select * from tbl_users where email = '$email' AND pwd = '$password' AND name='$username'";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

$sql1 = "select * from tbl_users where email = '$email' AND pwd = '$password' AND name='$username' AND admin = '1'";
$result1 = mysqli_query($con, $sql1) or die(mysqli_error($con));

if(mysqli_num_rows($result1)>0){
  //admin request
  header('location:addproduct.php');
}else{
  if(mysqli_num_rows($result)>0){
    //user request
    session_start();
    $row = mysqli_fetch_assoc($result);

    //session id
    $text = session_id();
    $_SESSION['session_id'] = $text;
    $_SESSION['user_status'] = 'logged_in';
    $_SESSION['user_name'] = $row['name'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['user_id'] = $row['user_id'];

    echo "Welcome".$_SESSION['user_name']."<br>";
    mysqli_close($con);
    header('location:index.php');
  }else{
    echo "<h2>User not found</h2><br>You might have entered invalid user information.<br>";
    echo("Click here to<a href='login.php'><b>Login<b></a> or <a href='signup.php'><b>Signup<b></a>");
  }
}
}
 ?>
  </body>
</html>
