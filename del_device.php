<!DOCTYPE html>
<html>
<head>
	<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">
	</script>

<link rel="stylesheet" type="text/css" href="mystyle.css" />
   <title>Scenario Testing Builder</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script> 

<script src="selectdut.js"></script>
</head> 
<body>
<?php include 'navigator.php'; ?>
<div id='test'>

<form action="del_dev.php" method="post" enctype="multipart/form-data">
Device Name <input type="text" name="name" >
<br>
<input type="submit" name="Del" value="Del" />
</form>
</div>
</body>
</html>
