<?php 
require('mysql_connect.php');
$name = mysql_real_escape_string($_POST['name']);
$id = mysql_real_escape_string($_POST['id']);
$email = mysql_real_escape_string($_POST['email']);

$query_check = "SELECT id,email FROM `users` WHERE id='$id' AND email='$email'";

$result_check = mysqli_query($con, $query_check);


if(mysqli_num_rows($result_check) > 0){
	$output['success'] = false;
	$output_string = json_encode($output);
	print_r($output_string);
	exit();
}
else{
$query = "INSERT INTO `kicks`.`users` (`id`, `email`, `name`) VALUES ('$id', '$email', 'name');";

$result = mysqli_query($con, $query);

if(mysqli_affected_rows($con) > 0){
	
		$output['success'] = true; 
}
$output_string = json_encode($output);
print_r($output_string);
};
?>