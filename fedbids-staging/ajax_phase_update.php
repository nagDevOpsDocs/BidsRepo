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
//echo "<pre>";
//print_r($_GET);
//exit;

//$ajax_opp_id = 2;
$ajax_opp_id = $_GET['oppid'];
$ajax_opp_field = $_GET['oppfield'];
$ajax_opp_value = $_GET['oppvalue'];
$ajax_opp_value = str_replace('"', "", $ajax_opp_value);
$ajax_opp_value = str_replace("'", "", $ajax_opp_value);

$do_this_as_well = 0;
$status_number_query = "";
if ($ajax_opp_field=='status') {
	$do_this_as_well = 1;
	$status_value = 0;
	//if ($ajax_opp_value=="Review")			{ $status_value = 1; }
	if ($ajax_opp_value=="Agenda Item")					{ $status_value = 1; }
	if ($ajax_opp_value=="Undecided")					{ $status_value = 2; }
	if ($ajax_opp_value=="Current Proposal Workload")	{ $status_value = 3; }
	if ($ajax_opp_value=="RFP Tracking")	{ $status_value = 4; }
	if ($ajax_opp_value=="Award Monitoring"){ $status_value = 5; }
	if ($ajax_opp_value=="Archived"){ $status_value = 6; }
}
//if (empty($ajax_opp_field)) { $ajax_opp_value = "eeee"; $ajax_opp_field='is_submitted'; }
//if ($ajax_opp_field=='is_submitted') { $ajax_opp_value = "1"; }
	//if ($ajax_opp_value=="1") { $ajax_opp_value = "BBBB"; } else  { $ajax_opp_value = "CCC"; }
	//if (empty($ajax_opp_value)) { $ajax_opp_value = "0"; } 
	//if ($ajax_opp_value == "1") { $ajax_opp_value = "AAA"; } else { $ajax_opp_value = "0";  }
		//$submitted2 = 0;
	//if (!empty($_GET['is_submitted'])) {  $ajax_opp_value=$_GET['is_submitted']; } 
		//if (!empty($_GET['is_submitted2'])) { $submitted2=$_GET['is_submitted2']; }


//oppid=" + idc + "&oppfield=" + thisa + "&oppvalue=" + value

//include($_SERVER['DOCUMENT_ROOT'] ."/../include/connect_db.php");
//include($_SERVER['DOCUMENT_ROOT'] ."/include/connect_db.php");

//include($_SERVER['DOCUMENT_ROOT'] ."/include/connect_db_umang.php");
//$umang_ = new MySQLi('localhost', $db_user, $db_password,'umang_opps');
//$mysqli_link = mysqli_connect('portal.ardentinc.com',$db_user, $db_password,'bidsnew');

//UPDATE excel_test SET STATUS='123' WHERE opportunity_id=1542
/*$query = "UPDATE excel_test SET $ajax_opp_field='$ajax_opp_value' WHERE opportunity_id=$ajax_opp_id";
$result = mysqli_query($mysqli_link, $query);*/
//print $query;
//STOP
/*if ($do_this_as_well==1) {
$query = "UPDATE excel_test SET status_value=$status_value WHERE opportunity_id=$ajax_opp_id";
$result = mysqli_query($mysqli_link, $query);	
}*/

if (($ajax_opp_field=='phase1')) {
$query = "UPDATE excel_test SET status_value=4, status='RFP Tracking', is_submitted='true' WHERE opportunity_id=$ajax_opp_id";
$result = mysqli_query($mysqli_link, $query);	
}

if (($ajax_opp_field=='phase2')) {
$query = "UPDATE excel_test SET status_value=5, status='Award Monitoring', is_submitted='true' WHERE opportunity_id=$ajax_opp_id";
$result = mysqli_query($mysqli_link, $query);	
}


/*if (($ajax_opp_field=='is_awarded') && (strlen($ajax_opp_value)>0)) {
$query = "UPDATE excel_test SET status_value=6, status='Archived' WHERE opportunity_id=$ajax_opp_id";
$result = mysqli_query($mysqli_link, $query);	
}*/

?>