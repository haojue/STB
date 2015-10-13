<html>
<head>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js">
</script>

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
setInterval("loadXMLDoc()",4000);
setTimeout("self.location.reload();",4000);
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
	 <?php
          include 'joblib.php';
          $id=$_REQUEST['id'];
          $get_param = search_job($id);
          list($serverip, $params, $processid) = explode(",",$get_param);
	  preg_match("/(.*?)\s+.*/i", "$params", $matches);
          $serverip= 
	  $tclname = $matches[1];
          $log=$tclname ."." . $id . ".".results;
#	   echo "log is $log";
	   exec("sudo rm -f $log");
           exec("sudo wget http://$_REQUEST[serverip]/$log");
       #    exec("sudo wget http://10.208.133.79/$log");
       #   exec("sudo wget http://10.208.130.44/$log");
          ?>;
        <?php echo "xmlhttp.open('GET','$log',false);" ?>;
	xmlhttp.send();
	document.getElementById("txt").value=xmlhttp.responseText;
}

function scroll() {var txt=document.getElementById("txt");txt.scrollTop=txt.scrollHeight; }

</script>
</head>

<body onload=scroll()>
<?php include 'navigator.php'; ?>

<br>
<br>
<form>
<textarea rows="25" cols="120" id="txt"></textarea>
</form>
<br>
<input type="button" value="Refresh">

</body>

</html>
