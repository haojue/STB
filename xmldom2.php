<?php
    $notes=new DOMDocument();
    $notes->load("note.xml");
$noteElements=$notes->getElementsByTagName('note');

    foreach($noteElements as $note){
        foreach ($note->attributes as $attr) {
            echo strtoupper($attr->nodeName).'----'.$attr->nodeValue.'<br/>';
        }
       $value = NULL;    
	foreach ($note->getElementsByTagName('heading') as $heading) {; 
            $value = $value . $heading->nodeValue.'&emsp;';
         }
        echo $value;  
 	echo '<br/><br/>';
    }  
?>
