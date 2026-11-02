<?php
session_start();
include("./includes/connect_portal123.php");
//ini_set('display_errors', '1'); error_reporting(E_ALL);
if(($_SESSION['access_level']!='101') && ($_SESSION['access_level']!='103')) { header("Location: $login");  }
$srch_val = http_build_query($_GET,'','&');
$this_page_name="Agenda";
$secure_webpage=0;
//print_r($_SESSION);
//echo $_SESSION['user_id']; 

//echo "<br/>SELECT firstname, lastname, user_role, myfav_bids FROM users WHERE user_id = ".$_SESSION['user_id'];
//$getusrdet = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT firstname,lastname,user_role,myfav_bids FROM users WHERE user_id = ".$_SESSION['user_id']));
$getusrdet = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT firstname,lastname,user_role,myfav_bids FROM users WHERE user_email = '".$_SESSION['user_email']."'"));
//print("<br/>Errors in the query: ".mysqli_error($mysqli_link)."\n");
//print_r($getusrdet);
$logged_user_name = $getusrdet[0].' '.$getusrdet[1];
//$logged_user_name = $_SESSION['user_name'];
//echo "<br/>Logged User Is :: ".$logged_user_name;
//exit;
$userRole = $getusrdet[2];
if (isset($_GET['makeactive'])) { $makeactive=$_GET['makeactive']; } else { $makeactive = 0; }
$ur = 0; $ur_checked=""; $ur_class="bidbuttonhighlight2";
if (isset($_GET['ur'])) { 
	if ($_GET['ur']==1) { $ur=1; $ur_checked=" checked "; $ur_class="bidbuttonhighlight"; }
}
//search area filteration
$ascdesc = "";
$order = isset($_GET['sort'])?$_GET['sort']:'released';

/*if($_GET['type'][0] == 'Forecast'){
	$order = isset($_GET['sort'])?$_GET['sort']:'rfp_date';
}*/

$ascdesc = isset($_GET['ascdesc'])?$_GET['ascdesc']:'ASC';
switch(strtoupper($ascdesc))
  {
  case 'DESC': 
	  $ascdesc = 'ASC';
	  $ascstyle = "<i class='fa fa-sort' aria-hidden='true'></i>";
  break;
  case 'ASC': 
	  $ascdesc = 'DESC'; 
	  $ascstyle = "<i class='fa fa-sort' aria-hidden='true'></i>";
  break;
  default: 
	  $ascdesc = 'DESC';
	  $ascstyle = "<i class='fa fa-sort' aria-hidden='true'></i>";
  break;
  }
//manager name pull for serach query
if($_GET['mngr']!='') {
	$mngrname .= " AND manager = '" .$name. "' ";
	$favtext .= "<div style='padding-left:400px; font-size:18px; color:#3c4db0'>Assigned List</div>";
}
else
{
	$mngrname .= '';
	$favtext .= '';
}
// ***************************** Printing Search Query Starts Here. ********************** //
$search_string = '';
if(($_GET['dualsearch'] == '') && ($_GET['search'] != '')){
	$search_string .= "<strong>Text : </strong>".$_GET['search'];
}
if(($_GET['dualsearch'] == 'IS') && ($_GET['search'] != '')){
	$search_string .= "<strong>Incumbent Text : </strong>".$_GET['search'];;
}

/*
$incumbent_search_string = '';
if($_GET['dualsearch'] == 'IS'){
	$incumbent_search_string .= "<strong>Incumbent Text : </strong>".$_GET['search'];
}else{
	$incumbent_search_string = '';
}
*/
if($_GET['vehicle'] != '') {
	$vehicle_string = "<strong>&nbsp;&nbsp;Vehicle(s) : </strong>";
	for($i=0;$i<(count($_GET['vehicle']));$i++){
		if($i == count($_GET['vehicle'])-1){
			$vehicle_string .= $_GET['vehicle'][$i];
		}else{
			$vehicle_string .= $_GET['vehicle'][$i]." , ";
		}
	}
}else{
	$vehicle_string .= '';
}

if($_GET['type'] != '') {
	$type_string = "<strong>&nbsp;&nbsp;Type(s) : </strong>";
	for($i=0;$i<(count($_GET['type']));$i++) {
		if($i == count($_GET['type'])-1) {
			$type_string .= $_GET['type'][$i];
		}else {
			$type_string .= $_GET['type'][$i]." , ";
		}
	}
}else{
	$type_string .= '';
}

if($_GET['set_aside'] != '') {
	$set_aside_string = "<strong>&nbsp;&nbsp;Set-Aside(s) : </strong>";
	for($i=0;$i<(count($_GET['set_aside']));$i++) {
		if($i == count($_GET['set_aside'])-1) {
			$set_aside_string .= $_GET['set_aside'][$i];
		}else {
			$set_aside_string .= $_GET['set_aside'][$i]." , ";
		}
	}
}else{
	$set_aside_string .= '';
}

if($_GET['decision'] != '') {
	$decision_string = "<strong>&nbsp;&nbsp;Decision(s) : </strong>";
	for($i=0;$i<count($_GET['decision']);$i++){
		if($i == count($_GET['decision'])-1){
			$decision_string .= $_GET['decision'][$i];
		}else{
			$decision_string .= $_GET['decision'][$i]." , ";
		}
	}
}else{
	$decision_string .= '';
}


if($_GET['submitted'] == 'Submitted') {
	$phase_string = "<strong>&nbsp;&nbsp;Phase : </strong>" . $_GET['submitted'];	
}
if($_GET['archived'] == 'Archived'){
	$phase_string = "<strong>&nbsp;&nbsp;Phase : </strong>" . $_GET['archived'];
}
if(($_GET['archived'] == 'Archived') && ($_GET['submitted'] == 'Submitted')){
	$phase_string = "<strong>&nbsp;&nbsp;Phase : </strong>" . $_GET['submitted']." & ".$_GET['archived'];
}
/*
if($_GET['bnpphase'] != '') {
	$phase_string = "<strong>&nbsp;&nbsp;Phase : </strong>";
	$phase_string .= $_GET['bnpphase'];
}else{
	$phase_string .= '';
} */

$date_search_string = '';
if($_GET['datesearch'] != ''){

	if($_GET['sdate'] != '') {
		$sdate = date('Y-m-d',strtotime($_GET['sdate']));
	}
	else
	{
		$sdate = '2014-01-01';
	}

	if($_GET['edate'] != '') {
		$edate = date('Y-m-d',strtotime($_GET['edate']));
	}
	else
	{
		$edate = date('Y-m-d');
	}

	if($_GET['datesearch'] == 'BAD'){
		$date_search_string = "&nbsp;&nbsp;<strong>Bid Added Date : </strong>".date('m/d/Y',strtotime($sdate))." <strong> To </strong> ".date('m/d/Y',strtotime($edate));
	}
	if($_GET['datesearch'] == 'RED'){
		$date_search_string = "&nbsp;&nbsp;<strong>RFP Exp. Date : </strong>".date('m/d/Y',strtotime($sdate))." <strong> To  </strong> ".date('m/d/Y',strtotime($edate));
	}
}
// ************************** Printing Search Query Ends Here. ************************* //
if($_GET['datesearch'] != '') {
	if($_GET['datesearch'] == 'BAD'){
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{   
			$proposalduedate = " AND (DATE(et.creation_timestamp) BETWEEN '".$sdate."' AND '".$edate."' AND response = 'Forecast')";
		}
		else
		{
			$proposalduedate = '';
		} 
	}
	if($_GET['datesearch'] == 'RED')
	{
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{    
			$releaseddate = " AND (DATE(et.rfp_date) BETWEEN '".$sdate."' AND '".$edate."' AND response = 'Forecast')";
		}
		else
		{
			$releaseddate = '';
		} 
	}         
}
//print_r($_GET);exit;
$fav_str = array();
if($_GET['favlist'] != '') {
	if($getusrdet['myfav_bids'] != '') {
		$fav_bids_arr = json_decode($getusrdet['myfav_bids'], TRUE);
		$bids_array	  = array_keys($fav_bids_arr);
	$fav_str = "(";
	$fav_str .= implode(', ', $bids_array);
	$fav_str .= ")"; 
//	echo $fav_str; exit;
	$favlist .= " AND et.dont_show_agenda = 1 AND et.opportunity_id IN ".$fav_str;
	$favtext .= "<div style='padding-left:351px; font-size:18px; color:#3c4db0'>8(a) Opportunities Favorite List</div>";
	}
	else
	{
		$favlist .= " AND et.opportunity_id IN (0000)";
		$favtext .= '';
	}
}
else
	{
	$favlist .= '';
	}
if($_GET['favshow'] == "yes") { $checked = "checked='checked'"; }

if($_POST['vehtype']!='') {
	$vehtype .= " AND et.contractveh_table LIKE '%".$_POST['vehtype']."%'";
}
else
{
	$vehtype .= '';
}

	if($_GET['archived'] == 'Archived') {
		//$_GET['archived'] == 'Archived';
		$_GET['_mode'] = 'Opportunities';
		$sttype .= " AND et.status='Archived'";
	}

/*	if ($_GET['submitted'] == 'Submitted') {
		//$_GET['submitted'] == 'Submitted';
		$_GET['_mode'] = 'Opportunities';
		$sttype .= " AND et.is_submitted='true'";
	}
	
	if (($_GET['archived'] == 'Archived') &&  ($_GET['submitted'] == 'Submitted')) {
		$_GET['_mode'] = 'Opportunities';
		$sttype .= " AND et.status='Archived' AND et.is_submitted='true'";
	}

	if ($_GET['sub_and_can'] == 'Archived') {
		$_GET['_mode'] = 'Opportunities';
		$sttype .= " AND et.is_submitted='true' AND et.is_archived='Cancelled'";
	} */
//}
else
{
	$sttype .= '';
} 
//end here
$search_this= ""; $urlsearch = "";
//echo $_GET['search'];
if(!empty($_GET['dualsearch'])) { 
	$_GET['_mode'] = 'Opportunities';
}

if(!empty($_GET['search'])) { 
	$_GET['_mode'] = 'Opportunities';
	
$urlsearch = trim($_GET['search']); 
$_SESSION["search"]=$urlsearch;
$queryurlsearch = " AND (et.bidopp LIKE '%$urlsearch%' OR et.response LIKE '%$urlsearch%' OR et.requestor LIKE '%$urlsearch%' OR et.title LIKE '%$urlsearch%' OR et.pop LIKE '%$urlsearch%' OR et.synopsis LIKE '%$urlsearch%' OR et.recruiting LIKE '%$urlsearch%' OR et.decision LIKE '%$urlsearch%' OR et.opportunity_id LIKE '%$urlsearch%' OR et.contractveh_table LIKE '%$urlsearch%') "; } else { 
$urlsearch = ""; $queryurlsearch=""; $urlmode=" AND et.status_value > 0 "; }
$vehicles_selected = 0;
$for_each_vehicle = 0;
if(isset($_GET['vehicle'])) { $vehicles_selected=count($_GET['vehicle']); 
		$queryvehicle = "";
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['vehicle'] as $vehselected) 
			{
				$for_each_vehicle++;
				/*if ($for_each_vehicle==1) { $queryvehicle .= " AND (contract_vehicle LIKE '%" . $vehselected . "%'"; }
				if ($for_each_vehicle> 1) { $queryvehicle .= " OR contract_vehicle LIKE '%" . $vehselected . "%'"; }*/
				if ($for_each_vehicle==1) { $queryvehicle .= " AND (et.contractveh_table LIKE '%" . $vehselected . "%' AND response = 'Forecast'"; }
				if ($for_each_vehicle> 1) { $queryvehicle .= " OR et.contractveh_table LIKE '%" . $vehselected . "%' AND response = 'Forecast'"; }
			}
			$queryvehicle .= ")";
		} 
	else { $queryvehicle = ""; }


$decision_selected=0;
$selected_type_count = 0;
$set_aside_selected = 0;
$phase_selected=0;
$for_each_decision = 0;
$for_each_type = 0;
$for_each_phase = 0;

/* **************************  framing type query starts here.  ****************************** */
	if(isset($_GET['type'])) { 
	$selected_type_count = count($_GET['type']); 
		$querytype = ""; 
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['type'] as $type_selected) 
			{
				$for_each_type++;
				if($for_each_type==1) { $querytype .= " AND (et.response = '$type_selected'"; }
				if($for_each_type > 1) { $querytype .= " OR et.response = '$type_selected'"; }
			}
			$querytype .= ")"; 
		} 
	else { $querytype = ""; }
/* *********************** framing type query ends here.  ******************************* */
// Filter Query for Set-Aside Starts Here.
if(isset($_GET['set_aside'])) { $set_aside_selected=count($_GET['set_aside']); 
		$querysetaside = "";
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['set_aside'] as $set_aside_select) 
			{
				$for_each_set_aside++;
				if ($for_each_set_aside==1) { $querysetaside .= " AND (et.contractveh_table LIKE '%" . $set_aside_select . "%' AND response = 'Forecast'"; }
				if ($for_each_set_aside>1) { $querysetaside .= " OR et.contractveh_table LIKE '%" . $set_aside_select . "%' AND response = 'Forecast'"; }
			}
			$querysetaside .= ")";
		} 
	else { $querysetaside = ""; }
// Filter Query for Set-Aside Ends Here.
if(isset($_GET['decision'])) { 
	$decision_selected=count($_GET['decision']); 
		$querydecision = ""; 
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['decision'] as $dec_selected) 
			{
				$for_each_decision++;
				if($for_each_decision==1) { $querydecision  .= " AND (et.decision = '$dec_selected' AND response = 'Forecast'"; }
				if($for_each_decision > 1) { $querydecision .= " OR et.decision   = '$dec_selected' AND response = 'Forecast'"; }
				if($for_each_decision > 1) { $querydecision .= " OR et.decision   = '' AND response = 'Forecast'"; }
			}
			$querydecision .= ")"; 
		} 
	else { $querydecision = ""; }
// Code to display selected count for phase dropdown Starts Here.
	if(isset($_GET['submitted'])) { $phase_selected= 1; }
	if(isset($_GET['archived'])) { $phase_selected= 1; }
	if(isset($_GET['submitted']) && isset($_GET['archived'])) { $phase_selected= 2; }
	if(isset($_GET['sub_and_can'])) { $phase_selected= 1; }
// Code to display selected count for phase dropdown Ends Here.
if(strlen($urlsearch)>0) { $querystatus = ""; } 
$queryurlmode="";
$start_empty="";
if(!empty($_GET['_mode']))  { $urlmode = $_GET['_mode']; } else { $queryurlmode=" AND et.status_value>0 "; }
	if($urlmode=='Opportunities') { $queryurlmode=" AND et.status_value>-1 "; }
	if($urlmode=='Agenda') { $queryurlmode=" AND et.status_value>0 "; }

$header_all = "<div class='div-table header'>
				<div style='display:inline-block; width:27px; vertical-align:top; padding-top: 9px;'>#</div>
				<div class='sortable' data-col='vehicle' style='display:inline-block; width:88px; vertical-align:top; padding-top: 9px;'>Vehicle<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<!--<div style='display:inline-block; width:99px; vertical-align:top; line-height: 17px;'>Expected Release Date</div>-->
				<div class='sortable' data-col='contract_exp_date' style='display:inline-block; width:103px; vertical-align:top; line-height: 17px;'>Contract <br/>Expiry Date<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<!--<div style='display:inline-block; width:114px; vertical-align:top; padding-top: 11px;'>Release</div>
				<div style='display:inline-block; width:110px; vertical-align:top;'>&nbsp;</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Type</div>-->
				<div class='sortable' data-col='naics' style='display:inline-block; width:66px; vertical-align:top; padding-top: 9px;'>NAICS<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<div class='sortable' data-col='department' style='display:inline-block; width:96px; vertical-align:top; padding-top: 9px;'>Department<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<!-- <div style='display:inline-block; width:120px; vertical-align:top;'>Set-Aside</div> -->
				<div class='sortable' data-col='clearance' style='display:inline-block; width:82px; vertical-align:top; padding-top: 9px;'>Clearance<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<div class='sortable' data-col='contract_value' style='display:inline-block; width:108px; vertical-align:top; padding-top: 9px;'>Contract Value<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<div class='sortable' data-col='title' style='display:inline-block; width: 405px; vertical-align:top; padding-top: 9px;'>Title<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				</div>";
$urlcontainer = "";
if ($urlmode=='Opportunities') { $urlcontainer = "<div class='title_bar'>$header_all</div>"; }
?>
<?php
//MANAGERS PULL
$manager_list = "";
$manager_query = "SELECT manager_name FROM managers WHERE access_type='F' OR access_type='B' AND manager_show=1 ORDER BY manager_name";
$manager_result = mysqli_query($mysqli_link, $manager_query);
while($row = mysqli_fetch_array($manager_result, MYSQLI_NUM))
    {
		$db_manager_name = $row[0];
		$manager_list .= "<option value='$db_manager_name'>$db_manager_name</option>";
	}
//VEHICLE PULL
$vehicle_list = "";
$vehicle_checkboxes = "";
$vehicle_query = "SELECT vehicle_id, vehicle_name FROM contract_vehicles WHERE vehicle_show=1 ORDER BY vehicle_name";
$vehicle_result = mysqli_query($mysqli_link, $vehicle_query);
while($row = mysqli_fetch_array($vehicle_result, MYSQLI_NUM))
    {
	$db_vehicle_name = $row[1];
	//$vehicle_list .= "<option value='$db_vehicle_name'>$db_vehicle_name</option>";

		if (isset($_GET['vehicle']))  
		{
			if(in_array($db_vehicle_name, $_GET['vehicle']))
			{
			//echo "Option1 was checked!";
				$vehicle_checkboxes .= "<input type='checkbox' id='vehicle'".$db_vehicle_name." name='vehicle[]' value='$db_vehicle_name' checked>
							  <label for='vehicle'".$db_vehicle_name."> $db_vehicle_name</label><br>";
			}
			else
			{
				$vehicle_checkboxes .= "<input type='checkbox' id='vehicle'".$db_vehicle_name." name='vehicle[]' value='$db_vehicle_name'>
							  <label for='vehicle'".$db_vehicle_name."> $db_vehicle_name</label><br>";
			}
		}
		else
		{
			$vehicle_checkboxes .= "<input type='checkbox' id='vehicle".$db_vehicle_name."' name='vehicle[]' value='$db_vehicle_name'>
							  <label for='vehicle".$db_vehicle_name."'> $db_vehicle_name</label><br>";
		}
	}
$types_array = array();
$types_array = $_GET['type'];
$IDChecked = ""; $RFIChecked = ""; $DRFPChecked = ""; $RFPChecked = ""; $RFQChecked = "";

if((!empty($types_array)) && (in_array('Industry Day',$types_array))) {$IDChecked = "checked='cheked'";}else{$IDChecked = "";}
if((!empty($types_array)) && (in_array('RFI',$types_array))) {$RFIChecked = "checked='cheked'";}else{$RFIChecked = "";}
if((!empty($types_array)) && (in_array('Draft RFP',$types_array))) {$DRFPChecked = "checked='cheked'";}else{$DRFPChecked = "";}
if((!empty($types_array)) && (in_array('RFP',$types_array))) {$RFPChecked = "checked='cheked'";}else{$RFPChecked = "";}
if((!empty($types_array)) && (in_array('RFQ',$types_array))) {$RFQChecked = "checked='cheked'";}else{$RFQChecked = "";}
if((!empty($types_array)) && (in_array('Forecast',$types_array))) {$ForecastChecked = "checked='cheked'";}else{$ForecastChecked = "";}


$set_aside_array = array();
$set_aside_array = $_GET['set_aside'];
$aChecked = ""; $assChecked = ""; $HZChecked = ""; $WOChecked = ""; $URChecked = ""; $SBChecked = "";

if((!empty($set_aside_array)) && (in_array('8(a) Competed',$set_aside_array))) {$aChecked = "checked='cheked'";}else{$aChecked = "";}
if((!empty($set_aside_array)) && (in_array('8(a) Sole-Source',$set_aside_array))) {$assChecked = "checked='cheked'";}else{$assChecked = "";}
if((!empty($set_aside_array)) && (in_array('HUBZone',$set_aside_array))) {$HZChecked = "checked='cheked'";}else{$HZChecked = "";}
if((!empty($set_aside_array)) && (in_array('Woman Owned',$set_aside_array))) {$WOChecked = "checked='cheked'";}else{$WOChecked = "";}
if((!empty($set_aside_array)) && (in_array('Unrestricted',$set_aside_array))) {$URChecked = "checked='cheked'";}else{$URChecked = "";}
if((!empty($set_aside_array)) && (in_array('Small Business',$set_aside_array))) {$SBChecked = "checked='cheked'";}else{$SBChecked = "";}
//echo $IDChecked;
//Decision List
//$decision_list = "";
$decision_checkboxes = "";
$type_checkboxes = "";
$decision_query = mysqli_query($mysqli_link,"SELECT decision_id,decision_name FROM decision WHERE decision_show=1 ORDER BY decision_id");
foreach($decision_query as $dec_item)
    {
	$db_decision_name = $dec_item['decision_name'];
	$db_decision_id = $dec_item['decision_id'];				  
		if (isset($_GET['decision']))  
		{
			if(in_array($db_decision_name, $_GET['decision']))
			{
			//echo "Option1 was checked!";
				$decision_checkboxes .= "<input type='checkbox' id='decision".$db_decision_name."' name='decision[]' value='$db_decision_name' checked>
							  <label for='decision".$db_decision_name."'> $db_decision_name</label><br>";
			}
			else
			{
				$decision_checkboxes .= "<input type='checkbox' id='decision".$db_decision_name."' name='decision[]' value='$db_decision_name'>
							  <label for='decision".$db_decision_name."'> $db_decision_name</label><br>";
			}
		}
		else
		{
			$decision_checkboxes .= "<input type='checkbox' id='decision".$db_decision_name."' name='decision[]' value='$db_decision_name'>
							  <label for='decision".$db_decision_name."'> $db_decision_name</label><br>";		
		}	
	}
// End of Decision List
?>
<!DOCTYPE html>
<html 'en-US'>
<head>
<title><?php print $this_page_name; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="styles/modal.css">
<link rel="stylesheet" href="styles/1.css">
<link rel="stylesheet" href="styles/rcs.css">
<link rel="stylesheet" href="styles/pagination.css">
<link rel="stylesheet" href="fonts/fonts.css">
<link rel="stylesheet" href="styles/search.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">
<?php include("includes/inline-styles.php"); ?>
.bid_edit { display:none; }
.bid_show { display:block; }
.light_grey_fade2 {
    background: #ffffff;
    background: -moz-linear-gradient(top,  #ffffff 0%, #f1f1f1 50%, #e1e1e1 51%, #f6f6f6 100%);
    background: -webkit-linear-gradient(top,  #ffffff 0%,#f1f1f1 50%,#e1e1e1 51%,#f6f6f6 100%);
    background: linear-gradient(to bottom,  #ffffff 0%,#f1f1f1 50%,#e1e1e1 51%,#f6f6f6 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0 );
}
.active_bar, .opp_container:hover { background-color: #3b51b1; color: #fff; font-weight: 700; font-size: 12px; }
.active_bar { background-color: #3b51b1 !important; color: #fff !important; font-weight: 700; font-size: 12px; }
.opp_container { font-size: 12px; border-bottom: 1px solid #efeff1; /*#848484;*/
    /*border-top: 1px solid #c4c5c8;*/
    border-left: 1px solid #c4c5c8;
    border-right: 2px solid #848484; cursor: pointer;}
.bidbuttonhighlight { background: linear-gradient(#3093e7, #173a85); }
.bidbuttonhighlight2 { background: linear-gradient(#FFF, #f0f0f0); }
.bidbuttonhighlight:hover { background: linear-gradient(#3198ef, #1d56d0); }

/*---------------------------- Added for sorting purpose Starts Here. -----------------------------------*/
.arrows {
    display: inline-flex;
    flex-direction: column;
    margin-left: 4px;
    line-height: 10px;
    font-size: 11px;
}
.arrows span {
    color: rgba(255,255,255,0.4); /* inactive */
}

.sortable {
    cursor: pointer;
    position: relative;
}
.sortable.asc .up {
    color: #fff;
}
.sortable.desc .down {
    color: #fff;
}

.sortable1 {
    cursor: pointer;
    position: relative;
}
.sortable1.asc .up {
    color: #fff;
}
.sortable1.desc .down {
    color: #fff;
}

.sortable2 {
    cursor: pointer;
	position: relative;
}
.sortable2.asc .up {
    color: #fff;
}
.sortable2.desc .down {
    color: #fff;
}

.div-table {
    display: flex;
    border-bottom: 1px solid #ddd;
    padding: 8px;
}
.div-table.header {
    background: #293466;
    color: white;
    font-weight: bold;
}
.div-table.row {
    background: #fff;
	color:#000;
}
.div-table.row:hover { background-color: #3b51b1; color: #fff; cursor: pointer; font-size: 12px; }


.div-table1 {
    display: flex;
    border-bottom: 1px solid #ddd;
    padding: 8px;
}
.div-table1.header {
    background: #293466;
    color: white;
    font-weight: bold;
}
.div-table1.row {
    background: #fff;
	color:#000;
}
.div-table1.row:hover { background-color: #3b51b1; color: #fff; cursor: pointer; font-size: 12px; }


.div-table2 {
    display: flex;
    border-bottom: 1px solid #ddd;
    padding: 8px;
}
.div-table2.header {
    background: #293466;
    color: white;
    font-weight: bold;
}
.div-table2.row {
    background: #fff;
	color:#000;
}
.div-table2.row:hover { background-color: #3b51b1; color: #fff; cursor: pointer; font-size: 12px; }


.col {
    flex: 1;
}
/*---------------------------- Added for sorting purpose Ends Here. --------------------------------------*/

</style>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $baseurl; ?>/styles/style.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
</head>
<body>
<?php 
if (isset($profile_first_name)) { $login_name=$profile_first_name; } else { $login_name="Login"; }
//include("includes/header.php"); 
?>
<div style="position:fixed; width:100%; z-index:2; height:100px;" class="topnav" id="myTopnav"> 
	  <div style="display: inline;top:9px; left:20px; position:relative; float:left; font-family:'Segoe UI';">
		<span style="font-size:15px; font-weight:700; color:#fff;"><a href="<?php echo $baseurl; ?>/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review">BidPortal V2.0</a></span>&nbsp;&nbsp;&nbsp;

	  <a class="default-btn" href="<?php echo $baseurl; ?>/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review">Agenda</a>&nbsp;&nbsp; 
	  <a class="default-btn active1" href="<?php echo $baseurl; ?>/fc_agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review">8(a) Opportunities</a></div>
</div>
<div style="z-index:3; margin-left:25%; position:fixed; right: 27px; top:9px;">
  		<div style="display: inline; float: right; position:relative; font-size:15px; font-weight:700; color:#fff; font-family:'Segoe UI">
		<?php
		if($_SESSION['access_level']=='103') { ?>
		<a href="https://ardentinc.com/statebids/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review" target="_blank" style="color:#fff; text-decoration: none;">Switch to State</a>&nbsp;|&nbsp;<?php } echo $logged_user_name; ?></div>
</div>
<form id="bidportal" action="" method="get" style="margin:0px; padding:0px;">
<div style="height:42px;"></div>
<div id='menu_group' style="width: 96%;
    margin-left: 2%;
    z-index: 2;
    padding: 1px 10px;
    background-color: rgba(0,0,0,0.1);
    position: fixed;
    -webkit-box-shadow: inset 0px 0px 17px -1px rgba(0,0,0,.7);
    -moz-box-shadow: inset 0px 0px 17px -1px rgba(0,0,0,.7);
    box-shadow: inset 0px 0px 17px -1px rgba(0,0,0,.7);">
    <div class="btn-group">
        <?php
		$getmngr = mysqli_query($mysqli_link,"SELECT manager_name FROM managers WHERE manager_name LIKE '%$name%'"); ?>
		<div class="btn-group" style='float:left; font-size:15px; font-weight:700; padding-top: 10px; padding-left: 2px;'>
			<ul id="nav">
				<li>
				<button type="button" class="collapsible"><img src="<?php echo $baseurl; ?>/images/menu-ico.png" style="margin-right: 10px; margin-top: 7px;"></button>

			<div class="content">
			<ul>
			<?php if($userRole == 'admin') {?>
				<li><a href="<?php echo $baseurl;?>/add_contract_vehicle.php" target="_blank">Add Contract Vehicle</a></li>
				<li><a href="<?php echo $baseurl;?>/add_manager.php" target="_blank">Add Manager</a></li>
			<?php } ?>
				<li><a href="<?php echo $baseurl;?>/addrole_add_opportunity.php" target="_blank">Manage Ops</a></li>
			<?php if(mysqli_num_rows($getmngr) > 0) { ?>
			  <li><a href="<?php echo $baseurl; ?>/agenda.php?search=&_mode=Agenda&mngr=rusvk54m">Assigned List</a></li>
			  <?php } ?>
			  <li><a href="<?php echo $baseurl; ?>/agenda.php?search=&_mode=Agenda&favlist=jklms27v">Favorite List</a></li>
			  <li><a href="<?php echo $baseurl;?>/advanced_search.php" target="_blank">Advanced Search</a></li>
			  <li><a href="<?php echo $baseurl;?>/changepwd.php">Change Password</a></li>
			  <li><a href="<?php echo $baseurl;?>/logout.php">Logout</a></li>
			</ul>
			</li>
		</ul></div>
        <div style="display:inline-block;"> 
            <div class="btn-group" style='float:left;'>
				<div style='text-align:center; color:#fff; font-size:12px; color:#c6c7d8; margin-left:-4px;'>
					<select name="dualsearch" id="dualsearch">
						<option value="">Search text&nbsp;.&nbsp;.&nbsp;.&nbsp;.&nbsp.</option>
						<option value="IS"<?php if($_GET['dualsearch']=='IS') { echo "selected"; }  ?>>Search incumbent</option>
					</select>
				</div>
				<div style='color:#fff; font-size:12px; color:#c6c7d8; padding-top:5px;'>
					<input type="text" name="search" id="search" placeholder="Search text&nbsp;.&nbsp;.&nbsp;.&nbsp;.&nbsp;." autocomplete="off" style="width:96%;" value="<?php if($_GET['search'] != '') {echo $_GET['search'];} else { echo "";
					} ?>">
<!--				<input type="text" name="incumbent_search" id="incumbent_search" placeholder="Search incumbent&nbsp;.&nbsp;.&nbsp;.&nbsp;.&nbsp;." autocomplete="off" style="width:96%;" value="<?php //if(($_GET['incumbent_search'] != "")) {echo $_GET['incumbent_search'];} else{ echo ""; } ?>">   -->
				</div>
			</div>

            <div class="btn-group" style='float:left;'> 
                <div style='text-align:left; font-weight:700; color:#fff; font-size:12px; color:#c6c7d8; padding-top:4px;'>Contract Vehicle</div>
                <div class="dropdown">
                <div name="_status2" id="_status2" onclick="dropvehicle()" class="dropbtnopen" style='width: 120px;
    margin-right: 10px; display: inline-block; background: #fff; padding-left: 4px;
    border: 1px solid #2a2d3a; padding-bottom: 1px; margin-top:2px;'>
                <?php print ($vehicles_selected . " Selected" ); ?>
                </div>
                  <div id="myDropdown4" class="dropdown-content" style="top:26px; left:-1px; padding-left:5px; padding-top:4px; font-size:12px; background-color:#fff; min-width: 131px;">
                  		<?php print $vehicle_checkboxes; ?>
    					<!-- <input type="submit" class='select_color' style="float: right; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="Apply"> -->
                       <input type="button" onclick="select_all_boxes();" class='select_color' style="float: left; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="All">
                        <input type="button" onclick="select_no_boxes();" class='select_color' style="float: left; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="None">	
                  </div>
                </div>
        	</div>

<!------------------------------- Set Aside Filter Starts Here. --------------------------------------->
<div class="btn-group" style='float:left;'> 
<div style='text-align:left; font-weight:700; color:#fff; font-size:12px; color:#c6c7d8; padding-top:4px;'>Set-Aside</div>
<div class="dropdown">
<div name="_status9" id="_status9" onclick="dropsetaside()" class="dropbtnopen" style='width: 120px;
margin-right: 10px; display: inline-block; background: #fff; padding-left: 4px;
border: 1px solid #2a2d3a; padding-bottom: 1px;  margin-top:2px;'>
<?php print ($set_aside_selected. " Selected"); ?>
</div>
  <div id="myDropdown9" class="dropdown-content" style="top:26px; left:-1px; padding-left:5px; padding-top:4px; font-size:12px; background-color:#fff; min-width: 131px">
		<input type='checkbox' id='8(a) Competed' name='set_aside[]' value='8(a) Competed' <?php echo $aChecked;?>>
			<label for='8(a) Competed'>8(a) Competed</label><br>
		<input type='checkbox' id='8(a) Sole-Source' name='set_aside[]' value='8(a) Sole-Source' <?php echo $assChecked;?>>
			<label for='8(a) Sole-Source'>8(a) Sole-Source</label><br>
		<input type='checkbox' id='HUBZone' name='set_aside[]' value='HUBZone' <?php echo $HZChecked;?>>
			<label for='HUBZone'>HUBZone</label><br>
		<input type='checkbox' id='Woman Owned' name='set_aside[]' value='Woman Owned' <?php echo $WOChecked;?>>
			<label for='Woman Owned'>Woman Owned</label><br>
		<input type='checkbox' id='Unrestricted' name='set_aside[]' value='Unrestricted' <?php echo $URChecked;?>>
			<label for='Unrestricted'>Unrestricted</label><br>
		<input type='checkbox' id='Small Business' name='set_aside[]' value='Small Business' <?php echo $SBChecked;?>>
			<label for='Small Business'>Small Business</label><br>
		<input type="button" onclick="select_all_set_aside_boxes();" class='select_color' style="float: left; 
margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="All">
		<input type="button" onclick="select_no_set_aside_boxes();" class='select_color' style="float: left; 
margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="None">	
  </div>
  </div></div>
<!-------------------------------------- Set Aside Filter Ends Here. ------------------------------------>
<!-- Decision filter -->
<div class="btn-group" style='float:left;'> 
<div style='text-align:left; font-weight:700; color:#fff; font-size:12px; color:#c6c7d8; padding-top:4px;'>Decision</div>
<div class="dropdown">
<div name="_status3" id="_status3" onclick="dropdecision()" class="dropbtnopen" style='width: 120px;
margin-right: 10px; display: inline-block; background: #fff; padding-left: 4px;
border: 1px solid #2a2d3a; padding-bottom: 1px;  margin-top:2px;'>
<?php print ($decision_selected . " Selected" ); ?>
</div>
  <div id="myDropdown5" class="dropdown-content" style="top:26px; left:-1px; padding-left:5px; padding-top:4px; font-size:12px; background-color:#fff; min-width: 153px">
		<?php print $decision_checkboxes; ?>
		<!-- <input type="submit" class='select_color' style="float: right; 
margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="Apply"> -->
		<input type="button" onclick="select_dec_all_boxes();" class='select_color' style="float: left; 
margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="All">
		<input type="button" onclick="select_dec_no_boxes();" class='select_color' style="float: left; 
margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="None">	
  </div>
</div>
</div>
<!-- Decision filter -->
<!-- Archived filter -->
<div class="btn-group" style='float:left;'> 
<div style='text-align:left; font-weight:700; color:#fff; font-size:12px; color:#c6c7d8; padding-top:5px;'>Phase</div>
<div class="dropdown">
<div name="_status4" id="_status4" onclick="dropPhase()" class="dropbtnopen" style='width: 120px;
margin-right: 10px; display: inline-block; background: #fff; padding-left: 4px;
border: 1px solid #2a2d3a; padding-bottom: 1px;  margin-top:2px;'>
<?php print ($phase_selected . " Selected" ); ?>
</div>

<div id="myDropdown6" class="dropdown-content" style="top:26px; left:-1px; padding-left:5px; padding-top:4px; font-size:12px; background-color:#fff; min-width: 145px">
		<input type="checkbox" id="archived" name="archived" value="Archived" <?php if($_GET['archived'] == 'Archived') {echo "checked='checked'";}?>>
		<label for='archived'>Archived</label><br/>
<!--		<input type="checkbox" id="submitted" name="submitted" value="Submitted" <?php //if($_GET['submitted'] == 'Submitted') {echo "checked='checked'";}?>>
		<label for='submitted'>Submitted</label> <br/>
		<input type="checkbox" id="sub_and_can" name="sub_and_can" value="Archived" <?php //if($_GET['sub_and_can'] == 'Archived') {echo "checked='checked'";}?>>
		<label for='sub_and_can'>Submitted & Cancelled</label>  -->
</div>
<!--	
<select name="bnpphase" style="height:23px">
	<option value="">Select</option>
	<option value="Archived"<?php //if($_GET['bnpphase']=='Archived') { echo "selected"; }  ?>>Archived</option>
	<option value="Submitted"<?php //if($_GET['bnpphase']=='Submitted') { echo "selected"; }  ?>>Submitted</option>
	<option value="Archived & Submitted"<?php //if($_GET['bnpphase']=='Archived & Submitted') { echo "selected"; }  ?>>Archived & Submitted</option>
</select> -->
		<!-- <input type="submit" class='select_color' style="float: right; 
margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="Apply"> -->
</div>
</div>
<!--
<div class="btn-group" style='float:left;'> 
<div style='text-align:left; font-weight:700; color:#fff; font-size:12px; color:#c6c7d8; padding-top:5px;'>Archived</div>
<div class="dropdown">
 <input style="width:45px; height:22px;" type="checkbox" name="bnpphase" id="bnpphase" value="Archived" <?php //if($_GET['bnpphase']=='Archived') { echo "checked"; }  else { echo ""; }?> >
</div>
</div> -->
<!-- Date filter -->
<div class="btn-group" style='float:left;'> 
<div style='text-align:center; color:#fff; font-size:12px; color:#c6c7d8;'>
<select name="datesearch" id="datesearch" style='margin-right: -2px; margin-left: -108px;'>
<option value="">Select date type</option>
<option value="BAD"<?php if($_GET['datesearch']=='BAD') { echo "selected"; }  ?>>Bid Added date</option>
<option value="RED"<?php if($_GET['datesearch']=='RED') { echo "selected"; }  ?>>RFP Exp. date</option>
</select> 
 <input type="checkbox" name="fc_favourite_bids" id="fc_favourite_bids" style="margin-left: 12px; width: 15px;     height: 15px; margin-right: 4px;" <?php echo $checked;?>><span style="color:#ffff00">My Favorites</span>
</div>
<div style="top:26px; left:-1px; padding-left:5px; padding-top:4px; font-size:12px;">
<input type="date" name="sdate" id="sdate" value="<?php if(isset($_GET['sdate'])) { echo $_GET['sdate']; } else { echo ""; }  ?>" >&nbsp;<input type="date" name="edate" id="edate" value="<?php if(isset($_GET['edate'])) { echo $_GET['edate']; } else { echo ""; }  ?>">
<input type="submit" name="datesubmit" class='select_color' style=" 
border-radius: 5px; font-size: 12px; padding-bottom:2px; font-weight: bold; margin-left: 5px;" value="Submit">

<input type="button" name="clearFilters" class='select_color' style=" 
border-radius: 5px; font-size: 12px; padding-bottom:2px; font-weight: bold; margin-left: 3px;" value="Clear" onClick="clearFilterFields();">
</div>
</div>
</div>

<!-- Checkbox for Favorite Bids. -->

<!--
<a style="cursor:pointer;" href="<?php //echo $baseurl;?>/agenda.php?search=&_mode=Agenda&favlist=jklms27v"> <font color="#FFFF" style="margin-left: 225px;">My Favorite Bids</font> 
<img src="images/star-gray.gif" border="0" title="Click to See Your Favourites" style="width:18px; width: 27px; margin-top: -20px; height: 27px; margin-bottom: 5px;"> 
</a> -->
</div> 
</div>

<div style="clear:both; height:68px;"></div>
</form>
<?php
$entry_date2 = date("Y-m-d"); //Y-m-d h:i:sa
$entry_date1 = date('Y-m-d', strtotime($entry_date2 . ' -1 month'));

$filterarea = "";
//include("includes/filter_area.php");
$app_builder = "";
$count_results = 0;
$type_change = 0;
$tr_color = "background-color:#31335f;"; /* #98e0e0 */
$tr_font_color = "color:#fff; text-align:center;";
$tr_color .= $tr_font_color;
$header_part = "";
$table_content = "<DIV>$urlcontainer</div>";
$table_content_new = ""; 
$header_cpw = "<div style='display:inline-block; width:40px; vertical-align:top;'>#</div>
				<div style='display:inline-block; width:114px; vertical-align:top;'>RFP Exp.Date</div>
				<div style='display:inline-block; width:112px; vertical-align:top;'>&nbsp;</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Vehicle</div>
				<div style='display:inline-block; width:72px; vertical-align:top;'>Type</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Set-Aside</div>
				<div style='display:inline-block; width:160px;'>Manager</div>
				<div style='display:inline-block; vertical-align:top;'>Title</div>";

$header_rfp = "<div class='div-table2 header'>
				<div style='display:inline-block; width:40px; vertical-align:top;'>#</div>
				<div class='sortable2' data-col='rfp_exp_date' style='display:inline-block; width:114px; vertical-align:top;'>RFP Exp.Date<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<div style='display:inline-block; width:110px; vertical-align:top;'>&nbsp;</div>
				<div class='sortable2' data-col='vehicle' style='display:inline-block; width:120px; vertical-align:top;'>Vehicle<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<div class='sortable2' data-col='type' style='display:inline-block; width:72px; vertical-align:top;'>Type<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<div class='sortable2' data-col='set_aside' style='display:inline-block; width:120px; vertical-align:top;'>Set-Aside<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<div class='sortable2' data-col='manager' style='display:inline-block; width:160px;'>Manager<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<div class='sortable2' data-col='title' style='display:inline-block; vertical-align:top;'>Title<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				</div>";

$header_award = "<div style='display:inline-block; width:40px; vertical-align:top;'>#</div>
				<div style='display:inline-block; width:114px; vertical-align:top;'>Award Date</div>
				<div style='display:inline-block; width:110px; vertical-align:top;'>Est. PoP Start</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Vehicle</div>
				<div style='display:inline-block; width:72px; vertical-align:top;'>Type</div>
				<div style='display:inline-block; width:120px; vertical-align:top;'>Set-Aside</div>
				<div style='display:inline-block; width:160px;'>Manager</div>
				<div style='display:inline-block; vertical-align:top;'>Title</div>";

$header_ur =    "<div class='div-table1 header'>
				<div style='display:inline-block; width:40px; vertical-align:top;'>#</div>
				<div class='sortable1' data-col='rfp_exp_date' style='display:inline-block; width:114px; vertical-align:top;'>RFP Exp.Date<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<div style='display:inline-block; width:112px; vertical-align:top;'>&nbsp;</div>
				<div class='sortable1' data-col='vehicle' style='display:inline-block; width:120px; vertical-align:top;'>Vehicle<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<div class='sortable1' data-col='type' style='display:inline-block; width:72px; vertical-align:top;'>Type<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<div class='sortable1' data-col='set_aside' style='display:inline-block; width:126px; vertical-align:top;'>Set-Aside<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<div class='sortable1' data-col='manager' style='display:inline-block; width:117px;'>Manager<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				<div class='sortable1' data-col='title' style='display:inline-block; vertical-align:top;'>Title<span class='arrows'>
				<span class='up'>▲</span>
				<span class='down'>▼</span></span>
				</div>
				</div>";
/*
if($types_array[0] == 'Forecast'){
	$sort_column   = 'rfp_date';
	$sort_column2  = 'creation_timestamp';
	$firstColumn  = 'RFP Exp.Date';
	$secondColumn = 'Bid added date';
}else{
	$sort_column   = 'released';
	$sort_column2  = 'proposal_due';
	$firstColumn  = 'Release Date';
	$secondColumn = 'RFP Exp.Date';
}*/

$header_search = "<div style='display:inline-block; width:40px; vertical-align:top;'>#</div>

				<div style='display:inline-block; width:72px; vertical-align:top;'><a href='?".$srch_val."&sort=contract_vehicle&ascdesc=".$ascdesc."'>Vehicle $ascstyle</a></div>

				<div style='display:inline-block; width:99px; vertical-align:top;'><a href='?".$srch_val."&sort=rfp_date&ascdesc=".$ascdesc."'>RFP Exp.Date $ascstyle</a></div>

				<div style='display:inline-block; width:99px; vertical-align:top;'><a href='?".$srch_val."&sort=ultimate_completion_date&ascdesc=".$ascdesc."'>Contract <br/>Expiry Date $ascstyle</a></div>

				<div style='display:inline-block; width:81px; vertical-align:top;'><a href='?".$srch_val."&sort=naics_code&ascdesc=".$ascdesc."'>NAICS<br/>Code $ascstyle</a></div>

				<div style='display:inline-block; width:108px; vertical-align:top;'><a href='?".$srch_val."&sort=agency&ascdesc=".$ascdesc."'>Department $ascstyle</a></div>

				<div style='display:inline-block; width:117px; vertical-align:top;'><a href='?".$srch_val."&sort=clearance_level&ascdesc=".$ascdesc."'>Clearance Level $ascstyle</a></div>

				<div style='display:inline-block; width:99px; text-align: left;'><a href='?".$srch_val."&sort=title&ascdesc=".$ascdesc."'>Contract Value $ascstyle</a></div>

				<div style='display:inline-block;  width:120px; vertical-align:top; text-align: center;'><a href='?".$srch_val."&sort=title&ascdesc=".$ascdesc."' style='margin-left: 27px;'>Title $ascstyle</a></div>";
// Code for Incumbent Search.
/*$header_incumbent_search = "<div style='display:inline-block; width:27px;											vertical-align:top;'>#</div>
				<div style='display:inline-block; width:99px; vertical-align:top;'><a href='?".$srch_val."&sort=released&ascdesc=".$ascdesc."'>Release Date $ascstyle</a></div>
				<div style='display:inline-block; width:99px; vertical-align:top;'><a href='?".$srch_val."&sort=released&ascdesc=".$ascdesc."'>Due Date $ascstyle</a></div>
				<div style='display:inline-block; width:99px; vertical-align:top;'><a href='?".$srch_val."&sort=released&ascdesc=".$ascdesc."'>Vehicle $ascstyle</a></div>
				<div style='display:inline-block; width:99px; vertical-align:top;'><a href='?".$srch_val."&sort=released&ascdesc=".$ascdesc."'>Type $ascstyle</a></div>
				<div style='display:inline-block; width:99px; vertical-align:top;'><a href='?".$srch_val."&sort=released&ascdesc=".$ascdesc."'>Manager $ascstyle</a></div>
				<div style='display:inline-block; width:207px; vertical-align:top;'><a href='?".$srch_val."&sort=released&ascdesc=".$ascdesc."'>Title $ascstyle</a></div>
				<div style='display:inline-block; width:81px; vertical-align:top;'><a href='?".$srch_val."&sort=released&ascdesc=".$ascdesc."'>Decision  $ascstyle</a></div>
				<div style='display:inline-block; width:199px; vertical-align:top;'><a href='?".$srch_val."&sort=released&ascdesc=".$ascdesc."'>Incumbent Name $ascstyle</a></div>";   */
// Ends Here.
// Code to get contract vehicles dynamically starts here.
$contract_vehicle_list = '';
$contract_vehicle_query = "SELECT vehicle_name FROM contract_vehicles WHERE vehicle_show =1 ORDER BY vehicle_name";
$contract_vehicle_result = mysqli_query($mysqli_link, $contract_vehicle_query);
while($row = mysqli_fetch_array($contract_vehicle_result, MYSQLI_NUM))
    {
		$contract_vehicle_name = $row[0];
		$contract_vehicle_list .= "<option value='$contract_vehicle_name'";
		if($_POST['vehtype'] == $contract_vehicle_name) 
			$contract_vehicle_list .= "selected = 'selected'"; 
			$contract_vehicle_list .= ">$contract_vehicle_name</option>";
	}
// Code to get contract vehicles dynamically ends here.
$table_content_a = "<div class='bp_label' style='display: inline-flex; padding-bottom: 5px;'>Agenda Item&nbsp;&nbsp;
<form name='vehpost' method='post' action=''>
    <select name='vehtype' onchange='this.form.submit()'>
      <option value=''>All</option>
		$contract_vehicle_list
    </select>
</form>$favtext</div><div class='title_bar'>$header_all</div>";
//$table_content_b = "<div class='bp_label' style='margin-top:20px;'>Current Proposal Workload</div><div class='title_bar'>$header_cpw</div>";
$table_content_c = "<div class='bp_label' style='margin-top:20px;'>RFP Tracking</div><div class='title_bar'>$header_rfp</div>";
if($_GET['mngr'] != '' || $_GET['favlist'] != '')
{
	//$table_content_d = "<div class='bp_label' style='margin-top:20px;'>Award Monitoring</div><div class='title_bar'>$header_award</div>";
	//$table_content_e = "<div class='bp_label' style='margin-top:20px;'>Under Review</div><div class='title_bar'>$header_cpw</div>";
}
else
{
	//$table_content_e = "";
	//$table_content_d = "<div class='bp_label' style='margin-top:20px;'>Award Monitoring</div>
	//<div class='title_bar'>$header_award</div>";
}
//echo "<pre>";
//print_r($_GET);
$table_content_e = "<div class='bp_label' style='margin-top:20px;'>Under Review</div><div class='title_bar'>$header_ur</div>";

//Added For ADDENDUMS.
/*
$addenndumsQuery = "SELECT count(*) FROM excel_test WHERE status='Archived' AND is_addendum=1";
$query_result = mysqli_query($mysqli_link, $addenndumsQuery);
$count = mysqli_fetch_array($query_result, MYSQLI_NUM);
if($count[0] > 0){
	$table_content_g = "<div class='bp_label' style='margin-top:20px;'>Addendums (Archived Opportunities)</div><div class='title_bar'>$header_cpw</div>";
}
//Ends Here.
*/
// Added To Fetch Decision Pending Opportunities.
$decision_pending_query = "SELECT count(*) FROM excel_test WHERE decision='Decision Pending / Hold'";
$decision_pending_query_result = mysqli_query($mysqli_link, $decision_pending_query);
$decision_pending_query_count = mysqli_fetch_array($decision_pending_query_result, MYSQLI_NUM);
if($decision_pending_query_count[0] > 0){
//	$table_content_h = "<div class='bp_label' style='margin-top:20px;'>Decision Pending / Hold </div><div class='title_bar'>$header_cpw</div>";
}
// Ends Here.
if($_GET['dualsearch'] == "") {
	$table_content_opp = "<div class='bp_label' style='margin-top:5px; margin-left: -8px;'>Search Details</div>
	<div class='title_bar'>$header_search</div>";
}   
elseif($_GET['dualsearch'] == "IS") {
	$table_content_opp = "<div class='bp_label' style='margin-top:5px; margin-left: -8px;'>Search Details</div>
	<div class='title_bar'>$header_incumbent_search</div>";
}
 
//$table_content_f = "<div class='bp_label' style='margin-top:20px;'>Archived</div><div class='title_bar'>$header_cpw</div>";


//if($urlmode=='Opportunities') { $table_content_a = ""; $table_content_b = ""; $table_content_c = ""; $table_content_d = ""; $table_content_e = ""; }
//AGENDA MODE
//if($urlmode=='Agenda') { $queryvehicle=""; }  
//INCLUDE
include("fc_agenda_insert.php");
//echo "Total Results Are :: ".$total_results;
if($urlmode=='Agenda')
{
	if($_GET['favshow'] == 'yes')
		print($filterarea . "<div style='padding-bottom: 30px;'><div class='clearfix ' style='display:inline-block;vertical-align:top;width:96%; margin-left:2%;'>" . $header_part . $table_content_a . $table_content_b . $table_content_c . $table_content_d . $table_content_e . $table_content_f . "</table>&nbsp;</div></div>"); 
	else
		print($filterarea . "<div style='padding-bottom: 30px;'><div class='clearfix ' style='display:inline-block;vertical-align:top;width:96%; margin-left:2%;'>" . $header_part . $table_content_a . $table_content_b . $table_content_c . $table_content_d . $table_content_e . $table_content_g. $table_content_h . "</table>&nbsp;</div></div>"); 
}
if($urlmode=='Opportunities')
{ 
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
echo "<div class='bp_label' style='margin-top: -5px;'>Searching for :: ". $search_string . $vehicle_string . $type_string . $set_aside_string . $decision_string . $phase_string . $date_search_string."</div>";
?>
<div class="text1" style='float: right;margin-right: 27px; margin-top: -20px; font-weight:bold; color:#337ab7;  text-decoration:none'><a class="hometext1" href="<?php echo $baseurl;?>/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review"><i class="fa fa-home" aria-hidden="true"></i> Home</a></div>
<div style="clear:both"></div>
<div id="pagination_div">
<div style="display:flex; margin-top: 3px;">
<?php if($total_results > 0) {  ?>
<div style='padding-left: 3px; padding-top: 7px; border-top: dotted 1px #CCC; margin-left: 2%; width: 15%'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
<!-- &nbsp;&nbsp;&nbsp;&nbsp;Total Records: <?php echo $total_results; ?></strong>-->
</div>
<?php } ?>
<div style='width:63%; text-align:center; font-weight:700; color:#464758;'>
	<ul class="pagination">
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?".$srch_val."&page_no=$previous_page'"; } ?>>Previous</a>
	</li>      
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}
	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?".$srch_val."&page_no=1'>1</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?".$srch_val."&page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?".$srch_val."&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";    }
		else {
        echo "<li><a href='?".$srch_val."&page_no=1'>1</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>  
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) {
	echo "href='?".$srch_val."&page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?".$srch_val."&page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
	} ?>
</ul>
</div>
<!--  Top Pagination Starts Here.   -->
<div style='width:18%; text-align:right; font-weight:700; color:#464758; padding-top: 7px;'>
<?php
$count_results = 50;
if(($urlmode != 'Agenda') && ($total_results >= 50)){
	if($page_no < $total_no_of_pages){
		print("<strong>Displaying&nbsp;:&nbsp; ".(($page_no-1)*($count_results)+1)." - ".($page_no)*$count_results." &nbsp;of &nbsp;$total_results</strong>");
	}
	if($page_no == $total_no_of_pages){
		print("<strong>Displaying&nbsp;:&nbsp; ".(($page_no-1)*($count_results)+1)." - ".$total_results." &nbsp;of &nbsp;$total_results</strong>");
	}
}
 else if(($urlmode != 'Agenda') && ($total_results < $count_results)){
	print("<strong>Displaying&nbsp;:&nbsp;  ".$total_results." &nbsp;of &nbsp;$total_results</strong>");
}
?>
	</div>
</div>
</div> <!-- Pagination Div ends Here. -->
<div style="clear:both"></div>
<!--  Top Pagination Ends Here.      -->
<!-- Search DropDown for Text & Incumbents.  -->
<?php if($_GET['dualsearch'] == '') { ?>
	<?php echo $filterarea; ?><div style='padding-bottom: 10px;'><div class='clearfix ' style='display:inline-block;vertical-align:top;width:98%; margin-left:2%;'><?php echo  
	$header_part . $table_content_opp; ?></div></div></table>
<?php } ?>

<?php if($_GET['dualsearch'] == 'IS') { ?>
	<?php echo $filterarea; ?><div style='padding-bottom: 10px;'><div class='clearfix ' style='display:inline-block;vertical-align:top;width:98%; margin-left:2%;'><?php echo  
	$table_content_opp . $incumbents_filter_data; ?></div></div></table>
<?php }?>
<!-- Ends Here.   ----->
<div style="display:flex; margin-top: 10px;">
<?php if($total_results > 0) { ?>
<div id="page_counter" style='padding: 10px 0px 0px; border-top: dotted 1px #CCC; margin-left: 2%; width: 15%'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
<!-- &nbsp;&nbsp;&nbsp;&nbsp;Total Records: <?php echo $total_results; ?>-->
</div>
<?php } ?>
<div style='width:63%; text-align:center; font-weight:700; color:#464758;'>
<ul class="pagination">
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?".$srch_val."&page_no=$previous_page'"; } ?>>Previous</a>
	</li>      
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}
	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?".$srch_val."&page_no=1'>1</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?".$srch_val."&page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?".$srch_val."&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";    }	
		else {
        echo "<li><a href='?".$srch_val."&page_no=1'>1</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) {
	echo "href='?".$srch_val."&page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?".$srch_val."&page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
	} ?>
</ul>
</div>
<?php }  ?>

<div style='width:18%; text-align:right; font-weight:700; color:#464758;'>
<?php
//echo $count_results.'--'.$total_results;
$count_results = 50;
if(($urlmode != 'Agenda') && ($total_results >= 50)){
	if($page_no < $total_no_of_pages){
		print("<strong>Displaying&nbsp;:&nbsp; ".(($page_no-1)*($count_results)+1)." - ".($page_no)*$count_results." &nbsp;of &nbsp;$total_results</strong>");
	}
	if($page_no == $total_no_of_pages){
		print("<strong>Displaying&nbsp;:&nbsp; ".(($page_no-1)*($count_results)+1)." - ".$total_results." &nbsp;of &nbsp;$total_results</strong>");
	}
}
 else if(($urlmode != 'Agenda') && ($total_results < $count_results)){
	print("<strong>Displaying&nbsp;:&nbsp;  ".$total_results." &nbsp;of &nbsp;$total_results</strong>");
}
?>
</div>
</div>
<div style="clear:both"></div>
<!-- End page content -->
</div>

<!-- Footer -->
<?php include("includes/footer.php"); ?>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>

<script>
function dropdownshow2() {
  document.getElementById("myDropdown2").classList.toggle("show");
}

window.onclick = function(event) {
	if (!event.target.matches('.dropbtn')) {
		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
		  var openDropdown = dropdowns[i];
		  if (openDropdown.classList.contains('show')) {
			openDropdown.classList.remove('show');
		  }
		}
	}
}

/*function hidevehicle() {
	alert('test');
document.getElementById("myDropdown4").classList.toggle("show");
}*/

function dropvehicle() {
	document.getElementById("myDropdown4").classList.toggle("show");
	//document.getElementById('search').value = '';
	document.getElementById("_mode").value = "Opportunities";
	document.getElementById("ur").checked = false;
	var ele=document.getElementsByName('status[]');  
	for(var i=0; i<ele.length; i++)
	{  
		   if(ele[i].type=='checkbox')
		   {  
				//if (i == 1) { ele[i].checked=true; }  else { ele[i].checked=false; }
				if (ele[i].value == 'Undecided') { ele[i].checked=true; }  else { ele[i].checked=false; }
		   }
	} 
}
/*document.getElementById("myDropdown4").addEventListener("onmouseout", function(event) {
	document.getElementById("myDropdown4").classList.remove("show");
});*/


function droptype() {
	document.getElementById("myDropdown8").classList.toggle("show");
	//document.getElementById('search').value = '';
	document.getElementById("_mode").value = "Opportunities";
	document.getElementById("ur").checked = false;
	var ele=document.getElementsByName('type[]');  
	for(var i=0; i<ele.length; i++)
	{  
		   if(ele[i].type=='checkbox')
		   {  
				//if (i == 1) { ele[i].checked=true; }  else { ele[i].checked=false; }
				if (ele[i].value == 'Undecided') { ele[i].checked=true; }  else { ele[i].checked=false; }
		   }
	} 
}

function dropsetaside() {
	document.getElementById("myDropdown9").classList.toggle("show");
	//document.getElementById('search').value = '';
	document.getElementById("_mode").value = "Opportunities";
	document.getElementById("ur").checked = false;
	var ele=document.getElementsByName('type[]');  
	for(var i=0; i<ele.length; i++)
	{  
		   if(ele[i].type=='checkbox')
		   {  
				//if (i == 1) { ele[i].checked=true; }  else { ele[i].checked=false; }
				if (ele[i].value == 'Undecided') { ele[i].checked=true; }  else { ele[i].checked=false; }
		   }
	} 
}


function dropdecision() {
	document.getElementById("myDropdown5").classList.toggle("show");
	//document.getElementById('search').value = '';
	document.getElementById("_mode").value = "Opportunities";
	document.getElementById("ur").checked = false;
	var ele=document.getElementsByName('status[]');  
	for(var i=0; i<ele.length; i++)
	{  
		   if(ele[i].type=='checkbox')
		   {  
				//if (i == 1) { ele[i].checked=true; }  else { ele[i].checked=false; }
				if (ele[i].value == 'Undecided') { ele[i].checked=true; }  else { ele[i].checked=false; }
		   }
	} 
}

function dropPhase(){
	document.getElementById("myDropdown6").classList.toggle("show");
	document.getElementById("_mode").value = "Opportunities";
	/*document.getElementById("ur").checked = false;
	var ele=document.getElementsByName('phase[]');  
	for(var i=0; i<ele.length; i++)
	{  
		   if(ele[i].type=='checkbox')
		   {  
				//if (i == 1) { ele[i].checked=true; }  else { ele[i].checked=false; }
				if (ele[i].value == 'Undecided') { ele[i].checked=true; }  else { ele[i].checked=false; }
		   }
	} */
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtnopen')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
      }
    }
  }
}
</script>

<script>
$(document).ready(function(){
	//$("#search").prop("style","display:block");
	//$("#incumbent_search").prop("style","display:none");
	
	$("#dualsearch").change(function(){
		var selectedValue = '';
		 selectedValue = $('#dualsearch').val();
			if(selectedValue == 'IS') {
				$("#search").val('');
				$("#search").prop('placeholder', 'Search Incumbent . . . . . ');
				$("#search").prop('autocomplete', 'on');

// Auto Search For Incumbents Starts Here.		
				$("#search").autocomplete({
					source: function( request, response ) {
						$.ajax({
							url		: 'ajax_get_incumbent_names.php',
							dataType: "JSON",
							method	: 'post',
							data: {
								search_string: request.term,
							},
							success: function( data ) {
								response( $.map( data, function( item ) {
									return {
										label: item,
										value: item,
									}
								}));
							}
						});
					},
			autoFocus: true,	      	
			minLength: 1,
			select: function( event, ui ) {}	
		});
// Auto Search For Incumbents Ends Here.					
			}else{
				$("#search").val('');
				$("#search").prop('placeholder', 'Search Text . . . . . ');
			}
	});

/*	$("#dualsearch").change(function(){
		var selectedValue = '';
		 selectedValue = $('#dualsearch').val();
		if(selectedValue == '') {
			$("#search").show();
			$("#incumbent_search").hide();
			$("#incumbent_search").val('');
		}else if(selectedValue == 'IS') {
			$("#incumbent_search").show();
			$("#search").hide();
			$("#search").val('');
		}
	});

/*	$("#bidportal").submit(function(){
		var searchVal		   = $("#search").val();
		var IncumbentSearchVal = $("#incumbent_search").val();
alert("Search Value Is :: "+searchVal);
alert("Incumbent Search Value Is :: "+IncumbentSearchVal);
		if(searchVal != ""){
			$("#search").prop("style","display:block");
		}else{
			$("#incumbent_search").prop("style","display:none");
		}
		
		if(IncumbentSearchVal != ""){
			$("#incumbent_search").prop("style","display:block");
		}else{
			$("#search").prop("style","display:none");
		}
	});
*/
	$("#sdate,#edate").click(function(){
		var datetype = $("#datesearch").val();
		if(datetype == ''){
			alert("Please select date type.");
		}
	});
	
	$("#datesearch").change(function(){
		var datetype = this.value;
		if(datetype != '')
		 {
			$("#sdate").attr("readonly", false);
			$("#edate").attr("readonly", false);
		 }
		 else
		 {
			$("#sdate").attr("readonly", true);
			$("#edate").attr("readonly", true);
			$("#sdate").val('');
			$("#edate").val('');
		 }
		});
		$("#datesearch").trigger("change");

//JQuery code to toggle fav bids starts here.
	$("#fc_favourite_bids").click(function(){
		var status = $("#fc_favourite_bids").is(':checked');
		if(status){	
			window.location.href= "<?php echo $baseurl; ?>"+"/fc_agenda.php?search=&_mode=Agenda&favlist=jklms27v&favshow=yes";
		}else{	
			window.location.href = "<?php echo $baseurl; ?>"+"/fc_agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review";
		}
	});
//JQuery code to toggle fav bids ends here.
/*	$("#archived").change(function() {
		var ischecked = $(this).is(':checked');
		if(ischecked)
		  $("#sub_and_can").prop('disabled',true);
		else
		  $("#sub_and_can").prop('disabled',false);
    }); 

	$("#submitted").change(function() {
		var ischecked = $(this).is(':checked');
		if(ischecked)
		  $("#sub_and_can").prop('disabled',true);
		else
		  $("#sub_and_can").prop('disabled',false);
    }); */
	
	$("#submitted,#archived").change(function() {
		var sub_checked  = $('#submitted').is(':checked');
		var arch_checked = $('#archived').is(':checked');

		if(sub_checked || arch_checked) {
		  $("#sub_and_can").prop('disabled',true);
		  $("#sub_and_can").prop('checked',false);
		}else{
		  $("#sub_and_can").prop('disabled',false);
		  $("#sub_and_can").prop('checked',false);
		}
    });


	$("#sub_and_can").change(function() {
		var ischecked = $(this).is(':checked');
		if(ischecked){
		  $("#archived").prop('disabled',true);
		  $("#submitted").prop('disabled',true);
		  $("#submitted").prop('checked',false);
		  $("#archived").prop('checked',false);
		}else{
		  $("#archived").prop('disabled',false);
		  $("#submitted").prop('disabled',false);
		}
    }); 

	$(document).on('click', '.Btn_showView', function() {
		var oppid = $(this).val();
		$("#oppdet_view_"+oppid).show();
		$("#oppdet_"+oppid).hide();
	});

	$(document).on('click', '.Btn_showEdit', function() {
		var oppid = $(this).val();
		$("#oppdet_view_"+oppid).hide();
		$("#oppdet_"+oppid).show();
	});
});
// opportunity update details in agenda
function submitoppform($opp_id)
{
	var formData = $('#oppdet_'+$opp_id).serialize();
	$.ajax({
		type: 'POST',
		url: 'ajax_oppdet_update.php',
		data: formData,
		success: function(response) {
			//alert(response);
			location.reload();
		}
	});
}

/*function submitform()
{
var formData = $('#proposalarea').serialize();
$.ajax({
type: 'POST',
url: 'ajax_status_update.php',
data: formData,
success: function(response) {
	//alert(response);
    location.reload();
}
});
}*/

function validateReasonText(idc){
	var decisionValue = document.getElementById("decision_edit" + idc).value;
	var reasonText = document.getElementById("reason" + idc).value;
	if((decisionValue == 'No Bid') || (decisionValue == "Ineligible")){	
		if(reasonText == ''){	
			document.getElementById('reason' + idc).style.borderWidth = 'medium';
			document.getElementById('reason' + idc).style.borderColor = 'red';
			document.getElementById('reasonError').innerHTML = 'Please provide reason for No Bid.';
			document.getElementById('reasonError').style.display = 'block';
			return false;
		}
	}
}

var is_fav_page = "<?php echo $_GET['favshow']; ?>";
function blurfunction(namea,valueb,idc) {
	var namea = namea;
	var valueb = valueb;
	var idc = idc;
    var returnValue = '';
	//var whichphase = document.getElementById("opp_status" + idc).value;
	//var submittedcheckbox = document.getElementById('is_submitted' + idc).checked; 
	//var archivedcheckbox  = document.getElementById('is_archived' + idc).checked;
	if (namea=='decision') {
		if ((valueb == "Bid") || (valueb == "Bid")) { 
			document.getElementById("opp_status" + idc).value = "RFP Tracking";
			document.getElementById("is_submitted" + idc).disabled = false;
		}
		if ((valueb == "Review") || (valueb == "Review")) {
			document.getElementById("opp_status" + idc).value = "Under Review";	
			document.getElementById("is_submitted" + idc).disabled = false;
		}
		if ((valueb == "Cancelled") || (valueb == "Cancelled")) {
			document.getElementById("opp_status" + idc).value = "Archived";	
//			document.getElementById("is_awarded" + idc).value = "Cancelled";	
//			document.getElementById("is_submitted" + idc).disabled = true;
//			document.getElementById('is_archived' + idc).checked = true; 
		}
// Added for Decision Pending.
		if ((valueb == "Decision Pending") || (valueb == "Decision Pending")) { 
			//document.getElementById("opp_status" + idc).value = "Decision Pending / Hold";
			document.getElementById("opp_status" + idc).value = "Agenda Item";
		}
// Ends Here.		
		if (valueb == "") {
			document.getElementById("opp_status" + idc).value = "Agenda Item";
			document.getElementById("submitbtn" + idc).disabled = true;	
		}
		else
		{
			document.getElementById("submitbtn" + idc).disabled = false;	
		}
		if((valueb == "No Bid") || (valueb == "Ineligible") || (valueb == "Cancelled")) {
			document.getElementById('is_archived' + idc).checked = true;
			document.getElementById("opp_status" + idc).value = "Archived";	
			document.getElementById("is_submitted" + idc).disabled = true;
	//		document.getElementById("reason" + idc).setAttribute('required', '');
		}
		else{
			document.getElementById('reason' + idc).style.borderColor = 'black';
			document.getElementById('reasonError').innerHTML = '';
			document.getElementById('reasonError').style.display = 'none';
			document.getElementById('reason' + idc).style.borderWidth = 'thin';
//			document.getElementById("reason" + idc).removeAttribute('required');
			document.getElementById('is_archived' + idc).checked = false;
///			document.getElementById("is_submitted" + idc).disabled = false;
		}
	}
	else
	{
		document.getElementById("decision_edit" + idc).disabled = false;
	}
  if (namea=='manager') { 
  //alert("manager " + idc); 
	document.getElementById("managertitle" + idc).innerHTML=valueb;
  }
}
/* favourite code starts here */
function blurfavsubmitted(chkval,idc) {
 	if(chkval == true || chkval == 'true'){
		$('#div_fav_'+idc).html("<a style='cursor:pointer;' onclick='blurfavsubmitted(false, "+idc+")'><img src='images/star-blue.gif' border='0' title='Click to remove from Favourite' style='width:18px; margin-bottom: 5px;' /></a>");
				$('#div_favcommnt_'+idc).show();
				$('#div_favreason_'+idc).show();

	}
	else if(chkval == false || chkval == 'false'){
	$.ajax({
		type: "get",
		url: "ajax_favbid_add.php?oppid=" + idc + "&unflag=1", 
		success: function(result){
			alert('Removed from Favorites.');
			$("span.favtext").text("Add to my favorites");
			document.getElementById("txtarea_fav_reason_" + idc).value = '';
			if(is_fav_page == 'yes')
			location.reload();
		}
	});	
		$('#div_fav_'+idc).html("<a style='cursor:pointer;' onclick='blurfavsubmitted(true, "+idc+")'><img src='images/star-gray.gif' border='0' title='Click to add to Favourite' style='width:18px; margin-bottom: 5px;' />	</a>");
				$('#div_favcommnt_'+idc).hide();
				$('#div_favreason_'+idc).hide();

	}
}

function favsubmitted(idc) {
	//var id = idc;
	var reason = document.getElementById("txtarea_fav_reason_" + idc).value;
	$.ajax({
		type: "get",
		url: "ajax_favbid_add.php?oppid=" + idc + "&reason=" + reason, 
		success: function(result){
		if(result == true || result == 'true'){
			$('#div_fav_'+idc).html("<a style='cursor:pointer;' onclick='blurfavsubmitted(false, "+idc+")'><img src='images/star-blue.gif' border='0' title='Click to remove from Favorites.' style='width:18px; margin-bottom: 5px;' /></a>");
			alert('Added to the Favorites.');
			$("span.favtext").text("Remove from my favorites");
		}
		else if(result == false || result == 'false'){
			$('#div_fav_'+idc).html("<a style='cursor:pointer;' onclick='blurfavsubmitted(true, "+idc+")'><img src='images/star-gray.gif' border='0' title='Click to add to Favorites.' style='width:18px; margin-bottom: 5px;' />	</a>");
		}
  }});
}
/* favourite code ends here */
function blursubmitted(namea,valueb,idc) {
	var namea = namea;
	var valueb = valueb;
	var idc = idc;
	var whichphase = 0;
	var thisajaxurl = "ajax_status_update.php?oppid=";
	valuedecision = document.getElementById('decision_edit' + idc).value;
	valueopptype = document.getElementById('opptypeedit' + idc).value;
	if (namea=='is_submitted') { valuesubmitted = document.getElementById('is_submitted' + idc).checked; valueb=valuesubmitted; }
	if (namea=='is_archived') { valuearchived = document.getElementById('is_archived' + idc).checked; valueb=valuearchived; }
	if ((namea=='is_submitted') && (valuedecision=='Bid') && (valuesubmitted==true)) 
		{ //alert ("Type " + valueopptype + " valueb " + valueb + " namea " + namea);
			thisajaxurl = "ajax_phase_update.php?oppid=";
			if ((valueopptype=='RFI') || (valueopptype=='Draft RFP')) { whichphase=1; document.getElementById("opp_status" + idc).value = "RFP Tracking"; }
			if ((valueopptype=='RFP') || (valueopptype=='RFQ')) { whichphase=2; document.getElementById("opp_status" + idc).value = "Award Monitoring";}
			if (whichphase==1) { namea = "phase1";  } 
			if (whichphase==2) { namea = "phase2";  } 
		} 
}
//SELECT BLUR UPDATE STATUS
function blurfunctiondecision(namea,valueb,idc) {
	var namea = namea;
	var valueb = valueb;
	var idc = idc;
	$.ajax({
		type: "get",
		url: "ajax_decision_update.php?oppid=" + idc + "&oppfield=" + namea + "&oppvalue=" + valueb, 
		success: function(result){
		//$("#ajaxevent").html(result);
		//alert("Ready DECISION");
		//alert("ajax_events_update.php?eventid=" + idc + "&eventfield=" + namea + "&eventvalue=" + valueb);
		}
	});
}
</script>
<script>
var coll = document.getElementsByClassName("collapsible_bid");
var i;
for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
	  //alert("FIX");
    this.classList.toggle("active_bid");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
<script>
function showajaxopp(x) {
//alert("Search " + document.getElementById('search').value);
passthissearch = document.getElementById('search').value;
var thisElement = document.getElementById(x); 
var current_bar = document.getElementById("opportunity_container" + x);
current_bar.classList.toggle("active_bar");
//AJAX GET
if (x.length == 0) {
document.getElementById(x).innerHTML = ""; 
return;
} else {
var xmlhttp1 = new XMLHttpRequest();
xmlhttp1.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
document.getElementById(x).innerHTML = this.responseText; 
$("#accordion").accordion();
}
};
xmlhttp1.open("GET", "opportunity_details.php?bp=" + x + "&search=" + passthissearch, true);
xmlhttp1.send();
}
//AJAX CLEAR
if (thisElement.style.display === "block") 
{
  thisElement.style.display = "none";
} else 
{
  thisElement.style.display = "block";
}

}
</script>
<script>
/*function bidportalchange(){ 
  document.getElementById('bidportal').submit(); 
}*/ 
</script>
<script>
function select_all_boxes(){ 
//alert("All");
var ele=document.getElementsByName('vehicle[]');  
for(var i=0; i<ele.length; i++)
{  
   if(ele[i].type=='checkbox')
   {  
		ele[i].checked=true;  
   }
}  
} 
function select_no_boxes(){ 
//alert("None");
	var ele=document.getElementsByName('vehicle[]');  
	for(var i=0; i<ele.length; i++)
	{  
	   if(ele[i].type=='checkbox')
	   {  
			ele[i].checked=false;  
	   }
	}
}

function select_all_type_boxes(){ 
	var ele=document.getElementsByName('type[]');  
	for(var i=0; i<ele.length; i++)
	{  
	   if(ele[i].type=='checkbox')
	   {  
			ele[i].checked=true;  
	   }
	}  
} 
function select_no_type_boxes(){ 
	var ele=document.getElementsByName('type[]');  
	for(var i=0; i<ele.length; i++)
	{  
	   if(ele[i].type=='checkbox')
	   {  
			ele[i].checked=false;  
	   }
	}
}

function select_all_set_aside_boxes(){ 
	var ele=document.getElementsByName('set_aside[]');  
	for(var i=0; i<ele.length; i++)
	{  
	   if(ele[i].type=='checkbox')
	   {  
			ele[i].checked=true;  
	   }
	}  
} 
function select_no_set_aside_boxes(){ 
	var ele=document.getElementsByName('set_aside[]');  
	for(var i=0; i<ele.length; i++)
	{  
	   if(ele[i].type=='checkbox')
	   {  
			ele[i].checked=false;  
	   }
	}
}

function select_dec_all_boxes() { 
//alert("All");
	var ele=document.getElementsByName('decision[]');  
	for(var i=0; i<ele.length; i++)
	{  
	   if(ele[i].type=='checkbox')
	   {  
			ele[i].checked=true;  
	   }
	}  
} 
function select_dec_no_boxes(){ 
//alert("None");
	var ele=document.getElementsByName('decision[]');  
	for(var i=0; i<ele.length; i++)
	{  
	   if(ele[i].type=='checkbox')
	   {  
			ele[i].checked=false;  
	   }
	}
}
</script>
<script>
var coll = document.getElementsByClassName("collapsiblehistory");
var i;
for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("activehistory");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
<script>
  function toggleHistory(element) {
    var content = element.querySelector('.collapsible-content-history');
    content.classList.toggle('active-history');
  }
</script>
<script>
  function toggleDocuments(element) {
    var content = element.querySelector('.collapsible-content-documents');
    content.classList.toggle('active-documents');
  }
</script>
<script>
var coll = document.getElementsByClassName("collapsible");
var i;
for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}

var expanded = false;
function showCheckboxes(opp_id) { 
  var checkboxes = document.getElementById("selectMultipleManagers" + opp_id);
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}  
</script>
<script> 
	function clearFilterFields(){
	window.location.href = "<?php echo $baseurl; ?>/fc_agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review";
	}
</script>
<script>
	function displayMessage(oppId,naicsCode){
		$.ajax({
				url		: 'ajax_get_size_standards.php',
				method	: 'POST',
				data: {
					codeValue: naicsCode,
				},
				success: function(data) {
						const myArray = data.split("&");
						$('#naicsDiv'+oppId).prop('title', myArray[0]);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
		});
	}
</script>

<script>
let sortColumn = "";
let sortDir = 1;

document.querySelectorAll(".sortable").forEach(header => {

  header.addEventListener("click", function () {
    let col = this.dataset.col;

    // reset all headers
    document.querySelectorAll(".sortable").forEach(h => {
      h.classList.remove("asc", "desc");
    });

    // toggle direction
    if (sortColumn === col) {
      sortDir *= -1;
    } else {
      sortDir = 1;
      sortColumn = col;
    }

    this.classList.add(sortDir === 1 ? "asc" : "desc");

    let rows = Array.from(document.querySelectorAll(".div-table.row"));

    rows.sort((a, b) => {
      let x = a.dataset[col];
      let y = b.dataset[col];

      if (!isNaN(x)) {
        return sortDir * (parseFloat(x) - parseFloat(y));
      }
      return sortDir * x.localeCompare(y);
    });

    let body = document.getElementById("tableBody");
    body.innerHTML = "";
    rows.forEach(r => body.appendChild(r));
  });

});
</script>

<script>
let sortColumn1 = "";
let sortDir1 = 1;

document.querySelectorAll(".sortable1").forEach(header => {

  header.addEventListener("click", function () {
    let col = this.dataset.col;

    // reset all headers
    document.querySelectorAll(".sortable1").forEach(h => {
      h.classList.remove("asc", "desc");
    });

    // toggle direction
    if (sortColumn1 === col) {
      sortDir1 *= -1;
    } else {
      sortDir1 = 1;
      sortColumn1 = col;
    }

    this.classList.add(sortDir1 === 1 ? "asc" : "desc");

    let rows = Array.from(document.querySelectorAll(".div-table1.row"));

    rows.sort((a, b) => {
      let x = a.dataset[col];
      let y = b.dataset[col];

      if (!isNaN(x)) {
        return sortDir1 * (parseFloat(x) - parseFloat(y));
      }
      return sortDir1 * x.localeCompare(y);
    });

    let body = document.getElementById("tableBody1");
    body.innerHTML = "";
    rows.forEach(r => body.appendChild(r));
  });

});
</script>
<script>
let sortColumn2 = "";
let sortDir2 = 1;

document.querySelectorAll(".sortable2").forEach(header => {

  header.addEventListener("click", function () {
    let col = this.dataset.col;

    // reset all headers
    document.querySelectorAll(".sortable2").forEach(h => {
      h.classList.remove("asc", "desc");
    });

    // toggle direction
    if (sortColumn2 === col) {
      sortDir2 *= -1;
    } else {
      sortDir2 = 1;
      sortColumn2 = col;
    }

    this.classList.add(sortDir2 === 1 ? "asc" : "desc");

    let rows = Array.from(document.querySelectorAll(".div-table2.row"));

    rows.sort((a, b) => {
      let x = a.dataset[col];
      let y = b.dataset[col];

      if (!isNaN(x)) {
        return sortDir2 * (parseFloat(x) - parseFloat(y));
      }
      return sortDir2 * x.localeCompare(y);
    });

    let body = document.getElementById("tableBody2");
    body.innerHTML = "";
    rows.forEach(r => body.appendChild(r));
  });

});
</script>
</body>
</html>