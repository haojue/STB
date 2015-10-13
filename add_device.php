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

<div id='test'>

<form action="save_dev.php" method="post" enctype="multipart/form-data">
Device Name <input type="text" name="name" >
<p>(Note:for HA, please input primary node name)</p>
<br>
Type <select id="type" name="type"  onchange="showconfig(this.value)" >
<?php
  $doc = new DOMDocument();
  $doc->load( 'type.xml' );

  $types = $doc->getElementsByTagName( "type" );
  foreach( $types as $type )
  {
  $id =  $type->getAttribute("type");
  echo "<option value='$id'>" . $id . "</option>"; 
  }
?>
</select>
<br>
<br>
Cluster Status<select id="ha" name="cluster">
   <option value='ha'>ha</option>;
   <option value='st'>standalone</option>;
</select>
<br>
<br>
<input type="submit" name="Add" value="Add" />
</form>
</div>
</body>
</html>
