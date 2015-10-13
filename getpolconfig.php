<?php
$q=$_GET["q"];

#echo "q is $q";
  $doc = new DOMDocument();
  $doc->load( 'pol.xml' );

  $pols = $doc->getElementsByTagName( "pol" );
  foreach( $pols as $pol )
  {
  $id =  $pol->getAttribute("id");
  $params =  $pol->getAttribute("param");
  if($id == $q) {
#  $params = $int->getElementsByTagName( "param" );
  echo  $params;
  }
#  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  }

#exec("sudo ./getconfig.pl", $info);
#echo "info is $info\n\n\n\n";
#echo "$q Config show here";
?>
