<?php

/**
 * @author Klaas Vanaudenaerde
 * @copyright 2008
 */


/*$image = imagecreate(102,8);
$background = imagecolorallocate($image, 255, 255, 255);
$foreground = imagecolorallocate($image, 0, 0, 0);
$border = imagecolorallocate($image, 0, 0, 0);
$image2 = imagecreatefrompng("1.png");
imagecopy($image, $image2, 1, 1, 1, 1, ($_GET['per'])*10, 6);
imagerectangle($image, 0, 0, 101, 7, $border);
header('Content-type: image/png');
imagepng($image,NULL,9);*/


function drawRating($rating) {
   $width = $_GET['width'];
   $height = $_GET['height'];
   if ($width == 0) {
     $width = 102;
   }
   if ($height == 0) {
     $height = 8;
   }
   $rating = $_GET['rating'];
   $ratingbar = (($rating/100)*$width)-2;
   $image = imagecreate($width,$height);
   $fill = ImageColorAllocate($image,0,255,0); 
   if ($rating > 49) { $fill = ImageColorAllocate($image,255,255,0); } 
   if ($rating > 74) { $fill = ImageColorAllocate($image,255,128,0); } 
   if ($rating > 89) { $fill = ImageColorAllocate($image,255,0,0); } 
   $back = ImageColorAllocate($image,255,255,255);
   $border = ImageColorAllocate($image,0,0,0);
   ImageFilledRectangle($image,0,0,$width-1,$height-1,$back);
   ImageFilledRectangle($image,1,1,$ratingbar,$height-1,$fill);
   ImageRectangle($image,0,0,$width-1,$height-1,$border);
   imagePNG($image);
   imagedestroy($image);
}
@Header("Content-type: image/png");
drawRating($rating);

?>