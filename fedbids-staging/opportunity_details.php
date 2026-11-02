<style>
  .collapsible-content-history {
    display: none;
  }
  .active-history {
    display: block;
  }
  .collapsible-content-documents {
    display: none;
  }
  .active-documents {
    display: block;
  }
  .custom-select {
		border: 1px solid #767676;
		background:#fff;
		width:100%;
		color: #000;
		padding: 1px 8px;
   }
   .custom-select:after {
	  position: absolute;
	  content: "";
	  top: 8px;
	  right: 3px;
	  width: 0;
	  height: 0;
	  border: 6px solid transparent;
	  border-color: #767676 transparent transparent transparent;
	}
a:hover {
  color: blue;
}
</style>
<style>
.collapsiblehistory {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 8px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}
.activehistory, .collapsiblehistory:hover {
  background-color: blue;
}
.contenthistory {
  padding: 0 10px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
}
</style>
<style>
.ui-accordion .ui-accordion-header {
	display: block;
	cursor: pointer;
	position: relative;
	margin: 2px 0 0 0;
	padding: .5em .5em .5em .7em;
	font-size: 100%;
}
.ui-accordion .ui-accordion-content {
	padding: 1em 2.2em;
	border-top: 0;
	overflow: auto;
}
.ui-autocomplete {
	position: absolute;
	top: 0;
	left: 0;
	cursor: default;
}
.doclink1 a {
	color:#000000
}
</style>
<!-- Styles for MultiSelect Boxes Starts Here. ------>
<style>
.multiselect {
  width: 100px;
}
.selectBox {
  position: relative;
}
.selectBox select {
  width: 234%;
  font-weight: normal;
  height: 20px;
}
#checkboxes {
  display: none;
}
</style>
<!-- Styles for MultiSelect Boxes Ends Here. ------>
<?php
session_start();
$bp_id = $_GET['bp']; 
$button_page_reference = "opportunities";
$this_page_name="Ardent Capture System";
include("./includes/connect_portal123.php");
$secure_webpage=0;
//ini_set('display_errors', '1'); error_reporting(E_ALL);
$role = $_SESSION['user_role'];
if($role == 'admin'){
	$dis_txt_fld = "";
	$dis_multi_select = "pointer-events:enabled";
}
else
{
	$dis_txt_fld = "disabled='disabled'";
	$dis_multi_select = "pointer-events:none;";
}

if (isset($_GET['makeactive'])) { $makeactive=$_GET['makeactive']; } else { $makeactive = 0; }

$search_this= "";
$urlsearch="";
if (!empty($_GET['search'])) { $search_this = $_GET['search']; $urlsearch = $_GET['search']; } 
if (!empty($_GET['status'])) { $status =  " STATUS='" . $_GET['status'] . "' AND "; $_SESSION["status"] = "?status=" . $status; } else { $_SESSION["status"] = ""; $status="";}

if (!empty($_GET['cv1']) && ($_GET['cv1']==1)) { $cv1 = 1; } else { $cv1 = 0; }
if (!empty($_GET['cv2']) && ($_GET['cv2']==1)) { $cv2 = 1; } else { $cv2 = 0; }


$search_area="
<div style='z-index:3; width:50%; margin-left:25%; position:fixed; text-align:center; top:9px;'><form action='' method='get' enctype='multipart/form-data' style='margin:0px; padding:0px;'>
		<input name='search' type='text' value='$search_this' style='font-size:13px;width: 200px; padding-left:8px; font-weight:700;'><select name='search_type' id='search_type' style='padding:2px 5px; font-weight:700; display:none;'>
			<option value='opportunities'>Opportunities</option>
			<option value='companies'>Companies</option>
			<option value='contacts'>Contacts</option>
		  </select><button type='submit'><i class='fa fa-search' style='padding:0px;'></i></button>
  		<div onClick='ajaxshowfilter();' style='background-color: #efefef; display: inline-block; padding: 2px 8px; font-weight:700; margin-left:10px;'>Filters</div>
		
    </form></div>";
?>

<!DOCTYPE html>
<html>
<head>

<title><?php print $this_page_name; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="styles/modal.css">
<link rel="stylesheet" href="styles/1.css">
<link rel="stylesheet" href="styles/rcs.css">

<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="icon" type="image/x-icon" href="favicon.ico">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style type="text/css">
<?php include("includes/inline-styles.php"); ?>
.bid_edit { display:none; }
.bid_show { display:block; }
.light_grey_fade2 {
    background: #ffffff;
    background: -moz-linear-gradient(top,  #ffffff 0%, #f1f1f1 50%, #e1e1e1 51%, #f6f6f6 100%);
    background: -webkit-linear-gradient(top,  #ffffff 0%,#f1f1f1 50%,#e1e1e1 51%,#f6f6f6 100%);
    background: linear-gradient(to bottom,  #ffffff 0%,#f1f1f1 50%,#e1e1e1 51%,#f6f6f6 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0 );
}
</style>
</head>
<body style="background-color:#fff;">
<?php 
if (isset($profile_first_name)) { $login_name=$profile_first_name; } else { $login_name="Login"; }
//include("includes/header.php"); 
?>

<?php
/*  Code to select & update users who seen addendum Starts Here.  */
	$addendum_seen_array = []; 
	$addendum_seen_query = "SELECT addendum_seen FROM excel_test WHERE is_addendum=1 AND opportunity_id=$bp_id";
	$addendum_seen_result = mysqli_fetch_array(mysqli_query($mysqli_link, $addendum_seen_query));
//	$addendum_seen_array = json_decode($addendum_seen_result[0], true);
	if (is_array($addendum_seen_array) && !in_array($_SESSION['user_id'], $addendum_seen_array)) {
		array_push($addendum_seen_array,$_SESSION['user_id']);	
	}
	$addendum_seen_array = json_encode($addendum_seen_array);
	$addendum_seen_query_update = "UPDATE excel_test SET addendum_seen='".$addendum_seen_array."' where opportunity_id=$bp_id";
	$addendum_seen_query_update_result = mysqli_query($mysqli_link, $addendum_seen_query_update); 
/*  Code to select & update users who seen addendum Ends Here. */

$entry_date2 = date("Y-m-d"); //Y-m-d h:i:sa
$entry_date1 = date('Y-m-d', strtotime($entry_date2 . ' -1 month'));

$filterarea = "";

$app_builder = "";
$count_results = 0;
$type_change = 0;
$tr_color = "background-color:#31335f;"; /* #98e0e0 */
$tr_font_color = "color:#fff; text-align:center;";
$tr_color .= $tr_font_color;

$header_part = "";
$table_content = "";
$last_company_name = "";
$company_builder = "";
$co_website_array = "";
$starting_table = "";
$table_details = "";

$opportunities_found = 0;
$gov_contacts_found = 0;
$company_info_found = 0;
$company_contacts_found = 0;

//DOCUMENTS PULL
$documents_list = "";
$documents_query = "SELECT filename, renew_filename FROM documents WHERE opportunity_id=$bp_id";
$documents_result = mysqli_query($mysqli_link, $documents_query);
while($row = mysqli_fetch_array($documents_result, MYSQLI_NUM))
    {
	$document_filedesc = $row[0];
	$renew_filename = $row[1];
	$documents_list .= "<div><a href='./documents/$renew_filename' target='_blank'>$document_filedesc</a></div>";
	}

//MANAGERS PULL
$manager_list = "";
$manager_query = "SELECT manager_name FROM managers WHERE (access_type='F' OR access_type='B') AND manager_show=1 ORDER BY manager_name";

$manager_query1 = "SELECT support_managers FROM excel_test WHERE opportunity_id = ".$bp_id;
$manager_result1 = mysqli_query($mysqli_link, $manager_query1);
$row1 = mysqli_fetch_array($manager_result1, MYSQLI_NUM);
$single_mgnr_temp = $row1[0];
$managers_array = json_decode($row1[0]);
$manager_result = mysqli_query($mysqli_link, $manager_query);
while($row = mysqli_fetch_array($manager_result, MYSQLI_NUM)){
	$db_manager_name = $row[0];
	$manager_list .= "<option value='$db_manager_name'>$db_manager_name</option>";
// Managers List With CheckBoxes Starts Here.
	if(is_array($managers_array)){
		$manager_list_withCheckBoxes .= "<div style='height:5px'></div><input type='checkbox' name='support_managers[]' id='$db_manager_name' value='$db_manager_name' "; 
		if(in_array($db_manager_name, $managers_array)) { 
			$manager_list_withCheckBoxes .=  "checked='checked'"; 
		}
		$manager_list_withCheckBoxes .= " style='margin-left: 11px;'><label style='margin-left: 9px; color:#000' for='$db_manager_name'>$db_manager_name</label><div style='height:5px'></div>";
	}
	else{     
		$manager_list_withCheckBoxes .= "<div style='height:5px'></div><input type='checkbox' name='support_managers[]' id='$db_manager_name' value='$db_manager_name' style='margin-left: 11px;'"; 
		if($db_manager_name == $single_mgnr_temp) { 
			$manager_list_withCheckBoxes .=  "checked='checked'"; 
		}	
		$manager_list_withCheckBoxes .= "><label style='margin-left: 9px; color:#000;' for='$db_manager_name'>$db_manager_name</label><div style='height:5px'></div>";
	}  
}
// Managers List With CheckBoxes Ends Here.
//BUSINESS ENTITY LIST
$business_entity_list = "";
$business_entity_query = "SELECT entity_name FROM business_entities WHERE entity_show>0 ORDER BY entity_id";
$business_entity_query_result = mysqli_query($mysqli_link, $business_entity_query);
while($row = mysqli_fetch_array($business_entity_query_result, MYSQLI_NUM))
    {
	$db_entity_name = $row[0];
	$business_entity_list .= "<option value='$db_entity_name'>$db_entity_name</option>";
	}
//DECISION LIST
$decision_list = "";
$decision_query = "SELECT decision_name FROM decision WHERE decision_show>0 ORDER BY decision_id";
$decision_result = mysqli_query($mysqli_link, $decision_query);
while($row = mysqli_fetch_array($decision_result, MYSQLI_NUM))
    {
	$db_decision_name = $row[0];
	$decision_list .= "<option value='$db_decision_name'>$db_decision_name</option>";
	}
//AWARDED LIST
$awarded_list = "";
$awarded_query = "SELECT awarded_name FROM awarded_levels WHERE awarded_show>0 ORDER BY awarded_id";
$awarded_result = mysqli_query($mysqli_link, $awarded_query);
while($row = mysqli_fetch_array($awarded_result, MYSQLI_NUM))
    {
	$db_awarded_name = $row[0];
	$awarded_list .= "<option value='$db_awarded_name'>$db_awarded_name</option>";
	}

//VEHICLE PULL
$vehicle_list = "";
$vehicle_checkboxes = "";
$vehicle_query = "SELECT vehicle_id, vehicle_name FROM contract_vehicles WHERE vehicle_show=1 ORDER BY vehicle_name";
$vehicle_result = mysqli_query($mysqli_link, $vehicle_query);
while($row = mysqli_fetch_array($vehicle_result, MYSQLI_NUM))
    {
	$db_vehicle_name = $row[1];
	$vehicle_list .= "<option value='$db_vehicle_name'>$db_vehicle_name</option>";
					  
		if (isset($_GET['vehicle']))  
		{
			if(in_array($db_vehicle_name, $_GET['vehicle']))
			{
			$vehicle_checkboxes .= "<input type='checkbox' id='vehicle[]' name='vehicle[]' value='$db_vehicle_name' checked>
							  <label for='vehicle[]'> $db_vehicle_name</label><br>";
			}
			else
			{
			$vehicle_checkboxes .= "<input type='checkbox' id='vehicle[]' name='vehicle[]' value='$db_vehicle_name'>
							  <label for='vehicle[]'> $db_vehicle_name</label><br>";
			}
		}
		else
		{
			$vehicle_checkboxes .= "<input type='checkbox' id='vehicle[]' name='vehicle[]' value='$db_vehicle_name'>
							  <label for='vehicle[]'> $db_vehicle_name</label><br>";
		}
	
	}

//status PULL
$status_list = "";
$status_checkboxes = "";
$status_query = "SELECT status_id, status_name FROM status_levels WHERE (status_show>0) ORDER BY status_show";
$status_result = mysqli_query($mysqli_link, $status_query);
while($row = mysqli_fetch_array($status_result, MYSQLI_NUM))
    {
		$db_status_id = $row[0];
		$db_status_name = $row[1];
		$status_list .= "<option value='$db_status_name'>$db_status_name</option>";
	}
	$history_count=0;	
$history_query = "SELECT history_id, history_opp_id, history_ip, history_username, history_timestamp, history_field, old_value, new_value FROM history_log WHERE history_opp_id=$bp_id order by history_id DESC";
$history_builder = "<div class='incumbentvaluecss' style='display:inline-block;width:calc(100%);vertical-align:top; padding:8px 0px; overflow:auto; overflow-wrap:break-word; /*border:1px solid #d1d1d3; */'>";
			
$result = mysqli_query($mysqli_link, $history_query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
		$history_count++;
	$db_history_id = $row[0];
	$db_history_opp_id = $row[1];
	$db_history_ip = $row[2];
	$db_history_username = $row[3];
	$db_history_timestamp = date('m-d-Y H:i:s',strtotime($row[4]));
	$db_history_field = $row[5];
	$db_history_old_value = $row[6];
	$db_history_new_value = $row[7];
	$history_builder .= "<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top;  '>$db_history_timestamp</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;  '><strong>$db_history_field</strong> --- $db_history_new_value --- $db_history_username</div><br>";
	}
	$history_builder .= "</div>";
	
	$documents_count=0;
	
$documents_query = "SELECT partner_id, opportunity_id, documents_ip, documents_username, filetimestamp, filename, filedesc, filetype 
FROM partners WHERE opportunity_id=$bp_id ORDER BY partner_id DESC";
$documents_builder = "<div class='incumbentvaluecss' style='display:inline-block;width:calc(100%);vertical-align:top; padding:8px 0px; overflow:auto; overflow-wrap:break-word; /*border:1px solid #d1d1d3; */'>";
//print $documents_query;
			
$result = mysqli_query($mysqli_link, $documents_query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
		$documents_count++;
	$db_documents_id = $row[0];
	$db_documents_opp_id = $row[1];
	$db_documents_ip = $row[2];
	$db_documents_username = $row[3];
	$db_documents_timestamp = $row[4];
	$db_documents_field = $row[5];
	$db_documents_old_value = $row[6];
	$db_documents_new_value = $row[7];
	
	$doc_link_builder = "<a style='color:#efa232' href='" . "$baseurl/partners/" . $db_documents_field . "' target='_blank'>" . $db_documents_field . "</a>";
	$documents_builder .= "<div class='incumbentvaluecss' style='display:inline-block;width:calc(100%);vertical-align:top;  '><strong>$doc_link_builder</strong> --- $db_documents_username --- $db_documents_timestamp</div><br>";
	}
	$documents_builder .= "</div>";

$query = "SELECT DATE(entrydate), opportunity_type, DATE(duedate), opportunity_title, agency, url, category, opportunity_id  FROM temp_opportunities   
WHERE opportunity_type LIKE '%$search_this%' 
OR opportunity_title LIKE '%$search_this%' 
OR agency LIKE '%$search_this%' 
OR url LIKE '%$search_this%'  
ORDER BY entrydate DESC LIMIT 200";

$query = "SELECT DATE(entrydate), state, DATE(duedate), projecttitle, dept, url, category, id, mastercontracts, status, bidnumber, source FROM atom  
WHERE state LIKE '%$search_this%' 
OR projecttitle LIKE '%$search_this%' 
OR dept LIKE '%$search_this%' 
OR url LIKE '%$search_this%' 
OR mastercontracts LIKE '%$search_this%' 
OR status LIKE '%$search_this%' 
OR bidnumber LIKE '%$search_this%' 
OR source LIKE '%$search_this%'
ORDER BY entrydate DESC LIMIT 200";

$is_oasis_sb ="";
if (($cv1>0) && ($cv2==0)) { $is_oasis_sb = ""; $is_oasis_sb = " AND contract_vehicle = 'OASIS SB' "; } else { /*$is_oasis_sb ="";*/ }
if (($cv1==0) && ($cv2>0)) { $is_oasis_sb = ""; $is_oasis_sb = " AND contract_vehicle = 'OASIS 8(a)' "; } else { /*$is_oasis_a ="";*/ }
  
$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, contract_vehicle_two, contract_pop2, status_value, transition_notes, submission_notes, is_submitted, is_archived, is_awarded, award_date, rfp_date, est_pop_start_date, notes_datateam, gaps_datateam, pricing_eval, subagency, contractveh_table, certifications, solicitation_docs, support_managers, domains, naics_code, previous_releases, size_standard, ron_cp_date, tyler_cp_date, team_cp_date, business_entity,no_of_awards FROM excel_test   
WHERE opportunity_id = $bp_id"; //LIMIT 50

$query_total = "SELECT count(*) FROM excel_test   
WHERE status='New' AND (bidopp LIKE '%$search_this%' 
OR response LIKE '%$search_this%' 
OR requestor LIKE '%$search_this%' 
OR title LIKE '%$search_this%' 
OR pop LIKE '%$search_this%' 
OR synopsis LIKE '%$search_this%' 
OR recruiting LIKE '%$search_this%' 
OR decision LIKE '%$search_this%') $is_oasis_sb 
ORDER BY opportunity_id";

$total_results = 0;
$result11 = mysqli_query($mysqli_link, $query_total);

while($row11 = mysqli_fetch_array($result11, MYSQLI_NUM))
    {
	$total_results = $row11[0];
	}

$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$opp_opportunity_id = $row[0];
	$opp_bidopp = $row[1];
	$opp_response = "<option hidden selected value='" . $row[2] . "'>" . $row[2] . "</option>";
	$opp_response_val = $row[2];

		if($opp_response_val == 'Forecast'){$action_file_name = 'fc_ajax_status_update.php';}else{$action_file_name = 'ajax_status_update.php';}

	$opp_requestor = $row[3];
	$opp_title = str_replace("<BR>","",$row[4]);
	$opp_due = strtoupper($row[5]); 
	$opp_released = strtoupper($row[6]); 
		
	$opp_released = $row[6];
	$opp_released = date("m/d/Y", strtotime($opp_released)); 
	$opp_released_formatted=$opp_released;
	if (empty($row[6])) { $opp_released="N/A"; $opp_released_formatted=""; } 

	$opp_pop = $row[7]; 
	$opp_synopsis_in = html_entity_decode($row[8]); 
		$opp_synopsis = str_ireplace($urlsearch, '<span style="background-color:#f1b133;">'.strtoupper($urlsearch).'</span>', $opp_synopsis_in); 
	$opp_synopsis = preg_replace('/<a(?![^>]*target=)/i', '<a target="_blank"', $opp_synopsis); // added to open link in new tab.

	$opp_proposal = html_entity_decode($row[9]);
	$opp_proposal = preg_replace('/<a(?![^>]*target=)/i', '<a target="_blank"', $opp_proposal); // added to open link in new tab.

	$opp_pricing = $row[10]; 
	$opp_recruiting_in = $row[11]; 
	
	if ($makeactive==$opp_opportunity_id) { $makeactive1 = "active_bid"; $makeactive2 = "display: block;"; } else { $makeactive1 = ""; $makeactive2 = ""; $anchor=""; }

		if(strpos($opp_recruiting_in, '|||') !== false) {
				$ok = explode("|||",$opp_recruiting_in);					
				$i = 0;
				$inloop = 0;
				$opp_recruiting = "";
				$opp_recruiting1 = "";
				$opp_fte1 = "";
				$temp_job = "";
				$recruiting_hold = "";
				$recruiting_qty = "";
				$recruiting_ftehrs = "";
				$recruiting_jobtitle = "";
				$recruiting_clearance = "";
				$recruiting_kp = "";
				
				$recruit_qty_array = [];			
				$total_recruiting_qty = 0;
				$recruiting_qty_array = [];
				
				$recruit_ftehrs_array = [];			
				$total_recruiting_ftehrs = 0;
				$recruiting_ftehrs_array = [];
				
				$jobTitle_count = 0;

				while($i < count($ok))
				{
					$inloop++; 
					if (($inloop==1) && ((count($ok)-$i)>1)) { $opp_recruiting .= "<DIV style='background-color:#fff; /*border-top:1px solid #d1d1d3;*/ '>"; } //color:#106b9a;
					if ($inloop==1) { 
						$recruiting_qty = $ok[$i]; 			
					$recruit_ftes_array = explode('FTE(s)',$recruiting_qty);
						if($recruit_ftes_array[0] != 0){
						$opp_fte1 = $recruiting_qty;
						}else {$opp_fte1 = "";}
					$opp_recruiting .= "<div style='width:60px; display:inline-block; vertical-align:top;'>" . $opp_fte1 . " </div>";
					}

					if ($inloop==2) { 
						$recruiting_ftehrs = $ok[$i]; 
						$recruit_ftehrs_array = explode('HRS',$recruiting_ftehrs);
						if($recruit_ftehrs_array[0] != 0){
						$opp_recruiting1 = $recruiting_ftehrs;
						}else {$opp_recruiting1 = "";}
						$opp_recruiting .= "<div style='width:60px; display:inline-block; vertical-align:top;'>" . $opp_recruiting1 . " </div>";
					}

					if ($inloop==1) {
						$recruit_qty_array = explode('FTE(s)',$recruiting_qty);
						array_push($recruiting_qty_array,$recruit_qty_array);
					}		
					if ($inloop==2) {
						$recruit_ftehrs_array = explode('HRS',$recruiting_ftehrs);
						array_push($recruiting_ftehrs_array,$recruit_ftehrs_array);
					}
					if ($inloop==3) { $recruiting_jobtitle = $ok[$i];  $jobTitle_count++;}
					if ($inloop==4) { $recruiting_hold = $ok[$i];  }
					if ($inloop==5) { $recruiting_clearance = $ok[$i]; }
					 
					if ($inloop==5) { $recruiting_kp = $recruiting_hold; $opp_recruiting .= "<div style='width:340px; display:inline-block; vertical-align:top;'>$recruiting_jobtitle $temp_job<span style='float:right'>$recruiting_kp</span></div></DIV>"; $inloop=0; }	/*<span style='float:right'><i class='fa fa-expeditedssl' style='font-size:14px; margin-left:7px;' title='$recruiting_clearance'></i></span>*/
					$i++;
				}

				for($q=0; $q<count($recruiting_qty_array); $q++){
						if($recruiting_qty_array[$q][0] != ''){
							$total_recruiting_qty += $recruiting_qty_array[$q][0];
						}
				}	
				for($j=0; $j<count($recruiting_ftehrs_array); $j++){
					$total_recruiting_ftehrs += $recruiting_ftehrs_array[$j][0];
				}
		} else { $opp_recruiting = $opp_recruiting_in; }
	
	$opp_gaps = stripslashes(strtoupper($row[12]));	
	$opp_decision = $row[13];
	if($opp_decision != ''){
		$dis_btn_fld = "";
	}
	else
	{
		$dis_btn_fld = "disabled='disabled'";
	}
	$decision = "<option hidden selected value='" . $row[13] . "'>" . $row[13] . "</option>";	
	$decision_selector = "<select name='decision' title='$opp_decision' id='decision_edit$opp_opportunity_id' size='1' style='padding:2px 5px; width:100%; background:#fff;' onchange=\"blurfunction('decision',this.value, $opp_opportunity_id);\" {$dis_txt_fld}>
				  $decision
				  <option value=''></option>
				  $decision_list
				</select>";
	
// Added for Business Entity . Starts Here.
		$db_business_entity_value = "<option hidden selected value='" . $row[55] . "'>" . $row[55] . "</option>";	
		$no_of_awards = $row[56];
		$business_Entity_selector = "<select name='business_entity' title='$opp_decision' id='business_entity_edit$opp_opportunity_id' size='1' style='padding:2px 5px; width:100%; background:#fff; {$busi_entity_vis}' onchange=\"blurfunction('decision',this.value, $opp_opportunity_id);\" >
				  $db_business_entity_value  
				  <option value=''></option>
				  $business_entity_list
				</select>";
// Ends Here.

	$pop_parts = explode("|||",$row[14]);
	$contract_pop_address = "";
	$pop_parts = explode("|||",$row[14]);
	$contract_pop_address =  $pop_parts[0];
	
	if (strpos($row[14], '|||')!== false){ $contract_pop_city = $pop_parts[1]; $contract_pop_state = $pop_parts[2]; } else { $contract_pop_state = ""; $contract_pop_city = ""; }
	
	$contract_pop = str_replace("|||"," ",$row[14]);
	$pop_counter=0;
	$contract_pop = "";
		foreach($pop_parts as $pop_element)
		{
		$pop_counter++;
			if ($pop_counter % 3 == 0) { $contract_pop .= $pop_element . "<BR>"; }
			else 
			{ $contract_pop .= $pop_element . " "; }
		
		}
	$contract_period = strtoupper(str_replace("Period: ","",$row[15])); 	
	$period_array = explode('#',$row[15]);
	if($period_array[4] != ""){
		$contract_period = $period_array[2]."  BASE  ".$period_array[3]. "  +  " .$period_array[4]." OPTION ".$period_array[5];
	}elseif($period_array[2] != ""){
		$contract_period = $period_array[2]."  BASE  ".$period_array[3];
	}
	else
		{
		$contract_period = '';
		}
	if($period_array[0] != "" and $period_array[6] == "") {
		$transition_notes = " Transition In: ". $period_array[0]."  ".$period_array[1] ;
	}
	if($period_array[0] == "" and $period_array[6] != ""){
		$transition_notes = " EOS: ". $period_array[6]."  ".$period_array[7];
	}
	if($period_array[0] != "" and $period_array[6] != ""){
		$transition_notes = " Transition In: ". $period_array[0]."  ".$period_array[1]."  EOS: ". $period_array[6]."  ".$period_array[7];
	}
	
	$vehicle_one = $row[16];
	$vehicle_two = $row[17];
	
	$contract_vehicle = $row[18];

	/* update code starts by rajini */
		$contrctveh_in = $row[44];
$contract_vehicle_length = 1;									// added by me.
		if (strpos($contrctveh_in, '|||') !== false) {
				$ok = explode("|||",$contrctveh_in);
				$i = 0;
				$temp_variable = "";
				while($i<count($ok)){
					if($ok[$i] or $ok[$i+1]){
						$vtm = explode('+', $ok[$i+1]);
						if($vtm[1])
						$temp_variable .= $ok[$i]."&nbsp;-&nbsp;".$vtm[0]."&nbsp;-&nbsp;".$vtm[1]."<br/>";
						else
						$temp_variable .= $ok[$i]."&nbsp;-&nbsp;".$vtm[0]."<br/>";
					}
					$i = $i+2;
					$contract_vehicle_length += 1;				// added by me.
				}
		}		
		 else { 
			 $temp_variable = ''; 
		}
/* update code ends here */	
	$proposal_ida = explode(" ", $vehicle_one); 
	$proposal_idb = explode(" ", $vehicle_two);
	$proposal_id_a = $proposal_ida[0];
	$proposal_id_b = $proposal_idb[0];
	
	//START
	$incumbent_container = "";
	$more_incumbents = "";
	$incumbent_counter = 0;
	$extra_searcha = "";
	$extra_searchb = "";	    
	if (strlen($proposal_id_a)>2) { $extra_searcha = " OR (opp LIKE '%" . $proposal_id_a . "%') "; }
	if (strlen($proposal_id_b)>2) { $extra_searchb = " OR (opp LIKE '%" . $proposal_id_b . "%') "; }
	
	$find_incumbents = "SELECT incumbent_id, incumbent_name, opp, contract, reference_link, award_amount, spend_to_date, start_date, completion_date, ultimate_completion_date, website, current_pools, oasis_pools, contact_parts, in_forecast, taskorder, awarded_thru, eligible_incumbent, eligible_jv, incumbent_status, graduated, awarded_set_aside, incumbent_identified_by FROM incumbents_test WHERE (opportunity_id=$opp_opportunity_id) ORDER BY incumbent_status ASC"; 
	
	$incumbent_name = "";
$incumbent_container .= "
			<div id='accordion'>";

	$resultb = mysqli_query($mysqli_link, $find_incumbents);
	while($rowb = mysqli_fetch_array($resultb, MYSQLI_NUM))
		{
		$incumbent_id = $rowb[0];
		$incumbent_name = strtoupper(str_replace("(","<BR>(",$rowb[1]));
		$incumbent_identified_by = $rowb[22];
		$incumbent_opp = $rowb[2];
		$incumbent_taskorder = $rowb[3];
		$incumbent_ref_link = $rowb[4];
		$incumbent_award_amount = $rowb[5];
		$incumbent_spend_to_date = $rowb[6];
		
		$incumbent_award_amount_formatted = "";
		if (isset($incumbent_award_amount) && (floatval($incumbent_award_amount) > -1)) {
			$incumbent_award_amount_formatted = "$" . number_format(floatval($incumbent_award_amount), 0);
		}		
		$incumbent_spend_to_date_formatted = "";
		if (isset($incumbent_spend_to_date) && (floatval($incumbent_spend_to_date) > -1)) {
			$incumbent_spend_to_date_formatted = "$" . number_format(floatval($incumbent_spend_to_date), 0);
		}
		
		$incumbent_start_date = date('m/d/Y',strtotime($rowb[7]));
		$incumbent_completion = date('m/d/Y',strtotime($rowb[8]));
		$incumbent_ultimate = date('m/d/Y',strtotime($rowb[9]));
		$incumbent_website_url = $rowb[10];
		$current_pools = $rowb[11];
		$oasis_pools = $rowb[12];
	
		$contact_info = $rowb[13];
		$contact_info = preg_replace('/\|\|\|/', ' ', $contact_info, 1);
		$contact_info = str_replace('|||', ', ', $contact_info);
		$contact_info = rtrim($contact_info, ', ');

		$in_forecast = $rowb[14];
		$incumbent_contract_taskorder = $rowb[15];
		$awarded_thru = $rowb[16];
		if($rowb[21] != ''){
		$awarded_set_aside = $rowb[21];}else{$awarded_set_aside = 'N/A';}
		$eligible_incumbent = $rowb[17];
		$eligible_jv = $rowb[18];
		$incumbent_contract_status_new = $rowb[19];
		$graduated = $rowb[20];
		
		if($eligible_incumbent == 'eligible')
			{
			 $ischecked_eligible_incumbent = 'Incumbent is Eligible';
			}
			else if($eligible_incumbent == 'eligible_jv')
			{
				$ischecked_eligible_incumbent = 'Incumbent is Eligible with JV';
			}
			else if($eligible_incumbent == 'eligible_jv_member')
			{
				$ischecked_eligible_incumbent = 'Incumbent is Eligible with JV Member';
			}
			else if($eligible_incumbent == 'not_eligible')
			{
				$ischecked_eligible_incumbent = 'Incumbent is Not Eligible';
			}
		
		if($graduated != ''){
			$ischecked_graduated = date('m/d/Y', strtotime($graduated));
		}else{
			$ischecked_graduated = "N/A";
		}
		$incumbent_counter++;
		
		if ((strpos($incumbent_website_url, 'http')!== false) && (strlen($incumbent_website_url)>2)) {	//(strpos($haystack, $needle) !== false) 
			//FOUND REMOVE www.
			$incumbent_website_url = str_replace("www.","",$incumbent_website_url);
		} else {
			$incumbent_website_url = "https://" . $incumbent_website_url;
			$incumbent_website_url = str_replace("www.","",$incumbent_website_url);
		}
		
		$incumbent_website = "<a title='" . $incumbent_name . "' style='color:#2f40a2;' href='" . $incumbent_website_url . "' target='_blank'><img style='vertical-align: middle; height:16px; width:16px; margin-left:20px; position:relative; top:-1px;' src='hyperlink.jpg' alt='$incumbent_name'></a>";
		
		if($incumbent_ref_link != '') {
		$full_ref_link = "<a title='" . $incumbent_ref_link . "' style='color:#2f40a2;' href='" . $incumbent_ref_link . "' target='_blank'>GovWin</a>";
		}
		else
		{
		$full_ref_link = "";
		}


		$incumbent_container .= "
			<h4 style='background-color:#3b51b1; color:#ffffff';>
			<a style='color:#ffffff' href='addrole_incumbents.php?which_update_id=$opp_opportunity_id'>Incumbent Name</a>&nbsp;&nbsp;&nbsp;
			<b>$incumbent_name</b>
			</h4>
			
			<div>
			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Incumbent Identified By</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$incumbent_identified_by</div>

			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Incumbent Status</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$incumbent_contract_status_new</div>

			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Eligibilty</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>
				$ischecked_eligible_incumbent 
			</div>

			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>8(a) Graduation</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>
				".$ischecked_graduated."
			</div>

			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Contract - Task Order</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$incumbent_taskorder - $incumbent_contract_taskorder</div>
			
			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Awarded Thru</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$awarded_thru</div>

			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Awarded Set Aside</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$awarded_set_aside</div>
					
			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Award Amount</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$incumbent_award_amount_formatted</div>

			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Spend To Date</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$incumbent_spend_to_date_formatted</div>

			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Start Date</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$incumbent_start_date </div>
			
			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Completion Date</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$incumbent_completion</div>
			
			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Ultimate Completion</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$incumbent_ultimate</div>
						
			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Eligible Contract Vehicles</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$oasis_pools</div>

			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Reference Link</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$full_ref_link</div>

			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Website</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$incumbent_website_url</div>
			
	<!--	<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Contract Vehicle</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$contract_vehicle</div> -->
			
	<!--	<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>In Forecast</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$in_forecast</div>  -->
			
			<div class='incumbentvaluecss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/ '>Contact Info</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$contact_info</div>
			</div>";
			
		}
	$incumbent_container .= "</div>";
		 
	$opp_status = "<option hidden selected value='" . $row[19] . "'>" . $row[19] . "</option>"; 
	$status_text = $row[19];
	$agency = $row[20];
	$facility = $row[21]; //"<option value='" . $row[21] . "'>" . $row[21] . "</option>"; 
		if (strlen($facility)<1) { $facility='&nbsp;'; }
	$company_clearance = $row[22];
		if (strlen($company_clearance)<1) { $company_clearance='&nbsp;'; }	
	$certifications = $row[45];	
	$solicitation_docs = $row[46];
	    if($solicitation_docs != '') {
			$full_solicitation_docs = "<a title='" . $solicitation_docs . "' style='color:#2f40a2;' href='" . $solicitation_docs . "' target='_blank'>Link</a>";
		}else{
			$full_solicitation_docs = "N/A";
		}
/*
	$opportunity_link = $row[46];
	    if($opportunity_link != '') {
			$full_opportunity_link = "<a title='" . $opportunity_link . "' style='color:#2f40a2;' href='" . $opportunity_link . "' target='_blank'>Link</a>";
		}else{
			$full_opportunity_link = "N/A";
		}
	$sharepoint_link = $row[47];
	    if($sharepoint_link != '') {
			$full_sharepoint_link = "<a title='" . $sharepoint_link . "' style='color:#2f40a2;' href='" . $sharepoint_link . "' target='_blank'>Link</a>";
		}else{
			$full_sharepoint_link = "N/A";
		}
*/
	$qa_due = $row[24];
	
	$qa_due_date = "";
	$qa_due_time = "";
	if (strlen($qa_due>1)) {
	$phpdate = strtotime( $qa_due );
	$qa_due_date = date( 'm/d/Y', $phpdate ); 
	$qa_due_time = date( 'H:i', $phpdate ); 
	}
	if (strlen($qa_due>1)) {
		$qa_due_date = date("Y-m-d", strtotime($qa_due));
	}
	else
	{ $qa_due_date = ""; }
	
	$reason = stripslashes($row[25]);
	$manager = "<option hidden selected value='" . $row[26] . "'>" . $row[26] . "</option>";
	$opp_manager = $row[26];

	$support_managers = $row[47];
	if($support_managers != '') {
		$support_managers_array = json_decode($support_managers);
		$support_managers_list = "";
		if(count($support_managers_array) > 0) {
			foreach ($support_managers_array as $support_manager) {
				$support_managers_list .= $support_manager;
			} 
			$support_managers_list = implode(", ", $support_managers_array);
		}
	} else {
		$support_managers_list = 'Select Support Managers';
	}
//	if(($contract_vehicle_length-2) > 1){
		    $multi_manager_selector = "<div class='multiselect' style='width:100%;'>
									<div class='selectBox custom-select'>
										<div name='manager' id='dynamicManagers' style= {$dis_multi_select} onclick=showCheckboxes($opp_opportunity_id);>
												$support_managers_list
										</div>
									</div>
									<div id='selectMultipleManagers$opp_opportunity_id' style='padding: 2px 5px;background: #fff; display:none;'>
											$manager_list_withCheckBoxes
									</div>
							  </div>"; 	
//	}else{ 
			$manager_selector = "<select name='manager' id='manager_edit$opp_opportunity_id' size='1' style='padding:2px 5px; width:100%; background:#fff;' {$dis_txt_fld}>
				  $manager
				  <option value=''></option>
				  $manager_list
			</select>";
//	}
	$contract_vehicle_two = $row[29];	
	$secondary_address = str_replace("|||"," ",$row[30]); //$row[18];	
	$status_value = $row[31];
//	$transition_notes = $row[32];
	$submission_notes = stripslashes($row[33]);
	$is_submitted = $row[34];
	$is_archived = $row[35];
	$is_awarded = "<option hidden selected value='" . $row[36] . "'>" . $row[36] . "</option>";
	$opp_award_date = $row[37];
	if (empty($row[37])) { $opp_award_date=""; }
	$proposal_due = $row[23];
	$proposal_due_date = "";
	$proposal_due_time = "";
	if (strlen($proposal_due>1)) {
	$phpdate = strtotime( $proposal_due );
	$proposal_due_date_old = date( 'm/d/Y', $phpdate ); 
	$proposal_due_time = date( 'H:i', $phpdate ); 
	}

	if(strlen($proposal_due>1)) {
	$proposal_due_date = date("Y-m-d", strtotime($proposal_due));
	}
	else
	{ $proposal_due_date = ""; }

	$qa_timezone = "<option hidden selected value='" . $row[27] . "'>" . $row[27] . "</option>"; 
	$proposal_timezone = "<option hidden selected value='" . $row[28] . "'>" . $row[28] . 
	"</option>";
		
	$opp_rfp_date = $row[38];
	if (empty($row[38])) { $opp_rfp_date=""; } 

	$est_pop_start_date = $row[39];
		$est_pop_start_date = date("m/d/Y", strtotime($est_pop_start_date));
		if (empty($row[39])) { $est_pop_start_date=""; } 

	$notes_datateam = html_entity_decode($row[40]);
	$notes_datateam = preg_replace('/<a(?![^>]*target=)/i', '<a target="_blank"', $notes_datateam);// added to open link in new tab.

	$gaps_datateam = html_entity_decode($row[41]);
	$gaps_datateam = preg_replace('/<a(?![^>]*target=)/i', '<a target="_blank"', $gaps_datateam);// added to open link in new tab.

	$pricing_eval = $row[42];
	$subagency	= $row[43];	
		$domainsValue = "";
	if($row[48] != ""){
		$domains	= json_decode($row[48]);
		foreach($domains as $domain){
			$domainsValue .= $domain."<br/>";
		}
	}else{
		$domainsValue = "N/A";
	}

	if($row[49] != ""){
		$naicsCode	= $row[49];
	}else{
		$naicsCode	= "N/A";
	}

	if($row[50] != ""){
		$releases = explode('||',$row[50]);
		$i = 1;
		foreach($releases as $release){
			if($release != ''){
				$ids = explode('=',$release);
				$query = "SELECT response FROM excel_test WHERE opportunity_id=$ids[1]";
				$result = mysqli_query($mysqli_link, $query);
				$row = mysqli_fetch_array($result, MYSQLI_NUM);
				$prev_releases .= $i.") "."<a style='text-decoration: none;' href='$baseurl/addrole_view_opportunities.php?which_update_id=$ids[1]' target='_blank'>".$row[0]."</a><br/>";
				$i++;
			}
		}
	}else{
		$prev_releases	= "N/A";
	}

	if($row[51] != ""){
		$sizeStandard	= $row[51];
	}else{
		$sizeStandard	= "N/A";
	}
	
	$ron_cp_date = $row[52];
	$tyler_cp_date = $row[53];
	$team_cp_date = $row[54];

	$awarded_selector = "<select name='is_awarded' title='' id='is_awarded$opp_opportunity_id' size='1' style='padding:2px 5px; width:100%; /*border:1px solid #f0f0f0;*/' onchange=\"blurfunction('is_awarded',this.value, $opp_opportunity_id);\">
				  $is_awarded
				  <option value=''></option>
				  $awarded_list
				</select>";
	
	$is_submitteda = "";
	$is_archiveda = "";  
 // Added for Business Entity Field Starts Here.  	
	if($opp_decision == 'Bid'){
		$busi_entity_vis = "display:block;";
	}else{
		$busi_entity_vis = "display:none;"; 
	}
 // Added for Business Entity Field Ends Here.  	
	if ($is_submitted=='true') { $is_submitteda = "checked"; } else { $is_submitteda = ""; }
	if ($is_archived =='true') { $is_archiveda  = "checked";  } else { $is_archiveda = ""; }
	
	//is favourate code
	$is_favourate = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT myfav_bids FROM users WHERE user_id = '$_SESSION[user_id]' AND myfav_bids LIKE '%$opp_opportunity_id%'"));

	if($is_favourate['myfav_bids'] != '' and $is_favourate['myfav_bids'] != 'NULL') { $show_fav_img = "<a style='cursor:pointer;' onclick='blurfavsubmitted(false, $opp_opportunity_id)'>
		<img src='images/star-blue.gif' border='0' title='Click to remove from Favourite' style='width:18px; margin-bottom: 5px;' />
		</a>";  
		$fav_css_style = 'display:block';
		$fav_bids = json_decode($is_favourate['myfav_bids'], TRUE);
		$fav_reason = $fav_bids[$opp_opportunity_id];	
		$fav_text = 'Remove from my favorites';
		}else {
		 $show_fav_img = "<a style='cursor:pointer;' onclick='blurfavsubmitted(true, $opp_opportunity_id)'>
		<img src='images/star-gray.gif' border='0' title='Click to add to Favourite' style='width:18px; margin-bottom: 5px;' />
		</a>"; 
		$fav_css_style = 'display:none';
		$fav_reason = '';
		$fav_text = 'Add to my favorites';
		}
	// code ends here

	$opp_synopsis_cropped = $opp_synopsis; 
	$vehicle_part = "Opp Id";
	$vehicle_id_one = $vehicle_part;
	$vehicle_id_two = $vehicle_part;
	
	if (strpos(strtolower($vehicle_one), 'sb') !== false) {
    	$vehicle_id_one .= " SB ";
	}
	if (strpos(strtolower($vehicle_one), '8(') !== false) {
    	$vehicle_id_one .= " 8(a) ";
	}
	if (strpos(strtolower($vehicle_two), 'sb') !== false) {
    	$vehicle_id_two .=  " SB ";
	}
	if (strpos(strtolower($vehicle_two), '8(') !== false) {
    	$vehicle_id_two .= " 8(a) ";
	}
	if (strlen($vehicle_two)<2) { $vehicle_id_two = ""; }
	
	$contract_vehicle_image = "./images/vehicles/blank.png";
	$poc_name_output = "";

	$count_results++;
	if ($starting_table == $status_text) { $table_details = ""; } else { 
		$starting_table=$status_text; $type_change++;
			if ($type_change==1) { $table_details = "<div style='background-color:#fff; padding:5px 8px;'><strong>$status_text</strong>"; }
			if ($type_change> 1) { $table_details = "</div><div style='height:15px'></div><div style='background-color:#fff; padding:5px 8px;'><strong>$status_text</strong>"; } 
		}
		$table_details="";
	
	if ($status_text=='Award Monitoring') { 
	$outcome="
	<div class='fieldcss_blue' style='display:inline-block;width:148px;vertical-align:top; /*margin-bottom:2px;*/'>Outcome</div>
			<div class='' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>			
				<div class='valuecss_blue' style='display:inline-block;width:100%;vertical-align:top; /*margin-bottom:2px;*/ '>
				$awarded_selector
				</div>	  								
			</div>
	";
	} else { 
	$outcome=""; 
	}
		
	$table_content .= "
	<DIV style='background-color:#fff; border-left: 1px solid #676977; border-right: 1px solid #676977; border-bottom: 1px solid #676977; margin-bottom:12px;'>		
	<div style='width:29%;display:inline-block; vertical-align:top; padding:5px;'>	
			<!--start panel offset-->
		<div style='background:#f4f4f6;'>
			
			<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Vehicle(s) / Opp # / Set-Aside</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; '>
				<div style='display:inline-block;'>$temp_variable</div>
			</div>
		
			<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Domains</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; '>
				<div style='display:inline-block;'>$domainsValue</div>
			</div>	
			
			<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>NAICS Code</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; '>
				<div style='display:inline-block;'>$naicsCode</div>
			</div>

			<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Size Standard</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; '>
				<div style='display:inline-block;'>$sizeStandard</div>
			</div>

		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Release Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; '>$opp_released</div><BR>


<!-- ----------------------------------------- VIEW SECTION STARTS HERE ------------------------------------ -->
<div id='oppdet_view_$opp_opportunity_id'>

		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Opportunity Type</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; '>$opp_response_val</div>

		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Proposal Due Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; padding-top:5px; padding-bottom:5px;'>";
		$proposalTimeZone = explode(' ',$row[28]);
		if($proposal_due_date){
		$table_content .= date('m/d/Y H:i', strtotime($proposal_due)).' '.$proposalTimeZone[2];
	//	$table_content .= date('m/d/Y H:i', strtotime($proposal_due_date.' '.$proposal_due_time)).' '.$proposal_timezone;
		}
		else{
		$table_content .= "N/A"; 
		}

		$table_content .= "</div><BR>
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Q&A Due Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; padding-top:5px; padding-bottom:5px;'>";

		$qaTimeZone = explode(' ',$row[27]);	
		if($qa_due_date){
		$table_content .= date('m/d/Y H:i', strtotime($qa_due)).' '.$qaTimeZone[2];
	//	$table_content .= date('m/d/Y H:i', strtotime($qa_due_date.' '.$qa_due_time)).' '.$qa_timezone;
		}
		else{
		$table_content .= "N/A"; 
		}

		$table_content .= "</div><BR>
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>RFP Exp.Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'>
		";

		if($opp_rfp_date){
			$table_content .= date('m/d/Y', strtotime($opp_rfp_date));
		}
		else{
			$table_content .= "N/A"; 
		}


		$table_content .= "</div><BR>
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Award Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'>";

		if($opp_award_date){
			$table_content .= date('m/d/Y', strtotime($opp_award_date));
		}
		else{
			$table_content .= "N/A"; 
		}
		
/*		$table_content .= "</div><BR>
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>RON CP Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'>";
			if($ron_cp_date){
				$table_content .= date('m/d/Y', strtotime($ron_cp_date));
			}
			else{
				$table_content .= "N/A"; 
			}

		$table_content .= "</div><BR>
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Tyler CP Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'>";
			if($tyler_cp_date){
				$table_content .= date('m/d/Y', strtotime($tyler_cp_date));
			}
			else{
				$table_content .= "N/A"; 
			}

		$table_content .= "</div><BR>
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Team CP Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'>";
			if($team_cp_date){
				$table_content .= date('m/d/Y', strtotime($team_cp_date));
			}
			else{
				$table_content .= "N/A"; 
			}
*/
		
		$table_content .= "</div><BR>
		<div style='color: #fff;
			font-size: 12px;
			font-weight: 700;
			width: 120px;
			margin-left: auto;
			margin-right: 17px;
			border-radius: 3px;
			margin-top: 8px;
			margin-bottom: 2px;
			text-align: center;
			padding: 1px;'><button type='button' class='Btn_showEdit' value='$opp_opportunity_id'>Edit</button></div>

</div> 
<!-- ----------------------------------------- END OF VIEW SECTION ------------------------------------ -->

<!-- ----------------------------------------- EDIT SECTION STARTS HERE ------------------------------------ -->
<form name='oppdet' id='oppdet_$opp_opportunity_id' action='' method='POST'  style='margin:0px; padding:0px; display:none;'>
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Opportunity Type</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; '><select name='opp_response' size='1' required class='select-styled' style='border-left:5px solid #3c4db0; width: 100%;'>
				  $opp_response
				  <option value='Industry Day'>Industry Day</option>
				  <option value='RFI'>RFI</option>
				  <option value='Draft RFP'>Draft RFP</option>
				  <option value='RFP'>RFP</option>
				  <option value='RFQ'>RFQ</option>  
				  <option value='Forecast'>Forecast</option>
				  <option value='Ongoing'>Ongoing</option>
				</select></div>

<input type='hidden' id='opptypeedit$opp_opportunity_id' value='$opp_response_val'>
		
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Proposal Due Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; padding-top:5px; padding-bottom:5px;'>
<input style='width:82px; border:1px solid #cbcbcb;' type='date' id='proposal_date' name='proposal_date' value='$proposal_due_date'>
	 
	<input style='width:79px; border:1px solid #cbcbcb;' type='time' onchange='showproposal()' id='proposal_time' name='proposal_time' value='". $proposal_due_time."'>
	<select name='proposal_timezone' size='1' class='select-styled' style='width:100%; margin-top:3px;'>
				  $proposal_timezone
				  <option value=''></option>
				  <option value='Atlantic Time (AT)'>Atlantic  (AT)</option>
				  <option value='Eastern Time (ET)'>Eastern  (ET)</option>
				  <option value='Central Time (CT)'>Central  (CT)</option>
				  <option value='Mountain Time (MT)'>Mountain  (MT)</option>
				  <option value='Pacific Time (PT)'>Pacific  (PT)</option>
				  <option value='Alaskan Time (AKT)'>Alaskan  (AKT)</option>
				  <option value='Hawaii-Aleutian Time (HT)'>Hawaii-Aleutian  (HT)</option>
	</select>
	</div><BR>
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Q&A Due Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; padding-top:5px; padding-bottom:5px;'>
		<input style='width:82px; border:1px solid #cbcbcb;' type='date' id='qa_date' name='qa_date' value='$qa_due_date'>
	
	<input style='width:79px; border:1px solid #cbcbcb;' type='time' onchange='qatimezone()' id='qa_time' name='qa_time' value='". $qa_due_time ."'>
	<select name='qa_timezone' size='1' class='select-styled' style='width:100%; margin-top:3px;'>
				  $qa_timezone
				  <option value=''></option>
				  <option value='Atlantic Time (AT)'>Atlantic  (AT)</option>
				  <option value='Eastern Time (ET)'>Eastern  (ET)</option>
				  <option value='Central Time (CT)'>Central  (CT)</option>
				  <option value='Mountain Time (MT)'>Mountain  (MT)</option>
				  <option value='Pacific Time (PT)'>Pacific  (PT)</option>
				  <option value='Alaskan Time (AKT)'>Alaskan  (AKT)</option>
				  <option value='Hawaii-Aleutian Time (HT)'>Hawaii-Aleutian  (HT)</option>
	</select>
	</div><BR>
		
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>RFP Release Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'><input style='width:171px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='opp_rfp_date' name='opp_rfp_date' value='$opp_rfp_date'></div><BR>
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Award Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'><input style='width:171px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='opp_award_date' name='opp_award_date' value='$opp_award_date'></div>

		<!--<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>RON CP Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'><input style='width:171px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='opp_ron_cp_date' name='opp_ron_cp_date' value='$ron_cp_date'></div>

		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Tyler CP Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'><input style='width:171px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='opp_tyler_cp_date' name='opp_tyler_cp_date' value='$tyler_cp_date'></div>

		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Team CP Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'><input style='width:171px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='opp_team_cp_date' name='opp_team_cp_date' value='$team_cp_date'></div>-->
	
		<input type='hidden' name='oppid' value='$opp_opportunity_id'> <BR>

<div style='color: #fff;
    font-size: 12px;
    font-weight: 700;
    width: 120px;
	margin-left: auto;
	margin-right: 17px;
	border-radius: 3px; 
	margin-top: 8px;
	margin-bottom: 2px;
    text-align: center;
    padding: 1px;'><button type='button' id='oppBtn' onClick='submitoppform($opp_opportunity_id);'>Update</button>&nbsp;&nbsp;
	<button type='button' class='Btn_showView' value='$opp_opportunity_id'>Cancel</button></div>
</form>
<!-- ----------------------------------------- END OF EDIT SECTION ------------------------------------- -->

		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/'>Est. PoP Start Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$est_pop_start_date</div><BR>
		
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top; margin-bottom:4px;'>Certifications</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; margin-bottom:4px; '>$certifications</div><BR>

		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top; margin-top:4px;'>Solicitation Docs</div>
		<div class='fieldcss_left' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; margin-top:4px; word-wrap: break-word;'>$full_solicitation_docs</div>

		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top; margin-top:4px;'>Previous Releases</div>
		<div class='fieldcss_left' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; margin-top:4px; word-wrap: break-word;'>$prev_releases</div>

		</div> <!--end left panel offset-->
	
		<div class='valuecss' style='display:inline-block;width:calc(100%);vertical-align:top; height:280px; margin-top:0px; padding:4px 8px; overflow-y: scroll; overflow-wrap:break-word; border:1px solid #ccc;'>$opp_synopsis</div><br>
<div style='background:#f4f4f6;'>
<!--	<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top; margin-top:4px;'>Opportunity Link</div>
		<div class='fieldcss_left' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; margin-top:4px; word-wrap: break-word;'>$full_opportunity_link</div>

		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top; margin-top:4px;'>SharePoint Link</div>
		<div class='fieldcss_left' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; margin-top:4px; word-wrap: break-word;'>$full_sharepoint_link</div>  -->

		<div class='fieldcss_left' style='width:150px;vertical-align:top; margin-top:10px; /*margin-bottom:2px;*/'>Notes (Research Team)</div>
			<div class='valuecss' style='vertical-align:top; overflow-y: scroll; height:205px; margin-top:5px; border:1px solid #ccc; /*margin-bottom:2px;*/ '>$notes_datateam</div><BR>	
	</div>
	</div>
	
	<div style='width:34%;display:inline-block; vertical-align:top;/*margin-right:1%;*/padding:5px;'>
	
	<!--start panel offset-->
		<div style='background:#f4f4f6;'>

				<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/'>Department</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$agency</div>
		
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/'>Agency</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$subagency</div>
		
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/'>Requestor Name</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$opp_requestor</div><BR>
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top; margin-bottom:4px;'>Clearance Level</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; margin-bottom:4px; '>$company_clearance</div>
		<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/'>Expected Awards</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$no_of_awards</div><BR>
  			
			<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/'>Performance Location</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>
			$facility
			
			</div><BR>
			<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/'>Address</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$contract_pop<BR>$secondary_address</div><BR>
			<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/'>Period</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; /*margin-bottom:2px;*/ '>$contract_period<BR>$transition_notes</div><BR>
			
			
			<div class='fieldcss_left' style='display:inline-block;width:150px;vertical-align:top;'>Pricing</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; '>$opp_pricing $pricing_eval</div><BR>
			
				<div class='fieldcss_left' style='width:250px;vertical-align:top; margin-top:4px;'>Submission Requirements</div>
			<div class='valuecss' style='vertical-align:top; overflow-y: scroll; height:200px; margin-top:5px; border:1px solid #ccc;'>$opp_proposal</div><BR>
			
			<div class='fieldcss_left' style='width:250px;vertical-align:top;'>Gaps (Research Team)</div>
			<div class='valuecss' style='vertical-align:top; overflow-y: scroll; height:150px; margin-top:5px; border:1px solid #ccc; '>$gaps_datateam</div><BR>
		
		<!--PROPOSAL AREA BEGIN-->	
		<form name='proposalarea' id='proposalarea' action='$action_file_name' method='POST' onSubmit=\"return validateReasonText($opp_opportunity_id);\"  style='margin:0px; padding:0px;'>
		<div id='proposal_area' style='background-color:#e1ebff; padding: 6px 4px; margin-top:5px;'>	
			<div class='fieldcss_blue' style='display:inline-block;width:148px;vertical-align:top;'>Decision<font style='color:red'>*</font></div>
			<div class='' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'>			
				<div class='valuecss_blue' style='display:inline-block;width:100%; vertical-align:top;'>
				$decision_selector
				</div>								
			</div>

			<div class='fieldcss_blue' style='display:inline-block;width:148px;vertical-align:top;'>Manager</div>
			<div class='valuecss_blue' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'>
				<div class='valuecss_blue' style='display:inline-block;width:100%; vertical-align:top;'>
				$manager_selector
				</div>
			</div>

			<div class='fieldcss_blue' style='display:inline-block;width:148px;vertical-align:top;'> Support Manager</div>
			<div class='valuecss_blue' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'>
				<div class='valuecss_blue' style='display:inline-block;width:100%; vertical-align:top;'>
				$multi_manager_selector
				</div>
			</div>

			<div id='be{$opp_opportunity_id}' style='{$busi_entity_vis}'>
			<div class='fieldcss_blue' style='display:inline-block;width:148px;vertical-align:top;'> Business Entity</div>
			<div class='valuecss_blue' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'>
				<div class='valuecss_blue' style='display:inline-block;width:100%; vertical-align:top;'>
					$business_Entity_selector
				</div>
			</div>
			</div>

			<div class='fieldcss_blue' style='display:inline-block;width:148px;padding-top:4px'>Submission</div>
			<div class='valuecss_blue' style='display:inline-block;width:calc(100% - 160px);padding-top:4px'>
				<input type='checkbox' id='is_submitted$opp_opportunity_id' name='is_submitted' value='1' $is_submitteda onchange=\" blursubmitted('is_submitted',this.value, $opp_opportunity_id)\" {$dis_txt_fld}>
  				<label for='is_submitted'> Submitted</label>&nbsp;&nbsp;&nbsp;
				
  				<input type='checkbox' id='is_archived$opp_opportunity_id' name='is_archived' value='2' $is_archiveda onchange=\" blursubmitted('is_archived',this.value, $opp_opportunity_id)\" {$dis_txt_fld}>
  				<label for='is_submitted2'> Archive</label> <br>
			</div>
			
			<div class='fieldcss_blue' style='display:inline-block;width:148px;vertical-align:top;'>Reason (Bid/NoBid)</div>
			<div class='valuecss_blue' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'>
				<textarea id='reason$opp_opportunity_id' rows='3' name='reason_bid'  style='vertical-align:top; width:calc(100%); padding-left:7px; min-height:25px; width:100%;' {$dis_txt_fld}/>$reason</textarea>
				<div id='reasonError' style='color: red; font-weight: bold;'></div>
			</div>
			
			<div class='fieldcss_blue' style='display:inline-block;width:148px;vertical-align:top;'>Notes (Bid Team)</div>
			<div class='valuecss_blue' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'>
				
				
				<textarea id='submission' rows='3' name='submission_notes' style='vertical-align:top; width:calc(100%); padding-left:7px; min-height:25px; width:100%;' {$dis_txt_fld}>$submission_notes</textarea>
			</div>
		
			
			<div class='fieldcss_blue' style='display:inline-block;width:148px;vertical-align:top;'> Gaps (Bid Team)</div>
			<div class='valuecss_blue' style='display:inline-block;width:calc(100% - 160px);vertical-align:top;'>
				<textarea id='' rows='3' name='gaps_bidteam' style='vertical-align:top; width:calc(100%); padding-left:7px; min-height:25px; width:100%;' {$dis_txt_fld}>$opp_gaps</textarea>
			</div>
			
			<div class='fieldcss_blue' style='display:inline-block;width:148px;vertical-align:top;'>B&P Phase</div>
			<div class='valuecss_blue' style='display:inline-block;width:calc(100% - 160px);vertical-align:top; '>
				<select name='opp_status' id='opp_status$opp_opportunity_id'  size='1' style='padding:2px 5px; width:100%; background:#fff;' onchange=\"blurfunctionphase('status',this.value, $opp_opportunity_id);\" {$dis_txt_fld}>
				  $opp_status
				  $status_list
				  <option value=''></option>
				</select>
				<input type='hidden' name='oppid' id='oppid' value='$opp_opportunity_id'>
			</div>
			
			$outcome
			
	<div style='color: #fff;
    font-size: 12px;
    font-weight: 700;
    width: 120px;
	margin-left: auto;
	margin-right: 17px;
	border-radius: 3px;
	margin-top: 8px;
	margin-bottom: 2px;
    text-align: center;
    padding: 1px;'><input type='submit' name='submit' id='submitbtn$opp_opportunity_id' {$dis_txt_fld} {$dis_btn_fld} value='Submit'></div>
		</div>
		</form>
		<!--PROPOSAL AREA END-->
  	</div>
	
		<!--end panel offset-->
		</div>
  
	<div style='width:34%;display:inline-block; vertical-align:top;padding:5px; min-height:450px;'>

		<!--MAKE BID AS FAV BEGIN-->	
		<div style='display:flex'>
		<div class='fieldcss' style='width:150px;'><span class='favtext'>$fav_text</span></div>

		<div id='div_fav_$opp_opportunity_id' style='padding-left:10px'>
		$show_fav_img</div><div style='margin-left:216px'><a href='$baseurl/addrole_update_opportunities.php?which_update_id=$opp_opportunity_id' target='_blank'><img src='$baseurl/edit-pencil16.png' title='Edit'></a></div></div>

		<div id='div_favcommnt_$opp_opportunity_id' class='valuecss' style='display:block;width:calc(100%);vertical-align:top;     border-bottom: 1px solid #dddddf;'>
		<div id='div_favreason_$opp_opportunity_id' style='vertical-align:top; padding-bottom:8px; padding-left:2px; font-weight:bold; $fav_css_style'>
		<table>
		<tr>
			<td style='border:0px; background:#fff;'>Reason:</td>
			<td style='border:0px; background:#fff;'><textarea name='txtarea_fav_reason_$opp_opportunity_id' id='txtarea_fav_reason_$opp_opportunity_id' rows='2' cols='25'>$fav_reason</textarea></td>
		</tr>
		<tr>
			<td style='border:0px; background:#fff;'>&nbsp;</td>
			<td style='border:0px; background:#fff;'><input type='button' name='btn_fav_$opp_opportunity_id' id='btn_favsubmit_$opp_opportunity_id' value='Submit' onclick='favsubmitted($opp_opportunity_id)' /></td>
		</tr>
		</table>
		
		</div>
		</div>
		<!--MAKE BID AS FAV END-->
		
		<!--RECRUITING AREA BEGIN-->	
		<div style='display:flex'>
		<div class='fieldcss' style='width:150px;'>Recruiting</div>
		</div>

		<div class='valuecss' style='display:block;width:calc(100%);vertical-align:top;     border-bottom: 1px solid #dddddf;'>$opp_recruiting
		<div style='vertical-align:top; padding-bottom:8px; padding-left:2px; font-weight:bold'>LCATs: $jobTitle_count,  FTE(s): $total_recruiting_qty</div>
		</div>
		<!--RECRUITING AREA END-->
		
		<!--INCUMBENT AREA BEGIN-->
		<br/>
		<div class='fieldcss' style='display:inline-block;width:150px;vertical-align:top; '>Incumbent(s) <span style='float:right;background: #3b51b1;color: #fff; width:34px; font-size:9px; text-align:center; border-radius: 16px;'></span></div>
		<div class='valuecss' style='display:block;width:calc(100%);vertical-align:top; '>$incumbent_container</div>
		
		<!--</div>INCUMBENT AREA END-->
		
		<!--HISTORY AREA BEGIN-->
		<div onclick='toggleHistory(this)'>
		  <div class='fieldcss' style='display:inline-block;width:150px;vertical-align:top; /*margin-bottom:2px;*/'>History <span style='float:right;background: #3b51b1;color: #fff; width:34px; font-size:9px; text-align:center; border-radius: 16px; cursor: pointer; '>$history_count</span></div>
		  <div class='collapsible-content-history'>
			<div class='valuecss' style='display:block;width:calc(100%);vertical-align:top;>$history_builder</div>
		  </div>  
		  
		<div onclick='toggleDocuments(this)'>
				<div class='fieldcss' style='display:none;width:150px;vertical-align:top; /*margin-bottom:2px;*/'>Documents <span style='float:right;background: #e97a17;color: #fff; width:34px; font-size:9px; text-align:center; border-radius: 16px;'>$documents_list_counter</span></div>
			  
				<div class='collapsible-content-documents' style='display:none;'>
					<div style='font-size:10px;' class='doclink1'>$documents_list</div>
				</div>
				
		<div id='documentContainer' style='font-size:10px;' class='doclink1'>$documents_list</div>
		</div>
		
		</div>
		<!--</div>HISTORY AREA END-->
	</div>
		
</DIV>";
	}
?>

<?php
print($filterarea . "<div class='clearfix ' style='display:inline-block;vertical-align:top;/*border:1px solid #d1d1d1; width:96%; margin-left:2%;*/'>" . 
$header_part .  $table_content . "</table></div>"); 
?>
<!-- End page content -->
</div>

</body>
</html>
