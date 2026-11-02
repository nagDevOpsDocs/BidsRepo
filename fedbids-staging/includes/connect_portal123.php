<?php
$db_mysqli_location = "localhost"; 
$db_user = "fedbidsuser";
$db_password = "Ardent@123";


//$mysqli_link = mysqli_connect('localhost',$db_user, $db_password,'temp1');
//$mysqli_link = mysqli_connect('localhost',$db_user, $db_password,'fedbids_staging_old');
$mysqli_link = mysqli_connect('localhost',$db_user, $db_password,'fedbids_staging_new');
//$mysqli_link = mysqli_connect('localhost',$db_user, $db_password,'fedbids_staging');
//$mysqli_link = mysqli_connect('localhost',$db_user, $db_password,'live_map_dev');

// Try connecting to the database
//$conn = new mysqli('localhost', $db_user, $db_password,'temp1');
//$conn = new mysqli('localhost', $db_user, $db_password,'fedbids_staging_old');
$conn = new mysqli('localhost', $db_user, $db_password,'fedbids_staging_new');
//$conn = new mysqli('localhost', $db_user, $db_password,'fedbids_staging');
//$conn = new mysqli('localhost', $db_user, $db_password,'live_map_dev');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$baseurl = 'https://ardentinc.com/fedbids-staging';
$login = 'https://ardentinc.com/login_staging.php';

date_default_timezone_set('US/Eastern');
const DIRECTED_8A_USERS = array(28, 29);
const USER_RON	 = 28;
const USER_TYLER = 29;
?>
