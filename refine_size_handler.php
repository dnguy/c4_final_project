<?php 
require('mysql_connect.php');
session_start();

// 

$size = mysql_real_escape_string($_POST['size']);
$price = mysql_real_escape_string($_POST['price']);
$shoe_name = mysql_real_escape_string($_SESSION['shoe_description']);

if($size == '' && $price == ''){
	exit();
}
else if($size !== '' && $price !== ''){
	$query = "SELECT * FROM `items` WHERE size='$size' AND price<='$price' AND title LIKE '%$shoe_name%'";
	$output['title']= $shoe_name.' / size: '.$size.' / Max Price:$'.$price;
}
else if($size != ''){
	$query = "SELECT * FROM `items` WHERE size='$size' AND title LIKE '%$shoe_name%'";
	$output['title']= $shoe_name.' / size: '.$size;
}
else if($price != ''){
	$query = "SELECT * FROM `items` WHERE price<='$price' AND title LIKE '%$shoe_name%'";
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