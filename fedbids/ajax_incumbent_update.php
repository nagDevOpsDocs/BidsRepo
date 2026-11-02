<?php
//print("YEP ...");
//exit();

$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;
////include($_SERVER['DOCUMENT_ROOT'] . "include/it_loader.php");

print("<style>
.samewidth { width:240px; font-weight:700;}
.td-left { /*background: #f9f9f9;*/ background-color:#fff; /*background:none;*/ border:none; /*border: 1px #dedede solid;*/ padding: 5px;}
.select-styled { padding: 4px 5px; /*font-weight: 500;*/ border: 1px solid #cbcbcb; width:200px;}
</style>");
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$which_update_id=$_GET['which_update_id'];

$form_portion = "<form action='incumbent_db_addnew.php' method='post'>";
$form_table = $form_portion . "<table width='100%' border='0' cellspacing='5' cellpadding='5'>";
$form_update_content = "";

//print('hello ' . $which_update_id);
//$mysqli_link = mysqli_connect('portal.ardentinc.com',$db_user, $db_password,'bidsnew');

/*$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager FROM excel_test  
WHERE opportunity_id = $which_update_id";*/

$query = "SELECT opportunity_id, bidopp, title, vehicle_one, vehicle_two FROM excel_test    
WHERE opportunity_id = $which_update_id";

$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$opp_opportunity_id = $row[0];
	$opp_bidopp = $row[1];
	$opp_title = strtoupper(str_replace("<BR>","",$row[2]));
	$vehicle_one = $row[3];
	$vehicle_two = $row[4];
	}
	//$opp_response = "<option hidden selected value='" . $row[2] . "'>" . $row[2] . "</option>"; */
	/*
				
		} else { $opp_recruiting = $opp_recruiting_in; }
	
	$opp_gaps = strtoupper($row[12]);
	$opp_decision = "<option hidden selected value='" . $row[13] . "'>" . $row[13] . "</option>"; //strtoupper($row[13]);
	
	$contract_pop = $row[14];
	$contract_period = strtoupper(str_replace("Period: ","",$row[15])); 
	
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
	}
	
	$vehicle_one = $row[16];
	$vehicle_two = $row[17];
	
	$contract_vehicle = $row[18];
	$opp_status = "<option hidden selected value='" . $row[19] . "'>" . $row[19] . "</option>";
	$agency = $row[20];
	$facility = "<option hidden selected value='" . $row[21] . "'>" . $row[21] . "</option>"; 
	$clearance_level = "<option hidden selected value='" . $row[22] . "'>" . $row[22] . "</option>";
	
	$proposal_due = $row[23];
	
	$phpdate = strtotime( $proposal_due );
	$proposal_due_date = date( 'Y-m-d', $phpdate ); //Y-m-d H:i:s on 80 date('Y-m-d')
	$proposal_due_time = date( 'H:i', $phpdate ); //not A
	
	$qa_due = $row[24];
	
	$phpdate = strtotime( $qa_due );
	$qa_due_date = date( 'Y-m-d', $phpdate ); //Y-m-d H:i:s on 80 date('Y-m-d')
	$qa_due_time = date( 'H:i', $phpdate ); //not A
	
	$reason = $row[25];
	$manager = "<option hidden selected value='" . $row[26] . "'>" . $row[26] . "</option>";*/
	
	
	//$vehicle_one = $row[16];
	//$vehicle_two = $row[17];
	
	$proposal_ida = explode(" ", $vehicle_one); // . " " . $vehicle_two;
	$proposal_idb = explode(" ", $vehicle_two);
	$proposal_id_a = $proposal_ida[0];
	$proposal_id_b = $proposal_idb[0];
	
	//START
	$incumbent_container = "";
	// OR (opp LIKE '%" . $proposal_id_b . "%') 
	$extra_search = "";
	if (strlen($proposal_id_b)>2) { $extra_search = " OR (opp LIKE '%" . $proposal_id_b . "%') "; }
	$find_incumbents = "SELECT incumbent_id, incumbent_name, opp, incumbent_contract_taskorder, reference_link, award_amount, spend_to_date, start_date, completion_date, ultimate_completion_date, website, current_pools, oasis_pools, contact_info, in_forecast, incumbent_contract_taskorder FROM incumbents_test WHERE (opp LIKE '%" . $proposal_id_a . "%') $extra_search OR (opportunity_id LIKE '%" . $which_update_id . "%') ORDER BY incumbent_id"; 
	$incumbent_name = "";
	$resultb = mysqli_query($mysqli_link, $find_incumbents);
	while($rowb = mysqli_fetch_array($resultb, MYSQLI_NUM))
		{
		$incumbent_id = $rowb[0];
		//$incumbent_name = $rowb[1];
		$incumbent_name = strtoupper(str_replace("(","<BR>(",$rowb[1]));
		$incumbent_opp = $rowb[2];
		$incumbent_taskorder = $rowb[3];
		$incumbent_ref_link = $rowb[4];
		$incumbent_award_amount = $rowb[5];
		$incumbent_spend_to_date = $rowb[6];
		$incumbent_start_date = $rowb[7];
		$incumbent_completion = $rowb[8];
		$incumbent_ultimate = $rowb[9];
		$incumbent_website_url = $rowb[10];
		$current_pools = $rowb[11];
		$oasis_pools = $rowb[12];
		$contact_info = str_replace(",","<BR>",$rowb[13]);
		$contact_info = str_replace(";","<BR>",$contact_info);
		//$contact_info = $rowb[13];
		$in_forecast = $rowb[14];
		$incumbent_contract_taskorder = $rowb[15];
		
		//if (strval($incumbent_award_amount)>2) { $award_amount_formatted = number_format($incumbent_award_amount,0); } else { $award_amount_formatted=""; }
		//$award_amount_formatted = money_format('$%i', $incumbent_award_amount); 
		//$award_amount_formatted = ""; number_format($incumbent_award_amount,0);
		if ((strpos($incumbent_website_url, 'http')!== false) && (strlen($incumbent_website_url)>2)) {
			//(strpos($haystack, $needle) !== false) 
			//FOUND REMOVE www.
			$incumbent_website_url = str_replace("www.","",$incumbent_website_url);
		} else {
			$incumbent_website_url = "https://" . $incumbent_website_url;
			$incumbent_website_url = str_replace("www.","",$incumbent_website_url);
		}
		
		$incumbent_website = "<a title='" . $incumbent_name . "' style='color:#2f40a2;' href='" . $incumbent_website_url . "' target='_blank'><img style='vertical-align: middle; height:16px; width:16px; margin-left:20px; position:relative; top:-1px;' src='hyperlink.jpg' alt='$incumbent_name'></a>";
		//$incumbent_website = "vertical-align: middle; height:16px; width:16px; margin-left:20px; position:relative; top:-1px;";
		
		$full_ref_link = "<a title='" . $incumbent_ref_link . "' style='color:#106b9a;' href='" . $incumbent_ref_link . "' target='_blank'>GovWin</a>";
		//$incumbent_container = "Incumbent " . $incumbent_name . "<BR>" . "Award Amount: " . $incumbent_award_amount; 
		/*<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Spend to Date</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_spend_to_date</div><BR>*/
		
		$incumbent_container .= "
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100%);vertical-align:top; padding:8px 12px; overflow:auto; overflow-wrap:break-word; border:1px solid #d1d1d3; margin-bottom:12px;'>
		
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Incumbent</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_name $incumbent_website</div><BR>
			
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Award Amount</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_award_amount</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Spend To Date</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_spend_to_date</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Reference Link</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$full_ref_link</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Current OASIS Pools</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$current_pools</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>OASIS Pools</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$oasis_pools</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Start Date</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_start_date</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Completion Date</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_completion</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Ultimate Completion</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_ultimate</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Contract - Task Order</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_contract_taskorder</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>In Forecast</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$in_forecast</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Contact Info</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$contact_info</div><BR>
					
			
			</div>
			";
		}
		if (strlen($proposal_id_a)<3) { $incumbent_container=""; }
	//STOP
	
	
	//$form_update_content .= "<tr><td>ID:</td><td>$db_poc_id</td></tr>";
	$form_update_content .= "<tr><td width='170'><strong>Incumbent Name</strong></td><td class='td-left' colspan='3'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='incumbent_name_pass' type='text' value='' /></td></tr>";
	
	$form_update_content .= "<tr><td width='170'><strong>Incumbent Website</strong></td><td class='td-left' colspan='3'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='website_pass' type='text' value='' /></td></tr>";
	
	$form_update_content .= "<tr><td width='170' colspan='3'><strong>Reference Link</strong></td><td class='td-left'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='reference_link_pass' type='text' value='' /></td></tr>";

	$form_update_content .= "<tr><td width='170'><strong>Award Amount</strong></td><td class='td-left'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='award_amount_pass' type='text' value='' /></td><td width='170'><strong>Spend To Date</strong></td><td class='td-left'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='spend_to_date_pass' type='text' value='' /></td></tr>";

	$form_update_content .= "<tr><td width='170'><strong>Current OASIS Pools</strong></td><td class='td-left'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='current_pools_pass' type='text' value='' /></td><td width='170'><strong>OASIS Pools</strong></td><td class='td-left'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='oasis_pools_pass' type='text' value='' /></td></tr>";

	
	$form_update_content .= "<tr><td width='170'><strong>Start Date</strong></td><td class='td-left'><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='start_date_pass' type='date' max='2100-12-31' value='" . date('Y-m-d') . "' /></td><td width='170'><strong>Completion Date</strong></td><td class='td-left'><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='completion_date_pass' type='date' max='2100-12-31' value='" . date('Y-m-d') . "' /></td></tr>";

	$form_update_content .= "<tr><td width='170'><strong>Contract - Task Order</strong></td><td class='td-left'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='incumbent_contract_taskorder_pass' type='text' value='' /></td><td width='170'><strong>Ultimate Completion</strong></td><td class='td-left'><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='ultimate_completion_date_pass' type='date' max='2100-12-31' value='" . date('Y-m-d') . "' /></td></tr>";
	

	$form_update_content .= "<tr><td width='170'><strong>In Forecast</strong></td><td class='td-left'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='in_forecast_pass' type='text' value='' /></td></tr>";
	
	$form_update_content .= "<tr><td width='170'><strong>Contact Info</strong></td><td class='td-left'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='contact_info_pass' type='text' value='' /></td></tr>";

	
	
	
	
	/*$form_update_content .= "<tr><td width='170'><strong>Hidden</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='opp_title' type='text' value='$opp_title' /></td></tr>";*/
	
	
	/*$form_update_content .= "<tr><td><strong>Release Date</strong></td><td class='td-left'><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='opp_released' type='date' max='2100-12-31' value='$opp_released' /></td></tr>";
	$form_update_content .= "<tr><td><strong>Opportunity Type</strong></td><td class='td-left'><select name='opp_response' size='1' class='select-styled'>
				  $opp_response
				  <option value='Draft RFP'>Draft RFP</option>
				  <option value='RFI'>RFI</option>
				  <option value='RFQ'>RFQ</option>
				  <option value='RFP'>RFP</option>
				</select></td></tr>";
	$form_update_content .= "<tr><td><strong>Proposal Due Date</strong></td><td class='td-left'>
	<input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='proposal_date' type='date' max='2100-12-31' value='" . $proposal_due_date . "' />
	<input style='width:100px; border:1px solid #cbcbcb; padding:4px;' type='time' id='proposal_time' name='proposal_time' value='". $proposal_due_time ."'>
	</td></tr>";
	$form_update_content .= "<tr><td><strong>Q&A Due Date</strong></td><td class='td-left'>
	<input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='qa_date' type='date' max='2100-12-31' value='" . $qa_due_date . "' />
	<input style='width:100px; border:1px solid #cbcbcb; padding:4px;' type='time' id='qa_time' name='qa_time' value='". $qa_due_time ."'>
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Vehicle</strong></td><td class='td-left'>
	<select name='opp_vehicle' size='1' class='select-styled'>
				  <option value=''></option>
				  <option value='OASIS 8(a)'>OASIS 8(a)</option>
				  <option value='OASIS SB'>OASIS SB</option>
				</select>
	</td></tr>";
	$form_update_content .= "<tr><td><strong>Agency</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='agency' type='text' value='$agency' /></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Opportunity Id1</strong></td><td class='td-left'><input style='width:404px; border:1px solid #cbcbcb; padding:5px;' name='opp_vehicle_one' type='text' value='$vehicle_one' /></td></tr>";
	$form_update_content .= "<tr><td><strong>Opportunity Id2</strong></td><td class='td-left'><input style='width:404px; border:1px solid #cbcbcb; padding:5px;' name='opp_vehicle_two' type='text' value='$vehicle_two' /></td></tr>";
	
	
	$form_update_content .= "<tr><td><strong>Requestor Name</strong></td><td class='td-left'><input style='width:404px; border:1px solid #cbcbcb; padding:5px;' name='opp_requestor' type='text' value='$opp_requestor' /></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Clearance Level</strong></td><td class='td-left'><select name='clearance_level' size='1' class='select-styled'>
				  $clearance_level
				  <option value=''></option>
				  <option value='Confidential'>Confidential</option>
				  <option value='Secret'>Secret</option>
				  <option value='Top Secret'>Top Secret</option>
				</select></td></tr>";
	
	
	
	
	$form_update_content .= "<tr><td><strong>Synopsis</strong></td><td class='td-left'><textarea style='width:90%; border:1px solid #cbcbcb; padding:5px;' name='opp_synopsis' cols='10' rows='10'>$opp_synopsis</textarea></td></tr>";
	
	
	
	$form_update_content .= "<tr><td><strong>Performance Location</strong></td><td class='td-left'>
	<select name='facility' size='1' class='select-styled'>
				  $facility
				  <option value='Federal Facility'>Federal Facility</option>
				  <option value='Contractor Facility'>Contractor Facility</option>
				</select></td></tr>";
	$form_update_content .= "<tr><td><strong>Address</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='contract_pop' type='text' value='$contract_pop' /></td></tr>";
	
	
	$form_update_content .= "<tr><td><strong>Period</strong></td><td class='td-left'>
	<select name='perioda' size='1'>
	  <option hidden selected value='$period_a'>$period_a</option>
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
BASE 
	<select name='periodb' size='1'>
	  <option hidden selected value='$period_b'>$period_b</option>
		<option value=''></option>
	  <option value='MONTH(S)'>MONTH(S)</option>
	  <option value='YEAR(S)'>YEAR(S)</option>
	</select>
 +  
 	<select name='periodqty' style='display:none;'  size='1'>
		<option hidden selected value='$period_qty'>$period_qty</option>
	  <option value=''></option>
	  <option value='(1)'>(1)</option>
	  <option value='(2)'>(2)</option>
	  <option value='(3)'>(3)</option>
	  <option value='(4)'>(4)</option>
	  <option value='(5)'>(5)</option>
	  <option value='(6)'>(6)</option>
	  <option value='(7)'>(7)</option>
	  <option value='(8)'>(8)</option>
	  <option value='(9)'>(9)</option>
	  <option value='(10)'>(10)</option>
	  <option value='(11)'>(11)</option>
	  <option value='(12)'>(12)</option>
	</select>
 
	<select name='periodc' size='1'>
		<option hidden selected value='$period_c'>$period_c</option>
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
OPTION 
	<select name='periodd' size='1'>
		<option hidden selected value='$period_d'>$period_d</option>
	  <option value=''></option>
	  <option value='MONTH(S)'>MONTH(S)</option>
	  <option value='YEAR(S)'>YEAR(S)</option>
	</select>
	
	</td></tr>";	
	
	
	
	
	
	$form_update_content .= "<tr><td><strong>Pricing</strong></td><td class='td-left'>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Fixed-Price</div>
	  <input type='checkbox' id='pricing1' name='pricing1' value='Firm Fixed-Price (FFP)' onclick=\"pricing_update();\" $opp_pricing_a>
	  <label for='pricing1'> Firm Fixed-Price (FFP)</label><br>
	  <input type='checkbox' id='pricing2' name='pricing2' value='Firm Fixed-Price LOE' onclick=\"pricing_update();\" $opp_pricing_b>
	  <label for='pricing2'> Firm Fixed-Price LOE</label><br>
	  <input type='checkbox' id='pricing3' name='pricing3' value='FFP Materials Reimbursement' onclick=\"pricing_update();\" $opp_pricing_c>
	  <label for='pricing3'> FFP Materials Reimbursement</label><BR>
	  <input type='checkbox' id='pricing4' name='pricing4' value='Fixed-Price Incentive (FPI)' onclick=\"pricing_update();\" $opp_pricing_d>
	  <label for='pricing4'> Fixed-Price Incentive (FPI)</label>
	  
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Cost-Reimbursement</div>
	  <input type='checkbox' id='pricing5' name='pricing5' value='Cost-Reimbursement Actual Cost' onclick=\"pricing_update();\" $opp_pricing_e>
	  <label for='pricing5'> Cost-Reimbursement Actual Cost</label><br>
	  <input type='checkbox' id='pricing6' name='pricing6' value='Cost-Reimbursement Cost-Sharing' onclick=\"pricing_update();\" $opp_pricing_f>
	  <label for='pricing6'> Cost-Reimbursement Cost-Sharing</label><br>
	  <input type='checkbox' id='pricing7' name='pricing7' value='Cost-Plus-Fixed-Fee (CPFF)' onclick=\"pricing_update();\" $opp_pricing_g>
	  <label for='pricing7'> Cost-Plus-Fixed-Fee (CPFF)</label><BR>
	  <input type='checkbox' id='pricing8' name='pricing8' value='Cost-Plus-Incentive-Fee (CPIF)' onclick=\"pricing_update();\" $opp_pricing_h>
	  <label for='pricing8'> Cost-Plus-Incentive-Fee (CPIF)</label><br>
	  <input type='checkbox' id='pricing9' name='pricing9' value='Cost-Plus-Award-Fee (CPAF)' onclick=\"pricing_update();\" $opp_pricing_i>
	  <label for='pricing9'> Cost-Plus-Award-Fee (CPAF)</label><br>
	  <input type='checkbox' id='pricing10' name='pricing10' value='Cost Plus Percentage of Cost (CPPC)' onclick=\"pricing_update();\" $opp_pricing_j>
	  <label for='pricing10'> Cost Plus Percentage of Cost (CPPC)</label>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Time and Materials (T&M)</div>
	  <input type='checkbox' id='pricing11' name='pricing11' value='Time and Materials (T&M)' onclick=\"pricing_update();\" $opp_pricing_k>
	  <label for='pricing11'> Time and Materials (T&M)</label>
	  </div>
	  
	
	
	<input style='width:100%; border:1px solid #cbcbcb; padding:5px;' id='opp_pricing' name='opp_pricing' type='text' value='' /></td></tr>";
	
	
	
	$form_update_content .= "<tr><td><strong>Recruiting</strong></td><td class='td-left'>$opp_recruiting</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Submission Requirements</strong></td><td class='td-left'><textarea style='width:90%; border:1px solid #cbcbcb; padding:5px;' name='opp_proposal' cols='10' rows='10'>$opp_proposal</textarea></td></tr>";
	
	
	$form_update_content .= "<tr><td><strong>Decision</strong></td><td class='td-left'>
				<select name='opp_decision' size='1' class='select-styled'>
				  $opp_decision
				  <option value='Bid'>Bid</option>
				  <option value='On Hold'>On Hold</option>
				  <option value='Ineligible'>Ineligible</option>
				  <option value='No Bid'>No Bid</option>
				</select>
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Assigned To</strong></td><td class='td-left'>
				<select id='manager' name='manager' size='1' class='select-styled'>
				  $manager
				  <option value='Genaro Cavazos'>Genaro Cavazos</option>
				  <option value='Holly Knouff'>Holly Knouff</option>
				  <option value='Jonathan Quenan'>Jonathan Quenan</option>
				  <option value='Mick Feldmeyer'>Mick Feldmeyer</option>
				  <option value='Ron Hartke'>Ron Hartke</option>
				  <option value='Rick Neetz'>Rick Neetz</option>
				</select>
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Reason</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='reason' type='text' value='$reason' /></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Status</strong></td><td class='td-left'><select name='opp_status' size='1' class='select-styled'>
				  $opp_status
				  <option value='New'>New</option>
				  <option value='Working'>Working</option>
				  <option value='RFP Tracking'>RFP Tracking</option>
				  <option value='Award Monitoring'>Award Monitoring</option>
				  <option value='Archived'>Archived</option>
				</select></td></tr>";*/
	
	
	
	//}
	print ($form_table . $form_update_content . "</table>");
?>

<input type="hidden" name="opp_opportunity_id" value="<?php print $opp_opportunity_id; ?>"/>
<input type="hidden" name="opp_vehicle_one" value="<?php print $vehicle_one; ?>"/>
<input type="hidden" name="opp_vehicle_two" value="<?php print $vehicle_two; ?>"/>
<input type="hidden" name="<?= ASCsrf::getTokenName() ?>" value="<?= ASCsrf::getToken() ?>">
<div>
<div style="display:inline-block; width:48%;"><!--<input style="margin-left: 50px; background-color:#9b1f6b; padding:4px 16px; border-radius:7px; color:#fff; font-weight: 700;" type="reset" value="Reset">--></div>
<div style="display:inline-block; width:48%; text-align:right;"><input style="background-color:#23a69a; padding:4px 16px; border-radius:7px; color:#fff; font-weight: 700;" type="submit" value="Add Incumbent"></div>
</div>
</form>
<div style="height:60px;"></div>
<?php
print("
$incumbent_container
");
?>
