<?php
session_start();
//ini_set('display_errors', 1); error_reporting(E_ALL);
//echo "<pre>";print_r($_POST);//exit;  
$referer = $_SERVER['HTTP_REFERER'];
$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;

include_once("../PHPMailer/src/Exception.php");
include_once("../PHPMailer/src/PHPMailer.php");
include_once("../PHPMailer/src/SMTP.php");
include_once("../PHPMailer/PHPMailerAutoload.php");

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

$selemail = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT user_email,firstname FROM users WHERE user_id='".$_SESSION['user_id']."'"));
$profile_email = $selemail[0];
$addedby	   = $selemail[1];
$user_id = $_SESSION['user_id'];
//echo "Added By Value Is :: ".$user_id; exit;
if (isset($_POST['opp_opportunity_id'])) { $opp_opportunity_id = $_POST['opp_opportunity_id']; } else { $opp_opportunity_id=""; }

if(isset($_POST['manager'])) { $assign_to = $_POST['manager']; } else { $assign_to=""; }

if (isset($_POST['opp_vehicle_one'])) { $vehone = $_POST['opp_vehicle_one']; } else { $vehone=""; } 
if (isset($_POST['contract_vehicle']) && ($_POST['contract_vehicle'] != 'Others')) { $contveh = $_POST['contract_vehicle']; } else { $contveh=$_POST['other_master_contract']; } 
if (isset($_POST['state'])) { $state = $_POST['state']; } else { $state=""; } 

$other_mc = $_POST['other_master_contract'];

if (isset($_POST['opp_response'])) { $opp_response = $_POST['opp_response']; } else { $opp_response=""; }
	$opp_response= filter_var($opp_response, FILTER_SANITIZE_SPECIAL_CHARS);
if($_POST['staffing']=='Staffing') 
{ $staffing = 'Staffing'; } 
elseif($_POST['staffing']=='Project')  
{ $staffing = 'Project'; }

if (isset($_POST['opp_title'])) { $opp_title = $_POST['opp_title']; } else { $opp_title=""; }
	$opp_title= filter_var($opp_title, FILTER_SANITIZE_SPECIAL_CHARS);
	$extra_quotes = array("'", "\"");
	$opp_title = str_replace($extra_quotes, "", $opp_title);

$weburl = mysqli_real_escape_string($mysqli_link,$_POST['weburl']);

if (isset($_POST['opp_due'])) { $opp_due = $_POST['opp_due']; } else { $opp_due=""; }
	$opp_due= filter_var($opp_due, FILTER_SANITIZE_SPECIAL_CHARS);

// DB Code To Add Submission Mode Starts Here.
if (isset($_POST['submission_mode'])) { $submission_mode = json_encode($_POST['submission_mode']); } else { $submission_mode=""; }
// DB Code To Add Submission Mode Ends Here.

if (isset($_POST['opp_released'])) { $opp_released = $_POST['opp_released']; } else { $opp_released=""; }
//$opp_released = date( 'm/d/Y', $opp_released ); 
//$phpdate = strtotime( $opp_released );
//$opp_released = date( 'Y-m-d', $phpdate );

if (isset($_POST['certifications'])) { $certifications = $_POST['certifications']; } else { $certifications=""; }
	$certifications= filter_var($certifications, FILTER_SANITIZE_SPECIAL_CHARS);

if (empty($_POST['opp_award_date'])) {
    $opp_award_date = null;
} else {
    $phpdate = strtotime($_POST['opp_award_date']);
    $opp_award_date = date('Y-m-d', $phpdate);
}

if (empty($_POST['opp_rfp_date'])) {
    $opp_rfp_date = null;
} else {
    $phpdate = strtotime($_POST['opp_rfp_date']);
    $opp_rfp_date = date('Y-m-d', $phpdate);
}


if (empty($_POST['est_pop_start_date'])) {
    $est_pop_start_date = null;
} else {
    $phpdate = strtotime($_POST['est_pop_start_date']);
    $est_pop_start_date = date('Y-m-d', $phpdate);
}

if (isset($_POST['opp_pop'])) { $opp_pop = $_POST['opp_pop']; } else { $opp_pop=""; }
	$opp_pop= filter_var($opp_pop, FILTER_SANITIZE_SPECIAL_CHARS);

if (isset($_POST['opp_pricing'])) { $opp_pricing = $_POST['opp_pricing']; } else { $opp_pricing=""; }

if (isset($_POST['combined_table'])) { $contract_pop = strtoupper($_POST['combined_table']); } else { $contract_pop=""; }

if (isset($_POST['perioda'])) { $perioda = $_POST['perioda']; } else { $perioda=""; }
if (isset($_POST['periodb'])) { $periodb = $_POST['periodb']; } else { $periodb=""; }
if (isset($_POST['periodc'])) { $periodc = $_POST['periodc']; } else { $periodc=""; }
if (isset($_POST['periodd'])) { $periodd = $_POST['periodd']; } else { $periodd=""; }

if (isset($_POST['combined'])) { $opp_recruiting = $_POST['combined']; } else { $opp_recruiting=""; }

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

if (isset($_POST['pricing_eval'])) { $pricing_eval = $_POST['pricing_eval']; } else { $pricing_eval=""; }

if (strlen($opp_title)<3) { $opp_title="Title Empty"; }

if($_POST['trans_in_qty']!='') { $trans_in_qty = $_POST['trans_in_qty']; } else { $trans_in_qty=""; }
if($_POST['trans_in_time']) { $trans_in_time = $_POST['trans_in_time']; } else { $trans_in_time=""; }
if($_POST['eos_qty']!='') { $eos_qty = $_POST['eos_qty']; } else { $eos_qty=""; }
if($_POST['eos_time']) { $eos_time = $_POST['eos_time']; } else { $eos_time=""; }

$contract_period = $trans_in_qty . "#" . $trans_in_time ."#". $perioda . "#" . $periodb . "#" . $periodc . "#" . $periodd. "#".$eos_qty . "#" . $eos_time;

if (isset($_POST['opp_gaps'])) { $opp_gaps = $_POST['opp_gaps']; } else { $opp_gaps=""; }

if (isset($_POST['agency'])) { $deptagency = addslashes($_POST['agency']); } else { $deptagency="";}
//if (isset($_POST['facility'])) { $facility = $_POST['facility']; } else { $facility=""; }	
if (isset($_POST['gaps_datateam'])) { $gaps_datateam = $_POST['gaps_datateam']; } else { $gaps_datateam=""; }
	$gaps_datateam= filter_var($gaps_datateam, FILTER_SANITIZE_SPECIAL_CHARS);	
if (isset($_POST['notes_datateam'])) { $notes_datateam = $_POST['notes_datateam']; } else { $notes_datateam=""; }
	$notes_datateam= filter_var($notes_datateam, FILTER_SANITIZE_SPECIAL_CHARS);

if (isset($_POST['bid_category'])) { $bid_category = $_POST['bid_category']; } else {$bid_category = '';}
if (isset($_POST['priority'])) { $priority = $_POST['priority']; } else {$priority = '';}
if (isset($_POST['est_actual'])) { $est_actual = $_POST['est_actual']; } else {$est_actual = '';}

if (isset($_POST['intension'])) { $intent_to_bid = $_POST['intension']; } else {$intent_to_bid = '';}
if (isset($_POST['intent_bid_date'])) { $intent_bid_date = $_POST['intent_bid_date']; } else {$intent_bid_date = '';}

if (isset($_POST['pp_conference'])) { $pp_conference = $_POST['pp_conference']; } else {$pp_conference = '';}
if (isset($_POST['mandatory'])) { $mandatory = $_POST['mandatory']; } else {$mandatory = '';}
if (isset($_POST['pp_conference_date'])) { $pp_conference_date = $_POST['pp_conference_date']; } else {$pp_conference_date = '';}
if (isset($_POST['pp_conf_time'])) { $pp_conf_time = $_POST['pp_conf_time']; } else {$pp_conf_time = '';}
if (strlen($pp_conf_time)>1) { $pp_conf_time = " " . $pp_conf_time . ":00"; } else { $pp_conf_time = ""; }
if (isset($_POST['pp_conf_timezone'])) { $pp_conf_timezone = $_POST['pp_conf_timezone']; } else {$pp_conf_timezone = '';}

$pp_conf_timestamp = $pp_conference_date." ".$pp_conf_time;
	
$force_status = "Agenda Item"; 
$force_status_number = 1;

//Inserting 'Other' Master Contracts into 'state_contract_vehicles' Table Starts Here.
if($_POST['contract_vehicle'] == 'Others'){
	$query = "INSERT INTO state_contract_vehicles (vehicle_name,vehicle_show,groupBy) VALUES 
	('$other_mc', 1, 'Others')";
	$result = mysqli_query($mysqli_link, $query);
}
//Inserting 'Other' Master Contracts into 'state_contract_vehicles' Table Ends Here.

// Inserting 'intent_to_bid' & 'pp_conference' & 'pp_mandatory' columns to the DB.
$query = "INSERT INTO state_excel_test (web_url,naics_code,vehicle_one, vehicle_two, contract_vehicle, contract_vehicle_two, response, requestor, title, submission_mode, due, pricing, contract_pop, contract_period, recruiting, contractveh_table, STATUS, agency, subagency, facility, clearance_level, qa_timezone, proposal_timezone, pp_conference_timezone, http_referer, gaps, pricing_eval, status_value, entered_in_by, certifications, est_actual, bid_category, intent_to_bid, pp_conference, pp_mandatory, priority) VALUES 
('$weburl', 'NULL', '$vehone', '$assign_to', '$contveh', '-', '$opp_response', '$user_id', '$opp_title', '$submission_mode', '$opp_due', '$opp_pricing', '$contract_pop', '$contract_period', '$opp_recruiting', '$deptagency', '$force_status', '$state', '$staffing', '-', '-', '$qa_timezone', '$proposal_timezone', '$pp_conf_timezone', '$referer', '$opp_gaps', '$pricing_eval', $force_status_number, '$profile_full_name', '$certifications', '$est_actual', '$bid_category', '$intent_to_bid', '$pp_conference', '$mandatory', '$priority')";

//print $query;
$result = mysqli_query($mysqli_link, $query);

$query = "SELECT opportunity_id FROM state_excel_test ORDER BY opportunity_id DESC LIMIT 1";
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
		$lastid = $row[0];
	}
//print("<BR><BR>New Line Last ID:" . $lastid);

//INSERT INTO HISTORY LOG
$visitor_ip = $_SERVER['REMOTE_ADDR'];
	$query = "INSERT INTO state_history_log (history_opp_id, history_username, history_ip, history_field, old_value, new_value) VALUES ($lastid, '$profile_email', '$visitor_ip', 'New Entry', 'New', '$opp_title');";
	$result = mysqli_query($mysqli_link, $query);
// Inserting 'intent_bid_date' & 'pp_conference_date' columns to the DB.
$query = "UPDATE state_excel_test SET 
released = IF('$opp_released' = '', NULL, '$opp_released'), 
proposal_due = IF('$proposal_timestamp' = '', NULL, '$proposal_timestamp'), 
qa_due = IF('$qa_timestamp' = '', NULL, '$qa_timestamp'), 
award_date = IF('$opp_award_date' = '', NULL, '$opp_award_date'), 
rfp_date = IF('$opp_rfp_date' = '', NULL, '$opp_rfp_date'), 
est_pop_start_date = IF('$est_pop_start_date' = '', NULL, '$est_pop_start_date'),  
intent_bid_date = IF('$intent_bid_date' = '', NULL, '$intent_bid_date'),
pp_conference_date = IF('$pp_conf_timestamp' = '', NULL, '$pp_conf_timestamp')
WHERE opportunity_id=$lastid";

$result = mysqli_query($mysqli_link, $query);

$content = "";
$allowedTags = '<p><a><ul><ol><li><strong><em><b><i><BR>';
$stripped_content = strip_tags($content, $allowedTags);

function replaceCurlyQuotes($text) {
    $search = array(chr(145), chr(146), chr(147), chr(148), chr(151));
    $replace = array("'", "'", '"', '"', '-');
    $text = str_replace($search, $replace, $text);
    return $text;
}

function stripToNotepadValues($text) {
    $strippedText = preg_replace("/[^a-zA-Z0-9\r\n]+/", '', $text);
    return $strippedText;
}

$opp_synopsis_sanitized = htmlentities($_POST['opp_synopsis']);
$opp_proposal_sanitized = htmlentities($_POST['opp_proposal']);
$gaps_datateam_sanitized = htmlentities($_POST['gaps_datateam']);
$notes_datateam_sanitized = htmlentities($_POST['notes_datateam']);
$opp_synopsis = $mysqli_link->real_escape_string($opp_synopsis_sanitized);

$opp_proposal = $mysqli_link->real_escape_string($opp_proposal_sanitized);
$gaps_datateam = $mysqli_link->real_escape_string($gaps_datateam_sanitized);
$notes_datateam = $mysqli_link->real_escape_string($notes_datateam_sanitized);

$query = "UPDATE state_excel_test SET synopsis='$opp_synopsis', proposal='$opp_proposal', gaps_datateam='$gaps_datateam', notes_datateam='$notes_datateam' WHERE opportunity_id=$lastid"; 
$result = mysqli_query($mysqli_link, $query);

//GOOD BELOW
$query = "UPDATE state_excel_test SET synopsis='$opp_synopsis', proposal='$opp_proposal', gaps_datateam='$gaps_datateam', notes_datateam='$notes_datateam' WHERE opportunity_id=$lastid"; 
$result = mysqli_query($mysqli_link, $query);
$code = base64_encode($lastid);

// mail functionality starts here.
if($_POST['bid_category'] == 'Artificial Intelligence') {
		$mail = new PHPMailer;
		$mail->isSMTP();                                      
		//$mail->SMTPDebug = 3;                                      
		$mail->Host = 'smtp.office365.com';  
		$mail->SMTPAuth = true;                               
		$mail->Username = 'notification@ardentinc.com';                 
		$mail->Password = 'H@llo2023%$#@!';                           
		$mail->SMTPSecure = 'tls';                             
		$mail->Port = 587; 
		$mail->setFrom('notification@ardentinc.com', 'AI Bid Notification');
		//$mail->addAddress('aibids@ardentinc.com', 'AI Bids');  
		$mail->addAddress('nageswararao.v@ardentinc.com', 'Nageswararao.');  
		//$mail->addCC('nageswararao.v@ardentinc.com', 'Nageswararao.');
		$mail->isHTML(true);                                  
		$mail->Subject = 'New AI Opportunity Added.';
	
// Header Part.
		$mail->Body .= "Hi Team,";
		$mail->Body .= "<br/><br/>A new bid has been added to the portal under the AI category.";
		$mail->Body .= "<br/><br/>Please review the bid details at your convenience.<br/>";

		$mail->Body .= "<table border='0.5' style='width: 100%; background-color: #f4f5fb; font-weight: normal; font-family: Segoe UI, Century Gothic; font-size: 11px;'>";
		$mail->Body .= "<tr>";
		$mail->Body .= "<td style='color:#fff; font-weight:bold; background-color:#3c3cb3'>Release</td>";
		$mail->Body .= "<td style='color:#fff; font-weight:bold; background-color:#3c3cb3'>Submission</td>";
		$mail->Body .= "<td style='color:#fff; font-weight:bold; background-color:#3c3cb3'>Type</td>";
		$mail->Body .= "<td style='color:#fff; font-weight:bold; background-color:#3c3cb3'>Bid #</td>";
		$mail->Body .= "<td style='color:#fff; font-weight:bold;background-color:#3c3cb3'>State/Agency</td>";
		$mail->Body .= "<td style='color:#fff; font-weight:bold; background-color:#3c3cb3'>Title</td>"; 
		$mail->Body .= "<td style='color:#fff; font-weight:bold; background-color:#3c3cb3'>Assigned to</td>";
		$mail->Body .= "<td style='color:#fff; font-weight:bold; background-color:#3c3cb3'>Added By</td>";
		$mail->Body .= "</tr>";
// Data Part.
		$mail->Body .= "<tr>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'>".date('m/d/Y',strtotime($_POST['opp_released']))."</td>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'>".date('m/d/Y',strtotime($_POST['proposal_date']))."</td>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'>".$_POST['staffing']."</td>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'><a href='$baseurl/addrole_view_opportunities.php?which_update_id=".$lastid."' target='_blank'>".$_POST['opp_vehicle_one']."</a></td>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'>".$_POST['state'] ."/". $_POST['agency']."</td>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'><a href='$baseurl/addrole_view_opportunities.php?which_update_id=".$lastid."' target='_blank'>".$_POST['opp_title']."</a></td>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'>".$_POST['manager'] ."</td>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'>".$addedby."</td>";
		$mail->Body .= "</tr></table>";
		if(!$mail->Send())
		{
			//$error_message = "<font color='red'>Please check mail id</font>";
		   echo "Mailer Error: " . $mail->ErrorInfo;
		   exit;
		}
	}
// mail functionality ends here.
print "<script>window.top.location.href = \"$baseurl/addrole_add_opportunity.php?msg=$code\";</script>"; 
?>