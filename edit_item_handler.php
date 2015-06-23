<?php 
session_start();
require('mysql_connect.php');

$post_id = addslashes($_POST['postid']);
$title = addslashes($_POST['title']);
$shoe_condition = addslashes($_POST['shoe_condition']);
$details = addslashes($_POST['details']);
$size = addslashes($_POST['size']);
$price = addslashes($_POST['price']);
$user_id = addslashes($_SESSION['id']);

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