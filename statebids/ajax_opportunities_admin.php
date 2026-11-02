<?php
include("./includes/connect_portal123.php");
?>
<style>
body, input, table, td, select, textarea {
font-family:'Century Gothic', 'Segoe UI'; font-size:12px;
}
.font-size 
{ 
font-weight:500; background-color:#f6f6f6; 
}
</style>

<?php
$search_this= "";
if (!empty($_GET['search'])) { $search_this = $_GET['search']; $_SESSION["search"] = "?search=" . $search_this; $search_term=strtoupper($_GET['search']); } else { $_SESSION["search"] = ""; $search_term="";}
if (!empty($_GET['status'])) { $status =  " STATUS='" . $_GET['status'] . "' AND "; $_SESSION["status"] = "?status=" . $status; } else { $_SESSION["status"] = ""; $status="";}

	$qy_builder = "";
	

	if (!empty($_GET['range_from'])) { 
	$range_from_date = $_GET['range_from'];
	$range_from_date_in = date("Y-m-d", strtotime($_GET['range_from']));
	$range_from_date_formatted = DateTime::createFromFormat("m/d/Y" , $range_from_date_in);

	$qy_builder .= " AND DATE(released) >= '" . $range_from_date_in . "'"; 
	}
	if (!empty($_GET['range_to'])) { 
	$range_to_date = $_GET['range_to'];
	$range_to_date_in = date("Y-m-d", strtotime($_GET['range_to']));
	$range_to_date_formatted = DateTime::createFromFormat("m/d/Y" , $range_to_date_in);
	
	$qy_builder .= " AND DATE(released) <= '" . $range_to_date_in . "'"; 
	}

$entry_date2 = date("Y-m-d");
$entry_date1 = date('Y-m-d', strtotime($entry_date2 . ' -1 month'));

$filterarea = "";
//include("includes/filter_area.php");


$count_results = 0;
$tr_color = "background-color:#31335f;";
$tr_font_color = "color:#fff; text-align:center;";
$tr_color .= $tr_font_color;

$header_part = "";
$table_content = "";

if (!empty($_GET['which_update_id'])) { $which_update_id = $_GET['which_update_id']; $specific_id=" AND opportunity_id='$which_update_id' "; } else { $specific_id=""; } 

$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, contract_vehicle_two, last_update, contractveh_table FROM state_excel_test   
WHERE $status (title LIKE '%$search_this%' 
OR vehicle_one LIKE '%$search_this%' 
OR contract_vehicle LIKE '%$search_this%'  
OR contract_vehicle_two LIKE '%$search_this%'  
OR agency LIKE '%$search_this%' 
OR subagency LIKE '%$search_this%') order by opportunity_id DESC LIMIT 100";

$query_total = "SELECT count(*) FROM state_excel_test   
WHERE $status (title LIKE '%$search_this%' 
OR vehicle_one LIKE '%$search_this%' 
OR contract_vehicle LIKE '%$search_this%'  
OR contract_vehicle_two LIKE '%$search_this%' 
OR agency LIKE '%$search_this%' 
OR subagency LIKE '%$search_this%' 
) ORDER BY opportunity_id";


$total_results = 0;
$result = mysqli_query($mysqli_link, $query_total);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$total_results = $row[0];
	}

$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$opp_opportunity_id = $row[0];
	$opp_opportunity_id_find = str_ireplace($search_this, '<span style="background-color:yellow;">'.strtoupper($search_this).'</span>', $opp_opportunity_id); 
	$opp_bidopp = $row[1];
	$opp_response = $row[2]; 
	$opp_requestor_db = $row[3];
	$opp_requestor = str_ireplace($search_this, '<span style="background-color:yellow;">'.strtoupper($search_this).'</span>', $opp_requestor_db); //#8ad7ff;
	$opp_title_db = str_replace("<BR>","",$row[4]);
	$opp_title = str_ireplace($search_this, '<span style="background-color:yellow;">'.strtoupper($search_this).'</span>', $opp_title_db);
	$opp_due = strtoupper($row[5]); 
	
	$release_date_db = $row[6];
	$phpdate_released = strtotime( $release_date_db );
	$opp_released = date( 'm/d/Y', $phpdate_released );
	
	$opp_pop = $row[7];
	$opp_synopsis = str_replace("•<BR>","• ",$row[8]); 
	$opp_proposal = $row[9]; 
	$opp_pricing = $row[10]; 
	$opp_recruiting_in = $row[11]; 
	
	$contract_vehicle = $row[16];

	$table_content .= "<DIV style='background-color:#fff; border:1px solid #c1c1c1; margin-bottom:10px;padding:0px;'>
	
	<div style='width:60%;font-size:13px; font-weight:700; padding-left:5px; padding-right:5px; padding-top:5px; padding-bottom:7px; cursor: pointer; color:#36374c; display:inline-block;' class='' onclick=\"window.parent.location.href='$baseurl/addrole_update_opportunities.php?which_update_id=$opp_opportunity_id'\"><u><strong>$opp_title</strong></u> <img src='edit-pencil16.png' width='16' height='16' /><BR>
		<div style='color:#141414; font-weight:500;display:inline-block; width:100%;margin-top:14px;'>
			<div style='display:inline-block; width:150px;'>Type </div>
			<div style='display:inline-block; width:50%;'>$opp_response</div>
		</div>
		<div style='color:#141414; font-weight:500;display:inline-block; width:100%;'>
			<div style='display:inline-block; width:150px;'>Release Date </div>
			<div style='display:inline-block; width:50%;'>$opp_released</div>
		</div>
		<div style='color:#141414; font-weight:500;display:inline-block; width:100%;'>
			<div style='display:inline-block; width:150px;'>State</div>
			<div style='display:inline-block; width:50%;'>$agency</div>
		</div>
		
		<div style='color:#141414; font-weight:500;display:inline-block; width:100%;'>
			<div style='display:inline-block; width:150px;'>Master Contracts</div>
			<div style='display:inline-block; width:50%;'>$contract_vehicle</div>
		</div>
	</div>
</DIV>";
$count_results++;
}
	
//TITLE
print("<div style='width:98%; text-align:center;font-weight:500; color:#141414; font-size:15px;'><span style='font-weight:700;'>Searching for '$search_term'</span></div><div style='height:10px;'></div>");

print("<div style='width:98%; text-align:center;font-weight:500; color:#3c4db0; font-size:15px;'><span style='font-weight:700;color:#3c4db0'><a name='opportunities_anchor' style='color:#3c4db0;'>Opportunities</a></span> ($total_results Found)</div><div style='height:10px;'></div>");

print($filterarea . "<div class='clearfix' style='display:inline-block;vertical-align:top; width:98%; margin-left:1%;'>" . $header_part. $table_content . "</table></div>");
?>

</div>