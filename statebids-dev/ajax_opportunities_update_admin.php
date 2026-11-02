<?php
session_start();
$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;
?>
<!DOCTYPE html>
<html>
<head>
<script src="<?php echo $baseurl; ?>/tinymce/tinymce.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<link href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet">

  <style>
body, input, table, td, select, textarea {font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}
.samewidth { width:240px; font-weight:700;}
.td-left { /*background: #f9f9f9;*/ background-color:#fff; /*background:none;*/ border:none; /*border: 1px #dedede solid;*/ padding: 5px;}
.select-styled { padding: 4px 5px; /*font-weight: 500;*/ border: 1px solid #cbcbcb; width:200px; font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}

.tox .tox-statusbar__text-container.tox-statusbar__text-container--flex-start {
    display: none !important;
}

.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* The actual popup */
.popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #3c4db0;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: '';
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #3c4db0 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
</style>

<?php
$which_update_id=$_GET['which_update_id'];
print("<div style='text-align:center;font-size: 18px;font-weight: 700;color: #3c4db0;padding: 10px;'>Opportunity - Update</div>");

$form_portion = "<form name='opp_update' id='opp_update' method='post' action='opp_db_update2.php' onsubmit='return requiredfields();' >";
$form_table = $form_portion . "<table width='100%' border='0' cellspacing='5' cellpadding='5'>";
$form_update_content = "";

$state_dropdown_c = "";
$state_dropdown_c2 = "";

$state_dropdown="<select name='contract_state' id='contract_state' size='1' class='select-styled' style='width:60px;'>
				  <option value=''></option>
				  ";
$state_dropdown2="<select name='contract_state2' size='1' class='select-styled' style='width:60px;'>
				  <option value=''></option>";

$vehicles_dropdown = "";
$vehicle_query = "SELECT vehicle_name FROM state_contract_vehicles WHERE vehicle_show=1 ORDER BY vehicle_name";
$veh_result = mysqli_query($mysqli_link, $vehicle_query);
while($row = mysqli_fetch_array($veh_result, MYSQLI_NUM))
    {
	$db_veh_name = $row[0];
	$vehicles_dropdown .= "<option value='$db_veh_name'>$db_veh_name</option>";
	}

$btype_dropdown = "";
$btype_query = "SELECT bid_name FROM state_bidtype WHERE bid_show=1 ORDER BY bid_name";
$btype_result = mysqli_query($mysqli_link, $btype_query);
while($row = mysqli_fetch_array($btype_result, MYSQLI_NUM))
    {
	$db_btype_name = $row[0];
	$btype_dropdown .= "<option value='$db_btype_name'>$db_btype_name</option>";
	}

$query = "SELECT state_abbrev FROM states ORDER BY state_abbrev";
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
		$state_dropdown .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
		$state_dropdown2 .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
		$state_dropdown_d .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
		$state_dropdown_d2 .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
	}
	$state_dropdown .= "</select>";
	$state_dropdown2 .= "</select>";
	$state_dropdown_d .= "</select>";
	$state_dropdown_d2 .= "</select>";

$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_two, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, gaps_datateam, notes_datateam, pricing_eval, contract_pop2, award_date, rfp_date, est_pop_start_date, subagency, certifications, contract_vehicle, vehicle_one, contractveh_table, naics_code, web_url, bid_category, est_actual, intent_to_bid, intent_bid_date, submission_mode, pp_conference, pp_mandatory, pp_conference_date, pp_conference_timezone FROM state_excel_test WHERE opportunity_id = $which_update_id";
//print $query;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {//print_r($row);
	$opp_opportunity_id = $row[0];
	$opp_bidopp = $row[1];

	$opp_response = "<option hidden selected value='" . $row[2] . "'>" . $row[2] . "</option>"; 
	$btype_selector = "<select name='opp_response' id='opp_response' size='1' class='select-styled'>
	  $opp_response
	  <option value=''></option>
	  $btype_dropdown
	</select>";

	$opp_requestor = $row[3];
	$opp_title = $row[4];
	$opp_due = strtoupper($row[5]); 
	$opp_released = strtoupper($row[6]); 
	 
    $opp_released_old = date("m/d/Y", strtotime($opp_released));    
		
	$opp_pop = $row[7];
	$opp_synopsis = $row[8]; 
	$opp_proposal = $row[9]; 
	$opp_pricing_in = $row[10];  
	$opp_recruiting_in = $row[11];  
	
	$opp_pricing_a = "";
	$opp_pricing_b = "";
	$opp_pricing_c = "";
	$opp_pricing_d = "";
	$opp_pricing_e = "";
	$opp_pricing_f = "";
	$opp_pricing_g = "";
	$opp_pricing_h = "";
	$opp_pricing_i = "";
	$opp_pricing_j = "";
	$opp_pricing_k = "";
	$opp_pricing_l = "";
	$opp_pricing_m = "";
	
	$opp_pricing = $opp_pricing_in; 
	if (strlen($opp_pricing_in)>1) {
	$pricing_parts = explode("<BR>", $opp_pricing_in);
	//$opp_pricing = "";
	
		foreach ($pricing_parts as $pricing_option) {
			if ($pricing_option=='Firm Fixed-Price (FFP)') { $opp_pricing_a = "checked='checked'"; } 
			
			if ($pricing_option=='Cost-Reimbursement Actual Cost') { $opp_pricing_e = "checked='checked'"; }
			
			if ($pricing_option=='Time and Materials (T&M)') { $opp_pricing_k = "checked='checked'"; } 	
			
			if ($pricing_option=='Labor Hour (LH)') { $opp_pricing_l = "checked='checked'"; } 	
			
			if ($pricing_option=='Cost Plus Fixed Fee (CPFF)') { $opp_pricing_m = "checked='checked'"; } 	
	}
	}
	
	//$a = 'How are you?';
	$recruiting_start = "";
	if (strpos($opp_recruiting_in, '|||') !== false) {
	$ok = explode("|||",$opp_recruiting_in);
	//print_r($ok);
	//exit;
	$i = 0;
	$inloop = 0;
	$opp_recruiting = "";
	$temp_job = "";
	$temp_personal = "";
	$key_personal = "";
	while($i < count($ok))
	{
		$inloop++;
		if (($inloop==1) && ((count($ok)-$i)>1)) { $opp_recruiting .= "<DIV style='background-color:#fff; border-top:1px solid #d1d1d3; color:#4f8ccd;'>";  }
		if ($inloop==1) { $opp_recruiting .= "<div style='width:40px; display:inline-block; vertical-align:top;'>" . $ok[$i] . " </div>"; $pass_quantity=$ok[$i]; }
		if ($inloop==2) { $opp_recruiting .= "<div style='width:150px; display:inline-block; vertical-align:top;'>" . $ok[$i] . " </div>"; $pass_ftehours=$ok[$i];}
		if ($inloop==3) { $temp_job = $ok[$i]; $pass_labor=$ok[$i]; }
		
// Added by VNRao to display Key Persons Correct! Starts Here.					
		
		if($inloop==4) { 
			$key_personal = $ok[$i];
		}
		if($inloop==5) { 
			$clearance = $ok[$i];
		}
// Ends Here.					
							
	if ($inloop==4) { $opp_recruiting .= "<div style='width:40px; display:inline-block; vertical-align:top;'>" . $ok[$i] . "</div>"; }
	if ($inloop==5) { $opp_recruiting .= "<div style='width:80px; display:inline-block; vertical-align:top;'>" . $ok[$i] . "</div>"; } 
	if ($inloop==5) { $recruiting_start .= '
		<div name="opp_recruiting_start" id="opp_recruiting_start"><div style="color:#a269c6; width:90%; border:1px solid #d4d4d4;"><div style="display:inline-block; padding:5px 10px;">
		<input type="text" name="pt_a_238" value="'. $pass_quantity .'" style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:60px; border:none;"></div><div style="display:inline-block; padding:5px 10px;">
		<input type="text" name="pt_e_213" value="'. $pass_ftehours .'" style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:60px; border:none;"></div><div style="display:inline-block; padding:5px 10px;margin-left:4px;">
		<input type="text" name="pt_b" value="'. $pass_labor .'" style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:220px; border:none;"></div><div style="display:inline-block; padding:5px 10px;">
		<input type="text" name="pt_c" value="'. $key_personal .'" style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:50px; border:none;"></div><div style="display:inline-block; padding:5px 10px;">
		<input type="text" name="pt_d" value="'. $clearance .'" style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:180px; margin-left:7px; border:none;"></div><span style="background-color:#6450ae; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 14px; cursor: pointer;" onclick="this.parentElement.remove();refresh_table();"> Remove </span></div></div>
		'; }
					
			if ($inloop==5) { $opp_recruiting .= "<div style='padding-left:40px; font-weight:700;'>$temp_job</div></DIV>"; $inloop=0; }	
				$i++;
			}				
				
		} else { $opp_recruiting = $opp_recruiting_in; }
	
	$opp_gaps = $row[12];
	$opp_decision = $row[13]; 
	

	/* update code starts by rajini addr*/
		$pop_parts_in = $row[14];
		$addrdet = "";

		if(strpos($pop_parts_in, '|||') !== false) {
				$ok = explode("|||",$pop_parts_in);

				$addrdet_start .= '<div name="opp_address" id="opp_address">';
				for($i = 0; $i<count($ok);){
					if($ok[$i]){
				$addrdet_start .= '<div style="color:#a269c6; width:90%; border:1px solid #d4d4d4;"><div style="display:inline-block; padding:5px 10px;"><input type="text" name="adp_a_269" value="'. $ok[$i] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:260px; border:none;"></div><div style="display:inline-block; padding:5px 10px;"><input type="text" name="adp_b_282" value="'. $ok[++$i] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:260px; border:none;"></div><div style="display:inline-block; padding:5px 10px;"><input type="text" name="adp_c_289" value="'. $ok[++$i] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:260px; border:none;"></div><span style="background-color:#6450ae; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 14px; cursor: pointer;"onclick="this.parentElement.remove();refresh_addr();"> Remove </span></div>';
					}
				$i++;
				}

				$addrdet_start .= '</div>';

		}		
		 else { 
			 $addrdet = $pop_parts_in; 
		}

		$ContractPeriod = explode("#",$row[15]);
	$trans_in_qty = $ContractPeriod[0];
	$eos_qty = $ContractPeriod[6];

	$trans_in_time = "<option hidden selected value='" . $ContractPeriod[1] . "'>" . $ContractPeriod[1] . "</option>";
	$perioda = "<option hidden selected value='" . $ContractPeriod[2] . "'>" . $ContractPeriod[2] . "</option>";
	$periodb = "<option hidden selected value='" . $ContractPeriod[3] . "'>" . $ContractPeriod[3] . "</option>";
	$periodc = "<option hidden selected value='" . $ContractPeriod[4] . "'>" . $ContractPeriod[4] . "</option>";
	$periodd = "<option hidden selected value='" . $ContractPeriod[5] . "'>" . $ContractPeriod[5] . "</option>";
	$eos_time = "<option hidden selected value='" . $ContractPeriod[7] . "'>" . $ContractPeriod[7] . "</option>";
	/* update code ends here */

	$opp_status_readonly = $row[17];
	$opp_status = $row[17];
	$opp_status = "<option hidden selected value='" . $row[17] . "'>" . $row[17] . "</option>";
	
	$status_list = "";
	$status_query = "SELECT status_id, status_name FROM state_status_levels WHERE (status_show>0) ORDER BY status_show";
$status_result = mysqli_query($mysqli_link, $status_query);
while($rec = mysqli_fetch_array($status_result, MYSQLI_NUM))
    {
	//$db_status_id = $row[0];
	$db_status_name = $rec[1];
	$status_list .= "<option value='$db_status_name'>$db_status_name</option>";
	}

	//$agency = $row[18];
	$facility = "<option hidden selected value='" . $row[19] . "'>" . $row[19] . "</option>"; 
	$clearance_level = "<option hidden selected value='" . $row[20] . "'>" . $row[20] . "</option>";
	
	$proposal_due = $row[21];
	
	$proposal_due_date = "";
	$proposal_due_time = "";
	if (strlen($proposal_due>1)) {
	$phpdate = strtotime( $proposal_due );
	$proposal_due_date_old = date( 'm/d/Y', $phpdate ); 
	$proposal_due_time = date( 'H:i', $phpdate ); 
	}
	
	if (strlen($proposal_due>1)) {
	$proposal_due_date = date("Y-m-d", strtotime($proposal_due));
	}
	else
	{ $proposal_due_date = ""; }
	$qa_due = $row[22];
	
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
	
	$reason = strip_tags(html_entity_decode($row[23]));
	$manager = $row[24]; 
	
	$assigned = $row[16];
	
	//$manager_d = "<option hidden selected value='" . $row[24] . "'>" . $row[24] . "</option>";
	 
		if($assigned == 'Prasad Devarakonda') 
		{
		$ischecked_pd = 'selected';
		}
		if($assigned == 'Rama Krishna') 
		{
		$ischecked_rk = 'selected';
		}
	//$ischecked_rk = ($assigned == 'Rama Krisha') ? 'selected' : '';
	
	$qa_timezone       = "<option hidden selected value='" . $row[25] . "'>" . $row[25] . "</option>"; 
	$proposal_timezone = "<option hidden selected value='" . $row[26] . "'>" . $row[26] . "</option>"; 
	$pp_conf_timezone  = "<option hidden selected value='" . $row[49] . "'>" . $row[49] . "</option>"; 
	//contract_vehicle,vehicle_one->35,36
	$contract_vehicle_id = $row[37];
	//echo $row[37].' ====='.$row[36];
	$get_veh = "<option hidden selected value='" . $row[36] . "'>" . $row[36] . "</option>";
	$vehicles_selector = "<select name='contract_vehicle' id='edit_contract_vehicle' size='1' class='select-styled'>
	  $get_veh
	  <option value=''></option>
	  $vehicles_dropdown
	  <option value='Others'>Others</option>
	</select>";
	$get_state = "<option hidden selected value='" . $row[18] . "'>" . $row[18] . "</option>";
	$state_selector = "<select name='state' size='1' class='select-styled' style='width:60px;'>
	  $get_state
	  <option value=''></option>
	  $state_dropdown_d
	</select>";
	
	$gaps_datateam = $row[27];
	$notes_datateam = $row[28];
	$pricing_eval = "<option value='$row[29]'>$row[29]</option>";
	//$contract_pop2 = $row[33];
	$pop_partsb = explode("|||",$row[30]);
	$contract_pop_address2 = "";
	$contract_pop_city2 = ""; 
	$contract_pop_state2 = "";
	if (strpos($row[30], '|||')!== false) 
	{ 
	$contract_pop_address2 =  $pop_partsb[0];
	$contract_pop_city2 = $pop_partsb[1]; 
	$contract_pop_state2 = $pop_partsb[2]; 
	$state_dropdown_b2 = "<option value='" . $pop_partsb[2] . "'>" . $pop_partsb[2] . "</option><option value=''></option>";
	} 
	else { 
		$contract_pop_state2 = ""; $contract_pop_city2 = ""; $state_dropdown_b2 = "<option value=''></option>";
		}
	
	$opp_award_date = $row[31];
		 $opp_award_date = $row[31];
		if (empty($row[31])) { $opp_award_date=""; } 
		
		 
	$opp_rfp_date = $row[32];
		$opp_rfp_date_old = date("m/d/Y", strtotime($opp_rfp_date));
		if (empty($row[32])) { $opp_rfp_date=""; } 
	$opp_est_pop_start_date = $row[33];
		if (empty($row[33])) { $opp_est_pop_start_date=""; } 
	
	$subagency = $row[34];
	$ischecked_staffing = ($subagency == 'Staffing') ? 'checked' : '';
	$ischecked_project = ($subagency == 'Project') ? 'checked' : '';

	$certifications = $row[35];
	$deptagency = htmlspecialchars($row[38], ENT_QUOTES);
	$weburl = $row[40];
	$bid_category = $row[41];
	$est_actual = $row[42];
		if($est_actual == 'Estimate') 
			{
				$selected_1 = 'selected';
			}
		if($est_actual == 'Actual') 
			{
				$selected_2 = 'selected';
			}  
		//	$checked_1 = ($est_actual == 'LMS') ? 'checked' : '';
		//	$checked_2 = ($est_actual == 'Top Secret') ? 'checked' : '';
		$checked_1 = ($bid_category == 'Sole Source') ? 'selected' : '';
		$checked_2 = ($bid_category == 'COTS/Available Software') ? 'selected' : '';
		$checked_3 = ($bid_category == 'License/Hardware Procurement') ? 'selected' : '';
		$checked_4 = ($bid_category == 'Website Development') ? 'selected' : '';
		$checked_5 = ($bid_category == 'SWA') ? 'selected' : '';
		$checked_6 = ($bid_category == 'Non-IT') ? 'selected' : '';
		$checked_7 = ($bid_category == 'LMS') ? 'selected' : '';
		$checked_8 = ($bid_category == 'Scanning/Digitization') ? 'selected' : '';
		$checked_8_1 = ($bid_category == 'Artificial Intelligence') ? 'selected' : '';
		$checked_9 = ($bid_category == 'Others') ? 'selected' : '';

	$intent_to_bid =  $row[43];
	$intent_bid_date = $row[44];
	$submission_modes = json_decode($row[45]);
	$pp_conference = $row[46];
	$db_mandatory = $row[47];
	$pp_conference_date = $row[48];
	$pp_conference_time_zone = $row[49];
	
	if ($pp_conference_date != "") {
		$datePart = date('d-m-Y', strtotime($pp_conference_date)); 
		$timePart = date('H:i', strtotime($pp_conference_date)); 
	}
	
//	$db_pp_conf_timezone = ($pp_conference_time_zone == 'Sole Source') ? 'selected' : '';


	foreach ($submission_modes as $submission_modes_value) {
			if ($submission_modes_value == 'Postal') { $postal_checked = "checked='checked'"; } 
			
			if ($submission_modes_value == 'EMail') { $email_checked = "checked='checked'"; }
			
			if ($submission_modes_value == 'Online') { $online_checked = "checked='checked'"; } 	
	}
	
	$intent_to_bid_cheked_yes = ($intent_to_bid == 'Yes') ? 'checked' : '';
	$intent_to_bid_cheked_no  = ($intent_to_bid == 'No') ? 'checked' : '';

	if($intent_to_bid == 'Yes') {$display = "display:inline-block;";}
	if($intent_to_bid == 'No') {$display = "display:none;";}

	$pp_conference_yes = ($pp_conference == 'Yes') ? 'checked' : '';
	$pp_conference_no = ($pp_conference == 'No') ? 'checked' : '';

	if($pp_conference == 'Yes') {$display1 = "style='display:inline-block;'";}
	if($pp_conference == 'No') {$display1 = "style='display:none;'";}
	

	$mandatory_yes = ($db_mandatory == 'Yes') ? 'checked' : '';
	$mandatory_no = ($db_mandatory == 'No') ? 'checked' : '';

	$form_update_content .= "<tr><td width='160'><strong>Reason for update</strong> <span style='font-size:16px; font-weight:700; color:red'>*</span></td><td class='td-left'><div class='popup'>
	<input style='width:600px; border:1px solid #cbcbcb;  padding:5px;' name='update_reason' id='update_reason' autocomplete='off' placeholder='Max of 60 Characters.' type='text' value='' 
	maxlength='60' required /><span class='popuptext' >Title - Required Field</span></div></td></tr>";

	$form_update_content .= "<tr><td width='160'><strong>Title</strong> <span style='font-size:16px; font-weight:700; color:red'>*</span></td><td class='td-left'><div class='popup'>
	<input style='width:600px; border:1px solid #cbcbcb;  padding:5px;' name='opp_title' id='opp_title' required autocomplete='off' type='text' value='$opp_title' /><span class='popuptext' id='myPopup1'>Title - Required Field</span></div></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Master Contracts</strong> <span style='font-size:16px; font-weight:700; color:red'>*</span></td><td class='td-left'><div class='popup'>
	$vehicles_selector &nbsp;&nbsp; 

	<input style='width:204px; border:1px solid #cbcbcb; padding:5px; display:none;' name='edit_other_master_contract' id='edit_other_master_contract' type='text' />

	<strong>State</strong>$state_selector
	</div>
	<div style='font-weight:700; display:inline-block; vertical-align:top; margin-left:10px;'>ID</div>
	<div class='popup'>
	<input style='width:204px; border:1px solid #cbcbcb; padding:5px;' name='opp_vehicle_id' autocomplete='new-password' type='text' value='$contract_vehicle_id'/>
	</div>
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Release Date</strong> <span style='font-size:16px; font-weight:700; color:red'>*</span></td><td class='td-left'>
				<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' required type='date' id='opp_released' name='opp_released' value='$opp_released'> 
		</td></tr>";
	 
	$form_update_content .= "<tr><td><strong>Opportunity Type</strong></td><td class='td-left'>
		<div class='popup'>
				  $btype_selector &nbsp;&nbsp;<input type='radio' name='staffing' value='Staffing' $ischecked_staffing>Staffing &nbsp;<input type='radio' name='staffing' value='Project' $ischecked_project>Project
				</div>
				</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Assign to</strong></td><td class='td-left'>
	<div class='popup' >
	<select name='manager' size='1' class='select-styled'>
	  <!-- $manager_d -->
	  <option value='Prasad Devarakonda' $ischecked_pd>Prasad Devarakonda</option>
	  <option value='Rama Krishna' $ischecked_rk>Rama Krishna</option>
	</select></div></td></tr>";
// Code To Add Submission Mode Field Starts Here.
	$form_update_content .= "<tr><td><strong>Submission Mode</strong> <td class='td-left'>
	  <input type='checkbox' id='edit_submission_postal' name='edit_submission_mode[]' value='Postal' $postal_checked>
	  <label for='recruiting_keypersonnel'> Postal</label>&nbsp;&nbsp;&nbsp;
	  <input type='checkbox' id='edit_submission_email' name='edit_submission_mode[]' value='EMail' $email_checked>
	  <label for='recruiting_keypersonnel'> EMail</label>&nbsp;&nbsp;&nbsp;
	  <input type='checkbox' id='edit_submission_online' name='edit_submission_mode[]' value='Online' $online_checked>
	  <label for='recruiting_keypersonnel'> Online</label></td></tr>";
// Code To Add Submission Mode Field Ends Here.	
	$form_update_content .= "<tr><td><strong>Submission Due Date</strong></td><td class='td-left'>
	
	 <input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='proposal_date' name='proposal_date' value='$proposal_due_date'>
	 
	<input style='margin-left:10px; width:100px; border:1px solid #cbcbcb; padding:4px;' type='time' onchange='showproposal()' id='proposal_time' name='proposal_time' value='". $proposal_due_time ."'>
	<select name='proposal_timezone' size='1' class='select-styled'>
	  $proposal_timezone
	  <option value=''></option>
	  <option value='Atlantic Time (AT)'>Atlantic Time (AT)</option>
	  <option value='Eastern Time (ET)'>Eastern Time (ET)</option>
	  <option value='Central Time (CT)'>Central Time (CT)</option>
	  <option value='Mountain Time (MT)'>Mountain Time (MT)</option>
	  <option value='Pacific Time (PT)'>Pacific Time (PT)</option>
	  <option value='Alaskan Time (AKT)'>Alaskan Time (AKT)</option>
	  <option value='Hawaii-Aleutian Time (HT)'>Hawaii-Aleutian Time (HT)</option>
	</select>
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Q&A Due Date</strong></td><td class='td-left'>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='qa_date' name='qa_date' value='$qa_due_date'>
	
	<input style='margin-left:10px; width:100px; border:1px solid #cbcbcb; padding:4px;' type='time' onchange='qatimezone()' id='qa_time' name='qa_time' value='". $qa_due_time ."'>
	<select name='qa_timezone' size='1' class='select-styled'>
				  $qa_timezone
				  <option value=''></option>
				  <option value='Atlantic Time (AT)'>Atlantic Time (AT)</option>
				  <option value='Eastern Time (ET)'>Eastern Time (ET)</option>
				  <option value='Central Time (CT)'>Central Time (CT)</option>
				  <option value='Mountain Time (MT)'>Mountain Time (MT)</option>
				  <option value='Pacific Time (PT)'>Pacific Time (PT)</option>
				  <option value='Alaskan Time (AKT)'>Alaskan Time (AKT)</option>
				  <option value='Hawaii-Aleutian Time (HT)'>Hawaii-Aleutian Time (HT)</option>
	</select>
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Intent to Bid</strong></td><td class='td-left'>
	<div class='popup'>&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='radio' name='edit_intension' id='edit_intent_yes' value='Yes' $intent_to_bid_cheked_yes>Yes &nbsp;
	<input type='radio' name='edit_intension' id='edit_intent_no' value='No' $intent_to_bid_cheked_no>No
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
	<span id='edit_mandatory_show' style='font-size:16px; font-weight:700; color:red; $display' title='Required Field'>*</span>
	&nbsp;<input style='width:200px; border:1px solid #cbcbcb; padding:5px; $display' type='date' id='edit_intent_bid_date' name='edit_intent_bid_date' value='$intent_bid_date'>
	</div>
	</td></tr>";

/*	if($intent_to_bid == 'Yes'){
	$form_update_content .= "<span id='db_edit_mandatory_show' style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span>
	&nbsp;
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='db_intent_bid_date' name='db_intent_bid_date' value='".$intent_bid_date."'>"; } 
    $form_update_content .= "</div>
	</td></tr>"; */

	$form_update_content .= "<tr><td><strong>RFP Release Date</strong></td><td class='td-left'>
	
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='opp_rfp_date' name='opp_rfp_date' value='$opp_rfp_date'>
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Award Date</strong> <!--<span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span>--></td><td class='td-left'>
	
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='opp_award_date' name='opp_award_date' value='$opp_award_date'>
	</td></tr>";
	

	$form_update_content .= "<tr><td><strong>Bid Category</strong></td><td class='td-left'>
		<select name='edit_bid_category' id='edit_bid_category' size='1' class='select-styled'	style='width:200px;'>
			<option value=''></option>
			<option value='Sole Source' $checked_1>Sole Source</option>
			<option value='COTS/Available Software' $checked_2>COTS/Available Software</option>
			<option value='License/Hardware Procurement' $checked_3>License/Hardware Procurement</option>
			<option value='Website Development' $checked_4>Website Development</option>
			<option value='SWA' $checked_5>SoftWare/App Development</option>
			<option value='Non-IT' $checked_6>Non-IT</option>
			<option value='LMS' $checked_7>LMS</option>
			<option value='Scanning/Digitization' $checked_8>Scanning/Digitization</option>
			<option value='Artificial Intelligence' $checked_8_1>Artificial Intelligence</option>
			<option value='Others' $checked_9>Others</option>
		</select>
	<!--<input type='checkbox' name='edit_bid_category' value='LMS' $checked_1>&nbsp;LMS &nbsp;
	<input type='radio' name='edit_bid_category' value='Top Secret' $checked_2>Top Secret-->
	</td></tr>";

	$form_update_content .= "<tr><td><strong>Est/Actual</strong></td><td class='td-left'>
	<select name='edit_est_actual' id='edit_est_actual' size='1' class='select-styled' style='width:200px;'>
		<option value=''></option>
		<option value='Estimate' $selected_1>Estimate</option>
		<option value='Actual' $selected_2>Actual</option>
	</select>
	</td></tr>";



	/*$form_update_content .= "<tr><td><strong>Est. PoP Start Date</strong></td><td class='td-left'>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='est_pop_start_date' name='est_pop_start_date' value='$opp_est_pop_start_date'>
	</td></tr>";*/
	
	$form_update_content .= "<tr><td><strong>Department/Agency</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='agency' autocomplete='off' type='text' value='".$deptagency."' /></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Certifications</strong></td><td class='td-left'><input style='width:404px; border:1px solid #cbcbcb; padding:5px;' name='certifications' type='text' value='$certifications' /></td></tr>";

	$form_update_content .= "<tr><td><strong>URL</strong></td><td class='td-left'><input style='width:404px; border:1px solid #cbcbcb; padding:5px;' name='weburl' type='text' value='$weburl' /></td></tr>";

	$form_update_content .= "<tr><td><strong>Pre-Proposal Conference </strong></td><td class='td-left'>
	<div class='popup'> 
	<input type='radio' name='edit_pp_conference' id='edit_pp_conference_yes' value='Yes' $pp_conference_yes>Yes &nbsp;
	<input type='radio' name='edit_pp_conference' id='edit_pp_conference_no' value='No' $pp_conference_no>No
	<!--</div>-->
	&nbsp;&nbsp;&nbsp;
	<span id='edit_mandatory_field' $display1'>
	<strong>Mandatory  </strong>
	<!--<div class='popup'>-->
	<input type='radio' name='edit_mandatory' id='edit_mandatory_yes' value='Yes' $mandatory_yes>Yes &nbsp;
	<input type='radio' name='edit_mandatory' id='edit_mandatory_no' value='No' $mandatory_no>No
	&nbsp;
	<!--<span id='mandatory_show' style='font-size:16px; font-weight:700; color:red; display:none' title='Required Field'>*</span>-->
	<input style='width:126px;; border:1px solid #cbcbcb; padding:5px;' type='date' name='edit_pp_conference_date' id='edit_pp_conference_date' value=''>
	<input style='margin-left:10px; width:95px; border:1px solid #cbcbcb; padding:4px;' type='time' id='edit_pp_conf_time' name='edit_pp_conf_time' value='$timePart' onchange='edit_function_pp_conf_timezone()'>
	<span id='edit_pp_conf_timezone_id' font-weight:700; margin-left:10px;'>  
	<select name='edit_pp_conf_timezone' id='edit_pp_conf_timezone' size='1' class='select-styled' style='margin-left:10px; width: 180px; display:none;'>
		$pp_conf_timezone
				  <option value='Not Provided'>Not Provided</option>
				  <option value='Atlantic Time (AT)'>Atlantic Time (AT)</option>
				  <option value='Eastern Time (ET)'>Eastern Time (ET)</option>
				  <option value='Central Time (CT)'>Central Time (CT)</option>
				  <option value='Mountain Time (MT)'>Mountain Time (MT)</option>
				  <option value='Pacific Time (PT)'>Pacific Time (PT)</option>
				  <option value='Alaskan Time (AKT)'>Alaskan Time (AKT)</option>
				  <option value='Hawaii-Aleutian Time (HT)'>Hawaii-Aleutian Time (HT)</option>
				  <option value='Local Time'>Local Time</option>
	</select> </span>

	<!--<input style='margin-left:10px; width:100px; border:1px solid #cbcbcb; padding:4px;' type='time' onchange='qatimezone()' id='edit_pp_conf_time' name='edit_pp_conf_time' value='$pp_conf_time'>-->
	</span>
    </div>
	</td></tr>";

	$form_update_content .= "<tr><td><strong><div>Description</div></strong></td><td class='td-left'>
			<div style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='opp_synopsis' name='opp_synopsis'>$opp_synopsis</textarea>
			</div>
	</td></tr>";

	$form_update_content .= "<tr><td><strong>Performance Location</strong></td><td class='td-left'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='contract_pop' id='contract_pop' autocomplete='new-password' type='text' value='' />
	 <div style='font-weight:700; width:50px; display:inline-block; vertical-align:top; margin-left:10px;'>City</div><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='contract_city' id='contract_city' autocomplete='new-password' type='text' value='' />
	 <div style='font-weight:700; width:50px; display:inline-block; vertical-align:top; margin-left:10px;'>State</div>$state_dropdown"; 
	 
	 $form_update_content .="<div style='background-color: #e4e4e4;
    padding: 4px;
    width: 80px;
    text-align: center; margin-top:10px;
    font-weight: 700; display:inline-block; margin-left: 20px; margin-bottom:10px; cursor: pointer;' onclick='address_table();
  '>Add</div></td></tr>";
	 
	$form_update_content .="<tr><td colspan='3'>
    $addrdet_start
    <div name='opp_address' id='opp_address'></div>
		<input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='combined_table' id='combined_table' type='hidden' value='$pop_parts_in' />
		<div style='visibility: hidden;' onclick='refresh_addr(); alert(\"refresh\");'>REFRESH</div>
		</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Period</strong></td><td class='td-left'>
	<fieldset style='width:134px; display:inline-block; border:1px solid #eaeaea; vertical-align: top;'>
  		<legend  style='font-size: 13px; font-weight: 700;'>Transition In</legend>
		<input name='trans_in_qty' id='trans_in_qty' autocomplete='new-password' maxlength='6' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' value='$trans_in_qty' style='width:40px; border:1px solid #cbcbcb; padding:5px;'/>
		
	<select name='trans_in_time' size='1' class='select-styled' style='width:80px;'>
	$trans_in_time
	  <option value=''></option>
	  <option value='DAY(S)'>DAY(S)</option>
	  <option value='WEEK(S)'>WEEK(S)</option>
	  <option value='MONTH(S)'>MONTH(S)</option>
	</select>
	</fieldset>
	<span style='color: #e6e7ed; font-weight: 700; font-size: 20px;'>+</span> 
	<fieldset style='width:210px; display:inline-block; border:1px solid #eaeaea; vertical-align: top;'>
  		<legend  style='font-size: 13px; font-weight: 700;'>Base</legend>
		<select name='perioda' size='1' class='select-styled' style='width:60px;'>
		$perioda
	  <option value=''></option>
	  <option value='1'>1</option>
	  <option value='2'>2</option>
	  <option value='3'>3</option>
	  <option value='4'>4</option>
	  <option value='5'>5</option>
	  <option value='6'>6</option>
	  <option value='7'>7</option>
	  <option value='8'>8</option>
	  <option value='9'>9</option>
	  <option value='10'>10</option>
	  <option value='11'>11</option>
	  <option value='12'>12</option>
	</select> 
<!-- <span style='color: #3c4db0;font-weight: 700;'>BASE</span> --> 
	<select name='periodb' size='1' class='select-styled' style='width:100px;'>
	$periodb
		<option value=''></option>
	  <option value='MONTH(S)'>MONTH(S)</option>
	  <option value='YEAR(S)'>YEAR(S)</option>
	</select>
	</fieldset>
 <span style='color: #e6e7ed; font-weight: 700; font-size: 20px;'>+</span>  
 
 	<fieldset style='width:225px; margin-left:20px; display:inline-block; border:1px solid #eaeaea; vertical-align: top;'>
  		<legend  style='font-size: 13px; font-weight: 700;'>Option</legend>
		<select name='periodc' size='1' class='select-styled' style='width:60px;'>
		$periodc
	  <option value=''></option>
	  <option value='1'>1</option>
	  <option value='2'>2</option>
	  <option value='3'>3</option>
	  <option value='4'>4</option>
	  <option value='5'>5</option>
	  <option value='6'>6</option>
	  <option value='7'>7</option>
	  <option value='8'>8</option>
	  <option value='9'>9</option>
	  <option value='10'>10</option>
	  <option value='11'>11</option>
	  <option value='12'>12</option>
	</select> 
 <!-- <span style='color: #3c4db0;font-weight: 700;'>OPTION</span> -->
	<select name='periodd' size='1' class='select-styled' style='width:100px;'>
$periodd
	  <option value=''></option>
	  <option value='MONTH(S)'>MONTH(S)</option>
	  <option value='YEAR(S)'>YEAR(S)</option>
	</select>
		
	</fieldset>
	
	<span style='color: #e6e7ed; font-weight: 700; font-size: 20px;'>+</span> 
	
	<fieldset style='width:136px; display:inline-block; border:1px solid #eaeaea; vertical-align: top;'>
  		<legend style='font-size: 13px; font-weight: 700;'>EOS</legend>
		<input name='eos_qty' id='eos_qty' autocomplete='new-password' maxlength='6' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' value='$eos_qty' style='width:40px; border:1px solid #cbcbcb; padding:5px;'/>
		
	<select name='eos_time' size='1' class='select-styled' style='width:80px;'>
	$eos_time
	  <option value=''></option>
	  <option value='DAY(S)'>DAY(S)</option>
	  <option value='WEEK(S)'>WEEK(S)</option>
	  <option value='MONTH(S)'>MONTH(S)</option>
	</select>
	</fieldset>
	</td></tr>";	
	
	$form_update_content .= "<tr><td><strong>Pricing</strong></td><td class='td-left'>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Fixed-Price</div>
	  <input type='checkbox' id='pricing1' name='pricing1' value='Firm Fixed-Price (FFP)' onclick=\"pricing_update();\" $opp_pricing_a>
	  <label for='pricing1'> Firm Fixed-Price (FFP)</label>
	  
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Cost-Reimbursement</div>
	  <input type='checkbox' id='pricing5' name='pricing5' value='Cost-Reimbursement Actual Cost' onclick=\"pricing_update();\" $opp_pricing_e>
	  <label for='pricing5'> Cost-Reimbursement Actual Cost</label>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Time and Materials (T&M)</div>
	  <input type='checkbox' id='pricing11' name='pricing11' value='Time and Materials (T&M)' onclick=\"pricing_update();\" $opp_pricing_k>
	  <label for='pricing11'> Time and Materials (T&M)</label>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Labor Hour (L-H)</div>
	  <input type='checkbox' id='pricing12' name='pricing12' value='Labor Hour (LH)' onclick=\"pricing_update();\" $opp_pricing_l>
	  <label for='pricing12'> Labor Hour (L-H)</label>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Cost Plus Fixed Fee (CPFF)</div>
	  <input type='checkbox' id='pricing13' name='pricing13' value='Cost Plus Fixed Fee (CPFF)' onclick=\"pricing_update();\" $opp_pricing_m>
	  <label for='pricing12'> Cost Plus Fixed Fee (CPFF)</label>
	  </div>
	  
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Evaluation</div>
		  <select name='pricing_eval' class='select-styled'>
	  $pricing_eval
	  <option value=''></option>
	  <option value='LPTA'>LPTA</option>
	  <option value='Best Value'>Best Value</option>
		  </select>
	  </div>
	  ";
	  
	$form_update_content .= "
	
	<input style='width:100%; border:1px solid #cbcbcb; padding:5px;' id='opp_pricing' name='opp_pricing' type='hidden' value='' /></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Recruiting</strong></td><td class='td-left'>
	<div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>FTE(s)</div>
		  <input name='recruitinga' id='recruitinga' autocomplete='new-password' maxlength='6' type='text' value='' style='width:110px; border:1px solid #cbcbcb; padding:5px;'/>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Hour(s)</div>
		  <input name='recruitinge' id='recruitinge' autocomplete='new-password' maxlength='6' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' value='' style='width:60px; border:1px solid #cbcbcb; padding:5px;'/>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Labor Category</div>
	  <input name='recruitingb' id='recruitingb' autocomplete='new-password' type='text' value='' style='width:220px; border:1px solid #cbcbcb; padding:5px;'/>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700; width:100px;'>Personnel</div>
	  <input type='checkbox' id='recruiting_keypersonnel' name='recruiting_keypersonnel' value='Key Personnel'>
	  <label for='recruiting_keypersonnel'> KP</label>
	  <input type='checkbox' id='recruiting_sca' name='recruiting_sca' value='SCA Personnel'>
	  <label for='recruiting_keypersonnel'> SCA</label>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Clearance</div>
		  <select name='recruitingd' id='recruitingd' size='1' class='select-styled' style='width:100px;'>
		  <option value=''></option>
		  <option value='Not Applicable'>Not Applicable</option>
		  <option value='Public Trust'>Public Trust</option>
		  <option value='Confidential'>Confidential</option>
		  <option value='Secret'>Secret</option>
		  <option value='Top-Secret'>Top-Secret</option>
		  <option value='Top-Secret w/SCI'>Top-Secret w/SCI</option>
		  </select>
	  </div>
	  
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'></div>
		  
  
  <div style='background-color: #e4e4e4;
    padding: 4px;
    width: 80px;
    text-align: center; margin-top:10px;
    font-weight: 700; cursor: pointer;' onclick='recruiting_table();
  '>Add</div>
	  </div>
	  $recruiting_start
	  <DIV name='opp_recruiting' id='opp_recruiting'></div>
		<input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='combined' id='combined' type='hidden' value='$opp_recruiting_in' />
		
		 <DIV style='visibility: hidden;' onclick='refresh_table(); alert(\"refresh\");'>REFRESH</div> 
	
	</td></tr>";

	$form_update_content .= "<tr><td><strong><div>Submission <br/>Requirements</strong></div></td><td class='td-left'>
	
			<div style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='opp_proposal' name='opp_proposal'>$opp_proposal</textarea>
			</div>
	
	</td></tr>";

	$form_update_content .= "<tr><td><strong>Gaps (Research Team)</strong></td><td class='td-left'>
	
			<div style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='gaps_datateam' name='gaps_datateam'>$gaps_datateam</textarea>
			</div>
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Notes (Research Team)</strong></td><td class='td-left'>
	
			<div style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='notes_datateam' name='notes_datateam'>$notes_datateam</textarea>
			</div>
	</td></tr>";
	
	
	$form_update_content .= "<tr><td><strong>Decision</strong></td><td class='td-left'><input style='width:600px; border:none; padding:5px;' name='opp_decision' type='text' value='$opp_decision' readonly/>
				
	</td></tr>";
	
	//$form_update_content .= "<tr><td><strong>Assigned To</strong></td><td class='td-left'><input style='width:600px; border:none; padding:5px;' name='manager' type='text' value='$manager' readonly/></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Reason</strong></td><td class='td-left'><input style='width:600px; border:none; padding:5px;' name='reason' type='text' value='$reason' readonly/></td></tr>";

	$form_update_content .= "<tr><td><strong>Gap(s)</strong></td><td class='td-left'><input style='width:600px; border:none; padding:5px;' name='opp_gaps' type='text' value='$opp_gaps' readonly/></td></tr>";
	
		$form_update_content .= "<tr><td><strong>Gap(s)</strong></td><td class='td-left'><input style='width:600px; border:none; padding:5px;' name='opp_gaps' type='text' value='$opp_gaps' readonly/></td></tr>";
	
		if($opp_status_readonly == 'Archived' && $_SESSION['user_role']=='admin') {
		$form_update_content .= "<tr><td><strong>B&P Phase</strong></td>
		<td>
		<select name='opp_status' id='opp_status' size='1' style='padding:2px 5px; width:20%; background:#fff;'>
		  $opp_status
		  $status_list
		  <option value=''></option>
		</select></td></tr>";
	  }
	  else
		{
		$form_update_content .= "<tr><td><strong>B&P Phase</strong></td><td class='td-left'><input style='width:600px; border:none; padding:5px;' name='opp_status' type='text' value='$opp_status_readonly' readonly/></td></tr>";
		}
	}
	
	$extra_top_buttons = "
<div style=\"display:inline-block; width:98%; text-align:left;\">

<!-- <div style=\"display:inline-block; width:48%; vertical-align:top;\">
	<div onclick=\"window.top.location.href = '$baseurl/addrole_incumbents.php?which_update_id=$which_update_id'\" style=\"
    width: 100px;
    padding: 6px;
    background-color: #ebeaea;
    text-align: center;
    font-weight: 700;
    border: 1px solid #767676;
    border-radius: 4px;
    margin-left: 50px;
	cursor: pointer;
\">Incumbent(s)</div>
</div> -->
<div style=\"display:inline-block; width:90%;\">
<input style=\"margin-right: 50px; padding:4px 16px; font-weight: 700;  width:100px; cursor: pointer; float:right;\" type=\"submit\" value=\"Update\"></div>
</div>";
	
	print ($form_table . $extra_top_buttons . $form_update_content . "</table>");
?>

<input type="hidden" name="opp_opportunity_id" value="<?php print $opp_opportunity_id; ?>"/>
<div>
<?php print("<div style=\"display:inline-block; width:98%; text-align:left;\">

<!-- <div style=\"display:inline-block; width:48%; vertical-align:top;\">
	<div onclick=\"window.top.location.href = '$baseurl/addrole_incumbents.php?which_update_id=$which_update_id'\" style=\"
    width: 100px;
    padding: 6px;
    background-color: #ebeaea;
    text-align: center;
    font-weight: 700;
    border: 1px solid #767676;
    border-radius: 4px;
    margin-left: 50px;
	cursor: pointer;
\">Incumbent(s)</div>
</div> -->
<div style=\"display:inline-block; width:90%;\">
<input style=\"margin-right: 50px; padding:4px 16px; font-weight: 700;  width:100px; float:right; cursor: pointer;\" type=\"submit\" value=\"Update\"></div>
</div>"); ?>
</div>
</form>

<div style='margin-top:30px;'></div>
<div style='text-align:center;font-size: 18px;font-weight: 700;color: #3c4db0;padding: 10px;'>Document(s)</div>
<div style="padding:10px 10px; text-align:center;background-color: #fcfcfc;
    border-top: 1px solid #b3b5c2; border-bottom: 1px solid #b3b5c2;">
    <input style="font-weight:700; width:420px;" id="sortpicture" type="file" name="file" id="file" /><button id="upload" style="cursor: pointer;">Upload</button></div>
<div></div>
<?php
print("<div id='phpout_partner'>");
$partner_list = "";
	$query = "SELECT opportunity_id, filename, filedesc, filetype, filetimestamp FROM state_documents WHERE opportunity_id=$opp_opportunity_id";
	$result = mysqli_query($mysqli_link, $query);
	//print $query;
	while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
		$screen_opportunity_id = $row[0];
		$screen_filename = $row[1];
		$screen_filedesc = ucfirst($row[2]);
		$screen_filetype = strtoupper($row[3]);
		$screen_filetime = strtotime($row[4]);
		$screen_filetimeformatted = date("m/d/Y", $screen_filetime);
		$partner_list .= "<div style='padding:3px;'>
		<div style='width:68%; display:inline-block;'><a style='color:#181818;' href='$baseurl/documents/" . $screen_filename . "' target='_blank'>" . $screen_filedesc . "</a></div>
		<div style='width:15%; display:inline-block;'>$screen_filetype</div>
		<div style='width:15%; display:inline-block;'>$screen_filetimeformatted</div>
		</div>";
	}
	print $partner_list;
print("</div>"); 
?>
</html>
<script>
$(document).ready(function() {
$('#upload').on('click', function() {
	
	var form_data = new FormData();
	form_data.append('file', $('#sortpicture')[0].files[0]);
    form_data.append('ref_opportunity_id', '<?php print($which_update_id);?>');
    //alert(form_data);            

    $.ajax({
        url: '<?php echo $baseurl; ?>/upload.php',  
        dataType: 'text', 
		enctype: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false, 
		data: form_data,                      
        type: 'post',
        success: function(php_script_response){
			$("#file").val('');
			$("#phpout_partner").html(php_script_response);
        }
     });
});
});
</script>

<script>
  tinymce.init({
  selector: 'textarea',
  height: 250,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'template paste textcolor colorpicker textpattern imagetools codesample toc help'
  ],
  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
  image_advtab: true,
  forced_root_block : 'div',
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
  ]
});
  </script>

<script>
function pricing_update() {
	var pricing_text = "";
	document.getElementById('opp_pricing').value = "";
	if (document.getElementById('pricing1').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing1').value + '<BR>'; }
	if (document.getElementById('pricing5').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing5').value + '<BR>'; }
	if (document.getElementById('pricing11').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing11').value + '<BR>'; }
	if (document.getElementById('pricing12').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing12').value + '<BR>'; }
	if (document.getElementById('pricing13').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing13').value + '<BR>'; }
}
</script>
<script>
//AUTOSTART
pricing_update();
</script>
<script>
function recruiting_table() {
	const divadd = document.createElement("div");
	const node = document.createTextNode("");
	divadd.style.color = "#a269c6";
	divadd.style.border = "1px solid #d4d4d4"; 
	divadd.style.width = "90%";
	
	// Added by Rao.
var hoursVal;
var hrs_val = document.getElementById("recruitinge").value;
if(hrs_val != ""){
	hoursVal = hrs_val;
}else{
	hoursVal = 0;
}

var fteVal;
var fte_val = document.getElementById("recruitinga").value;
if(fte_val != ""){
	fteVal = fte_val;
}else{
	fteVal = 0;
}

//Ends Here.

	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='pt_a_" + Math.floor(Math.random() * 255) + "' value='" + fteVal + " FTE(s)' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#fff; color:#3c4db0; width:60px; border:none;'></DIV>";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='pt_e_" + Math.floor(Math.random() * 255) + "' value='" + hoursVal + " HRS' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#fff; color:#3c4db0; width:60px; border:none;'></DIV>";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;margin-left:4px;'><input type='text' name='pt_b' value='" + document.getElementById("recruitingb").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#fff; color:#3c4db0; width:220px; border:none;'></DIV>";
	
	var kptext = "";			
	var kp=document.getElementById("recruiting_keypersonnel"); 
	if(document.getElementById("recruiting_keypersonnel").checked == true){ kptext = "(KP)"; }  
				
	var sca=document.getElementById("recruiting_sca"); 
	if(document.getElementById("recruiting_sca").checked == true){ kptext = "(SCA)"; }

	
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='pt_c' value='" + kptext + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#fff; color:#3c4db0; width:50px; border:none;'></DIV>"; //50px
	    /* float: right; */
    
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='pt_d' value='" + document.getElementById("recruitingd").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#fff; color:#3c4db0; width:180px; border:none; margin-left:7px;'></DIV>";
	
	divadd.innerHTML += "<span style='background-color:#a04071; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 14px; cursor: pointer;' onclick='this.parentElement.remove();refresh_table();'> Remove </span>"; 
	//divadd.setAttribute("id","newarea");
	divadd.appendChild(node);
	const element = document.getElementById("opp_recruiting");
	
	element.appendChild(divadd);
	
	//PASS TO INPUT
	var combinedtext = "";
	  var inputs, index;

		inputs = document.getElementsByTagName('input');
		for (index = 0; index < inputs.length; ++index) {
			if(inputs[index].name.indexOf('pt_') == 0) {
					combinedtext += inputs[index].value + "|||";
				}
		}	
	document.getElementById('combined').value=combinedtext;
	
	//CLEAR INPUT ZONE
	document.getElementById('recruitinga').value="";
	document.getElementById('recruitinge').value="";
	document.getElementById('recruitingb').value="";
	document.getElementById('recruiting_keypersonnel').checked = false;
	document.getElementById('recruiting_sca').checked = false;
	document.getElementById('recruitingd').value="";
}
function refresh_table() {
//PASS TO INPUT
	var combinedtext = "";
	  var inputs, index;

		inputs = document.getElementsByTagName('input');
		for (index = 0; index < inputs.length; ++index) {
			if(inputs[index].name.indexOf('pt_') == 0) {
					combinedtext += inputs[index].value + "|||";
				}
		}
	
	document.getElementById('combined').value=combinedtext;	
}
</script>

<script>
function address_table() {
	var contract_pop = document.getElementById("contract_pop").value;
	const divadd = document.createElement("div");
	const node = document.createTextNode(""); 
	divadd.style.color = "#a269c6"; 
	divadd.style.border = "1px solid #d4d4d4";
	divadd.style.width = "90%";
	
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='adp_a_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("contract_pop").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:260px; border:none;'></div>";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='adp_b_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("contract_city").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:260px; border:none;'></div>";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='adp_c_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("contract_state").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:60px; border:none;'></div>";
	
	divadd.innerHTML += "<span style='background-color:#a04071; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 14px; float:right; margin-right:20px; margin-top:3px; cursor: pointer;' onclick='this.parentElement.remove();refresh_addr();'> Remove </span>";
	
	divadd.appendChild(node);
	const element = document.getElementById("opp_address");
	
	element.appendChild(divadd);
	
	//PASS TO INPUT
	var combinedtext = "";
	  var inputs, index;

		inputs = document.getElementsByTagName('input');
		for (index = 0; index < inputs.length; ++index) {
			if(inputs[index].name.indexOf('adp_') == 0) {
					combinedtext += inputs[index].value + "|||";
				}
		}
		
	document.getElementById('combined_table').value=combinedtext;
	
	//CLEAR INPUT ZONE
	document.getElementById('contract_pop').value="";
	document.getElementById('contract_city').value="";
	document.getElementById('contract_state').value="";
}

function refresh_addr() {
//PASS TO INPUT
	var combinedtext = "";
	  var inputs, index;

		inputs = document.getElementsByTagName('input');
		for (index = 0; index < inputs.length; ++index) {
			if(inputs[index].name.indexOf('adp_') == 0) {
					combinedtext += inputs[index].value + "|||";
				}
		}
	
	document.getElementById('combined_table').value=combinedtext;
}
</script>

<script>
function showproposal(){
	document.getElementById("proposal_timezone").style.display = "inline-block";
}
function qatimezone(){
	document.getElementById("qa_timezone").style.display = "inline-block";
}
function edit_function_pp_conf_timezone(){
	//alert('qa'); qa_timezone
	document.getElementById("edit_pp_conf_timezone").style.display = "inline-block";
}
</script>
<script>
function requiredfields() {
  var x = document.forms["opp_update"]["opp_title"].value;
  if (x == "") {
    //alert("Title must be filled out (Required Field)");
	popup1();
	setTimeout(popup1, 5000);
	//x.focus();
	document.forms["opp_update"]["opp_title"].focus();
    return false;
  }
  
  var x = document.forms["opp_update"]["opp_released"].value;
  if (x == "") {
	popup4();
	setTimeout(popup4, 5000);
	document.forms["opp_update"]["opp_released"].focus();
    return false;
  }
  var x = document.forms["opp_update"]["opp_response"].value;
  if (x == "") {
    //alert("Opportunity Type must be filled out (Required Field)");
	popup5();
	setTimeout(popup5, 5000);
	//x.focus();
	document.forms["opp_update"]["opp_response"].focus();
    return false;
  }
}
</script>
<script>
function dateslashes() {

	var sdp = document.getElementById('opp_released');
    var sdp_length = sdp.value.length;
	var remove_extras_stp = "";
    //alert(sdp_length);

	 			if (sdp_length == 2){
					sdp.value = sdp.value + "/";
                }
				else if (sdp_length == 5){
                    sdp.value = sdp.value + "/";
                }
				if (sdp_length>10) {
					remove_extras_stp = sdp.value.slice(0,-1); //"123"; //sdp.text.slice(0,-1);
					sdp.value = remove_extras_stp;
					}
				
	var sdp = document.getElementById('proposal_date');
    var sdp_length = sdp.value.length;
	var remove_extras_stp = "";
    //alert(sdp_length);

	 			if (sdp_length == 2){
					sdp.value = sdp.value + "/";
                }
				else if (sdp_length == 5){
                    sdp.value = sdp.value + "/";
                }
				if (sdp_length>10) {
					remove_extras_stp = sdp.value.slice(0,-1); //"123"; //sdp.text.slice(0,-1);
					sdp.value = remove_extras_stp;
					}
				
	var sdp = document.getElementById('qa_date');
    var sdp_length = sdp.value.length;
	var remove_extras_stp = "";
    //alert(sdp_length);

	 			if (sdp_length == 2){
					sdp.value = sdp.value + "/";
                }
				else if (sdp_length == 5){
                    sdp.value = sdp.value + "/";
                }
				if (sdp_length>10) {
					remove_extras_stp = sdp.value.slice(0,-1); //"123"; //sdp.text.slice(0,-1);
					sdp.value = remove_extras_stp;
					}
	
	var sdp = document.getElementById('opp_award_date');
    var sdp_length = sdp.value.length;
	var remove_extras_stp = "";
    //alert(sdp_length);

	 			if (sdp_length == 2){
					sdp.value = sdp.value + "/";
                }
				else if (sdp_length == 5){
                    sdp.value = sdp.value + "/";
                }
				if (sdp_length>10) {
					remove_extras_stp = sdp.value.slice(0,-1); //"123"; //sdp.text.slice(0,-1);
					sdp.value = remove_extras_stp;
					}
					
	var sdp = document.getElementById('opp_rfp_date');
    var sdp_length = sdp.value.length;
	var remove_extras_stp = "";
    //alert(sdp_length);

	 			if (sdp_length == 2){
					sdp.value = sdp.value + "/";
                }
				else if (sdp_length == 5){
                    sdp.value = sdp.value + "/";
                }
				if (sdp_length>10) {
					remove_extras_stp = sdp.value.slice(0,-1); //"123"; //sdp.text.slice(0,-1);
					sdp.value = remove_extras_stp;
					}
	
	var sdp = document.getElementById('est_pop_start_date');
    var sdp_length = sdp.value.length;
	var remove_extras_stp = "";
    //alert(sdp_length);

	 			if (sdp_length == 2){
					sdp.value = sdp.value + "/";
                }
				else if (sdp_length == 5){
                    sdp.value = sdp.value + "/";
                }
				if (sdp_length>10) {
					remove_extras_stp = sdp.value.slice(0,-1); //"123"; //sdp.text.slice(0,-1);
					sdp.value = remove_extras_stp;
					}
}
</script>
<script>

function popup1() {
  var popup1 = document.getElementById('myPopup1');
  popup1.classList.toggle('show');
}
function popup2() {
  var popup2 = document.getElementById('myPopup2');
  popup2.classList.toggle('show');
}
function popup3() {
  var popup3 = document.getElementById('myPopup3');
  popup3.classList.toggle('show');
}
function popup4() {
  var popup4 = document.getElementById('myPopup4');
  popup4.classList.toggle('show');
}
function popup5() {
  var popup5 = document.getElementById('myPopup5');
  popup5.classList.toggle('show');
}
function popup6() {
  var popup6 = document.getElementById('myPopup6');
  popup6.classList.toggle('show');

}
function popup7() {
  var popup7 = document.getElementById('myPopup7');
  popup7.classList.toggle('show');

} 
</script>

<script>
	function qa_due_date_click() {
		document.getElementById('qa_date').focus();
		document.getElementById('qa_date').click();
	}
	 function proposal_date_click() {
		document.getElementById('proposal_date').focus();
		document.getElementById('proposal_date').click();
	}
	function opp_award_click() {
		document.getElementById('opp_award_date').focus();
		document.getElementById('opp_award_date').click();
	}
	function opp_rfp_click() {
		document.getElementById('opp_rfp_date').focus();
		document.getElementById('opp_rfp_date').click();
	} 
	function opp_released_click() {
		document.getElementById('opp_released').focus();
		document.getElementById('opp_released').click();
	}
	
         
      
</script>
<script>
function saveDescription(opp_id) {
	var opp_id=opp_id
	  var oppSynopsis = document.getElementById("opp_synopsis").value;
	  
	  	var csrfTokenName = "TOKEN"; //<= ASCsrf::getTokenName() ?>";
		var csrfTokenValue = "VALUE"; //<= ASCsrf::getToken() ?>";
	
	  // Create an AJAX request
	  var xhr = new XMLHttpRequest();
	  xhr.open("POST", "save_note_to_db.php", true);
	  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	
		var data = "opp_id=" + opp_id + "&oppSynopsis=" + encodeURIComponent(oppSynopsis);
		data += "&" + encodeURIComponent(csrfTokenName) + "=" + encodeURIComponent(csrfTokenValue);
	
	  xhr.send(data);
	  
	  xhr.addEventListener("load", function() {
		var response = xhr.responseText;
		alert(response); // display the response in an alert box
	  });

}
function saveSubmission(opp_id) {
	var opp_id=opp_id
	  var opp_proposal = document.getElementById("opp_proposal").value;
	  
	  	var csrfTokenName = "TOKEN"; //<= ASCsrf::getTokenName() ?>";
		var csrfTokenValue = "VALUE"; //<= ASCsrf::getToken() ?>";
	
	  // Create an AJAX request
	  var xhr = new XMLHttpRequest();
	  xhr.open("POST", "save_submission_to_db.php", true);
	  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	
		var data = "opp_id=" + opp_id + "&opp_proposal=" + encodeURIComponent(opp_proposal);
		data += "&" + encodeURIComponent(csrfTokenName) + "=" + encodeURIComponent(csrfTokenValue);
	
	  // Send the AJAX request
	  xhr.send(data);
	  
	  // Event listener to capture the response
	  xhr.addEventListener("load", function() {
		var response = xhr.responseText;
		alert(response); // display the response in an alert box
	  });

}

		document.getElementById('edit_intent_yes').addEventListener('click', function() {	
			document.getElementById('edit_mandatory_show').style.display = 'inline-block';
			document.getElementById('edit_intent_bid_date').style.display = 'inline-block';
			document.getElementById('edit_intent_bid_date').value = "<?php echo $intent_bid_date;?>";
		});
		document.getElementById('edit_intent_no').addEventListener('click', function() {
			document.getElementById('edit_intent_bid_date').style.display = 'none';
			document.getElementById('edit_mandatory_show').style.display = 'none';
			document.getElementById('edit_intent_bid_date').value = "";
			document.getElementById('edit_intent_bid_date').removeAttribute('required');	
		});
		document.getElementById('edit_pp_conference_yes').addEventListener('click', function() {	
			document.getElementById('edit_mandatory_field').style.display = 'inline-block';
			var val = "<?php echo $db_mandatory;?>";
			if(val == 'Yes'){
				document.getElementById('edit_mandatory_yes').checked = "<?php echo $mandatory_yes;?>";
			}
			if(val == 'No'){
				document.getElementById('edit_mandatory_no').checked = "<?php echo $mandatory_no;?>";
			}
			document.getElementById('edit_pp_conference_date').value = "<?php if(trim($pp_conference_date) != ''){echo date('Y-m-d', strtotime($pp_conference_date));}?>";
		});
		document.getElementById('edit_pp_conference_no').addEventListener('click', function() {	
			document.getElementById('edit_mandatory_field').style.display = 'none';
			document.getElementById('edit_mandatory_yes').checked = false;
			document.getElementById('edit_mandatory_no').checked = false;
			document.getElementById('edit_pp_conference_date').value = '';
		});

		var intent_db_value = "<?php echo $intent_to_bid;?>";
			if(intent_db_value == 'Yes'){
				document.getElementById('edit_intent_yes').click();
			}else{
				document.getElementById('edit_intent_no').click();
			}

		var conference_db_value = "<?php echo $pp_conference;?>";
			if(conference_db_value == 'Yes'){
				document.getElementById('edit_pp_conference_yes').click();
			}else{
				document.getElementById('edit_pp_conference_no').click();
			}
</script>

<script>
	$(document).ready(function() {
		$("#edit_contract_vehicle").change(function(){
			var contract_name = $("#edit_contract_vehicle").val();
			if(contract_name == 'Others'){
				$("#edit_other_master_contract").show();
				$("#edit_other_master_contract").prop('required', true);
			}else{
				$("#edit_other_master_contract").hide();
				$("#edit_other_master_contract").prop('required', false);
			}
		});
	});
</script>
