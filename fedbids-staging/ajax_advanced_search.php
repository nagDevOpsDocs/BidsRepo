<?php
session_start();
include("./includes/connect_portal123.php");

if(isset($_POST['search']))
{
$title = trim($_POST['title']);
$vehile = $_POST['vehile'];
$opportunity_type = $_POST['opportunity_type'];
$adv_set_aside	= $_POST['adv_set_aside'];
//$fav = $_POST['fav'];
$award = $_POST['award'];
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

}

if($released != '') {
	$query = mysqli_query($mysqli_link,"SELECT opportunity_id, title, contractveh_table, decision, set_aside, manager, status, released, proposal_due, rfp_date, response FROM excel_test WHERE opportunity_id>0 $bidopp $tit $veh $response $adv_set_aside $mngr $awarded $st $dec $released $proposal_due $rfp_release ORDER BY (released IS NULL), released DESC");
}
elseif($proposal_due != '') {
	$query = mysqli_query($mysqli_link,"SELECT opportunity_id, title, contractveh_table, decision, set_aside, manager, status, released, proposal_due, rfp_date, response FROM excel_test WHERE opportunity_id>0 $bidopp $tit $veh $response $adv_set_aside $mngr $awarded $st $dec $released $proposal_due $rfp_release ORDER BY (proposal_due IS NULL), proposal_due DESC");
}
elseif($rfp_release != '') {
	$query = mysqli_query($mysqli_link,"SELECT opportunity_id, title, contractveh_table, decision, set_aside, manager, status, released, proposal_due, rfp_date, response FROM excel_test WHERE opportunity_id>0 $bidopp $tit $veh $response $adv_set_aside $mngr $awarded $st $dec $released $proposal_due $rfp_release ORDER BY (rfp_date IS NULL), rfp_date DESC");
}
else
{
	$query = mysqli_query($mysqli_link,"SELECT opportunity_id, title, contractveh_table, decision, set_aside, manager, status, released, proposal_due, rfp_date, response FROM excel_test WHERE opportunity_id>0 $bidopp $tit $veh $response $adv_set_aside $mngr $awarded $st $dec $released $proposal_due $rfp_release ORDER BY (released IS NULL), released DESC");
}

//echo "SELECT opportunity_id, title, contractveh_table, decision, set_aside, manager, status, released, proposal_due, rfp_date, response FROM excel_test WHERE opportunity_id>0 $bidopp $tit $veh $response $adv_set_aside $mngr $awarded $st $dec $released $proposal_due $rfp_release ORDER BY (released IS NULL), released DESC";
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
body {
	font-family: 'Roboto', sans-serif;
}
.select-styled { padding: 4px 5px; border: 1px solid #cbcbcb; width:200px; font-family:'Roboto', sans-serif; font-size:12px;}
.font-size { font-weight:500; background-color:#f6f6f6; }
.input1 { width:188px;; border:1px solid #cbcbcb; padding:5px; }
</style>
 </head>
 <body>

<div style="text-align:center;font-size:22px;font-weight:700;color:#3c4db0;margin-bottom:15px;">Advanced Search</div>
<?php 
$vehicle = mysqli_query($mysqli_link,"SELECT vehicle_id, vehicle_name FROM contract_vehicles WHERE vehicle_show=1 ORDER BY vehicle_name");

$decision = mysqli_query($mysqli_link,"SELECT decision_name FROM decision WHERE decision_show=1 ORDER BY decision_id");

$manager = mysqli_query($mysqli_link,"SELECT manager_name FROM managers WHERE manager_show=1 ORDER BY manager_name");

$status = mysqli_query($mysqli_link,"SELECT status_id, status_name FROM status_levels WHERE (status_show>0) ORDER BY status_show");

$awarded = mysqli_query($mysqli_link,"SELECT awarded_name FROM awarded_levels WHERE awarded_show>0 ORDER BY awarded_id");
?>

<form id="addform" action="" method="post">
<table align="center" cellpadding="4">
<tr>
	<td colspan="3">
<input style="width:608px; border:1px solid #cbcbcb; padding:5px; font-family: 'Roboto', sans-serif; color:#000000" type="text" placeholder="Title/vehicle ID" name="title" id="title" value="<?php if(isset($_POST['title'])) { echo $_POST['title']; } else { echo ''; } ?>">
</td>

<tr>
	<td>
<select name="vehile" id="vehile" class="select-styled">
<option value=''>Contract Vehicle</option>
<?php while($getveh = mysqli_fetch_array($vehicle)) { ?>
<option value='<?php echo $getveh[1]; ?>'<?php if($_POST['vehile']==$getveh[1]) { echo "selected";} ?>><?php echo $getveh[1]; ?></option>
<?php 
//	if($getveh[1] == '711th'){
?>
<!--<option value='<?php //echo 'DLA JETS 2.0'; ?>'<?php //if($_POST['vehile']=='DLA JETS 2.0') { echo "selected";} ?>><?php //echo 'DLA JETS 2.0'; ?></option>-->
<?php 
	//}
	//else if($getveh[1] == 'GSA MAS Schedule'){
?>
<!--<option value='<?php //echo 'OASIS+ SB'; ?>'<?php //if($_POST['vehile']=='OASIS+ SB') { echo "selected";} ?>><?php //echo 'OASIS+ SB'; ?></option>-->
<?php
//	}
} ?>
</select>
</td>
<td>
<select name="opportunity_type" id="opportunity_type" class="select-styled">
<option value=''>Opportunity type</option>

<option value='Industry Day'<?php if($_POST['opportunity_type']=='Industry Day') { echo "selected";} ?>>Industry Day</option>
<option value='RFI'<?php if($_POST['opportunity_type']=='RFI') { echo "selected";} ?>>RFI</option>
<option value='Draft RFP'<?php if($_POST['opportunity_type']=='Draft RFP') { echo "selected";} ?>>Draft RFP</option>
<option value='RFP'<?php if($_POST['opportunity_type']=='RFP') { echo "selected";} ?>>RFP</option>
<option value='RFQ'<?php if($_POST['opportunity_type']=='RFQ') { echo "selected";} ?>>RFQ</option>
</select>
</td>

<td>
<select name="adv_set_aside" id="adv_set_aside" class="select-styled">
	<option value=''>Set-Aside</option>
	<option value='8(a) Competed'<?php if($_POST['adv_set_aside']=='8(a) Competed') { echo "selected";} ?>>8(a) Competed</option>
	<option value='8(a) Sole-Source'<?php if($_POST['adv_set_aside']=='8(a) Sole-Source') { echo "selected";} ?>>8(a) Sole-Source</option>
	<option value='HUBZone'<?php if($_POST['adv_set_aside']=='HUBZone') { echo "selected";} ?>>HUBZone</option>
	<option value='Woman Owned'<?php if($_POST['adv_set_aside']=='Woman Owned') { echo "selected";} ?>>Woman Owned</option>
	<option value='Unrestricted'<?php if($_POST['adv_set_aside']=='Unrestricted') { echo "selected";} ?>>Unrestricted</option>
	<option value='Small Business'<?php if($_POST['adv_set_aside']=='Small Business') { echo "selected";} ?>>Small Business</option>
</select>
</td>
</tr>
<tr>
<td>
<select name="award" id="award" class="select-styled">
<option value=''>Award</option>
<?php while($getaward = mysqli_fetch_array($awarded)) { ?>
<option value='<?php echo $getaward[0]; ?>'<?php if($_POST['award']==$getaward[0]) { echo "selected";} ?>><?php echo $getaward[0]; ?></option>
<?php } ?>
</select>
</td>
<td>
<select name="manager" id="manager" class="select-styled">
<option value=''>Manager</option>
<?php while($getmngr = mysqli_fetch_array($manager)) { ?>
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
<select name="decision" id="decision" class="select-styled">
<option value=''>Decision</option>
<?php while($getdec = mysqli_fetch_array($decision)) { ?>
<option value='<?php echo $getdec[0]; ?>'<?php if($_POST['decision']==$getdec[0]) { echo "selected";} ?>><?php echo $getdec[0]; ?></option>
<?php } ?>
</select>
</td>
<td>
<select name="daterange" id="daterange" class="select-styled">
<option value=''>Select date type</option>
<option value='released'<?php if($_POST['daterange']=='released') { echo "selected";} ?>>Release date</option>
<option value='proposal_due'<?php if($_POST['daterange']=='proposal_due') { echo "selected";} ?>>Proposal date</option>
<option value='rfp_release'<?php if($_POST['daterange']=='rfp_release') { echo "selected";} ?>>RFP date</option>
</select>
</td>
<td colspan="2">
	<div id="dates" style="display:none;">
<input class="input1" type="date" name="sdate" id="sdate" value="<?php if($_POST['sdate']!='') { echo $_POST['sdate']; } else { echo '';} ?>">&nbsp;&nbsp;
<input class="input1" type="date" name="edate" id="edate" value="<?php if($_POST['edate']!='') { echo $_POST['edate']; } else { echo '';} ?>"></div>
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
<a style="float: right;" href="export_csv.php?title=<?=trim($_POST['title']);?>&vehicle=<?=urlencode($_POST['vehile']);?>&opportunity_type=<?=$_POST['opportunity_type'];?>&adv_set_aside=<?=$_POST['adv_set_aside'];?>&award=<?=$_POST['award'];?>&manager=<?=$_POST['manager'];?>&bnpphase=<?=$_POST['bnpphase'];?>&decision=<?=$_POST['decision'];?>"><b>Export to CSV</b></a>
 <table id="example" class="display" style="width:100%; font-family: 'Roboto', sans-serif; font-size: 13px;">
 <thead>
 <tr style="background-color: #3c4db0; color: #ffffff;">
	<th>Title</th>
	<th>Contract Vehicle</th>
	<th>Type</th>
	<th>Set-Aside</th>
	<th>Decision</th>
	<th>Manager</th>
	<th>B&P Phase</th>
	<th><?php if($released != '') { echo "Release Date"; } elseif($proposal_due != '') { echo "Proposal Date"; } elseif($rfp_release != '') { echo "RFP Date"; } else { echo "Release Date"; } ?></th>
	<th>#</th>
 </tr>
 </thead>
  <tbody>
 <?php 
 while($rec = mysqli_fetch_array($query)) {
$contrctveh_in = $rec[2];
$contrctveh = "";

if(strpos($contrctveh_in, '|||') !== false) {
	$ok = explode("|||",$contrctveh_in);
	$i = 0;
	$temp_variable = "";
	while($i<count($ok)){
		if($ok[$i] or $ok[$i+1]){
			$contrctveh .= $ok[$i]."&nbsp;-&nbsp;".$ok[$i+1]."<br/>";	
		}
		$i = $i+2;
	}
}		
else { 
 $contrctveh = ''; 
}
 ?>
 <tr>
	<td title="<?php echo $rec[1]; ?>"><?php
 //substr(strip_tags($rec[1]), 0, 20); 
 if(strlen($rec[1]) <= 20) {
  echo $rec[1];
} else {
  echo substr($rec[1], 0, 20) . '...';
}
 ?></td>
	<td><?php echo $contrctveh; ?></td>
	<td><?php echo $rec[10]; ?></td>
	<td><?php echo $rec[4]; ?></td>
	<td><?php echo $rec[3]; ?></td>
	<td><?php echo str_replace('"',"",$rec[5]); ?></td>
	<td><?php echo $rec[6]; ?></td>
<?php if($released != '') { ?>
<td>
<div style='display:none;'><?php echo date('Ymd', strtotime($rec[6])); ?></div>
<?php echo date('m-d-Y',strtotime($rec[7])); ?>
</td>
<?php } elseif($proposal_due != '') { ?>
<td>
<div style='display:none;'><?php echo date('Ymd', strtotime($rec[7])); ?></div>
<?php echo date('m-d-Y',strtotime($rec[8])); ?>
</td>
<?php } elseif($rfp_release != '') { ?>
<td>
<div style='display:none;'><?php echo date('Ymd', strtotime($rec[8])); ?></div>
<?php echo date('m-d-Y',strtotime($rec[9])); ?>
</td>
<?php } else { ?>
<td>
<div style='display:none;'><?php echo date('Ymd', strtotime($rec[6])); ?></div>
<?php echo date('m-d-Y',strtotime($rec[7])); ?>
</td>
<?php } ?>

	<td><a href="<?php echo $baseurl; ?>/addrole_view_opportunities.php?which_update_id='<?php echo $rec[0]; ?>'" target="_blank"><img src="<?php echo $baseurl; ?>/view.png" title="View" width="20" height="20" alt="View"></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $baseurl; ?>/addrole_update_opportunities.php?which_update_id='<?php echo $rec[0]; ?>'" target="_blank"><img src="<?php echo $baseurl; ?>/edit-pencil16.png" title="Edit" width="14" height="14" alt="Edit"></a></td>
 </tr>
 <?php } ?>
 
  </tbody>
 </table>
  
 </body>
</html>
<script>
$(document).ready(function(){
	$("#daterange").change(function(){
    var datetype = this.value;
//var datetype = $("#daterange").val();
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
	$("#dates").hide();
 }
});
$("#daterange").trigger("change");
});

$(document).ready(function(){
	$('#refreshpage').click(function(){				
		$('#title').val('');				
		$('#vehile').val('');				
		$('#opportunity_type').val('');				
		$('#adv_set_aside').val('');				
		$('#award').val('');				
		$('#manager').val('');				
		$('#bnpphase').val('');				
		$('#decision').val('');				
		$('#daterange').val('');				
	});
});
</script>