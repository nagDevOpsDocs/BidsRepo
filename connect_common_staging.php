<?php
$db_mysqli_location = "localhost"; 
$db_user = "fedbidsuser";
$db_password = "Ardent@123";

$mysqli_link = mysqli_connect('localhost',$db_user, $db_password,'fedbids_staging_new');
//$mysqli_link = mysqli_connect('localhost',$db_user, $db_password,'live_map_dev');

// Try connecting to the database
$conn = new mysqli('localhost', $db_user, $db_password,'fedbids_staging_new');
//$conn = new mysqli('localhost', $db_user, $db_password,'live_map_dev');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$baseurl = 'https://ardentinc.com';

/*$db_mysqli_location = "localhost"; 
$db_user = "fedbidsuser";
$db_password = "Ardent@123";

$mysqli_link = mysqli_connect('localhost',$db_user, $db_password,'statebidsdb');

// Try connecting to the database
$conn = new mysqli('localhost', $db_user, $db_password,'statebidsdb');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}*/
?>