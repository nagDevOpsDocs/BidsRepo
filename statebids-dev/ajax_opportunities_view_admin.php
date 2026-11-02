<?php
session_start();
include("./includes/connect_portal123.php");
$secure_webpage=0;
?>
<!DOCTYPE html>
<html>
<head>
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
.td-left { background-color:#fff; border:none; padding: 5px;}
.select-styled { padding: 4px 5px; border: 1px solid #cbcbcb; width:200px; font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}

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
<style>
div.ex3 {
  background-color: lightblue;
  height: 40px;
  width: 200px;  
  overflow-y: auto;
  border: 1px solid #ddd;
}
</style>
<?php 
$which_update_id=$_GET['which_update_id'];
print("<div style='text-align:center;font-size: 18px;font-weight: 700;color: #3c4db0;padding: 10px;'>Opportunity - View</div>");

$form_portion = "<form action='opp_db_update2.php' name='opp_update' id='opp_update'  onsubmit='return requiredfields();' method='post'>";
$form_table = $form_portion . "<table width='100%' border='0' cellspacing='5' cellpadding='5'>";
$form_update_content = "";

$state_dropdown_c = "";
$state_dropdown_c2 = "";

$state_dropdown="<select name='contract_state' id='contract_state' size='1' class='select-styled' style='width:60px;'>
				  <option value=''></option>
				  ";
$state_dropdown2="<select name='contract_state2' size='1' class='select-styled' style='width:60px;'>
				  <option value=''></option>
				  ";

$vehicles_dropdown_d = "";
$vehicles_dropdown2_d = "";
//$vehicles_dropdown_a="<select name='contract_vehicle' id='contract_vehicle' size='1' class='select-styled' style='border-left:5px solid #3c4db0;' >";
//$vehicles_dropdown2_a = "<select name='contract_vehicle' size='1' class='select-styled'>";
//$vehicles_dropdown_c = "<option value=''></option>";
//$vehicles_dropdown2_c = "<option value=''></option>";
//$vehicles_dropdown2_a="<select name='contract_vehicle_two' size='1' class='select-styled'>";


$query = "SELECT vehicle_name FROM contract_vehicles WHERE vehicle_show=1 ORDER BY vehicle_name";
//print $query;
//$result = mysqli_query($mysqli_link, $query);
//while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    //{
		//$vehicles_dropdown_d .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
		//$vehicles_dropdown2_d .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
	//}
	//$vehicles_dropdown_d .= "</select>";
	//$vehicles_dropdown2_d .= "</select>";
	//$vehicles_dropdown2 .= "</select>";


$query = "SELECT state_abbrev FROM states ORDER BY state_abbrev";
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
		$state_dropdown .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
		$state_dropdown2 .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
	}
	$state_dropdown .= "</select>";
	$state_dropdown2 .= "</select>";

$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, contractveh_table, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, gaps_datateam, notes_datateam, pricing_eval, contract_pop2, award_date, rfp_date, est_pop_start_date, subagency, certifications, contract_vehicle, vehicle_one, naics_code, submission_notes, vehicle_two, submission_mode, intent_to_bid, bid_category, priority, est_actual FROM state_excel_test WHERE opportunity_id = $which_update_id";
//print $query;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$opp_opportunity_id = $row[0];
	$opp_bidopp = $row[1];
	$opp_response = $row[2]; //opportunity type
	$opp_requestor = $row[3];
	$opp_title = $row[4];
	$master_contract = $row[36];
	$agency = $row[18]; //state
	$contract_id = $row[37]; //Id
	$contrctveh_in = $row[16]; //deptagency
	$certifications = $row[35];
	$weburl = $row[38];
	$notes = $row[39];
	//$opp_due = strtoupper($row[5]);   
    $opp_released = date("m/d/Y", strtotime($row[6])); //release date   
		
	//$opp_pop = $row[7];
	$opp_synopsis = html_entity_decode($row[8]); 
	$opp_proposal = html_entity_decode($row[9]);
	$opp_pricing_in = $row[10]; 
	$opp_recruiting = $row[11]; 
	$opp_recruiting_in = $row[11];  
	
	/*$opp_pricing_a = "";
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
	}*/
	
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
		<input type="text" name="pt_d" value="'. $clearance .'" style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:180px; margin-left:7px; border:none;"></div></div></div>
		'; }
					
			if ($inloop==5) { $opp_recruiting .= "<div style='padding-left:40px; font-weight:700;'>$temp_job</div></DIV>"; $inloop=0; }	
				$i++;
			}
				
		} else { $opp_recruiting = $opp_recruiting_in; }

		/* update code starts by rajini */
			
		
		/* update code ends here */

	
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
				$addrdet_start .= '<div style="color:#a269c6; width:90%; border:1px solid #d4d4d4;"><div style="display:inline-block; padding:5px 10px;"><input type="text" name="adp_a_269" value="'. $ok[$i] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:260px; border:none;"></div><div style="display:inline-block; padding:5px 10px;"><input type="text" name="adp_b_282" value="'. $ok[++$i] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:260px; border:none;"></div><div style="display:inline-block; padding:5px 10px;"><input type="text" name="adp_c_289" value="'. $ok[++$i] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:260px; border:none;"></div></div>';
					}
				$i++;
				}

				$addrdet_start .= '</div>';

		}		
		 else { 
			 $addrdet_start = ''; 
		}

		$ContractPeriod = explode("#",$row[15]);
	$trans_in_qty = $ContractPeriod[0];
	$eos_qty = $ContractPeriod[6];

	$trans_in_time = $ContractPeriod[1];
	$perioda = $ContractPeriod[2];
	$periodb = $ContractPeriod[3];
	$periodc = $ContractPeriod[4];
	$periodd = $ContractPeriod[5];
	$eos_time = $ContractPeriod[7];
	/* update code ends here */

	$opp_status_readonly = $row[17];
	$opp_status = $row[17];
	$opp_status = "<option hidden selected value='" . $row[17] . "'>" . $row[17] . "</option>";
	
	$status_list = "";
	$status_query = "SELECT status_id, status_name FROM status_levels WHERE (status_show>0) ORDER BY status_show";
$status_result = mysqli_query($mysqli_link, $status_query);
while($rec = mysqli_fetch_array($status_result, MYSQLI_NUM))
    {
	//$db_status_id = $row[0];
	$db_status_name = $rec[1];
	$status_list .= "<option value='$db_status_name'>$db_status_name</option>";
	}

	$facility = $row[19]; 
	
	$proposal_due = $row[21];
	
	$proposal_due_date = "";
	$proposal_due_time = "";
	if (strlen($proposal_due>1)) {
	$phpdate = strtotime( $proposal_due );
	$proposal_due_date_old = date( 'm/d/Y', $phpdate ); 
	$proposal_due_time = date( 'H:i', $phpdate ); 
	}
	//$proposal_due_date = $proposal_due;
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
	
	$reason = $row[23];
	$manager = $row[24]; 
	
	$qa_timezone = $row[25];
	$proposal_timezone = $row[26];
	
	$gaps_datateam = html_entity_decode($row[27]);
	$notes_datateam = html_entity_decode($row[28]);
	$pricing_eval = $row[29];
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
		//$opp_award_date = date("m/d/Y", strtotime($opp_award_date));
		 $opp_award_date = $row[31];
		if (empty($row[31])) { $opp_award_date=""; } 
		
		 
	$opp_rfp_date = $row[32];
		$opp_rfp_date_old = date("m/d/Y", strtotime($opp_rfp_date));
		if (empty($row[32])) { $opp_rfp_date=""; } 
	$opp_est_pop_start_date = $row[33];
		//$opp_est_pop_start_date = date("m/d/Y", strtotime($opp_est_pop_start_date));
		if (empty($row[33])) { $opp_est_pop_start_date=""; } 
	
	$subagency = $row[34];
	$assigned_to	 = $row[40];
	$submission_mode = $row[41];
	$intent_tobid	 = $row[42];
	$bid_category    = $row[43];
	$priority		 = $row[44];
	$est_actual		 = $row[45];
	
	$form_update_content .= "<tr><td width='160'><strong>Title</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'><div class='popup'>
	$opp_title</div></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Master Contracts</strong></td><td>
    $master_contract
		</td></tr>";
	$form_update_content .= "<tr><td><strong>State</strong></td><td>
    $agency
		</td></tr>";
	$form_update_content .= "<tr><td><strong>Id</strong></td><td>
    $contract_id
		</td></tr>";

	
	$form_update_content .= "<tr><td><strong>Release Date</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'>
				$opp_released 
		</td></tr>";
	 
	$form_update_content .= "<tr><td><strong>Opportunity Type</strong></td><td class='td-left'>
		<div class='popup'>
				  $opp_response
				  </div>
				</td></tr>";
	$form_update_content .= "<tr><td><strong>Assigned To</strong></td><td class='td-left'>
		<div class='popup'>
				 $assigned_to
				  </div>
				</td></tr>";			
	
	$form_update_content .= "<tr><td><strong>Submission Mode</strong></td><td class='td-left'>
		<div class='popup'>
				   $submission_mode
				  </div>
				</td></tr>";

	$form_update_content .= "<tr><td><strong>Submission Due Date</strong></td><td class='td-left'>
	 $proposal_due_date
	 $proposal_due_time
	$proposal_timezone
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Q&A Due Date</strong></td><td class='td-left'>
	$qa_due_date
	$qa_due_time
	$qa_timezone
		</td></tr>";

	$form_update_content .= "<tr><td><strong>Intent to Bid</strong></td><td class='td-left'>
		$intent_tobid
		</td></tr>";
	
	$form_update_content .= "<tr><td><strong>RFP Release Date</strong></td><td class='td-left'>
	$opp_rfp_date
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Award Date</strong></td><td class='td-left'>
	$opp_award_date
	</td></tr>";

	$form_update_content .= "<tr><td><strong>Bid Category</strong></td><td class='td-left'>
	$bid_category
	</td></tr>";

	$form_update_content .= "<tr><td><strong>Priority</strong></td><td class='td-left'>
	$priority
	</td></tr>";

	$form_update_content .= "<tr><td><strong>Est/Actual</strong></td><td class='td-left'>
	$est_actual
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Department/Agency</strong></td><td class='td-left'>$contrctveh_in</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Certifications</strong></td><td class='td-left'>$certifications</td></tr>";
	
	$form_update_content .= "<tr><td><strong>URL</strong></td><td class='td-left'>
				  $weburl
				  </td></tr>";

	$form_update_content .= "<tr><td><strong><div>Description</div></strong></td><td class='td-left'>
			
			<div class='ex3' style='width:90%; height: 200px; background: #fff; vertical-align: top;'>
				$opp_synopsis
			</div>
	</td></tr>";
	$form_update_content .= "<tr><td><strong>Performance Location</strong></td><td class='td-left'>$facility</td></tr>";
	 
	$form_update_content .="<tr><td colspan='3'>
    $addrdet_start
		</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Period</strong></td><td class='td-left'>
	<fieldset style='width:134px; display:inline-block; border:1px solid #eaeaea; vertical-align: top;'>
  		<legend  style='font-size: 13px; font-weight: 700;'>Transition In</legend>
		$trans_in_qty
	$trans_in_time
	</fieldset>
	
	<span style='color: #e6e7ed; font-weight: 700; font-size: 20px;'>+</span> 
	
	<fieldset style='width:210px; display:inline-block; border:1px solid #eaeaea; vertical-align: top;'>
  		<legend  style='font-size: 13px; font-weight: 700;'>Base</legend>
		$perioda
	$periodb
	</fieldset>
	
 <span style='color: #e6e7ed; font-weight: 700; font-size: 20px;'>+</span>  

 	<fieldset style='width:225px; margin-left:20px; display:inline-block; border:1px solid #eaeaea; vertical-align: top;'>
  		<legend  style='font-size: 13px; font-weight: 700;'>Option</legend>
		$periodc 
	$periodd
	</fieldset>
	<span style='color: #e6e7ed; font-weight: 700; font-size: 20px;'>+</span> 
	
	<fieldset style='width:136px; display:inline-block; border:1px solid #eaeaea; vertical-align: top;'>
  		<legend style='font-size: 13px; font-weight: 700;'>EOS</legend>
		$eos_qty
	$eos_time
	</fieldset>
	</td></tr>";	
	
	/*$form_update_content .= "<tr><td><strong>Pricing</strong></td><td class='td-left'>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'>
	  $opp_pricing_in
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Cost-Reimbursement</div>
	  $opp_pricing_e
	  </div>
	  
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Evaluation</div>
		  
	  $pricing_eval
	  
	  </div></tr>";*/
	  	$form_update_content .= "<tr><td><strong>Pricing</strong></td><td class='td-left'>
				  $opp_pricing_in
				  </td></tr>";
	  	$form_update_content .= "<tr><td>&nbsp;</td><td class='td-left'>
				  $pricing_eval
				  </td></tr>";
	  
	/*$opp_recruiting*/
	$form_update_content .= "<tr><td><strong>Recruiting</strong></td><td class='td-left'>
	<div style='display:inline-block;padding:5px 28px;vertical-align:top;'><div style='font-weight:700;'>FTE(s)</div>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Hour(s)</div>
	  </div>
	  <div style='display:inline-block;padding:5px 70px;vertical-align:top;'><div style='font-weight:700;'>Labor Category</div>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700; width:100px;'>Personnel</div>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Clearance</div>
	  </div>
	  
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'></div>
		  
	  </div>
	  $recruiting_start 
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong><div>Submission <br/>Requirements</strong></div></td><td class='td-left'>
	
			<div class='ex3' style='width:90%; height: 200px; background: #fff; vertical-align: top;'>
				$opp_proposal
			</div>
	
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Gaps (Research Team)</strong></td><td class='td-left'>
	
			<div class='ex3' style='width:90%; height: 200px; background: #fff; vertical-align: top;'>
				$gaps_datateam
			</div>
	
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Notes (Research Team)</strong></td><td class='td-left'>
	
			<div class='ex3' style='width:90%; height: 200px; background: #fff; vertical-align: top;'>
				$notes_datateam
			</div>
	</td></tr>";
	
	
	$form_update_content .= "<tr><td><strong>Decision</strong></td><td class='td-left'>$opp_decision
				
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Assigned To</strong></td><td class='td-left'>$manager
				
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Reason</strong></td><td class='td-left'>$reason</td></tr>";
	$form_update_content .= "<tr><td><strong>Notes</strong></td><td class='td-left'>$notes</td></tr>";
	
		$form_update_content .= "<tr><td><strong>Gap(s)</strong></td><td class='td-left'>$opp_gaps</td></tr>";
	
		$form_update_content .= "<tr><td><strong>B&P Phase</strong></td><td class='td-left'>$opp_status_readonly</td></tr>";

	}
	
	print ($form_table . $extra_top_buttons . $form_update_content . "</table>");
?>
</form>

<div style='margin-top:30px;'></div>
<div style='text-align:center;font-size: 18px;font-weight: 700;color: #3c4db0;padding: 10px;'>Document(s)</div>
<?php
print("<div id='phpout_partner'>");
$partner_list = "";
	$query = "SELECT opportunity_id, filename, filedesc, filetype, filetimestamp FROM documents WHERE opportunity_id=$opp_opportunity_id";
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