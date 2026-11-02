<?php
session_start();
include("./includes/connect_portal123.php");
 
$opp_id = $_GET['oppid'];
$reason = $_GET['reason'];
$unflag = $_GET['unflag'];
$uid	= $_SESSION['user_id'];

$getval = mysqli_fetch_array(mysqli_query($mysqli_link22, "SELECT myfav_bids FROM users WHERE user_id = '".$uid."'"));

	$tempArray = array(); 
	if($getval[0] != ''){
		$tempArray = json_decode($getval[0], TRUE);
	}
	
	if(isset($unflag) and $unflag == 1){
		if (array_key_exists($opp_id, $tempArray)) {
			unset($tempArray[$opp_id]);
		}
	}
	else{
		$tempArray[$opp_id] = $reason;
	}

	$jsonData = json_encode($tempArray);

	mysqli_query($mysqli_link22,"UPDATE users SET myfav_bids='".$jsonData."' WHERE user_id = '".$uid."'");

	echo true;
?>