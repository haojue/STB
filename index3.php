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

<script>
function foo() {
var checkbox01 = document.getElementsByName("checkbox01");

if(checkbox01[0].checked && checkbox01[1].checked) {
checkbox01[0].checked = false ;
var p = document.createElement("p");  
var tp = document.createTextNode("createTextNode"); 
p.appendChild(tp);
document.body.appendChild(p);
alert("only one box can be selected!");
}
}

function appendtxt(value){
        var div = document.createElement("div");
        div.innerText=value;            
        document.body.appendChild(div);
}	

</script>
</head>
<body>
<?php include 'navigator.php'; 


if (!(isset($_COOKIE["user"]))) {
header('Location: ./login.php');
}                                                                                                                            

$user = $_COOKIE["user"]; 
setcookie("user", "$user", time()+3600);

?>
<h3 style="background-color:#EEEEEE;text-align:left;height:5%;width:80%"> &nbsp Testbed Info </h3>
<table id="devs" border="1" width="400" cellpadding="10">
<tr>
  <th>device name</th>
  <th>device type</th>
  <th>cluster status</th>
  <th>owner</th>
  <th>In use</th>
</tr>

 <?php
  $doc = new DOMDocument();
  $doc->load( 'dev.xml' );

  $devs = $doc->getElementsByTagName( "dev" );
  foreach( $devs as $dev )
  {
  echo "<tr>";
  $name =  $dev->getAttribute("name");
  $type =  $dev->getAttribute("type");
  $cluster =  $dev->getAttribute("cluster");
  $owner =  $dev->getAttribute("owner");
  $inuse =  $dev->getAttribute("inuse");


  echo "<td>" . $name . "<br>" . "</td>";
  echo "<td>" . $type . "<br>" . "</td>";
  echo "<td>" . $cluster . "<br>" . "</td>";
  echo "<td>" . $owner . "<br>" . "</td>";
  echo "<td>" . $inuse . "<br>" . "</td>";
#  echo "<td>" . $params . "<br>" . "</td>";
  echo "</tr>";                                                                                                                                          
#  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  }
  ?>
</table>
<br>
<br>



<h3 style="background-color:#EEEEEE;text-align:left;height:5%;width:80%"> &nbsp Queued jobs </h3> 
<table id="jobs" border="1" width="400" cellpadding="10">
<tr>
  <th>jobid</th>
  <th>submitter</th>
  <th>testbed</th>
  <th>serverip</th>
  <th>processid</th>
  <th>other params</th>
  <th></th>
</tr>

<?php
  $doc = new DOMDocument();
  $doc->load( 'job.xml' );

  $jobs = $doc->getElementsByTagName( "job" );
  foreach( $jobs as $job )
  {
  $status =  $job->getAttribute("status");
  if($status == "queued") {
  echo "<tr>";
  $id =  $job->getAttribute("id");
  $submitter =  $job->getAttribute("submitter");
  $dev =  $job->getAttribute("dev");
  $serverip =  $job->getAttribute("serverip");
  $scriptname =  $job->getAttribute("scriptname");
  $processid = $job->getAttribute( "processid" );
  $params = $job->getAttribute( "params" );

  echo "<td nowrap>" . $id . "<br>" . "</td>";
  echo "<td nowrap>" . $submitter . "<br>" . "</td>";
  echo "<td nowrap>" . $dev . "<br>" . "</td>";
  echo "<td nowrap>" . $serverip . "<br>" . "</td>";
  echo "<td nowrap>" . $processid . "<br>" . "</td>";
  echo "<td nowrap>" . $params . "<br>" . "</td>";
  echo "<td nowarp>" . "<form action='kill_process.php?id=$id' method='post'>". "<input type='submit' name='Submit' value='abort' />" . "</form>" . "</td>"; 
  echo "</tr>";                                                                                                                                          
  } 
  }
  ?>
</table>
<br>


<h3 style="background-color:#EEEEEE;text-align:left;height:5%;width:80%"> &nbsp Running jobs </h3> 
<table id="jobs" border="1" width="400" cellpadding="10">
<tr>
  <th>jobid</th>
  <th>submitter</th>
  <th>testbed</th>
  <th>serverip</th>
  <th>processid</th>
  <th>other params</th>
  <th></th>
</tr>

 <?php
include 'kill_process.php';

  $doc = new DOMDocument();
  $doc->load( 'job.xml' );

  $jobs = $doc->getElementsByTagName( "job" );
  foreach( $jobs as $job )
  {
  $status =  $job->getAttribute("status");
  if($status == "running") {
  echo "<tr>";
  $id =  $job->getAttribute("id");
  $submitter =  $job->getAttribute("submitter");
  $dev =  $job->getAttribute("dev");
  $serverip =  $job->getAttribute("serverip");
  $scriptname =  $job->getAttribute("scriptname");
  $processid = $job->getAttribute( "processid" );
  $params = $job->getAttribute( "params" );
#  $params = $job->getElementsByTagName( "param" );

   echo "<td nowarp>" . "<a href='runstatus.php?id=$id&serverip=$serverip' target='_blank'>" . $id . "</a>" . "<br>" . "</td>";
#  echo "<td nowrap>" . $id . "<br>" . "</td>";
  echo "<td nowrap>" . $submitter . "<br>" . "</td>";
  echo "<td nowrap>" . $dev . "<br>" . "</td>";
  echo "<td nowrap>" . $serverip . "<br>" . "</td>";
  echo "<td nowrap>" . $processid . "<br>" . "</td>";
  echo "<td nowrap>" . $params . "<br>" . "</td>";
  echo "<td nowarp>" . "<form action='index.php?id=$id' method='post'>". "<input type='submit' name='Submit' value='terminate job' />" . "</form>" . "</td>"; 
  #  echo "<td>" . $params . "<br>" . "</td>";
  echo "</tr>";                                                                                                                                          
#  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  } 
  }
  ?>
</table>
<br>

<h3 style="background-color:#EEEEEE;text-align:left;height:5%;width:80%"> &nbsp Finished jobs </h3>
<h5> (newest at the top) </h5>
<table id="jobs" border="1" width="400" cellpadding="10">
<tr>
  <th>jobid(time)</th>
  <th>submitter</th>
  <th>testbed</th>
  <th>serverip</th>
  <th>processid</th>
  <th>other params</th>
  <th></th>
</tr>

 <?php
#   exec("sudo ./checkjob.pl");

  $doc = new DOMDocument();
  $doc->load( 'finishedjob.xml' );

  $jobs = $doc->getElementsByTagName( "job" );
#  var_dump($jobs);

   $jobs1 = array();
foreach ($jobs as $job)
{
  array_push($jobs1, $job);
}

$len = count($jobs1); 
#  foreach( $jobs1 as $job )
for ($i = count($jobs1) -1; $i>=0; $i--) 
#for ($i=0; $i <= count($jobs1) -1; $i++) 
{
  if($i < $len -10) {
  goto more;
  }  
  $job = array_pop($jobs1);    
  echo "<tr>";
  $id =  $job->getAttribute("id");
  $submitter =  $job->getAttribute("submitter");
  $dev =  $job->getAttribute("dev");
  $serverip =  $job->getAttribute("serverip");
  $scriptname =  $job->getAttribute("scriptname");
  $processid = $job->getAttribute( "processid" );
  $params = $job->getAttribute( "params" );
  
  if(!empty($id)) {
#  echo "<td nowrap>" . $id . "<br>" . "</td>";
 echo "<td nowarp>" . "<a href='viewlog.php?id=$id' target='_blank'>" . $id . "</a>" . "<br>" . "</td>";
  echo "<td nowrap>" . $submitter . "<br>" . "</td>";
  echo "<td nowrap>" . $dev . "<br>" . "</td>";
  echo "<td nowrap>" . $serverip . "<br>" . "</td>";
  echo "<td nowrap>" . $processid . "<br>" . "</td>";
  echo "<td nowrap>" . $params . "<br>" . "</td>";
  echo "<td nowarp>" . "<form action='index.php?id=$id' method='post'>". "<input type='submit' name='Submit' value='rerun' />" . "</form>" . "</td>"; 
  #  echo "<td>" . $params . "<br>" . "</td>";
  echo "</tr>";    
  } else {
  $i += 1;
  }  
#  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  
  }
echo "</table>";
return;
more:
	echo "</table>";
	echo "<br>";
       echo "<a href='viewfulllog.php'>" . ">>>View Full Finished Log List<<<" . "</a>";  
  ?>
</body>
</html>
