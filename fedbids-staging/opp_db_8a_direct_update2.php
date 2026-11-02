<?php
session_start();
//echo "<pre>";print_r($_POST);exit;
//ini_set('display_errors', '1'); error_reporting(E_ALL);
$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;
$currenttime = date('Y-m-d H:i:s');
$selemail = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT user_email FROM users WHERE user_id='$_SESSION[user_id]'"));
$profile_email = $selemail[0];

if (isset($_POST['opp_opportunity_id'])) { $opp_opportunity_id = $_POST['opp_opportunity_id']; } else { $opp_opportunity_id=""; }

if (isset($_POST['opp_response'])) { $opp_response = $_POST['opp_response']; } else { $opp_response=""; }
if (isset($_POST['opp_requestor'])) { $opp_requestor = $_POST['opp_requestor']; } else { $opp_requestor=""; }
	$opp_requestor= filter_var($opp_requestor, FILTER_SANITIZE_STRING);
if (isset($_POST['agency'])) { $agency = $_POST['agency']; } else { $agency=""; }
	$agency= filter_var($agency, FILTER_SANITIZE_STRING);
if (isset($_POST['subagency'])) { $subagency = $_POST['subagency']; } else { $subagency=""; }
	$subagency = filter_var($subagency, FILTER_SANITIZE_STRING);

if (isset($_POST['certifications'])) { $certifications = $_POST['certifications']; } else { $certifications=""; }
	$certifications = filter_var($certifications, FILTER_SANITIZE_STRING);
//if (isset($_POST['opportunity_link'])) { $opportunity_link = $_POST['opportunity_link']; } else { $opportunity_link=""; }	
//if (isset($_POST['sharepoint_link'])) { $sharepoint_link = $_POST['sharepoint_link']; } else { $sharepoint_link=""; }	
if (isset($_POST['solicitation_docs'])) { $solicitation_docs = $_POST['solicitation_docs']; } else { $solicitation_docs=""; }	
if (isset($_POST['opp_title'])) { $opp_title = $_POST['opp_title']; } else { $opp_title="Title Empty"; }
	if (strlen($opp_title)<2) { $opp_title="Title Empty"; } 
	$opp_title= filter_var($opp_title, FILTER_SANITIZE_STRING);
//if (isset($_POST['opp_due'])) { $opp_due = $_POST['opp_due']; } else { $opp_due=""; }

if (isset($_POST['opp_due'])) { $opp_due = $_POST['opp_due']; } else { $opp_due = ""; }
if (!empty($opp_due)) { $phpdate = strtotime($opp_due); $opp_due = date('Y-m-d', $phpdate); } else { $opp_due = ""; }

if (isset($_POST['opp_released'])) { $opp_released = $_POST['opp_released']; } else { $opp_released = ""; }
//if (!empty($opp_released)) { $phpdate = strtotime($opp_released); $opp_released = date('Y-m-d', $phpdate); } else { $opp_released = ""; }

if (isset($_POST['opp_award_date'])) { $opp_award_date = $_POST['opp_award_date']; } else { $opp_award_date = ""; }
if (!empty($opp_award_date)) { $phpdate = strtotime($opp_award_date); $opp_award_date = date('Y-m-d', $phpdate); } else { $opp_award_date = ""; }

if (isset($_POST['opp_rfp_date'])) { $opp_rfp_date = $_POST['opp_rfp_date']; } else { $opp_rfp_date = ""; }
if (!empty($opp_rfp_date)) { $phpdate = strtotime($opp_rfp_date); $opp_rfp_date = date('Y-m-d', $phpdate); } else { $opp_rfp_date = ""; }

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

if(isset($_POST['contractveh_table'])) 
{	//print_r($_POST['contractveh_table']);
	$contractveh = $_POST['contractveh_table'];
	$getrow = explode("|||",$contractveh);
	
	//echo "<pre>";
	//print_r($getrow);
	//exit;

	$j = 0;

	
//	while($i<(count($getrow)-1)){
		$temp = explode("+",$getrow[$j+1]);
//		print_r($temp);
		if($temp[1] != ''){
			$set_aside = $temp[1];
		}
//		$i = $i+2;
//	}

//echo "First Set Aside value Is :: ".$set_aside;
//exit;
	$contveh = $getrow[0];
//	$vehone = $getrow[1];
	if(empty($getrow[2]))
	{
		$contveh2 = '';
		$vehtwo   = '';
	}
	else
	{
		$contveh2 = $getrow[2];
		$vehtwo	  = $getrow[3];
	}
} 
else 
{ 
	$contractveh = ''; 
	$contveh = '';
	$vehone = '';
	$contveh2 = '';
	$vehtwo = '';
	$set_aside = '';
}

if (isset($_POST['opp_gaps'])) { $opp_gaps = $_POST['opp_gaps']; } else { $opp_gaps=""; }
if (isset($_POST['opp_decision'])) { $opp_decision = $_POST['opp_decision']; } else { $opp_decision=""; }
if (isset($_POST['opp_status'])) { $opp_status = $_POST['opp_status']; } else { $opp_status=""; }

if (isset($_POST['facility'])) { $facility = $_POST['facility']; } else { $facility=""; }	
if (isset($_POST['clearance_level'])) { $clearance_level = $_POST['clearance_level']; } else { $clearance_level=""; }	

if (isset($_POST['proposal_date'])) { $proposal_date = $_POST['proposal_date']; } else { $proposal_date=""; }
if (isset($_POST['proposal_time'])) { $proposal_time = $_POST['proposal_time']; } else { $proposal_time=""; }
if (isset($_POST['proposal_timezone'])) { $proposal_timezone = $_POST['proposal_timezone']; } else { $proposal_timzonee=""; }
if (isset($_POST['qa_date'])) { $qa_date = $_POST['qa_date']; } else { $qa_date=""; }
if (isset($_POST['qa_time'])) { $qa_time = $_POST['qa_time']; } else { $qa_time=""; }
if (isset($_POST['qa_timezone'])) { $qa_timezone = $_POST['qa_timezone']; } else { $qa_timzone=""; }

if (strlen($proposal_time)>1) { $proposal_time = " " . $proposal_time . ":00"; } else { $proposal_time = ""; }
if (strlen($qa_time)>1) { $qa_time = " " . $qa_time . ":00"; } else { $qa_time = ""; }
$proposal_timestamp = $proposal_date . $proposal_time;
$qa_timestamp = $qa_date . $qa_time;

if (isset($_POST['reason'])) { $reason = $_POST['reason']; } else { $reason=""; }
if (isset($_POST['manager'])) { $manager = $_POST['manager']; } else { $manager=""; }
if (isset($_POST['gaps_datateam'])) { $gaps_datateam = htmlentities($_POST['gaps_datateam']); } else { $gaps_datateam=""; }
	//$gaps_datateam= filter_var($gaps_datateam, FILTER_SANITIZE_STRING);
if (isset($_POST['notes_datateam'])) { $notes_datateam = htmlentities($_POST['notes_datateam']); } else { $notes_datateam=""; }
	//$notes_datateam= filter_var($notes_datateam, FILTER_SANITIZE_STRING);
if (isset($_POST['pricing_eval'])) { $pricing_eval = $_POST['pricing_eval']; } else { $pricing_eval=""; }
// code to add Domains & NAICS  Code Starts Here.
if (isset($_POST['domains'])) { $domain_values = json_encode($_POST['domains']); } else{$domains="";}
if (isset($_POST['edit_naics_code'])) { $naics_code = $_POST['edit_naics_code']; } else { $naics_code=""; }
// code to add Domains & NAICS  Code Ends Here.

// Code to add previous Docs Starts Here.
if (isset($_POST['prev_release_docs'])) { $previous_releases = $_POST['prev_release_docs']; } else { $previous_releases=""; }
// Code to add previous Docs Ends Here.
//Code to add Addendum Starts Here.
if (isset($_POST['addendum'])) { $addendum = $_POST['addendum']; } else { $addendum=0; }
//Code to add Addendum Ends Here.

if(isset($_POST['agenda_show_status'])) { $agenda_show_status = $_POST['agenda_show_status']; } else { $agenda_show_status=0; }
//Show bid in Agenda item section or not.

if(isset($_POST['edit_size_standard'])) { $size_standard = $_POST['edit_size_standard']; } else { $size_standard = ""; }

if (isset($_POST['edit_ron_cp_date'])) { $ron_cp_date = $_POST['edit_ron_cp_date']; } else { $ron_cp_date = ""; }	
if (isset($_POST['edit_tyler_cp_date'])) { $tyler_cp_date = $_POST['edit_tyler_cp_date']; } else { $tyler_cp_date = ""; }	
if (isset($_POST['edit_team_cp_date'])) { $team_cp_date = $_POST['edit_team_cp_date']; } else { $team_cp_date = ""; }	
if (isset($_POST['edit_urls'])) { $urls = $_POST['edit_urls']; } else { $urls = ""; }	


if (isset($_POST['edit_foia_req_sub_box'])) { $foia_req_sub_box = $_POST['edit_foia_req_sub_box']; } else { $foia_req_sub_box = 0; }	
if (isset($_POST['edit_foia_info_receiv_box'])) { $foia_info_receiv_box = $_POST['edit_foia_info_receiv_box']; } else { $foia_info_receiv_box = 0; }	
if (isset($_POST['edit_foia_req_sub_date'])) { $foia_req_sub_date = $_POST['edit_foia_req_sub_date']; } else { $foia_req_sub_date = ""; }	
if (isset($_POST['edit_foia_info_receiv_date'])) { $foia_info_receiv_date = $_POST['edit_foia_info_receiv_date']; } else { $foia_info_receiv_date = ""; }


$qry1 = mysqli_query($mysqli_link,"UPDATE excel_test SET vehicle_one='$vehone', vehicle_two='$vehtwo', contract_vehicle='$contveh', contract_vehicle_two='$contveh2', response='$opp_response', requestor='$opp_requestor', agency='$agency', subagency='$subagency', title='$opp_title', due='$opp_due', contract_pop='$contract_pop', contract_pop2='', contract_period='$contract_period', pricing='$opp_pricing', recruiting='$opp_recruiting', gaps='$opp_gaps', contractveh_table='$contractveh', facility='$facility', clearance_level='$clearance_level', reason='$reason', manager='$manager', qa_timezone='$qa_timezone', proposal_timezone='$proposal_timezone', pricing_eval='$pricing_eval', certifications='$certifications', solicitation_docs='$solicitation_docs', domains='$domain_values', naics_code='$naics_code', previous_releases='$previous_releases', is_addendum=$addendum, set_aside='$set_aside', dont_show_agenda=$agenda_show_status, size_standard='$size_standard', bid_category='8a_direct', urls='$urls', foia_req_submitted=$foia_req_sub_box, foia_info_received=$foia_info_receiv_box WHERE opportunity_id = $opp_opportunity_id") or die(mysqli_error($mysqli_link));
//DATES
$qry2 = mysqli_query($mysqli_link,"UPDATE excel_test SET 
released = IF('$opp_released' = '', NULL, '$opp_released'), 
proposal_due = IF('$proposal_timestamp' = '', NULL, '$proposal_timestamp'), 
qa_due = IF('$qa_timestamp' = '', NULL, '$qa_timestamp'), 
award_date = IF('$opp_award_date' = '', NULL, '$opp_award_date'), 
rfp_date = IF('$opp_rfp_date' = '', NULL, '$opp_rfp_date'), 
est_pop_start_date = IF('$est_pop_start_date' = '', NULL, '$est_pop_start_date'),
ron_cp_date = IF('$ron_cp_date' = '', NULL, '$ron_cp_date'),
tyler_cp_date = IF('$tyler_cp_date' = '', NULL, '$tyler_cp_date'),
team_cp_date = IF('$team_cp_date' = '', NULL, '$team_cp_date'),
foia_req_submitted_date = IF('$foia_req_sub_date' = '', NULL, '$foia_req_sub_date'),
foia_info_received_date = IF('$foia_info_receiv_date' = '', NULL, '$foia_info_receiv_date')
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
$query = "UPDATE excel_test SET synopsis='$opp_synopsis', proposal='$opp_proposal', gaps_datateam='$gaps_datateam', notes_datateam='$notes_datateam' WHERE opportunity_id=$opp_opportunity_id"; 
$result = mysqli_query($mysqli_link, $query);

//INSERT INTO HISTORY LOG
$visitor_ip = $_SERVER['REMOTE_ADDR'];

$query = "INSERT INTO history_log (history_opp_id, history_username, history_ip, history_field, old_value, new_value,history_timestamp) VALUES ($opp_opportunity_id, '$profile_email', '$visitor_ip', 'Update', 'New Content', '$opp_title','$currenttime');";
$result = mysqli_query($mysqli_link, $query);

if($opp_status != '') {
mysqli_query($mysqli_link,"INSERT INTO last_updatedby (opportunity_id,status,updated_by,upd_datetime) VALUES ('$opp_opportunity_id','$opp_status','".$_SESSION['user_id']."','$currenttime')");
} 

if($opp_status == 'Agenda Item') {
mysqli_query($mysqli_link,"UPDATE excel_test SET decision='',decision_value='0',is_archived='NULL',`status`='Agenda Item', status_value='1' WHERE opportunity_id = $opp_opportunity_id");
}
else if($opp_status == 'Under Review')
{
mysqli_query($mysqli_link,"UPDATE excel_test SET decision='Review',decision_value='6',is_archived='NULL',`status`='Under Review', status_value='7' WHERE opportunity_id = $opp_opportunity_id");
}
else if($opp_status == 'Current Proposal Workload')
{
mysqli_query($mysqli_link,"UPDATE excel_test SET decision='Bid',decision_value='3',is_archived='NULL',`status`='Current Proposal Workload', status_value='3' WHERE opportunity_id = $opp_opportunity_id");
}
else if($opp_status == 'RFP Tracking')
{
mysqli_query($mysqli_link,"UPDATE excel_test SET decision='Bid',decision_value='3',is_archived='NULL',`status`='RFP Tracking', status_value='4' WHERE opportunity_id = $opp_opportunity_id");
}
else if($opp_status == 'Award Monitoring')
{
mysqli_query($mysqli_link,"UPDATE excel_test SET decision='Bid',decision_value='3',is_archived='NULL',`status`='Award Monitoring', status_value='5' WHERE opportunity_id = $opp_opportunity_id");
}
else if($opp_status == 'Archived')
{
mysqli_query($mysqli_link,"UPDATE excel_test SET decision='No Bid',decision_value='4',is_archived='NULL',`status`='Archived', status_value='6' WHERE opportunity_id = $opp_opportunity_id");
}

print("<script>window.top.location.href = \"$baseurl/addrole_8a_direct_update_opportunities.php?which_update_id=$opp_opportunity_id\";</script>");
?>