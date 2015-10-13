<html>  
<head>  
<title>edit html</title>  

<?php 
if (!(isset($_COOKIE["adddevice"]))) {
	echo "<script language=\"javascript\">";
#	echo "alert('add new device?')";
	echo "prompt('add new device?')";
        echo "document.getElementById('demo').innerHTML=testtest";    
	#    echo "cookie .SetCookie('adddevice','1',10)"; 	
	echo "</script>"; 
}                                                                                                                            
?>

</head> 
<body>
<p id="demo">test</p>
</body> 
</html> 
