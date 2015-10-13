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


<script src="selectdut.js"></script>
</head> 
<body>
<?php include 'navigators2.php'; ?>
<div id='test'>

<?php 
$device = $_REQUEST["device"];
$image = $_REQUEST["image"];
$user = $_REQUEST["user"];

#$device = "bajie";
#$image = "/.amd/cnrd-eng001-cf2/vol/systest_image2/slt-junos-build/JUNOS_121_X47_D15_BRANCH/20150125/junos-srx1k3k-12.1I20150125_junos_121_x47_d15.0-681331-domestic.tgz";

#echo "<h4>" . " $device" . "</h4>"; 
#echo "<h4>" . " $image" . "</h4>"; 
#echo "<h4>" . " $user" . "</h4>"; 

#exec("sudo ./changeimage.pl $device $image $user");
pclose(popen("sudo ./changeimage.pl $device $image $user &", 'r'));
#pclose(popen("sudo whoami &", 'r'));
echo "Request submitted" . "<br>"; 
echo "You will receive one email once finished changing image" . "<br>"; 
 #   exec("sudo ./changeimage.pl $device $image $user &",$arr, $sta);                                                                                   
    #  echo var_dump($arr);
#    foreach($arr AS $value){
#      if (preg_match("/^set/i",$value)) {
 #   echo "$value" . ","  . "<br>";
#    }
#}
?>

</div>
</body>
</html>
