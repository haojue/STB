<!DOCTYPE html>
<html>
<head>
	<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
	</script>
</head> 
<body>

<form id="form1" name="form1" method="post" action="runixiaewf.php">
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

  if($type == "IxiaLoad") {
    echo "<option value='$id'>" . $id . "</option>";  

#  echo "<td>" . $params . "<br>" . "</td>";
  }
  #  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  }                                                                                                                                                                            

  $device = $_COOKIE["dev"];
  $doc = new DOMDocument();
  $doc->load( 'dev.xml' );
  $items = $doc->getElementsByTagName( "dev" );

  foreach( $items as $item )
  {
  $name =  $item->getAttribute("name");

  if($name == $device) {
  $port1 = $item->getAttribute("port1");
  $port2 = $item->getAttribute("port2");
  break;
  }
  }


echo  " </select>";
echo  "<br>";
echo "Ixia Chassis ip"; 
echo "<select id='chassisip' name='chassisip' >";
echo  "<option value='10.208.69.220'>" . "10.208.69.220" . "</option>";
echo  "<option value='10.208.164.19'>" . "10.208.164.19" . "</option>";
echo   "</select>";
echo "<br>";
echo "Card name" . "<input type='text' name='cardname' id='cardname' >" . "<br>";
echo "start port" . "<input type='text' name='startport' id='startport' value='$port1' >" ."<br>";
echo "port <input type='text' name='endport' id='endport' value='$port2' >" .  "<br>";
#echo "start port" . "<input type='text' name='startport' id='startport'>" ."<br>";
#echo "port <input type='text' name='endport' id='endport'>" .  "<br>";
echo "</div>";
?>
<br>
<div id='traffic'>
<h3> Traffic option </h3>
Traffic type <select id="type" name="type" >
                <option value="cps">cps</option>
                <option value="cc">cc</option>
 </select> <br>
Target value<input type="text" name="value" id="value" > <br>
Sustain time<input type="text" name="sustaintime" id="sustaintime" > <br>
</div>
<input type="submit" name="Submit" value="submit" />
</form>
</body>
</html>
