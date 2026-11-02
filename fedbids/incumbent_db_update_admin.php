<?php
//print("YEP ...");
//error_reporting(E_ALL);
// ini_set("display_errors", 1);

//echo "<pre>";
//print_r($_POST);
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
if (isset($_POST['which_incumbent_id'])) { $which_incumbent_id = $_POST['which_incumbent_id']; } else { $which_incumbent_id=""; }
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
if (isset($_POST['edit_incumbent_identified'])) { $edit_incumbent_identified = $_POST['edit_incumbent_identified']; } else { $edit_incumbent_identified=""; } // Added for Incumbent Identified By. 
if (isset($_POST['website_pass'])) { $website_pass = $_POST['website_pass']; } else { $website_pass=""; }
if (isset($_POST['award_amount_pass'])) { $award_amount_pass = $_POST['award_amount_pass']; } else { $award_amount_pass=""; }
if (isset($_POST['spend_to_date_pass'])) { $spend_to_date_pass = $_POST['spend_to_date_pass']; } else { $spend_to_date_pass=""; }

if (isset($_POST['reference_link_pass'])) { $reference_link_pass = $_POST['reference_link_pass']; } else { $reference_link_pass=""; }
if (isset($_POST['current_pools_pass'])) { $current_pools_pass = $_POST['current_pools_pass']; } else { $current_pools_pass=""; }
if (isset($_POST['oasis_pools_pass'])) { $oasis_pools_pass = $_POST['oasis_pools_pass']; } else { $oasis_pools_pass=""; }
if (isset($_POST['graduation_8a_chk'])) { $graduation_8a_chk = $_POST['graduation_8a_chk']; } else { $graduation_8a_chk = 0; }

if (isset($_POST['graduation_8a'])) { $graduation_8a = $_POST['graduation_8a']; } else { $graduation_8a = ""; }


if (isset($_POST['start_date_pass'])) { $start_date_pass = $_POST['start_date_pass']; } else { $start_date_pass=""; }

if (isset($_POST['completion_date_pass'])) { $completion_date_pass = $_POST['completion_date_pass']; } else { $completion_date_pass=""; }

if (isset($_POST['incumbent_contract_pass'])) { $incumbent_contract_pass = $_POST['incumbent_contract_pass']; } else { $incumbent_contract_pass=""; }
if (isset($_POST['incumbent_taskorder_pass'])) { $incumbent_taskorder_pass = $_POST['incumbent_taskorder_pass']; } else { $incumbent_taskorder_pass=""; }
if (isset($_POST['awarded_thru_pass'])) { $awarded_thru_pass = $_POST['awarded_thru_pass']; } else { $awarded_thru_pass=""; }
//awarded_thru_pass

if (isset($_POST['ultimate_completion_date_pass'])) { $ultimate_completion_date_pass = date('Y-m-d',strtotime($_POST['ultimate_completion_date_pass'])); } else { $ultimate_completion_date_pass=""; }
if (isset($_POST['in_forecast_pass'])) { $in_forecast_pass = $_POST['in_forecast_pass']; } else { $in_forecast_pass=""; }
if (isset($_POST['contact_info_pass'])) { $contact_info_pass = $_POST['contact_info_pass']; } else { $contact_info_pass=""; }
if (isset($_POST['incumbent_status_pass'])) { $incumbent_status_pass = $_POST['incumbent_status_pass']; } else { $incumbent_status_pass=""; }
if (isset($_POST['combined'])) { $combined = $_POST['combined']; } else { $combined=""; }

if (isset($_POST['awarded_set_aside'])) { $awarded_set_aside = $_POST['awarded_set_aside']; } else { $awarded_set_aside=""; }
//$eligible_incumbent = isset($_POST['eligible_incumbent']) ? 1 : 0;
//$eligible_jv = isset($_POST['eligible_jv']) ? 1 : 0;
//$graduated = isset($_POST['graduated']) ? 1 : 0;
$eligible_incumbent = $_POST['elig_inc'];

/*if($_POST['elig_inc'] == 'eligible')
{
	$eligible_incumbent = 'eligible';
}
elseif($_POST['elig_inc'] == 'eligible_jv')
{
	$eligible_incumbent = 'eligible_jv';
}
elseif($_POST['elig_inc'] == 'not_eligible')
{
	$eligible_incumbent = 'not_eligible';
}*/


//print $proposal_timestamp;
//exit();

if (strlen($opp_title)<3) { $opp_title="Title Empty"; }


/*if (isset($_POST['agency'])) { $agnecy = $_POST['agency']; } else { $agency="";}
if (isset($_POST['facility'])) { $facility = $_POST['facility']; } else { $facility=""; }*/	

//print("hello " . $opp_opportunity_id);

//$mysqli_link = mysqli_connect('portal.ardentinc.com',$db_user, $db_password,'bidsnew');

//echo "UPDATE incumbents_test SET opportunity_id=$opp_opportunity_id, incumbent_name='$incumbent_name_pass',website='$website_pass',contract='$incumbent_contract_pass',taskorder='$incumbent_taskorder_pass', awarded_thru='$awarded_thru_pass', reference_link='$reference_link_pass', award_amount='$award_amount_pass', spend_to_date='$spend_to_date_pass', start_date='$start_date_pass', completion_date='$completion_date_pass', ultimate_completion_date='$ultimate_completion_date_pass',incumbent_status='$incumbent_status_pass', contact_parts='$combined', eligible_incumbent='$eligible_incumbent', eligible_jv='', graduated='$8a_graduation' WHERE incumbent_id=$which_incumbent_id";
//exit;
$query = "UPDATE incumbents_test SET opportunity_id=$opp_opportunity_id, incumbent_name='$incumbent_name_pass',incumbent_identified_by='$edit_incumbent_identified',website='$website_pass',oasis_pools='$oasis_pools_pass',contract='$incumbent_contract_pass',taskorder='$incumbent_taskorder_pass', awarded_thru='$awarded_thru_pass', reference_link='$reference_link_pass', award_amount='$award_amount_pass', spend_to_date='$spend_to_date_pass', start_date='$start_date_pass', completion_date='$completion_date_pass', ultimate_completion_date='$ultimate_completion_date_pass',incumbent_status='$incumbent_status_pass', contact_parts='$combined', eligible_incumbent='$eligible_incumbent', eligible_jv='', graduate_8a_status=$graduation_8a_chk, graduated='$graduation_8a', awarded_set_aside='$awarded_set_aside' WHERE incumbent_id=$which_incumbent_id";

/*
, incumbent_name, title, incumbent_contract_taskorder, reference_link, award_amount, spend_to_date, start_date, completion_date, ultimate_completion_date, oasis_pools, current_pools, website, contact_info, in_forecast, incumbent_status) VALUES ($opp_opportunity_id,'$incumbent_name_pass', '$opp_title', '$incumbent_contract_taskorder_pass', '$reference_link_pass', '$award_amount_pass', '$spend_to_date_pass', '$start_date_pass', '$completion_date_pass', '$ultimate_completion_date_pass', '$oasis_pools_pass', '$current_pools_pass', '$website_pass', '$contact_info_pass', '$in_forecast_pass', '$incumbent_status_pass')";
*/

//print $query;
$result = mysqli_query($mysqli_link, $query);
//exit();
/*print ("<script>
alert('123');
</script>");*/
//print $query;
//exit();
//print ("<BR><BR>" . $contract_period);
//header("Location: https://ardentinc.com/bids-test/addrole_incumbents.php?which_update_id=$opp_opportunity_id");
//addrole_update_opportunities.php?which_update_id=1
print "<script>window.top.location.href = \"$baseurl/addrole_update_opportunities.php?which_update_id=$opp_opportunity_id\";</script>"; 
//header("Location: https://ardentinc.com/bids-test/"); 
//exit();
?>