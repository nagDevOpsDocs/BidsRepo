<?php
//ini_set('display_errors', '1');error_reporting(E_ALL);
$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;
////include($_SERVER['DOCUMENT_ROOT'] . "include/it_loader.php");


setlocale(LC_MONETARY,"en_US");
?>
<?php
//print("hey"); exit;
print("<body onload='dynamic_link()'>"); ?> 
<style>
.collapsible {
  background-color: #368dae; /*#7F36AE; #3c4db0;*/ /*#e0b933;*/
  color: white;
  cursor: pointer;
  padding: 14px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #3c4db0; /*#2a3679; #368dae*/
}

.content {
  padding: 0 18px;
  display: block; /*none;*/
  overflow: hidden; /*block;*/ /*hidden;*/
  background-color: #fff;
  border:1px solid #e1e1e1;
}
</style>
  
<link href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>  
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>  
$(function() { 
//$( '#start_date_pass' ).datepicker({
//dateFormat: 'mm/dd/yy'
//});
//$( '#completion_date_pass' ).datepicker();
//$( '#ultimate_completion_date_pass' ).datepicker();
//$( '#graduated' ).datepicker();
/*
$("#start_date_pass").datepicker({
	dateFormat: 'mm/dd/yy',
    changeMonth: true,
    changeYear: true
});

$("#completion_date_pass").datepicker({
	dateFormat: 'mm/dd/yy',
    changeMonth: true,
    changeYear: true
});

$("#ultimate_completion_date_pass").datepicker({
	dateFormat: 'mm/dd/yy',
    changeMonth: true,
    changeYear: true
}); 
*/

/*
$("#graduated").datepicker({
	dateFormat: 'mm/dd/yy',
    changeMonth: true,
    changeYear: true
}); */

});  
</script> 

<style>
body, input, table, td {font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}
.samewidth { width:240px; font-weight:700;}
.td-left { background-color:#fff; border:none; padding: 5px;}
.select-styled { padding: 4px 5px; border: 1px solid #cbcbcb; width:200px; font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}
</style>

<?php
$which_update_id=$_GET['which_update_id'];

$form_portion = "<form action='incumbent_db_addnew_admin.php' name='incumbent_add' id='incumbent_add' method='post' onsubmit='return requiredfields();'>";
$form_table = $form_portion . "<table width='90%' align='left' border='0' cellspacing='5' cellpadding='5'>";
$form_update_content = "";

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
	
//BID excel_test
		$excel_test_record = "SELECT contract_vehicle FROM excel_test WHERE opportunity_id = $opp_opportunity_id"; 
		$resulte = mysqli_query($mysqli_link, $excel_test_record);
		while($rowe = mysqli_fetch_array($resulte, MYSQLI_NUM))
		{
		$db_contract_vehicle = $rowe[0];
		$is_oasis = 0;
		if (strpos($db_contract_vehicle, 'OASIS') !== false) 
			{
			$is_oasis = 1;
			}
		}

print("<div style='text-align:center;font-size: 18px;font-weight: 700;color: #3c4db0;padding: 10px;'>$opp_title - Incumbents</div>");
	
	$proposal_ida = explode(" ", $vehicle_one); 
	$proposal_idb = explode(" ", $vehicle_two);
	$proposal_id_a = $proposal_ida[0];
	$proposal_id_b = $proposal_idb[0];
	
	//START
	$incumbent_container = "";
	
	$incumbent_award_amount_formatted="";
	$incumbent_spend_to_date_formatted="";
	$incumbent_award_amount=0;
	$incumbent_spend_to_date=0;
		
	// OR (opp LIKE '%" . $proposal_id_b . "%') 
	$extra_search = "";
	if (strlen($proposal_id_b)>2) { $extra_search = " OR (opp LIKE '%" . $proposal_id_b . "%') "; }
	$find_incumbents = "SELECT incumbent_id, incumbent_name, opp, incumbent_contract_taskorder, reference_link, award_amount, spend_to_date, start_date, completion_date, ultimate_completion_date, website, current_pools, oasis_pools, contact_parts, in_forecast, incumbent_contract_taskorder, incumbent_status, contract, taskorder, awarded_thru, eligible_incumbent, eligible_jv, graduated, eligible_status, awarded_set_aside FROM incumbents_test WHERE (opportunity_id = $which_update_id) ORDER BY incumbent_status ASC"; 
	$incumbent_name = "";
	//print ("FIND " . $find_incumbents);; 
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
		if ($incumbent_award_amount) {$incumbent_award_amount_formatted = "$" . number_format($rowb[5],0);}
		$incumbent_spend_to_date = $rowb[6];
		if ($incumbent_spend_to_date) {$incumbent_spend_to_date_formatted = "$" . number_format($rowb[6],0);}
		
		$incumbent_start_date = date("m/d/Y", strtotime($rowb[7]));
		if ($incumbent_start_date=='12/31/1969') { $incumbent_start_date="N/A"; }
		$incumbent_completion = date("m/d/Y", strtotime($rowb[8]));
		if ($incumbent_completion=='12/31/1969') { $incumbent_completion="N/A"; }
		$incumbent_ultimate = date("m/d/Y", strtotime($rowb[9]));
		if ($incumbent_ultimate=='12/31/1969') { $incumbent_ultimate="N/A"; }
		$incumbent_website_url = $rowb[10];
		$current_pools = $rowb[11];
		$oasis_pools = $rowb[12];
		$contact_info = str_replace("|||"," ",$rowb[13]);
		$in_forecast = $rowb[14];
		$incumbent_contract_taskorder = $rowb[15];
		$incumbent_status = $rowb[16];
		
		$incumbent_contract = $rowb[17];
		$incumbent_taskorder = $rowb[18];
		$incumbent_awarded_thru = $rowb[19];
		$awarded_set_aside = $rowb[24];
		
		$eligible_incumbent = $rowb[20];
		$eligible_jv = $rowb[21];
		$graduated = $rowb[22];
		$graduated_date = date("m/d/Y", strtotime($rowb[22]));
		if ($graduated_date=='12/31/1969') { $graduated_date=""; }
		
		$eligible_status = $rowb[23];
		
		$ischecked_eligible_incumbent = ($eligible_incumbent == 'eligible') ? 'Yes' : 'No';
		$ischecked_eligible_jv = ($eligible_incumbent == 'eligible_jv') ? 'Yes' : 'No';

		$ischecked_eligible_jv_member = ($eligible_incumbent == 'eligible_jv_member') ? 'Yes' : 'No';

		$ischecked_eligible_status = ($eligible_incumbent == 'not_eligible') ? 'Yes' : 'No';
		
		$incumbent_website = "<a title='" . $incumbent_name . "' style='color:#2f40a2;' href='" . $incumbent_website_url . "' target='_blank'><img style='vertical-align: middle; height:16px; width:16px; margin-left:20px; position:relative; top:-1px;' src='hyperlink.jpg' alt='$incumbent_name'></a>";
		
		$full_ref_link = "<a title='" . $incumbent_ref_link . "' style='color:#3c4db0;' href='" . $incumbent_ref_link . "' target='_blank'>GovWin</a>";	
			
		
		$incumbent_container .= "
			<div class='incumbentvaluecss' style='display:inline-block;width:96%;vertical-align:top; padding:8px 12px; overflow:auto; overflow-wrap:break-word; border:1px solid #d1d1d3; margin-bottom:12px;'>
		
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Incumbent Name</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '><strong>
			
			<a title='" . $incumbent_name . "' style='color:#3c4db0;' href='" . "addrole_edit_incumbent.php?which_incumbent_id=$incumbent_id" . "' target='top'>$incumbent_name</a> <span style='margin-left:20px;'>$incumbent_status</span></div></strong>
			
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Award Amount</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_award_amount_formatted</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Spend To Date</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_spend_to_date_formatted</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Website URL</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_website_url</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Reference Link</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_ref_link</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Current OASIS Pools</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$oasis_pools</div><BR>
			
	<!--	<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>$db_contract_vehicle</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$oasis_pools</div><BR> -->
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Start Date</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_start_date</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Completion Date</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_completion</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Ultimate Completion</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_ultimate</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Contract</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_contract</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Task Order</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_taskorder</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Awarded Thru</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_awarded_thru</div><BR>

			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Awarded Set Aside</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$awarded_set_aside</div><BR>
			
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Incumbent Status</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_status</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Contact(s)</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$contact_info</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Eligible</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$ischecked_eligible_incumbent</div><BR>
				
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Eligible With JV</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$ischecked_eligible_jv</div><BR>

			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>JV Member is eligible</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$ischecked_eligible_jv_member</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Not Eligible</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$ischecked_eligible_status</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>8(a) Graduated</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$graduated_date</div><BR>
			
			</div>
			";
			
			
			//RECRUITING START
		$contact_parts = ""; //$rowb[18];
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
					//if ($inloop==4) { $opp_recruiting .= "***<BR>"; $inloop=0; } 
					if ($inloop==5) { $recruiting_start .= '
		<div name="opp_recruiting_start" id="opp_recruiting_start"><div><div style="display:inline-block; padding:5px 10px;">
		<input type="text" name="pt_a_238" value="'. $pass_quantity .'" style="padding:2px 5px; font-weight:500; width:110px;border:none;"></div><div style="display:inline-block; padding:5px 10px;">
		<input type="text" name="pt_e_213" value="'. $pass_ftehours .'" style="padding:2px 5px; font-weight:500; width:110px;border:none;"></div><div style="display:inline-block; padding:5px 10px;margin-left:4px;">
		<input type="text" name="pt_b" value="'. $pass_labor .'" style="padding:2px 5px; font-weight:500; width:180px;border:none;"></div><div style="display:inline-block; padding:5px 10px;"><input type="text" name="pt_c" value="'.$pass_email_contact.'" style="padding:2px 5px; font-weight:500; width:180px;border:none;"></div><div style="display:inline-block; padding:5px 10px;"><input type="text" name="pt_d" value="'.$pass_phone_contact.'" style="padding:2px 5px; font-weight:500; width:100px; border:none; margin-left:7px;"></div><span style="background-color:#9b1f6b; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 16px;" onclick="this.parentElement.remove();refresh_table();"> Remove </span></div></div>
		';
					}
					
					if ($inloop==5) { $opp_recruiting .= "<div style='padding-left:40px; font-weight:700;'>$temp_job</div></DIV>"; $inloop=0; }
					
					
					$i++;
				}
				
		} else { $opp_recruiting = $contact_parts; }
		//RECRUITING STOP
		}
	//STOP
	
	//$form_update_content .= "<tr><td>ID:</td><td>$db_poc_id</td></tr>";
	$form_update_content .= "<tr><td width='220'><strong>Incumbent Name</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left' colspan='3'><input style='width:600px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' name='incumbent_name_pass' id='incumbent_name_pass' required type='text' value='' autocomplete='off'/></td></tr>";

	$form_update_content .= "<tr><td width='170'><strong>Incumbent Identified By </strong><span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td>
	<td><label class='container' style='margin-left:10px;'><input style='' type='radio' name='incumbent_identified' value='Government' required>Government</label>
	<label class='container' style='margin-left:20px;'><input style='' type='radio' name='incumbent_identified' value='Research Team' required>Research Team</label></td></tr>";
	
	$form_update_content .= "<tr><td width='220'><strong>Incumbent Website</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left' colspan='3'><input style='width:600px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' name='website_pass' id='website_pass' required type='text' onkeyup='dynamic_link();' value='' autocomplete='off'/>
	<div id='dynamic_weblink' style='display:inline-block;margin-left:10px;'></div>
	</td></tr>";
	
	//NEW
	$form_update_content .= "<tr><td width='220'><strong>Contract</strong></td><td class='td-left'><input style='width:300px; border:1px solid #cbcbcb; padding:5px;' name='incumbent_contract_pass' type='text' value='' /><span style='width:100px; text-align:center; font-weight:700; display:inline-block;'></span></td><td width='170'><strong>Task Order</strong></td><td class='td-left'><input style='width:300px; border:1px solid #cbcbcb; padding:5px;' name='incumbent_taskorder_pass' type='text' value='' /><span style='width:100px; text-align:center; font-weight:700; display:inline-block;'></span></td></tr>";
	
	$form_update_content .= "<tr><td width='170'><strong>Awarded Thru</strong></td><td class='td-left'><input style='width:300px; border:1px solid #cbcbcb; padding:5px;' name='awarded_thru_pass' type='text' value='' /><span style='width:100px; text-align:center; font-weight:700; display:inline-block;'></span></td><td width='170'><strong>Awarded Set Aside</strong></td><td class='td-left'><input style='width:300px; border:1px solid #cbcbcb; padding:5px;' name='awarded_set_aside' type='text' value='' /><span style='width:100px; text-align:center; font-weight:700; display:inline-block;'></span></td></tr>";
	
	
	$form_update_content .= "<tr><td width='220'><strong>Reference Link</strong></td><td class='td-left' colspan='3'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='reference_link_pass' type='text' value='' /></td></tr>";

	$form_update_content .= "<tr><td width='170'><strong>Award Amount</strong></td><td class='td-left'>
	<input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='award_amount_view' id='award_amount_view' onkeyup='blur_award_amount_money()' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' value='' />
	<input style='width:100px; border:1px solid #cbcbcb; padding:5px;' name='award_amount_pass' id='award_amount_pass' type='hidden' value='' />
	</td>
	
	<td width='170'><strong>Spend To Date</strong></td><td class='td-left'>
	<input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='spend_to_date_view' id='spend_to_date_view' onkeyup='blur_spend_to_date_money()' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' value='' />
	<input style='width:100px; border:1px solid #cbcbcb; padding:5px;' name='spend_to_date_pass' id='spend_to_date_pass' type='hidden' value='' />
	</td></tr>";

	$form_update_content .= "<tr><td width='170'><strong>Incumbent Eligibility</strong></td><td class='td-left' colspan='3'>
	<input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='eligible_pass' type='hidden' value='' />
	<label class='container' style='margin-left:10px;'><input style='' type='radio' name='elig_inc' value='eligible' > Eligible</label>
	<label class='container' style='margin-left:20px;'><input style='' type='radio' name='elig_inc' value='eligible_jv'> Eligible with JV</label>

	<label class='container' style='margin-left:20px;'><input style='' type='radio' name='elig_inc' value='eligible_jv_member' required> JV Member is eligible</label>

	<label class='container' style='margin-left:20px;'><input style='' type='radio' name='elig_inc' value='not_eligible'> Not Eligible</label>
	</td>";
	/*<td width='170'>&nbsp;</td><td class='td-left'>&nbsp;</td></tr>";*/
	
	
	$form_update_content .= "<tr><td width='170'><strong>8(a) Graduation</strong></td>
	<td class='td-left'><input type='checkbox' name='8achk' id='8achk' value='8achk'>
	<input type='date' style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='graduated' id='graduated' autocomplete='off' onkeyup='dateslashes(this);' placeholder='MM/DD/YYYY' /></td>
	
	
	<td width='170'><strong>Eligible OASIS Pools</strong></td><td class='td-left'>
	<input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='oasis_pools_pass' autocomplete='new-password' type='text' value='' /></td></tr>";
	
	
	//date('Y-m-d')
	$form_update_content .= "<tr><td width='220'><strong>Start Date</strong></td><td class='td-left'><input type='date' style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='start_date_pass' id='start_date_pass' autocomplete='off' onkeyup='dateslashes(this);'  placeholder='MM/DD/YYYY'  /> </td><td width='220'><strong>Completion Date</strong></td><td class='td-left'><input type='date' style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='completion_date_pass' id='completion_date_pass' autocomplete='off' placeholder='MM/DD/YYYY'  /> </td></tr>";

	$form_update_content .= "<tr>
	<td width='220'><strong>Ultimate Completion</strong></td><td class='td-left'><input type='date' style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='ultimate_completion_date_pass' id='ultimate_completion_date_pass' autocomplete='off' placeholder='MM/DD/YYYY'  /></td>
	<td width='220'><strong>Incumbent Status</strong></td><td class='td-left'>
	<select name='incumbent_status_pass' size='1' class='select-styled'>
				  <option value=''></option>
				  <option value='Current Incumbent'>Current Incumbent</option>
				  <option value='Previous Incumbent'>Previous Incumbent</option>
	</select></td>
	</tr>";
	
	//CONTACTS 
	$form_update_content .= "<table width='100%' align='left' border='0' cellspacing='5' cellpadding='5' style='background-color:#f2f2f2;'><tr><td width='92'><strong>Contact</strong></td><td class='td-left'>
	<div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>First Name</div>
		  <input name='recruitinga' id='recruitinga' type='text' value='' style='width:110px; font-weight:500;'/>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Last Name</div>
		  <input name='recruitinge' id='recruitinge' type='text' autocomplete='off' value='' style='width:110px; font-weight:500;'/>
		  
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Title</div>
	  <input name='recruitingb' id='recruitingb' type='text' autocomplete='off' value='' style='width:180px; font-weight:500;'/>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700; width:100px;'>Email</div>
	  <input name='recruiting_keypersonnel' id='recruiting_keypersonnel' autocomplete='off' type='text' value='' style='width:140px; font-weight:500;'/>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Phone</div>
		  <input name='recruitingd' id='recruitingd' autocomplete='off' autocomplete='new-password' onKeyup='formatPhone(this);' maxlength='14' minlength='14' pattern='.{0}|.{14,}' title='10 Digit Number Needed' type='text' value='' style='width:100px; font-weight:500;'/>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Ext</div>
		  <input name='recruitinge' id='recruitingh' autocomplete='off' maxlength='4' minlength='3' type='text' value='' style='width:80px; font-weight:500;'/>
	  </div>
	  
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'></div>
		  
  
  <div id='add_contact_button' style='background-color: #e4e4e4;
    padding: 6px;
    width: 70px;
    text-align: center; margin-top:11px;
    font-weight: 700; cursor:pointer' onclick='recruiting_table();
  '>Add</div>
	  </div>
	  
	  <DIV name='opp_recruiting' id='opp_recruiting'></div>
		<input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='combined' id='combined' type='hidden' value='' />
		
		<DIV style='visibility: hidden;' onclick='refresh_table(); alert(\"refresh\");'>REFRESH</div>
	
	</td></tr>";
	
	
	
	$form_update_content .=
	"<input type='hidden' name='opp_opportunity_id' value='$opp_opportunity_id'/>
<input type='hidden' name='opp_vehicle_one' value='$vehicle_one'/>
<input type='hidden' name='opp_vehicle_two' value='$vehicle_two'/>
	";
	/*<input type='hidden' name='" . ASCsrf::getTokenName() ."' value='" . ASCsrf::getToken() . "'>*/

	$form_update_content .= "

</div>";
	
	$collapse_div = "<button type='button' class='collapsible active'>Add Incumbent&nbsp;1</button>
<div class='content'>
  <div>
  
  $form_table $form_update_content </table>
  
  </div>
  <div style=''>
  		<div style='display:inline-block; width:48%;'></div>
		<div style='display:inline-block; width:48%; text-align:right;'><input style='font-weight: 700; padding: 8px; margin-top: 20px;' type='submit' value='Add Incumbent'></div>
		
  </div>
  <div style='height:40px;'></div>
</div>
<div style='height:30px;'></div>
";
?>
	
<div>

	<?php
    /*print("<div>HELLO<BR></div>" . $collapse_div);*/
	print("" . $collapse_div);
    ?>

</form>
<!--TITLE INCUMB-->
<?php print("$incumbent_container"); ?>
<!--<div style="height:60px;"></div>-->

<div style="display:inline-block; width:48%;"><input style="margin-left: 50px; width:200px; padding:4px 16px; font-weight: 700;" type="button" value="Back" <?php print("onclick=\"window.top.location.href='$baseurl/addrole_update_opportunities.php?which_update_id=".$opp_opportunity_id."'\""); ?>></div>
<div style="display:inline-block; width:48%; text-align:right;"><!--<input style="background-color:#23a69a; padding:4px 16px; border-radius:7px; color:#fff; font-weight: 700;" type="submit" value="Add Incumbent">--></div>
</div>
<div style="height:60px;"></div>
<?php
/*print("
$incumbent_container
");*/
?>
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "none") {
      content.style.display = "block";
    } else {
      content.style.display = "none";
    }
  });
}
</script>
<script>
function recruiting_table() {
	//alert("Nice");
	//CREATE DIV
	const divadd = document.createElement("div");
	const node = document.createTextNode(""); 
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='pt_a_" + Math.floor(Math.random() * 255) + "' value='" + document.getElementById("recruitinga").value + "' style='padding:2px 5px; font-weight:500; width:110px; border:none;'></DIV>";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='pt_e_" + Math.floor(Math.random() * 255) + "' value='" + document.getElementById("recruitinge").value + "' style='padding:2px 5px; font-weight:500; width:110px; border:none;'></DIV>";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;margin-left:4px;'><input type='text' name='pt_b' value='" + document.getElementById("recruitingb").value + "' style='padding:2px 5px; font-weight:500; width:180px; border:none;'></DIV>";
	
	var kptext = "";			
	var kp=document.getElementById("recruiting_keypersonnel");  
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;margin-left:4px;'><input type='text' name='pt_f' value='" + document.getElementById("recruiting_keypersonnel").value + "' style='padding:2px 5px; font-weight:500; width:140px; border:none;'></DIV>";
	/* float: right; */
    
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='pt_d' value='" + document.getElementById("recruitingd").value + "' style='padding:2px 5px; font-weight:500; width:100px; border:none; margin-left:7px;'></DIV>";

	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='pt_h' value='" + document.getElementById("recruitingh").value + "' style='padding:2px 5px; font-weight:500; width:80px; border:none; margin-left:7px;'></DIV>";
	
	divadd.innerHTML += "<span style='background-color:#9b1f6b; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 60px; display: inline-block; margin-left: 7px; cursor:pointer;' onclick='this.parentElement.remove();refresh_table();'> Remove </span>";
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
	document.getElementById('recruitingh').value="";
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
function requiredfields() {
	//alert("Required Fields");
  var x = document.forms["incumbent_add"]["incumbent_name_pass"].value;
  if (x == "") {
    alert("Incumbent Name must be filled out (Required Field)");
	//x.focus();
	document.forms["incumbent_add"]["incumbent_name_pass"].focus();
    return false;
  }
  var x = document.forms["incumbent_add"]["website_pass"].value;
  if (x == "") {
    alert("Incumbent Website must be filled out (Required Field)");
	//x.focus();
	document.forms["incumbent_add"]["website_pass"].focus();
    return false;
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
		}
    </script>
<script>
function blur_award_amount(){
	var eaa = document.getElementById('award_amount_pass').value;
	var numb = 1234567.89;
	var commas = eaa.toLocaleString("en-US");
	var eaa_ready = eaa.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	
	document.getElementById('new_award_amount').innerHTML='$' + eaa_ready;
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
});

	clean_number2 = aav.replace("$", "");
	clean_number  = parseFloat(clean_number2.replace(/,/g, ''))
	var formattedaav = formatter.format(clean_number);
	document.getElementById('award_amount_pass').value=clean_number;
	if (clean_number>0) { document.getElementById('award_amount_view').value=formattedaav; } 

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
});

	clean_number2 = stdv.replace("$", "");
	clean_number  = parseFloat(clean_number2.replace(/,/g, ''))
	var formattedstdv = formatter.format(clean_number);
	document.getElementById('spend_to_date_pass').value=clean_number;
	if (clean_number>0) { document.getElementById('spend_to_date_view').value=formattedstdv; } 

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
document.getElementById('8achk').onchange = function() {
    document.getElementById('graduated').disabled = !this.checked;
	document.getElementById('graduated').value = ' ';
};
</script>