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


<script src="selectdut.js"></script>
</head> 
<body>
<?php include 'navigators2.php'; ?>
<div id='test'>


<?php echo "<form action='save_des.php?name=$name' method='post' enctype='multipart/form-data'>"; ?>
<br>
<h3>Description </h3>
<?php echo "<textarea rows='10' cols='120' name='txt' id='txt'>" . $des . "</textarea>"; ?>
<br>
<input type="submit" name="Submit" value="Save" />
</form>
</div>
</body>
</html>
