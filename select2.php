<?php
$con = mysql_connect("localhost","root","Embe1mpls");
if (!$con)
	  {
		    die('Could not connect: ' . mysql_error());
		      }

mysql_select_db("my_db2", $con);


//echo "date is $_POST[date]";

$result = mysql_query("SELECT * FROM Report WHERE FirstName = '$_POST[firstname]'");

while($row = mysql_fetch_array($result))
	  {
		    echo "Name:" . $row['FirstName'];
		    echo "<br />";
		    echo "Date:" . $row['Date'];
		    echo "<br />"; 
		    echo "Progress:" . $row['Progress'];
		    echo "<br />";
		    echo "Plan:" . $row['Plan'];
		    echo "<br />";
                    echo "<br />";
		    echo "<br />";
		    echo "<br />";
	  }
mysql_close($con);
?>
