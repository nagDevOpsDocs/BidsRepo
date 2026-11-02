<?php
session_start();
//ini_set('display_errors', '1'); error_reporting(E_ALL);
$this_page_name="AJAX OPPORTUNITY UPDATE";
require_once("./includes/connect_portal123.php");
//date_default_timezone_set('US/Eastern');

$getemail = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT user_email FROM users WHERE user_id='".$_SESSION['user_id']."'"));

$get_decision = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT response FROM excel_test WHERE opportunity_id=".$_POST['oppid']));


$profile_email = $getemail[0];
$secure_webpage=0;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
//echo "<pre>"; 
//print_r($_POST);
//exit;
/*	if($_POST['managers'] != ''){
		$managersCount = count($_POST['managers']);
		for($i=0;$i<$managersCount;$i++){
			if($i != ($managersCount-1)){
				$managers .= $_POST['managers'][$i].'-';
			}else{
				$managers .= $_POST['managers'][$i];
			}
		}
		$managerName = json_encode($managers);
	}elseif($_POST['manager'] != ''){
		$managerName = $_POST['manager'];
	}

if ($_POST['managers'] != '') {
	$managers = json_encode($_POST['managers']);
}
elseif($_POST['manager'] != ''){
	$managers = $_POST['manager'];
} */

if ($_POST['support_managers'] != '') {
	$support_managers = json_encode($_POST['support_managers']);
}
if($_POST['manager'] != ''){
	$manager = $_POST['manager'];
}

$ajax_opp_id	= $_POST['oppid'];
$decision		= $_POST['decision'];
$manager		= $manager;          //$_POST['manager'];
$support_managers = $support_managers;
$is_awarded		= $_POST['is_awarded'];
$reason_bid		=  addslashes($_POST['reason_bid']);
$submission_notes= addslashes($_POST['submission_notes']);
$gaps_bidteam	= addslashes($_POST['gaps_bidteam']);
$opp_status		= $_POST['opp_status'];
$business_entity= $_POST['business_entity'];

if($_POST['is_submitted']=='1')
{
	$is_submitted = 'true';
}
else
{
	$is_submitted = '';
}

if($_POST['is_archived']=='2')
{
	$is_archived = 'true';
}
else
{
	$is_archived = '';
}

$visitor_ip = $_SERVER['REMOTE_ADDR'];
$now = date('Y-m-d H:i:s');
if($decision != '') {
$query = mysqli_query($mysqli_link,"INSERT INTO history_log (history_opp_id, history_username, history_ip, history_timestamp, history_field, old_value, new_value) VALUES ($ajax_opp_id, '$profile_email', '$visitor_ip', '$now', 'decision', '', '$decision');");
}
if($manager != '') {
$query = mysqli_query($mysqli_link,"INSERT INTO history_log (history_opp_id, history_username, history_ip, history_timestamp, history_field, old_value, new_value) VALUES ($ajax_opp_id, '$profile_email', '$visitor_ip', '$now', 'manager', '', '$manager');");
}

if($reason_bid != '') {
$query = mysqli_query($mysqli_link,"INSERT INTO history_log (history_opp_id, history_username, history_ip, history_timestamp, history_field, old_value, new_value) VALUES ($ajax_opp_id, '$profile_email', '$visitor_ip', '$now', 'reason', '', '$reason_bid');");
}
if($submission_notes != '') {
$query = mysqli_query($mysqli_link,"INSERT INTO history_log (history_opp_id, history_username, history_ip, history_timestamp, history_field, old_value, new_value) VALUES ($ajax_opp_id, '$profile_email', '$visitor_ip', '$now', 'submission_notes', '', '$submission_notes');");
}
if($gaps_bidteam != '') {
$query = mysqli_query($mysqli_link,"INSERT INTO history_log (history_opp_id, history_username, history_ip, history_timestamp, history_field, old_value, new_value) VALUES ($ajax_opp_id, '$profile_email', '$visitor_ip', '$now', 'notes_datateam', '', '$gaps_bidteam');");
}
if($opp_status != '') {
$query = mysqli_query($mysqli_link,"INSERT INTO history_log (history_opp_id, history_username, history_ip, history_timestamp, history_field, old_value, new_value) VALUES ($ajax_opp_id, '$profile_email', '$visitor_ip', '$now', 'status', '', '$opp_status');");
}

$new_decision_value = 0;
$query_decision_value  = mysqli_query($mysqli_link,"SELECT decision_level_id FROM decision_levels WHERE decision_level_name='$decision'");
$row = mysqli_fetch_array($query_decision_value, MYSQLI_NUM);
$new_decision_value = $row[0];

$queryexcel = "UPDATE excel_test SET decision='$decision', decision_value='$new_decision_value', gaps='$gaps_bidteam', manager='$manager', support_managers='$support_managers', submission_notes='$submission_notes', is_submitted='$is_submitted', business_entity='$business_entity', is_awarded='$is_awarded', is_archived='$is_archived', reason='$reason_bid' WHERE opportunity_id=$ajax_opp_id";

$result2 = mysqli_query($mysqli_link, $queryexcel);
//STOP

//mail functionality to send manager
//$mngr_email  = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT manager_name,manager_email FROM managers WHERE manager_name='".$manager."'"));

if($opp_status == "Agenda Item") {
$result = mysqli_query($mysqli_link,"UPDATE excel_test SET status='Agenda Item', status_value='1' WHERE opportunity_id=$ajax_opp_id");
}
if($opp_status == "Current Proposal Workload") {
$result = mysqli_query($mysqli_link,"UPDATE excel_test SET status='Current Proposal Workload', status_value='3' WHERE opportunity_id=$ajax_opp_id");
}
if($opp_status == "RFP Tracking") {
$result = mysqli_query($mysqli_link,"UPDATE excel_test SET status='RFP Tracking', status_value='4', is_submitted='$is_submitted' WHERE opportunity_id=$ajax_opp_id");
}
if($opp_status == "Award Monitoring") {
$result = mysqli_query($mysqli_link,"UPDATE excel_test SET status='Award Monitoring', status_value='5', is_submitted='$is_submitted' WHERE opportunity_id=$ajax_opp_id");
}

if($opp_status == "Under Review") {
$result = mysqli_query($mysqli_link,"UPDATE excel_test SET status='Under Review', status_value='7' WHERE opportunity_id=$ajax_opp_id");
}

if(($opp_status == "Archived") OR ($_POST['is_archived']=='2')) {
$result = mysqli_query($mysqli_link,"UPDATE excel_test SET status='Archived', status_value='6', is_archived='true' WHERE opportunity_id=$ajax_opp_id");
}

if(($is_awarded != '') OR ($decision == 'No Bid')) {
$result = mysqli_query($mysqli_link,"UPDATE excel_test SET status_value=6, status='Archived' WHERE opportunity_id=$ajax_opp_id");	
}

if($decision == 'Cancelled') {
	$result = mysqli_query($mysqli_link,"UPDATE excel_test SET status_value=6, status='Archived', is_archived='Cancelled' WHERE opportunity_id=$ajax_opp_id");
}
// Added this for Decision Pending Code.
if($decision == 'Decision Pending') {
	$result = mysqli_query($mysqli_link,"UPDATE excel_test SET status_value='8', status='Decision Pending' WHERE opportunity_id=$ajax_opp_id");
} 
// Ends Here.

   header("Location: $baseurl/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review");
}
else
{
	header("Location: $baseurl/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review");
}
?>
