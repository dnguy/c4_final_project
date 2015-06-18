<?php 
session_start();
require('mysql_connect.php');

$post_id = mysql_real_escape_string($_POST['postid']);
$title = mysql_real_escape_string($_POST['title']);
$shoe_condition = mysql_real_escape_string($_POST['shoe_condition']);
$details = mysql_real_escape_string($_POST['details']);
$size = mysql_real_escape_string($_POST['size']);
$price = mysql_real_escape_string($_POST['price']);
$user_id = mysql_real_escape_string($_SESSION['id']);

$query = "UPDATE `items` SET price='$price',title='$title', size='$size', shoe_condition='$shoe_condition' WHERE id='$post_id' AND user_id='$user_id'";

$result = mysqli_query($con, $query);

if(mysqli_affected_rows($con) > 0){
	$output['success']=true;
}
else{
	$output['success']=false;
}

$output_string = json_encode($output);
print_r($output_string);

?>