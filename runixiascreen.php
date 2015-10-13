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

if (empty($_POST["tclserver"])||empty($_POST["tclname"])||empty($_POST["chassisip"])||empty($_POST["cardname"])||empty($_POST["port"])||empty($_POST["dstmac"])||empty($_POST["stime"])) {
	           echo  "Some parameter is missing, please go back to add";
       return;
}
$tclserver = $_POST["tclserver"];
$tclname = $_POST["tclname"];
$chassisip = $_POST["chassisip"];
$cardname = $_POST["cardname"];
$port = $_POST["port"];
$dstmac = $_POST["dstmac"];
$stime = $_POST["stime"];


$id = date("ymdhis");
$param = "$tclname $tclserver $chassisip $cardname $port $dstmac";
#$arr = list($tclserver, $tclname, $chassisip, $cardname, $port, $dstmac);
$param2 = $tclserver . "," . $tclname . "," . $chassisip . "," . $cardname . "," . $port . "," . $dstmac;  


include 'joblib.php';
$cmd = "sudo ./runixiascreen.pl \"$tclserver\" \"$tclname\" \"$chassisip\" \"$cardname\" \"$port\" \"$dstmac\" $stime $id"; 

$status = check_dut_status($device);

if($status == "inuse") {
        echo "Testbed is in use, submit job to job queue and run it later...";
        echo "<a href='index.php' >" . "Back to HomePage" . "</a>" . "<br>";
        exec("sudo ./job.pl add job.xml $id $tclserver $tclname \"$param\" $device queued \"$cmd\"");
        exec("sudo ./job.pl attr job.xml $id submitter $user");
	return;
}

#$log=$tclname.".".results;
$log=$tclname ."." . $id . ".".results;
#echo "log is $log\n";
#echo "$tclname running on $tclserver with chassisip $chassisip, card $cardname, port $port $dstmac $id";
echo "$tclname running on $tclserver with chassisip $chassisip, card $cardname, port $port";


echo "<br>"; 
echo "<br>"; 

echo "Job submitted, you can view the running status by the following link.";
echo "<br>";
echo "<br>";

exec("sudo ./job.pl add job.xml $id $tclserver $tclname \"$param\" $device running \"$cmd\"");
exec("sudo ./dev.pl set $device inuse");
exec("sudo ./job.pl attr job.xml $id submitter $user");

exec("sudo ./runixiascreen.pl \"$tclserver\" \"$tclname\" \"$chassisip\" \"$cardname\" \"$port\" \"$dstmac\" $stime $id");
echo "<a href='runstatusscreen.php?log=$log&param=$param2' target='_blank' font-size:80px>" . "View Running Status" . "</a>";
#echo "<a href='runstatusscreen.php?log=$log' target='_blank' font-size:80px>" . "View Running Status" . "</a>";
?>
</body>
</html>
