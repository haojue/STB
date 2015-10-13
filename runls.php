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


if (empty($_POST["tclserver"])||empty($_POST["tclname"])||empty($_POST["chassisip"])||empty($_POST["lsuser"])||empty($_POST["lspass"])||empty($_POST["library"])||empty($_POST["session"])) {
	           echo  "Some parameter is missing, please go back to add";
return;
}
$tclserver = trim($_POST["tclserver"],"^M");
$tclname = trim($_POST["tclname"],"^M");
$chassisip = trim($_POST["chassisip"],"^M");
$lsuser = trim($_POST["lsuser"],"^M");
$lspass = trim($_POST["lspass"],"^M");
$library = trim($_POST["library"],"^M");
$session = trim($_POST["session"],"^M");



$id = date("ymdhis");
#$param = $tclname $tclserver $chassisip $lsuser $lspass $library "$session";
$param = $tclname . " " . $tclserver . " " . $chassisip . " " . $lsuser . " ". $lspass ." " . $library . " " . "$session";
$param2 = $tclname . "," . $tclserver . "," . $chassisip . "," . $lsuser . "," . $lspass . "," . $library . "," . $session;


include 'joblib.php';
$cmd = "sudo ./runls.pl $tclserver $tclname $chassisip $lsuser $lspass $library '$session' $id";

#echo "cmd is $cmd, id is $id";

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
echo "$tclname running on $tclserver with chassisip $chassisip";

echo "<br>";
echo "<br>";

echo "Job submitted, you can view the running status by the following link.";
echo "<br>";
echo "<br>";

echo("./job.pl add job.xml $id $tclserver $tclname \"$param\" $device running \"$cmd\"");
exec("sudo ./job.pl add job.xml $id $tclserver $tclname \"$param\" $device running \"$cmd\"");
exec("sudo ./dev.pl set $device inuse");
exec("sudo ./job.pl attr job.xml $id submitter $user");


#echo "tclserver $tclserver tclname $tclname $chassisip $cardname $startport $endport $type $value $sustaintime";
exec("sudo ./runls.pl $tclserver $tclname $chassisip $lsuser $lspass $library \"$session\" $id");


#echo "<a href='runstatusewf.php?log=$log' target='_blank' font-size:80px>" . "View Run status" . "</a>";
echo "<a href='runstatusewf.php?id=$id&log=$log&param=$param' target='_blank' font-size:80px>" . "View Running Status" . "</a>";
?>
</body>
</html>
