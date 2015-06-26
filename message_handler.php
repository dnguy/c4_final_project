<?php 
session_start();
require('mysql_connect.php');
if(isset($_POST['sender'])){

$postid = addslashes($_POST['postid']);

$query_recipient_email = "SELECT user_email FROM `items` WHERE id='$postid'";
$result_email = mysqli_query($con, $query_recipient_email);

$row = mysqli_fetch_assoc($result_email);
$email= $row;

$sender = addslashes($_POST['sender']);
$subject = addslashes($_POST['subject']);
$message = addslashes($_POST['message']);
$user_email = addslashes($email['user_email']);


$query = "INSERT INTO `kicks`.`messages` (`id`, `recipient`, `sender`, `subject`, `message`, `timestamp`, `status`, `thread_id`) VALUES (NULL, '$user_email', '$sender', '$subject', '$message', CURRENT_TIMESTAMP, '1','');";

$result = mysqli_query($con, $query);

$thread_id = mysqli_insert_id($con);



if(mysqli_affected_rows($con) > 0){
	//insert into thread_id the current message id
	$query_change_image_name = "UPDATE `messages` SET thread_id='$thread_id' WHERE id='$thread_id'";
	$result_name_change = mysqli_query($con, $query_change_image_name);
	$output['success'] = true;
}
$output_string = json_encode($output);
print_r($output_string);
}
else{
	$output['success'] = false;
	$output['errors'] = 'You must be logged in to send messages.';
	$output_string = json_encode($output);
	print_r($output_string);
	exit();
}
?>