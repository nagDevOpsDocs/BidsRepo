<?php
session_start();

$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;
?>
<!DOCTYPE html>
<html>
<head>
 <script src="https://cdn.tiny.cloud/1/tx2aw65ugkqux2tmj4x89fwhmfvxqlnqhhg22q2mpojdv4oj/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<?php
print("
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css'>
    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js'></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css' rel='stylesheet'>
	<link href='https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.css' rel='stylesheet'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js'></script>
	<script src='https://code.jquery.com/jquery-3.1.1.min.js'></script>");

print("  
<link href='https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/themes/smoothness/jquery-ui.css' rel='stylesheet'>
      ");
	  
	 
print("
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
</style>"); ?>
<style>
div.ex3 {
  background-color: lightblue;
  height: 40px;
  width: 200px;  
  overflow-y: auto;
  border: 1px solid #ddd;
}
</style>
<?php $which_update_id=$_GET['which_update_id'];
print("<div style='text-align:center;font-size: 18px;font-weight: 700;color: #3c4db0;padding: 10px;'>Opportunity - Update</div>");

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

$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, contractveh_table, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, gaps_datateam, notes_datateam, pricing_eval, contract_pop2, award_date, rfp_date, est_pop_start_date, subagency, certifications, solicitation_docs, domains, naics_code, previous_releases FROM excel_test  
WHERE opportunity_id = $which_update_id";
//print $query;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$opp_opportunity_id = $row[0];
	$opp_bidopp = $row[1];
	$opp_response = $row[2]; 
	$opp_requestor = $row[3];
	$opp_title = $row[4];
	$opp_due = strtoupper($row[5]); 
//	$opp_released = strtoupper($row[6]); 
	$opp_released = date("m/d/Y", strtotime($row[6])); 
	 
//  $opp_released_old = date("m/d/Y", strtotime($opp_released));    
		
	$opp_pop = $row[7];
	$opp_synopsis = html_entity_decode($row[8]); 
	$opp_proposal = html_entity_decode($row[9]);
	$opp_pricing_in = $row[10]; 
	
	//$opp_recruiting = $row[11]; 
	
	$opp_recruiting_in = $row[11];  
	
//	echo "<br/>$opp_recruiting_in";
	
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
		<input type="text" name="pt_d" value="'. $clearance .'" style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:180px; margin-left:7px; border:none;"></div></div></div>
		'; }
					
			if ($inloop==5) { $opp_recruiting .= "<div style='padding-left:40px; font-weight:700;'>$temp_job</div></DIV>"; $inloop=0; }	
				$i++;
			}
				
		} else { $opp_recruiting = $opp_recruiting_in; }

		/* update code starts by rajini */
			$contrctveh_in = $row[16];
		$contrctveh = "";

		if (strpos($contrctveh_in, '|||') !== false) {
				$ok = explode("|||",$contrctveh_in);

				$contrctveh_start .= '<div name="contractveh_address" id="contractveh_address">';
				for($i = 0; $i<count($ok);){
					if($ok[$i]){
				$contrctveh_start .= '<div style="color:#a269c6; width:60%; border:1px solid #d4d4d4;"><div style="display:inline-block; padding:5px 10px;"><input type="text" name="addr_a_239" value="'. $ok[$i] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:260px; border:none;"></div><div style="display:inline-block; padding:5px 10px;"><input type="text" name="addr_e_214" value="'. $ok[++$i] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:260px; border:none;"></div></div>';
					}
				$i++;
				}

				$contrctveh_start .= '</div>';

		}		
		 else { 
			 $contrctveh = $contrctveh_in; 
		}
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

	$agency = $row[18];
	$facility = $row[19]; 
	$clearance_level = $row[20];
	
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
	$proposal_due_date = date("m/d/Y", strtotime($proposal_due));
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
	$qa_due_date = date("m/d/Y", strtotime($qa_due));
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
		$opp_award_date = date("m/d/Y", strtotime($opp_award_date));
//		 $opp_award_date = $row[31];
		if (empty($row[31])) { $opp_award_date=""; } 
		
		 
	$opp_rfp_date = $row[32];
//		$opp_rfp_date_old = date("m/d/Y", strtotime($opp_rfp_date));
		if (!empty($row[32])) { $opp_rfp_date=date("m/d/Y", strtotime($opp_rfp_date)); } else{$opp_rfp_date='';}
	$opp_est_pop_start_date = $row[33];
		$opp_est_pop_start_date = date("m/d/Y", strtotime($opp_est_pop_start_date));
		if (empty($row[33])) { $opp_est_pop_start_date=""; } 

	$subagency = $row[34];
	$certifications = $row[35];
	$opportunity_link = $row[36];

	$domains = str_replace('"',"",$row[37]);
	$naics_code = $row[38];
	$previous_releases = str_replace('||','<br/>',$row[39]);
	
	$form_update_content .= "<tr><td width='160'><strong>Title</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'><div class='popup'>
	$opp_title</div></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Contract Vehicle(s)</strong></td><td>
    $contrctveh_start
		</td></tr>";
//add button code ends here
	
	$form_update_content .= "<tr><td><strong>Release Date</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'>
				$opp_released 
		</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Domains</strong></td><td class='td-left'>
				$domains
		</td></tr>";

	$form_update_content .= "<tr><td><strong>NAICS Code</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'>
			$naics_code
		</td></tr>";
	$form_update_content .= "<tr><td><strong>Opportunity Type</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'>
		<div class='popup' onclick=''>
				  $opp_response
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
	
	$form_update_content .= "<tr><td><strong>RFP Release Date</strong></td><td class='td-left'>
	$opp_rfp_date
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Award Date</strong></td><td class='td-left'>
	$opp_award_date
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Est. PoP Start Date</strong></td><td class='td-left'>
	$opp_est_pop_start_date
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Department</strong></td><td class='td-left'>$agency</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Agency</strong></td><td class='td-left'>$subagency</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Requestor Name</strong></td><td class='td-left'>$opp_requestor</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Facility Clearance</strong></td><td class='td-left'>
				  $clearance_level
				  </td></tr>";
	
	
	$form_update_content .= "<tr><td><strong>Certifications</strong></td><td class='td-left'>$certifications</td></tr>";

	$form_update_content .= "<tr><td><strong>Solicitation Docs</strong></td><td class='td-left'>$opportunity_link</td></tr>";

	$form_update_content .= "<tr><td><strong>Previous Release(s)</strong></td><td class='td-left'>$previous_releases</td></tr>";



	$form_update_content .= "<tr><td><strong><div>Description</div></strong></td><td class='td-left'>
			
			<div class='ex3' style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				$opp_synopsis
			</div>
	</td></tr>";
	$form_update_content .= "<tr><td><strong>Performance Location</strong></td><td class='td-left'>$facility</td></tr>";

	/*$form_update_content .= "<tr><td><strong>Address</strong></td><td class='td-left'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='contract_pop' id='contract_pop' autocomplete='new-password' type='text' value='' />
	 <div style='font-weight:700; width:50px; display:inline-block; vertical-align:top; margin-left:10px;'>City</div><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='contract_city' id='contract_city' autocomplete='new-password' type='text' value='' />
	 <div style='font-weight:700; width:50px; display:inline-block; vertical-align:top; margin-left:10px;'>State</div>$state_dropdown"; 
	 
	 $form_update_content .="<div style='background-color: #e4e4e4;
    padding: 4px;
    width: 80px;
    text-align: center; margin-top:10px;
    font-weight: 700; display:inline-block; margin-left: 20px; margin-bottom:10px; cursor: pointer;' onclick='address_table();
  '>Add</div></td></tr>";*/
	 
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
	
	$form_update_content .= "<tr><td><strong>Pricing</strong></td><td class='td-left'>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Fixed-Price</div>
	  $opp_pricing_a
	  <label for='pricing1'> Firm Fixed-Price (FFP)</label>
	  
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Cost-Reimbursement</div>
	  $opp_pricing_e
	  <label for='pricing5'> Cost-Reimbursement Actual Cost</label>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Time and Materials (T&M)</div>
	  $opp_pricing_k
	  <label for='pricing11'> Time and Materials (T&M)</label>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Labor Hour (L-H)</div>
	  $opp_pricing_l
	  <label for='pricing12'> Labor Hour (L-H)</label>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Cost Plus Fixed Fee (CPFF)</div>
	  $opp_pricing_m
	  <label for='pricing12'> Cost Plus Fixed Fee (CPFF)</label>
	  </div>
	  
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Evaluation</div>
		  
	  $pricing_eval
	  
	  </div>
	  ";
	  
	/*$form_update_content .= "
	<input style='width:100%; border:1px solid #cbcbcb; padding:5px;' id='opp_pricing' name='opp_pricing' type='hidden' value='' /></td></tr>";*/
	
	
	/*$form_update_content .= "<tr><td><strong>Pricing</strong></td><td class='td-left'><input style='width:100%; border:1px solid #cbcbcb; padding:5px;' name='opp_pricing' type='text' value='$opp_pricing' /></td></tr>";*/
	
	/*$form_update_content .= "<tr><td><strong>Recruiting:</strong></td><td><input style='width:100%; border:1px solid #cbcbcb; padding:5px;' name='opp_recruiting' type='text' value='$opp_recruiting' /></td></tr>";*/
	/*$form_update_content .= "<tr><td><strong>Recruiting</strong></td><td class='td-left'><textarea style='width:100%; border:1px solid #cbcbcb; padding:5px;' name='opp_recruiting' cols='10' rows='10'>$opp_recruiting</textarea></td></tr>";*/
	/*$opp_recruiting*/
	$form_update_content .= "<tr><td><strong>Recruiting</strong></td><td class='td-left'>
	<div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>FTE(s)</div>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Hour(s)</div>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Labor Category</div>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700; width:100px;'>Personnel</div>
	  <label for='recruiting_keypersonnel'> KP</label>
	  <label for='recruiting_keypersonnel'> SCA</label>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Clearance</div>
	  </div>
	  
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'></div>
		  
	  </div>
	  $recruiting_start 
	</td></tr>";
	
	/*<textarea style='width:90%; border:1px solid #cbcbcb; padding:5px;' name='opp_proposal' cols='10' rows='10'>$opp_proposal</textarea>*/
	
//	$form_update_content .= "<tr><td style='color:blue;'><strong><div onclick=\"saveSubmission($opp_opportunity_id);\">Submission Requirements</strong></div></td><td class='td-left'>
	$form_update_content .= "<tr><td><strong><div>Submission <br/>Requirements</strong></div></td><td class='td-left'>
	
			<div class='ex3' style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				$opp_proposal
			</div>
	
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Gaps (Research Team)</strong></td><td class='td-left'>
	
			<div class='ex3' style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				$gaps_datateam
			</div>
	
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Notes (Research Team)</strong></td><td class='td-left'>
	
			<div class='ex3' style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				$notes_datateam
			</div>
	</td></tr>";
	
	
	$form_update_content .= "<tr><td><strong>Decision</strong></td><td class='td-left'>$opp_decision
				
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Assigned To</strong></td><td class='td-left'>$manager
				
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Reason</strong></td><td class='td-left'>$reason</td></tr>";
	$form_update_content .= "<tr><td><strong>Gap(s)</strong></td><td class='td-left'>$opp_gaps</td></tr>";
	
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