<?php
session_start();
//error_reporting(E_ALL);ini_set('display_errors', 1); 
//print_r($_POST); exit;

$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;

$currenttime = date('Y-m-d H:i:s');

$selemail = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT user_email FROM users WHERE user_id='".$_SESSION['user_id']."'"));
$profile_email = $selemail[0];

if (isset($_POST['opp_opportunity_id'])) { $opp_opportunity_id = $_POST['opp_opportunity_id']; } else { $opp_opportunity_id=""; }

if (isset($_POST['opp_response'])) { $opp_response = $_POST['opp_response']; } else { $opp_response=""; }
//if (isset($_POST['opp_requestor'])) { $opp_requestor = $_POST['opp_requestor']; } else { $opp_requestor=""; }
	//$opp_requestor= filter_var($opp_requestor, FILTER_SANITIZE_STRING);
if (isset($_POST['state'])) { $state = $_POST['state']; } else { $state=""; }
if (isset($_POST['staffing'])) { $staffing = $_POST['staffing']; } else { $staffing=""; }
if (isset($_POST['agency'])) { $deptagency = addslashes($_POST['agency']); } else { $deptagency=""; }

if (isset($_POST['certifications'])) { $certifications = $_POST['certifications']; } else { $certifications=""; }
	$certifications = filter_var($certifications, FILTER_SANITIZE_STRING);
	
if (isset($_POST['opp_title'])) { $opp_title = $_POST['opp_title']; } else { $opp_title="Title Empty"; }
	if (strlen($opp_title)<2) { $opp_title="Title Empty"; } 
	$opp_title= filter_var($opp_title, FILTER_SANITIZE_STRING);

$weburl = mysqli_real_escape_string($mysqli_link,$_POST['weburl']);
/*if (isset($_POST['opp_due'])) { $opp_due = $_POST['opp_due']; } else { $opp_due=""; }

if (isset($_POST['opp_due'])) { $opp_due = $_POST['opp_due']; } else { $opp_due = ""; }
if (!empty($opp_due)) { $phpdate = strtotime($opp_due); $opp_due = date('Y-m-d', $phpdate); } else { $opp_due = ""; }*/

if (isset($_POST['opp_released'])) { $opp_released = $_POST['opp_released']; } else { $opp_released = ""; }
if (!empty($opp_released)) { $phpdate = strtotime($opp_released); $opp_released = date('Y-m-d', $phpdate); } else { $opp_released = ""; }

if (isset($_POST['opp_award_date'])) { $opp_award_date = $_POST['opp_award_date']; } else { $opp_award_date = ""; }
if (!empty($opp_award_date)) { $awrdate = strtotime($opp_award_date); $opp_award_date = date('Y-m-d', $awrdate); } else { $opp_award_date = ""; }

if (isset($_POST['opp_rfp_date'])) { $opp_rfp_date = $_POST['opp_rfp_date']; } else { $opp_rfp_date = ""; }
if ($opp_rfp_date != "") { $phpdate = strtotime($opp_rfp_date); $opp_rfp_date = date('Y-m-d', $phpdate); } else { $opp_rfp_date = ""; }

if (isset($_POST['est_pop_start_date'])) { $est_pop_start_date = $_POST['est_pop_start_date']; } else { $est_pop_start_date = ""; }
if (!empty($est_pop_start_date)) { $phpdate = strtotime($est_pop_start_date); $est_pop_start_date = date('Y-m-d', $phpdate); } else { $est_pop_start_date = ""; }


if (isset($_POST['combined_table'])) { $contract_pop = strtoupper($_POST['combined_table']); } else { $contract_pop=""; }

if (isset($_POST['perioda'])) { $perioda = $_POST['perioda']; } else { $perioda=""; }
if (isset($_POST['periodb'])) { $periodb = $_POST['periodb']; } else { $periodb=""; }
if (isset($_POST['periodc'])) { $periodc = $_POST['periodc']; } else { $periodc=""; }
if (isset($_POST['periodd'])) { $periodd = $_POST['periodd']; } else { $periodd=""; }

if($_POST['trans_in_qty']!='') { $trans_in_qty = $_POST['trans_in_qty']; } else { $trans_in_qty=""; }
if($_POST['trans_in_time']) { $trans_in_time = $_POST['trans_in_time']; } else { $trans_in_time=""; }
if($_POST['eos_qty']!='') { $eos_qty = $_POST['eos_qty']; } else { $eos_qty=""; }
if($_POST['eos_time']) { $eos_time = $_POST['eos_time']; } else { $eos_time=""; }

$contract_period = $trans_in_qty . "#" . $trans_in_time ."#". $perioda . "#" . $periodb . "#" . $periodc . "#" . $periodd. "#".$eos_qty . "#" . $eos_time;

if (isset($_POST['opp_pricing'])) { $opp_pricing = $_POST['opp_pricing']; } else { $opp_pricing=""; }

if (isset($_POST['combined'])) { $opp_recruiting = $_POST['combined']; } else { $opp_recruiting=""; }


if (isset($_POST['opp_gaps'])) { $opp_gaps = $_POST['opp_gaps']; } else { $opp_gaps=""; }
if (isset($_POST['opp_decision'])) { $opp_decision = $_POST['opp_decision']; } else { $opp_decision=""; }
if (isset($_POST['opp_status'])) { $opp_status = $_POST['opp_status']; } else { $opp_status=""; }

//if (isset($_POST['contract_vehicle'])) { $contveh = $_POST['contract_vehicle']; } else { $contveh=""; }
if (isset($_POST['contract_vehicle']) && ($_POST['contract_vehicle'] != 'Others')) { $contveh = $_POST['contract_vehicle']; } else { $contveh=$_POST['edit_other_master_contract']; } 
if (isset($_POST['opp_vehicle_id'])) { $vehone = $_POST['opp_vehicle_id']; } else { $vehone=""; }	

if (isset($_POST['proposal_date'])) { $proposal_date = $_POST['proposal_date']; } else { $proposal_date=""; }
if (isset($_POST['proposal_time'])) { $proposal_time = $_POST['proposal_time']; } else { $proposal_time=""; }
if (isset($_POST['proposal_timezone'])) { $proposal_timezone = $_POST['proposal_timezone']; } else { $proposal_timzonee=""; }
if (isset($_POST['qa_date'])) { $qa_date = $_POST['qa_date']; } else { $qa_date=""; }
if (isset($_POST['qa_time'])) { $qa_time = $_POST['qa_time']; } else { $qa_time=""; }
if (isset($_POST['qa_timezone'])) { $qa_timezone = $_POST['qa_timezone']; } else { $qa_timezone=""; }

if (strlen($proposal_time)>1) { $proposal_time = " " . $proposal_time . ":00"; } else { $proposal_time = ""; }
if (strlen($qa_time)>1) { $qa_time = " " . $qa_time . ":00"; } else { $qa_time = ""; }
$proposal_timestamp = $proposal_date . $proposal_time;
$qa_timestamp = $qa_date . $qa_time;

if (isset($_POST['reason'])) { $reason = addslashes($_POST['reason']); } else { $reason=""; }
if (isset($_POST['manager'])) { $assign_to = $_POST['manager']; } else { $assign_to=""; }
if (isset($_POST['gaps_datateam'])) { $gaps_datateam = htmlentities($_POST['gaps_datateam']); } else { $gaps_datateam=""; }
	//$gaps_datateam= filter_var($gaps_datateam, FILTER_SANITIZE_STRING);
if (isset($_POST['notes_datateam'])) { $notes_datateam = htmlentities($_POST['notes_datateam']); } else { $notes_datateam=""; }
	//$notes_datateam= filter_var($notes_datateam, FILTER_SANITIZE_STRING);
if (isset($_POST['pricing_eval'])) { $pricing_eval = $_POST['pricing_eval']; } else { $pricing_eval=""; }

if (isset($_POST['edit_bid_category'])) { $bid_category = $_POST['edit_bid_category']; } else { $bid_category=""; }
if (isset($_POST['edit_est_actual'])) { $est_actual = $_POST['edit_est_actual']; } else { $est_actual=""; }

if (isset($_POST['edit_intension'])) { $edit_intent_to_bid = $_POST['edit_intension']; } else {$edit_intent_to_bid = '';}
if (isset($_POST['edit_intent_bid_date'])) { $edit_intent_bid_date = $_POST['edit_intent_bid_date']; } else{$edit_intent_bid_date = strtotime('Y-m-d',0);}
// DB Code To Add Submission Mode Starts Here.
if (isset($_POST['edit_submission_mode'])) { $submission_mode = json_encode($_POST['edit_submission_mode']); } else { $submission_mode=""; }
// DB Code To Add Submission Mode Ends Here.
if (isset($_POST['edit_pp_conference'])) { $pp_conference = $_POST['edit_pp_conference']; } else { $pp_conference = ""; }
if (isset($_POST['edit_mandatory'])) { $pp_edit_mandatory = $_POST['edit_mandatory']; } else {$pp_edit_mandatory = "";}
if (isset($_POST['edit_pp_conference_date'])) { $pp_conference_date = $_POST['edit_pp_conference_date']; } else { $pp_conference_date = ""; }
if (isset($_POST['edit_pp_conf_time'])) { $edit_pp_conf_time = $_POST['edit_pp_conf_time']; } else { $edit_pp_conf_time = ""; }
if (isset($_POST['edit_pp_conf_timezone'])) { $edit_pp_conf_timezone = $_POST['edit_pp_conf_timezone']; } else { $edit_pp_conf_timezone = ""; }
$ppConferenceDateTime = $pp_conference_date." ".$edit_pp_conf_time;

$update_reason = "Update --- ".$_POST['update_reason'];


$qry1 = mysqli_query($mysqli_link,"UPDATE state_excel_test SET web_url='$weburl', contract_vehicle='$contveh', vehicle_one='$vehone', vehicle_two='$assign_to', contractveh_table='$deptagency', response='$opp_response', agency='$state', subagency='$staffing', title='$opp_title',  contract_pop='$contract_pop', contract_pop2='', contract_period='$contract_period', pricing='$opp_pricing', recruiting='$opp_recruiting', gaps='$opp_gaps', reason='$reason', qa_timezone='$qa_timezone', proposal_timezone='$proposal_timezone', pricing_eval='$pricing_eval', certifications='$certifications', est_actual='$est_actual', bid_category='$bid_category', intent_to_bid='$edit_intent_to_bid', submission_mode='$submission_mode', pp_conference='$pp_conference', pp_mandatory='$pp_edit_mandatory', pp_conference_timezone='$edit_pp_conf_timezone' WHERE opportunity_id = $opp_opportunity_id") or die(mysqli_error($mysqli_link));


//DATES
$qry2 = mysqli_query($mysqli_link,"UPDATE state_excel_test SET 
released = IF('$opp_released' = '', NULL, '$opp_released'), 
proposal_due = IF('$proposal_timestamp' = '', NULL, '$proposal_timestamp'), 
qa_due = IF('$qa_timestamp' = '', NULL, '$qa_timestamp'), 
award_date = IF('$opp_award_date' = '', NULL, '$opp_award_date'), 
rfp_date = IF('$opp_rfp_date' = '', NULL, '$opp_rfp_date'), 
est_pop_start_date = IF('$est_pop_start_date' = '', NULL, '$est_pop_start_date'),
intent_bid_date = IF('$edit_intent_bid_date' = '', NULL, '$edit_intent_bid_date'),
pp_conference_date = IF('$ppConferenceDateTime' = '', NULL, '$ppConferenceDateTime')
WHERE opportunity_id=$opp_opportunity_id") or die(mysqli_error($mysqli_link));

$opp_synopsis_sanitized = htmlentities($_POST['opp_synopsis']);
$opp_proposal_sanitized = htmlentities($_POST['opp_proposal']);
$gaps_datateam_sanitized = htmlentities($_POST['gaps_datateam']);
$notes_datateam_sanitized = htmlentities($_POST['notes_datateam']);

$opp_synopsis = $mysqli_link->real_escape_string($opp_synopsis_sanitized);
$opp_proposal = $mysqli_link->real_escape_string($opp_proposal_sanitized);
$gaps_datateam = $mysqli_link->real_escape_string($gaps_datateam_sanitized);
$notes_datateam = $mysqli_link->real_escape_string($notes_datateam_sanitized);

//GOOD BELOW
$query = "UPDATE state_excel_test SET synopsis='$opp_synopsis', proposal='$opp_proposal', gaps_datateam='$gaps_datateam', notes_datateam='$notes_datateam' WHERE opportunity_id=$opp_opportunity_id"; 
$result = mysqli_query($mysqli_link, $query);

//INSERT INTO HISTORY LOG
$visitor_ip = $_SERVER['REMOTE_ADDR'];

$query = "INSERT INTO state_history_log (history_opp_id, history_username, history_ip, history_field, old_value, new_value,history_timestamp) VALUES ($opp_opportunity_id, '$profile_email', '$visitor_ip', '$update_reason', 'New Content', '$opp_title','$currenttime');";
$result = mysqli_query($mysqli_link, $query);

if($opp_status != '') {
mysqli_query($mysqli_link,"INSERT INTO state_last_updatedby (opportunity_id,status,updated_by,upd_datetime) VALUES ('$opp_opportunity_id','$opp_status','".$_SESSION['user_id']."','$currenttime')");
}

if($opp_status == 'Agenda Item') {
mysqli_query($mysqli_link,"UPDATE state_excel_test SET decision='',decision_value='0',is_archived='NULL',`status`='Agenda Item', status_value='1' WHERE opportunity_id = $opp_opportunity_id");
}
else if($opp_status == 'Under Review')
{
mysqli_query($mysqli_link,"UPDATE state_excel_test SET decision='Review',decision_value='6',is_archived='NULL',`status`='Under Review', status_value='7' WHERE opportunity_id = $opp_opportunity_id");
}
else if($opp_status == 'Current Proposal Workload')
{
mysqli_query($mysqli_link,"UPDATE state_excel_test SET decision='Bid',decision_value='3',is_archived='NULL',`status`='Current Proposal Workload', status_value='3' WHERE opportunity_id = $opp_opportunity_id");
}
else if($opp_status == 'Prioritize Tracking')
{
mysqli_query($mysqli_link,"UPDATE state_excel_test SET decision='Bid',decision_value='3',is_archived='NULL',`status`='Prioritize Tracking', status_value='4' WHERE opportunity_id = $opp_opportunity_id");
}
else if($opp_status == 'Award Monitoring')
{
mysqli_query($mysqli_link,"UPDATE state_excel_test SET decision='Bid',decision_value='3',is_archived='NULL',`status`='Award Monitoring', status_value='5' WHERE opportunity_id = $opp_opportunity_id");
}
else if($opp_status == 'Archived')
{
mysqli_query($mysqli_link,"UPDATE state_excel_test SET decision='No Bid',decision_value='4',is_archived='NULL',`status`='Archived', status_value='6' WHERE opportunity_id = $opp_opportunity_id");
}

print("<script>window.top.location.href = \"$baseurl/addrole_update_opportunities.php?which_update_id=$opp_opportunity_id\";</script>");
?>