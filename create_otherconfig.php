<!DOCTYPE html>
<html>
<head>
	<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
	</script>
<script src="selectdut.js"></script>

<link rel="stylesheet" type="text/css" href="mystyle.css" />
         <link rel="stylesheet" type="text/css" href="js/easyui.css">
	<link rel="stylesheet" type="text/css" href="js/icon.css">
        <link rel="stylesheet" type="text/css" href="js/demo.css"> 

   <title>Scenario Testing Builder</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script> 
   <script type="text/javascript" src="js/jquery-1.6.min.js"></script>
   <script type="text/javascript" src="js/jquery.easyui.min.js"></script>


<script>
function foo() {
var checkbox01 = document.getElementsByName("checkbox01");

if(checkbox01[0].checked && checkbox01[1].checked) {
checkbox01[0].checked = false ;                                                                                                                          
var p = document.createElement("p");  
var tp = document.createTextNode("createTextNode"); 
p.appendChild(tp);
document.body.appendChild(p);
alert("only one box can be selected!");
}
}

function scroll() {var txt=document.getElementById("txt");txt.scrollTop=txt.scrollHeight; }
</script>


</head> 
<body onload=scroll()>
<?php include 'navigators2.php'; ?>
<?php 
#print_r($_POST);
$next=$_POST['Submit'];
#var_dump($dev);
#echo print_r($checkbox1);
if($next == "Skip Next") {
$GoTo="create_traff.php";
header(sprintf("Location: %s", $GoTo));
}

if (preg_match("/Add new device/i",$next)) {
 include 'add_device.php';
 return;
}

?> 

<div id='test'>

<!-- <form action="commitconfig.php" method="post" enctype="multipart/form-data"> -->

<h3 style="background-color:#EEEEEE;text-align:left;width:70%">Step2:Select Config</h3>
<table id="devs" border="1" width="400" cellpadding="10">
<tr>
  <th>config name</th>
  <th>Description</th>
  <th>Owner</th>
  <th></th>
</tr>
<?php
$dev=$_POST['checkbox01'];

if (!(isset($_COOKIE["user"]))) {
	header('Location: ./login.php');
}

$user = $_COOKIE["user"];
setcookie("user", "$user", time()+3600); 

if (!empty($_POST['checkbox01'])) {
setcookie("dev", "$dev", time()+3600);
} else {
       $dev = $_COOKIE["dev"]; 
  echo "No devices selected, use last selected device $dev";
  echo "<br>";
}

############################################################################################
$device = $_COOKIE["dev"];

    exec("sudo ./getlink.pl $device",$arr, $sta);
    $string = implode(",",$arr);
#  echo var_dump($arr);
  preg_match("/.*?(Current.*)\[regress.*/is", $string, $matches);
  $want = explode(",",$matches[1]);


#  var_dump($matches);

  $port=array();
  $bport=array();
    foreach($want AS $value){
   #        if( preg_match_all("/.*?(ixia.*?\s+)(\d+\/\d+).*/is", $value, $matches)) {
           if( preg_match_all("/(ixia.*?\s+)(\d+\/\d+)/is", $value, $matches)) {
#           var_dump($matches[2]);		 
	   #         echo "$matches[2]";
	    foreach($matches[2] as $temp) { 
		   array_push($port,$temp);
	    } 
	    } elseif (preg_match_all("/(bps-ctm.*?\s+)(eth\d+)/is", $value, $matches)) {   
              	var_dump($matches[2]);   
	      foreach($matches[2] as $temp) { 
       	        array_push($bport,$temp);
              }  
	    }
    }


  $count = count($port);
  for ($x=0; $x<($count/2); $x++) {
  $string1 .= $port[$x];
  $string1 .= ':';    
  }

  preg_match("/(.*):/is",$string1,$matches);

  exec("sudo ./dev.pl attr $device port1 $matches[1]");

  for ($x=$count/2; $x<$count; $x++) {
  $string2 .= $port[$x];
  $string2 .= ':';    
  }

  preg_match("/(.*):/is",$string2,$matches);
  exec("sudo ./dev.pl attr $device port2 $matches[1]");


  $count = count($bport);
  for ($x=0; $x<($count/2); $x++) {
  $string1 .= $bport[$x];
  $string1 .= ':';    
  }

  preg_match("/(.*):/is",$string1,$matches);

  exec("sudo ./dev.pl attr $device bport1 $matches[1]");

  for ($x=$count/2; $x<$count; $x++) {
  $string2 .= $bport[$x];
  $string2 .= ':';    
  }

  preg_match("/(.*):/is",$string2,$matches);
  exec("sudo ./dev.pl attr $device bport2 $matches[1]");


#  exec("sudo ./dev.pl attr $device port1 $port[0]");
#  exec("sudo ./dev.pl attr $device port2 $port[1]");

#############################################################################################


#$dev=$_POST['dut'];
#var_dump($dev);
#echo print_r($checkbox1);
#echo "$dev";
#$devs=array("bajie","donghai");

$doc = new DOMDocument();
$doc->load('config.xml');
$configs = $doc->getElementsByTagName("config");
foreach ($configs as $name)
{
	echo "<tr>";

	$id = $name->getAttribute("id");
	$type = $name->getAttribute("type");
	$des = $name->getAttribute("des");
	$owner = $name->getAttribute("owner");
#	$inuse =  $name->getAttribute("inuse");

if(!($type == "BPS") && !($type == "IxiaLoad") && !($type == "IxiaExplorer") && !($type == "TestCenter") && !($type == "LandSlide") ) {
        echo "<td nowarp>" . $id . "<br>" . "</td>";
	echo "<td nowarp>" . $des . "<br>" . "</td>";
	echo "<td nowarp>" . $owner . "<br>" . "</td>";
	echo "<td nowarp>" . "<input type='button' name='$id' value='Use' onclick='showconfig(this.name)' />" . "</td>";
	echo "</tr>";
  }
}
?>
</table>

<!-- <a href="create_config.php" target="_blank"> Add new base config</a>  -->

<form action="commitconfig.php" method="post" enctype="multipart/form-data">
<?php 


if (isset($_COOKIE["dev"]))
{ $dev = $_COOKIE["dev"];
#    echo "welcome $dev";
}else
{ $dev=$_POST['checkbox01']; 
#    echo "welcome $dev";
}

echo "<input type='checkbox'  name='checkbox01' value='$dev' checked='true' style='display:none' />";
?>
<h4 style="background-color:#EEEEEE;text-align:left;width:50%" >Config To Commit</h4> <p>("," is expected at the end of each config, use Config Formatter to add ",") </p> 
<textarea rows="10" cols="120" name="txt" id="txt"></textarea>
<br>
<input type="submit" name="Submit" value="commit" />

<input type="submit" name="Submit" value="Save as config" />

<input type="submit" name="Submit" value="View DUT config" />

<input type="submit" name="Submit" value="Config Formatter" />
<!--- <a href='commitconfig.php?Submit="View DUT config"' target='_blank'> View DUT config --> 


<br>
<br>
<br>
<input type="submit" name="Submit" value="Next Step" />
</form>

</div>
</body>
</html>
