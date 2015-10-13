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

if (empty($_REQUEST["name"])){
                   echo  "device name is missing";
}else{
#exec("sudo ./dev.pl del $name");
$device = $_REQUEST["name"];
echo "<h4>" . "Current Link Status of $device" . "</h4>";   
    exec("sudo ./getlink.pl $device",$arr, $sta);                                                                                   
    $string = implode(",",$arr);
#  echo var_dump($arr);
  preg_match("/.*?(Current.*)\[regress.*/is", $string, $matches);
  $want = explode(",",$matches[1]);


#  var_dump($matches);
  
   $port=array();
    foreach($want AS $value){
	   if( preg_match("/.*?(ixia.*?\s+)(\d+\/\d+).*/is", $value, $matches)) {
#	    echo "$matches[2]";
		   array_push($port,$matches[2]);
	   }
    }

 # var_dump($port);

  exec("sudo ./dev.pl attr $device port1 $port[0]");
  exec("sudo ./dev.pl attr $device port2 $port[1]");


    foreach($want AS $value){
    echo "$value" .  "<br>";
}
}
echo "<br>";
echo "<br>";
echo "<a href='https://inception.juniper.net/lrm' target='_blank' font-size:80px>" . "LRM to Add or Delete Link" . "</a>";
?>

</div>
</body>
</html>
