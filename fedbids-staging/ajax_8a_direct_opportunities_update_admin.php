<?php
session_start();
//ini_set('display_errors', '1'); error_reporting(E_ALL);
$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;
?>
<!DOCTYPE html>
<html>
<head>
 <script src="<?php echo $baseurl; ?>/tinymce/tinymce.min.js"></script>
<!--  Code for MultiSelect Boxes Ends Here.  -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css'>
    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js'></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css' rel='stylesheet'>
	<link href='https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.css' rel='stylesheet'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js'></script>
	<script src='https://code.jquery.com/jquery-3.1.1.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js'></script>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css'>

 
	<link href='https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/themes/smoothness/jquery-ui.css' rel='stylesheet'>
	<link href= "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"  rel="stylesheet"> 
    <script src= "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"> </script> 


  <style>
body, input, table, td, select, textarea {font-family: 'Roboto', sans-serif; font-size:12px;}
.samewidth { width:240px; font-weight:700;}
.td-left { /*background: #f9f9f9;*/ background-color:#fff; /*background:none;*/ border:none; /*border: 1px #dedede solid;*/ padding: 5px;}
.select-styled { padding: 4px 5px; /*font-weight: 500;*/ border: 1px solid #cbcbcb; width:200px; font-family: 'Roboto', sans-serif; font-size:12px;}

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

.btn-default {
	width:200px;
	text-align:left;
	border-radius: 0px;
 }
 .btn-default .caret{
	display:none
 }

 .dropdown-menu {
 	font-size: 14px;
	text-align: left;
	min-width: 13rem;
 }
 .multiselect-container>li>a>label.checkbox {
    margin: 0;
    margin-left: -28px;
}
a {
    color: #000000;
}
.multiselect-container>li>a>label {
    margin: 0;
    height: 100%;
    cursor: pointer;
    font-weight: 400;
    padding: 3px 9px 3px 25px;
}
.multiselect-container {
    position: absolute;
    list-style-type: none;
    margin: 0;
    padding: 0;
    padding-left: 10px;
}

</style>


<script>
  $(document).ready(function() {
		$('#domains').multiselect({
			includeSelectAllOption: false,
		});
  });
</script>

<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$which_update_id=$_GET['which_update_id'];
print("<div style='text-align:center;font-size: 18px;font-weight: 700;color: #3c4db0;padding: 10px;'> Opportunity - Update</div>");

$form_portion = "<form action='opp_db_8a_direct_update2.php' name='opp_update' id='opp_update'  onsubmit='return requiredfields();' method='post'>";
$form_table = $form_portion . "<table width='100%' border='0' cellspacing='5' cellpadding='5'>";
$form_update_content = "";

$state_dropdown_c = "";
$state_dropdown_c2 = "";
//$state_dropdown_a="<select name='contract_state' size='1' class='select-styled' style='width:60px;'>";
//$state_dropdown_a2="<select name='contract_state2' size='1' class='select-styled' style='width:60px;'>";

$state_dropdown="<select name='contract_state' id='contract_state' size='1' class='select-styled' style='width:60px;'>
				  <option value=''></option>
				  ";
$state_dropdown2="<select name='contract_state2' size='1' class='select-styled' style='width:60px;'>
				  <option value=''></option>
				  ";

$vehicles_dropdown_d = "";
$vehicles_dropdown2_d = "";
$vehicles_dropdown_a="<select name='contract_vehicle' id='contract_vehicle' size='1' class='select-styled' style='border-left:5px solid #3c4db0;' >";
$vehicles_dropdown2_a = "<select name='contract_vehicle' size='1' class='select-styled'>";
$vehicles_dropdown_c = "<option value=''></option>";
$vehicles_dropdown2_c = "<option value=''></option>";
$vehicles_dropdown2_a="<select name='contract_vehicle_two' size='1' class='select-styled'>";


$query = "SELECT vehicle_name FROM contract_vehicles WHERE vehicle_show=1 ORDER BY vehicle_name";
//print $query;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {	if($row[0] == 'N/A'){$selected = 'selected';}else{$selected = '';}
		$vehicles_dropdown_d .= "<option $selected value='" . $row[0] . "'>" . $row[0] . "</option>";
		$vehicles_dropdown2_d .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";

		/*	if($row[0] == '711th'){
				$vehicles_dropdown_d .= "<option value='DLA JETS 2.0'>DLA JETS 2.0</option>";
				$vehicles_dropdown2_d .= "<option value='DLA JETS 2.0'>DLA JETS 2.0</option>";
			}
			else if($row[0] == 'GSA MAS Schedule'){
				$vehicles_dropdown_d .= "<option value='OASIS+ SB'>OASIS+ SB</option>";
				$vehicles_dropdown2_d .= "<option value='OASIS+ SB'>OASIS+ SB</option>";
			} */
	}

	$vehicles_dropdown_d .= "</select>";
	$vehicles_dropdown2_d .= "</select>";
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


$naics_query = "SELECT naics_code FROM naics_codes ORDER BY naics_code";
$result1 = mysqli_query($mysqli_link, $naics_query);
$naics_code_dropdown = "";
while($row = mysqli_fetch_array($result1, MYSQLI_NUM))
    {
		$naics_code_dropdown .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
	}

$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, contractveh_table, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, gaps_datateam, notes_datateam, pricing_eval, contract_pop2, award_date, rfp_date, est_pop_start_date, subagency, certifications, solicitation_docs, domains, naics_code, previous_releases, is_addendum, dont_show_agenda, size_standard, ron_cp_date, tyler_cp_date, team_cp_date, urls, foia_req_submitted, foia_info_received, foia_req_submitted_date, foia_info_received_date FROM excel_test WHERE opportunity_id = $which_update_id";
//print $query;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    { //print_r($row);
	$opp_opportunity_id = $row[0];
	$opp_bidopp = $row[1];
	$opp_response = "<option hidden selected value='" . $row[2] . "'>" . $row[2] . "</option>"; 
	$opp_requestor = $row[3];
	$opp_title = $row[4];
	$opp_due = strtoupper($row[5]); 
	if($row[6] != ''){
		$opp_released = $row[6]; 
	}else{
		$opp_released = "";
	}
	 
//    $opp_released_old = date("m/d/Y", strtotime($opp_released));    
		
	$opp_pop = $row[7];
	$opp_synopsis = $row[8]; 
	$opp_proposal = $row[9]; 
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
		<input type="text" name="pt_d" value="'. $clearance .'" style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:180px; margin-left:7px; border:none;"></div><span style="background-color:#6450ae; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 14px; cursor: pointer;" onclick="this.parentElement.remove();refresh_table();"> Remove </span></div></div>
		'; }
					
			if ($inloop==5) { $opp_recruiting .= "<div style='padding-left:40px; font-weight:700;'>$temp_job</div></DIV>"; $inloop=0; }	
				$i++;
			}
				
				//$opp_recruiting = $ok[0];
				/*for ($x = 0; $x <= 3; $x++) {
				  echo "The number is: $x <br>";
				}*/
				
		} else { $opp_recruiting = $opp_recruiting_in; }

/* update code starts by rajini */
		$contrctveh_in = $row[16];
		$contrctveh = "";
		if (strpos($contrctveh_in, '|||') !== false) {
				$ok = explode("|||",$contrctveh_in);
				$contrctveh_start .= '<div name="contractveh_address" id="contractveh_address">';
				for($i = 0; $i<(count($ok)-1);){
					if($ok[$i]){
				$contrctveh_start .= '<div style="color:#a269c6; width:90%; border:1px solid #d4d4d4;"><div style="display:inline-block; padding:5px 10px;"><input type="text" name="addr_a_239" value="'. $ok[$i] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:260px; border:none;"></div>';
/*
	if($contract_veh == "Other"){
		$contrctveh_start .='<div style="color:#a269c6; width:90%; border:1px solid #d4d4d4;"><div style="display:inline-block; padding:5px 10px;"><input type="text" name="edit_hello_veh_212" value="'. $ok[$i] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:260px; border:none;"></div>';

//		$contrctveh_start .= '<div style='display:inline-block; padding:5px 10px;'><input type='text' name='edit_hello_veh_212" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("edit_other_vehicle_name").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:190px; border:none;' ></DIV>";
	}else{
//		$contrctveh_start .= "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='edit_hello_veh_212" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("edit_other_vehicle_name").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:190px; border:none;' ></DIV>";
	  $contrctveh_start .='<div style="color:#a269c6; width:90%; border:1px solid #d4d4d4;"><div style="display:inline-block; padding:5px 10px;"><input type="text" name="edit_hello_veh_212" value="'. $ok[$i] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:260px; border:none;"></div>';
	}
*/
				$exp = explode('+', $ok[++$i]);
				
				if($exp[0]){
				$contrctveh_start .='<div style="display:inline-block; padding:5px 10px;"><input type="text" name="addr_b_214" value="'. $exp[0] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:260px; border:none;"></div>';
				}
				if($exp[1]){
				//$contrctveh_start .='<div style="display:inline-block; padding:5px 10px;"><input type="text" name="addr_f_216" value="'. $exp[1] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:162px; border:none;"></div>';
				$contrctveh_start .='<div style="display:inline-block; padding:5px 10px;"><input type="text" name="edit_address_c_216" value="'. $exp[1] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:162px; border:none;"></div>';
				}

				$contrctveh_start .='<span style="background-color:#6450ae; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 14px; cursor: pointer;"onclick="this.parentElement.remove();refresh_contvehtable();"> Remove </span></div>';
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
			//echo "<pre>";
			//print_r($ok);

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
	
	/*$contract_period = strtoupper(str_replace("Period: ","",$row[15])); 
	
	$period_a = ""; 
	$period_b = "";
	$period_qty = "";
	$period_c = ""; 
	$period_d = "";
	if (strlen($contract_period)>1) {
	$period_parts = explode(" ", $contract_period);
	if (isset($period_parts[0])) { $period_a = $period_parts[0]; } 
	if (isset($period_parts[2])) {$period_b = $period_parts[2]; } 
	if (isset($period_parts[4])) {$period_qty = $period_parts[4]; } 
	if (isset($period_parts[5])) {$period_c = $period_parts[5]; } 
	if (isset($period_parts[7])) {$period_d = $period_parts[7]; } 
	}*/
	
	//$vehicle_one = $row[16];
	//$vehicle_two = $row[17];
	
	//$contract_vehicle = "<option hidden selected value='" . $row[18] . "'>" . $row[18] . "</option>"; //$row[18];
	//$opp_status = $row[17]; //"<option hidden selected value='" . $row[19] . "'>" . $row[19] . "</option>";

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
	$facility = "<option hidden selected value='" . $row[19] . "'>" . $row[19] . "</option>"; 
	$clearance_level = "<option hidden selected value='" . $row[20] . "'>" . $row[20] . "</option>";
	
	$proposal_due = $row[21];
	
	$proposal_due_date = "";
	$proposal_due_time = "";
	if (strlen($proposal_due>1)) {
	$phpdate = strtotime( $proposal_due );
	$proposal_due_date_old = date( 'm/d/Y', $phpdate ); //Y-m-d H:i:s on 80 date('Y-m-d')
	$proposal_due_time = date( 'H:i', $phpdate ); //not A
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
	$qa_due_date = date( 'm/d/Y', $phpdate ); //Y-m-d H:i:s on 80 date('Y-m-d')
	$qa_due_time = date( 'H:i', $phpdate ); //not A
	}
	//$qa_due_date = $qa_due;
	//$qa_due_date = date("Y-m-d", strtotime($qa_due));
	if (strlen($qa_due>1)) {
	$qa_due_date = date("Y-m-d", strtotime($qa_due));
	}
	else
	{ $qa_due_date = ""; }
	
	$reason = $row[23];
	$manager = $row[24]; //"<option hidden selected value='" . $row[26] . "'>" . $row[26] . "</option>";
	
	$qa_timezone = "<option hidden selected value='" . $row[25] . "'>" . $row[25] . "</option>"; /*$row[27];*/
	$proposal_timezone = "<option hidden selected value='" . $row[26] . "'>" . $row[26] . "</option>"; /*$row[28];*/
	
	//$contract_vehicle_two = "<option hidden selected value='" . $row[27] . "'>" . $row[27] . "</option>"; //$row[18]; //$row[29];
	
	$gaps_datateam = $row[27];
	$notes_datateam = $row[28];
	$pricing_eval = "<option value='$row[29]'>$row[29]</option>";
	//$contract_pop2 = $row[33];
	$pop_partsb = explode("|||",$row[30]);
	$contract_pop_address2 = "";
	$contract_pop_city2 = ""; 
	$contract_pop_state2 = "";
	//if (count($pop_parts)==1) { $contract_pop_city = $pop_parts[1]; } else { $contract_pop_city = ""; }
	if (strpos($row[30], '|||')!== false) 
	//{ $contract_pop_city2 = $pop_partsb[1]; $contract_pop_state2 = $pop_partsb[2]; }
	{ 
	$contract_pop_address2 =  $pop_partsb[0];
	$contract_pop_city2 = $pop_partsb[1]; 
	$contract_pop_state2 = $pop_partsb[2]; 
	$state_dropdown_b2 = "<option value='" . $pop_partsb[2] . "'>" . $pop_partsb[2] . "</option><option value=''></option>";
	} 
	else { 
		$contract_pop_state2 = ""; $contract_pop_city2 = ""; $state_dropdown_b2 = "<option value=''></option>";
		}
	
	//$state_dropdown = $state_dropdown_a . $state_dropdown_b . $state_dropdown_c . $state_dropdown_d;
	//$state_dropdown2 = $state_dropdown_a2 . $state_dropdown_b2 . $state_dropdown_c2 . $state_dropdown_d;
	
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
	$certifications = $row[35];
	$solicitation_docs = $row[36];
//	$sharepoint_link = $row[37];
	$domains = json_decode($row[37]);
	$naics_code = $row[38];

/* update code starts by rajini */
		$db_previous_docs = $row[39];
		$prev_docs_value = "";


if ($row[40]==1) { $addendumChecked = "checked='checked'"; } 	

if($row[42] != '') { $size_standard = $row[42]; } else { $size_standard = ''; }

$ron_cp_date   = $row[43];
$tyler_cp_date = $row[44];
$team_cp_date  = $row[45];
$urls		   = $row[46]; 

if($row[47] == 1){$foia_req_checked = "checked='checked'";}else{$foia_req_checked = '';}
$foia_req_submitted = $row[47]; 
if($row[48] == 1){$foia_info_checked = "checked='checked'";}else{$foia_info_checked = '';}
$foia_info_received = $row[48];
$foia_req_submitted_date = $row[49];
$foia_info_received_date = $row[50];

		if (strpos($db_previous_docs, '||') !== false) {
				$ok = explode("||",$db_previous_docs);

				$db_previous_docs_start .= '<div name="prev_docs_div" id="prev_docs_div">';
				for($i = 0; $i<count($ok);){
					if($ok[$i]){
						$db_previous_docs_start .= '<div style="color:#a269c6; width:90%; border:1px solid #d4d4d4;"><div style="display:inline-block; padding:5px 10px;"><input type="text" name="prev_docs_240" value="'. $ok[$i] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; width:570px; border:none;"></div>
	<!--<div style="display:inline-block; padding:5px 10px;"><input type="text" name="addr_e_215" value="'. $row[2] .'" readonly style="padding:2px 5px; font-weight:500; color:#fff; color:#3c4db0; border:none; width:126px;"></div> -->
						<span style="background-color:#6450ae; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 14px; cursor: pointer;"onclick="this.parentElement.remove();refresh_prev_docs();"> Remove </span></div>';
					}
					$i++;
				}
				$db_previous_docs_start .= '</div>';
		}		
		 else { 
			 $prev_docs_value = $db_previous_docs; 
		}
		/* update code ends here */


	//echo $contrctveh_start;
	//exit;
	$enterprise_solutions = (isset($domains) &&  in_array('Enterprise Solutions',$domains)) ? 'checked="checked"' : '';
	$environmental_services = (isset($domains) && in_array('Environmental Services',$domains)) ? 'checked="checked"' : '';
	$facilities = (isset($domains) && in_array('Facilities',$domains)) ? 'checked="checked"' : '';
	$intelligence_services = (isset($domains) && in_array('Intelligence Services',$domains)) ? 'checked="checked"' : '';
	$logistics = (isset($domains) && in_array('Logistics',$domains)) ? 'checked="checked"' : '';
	$management_advisory = (isset($domains) && in_array('Management and Advisory',$domains)) ? 'checked="checked"' : '';
	$research_development = (isset($domains) && in_array('Research and Development',$domains)) ? 'checked="checked"' : '';
	$technical_engineering = (isset($domains) && in_array('Technical and Engineering',$domains)) ? 'checked="checked"' : '';

$dont_show_agenda_check = "";
if($row[41]){
$dont_show_agenda_check = "checked";
}
	//$form_update_content .= "<tr><td>ID:</td><td>$db_poc_id</td></tr>";
	$form_update_content .= "<tr><td width='160'><strong>Title</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'><div class='popup' onclick=''>
	<input style='width:600px; border:1px solid #cbcbcb;  padding:5px; border-left:5px solid #3c4db0;' name='opp_title' id='opp_title' required autocomplete='off' type='text' value='$opp_title' /><span class='popuptext' id='myPopup1'>Title - Required Field</span>&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' name='agenda_show_status' id='agenda_show_status' value='1' {$dont_show_agenda_check}><strong>&nbsp;Don't show in Agenda</strong></div></td></tr>";
	
	
	/*$form_update_content .= "<tr><td><strong>Vehicle</strong></td><td class='td-left'>
	<select name='opp_vehicle' size='1' class='select-styled'>
				  <option value=''></option>
				  <option value='OASIS 8(a)'>OASIS 8(a)</option>
				  <option value='OASIS SB'>OASIS SB</option>
				</select>
	</td></tr>";*/
	$form_update_content .= "<tr><td><strong>Contract Vehicle(s)</strong><span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'>
		<div class='popup' onclick=''>
			$vehicles_dropdown_a
			 $contract_vehicle
			$vehicles_dropdown_c
			$vehicles_dropdown_d
		<span class='popuptext' id='myPopup2'>Contract Vehicle(s) - Required Field</span>
		</div>
	
	<input style='width:153px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0; display: none;' name='edit_other_vehicle_name' id='edit_other_vehicle_name' autocomplete='off' type='text' value=''/>
	

	<div style='font-weight:700; width:27px; display:inline-block; /*vertical-align:top;*/ margin-left:10px;'><strong>ID</strong><span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></div>
	<input style='width:153px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' name='opp_vehicle_one' id='opp_vehicle_one' type='text' value=''  autocomplete='off'/> 
	<div style='font-weight:700; width:69px; display:inline-block; /*vertical-align:top;*/ margin-left:10px;'><strong>Set-Aside</strong><span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></div>
	<div class='popup' onclick=''>
	<select name='edit_set_aside' id='edit_set_aside' size='1' class='select-styled' style='border-left:5px solid #3c4db0;'>
				  <option value=''></option>
				  <option value='8(a) Competed'>8(a) Competed</option>
				  <option value='8(a) Directed'>8(a) Directed</option>
				  <option value='HUBZone'>HUBZone</option>
				  <option value='Woman Owned'>Woman Owned</option>
				  <option value='Unrestricted'>Unrestricted</option>
				  <option value='Small Business'>Small Business</option>
	</select>
	<div style='background-color: #e4e4e4;
    padding: 4px;
    width: 80px;
    text-align: center; margin-top:10px;
    font-weight: 700; display:inline-block; margin-left: 20px; margin-bottom:10px; cursor: pointer;' onclick='contractveh_add();'>Add</div>
	</td></tr>";

	//add button added by rajini
	$form_update_content .="<tr><td colspan='2'>

    $contrctveh_start
    <DIV name='contractveh_address' id='contractveh_address'></div>
		<input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='contractveh_table' id='contractveh_table' type='hidden' value='$contrctveh_in' />
		
		<DIV style='visibility: hidden;' onclick='refresh_contvehtable(); alert(\"refresh\");'>REFRESH</div>

		</td></tr>";
//add button code ends here
	
	/*<div class='popup' onclick=''>
	<input style='width:200px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' name='opp_released' id='opp_released' type='text' placeholder='MM/DD/YYYY' onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup='dateslashes(this);' maxlength='10' minlength='10' pattern='.{0}|.{10,}' title='10 character minimum'  max='2100-12-31' autocomplete='off' required value='$opp_released'/>
		<span class='popuptext' id='myPopup4'>Release Date - Required Field</span></div>
	 <span style='margin-left:10px'><span style='color:#d4d4d4' onclick='opp_released_click();'> &#x1F4C5; </span></span>*/

/*--------------------------   Domains Block Starts Here. -------------------------------------*/	 	
	$form_update_content .= "<tr><td><strong>Domains</strong> </td><td class='td-left'>
	
	<div class='dropdown' style='display: inline-block;'> 
            <button class='dropdown-toggle'
                    type='button' 
                    id='multiSelectDropdown'
                    data-bs-toggle='dropdown' 
                    aria-expanded='false'
					style='width: 202px; border: 1px solid; height: 29px; background: white; border-color: #ccc; font-size: 14px;'> 
                Select &nbsp;Domains
            </button> 
	<ul class='dropdown-menu' aria-labelledby='multiSelectDropdown'> 
		<li> 
			<label> <input name='domains[]' type='checkbox' style='margin-left: 9px;' value='Enterprise Solutions' $enterprise_solutions> Enterprise Solutions </label> 
		</li> 
		<li> 
			<label> <input name='domains[]' type='checkbox' style='margin-left: 9px;' value='Environmental Services' $environmental_services>  Environmental Services </label> 
		</li> 
		<li> 
			<label> <input name='domains[]' type='checkbox' style='margin-left: 9px;' value='Facilities' $facilities> Facilities </label> 
		</li> 
		<li> 
			<label> <input name='domains[]' type='checkbox' style='margin-left: 9px;' value='Intelligence Services' $intelligence_services> Intelligence Services </label> 
		</li> 
		<li> 
			<label> <input name='domains[]' type='checkbox' style='margin-left: 9px;' value='Logistics' $logistics> Logistics </label> 
		</li> 
		<li> 
			<label> <input name='domains[]' type='checkbox' style='margin-left: 9px;' value='Management and Advisory' $management_advisory> Management and Advisory </label> 
		</li> 
		<li> 
			<label> <input name='domains[]' type='checkbox' style='margin-left: 9px;' value='Research and Development' $research_development> Research and Development </label> 
		</li> 
		<li> 
			<label> <input name='domains[]' type='checkbox' style='margin-left: 9px;'  value='Technical and Engineering' $technical_engineering> Technical and Engineering </label> 
		</li> 
	</ul> 
        </div>
<!------------------------   Domains Block Ends Here. -------------------------------------------->
	
	<div style='font-weight:700; width:40px; display:inline-block; vertical-align:top; margin-left:10px;'>NAICS<br/>Code <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></div>
	<input style='width:141px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' name='edit_naics_code' id='edit_naics_code' autocomplete='off' type='text' value='$naics_code' list='edit_naics_codes' required/>

			<datalist id='edit_naics_codes'>
				$naics_code_dropdown
			</datalist> 

	<div style='font-weight:700; width:153px; display:inline-block; vertical-align:top; margin-left:10px;'>Size Standards (\$M / E#)
	<span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></div>
	<input style='width:111px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0; text-align: center;' name='edit_size_standard' id='edit_size_standard' autocomplete='off' type='text' value='$size_standard' readonly /></td></tr>"; 

	
	$form_update_content .= "<tr><td><strong>Release Date</strong> </td><td class='td-left'>
				<input style='width:200px;; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' type='date' id='opp_released' name='opp_released' value='$opp_released'> 
		</td></tr>";
	 
	$form_update_content .= "<tr><td><strong>Opportunity Type</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'>
		<div class='popup' onclick=''>
	<select name='opp_response' size='1' required class='select-styled' style='border-left:5px solid #3c4db0;'>
				  $opp_response
				  <option value='Industry Day'>Industry Day</option>
				  <option value='RFI'>RFI</option>
				  <option value='Draft RFP'>Draft RFP</option>
				  <option value='RFP'>RFP</option>
				  <option value='RFQ'>RFQ</option>
				  <option value='Forecast'>Forecast</option>
				  <option value='Ongoing'>Ongoing</option>
				</select>
				
			<span class='popuptext' id='myPopup5'>Opportunity Type - Required Field</span></div>
				</td></tr>";
				
	/*<input style='width:200px; border:1px solid #cbcbcb; padding:5px;' id='proposal_date' name='proposal_date' onkeyup='dateslashes(this);' autocomplete='off' placeholder='MM/DD/YYYY' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' maxlength='10' minlength='10' pattern='.{0}|.{10,}' title='10 character minimum' max='2100-12-31' value='" . $proposal_due_date . "' />
	 <span style='margin-left:10px'><span style='color:#d4d4d4; margin-right:10px;' onclick='proposal_date_click();'> &#x1F4C5; </span></span>*/			
	
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
	
	/*<input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='qa_date' id='qa_date'  type='text' onkeyup='dateslashes(this);' onkeypress='return event.charCode >= 48 && event.charCode <= 57'  autocomplete='off' placeholder='MM/DD/YYYY' maxlength='10' minlength='10' pattern='.{0}|.{10,}' title='10 character minimum' max='2100-12-31' value='" . $qa_due_date . "' />
	<span style='margin-left:10px'><span style='color:#d4d4d4; margin-right:10px;' onclick='qa_due_date_click();'> &#x1F4C5; </span></span>*/
	
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
	
	/*<div class='popup' onclick=''>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px; <!--border-left:5px solid #3c4db0;-->' name='opp_rfp_date' id='opp_rfp_date' autocomplete='off' type='text' placeholder='MM/DD/YYYY' onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup='dateslashes(this);' maxlength='10' minlength='10' pattern='.{0}|.{10,}' title='10 character minimum'  max='2100-12-31' value='" . $opp_rfp_date . "' />
	<span class='popuptext' id='myPopup7'>RFP Release Date - Required Field</span></div>  
	<span style='margin-left:10px'><span style='color:#d4d4d4; margin-right:10px;' onclick='opp_rfp_click();'> &#x1F4C5; </span></span>*/
	
	/*$form_update_content .= "<tr><td><strong>RFP Exp.Date</strong></td><td class='td-left'>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='opp_rfp_date' name='opp_rfp_date' value='$opp_rfp_date'>
	</td></tr>";
	
	<div class='popup' onclick=''>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px; <!--border-left:5px solid #3c4db0;-->' name='opp_award_date' id='opp_award_date' autocomplete='off' type='text' placeholder='MM/DD/YYYY' onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup='dateslashes(this);' maxlength='10' minlength='10' pattern='.{0}|.{10,}' title='10 character minimum'  max='2100-12-31' value='" . $opp_award_date . "' />
	<span class='popuptext' id='myPopup6'>Award Date - Required Field</span></div>  
	<span style='margin-left:10px'><span style='color:#d4d4d4; margin-right:10px;' onclick='opp_award_click();'> &#x1F4C5; </span></span>
	
	$form_update_content .= "<tr><td><strong>Award Date</strong> <!--<span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span>--></td><td class='td-left'>
	
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='opp_award_date' name='opp_award_date' value='$opp_award_date'>
	</td></tr>";*/
	
	/*<div class='popup' onclick=''>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px; <!--border-left:5px solid #3c4db0;-->' name='est_pop_start_date' id='est_pop_start_date' autocomplete='off' type='text' placeholder='MM/DD/YYYY' onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup='dateslashes(this);' maxlength='10' minlength='10' pattern='.{0}|.{10,}' title='10 character minimum'  max='2100-12-31' value='" . $opp_est_pop_start_date . "' />
	<span class='popuptext' id='myPopup6'>Award Date - Required Field</span></div>  
	<span style='margin-left:10px'><span style='color:#d4d4d4; margin-right:10px;' onclick='opp_award_click();'> &#x1F4C5; </span></span>*/

	$form_update_content .= "<tr><td><strong>Ron CP Date</strong> <!--<span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span>--></td><td class='td-left'>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' name='edit_ron_cp_date' id='edit_ron_cp_date' value='$ron_cp_date'>&nbsp;&nbsp;&nbsp;
	<strong>Tyler CP Date</strong>&nbsp;&nbsp;<input style='width:180px;; border:1px solid #cbcbcb; padding:5px;' type='date' name='edit_tyler_cp_date' id='edit_tyler_cp_date' value='$tyler_cp_date'>&nbsp;&nbsp;&nbsp;
	<strong>Team CP Date</strong>&nbsp;&nbsp;<input style='width:180px;; border:1px solid #cbcbcb; padding:5px;' type='date' name='edit_team_cp_date' id='edit_team_cp_date' value='$team_cp_date'></td></tr>";
	
	$form_update_content .= "<tr><td><strong>FOIA</strong> <!--<span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span>--></td><td class='td-left'>
	<input type='checkbox' name='edit_foia_req_sub_box' id='edit_foia_req_sub_box' value='1' $foia_req_checked>&nbsp;<label for='pricing12'>Request Submitted</label>&nbsp; 
	<input style='width:200px; border:1px solid #cbcbcb; padding:5px; display: none;' type='date' name='edit_foia_req_sub_date' id='edit_foia_req_sub_date' value='$foia_req_submitted_date'>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='checkbox' name='edit_foia_info_receiv_box' id='edit_foia_info_receiv_box' value='1' $foia_info_checked>&nbsp;<label for='pricing12'>Info Received</label>&nbsp;
	<input style='width:200px; border:1px solid #cbcbcb; padding:5px; display: none;' type='date' name='edit_foia_info_receiv_date' id='edit_foia_info_receiv_date' value='$foia_info_received_date'>";
	
	$form_update_content .= "<tr><td><strong>Est. PoP Start Date</strong> <!--<span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span>--></td><td class='td-left'>
	
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='est_pop_start_date' name='est_pop_start_date' value='$opp_est_pop_start_date'>
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Department</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='agency'  autocomplete='off' type='text' value='$agency' /></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Agency</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='subagency'  autocomplete='off' type='text' value='$subagency' /></td></tr>";
	
	/*$form_update_content .= "<tr><td><strong>Bid #:</strong></td><td><input style='width:100%; border:1px solid #cbcbcb; padding:5px;' name='opp_bidopp' type='text' value='$opp_bidopp' /></td></tr>";*/
	/*$form_update_content .= "<tr><td><strong>Opportunity Id1</strong></td><td class='td-left'><input style='width:404px; border:1px solid #cbcbcb; padding:5px;' name='opp_vehicle_one' type='text' value='$vehicle_one' /></td></tr>";
	$form_update_content .= "<tr><td><strong>Opportunity Id2</strong></td><td class='td-left'><input style='width:404px; border:1px solid #cbcbcb; padding:5px;' name='opp_vehicle_two' type='text' value='$vehicle_two' /></td></tr>";*/
	
	
	$form_update_content .= "<tr><td><strong>Requestor Name</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='opp_requestor' type='text' value='$opp_requestor' /></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Facility Clearance</strong></td><td class='td-left'><select name='clearance_level' size='1' class='select-styled'>
				  $clearance_level
				  <option value=''></option>
				  <option value='Not Applicable'>Not Applicable</option>
				  <option value='Secret'>Secret</option>
				  <option value='Secret w/ Safeguarding'>Secret w/ Safeguarding</option>
				  <option value='Top Secret'>Top Secret</option>
				  <option value='Top Secret w/ Safeguarding'>Top Secret w/ Safeguarding</option>
				</select></td></tr>";
	
	
	$form_update_content .= "<tr><td><strong>Certifications Required</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='certifications' type='text' value='$certifications' /></td></tr>";

	/*$form_update_content .= "<tr><td><strong>Opportunity Link</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='opportunity_link' type='text' value='$opportunity_link' /></td></tr>";

	//$form_update_content .= "<tr><td><strong>SharePoint Link</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='sharepoint_link' type='text' value='$sharepoint_link' /></td></tr>"; */

	//$form_update_content .= "<tr><td><strong>Solicitation Docs</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='solicitation_docs' type='text' value='$solicitation_docs' /></td></tr>";

	/*$form_update_content .= "<tr><td><strong>Previous Release(s)</strong></td><td class='td-left'>
	<input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='previous_releases' id='previous_releases' type='text' value='' autocomplete='off'/>
	<div style='background-color: #e4e4e4;
		padding: 4px;
		width: 80px;
		text-align: center; margin-top:10px;
		font-weight: 700; display:inline-block; margin-left: 20px; margin-bottom:10px; cursor: pointer;' onclick='previous_docs_add();'>Add</div>
	</td></tr>";  */
	//<div id='prev_docs_div'></div>
	

$form_update_content .="<tr><td colspan='2'>
$db_previous_docs_start
    <DIV name='prev_docs_div' id='prev_docs_div'></div>
		<input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='prev_release_docs' id='prev_release_docs' type='hidden' value='$prev_release_docs_value' />
		
		<DIV style='visibility: hidden;' onclick='refresh_prev_docs(); alert(\"refresh\");'>REFRESH</div>

		</td></tr>";


	/*$form_update_content .= "<tr><td><strong>Synopsis:</strong></td><td><input style='width:100%; border:1px solid #cbcbcb; padding:5px;' name='opp_synopsis' type='text' value='$opp_synopsis' /></td></tr>";*/
	/*<textarea style='width:90%; border:1px solid #cbcbcb; padding:5px;' name='opp_synopsis' cols='10' rows='10'>$opp_synopsis</textarea>*/
	/*onchange=\"alert('hi'); blurfunction('reason', this.value, 3200)\"*/
	
//	$form_update_content .= "<tr><td style='color:blue'><strong><div onclick=\"saveDescription($opp_opportunity_id);\">Description</div></strong></td><td class='td-left'>
	$form_update_content .= "<tr>
        <td><strong>URLs</strong></td>
        <td>
			<div style='width:86%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='edit_urls' name='edit_urls'>$urls</textarea>
			</div>
		  </td>
      </tr>";

	$form_update_content .= "<tr><td><strong>Notes (Research Team)</strong></td><td class='td-left'>
	
			<div style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='notes_datateam' name='notes_datateam'>$notes_datateam</textarea>
			</div>
	</td></tr>";

	/*$form_update_content .= "<tr><td><strong>*PoP:*</strong></td><td><input style='width:100%; border:1px solid #cbcbcb; padding:5px;' name='opp_pop' type='text' value='$opp_pop' /></td></tr>";*/ //REMIVING THIS ONE
	$form_update_content .= "<tr><td><strong>Performance Location</strong></td><td class='td-left'>
	<select name='facility' size='1' class='select-styled'>
				  $facility
				  <option value='Federal Facility'>Federal Facility</option>
				  <option value='Contractor Facility'>Contractor Facility</option>
				</select></td></tr>";
	/*$form_update_content .= "<tr><td><strong>Address</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='contract_pop' type='text' value='$contract_pop' /></td></tr>";*/
	
	/*$form_update_content .= "<tr><td><strong>Address</strong></td><td class='td-left'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='contract_pop' type='text' autocomplete='new-password' value='$contract_pop_address' />
	 <div style='font-weight:700; width:50px; display:inline-block;'>City</div>
	 <input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='contract_city' autocomplete='new-password' type='text' value='$contract_pop_city' />
	 <div style='font-weight:700; width:50px; display:inline-block;'>State</div>$state_dropdown
	 
	 <div style='display:inline-block;padding:6px 10px;vertical-align:top;'>
	 <div style='background-color: #e4e4e4; display:none;
    padding: 4px;
    width: 80px;
    text-align: center; margin-top:-4px;
    font-weight: 700;' onclick='addressline2()'>Add</div>
	</div>

	 </td></tr>";*/
	 //<DIV style='display:inline-block;' onclick='refresh_table(); alert(\"refresh\");'>REFRESH</div>
	 
	 /*$form_update_content .= "<tr><td id='address_left' style='color:#fff'><strong>Address2</strong></td>
	 <td id='address_right' class='td-left' style=''>
	 <input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='contract_pop2' autocomplete='new-password' type='text' value='$contract_pop_address2' />
	 <div style='font-weight:700; width:50px; display:inline-block;'>City</div>
	 <input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='contract_city2' autocomplete='new-password' type='text' value='$contract_pop_city2' />
	 <div style='font-weight:700; width:50px; display:inline-block;'>State</div>$state_dropdown2
	 
	 <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'></div>
		<input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='address_combined' id='address_combined' type='hidden' value='' />
	 </td></tr>";*/
	/*$form_update_content .= "<tr><td><strong>Period</strong></td><td class='td-left'><input style='width:100%; border:1px solid #cbcbcb; padding:5px;' name='contract_period' type='text' value='$contract_period' /></td></tr>";*/

	$form_update_content .= "<tr><td><strong>Address</strong></td><td class='td-left'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='contract_pop' id='contract_pop' autocomplete='new-password' type='text' value='' />
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
	  /*<div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Pricing Evaluation</div>
	  <input type='checkbox' id='pricing13' name='pricing13' value='LPTA (Lowest Price Technically Acceptable)' onclick=\"pricing_update();\" $opp_pricing_m>
	  <label for='pricing13'> LPTA (Lowest Price Technically Acceptable)</label>
	  </div>*/
	  
	$form_update_content .= "
	
	<input style='width:100%; border:1px solid #cbcbcb; padding:5px;' id='opp_pricing' name='opp_pricing' type='hidden' value='' /></td></tr>";
	
	
	/*$form_update_content .= "<tr><td><strong>Pricing</strong></td><td class='td-left'><input style='width:100%; border:1px solid #cbcbcb; padding:5px;' name='opp_pricing' type='text' value='$opp_pricing' /></td></tr>";*/
	
	/*$form_update_content .= "<tr><td><strong>Recruiting:</strong></td><td><input style='width:100%; border:1px solid #cbcbcb; padding:5px;' name='opp_recruiting' type='text' value='$opp_recruiting' /></td></tr>";*/
	/*$form_update_content .= "<tr><td><strong>Recruiting</strong></td><td class='td-left'><textarea style='width:100%; border:1px solid #cbcbcb; padding:5px;' name='opp_recruiting' cols='10' rows='10'>$opp_recruiting</textarea></td></tr>";*/
	/*$opp_recruiting*/
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
	
	/*<textarea style='width:90%; border:1px solid #cbcbcb; padding:5px;' name='opp_proposal' cols='10' rows='10'>$opp_proposal</textarea>*/
	
//	$form_update_content .= "<tr><td style='color:blue;'><strong><div onclick=\"saveSubmission($opp_opportunity_id);\">Submission Requirements</strong></div></td><td class='td-left'>

	$form_update_content .= "<tr><td><strong><div>Description</div></strong></td><td class='td-left'>
			
			<div style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='opp_synopsis' name='opp_synopsis'>$opp_synopsis</textarea>
			</div>
	
	</td></tr>";

	$form_update_content .= "<tr><td><strong><div>Submission <br/>Requirements</strong></div></td><td class='td-left'>
	
			<div style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='opp_proposal' name='opp_proposal'>$opp_proposal</textarea>
			</div>
	
	</td></tr>";

	/*<textarea style='width:90%; border:1px solid #cbcbcb; padding:5px;' name='gaps_datateam' cols='10' rows='10'>$gaps_datateam</textarea>*/
	
	$form_update_content .= "<tr><td><strong>Gaps (Research Team)</strong></td><td class='td-left'>
	
			<div style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='gaps_datateam' name='gaps_datateam'>$gaps_datateam</textarea>
			</div>
	
	</td></tr>";
	
	/*<textarea style='width:90%; border:1px solid #cbcbcb; padding:5px;' name='notes_datateam' cols='10' rows='10'>$notes_datateam</textarea>*/
	
	$form_update_content .= "<tr><td><strong>Decision</strong></td><td class='td-left'><input style='width:600px; border:none; padding:5px;' name='opp_decision' type='text' value='$opp_decision' readonly/>
				
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Assigned To</strong></td><td class='td-left'><input style='width:600px; border:none; padding:5px;' name='manager' type='text' value='$manager' readonly/>
				
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Reason</strong></td><td class='td-left'><input style='width:600px; border:none; padding:5px;' name='reason' type='text' value='$reason' readonly/></td></tr>";
	/*$form_update_content .= "<tr><td><strong>Gap(s)</strong></td><td class='td-left'>$opp_gaps</td></tr>";*/
	/*$form_update_content .= "<tr><td><strong>Gap(s)</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='opp_gaps' type='text' value='$opp_gaps' /></td></tr>";*/
	$form_update_content .= "<tr><td><strong>Gap(s)</strong></td><td class='td-left'><input style='width:600px; border:none; padding:5px;' name='opp_gaps' type='text' value='$opp_gaps' readonly/></td></tr>";
	
//		$form_update_content .= "<tr><td><strong>Gap(s)</strong></td><td class='td-left'><input style='width:600px; border:none; padding:5px;' name='opp_gaps' type='text' value='$opp_gaps' readonly/></td></tr>";
	
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

		$form_update_content .= "<tr><td style='color:#0000ff; font-size: 13px;'><strong>Do we have addendums </strong> </td><td class='td-left'><input type='checkbox' name='addendum'  id='addendum' onclick='return getAddendumValue();' value='0'  $addendumChecked/></td></tr>";

	}
	
	/*$extra_top_buttons = "
	<div style=\"display:inline-block; width:48%;\"><input style=\"margin-left: 50px; background-color:#334893; padding:4px 16px; border-radius:7px; color:#fff; font-weight: 700;\" type=\"button\" value=\"Next\" 
onclick=\"window.top.location.href = 'https://ardentinc.com/bids-test/addrole_incumbents.php?which_update_id=$opp_opportunity_id'\" >
</div>
<div style=\"display:inline-block; width:48%; text-align:right;\"><input style=\"background-color:#23a69a; padding:4px 16px; border-radius:7px; color:#fff; font-weight: 700;\" type=\"submit\" value=\"Update\"></div>";*/


	$extra_top_buttons = "
<div style=\"display:inline-block; width:98%; text-align:left;\">

<div style=\"display:inline-block; width:48%; vertical-align:top;\">
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
</div>
<div style=\"display:inline-block; width:46%;\">
<input style=\"margin-right: 50px; padding:4px 16px; font-weight: 700;  width:100px; cursor: pointer; float:right;\" type=\"submit\" value=\"Update\"></div>


</div>";

/*<div style='display:inline-block; width:48%;  text-align:center'><input style='margin-left: 50px; padding:4px 16px; font-weight: 700;  width:100px;' type='button' value='Next' 
onclick=\"window.top.location.href = 'https://ardentinc.com/bids-test/addrole_incumbents.php?which_update_id=$opp_opportunity_id'\" >
</div>*/

	
	print ($form_table . $extra_top_buttons . $form_update_content . "</table>");
?>

<input type="hidden" name="opp_opportunity_id" value="<?php print $opp_opportunity_id; ?>"/>
<!--<input type="hidden" name="<= ASCsrf::getTokenName() ?>" value="<= ASCsrf::getToken() ?>">-->
<div>
<!--<div style="display:inline-block; width:98%; text-align:left;"><input style="margin-right: 50px; padding:4px 16px; font-weight: 700;  width:100px; float:right" type="submit" value="Update"></div>-->
<?php print("<div style=\"display:inline-block; width:98%; text-align:left;\">

<div style=\"display:inline-block; width:48%; vertical-align:top;\">
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
</div>
<div style=\"display:inline-block; width:46%;\">
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
	$query = "SELECT opportunity_id, filename, filedesc, filetype, filetimestamp, document_id FROM documents WHERE opportunity_id=$opp_opportunity_id";
	$result = mysqli_query($mysqli_link, $query);
	//print $query;
	while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
		$screen_opportunity_id = $row[0];
		$screen_filename = $row[1];
		$screen_filedesc = ucfirst($row[2]);
		$screen_filetype = strtoupper($row[3]);
		$screen_filetime = strtotime($row[4]);
		$document_id = $row[5];
		$screen_filetimeformatted = date("m/d/Y", $screen_filetime);
		$partner_list .= "<div style='padding:3px;'>
		<div style='width:50%; display:inline-block;'><a style='color:#181818;' href='$baseurl/documents/" . $screen_filename . "' target='_blank'>" . $screen_filedesc . "</a></div>
		<div style='width:15%; display:inline-block;'>$screen_filetype</div>
		<div style='width:15%; display:inline-block;'>$screen_filetimeformatted</div>
		<div style='width:15%; display:inline-block;'><button class='delete' id='delete_".$document_id."' style='cursor: pointer;'>Delete</button></div>
		</div>";
	}
	print $partner_list;
print("</div>"); 
?>
</html>
<script>
$(document).ready(function() {
	$('#upload').on('click', function(e) {
	var fileInput = $('#sortpicture')[0];

        if (fileInput.files.length === 0) {
            e.preventDefault(); 
            alert('Please choose a file to upload.');
        }else{
			$('#upload').prop('disabled', true);
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
					$('#upload').prop('disabled', false);
				}
			 });
		}
	});

		$('.delete').on('click', function() {
			var butnid = $(this).attr('id');
			var fid_temp = butnid.split('_');
			var fid = fid_temp[1];
			var opp_id = "<?php print($which_update_id);?>";
//		alert(fid_temp[1]);            
			$.ajax({
				url: '<?php echo $baseurl; ?>/delete_file.php',  
				dataType: 'text', 
				type: 'POST',
				data: {id:fid, oppId:opp_id},                      
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
    //'//www.tinymce.com/css/codepen.min.css'
  ]
});
  </script>

<script>
function pricing_update() {
	//var pricingmod = document.getElementById('opp_pricing').value;
	//pricingmod = "";
	//if document.getElementById('pricing1')
	var pricing_text = "";
	document.getElementById('opp_pricing').value = "";
	//var p1=document.getElementById('pricing1').checked; 
	if (document.getElementById('pricing1').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing1').value + '<BR>'; }
	/*if (document.getElementById('pricing2').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing2').value + '<BR>'; }
	if (document.getElementById('pricing3').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing3').value + '<BR>'; }
	if (document.getElementById('pricing4').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing4').value + '<BR>'; }*/
	if (document.getElementById('pricing5').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing5').value + '<BR>'; }
	/*if (document.getElementById('pricing6').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing6').value + '<BR>'; }
	if (document.getElementById('pricing7').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing7').value + '<BR>'; }
	if (document.getElementById('pricing8').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing8').value + '<BR>'; }
	if (document.getElementById('pricing9').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing9').value + '<BR>'; }
	if (document.getElementById('pricing10').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing10').value + '<BR>'; }*/
	if (document.getElementById('pricing11').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing11').value + '<BR>'; }
	if (document.getElementById('pricing12').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing12').value + '<BR>'; }
	if (document.getElementById('pricing13').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing13').value + '<BR>'; }
	//if (p1.checked){ pricing_text += document.getElementById('pricing1').value; }
	//document.getElementById('opp_pricing').innerhtml = pricing_text;
	//var p2=document.getElementById('pricing2'); if (p2.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing2').value; }
	/*var p3=document.getElementById('pricing3'); if (p3.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing3').value; }
	var p4=document.getElementById('pricing4'); if (p4.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing4').value; }
	var p5=document.getElementById('pricing5'); if (p5.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing5').value; }
	var p6=document.getElementById('pricing6'); if (p6.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing6').value; }
	var p7=document.getElementById('pricing7'); if (p7.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing7').value; }
	var p8=document.getElementById('pricing8'); if (p8.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing8').value; }
	var p9=document.getElementById('pricing9'); if (p9.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing9').value; }
	var p10=document.getElementById('pricing10'); if (p10.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing10').value; }
	var p11=document.getElementById('pricing11'); if (p11.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing11').value; }
	var p12=document.getElementById('pricing12'); if (p12.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing12').value; }*/
	//document.getElementById('opp_pricing').value = document.getElementById('pricing1').value;
	//alert('Nice ' + p1);	
	//if (p1==true) { alert("OK" + document.getElementById('pricing1').value); }
}
</script>
<script>
//AUTOSTART
pricing_update();
</script>
<script>
function recruiting_table() {
	//alert("Nice");
	//CREATE DIV
	const divadd = document.createElement("div");
	//const node = document.createTextNode("aaa " + Math.floor(Math.random() * 255)); //0 thru 255);
	const node = document.createTextNode(""); //0 thru 255);
	//divadd.style.backgroundColor = "#a269c6"; //background-color:#a269c6; width:90%; border:1px solid #8c4fb5;
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
							//padding:2px 5px; font-weight:700; color:#fff; color:#3c4db0; width:60px; border:none;
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='pt_e_" + Math.floor(Math.random() * 255) + "' value='" + hoursVal + " HRS' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#fff; color:#3c4db0; width:60px; border:none;'></DIV>";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;margin-left:4px;'><input type='text' name='pt_b' value='" + document.getElementById("recruitingb").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#fff; color:#3c4db0; width:220px; border:none;'></DIV>";
	
	/*var kptext = "";			
	var kp=document.getElementById("recruiting_keypersonnel"); if (document.getElementById("recruiting_keypersonnel").checked==true){ kptext = "(KP)"; } else { kptext = ""; } */
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
					//eles.push(inputs[i]);
						//alert("# of inputs " + inputs.length + " OK " + inputs[index].name + " VAL " + inputs[index].value);
					//alert ("&" + inputs[index].name + "=" + inputs[index].value);
					combinedtext += inputs[index].value + "|||";
				}
		}
	
	//alert(inputs.length);
	//document.getElementById('car').value="1234567890abc";	
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
						//alert("# of inputs " + inputs.length + " OK " + inputs[index].name + " VAL " + inputs[index].value);
					combinedtext += inputs[index].value + "|||";
				}
		}
	
	document.getElementById('combined').value=combinedtext;	
}

/* fint code starts */
function contractveh_add(){
	var contract_veh		   = document.getElementById("contract_vehicle").value;
	var contract_veh_id		   = document.getElementById("opp_vehicle_one").value;
	var contract_veh_set_aside = document.getElementById("edit_set_aside").value;
	if(contract_veh == "") {
		alert("Select Contract Vehicle.");
		return false;
	}
	if(contract_veh_id == "") {
		alert("Enter Opp. ID.");
		return false;
	}
	if(contract_veh_set_aside == "") {
		alert("Select Set-Aside.");
		return false;
	}	
	const divadd = document.createElement("div");
	const node = document.createTextNode(""); 
	divadd.style.color = "#a269c6"; border:"1px solid #8c4fb5";
	divadd.style.border = "1px solid #d4d4d4";
	divadd.style.width = "90%";

	//divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='addr_a_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("contract_vehicle").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:135px; border:none;'></DIV>";

	if(contract_veh != "Other"){
		divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='addr_a_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("contract_vehicle").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:190px; border:none;' ></DIV>";
	}else{
		divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='addr_a_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("edit_other_vehicle_name").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:190px; border:none;' ></DIV>";
	}

	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='addr_b_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("opp_vehicle_one").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:160px; border:none;'></DIV>";

	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='edit_address_c_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("edit_set_aside").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:155px; border:none;'></DIV>";


	divadd.innerHTML += "<span style='background-color:#a04071; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 14px; float:right; margin-right:20px; margin-top:3px; cursor: pointer;' onclick='this.parentElement.remove();refresh_contvehtable();'> Remove </span>";
	//divadd.setAttribute("id","newarea");
	divadd.appendChild(node);
	const element = document.getElementById("contractveh_address");
	
	element.appendChild(divadd);
	
	//PASS TO INPUT
	var combinedtext = "";
	  var inputs, index;

		inputs = document.getElementsByTagName('input');
		for (index = 0; index < inputs.length; ++index) {
			
			if(inputs[index].name.indexOf('addr_a') == 0) {
					combinedtext = combinedtext + inputs[index].value + "|||";
//					combinedtext += inputs[index].value + "|||";
			}else if(inputs[index].name.indexOf('addr_b') == 0) {
					combinedtext = combinedtext + inputs[index].value;
			}else if(inputs[index].name.indexOf('edit_address_') == 0) {
//				    combinedtext = combinedtext.slice(0, -3);
					combinedtext = combinedtext + "+" + inputs[index].value + "|||";
			} 
		}
	document.getElementById('contractveh_table').value=combinedtext;
	
	//CLEAR INPUT ZONE
	document.getElementById('contract_vehicle').value="";
	document.getElementById('edit_other_vehicle_name').value="";
	document.getElementById('opp_vehicle_one').value="";
	document.getElementById('edit_set_aside').value="";
	document.getElementById('edit_other_vehicle_name').style.display = "none";
	document.getElementById('edit_other_vehicle_name').removeAttribute("required");
}
// Code to append Previous Documents Starts Here.
function previous_docs_add(){
	var prev_docs_val = document.getElementById("previous_releases").value;
	const prev_docs_val_div = document.createElement("div");
	const node = document.createTextNode(""); 
	prev_docs_val_div.style.color = "#a269c6"; border:"1px solid #8c4fb5";
	prev_docs_val_div.style.border = "1px solid #d4d4d4";
	prev_docs_val_div.style.width = "90%";
	prev_docs_val_div.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='prev_docs" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("previous_releases").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:567px; border:none;'></DIV>";

	prev_docs_val_div.innerHTML += "<span style='background-color:#a04071; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 14px; float:right; margin-right:20px; margin-top:3px; cursor: pointer;' onclick='this.parentElement.remove();refresh_prev_docs();'> Remove </span>";

	prev_docs_val_div.appendChild(node);
	const prev_docs_val_div_element = document.getElementById("prev_docs_div");
	
	prev_docs_val_div_element.appendChild(prev_docs_val_div);

	document.getElementById('previous_releases').value=prev_docs_val_div_element;
	document.getElementById('previous_releases').value="";


	//PASS TO INPUT
	document.getElementById('prev_release_docs').value = "";
	var relese_docs_combinedtext = "";
	  var inputs, index;

		inputs = document.getElementsByTagName('input');
		for (index = 0; index < inputs.length; ++index) {
			
			if(inputs[index].name.indexOf('prev_') == 0) {
					
					relese_docs_combinedtext += inputs[index].value + "||";
				}
		}
	document.getElementById('prev_release_docs').value=relese_docs_combinedtext;
	document.getElementById('previous_releases').value="";    
}

function refresh_prev_docs() {
	var combinedtext1 = "";
	  var inputs1, index1;

		inputs1 = document.getElementsByTagName('input');
		for (index1 = 0; index1 < inputs1.length; ++index1) {
			if(inputs1[index1].name.indexOf('prev_docs_') == 0) {
					combinedtext1 += inputs1[index1].value + "||";
				}
		}		
	document.getElementById('prev_release_docs').value=combinedtext1;	
}
// Code to append Previous Documents Ends Here.



function refresh_contvehtable() {
	var combinedtext = "";
	  var inputs, index;

		inputs = document.getElementsByTagName('input');
		for (index = 0; index < inputs.length; ++index) {
			
			
			if(inputs[index].name.indexOf('addr_') == 0) {
						//alert("# of inputs " + inputs.length + " OK " + inputs[index].name + " VAL " + inputs[index].value);
					combinedtext += inputs[index].value + "|||";
			}else if(inputs[index].name.indexOf('edit_address_') == 0){
				    combinedtext = combinedtext.slice(0, -3);
					combinedtext = combinedtext + "+" + inputs[index].value + "|||";
			}
		}
	
	document.getElementById('contractveh_table').value=combinedtext;	
}
/* fint code end */
function onsubmit_code() {
	//alert("HMMM");
	refresh_table();	
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
					//eles.push(inputs[i]);
						//alert("# of inputs " + inputs.length + " OK " + inputs[index].name + " VAL " + inputs[index].value);
					//alert ("&" + inputs[index].name + "=" + inputs[index].value);
					combinedtext += inputs[index].value + "|||";
				}
		}
	
	//alert(inputs.length);
	//document.getElementById('car').value="1234567890abc";	
	document.getElementById('combined_table').value=combinedtext;
	
	//CLEAR INPUT ZONE
	document.getElementById('contract_pop').value="";
	document.getElementById('contract_city').value="";
	document.getElementById('contract_state').value="";
	//document.getElementById('recruiting_keypersonnel').checked = false;
	//document.getElementById('recruitingd').value="";
}

function refresh_addr() {
//PASS TO INPUT
	var combinedtext = "";
	  var inputs, index;

		inputs = document.getElementsByTagName('input');
		for (index = 0; index < inputs.length; ++index) {
			
			
			if(inputs[index].name.indexOf('adp_') == 0) {
						//alert("# of inputs " + inputs.length + " OK " + inputs[index].name + " VAL " + inputs[index].value);
					combinedtext += inputs[index].value + "|||";
				}
		}
	
	document.getElementById('combined_table').value=combinedtext;
}
</script>

<script>
function showproposal(){
	//alert('hello111');
	document.getElementById("proposal_timezone").style.display = "inline-block";
}
function qatimezone(){
	//alert('qa'); qa_timezone
	document.getElementById("qa_timezone").style.display = "inline-block";
}
</script>
<script>
function requiredfields() {
	//alert("Required Fields");
  var x = document.forms["opp_update"]["opp_title"].value;
  if (x == "") {
    //alert("Title must be filled out (Required Field)");
	popup1();
	setTimeout(popup1, 5000);
	//x.focus();
	document.forms["opp_update"]["opp_title"].focus();
    return false;
  }
  /*var x = document.forms["opp_update"]["contract_vehicle"].value;
  if (x == "") {
    //alert("Contract Vehicle One must be filled out (Required Field)");
	popup2();
	setTimeout(popup2, 5000);
	//x.focus();
	document.forms["opp_update"]["contract_vehicle"].focus();
    return false;
  }
  var x = document.forms["opp_update"]["opp_vehicle_one"].value;
  if (x == "") {
    //alert("Vehicle One ID must be filled out (Required Field)");
	popup3();
	setTimeout(popup3, 5000);
	//x.focus();
	document.forms["opp_update"]["opp_vehicle_one"].focus();
    return false;
  }*/
  var x = document.forms["opp_update"]["opp_released"].value;
  if (x == "") {
    //alert("Release Date must be filled out (Required Field)");
	popup4();
	setTimeout(popup4, 5000);
	//x.focus();
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
  //opp_response
  //opp_released
  //contract_vehicle
  //opp_vehicle_one
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
  //setTimeout(popup1, 5000);
   //document.getElementById('myPopup1').fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
}
function popup2() {
  var popup2 = document.getElementById('myPopup2');
  popup2.classList.toggle('show');
  //setTimeout(popup2, 5000);
}
function popup3() {
  var popup3 = document.getElementById('myPopup3');
  popup3.classList.toggle('show');
	//setTimeout(popup3, 5000);
}
function popup4() {
  var popup4 = document.getElementById('myPopup4');
  popup4.classList.toggle('show');
	//setTimeout(popup4, 5000);
}
function popup5() {
  var popup5 = document.getElementById('myPopup5');
  popup5.classList.toggle('show');
	//setTimeout(popup5, 5000);
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
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('qa_date').focus();
		document.getElementById('qa_date').click();
	}
	 function proposal_date_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('proposal_date').focus();
		document.getElementById('proposal_date').click();
	}
	function opp_award_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('opp_award_date').focus();
		document.getElementById('opp_award_date').click();
	}
	function opp_rfp_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('opp_rfp_date').focus();
		document.getElementById('opp_rfp_date').click();
	} 
	function opp_released_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('opp_released').focus();
		document.getElementById('opp_released').click();
	}
	
         
      
</script>
<script>
function saveDescription(opp_id) {
	var opp_id=opp_id
//alert("Hi " + opp_id);
		// Get the value of the Summernote textarea
	  var oppSynopsis = document.getElementById("opp_synopsis").value;
	  
	  	var csrfTokenName = "TOKEN"; //<= ASCsrf::getTokenName() ?>";
		var csrfTokenValue = "VALUE"; //<= ASCsrf::getToken() ?>";
	
	  // Create an AJAX request
	  var xhr = new XMLHttpRequest();
	  xhr.open("POST", "save_note_to_db.php", true);
	  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	
	  // Prepare the data to be sent
	  //var data = "oppSynopsis=" + encodeURIComponent(oppSynopsis);
	  // Prepare the data to be sent
  		//var data = "opp_id=" + opp_id + "&oppSynopsis=" + encodeURIComponent(oppSynopsis);
		var data = "opp_id=" + opp_id + "&oppSynopsis=" + encodeURIComponent(oppSynopsis);
		data += "&" + encodeURIComponent(csrfTokenName) + "=" + encodeURIComponent(csrfTokenValue);
	
	  // Send the AJAX request
	  xhr.send(data);
	  
	  // Event listener to capture the response
	  xhr.addEventListener("load", function() {
		var response = xhr.responseText;
		alert(response); // display the response in an alert box
	  });

}
function saveSubmission(opp_id) {
	var opp_id=opp_id
//alert("Hi " + opp_id);
		// Get the value of the Summernote textarea
	  var opp_proposal = document.getElementById("opp_proposal").value;
	  
	  	var csrfTokenName = "TOKEN"; //<= ASCsrf::getTokenName() ?>";
		var csrfTokenValue = "VALUE"; //<= ASCsrf::getToken() ?>";
	
	  // Create an AJAX request
	  var xhr = new XMLHttpRequest();
	  xhr.open("POST", "save_submission_to_db.php", true);
	  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	
	  // Prepare the data to be sent
	  //var data = "oppSynopsis=" + encodeURIComponent(oppSynopsis);
	  // Prepare the data to be sent
  		//var data = "opp_id=" + opp_id + "&oppSynopsis=" + encodeURIComponent(oppSynopsis);
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

function getAddendumValue() {
	if(document.getElementById("addendum").checked == true){
		document.getElementById("addendum").value = 1;
	}//else{document.getElementById("addendum").value = 0;}
}


	$(document).ready(function() {
		$('#edit_naics_code').change(function() {
			var code = $('#edit_naics_code').val();
				$.ajax({
						url		: 'ajax_get_size_standards.php',
						method	: 'POST',
						data: {
							codeValue: code,
						},
						success: function(data) {
								const myArray1 = data.split("&");
								$('#edit_size_standard').val(myArray1[1]);
								$('#edit_naics_code').prop('title', myArray1[0]);
						},
						error: function(jqXHR, textStatus, errorThrown) {
							console.log(textStatus, errorThrown);
						}
				});
		});
	});

	$(document).ready(function() {
		$("#contract_vehicle").change(function () {
			var vehicleValue = $("#contract_vehicle").val();
			if(vehicleValue == 'Other'){
				$("#edit_other_vehicle_name").prop('required',true);
				$("#edit_other_vehicle_name").show();
			}else{
				$("#edit_other_vehicle_name").removeAttr("required");
				$("#edit_other_vehicle_name").hide();
			}
		});

		$("#edit_foia_req_sub_box").click(function () {
			  if ($(this).is(':checked')) {
				$("#edit_foia_req_sub_date").show();
				$("#edit_foia_req_sub_date").prop("required",true);
			  }else{
				$("#edit_foia_req_sub_date").hide();
				$("#edit_foia_req_sub_date").removeAttr('required');
				$("#edit_foia_req_sub_date").val('');
			  }
		});

		$("#edit_foia_info_receiv_box").click(function () {
			if ($(this).is(':checked')) {
				$("#edit_foia_info_receiv_date").show();
				$("#edit_foia_info_receiv_date").prop("required",true);
			}else{
				$("#edit_foia_info_receiv_date").hide();
				$("#edit_foia_info_receiv_date").removeAttr('required');
				$("#edit_foia_info_receiv_date").val('');
			}
		});

			if ($('#edit_foia_req_sub_box').is(':checked')) {
				$("#edit_foia_req_sub_date").show();
			}
			if ($('#edit_foia_info_receiv_box').is(':checked')) {
				$("#edit_foia_info_receiv_date").show();
			}
	});
</script>