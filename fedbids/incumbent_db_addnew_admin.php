<?php
//ini_set('display_errors', '1');error_reporting(E_ALL);
//print("YEP ...");
//exit();

$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;
////include($_SERVER['DOCUMENT_ROOT'] . "include/it_loader.php");

print("<style>
body, input, table, td {font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}
.samewidth { width:240px; font-weight:700;}
</style>");
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

//$which_update_id=$_POST['which_update_id'];
/* portal.ardentinc.com/bids-test/opp_db_update.php?opp_bidopp=70098PR220070162++8%28a%291&opp_response=DRAFT+RFP&opp_requestor=Katherine+West&opp_title=USCG+Government+Purchase+Card+Program&opp_due=TBD&opp_released=opp_released&opp_pop=Period%3A+1+Base+Year+%2B+4+Option+Years%3CBR%3EPlace%3A+USCG+HQ%2C+Washington+DC&opp_synopsis=opp_synopsis&opp_proposal=VOLUME+1%3CBR%3EFactor+1+-+Corporate+Experience+%28Description+of+relevant+and+recent+corporate+experience%29%3CBR%3EFactor+2+-+Key+Personnel+Qualifications+%28Resumes+and+LOCs%29%3CBR%3EFactor+3+-+Past+Performance+%28At+least+3%2C+can+come+from+subs%29%3CBR%3EVOLUME+2%3CBR%3EPrice&opp_pricing=FFP&opp_recruiting=LCATS%3A%3CBR%3ESenior+Project+Manager+%28KEY%29%3CBR%3EProject+Manager%3CBR%3EProgram+Analysts+%28i%2C+ii%2C+iii%29&opp_gaps=&opp_decision=&opp_opportunity_id=1&token=3ac9793a4cf144fe1afb17a850b91b4908d60f1d */

if (isset($_POST['opp_opportunity_id'])) { $opp_opportunity_id = $_POST['opp_opportunity_id']; } else { $opp_opportunity_id=""; }
//if (isset($_POST['agency'])) { $agency = $_POST['agency']; } else { $agency=""; }
if (isset($_POST['opp_vehicle_one'])) { $opp_vehicle_one = $_POST['opp_vehicle_one']; } else { $opp_vehicle_one=""; }
if (isset($_POST['opp_vehicle_two'])) { $opp_vehicle_two = $_POST['opp_vehicle_two']; } else { $opp_vehicle_two=""; }

$vehicle_combined = $opp_vehicle_one . " " . $opp_vehicle_two;
/*if (isset($_POST['opp_response'])) { $opp_response = $_POST['opp_response']; } else { $opp_response=""; }
if (isset($_POST['opp_requestor'])) { $opp_requestor = $_POST['opp_requestor']; } else { $opp_requestor=""; }
if (isset($_POST['clearance_level'])) { $clearance_level = $_POST['clearance_level']; } else { $clearance_level=""; }*/
if (isset($_POST['opp_title'])) { $opp_title = $_POST['opp_title']; } else { $opp_title=""; }

if (isset($_POST['incumbent_name_pass'])) { $incumbent_name_pass = htmlentities($_POST['incumbent_name_pass']); } else { $incumbent_name_pass="";
}
if (isset($_POST['incumbent_identified'])) { $incumbent_identified = $_POST['incumbent_identified']; } else { $incumbent_identified=""; }   // Added for Incumbent Identified By. 
if (isset($_POST['website_pass'])) { $website_pass = $_POST['website_pass']; } else { $website_pass=""; }
if (isset($_POST['award_amount_pass'])) { $award_amount_pass = $_POST['award_amount_pass']; } else { $award_amount_pass=""; }
if (isset($_POST['spend_to_date_pass'])) { $spend_to_date_pass = $_POST['spend_to_date_pass']; } else { $spend_to_date_pass=""; }

if (isset($_POST['reference_link_pass'])) { $reference_link_pass = $_POST['reference_link_pass']; } else { $reference_link_pass=""; }
if (isset($_POST['current_pools_pass'])) { $current_pools_pass = $_POST['current_pools_pass']; } else { $current_pools_pass=""; }
if (isset($_POST['oasis_pools_pass'])) { $oasis_pools_pass = $_POST['oasis_pools_pass']; } else { $oasis_pools_pass=""; }
if (isset($_POST['start_date_pass'])) { $start_date_pass = $_POST['start_date_pass']; } else { $start_date_pass=""; }

if (isset($_POST['completion_date_pass'])) { $completion_date_pass = $_POST['completion_date_pass']; } else { $completion_date_pass=""; }

if (isset($_POST['incumbent_contract_pass'])) { $incumbent_contract_pass = $_POST['incumbent_contract_pass']; } else { $incumbent_contract_pass=""; }
if (isset($_POST['incumbent_taskorder_pass'])) { $incumbent_taskorder_pass = $_POST['incumbent_taskorder_pass']; } else { $incumbent_taskorder_pass=""; }
if (isset($_POST['awarded_thru_pass'])) { $awarded_thru_pass = $_POST['awarded_thru_pass']; } else { $awarded_thru_pass=""; }

if (isset($_POST['awarded_set_aside'])) { $awarded_set_aside = $_POST['awarded_set_aside']; } else { $awarded_set_aside=""; }

//$eligible_incumbent = isset($_POST['eligible_incumbent']) ? 1 : 0;
//$eligible_jv = isset($_POST['eligible_jv']) ? 1 : 0;
//$eligible_status = isset($_POST['eligible_status']) ? 1 : 0;

if($_POST['elig_inc'] == 'eligible')
{
	$eligible_incumbent = 'eligible';
}
elseif($_POST['elig_inc'] == 'eligible_jv')
{
	$eligible_incumbent = 'eligible_jv';
}
elseif($_POST['elig_inc'] == 'eligible_jv_member')
{
	$eligible_incumbent = 'eligible_jv_member';
}
elseif($_POST['elig_inc'] == 'not_eligible')
{
	$eligible_incumbent = 'not_eligible';
}

$graduated_check_status = isset($_POST['8achk']) ? 1 : 0;
if (isset($_POST['graduated'])) { $graduated = $_POST['graduated']; } else { $graduated=""; }


/*if (isset($_POST['incumbent_contract_taskorder_pass'])) { $incumbent_contract_taskorder_pass = $_POST['incumbent_contract_taskorder_pass']; } else { $incumbent_contract_taskorder_pass=""; }*/


if (isset($_POST['ultimate_completion_date_pass'])) { $ultimate_completion_date_pass = $_POST['ultimate_completion_date_pass']; } else { $ultimate_completion_date_pass=""; }
if (isset($_POST['in_forecast_pass'])) { $in_forecast_pass = $_POST['in_forecast_pass']; } else { $in_forecast_pass=""; }
if (isset($_POST['contact_info_pass'])) { $contact_info_pass = $_POST['contact_info_pass']; } else { $contact_info_pass=""; }
if (isset($_POST['incumbent_status_pass'])) { $incumbent_status_pass = $_POST['incumbent_status_pass']; } else { $incumbent_status_pass=""; }
if (isset($_POST['combined'])) { $combined = $_POST['combined']; } else { $combined=""; }


//print $proposal_timestamp;
//exit();

if (strlen($opp_title)<3) { $opp_title="Title Empty"; }


/*if (isset($_POST['agency'])) { $agnecy = $_POST['agency']; } else { $agency="";}
if (isset($_POST['facility'])) { $facility = $_POST['facility']; } else { $facility=""; }*/	

//print("hello " . $opp_opportunity_id);

//$mysqli_link = mysqli_connect('portal.ardentinc.com',$db_user, $db_password,'bidsnew');

/*$query = "UPDATE excel_test SET vehicle_one='$opp_vehicle_one', vehicle_two='$opp_vehicle_two', response='$opp_response', requestor='$opp_requestor', title='$opp_title', due='$opp_due', released='$opp_released', pop='$opp_pop', synopsis='$opp_synopsis', proposal='$opp_proposal', pricing='$opp_pricing', recruiting='$opp_recruiting', gaps='$opp_gaps', decision='$opp_decision', contract_vehicle='$opp_vehicle', status='$opp_status' 
WHERE opportunity_id = $opp_opportunity_id";*/

/*$query = "INSERT INTO excel_test (response, requestor, title, due, released, synopsis, proposal, pricing, contract_pop, contract_period, recruiting, gaps, vehicle_one, vehicle_two, contract_vehicle,STATUS, agency, facility, clearance_level, proposal_due, qa_due, qa_timezone, proposal_timezone) VALUES 
('$opp_response', '$opp_requestor', '$opp_title', '$opp_due', '$opp_released', '$opp_synopsis', '$opp_proposal', '$opp_pricing', '$contract_pop', '$contract_period', '$opp_recruiting', '$opp_gaps', '$opp_vehicle_one', '$opp_vehicle_two', '$opp_vehicle', 'New', '$agency', '$facility', '$clearance_level', '$proposal_timestamp', '$qa_timestamp', '$qa_timezone', '$proposal_timezone')";*/
$query = "INSERT INTO incumbents_test (opportunity_id, incumbent_name, incumbent_identified_by, title, contract, taskorder, awarded_thru, reference_link, award_amount, spend_to_date, oasis_pools, current_pools, website, contact_info, in_forecast, incumbent_status, contact_parts, eligible_incumbent, awarded_set_aside, graduate_8a_status, graduated) VALUES ($opp_opportunity_id,'$incumbent_name_pass', '$incumbent_identified', '$opp_title', '$incumbent_contract_pass', '$incumbent_taskorder_pass', '$awarded_thru_pass', '$reference_link_pass', '$award_amount_pass', '$spend_to_date_pass', '$oasis_pools_pass', '$current_pools_pass', '$website_pass', '$contact_info_pass', '$in_forecast_pass', '$incumbent_status_pass', '$combined', '$eligible_incumbent', '$awarded_set_aside', $graduated_check_status, '$graduated')";

//print $query;
$result = mysqli_query($mysqli_link, $query);

$query = "SELECT incumbent_id FROM incumbents_test ORDER BY incumbent_id DESC LIMIT 1";
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
		$lastid = $row[0];
	}


//DATES
$query = "UPDATE incumbents_test SET 
graduated = IF('$graduated' = '', NULL, '$graduated'),
ultimate_completion_date = IF('$ultimate_completion_date_pass' = '', NULL, '$ultimate_completion_date_pass'), 
start_date = IF('$start_date_pass' = '', NULL, '$start_date_pass'), 
completion_date = IF('$completion_date_pass' = '', NULL, '$completion_date_pass')
WHERE incumbent_id=$lastid";


//print $query;
$result = mysqli_query($mysqli_link, $query);
//print $query;
//exit();
/*print ("<script>
alert('123');
</script>");*/
//print $query;
//exit();
//print ("<BR><BR>" . $contract_period);
//header("Location: https://ardentinc.com/bids-test/addrole_incumbents.php?which_update_id=$opp_opportunity_id");
print "<script>window.top.location.href = \"$baseurl/addrole_incumbents.php?which_update_id=$opp_opportunity_id\";</script>"; 
//header("Location: https://ardentinc.com/bids-test/"); 
//exit();
?>