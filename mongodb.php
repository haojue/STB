<?php
$succss = "";
if(isset($_POST) and $_POST['submitForm'] == "Login" )
{
$usr_email = mysql_escape_string($_POST['usr_email']);
$usr_password = mysql_escape_string($_POST['usr_password']);
$error = array();
// Email Validation
if(empty($usr_email) or !filter_var($usr_email,FILTER_SANITIZE_EMAIL))
{
$error[] = "Empty or invalid email address";
}
if(empty($usr_password)){
$error[] = "Enter your password";
}
if(count($error) == 0){
$con = new Mongo();
if($con){
// Select Database
$db = $con->test;
// Select Collection
$people = $db->people;
$qry = array("user" => $usr_email,"password" => md5($usr_password));
$result = $people->findOne($qry);
echo "continue ====  $result";
if($result){
$success = "You are successully loggedIn";
// Rest of code up to you....
echo "$success";
}
} else {
die("Mongo DB not installed");
}
}
}
?>
