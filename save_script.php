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
$name = $_POST["name"];
$type = $_POST["type"];
$txt = $_POST["txt"];
$des = $_POST["des"];
$file = $_POST["file"];

if (isset($_COOKIE["user"]))
{
 $user = $_COOKIE["user"];
}

if (empty($_POST["name"])||empty($_POST["txt"]) ){
#       include 'cloudfile.php';
	 echo  "profile name or config is missing";
     return;
}
#exec("sudo ./config_op.pl add $name $type $des");
exec("sudo ./config_op.pl add \"$name\" $type \"$des\" \"$file\""); 
exec("sudo ./config_op.pl attr \"$name\" owner $user"); 

exec("sudo ./mod_uploadfile.sh \"$name\""); 

if($type == "BPS") {
exec("sudo ./upload_script.pl \"10.208.130.44\" \"$name\""); 
} else {
exec("sudo ./upload_script.pl \"10.208.133.79\" \"$name\""); 
}

include 'cloudfile.php';
#echo "Done\n";
#exec("sudo ./profile.pl add profile.xml $name $type $des ");                                                                                    
#echo "$type $name saved" . "<br>";
?>
</body>
</html>
