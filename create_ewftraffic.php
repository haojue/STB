<!DOCTYPE html>
<html>
<head>
	<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
	</script>
<script>
function foo2() {
var checkbox01 = document.getElementById("checkbox01");
var checkbox02 = document.getElementById("checkbox02");
var checkbox03 = document.getElementById("checkbox03");
var checkbox04 = document.getElementById("checkbox04");


if(checkbox01.checked) {
        document.getElementById("type").disabled = false;
} else {
 document.getElementById("type").disabled = true;
}

if(checkbox02.checked) {
        document.getElementById("value").disabled = false;
} else {
 document.getElementById("value").disabled = true;
}

if(checkbox03.checked) {
        document.getElementById("sustaintime").disabled = false;
} else {
 document.getElementById("sustaintime").disabled = true;
}

if(checkbox04.checked) {
        document.getElementById("otherparameters").disabled = false;
} else {
 document.getElementById("otherparameters").disabled = true;
}

}
</script>
</head> 
<body>

<form id="form1" name="form1" method="post" action="runixiaewf.php">
<div id='test'>
<h3> Test option </h3>
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

  if(!$device = $_REQUEST["dev"]) {
  $device = $_COOKIE["dev"];
  }

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
echo  "Windows Tcl server";
echo "<select id='tclserver' name='tclserver' >";
echo "<option value='10.208.133.2'>" . "10.208.133.2" ."</option>";
echo "<option value='tcl server2'>" ."tcl server2" ."</option>";
echo "</select>" . "<br>";
echo "Ixia Chassis ip"; 
echo "<select id='chassisip' name='chassisip' >";
echo  "<option value='10.208.69.220'>" . "10.208.69.220" . "</option>";
echo  "<option value='10.208.164.19'>" . "10.208.164.19" . "</option>";
echo   "</select>";
echo "<br>";
#echo "Card name" . "<input type='text' name='cardname' id='cardname' >" . "<br>";
echo "client card/port" . "<input type='text' name='startport' id='startport' value='$port1' >" ."(split with ':')"."<br>";
echo "server card/port" . "<input type='text' name='endport' id='endport' value='$port2' >" . "(split with ':')" . "<br>";
#echo "start port" . "<input type='text' name='startport' id='startport'>" ."<br>";
#echo "port <input type='text' name='endport' id='endport'>" .  "<br>";
echo "<input type='checkbox'  name='device' value='$device' checked='true' style='display:none' />";
echo "</div>";
?>
<br>
<div id='traffic'>
<h3> Traffic option </h3>
<!---
Page size <select id="size" name="size" >
                <option value="1b.html">1b.html</option>
                <option value="4k.html">4k.html</option>
                <option value="8k.html">8k.html</option>
                <option value="16k.html">16k.html</option>
                <option value="32k.html">32k.html</option>
                <option value="64k.html">64k.html</option>
                <option value="128k.html">128k.html</option>
                <option value="256k.html">256k.html</option>
                <option value="512k.html">512k.html</option>
                <option value="1024k.html">1024k.html</option>
</select> <br>
--->
<input type='checkbox' id='checkbox01' name='checkbox01' value='checkbox01' checked="true" onclick='foo2()'/>
Traffic type <select id="type" name="type" >
                <option value="cps">cps</option>
                <option value="cc">cc</option>
 </select> <br>
<input type='checkbox' id='checkbox02' name='checkbox02' value='checkbox02' checked="true" onclick='foo2()'/>
Target value<input type="text" name="value" id="value" > <br>
<input type='checkbox' id='checkbox03' name='checkbox03' value='checkbox03' checked="true" onclick='foo2()'/>
Sustain time<input type="text" name="sustaintime" id="sustaintime"> <br>
<input type='checkbox' id='checkbox04' name='checkbox04' value='checkbox04 '  onclick='foo2()'/>
Customized parameters<input type="text" name="otherparameters" id="otherparameters" disabled="true" > (split with ':') <br>
<br>
<h6>(Note:Please follow the parameters order when invoking the tcl script: ./$tclname $tclserver $chassisip $startport $endport $others )
</h6>
</div>
<input type="submit" name="Submit" value="submit" />
</form>
</body>
</html>
