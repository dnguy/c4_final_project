<?php 
require('mysql_connect.php');

if(!isset($_POST['user_id'])){
	$output['success'] = false;
	$output['errors'] = 'You must be logged in to like photos';
	$output_string = json_encode($output);
	print_r($output_string);
	exit();
}

$user_id = mysql_real_escape_string($_POST['user_id']);
$post_id = mysql_real_escape_string($_POST['post_id']);

$query_check = "SELECT * FROM `item_popularity` WHERE user_id='$user_id' AND post_id='$post_id'";

$result_check = mysqli_query($con, $query_check);


if(mysqli_num_rows($result_check) > 0){
	$output['success'] = false;
	$output['errors'] = 'This photo has already been liked';
	$output_string = json_encode($output);
	print_r($output_string);
	exit();
}
else{
$query = "INSERT INTO `kicks`.`item_popularity` (`vote_id`, `user_id`, `post_id`, `vote`) VALUES (NULL, '$user_id', '$post_id', '1')";

$result = mysqli_query($con, $query);

if(mysqli_affected_rows($con) > 0){
	
		$output['success'] = true; 
}
$output_string = json_encode($output);
print_r($output_string);
};
?>