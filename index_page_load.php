<?php 
require('mysql_connect.php');

$query = "SELECT * FROM `items`";

$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
		// print_r($row);
		$output[]= $row;
	}
}
$output_string = json_encode($output);
print_r($output_string);
?>