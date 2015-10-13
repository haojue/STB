<html>
<head>
<style>
.error {color: #FF0000;}
#ip td, #ip th, #file td, #file th
  {
  font-size:1em;
#  border:1px solid #98bf21;
  border:1px solid #5F9EA0;
  padding:3px 7px 2px 7px;
  }

#ip th, #file th
  {
  font-size:1.1em;
  text-align:left;
  padding-top:5px;
  padding-bottom:4px;
#  background-color:#A7C942;
  background-color:#5F9EA0;
  color:#ffffff;
  }
</style>
</head>
<body> 
<?php
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
#$date = test_input($_POST["date"]);
$date = $_GET['date'];
#echo $date;
#$date = $_POST["date"];
if ($date != null) {
if (!preg_match("/\d{4}-\d{2}-\d{2}/i",$date)) {
  $DateErr = "invalid date"; 
}
if($DateErr != null) {
echo "$DateErr\n";
} else {
        echo "<h3> DNS info for All IP accessing for $date</h3>";
       	echo "<table border=1 id=ip width=400 cellpadding=10>";
	     echo "<tr>";
	     echo "<th>IP</th>";
	     echo "<th>Corresponding Domain name</th>";
	     echo "</tr>";
 $myfile = fopen("AV_domainstats_$date", "r") or die("Unable to open file!");
     $line = fgets($myfile);	     
    while(!feof($myfile)) {
     list($type, $number) =  preg_split('/[\n\r\t\s]+/i', $line);
             echo "<td>" . $type . "<br>" . "</td>";
             echo "<td>" . $number . "<br>" . "</td>";
             echo "</tr>";
     $line = fgets($myfile);
     }
     echo "</table>";
     }
}
?>
</body>
</html>
