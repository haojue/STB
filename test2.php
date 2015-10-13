<?php 
function read() { 
	$fp = fopen('/dev/stdin', 'r'); 
	$input = fgets($fp, 255); 
	fclose($fp); 
	$input = chop($input);
	return $input; 
} 
print("What is your first name? "); 
$first_name = read(); 
print("What is your last name? "); 
$last_name = read(); 
print("\nHello, $first_name $last_name! Nice to meet you!\n"); 
?>  
