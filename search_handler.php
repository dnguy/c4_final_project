<?php 
require('mysql_connect.php');
session_start();

if($_POST['shoe_description'] == ''){
	exit();
}
if(isset($_SESSION['email'])){
	$output['email'] = $_SESSION['email'];
}

$_SESSION['shoe_description'] = $_POST['shoe_description'];

$shoe_name = addslashes($_POST['shoe_description']);
$output['title'] = $shoe_name;

$query = "SELECT * FROM `items` WHERE MATCH(title) AGAINST ('$shoe_name' IN BOOLEAN MODE) ";

$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
		$output['items'][]= $row;
	}
}
$output_string = json_encode($output);
print_r($output_string);
?>