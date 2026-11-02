<?php
session_start();
include("./includes/connect_portal123.php");
//error_reporting(E_ALL); ini_set('display_errors', '1'); 
echo "<pre>";
print_r($_GET);
$urlsearch = $_GET['title'];

if($_GET['sdate']!='') {
	$sdate = date('Y-m-d',strtotime($_GET['sdate']));
}
else
{
	$sdate = '2018-01-01';
}

if($_GET['edate']!='') {
	$edate = date('Y-m-d',strtotime($_GET['edate']));
}
else
{
	$edate = date('Y-m-d');
}

if($_GET['datesearch'] != '') {
// Search by proposal due date.
	if($_GET['datesearch'] == 'DD'){
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{   
			$proposal_due_date = " AND (DATE(proposal_due) BETWEEN '".$sdate."' AND '".$edate."')";
		}
		else
		{
			$proposal_due_date = '';
		} 
	}
// Search by Bid Added Date.
	if($_GET['datesearch'] == 'BD'){
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{   
			$bid_added_date = " AND (DATE(creation_timestamp) BETWEEN '".$sdate."' AND '".$edate."')";
		}
		else
		{
			$bid_added_date = '';
		} 
	}
// Search by Last Updated Date.
	if($_GET['datesearch'] == 'LD'){
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{   
			$last_updated_date = " AND ((last_update) BETWEEN '".$sdate."' AND '".$edate."')";
		}
		else
		{
			$last_updated_date = '';
		} 
	}
//Search by Award Date.
	if($_GET['datesearch'] == 'AD')
	{
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{    
			$releaseddate = " AND ((award_date) BETWEEN '".$sdate."' AND '".$edate."')";
		}
		else
		{
			$releaseddate = '';
		} 
	}     
//Search by QA Date.
	if($_GET['datesearch'] == 'QD')
	{
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{    
			$qa_date = " AND (DATE(qa_due) BETWEEN '".$sdate."' AND '".$edate."')";
		}
		else
		{
			$qa_date = '';
		} 
	}  
//Search by Release Date.
	if($_GET['datesearch'] == 'RD')
	{
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{    
			$release_date = " AND (DATE(released) BETWEEN '".$sdate."' AND '".$edate."')";
		}
		else
		{
			$release_date = '';
		} 
	} 	
}


if($urlsearch != '')
	{
		$queryurlsearch = " AND (vehicle_one LIKE '%$urlsearch%' OR contract_vehicle LIKE '%$urlsearch%' OR title LIKE '%$urlsearch%' OR agency LIKE '%$urlsearch%' OR pop LIKE '%$urlsearch%' OR synopsis LIKE '%$urlsearch%' OR recruiting LIKE '%$urlsearch%')";
	}
	else
	{
		$queryurlsearch = '';
	}
if($vehile != '')
	{
		$veh = " AND contractveh_table LIKE '%".$vehile."%'";
	}
	else
	{
		$veh = '';
	}
if($opportunity_type != '')
	{
		$response = " AND response ='".$opportunity_type."'";
	}
	else
	{
		$response = '';
	}



if($adv_set_aside != '')
	{
		$adv_set_aside = " AND set_aside = '".$adv_set_aside."'";
	}
	else
	{
		$adv_set_aside = '';
	}


if($award != '')
	{
		$awarded = " AND is_awarded = '".$award."'";
	}
	else
	{
		$awarded = '';
	}


if($manager != '')
	{
		$mngr = " AND manager = '".$manager."'";
	}
	else
	{
		$mngr = '';
	}
if($bnpphase != '')
	{
		$st = " AND status_value ='".$bnpphase."'";
	}
	else
	{
		$st = '';
	}
if($decision != '')
	{
		$dec = " AND decision ='".$decision."'";
	}
	else
	{
		$dec = '';
	}
if($daterange == 'released')
	{
		$released = " AND (DATE(released) BETWEEN '".$sdate."' AND '".$edate."')";
	}
	else
	{
		$released = '';
	}
if($daterange == 'proposal_due')
	{
		$proposal_due = " AND (DATE(proposal_due) BETWEEN '".$sdate."' AND '".$edate."')";
	}
	else
	{
		$proposal_due = '';
	}
if($daterange == 'rfp_release')
	{
		$rfp_release = " AND (DATE(rfp_date) BETWEEN '".$sdate."' AND '".$edate."')";
	}
	else
	{
		$rfp_release = '';
	}


if($_GET['bnpphase']!='') {
	$_GET['_mode'] = 'Opportunities';
	$sttype .= " AND status='".$_GET['bnpphase']."'";
}
else
{
	$sttype .= '';
}

if($_GET['addedBy']!='') {
	$_GET['_mode'] = 'Opportunities';
	$addedBy1 .= " AND requestor='".$_GET['addedBy']."'";
}
else
{
	$addedBy1 .= '';
}

if($_GET['assignedTo1']!='') {
	$_GET['_mode'] = 'Opportunities';
	$assigned1 .= " AND vehicle_two='".$_GET['assignedTo1']."'";
}
else
{
	$assigned1 .= '';
}

// Code to filter states starts here.
if($_GET['state']!='') {
	$_GET['_mode'] = 'Opportunities';
	$state1 .= " AND agency='".$_GET['state']."'";
}
else
{
	$state1 .= '';
}
// Code to filter states ends here.

if($_GET['groupBy']!='') {
	$_GET['_mode'] = 'Opportunities';
	$group .= " AND subagency='".$_GET['groupBy']."'";
}
else
{
	$group .= '';
}


$vehicles_selected=0;
$for_each_vehicle = 0;
if($_GET['vehicle']) {
		$queryvehicle = ""; 
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['vehicle'] as $vehselected) 
			{
				$for_each_vehicle++;
				if ($for_each_vehicle==1) { $queryvehicle .= " AND (contract_vehicle LIKE '%" . $vehselected . "%'"; }
				if ($for_each_vehicle> 1) { $queryvehicle .= " OR contract_vehicle LIKE '%" . $vehselected . "%'"; }
			}
			$queryvehicle .= ")";
		} 
	else { $queryvehicle = ""; }


$for_each_decision = 0;
if($_GET['decision']) {
		$querydecision = ""; 
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['decision'] as $dec_selected) 
			{ 
				$for_each_decision++;
				if($for_each_decision==1) { $querydecision .= " AND (decision='$dec_selected'"; }
				if($for_each_decision > 1) { $querydecision .= " OR decision='$dec_selected'"; }
			}
			$querydecision .= ")"; 
		} 
	else { $querydecision = ""; }


$bidcategory_selected=0;
$for_each_bidcategory = 0;
if($_GET['bidcategory']) {  

		$querybidcategory = ""; 
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['bidcategory'] as $bid_category_selected) 
			{ 
				$for_each_bidcategory++;
				if($for_each_bidcategory==1) { $querybidcategory .= " AND (bid_category='$bid_category_selected'"; }
				if($for_each_bidcategory > 1) { $querybidcategory .= " OR bid_category='$bid_category_selected'"; }
			}
			$querybidcategory .= ")"; 
		} 
	else { $querybidcategory = ""; }

$bidtype_selected=0;
$for_each_bidtype = 0;
if($_GET['bidtype']) { 
		$querybidtype = ""; 
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['bidtype'] as $bid_type_selected) 
			{ 	$for_each_bidtype++;
				if($for_each_bidtype==1) { $querybidtype .= " AND (response='$bid_type_selected'"; }
				if($for_each_bidtype > 1) { $querybidtype .= " OR response='$bid_type_selected'"; }
			}
			$querybidtype .= ")"; 
		} 
	else { $querybidtype = ""; }

echo "SELECT released, proposal_due, subagency, contractveh_table, vehicle_one, agency, title, vehicle_two, decision FROM state_excel_test WHERE opportunity_id>0  $mngrname $queryurlmode $queryurlsearch $queryvehicle $proposal_due_date $releaseddate $bid_added_date $last_updated_date $qa_date $release_date $querydecision $querybidtype $sttype $querybidcategory $start_empty $addedBy1 $assigned1 $state1 $group ORDER BY proposal_due DESC"; exit;

$query = mysqli_query($mysqli_link,"SELECT released, proposal_due, subagency, contractveh_table, vehicle_one, agency, title, vehicle_two, decision FROM state_excel_test WHERE opportunity_id>0  $mngrname $queryurlmode $queryurlsearch $queryvehicle $proposal_due_date $releaseddate $bid_added_date $last_updated_date $qa_date $release_date $querydecision $querybidtype $sttype $querybidcategory $start_empty $addedBy1 $assigned1 $state1 $group ORDER BY proposal_due DESC");


$filename = 'excel_test_' . date("d-m-Y") . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' .$filename .'"');
header('Pragma: no-cache');
header('Expires: 0');
$output = fopen('php://output', 'w');

fputcsv($output, [
    'Release',
	'Due Date', 
	'Type',
	'Bid #',
	'State/Agency',
	'Title',
    'Asigned To',
	'Criteria'
]);
while($row = mysqli_fetch_array($query, MYSQLI_NUM))
{  
	fputcsv($output, [
        $row[0],
        $row[1],
		$row[2],
        $row[4],
		$row[5]." / ".$row[3],
        $row[6],
        $row[7],
		$row[8]
    ]); 
}
fclose($output);
?>