<?php 
session_start();
if(isset($_SESSION['id'])){
require('mysql_connect.php');

foreach($_POST as $k => $v){

	switch ($k) {
    case "title":
        if($_POST['title'] == '')
    {
    		$output['success'] = false;
        	$output['errors'] = 'You must enter a title';
        	$output_string = json_encode($output);
        	print_r($output_string);
        	exit();
    };
        break;
    case "details":
        if($_POST['details'] == '')
    {
    		$output['success'] = false;
        	$output['errors'] = 'You must enter detail information';
        	$output_string = json_encode($output);
        	print_r($output_string);
        	exit();
    };
        break;
    case "size":
        
        if(preg_match( "/^[1-9]\d*(\.\d+)?$/ ",  $_POST['size']) != 1)
    {
    	    $output['success'] = false;
        	$output['errors'] = 'size must be a number value';
        	$output_string = json_encode($output);
        	print_r($output_string);
        	exit();
    };
        break;
    case "price":
        
        if(preg_match( "/^[1-9]\d*(\.\d+)?$/ ",  $_POST['price']) != 1)
    {
    	    $output['success'] = false;
        	$output['errors'] = 'price must be a number value';
        	$output_string = json_encode($output);
        	print_r($output_string);
        	exit();
    };
        break;
    case "location":
        if($_POST['location'] == '')
    {
    		$output['success'] = false;
        	$output['errors'] = 'Must enter a location';
        	$output_string = json_encode($output);
        	print_r($output_string);
        	exit();
    };
        break;
     case "postal_code":
        if(preg_match( "/^[0-9]{5}$/ ",  $_POST['postal_code']) != 1)
    {
    		$output['success'] = false;
        	$output['errors'] = 'Must enter a valid 5 digit zip code';
        	$output_string = json_encode($output);
        	print_r($output_string);
        	exit();
    };
        break;
}
};
if(array_sum($_FILES["fileToUpload"]['error']) == 24){
			$output['success'] = false;
        	$output['errors'] = 'You must upload at least one photo';
        	$output_string = json_encode($output);
        	print_r($output_string);
        	exit();
}


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

$post_id = mysqli_insert_id($con);

$extensions = ['jpg', 'gif', 'jpeg', 'png'];
$target_dir = 'uploads/';
for($i=0; $i<count($_FILES["fileToUpload"]['tmp_name']);$i++){
	if($_FILES["fileToUpload"]['tmp_name'][$i] == ''){continue;}
$target_file = $target_dir.'postid'.$post_id.'_'.$_FILES['fileToUpload']['name'][$i];
if(file_exists('uploads')){
	if(in_array(pathinfo($target_file)['extension'], $extensions)){
		if($_FILES['fileToUpload']['size'][$i] < 2000000){
			if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'][$i], $target_file)){
				//store images into item_images database to reveal in modal carousel
				$query_insert_images = "INSERT INTO `kicks`.`item_images` (`post_id`, `filepath`) VALUES ('$post_id', '$target_file')";
				$result_insert_images = mysqli_query($con, $query_insert_images);			
			}
		}
	}
}
else{
	exit();
}

}

if(mysqli_affected_rows($con) > 0){
		//if row is inserted then query database for the postid number to give the image a unique filename used as thumbnail
		$query_change_image_name = "UPDATE `items` SET filepath='$target_file' WHERE id='$post_id'";
		$result_name_change = mysqli_query($con, $query_change_image_name);
		$output['success'] = true; 
}

$output_string = json_encode($output);
print_r($output_string);
}
else{
	$output['success'] = false;
	$output['errors'] = 'You must be logged in to upload items.';
	$output_string = json_encode($output);
	print_r($output_string);
	exit();
}

?>