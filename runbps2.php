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

<?php
#print_r($_POST);
$device = $_POST["device"];
if(!$device) {	
if (isset($_COOKIE["dev"]))
{ $device = $_COOKIE["dev"];
#    echo "welcome $device";
}
}

#$device = $_REQUEST["dev"];

if (isset($_COOKIE["user"]))
{
  $user = $_COOKIE["user"];
} 


if (empty($_POST["tclserver"])||empty($_POST["tclname"])||empty($_POST["profilename"])||empty($_POST["chassisip"])||empty($_POST["cps"])||empty($_POST["port1"])||empty($_POST["port2"])||empty($_POST["sustaintime"])||empty($_POST["rampuptime"])||empty($_POST["rampdowntime"])) {
	           echo  "Some parameter is missing, please go back to add";
         return;
  }
$tclserver = $_POST["tclserver"];
$tclname = $_POST["tclname"];
$profilename = $_POST["profilename"];
$chassisip = $_POST["chassisip"];
$cps = $_POST["cps"];
$port1 = $_POST["port1"];
$port2 = $_POST["port2"];
$sustaintime = $_POST["sustaintime"];
$rampuptime = $_POST["rampuptime"];
$rampdowntime = $_POST["rampdowntime"];


exec("sudo ./job.pl add_testprofile $profilename");

#exec("sudo ./.pl \"$cmd\"");


$id = date("ymdhis");
$param = "$tclname  10.208.130.44 $tclserver $chassisip $profilename $sustaintime $cps $port1 $port2 $sustaintime $rampuptime $rampdowntime";
$param2 = $tclname . "," . $tclserver . "," . $chassisip . "," . $profilename . "," . $sustaintime . "," . $cps . "," . $port1 . "," . $port2 . "," . $sustaintime . "," . $rampuptime . "," . $rampdowntime;

include 'joblib.php';
$cmd = "sudo ./runbps2.pl $tclserver $tclname $profilename $chassisip $cps $port1 $port2 $sustaintime $rampuptime $rampdowntime $id";

$log=$tclname ."." . $id . ".".results;
#echo "log is $log\n";

$status = check_dut_status($device);

if($status == "inuse") {
	echo "Testbed is in use, submit job to job queue and run it later...";
#        echo "<a href='index.php' >" . "Back to HomePage" . "</a>" . "<br>"; 
	exec("sudo ./job.pl add job.xml $id $tclserver $tclname \"$param\" $device queued \"$cmd\"");
        exec("sudo ./job.pl attr job.xml $id submitter $user");
	return;
}

#echo("./job.pl add job.xml $id $tclserver $tclname \"$param\" $device");
exec("sudo ./job.pl add job.xml $id $tclserver $tclname \"$param\" $device running \"$cmd\"");
exec("sudo ./dev.pl set $device inuse");
exec("sudo ./job.pl attr job.xml $id submitter $user");

echo "$tclname running on $tclserver with chassisip $chassisip, card $cardname, port $port1 and $port2";
echo "<br>";
echo "<br>";
#echo "$tclserver $tclname $profilename $chassisip $cps $port1 $port2 $sustaintime $rampuptime $rampdowntime $id";
exec("sudo ./runbps2.pl $tclserver $tclname $profilename $chassisip $cps $port1 $port2 $sustaintime $rampuptime $rampdowntime $id");
echo "Job submitted, you can view the running status by the following link.";
echo "<br>";
echo "<br>";
#echo "<a href='runstatus2.php?log=$log' target='_blank' font-size:80px>" . "View Run status" . "</a>";
echo "<a href='runstatus2.php?id=$id&log=$log&param=$param2' target='_blank' font-size:80px>" . "View Running Status" . "</a>";
?>
</body>
</html>
