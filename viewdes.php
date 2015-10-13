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


$name=$_REQUEST['name'];

$des =  find_des_by_id($name);
#echo "$get_param";
echo "<form action='commitconfig.php?name=$name' method='post' enctype='multipart/form-data'>";
echo "<p id='des'>" . "$des" . "</p>" . "<br>"; 

echo "<input type='submit' name='Submit' value='Edit' />";

echo "</form>";	

?>

</body>

</html>
