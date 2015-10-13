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

<form action="save_config.php" method="post" enctype="multipart/form-data">
Profile Name <input type="text" name="name" >
<br>
Interface and Zone
 <select id="int" name="int" onchange="showdut(this.value)">
 <?php
  $doc = new DOMDocument();
  $doc->load( 'int.xml' );

  $ints = $doc->getElementsByTagName( "int" );
  foreach( $ints as $int )
  {
  $id =  $int->getAttribute("id");
#  $serverip =  $job->getAttribute("serverip");
#  $scriptname =  $job->getAttribute("scriptname");
#  $params = $job->getElementsByTagName( "param" );
   echo "<option value='$id'>" . $id . "</option>";
  }
  ?>
  </select> <br>
Policy 
 <select id="pol" name="pol"  onchange="showpol(this.value)" >
 <?php
  $doc = new DOMDocument();
  $doc->load( 'pol.xml' );

  $pols = $doc->getElementsByTagName( "pol" );
  foreach( $pols as $pol )
  {
  $id =  $pol->getAttribute("id");
   echo "<option value='$id'>" . $id . "</option>";
  }
  ?>
	</select> <br>
<h3>Config </h3>
<textarea rows="10" cols="80" name="txt" id="txt"></textarea>
<br>
<input type="submit" name="Submit" value="Save Profile" />
</form>
</div>
</body>
</html>
