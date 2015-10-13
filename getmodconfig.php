<?php
$q=$_GET["q"];

#echo "q is $q";
  $doc = new DOMDocument();
  $doc->load( 'mod.xml' );

  $mods = $doc->getElementsByTagName( "mod" );
  foreach( $mods as $mod )
  {
  $id =  $mod->getAttribute("id");
  $params =  $mod->getAttribute("param");
  if($id == $q) {
#  $params = $int->getElementsByTagName( "param" );
  echo  $params;
  }
#  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  }

  $doc = new DOMDocument();
  $doc->load( 'config.xml' );

  $configs = $doc->getElementsByTagName( "config" );
  foreach( $configs as $config )
  {
  $id =  $config->getAttribute("id");
  $params =  $config->getAttribute("param");
     $value = NULL;
    foreach ($config->getElementsByTagName('param') as $param) {
            $value = $value . $param->nodeValue;                                                                                                                               
         }
  if($id == $q) {
#  $params = $int->getElementsByTagName( "param" );


  $items = explode(",",$value);
  $params = implode(",",$items);
  echo  $params;
  }
#  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  }


#exec("sudo ./getconfig.pl", $info);
#echo "info is $info\n\n\n\n";
#echo "$q Config show here";
?>
