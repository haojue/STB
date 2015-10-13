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
<?php include 'navigator.php'; ?>
<h3 style="background-color:#EEEEEE;text-align:left;height:5%;width:80%"> &nbsp Testbed Info </h3>
<table id="devs" border="1" width="400" cellpadding="10">
<tr>
  <th>device name</th>
  <th>device type</th>
  <th>cluster status</th>
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
  $inuse =  $dev->getAttribute("inuse");


  echo "<td>" . $name . "<br>" . "</td>";
  echo "<td>" . $type . "<br>" . "</td>";
  echo "<td>" . $cluster . "<br>" . "</td>";
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
<h3 style="background-color:#EEEEEE;text-align:left;height:5%;width:80%"> &nbsp Running jobs </h3> 
<table id="jobs" border="1" width="400" cellpadding="10">
<tr>
  <th>jobid</th>
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
  echo "<tr>";
  $id =  $job->getAttribute("id");
  $dev =  $job->getAttribute("dev");
  $serverip =  $job->getAttribute("serverip");
  $scriptname =  $job->getAttribute("scriptname");
  $processid = $job->getAttribute( "processid" );
  $params = $job->getAttribute( "params" );
#  $params = $job->getElementsByTagName( "param" );

  echo "<td nowrap>" . $id . "<br>" . "</td>";
  echo "<td nowrap>" . $dev . "<br>" . "</td>";
  echo "<td nowrap>" . $serverip . "<br>" . "</td>";
  echo "<td nowrap>" . $processid . "<br>" . "</td>";
  echo "<td nowrap>" . $params . "<br>" . "</td>";
  echo "<td nowarp>" . "<form action='maintest.php?id=$id' method='post'>". "<input type='submit' name='Submit' value='terminate job' />" . "</form>" . "</td>"; 
  #  echo "<td>" . $params . "<br>" . "</td>";
  echo "</tr>";                                                                                                                                          
#  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  
  }
  ?>
</table>
<br>

<h3 style="background-color:#EEEEEE;text-align:left;height:5%;width:80%"> &nbsp Finished jobs </h3>
<table id="jobs" border="1" width="400" cellpadding="10">
<tr>
  <th>jobid</th>
  <th>testbed</th>
  <th>serverip</th>
  <th>processid</th>
  <th>other params</th>
</tr>

 <?php
#   exec("sudo ./checkjob.pl");

  $doc = new DOMDocument();
  $doc->load( 'finishedjob.xml' );

  $jobs = $doc->getElementsByTagName( "job" );
  foreach( $jobs as $job )
  {
  echo "<tr>";
  $id =  $job->getAttribute("id");
  $dev =  $job->getAttribute("dev");
  $serverip =  $job->getAttribute("serverip");
  $scriptname =  $job->getAttribute("scriptname");
  $processid = $job->getAttribute( "processid" );
  $params = $job->getAttribute( "params" );
#  $params = $job->getElementsByTagName( "param" );

#  echo "<td nowrap>" . $id . "<br>" . "</td>";
 echo "<td nowarp>" . "<a href='viewlog.php?id=$id' target='_blank'>" . $id . "</a>" . "<br>" . "</td>";
  echo "<td nowrap>" . $dev . "<br>" . "</td>";
  echo "<td nowrap>" . $serverip . "<br>" . "</td>";
  echo "<td nowrap>" . $processid . "<br>" . "</td>";
  echo "<td nowrap>" . $params . "<br>" . "</td>";
  #  echo "<td>" . $params . "<br>" . "</td>";
  echo "</tr>";                                                                                                                                          
#  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  
  }
  ?>
</table>
</body>
</html>
