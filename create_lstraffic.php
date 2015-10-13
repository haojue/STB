<!DOCTYPE html>
<html>
<head>
	<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
	</script>
</head> 
<body>

<form id="form1" name="form1" method="post" action="runls.php">
<div id='test'>
<h3> Test option </h3>
Linux Tcl server
 <select id="tclserver" name="tclserver" >
                <option value="10.208.133.79">10.208.133.79</option>
                <option value="tcl server2">tcl server3</option>
        </select> <br>
Tcl name 
 <select id="tclname" name="tclname" >
<?php
  $doc = new DOMDocument();
  $doc->load( 'config.xml' );

  $items = $doc->getElementsByTagName( "config" );
  foreach( $items as $item )
  {
  $id =  $item->getAttribute("id");
  $type =  $item->getAttribute("type");
  $des =  $item->getAttribute("des");

  if($type == "LandSlide") {
    echo "<option value='$id'>" . $id . "</option>";  

#  echo "<td>" . $params . "<br>" . "</td>";
  }
  #  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  }                                                                                                                                                                            

?>
   </select> <br>
Landslide Chassis ip 
 <select id="chassisip" name="chassisip" >
                <option value="10.208.131.188">10.208.131.188</option>
        </select> <br>
Landslide User <input type="text" name="lsuser" id="lsuser" > <br>
Landslide Password<input type="text" name="lspass" id="lspass" > <br>
Landslide Library <input type="text" name="library" id="library" > <br>
Landslide Testsession <input type="text" name="session" id="session" > <br>
</div>
<br>
<input type="submit" name="Submit" value="submit" />
</form>
</body>
</html>
