<?php
    $configs=new DOMDocument();
    $configs->load("config.xml");
$configElements=$configs->getElementsByTagName('config');

    foreach($configElements as $config){
   #     foreach ($config->attributes as $attr) {
    #        echo strtoupper($attr->nodeName).'----'.$attr->nodeValue.'<br/>';
     #   }
   $id =  $config->getAttribute("id");
   if($id == "haojue_try2") {
	    $value = NULL;    
#	    $param = $config->getElementsByTagName('param');
	  #  $value = $param->nodeValue;
	    	foreach ($config->getElementsByTagName('param') as $param) { 
            $value = $value . $param->nodeValue;
         }
        echo $value;  
	    echo '<br/><br/>';
   break;
   }
    }  
?>
