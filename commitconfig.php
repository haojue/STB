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
include 'joblib.php';
if (!(isset($_COOKIE["user"]))) {
	header('Location: ./login.php');
}

$user = $_COOKIE["user"];
setcookie("user", "$user", time()+3600); 

if (isset($_COOKIE["dev"]))
{ $device = $_COOKIE["dev"];
#    echo "welcome $device";
}else
{ $device=$_POST['checkbox01'];
#   echo "welcome $device";
}

# $device = $_POST["checkbox01"];
$user =  $_POST["user"];
$fullname = "$user"."_logresults";
$txt = $_POST['txt'];
$name=$_REQUEST['name'];
$des =  find_des_by_id($name);
#$des = "test";
# $commit = $_POST['Submit'];
 $commit = $_REQUEST['Submit'];

$type = $_REQUEST['type'];
$dev = $_REQUEST['dev'];
 

#var_dump($config);

#print_r($_POST);

#echo "\n\n\n\ndevice is $device";

$array = explode(",\r\n", trim($txt));
#$array = explode("\n", trim($txt));

#var_dump($array);

$config = "";
foreach($array AS $value){ 
#        echo "$value";
#        chop($value);
	$config = $config . $value . ",";
} 


#var_dump($config);

if (!preg_match("/[a-z]+/i",$user)) {
	  $DateErr = "invalid device name";
}


if (preg_match("/Next Step/i",$commit)) {
 include 'create_traff.php';  
 return; 
}

if (preg_match("/Reuse/i",$commit)) {
 include 'create_traff3.php';
 return; 
}

if (preg_match("/Save as config/i",$commit)) {
	   include 'saveasconfig.php';
	      return;
}


if (preg_match("/Edit/i",$commit)) {
	   include 'editdes.php';
	     return;
}


if (preg_match("/View DUT config/i",$commit)) {
	   include 'viewdutconfig.php';
	      return;
}

if (preg_match("/Config Formatter/i",$commit)) {
	   include 'configformatter.php';
	      return;
}

#if( $_POST )
#{
#	$array = $_POST['checkbox'];
#	print_r($array);
#}	
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
	exec("sudo ./commitconfig.pl $device \"$config\"",$arr, $sta); 
#	echo var_dump($arr);
foreach($arr AS $value){
	if (preg_match("/Configuration commit successfully/i",$value)) {
#         print "success\n";
# include 'create_traff.php';  
 include 'create_otherconfig.php';  
 echo "commit successfully!\n";
# echo "Commit is $commit\n";
 return;
	}
	#    exec("sudo ./ssh.pl $date $user");
}
}
#print "failed";

 include 'baseconfig.php';  
 echo "commit failed!Please start over!\n";
#var_dump($arr);
?>
</body>
</html>
