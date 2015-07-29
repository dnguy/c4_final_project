<?php 
require('mysql_connect.php');
session_start();
$postid = addslashes($_POST['postid']);
$sender = addslashes($_POST['sender']);
$subject = addslashes($_POST['subject']);
$message = addslashes($_POST['message']);
$recipient = addslashes($_POST['recipient']);


$query = "INSERT INTO `kicks`.`messages` (`id`, `recipient`, `sender`, `subject`, `message`, `timestamp`, `status`, `thread_id`) VALUES (NULL, '$recipient', '$sender', '$subject', '$message', CURRENT_TIMESTAMP, '1','$postid');";
echo $query;
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