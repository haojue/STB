<html>
<head>
<link rel="stylesheet" type="text/css" href="mystyle.css" />
</head>

<body>
<img src="juniper.png" class="center"/>
<div>
<div id="historical">
<h1 class=hisid style="background-color:#EEEEEE;text-align:left;width:1000px">JT Log Search on Shell Server</h1>
<form action="logdisplay.php" method="post" style="text-align:left;">
Last <input type="text" name="date" style = "width:50px"> days &nbsp  &nbsp  &nbsp  &nbsp Your alias: <input type="text" name="user"><br>
<input type="submit" value="Query">
</form> 
</div>
<br>
<br>
<br>
<div>
<h4> Or you can input the full path of the log</h4>
<form action="log2html.php" method="post" style="text-align:left;">
Log Full Path <input type="text" name="fullpath" >(e.g. /homes/haojue/UTM/AV/SAV/results/sav_bf_all_sanity.pl.8632.log) <br>
<input type="submit" value="Query">
</form>
</div>
</div>
</body>
</html>
