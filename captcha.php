<?php
session_start();
$possible = '0123456789bcdfghjkmnpqrstvwxyz';
$text = '';
$i = 0;
while ($i < 5) {
  $text .= substr($possible, mt_rand(0,strlen($possible)-1), 1);
  $i++;
}
$_SESSION["vercode"] = $text;
$height = 30;
$width = 150;
$image_p = imagecreate($width, $height);
$white = imagecolorallocate($image_p, 0, 0, 0);
$white = imagecolorallocate($image_p,255,255,255);
$font_size = 25;
imagestring($image_p, 20, 18, 5, $text, $white);
imagejpeg($image_p,null,80);
?>
