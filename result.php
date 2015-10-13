<html>
<head>
<style>
.error {color: #FF0000;}
#ip, #file
  {
  font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
  width:100%;
  border-collapse:collapse;
  }

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
#ip tr.alt
  {
   color:#000000;
   background-color:#C0C0C0;
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
$date = test_input($_POST["date"]);
#$date = $_POST["date"];
$flag = null;
if ($date != null) {
if (!preg_match("/\d{4}-\d{2}-\d{2}/i",$date)) {
  $DateErr = "invalid date"; 
  $flag = 1; 
}
if($DateErr != null) {
echo "$DateErr\n";
} else {
        $myfile = fopen("ip_stats.txt", "r") or die("Unable to open file!");
     while(!feof($myfile)) {
     $line = fgets($myfile);
     $line = test_input($line);
     if (strcmp($line,$date)) continue; 
     else {
	     $flag = 2;
             echo "<h4>IP Statistics by AV type for $date </h4>";
             echo "<table id=ip border=1 width=400 cellpadding=10>";
     echo "<tr>";
     echo "<th>AV Type</th>";
     echo "<th>Platform Type</th>";
     echo "<th>Access Number by Unique IP</th>";
     echo "</tr>"; 	
	     $sum=0;
    for ($x=0; $x<7; $x++) {                                                                                                                                                   
     $line = fgets($myfile);
     list($type, $platform, $number) =  preg_split('/[\n\r\t\s]+/i', $line);
     $sum += $number;
             echo "<tr>";
     if($x==0) {
     echo "<td rowspan=8>" . $type  . "</td>";
     }  
             echo "<td>" . $platform  . "</td>";
             echo "<td>" . $number . "</td>";
             echo "</tr>";
     }
     echo "<tr class=alt>";
 #    echo "<td> "."</td>";
     echo "<td>" . "KAV Total:" . "</td>";
     echo "<td>" . $sum . "&nbsp" . "&nbsp" . "&nbsp" . "&nbsp" . "<a href='kav_detail.php?date=$date' font-size:80px>Learn IP and FQDN detail</a>" . "</td>";
     echo "</tr>";
     $sum=0;     
     for ($x=0; $x<5; $x++) {                                                                                                      
         $line = fgets($myfile); 
         list($type, $platform, $number) =  preg_split('/[\n\r\t\s]+/i', $line);
         $sum += $number;  
     if($x==0) {
         echo "<td rowspan=6>" . $type  . "</td>";
     } 
         echo "<td>" . $platform  . "</td>";
         echo "<td>" . $number . "</td>";
         echo "</tr>";
     }
     echo "<tr class=alt>";
#     echo "<td>" ."</td>";
     echo "<td>" . "EAV Total:" . "</td>";
     echo "<td>" . "$sum" . "&nbsp" . "&nbsp" . "&nbsp". "&nbsp" . "&nbsp" . "<a href='eav_detail.php?date=$date' font-size:80px>Learn IP and FQDN detail</a>" .  "</td>";     
  
     echo "</tr>";
     $line = fgets($myfile);
     list($type, $platform, $number) =  preg_split('/[\n\r\t\s]+/i', $line);
     echo "<tr>";
     echo "<td>" . $type  . "</td>";
     echo "<td>" . $platform  . "</td>";
     echo "<td>" . $number . "&nbsp" . "&nbsp" . "&nbsp". "&nbsp" . "&nbsp" . "&nbsp" ."<a href='sav_detail.php?date=$date' font-size:80px>Learn IP and FQDN detail</a>" . "</t
d>";
     echo "</tr>";
     $sum=0;
     for ($x=0; $x<2; $x++) {                                                                                                      
     $line = fgets($myfile); 
     list($type, $platform, $number) =  preg_split('/[\n\r\t\s]+/i', $line);
             $sum += $number; 
     if($x==0) {
         echo "<td rowspan=3>" . $type  . "</td>";
     }     
         echo "<td>" . $platform  . "</td>";
         echo "<td>" . $number . "</td>";
         echo "</tr>";
     }
     echo "<tr class=alt>";
#     echo "<td>" ."</td>";
     echo "<td>" . "KAV_Engine Total:" . "</td>";
     echo "<td>" . "$sum" . "&nbsp" . "&nbsp" . "&nbsp" . "&nbsp". "&nbsp" ."<a href='kav_engine_detail.php?date=$date' font-size:80px>Learn IP and FQDN detail</a>" .  "</td>"
;       
     echo "</tr>";
     echo "</table>"; 
     } 
     echo "<br>";
     echo "<br>"; 
     $myfile = fopen("stats.txt", "r") or die("Unable to open file!");
while(!feof($myfile)) {
     $line = fgets($myfile);
     $line = test_input($line);
     if (strcmp($line,$date)) continue; 
     else {
     echo "<h4>Downloaded File Statistics by AV type for $date </h4>";
     echo "<table id=file border=1 width=400 cellpadding=10>";
     echo "<tr>";
     echo "<th>AV Type</th>";
     echo "<th>Downloaded File</th>";                                                                                        
     echo "<th>Downloaded Number</th>";
     echo "</tr>";   
     for ($x=0; $x<4; $x++) { 
     $line = fgets($myfile); 
     list($type, $file, $number) =  preg_split('/[\n\r\t\s]+/i', $line);
             echo "<td>" . $type . "<br>" . "</td>";
             echo "<td>" . $file . "<br>" . "</td>";
             echo "<td>" . $number . "<br>" . "</td>";
             echo "</tr>";
     }
     echo "</table>";
     echo "<br>";
     echo "<br>"; 
#     echo "<a href='detail.php?date=$date' font-size:80px>Learn Detail of all accessing IP for $date</a>";
     }
}
}
}
if($flag == null) {
    echo "Sorry, no data for $date, please try another date\n";
}
}
?>
</body>
</html>
