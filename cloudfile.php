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
       <?php include 'navigators4.php'; ?>
<h3 style="background-color:#EEEEEE;text-align:left;height:5%;width:80%"> &nbsp Existing Scripts </h3>
<table id="devs" border="1" width="400" cellpadding="10">
<tr>
  <th>Traffic Tcl Name</th>
  <th>Traffic Tcl Type</th>
  <th>Owner</th>
  <th>Short Description</th>
  <th>Download Link</th>
</tr>

 <?php
  $doc = new DOMDocument();
  $doc->load( 'config.xml' );

  $items = $doc->getElementsByTagName( "config" );
  foreach( $items as $item )
  {
  echo "<tr>";
  $name =  $item->getAttribute("id");
  $type =  $item->getAttribute("type");
  $des =  $item->getAttribute("des");
  $owner =  $item->getAttribute("owner");

  if(($type == "BPS")||($type == "IxiaLoad") || ($type == "IxiaExplorer") || ($type == "TestCenter") || ($type == "LandSlide") ) {


  echo "<td>" . $name . "<br>" . "</td>";
  echo "<td>" . $type . "<br>" . "</td>";
  echo "<td>" . $owner . "<br>" . "</td>";
#  echo "<td nowarp>" . "<a href='viewdes.php?name=$name' target='_blank'>" . "View" . "</a>" . "<br>" . "</td>";  
  echo "<td nowarp>" . "<a href='viewdes.php?name=$name'>" . "View" . "</a>" . "<br>" . "</td>";  
  echo "<td nowarp>" . "<a href='upload/$name'>" . "Download" . "</a>" . "<br>" . "</td>";  
#  echo "<td>" . $des . "<br>" . "</td>";
#  echo "<td>" . $params . "<br>" . "</td>";
  echo "</tr>";                                                                                                                                          
  }
  #  $titles = $book->getElementsByTagName( "title" );
#  $title = $titles->item(0)->nodeValue;
  }
  ?>
</table>
<br>
<br>
<h3 style="background-color:#EEEEEE;text-align:left;height:5%;width:80%"> &nbsp Upload new Scripts </h3> 
		<form action="showuploadconfig.php" method="post"
			enctype="multipart/form-data">
			Scripts type:  
 <select id="profiletype" name="profiletype" >
                <option value="BPS">BPS</option>
                <option value="IxiaLoad">IxiaLoad</option>
                <option value="IxiaExplorer">IxiaExplorer</option>
                <option value="TestCenter">TestCenter</option>
                <option value="LandSlide">LandSlide</option>
 </select> <br> <br>   
			Scripts name: <input type="txt" name="profilename" id="profilename" /> <br> <br> 
			Scripts description: <input type="txt" name="profiledes" id="profiledes" /> <br> <br> 
			<label for="file">Filename:</label>
			<input type="file" name="file" id="file" /> 
			<br />
			<input type="submit" name="submit" value="Upload" />
		</form>

	</body>
</html>
