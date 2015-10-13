<?php
$q=$_GET["q"];

#echo "q is $q";
  $doc = new DOMDocument();
  $doc->load( 'int.xml' );

  $ints = $doc->getElementsByTagName( "int" );
  foreach( $ints as $int )
  {
  $id =  $int->getAttribute("id");
  $params =  $int->getAttribute("param");
  if($id == $q) {
#  $params = $int->getElementsByTagName( "param" );
#  echo  $params;
  $paras = explode(",",$params); 
  foreach( $paras as $para ) {
  echo $para . "," . "\n";
  }
  }
#  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  }

#exec("sudo ./getconfig.pl", $info);
#echo "info is $info\n\n\n\n";
#echo "$q Config show here";
?>
