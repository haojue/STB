<!DOCTYPE html>
<html>
<head>
	<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
	</script>
</head> 
<body>


	<img src="juniper.png" class="center"/> <br>
	<h1 class=hisid style="background-color:#EEEEEE;text-align:left;width:1000px">Config Traffic</h1>


<form id="form1" name="form1" method="post" action="runbps.php">
<div id='test'>
<h3> Test option </h3>
Linux Tcl server
 <select id="tclserver" name="tclserver" >
                <option value="tcl server1">10.208.130.44</option>
                <option value="tcl server2">tcl server2</option>
        </select> <br>
Tcl name <input type="text" name="tclname" id="tclname" > <br>
Ixia Chassis ip 
 <select id="chassisip" name="chassisip" >
                <option value="chassisip1">10.208.131.129</option>
                <option value="chassisip2">chassis ip2</option>
        </select> <br>
</div>
<br>
<div id='traffic'>
<h3> Traffic option </h3>
Cps<input type="text" name="cps" id="cps" > <br>
endCPS<input type="text" name="cc" id="cc" > <br>
incrementCPS<input type="text" name="sustaintime" id="sustaintime" > <br>
Rampuptime<input type="text" name="rampuptime" id="rampuptime" > <br>
Sustaintime<input type="text" name="sustaintime" id="sustaintime" > <br>
Rampdowntime<input type="text" name="rampdowntime" id="rampdowntime" > <br>
</div>
<input type="submit" name="Submit" value="submit" />
</form>
</body>
</html>
