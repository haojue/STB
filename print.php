<?php

$img = imagecreatetruecolor(400, 300);

$bg = imagecolorallocate($img, 0, 255, 255);

#$col_ellipse = imagecolorallocate($image, 255, 255, 255);
#imageellipse($image, 200, 150, 300, 200, $col_ellipse);

#$black = imagecolorallocate($img, 0, 0, 0);

$blue_color = imagecolorallocate($img, 0, 0, 255);               
$red_color = imagecolorallocate($img, 255, 0, 0);  
imageellipse($img, 300, 200, 300, 200, $blue_color);  
imagefill($img, 300, 200, $red_color); 

#imagearc($image, 100, 100, 150, 180, 0, 90,$bg);

header("Content-type: image/png");
imagepng($img);

?>
