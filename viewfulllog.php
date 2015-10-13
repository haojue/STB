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
<?php include 'navigator.php'; ?>    
<h3 style="background-color:#EEEEEE;text-align:left;height:5%;width:80%"> &nbsp Finished jobs </h3>
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

#include 'kill_process.php';

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
  }  
#  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  
  }
echo "</table>";
  ?>
</body>
</html>
