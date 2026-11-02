<?php
include("./includes/connect_portal123.php");

if($_SERVER['REQUEST_METHOD'] === 'POST') {
$opp_opportunity_id = $_POST['oppid'];


/*$visitor_ip = $_SERVER['REMOTE_ADDR'];

if($decision != '') {
$query = mysqli_query($mysqli_link,"INSERT INTO history_log (history_opp_id, history_username, history_ip, history_field, old_value, new_value) VALUES ($ajax_opp_id, '$profile_email', '$visitor_ip', 'decision', '', '$decision');");
}*/


if(isset($_POST['opp_response'])) { $opp_response = $_POST['opp_response']; } else { $opp_response=""; }

if(isset($_POST['proposal_date'])) { $proposal_date = $_POST['proposal_date']; } else { $proposal_date=""; }
if(isset($_POST['proposal_time'])) { $proposal_time = $_POST['proposal_time']; } else { $proposal_time=""; }
if(isset($_POST['proposal_timezone'])) { $proposal_timezone = $_POST['proposal_timezone']; } else { $proposal_timzonee=""; }
if(isset($_POST['qa_date'])) { $qa_date = $_POST['qa_date']; } else { $qa_date=""; }
if(isset($_POST['qa_time'])) { $qa_time = $_POST['qa_time']; } else { $qa_time=""; }
if(isset($_POST['qa_timezone'])) { $qa_timezone = $_POST['qa_timezone']; } else { $qa_timzone=""; }

if(strlen($proposal_time)>1) { $proposal_time = " " . $proposal_time . ":00"; } else { $proposal_time = ""; }
if(strlen($qa_time)>1) { $qa_time = " " . $qa_time . ":00"; } else { $qa_time = ""; }
$proposal_timestamp = $proposal_date . $proposal_time;
$qa_timestamp = $qa_date . $qa_time;


if(isset($_POST['opp_rfp_date'])) { $opp_rfp_date = $_POST['opp_rfp_date']; } else { $opp_rfp_date = ""; }
if(!empty($opp_rfp_date)) { $phpdate = strtotime($opp_rfp_date); $opp_rfp_date = date('Y-m-d', $phpdate); } else { $opp_rfp_date = ""; }

if(isset($_POST['opp_award_date'])) { $opp_award_date = $_POST['opp_award_date']; } else { $opp_award_date = ""; }
if(!empty($opp_award_date)) { $phpdate = strtotime($opp_award_date); $opp_award_date = date('Y-m-d', $phpdate); } else { $opp_award_date = ""; }


$query = "UPDATE state_excel_test SET response='$opp_response', qa_timezone='$qa_timezone', proposal_timezone='$proposal_timezone' WHERE opportunity_id = $opp_opportunity_id";

$result = mysqli_query($mysqli_link, $query);

//DATES
$query2 = "UPDATE state_excel_test SET 
proposal_due = IF('$proposal_timestamp' = '', NULL, '$proposal_timestamp'), 
qa_due = IF('$qa_timestamp' = '', NULL, '$qa_timestamp'), 
award_date = IF('$opp_award_date' = '', NULL, '$opp_award_date'), 
rfp_date = IF('$opp_rfp_date' = '', NULL, '$opp_rfp_date') 
WHERE opportunity_id=$opp_opportunity_id";

$result2 = mysqli_query($mysqli_link, $query2);

   echo "Updated successfully.";
}
else
{
	echo "Error in details.";
}
?>