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

<script type="text/javascript">
$(document).ready(function(){
setInterval("loadXMLDoc()",2000);
setTimeout("self.location.reload();",2000);
});
var c=0
var t
function timedCount()
 {
 document.getElementById('txt').value=c
 c=c+1
 t=setTimeout("timedCount()",1000)
 }

function loadXMLDoc()
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {
	    xmlhttp=new XMLHttpRequest();
	  }
	 <?php exec("sudo rm -f $_REQUEST[log]")?>;
         <?php exec("sudo wget http://10.208.133.79/$_REQUEST[log]")?>;
         <?php #exec("sudo mv -f $_REQUEST[log] ewf_testresults")?>;
         <?php echo "xmlhttp.open('GET','$_REQUEST[log]',false);" ?>; 
	xmlhttp.send();
	document.getElementById("txt").value=xmlhttp.responseText;
}

function scroll() {var txt=document.getElementById("txt");txt.scrollTop=txt.scrollHeight; }

</script>
</head>

<body onload=scroll()>
<?php include 'navigator.php'; 

$param = $_REQUEST[param];

list($tclname,$tclserver,$chassisip,$lsuser, $lspass, $library, $session) = explode(",",$param);

echo "$tclname running on server $tclserver with chassis ip $chassisip";

?>

<br>
<br>
<form>
<textarea rows="25" cols="120" id="txt"></textarea>
</form>

<br>
<br>
<input type="button" value="Refresh" onClick="loadXMLDoc()">

<h4> Please go to homepage if you want to terminate this job </h4>
</body>

</html>
