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
<?php include 'navigators1.php'; ?>

<?php

$xmlFile = "dev.xml";
$name = $_POST["name"];
$type = $_POST["type"];
$cluster = $_POST["cluster"];

if (isset($_COOKIE["user"]))   
{
 $user = $_COOKIE["user"];
}  

if (empty($_POST["name"])||empty($_POST["type"]) ){
    echo  "device name or type is missing";
return;
}

#echo "sudo ./dev.pl add $name $type $cluster" . "<br>";
exec("sudo ./dev.pl add $name $type $cluster $user");
#echo "$name $type $cluster saved" . "<br>";
#echo "Done\n";

include 'index.php';
?>
</body>
</html>
