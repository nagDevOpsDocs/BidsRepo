<?php
session_start();
include("./includes/connect_portal123.php");
//ini_set('display_errors', '1'); error_reporting(E_ALL);

$sdate = $_GET['sdate'];
$edate = $_GET['edate'];

$queryurlsearch = "";
$urlsearch = $_GET['search']; 
$queryurlsearch .= " AND (et.bidopp LIKE '%$urlsearch%' OR et.response LIKE '%$urlsearch%' OR et.requestor LIKE '%$urlsearch%' OR et.title LIKE '%$urlsearch%' OR et.pop LIKE '%$urlsearch%' OR et.synopsis LIKE '%$urlsearch%' OR et.recruiting LIKE '%$urlsearch%' OR et.decision LIKE '%$urlsearch%' OR et.opportunity_id LIKE '%$urlsearch%')";

if($_GET['datesearch'] != '') {
	if($_GET['datesearch'] == 'PD'){
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{   
			$proposalduedate = " AND (DATE(et.proposal_due) BETWEEN '".$sdate."' AND '".$edate."')";
		}
		else
		{
			$proposalduedate = '';
		} 
	}
	if($_GET['datesearch'] == 'RD')
	{
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{    
			$releaseddate = " AND (DATE(et.released) BETWEEN '".$sdate."' AND '".$edate."')";
		}
		else
		{
			$releaseddate = '';
		} 
	}         
}

	if($_GET['archived'] == 'Archived') {
		$_GET['_mode'] = 'Opportunities';
		$sttype .= " AND et.status='Archived'";
	}

	if ($_GET['submitted'] == 'Submitted') {
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
	}
	else
	{
		$sttype .= '';
	} 

if($_GET['vehicle']) { 
		$queryvehicle = "";
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['vehicle'] as $vehselected) 
			{
				$for_each_vehicle++;
				/*if ($for_each_vehicle==1) { $queryvehicle .= " AND (contract_vehicle LIKE '%" . $vehselected . "%'"; }
				if ($for_each_vehicle> 1) { $queryvehicle .= " OR contract_vehicle LIKE '%" . $vehselected . "%'"; }*/
				if ($for_each_vehicle==1) { $queryvehicle .= " AND (et.contractveh_table LIKE '%" . $vehselected . "%'"; }
				if ($for_each_vehicle> 1) { $queryvehicle .= " OR et.contractveh_table LIKE '%" . $vehselected . "%'"; }
			}
			$queryvehicle .= ")";
		} 
	else { $queryvehicle = ""; }


/* **************************  framing type query starts here.  ****************************** */
	if($_GET['type']) { 
	//$selected_type_count = count($_GET['type']); 
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
if($_GET['set_aside']) {  
		$querysetaside = "";
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['set_aside'] as $set_aside_select) 
			{
				$for_each_set_aside++;
				if ($for_each_set_aside==1) { $querysetaside .= " AND (et.contractveh_table LIKE '%" . $set_aside_select . "%'"; }
				if ($for_each_set_aside>1) { $querysetaside .= " OR et.contractveh_table LIKE '%" . $set_aside_select . "%'"; }
			}
			$querysetaside .= ")";
		} 
	else { $querysetaside = ""; }
// Filter Query for Set-Aside Ends Here.
if($_GET['decision']) { 
		$querydecision = ""; 
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['decision'] as $dec_selected) 
			{
				$for_each_decision++;
				if($for_each_decision==1) { $querydecision .= " AND (et.decision = '$dec_selected'"; }
				if($for_each_decision > 1) { $querydecision .= " OR et.decision = '$dec_selected'"; }
			}
			$querydecision .= ")"; 
		} 
	else { $querydecision = ""; }


//echo "SELECT et.released, et.proposal_due, et.contractveh_table, et.response, et.set_aside, et.manager, et.title, et.decision FROM excel_test et WHERE et.opportunity_id > 0 $favlist $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $sttype $proposalduedate $releaseddate $start_empty ORDER BY et.released DESC"; exit;


$query = "SELECT et.released, et.proposal_due, et.contractveh_table, et.response, et.set_aside, et.manager, et.title, et.decision FROM excel_test et WHERE et.opportunity_id > 0 $queryurlsearch $queryvehicle $querysetaside $querydecision $querytype $sttype $proposalduedate $releaseddate $start_empty ORDER BY et.released DESC";

$filename = 'excel_test_' . date("d-m-Y") . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' .$filename .'"');
header('Pragma: no-cache');
header('Expires: 0');
$output = fopen('php://output', 'w');

fputcsv($output, [
    'Release Date',
	'Due Date', 
	'Vehicle',
	'Type',
	'Set-Aside',
	'Manager',
    'Title',
	'Decision'
]);

$query_result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($query_result, MYSQLI_NUM))
    {
	$contrctveh_in = $row[2];
	$contrctveh = "";

if(strpos($contrctveh_in, '|||') !== false) {
	$ok = explode("|||",$contrctveh_in);
	$i = 0;
	$temp_variable = "";
	while($i<count($ok)){
		if($ok[$i] or $ok[$i+1]){
			$contrctveh .= $ok[$i]."-".$ok[$i+1].", ";	
		}
		$i = $i+2;
	}
}		
else { 
 $contrctveh = ''; 
}
	fputcsv($output, [
        $row[0],
		$row[1],
        rtrim($contrctveh,", "),
        $row[3],
		$row[4],
//      $row[3],
		$row[5],
        $row[6],
        $row[7]
    ]);
	}
?>