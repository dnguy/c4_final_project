<?php 
require('mysql_connect.php');
session_start();

// 

$size = addslashes($_POST['size']);
$price = addslashes($_POST['price']);
$shoe_name = addslashes($_SESSION['shoe_description']);
if(isset($_SESSION['email'])){
	$output['email'] = $_SESSION['email'];
}

if($size == '' && $price == ''){
	exit();
}
else if($size !== '' && $price !== ''){
	$query = "SELECT * FROM `items` WHERE size='$size' AND price<='$price' AND MATCH(title) AGAINST ('$shoe_name' IN BOOLEAN MODE)";
	$output['title']= $shoe_name.' / size: '.$size.' / Max Price:$'.$price;
}
else if($size != ''){
	$query = "SELECT * FROM `items` WHERE size='$size' AND MATCH(title) AGAINST ('$shoe_name' IN BOOLEAN MODE)";
	$output['title']= $shoe_name.' / size: '.$size;
}
else if($price != ''){
	$query = "SELECT * FROM `items` WHERE price<='$price' AND MATCH(title) AGAINST ('$shoe_name' IN BOOLEAN MODE)";
	$output['title']= $shoe_name.' / Max Price: $'.$price;
}


$result = mysqli_query($con, $query);


if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
		$output['items'][]= $row;
	}
}
$output_string = json_encode($output);
print_r($output_string);
?>