<?php
session_start();
require_once("./includes/connect_portal123.php");
$getemail = mysqli_fetch_array(mysqli_query($mysqli_link22,"SELECT user_email FROM users WHERE user_id='".$_SESSION['user_id']."'"));
$profile_email = $getemail[0];
$secure_webpage=0;
//echo "<pre>"; print_r($_POST); exit;
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	if ($_POST['support_team'] != '') {
		$support_team = json_encode($_POST['support_team']);
	}

$ajax_opp_id = $_POST['oppid'];
$decision = $_POST['decision'];

if($_POST['criteriatype'] != ''){
	$criteriatype = addslashes($_POST['criteriatype']);
}else{
	$criteriatype = '';
}

$manager = $_POST['manager'];
$is_awarded = $_POST['is_awarded'];
$reason_bid = htmlentities(($_POST['reason_bid']));
$submission_notes = $_POST['submission_notes'];
$gaps_bidteam = $_POST['gaps_bidteam'];
$opp_status = $_POST['opp_status'];
$reqURI = $_POST['reqURI'];


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

//echo "UPDATE state_excel_test SET decision='$decision',decision_value=$new_decision_value,gaps='$gaps_bidteam',manager='$manager',
//support_team='$support_team',submission_notes='$submission_notes',is_submitted='$is_submitted',is_awarded='$is_awarded',is_archived='$is_archived',reason='$reason_bid',bid_category='$criteriatype' WHERE opportunity_id=$ajax_opp_id";
//exit;
$visitor_ip = $_SERVER['REMOTE_ADDR'];
$now = date('Y-m-d H:i:s');
if($decision != '') {
$query = mysqli_query($mysqli_link,"INSERT INTO state_history_log (history_opp_id, history_username, history_ip, history_timestamp, history_field, old_value, new_value) VALUES ($ajax_opp_id, '$profile_email', '$visitor_ip', '$now', 'decision', '', '$decision');");
}
if($manager != '') {
$query = mysqli_query($mysqli_link,"INSERT INTO state_history_log (history_opp_id, history_username, history_ip, history_timestamp, history_field, old_value, new_value) VALUES ($ajax_opp_id, '$profile_email', '$visitor_ip', '$now', 'manager', '', '$manager');");
}

if($reason_bid != '') {
$query = mysqli_query($mysqli_link,"INSERT INTO state_history_log (history_opp_id, history_username, history_ip, history_timestamp, history_field, old_value, new_value) VALUES ($ajax_opp_id, '$profile_email', '$visitor_ip', '$now', 'reason', '', '$reason_bid');");
}
if($submission_notes != '') {
$query = mysqli_query($mysqli_link,"INSERT INTO state_history_log (history_opp_id, history_username, history_ip, history_timestamp, history_field, old_value, new_value) VALUES ($ajax_opp_id, '$profile_email', '$visitor_ip', '$now', 'submission_notes', '', '$submission_notes');");
}
if($gaps_bidteam != '') {
$query = mysqli_query($mysqli_link,"INSERT INTO state_history_log (history_opp_id, history_username, history_ip, history_timestamp, history_field, old_value, new_value) VALUES ($ajax_opp_id, '$profile_email', '$visitor_ip', '$now', 'notes_datateam', '', '$gaps_bidteam');");
}
if($opp_status != '') {
$query = mysqli_query($mysqli_link,"INSERT INTO state_history_log (history_opp_id, history_username, history_ip, history_timestamp, history_field, old_value, new_value) VALUES ($ajax_opp_id, '$profile_email', '$visitor_ip', '$now', 'status', '', '$opp_status');");
}

$new_decision_value = 0;
$query_decision_value  = mysqli_query($mysqli_link,"SELECT decision_id FROM state_decision WHERE decision_name='$decision'");
$row = mysqli_fetch_array($query_decision_value, MYSQLI_NUM);

$new_decision_value = $row[0];

//$queryexcel = mysqli_query($mysqli_link,"UPDATE state_excel_test SET decision='$decision',decision_value='$new_decision_value',gaps='$gaps_bidteam',manager='$manager',submission_notes='$submission_notes',is_submitted='$is_submitted',is_awarded='$is_awarded',is_archived='$is_archived',reason='$reason_bid',vehicle_two='$criteriatype' WHERE opportunity_id=$ajax_opp_id");

$queryexcel = mysqli_query($mysqli_link,"UPDATE state_excel_test SET decision='$decision',decision_value=$new_decision_value,gaps='$gaps_bidteam',manager='$manager',
support_team='$support_team',submission_notes='$submission_notes',is_submitted='$is_submitted',is_awarded='$is_awarded',is_archived='$is_archived',reason='$reason_bid', bid_category='$criteriatype' WHERE opportunity_id=$ajax_opp_id");

if($opp_status == "Agenda Item") {
$result = mysqli_query($mysqli_link,"UPDATE state_excel_test SET status='Agenda Item', status_value='1' WHERE opportunity_id=$ajax_opp_id");
}
if($opp_status == "Current Proposal Workload") {
$result = mysqli_query($mysqli_link,"UPDATE state_excel_test SET status='Current Proposal Workload', status_value='3' WHERE opportunity_id=$ajax_opp_id");
}
if($opp_status == "Prioritize Tracking") {
$result = mysqli_query($mysqli_link,"UPDATE state_excel_test SET status='Prioritize Tracking', status_value='4', is_submitted='$is_submitted' WHERE opportunity_id=$ajax_opp_id");
}
if($opp_status == "Award Monitoring") {
$result = mysqli_query($mysqli_link,"UPDATE state_excel_test SET status='Award Monitoring', status_value='5', is_submitted='$is_submitted' WHERE opportunity_id=$ajax_opp_id");
}

if($opp_status == "Under Review") {
$result = mysqli_query($mysqli_link,"UPDATE state_excel_test SET status='Under Review', status_value='7' WHERE opportunity_id=$ajax_opp_id");
}

if(($opp_status == "Archived") OR ($_POST['is_archived']=='2')) {
$result = mysqli_query($mysqli_link,"UPDATE state_excel_test SET status='Archived', status_value='6', is_archived='true' WHERE opportunity_id=$ajax_opp_id");
}

if(($is_awarded != '') OR ($decision == 'No Bid')) {
$result = mysqli_query($mysqli_link,"UPDATE state_excel_test SET status_value=6, status='Archived',contract_vehicle_two='$criteriatype' WHERE opportunity_id=$ajax_opp_id");	
}

if($decision == 'Cancelled') {
	$result = mysqli_query($mysqli_link,"UPDATE state_excel_test SET status_value=6, status='Archived', is_archived='Cancelled' WHERE opportunity_id=$ajax_opp_id");
}
   //header("Location: $baseurl/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review");
   header("Location: {$reqURI}");
}
else
{
	header("Location: $baseurl/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review");
}
?>
