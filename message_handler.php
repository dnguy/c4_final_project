<?php 
session_start();
require('mysql_connect.php');

if(!isset($_POST['sender'])){
	$output['success'] = false;
	$output['errors'] = 'You must be logged in to send messages.';
	$output_string = json_encode($output);
	print_r($output_string);
	exit();
}

$query_recipient_email = "SELECT user_email FROM `items` WHERE id='1'";
$result_email = mysqli_query($con, $query_recipient_email);

$row = mysqli_fetch_assoc($result_email);
$email= $row;

$sender = mysql_real_escape_string($_POST['sender']);
$subject = mysql_real_escape_string($_POST['subject']);
$message = mysql_real_escape_string($_POST['message']);
$user_email = mysql_real_escape_string($email['user_email']);


$query = "INSERT INTO `kicks`.`messages` (`id`, `recipient`, `sender`, `subject`, `message`, `timestamp`) VALUES (NULL, '$user_email', '$sender', '$subject', '$message', CURRENT_TIMESTAMP);";

$result = mysqli_query($con, $query);

if(mysqli_affected_rows($con) > 0){
	$output['success'] = true;
}
else{
	$output['success'] = false;
}

$output_string = json_encode($output);
print_r($output_string);
?>