<?php
$db_mysqli_location = "localhost"; 
$db_user = "fedbidsuser";
$db_password = "Ardent@123";

$mysqli_link = mysqli_connect('localhost',$db_user, $db_password,'statebidsdb');
$mysqli_link22 = mysqli_connect('localhost',$db_user, $db_password,'fedbidsdb');
//$mysqli_link = mysqli_connect('localhost',$db_user, $db_password,'statebids_dev');

// Try connecting to the database
$conn = new mysqli('localhost', $db_user, $db_password,'statebidsdb');
//$conn = new mysqli('localhost', $db_user, $db_password,'statebids_dev');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$baseurl = 'https://ardentinc.com/statebids';
$login = 'https://ardentinc.com/login.php';

date_default_timezone_set('US/Eastern');
?>
