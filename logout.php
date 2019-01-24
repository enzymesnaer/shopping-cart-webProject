<?php
session_start();
unset($_SESSION['user_status']);
unset($_SESSION['user_name']);
unset($_SESSION['user_id']);
unset($_SESSION['email']);
unset($_SESSION['session_id']);
session_destroy();
echo "<br>";
echo "<br>";
echo "<em><h1>Thank You, Visit again<h1></em>";
echo "<br>";
echo "<a href = 'login.php'>Signup or Login.</a>";
echo "<br>";
echo "<br>";
echo "<a href = 'index.php'>Continue without logging in.</a>";
//header('location:index.php');
?>
