<?php
$image = imagecreatefrompng("juniper.png");  
        $values = array(  
                                40,50,  
                                20,240,  
                                60,60,  
                                240,20,  
                                50,40,  
                                10,10,  
                        );          
        $blue = imagecolorallocate($image,0,0,255);  
        imagefilledpolygon($image,$values,6,$blue);  
        header("Content-type: image/png");  
        imagejpeg($image);  
        imagedestroy($image);
?>
