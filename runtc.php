<html>                                                                                                                                                   
<body>

<?php
#print_r($_POST);
$device;
if (isset($_COOKIE["dev"]))
{ $device = $_COOKIE["dev"];
#    echo "welcome $device";
}

if (isset($_COOKIE["user"]))
{
	  $user = $_COOKIE["user"];
}


if (empty($_POST["tclserver"])||empty($_POST["tclname"])||empty($_POST["chassisip"])||empty($_POST["cardname"])||empty($_POST["startport"])||empty($_POST["endport"])||empty($_POST["value"])||empty($_POST["sustaintime"])) {
	           echo  "Some parameter is missing, please go back to add";
return;
}
$tclserver = trim($_POST["tclserver"],"^M");
$tclname = trim($_POST["tclname"],"^M");
$chassisip = trim($_POST["chassisip"],"^M");
$cardname = trim($_POST["cardname"],"^M");
$startport = trim($_POST["startport"],"^M");
$endport = trim($_POST["endport"],"^M");
$value = trim($_POST["value"],"^M");
$sustaintime = trim($_POST["sustaintime"],"^M");



$id = date("ymdhis");
$param = "$tclname  $tclserver $chassisip $sustaintime $value $cardname $startport $endport";
$param2 = $tclname . "," . $tclserver . "," . $chassisip . "," . $sustaintime . "," . $cardname . "," . $startport . "," . $endport;


include 'joblib.php';
$cmd = "sudo ./runtc.pl $tclserver $tclname $chassisip $cardname $startport $endport $value $sustaintime $id";

$status = check_dut_status($device);

if($status == "inuse") {
        echo "Testbed is in use, submit job to job queue and run it later...";
        echo "<a href='index.php' >" . "Back to HomePage" . "</a>" . "<br>"; 
        exec("sudo ./job.pl add job.xml $id $tclserver $tclname \"$param\" $device queued \"$cmd\"");
        exec("sudo ./job.pl attr job.xml $id submitter $user");
	return;
}

$log=$tclname ."." . $id . ".".results;
#echo "log is $log\n";
echo "$tclname running on $tclserver with chassisip $chassisip, card $cardname, port $startport and $endport";

echo "<br>";
echo "<br>";

echo "Job submitted, you can view the running status by the following link.";
echo "<br>";
echo "<br>";

#echo("./job.pl add job.xml $id $tclserver $tclname \"$param\"");
exec("sudo ./job.pl add job.xml $id $tclserver $tclname \"$param\" $device running \"$cmd\"");
exec("sudo ./dev.pl set $device inuse");
exec("sudo ./job.pl attr job.xml $id submitter $user");


#echo "tclserver $tclserver tclname $tclname $chassisip $cardname $startport $endport $type $value $sustaintime";
exec("sudo ./runtc.pl $tclserver $tclname $chassisip $cardname $startport $endport $value $sustaintime $id");


#echo "<a href='runstatusewf.php?log=$log' target='_blank' font-size:80px>" . "View Run status" . "</a>";
echo "<a href='runstatusewf.php?id=$id&log=$log&param=$param2' target='_blank' font-size:80px>" . "View Running Status" . "</a>";
?>
</body>
</html>
