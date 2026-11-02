<?php
session_start();
include("./includes/connect_portal123.php");
//if($_SESSION['user_role']==''){ header("Location: $login");  }
//$srch_val = http_build_query($_GET,'','&');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['search']))
{
//$title = trim($_POST['title']);
$vehile = $_POST['vehile'];
$opportunity_type = $_POST['opportunity_type'];
//$fav = $_POST['fav'];
//$award = $_POST['award'];
//$manager = $_POST['manager'];
$bnpphase = $_POST['bnpphase'];
//$decision = $_POST['decision'];
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

if($bnpphase != '')
	{
		$st = " AND status_value ='".$bnpphase."'";
	}
	else
	{
		$st = '';
	}

if($daterange == 'released')
	{
		$released = " AND (DATE(released) BETWEEN '".$sdate."' AND '".$edate."')";
	}
	else
	{
		$released = " AND (DATE(released) BETWEEN '2018-01-01' AND '".$edate."')";
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

//$query = mysqli_query($mysqli_link,"SELECT opportunity_id, contractveh_table,  decision, manager, status, released, proposal_due, rfp_date FROM excel_test WHERE $veh $released $proposal_due $rfp_release");

//$getrec = mysqli_query($mysqli_link,"SELECT YEAR(released) AS year, MONTH(released) AS month, COUNT(DISTINCT opportunity_id) AS joins FROM  excel_test WHERE released BETWEEN '2022-01-01' AND '2024-05-31' GROUP BY MONTH(released)"); */

$query = mysqli_query($mysqli_link,"SELECT released as reldate, YEAR(released) as ryear,MONTH(released) as rmonth,COUNT(opportunity_id) as rcount FROM excel_test WHERE status_value='1' $veh $released GROUP BY released, YEAR(released),MONTH(released) ORDER BY YEAR(released),MONTH(released)");
$agenda_count = mysqli_num_rows($query);
$query2 = mysqli_query($mysqli_link,"SELECT released as reldate, YEAR(released) as ryear, MONTH(released) as rmonth, COUNT(opportunity_id) as rcount FROM excel_test WHERE status_value='5' $veh $released GROUP BY released, YEAR(released),MONTH(released) ORDER BY YEAR(released),MONTH(released)");
$award_count = mysqli_num_rows($query2);
$query3 = mysqli_query($mysqli_link,"SELECT released as reldate, YEAR(released) as ryear,MONTH(released) as rmonth,COUNT(opportunity_id) as rcount 
  FROM excel_test WHERE status_value='7' $veh $released GROUP BY released, YEAR(released),MONTH(released) ORDER BY YEAR(released),MONTH(released)");
$underreview_count = mysqli_num_rows($query3);
$query4 = mysqli_query($mysqli_link,"SELECT released as reldate, YEAR(released) as ryear,MONTH(released) as rmonth,COUNT(opportunity_id) as rcount 
  FROM excel_test WHERE status_value='6' $veh $released GROUP BY released, YEAR(released),MONTH(released) ORDER BY YEAR(released),MONTH(released)");
$archieve_count = mysqli_num_rows($query4);

$getres = array();
while($res = mysqli_fetch_array($query,MYSQLI_ASSOC)){
$getres[] = array("month"=>date('M-Y',strtotime($res['reldate'])), "count"=>$res['rcount']);
}
print_r($getres);

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 300px; 
}

.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>
<style>
.select-styled { padding: 4px 5px; border: 1px solid #cbcbcb; width:200px; font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}
.font-size { font-weight:500; background-color:#f6f6f6; }
.input1 { width:188px;; border:1px solid #cbcbcb; padding:5px; }
</style>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
</head>
<body>
<div style="text-align:center;font-size:22px;font-weight:700;color:#3c4db0;margin-bottom:15px;">Dash Board</div>
<?php 
$vehicle = mysqli_query($mysqli_link,"SELECT vehicle_id, vehicle_name FROM contract_vehicles WHERE vehicle_show=1 ORDER BY vehicle_name");

$status = mysqli_query($mysqli_link,"SELECT status_id, status_name FROM status_levels WHERE (status_show>0) ORDER BY status_show");

//$awarded = mysqli_query($mysqli_link,"SELECT awarded_name FROM awarded_levels WHERE awarded_show>0 ORDER BY awarded_id");
?>
<form id="dbform" action="" method="post">
<table align="center" cellpadding="4">
<tr>
	<td>
<select name="vehile" id="vehile" class="select-styled">
<option value=''>Contract Vehicle</option>
<?php while($getveh = mysqli_fetch_array($vehicle)) { ?>
<option value='<?php echo $getveh[1]; ?>'<?php if($_POST['vehile']==$getveh[1]) { echo "selected";} ?>><?php echo $getveh[1]; ?></option>
<?php } ?>
</select>
</td>
<!-- <td>
<select name="opportunity_type" id="opportunity_type" class="select-styled">
<option value=''>Opportunity type</option>
<option value='Draft RFP'<?php if($_POST['opportunity_type']=='Draft RFP') { echo "selected";} ?>>Draft RFP</option>
<option value='Industry Day'<?php if($_POST['opportunity_type']=='Industry Day') { echo "selected";} ?>>Industry Day</option>
<option value='RFI'<?php if($_POST['opportunity_type']=='RFI') { echo "selected";} ?>>RFI</option>
<option value='RFQ'<?php if($_POST['opportunity_type']=='RFQ') { echo "selected";} ?>>RFQ</option>
<option value='RFP'<?php if($_POST['opportunity_type']=='RFP') { echo "selected";} ?>>RFP</option>
</select>
</td> -->

<!-- <td>
<select name="bnpphase" id="bnpphase" class="select-styled">
<option value=''>B&P Phase</option>
<?php while($getst = mysqli_fetch_array($status)) { ?>
<option value='<?php echo $getst[0]; ?>'<?php if($_POST['bnpphase']==$getst[0]) { echo "selected";} ?>><?php echo $getst[1]; ?></option>
<?php } ?>
</select>
</td> -->
</tr>
<tr>
<td>
<select name="daterange" id="daterange" class="select-styled">
<option value=''>Select date type</option>
<option value='released'<?php if($_POST['daterange']=='released') { echo "selected";} ?>>Release date</option>
<!-- <option value='proposal_due'<?php if($_POST['daterange']=='proposal_due') { echo "selected";} ?>>Proposal date</option>
<option value='rfp_release'<?php if($_POST['daterange']=='rfp_release') { echo "selected";} ?>>RFP date</option> -->
</select>
</td>
<td colspan="2">
	<div id="dates" style="display:none;">
<input class="input1" type="text" name="sdate" id="sdate" autocomplete="off" value="<?php if($_POST['sdate']!='') { echo $_POST['sdate']; } else { echo '';} ?>">&nbsp;&nbsp;
<input class="input1" type="text" name="edate" id="edate" autocomplete="off" value="<?php if($_POST['edate']!='') { echo $_POST['edate']; } else { echo '';} ?>"></div>
</td>
</tr>
<tr>
<td colspan="3">
<input style="50px; padding:4px 16px; width:100px; font-weight: 700;" type="submit" name="search" value="Create" />&nbsp;&nbsp;
<button id="refreshpage" style="50px; padding:4px 16px; width:100px; font-weight: 700;">Reset</button>
</td>
</tr>
</table>
</form>
<div class="row">
  <div class="column" style="background-color:#aaa;">
    <h2>First</h2>
    <p>Agenda..<?php echo $agenda_count; ?></p>
  </div>
  <div class="column" style="background-color:#bbb;">
    <h2>Second</h2>
    <p>Award..<?php echo $award_count; ?></p>
  </div>
</div>
<div class="row">
  <div class="column" style="background-color:#ccc;">
    <h2>Third</h2>
    <p>Under Review..<?php echo $underreview_count; ?></p>
  </div>
  <div class="column" style="background-color:#ddd;">
    <h2>Fourth</h2>
    <p>Archived..<?php echo $archieve_count; ?></p>
  </div>
</div>

<?php include("includes/footer.php"); ?>
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
		//$('#title').val('');				
		$('#vehile').val('');				
		$('#opportunity_type').val('');				
		//$('#award').val('');				
		$('#manager').val('');				
		$('#bnpphase').val('');				
		//$('#decision').val('');				
		$('#daterange').val('');				
	});
});
</script>

<script>
$( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#sdate" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#edate" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
</script>