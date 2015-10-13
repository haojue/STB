<html>
<head>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js">
</script>
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
	 <?php exec("sudo rm -f testresult")?>;
         <?php exec("sudo wget http://10.208.130.44/testresult")?>;
	xmlhttp.open("GET","testresult",false);
	xmlhttp.send();
	document.getElementById("txt").value=xmlhttp.responseText;
}

function kill_process() {
        <?php exec("sudo ./kill_process.pl")?>;
}


</script>
</head>

<body>
<form>
<input type="button" value="Testing results!" onClick="kill_process()">
<textarea rows="10" cols="80" id="txt"></textarea>
</form>

<a href='job.php' font-size:80px>Go to job status</a>

</body>

</html>
