<!DOCTYPE html>
<html>
<head>
        <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
        </script>
   <title>Create Traffic</title>
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


<script src="selecttraff1.js"></script>
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

function appendtxt(value){
        var div = document.createElement("div");
        div.innerText=value;            
        document.body.appendChild(div);
}	

function showiframe(str){
alert(str);
var options = str;	
if(str == "bps") {
var file =  create_bpstraffic.php;
} else if(str == "ixiaewf") {
var file =  create_ewftraffic.php;
} else if(str == "ixiascreen") {
var file =  create_screentraffic.php;
} else if(str == "testcenter") {
var file =  create_tctraffic.php;
}	

document.getElementById("iframe").src = file; 
}

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


</script>
</head>
<body>
<?php include 'navigators3.php'; ?>
<br>
<h3 style="background-color:#EEEEEE;text-align:left;height:5%;width:80%">Step3:Select Traffic</h3>
<table id="devs" border="1" width="400" cellpadding="10">
<tr>
  <th>Traffic Type</th>
  <th></th>
</tr>
<?php
#  echo "$type";
#  echo "$dev";

  $port1 = 3;
  $port2 = 4; 
  $doc = new DOMDocument();
  $doc->load( 'traff.xml' );
  $traffs = $doc->getElementsByTagName( "traff" );
  foreach( $traffs as $traff )
  {
  echo "<tr>";	  
  $name =  $traff->getAttribute("name");
  $gettype =  $traff->getAttribute("type");
  if($type == $gettype) {
  switch($type) {
  #  $serverip =  $job->getAttribute("serverip");
#  $scriptname =  $job->getAttribute("scriptname");
#  $params = $job->getElementsByTagName( "param" );
  case "bps":	
    echo "<td nowarp>" . $name . "<br>" . "</td>";
    echo "<td nowarp>" . "<input type='button' name='$type' value='Use' onclick='showtraff(this.name)' />" . "</td>";
#    echo "<td nowarp>" . "<input type='button' name='$type' value='Use' onclick='showiframe(this.name)' />" . "</td>";
    echo "</tr>";
    break;
  case "ixiaewf":	
    echo "<td nowarp>" . $name . "<br>" . "</td>";
    echo "<td nowarp>" . "<input type='button' name='$type' value='Use' onclick='showtraff(this.name)' />" . "</td>";
#    echo "<td nowarp>" . "<input type='button' name='$type' value='Use' onclick='showiframe(this.name)' />" . "</td>";
    echo "</tr>";
    break;
  case "ixiascreen":	
    echo "<td nowarp>" . $name . "<br>" . "</td>";
    echo "<td nowarp>" . "<input type='button' name='$type' value='Use' onclick='showtraff(this.name)' />" . "</td>";
#    echo "<td nowarp>" . "<input type='button' name='$type' value='Use' onclick='showiframe(this.name)' />" . "</td>";
    echo "</tr>";
    break;
  case "testcenter":	
    echo "<td nowarp>" . $name . "<br>" . "</td>";
    echo "<td nowarp>" . "<input type='button' name='$type' value='Use' onclick='showtraff(this.name)' />" . "</td>";
#    echo "<td nowarp>" . "<input type='button' name='$type' value='Use' onclick='showiframe(this.name)' />" . "</td>";
    echo "</tr>";
    break;
  }
  }
  }
echo "</table>";
echo "<br>";
#echo "<iframe id='iframe' src='create_tctraffic.php' frameborder='0' width='600' height='480'>" . "</iframe>";
$files=array("bps"=>"create_bpstraffic.php","ixiaewf"=>"create_ewftraffic.php","ixiascreen"=>"create_screentraffic.php","testcenter"=>"create_tctraffic.php");
$file=$files[$type];
echo "<iframe id='iframe' src='$file?dev=$dev' frameborder='0' width='600' height='480'>" . "</iframe>";
#echo "<iframe id='iframe' src='create_bpstraffic.php?dev=$dev' frameborder='0' width='600' height='480'>" . "</iframe>";
?>
</body>
</html>
