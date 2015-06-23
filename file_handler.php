<?php 
session_start();
require('mysql_connect.php');

$user_id = addslashes($_SESSION['id']);
$user_email = addslashes($_SESSION['email']);
$title = addslashes($_POST['title']);
$details = addslashes($_POST['details']);
$size = addslashes($_POST['size']);
$shoe_condition = addslashes($_POST['shoe_condition']);
$price = addslashes($_POST['price']);
$location = addslashes($_POST['location']);
$postal_code = addslashes($_POST['postal_code']);
$brand = addslashes($_POST['brand']);


$query = "INSERT INTO `kicks`.`items` (`id`, `title`, `details`, `size`, `shoe_condition`, `filepath`, `user_id`, `price`, `location`, `postal_code`, `user_email`, `brand`) VALUES (NULL, '$title', '$details', '$size', '$shoe_condition', '', '$user_id', '$price', '$location', '$postal_code', '$user_email', '$brand')";

$result = mysqli_query($con, $query);

$extensions = ['jpg', 'gif', 'jpeg', 'png'];
$target_dir = 'uploads/';
for($i=0; $i<count($_FILES["fileToUpload"]['tmp_name']);$i++){
	if($_FILES["fileToUpload"]['tmp_name'][$i] == ''){continue;}
$target_file = $target_dir.'postid'.mysqli_insert_id($con).'_'.$_FILES['fileToUpload']['name'][$i];
if(file_exists('uploads')){
	if(in_array(pathinfo($target_file)['extension'], $extensions)){
		if($_FILES['fileToUpload']['size'][$i] < 2000000){
			if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'][$i], $target_file)){
				
			}
		}
	}
}
else{
	exit();
}

}

if(mysqli_affected_rows($con) > 0){
	//if row is inserted then query database for the postid number to give the image a unique filename
		$post_id = mysqli_insert_id($con);
		$query_change_image_name = "UPDATE `items` SET filepath='$target_file' WHERE id='$post_id'";
		$result_name_change = mysqli_query($con, $query_change_image_name);
		$output['success'] = true; 
}

$output_string = json_encode($output);
print_r($output_string);

?>