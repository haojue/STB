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
</head>
<body>
 <?php

$xmlFile = "config.xml";
$name = $_REQUEST["name"];
$txt = $_POST["txt"];
$des = $_POST["des"];

if (isset($_COOKIE["user"]))
{
 $user = $_COOKIE["user"];
}

if (empty($_REQUEST["name"])||empty($_POST["txt"]) ){
#       include 'cloudfile.php';
	 echo  "profile name or config is missing";
     return;
}

#  $items = explode("\n",$txt);
#  $txt = implode(",",$items);   

#exec("sudo ./config_op.pl add \"$name\" config \"$des\" \"$txt\"");
exec("sudo ./config_op.pl attr \"$name\" des \"$txt\"");

include 'cloudfile.php';
#echo "Done\n";
#exec("sudo ./profile.pl add profile.xml $name $type $des ");                                                                                    
#echo "$type $name saved" . "<br>";
?>
</body>
</html>
