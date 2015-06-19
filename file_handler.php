<?php 
header('location: index.php?page=sell');
session_start();
require('mysql_connect.php');
$extensions = ['jpg', 'gif', 'jpeg', 'png'];
$target_dir = 'uploads/';
$target_file = $target_dir.$_FILES['fileToUpload']['name'];
if(file_exists('uploads')){
	if(in_array(pathinfo($target_file)['extension'], $extensions)){
		print('the file type matches');
		if($_FILES['fileToUpload']['size'] < 2000000){
			print('the file size matches the requirement');
			if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)){
				
			}
		}
	}
else{
	exit();
}

}
$user_id = mysql_real_escape_string($_SESSION['id']);
$user_email = mysql_real_escape_string($_SESSION['email']);
$title = mysql_real_escape_string($_POST['title']);
$details = mysql_real_escape_string($_POST['details']);
$size = mysql_real_escape_string($_POST['size']);
$shoe_condition = mysql_real_escape_string($_POST['shoe_condition']);
$price = mysql_real_escape_string($_POST['price']);
$location = mysql_real_escape_string($_POST['location']);
$postal_code = mysql_real_escape_string($_POST['postal_code']);
$brand = mysql_real_escape_string($_POST['brand']);


$query = "INSERT INTO `kicks`.`items` (`id`, `title`, `details`, `size`, `shoe_condition`, `filepath`, `user_id`, `price`, `location`, `postal_code`, `user_email`, `brand`) VALUES (NULL, '$title', '$details', '$size', '$shoe_condition', '$target_file', '$user_id', '$price', '$location', '$postal_code', '$user_email', '$brand')";

$result = mysqli_query($con, $query);

if(mysqli_affected_rows($con) > 0){
	
		$output['success'] = true; 
}

?>