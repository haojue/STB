<html>
<head>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js">
</script>

<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
</script>
<link rel="stylesheet" type="text/css" href="mystyle.css" />
   <title>Scenario Testing Builder</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script> 

        <link rel="stylesheet" type="text/css" href="js/easyui.css">
        <link rel="stylesheet" type="text/css" href="js/icon.css">
        <link rel="stylesheet" type="text/css" href="js/demo.css">
   <script type="text/javascript" src="js/jquery-1.6.min.js"></script>                                                                                   
   <script type="text/javascript" src="js/jquery.easyui.min.js"></script>

</head>

<body>
<?php include 'navigator.php'; ?>
<br>
<br>

<?php
include 'joblib.php';


$id=$_REQUEST['id'];

$get_param = search_job($id);

$device =  search_dev_by_id($id);
#echo "$get_param";
                                                                                                                                                         
list($serverip, $params, $processid) = explode(",",$get_param);
#  echo "params is $get_param";
  preg_match("/(.*?)\s+.*/i", "$params", $matches);
  $tclname = $matches[1];

  $rsi=$device ."." . $id;
#  echo "log is $log";
#  exec("sudo rm -f $log");
#  exec("sudo wget http://$serverip/$log");
#   echo file_get_contents("$log");
  if(file_exists($rsi))
  {
   if(filesize("$rsi")> 1000000) {
	  #    $lines = file("$rsi");   
  
#    foreach ( $lines as $line ) {
#     echo "$line" . "<br>"; 
#    }
    echo "This file size is larger than 1000000 bytes, please use the following link to view" . "<br>";
    echo "<a href='$rsi'>" . "Download" . "</a>"; 
   } else { 
          $myfile = fopen("$rsi", "r") or die("Unable to open file!");
          while(!feof($myfile)) {
          echo fgets($myfile) . "<br>";
          }
          fclose($myfile);
   }
  } else {
     echo "This job is terminated or aborted, no RSI collected.";    
  }
  #exec("sudo mv -f $_REQUEST[log] ewf_testresults");
?>

</body>

</html>
