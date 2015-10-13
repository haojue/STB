<?php

function safestrip($string){
   $string = strip_tags($string);
   $string = mysql_real_escape_string($string);
   return $string;
}
  

function messages() {
 $message = '';
 if($_SESSION['success'] != '') {
   $message = '<span id="message">'
   .$_SESSION['success'].'</span>';
   $_SESSION['success'] = '';
 }
 if($_SESSION['error'] != '') {
   $message = '<span id="message">'
   .$_SESSION['error'].'</span>';
   $_SESSION['error'] = '';
 }
 return $message;
}
  

function login($username, $password){
  

#$user = safestrip($username);
#$pass = safestrip($password);

$user =	$username; 
$pass =	$password; 


#$pass = md5($pass);

$con = mysql_connect("localhost","root","Embe1mpls");
if (!$con)
          {
                    die('Could not connect: ' . mysql_error());
                      }
  mysql_select_db("mydb", $con);

#echo "SELECT * FROM user_table WHERE username = $user AND password = $pass";	
 $sql =
 mysql_query("SELECT * FROM user_table WHERE username = '$user'
 AND password = '$pass'")or die(mysql_error());
  

 if (mysql_num_rows($sql) == 1) {
  
            
             $_SESSION['authorized'] = true;
  
             
            $_SESSION['success'] = 'login successfully';
	    setcookie("user", "$user", time()+3600);
	     header('Location: ./index.php');
	     echo "login successfully";
            exit;
  
 } else {
        $result =mysql_num_rows($sql);     
#	 echo "$result"; 
       $_SESSION['error'] = 'sorry, you password or username is wrong';
   echo "sorry, you password or username is wrong";
 }
}

function change($username, $oldpass, $newpass){

$user = $username;
$pass = $oldpass;
$newpass = $newpass;

#$pass = md5($pass);

$con = mysql_connect("localhost","root","Embe1mpls");
if (!$con)
          {
                    die('Could not connect: ' . mysql_error());
                      }
  mysql_select_db("mydb", $con);

#echo "SELECT * FROM user_table WHERE username = $user AND password = $pass";   
 $sql =
 mysql_query("SELECT * FROM user_table WHERE username = '$user'
 AND password = '$pass'")or die(mysql_error());


 if (mysql_num_rows($sql) == 1) {

   mysql_query("update user_table set password='$newpass' where username='$user'");
           header('Location: ./login.php');
            exit;

 } else {
    
        $result =mysql_num_rows($sql);
   echo "sorry, something wrong, your password not change";
 }
}

function register($username, $pass){

$user = $username;
$pass = $pass;

#$pass = md5($pass);

$con = mysql_connect("localhost","root","Embe1mpls");
if (!$con)
          {
                    die('Could not connect: ' . mysql_error());
                      }
  mysql_select_db("mydb", $con);


$sql="INSERT INTO user_table (username, password) VALUES ('$user','$pass')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
   echo "sorry, something wrong, your password not change";
  }
else {
     header('Location: ./login.php');
     exit;
  } 
}


function recovery($username){
$user = $username;

$con = mysql_connect("localhost","root","Embe1mpls");
if (!$con) {
      die('Could not connect: ' . mysql_error());
}
mysql_select_db("mydb", $con);
$sql = mysql_query("SELECT * FROM user_table")or die(mysql_error());
$row = mysql_fetch_array($sql);
$password = $row['password']; 
return $password;
}


$name = $_POST["usr_email"];
$passwd = $_POST["pwd"];
$op = $_POST["doLogin"];

$oldpass = $_POST["oldpwd"];
$newpass = $_POST["newpwd1"];
$newpass2 = $_POST["newpwd2"];
$pwd1 = $_POST["pwd1"];
$pwd2 = $_POST["pwd2"];
	
#echo "name $name, passwd $passwd";
if($op == "Change") {
      if($newpass == $newpass2) {
          echo "Going to change password for $name";      
	      change($name, $oldpass, $newpass);
      } else {
          echo "retype password didn't match";
      }
}elseif($op == "Register") {
     if($pwd1 == $pwd2) {
     register($name,$pwd1);
     } else {
          echo "retype password didn't match";
     }
} elseif($op == "Recovery") {
   $pass = recovery($name);
   exec("sudo ./sendpass.pl $name $pass &"); 
   echo "An email is delivering to your mailbox";
   header('Location: ./login.php'); 
}else {
	login($name, $passwd);
}
?>
