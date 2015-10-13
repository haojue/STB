<?php

function search_job($id) {
  $doc = new DOMDocument();
  $doc->load( 'job.xml' );

  $jobs = $doc->getElementsByTagName( "job" );
  foreach( $jobs as $job )
  {
  $gid =  $job->getAttribute("id");
  if($gid == $id) {
  $serverip =  $job->getAttribute("serverip");
  $params = $job->getAttribute( "params" );
  $processid = $job->getAttribute( "processid" );
  $dev = $job->getAttribute( "dev" );
  return $serverip. "," . $params . "," . $processid . "," . $dev; 
  }
  }
  return 0;
}


#$id=$_POST['id'];

#   exec("sudo ./checkjob.pl 10.208.133.79");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$id = $_REQUEST["id"];
$submit = $_REQUEST["Submit"];


if (empty($_REQUEST["id"])){
                   echo  "device name is missing";
} elseif(preg_match("/rerun/i",$submit)) {

#include 'joblib.php';
#$cmd = find_cmd_by_jobid($id);

exec("sudo ./job.pl rerun $id");
#header('Location: http://localhost/index.php');
echo "<script language=\"javascript\">";
echo "location.href=\"index.php\"";
echo "</script>";
return;
} elseif(preg_match("/abort/i",$submit)) {
exec("sudo ./job.pl abort $id");
echo "<script language=\"javascript\">";
echo "location.href=\"index.php\"";
echo "</script>";
} elseif(preg_match("/show/i",$submit)) {
echo "<script language=\"javascript\">";
echo "location.href=\"index1.php\"";
echo "</script>";	
} elseif(preg_match("/start/i",$submit)) {
#exec("sudo nohup ./checkjob.pl & ");
#exec("sudo ");
system("sudo nohup ./checkjob.pl > /tmp/null &"); 
echo "<script language=\"javascript\">";
echo "location.href=\"index.php\"";
echo "</script>";	
}else{
$get_param = search_job($id);

#echo "get_param is $get_param";

#if(preg_match("/(d+)\.(d+).*/", $get_param)) {
if(preg_match("/.*/", $get_param)) {
list($serverip, $params, $processid, $dev) = explode(",",$get_param);

#echo "$serverip, $params, $processid, $dev\n\n";
#echo "success\n";

#exec("sudo ./job.pl del job.xml $id $serverip \"$params\"");
if(!empty($processid)) {
	exec("sudo ./kill_process.pl $serverip $processid");
} else {
        exec("sudo ./job.pl abort $id");
}
exec("sudo ./dev.pl set $dev free");
echo "<script language=\"javascript\">";
echo "location.href=\"index.php\"";                                                                                                                      
echo "</script>";
return;
}

#echo "sudo ./job.pl del job.xml $id";
exec("sudo ./job.pl del job.xml $id");
#echo "This id $serverip $processid is not a running job id, no need to kill\n";
}
}
#$GoTo="job.php"; 
#
#sleep(2);
#header(sprintf("Location: %s", $GoTo)); 
?>
