<?php
session_start();
include("./includes/connect_portal123.php");
if($_SESSION['user_role']==''){ header("Location: $login");  }

//ini_set('display_errors', 1);

if(isset($_POST['search']))
{
$vehile = $_POST['vehile'];
$opportunity_type = $_POST['opportunity_type'];
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
/*if($opportunity_type != '')
	{
		$response = " AND response ='".$opportunity_type."'";
	}
	else
	{
		$response = '';
	}*/

if($sdate != '')
	{
		$released = " AND (DATE(released) BETWEEN '".$sdate."' AND '".$edate."')";
	}
	else
	{
		$released = " AND (DATE(released) BETWEEN '2018-01-01' AND '".$edate."')";
	}

}

$query = mysqli_query($mysqli_link,"SELECT YEAR(released) as ryear,MONTH(released) as rmonth,COUNT(opportunity_id) as rcount FROM excel_test WHERE decision_value='5' $veh $released GROUP BY YEAR(released),MONTH(released) ORDER BY YEAR(released),MONTH(released)");
$ie_count = mysqli_num_rows($query);

$query2 = mysqli_query($mysqli_link,"SELECT is_awarded, YEAR(released) as ryear, MONTH(released) as rmonth, COUNT(opportunity_id) as rcount FROM excel_test WHERE is_awarded='Won' $veh $released GROUP BY YEAR(released),MONTH(released) ORDER BY YEAR(released),MONTH(released)");
$award_count = mysqli_num_rows($query2);

$query3 = mysqli_query($mysqli_link,"SELECT YEAR(released) as ryear,MONTH(released) as rmonth,COUNT(opportunity_id) as rcount FROM excel_test WHERE response='RFI' $veh $released GROUP BY YEAR(released),MONTH(released) ORDER BY YEAR(released),MONTH(released)");
$rfi_count = mysqli_num_rows($query3);

$query4 = mysqli_query($mysqli_link,"SELECT YEAR(released) as ryear,MONTH(released) as rmonth,COUNT(opportunity_id) as rcount FROM excel_test WHERE response='RFP' $veh $released GROUP BY YEAR(released),MONTH(released) ORDER BY YEAR(released),MONTH(released)");
$rfp_count = mysqli_num_rows($query4);

$getagenda = array();
while($res = mysqli_fetch_array($query,MYSQLI_ASSOC)){
$monthName = date('M', mktime(0, 0, 0, $res['rmonth'], 10)); 
$getagenda[] = array("month"=>$monthName.'-'.$res['ryear'], "count"=>$res['rcount']);
}

$getaward = array();
while($res2 = mysqli_fetch_array($query2,MYSQLI_ASSOC)){
$monthName2 = date('M', mktime(0, 0, 0, $res2['rmonth'], 10));
$getaward[] = array("month"=>$monthName2.'-'.$res2['ryear'], "count"=>$res2['rcount'], "awarded"=>$res2['is_awarded']);
}
//echo "<pre>";
//print_r($getaward);
//exit;
$getreview = array();
while($res3 = mysqli_fetch_array($query3,MYSQLI_ASSOC)){
$monthName3 = date('M', mktime(0, 0, 0, $res3['rmonth'], 10));
$getreview[] = array("month"=>$monthName3.'-'.$res3['ryear'], "count"=>$res3['rcount']);
}

$getarchived = array();
while($res4 = mysqli_fetch_array($query4,MYSQLI_ASSOC)){
$monthName4 = date('M', mktime(0, 0, 0, $res4['rmonth'], 10));
$getarchived[] = array("month"=>$monthName4.'-'.$res4['ryear'], "count"=>$res4['rcount']);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BidPortal</title>
<!-- from agenda -->
<link rel="stylesheet" href="styles/rcs.css?ver=5">
<!--end -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
  <style>
* {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 50%;
  padding: 10px;
}
.row {
  margin-left:10px;
  margin-right:10px;
}
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>
<style>
.select-styled { padding: 9px 9px; border: 1px solid #cbcbcb; width:200px; font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}
.font-size { font-weight:500; background-color:#f6f6f6; }
.input1 { width:188px;; border:1px solid #cbcbcb; padding:5px; }
</style>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
</head>
<body>
<div style='width:100%; z-index:2; height:80px;' class="topnav" id="myTopnav"> 
	  <div style="display: inline;top:25px; left:30px; position:relative; font-size:18px; font-weight:700; color:#fff;">BidPortal</div> 

	  <div onclick='window.location.href = "<?php echo $baseurl; ?>/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review"' style="position:relative; text-align:right; margin-right:20px; font-size:16px; cursor: pointer; font-weight:700; color:#fff">Bid Agenda</div>

	  <div onclick='window.location.href = "<?php echo $baseurl; ?>/logout.php' style="position:relative; text-align:right; margin-right:20px; font-size:16px; cursor: pointer; font-weight:700; color:#fff">Logout</div>
</div>

<?php 
$vehicle = mysqli_query($mysqli_link,"SELECT vehicle_id, vehicle_name FROM contract_vehicles WHERE vehicle_show=1 ORDER BY vehicle_name");

$status = mysqli_query($mysqli_link,"SELECT status_id, status_name FROM status_levels WHERE (status_show>0) ORDER BY status_show");

//$awarded = mysqli_query($mysqli_link,"SELECT awarded_name FROM awarded_levels WHERE awarded_show>0 ORDER BY awarded_id");
?>

<form id="dbform" action="" method="post" style="padding:30px 0px;">
<table align="center" cellpadding="4">
<tr>
<td>
<select name="vehile" id="vehile" class="select-styled">
<option value=''>Contract Vehicle</option>
<?php while($getveh = mysqli_fetch_array($vehicle)) { ?>
<option value='<?php echo $getveh[1]; ?>'<?php if($_POST['vehile']==$getveh[1]) { echo "selected";} ?>><?php echo $getveh[1]; ?></option>
<?php } ?>
</select> 
<input class="input1" type="text" name="sdate" id="sdate" placeholder="Start date" autocomplete="off" value="<?php if($_POST['sdate']!='') { echo $_POST['sdate']; } else { echo '';} ?>" readonly >&nbsp;&nbsp;
<input class="input1" type="text" name="edate" id="edate" placeholder="End date" autocomplete="off" value="<?php if($_POST['edate']!='') { echo $_POST['edate']; } else { echo '';} ?>" readonly > 

<input style="50px; padding:4px 16px; width:100px; font-weight: 700;" type="submit" name="search" value="Create" />
<!-- <button id="refreshpage" style="50px; padding:4px 16px; width:100px; font-weight: 700;">Reset</button> -->
</td>
<!-- <td>
<select name="opportunity_type" id="opportunity_type" class="select-styled">
<option value='RFI'<?php if($_POST['ot']=='RFI') { echo "selected";} ?>>RFP</option>
<option value='RFP'<?php if($_POST['ot']=='RFP') { echo "selected";} ?>>RFP</option>
</select>
</td> -->
</tr>
</table>
</form>

<div class="row">
<div class="column">
<?php if($getagenda){ ?>
<div class='col-md-12'>
<div id="GoogleColumnChart" style="height: 400px; width: 100%"></div>
</div>
 
<script>
google.charts.load('visualization', "1", {
	packages: ['corechart']
});
function showChart() {
	var data = google.visualization.arrayToDataTable([
		['Month','Count'], 
	<?php
		foreach($getagenda as $row) {
			if($row){
				echo "['".$row['month']."',";
				echo $row['count'];
				echo "],";
			}
		}
		?>
	]);
	var options = {
		title: 'Ineligible',
		isStacked: false
	};
	var chart = new google.visualization.LineChart(document.getElementById('GoogleColumnChart'));
	chart.draw(data, options);
}
google.charts.setOnLoadCallback(showChart);
</script>
<?php
}
else {
?>
<div class='col-md-12'>
<div id="GoogleColumnChart" style="height: 500px; width: 100%">History is not available!</div>
</div>
<?php } ?>
</div>

<div class="column">
<!-- <p>Award..<?php echo $award_count; ?></p> -->
<?php if($getaward){ ?>
<div class='col-md-12'>
<div id="GoogleColumnChart2" style="height: 400px; width: 100%"></div>
</div>
 
<script>
google.charts.load('visualization', "1", {
	packages: ['corechart']
});
function showChart() {
	var data = google.visualization.arrayToDataTable([
		['Award','Count'], 
	<?php
		foreach($getaward as $row) {
			if($row){
				echo "['".$row['month']."',";
				echo $row['count'];
				echo $row['is_awarded'];
				echo "],";
			}
		}
		?>
	]);
	var options = {
		title: 'Award Won',
		is3D: true
	};
	var chart = new google.visualization.PieChart(document.getElementById('GoogleColumnChart2'));
	chart.draw(data, options);
}
google.charts.setOnLoadCallback(showChart);
</script>
<?php
		}
		else{
		?>
<div class='col-md-12'>
<div id="GoogleColumnChart2" style="height: 400px; width: 100%">History is not available!</div>
</div>
<?php } ?>
</div>
</div>

<div class="row" style="margin-top:20px !important;">
  <div class="column">
    <!-- <p>RFI..<?php echo $rfi_count; ?></p> -->

<?php if($getreview){ ?>
<div class='col-md-12'>
<div id="GoogleColumnChart3" style="height: 400px; width: 100%"></div>
</div>
 
<script>
google.charts.load('visualization', "1", {
	packages: ['corechart']
});
function showChart() {
	var data = google.visualization.arrayToDataTable([
		['Month','Count'], 
	<?php
		foreach($getreview as $row) {
			if($row){
				echo "['".$row['month']."',";
				echo $row['count'];
				echo "],";
			}
		}
		?>
	]);
	var options = {
		title: 'RFI',
		isStacked: false
	};
	var chart = new google.visualization.BarChart(document.getElementById('GoogleColumnChart3'));
	chart.draw(data, options);
}
google.charts.setOnLoadCallback(showChart);
</script>
<?php
}
else {
?>
<div class='col-md-12'>
<div id="GoogleColumnChart3" style="height: 500px; width: 100%">History is not available!</div>
</div>
<?php } ?>

  </div>
  <div class="column">
    <!-- <p>RFP..<?php echo $rfp_count; ?></p> -->

<?php if($getarchived){ 
?>
<div class='col-md-12'>
<div id="GoogleColumnChart4" style="height: 400px; width: 100%"></div>
</div>
 
<script>
google.charts.load('visualization', "1", {
	packages: ['corechart']
});
function showChart() {
	var data = google.visualization.arrayToDataTable([
		['Month','Count'], 
	<?php
		foreach($getarchived as $row) {
			if($row){
				echo "['".$row['month']."',";
				echo $row['count'];
				echo "],";
			}
		}
		?>
	]);
	var options = {
		title: 'RFP',
		isStacked: false
	};
	var chart = new google.visualization.ColumnChart(document.getElementById('GoogleColumnChart4'));
	chart.draw(data, options);
}
google.charts.setOnLoadCallback(showChart);
</script>
<?php
}
else {
?>
<div class='col-md-12'>
<div id="GoogleColumnChart4" style="height: 500px; width: 100%">History is not available!</div>
</div>
<?php } ?>

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
				
		$('#vehile').val('');			
		$('#opportunity_type').val('');
		$("#sdate").val('');
		$("#edate").val('');
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
          changeYear: true,
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