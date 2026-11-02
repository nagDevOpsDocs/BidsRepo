<?php
//echo "<br/><br/>Selected Opportunity Type Is :: ".$_GET['type'][0];
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

if($_GET['dualsearch'] == 'IS') {
	$searchstring = $_GET['search'];
	//$query_total1 = "SELECT count(*) FROM incumbents_test WHERE incumbent_name LIKE '%$searchstring%' OR website LIKE '%$searchstring%'";

	//$query_total1 = "SELECT count(*) FROM incumbents_test i JOIN excel_test et ON i.opportunity_id = et.opportunity_id AND (i.incumbent_name LIKE '%$searchstring%' OR i.website LIKE '%$searchstring%')";
	$query_total1 = "SELECT count(*) FROM excel_test et JOIN incumbents_test it ON et.opportunity_id = it.opportunity_id WHERE (et.dont_show_agenda = 1 AND et.contract_vehicle = 'MA - IDIQ') AND (it.incumbent_name LIKE '%$searchstring%')$queryurlmode $querystatus $ur_only $queryvehicle $querysetaside $querydecision $querytype $sttype $ron_cp_date $tyler_cp_date $team_cp_date $contract_exp_date $start_empty";// ORDER BY et.contract_vehicle, et.status_value, et.creation_timestamp";
//echo $query_total1;
	$total_results = 0;
	$result1 = mysqli_query($mysqli_link, $query_total1);
	while($row1 = mysqli_fetch_array($result1, MYSQLI_NUM))
		{
			$total_results1 = $row1[0];
		}
		$total_results = $total_results1;
}else {
$query_total = "SELECT count(*) FROM excel_test et LEFT JOIN incumbents_test it ON et.opportunity_id = it.opportunity_id
WHERE (et.dont_show_agenda = 1 AND et.contract_vehicle = 'MA - IDIQ') AND et.opportunity_id > 0 $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $sttype $ron_cp_date $tyler_cp_date $team_cp_date $contract_exp_date $foia_req_sub_date $foia_info_receiv_date $start_empty ORDER BY et.contract_vehicle, et.status_value, et.creation_timestamp";
//$total_results = 0;
$result = mysqli_query($mysqli_link, $query_total);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
		$total_results2 = $row[0];
	}
	$total_results = $total_results2;

for($bidportal_counter = 0; $bidportal_counter <= 8; $bidportal_counter++) 
{ 
if ($bidportal_counter==0) {
$query = "SELECT et.opportunity_id,et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis,
et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, 
et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager,
et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, 
et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum,
et.set_aside, it.ultimate_completion_date, it.award_amount, et.naics_code, it.incumbent_name, it.graduated, et.ron_cp_date, et.tyler_cp_date, et.team_cp_date
FROM excel_test et LEFT JOIN incumbents_test it ON et.opportunity_id = it.opportunity_id  WHERE (et.dont_show_agenda = 1 AND et.contract_vehicle = 'MA - IDIQ') AND et.opportunity_id > 0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $sttype $ron_cp_date $tyler_cp_date $team_cp_date $contract_exp_date $foia_req_sub_date $foia_info_receiv_date $start_empty ORDER BY $order $ascdesc LIMIT $offset, $total_records_per_page"; 
//echo $query;exit;
}

if($bidportal_counter == 1) { 
/*
			$cp_date_cond = '';
	if($_SESSION['user_id'] == USER_RON){
		$cp_date_cond = " AND et.ron_cp_date = curdate()";
	}
	else if($_SESSION['user_id'] == USER_TYLER){
		$cp_date_cond = " AND et.tyler_cp_date = curdate()";
	}else{
		$cp_date_cond = " AND et.team_cp_date = curdate()";
	} */
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis,
et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, 
et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager,
et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, 
et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum,
et.set_aside, it.ultimate_completion_date, it.award_amount, et.naics_code, it.incumbent_name, it.graduated, et.ron_cp_date, et.tyler_cp_date, et.team_cp_date
FROM excel_test et LEFT JOIN incumbents_test it ON et.opportunity_id = it.opportunity_id WHERE (et.dont_show_agenda = 1 AND et.contract_vehicle = 'MA - IDIQ') AND et.opportunity_id > 0 $favlist $vehtype $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $start_empty AND (et.status_value=1) ORDER BY STR_TO_DATE(it.ultimate_completion_date, '%m/%d/%Y') ASC LIMIT 300";
//echo $query;exit;
}
/*
if($bidportal_counter==2) { 
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum, et.set_aside FROM excel_test et WHERE (et.dont_show_agenda = 1 AND et.bid_category = '8a_direct')AND et.opportunity_id > 0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $ron_cp_date $start_empty AND (et.status_value=2) ORDER BY et.status_value, et.creation_timestamp ASC LIMIT 300";
}

if($bidportal_counter==3) {  
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum, et.set_aside FROM excel_test et WHERE (et.dont_show_agenda = 1 AND et.bid_category = '8a_direct')AND et.opportunity_id>0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $ron_cp_date $start_empty AND et.status_value=3 ORDER BY 
et.status_value, et.proposal_due ASC LIMIT 300";
} */
if($bidportal_counter==4) { 
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum, et.set_aside FROM excel_test et WHERE (et.dont_show_agenda = 1 AND et.contract_vehicle = 'MA - IDIQ') AND et.opportunity_id > 0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $start_empty AND et.status_value=4 ORDER BY (et.rfp_date IS NULL), et.status_value, et.rfp_date ASC LIMIT 300";
}
/*
if($bidportal_counter==5) { 
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis,
et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, 
et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager,
et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, 
et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum,
et.set_aside, it.ultimate_completion_date, it.award_amount, et.naics_code, it.incumbent_name, it.graduated, et.ron_cp_date, et.tyler_cp_date, et.team_cp_date
FROM excel_test et LEFT JOIN incumbents_test it ON et.opportunity_id = it.opportunity_id WHERE (et.dont_show_agenda = 1 AND et.contract_vehicle = 'MA - IDIQ') AND et.opportunity_id > 0 $favlist $vehtype $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $start_empty AND (et.status_value=5) ORDER BY STR_TO_DATE(it.ultimate_completion_date, '%m/%d/%Y') ASC LIMIT 300";
} 
if($bidportal_counter==6 and $_GET['favshow'] == 'yes') { 
$query = "SELECT et.opportunity_id,et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis,
et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, 
et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager,
et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, 
et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum,
et.set_aside, it.ultimate_completion_date, it.award_amount, et.naics_code, it.incumbent_name, it.graduated, et.ron_cp_date, et.tyler_cp_date, et.team_cp_date
FROM excel_test et LEFT JOIN incumbents_test it ON et.opportunity_id = it.opportunity_id WHERE (et.dont_show_agenda = 1 AND et.contract_vehicle = 'MA - IDIQ') AND et.opportunity_id > 0 $favlist $vehtype $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $start_empty AND (et.status_value=6) ORDER BY STR_TO_DATE(it.ultimate_completion_date, '%m/%d/%Y') ASC LIMIT 300";
}
// Added for addendums.
if($bidportal_counter == 6 ){  
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum, et.set_aside FROM excel_test et WHERE (et.dont_show_agenda = 1 AND et.bid_category = '8a_direct' AND et.opportunity_id > 0 AND et.is_addendum=1)$favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $ron_cp_date $start_empty AND et.status_value=6 ORDER BY (et.award_date IS NULL), et.status_value, et.award_date ASC ";
}
*/
// UNDER REVIEW SECTION.
if($bidportal_counter==7) { 
/*			$cp_date_cond = '';
	if($_SESSION['user_id'] == USER_RON){
		$cp_date_cond = " AND et.ron_cp_date = curdate()";
	}
	else if($_SESSION['user_id'] == USER_TYLER){
		$cp_date_cond = " AND et.tyler_cp_date = curdate()";
	}else{
		$cp_date_cond = " AND et.team_cp_date = curdate()";
	}
*/		
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum, et.set_aside, it.ultimate_completion_date, it.award_amount, et.naics_code, it.incumbent_name, it.graduated, et.ron_cp_date, et.tyler_cp_date, et.team_cp_date FROM excel_test et LEFT JOIN incumbents_test it ON et.opportunity_id = it.opportunity_id  WHERE (et.dont_show_agenda = 1 AND et.contract_vehicle = 'MA - IDIQ') AND et.opportunity_id > 0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $start_empty AND (et.status_value=7) ORDER BY et.status_value, et.proposal_due ASC LIMIT 300";
}

// Added for 'Work In Progress' OR 'Very Important' Section.
if($bidportal_counter==8) {
/*	$cp_date_cond = '';
	if($_SESSION['user_id'] == USER_RON){
		$cp_date_cond = " AND et.ron_cp_date = curdate()";
	}
	else if($_SESSION['user_id'] == USER_TYLER){
		$cp_date_cond = " AND et.tyler_cp_date = curdate()";
	}else{
		$cp_date_cond = " AND et.team_cp_date = curdate()";
	} */
/*
$query = "SELECT et.opportunity_id,et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis,
et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, 
et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager,
et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, 
et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum,
et.set_aside, it.ultimate_completion_date, it.award_amount, et.naics_code, it.incumbent_name, it.graduated, et.ron_cp_date, et.tyler_cp_date, et.team_cp_date
FROM excel_test et LEFT JOIN incumbents_test it ON et.opportunity_id = it.opportunity_id WHERE (et.dont_show_agenda = 1 AND et.contract_vehicle = 'MA - IDIQ') AND et.opportunity_id > 0 $favlist $vehtype $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $start_empty AND (et.status_value=9) ORDER BY STR_TO_DATE(it.ultimate_completion_date, '%m/%d/%Y') ASC LIMIT 300";
//echo $query; */
}

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
	$opp_synopsis_in = str_replace("•<BR>","• ",$row[8]); 
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
	}else{
		$set_aside = $row[40];
	}

	if(($bidportal_counter == 0 || $bidportal_counter == 1 || $bidportal_counter == 7 || $bidportal_counter == 8 || $bidportal_counter == 5) && ($row[41])) {
			$ultimate_date = date('m/d/Y',strtotime($row[41]));
	}else{
			$ultimate_date = 'N/A';
	}
	if(($bidportal_counter == 0 || $bidportal_counter == 1 || $bidportal_counter == 7 || $bidportal_counter == 8 || $bidportal_counter == 5) && ($row[42])) {
			//$award_amount = "$".number_format($row[42],0,".",",");
			$award_amount = number_format($row[42],0,".",",");
	}else{
		    $award_amount = 'N/A';
	}
	if(($bidportal_counter == 0 || $bidportal_counter == 1 || $bidportal_counter == 7 || $bidportal_counter == 8 || $bidportal_counter == 5) && ($row[43])){
			$naics_code = $row[43];
	}else{
		    $naics_code = 'N/A';
	}
	if(($bidportal_counter == 0 || $bidportal_counter == 1 || $bidportal_counter == 7 || $bidportal_counter == 8 || $bidportal_counter == 5) && ($row[44])){
			$incumbent_name = $row[44];
	}else{
		    $incumbent_name = 'N/A';
	}
	if(($bidportal_counter == 0 || $bidportal_counter == 1 || $bidportal_counter == 7 || $bidportal_counter == 8 || $bidportal_counter == 5) && ($row[45])){
			$graduate_date = $row[45];
	}else{
		    $graduate_date = 'N/A';
	}
	if(($bidportal_counter == 0 || $bidportal_counter == 1 || $bidportal_counter == 7 || $bidportal_counter == 8 || $bidportal_counter == 5) && ($row[46])){
			$ron_cp_date = date('m/d/Y',strtotime($row[46]));
	}else{
		    $ron_cp_date = 'N/A';
	}
	if(($bidportal_counter == 0 || $bidportal_counter == 1 || $bidportal_counter == 7 || $bidportal_counter == 8 || $bidportal_counter == 5) && ($row[47])){
			$tyler_cp_date = date('m/d/Y',strtotime($row[47]));
	}else{
		    $tyler_cp_date = 'N/A';
	}
	if(($bidportal_counter == 0 || $bidportal_counter == 1 || $bidportal_counter == 7 || $bidportal_counter == 8 || $bidportal_counter == 5) && ($row[48])){
			$team_cp_date = date('m/d/Y',strtotime($row[48]));
	}else{
		    $team_cp_date = 'N/A';
	}
	
	//number_format(float $number, int $decimals = 0, string $decimal_separator = ".", string $thousands_separator = ",");

	$opp_status = "<option hidden selected value='" . $row[19] . "'>" . $row[19] . "</option>"; 
	$status_text = $row[19];
	$agency = $row[20];
	$facility = $row[21]; 

	if($row[22] == 'Not Applicable'){
		$company_clearance = 'N/A';
	}else{
		$company_clearance = $row[22];
	}
	
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
		if($addendumValue){
			$addendum = "<i class='fa fa-flag' aria-hidden='true' style='color:#ff0000'></i>"; 
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
				<div style='display:inline-block; width:114px; vertical-align:top;'>RFP Exp.Date</div>
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
				<div style='display:inline-block; vertical-align:top;'>Title</div>
				";
				
		$header_award = "<div style='display:inline-block; width:40px; vertical-align:top;'>#</div>
				<div style='display:inline-block; width:114px; vertical-align:top;'>Award Date</div>
				<div style='display:inline-block; width:110px; vertical-align:top;'>Est. PoP Start</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Vehicle</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Type</div>
				<div style='display:inline-block; width:160px;'>Manager</div>
				<div style='display:inline-block; vertical-align:top;'>Title</div>
				";
				
		
		$agenda_ts = ""; $ur_ts=""; $cpw_ts=""; $rfp_ts=""; $award_ts=""; $award_bottom=""; $work_in_progress="";
		
		if ($table_show_agenda==0) { $agenda_ts = "<div class='bp_label' style=''>Agenda Item</div>
<div class='title_bar'>$header_all</div>"; $table_show_agenda=1; 
		}
														
		if (($status_value>2) && ($table_show_cpw==0)) { $cpw_ts = "<div class='bp_label' style='margin-top:20px;'>Current Proposal Workload</div>
<div class='title_bar'>$header_cpw</div>"; $table_show_cpw=1;
														}
														
		if (($status_value==4) && ($table_show_rfp==0)) { //$rfp_ts = "<div class='bp_label' style='margin-top:20px;'>RFP Tracking</div>
//<div class='title_bar'>//$header_rfp</div>"; $table_show_rfp=1; 
														}
														
		if (($status_value==5) && ($table_show_award==0)) { //$award_ts = "<div class='bp_label' style='margin-top:20px;'>Award Monitoring</div><div class='title_bar'>$header_award</div>";  $table_show_award=1; $award_bottom="margin-bottom:10px;";
		}
																	
		if (($status_value>6) && ($table_show_ur==0)) { 
		$ur_ts = "<div class='bp_label' style='margin-top:20px;'>Under Review</div>
<div class='title_bar'>$header_cpw</div>"; $table_show_ur=1;
		}
// Added for 'Work in progress'	Section Display Starts Here.											
	if (($status_value>6) && ($table_show_wip==0)) { 											
		$work_in_progress = "<div class='bp_label' style='margin-top:20px;'>Work in progress</div>
		<div class='title_bar'>$header_all</div>"; $table_show_wip=1;
	}	
// Added for 'Work in progress'	Section Display Ends Here.											
							
	$table_details = $agenda_ts . $work_in_progress . $cpw_ts . $rfp_ts . $award_ts . $ur_ts;
	}
	
	$manager_selector = "<select name='manager' id='manager_edit$opp_opportunity_id' size='1' style='padding:2px 5px; width:150px; border:1px solid #f0f0f0;' onchange=\"blurfunctiondecision('manager',this.value, $opp_opportunity_id)\">
				  $manager
				  <option value=''></option>
				  $manager_list
				</select>";


// Added To Fetch Decision Pending Opportunities.
$decision_pending_query = "SELECT count(*) FROM excel_test WHERE decision='Decision Pending / Hold'";
$decision_pending_query_result = mysqli_query($mysqli_link, $decision_pending_query);
$decision_pending_query_count = mysqli_fetch_array($decision_pending_query_result, MYSQLI_NUM);
if($decision_pending_query_count[0] > 0){
//	$table_content_h = "<div class='bp_label' style='margin-top:20px;'>Decision Pending / Hold </div><div class='title_bar'>$header_cpw</div>";
}
// Ends Here.
				
	if (($urlmode=='Agenda') && ($status_value==6)) { $archive_hide="display:none;"; } else { $archive_hide=""; }
	if (($status_value==6)) { $is_archived=1; } else { $is_archived=0; }		
	//collapsible_bid
	$dynamic_date_column = "<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_released_formatted</div>";

	//$dynamic_date_column_b = "<div style='display:inline-block; width:114px; vertical-align:top;'>&nbsp;</div>";
	$dynamic_date_column_b = "<div style='display:inline-block; width:114px; vertical-align:top;'>&nbsp;</div>";
	if (($status_value == 3))  { $dynamic_date_column = "<div style='display:inline-block; width:124px; vertical-align:top;'>$proposal_due</div>"; }
	if (($status_value == 4) || ($status_value == 7))  { $dynamic_date_column = "<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_rfp_date</div>"; }
	if (($status_value == 5))  { $dynamic_date_column = "<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_award_date</div>"; 
		$dynamic_date_column_b = "<div style='display:inline-block; width:114px; vertical-align:top;'>$est_pop_start_date</div>";
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
<div onclick=\"contract_vehicle_container(" . $opp_opportunity_id . ")\"  id='contract_vehicle_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
	<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$sno_inc</div>
	<!--<div style='display:inline-block; width:72px; vertical-align:top;'>$contract_vehicle</div>
	<div style='display:inline-block; width:99px; vertical-align:top;'>$opp_rfp_date</div>-->
	<div style='display:inline-block; width:99px; vertical-align:top;'>$ron_cp_date</div>
	<div style='display:inline-block; width:99px; vertical-align:top;'>$tyler_cp_date</div>
	<div style='display:inline-block; width:99px; vertical-align:top;'>$team_cp_date</div>
	<div style='display:inline-block; width:99px; vertical-align:top;'>$ultimate_date</div>
	<div style='display:inline-block; width:80px; vertical-align:top;'>$naics_code</div>
	<div style='display:inline-block; width:108px; vertical-align:top;'>$agency</div>
	<div style='display:inline-block; width:126px; vertical-align:top;'>$incumbent_name</div>
	<div style='display:inline-block; width:126px; vertical-align:top;'>$graduate_date</div>
	<!--<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:116px;'>$company_clearance</div>-->
	<div style='display:inline-block;  vertical-align:top; width:126px;'>$award_amount</div>
	<div style='display:inline-block; vertical-align:top; width:calc(100% - 85%);'>$opp_title</div>
	
</div>
</div>
<div id='" . $opp_opportunity_id . "' style='display:none;'></div>";
}

//AGENDA ITEM
if (($bidportal_counter == 1) && ($status_value == 1)) { 
//$table_content_new .= "GREAT " . $bidportal_counter . " " . $status_reset_counter; exit;
$table_content_a .= "<div>$table_details</div>
<div id='tableBody'>
<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
	<div class='div-table row' data-sno='".$status_reset_counter."' data-rfp_exp_date='".$opp_rfp_date."'  data-naics='".$naics_code."' data-set_aside='".$set_aside."' data-department='".$agency."'  data-title='".$opp_title."' onclick=\"contract_vehicle_container(" . $opp_opportunity_id . ")\"  id='contract_vehicle_container" . $opp_opportunity_id . "' class='opp_container'>
			<div style='display:inline-block; width:63px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>
			<!--<div style='display:inline-block; width:90px;'>$contract_vehicle</div>
			<div style='display:inline-block; width:89px;'>$ron_cp_date</div>
			<div style='display:inline-block; width:89px;'>$tyler_cp_date</div>
			<div style='display:inline-block; width:89px;'>$team_cp_date</div>
			<div style='display:inline-block; width:89px;'>$ultimate_date</div>-->
			<div style='display:inline-block; width:99px;'>$opp_rfp_date</div>
			<div id='naicsDiv".$opp_opportunity_id."'style='display:inline-block; width:72px; vertical-align:top;' onmouseover=\"displayMessage($opp_opportunity_id,$naics_code);\">$naics_code</div>
			<div style='display:inline-block; width:120px;'>$set_aside</div>
			<div style='display:inline-block; width:90px; vertical-align:top;'>$agency</div>
			<!--<div style='display:inline-block; width:99px; vertical-align:top;'>$incumbent_name</div>
			<div style='display:inline-block; width:99px; vertical-align:top;'>$graduate_date</div>
			<!-- <div style='display:inline-block; width:120px;'>$opp_response</div>-->			
			<!--<div style='display:inline-block; width:63px;'>$company_clearance</div>
			<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:85px;'>$award_amount</div>-->
			<div style='display:inline-block; width:calc(100% - 72%);  vertical-align:top;'>$opp_title</div>
	</div>
</div>
<div class='div-table row' data-sno='".$status_reset_counter."' data-rfp_exp_date='".$opp_rfp_date."'  data-naics='".$naics_code."' data-set_aside='".$set_aside."' data-department='".$agency."'  data-title='".$opp_title."' id='" . $opp_opportunity_id . "' style='display:none;'></div>
</div> <!-- closure of 'tableBody' div -->";
}  
//RFP TRACKING
if (($bidportal_counter == 4) && ($status_value == 4)) { 
//$table_content_new .= "GREAT " . $bidportal_counter . " " . $status_reset_counter; 
$table_content_c .= "<div>$table_details</div>
<div id='tableBody2'>
<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
		<div class='div-table2 row' data-sno='".$fix_counter."' data-rfp_exp_date='".$opp_rfp_date."'  data-naics='".$naics_code."' data-set_aside='".$set_aside."' data-department='".$agency."'  data-title='".$opp_title."' onclick=\"contract_vehicle_container(" . $opp_opportunity_id . ")\"  id='contract_vehicle_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
			<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$fix_counter</div>
			<div style='display:inline-block; width:99px;'>$opp_rfp_date</div>
			<!--<div style='display:inline-block; width:90px;'>$contract_vehicle</div>
			<div style='display:inline-block; width:89px;'>$ron_cp_date</div>
			<div style='display:inline-block; width:89px;'>$tyler_cp_date</div>
			<div style='display:inline-block; width:89px;'>$team_cp_date</div>
			<div style='display:inline-block; width:89px;'>$ultimate_date</div>-->
			<div id='naicsDiv".$opp_opportunity_id."'style='display:inline-block; width:72px; vertical-align:top;' onmouseover=\"displayMessage($opp_opportunity_id,$naics_code);\">$naics_code</div>
			<div style='display:inline-block; width:120px;'>$set_aside</div>
			<div style='display:inline-block; width:90px; vertical-align:top;'>$agency</div>
			<!--<div style='display:inline-block; width:99px; vertical-align:top;'>$incumbent_name</div>
			<div style='display:inline-block; width:99px; vertical-align:top;'>$graduate_date</div>
			<div style='display:inline-block; width:120px;'>$opp_response</div>	
			<div style='display:inline-block; width:63px;'>$company_clearance</div>-->
			<!--<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:85px;'>$award_amount</div>-->
			<div style='display:inline-block; width:calc(100% - 72%);  vertical-align:top;'>$opp_title</div>
				
		</div>
	</div>
	</div> <!-- closure of 'tableBody2' div -->
<div class='div-table2 row' data-sno='".$fix_counter."' data-rfp_exp_date='".$opp_rfp_date."'  data-naics='".$naics_code."' data-set_aside='".$set_aside."' data-department='".$agency."'  data-title='".$opp_title."' id='" . $opp_opportunity_id . "' style='display:none;'></div>
";
}


//UNDER REVIEW
if (($bidportal_counter == 7) && ($status_value == 7)) {  
$table_content_e .= "<div>$table_details</div>
<div id='tableBody1'>
<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
	<div class='div-table1 row' data-sno='".$status_reset_counter."' data-rfp_exp_date='".$opp_rfp_date."'  data-naics='".$naics_code."' data-set_aside='".$set_aside."' data-department='".$agency."'  data-title='".$opp_title."' onclick=\"contract_vehicle_container(" . $opp_opportunity_id . ")\"  id='contract_vehicle_container" . $opp_opportunity_id . "' class='opp_container'>
			<div style='display:inline-block; width:63px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>
			<div style='display:inline-block; width:99px;'>$opp_rfp_date</div>
			<!--<div style='display:inline-block; width:90px;'>$contract_vehicle</div>
			<div style='display:inline-block; width:89px;'>$ron_cp_date</div>
			<div style='display:inline-block; width:89px;'>$tyler_cp_date</div>
			<div style='display:inline-block; width:89px;'>$team_cp_date</div>
			<div style='display:inline-block; width:89px;'>$ultimate_date</div>-->
			<div id='naicsDiv".$opp_opportunity_id."'style='display:inline-block; width:72px; vertical-align:top;' onmouseover=\"displayMessage($opp_opportunity_id,$naics_code);\">$naics_code</div>
			<div style='display:inline-block; width:120px;'>$set_aside</div>
			<div style='display:inline-block; width:90px; vertical-align:top;'>$agency</div>
			<!--<div style='display:inline-block; width:99px; vertical-align:top;'>$incumbent_name</div>
			<div style='display:inline-block; width:99px; vertical-align:top;'>$graduate_date</div>
			<div style='display:inline-block; width:120px;'>$opp_response</div>	
			<div style='display:inline-block; width:63px;'>$company_clearance</div>-->
			<!--<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:85px;'>$award_amount</div>-->
			<div style='display:inline-block; width:calc(100% - 72%);  vertical-align:top;'>$opp_title</div>
	</div>
</div></div> <!-- closure of 'tableBody1' div -->
<div class='div-table1 row' data-sno='".$status_reset_counter."' data-rfp_exp_date='".$opp_rfp_date."'  data-naics='".$naics_code."' data-set_aside='".$set_aside."' data-department='".$agency."'  data-title='".$opp_title."' id='" . $opp_opportunity_id . "' style='display:none;'></div>
";
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
<div class='div-table2 row' data-ron_cp_date='".$ron_cp_date."' data-tyler_cp_date='".$tyler_cp_date."'
	data-team_cp_date='".$team_cp_date."' data-contract_exp_date='".$ultimate_date."' data-naics='".$naics_code."' data-department='".$agency."' data-incumbent_name='".$incumbent_name."' data-8a_graduation_date='".$graduate_date."' data-contract_value='".$award_amount."' data-title='".$opp_title."' onclick=\"contract_vehicle_container(" . $opp_opportunity_id . ")\"  id='contract_vehicle_container" . $opp_opportunity_id . "' class='opp_container'>
			<div style='display:inline-block; width:36px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>
			<!--<div style='display:inline-block; width:90px;'>$contract_vehicle</div>
			<div style='display:inline-block; width:99px;'>$opp_rfp_date</div>-->
			<div style='display:inline-block; width:89px;'>$ron_cp_date</div>
			<div style='display:inline-block; width:89px;'>$tyler_cp_date</div>
			<div style='display:inline-block; width:89px;'>$team_cp_date</div>
			<div style='display:inline-block; width:89px;'>$ultimate_date</div>
			<div id='naicsDiv".$opp_opportunity_id."'style='display:inline-block; width:63px; vertical-align:top;' onmouseover=\"displayMessage($opp_opportunity_id,$naics_code);\">$naics_code</div>
			<div style='display:inline-block; width:81px; vertical-align:top;'>$agency</div>
			<div style='display:inline-block; width:99px; vertical-align:top;'>$incumbent_name</div>
			<div style='display:inline-block; width:99px; vertical-align:top;'>$graduate_date</div>
			<!-- <div style='display:inline-block; width:120px;'>$opp_response</div>			
			<div style='display:inline-block; width:120px;'>$set_aside</div>
			<div style='display:inline-block; width:63px;'>$company_clearance</div>-->
			<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:85px;'>$award_amount</div>
			<div style='display:inline-block; width:calc(100% - 72%);  vertical-align:top;'>$opp_title &nbsp;&nbsp; $addendum</div>
	</div>
			</div>
</div> <!-- closure of 'tableBody2' div -->
	<div class='div-table2 row' data-ron_cp_date='".$ron_cp_date."' data-tyler_cp_date='".$tyler_cp_date."'
	data-team_cp_date='".$team_cp_date."' data-contract_exp_date='".$ultimate_date."' data-naics='".$naics_code."' data-department='".$agency."' data-incumbent_name='".$incumbent_name."' data-8a_graduation_date='".$graduate_date."' data-contract_value='".$award_amount."' data-title='".$opp_title."' id='" . $opp_opportunity_id . "' style='display:none;'></div>
		";
}

//ARCHIEVE IN MY FAVLIST PAGE
if (($bidportal_counter == 6) and ($status_value == 6) and $_GET['favshow'] == 'yes') { 
//$table_content_new .= "GREAT " . $bidportal_counter . " " . $status_reset_counter; 
$table_content_f .= "<div>$table_details</div>

	<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
	-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
	box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
	'>
				<div onclick=\"contract_vehicle_container(" . $opp_opportunity_id . ")\"  id='contract_vehicle_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
						<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>"
						. $dynamic_date_column . $dynamic_date_column_b . 
						"<div style='display:inline-block; width:120px; vertical-align:top;'>$contract_vehicle</div>
						<div style='display:inline-block; width:72px; vertical-align:top;'>$opp_response</div>
						<div style='display:inline-block; width:120px;'>$set_aside</div>
						<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:117px;'>$opp_manager</div>
						<div style='display:inline-block; width:calc(100% - 730px);  vertical-align:top;'>$opp_title</div>
						
				</div>
			</div>
		<div id='" . $opp_opportunity_id . "' style='display:none;'></div>
		";
}

// Added For 'Work In Progress'.
if (($bidportal_counter == 8) && ($status_value == 9)) { 
$table_content_i .= "<div>$table_details</div>
<div id='tableBody'>
<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);'>
	<div class='div-table row' data-ron_cp_date='".$ron_cp_date."' data-tyler_cp_date='".$tyler_cp_date."'
	data-team_cp_date='".$team_cp_date."' data-contract_exp_date='".$ultimate_date."' data-naics='".$naics_code."' data-department='".$agency."' data-incumbent_name='".$incumbent_name."' data-8a_graduation_date='".$graduate_date."' data-contract_value='".$award_amount."' data-title='".$opp_title."' onclick=\"contract_vehicle_container(" . $opp_opportunity_id . ")\"  id='contract_vehicle_container" . $opp_opportunity_id . "' class='opp_container'>
			<div style='display:inline-block; width:36px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>
			<!--<div style='display:inline-block; width:90px;'>$contract_vehicle</div>
			<div style='display:inline-block; width:99px;'>$opp_rfp_date</div>-->
			<div style='display:inline-block; width:89px;'>$ron_cp_date</div>
			<div style='display:inline-block; width:89px;'>$tyler_cp_date</div>
			<div style='display:inline-block; width:89px;'>$team_cp_date</div>
			<div style='display:inline-block; width:89px;'>$ultimate_date</div>
			<div id='naicsDiv".$opp_opportunity_id."'style='display:inline-block; width:63px; vertical-align:top;' onmouseover=\"displayMessage($opp_opportunity_id,$naics_code);\">$naics_code</div>
			<div style='display:inline-block; width:81px; vertical-align:top;'>$agency</div>
			<div style='display:inline-block; width:99px; vertical-align:top;'>$incumbent_name</div>
			<div style='display:inline-block; width:99px; vertical-align:top;'>$graduate_date</div>
			<!-- <div style='display:inline-block; width:120px;'>$opp_response</div>			
			<div style='display:inline-block; width:120px;'>$set_aside</div>
			<div style='display:inline-block; width:63px;'>$company_clearance</div>-->
			<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:85px;'>$award_amount</div>
			<div style='display:inline-block; width:calc(100% - 72%);  vertical-align:top;'>$opp_title</div>
	</div>
</div>
</div> <!-- closure of 'tableBody' div -->
<div class='div-table row' data-ron_cp_date='".$ron_cp_date."' data-tyler_cp_date='".$tyler_cp_date."'
	data-team_cp_date='".$team_cp_date."' data-contract_exp_date='".$ultimate_date."' data-naics='".$naics_code."' data-department='".$agency."' data-incumbent_name='".$incumbent_name."' data-8a_graduation_date='".$graduate_date."' data-contract_value='".$award_amount."' data-title='".$opp_title."' id='" . $opp_opportunity_id . "' style='display:none;'></div>
";
}
// Ends Here.


$sno_inc++;
}

}	

}





// DECISION PENDING / HOLD STARTS HERE.
$decision_pending_query = "SELECT et.opportunity_id, et.rfp_date, et.contract_vehicle, et.response, et.set_aside, et.manager, et.title FROM excel_test et WHERE (et.dont_show_agenda = 1) AND et.decision='Decision Pending / Hold' and et.status_value=8";
$decision_pending_query_result = mysqli_query($mysqli_link, $decision_pending_query);
//$decision_pending_query_count = mysqli_fetch_array($decision_pending_query_result, MYSQLI_NUM);
$sno_inc = 1;
   while($row1 = mysqli_fetch_array($decision_pending_query_result, MYSQLI_NUM))    
		{ //print_r($row1);
//if($decision_pending_query_count[0] > 0){
	//$table_content_h = "<div class='bp_label' style='margin-top:20px;'>Decision Pending / Hold </div><div class='title_bar'>$header_cpw</div>";
			$opp_opportunity_id = $row1[0];
			$proposal_due = date('m/d/Y',strtotime($row1[1]));
			$vehicle	  = $row1[2];
			$type		  = $row1[3];
			$set_aside	  = $row1[4];
			$manager	  = $row1[5];
			$title		  = $row1[6];


	$table_content_h .= "<div>$table_details</div>

<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   $archive_hide'>
	<div onclick=\"contract_vehicle_container(" . $opp_opportunity_id . ")\"  id='contract_vehicle_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
			<div style='display:inline-block; width:40px; vertical-align:top; padding-left:8px;'>$sno_inc</div>
			<div style='display:inline-block; width:115px; vertical-align:top; padding-left:8px;'>$proposal_due</div>
		<div style='display:inline-block; width:110px; vertical-align:top; padding-left:8px;'>&nbsp;</div> 
			<div style='display:inline-block; width:130px; margin-bottom: 6px; vertical-align:top;'>$vehicle</div>
			<div style='display:inline-block; width:63px; vertical-align:top;'>$type</div>
			<div style='display:inline-block; width:120px; vertical-align:top;'>$set_aside</div>
			<div style='display:inline-block; width:117px; vertical-align:top;'>$manager</div>
			<div style='display:inline-block; width:calc(100% - 730px);  vertical-align:top;'>$title</div>
	</div>
</div>
<div id='" . $opp_opportunity_id . "' style='display:none;'></div>";
  $sno_inc ++;
		}
// DECISION PENDING / HOLD  Ends Here.





$incumbents_filter_data = '';
if($_GET['dualsearch'] == 'IS') {
	$searchstring = $_GET['search'];
//	$query1 = "SELECT incumbent_id,opportunity_id,incumbent_name,website FROM incumbents_test WHERE incumbent_name LIKE '%$searchstring%' OR website LIKE '%$searchstring%'";
   // $query1 = "SELECT et.released,et.proposal_due,et.contract_vehicle,et.response,et.manager,et.title,et.decision,i.incumbent_id,i.opportunity_id,i.incumbent_name FROM incumbents_test i JOIN excel_test et ON i.opportunity_id = et.opportunity_id AND (i.incumbent_name LIKE '%$searchstring%' OR i.website LIKE '%$searchstring%')"; 
    $query1 = "SELECT et.released,et.proposal_due,et.contractveh_table,et.response,et.manager,et.title,et.decision,i.incumbent_id,i.opportunity_id,i.incumbent_name FROM excel_test et JOIN incumbents_test i ON i.opportunity_id = et.opportunity_id AND (i.incumbent_name LIKE '%$searchstring%' OR i.website LIKE '%$searchstring%')$queryurlmode $querystatus $ur_only $queryvehicle $querysetaside $querydecision $querytype $sttype $ron_cp_date $tyler_cp_date $team_cp_date $start_empty ORDER BY et.contract_vehicle, et.status_value, et.creation_timestamp DESC LIMIT $offset, $total_records_per_page"; 
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
<div onclick=\"contract_vehicle_container(" . $opportunity_id . ")\"  id='contract_vehicle_container" . $opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
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