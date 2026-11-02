<?php

//$mysqli_link = mysqli_connect('portal.ardentinc.com',$db_user, $db_password,'bidsnew');

$status_selection = "<div style='background-color:#fff; color:#141414; text-align:left; width:200px; display:inline-block; vertical-align:top;'><div style='text-align:center;'><strong>Status</strong></div>";
 
$query = "SELECT DISTINCT STATUS FROM bp_transfer";
//print $query;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$select_value = $row[0];
	$status_selection .= "<input name='filter_0001' type='checkbox' value='value2' /> " . $select_value . "<BR>";
	}
	$status_selection .= "</select></div>";
	
//SELECT DISTINCT mastercontracts FROM bp_transfer

$vehicles_selection = "<div style='background-color:#fff; color:#141414; text-align:left; width:200px; display:inline-block;  vertical-align:top; overflow:auto;'><div style='text-align:center;'><strong>Vehicles</strong></div>";
 
$query = "SELECT DISTINCT mastercontracts FROM bp_transfer";
//print $query;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$vehicles_value = $row[0];
	$vehicles_selection .= "<input name='filter_0002' type='checkbox' value='value2' /> " . $vehicles_value . "<BR>";
	}
	$vehicles_selection .= "</div>";

/*$entry_date_selection = "<div style='display:100px; text-align:center; display:inline-block;'><strong>Status</strong><BR><input type='date' max='2100-12-31' id='entry_date_first' name='entry_date_first' value='" . $entry_date1 . "'> to 
<input type='date' max='2100-12-31' id='entry_date_second' name='entry_date_second' value='" . $entry_date2 . "'></div>";*/


$filterarea = "<div class='clearfix table_border' style='background-color:#fff; margin-bottom:10px; width:96%; margin-left:2%; padding:10px;'>
<div style='width:100px; text-align:center; display:inline-block;'>$vehicles_selection</div>
<div style='width:100px; text-align:center; display:inline-block;'>$status_selection</div>
</div>";
$filterarea = "<div style='background-color:#e2e2e2; margin-bottom:10px; width:96%; margin-left:2%; padding:15px;'>
$status_selection $vehicles_selection
</div>
";
?>