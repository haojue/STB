<!DOCTYPE html>
<html>
<head>
        <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
        </script>
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
   <script type="text/javascript" src="js/tablesorter.js"></script>


<script>
function newdev(){
             $('#dlg').dialog('open').dialog('setTitle','New Device');
             $('#fm').form('clear');
             url = 'save_user.php';
} 


function saveDev()
    {  
         $('#dlg').dialog('close');
          url = 'save_dev.php';    
	 $('#fm').form('submit',{url: url});
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

function appendtxt(value){
        var div = document.createElement("div");
        div.innerText=value;            
        document.body.appendChild(div);
}	

$(function () {
        $("input[type=checkbox]").click(function () {
        if($("input[type=checkbox]:checked").length>1) {
        alert("only one box can be selected!"); 
	}		
//		$(this).siblings().attr("checked", false);
        });
 });

function foo2() {
      if($("input[type=checkbox]:checked").length<1) {
       document.getElementById("form1").action = "baseconfig.php" ;	 
	      alert("one box should be selected!"); 
      } 
}

$(document).ready(function() 
    { 
        $("#devs").tablesorter(); 
    } 
);
</script>

</head>
<body>
<?php include 'navigators1.php'; ?>

<h3 style="background-color:#EEEEEE;text-align:left;width:80%">Step1:Select DUT</h3>
<!-- <hr  align="left" style="height:2px;width:80%;border-top:2px solid #185598;" /> --> 
<h4 style="background-color:#EEEEEE;text-align:left;height:5%;width:80%"> &nbsp Testbed Info </h4>
<form id="form1" action="create_otherconfig.php" method="post">  
<table id="devs" border="1" width="400" cellpadding="10" class="tablesorter">
<tr>
  <th>device name</th>
  <th>device type</th>
  <th>cluster status</th>
  <th>owner</th>
  <th>In use</th>
  <th></th>
  <th></th>
  <th></th>
</tr>

 <?php
#include 'joblib.php';
#$cmd = find_cmd_by_jobid(0528140332);
#var_dump($cmd);

if (!(isset($_COOKIE["user"]))) {
header('Location: ./login.php');
}

$user = $_COOKIE["user"]; 
setcookie("user", "$user", time()+3600);

setcookie("dev", "", time()+3600);

#setcookie("profile", "profile1", time()+3600);

#if (isset($_COOKIE["user"]))
#	          echo "Welcome " . $_COOKIE["profile"] . "!<br />";
#else
#	echo "Welcome guest!<br />";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = $_REQUEST["name"];

if (empty($_REQUEST["name"])){
#                   echo  "device name is missing";
}else{
exec("sudo ./dev.pl del $name");
} 
}


  $doc = new DOMDocument();
  $doc->load( 'dev.xml' );
  $devs = $doc->getElementsByTagName( "dev" );
  foreach( $devs as $dev )
  {
  echo "<tr>";
  $name =  $dev->getAttribute("name");
  $type =  $dev->getAttribute("type");
  $cluster =  $dev->getAttribute("cluster");
  $owner =  $dev->getAttribute("owner");
  $inuse =  $dev->getAttribute("inuse");


#  echo "<td nowarp>" .  $name . "</td>";
#  echo "<td nowarp>" . "<input type='checkbox' id='checkbox01' name='checkbox01' value='$name'  onclick='foo()' />" .$name ." <br />" . "</td>";  
  echo "<td nowarp>" . "<input type='checkbox' id='checkbox01' name='checkbox01' value='$name' />" .$name ." <br />" . "</td>";  
  echo "<td nowarp>" . $type . "<br>" . "</td>";
  echo "<td nowarp>" . $cluster . "<br>" . "</td>";
  echo "<td nowarp>" . $owner . "<br>" . "</td>";
  echo "<td nowarp>" . $inuse . "<br>" . "</td>";
#  echo "<td nowarp>" . "<form action='baseconfig.php?name=$name' method='post'>". "<input type='submit' name='Submit' value='delete' />" . "</form>" . "</td>";
echo "<td nowarp>" . "<a href='changeimage.php?name=$name'>" . "Change Image"  . "</a>" . "</td>";
echo "<td nowarp>" . "<a href='viewlinkstatus.php?name=$name'>" . "View Link Status"  . "</a>" . "</td>";
  echo "<td nowarp>" . "<form id='ff' action='baseconfig.php?name=$name' method='post'>". "<input type='submit' name='Submit' value='delete' />" . "</form>" . "</td>";
  #  echo "<td>" . $params . "<br>" . "</td>"; 
  echo "</tr>";                                                                                                                                          
#  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  }
  ?>
</table>

<br>

<input type="submit" name="Submit" value="Add new device" />

<br>
<br>

<input id="nextstep" type="submit" name="Submit" value="Next Step" onclick='foo2()'/>                                                                                                       
</form>

	<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
                        closed="true" buttons="#dlg-buttons">
                <div class="ftitle">Device Information</div>
                <form id="fm" method="post" novalidate>
                        <div class="fitem">
                                <label>Device Name:</label>
                                <input name="name" class="easyui-validatebox" required="true">
                        </div>
                        <div class="fitem">
                                <label>Device Type:</label>
                                <input name="type" class="easyui-validatebox" required="true">
                        </div>
                        <div class="fitem">
                                <label>Cluster Status:</label>
                                <input name="cluster">
                        </div>
                </form>
        </div>
        <div id="dlg-buttons">
                <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick='saveDev()'>Save</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
        </div>
</body>
</html>
