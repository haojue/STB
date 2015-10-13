<!DOCTYPE html>
<html>
<head>
<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
</script>
<link rel="stylesheet" type="text/css" href="mystyle.css" />
   <title>Scenario Testing Builder</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script> 
</head>
<body>
<?php include 'navigator.php'; ?>
<?php

$xmlFile = "dev.xml";
$name = $_REQUEST["name"];


if (empty($_REQUEST["name"])){
	           echo  "device name is missing";
}

exec("sudo ./dev.pl del $name");

echo "Done\n";
?>
</body>
</html>
