<html>
<head>
        <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
        </script>
   <title>Log Search</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script> 
</head>

<body>
<img src="juniper.png" class="center"/>
<div id="historical">
<h1 class=hisid style="background-color:#EEEEEE;text-align:left;width:80%">Scenario Testing Builder</h1>
<nav class="navbar navbar-default" role="navigation" style="width:80%">
   <div class="navbar-header">
      <a class="navbar-brand" href="maintest.php">Home</a>
   </div>
   <div>
      <ul class="nav navbar-nav">
         <li class="active"><a href="http://10.208.132.244/~regress/smartTest/cgi-bin/smartTest.pl">SmartTest</a></li>
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               StressTest 
               <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
               <li><a href="baseconfig.php">Topo and Config</a></li>
               <li><a href="create_traff.php">Traffic</a></li>
               <li class="divider"></li>
               <li><a href="#">separate link</a></li>
               <li class="divider"></li>
               <li><a href="#">another separate link</a></li>
            </ul>
         </li>
         <li><a href="changeimage.html">Change Image</a></li>
         <li><a href="job.php">Job Management</a></li>
         <li><a href="log.php">Log Search on Shell Server</a></li>
      </ul>
   </div>
</nav>
<br>
<br>
<form action="logdisplay.php" method="post" style="text-align:left;">
Last <input type="text" name="date" style = "width:50px"> days &nbsp  &nbsp  &nbsp  &nbsp Your alias: <input type="text" name="user"><br>
<input type="submit" value="Query">
</form> 
</div>
<br>
<br>
<div>
<h4> Or you can input full path of log</h4>
<form action="log2html.php" method="post" style="text-align:left;">
Log Full Path <input type="text" name="fullpath" >(e.g. /homes/haojue/UTM/AV/SAV/results/sav_bf_all_sanity.pl.8632.log) <br>
<input type="submit" value="Query">
</form>
</div>
</body>
</html>
