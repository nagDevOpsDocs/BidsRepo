<?php
session_start();
include("./includes/connect_portal123.php");

//if(isset($_GET['search']))
//{
	//echo "<pre>";	print_r($_GET);	exit;

$title = trim($_GET['title']);
$vehile = $_GET['vehicle'];
$opportunity_type = $_GET['opportunity_type'];
$adv_set_aside	= $_GET['adv_set_aside'];
//$fav = $_GET['fav'];
$award = $_GET['award'];
$manager = $_GET['manager'];
$bnpphase = $_GET['bnpphase'];
$decision = $_GET['decision'];
$daterange = $_GET['daterange'];
$sdate = $_GET['sdate'];
$edate = $_GET['edate'];

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

if($title != '')
	{
		$tit = " AND title LIKE '%".$title."%' OR contractveh_table LIKE '%".$title."%'";
	}
	else
	{
		$tit = '';
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

//}

if($released != '') {
	$sql = mysqli_query($mysqli_link,"SELECT opportunity_id, title, contractveh_table, decision, set_aside, manager, status, released, proposal_due, rfp_date, response FROM excel_test WHERE opportunity_id>0 $bidopp $tit $veh $response $adv_set_aside $mngr $awarded $st $dec $released $proposal_due $rfp_release ORDER BY (released IS NULL), released DESC");
}
elseif($proposal_due != '') {
	$sql = mysqli_query($mysqli_link,"SELECT opportunity_id, title, contractveh_table, decision, set_aside, manager, status, released, proposal_due, rfp_date, response FROM excel_test WHERE opportunity_id>0 $bidopp $tit $veh $response $adv_set_aside $mngr $awarded $st $dec $released $proposal_due $rfp_release ORDER BY (proposal_due IS NULL), proposal_due DESC");
}
elseif($rfp_release != '') {
	$sql = mysqli_query($mysqli_link,"SELECT opportunity_id, title, contractveh_table, decision, set_aside, manager, status, released, proposal_due, rfp_date, response FROM excel_test WHERE opportunity_id>0 $bidopp $tit $veh $response $adv_set_aside $mngr $awarded $st $dec $released $proposal_due $rfp_release ORDER BY (rfp_date IS NULL), rfp_date DESC");
}
else
{
	$sql = mysqli_query($mysqli_link,"SELECT opportunity_id, title, contractveh_table, decision, set_aside, manager, status, released, proposal_due, rfp_date, response FROM excel_test WHERE opportunity_id>0 $bidopp $tit $veh $response $adv_set_aside $mngr $awarded $st $dec $released $proposal_due $rfp_release ORDER BY (released IS NULL), released DESC");
}

$filename = 'excel_test_' . date("d-m-Y") . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' .$filename .'"');
header('Pragma: no-cache');
header('Expires: 0');
$output = fopen('php://output', 'w');

fputcsv($output, [
    'Title',
	'Contract Vehicle', 
	'Type',
	'Set-Aside',
	'Decision',
	'Manager',
    'Phase',
	'Release Date'
]);
while($row = mysqli_fetch_array($sql, MYSQLI_NUM))
{ //print_r($row);
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
        $row[1],
        rtrim($contrctveh,", "),
        $row[10],
		$row[4],
        $row[3],
		$row[5],
        $row[6],
        $row[7]
    ]);
}
fclose($output);
?>