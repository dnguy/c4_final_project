<?php 
session_start();
require('mysql_connect.php');
$first_name = mysql_real_escape_string($_POST['first_name']);
$last_name = mysql_real_escape_string($_POST['last_name']);
$id = mysql_real_escape_string($_POST['id']);
$email = mysql_real_escape_string($_POST['email']);

$_SESSION['id'] = $id;
$_SESSION['name'] = $first_name . "&nbsp" .$last_name;
$_SESSION['email'] = $email;


$query_check = "SELECT id,email FROM `users` WHERE id='$id' AND email='$email'";

$result_check = mysqli_query($con, $query_check);


if(mysqli_num_rows($result_check) > 0){
	$output['success'] = false;
	$output_string = json_encode($output);
	print_r($output_string);
	exit();
}
else{
$query = "INSERT INTO `kicks`.`users` (`id`, `email`, `first_name`, `last_name`) VALUES ('$id', '$email', '$first_name', '$last_name');";

$result = mysqli_query($con, $query);

if(mysqli_affected_rows($con) > 0){
	
		$output['success'] = true; 
}
$output_string = json_encode($output);
print_r($output_string);
};
?>