<!DOCTYPE html>
<html>
<head>
<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
</script>
<style type="text/css">
div#left {height:300px;width:400px;float:left;}
div#right {height:300px;width:400px;float:left;}
</style>
</head> 
<body>


	<img src="juniper.png" class="center"/> <br>
	<h1 class=hisid style="background-color:#EEEEEE;text-align:left;width:1000px">Config Interface, Zone</h1>

<div id='left'>
<button id="btn2">Add Interface, IP, Zone</button>
<script>
document.getElementById("btn2").onclick=function(){createconnection()};

function createconnection()
{
	var conns=new Array("conn1","conn2","conn3", "conn4");
	for(i in conns) {
	if(!document.getElementById(conns[i])) {
		        if(conns[i]=="conn1") {$("ol").append("<li> <input type='text' name= 'conn1' id='conn1'> </li>");}
			else if(conns[i]=="conn2") {$("ol").append("<li> <input type='text' name= 'conn2' id='conn2'> </li>");}  
		        else if(conns[i]=="conn3") {$("ol").append("<li> <input type='text' name= 'conn3' id='conn3'> </li>");}
	                else {$("ol").append("<p> 3 connections at most </p>");}
			break;
	}
        }
}
</script>

<form id="form1" name="form1" method="post" action="commitint.php">
Profile Name <input type="text" name='topo' id='topo' > <br>
<p> interface ip zone </p>
<ol>
</ol>
<input type="submit" name="Submit" value="Config" />
</form>
</div>
</body>
</html>
