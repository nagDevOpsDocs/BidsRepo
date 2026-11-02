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
WHERE (et.opportunity_id > 0 AND et.is_addendum = 1) $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $sttype $proposalduedate $releaseddate $start_empty ORDER BY et.contract_vehicle, et.status_value, et.creation_timestamp";

//$total_results = 0;
$result = mysqli_query($mysqli_link, $query_total);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$total_results2 = $row[0];
	}
	$total_results = $total_results2;

//for($bidportal_counter = 0; $bidportal_counter <= 7; $bidportal_counter++) 
//{
/*if ($bidportal_counter==0) {
$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.set_aside, et.business_entity FROM excel_test et WHERE et.opportunity_id > 0 $favlist $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $sttype $proposalduedate $releaseddate $start_empty ORDER BY $order $ascdesc LIMIT $offset, $total_records_per_page";
//echo $query;
} */

$query = "SELECT et.opportunity_id, et.bidopp, et.response, et.requestor, et.title, et.due, et.released, et.pop, et.synopsis, et.proposal, et.pricing, et.recruiting, et.gaps, et.decision, et.contract_pop, et.contract_period, et.vehicle_one, et.vehicle_two, et.contract_vehicle, et.status, et.agency, et.facility, et.clearance_level, et.proposal_due, et.qa_due, et.reason, et.manager, et.qa_timezone, et.proposal_timezone, et.contract_vehicle_two, et.contract_pop2, et.status_value, et.entered_in_by, et.creation_timestamp, et.transition_notes, et.award_date, et.rfp_date, et.est_pop_start_date, et.contractveh_table, et.is_addendum, et.set_aside, et.business_entity, et.addendum_date FROM excel_test et 
WHERE (et.is_addendum = 1 AND et.opportunity_id > 0 AND (et.addendum_date BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE())) $favlist $vehtype $mngrname $queryurlmode $querystatus $ur_only $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $proposalduedate $start_empty ORDER BY et.addendum_date DESC LIMIT 300";

//echo $query;
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
// Added for Short Cuts Ends Here.

		$business_entity =  $row[41];
	
	if($row[42] != ''){
		$addendum_date = date('m/d/Y',strtotime($row[42]));
	}else{
		$addendum_date = '';
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
		if($addendumValue){
//			$addendum = "<i class='fa fa-flag' aria-hidden='true' style='color:#ff0000'></i>"; 
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

	
	$manager_selector = "<select name='manager' id='manager_edit$opp_opportunity_id' size='1' style='padding:2px 5px; width:150px; border:1px solid #f0f0f0;' onchange=\"blurfunctiondecision('manager',this.value, $opp_opportunity_id)\">
				  $manager
				  <option value=''></option>
				  $manager_list
				</select>";

//AGENDA ITEM
//if (($bidportal_counter == 1) && ($status_value == 1)) { 
$table_content_a .= "<div>$table_details</div>
<div id='tableBody'>
<div style='background-color:#fff; -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
-moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);
box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.35);   
$archive_hide'>
	<div class='div-table row' data-sno='".$status_reset_counter."' data-vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-set_aside='".$set_aside."' data-release='".$opp_released_formatted."' data-sub_due_date='".$opp_released_formatted."' data-manager='".$opp_manager."' data-title='".$opp_title."' data-business_entity='".$business_entity."' onclick=\"showajaxopp(" . $opp_opportunity_id . ")\"  id='opportunity_container" . $opp_opportunity_id . "' class='opp_container'>
			<div style='display:inline-block; width:36px; vertical-align:top; padding-left:8px;'>$status_reset_counter</div>
			<div style='display:inline-block; width:78px;'>$contract_vehicle</div>
			<div style='display:inline-block; width:85px;'>$addendum_date</div>
			<div style='display:inline-block; width:153px; vertical-align:top;'>$proposal_due</div>
			<!-- <div  style='display:inline-block; width:60px;'>&nbsp;</div> -->  
			<div style='display:inline-block; width:63px;'>$opp_response</div>
			<div style='display:inline-block; width:81px;'>$set_aside</div>
			<div id='managertitle" . $opp_opportunity_id . "' style='display:inline-block; width:81px;'>$opp_manager</div>
			<div style='display:inline-block; width:349px;  vertical-align:top;'>$opp_title</div>
			<div style='display:inline-block; width:99px;  vertical-align:top;'>$opp_decision</div>
			<div style='display:inline-block; width:129px;  vertical-align:top;'>$status_text</div>
			<div style='display:inline-block; width:130px;  vertical-align:top;'>$business_entity</div>		
	</div>
</div>
<div class='div-table row' data-sno='".$status_reset_counter."' data-vehicle='".$contract_vehicle."' data-type='".$opp_response."' data-set_aside='".$set_aside."' data-release='".$opp_released_formatted."' data-sub_due_date='".$opp_released_formatted."' data-manager='".$opp_manager."' data-title='".$opp_title."' data-business_entity='".$business_entity."' id='" . $opp_opportunity_id . "' style='display:none;'></div>
</div> <!-- closure of 'tableBody' div -->";
//}
$sno_inc++;
}
}

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
