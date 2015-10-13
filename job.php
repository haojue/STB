<!DOCTYPE html>
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
<?php include 'navigator.php'; ?>
<h3> Running jobs </h3>
<table id="jobs" border="1" width="400" cellpadding="10">
<tr>
  <th>jobid</th>
  <th>serverip</th>
  <th>processid</th>
  <th>other params</th>
</tr>

 <?php
  $doc = new DOMDocument();
  $doc->load( 'job.xml' );
  
  $jobs = $doc->getElementsByTagName( "job" );
  foreach( $jobs as $job )
  {
  echo "<tr>";      
  $id =  $job->getAttribute("id");  
  $serverip =  $job->getAttribute("serverip");  
  $processid =  $job->getAttribute("processid");  
#  $params = $job->getElementsByTagName( "param" );
  $params = $job->getAttribute( "params" );

  preg_match("/(.*?)\s+.*/i", "$params", $matches);
  $tclname = $matches[1];

  $log=$tclname."." . $id . ".".results; 
  echo "log is $log\n";

  echo "<td nowarp>" . "<a href='viewlog.php'>" . $id  . "</a>"  . "<br>" . "</td>";
 # echo "<td nowarp>" . <a href="add_device.php" target="_blank"> Add new device</a>  $id . "<br>" . "</td>";
  echo "<td nowarp>" . $serverip . "<br>" . "</td>";
  echo "<td nowarp>" . $processid . "<br>" . "</td>";
  echo "<td nowrap>" . $params . "<br>" . "</td>";
  echo "</tr>";      
#  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  
  }
echo "</table>";
echo  "<br>";

echo "<h3>" . "Finished jobs" . "</h3>";
echo "<table id='jobs' border='1' width='400' cellpadding='10'>";
echo "<tr>";
echo  "<th>" . "jobid" . "</th>";
echo  "<th>" . "serverip" . "</th>";
echo  "<th>" . "processid" . "</th>";                                                                                                 
echo  "<th>" . "other params" . "</th>";
echo  "</tr>";
 
$doc = new DOMDocument();
  $doc->load( 'finishedjob.xml' );

  $jobs = $doc->getElementsByTagName( "job" );
  foreach( $jobs as $job )
  {
  echo "<tr>";
  $id =  $job->getAttribute("id");
  $serverip =  $job->getAttribute("serverip");
  $scriptname =  $job->getAttribute("scriptname");
  $processid = $job->getAttribute( "processid" );
  $params = $job->getAttribute( "params" );
#  $params = $job->getElementsByTagName( "param" );

#  echo "<td nowrap>" . $id . "<br>" . "</td>";
 echo "<td nowarp>" . "<a href='viewlog.php?id=$id' target='_blank'>" . $id . "</a>" . "<br>" . "</td>";
  echo "<td nowrap>" . $serverip . "<br>" . "</td>";
  echo "<td nowrap>" . $processid . "<br>" . "</td>";
  echo "<td nowrap>" . $params . "<br>" . "</td>";
#  echo "<td>" . $params . "<br>" . "</td>";
  echo "</tr>";                                                                                                                                          
#  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  
  }
echo "</table>";
echo "<br>";

echo "<form action='kill_process.php' method='post' style='text-align:left;'>";
echo "Job to kill(jobid):<input type='text' name='id'> <br>";
echo "<input type='submit'  value='Kill'>";
echo "</form>";
echo "<br>";
echo "<form action='viewlog.php' method='post' style='text-align:left;'>";
?>
View Job Log(jobid):<input type="text" name="id"><br>
<input type="submit" value="Check">
</form> 
</body>
</html>
