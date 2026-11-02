<?php
$manager_list = "";
$manager_query = "SELECT manager_id,manager_name,manager_email FROM managers WHERE access_type='F' AND manager_show=1 ORDER BY manager_name";
$manager_result = mysqli_query($mysqli_link, $manager_query);

while($row = mysqli_fetch_array($manager_result, MYSQLI_NUM))
    {	$db_manager_id    = $row[0];
		$db_manager_name  = $row[1];
		$db_manager_email = $row[2];
		$manager_list .= "<div class='form-group'>
							 <input type='checkbox' name='managers[]' id='".$db_manager_id."' class='forwarding_managers' style='width: 17px; height:17px;' value='".$db_manager_email."'>&nbsp;&nbsp;$db_manager_name
						  </div>";
	}


if(isset($_GET['page_no']) && $_GET['page_no']!="") {
		$page_no = $_GET['page_no'];
	} else {
		$page_no = 1;
    }

	$total_records_per_page = 50;
    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

    $total_no_of_pages = ceil($total_results / $total_records_per_page);
	$second_last = $total_no_of_pages - 1;
//$total_results = 0;

$agenda_count = 0; $cpw_count = 0; $rfp_count = 0; $am_count = 0; $ur_count = 0; $dp_count = 0;


if($_GET['dualsearch'] == 'IS') {
	$searchstring = $_GET['search'];
	//$query_total1 = "SELECT count(*) FROM incumbents_test WHERE incumbent_name LIKE '%$searchstring%' OR website LIKE '%$searchstring%'";

	//$query_total1 = "SELECT count(*) FROM incumbents_test i JOIN excel_test et ON i.opportunity_id = et.opportunity_id AND (i.incumbent_name LIKE '%$searchstring%' OR i.website LIKE '%$searchstring%')";
	$query_total1 = "SELECT count(*) FROM excel_test et JOIN incumbents_test i ON et.opportunity_id = i.opportunity_id AND (i.incumbent_name LIKE '%$searchstring%' OR i.website LIKE '%$searchstring%')$queryurlmode $querystatus $ur_only $queryvehicle $querysetaside $querydecision $querytype $sttype $proposalduedate $releaseddate $start_empty";// ORDER BY et.contract_vehicle, et.status_value, et.creation_timestamp";
//echo $query_total1;
	$total_results = 0;
	$result1 = mysqli_query($mysqli_link, $query_total1);
	while($row1 = mysqli_fetch_array($result1, MYSQLI_NUM))
		{
			$total_results1 = $row1[0];
		}
		$total_results = $total_results1;
}else {
$query_total = "SELECT count(*) FROM excel_test et  
WHERE et.opportunity_id > 0 $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $sttype $proposalduedate $releaseddate $start_empty ORDER BY et.contract_vehicle, et.status_value, et.creation_timestamp";

//$total_results = 0;
$result = mysqli_query($mysqli_link, $query_total);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$total_results2 = $row[0];
	}
	$total_results = $total_results2;

for($bidportal_counter = 0; $bidportal_counter <= 7; $bidportal_counter++) 
{
if ($bidportal_counter==0) {
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum, et.set_aside, et.business_entity, et.addendum_count, et.addendum_seen, et.addendum_date, et.addendum_date_updated FROM excel_test et WHERE et.opportunity_id > 0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $sttype $proposalduedate $releaseddate $start_empty ORDER BY $order $ascdesc LIMIT $offset, $total_records_per_page";
//echo $query;
}

if($bidportal_counter==1) { 
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum, et.set_aside, et.business_entity, et.addendum_count, et.addendum_seen, et.addendum_date, et.addendum_date_updated FROM excel_test et 
WHERE (et.dont_show_agenda = 0 OR et.dont_show_agenda IS NULL) AND et.opportunity_id > 0 $favlist $vehtype $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $proposalduedate $start_empty AND (status_value=1) ORDER BY et.status_value, et.contract_vehicle, et.released ASC LIMIT 300";
}

if($bidportal_counter==2) { 
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum, et.set_aside, et.business_entity, et.addendum_count, et.addendum_seen, et.addendum_date, et.addendum_date_updated FROM excel_test et WHERE et.opportunity_id > 0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $proposalduedate $start_empty AND (status_value=2) ORDER BY et.status_value, et.creation_timestamp ASC LIMIT 300";
}

if($bidportal_counter==3) {  
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum, et.set_aside, et.business_entity, et.addendum_count, et.addendum_seen, et.addendum_date, et.addendum_date_updated FROM excel_test et WHERE et.opportunity_id>0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $proposalduedate $start_empty AND et.status_value=3 ORDER BY 
et.status_value, et.proposal_due ASC LIMIT 300";
}
if($bidportal_counter==4) { 
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum, et.set_aside, et.business_entity, et.addendum_count, et.addendum_seen, et.addendum_date, et.addendum_date_updated FROM excel_test et WHERE et.opportunity_id > 0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $proposalduedate $start_empty AND et.status_value=4 ORDER BY (et.rfp_date IS NULL), et.status_value, et.rfp_date ASC LIMIT 300";
}
if($bidportal_counter==5) { 
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table,et.is_addendum, et.set_aside, et.business_entity, et.addendum_count, et.addendum_seen, et.addendum_date, et.addendum_date_updated FROM excel_test et WHERE et.opportunity_id > 0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $proposalduedate $start_empty AND et.status_value=5 ORDER BY (et.award_date IS NULL), et.status_value, et.award_date ASC LIMIT 300";
}
if($bidportal_counter==6 and $_GET['favshow'] == 'yes') { 
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table FROM excel_test et WHERE et.opportunity_id > 0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $proposalduedate $start_empty AND et.status_value=6 ORDER BY (et.award_date IS NULL), et.status_value, et.award_date ASC LIMIT 300";
}

// Added for addendums.
if($bidportal_counter == 6 ){  
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum, et.set_aside, et.business_entity, et.addendum_count, et.addendum_seen, et.addendum_date, et.addendum_date_updated FROM excel_test et WHERE (et.opportunity_id > 0 AND et.is_addendum=1)$favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $proposalduedate $start_empty AND et.status_value=6 ORDER BY (et.award_date IS NULL), et.status_value, et.award_date ASC ";
}

if($bidportal_counter==7) { 
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum, et.set_aside, et.business_entity, et.addendum_count, et.addendum_seen, et.addendum_date, et.addendum_date_updated FROM excel_test et WHERE et.opportunity_id > 0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $proposalduedate $start_empty AND et.status_value=7 ORDER BY et.status_value, et.proposal_due ASC LIMIT 300";
}
//echo $query;
$addendum_array = [];
$status_reset_counter=0;
$sno_inc = 1;
if($_GET['page_no'])
$sno_inc = $_GET['page_no']*50-(50-1);
$fix_counter=0;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))    
	{
	//echo "<pre>"; print_r($row); //exit;
	$opp_opportunity_id = $row[0];
	//echo $row[0].'<br>';
	$opp_bidopp		= $row[1];
	$opp_response	= $row[2];
	$opp_requestor	= $row[3];
	$opp_title_in	= str_replace("<BR>","",$row[4]); 
		$opp_title  = str_ireplace($urlsearch, '<span style="background-color:#f1b133;">'.strtoupper($urlsearch).'</span>', $opp_title_in);
		$opp_due = strtoupper($row[5]); 
	
	//  $opp_released = strtoupper($row[6]);			
	//	$opp_released = $row[6];
		$opp_released = date("m/d/Y", strtotime($row[6]));
		$opp_released_formatted = $opp_released;
		if (empty($row[6])) { $opp_released=""; $opp_released_formatted=""; } 	

	$opp_pop = $row[7];
	$opp_synopsis_in = str_replace("?<BR>","? ",$row[8]); 
		$opp_synopsis = str_ireplace($urlsearch, '<span style="background-color:#f1b133;">'.strtoupper($urlsearch).'</span>', $opp_synopsis_in);
	$opp_proposal = $row[9]; 
	$opp_pricing = $row[10]; 
	$opp_recruiting_in = $row[11]; 
	
	if ($makeactive==$opp_opportunity_id) { $makeactive1 = "active_bid"; $makeactive2 = "display: block;";  } else { $makeactive1 = ""; $makeactive2 = ""; $anchor=""; }
	//$a = 'How are you?';

		if (strpos($opp_recruiting_in, '|||') !== false) {
				$ok = explode("|||",$opp_recruiting_in);
				
				$i = 0;
				$inloop = 0;
				$opp_recruiting = "";

				$temp_job = "";
				$recruiting_hold = "";
				$recruiting_qty = "";
				$recruiting_ftehrs = "";
				$recruiting_jobtitle = "";
				$recruiting_clearance = "";
				$recruiting_kp = "";

				while($i < count($ok))
				{
					$inloop++;
					//if (($inloop==1) && ((count($ok)-$i)>1)) { $opp_recruiting .= "START";  } 
					if (($inloop==1) && ((count($ok)-$i)>1)) { $opp_recruiting .= "<DIV style='background-color:#fff; border-top:1px solid #d1d1d3; '>"; } 
					if ($inloop==1) { $recruiting_qty = $ok[$i]; $opp_recruiting .= "<div style='width:60px; display:inline-block; vertical-align:top;'>" . $recruiting_qty . " </div>"; }
					if ($inloop==2) { $recruiting_ftehrs = $ok[$i]; $opp_recruiting .= "<div style='width:60px; display:inline-block; vertical-align:top;'>" . $recruiting_ftehrs . " </div>"; }
					if ($inloop==3) { $recruiting_jobtitle = $ok[$i]; }
					if ($inloop==4) { $recruiting_hold = $ok[$i]; }
					if ($inloop==5) { $recruiting_clearance = $ok[$i]; }
					
					if ($inloop==5) { $recruiting_kp = $recruiting_hold; $opp_recruiting .= "<div style='width:340px; display:inline-block; vertical-align:top;'>$recruiting_jobtitle $temp_job<span style='float:right'><i class='fa fa-expeditedssl' style='font-size:14px; margin-left:7px;' title='$recruiting_clearance'></i></span><span style='float:right'>$recruiting_kp</span></div></DIV>"; $inloop=0; }
					
					$i++;
				}
		} else { $opp_recruiting = $opp_recruiting_in; }
	
	$opp_gaps = strtoupper($row[12]);
	$opp_decision = $row[13];
	$pop_parts = explode("|||",$row[14]);
	$contract_pop_address = "";
	$pop_parts = explode("|||",$row[14]);
	$contract_pop_address =  $pop_parts[0];
	
	if (strpos($row[14], '|||')!== false){ $contract_pop_city = $pop_parts[1]; $contract_pop_state = $pop_parts[2]; } else { $contract_pop_state = ""; $contract_pop_city = ""; }
	
	$contract_pop = str_replace("|||",", ",$row[14]);
	$contract_period = strtoupper(str_replace("Period: ","",$row[15])); 
	
	$vehicle_one = $row[16];
	$vehicle_two = $row[17];
	
	$proposal_ida = explode(" ", $vehicle_one); // . " " . $vehicle_two;
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
	
	$set_aside = "";
	//$contract_vehicle = $row[18];
	if((($_POST['vehtype']) != '') && ($bidportal_counter == 1)) {
		$contract_vehicle = $_POST['vehtype'];
	}

	else if(($bidportal_counter != 1) && ($row[18] != '')) {
		$contract_vehicle = $row[18];
	}
	else{
		$exp_veh = explode("|||", $row[38]);
		$contract_vehicle = $exp_veh[0];
	}

	if(($bidportal_counter == 0) && ($row[39])){
			$set_aside = $row[39];
			if($set_aside == '8(a) Competed')
				$set_aside = '8(a) C';
			if($set_aside == 'Small Business')
				$set_aside = 'SB';
			if($set_aside == '8(a) Sole-Source')
				$set_aside = '8(a) SS';
			if($set_aside == 'Unrestricted')
				$set_aside = 'UnR';
			if($set_aside == 'Woman Owned')
				$set_aside = 'WOSB';
			if($set_aside == 'HUBZone')
				$set_aside = 'HUBZone';
			if($set_aside == 'SDVOSB')
				$set_aside = 'SDVOSB';
			if($set_aside == '')
				$set_aside = '';
	}else{
	
// Added for Short Cuts Starts Here.
		if($row[40] != '') {
			$sa = $row[40];
			if($sa == '8(a) Competed')
				$set_aside = '8(a) C';
			if($sa == 'Small Business')
				$set_aside = 'SB';
			if($sa == '8(a) Sole-Source')
				$set_aside = '8(a) SS';
			if($sa == 'Unrestricted')
				$set_aside = 'UnR';
			if($sa == 'Woman Owned')
				$set_aside = 'WOSB';
			if($sa == 'HUBZone')
				$set_aside = 'HUBZone';
			if($sa == 'SDVOSB')
				$set_aside = 'SDVOSB';
			if($sa == '')
				$set_aside = '';
		}
//		$set_aside = $row[40];
// Added for Short Cuts Ends Here.
	}

	if($bidportal_counter != 0){
		$business_entity =  $row[41];
	}
	
	
		$addendum_count = $row[42];
	

	$cssValue = '';
	$addendum_array = json_decode($row[43]);
	$updated_addendum_date = $row[44];
	$addendumdate_updated = $row[45];
	if (is_array($addendum_array) && in_array($_SESSION['user_id'], $addendum_array)) {
		$cssValue = "normal";
	}else{
		$cssValue = "bold";
	}

	if($addendumdate_updated) {
		$updated_addendum_date = "<span class='opp_container99' style='color:#ad00ff;'>&nbsp;&nbsp;".date('m/d/Y', strtotime($updated_addendum_date))."</span>";
	}else{
		$updated_addendum_date = '';
	}

	$opp_status = "<option hidden selected value='" . $row[19] . "'>" . $row[19] . "</option>"; 
	$status_text = $row[19];
	$agency = $row[20];
	$facility = $row[21]; 
	$company_clearance = $row[22];
	
	$proposal_timezone = $row[28];  
	$proposal_timezone_array = explode(" ", $proposal_timezone);
	//$proposal_due = date("m/d/Y H:i:s", strtotime($row[23]));
//	$proposal_due = date("m/d/Y H:i:s", strtotime($row[23]));
	$proposal_due = date("m/d/Y H:i", strtotime($row[23]))."&nbsp;".$proposal_timezone_array[2];
	if(empty($row[23])) { $proposal_due=""; }

	$proposal_due_searchcol = date("m/d/Y", strtotime($row[23]));
	if(empty($row[23])) { $proposal_due_searchcol="&nbsp;"; }

	$qa_due = $row[24];
	$reason = $row[25];
	$manager = "<option hidden selected value='" . $row[26] . "'>" . $row[26] . "</option>";
	$opp_manager = str_replace('"',"",$row[26]);
	$opp_manager = str_replace('[',"",$opp_manager);
	$opp_manager = str_replace(']',"",$opp_manager);
	$opp_manager = str_replace(',',", ",$opp_manager);
	if (strlen($opp_manager)==0) { $opp_manager="&nbsp;"; }
// Code to Display the Managers in short form starts Here.	
	if($opp_manager == 'Anthony Yount')
		$opp_manager = 'Anthony';
	if($opp_manager == 'Aditya Kumar')
		$opp_manager = 'Aditya';
	if($opp_manager == 'Mick Feldmeyer')
		$opp_manager = 'Mick';
	if($opp_manager == 'Holly Knouff')
		$opp_manager = 'Holly';
	if($opp_manager == 'Kristian Willetts')
		$opp_manager = 'Kristian'; 
	if($opp_manager == 'Ron Hartke')
		$opp_manager = 'Ron'; 
	if($opp_manager == 'Rick Neetz')
		$opp_manager = 'Rick'; 
	if($opp_manager == 'Swarna Battula')
		$opp_manager = 'Swarna'; 
// Code to Display the Managers in short form ends Here.
	$qa_timezone = $row[27];
//	$proposal_timezone = $row[28];  
	$contract_vehicle_two = $row[29];
	
	$secondary_address = str_replace("|||",", ",$row[30]); //$row[18];
	
	$status_value = $row[31];
	$entered_in_by = $row[32];
	if (strlen($entered_in_by)<2) { $entered_in_by="&nbsp;"; }
	$creation_date = date("m/d/Y",strtotime($row[33]));
	$creation_timestamp1 = date("h:i:s",strtotime($row[33]));
	$transition_notes = $row[34];
	
	//$opp_award_date = $row[35];
	//$opp_rfp_date = $row[36]; 
	
		$opp_award_date = $row[35];
		$opp_award_date = date("m/d/Y", strtotime($opp_award_date));
		if (empty($row[35])) { $opp_award_date=""; }  
	
		$opp_rfp_date = $row[36];
		$opp_rfp_date = date("m/d/Y", strtotime($opp_rfp_date));
		if (empty($row[36])) { $opp_rfp_date=""; }
		
		$est_pop_start_date = $row[37];
		$est_pop_start_date = date("m/d/Y", strtotime($est_pop_start_date));
		if (empty($row[37])) { $est_pop_start_date=""; } 
$addendum = "";		
$addendumValue = $row[39];
		if($addendumValue and $addendum_count){
			//<i class='fa fa-flag' aria-hidden='true' style='color:#ff0000'></i>;
			$addendum = "&nbsp;&nbsp;<span id='addendum".$opp_opportunity_id."'. class='opp_container99' style='font-weight: $cssValue; font-size: 14px; color: blue;'>A<sup>$addendum_count</sup></span>"; 
		}
		$creation_timestamp_set = new DateTime($creation_timestamp_db);
		$creation_timestamp = $creation_timestamp_set->format('M j, Y h:i:s');
	
	
	$opp_synopsis_cropped =  substr($opp_synopsis,0,200); 
	
	
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
	$status_reset_counter++;
	$fix_counter++;
	
	$header_opp = "<div style='display:inline-block; width:50px; vertical-align:top;'>#</div>
				<div style='display:inline-block; width:114px; vertical-align:top;'>Release Date</div>
				<div style='display:inline-block; width:110px; vertical-align:top;'>&nbsp;</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Vehicle</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Type</div>
				<div style='display:inline-block; width:160px;'>Manager</div>
				<div style='display:inline-block; vertical-align:top;'>Title</div>";
				
	
	if($urlmode == 'Opportunities') { $table_details = ""; } else { 
		//$starting_table=$status_text; $type_change++; 
		
		$header_cpw = "<div style='display:inline-block; width:40px; vertical-align:top;'>#</div>
				<div style='display:inline-block; width:114px; vertical-align:top;'>Proposal Due</div>
				<div style='display:inline-block; width:110px; vertical-align:top;'>&nbsp;</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Vehicle</div>
				<div style='display:inline-block; width:63px; vertical-align:top;'>Type</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Set-Aside</div>
				<div style='display:inline-block; width:160px;'>Manager</div>
				<div style='display:inline-block; vertical-align:top;'>Title</div>
				";
		
		$header_rfp = "<div style='display:inline-block; width:40px; vertical-align:top;'>#</div>
				<div style='display:inline-block; width:114px; vertical-align:top;'>RFP Exp.Date</div>
				<div style='display:inline-block; width:110px; vertical-align:top;'>&nbsp;</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Vehicle</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Type</div>
				<div style='display:inline-block; width:160px;'>Manager</div>
				<div style='display:inline-block; width:270px; vertical-align:top;'>Title</div>
				<div style='display:inline-block; vertical-align:top;'>Business Entity</div>";
				
		$header_award = "<div style='display:inline-block; width:40px; vertical-align:top;'>#</div>
				<div style='display:inline-block; width:114px; vertical-align:top;'>Award Date</div>
				<div style='display:inline-block; width:110px; vertical-align:top;'>Est. PoP Start</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Vehicle</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Type</div>
				<div style='display:inline-block; width:160px;'>Manager</div>
				<div style='display:inline-block; width:270px; vertical-align:top;'>Title</div>
				<div style='display:inline-block; vertical-align:top;'>Business Entity</div>";
				
		
		$agenda_ts = ""; $ur_ts=""; $cpw_ts=""; $rfp_ts=""; $award_ts=""; $award_bottom="";
		
		if ($table_show_agenda==0) { $agenda_ts = "<div class='bp_label' style=''>Agenda Item</div>
<div class='title_bar'>$header_all</div>"; $table_show_agenda=1; 
		}
														
		if (($status_value>2) and ($table_show_cpw==0)) { $cpw_ts = "<div class='bp_label' style='margin-top:20px;'>Current Proposal Workload</div>
<div class='title_bar'>$header_cpw</div>"; $table_show_cpw=1;
														}
														
		if (($status_value==4) and ($table_show_rfp==0)) { //$rfp_ts = "<div class='bp_label' style='margin-top:20px;'>RFP Tracking</div>
//<div class='title_bar'>//$header_rfp</div>"; $table_show_rfp=1; 
														}
														
		if (($status_value==5) and ($table_show_award==0)) { //$award_ts = "<div class='bp_label' style='margin-top:20px;'>Award Monitoring</div><div class='title_bar'>$header_award</div>";  $table_show_award=1; $award_bottom="margin-bottom:10px;";
		}
																	
		if (($status_value>6) and ($table_show_ur==0)) { 
		$ur_ts = "<div class='bp_label' style='margin-top:20px;'>Under Review</div>
<div class='title_bar'>$header_cpw</div>"; $table_show_ur=1;
													}
							
	$table_details = $agenda_ts . $cpw_ts . $rfp_ts . $award_ts . $ur_ts;
	}
	
	$manager_selector = "<select name='manager' id='manager_edit$opp_opportunity_id' size='1' style='padding:2px 5px; width:150px; border:1px solid #f0f0f0;' onchange=\"blurfunctiondecision('manager',this.value, $opp_opportunity_id)\">
				  $manager
				  <option value=''></option>
				  $manager_list
				</select>";


// Added To Fetch Decision Pending Opportunities.
$decision_pending_query = "SELECT count(*) FROM excel_test WHERE decision='Decision Pending'";
$decision_pending_query_result = mysqli_query($mysqli_link, $decision_pending_query);
$decision_pending_query_count = mysqli_fetch_array($decision_pending_query_result, MYSQLI_NUM);
if($decision_pending_query_count[0] > 0){
	$table_content_h = "<div class='bp_label' style='margin-top:20px;'>Decision Pending&nbsp;<span id='dpItemCount'><span></div><div class='title_bar'>$header_decision_pending</div>";
}
// Ends Here.
				
	if (($urlmode=='Agenda') && ($status_value==6)) { $archive_hide="display:none;"; } else { $archive_hide=""; }
	if (($status_value==6)) { $is_archived=1; } else { $is_archived=0; }		
	//collapsible_bid
	$dynamic_date_column = "<div style='display:inline-block; width:108px; vertical-align:top;'>$opp_released_formatted</div>";

	//$dynamic_date_column_b = "<div style='display:inline-block; width:114px; vertical-align:top;'>&nbsp;</div>";
	//$dynamic_date_column_b = "<div class='col' style='display:inline-block; width:114px; vertical-align:top;'>&nbsp;</div>";
	if (($status_value == 3) || ($status_value == 7))  { $dynamic_date_column = "<div class='col' style='display:inline-block; width:124px; vertical-align:top;'>$proposal_due</div>"; }
	if (($status_value == 4))  { $dynamic_date_column = "<div class='col' style='display:inline-block; width:120px; vertical-align:top;'>$opp_rfp_date</div>"; }
	if (($status_value == 5))  { $dynamic_date_column = "<div class='col' style='display:inline-block; width:120px; vertical-align:top;'>$opp_award_date</div>"; 
		$dynamic_date_column_b = "<div class='col' style='display:inline-block; width:114px; vertical-align:top;'>$est_pop_start_date</div>";
								}
	
if($_GET['type'][0] == 'Forecast'){
	$firstColumnValue  = $opp_rfp_date;
	$secondColumnValue = $creation_date;//."<br/>".$creation_timestamp1;
}else{
	$firstColumnValue  = $opp_released;
	$secondColumnValue = $proposal_due_searchcol;
}

//OPP - search details
if($bidportal_counter == 0) {  
$table_content_opp .= "<div>$table_details</div>

<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
<div onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='' style='/*padding: 6px; background-color:#fff;*/'>
	<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$sno_inc</div>
	<div style='display:inline-block; width:120px; vertical-align:top;'>$firstColumnValue</div>
	<div style='display:inline-block; width:120px; vertical-align:top;'>$secondColumnValue</div>
	<div style='display:inline-block; width:120px; vertical-align:top;'>$contract_vehicle</div>
	<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_response</div>
	<div style='display:inline-block; width:120px; vertical-align:top;'>$set_aside</div>
	<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:99px;'>$opp_manager</div>
	<div style='display:inline-block;  vertical-align:top; width:353px;'>$opp_title &nbsp;&nbsp; $addendum $updated_addendum_date</div>
	<div style='display:inline-block; vertical-align:top; width:111px; text-align: center;'>$opp_decision</div>
	
</div>
</div>
<div id='" . $opp_opportunity_id . "' style='display:none;'></div>
";
}

//AGENDA ITEM
if (($bidportal_counter == 1) && ($status_value == 1)) { 
//$table_content_new .= "GREAT " . $bidportal_counter . " " . $status_reset_counter; 
$table_content_a .= "<div>$table_details</div>
<div id='tableBody'>
<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
	<div class='div-table row' data-sno='".$status_reset_counter."' data-vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-set_aside='".$set_aside."' data-release='".$opp_released_formatted."' data-sub_due_date='".$opp_released_formatted."' data-manager='".$opp_manager."' data-title='".$opp_title."' data-business_entity='".$business_entity."' onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container'>
			<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>
			<div style='display:inline-block; width:90px;'>$contract_vehicle</div>"
			. $dynamic_date_column . 
			"<div style='display:inline-block; width:153px; vertical-align:top;'>$proposal_due</div>
			<!-- <div  style='display:inline-block; width:60px;'>&nbsp;</div> -->  
			<div style='display:inline-block; width:72px;'>$opp_response</div>
			<div style='display:inline-block; width:81px;'>$set_aside</div>
			<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:81px;'>$opp_manager</div>
			<div style='display:inline-block; width:549px;  vertical-align:top;'>$opp_title &nbsp; $addendum $updated_addendum_date
			&nbsp;<img id='forwardImg' src='images/farward_image.png' style='height:18px;' onclick=\"displayMessage($opp_opportunity_id)\">
			</div>
			<div style='display:inline-block; width:130px;  vertical-align:top;'>$business_entity</div>			
	</div>
</div>

<div class='div-table row' data-sno='".$status_reset_counter."' data-vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-set_aside='".$set_aside."' data-release='".$opp_released_formatted."' data-sub_due_date='".$opp_released_formatted."' data-manager='".$opp_manager."' data-title='".$opp_title."' data-business_entity='".$business_entity."' id='" . $opp_opportunity_id . "' style='display:none;'></div>
</div> <!-- closure of 'tableBody' div -->";
$agenda_count++;
}
//CURRENT PROPOSAL WORKLOAD
if (($bidportal_counter == 3) && ($status_value == 3)) { 
//$table_content_new .= "GREAT " . $bidportal_counter . " " . $status_reset_counter; 
$table_content_b .= "<div>$table_details</div>
<div id='tableBody3'>
<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
	<div class='div-table3 row' data-sno='".$status_reset_counter."' data-prop_due='".$proposal_due."' data-vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-set_aside='".$set_aside."' data-manager='".$opp_manager."' data-title='".$opp_title."' data-business_entity='".$business_entity."' onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
			<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>
			<!-- //. $dynamic_date_column . -->
			<div style='display:inline-block; width:153px; vertical-align:top;'>$proposal_due</div>
			<div style='display:inline-block; width:120px; margin-bottom: 6px; vertical-align:top;'>$contract_vehicle</div>
			<div style='display:inline-block; width:72px; vertical-align:top;'>$opp_response</div>
			<div style='display:inline-block; width:81px;'>$set_aside</div>
			<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:81px;'>$opp_manager</div>
			<div style='display:inline-block; width:549px;  vertical-align:top;'>$opp_title &nbsp;&nbsp; $addendum $updated_addendum_date
			&nbsp;<img src='images/farward_image.png' style='height: 18px;' onclick=\"displayMessage($opp_opportunity_id)\">
			</div>
			<div style='display:inline-block; width:130px;  vertical-align:top;'>$business_entity</div>			
	</div>
</div>
</div> <!-- closure of 'tableBody3' div -->
<div class='div-table3 row' data-sno='".$status_reset_counter."' data-prop_due='".$proposal_due."' data-vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-set_aside='".$set_aside."' data-manager='".$opp_manager."' data-title='".$opp_title."' data-business_entity='".$business_entity."' id='" . $opp_opportunity_id . "' style='display:none;'></div>";
$cpw_count++;
}
//RFP TRACKING
if (($bidportal_counter == 4) && ($status_value == 4)) { 
//$table_content_new .= "GREAT " . $bidportal_counter . " " . $status_reset_counter; 
$table_content_c .= "<div>$table_details</div>
<div id='tableBody1'>
<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
		<div class='div-table1 row' data-sno='".$fix_counter."' data-rfp_exp_date='".$opp_rfp_date."' data-rfp_vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-set_aside='".$set_aside."' data-manager='".$opp_manager."' data-title='".$opp_title."' data-business_entity='".$business_entity."' onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
				<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$fix_counter</div>
				<!-- . $dynamic_date_column .  -->
				<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_rfp_date</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>$contract_vehicle</div>
				<div style='display:inline-block; width:72px; vertical-align:top;'>$opp_response</div>
				<div style='display:inline-block; width:81px;'>$set_aside</div>
				<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:81px;'>$opp_manager</div>
				<div style='display:inline-block; width:549px; vertical-align:top;'>$opp_title &nbsp;&nbsp; $addendum $updated_addendum_date
				&nbsp;<img src='images/farward_image.png' style='height: 18px;' onclick=\"displayMessage($opp_opportunity_id)\">
				</div>
				<div style='display:inline-block; width:130px;  vertical-align:top;'>$business_entity</div>
		</div>
	</div>
	</div> <!-- closure of 'tableBody1' div -->
<div class='div-table1 row' data-sno='".$fix_counter."' data-rfp_exp_date='".$opp_rfp_date."' data-rfp_vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-set_aside='".$set_aside."' data-manager='".$opp_manager."' data-title='".$opp_title."' data-business_entity='".$business_entity."' id='" . $opp_opportunity_id . "' style='display:none;'></div>";
$rfp_count++;
}
//AWARD MONITORING
if (($bidportal_counter == 5) && ($status_value == 5)) { 
//$table_content_new .= "GREAT " . $bidportal_counter . " " . $status_reset_counter; 
$table_content_d .= "<div>$table_details</div>
<div id='tableBody2'>
	<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
	-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
	box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
	$archive_hide'>
				<div class='div-table2 row' data-sno='".$status_reset_counter."' data-award_date='".$opp_award_date."' data-est_pop_date='".$est_pop_start_date."' data-vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-title='".$opp_title."' data-set_aside='".$set_aside."' data-manager='".$opp_manager."' data-business_entity='".$business_entity."' onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
						<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>
						 <!-- . $dynamic_date_column . $dynamic_date_column_b .  -->
						<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_award_date</div>
						<div style='display:inline-block; width:114px; vertical-align:top;'>$est_pop_start_date</div>
						<div style='display:inline-block; width:120px; vertical-align:top;'>$contract_vehicle</div>
						<div style='display:inline-block; width:81px; vertical-align:top;'>$opp_response</div>
						<div style='display:inline-block; width:99px;'>$set_aside</div>
						<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:81px;'>$opp_manager</div>
						<div style='display:inline-block; width:549px; vertical-align:top;'>$opp_title &nbsp;&nbsp; $addendum $updated_addendum_date
						&nbsp;<img src='images/farward_image.png' style='height: 18px;' onclick=\"displayMessage($opp_opportunity_id)\">
						</div>
						<div style='display:inline-block; width:135px; vertical-align:top;'>$business_entity</div>	
				</div>
			</div>
  </div> <!-- closure of 'tableBody2' div -->
		<div class='div-table2 row' data-sno='".$status_reset_counter."' data-award_date='".$opp_award_date."' data-est_pop_date='".$est_pop_start_date."' data-vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-title='".$opp_title."' data-set_aside='".$set_aside."' data-manager='".$opp_manager."' data-business_entity='".$business_entity."' id='" . $opp_opportunity_id . "' style='display:none;'></div>";
		$am_count++;
}

//UNDER REVIEW
if (($bidportal_counter == 7) && ($status_value == 7)) {  
$table_content_e .= "<div>$table_details</div>
<div id='tableBody4'>
<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
	<div class='div-table4 row' data-sno='".$status_reset_counter."' data-prop_due='".$proposal_due."' data-vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-set_aside='".$set_aside."' data-manager='".$opp_manager."' data-title='".$opp_title."' data-business_entity='".$business_entity."' onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
			<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>
			<div style='display:inline-block; width:144px; vertical-align:top;'>$proposal_due</div>
			<!-- . $dynamic_date_column . -->
			<div style='display:inline-block; width:117px; vertical-align:top;'>$contract_vehicle</div>
			<div style='display:inline-block; width:72px; vertical-align:top;'>$opp_response</div>
			<div style='display:inline-block; width:81px; vertical-align:top;'>$set_aside</div>
			<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:81px;'>$opp_manager</div>
			<div style='display:inline-block; width:549px;  vertical-align:top;'>$opp_title &nbsp;&nbsp; $addendum $updated_addendum_date
			&nbsp;<img src='images/farward_image.png' style='height: 18px;' onclick=\"displayMessage($opp_opportunity_id)\">
			</div>
			<div style='display:inline-block; width:130px; vertical-align:top;'>$business_entity</div>				
	</div>
	</div>
</div>  <!-- closure of 'tableBody4' div -->
<div class='div-table4 row' data-sno='".$status_reset_counter."' data-prop_due='".$proposal_due."' data-vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-set_aside='".$set_aside."' data-manager='".$opp_manager."' data-title='".$opp_title."' data-business_entity='".$business_entity."' id='" . $opp_opportunity_id . "' style='display:none;'></div>";
$ur_count++;
}

//ARCHIEVE IN MY FAVLIST PAGE
if (($bidportal_counter == 6) and ($status_value == 6) and $_GET['favshow'] == 'yes') { 
//$table_content_new .= "GREAT " . $bidportal_counter . " " . $status_reset_counter; 
$table_content_f .= "<div>$table_details</div>

	<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
	-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
	box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
	'>
				<div onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
						<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>"
						. $dynamic_date_column .
						"<div style='display:inline-block; width:120px; vertical-align:top;'>$contract_vehicle</div>
						<div style='display:inline-block; width:72px; vertical-align:top;'>$opp_response</div>
						<div style='display:inline-block; width:81px;'>$set_aside</div>
						<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:81px;'>$opp_manager</div>
						<div style='display:inline-block; width:calc(100% - 730px);  vertical-align:top;'>$opp_title</div>
						
				</div>
			</div>
		<div id='" . $opp_opportunity_id . "' style='display:none;'></div>
		";
}

//  ARCHIVED & HAVING ADDENDUMS.
/*if (($bidportal_counter == 6) and ($status_value == 6)) { 
$table_content_g .=  "<div>$table_details</div>  
  <div id='tableBody5'>
	<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
	-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
	box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35); '>
				<div class='div-table5 row' data-sno='".$status_reset_counter."' data-vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-set_aside='".$set_aside."' data-manager='".$opp_manager."' data-title='".$opp_title."' data-business_entity='".$business_entity."' onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container' style='padding: 6px; background-color:#fff;'>
						<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>"
						. $dynamic_date_column .
						"<div style='display:inline-block; width:120px; vertical-align:top;'>$contract_vehicle</div>
						<div style='display:inline-block; width:72px; vertical-align:top;'>$opp_response</div>
						<div style='display:inline-block; width:81px;'>$set_aside</div>
						<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:81px;'>$opp_manager</div>
						<div style='display:inline-block; width:549px;  vertical-align:top;'>$opp_title &nbsp;&nbsp; $addendum</div>
						<div style='display:inline-block; width:130px; vertical-align:top;'>$business_entity</div>	
				</div>
			</div>
     </div>  <!-- closure of 'tableBody5' div -->
		<div class='div-table5 row' data-sno='".$status_reset_counter."' data-vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-set_aside='".$set_aside."' data-manager='".$opp_manager."' data-title='".$opp_title."' data-business_entity='".$business_entity."' id='" . $opp_opportunity_id . "' style='display:none;'></div>";
} */
// Added for Archived & ADDENDUMS Ends Here.



$sno_inc++;
}

}	

}


// DECISION PENDING / HOLD.
$decision_pending_query = "SELECT et.proposal_due, et.contract_vehicle, et.response, et.set_aside, et.manager, et.title,  et.opportunity_id FROM excel_test et WHERE et.decision='Decision Pending'";
$decision_pending_query_result = mysqli_query($mysqli_link, $decision_pending_query);
//$decision_pending_query_count = mysqli_fetch_array($decision_pending_query_result, MYSQLI_NUM);
$sno_inc = 1;
   while($row1 = mysqli_fetch_array($decision_pending_query_result, MYSQLI_NUM))    
		{ //print_r($row1);
//if($decision_pending_query_count[0] > 0){
	//$table_content_h = "<div class='bp_label' style='margin-top:20px;'>Decision Pending</div><div class='title_bar'>$header_cpw</div>";
			$opp_opportunity_id = $row1[6];
			$proposal_due = date('m/d/Y',strtotime($row1[0]));
			$vehicle	  = $row1[1];
			$type		  = $row1[2];
//			$set_aside	  = $row1[3];
// Added for Short Cuts Starts Here. 
			if($row1[3] != '') {
			$sa = $row1[3];
			if($sa == '8(a) Competed')
				$set_aside = '8(a) C';
			if($sa == 'Small Business')
				$set_aside = 'SB';
			if($sa == '8(a) Sole-Source')
				$set_aside = '8(a) SS';
			if($sa == 'Unrestricted')
				$set_aside = 'UnR';
			if($sa == 'Woman Owned')
				$set_aside = 'WOSB';
			if($sa == 'HUBZone')
				$set_aside = 'HUBZone';
			if($sa == 'SDVOSB')
				$set_aside = 'SDVOSB';
		}
// Added for Short Cuts Ends Here.
			$manager	  = $row1[4];
// Code to Display the Managers in short form starts Here.	
	if($row1[4] != '') {
		$opp_manager	 = $row1[4];
	}
	if($opp_manager == 'Anthony Yount')
		$opp_manager = 'Anthony';
	if($opp_manager == 'Aditya Kumar')
		$opp_manager = 'Aditya';
	if($opp_manager == 'Mick Feldmeyer')
		$opp_manager = 'Mick';
	if($opp_manager == 'Holly Knouff')
		$opp_manager = 'Holly';
	if($opp_manager == 'Kristian Willetts')
		$opp_manager = 'Kristian'; 
	if($opp_manager == 'Ron Hartke')
		$opp_manager = 'Ron'; 
	if($opp_manager == 'Rick Neetz')
		$opp_manager = 'Rick'; 
	if($opp_manager == 'Swarna Battula')
		$opp_manager = 'Swarna'; 
// Code to Display the Managers in short form ends Here.
			$title		  = $row1[5];

	$table_content_h .= "<div>$table_details</div>

<div id='tableBody6'>
<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35); '>
	<div class='div-table6 row' data-sno='".$sno_inc."' data-vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-set_aside='".$set_aside."' data-manager='".$opp_manager."' data-title='".$title."' data-business_entity='".$business_entity."' onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
			<div style='display:inline-block; width:40px; vertical-align:top; padding-left:8px;'>$sno_inc</div>
			<div style='display:inline-block; width:123px; vertical-align:top; padding-left:8px;'>$proposal_due</div>
			<!-- <div style='display:inline-block; width:110px; vertical-align:top; padding-left:8px;'>&nbsp;</div>  -->
			<div style='display:inline-block; width:130px; margin-bottom: 6px; vertical-align:top;'>$vehicle</div>
			<div style='display:inline-block; width:72px; vertical-align:top;'>$type</div>
			<div style='display:inline-block; width:99px; vertical-align:top;'>$set_aside</div>
			<div style='display:inline-block; width:117px; vertical-align:top;'>$opp_manager</div>
			<div style='display:inline-block; width:549px;  vertical-align:top;'>$title &nbsp;&nbsp; $addendum $updated_addendum_date
			&nbsp;<img src='images/farward_image.png' style='height: 18px;' onclick=\"displayMessage($opp_opportunity_id)\">
			</div>
			<div style='display:inline-block; width:130px; vertical-align:top;'>$business_entity</div>	
	</div>
</div>
</div>  <!-- closure of 'tableBody6' div -->

<div class='div-table6 row' data-sno='".$sno_inc."' data-vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-set_aside='".$set_aside."' data-manager='".$opp_manager."' data-title='".$title."' data-business_entity='".$business_entity."' id='" . $opp_opportunity_id . "' style='display:none;'></div>";
  $sno_inc ++;
		
		$dp_count++;
//}
		}
// DECISION PENDING / HOLD  Ends Here.





$incumbents_filter_data = '';
if($_GET['dualsearch'] == 'IS') {
	$searchstring = $_GET['search'];
//	$query1 = "SELECT incumbent_id,opportunity_id,incumbent_name,website FROM incumbents_test WHERE incumbent_name LIKE '%$searchstring%' OR website LIKE '%$searchstring%'";
   // $query1 = "SELECT et.released,et.proposal_due,et.contract_vehicle,et.response,et.manager,et.title,et.decision,i.incumbent_id,i.opportunity_id,i.incumbent_name FROM incumbents_test i JOIN excel_test et ON i.opportunity_id = et.opportunity_id AND (i.incumbent_name LIKE '%$searchstring%' OR i.website LIKE '%$searchstring%')"; 
    $query1 = "SELECT et.released,et.proposal_due,et.contractveh_table,et.response,et.manager,et.title,et.decision,i.incumbent_id,i.opportunity_id,i.incumbent_name FROM excel_test et JOIN incumbents_test i ON i.opportunity_id = et.opportunity_id AND (i.incumbent_name LIKE '%$searchstring%' OR i.website LIKE '%$searchstring%')$queryurlmode $querystatus $ur_only $queryvehicle $querysetaside $querydecision $querytype $sttype $proposalduedate $releaseddate $start_empty ORDER BY et.contract_vehicle, et.status_value, et.creation_timestamp DESC LIMIT $offset, $total_records_per_page"; 
//echo "<br/>".$query1;
$sno_inc = 1;
if($_GET['page_no'])
$sno_inc = $_GET['page_no']*50-(50-1);
	$result1 = mysqli_query($mysqli_link, $query1);
    while($row1 = mysqli_fetch_array($result1, MYSQLI_NUM))    
		{  
			$opp_release_date   = date('m/d/Y', strtotime($row1[0]));
//			if($row[1] != ''){$proposal_due_date	= date('m/d/Y', strtotime($row1[1]));} else {
//			$proposal_due_date = "";}

if($row1[1] != ''){
			$proposal_timezone = $row1[1];  
	$proposal_timezone_array = explode(" ", $proposal_timezone);
	//$proposal_due = date("m/d/Y H:i:s", strtotime($row[23]));
//	$proposal_due = date("m/d/Y H:i:s", strtotime($row[23]));
	$proposal_due = date("m/d/Y H:i", strtotime($row1[1]))."&nbsp;".$proposal_timezone_array[2];
}else{ $proposal_due = ''; }
//			$proposal_due_date	= $row1[1];
			$vehicle = explode("|||", $row1[2]);
			$contract_vehicle = $vehicle[0];

//			$contract_vehicle	= $row1[2];
			$status				= $row1[3];
			$manager			= $row1[4];
			$decision			= $row1[6];
			$opp_title			= $row1[5];
			$incumbent_id		= $row1[7];
			$opportunity_id		= $row1[8];
			$incumbent_title	= $row1[9];
			$incumbent_website  = $row1[10];

	$incumbents_filter_data .=	"<div>$table_details</div>
	<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
<div onclick=\"showajaxopp(" . $opportunity_id . ")\"  id='opportunity_container" . $opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
	<div style='display:inline-block; width:36px; vertical-align:top; padding-left:8px;'>$sno_inc</div>
	<div style='display:inline-block; width:99px; vertical-align:top;'>$opp_release_date</div>
	<div style='display:inline-block; width:99px; vertical-align:top;'>$proposal_due</div>
	<div style='display:inline-block; width:99px; vertical-align:top;'>$contract_vehicle</div>
	<div style='display:inline-block; width:99px; vertical-align:top;'>$status</div>
	<div style='display:inline-block; width:99px; vertical-align:top;'>$manager</div>
	<div style='display:inline-block; width:189px; vertical-align:top;'>$opp_title</div>
	<div style='display:inline-block; width:99px; vertical-align:top;text-align: center;'>$decision</div>
	<div style='display:inline-block; width:375px; vertical-align:top;'>$incumbent_title</div>
</div>
</div>
<div id='" . $opportunity_id . "' style='display:none;'></div>";
  $sno_inc ++;
}
		}	
?>


<div id='formOverlay'>
	<div id='changePasswordForm'>
		<span id='closeForm'>&times;</span>
		<h3>Managers</h3>
		<form name='managers_form' method='POST' action='forward_managers.php'>
			<?=$manager_list?>
			<input type='hidden' name='opportunityId' id='frd_oppid' value=''>
			<button type='submit' class='submit-btn' id='manager_submit'>Submit</button>
		</form>
	</div>
</div>