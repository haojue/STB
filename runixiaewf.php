<html>                                                                                                                                                   
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

if (isset($_COOKIE["user"]))
{
	  $user = $_COOKIE["user"];
}


if (empty($_POST["tclserver"])||empty($_POST["tclname"])||empty($_POST["chassisip"])||empty($_POST["startport"])||empty($_POST["endport"])) {
	           echo  "Some parameter is missing, please go back to add";
return;
}
$tclserver = trim($_POST["tclserver"],"^M");
$tclname = trim($_POST["tclname"],"^M");
$chassisip = trim($_POST["chassisip"],"^M");
#$cardname = trim($_POST["cardname"],"^M");
$otherparameters = trim($_POST["otherparameters"],"^M");
$startport = trim($_POST["startport"],"^M");
$endport = trim($_POST["endport"],"^M");
$type = trim($_POST["type"],"^M");
$value = trim($_POST["value"],"^M");
$sustaintime = trim($_POST["sustaintime"],"^M");

$others;
$arr =  preg_split('/:/i', $otherparameters);

    foreach($arr AS $value){
    $others .= $value . " ";
    }


$id = date("ymdhis");
$param = "$tclname $tclserver $chassisip $sustaintime $type $value $others $startport $endport";
$param2 = $tclname . "," . $tclserver . "," . $chassisip . "," . $sustaintime . "," . $others . "," . $startport . "," . $endport;
$param3 = "$tclserver $tclname $chassisip  $startport $endport $type $value $sustaintime $others $id"; 

$runningserver = "10.208.133.79"; 

include 'joblib.php';
#$cmd = "sudo ./runixiaewf.pl $tclserver $tclname $chassisip $others $startport $endport $type $value $sustaintime $id";
$cmd = "sudo ./runixiaewf.pl $param3";

#echo "param3 is $param3\n";
#echo "$cmd\n";
#return;

$status = check_dut_status($device);

if($status == "inuse") {
        echo "Testbed is in use, submit job to job queue and run it later...";
        echo "<a href='index.php' >" . "Back to HomePage" . "</a>" . "<br>"; 
        exec("sudo ./job.pl add job.xml $id $runningserver $tclname \"$param\" $device queued \"$cmd\"");
        exec("sudo ./job.pl attr job.xml $id submitter $user");
        exec("sudo ./job.pl attr job.xml $id runningserver $runningserver");
	return;
}

$log=$tclname ."." . $id . ".".results;
#echo "log is $log\n";
echo "$tclname running on $runningserver with chassisip $chassisip, size $size, port $startport and $endport";

echo "<br>";
echo "<br>";

echo "Job submitted, you can view the running status by the following link.";
echo "<br>";
echo "<br>";

#echo("./job.pl add job.xml $id $tclserver $tclname \"$param\"");
exec("sudo ./job.pl add job.xml $id $runningserver $tclname \"$param\" $device running \"$cmd\"");
exec("sudo ./dev.pl set $device inuse");
exec("sudo ./job.pl attr job.xml $id submitter $user");
exec("sudo ./job.pl attr job.xml $id runningserver $runningserver");


#echo "tclserver $tclserver tclname $tclname $chassisip $cardname $startport $endport $type $value $sustaintime";
exec("sudo ./runixiaewf.pl $tclserver $tclname $chassisip $size $startport $endport $type $value $sustaintime $id");


#echo "<a href='runstatusewf.php?log=$log' target='_blank' font-size:80px>" . "View Run status" . "</a>";
echo "<a href='runstatusewf.php?id=$id&log=$log&param=$param2' target='_blank' font-size:80px>" . "View Running Status" . "</a>";
?>
</body>
</html>
