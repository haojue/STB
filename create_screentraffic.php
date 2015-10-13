<!DOCTYPE html>
<html>
<head>
	<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
	</script>
</head> 
<body>

<form id="form1" name="form1" method="post" action="runixiascreen.php">
<div id='test'>
<h3> Test option </h3>
Linux Tcl server
 <select id="tclserver" name="tclserver" >
                <option value="10.208.133.79">10.208.133.79</option>
                <option value="tcl server2">tcl server2</option>
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

  if($type == "IxiaExplorer") {
    echo "<option value='$id'>" . $id . "</option>";  

#  echo "<td>" . $params . "<br>" . "</td>";
  }
  #  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  }                                                                                                                                                                            

?>
   </select> <br>
Ixia Chassis ip 
 <select id="chassisip" name="chassisip" >
                <option value="10.208.68.58">10.208.68.58</option>
                <option value="10.208.170.8">10.208.170.8</option>
        </select> <br>
Card name <input type="text" name="cardname" id="cardname" > <br>                                                                                        
port <input type="text" name="port" id="port" > <br>
</div>
<br>
<div id='traffic'>
<h3> Traffic option </h3>
DstMac<input type="text" name="dstmac" id="dstmac" > <br>
SustainTime<input type="text" name="stime" id="stime" > <br>
</div>
<input type="submit" name="Submit" value="submit" />
</form>
</body>
</html>
