<?php 
require('mysql_connect.php');
session_start();

$postid = mysql_real_escape_string($_POST['postid']);

$query = "SELECT filepath FROM `item_images` WHERE post_id='$postid' ";

$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
		$output['images'][]= $row;
	}
}
$output_string = json_encode($output);
print_r($output_string);
?>