<html>
<head>
<link rel="stylesheet" type="text/css" href="mystyle.css" />
</head>

<body>
<img src="juniper.png" class="center"/>
<div id="historical">
<h1 class=hisid style="background-color:#EEEEEE;text-align:left;width:1000px">Config Device</h1>
<form id="form1" name="form1" method="post" action="commit.php">
Device name: <input type="text" name="device"> <br>
EWF:
<label>
<input type="checkbox" name="checkbox[]" value="ewf" />
</label> <br /> 
SAV:
<label>
<input type="checkbox" name="checkbox[]" value="sav" />
</label> <br /> 
UTM TRACE:
<label>
<input type="checkbox" name="checkbox[]" value="utmtrace" />
</label> <br /> 
OTHER:
<label>
<input type="checkbox" name="checkbox[]" value="jb51.net" />
</label> <br /> 
<label>
<input type="submit" name="Submit" value="submit" />
</label>
</form> 
</div>
</body>
</html>
