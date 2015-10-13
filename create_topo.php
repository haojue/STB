<!DOCTYPE html>
<html>
<head>
        <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
        </script>
   <title>Create Topo </title>
<link rel="stylesheet" type="text/css" href="mystyle.css" />                                                                                             
   <title>Scenario Testing Builder</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
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

</script>
</head>
<body>
<img src="juniper.png" class="center"/> <br>
<h1 class=hisid style="background-color:#EEEEEE;text-align:left;width:80%">Scenario Testing Builder</h1>
<nav class="navbar navbar-default" role="navigation" style="width:80%">
   <div class="navbar-header">
      <a class="navbar-brand" href="#">Test</a>
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

<?php
echo "today is" . date("mdhis") . "<br>";
?>

<h3>DUT</h3>
<hr  align="left" style="height:2px;width:80%;border-top:2px solid #185598;" />
<form action="baseconfig.php" method="post">
<input type="checkbox"  name="checkbox01" value="bajie"  onclick="foo()" />bajie<br />
<input type="checkbox"  name="checkbox01" value="donghai" onclick="foo()" />donghai<br />
<input type="submit" name="Submit" value="Next" />
</form>
</body>
</html>
