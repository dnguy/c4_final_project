<?php 
require('mysql_connect.php');
session_start();

if($_SESSION){
	$output['email'] = $_SESSION['email'];
	$output['id'] = $_SESSION['id'];
}

$query = "SELECT * FROM `items`";

$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
		$output['items'][]= $row;
	}
}
$output_string = json_encode($output);
print_r($output_string);
?>