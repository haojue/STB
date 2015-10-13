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

<script>
setTimeout("loadXMLDoc()",1000)

function loadXMLDoc()
{
	var xmlhttp;
        if (window.XMLHttpRequest)
          {
            xmlhttp=new XMLHttpRequest();
          }
<?php
$filename=$_FILES["file"]["name"];$profilename =$_POST["profilename"]; echo "document.getElementById('title').innerHTML='filename $filename $profilename';";  echo "xmlhttp.open('GET','upload/$filename',false);"; ?>

 xmlhttp.send();
	document.getElementById("txt").value=xmlhttp.responseText;
//	document.getElementById("txt").innerHTML=test;
}

</script>
</head>

<body>
<?php include 'navigators4.php'; ?>
<?php
#if (($_FILES["file"]["type"] == "text/plain")
#&& ($_FILES["file"]["size"] < 200000))
if ($_FILES["file"]["size"] < 200000)
	{
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
 
    $GLOBALS['file'] = $_FILES["file"]["tmp_name"];
    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
   
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
   #   echo "File name" $_FILES["file"]["name"];
      $file = $_FILES["file"]["name"];
      echo "<form action='save_script.php' method='post'>";
      echo "$file";
      echo "<p id='title'>" . "</p>";
      $profilename =$_POST["profilename"];
      $profiletype =$_POST["profiletype"];
      $profiledes =$_POST["profiledes"];
      $file =$_POST["file"];

   #   exec("sudo ./config_op.pl add \"$profilename\" $profiletype \"$profiledes\" \"$file\"");
   
      echo "<input type='hidden' id='name' name='name' value='$profilename'/>";	
      echo "<input type='hidden' id='type' name='type' value='$profiletype'/>";	
      echo "<input type='hidden' id='des' name='des' value='$profiledes'/>";	
#echo "<input type='hidden' id='dut' name='dut' value='$dev'/>"; 
      echo "<textarea rows='10' cols='80' id='txt' name='txt'>" . "</textarea>";
 #     echo "<p id='txt' name='txt'>" . "</p>";
      echo "<br>";
      echo "<input type='submit' value='save as profile' name='submit'>";
      echo "</form>"; 
      echo "$profilename $profiletype $profiledes\n\n";
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>  
</body>
</html>
