<?php
session_start();
//echo "<pre>";
//print_r($_POST);
//exit();
$referer = $_SERVER['HTTP_REFERER'];
$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$selemail = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT user_email FROM users WHERE user_id='".$_SESSION['user_id']."'"));
$profile_email = $selemail[0];

if (isset($_POST['opp_opportunity_id'])) { $opp_opportunity_id = $_POST['opp_opportunity_id']; } else { $opp_opportunity_id=""; }
	
if (isset($_POST['agency'])) { $agency = $_POST['agency']; } else { $agency=""; }
	$agency= filter_var($agency, FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($_POST['subagency'])) { $subagency = $_POST['subagency']; } else { $subagency=""; }
	$subagency = filter_var($subagency, FILTER_SANITIZE_SPECIAL_CHARS);
	//subagency
if (isset($_POST['opp_vehicle_one'])) { $opp_vehicle_one = $_POST['opp_vehicle_one']; } else { $opp_vehicle_one=""; }
	$opp_vehicle_one= filter_var($opp_vehicle_one, FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($_POST['opp_vehicle_two'])) { $opp_vehicle_two = $_POST['opp_vehicle_two']; } else { $opp_vehicle_two=""; }
	$opp_vehicle_two= filter_var($opp_vehicle_two, FILTER_SANITIZE_SPECIAL_CHARS);

if (isset($_POST['opp_response'])) { $opp_response = $_POST['opp_response']; } else { $opp_response=""; }
	$opp_response= filter_var($opp_response, FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($_POST['opp_requestor'])) { $opp_requestor = $_POST['opp_requestor']; } else { $opp_requestor=""; }
	$opp_requestor= filter_var($opp_requestor, FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($_POST['clearance_level'])) { $clearance_level = $_POST['clearance_level']; } else { $clearance_level=""; }
	$clearance_level= filter_var($clearance_level, FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($_POST['opp_title'])) { $opp_title = $_POST['opp_title']; } else { $opp_title=""; }
	$opp_title= filter_var($opp_title, FILTER_SANITIZE_SPECIAL_CHARS);
	$extra_quotes = array("'", "\"");
	//$opp_title = str_replace($extra_quotes, "", $opp_title);
	
if (isset($_POST['opp_due'])) { $opp_due = $_POST['opp_due']; } else { $opp_due=""; }
	$opp_due= filter_var($opp_due, FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($_POST['opp_released'])) { $opp_released = $_POST['opp_released']; } else { $opp_released=""; }

// code to add Domains & NAICS  Code Starts Here.
if (isset($_POST['domains'])) { $domain_values = json_encode($_POST['domains']); } else { $domains=""; }
if (isset($_POST['naics_code'])) { $naics_code = $_POST['naics_code']; } else { $naics_code=""; }
// code to add Domains & NAICS  Code Ends Here.

//$opp_released = date( 'm/d/Y', $opp_released ); 
$phpdate = strtotime( $opp_released );
$opp_released = date( 'Y-m-d', $phpdate );

if (isset($_POST['certifications'])) { $certifications = $_POST['certifications']; } else { $certifications=""; }
	$certifications= filter_var($certifications, FILTER_SANITIZE_SPECIAL_CHARS);

//if (isset($_POST['opportunity_link'])) { $opportunity_link = $_POST['opportunity_link']; } else { $opportunity_link=""; }

//if (isset($_POST['sharepoint_link'])) { $sharepoint_link = $_POST['sharepoint_link']; } else { $sharepoint_link=""; }

if (isset($_POST['solicitation_docs'])) { $solicitation_docs = $_POST['solicitation_docs']; } else { $solicitation_docs=""; }

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


	//$opp_released= filter_var($opp_released, FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($_POST['opp_pop'])) { $opp_pop = $_POST['opp_pop']; } else { $opp_pop=""; }
	$opp_pop= filter_var($opp_pop, FILTER_SANITIZE_SPECIAL_CHARS);
/*if (isset($_POST['opp_synopsis'])) { $opp_synopsis = $_POST['opp_synopsis']; } else { $opp_synopsis=""; }
	$opp_synopsis= filter_var($opp_synopsis, FILTER_SANITIZE_SPECIAL_CHARS);*/
/*if (isset($_POST['opp_proposal'])) { $opp_proposal = $_POST['opp_proposal']; } else { $opp_proposal=""; }
	$opp_proposal= filter_var($opp_proposal, FILTER_SANITIZE_SPECIAL_CHARS);*/
if (isset($_POST['opp_pricing'])) { $opp_pricing = $_POST['opp_pricing']; } else { $opp_pricing=""; }
	//$opp_pricing= filter_var($opp_pricing, FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($_POST['combined_table'])) { $contract_pop = strtoupper($_POST['combined_table']); } else { $contract_pop=""; }


if (isset($_POST['perioda'])) { $perioda = $_POST['perioda']; } else { $perioda=""; }
if (isset($_POST['periodb'])) { $periodb = $_POST['periodb']; } else { $periodb=""; }
if (isset($_POST['periodc'])) { $periodc = $_POST['periodc']; } else { $periodc=""; }
if (isset($_POST['periodd'])) { $periodd = $_POST['periodd']; } else { $periodd=""; }
//if (isset($_POST['periodqty'])) { $periodqty = $_POST['periodqty']; } else { $periodqty=""; }

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
//print $proposal_timestamp;
//exit();

if (isset($_POST['pricing_eval'])) { $pricing_eval = $_POST['pricing_eval']; } else { $pricing_eval=""; }

if (strlen($opp_title)<3) { $opp_title="Title Empty"; }

if($_POST['trans_in_qty']!='') { $trans_in_qty = $_POST['trans_in_qty']; } else { $trans_in_qty=""; }
if($_POST['trans_in_time']) { $trans_in_time = $_POST['trans_in_time']; } else { $trans_in_time=""; }
if($_POST['eos_qty']!='') { $eos_qty = $_POST['eos_qty']; } else { $eos_qty=""; }
if($_POST['eos_time']) { $eos_time = $_POST['eos_time']; } else { $eos_time=""; }

$contract_period = $trans_in_qty . "#" . $trans_in_time ."#". $perioda . "#" . $periodb . "#" . $periodc . "#" . $periodd. "#".$eos_qty . "#" . $eos_time;

if (isset($_POST['opp_gaps'])) { $opp_gaps = $_POST['opp_gaps']; } else { $opp_gaps=""; }

/*
if(isset($_POST['contractveh_table'])) 
{ 
	$contractveh_table = $_POST['contractveh_table'];
	$getrow = explode("|||",$contractveh_table);

	$contveh = $getrow[0];
	$vehone = $getrow[1];
	if(empty($getrow[2]))
	{
		$contveh2 = '';
		$vehtwo = '';
	}
	else
	{
		$contveh2 = $getrow[2];
		$vehtwo = $getrow[3];
	}
} 
else 
{ 
	$contractveh_table = ''; 
	$contveh = '';
	$vehone = '';
	$contveh2 = '';
	$vehtwo = '';
}*/

if(isset($_POST['contractveh_table'])) 
{ 
	$contractveh_table = $_POST['contractveh_table'];
	$getrow = explode("|||",$contractveh_table);
	$j = 0;

//	while($i<(count($getrow)-1)){
		$temp = explode("+",$getrow[$j+1]);
		if($temp[1] != ''){
			$set_aside = $temp[1];
		}
//		$i = $i+2;
//	}

	$contveh   = $getrow[0];
	$vehone    = $getrow[1];
//	$set_aside = $getrow[2];
/*	if(empty($getrow[3]))
	{
		$contveh2  = '';
		$vehtwo    = '';
		$set_aside = '';
	}
	else
	{
		$contveh2 = $getrow[3];
		$vehtwo   = $getrow[4];
		$set_aside= $getrow[5];
	} */
} 
else 
{ 
	$contractveh_table = ''; 
	$contveh = '';
	$vehone = '';
	$contveh2 = '';
	$vehtwo = '';
	$set_aside = '';
}

if (isset($_POST['agency'])) { $agnecy = $_POST['agency']; } else { $agency="";}
if (isset($_POST['facility'])) { $facility = $_POST['facility']; } else { $facility=""; }	
if (isset($_POST['gaps_datateam'])) { $gaps_datateam = $_POST['gaps_datateam']; } else { $gaps_datateam=""; }
	$gaps_datateam= filter_var($gaps_datateam, FILTER_SANITIZE_SPECIAL_CHARS);	
if (isset($_POST['notes_datateam'])) { $notes_datateam = $_POST['notes_datateam']; } else { $notes_datateam=""; }
	$notes_datateam= filter_var($notes_datateam, FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($_POST['size_standard'])) { $size_standard = $_POST['size_standard']; } else { $size_standard=""; }	


if($opp_response == 'Forecast'){
	$bid_category = '8a_opportunity';
}else if($opp_response == 'Ongoing') {
	$bid_category = '8a_directed';
}else{
	$bid_category = 'general';
}


$force_status = "Agenda Item"; 
$force_status_number = 1;

$dont_show_agenda = 0;
if($_POST['agenda_show_status'])
$dont_show_agenda = 1;

$query = "INSERT INTO excel_test (vehicle_one, vehicle_two, contract_vehicle, contract_vehicle_two, response, requestor, title, due, pricing, contract_pop, contract_period, recruiting, contractveh_table, STATUS, agency, subagency, facility, clearance_level, qa_timezone, proposal_timezone, http_referer, gaps, pricing_eval, status_value, entered_in_by, certifications, solicitation_docs, domains, naics_code, set_aside, dont_show_agenda, size_standard, bid_category) VALUES 
('$vehone', '$vehtwo', '$contveh', '$contveh2', '$opp_response', '$opp_requestor', '$opp_title', '$opp_due', '$opp_pricing', '$contract_pop', '$contract_period', '$opp_recruiting', '$contractveh_table', '$force_status', '$agency', '$subagency', '$facility', '$clearance_level', '$qa_timezone', '$proposal_timezone', '$referer', '$opp_gaps', '$pricing_eval', $force_status_number, '$profile_full_name', '$certifications', '$solicitation_docs', '$domain_values', '$naics_code', '$set_aside', $dont_show_agenda, '$size_standard', '$bid_category')";
//print $query;
$result = mysqli_query($mysqli_link, $query);
//exit();
$query = "SELECT opportunity_id FROM excel_test ORDER BY opportunity_id DESC LIMIT 1";
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$lastid = $row[0];
	}
//print("<BR><BR>New Line Last ID:" . $lastid);

//INSERT INTO HISTORY LOG
$visitor_ip = $_SERVER['REMOTE_ADDR'];

/*$query = "INSERT INTO history_log (history_opp_id, history_username, history_ip, history_field, old_value, new_value) VALUES ($ajax_opp_id, '$profile_email', '$visitor_ip', '$ajax_opp_field', '$db_old_value', '$ajax_opp_value');";*/
	$query = "INSERT INTO history_log (history_opp_id, history_username, history_ip, history_field, old_value, new_value) VALUES ($lastid, '$profile_email', '$visitor_ip', 'New Entry', 'New', '$opp_title');";
	$result = mysqli_query($mysqli_link, $query);
	
//print ("<BR>HISTORY " . $query . "<BR><BR><BR>");	
//synopsis, proposal, pricing, contract_pop, contract_period, recruiting, gaps, vehicle_one, vehicle_two, contract_vehicle, contract_vehicle_two, STATUS, agency, facility, clearance_level, 	
//, qa_timezone, proposal_timezone, http_referer, gaps_datateam, notes_datateam, pricing_eval, status_value, entered_in_by, transition_notes,
//NULLIF('$opp_award_date', '')

/*$query = "UPDATE excel_test (released, proposal_due, qa_due, award_date, rfp_date, est_pop_start_date) VALUES 
('$opp_released', '$proposal_timestamp', '$qa_timestamp', '$opp_award_date', '$opp_rfp_date', '$est_pop_start_date') WHERE opportunity_id=$lastid";*/

//CASE WHEN mydate = '' THEN NULL ELSE mydate END

$query = "UPDATE excel_test SET 
released = IF('$opp_released' = '', NULL, '$opp_released'), 
proposal_due = IF('$proposal_timestamp' = '', NULL, '$proposal_timestamp'), 
qa_due = IF('$qa_timestamp' = '', NULL, '$qa_timestamp'), 
award_date = IF('$opp_award_date' = '', NULL, '$opp_award_date'), 
rfp_date = IF('$opp_rfp_date' = '', NULL, '$opp_rfp_date'), 
est_pop_start_date = IF('$est_pop_start_date' = '', NULL, '$est_pop_start_date') 
WHERE opportunity_id=$lastid";


//print ("<BR> DATES: " . $query);
$result = mysqli_query($mysqli_link, $query);


//$mysqli_link = mysqli_connect('portal.ardentinc.com',$db_user, $db_password,'bidsnew');

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


//$replaced_content = replaceCurlyQuotes($content);

//$content = $_POST["your_textbox_content"];
//$sanitized_opp_synopsis = filter_var($_POST['opp_synopsis'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
$opp_synopsis_sanitized = htmlentities($_POST['opp_synopsis']);
//$sanitized_opp_proposal = filter_var($_POST['opp_proposal'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
$opp_proposal_sanitized = htmlentities($_POST['opp_proposal']);
//$sanitized_gaps_datateam = filter_var($_POST['gaps_datateam'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
$gaps_datateam_sanitized = htmlentities($_POST['gaps_datateam']);
//$sanitized_notes_datateam = filter_var($_POST['notes_datateam'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
$notes_datateam_sanitized = htmlentities($_POST['notes_datateam']);

//$opp_proposal = $mysqli_link->real_escape_string($_POST['opp_proposal']);
//$opp_proposal_stripped = $mysqli_link->real_escape_string($stripped_content);
//$opp_proposal_replaced = $mysqli_link->real_escape_string($replaced_content);

//$conn = new mysqli("localhost", "username", "password", "database");
$opp_synopsis = $mysqli_link->real_escape_string($opp_synopsis_sanitized);

$opp_proposal = $mysqli_link->real_escape_string($opp_proposal_sanitized);
$gaps_datateam = $mysqli_link->real_escape_string($gaps_datateam_sanitized);
$notes_datateam = $mysqli_link->real_escape_string($notes_datateam_sanitized);

//echo $opp_synopsis_sanitized.'<br>';
//echo $opp_synopsis.'<br>';
//exit;

/*$sql = "INSERT INTO excel_test (synopsis,proposal,gaps_datateam,notes_datateam) VALUES (?,?,?,?)";
$stmt = $mysqli_link->prepare($sql);
$stmt->bind_param("ssss", synopsis, $opp_proposal, $gaps_datateam, $notes_datateam);
$stmt->execute();*/


$query = "UPDATE excel_test SET synopsis='$opp_synopsis', proposal='$opp_proposal', gaps_datateam='$gaps_datateam', notes_datateam='$notes_datateam' WHERE opportunity_id=$lastid"; 
$result = mysqli_query($mysqli_link, $query);
	
	//print ("<BR><BR>SANITIZED: " . $query);
	/*if (($mysqli_link->query($query) === TRUE)) {
    echo "Data inserted successfully --- Sanitized";
		}*/
//$query = "UPDATE excel_test SET proposal='$opp_proposal' WHERE opportunity_id=$opp_id"; 
/*$query = "UPDATE excel_test SET proposal='$opp_proposal_replaced' WHERE opportunity_id=$opp_id";
$result = mysqli_query($mysqli_link, $query);*/

//GOOD BELOW
$query = "UPDATE excel_test SET synopsis='$opp_synopsis', proposal='$opp_proposal', gaps_datateam='$gaps_datateam', notes_datateam='$notes_datateam' WHERE opportunity_id=$lastid"; 
$result = mysqli_query($mysqli_link, $query);

   //echo "last id : ".$lastid; 
//print ("<BR><BR><BR><BR>LOWER TEST: " . $query);
//exit();
//print ("<BR><BR>" . $contract_period);

//header("Location: https://ardentinc.com/bids-test/"); 
//header("Location: https://ardentinc.com/bids-test/addrole_update_opportunities.php?which_update_id=$lastid");

print "<script>window.top.location.href = \"$baseurl/addrole_incumbents.php?which_update_id=$lastid\";</script>"; 
//https://ardentinc.com/bids-test/addrole_incumbents.php?which_update_id=1651
//addrole_update_opportunities.php?which_update_id=$lastid
//https://ardentinc.com/bids-test/addrole_update_opportunities.php?which_update_id=1643
//header("Location: https://ardentinc.com/bids-test/admin.php");
//exit();
?>