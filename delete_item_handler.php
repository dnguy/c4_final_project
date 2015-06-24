<?php 
require('mysql_connect.php');
session_start();

$postid = addslashes($_POST['postid']);

$query = "DELETE FROM `items` WHERE id='$postid'";

$result = mysqli_query($con, $query);

if(mysqli_affected_rows($con) > 0){
	
		$output['success'] = true; 
}

$output_string = json_encode($output);
print_r($output_string);
?>