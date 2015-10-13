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
$date = $_POST["date"];
$user =  $_POST["user"];
$fullname = "$user"."_logresults";

#echo "<h3> All IP accessing for $date</h3>";
#echo "$date";
#if ($date != null) {
if (!preg_match("/\d+/i",$date)) {
  $DateErr = "invalid date"; 
}
if (!preg_match("/[a-z]+/i",$user)) {
	  $DateErr = "invalid user";
}

if($DateErr != null) {
echo "$DateErr\n";
} else {
  	exec("sudo rm -f /tmp/$fullname");
  	exec("sudo rm -f $fullname");
	exec("sudo ./ssh.pl $date $user");
	exec("sudo cp /tmp/$fullname .");
       	echo "<table id=ip border=1 width=400 cellpadding=10>";
	     echo "<tr>";
	     echo "<th>Log Name</th>";
	     echo "<th>Date</th>";
	     echo "<th>Time</th>";
	     echo "</tr>";
	    
	     $myfile = fopen("$fullname", "r") or die("Unable to open file!");
	     $line = fgets($myfile);   
	     while(!feof($myfile)) {
     list($nouse1, $nouse2, $nouse3, $nouse4,$nouse5, $month,$day, $time,$name) =  preg_split('/[\n\r\t\s]+/i', $line);
    #         echo "<td>" . $name . "<br>" . "</td>";
      echo "<tr>";
      echo "<td>" . "$name" ."<br>" . "</td>";
      echo "<td>" . "$month" . "." . "$day" . "<br>" . "</td>";
      echo "<td>" . "$time" . "<br>" . "</td>";
      echo "<td>" . "<a href='log_detail.php?name=$name&user=$user' font-size:80px>Get from shellserver</a>" ."<br>" . "</td>";
      #             echo "<td>" . "<form action='log_detail.php?name=$name' method='get' style='text-align:left;'>". "<input type='submit' name="$name" value='Get from shellserver' action='log_detail.php?name=$name' method='get'>" . "</form>" . "</td>"; 
     echo "</tr>";
     $line = fgets($myfile);
     }
     echo "</table>";
     }
#} else {
#    echo "invalid date";
#}	
?>
</body>
</html>
