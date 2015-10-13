<?php
$mongo = new Mongo();
$db = $mongo->selectDB("test");
$db->createCollection("people",false);
$people = $db->people;
$insert = array("user"=>"test@juniper.net","password"=>md5("123"));
$db->insert($insert);
?>
