<?php
$con = mysql_connect("localhost","root","Embe1mpls");
if (!$con)
	  {
		    die('Could not connect: ' . mysql_error());
		      }

if (!(mysql_select_db("my_db2", $con))){
if (mysql_query("CREATE DATABASE my_db2",$con))
  {
  echo "Database created";
  }
else
  {
  echo "Error creating database: " . mysql_error();
  }
}
mysql_select_db("my_db2", $con);


$sql = "CREATE TABLE Report 
	(
		FirstName varchar(15),
		Date date,
                Progress text,
		Plan text
)";
if (!mysql_query($sql,$con))
          {
//                    die('Error: ' . mysql_error());
                      }

mysql_query("delete from Report WHERE FirstName = '$_POST[firstname]' AND Date = '$_POST[date]'");

//if(mysql_query("select * from Report WHERE FirstName = '$_POST[firstname]' AND Date = '$_POST[date]'")){
//mysql_query("UPDATE Report SET Progress = '$_POST[progress]'
//	WHERE FirstName = '$_POST[firstname]' AND Date = '$_POST[date]'");
//     mysql_query("UPDATE Report SET Plan = '$_POST[plan]'
//        WHERE FirstName = '$_POST[firstname]' AND Date = '$_POST[date]'");  

$sql="INSERT INTO Report (FirstName, Date, Progress, Plan)
	VALUES
	('$_POST[firstname]','$_POST[date]','$_POST[progress]','$_POST[plan]')";

if (!mysql_query($sql,$con))
	  {
		    die('Error: ' . mysql_error());
		      }
echo "1 record added";

mysql_close($con)
?>
