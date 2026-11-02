<?php
session_start();
$rowcount = 0;
//error_reporting(E_ALL);ini_set('display_errors', '1'); 
include("./includes/connect_portal123.php");
if($_SESSION['access_level']!='102' && $_SESSION['access_level']!='103'){ header("Location: $login"); }
	$id = trim($_POST["name"]);
	$getusrdetails = mysqli_query($mysqli_link,"SELECT * FROM state_excel_test WHERE vehicle_one = '".$id."'");
	$rowcount=mysqli_num_rows($getusrdetails);
	echo $rowcount;
?>