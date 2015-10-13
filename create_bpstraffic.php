<!DOCTYPE html>
<html>
<head>
<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js">
</script>

<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
</script>
<link rel="stylesheet" type="text/css" href="mystyle.css" />
   <title>Scenario Testing Builder</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script> 

        <link rel="stylesheet" type="text/css" href="js/easyui.css">
        <link rel="stylesheet" type="text/css" href="js/icon.css">
        <link rel="stylesheet" type="text/css" href="js/demo.css">
   <script type="text/javascript" src="js/jquery-1.6.min.js"></script>                                                                                   
   <script type="text/javascript" src="js/jquery.easyui.min.js"></script>
<script>

function add(val) {
    //  alert();                                                                                                                                                               
var profilename  = document.getElementById("profilename");
    profilename.value = val;
}       

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

<!-- Test name <input type="text" name="profilename" id="profilename" > -->  

<div class="row">
  <div class="col-lg-6">
    <div class="input-group">
      <div class="input-group-btn">
<button type="button" data-toggle="dropdown"> Test name <span class="caret"></span></button>

        <ul class="dropdown-menu" role="menu">
<?php
  $doc = new DOMDocument();
  $doc->load( 'stats.xml' );

  $stats = $doc->getElementsByTagName( "test" );
  foreach( $stats as $stat )
  {
  $name =  $stat->getAttribute("name");
      echo  "<li onclick='add(\"$name\")'>" ."$name" . "</li>"; 
  }
  ?>
      <!--  <li onclick=add("t1222")>t1222 </li> -->
        </ul>
      </div><!-- /btn-group -->
      <input type="text"  name="profilename" id="profilename">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->

Ixia Chassis ip 
 <select id="chassisip" name="chassisip" >
                <option value="10.208.131.129">10.208.131.129</option>
                <option value="chassisip2">chassis ip2</option>
        </select> <br>
</div>
<br>
<div id='traffic'>
<h3> Traffic option </h3>
<?php

  if(!$device = $_REQUEST["dev"]) {
	$device =  $_COOKIE["dev"];
     }

  $doc = new DOMDocument();
  $doc->load( 'dev.xml' );
  $items = $doc->getElementsByTagName( "dev" );

  foreach( $items as $item )
  {
  $name =  $item->getAttribute("name");

  if($name == $device) {
  $bport1 = $item->getAttribute("bport1");
  $bport2 = $item->getAttribute("bport2");
  break;
  }
  }   
 echo "port1<input type='text' name='port1' id='port1'  value='$bport1' >" . "<br>";
 echo "port2<input type='text' name='port2' id='port2' value='$bport2'>" ."<br>";
echo "<input type='checkbox'  name='device' value='$device' checked='true' style='display:none' />";  
?>
Cps<input type="text" name="cps" id="cps" > <br>
Rampuptime<input type="text" name="rampuptime" id="rampuptime" > <br>
Sustaintime<input type="text" name="sustaintime" id="sustaintime" > <br>
Rampdowntime<input type="text" name="rampdowntime" id="rampdowntime" > <br>

</div>
<input type="submit" name="Submit" value="submit" />
</form>
</body>
</html>
