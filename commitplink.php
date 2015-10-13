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
#echo "commit2";
if( $_POST )                                                                                                                                                                   
{
#  print_r($_POST);
  $conn1 = $_POST["conn1"];
  $conn2 = $_POST["conn2"];
  $conn3 = $_POST["conn3"];
  $arr = array($conn1,$conn2,$conn3); 
  $conn = implode(",",$arr);
#  echo $conn; 
  $count = count($_POST)-1; 
#  echo $count;
}

#$device = $_POST["device"];
#$user =  $_POST["user"];
#$fullname = "$user"."_logresults";

#if (!preg_match("/[a-z]+/i",$user)) {
#	  $DateErr = "invalid device name";
# }

	#foreach ((array)$array as $v)
#	{
	#     echo $v;
#	}	

#for($i=0;$i<=count($array);$i++)
#{
#	if(!is_null($array[$i]))
#	{$chechvalue.=$array[$i]}
#}
#print $chechvalue; 
#}

if($_POST) {
        exec("sudo ./mplinker.pl \"$conn\"");
       #    exec("sudo ./ssh.pl $date $user");
      echo "connection link success\n";
}

?>
</body>
</html>
