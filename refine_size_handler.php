<?php 
require('mysql_connect.php');
session_start();

$size = addslashes($_POST['size']);
$price = addslashes($_POST['price']);
$shoe_name = addslashes($_SESSION['shoe_description']);
$zipcode = addslashes($_POST['zipcode']);
$miles = addslashes($_POST['miles']);
$zipcode_array=[];

function zipcodeRadius($lat, $lon, $radius)
{	require('mysql_connect.php');
    $radius = $radius ? $radius : 20;
    $query = 'SELECT zipcode FROM zipcode_db  WHERE (3958*3.1415926*sqrt((Latitude-'.$lat.')*(Latitude-'.$lat.') + cos(Latitude/57.29578)*cos('.$lat.'/57.29578)*(Longitude-'.$lon.')*(Longitude-'.$lon.'))/180) <= '.$radius.';';
    $result = mysqli_query($con, $query);
    // get each result
    $zipcodeList = [];
    while($row = mysqli_fetch_assoc($result))
    {
       $zipcodeList[]=$row['zipcode'];
    }
    return $zipcodeList;
}

if(isset($_SESSION['email'])){
	$output['email'] = $_SESSION['email'];
}

if($size == '' && $price == ''){
	$query = "SELECT * FROM `items` WHERE MATCH(title) AGAINST ('$shoe_name' IN BOOLEAN MODE)";
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
if($_POST['zipcode'] != ''){
	$query = "SELECT latitude,longitude FROM `zipcode_db` WHERE zipcode='$zipcode'";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
		$zipcode_array = $row;
	}
}
$zipcode_array = zipcodeRadius($zipcode_array['latitude'], $zipcode_array['longitude'], $miles);
	for($i = 0; $i < count($output['items']); $i++){
		if(!in_array($output['items'][$i]['postal_code'], $zipcode_array)){
			array_splice($output['items'], $i, 1);
		}
	}

}
$output_string = json_encode($output);
print_r($output_string);
?>