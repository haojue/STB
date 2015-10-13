<html>
<head>
<style>
.error {color: #FF0000;}
#ip td, #ip th, #file td, #file th
  {
  font-size:1em;
#  border:1px solid #98bf21;
  border:1px solid #5F9EA0;
  padding:3px 7px 2px 7px;
  }

#ip th, #file th
  {
  font-size:1.1em;
  text-align:left;
  padding-top:5px;
  padding-bottom:4px;
#  background-color:#A7C942;
  background-color:#5F9EA0;
  color:#ffffff;
  }
</style>
</head>
<body> 
<?php

#$date = test_input($_POST["date"]);
$name = $_GET['name'];
$user = $_GET['user'];
#print "name is $name\n";

preg_match("/.*\/(.*)/i", "$name", $matches);
$file = $matches[1];

if (!file_exists($file)) {
#	  print 'File not found';
#$name = './EWF_HE/results/JX46_TPI21633_EWF_cache.pl.17165.log'; 
 #         print "name $name, user $user \n\n";
	  exec("sudo ./ssh2.pl $name $user");
	  exec("sudo cp /tmp/$file .");
}
         
$html_file = JT_.$file.".html";	  
           exec("sudo ./log2html.pl $file $html_file");
        echo "<a href='$html_file'>". "$file" . "</a>";
        #   system('sudo cat /tmp/JX46_TPI21633_EWF_cache.pl.17165.log');
?>
</body>
</html>
