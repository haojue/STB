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
<?php 

include 'navigators1.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = $_REQUEST["name"];


if (empty($_REQUEST["name"])){
#                   echo  "device name is missing";
}else{
#exec("sudo ./dev.pl del $name");
}
}



?>

<form action="change.php" method="post" style="text-align:left;">
<?php echo "Device" . "<input type='text' name='device' id='device' value=$name>" ."<br>"; ?>
Image <input type="text" name="image" id="image" > (location on cnrd shell server)<br>
Your mail alias <input type="text" name="user" id="user" > (Todo!!!!One mail will be sent to your mail box after finished changing image) <br>
<input type="submit" value="Change">
</form> 
</div>
</body>
</html>
