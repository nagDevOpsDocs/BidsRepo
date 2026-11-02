<?php
session_start();

include("./includes/connect_portal123.php");

$searchterm = $_GET['stxt'];

if(isset($_POST['search']))
{
$title = trim($_POST['title']);
$vehile = $_POST['vehile'];
$opportunity_type = $_POST['opportunity_type'];
//$fav = $_POST['fav'];
//$award = $_POST['award'];
$users = $_POST['users'];
$manager = $_POST['manager'];
$bnpphase = $_POST['bnpphase'];
$decision = $_POST['decision'];
$daterange = $_POST['daterange'];
$sdate = $_POST['sdate'];
$edate = $_POST['edate'];

if($_POST['sdate']!='') {
$sdate = date('Y-m-d',strtotime($_POST['sdate']));
}
else
{
$sdate = '2018-01-01';
}

if($_POST['edate']!='') {
$edate = date('Y-m-d',strtotime($_POST['edate']));
}
else
{
$edate = date('Y-m-d');
}

if($title != '')
	{
		$tit = " AND vehicle_one LIKE '%$title%' OR contract_vehicle LIKE '%$title%' OR title LIKE '%$title%'";
	}
	else
	{
		$tit = '';
	}
if($vehile != '')
	{
		$veh = " AND contract_vehicle LIKE '%".$vehile."%'";
	}
	else
	{
		$veh = '';
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
if($users != '')
	{
		$users = " AND requestor ='".$users."'";
	}
	else
	{
		$users = '';
	}
if($daterange == 'addeddate')
	{
		$creation_timestamp = " AND (DATE(creation_timestamp) BETWEEN '".$sdate."' AND '".$edate."')";
	}
	else
	{
		$creation_timestamp = '';
	}
if($daterange == 'due_date')
	{
		$submission_due = " AND (DATE(proposal_due) BETWEEN '".$sdate."' AND '".$edate."')";
	}
	else
	{
		$submission_due = '';
	}
if($daterange == 'upd_date')
	{
		$lastupd_date = " AND (DATE(last_update) BETWEEN '".$sdate."' AND '".$edate."')";
	}
	else
	{
		$lastupd_date = '';
	}

}

if($creation_timestamp != '') {
	$query = mysqli_query($mysqli_link,"SELECT opportunity_id, title, contract_vehicle,  decision, manager, `status`, requestor, creation_timestamp, proposal_due, last_update FROM state_excel_test WHERE opportunity_id>0 $tit $veh $mngr $st $users $creation_timestamp $submission_due $lastupd_date ORDER BY creation_timestamp DESC");
}
elseif($submission_due != '') {
	$query = mysqli_query($mysqli_link,"SELECT opportunity_id, title, contract_vehicle,  decision, manager, `status`, requestor, creation_timestamp, proposal_due, last_update FROM state_excel_test WHERE opportunity_id>0 $tit $veh $mngr $st $users $creation_timestamp $submission_due $lastupd_date ORDER BY proposal_due DESC");
}
elseif($lastupd_date != '') {
	$query = mysqli_query($mysqli_link,"SELECT opportunity_id, title, contract_vehicle,  decision, manager, `status`, requestor, creation_timestamp, proposal_due, last_update FROM state_excel_test WHERE opportunity_id>0 $tit $veh $mngr $st $users $creation_timestamp $submission_due $lastupd_date ORDER BY last_update DESC");
}
else
{
	$query = mysqli_query($mysqli_link,"SELECT opportunity_id, title, contract_vehicle,  decision, manager, `status`, requestor, creation_timestamp, proposal_due, last_update FROM state_excel_test WHERE opportunity_id>0 $tit $veh $mngr $st $users $creation_timestamp $submission_due $lastupd_date ORDER BY creation_timestamp DESC");
}

//echo "SELECT opportunity_id, title, contract_vehicle,  decision, manager, status, released, proposal_due, rfp_date FROM state_excel_test WHERE opportunity_id>0 $tit $veh $mngr $st $dec $released $proposal_due $rfp_release ORDER BY (released IS NULL), released DESC";
?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>BidPortal</title>

   <link href="https://cdn.datatables.net/2.0.4/css/dataTables.dataTables.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
   <!-- datepicker -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
  <!-- datepicker end-->
 <script>
$(document).ready(function() {
    $('#example').DataTable( {
		language: { search: "",
		searchPlaceholder: 'Search' },
		"lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
        "order": [[ 0, "" ]],
		"columns": [
    { "width": "20%" },
    { "width": "20%" },
    { "width": "10%" },
    { "width": "10%" },
    { "width": "20%" },
    { "width": "10%" },
    { "width": "10%" }
  ]
    } );
} );

</script>
<style>
.select-styled { padding: 4px 5px; border: 1px solid #cbcbcb; width:200px; font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}
.font-size { font-weight:500; background-color:#f6f6f6; }
.input1 { width:188px;; border:1px solid #cbcbcb; padding:5px; }
</style>
 </head>
 <body>

<div style="text-align:center;font-size:22px;font-weight:700;color:#3c4db0;margin-bottom:15px;">Advanced Search</div>
<?php 
$vehicle = mysqli_query($mysqli_link,"SELECT vehicle_id, vehicle_name FROM state_contract_vehicles WHERE vehicle_show=1 ORDER BY vehicle_name");

$decision = mysqli_query($mysqli_link,"SELECT decision_name FROM state_decision WHERE decision_show=1 ORDER BY decision_name");

$manager = mysqli_query($mysqli_link,"SELECT manager_name FROM state_managers WHERE manager_show=1 ORDER BY manager_name");

$status = mysqli_query($mysqli_link,"SELECT status_id, status_name FROM state_status_levels WHERE (status_show>0) ORDER BY status_show");

//$awarded = mysqli_query($mysqli_link,"SELECT awarded_name FROM state_awarded_levels WHERE awarded_show>0 ORDER BY awarded_id");
?>

<form id="addform" action="" method="post">
<table align="center" cellpadding="4">
<tr>
	<td colspan="3">
<input style='width:608px; border:1px solid #cbcbcb; padding:5px;' type="text" placeholder="Search text.." name="title" id="title" value="<?php echo $searchterm; ?>">
</td>

<tr>
	<td>
<select name="vehile" id="vehile" class="select-styled">
<option value=''>Contract Vehicle</option>
<?php while($getveh = mysqli_fetch_array($vehicle)) { ?>
<option value='<?php echo $getveh[1]; ?>'<?php if($_POST['vehile']==$getveh[1]) { echo "selected";} ?>><?php echo $getveh[1]; ?></option>
<?php } ?>
</select>
</td>
<td>
<select name="manager" id="manager" class="select-styled">
<option value=''>Manager</option>
<?php 
while($getmngr = mysqli_fetch_array($manager)) { ?>
<option value='<?php echo $getmngr[0]; ?>'<?php if($_POST['manager']==$getmngr[0]) { echo "selected";} ?>><?php echo $getmngr[0]; ?></option>
<?php } ?>
</select>
</td>
<td>
<select name="bnpphase" id="bnpphase" class="select-styled">
<option value=''>B&P Phase</option>
<?php while($getst = mysqli_fetch_array($status)) { ?>
<option value='<?php echo $getst[0]; ?>'<?php if($_POST['bnpphase']==$getst[0]) { echo "selected";} ?>><?php echo $getst[1]; ?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td>
<select name="daterange" id="daterange" class="select-styled">
<option value=''>Select date type</option>
<option value='addeddate'<?php if($_POST['daterange']=='addeddate') { echo "selected";} ?>>Bid Added date</option>
<option value='due_date'<?php if($_POST['daterange']=='due_date') { echo "selected";} ?>>Due date</option>
<option value='upd_date'<?php if($_POST['daterange']=='upd_date') { echo "selected";} ?>>Last Updated date</option>
</select>
</td>
<td colspan="2">
	<div id="dates" style="display:none;">
<input class="input1" type="text" name="sdate" id="sdate" value="<?php if($_POST['sdate']!='') { echo $_POST['sdate']; } else { echo '';} ?>" style="width:100px;" autocomplete="off" placeholder="Start date">&nbsp;&nbsp;
<input class="input1" type="text" name="edate" id="edate" value="<?php if($_POST['edate']!='') { echo $_POST['edate']; } else { echo '';} ?>" style="width:100px;" autocomplete="off" placeholder="End date">&nbsp;&nbsp;<select name="users" id="users" class="select-styled" style="width:160px;">
<option value="">Select User</option>
<?php 
$users = mysqli_query($mysqli_link,"SELECT user_id,firstname,lastname FROM users WHERE access_level='102' AND `status` = 1");
while($getrec = mysqli_fetch_array($users)) { ?>
<option value="<?php echo $getrec[0]; ?>"><?php echo $getrec[1].' '.$getrec[2]; ?></option>
<?php } ?>
</select></div>
</td>
</tr>
<tr>
<td colspan="3">

<input style="50px; padding:4px 16px; width:100px; font-weight: 700;" type="submit" name="search" value="Search" />&nbsp;&nbsp;
<button id="refreshpage" style="50px; padding:4px 16px; width:100px; font-weight: 700;">Reset</button>

</td>
</tr>
</table>
</form>
<br>
 <table id="example" class="display" style="width:100%; font-family: 'Segoe UI', 'Century Gothic'; font-size: 13px;">
 <thead>
 <tr style="background-color: #3c4db0; color: #ffffff;">
	<th>Title</th>
	<th>Contract Vehicle</th>
	<th>Criteria</th>
	<th>Manager</th>
	<th>B&P Phase</th>
	<th><?php if($creation_timestamp != '') { echo "Release Date"; } elseif($submission_due != '') { echo "Due Date"; } elseif($lastupd_date != '') { echo "Last Updated Date"; } else { echo "Release Date"; } ?></th>
	<th>#</th>
 </tr>
 </thead>
  <tbody>
 <?php 
 while($rec = mysqli_fetch_array($query)) {
 ?>
 <tr>
	<td title="<?php echo $rec[1]; ?>"><?php 
 if(strlen($rec[1]) <= 20) {
  echo $rec[1];
} else {
  echo substr($rec[1], 0, 20) . '...';
}
 ?></td>
	<td><?php echo $rec[2]; ?></td>
	<td><?php echo $rec[3]; ?></td>
	<td><?php echo $rec[4]; ?></td>
	<td><?php echo $rec[5]; ?></td>
<?php if($creation_timestamp != '') { ?>
<td>
<div style='display:none;'><?php echo date('Ymd', strtotime($rec[7])); ?></div>
<?php echo date('m-d-Y',strtotime($rec[7])); ?>
</td>
<?php } elseif($submission_due != '') { ?>
<td>
<div style='display:none;'><?php echo date('Ymd', strtotime($rec[8])); ?></div>
<?php echo date('m-d-Y',strtotime($rec[8])); ?>
</td>
<?php } elseif($lastupd_date != '') { ?>
<td>
<div style='display:none;'><?php echo date('Ymd', strtotime($rec[9])); ?></div>
<?php echo date('m-d-Y',strtotime($rec[9])); ?>
</td>
<?php } else { ?>
<td>
<div style='display:none;'><?php echo date('Ymd', strtotime($rec[7])); ?></div>
<?php echo date('m-d-Y',strtotime($rec[7])); ?>
</td>
<?php } ?>

	<td><a href="<?php echo $baseurl; ?>/addrole_view_opportunities.php?which_update_id=<?php echo $rec[0]; ?>" target="_blank"><img src="<?php echo $baseurl; ?>/view.png" width="20" height="20" alt="View"></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $baseurl; ?>/addrole_update_opportunities.php?which_update_id=<?php echo $rec[0]; ?>" target="_blank"><img src="<?php echo $baseurl; ?>/edit-pencil16.png" width="16" height="16" alt="Edit"></a></td>
 </tr>
 <?php } ?>
 
  </tbody>
 </table>
  
 </body>
</html>
<script>
$(function() {
$("#sdate").datepicker({ 
	changeMonth: true, 
	changeYear: true, 
	dateFormat: "mm/dd/yy" }).val()
});
$(function() {
$("#edate").datepicker({ 
changeMonth: true, 
changeYear: true, 
dateFormat: "mm/dd/yy" }).val()
});

$(document).ready(function(){
	$("#daterange").change(function(){
    var datetype = this.value;

if(datetype != '')
 {
	$("#sdate").attr("readonly", false);
	$("#edate").attr("readonly", false);
	$("#dates").show();
 }
 else
 {
	$("#sdate").attr("readonly", true);
	$("#edate").attr("readonly", true);
	$("#sdate").val('');
	$("#edate").val('');
	$("#users").val('');
	$("#dates").hide();
 }
});
$("#daterange").trigger("change");
});

$(document).ready(function(){
	$('#refreshpage').click(function(){				
		$('#title').val('');				
		$('#vehile').val('');				
		$('#users').val('');				
		$('#manager').val('');				
		$('#bnpphase').val('');				
		$('#daterange').val('');				
	});
});
</script>