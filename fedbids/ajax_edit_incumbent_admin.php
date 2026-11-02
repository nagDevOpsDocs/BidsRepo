<?php
//print("YEP ...");
//exit();
$checked_8a_value = "";
$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;
////include($_SERVER['DOCUMENT_ROOT'] . "include/it_loader.php");

print("<body onload='dynamic_link()'>  
<link href='https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/themes/smoothness/jquery-ui.css' rel='stylesheet'>
      <script src='https://code.jquery.com/jquery-1.10.2.js'></script>  
      <script src='https://code.jquery.com/ui/1.10.4/jquery-ui.js'></script>");
print("<script>  
         $(function() { 
			$( '#start_date_pass' ).datepicker();
			$( '#completion_date_pass' ).datepicker();
			$( '#ultimate_completion_date_pass' ).datepicker();
			$( '#graduation_8a' ).datepicker();
         });  
      </script> ");

setlocale(LC_MONETARY,"en_US");

print("<style>
body, input, table, td {font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}
.samewidth { width:240px; font-weight:700;}
.td-left { /*background: #f9f9f9;*/ background-color:#fff; /*background:none;*/ border:none; /*border: 1px #dedede solid;*/ padding: 5px;}
.select-styled { padding: 4px 5px; /*font-weight: 500;*/ border: 1px solid #cbcbcb; width:200px; font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}
</style>");
 //ini_set('display_errors', 1);
 //ini_set('display_startup_errors', 1);
 //error_reporting(E_ALL);

$which_incumbent_id=$_GET['which_incumbent_id'];
//$opp_opportunity_id = $which_incumbent_id;

print("<div style='text-align:center;font-size: 18px;font-weight: 700;color: #3c4db0;padding: 10px;'>Incumbents - Edit Form</div>");

$form_portion = "<form action='incumbent_db_update_admin.php' id='incumbent_update' name='incumbent_update' method='post'  onsubmit='return requiredfields();'>";
$form_table = $form_portion . "<table width='90%' align='left' border='0' cellspacing='5' cellpadding='5'>";
$form_update_content = "";

//print('hello ' . $which_incumbent_id);
//$mysqli_link = mysqli_connect('portal.ardentinc.com',$db_user, $db_password,'bidsnew');

/*$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager FROM excel_test  
WHERE opportunity_id = $which_incumbent_id";*/

/*$query = "SELECT opportunity_id, bidopp, title, vehicle_one, vehicle_two FROM excel_test    
WHERE opportunity_id = $which_incumbent_id";

$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$opp_opportunity_id = $row[0];
	$opp_bidopp = $row[1];
	$opp_title = strtoupper(str_replace("<BR>","",$row[2]));
	$vehicle_one = $row[3];
	$vehicle_two = $row[4];
	}
	
	
	$proposal_ida = explode(" ", $vehicle_one); 
	$proposal_idb = explode(" ", $vehicle_two);
	$proposal_id_a = $proposal_ida[0];
	$proposal_id_b = $proposal_idb[0];*/
	//BID excel_test
	/*$excel_test_record = "SELECT incumbent_id, incumbent_name, opp, incumbent_contract_taskorder, reference_link, award_amount, spend_to_date, start_date, completion_date, ultimate_completion_date, website, current_pools, oasis_pools, contact_info, in_forecast, incumbent_contract_taskorder, incumbent_status, opportunity_id, contact_parts, contract, taskorder, awarded_thru FROM incumbents_test WHERE (incumbent_id = $which_incumbent_id) ORDER BY incumbent_status ASC"; 
	$resultb = mysqli_query($mysqli_link, $find_incumbents);
	while($rowb = mysqli_fetch_array($resultb, MYSQLI_NUM))
		{
		$incumbent_id = $rowb[0];
		}*/
	
	//START
	$incumbent_container = ""; 
	$extra_search = "";
	$find_incumbents = "SELECT incumbent_id, incumbent_name, opp, incumbent_contract_taskorder, reference_link, award_amount, spend_to_date, start_date, completion_date, ultimate_completion_date, website, current_pools, oasis_pools, contact_info, in_forecast, incumbent_contract_taskorder, incumbent_status, opportunity_id, contact_parts, contract, taskorder, awarded_thru, eligible_incumbent, eligible_jv, graduated, awarded_set_aside, incumbent_identified_by, graduate_8a_status FROM incumbents_test WHERE (incumbent_id = $which_incumbent_id) ORDER BY incumbent_status ASC"; 
	$incumbent_name = "";
	$resultb = mysqli_query($mysqli_link, $find_incumbents);
	while($rowb = mysqli_fetch_array($resultb, MYSQLI_NUM))
		{
		$incumbent_id = $rowb[0];
		//$incumbent_name = $rowb[1];
		//$incumbent_name = strtoupper(str_replace("(","<BR>(",$rowb[1]));
		$incumbent_name = strtoupper($rowb[1]);
		$incumbent_identified_by = $rowb[26];
		$incumbent_opp = $rowb[2];
		$incumbent_taskorder = $rowb[3];
		$incumbent_ref_link = $rowb[4];
		$incumbent_award_amount = $rowb[5];
		if (strval($incumbent_award_amount)>0) {  $incumbent_award_amount_formatted = "$" . number_format($rowb[5],0); } else { $incumbent_award_amount_formatted=""; }
		$incumbent_spend_to_date = $rowb[6];
		if (strval($incumbent_spend_to_date)>0) {  $incumbent_spend_to_date_formatted = "$" . number_format($rowb[6],0); } else { $incumbent_spend_to_date_formatted=""; }

		$incumbent_start_date = date('m/d/Y',strtotime($rowb[7]));
		if ($incumbent_start_date=='12/31/1969') { $incumbent_start_date=""; }
		$incumbent_completion = date('m/d/Y',strtotime($rowb[8]));
		if ($incumbent_completion=='12/31/1969') { $incumbent_completion=""; }
		$incumbent_ultimate = date('m/d/Y',strtotime($rowb[9]));
		if ($incumbent_ultimate=='12/31/1969') { $incumbent_ultimate=""; }
		
		$incumbent_website_url = $rowb[10];
		$eligible = $rowb[11];
		$oasis_pools = $rowb[12];
		$contact_info = str_replace(",","<BR>",$rowb[13]);
		$contact_info = str_replace(";","<BR>",$contact_info);
		//$contact_info = $rowb[13];
		$in_forecast = $rowb[14];
		$incumbent_contract_taskorder = $rowb[15];
		$incumbent_status = $rowb[16];
		$opp_opportunity_id = $rowb[17];
		$contact_parts = $rowb[18];
		
			//BID excel_test
			$excel_test_record = "SELECT contract_vehicle FROM excel_test WHERE opportunity_id = $opp_opportunity_id"; //$opp_opportunity_id"; 
			$resulte = mysqli_query($mysqli_link, $excel_test_record);
			//print ("excel_test.... $opp_opportunity_id: " . $excel_test_record);
			while($rowe = mysqli_fetch_array($resulte, MYSQLI_NUM))
			{
			$db_contract_vehicle = $rowe[0];
			$is_oasis = 0;
			if (strpos($db_contract_vehicle, 'OASIS') !== false) 
				{
				$is_oasis = 1;
				}
			}
				
		
		$incumbent_contract = $rowb[19];
		$incumbent_taskorder = $rowb[20];
		$awarded_thru = $rowb[21];
		
		$eligible_incumbent = $rowb[22];
		$eligible_jv = $rowb[23];

		if($rowb[24])
			$graduated = date('m/d/Y',strtotime($rowb[24]));
		else 
			$graduated = "";

		$awarded_set_aside = $rowb[25];
		$checked_8a_value = $rowb[27];

		// Checking the Incumbent Identified By radio button 
		$by_governament = ($incumbent_identified_by == 'Government') ? 'checked' : '';
		$by_research_team = ($incumbent_identified_by == 'Research Team') ? 'checked' : '';
		// Checking the checkbox based on the value
		$ischecked_eligible_incumbent = ($eligible_incumbent == 'eligible') ? 'checked' : '';
		$ischecked_eligible_jv = ($eligible_incumbent == 'eligible_jv') ? 'checked' : '';

		$ischecked_eligible_jv_member = ($eligible_incumbent == 'eligible_jv_member') ? 'checked' : '';

		$ischecked_noteligible = ($eligible_incumbent == 'not_eligible') ? 'checked' : '';
		
		//$ischecked_eligible_incumbent = ($eligible_incumbent == 1) ? 'checked' : '';
		//$ischecked_eligible_jv = ($eligible_jv== 1) ? 'checked' : '';
		//$checked_8a_value = $rowb[27];

		if($rowb[27]){
			$checked_8a_value = "checked";
		}

		//if (strlen($db_incumbent_website)>2) {
			//FOUND REMOVE www.
			if (strlen($incumbent_website_url)<3) { $incumbent_reference_ready = ""; } else {
			$incumbent_website_url = str_replace("www.","",$incumbent_website_url);
			if (((strpos($incumbent_website_url, 'http://')!== false)) || ((strpos($incumbent_website_url, 'https://')!== false))) { /*print ('http found');*/ } 
			else { $incumbent_website_url = "https://" . $incumbent_website_url; }
			
			$incumbent_website_ready = "<a title='" . $incumbent_website_url . "' style='color:#2f40a2;' href='" . $incumbent_website_url . "' target='_blank'>$incumbent_website_url</a>";
			}
			
			//
			if (strlen($incumbent_ref_link)<3) { $incumbent_reference_ready = ""; } else {
			$incumbent_ref_link = str_replace("www.","",$incumbent_ref_link);
			if (((strpos($incumbent_ref_link, 'http://')!== false)) || ((strpos($incumbent_ref_link, 'https://')!== false))) { /*print ('http found');*/ } 
			else { $incumbent_ref_link = "https://" . $incumbent_ref_link; }
			
			$incumbent_reference_ready = "<a title='" . $incumbent_ref_link . "' style='color:#2f40a2;' href='" . $incumbent_ref_link . "' target='_blank'>$incumbent_ref_link</a>";
			}
			
		
		//if (strval($incumbent_award_amount)>2) { $award_amount_formatted = number_format($incumbent_award_amount,0); } else { $award_amount_formatted=""; }
		//$award_amount_formatted = money_format('$%i', $incumbent_award_amount); 
		//$award_amount_formatted = ""; number_format($incumbent_award_amount,0);
		/*if ((strpos($incumbent_website_url, 'http')!== false) && (strlen($incumbent_website_url)>2)) {
			$incumbent_website_url = str_replace("www.","",$incumbent_website_url);
		} else {
			$incumbent_website_url = "https://" . $incumbent_website_url;
			$incumbent_website_url = str_replace("www.","",$incumbent_website_url);
		}*/
		
		//$incumbent_website = "<a title='" . $incumbent_name . "' style='color:#2f40a2;' href='" . $incumbent_website_url . "' target='_blank'><img style='vertical-align: middle; height:16px; width:16px; margin-left:20px; position:relative; top:-1px;' src='hyperlink.jpg' alt='$incumbent_name'></a>";
		//$incumbent_website = "vertical-align: middle; height:16px; width:16px; margin-left:20px; position:relative; top:-1px;";
		
		//$full_ref_link = "<a title='" . $incumbent_ref_link . "' style='color:#106b9a;' href='" . $incumbent_ref_link . "' target='_blank'>GovWin</a>";
		
		//if (strlen($incumbent_website_url)<3) { $full_ref_link = ""; }
		//$incumbent_container = "Incumbent " . $incumbent_name . "<BR>" . "Award Amount: " . $incumbent_award_amount; 
		/*<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Spend to Date</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_spend_to_date</div><BR>*/
		
		$incumbent_container .= "";
		
		//RECRUITING START
		$contact_parts = $rowb[18];
		$recruiting_start = "";

		if (strpos($contact_parts, '|||') !== false) {
			//echo 'true';
			// 1|||A|||(KP)|||Confidential|||2|||B|||(KP)|||Secret|||3|||C||||||Top Secret|||
				//​$ok = explode("|||",$opp_recruiting);
				$ok = explode("|||",$contact_parts);
				
				$i = 0;
				$inloop = 0;
				$opp_recruiting = "";
				$temp_job = "";
				
				

				while($i < count($ok))
				{
					$inloop++;
					//if (($inloop==1) && ((count($ok)-$i)>1)) { $opp_recruiting .= "START";  } 
					if (($inloop==1) && ((count($ok)-$i)>1)) { $opp_recruiting .= "<DIV style='background-color:#fff; border-top:1px solid #d1d1d3; color:#4f8ccd;'>";  }
					if ($inloop==1) { $opp_recruiting .= "<div style='width:40px; display:inline-block; vertical-align:top;'>" . $ok[$i] . " </div>"; $pass_quantity=$ok[$i]; }//."-" . $i . "-";
					if ($inloop==2) { $opp_recruiting .= "<div style='width:150px; display:inline-block; vertical-align:top;'>" . $ok[$i] . " </div>"; $pass_ftehours=$ok[$i];}//."-" . $i . "-";
					if ($inloop==3) { $temp_job = $ok[$i]; $pass_labor=$ok[$i];/*$opp_recruiting .= "<div style='width:110px; display:inline-block; vertical-align:top;'>" . $ok[$i] . "</div>";*/ }//."-" . $i . "-";
					if ($inloop==4) { $pass_email_contact=$ok[$i]; $opp_recruiting .= "<div style='width:40px; display:inline-block; vertical-align:top;'>" . $ok[$i] . "</div>"; }//."-" . $i . "-";
				if ($inloop==5) { $pass_phone_contact=$ok[$i]; $opp_recruiting .= "<div style='width:80px; display:inline-block; vertical-align:top;'>" . $ok[$i] . "</div>"; }//."-" . $i . "-";
				if ($inloop==6) { $pass_phone_note=$ok[$i]; $opp_recruiting .= "<div style='width:100px; display:inline-block; vertical-align:top;'>" . $ok[$i] . "</div>"; }//."-" . $i . "-";
					//if ($inloop==4) { $opp_recruiting .= "***<BR>"; $inloop=0; } 
					if ($inloop==6) { $recruiting_start .= '
		<div name="opp_recruiting_start" id="opp_recruiting_start"><div><div style="display:inline-block; padding:5px 0px;">
		<input type="text" name="pt_a_238" value="'. $pass_quantity .'" style="padding:2px 5px; font-weight:500; width:110px;border:none;"></div><div style="display:inline-block; padding:5px 0px;">
		<input type="text" name="pt_e_213" value="'. $pass_ftehours .'" style="padding:2px 5px; font-weight:500; width:110px;border:none;"></div><div style="display:inline-block; padding:5px 0px;margin-left:4px;">
		<input type="text" name="pt_b" value="'. $pass_labor .'" style="padding:2px 5px; font-weight:500; width:180px;border:none;"></div><div style="display:inline-block; padding:5px 0px;">
		<input type="text" name="pt_c" value="'.$pass_email_contact.'" style="padding:2px 5px; font-weight:500; width:180px;border:none;"></div><div style="display:inline-block; padding:5px 0px;">
		<input type="text" name="pt_d" value="'.$pass_phone_contact.'" style="padding:2px 5px; font-weight:500; width:160px; border:none; margin-left:7px;">
		<input type="text" name="pt_f" value="'. $pass_phone_note .'" style="padding:2px 0px; font-weight:500; width:90px; border:none; margin-left:7px;">
		</div>
		<span style="background-color:#9b1f6b; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 9px; cursor:pointer;" onclick="this.parentElement.remove();refresh_table();"> Remove </span></div></div>
		';
					}
					
					if ($inloop==6) { $opp_recruiting .= "<div style='padding-left:40px; font-weight:700;'>$temp_job</div></DIV>"; $inloop=0; }
					
					
					/*$recruiting_start .= '
		<div name="opp_recruiting_start" id="opp_recruiting_start"><div><div style="display:inline-block; padding:5px 0px;"><input type="text" name="pt_a_238" value="quantity" style="padding:2px 5px; font-weight:500; width:50px;"></div><div style="display:inline-block; padding:5px 0px;"><input type="text" name="pt_e_213" value="FTE(s)" style="padding:2px 5px; font-weight:500; width:50px;"></div><div style="display:inline-block; padding:5px 0px;margin-left:4px;"><input type="text" name="pt_b" value="labor" style="padding:2px 5px; font-weight:500; width:220px;"></div><div style="display:inline-block; padding:5px 0px;"><input type="text" name="pt_c" value="(KP)" style="padding:2px 5px; font-weight:500; width:100px;"></div><div style="display:inline-block; padding:5px 0px;"><input type="text" name="pt_d" value="Confidential" style="padding:2px 5px; font-weight:500; width:100px; margin-left:7px;"></div><span style="background-color:#9b1f6b; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 14px;" onclick="this.parentElement.remove();refresh_table();"> Remove </span></div></div>
		';*/		
					
					
					$i++;
				}
				
				//$opp_recruiting = $ok[0];
				/*for ($x = 0; $x <= 3; $x++) {
				  echo "The number is: $x <br>";
				}*/
				
		} else { $opp_recruiting = $contact_parts; }
		//RECRUITING STOP
		}
		//if (strlen($proposal_id_a)<3) { $incumbent_container=""; }
	//STOP
	
	
	//$form_update_content .= "<tr><td>ID:</td><td>$db_poc_id</td></tr>";
	$form_update_content .= "<tr><td width='170'><strong>Incumbent Name</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left' colspan='3'><input style='width:500px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' name='incumbent_name_pass' id='incumbent_name_pass' type='text' value='$incumbent_name' autocomplete='off'/> <span style='margin-left:20px;color:#fff;'>$db_contract_vehicle</span></td></tr>";

	$form_update_content .= "<tr><td width='170'><strong>Incumbent Identified By </strong><span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td>
	<td><label class='container' style='margin-left:10px;'><input style='' type='radio' name='edit_incumbent_identified' value='Government' $by_governament required>Government</label>
	<label class='container' style='margin-left:20px;'><input style='' type='radio' name='edit_incumbent_identified' value='Research Team' $by_research_team required>Research Team</label></td></tr>";

	$form_update_content .= "<tr><td width='170'><strong>Incumbent Website</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left' colspan='3'><input style='width:500px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' name='website_pass' id='website_pass' autocomplete='off' type='text' onkeyup='dynamic_link();' value='$incumbent_website_url'/> <div id='dynamic_weblink' style='display:inline-block;margin-left:10px;'></div></td></tr>";
	
	$form_update_content .= "<tr><td width='170'><strong>Reference Link</strong></td><td class='td-left' colspan='3'><input style='width:500px; border:1px solid #cbcbcb; padding:5px;' name='reference_link_pass' type='text' value='$incumbent_ref_link' /> <span style='margin-left:20px;'>$incumbent_reference_ready</span></td></tr>";
	
	$form_update_content .= "<tr><td width='170'><strong>Contract</strong></td><td class='td-left'><input style='width:300px; border:1px solid #cbcbcb; padding:5px;' name='incumbent_contract_pass' autocomplete='new-password' type='text' value='$incumbent_contract' /><span style='width:100px; text-align:center; font-weight:700; display:inline-block;'></span></td><td width='170'><strong>Task Order</strong></td><td class='td-left'><input style='width:300px; border:1px solid #cbcbcb; padding:5px;' name='incumbent_taskorder_pass' autocomplete='new-password' type='text' value='$incumbent_taskorder' /><span style='width:100px; text-align:center; font-weight:700; display:inline-block;'></span></td></tr>";
	
	$form_update_content .= "<tr><td width='170'><strong>Awarded Thru</strong></td><td class='td-left'><input style='width:300px; border:1px solid #cbcbcb; padding:5px;' name='awarded_thru_pass' type='text' value='$awarded_thru' /><span style='width:100px; text-align:center; font-weight:700; display:inline-block;'></span></td><td width='170'><strong>Awarded Set Aside</strong></td><td class='td-left'><input style='width:300px; border:1px solid #cbcbcb; padding:5px;' name='awarded_set_aside' type='text' value='$awarded_set_aside' /><span style='width:100px; text-align:center; font-weight:700; display:inline-block;'></span></td></tr>";
	
	

	/*$form_update_content .= "<tr><td width='170'><strong>Award Amount</strong></td><td class='td-left'><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='award_amount_pass' id='award_amount_pass' onkeyup='blur_award_amount()' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='number' value='$incumbent_award_amount' /><span id='new_award_amount' style='width:200px; text-align:center; font-weight:700; display:inline-block; color:#23a69a'>$incumbent_award_amount_formatted</span></td><td width='170'><strong>Spend To Date</strong></td><td class='td-left'><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='spend_to_date_pass' id='spend_to_date_pass' onkeyup='blur_spend_to_date()' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='number' value='$incumbent_spend_to_date' /><span id='new_spend_to_date' style='width:200px; text-align:center; font-weight:700; display:inline-block; color:#23a69a'>$incumbent_spend_to_date_formatted</span></td></tr>";*/
	/*$form_update_content .= "<tr><td width='170'><strong>Award Amount</strong></td><td class='td-left'><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='award_amount_pass' id='award_amount_pass' onkeyup='blur_award_amount()' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' value='$incumbent_award_amount' /><span id='new_award_amount' style='width:200px; text-align:center; font-weight:700; display:inline-block; color:#23a69a'>$incumbent_award_amount_formatted</span></td><td width='170'><strong>Spend To Date</strong></td><td class='td-left'><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='spend_to_date_pass' id='spend_to_date_pass' onkeyup='blur_spend_to_date()' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='number' value='$incumbent_spend_to_date' /><span id='new_spend_to_date' style='width:200px; text-align:center; font-weight:700; display:inline-block; color:#23a69a'>$incumbent_spend_to_date_formatted</span></td></tr>";*/
	
	$form_update_content .= "<tr><td width='170'><strong>Award Amount</strong></td><td class='td-left'>
	<input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='award_amount_view' id='award_amount_view' onkeyup='blur_award_amount_money()' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' value='$incumbent_award_amount_formatted' />
	<input style='width:100px; border:1px solid #cbcbcb; padding:5px;' name='award_amount_pass' id='award_amount_pass' type='hidden' value='$incumbent_award_amount' />
	</td>
	
	<td width='170'><strong>Spend To Date</strong></td><td class='td-left'>
	<input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='spend_to_date_view' id='spend_to_date_view' onkeyup='blur_spend_to_date_money()' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' value='$incumbent_spend_to_date_formatted' /> 
	<input style='width:100px; border:1px solid #cbcbcb; padding:5px;' name='spend_to_date_pass' id='spend_to_date_pass' type='hidden' value='$incumbent_spend_to_date' />
	</td></tr>";
	
	
	$form_update_content .= "<tr><td width='170'><strong>Incumbent Eligibility</strong><span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'>
	<input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='eligible_pass' type='hidden' value='' />
	<label class='container'><input type='radio' name='elig_inc' value='eligible' $ischecked_eligible_incumbent required>Eligible</label>
	<label class='container'><input style='' type='radio' name='elig_inc' value='eligible_jv' $ischecked_eligible_jv required> Eligible with JV</label><br/>

	<label class='container'><input style='' type='radio' name='elig_inc' value='eligible_jv_member' $ischecked_eligible_jv_member required> JV Member is eligible</label>

	<label class='container'><input style='' type='radio' name='elig_inc' value='not_eligible' $ischecked_noteligible required> Not Eligible</label>
	</td>

	<td width='170'><strong>Current OASIS Pools</strong></td><td class='td-left'>
	<input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='oasis_pools_pass' autocomplete='new-password' type='text' value='$oasis_pools' /></td></tr>";
	
	$form_update_content .= "<tr><td width='170'><strong>8(a) Graduation</strong></td>
	<td class='td-left'><input type='checkbox' name='graduation_8a_chk' id='graduation_8a_chk' value='1' {$checked_8a_value}>
	<input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='graduation_8a' id='graduation_8a' autocomplete='off' type='text' value='" . $graduated . "' placeholder='MM/DD/YYYY' /> </td><td width='170'>&nbsp;</td><td class='td-left'>&nbsp;</td></tr>";
	
	//date('Y-m-d')
	/*$form_update_content .= "<tr><td width='170'><strong>Start Date</strong></td><td class='td-left'><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='start_date_pass' id='start_date_pass' autocomplete='off' type='text' value='" . $incumbent_start_date . "' placeholder='MM/DD/YYYY' readonly /> </td>
	<td width='170'><strong>Completion Date</strong></td><td class='td-left'><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='completion_date_pass' id='completion_date_pass' autocomplete='off' type='text' value='$incumbent_completion' placeholder='MM/DD/YYYY' readonly /></td></tr>"; */

	$form_update_content .= "<tr><td width='170'><strong>Start Date</strong></td><td class='td-left'><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='start_date_pass' id='start_date_pass' autocomplete='off' type='text' minlength='10' pattern='.{0}|.{10,}' title='10 character minimum' maxlength='10' max='2100-12-31' onkeyup='dateslashes(this);' value='" . $incumbent_start_date . "' /> <span style='margin-left:10px'><span style='color:#d4d4d4; margin-right:10px;' onclick='start_date_pass_click();'> &#x1F4C5; MM/DD/YYYY</span></span></td>
	<td width='170'><strong>Completion Date</strong></td><td class='td-left'><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='completion_date_pass' id='completion_date_pass' onkeyup='dateslashes(this);' autocomplete='off' type='text' minlength='10' pattern='.{0}|.{10,}' title='10 character minimum' maxlength='10'  max='2100-12-31' value='$incumbent_completion' /> <span style='margin-left:10px'><span style='color:#d4d4d4; margin-right:10px;' onclick='completion_date_pass_click();'>  &#x1F4C5; MM/DD/YYYY</span></span></td></tr>";

	$form_update_content .= "<tr><td width='170'><strong>Incumbent Status</strong></td><td class='td-left'>
	<select name='incumbent_status_pass' size='1' class='select-styled'>
				  
				  <option value='$incumbent_status'>$incumbent_status</option>
				  <option value=''></option>
				  <option value='Current Incumbent'>Current Incumbent</option>
				  <option value='Previous Incumbent'>Previous Incumbent</option>
	</select></td>
	<!--<td width='170'><strong>Ultimate Completion</strong></td><td class='td-left'><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='ultimate_completion_date_pass' id='ultimate_completion_date_pass' type='text'  value='$incumbent_ultimate' placeholder='MM/DD/YYYY' readonly /></td></tr>-->

	<td width='170'><strong>Ultimate Completion</strong></td><td class='td-left'><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='ultimate_completion_date_pass' id='ultimate_completion_date_pass' type='text' onkeyup='dateslashes(this);' autocomplete='off' minlength='10' pattern='.{0}|.{10,}' title='10 character minimum' maxlength='10'  max='2100-12-31' value='$incumbent_ultimate' /> <span style='margin-left:10px' onclick='ultimate_completion_date_pass_click();'><span style='color:#d4d4d4; margin-right:10px;'> &#x1F4C5; MM/DD/YYYY</span></span></td></tr>";
	
	
	//CONTACTS 
	$form_update_content .= "</table><table width='96%' align='left' border='0' cellspacing='5' cellpadding='5' style='background-color:#f2f2f2;'><tr><td width='92'><strong>Contact</strong></td><td class='td-left'>
	<div style='display:inline-block;padding:5px 0px;vertical-align:top;'><div style='font-weight:700;'>First Name</div>
		  <input name='recruitinga' id='recruitinga' autocomplete='new-password' type='text' value='' style='width:110px; font-weight:500;'/>
	  </div>
	  <div style='display:inline-block;padding:5px 0px;vertical-align:top;'><div style='font-weight:700;'>Last Name</div>
		  <input name='recruitinge' id='recruitinge' type='text' autocomplete='new-password' value='' style='width:110px; font-weight:500;'/>
		  
	  </div>
	  <div style='display:inline-block;padding:5px 0px;vertical-align:top;'><div style='font-weight:700;'>Title</div>
	  <input name='recruitingb' id='recruitingb' type='text' autocomplete='new-password' value='' style='width:180px; font-weight:500;'/>
	  </div>
	  <div style='display:inline-block;padding:5px 0px;vertical-align:top;'><div style='font-weight:700; width:100px;'>Email</div>
	  <input name='recruiting_keypersonnel' id='recruiting_keypersonnel' autocomplete='off' type='text' value='' style='width:180px; font-weight:500;'/>
	  
	  </div>
	  <div style='display:inline-block;padding:5px 0px;vertical-align:top;'><div style='font-weight:700;'>Phone</div>
		  <input name='recruitingd' id='recruitingd' autocomplete='off' onKeyup='formatPhone(this);' maxlength='20' minlength='20' pattern='.{0}|.{20,}' title='16 Digit Number Needed' type='text' value='' style='width:160px; font-weight:500;'/>
		  
	  </div>
	  <div style='display:inline-block;padding:5px 0px;vertical-align:top;'><div style='font-weight:700;'>Ext</div>
		  <input name='recruitingf' id='recruitingf' autocomplete='off' maxlength='4' minlength='3' type='text' value='' style='width:100px; font-weight:500;'/>
		  
	  </div>
	  
	  <div style='display:inline-block;padding:5px 0px;vertical-align:top;'><div style='font-weight:700;'></div>
		  
  
  <div id='add_contact_button' style='background-color: #e4e4e4;
    padding: 6px;
    width: 80px;
    text-align: center; margin-top:11px;
    font-weight: 700; cursor: pointer;' onclick='recruiting_table();
  '>Add</div>
	  </div>
	  $recruiting_start
	  <DIV name='opp_recruiting' id='opp_recruiting'></div>
		<input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='combined' id='combined' type='hidden' value='$contact_parts' />
		
		<DIV style='visibility: hidden;' onclick='refresh_table(); alert(\"refresh\");'>REFRESH</div>
	
	</td></tr>";

	
	
	
	
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
	  <div style='display:inline-block;padding:5px 0px;vertical-align:top;'><div style='font-weight:700;'>Fixed-Price</div>
	  <input type='checkbox' id='pricing1' name='pricing1' value='Firm Fixed-Price (FFP)' onclick=\"pricing_update();\" $opp_pricing_a>
	  <label for='pricing1'> Firm Fixed-Price (FFP)</label><br>
	  <input type='checkbox' id='pricing2' name='pricing2' value='Firm Fixed-Price LOE' onclick=\"pricing_update();\" $opp_pricing_b>
	  <label for='pricing2'> Firm Fixed-Price LOE</label><br>
	  <input type='checkbox' id='pricing3' name='pricing3' value='FFP Materials Reimbursement' onclick=\"pricing_update();\" $opp_pricing_c>
	  <label for='pricing3'> FFP Materials Reimbursement</label><BR>
	  <input type='checkbox' id='pricing4' name='pricing4' value='Fixed-Price Incentive (FPI)' onclick=\"pricing_update();\" $opp_pricing_d>
	  <label for='pricing4'> Fixed-Price Incentive (FPI)</label>
	  
	  </div>
	  <div style='display:inline-block;padding:5px 0px;vertical-align:top;'><div style='font-weight:700;'>Cost-Reimbursement</div>
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
	  <div style='display:inline-block;padding:5px 0px;vertical-align:top;'><div style='font-weight:700;'>Time and Materials (T&M)</div>
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
	
	//print("111 $incumbent_container 222");
	
	//}
	/// 333 TITLE
	print ($form_table . "" . $form_update_content . "</table>" . "");
	
	//print("$incumbent_container");
?>

<input type="hidden" name="opp_opportunity_id" value="<?php print $opp_opportunity_id; ?>"/>
<input type="hidden" name="which_incumbent_id" value="<?php print $which_incumbent_id; ?>"/>

<!--<input type="hidden" name="<= ASCsrf::getTokenName() ?>" value="<= ASCsrf::getToken() ?>">-->
<div>

</form>
<!--TITLE INCUMB-->
<?php /*print("$incumbent_container");*/ ?>
<!--<div style="height:60px;"></div>-->

<div style="display:inline-block; width:48%; margin-top:30px;"><input style="margin-left: 50px; width:200px; padding:4px 16px; font-weight: 700; cursor: pointer;" type="button" value="Back" <?php print("onclick=\"window.top.location.href='$baseurl/addrole_update_opportunities.php?which_update_id=".$opp_opportunity_id."'\""); ?>></div>
<div style="display:inline-block; width:48%; margin-top:30px; text-align:right;"><input style="padding:4px 16px; font-weight: 700; width:200px; cursor: pointer;" type="submit" value="Update Incumbent"></div>
</div>
<div style="height:60px;"></div>
<?php
//addrole_update_opportunities.php?which_update_id=1
//addrole_update_opportunities.php?which_update_id=1
/*print("
$incumbent_container
");*/
?>
<script>
function recruiting_table() {
	//alert("...");
	//CREATE DIV
	const divadd = document.createElement("div");
	//const node = document.createTextNode("aaa " + Math.floor(Math.random() * 255)); //0 thru 255);
	const node = document.createTextNode(""); //0 thru 255);
	//divadd.style.backgroundColor = "#9b1f6b";
	//divadd.style.color = "#fff";
	//divadd.style.width = "100px";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 0px;'><input type='text' name='pt_a_" + Math.floor(Math.random() * 255) + "' value='" + document.getElementById("recruitinga").value + "' style='padding:2px 5px; font-weight:500; width:110px; border:none;'></DIV>";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 0px;'><input type='text' name='pt_e_" + Math.floor(Math.random() * 255) + "' value='" + document.getElementById("recruitinge").value + "' style='padding:2px 5px; font-weight:500; width:110px; border:none;'></DIV>";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 0px;margin-left:4px;'><input type='text' name='pt_b' value='" + document.getElementById("recruitingb").value + "' style='padding:2px 5px; font-weight:500; width:180px; border:none;'></DIV>";
	
	var kptext = "";			
	var kp=document.getElementById("recruiting_keypersonnel"); /*if (document.getElementById("recruiting_keypersonnel").checked==true){ kptext = "(KP)"; } else { kptext = ""; }*/ 
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 0px;margin-left:4px;'><input type='text' name='pt_f' value='" + document.getElementById("recruiting_keypersonnel").value + "' style='padding:2px 5px; font-weight:500; width:180px; border:none;'></DIV>";
	
	/*divadd.innerHTML += "<div style='display:inline-block; padding:5px 0px;'><input type='text' name='pt_c' value='" + kptext + "' style='padding:2px 5px; font-weight:500; width:50px; border:none;'></DIV>";*/
	    /* float: right; */
    
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 0px;'><input type='text' name='pt_d' value='" + document.getElementById("recruitingd").value + "' style='padding:2px 0px; font-weight:500; width:160px; border:none; margin-left:7px;'></DIV>";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 0px;'><input type='text' name='pt_f' value='" + document.getElementById("recruitingf").value + "' style='padding:2px 0px; font-weight:500; width:90px; border:none; margin-left:7px;'></DIV>";
	
	divadd.innerHTML += "<span style='background-color:#9b1f6b; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 11px; cursor:pointer;' onclick='this.parentElement.remove();refresh_table();'> Remove </span>";
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
	
	//TEST PATTERN
	var phonelengthcheck = document.getElementById('recruitingd').value.length;
	//alert ('OK ' + phonelengthcheck);
	//END PATTERN
	
	//alert(inputs.length);
	//document.getElementById('car').value="1234567890abc";	
	document.getElementById('combined').value=combinedtext;
	
	//CLEAR INPUT ZONE
	document.getElementById('recruitinga').value="";
	document.getElementById('recruitinge').value="";
	document.getElementById('recruitingb').value="";
	//document.getElementById('recruiting_keypersonnel').checked = false;
	document.getElementById('recruiting_keypersonnel').value="";
	document.getElementById('recruitingd').value="";
	document.getElementById('recruitingf').value="";
	//END OF RECRUITING TABLE
	//var phonelengthcheck = document.getElementById('recruitingd').value;
	//alert ('OK ' + document.getElementById('recruitingd').length);
	//var text = "Visit W3Schools";
	//var pattern = /w3schools/i;
	//var result = text.match(pattern);
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
function onsubmit_code() {
	//alert("HMMM");
	refresh_table();	
}
</script>
<script>
function blur_award_amount(){
	//alert("OK");
	//var eaa = document.getElementById('award_amount_pass').value;
	//var num = 1234567.89;
	//var commas = eaa.toLocaleString("en-US");
	//var eaa_ready = eaa.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	
	//var faa = document.getElementById("demo").innerHTML; 
	//document.getElementById("demo").innerHTML = eaa_ready.replace("$", "");
	
	//document.getElementById('new_award_amount').innerHTML = eaa_ready;
	//alert('ok');
	//document.getElementById('award_amount_pass').value = eaa_ready;
	
	var eaa = document.getElementById('award_amount_pass').value;
	var numb = 1234567.89;
	var commas = eaa.toLocaleString("en-US");
	var eaa_ready = eaa.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	
	document.getElementById('new_award_amount').innerHTML='$' + eaa_ready;
	//document.getElementById('award_amount_pass').value='$' + eaa_ready;
	//alert ('$' + eaa_ready);
}

function blur_award_amount_money(){
	var aap = document.getElementById('award_amount_pass').value;
	var aav = document.getElementById('award_amount_view').value;
	//alert("OK");
	
	// Create our number formatter.
const formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
  maximumFractionDigits: 0
  //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});

//console.log(formatter.format(2500)); /* $2,500.00 */
	clean_number2 = aav.replace("$", "");
	//clean_number  = clean_number2.replace(",", "");
	clean_number  = parseFloat(clean_number2.replace(/,/g, ''))
	//alert ("Clean " + clean_number);
	var formattedaav = formatter.format(clean_number);
	//alert ("formatted " + formattedaav);

	//var eaa = document.getElementById('award_amount_pass').value;
	//var numb = 1234567.89;
	//var commas = eaa.toLocaleString("en-US");
	//var eaa_ready = eaa.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	document.getElementById('award_amount_pass').value=clean_number;
	if (clean_number>0) { document.getElementById('award_amount_view').value=formattedaav; } //formatter.format(aav)
	
		//document.getElementById('new_award_amount').innerHTML='$' + eaa_ready;

}

function blur_spend_to_date_money(){
	var stdp = document.getElementById('spend_to_date_pass').value;
	var stdv = document.getElementById('spend_to_date_view').value;
	//alert("OK");
	
	// Create our number formatter.
const formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
  maximumFractionDigits: 0
  //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});

//console.log(formatter.format(2500)); /* $2,500.00 */
	clean_number2 = stdv.replace("$", "");
	//clean_number  = clean_number2.replace(",", "");
	clean_number  = parseFloat(clean_number2.replace(/,/g, ''))
	//alert ("1 Clean " + clean_number);
	var formattedstdv = formatter.format(clean_number);
	//alert ("formatted " + formattedstdv);

	//var eaa = document.getElementById('award_amount_pass').value;
	//var numb = 1234567.89;
	//var commas = eaa.toLocaleString("en-US");
	//var eaa_ready = eaa.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	document.getElementById('spend_to_date_pass').value=clean_number;
	if (clean_number>0) { document.getElementById('spend_to_date_view').value=formattedstdv; } //formatter.format(aav)
	
		//document.getElementById('new_award_amount').innerHTML='$' + eaa_ready;

}



function blur_spend_to_date(){
	//alert("OK");
	var eab = document.getElementById('spend_to_date_pass').value;
	var numb = 1234567.89;
	var commasb = eab.toLocaleString("en-US");
	var eab_ready = eab.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	
	document.getElementById('new_spend_to_date').innerHTML='$' + eab_ready;
}
</script>
<script>
function requiredfields() {
	//alert("Required Fields");
  var x = document.forms["incumbent_update"]["incumbent_name_pass"].value;
  if (x == "") {
    alert("Incumbent Name must be filled out (Required Field)");
	//x.focus();
	document.forms["incumbent_update"]["incumbent_name_pass"].focus();
    return false;
  }
  var x = document.forms["incumbent_update"]["website_pass"].value;
  if (x == "") {
    alert("Incumbent Website must be filled out (Required Field)");
	//x.focus();
	document.forms["incumbent_update"]["website_pass"].focus();
    return false;
  }
  //website_pass
  //opp_response
  //opp_released
  //contract_vehicle
  //opp_vehicle_one
}
</script>
<script>
function dateslashes() {

	var sdp = document.getElementById('start_date_pass');
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
					
	var sdp = document.getElementById('completion_date_pass');
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
					
	var sdp = document.getElementById('ultimate_completion_date_pass');
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
      function formatPhone(obj) 
	  	{
			var remove_extras_phone="";
    	var numbers = obj.value.replace(/\D/g, ''),
        char = {0:'(',3:') ',6:'-'};
    	obj.value = '';
   			 for (var i = 0; i < numbers.length; i++) {
        obj.value += (char[i]||'') + numbers[i];
    			}
				//var add_contact_button_show = add_contact_button
				if ((numbers.length>0) && (numbers.length<10)) { 
					//alert("hey " + numbers.length);
					document.getElementById('add_contact_button').style.display = 'none';
					} 
				if ((numbers.length==10)) { 
					//alert("hey " + numbers.length);
					document.getElementById('add_contact_button').style.display = 'inline-block';
					} 
				//alert("hey " + numbers.length); //numbers is value
				if (numbers.length>10) {
					remove_extras_phone = obj.value.slice(0,-1); //"123"; //sdp.text.slice(0,-1);
					var text = "Hello world!";
					var remove_extras_charcters = obj.value.substring(0, 10);
					obj.value = remove_extras_charcters;
					}
				//if (numbers.length<10) { alert('Nope ' + numbers.length); }
				//alert (document.getElementById("recruitingd").value);
		}
		function formatPhoneNumber(phoneNumberString) {
		  var cleaned = ('' + phoneNumberString).replace(/\D/g, '');
		  var match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
		  if (match) {
			return '(' + match[1] + ') ' + match[2] + '-' + match[3];
		  }
		  return null;
		}

		function lengthRange(inputtxt, minlength, maxlength)
		{  	
		   var userInput = inputtxt.value;  
		   if(userInput.length >= minlength && userInput.length <= maxlength)
			  {  	
				return true;  	
			  }
		   else
			  {  	
			alert("Please input between " +minlength+ " and " +maxlength+ " characters");  		
				return false;  	
			  }  
		}
    </script>
<script>
function dynamic_link() {
	
	var weblink = document.getElementById('dynamic_weblink');
	var weblinkinput = document.getElementById('website_pass').value;
	var result = weblinkinput.includes("http");
	if (result==true) { 
	//var weblinkinputtrue = originalString.replace('https:////', '');
	var weblinkinputhttp = "<a style='color:#141414;' target='blank' href='" + weblinkinput + "'>" + weblinkinput + "</a>"; 
	}
	if (result==false) { 
	var weblinkinputhttp = "<a style='color:#141414;' target='blank' href='https://" + weblinkinput + "'>" + weblinkinput + "</a>";
	}
	
	//alert("test " + weblinkinput);
	weblink.innerHTML = weblinkinputhttp;
}
</script>

<script>
	function gradclick() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('8a_graduation').focus();
		document.getElementById('8a_graduation').click();
	}

	function start_date_pass_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('start_date_pass').focus();
		document.getElementById('start_date_pass').click();
	}

	 function completion_date_pass_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('completion_date_pass').focus();
		document.getElementById('completion_date_pass').click();
	} 

	function ultimate_completion_date_pass_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('ultimate_completion_date_pass').focus();
		document.getElementById('ultimate_completion_date_pass').click();
	}  

document.getElementById('graduation_8a_chk').onchange = function() {
	var checked_8a_val = document.getElementById('graduation_8a_chk').checked;
	if(checked_8a_val){
    document.getElementById('graduation_8a').disabled = !this.checked;
	document.getElementById('graduation_8a').value = ' ';
	}
	else{
		document.getElementById('graduation_8a').value = '<?php echo $graduated; ?>';
		document.getElementById('graduation_8a').value = date_8a;
	} 
};
</script>