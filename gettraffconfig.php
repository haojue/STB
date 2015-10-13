<?php
$q=$_GET["q"];

#$script=array("bps"=>"create_bpstraffic.php","ixiaewf"=>"create_ixiatraffic.php","ixiascreen"=>"create_screentraffic.php");
#echo "q is $q";
  $doc = new DOMDocument();
  $doc->load( 'traff.xml' );

  $traffs = $doc->getElementsByTagName( "traff" );
  foreach( $traffs as $traff )
  {
  $name =  $traff->getAttribute("name");
#  $params =  $int->getAttribute("param");
  if($name == $q) {
#  $params = $int->getElementsByTagName( "param" );
	
  echo $name;
#  echo "create_bpstraffic\.php";
 # $paras = explode(",",$params); 
 # foreach( $paras as $para ) {
 # echo $para . "," . "\n";
  }
  }
  
  echo $name;
  #  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;

#exec("sudo ./getconfig.pl", $info);
#echo "info is $info\n\n\n\n";
#echo "$q Config show here";
?>
