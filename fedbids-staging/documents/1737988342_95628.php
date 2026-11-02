<?php
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
if($_GET['incumbent_search'] != '') {
	$searchstring = $_GET['incumbent_search'];
$query_total1 = "SELECT count(*) FROM incumbents_test WHERE incumbent_name LIKE '%$searchstring%' OR website LIKE '%$searchstring%'";

$total_results = 0;
$result1 = mysqli_query($mysqli_link, $query_total1);
while($row1 = mysqli_fetch_array($result1, MYSQLI_NUM))
    {
		$total_results1 = $row1[0];
	}
	$total_results = $total_results1;
}

else  {

$query_total = "SELECT count(*) FROM excel_test   
WHERE opportunity_id>0 $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querydecision $sttype $proposalduedate $releaseddate $start_empty ORDER BY contract_vehicle, status_value, creation_timestamp";

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
$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, contract_vehicle_two, contract_pop2, status_value, entered_in_by, creation_timestamp, transition_notes, award_date, rfp_date, est_pop_start_date, contractveh_table FROM excel_test WHERE opportunity_id>0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querydecision $sttype $proposalduedate $releaseddate $start_empty ORDER BY proposal_due DESC LIMIT $offset, $total_records_per_page";
//echo $query;
}

if($bidportal_counter==1) { 
$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, contract_vehicle_two, contract_pop2, status_value, entered_in_by, creation_timestamp, transition_notes, award_date, rfp_date, est_pop_start_date, contractveh_table FROM excel_test   
WHERE opportunity_id>0 $favlist $vehtype $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querydecision $proposalduedate $start_empty AND (status_value=1) ORDER BY status_value, contract_vehicle, released ASC LIMIT 300";
}

if($bidportal_counter==2) { 
$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, contract_vehicle_two, contract_pop2, status_value, entered_in_by, creation_timestamp, transition_notes, award_date, rfp_date, est_pop_start_date, contractveh_table FROM excel_test   
WHERE opportunity_id>0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querydecision $proposalduedate $start_empty AND (status_value=2) ORDER BY status_value, creation_timestamp ASC LIMIT 300";
}

if($bidportal_counter==3) {  
$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, contract_vehicle_two, contract_pop2, status_value, entered_in_by, creation_timestamp, transition_notes, award_date, rfp_date, est_pop_start_date, contractveh_table FROM excel_test   
WHERE opportunity_id>0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querydecision $proposalduedate $start_empty AND status_value=3 ORDER BY 
status_value, proposal_due ASC LIMIT 300";
}
if($bidportal_counter==4) { 
$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, contract_vehicle_two, contract_pop2, status_value, entered_in_by, creation_timestamp, transition_notes, award_date, rfp_date, est_pop_start_date, contractveh_table FROM excel_test   
WHERE opportunity_id>0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querydecision $proposalduedate $start_empty AND status_value=4 ORDER BY (rfp_date IS NULL), status_value, rfp_date ASC LIMIT 300";
}
if($bidportal_counter==5) { 
$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, contract_vehicle_two, contract_pop2, status_value, entered_in_by, creation_timestamp, transition_notes, award_date, rfp_date, est_pop_start_date, contractveh_table FROM excel_test   
WHERE opportunity_id>0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querydecision $proposalduedate $start_empty AND status_value=5 ORDER BY (award_date IS NULL), status_value, award_date ASC LIMIT 300";
}
if($bidportal_counter==7) { 
$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, contract_vehicle_two, contract_pop2, status_value, entered_in_by, creation_timestamp, transition_notes, award_date, rfp_date, est_pop_start_date, contractveh_table FROM excel_test   
WHERE opportunity_id>0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querydecision $proposalduedate $start_empty AND status_value=7 ORDER BY status_value, proposal_due ASC LIMIT 300";
}

//echo $query;
$status_reset_counter=0;
$sno_inc = 1;
if($_GET['page_no'])
$sno_inc = $_GET['page_no']*50-(50-1);
$fix_counter=0;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))    
	{
	$opp_opportunity_id = $row[0];
	//echo $row[0].'<br>';
	$opp_bidopp = $row[1];
	$opp_response = $row[2]; 
	$opp_requestor = $row[3];
	$opp_title_in = str_replace("<BR>","",$row[4]); 
		$opp_title = str_ireplace($urlsearch, '<span style="background-color:#f1b133;">'.strtoupper($urlsearch).'</span>', $opp_title_in);
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
	
	$qa_timezone = $row[27];
//	$proposal_timezone = $row[28];  
	$contract_vehicle_two = $row[29];
	
	$secondary_address = str_replace("|||",", ",$row[30]); //$row[18];
	
	$status_value = $row[31];
	$entered_in_by = $row[32];
	if (strlen($entered_in_by)<2) { $entered_in_by="&nbsp;"; }
	$creation_timestamp_db = $row[33];
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
				<div style='display:inline-block; width:120px; vertical-align:top;'>Type</div>
				<div style='display:inline-block; width:160px;'>Manager</div>
				<div style='display:inline-block; vertical-align:top;'>Title</div>
				";
		
		$header_rfp = "<div style='display:inline-block; width:40px; vertical-align:top;'>#</div>
				<div style='display:inline-block; width:114px; vertical-align:top;'>RFP Release</div>
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
				
		
		$agenda_ts = ""; $ur_ts=""; $cpw_ts=""; $rfp_ts=""; $award_ts=""; $award_bottom="";
		
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
							
	$table_details = $agenda_ts . $cpw_ts . $rfp_ts . $award_ts . $ur_ts;
	}
	
	$manager_selector = "<select name='manager' id='manager_edit$opp_opportunity_id' size='1' style='padding:2px 5px; width:150px; border:1px solid #f0f0f0;' onchange=\"blurfunctiondecision('manager',this.value, $opp_opportunity_id)\">
				  $manager
				  <option value=''></option>
				  $manager_list
				</select>";
				
	if (($urlmode=='Agenda') && ($status_value==6)) { $archive_hide="display:none;"; } else { $archive_hide=""; }
	if (($status_value==6)) { $is_archived=1; } else { $is_archived=0; }		
	//collapsible_bid
	$dynamic_date_column = "<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_released_formatted</div>";

	$dynamic_date_column_b = "<div style='display:inline-block; width:114px; vertical-align:top;'>&nbsp;</div>";
	
	if (($status_value == 3) || ($status_value == 7))  { $dynamic_date_column = "<div style='display:inline-block; width:120px; vertical-align:top;'>$proposal_due</div>"; }
	if (($status_value == 4))  { $dynamic_date_column = "<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_rfp_date</div>"; }
	if (($status_value == 5))  { $dynamic_date_column = "<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_award_date</div>"; 
		$dynamic_date_column_b = "<div style='display:inline-block; width:114px; vertical-align:top;'>$est_pop_start_date</div>";
								}
	
//OPP - search details
if($bidportal_counter == 0) {  
$table_content_opp .= "<div>$table_details</div>

<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
<div onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
	<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$sno_inc</div>
	<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_released</div>
	<div style='display:inline-block; width:120px; vertical-align:top;'>$proposal_due_searchcol</div>
	<div style='display:inline-block; width:120px; vertical-align:top;'>$contract_vehicle</div>
	<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_response</div>
	<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:160px;'>$opp_manager</div>
	<div style='display:inline-block;  vertical-align:top; width:378px;'>$opp_title</div>
	<div style='display:inline-block; vertical-align:top; width:144px; text-align: center;'>$opp_decision</div>
	
</div>
</div>
<div id='" . $opp_opportunity_id . "' style='display:none;'></div>
";
}

//AGENDA ITEM
if (($bidportal_counter == 1) && ($status_value == 1)) { 
//$table_content_new .= "GREAT " . $bidportal_counter . " " . $status_reset_counter; 
$table_content_a .= "<div>$table_details</div>

<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
	<div onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container'>
			<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>
			<div style='display:inline-block; width:120px;'>$contract_vehicle</div>"
			. $dynamic_date_column . $dynamic_date_column_b .
			"<div style='display:inline-block; width:50px; vertical-align:top;'>$proposal_due</div>
			<div style='display:inline-block; width:60px;'>&nbsp;</div>
			<div style='display:inline-block; width:120px;'>$opp_response</div>
			<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:160px;'>$opp_manager</div>
			<div style='display:inline-block; width:calc(100% - 950px);  vertical-align:top;'>$opp_title</div>
			
	</div>
</div>
<div id='" . $opp_opportunity_id . "' style='display:none;'></div>
";
}
//CURRENT PROPOSAL WORKLOAD
if (($bidportal_counter == 3) && ($status_value == 3)) { 
//$table_content_new .= "GREAT " . $bidportal_counter . " " . $status_reset_counter; 
$table_content_b .= "<div>$table_details</div>

<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
	<div onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
			<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>"
			. $dynamic_date_column . $dynamic_date_column_b .
			"<div style='display:inline-block; width:120px; vertical-align:top;'>$contract_vehicle</div>
			<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_response</div>
			<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:160px;'>$opp_manager</div>
			<div style='display:inline-block; width:calc(100% - 730px);  vertical-align:top;'>$opp_title</div>
			
	</div>
</div>
<div id='" . $opp_opportunity_id . "' style='display:none;'></div>
";
}
//RFP TRACKING
if (($bidportal_counter == 4) && ($status_value == 4)) { 
//$table_content_new .= "GREAT " . $bidportal_counter . " " . $status_reset_counter; 
$table_content_c .= "<div>$table_details</div>

<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
		<div onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
				<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$fix_counter</div>"
				. $dynamic_date_column . $dynamic_date_column_b .
				"<div style='display:inline-block; width:120px; vertical-align:top;'>$contract_vehicle</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_response</div>
				<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:160px;'>$opp_manager</div>
				<div style='display:inline-block; width:calc(100% - 730px);  vertical-align:top;'>$opp_title</div>
				
		</div>
	</div>
<div id='" . $opp_opportunity_id . "' style='display:none;'></div>
";
}
//AWARD MONITORING
if (($bidportal_counter == 5) && ($status_value == 5)) { 
//$table_content_new .= "GREAT " . $bidportal_counter . " " . $status_reset_counter; 
$table_content_d .= "<div>$table_details</div>

	<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
	-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
	box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
	$archive_hide'>
				<div onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
						<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>"
						. $dynamic_date_column . $dynamic_date_column_b . 
						"<div style='display:inline-block; width:120px; vertical-align:top;'>$contract_vehicle</div>
						<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_response</div>
						<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:160px;'>$opp_manager</div>
						<div style='display:inline-block; width:calc(100% - 730px);  vertical-align:top;'>$opp_title</div>
						
				</div>
			</div>
		<div id='" . $opp_opportunity_id . "' style='display:none;'></div>
		";
}
//UNDER REVIEW
if (($bidportal_counter == 7) && ($status_value == 7)) {  
$table_content_e .= "<div>$table_details</div>

<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
	<div onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
			<div style='display:inline-block; width:50px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>"
			. $dynamic_date_column . $dynamic_date_column_b .
			"<div style='display:inline-block; width:120px; vertical-align:top;'>$contract_vehicle</div>
			<div style='display:inline-block; width:120px; vertical-align:top;'>$opp_response</div>
			<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:160px;'>$opp_manager</div>
			<div style='display:inline-block; width:calc(100% - 730px);  vertical-align:top;'>$opp_title</div>
			
	</div>
	</div>
<div id='" . $opp_opportunity_id . "' style='display:none;'></div>
";
}
$sno_inc++;
}

}	

}

$incumbents_filter_data = '';
if($_GET['dualsearch'] == 'IS') {
	$searchstring = $_GET['incumbent_search'];
	$query1 = "SELECT incumbent_id,incumbent_name,website FROM incumbents_test WHERE incumbent_name LIKE '%$searchstring%' OR website LIKE '%$searchstring%'";
$sno_inc = 1;
	$result1 = mysqli_query($mysqli_link, $query1);
    while($row1 = mysqli_fetch_array($result1, MYSQLI_NUM))    
		{  
			$incumbent_id		= $row1[0];
			$incumbent_title	= $row1[1];
			$incumbent_website  = $row1[2];

	$incumbents_filter_data .=	"<div>$table_details</div>
	<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
<div onclick=\"showajaxopp(" . $incumbent_id . ")\"  id='opportunity_container" . $incumbent_id . "' class='opp_container' style='/*padding: 6px; background-color:#fff;*/'>
	<div style='display:inline-block; width:99px; vertical-align:top; padding-left:8px;'>$sno_inc</div>
	<div style='display:inline-block; width:666px; vertical-align:top;'>$incumbent_title</div>
	<div style='display:inline-block; width:423px; vertical-align:top;'>$incumbent_website</div>	
</div>
</div>
<div id='" . $incumbent_id . "' style='display:none;'></div>";
  $sno_inc ++;
}


		}

?>