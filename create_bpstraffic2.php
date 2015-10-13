<!DOCTYPE html>
<html>
<head>
	<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
	</script>
</head> 
<body>

<form id="form1" name="form1" method="post" action="runbps2.php">
<div id='test'>
<h3> Test option </h3>
Linux Tcl server
 <select id="tclserver" name="tclserver" >
                <option value="10.208.130.44">10.208.130.44</option>
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

  if($type == "BPS") {
    echo "<option value='$id'>" . $id . "</option>";  

#  echo "<td>" . $params . "<br>" . "</td>";
  }
  #  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  }

?>
   </select> <br> 

Test name <input type="text" name="profilename" id="profilename" > <br>
Ixia Chassis ip 
 <select id="chassisip" name="chassisip" >
                <option value="10.208.131.129">10.208.131.129</option>
                <option value="chassisip2">chassis ip2</option>
        </select> <br>
</div>
<br>
<div id='traffic'>
<h3> Traffic option </h3>
port1<input type="text" name="port1" id="port1" > <br>
port2<input type="text" name="port2" id="port2" > <br>
Cps<input type="text" name="cps" id="cps" > <br>
Rampuptime<input type="text" name="rampuptime" id="rampuptime" > <br>
Sustaintime<input type="text" name="sustaintime" id="sustaintime" > <br>
Rampdowntime<input type="text" name="rampdowntime" id="rampdowntime" > <br>
</div>
<input type="submit" name="Submit" value="submit" />
</form>
</body>
</html>
