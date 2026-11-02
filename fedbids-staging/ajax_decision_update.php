<?php
//print("YEP ...");
//exit();

$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;
////include($_SERVER['DOCUMENT_ROOT'] . "include/it_loader.php");

print("<style>
.samewidth { width:240px; font-weight:700;}
</style>");
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

//$which_update_id=$_GET['which_update_id'];
//START


//$ajax_opp_id = 2;
$ajax_opp_id = $_GET['oppid'];
$ajax_opp_field = $_GET['oppfield'];
$ajax_opp_value = $_GET['oppvalue'];
//$ajax_opp_value = str_replace('"', "", $ajax_opp_value);
	//$ajax_opp_value = str_replace("'", "", $ajax_opp_value);

$ajax_opp_value = filter_input(INPUT_POST, 'oppvalue', FILTER_SANITIZE_STRING);


if (strpos($ajax_opp_field, 'decision') !== false) {
    //echo "Word Found!";
	$ajax_opp_field = str_replace($ajax_opp_id,"",$ajax_opp_field);
} else {
    //echo "Word Not Found!";
}

//oppid=" + idc + "&oppfield=" + thisa + "&oppvalue=" + value

//include($_SERVER['DOCUMENT_ROOT'] ."/../include/connect_db.php");
//include($_SERVER['DOCUMENT_ROOT'] ."/include/connect_db.php");

//include($_SERVER['DOCUMENT_ROOT'] ."/include/connect_db_umang.php");
//$umang_ = new MySQLi('localhost', $db_user, $db_password,'umang_opps');
//$mysqli_link = mysqli_connect('portal.ardentinc.com',$db_user, $db_password,'bidsnew');

//UPDATE excel_test SET STATUS='123' WHERE opportunity_id=1542
$query = "UPDATE excel_test SET $ajax_opp_field='$ajax_opp_value' WHERE opportunity_id=$ajax_opp_id";
//$query = "SELECT opp_name, opp_date, opp_price, opp_image, opp_type, opp_id, opp_time FROM umang_opps WHERE opp_id=$ajax_opp_id";
$result = mysqli_query($mysqli_link, $query);
//print $query;
//STOP
?>