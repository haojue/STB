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
<?php include 'navigators2.php'; ?>
 <?php

#$xmlFile = "config.xml";
#$name = $_POST["name"];
$txt = $_POST["txt"];
#$des = $_POST["des"];


if (empty($_POST["txt"]) ){
#       include 'cloudfile.php';
	 echo  "No config to be converted";
     return;
}
#exec("sudo ./config_op.pl add $name config $des $txt");

$arr =  preg_split('/[^-]set /i', $txt);

 #   exec("sudo ./getconfig.pl $device",$arr, $sta);
    #  echo var_dump($arr);
    foreach($arr AS $value){
 #     if (preg_match("/^set/i",$value)) {
    echo "set " . "$value" . ","  . "<br>";                                                                         
    }

#include 'create_otherconfig.php';
#echo "Done\n";
#exec("sudo ./profile.pl add profile.xml $name $type $des ");                                                                                    
#echo "$type $name saved" . "<br>";
?>
</body>
</html>
