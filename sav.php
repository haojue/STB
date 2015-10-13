<html>
<head>
<link rel="stylesheet" type="text/css" href="mystyle.css" />
</head>

<body>
<img src="juniper.png" class="center"/>
<h1 class=hdid>UTM Akamai Server Access Statistics Daily status</h1>
<div id="daily">
<div id="daily1">
<?php
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
#    $date = date("Y-m-d");
    $myfile = fopen("latest_ip_stats.txt", "r") or die("Unable to open file!");
    $line = fgets($myfile);
    $date = $line;
    echo "<h4>Latest IP Statistics $line by AV type </h4>"; 
     echo "<table id=ip border=1 width=600 cellpadding=10>";
     echo "<tr>";
     echo "<th>AV Type</th>";
     echo "<th>Platform Type</th>";
     echo "<th>Access Number by Unique IP</th>";
     echo "</tr>";   
#    while(!feof($myfile)) {
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
     echo "<td>" . $number . "&nbsp" . "&nbsp" . "&nbsp". "&nbsp" . "&nbsp" . "&nbsp" ."<a href='sav_detail.php?date=$date' font-size:80px>Learn IP and FQDN detail</a>" . "</td>";
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
     echo "<td>" . "$sum" . "&nbsp" . "&nbsp" . "&nbsp" . "&nbsp". "&nbsp" ."<a href='kav_engine_detail.php?date=$date' font-size:80px>Learn IP and FQDN detail</a>" .  "</td>";       
     echo "</tr>";
     echo "</table>";
   #    }
?>
</div>
<div id="daily2">
<h4>Downloaded File Statistics by AV type for <?php  $myfile = fopen("latest_ip_stats.txt", "r") or die("Unable to open file!");
$line = fgets($myfile); echo "$line";?> </h4> 
<table id="file" border="1" width="400" cellpadding="10">
<tr>
  <th>AV Type</th>
  <th>Downloaded File</th>
  <th>Downloaded Number</th>
</tr>
<?php
$myfile = fopen("latest_stats.txt", "r") or die("Unable to open file!");
#while(!feof($myfile)) {
     $i = 0;
     while($i < 6)  { 
     echo "<tr>";      
     $i += 1;
     $line = fgets($myfile);    
     if ($line != null && $i > 1) {
     #     list($type, $file, $number) = explode("", $line); 	 
          list($type, $file, $number) =  preg_split('/[\n\r\t\s]+/i', $line);  
	     echo "<td>" . $type . "<br>" . "</td>";
             echo "<td>" . $file . "<br>" . "</td>";
	     echo "<td>" . $number . "<br>" . "</td>";
	     echo "</tr>";      
     }    
}
?>
</table>
</div>
<div id="historical">
<h1 class=hisid style="background-color:#EEEEEE;text-align:left;width:1000px">Historical Data</h1>
<form action="result.php" method="post" style="text-align:left;">
Date(follow format like 2008-08-08):<input type="text" name="date"><br>
<input type="submit" value="Query">
</form>
</div>
</div>
</body>
</html>
