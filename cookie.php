<?php 
setcookie("user", "Haojue Wang", time()+3600);
?>

<html>
<body>

<?php
if (isset($_COOKIE["user"]))
	  echo "Welcome " . $_COOKIE["user"] . "!<br />";
else
	  echo "Welcome guest!<br />";
?>

</body>
</html>
