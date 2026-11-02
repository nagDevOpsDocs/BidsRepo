<?php
print("
<style>
/* Tooltip container */
.tooltip {
  position: relative;
  display: inline-block;
  /* border-bottom: 1px dotted black;  */
}

/* Tooltip text */
.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
 
  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 4;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
  visibility: visible;
  width: 120px;
  bottom: 100%;
  left: 50%;
  margin-left: -60px;
}
</style>
");
?>
<?php 

$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;

//CALENDARS
print("
<link href='https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/themes/smoothness/jquery-ui.css' rel='stylesheet'>
      <script src='https://code.jquery.com/jquery-1.10.2.js'></script>  
      <script src='https://code.jquery.com/ui/1.10.4/jquery-ui.js'></script>");
print("<script>  
         $(function() { 
			$( '#range_to' ).datepicker();
			$( '#range_from' ).datepicker();
			
         });  
      </script> ");

//GET VARS

	$range_from="";
	$range_to="";
	$search_suffix = "?opportunity_id>0";
	
	if (!empty($_GET['which_update_id'])) { $search_suffix .= "&which_update_id=". $_GET['which_update_id'];}
	if (!empty($_GET['search'])) { $search_suffix .= "&search=". $_GET['search'];}
	if (!empty($_GET['range_from'])) { $search_suffix .= "&range_from=". $_GET['range_from']; $range_from=$_GET['range_from'];} else {$range_from=""; }
	if (!empty($_GET['range_to'])) { $search_suffix .= "&range_to=". $_GET['range_to']; $range_to=$_GET['range_to'];} else { $range_to=""; }

	//$morefilters = "";
	if (isset($_GET['ot1'])) {  $ot1_checked=" checked='checked' "; } else { $ot1_checked=""; }
	if (isset($_GET['ot2'])) {  $ot2_checked=" checked='checked' "; } else { $ot2_checked=""; }
	if (isset($_GET['ot3'])) {  $ot3_checked=" checked='checked' "; } else { $ot3_checked=""; }
	if (isset($_GET['ot4'])) {  $ot4_checked=" checked='checked' "; } else { $ot4_checked=""; }
	if (isset($_GET['ot5'])) {  $ot5_checked=" checked='checked' "; } else { $ot5_checked=""; }

	if (isset($_GET['veh1'])) { $veh1_checked=" checked='checked' "; } else { $veh1_checked=""; }
	if (isset($_GET['veh2'])) { $veh2_checked=" checked='checked' "; } else { $veh2_checked=""; }
	if (isset($_GET['veh3'])) { $veh3_checked=" checked='checked' "; } else { $veh3_checked=""; }
	if (isset($_GET['veh4'])) { $veh4_checked=" checked='checked' "; } else { $veh4_checked=""; }
	if (isset($_GET['veh5'])) { $veh5_checked=" checked='checked' "; } else { $veh5_checked=""; }
	if (isset($_GET['veh6'])) { $veh6_checked=" checked='checked' "; } else { $veh6_checked=""; }
	if (isset($_GET['veh7'])) { $veh7_checked=" checked='checked' "; } else { $veh7_checked=""; }
	
	$morefilters = "";
	if (isset($_GET['ot1'])) {  $morefilters .= " AND response LIKE '%draft rfp%' "; } 
	if (isset($_GET['ot2'])) {  $morefilters .= " AND response LIKE '%industry%' "; }
	if (isset($_GET['ot3'])) {  $morefilters .= " AND response LIKE '%rfi%' "; }
	if (isset($_GET['ot4'])) {  $morefilters .= " AND response LIKE '%rfq%' "; }
	if (isset($_GET['ot5'])) {  $morefilters .= " AND response LIKE '%rfp%' "; }
	
	if (isset($_GET['veh1'])) {  $morefilters .= " AND ((contract_vehicle LIKE '%711%') OR (contract_vehicle_two LIKE '%711%')) "; }
	if (isset($_GET['veh2'])) {  $morefilters .= " AND ((contract_vehicle LIKE '%GSA%') OR (contract_vehicle_two LIKE '%GSA%')) "; }
	if (isset($_GET['veh3'])) {  $morefilters .= " AND ((contract_vehicle LIKE '%8(a)%') OR (contract_vehicle_two LIKE '%8(a)%')) "; }
	if (isset($_GET['veh4'])) {  $morefilters .= " AND ((contract_vehicle LIKE '%oasis sb%') OR (contract_vehicle_two LIKE '%oasis sb%')) "; }
	if (isset($_GET['veh5'])) {  $morefilters .= " AND ((contract_vehicle LIKE '%SAM%') OR (contract_vehicle_two LIKE '%SAM%')) "; }
	if (isset($_GET['veh6'])) {  $morefilters .= " AND ((contract_vehicle LIKE '%SEC%') OR (contract_vehicle_two LIKE '%SEC%')) "; }
	if (isset($_GET['veh7'])) {  $morefilters .= " AND ((contract_vehicle LIKE '%STARS%') OR (contract_vehicle_two LIKE '%STARS%')) "; }
	
	$_SESSION["morefilters"] = $morefilters;
		
			$query_vehicle = "SELECT vehicle_id, vehicle_name FROM state_contract_vehicles ORDER BY vehicle_name ";
		$qy_vehicle="";
		$qy_vehicle_count = 0;
$result_vehicle = mysqli_query($mysqli_link, $query_vehicle);
while($row_vehicle = mysqli_fetch_array($result_vehicle, MYSQLI_NUM))
    {
		//$state_dropdown .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
		$qy_vehicle_count++;
		if ($qy_vehicle_count==1) { $qy_vehicle .= "<label class='container'><input type='checkbox' $veh1_checked name='veh1' value='711'> " . $row_vehicle[1] . "</label>"; }
		if ($qy_vehicle_count==2) { $qy_vehicle .= "<label class='container'><input type='checkbox' $veh2_checked name='veh2' value='GSA'> " . $row_vehicle[1] . "</label>"; }
		if ($qy_vehicle_count==3) { $qy_vehicle .= "<label class='container'><input type='checkbox' $veh3_checked name='veh3' value='8(a)'> " . $row_vehicle[1] . "</label>"; }
		if ($qy_vehicle_count==4) { $qy_vehicle .= "<label class='container'><input type='checkbox' $veh4_checked name='veh4' value='oasis sb'> " . $row_vehicle[1] . "</label>"; }
		if ($qy_vehicle_count==5) { $qy_vehicle .= "<label class='container'><input type='checkbox' $veh5_checked name='veh5' value='SAM'> " . $row_vehicle[1] . "</label>"; }
		if ($qy_vehicle_count==7) { $qy_vehicle .= "<label class='container'><input type='checkbox' $veh7_checked name='veh7' value='STARS'> " . $row_vehicle[1] . "</label>"; }
		if ($qy_vehicle_count % 2 == 0) { $qy_vehicle .= "<BR>"; } 
	}
	
			print("
			<!-- <div style=\"font-weight:700; font-size:16px; background-color:#36374c; color:#FFF; text-align:center; padding-top:8px; padding-bottom:10px;margin-bottom:4px;\">BidPortal</div> -->

			<button type=\"button\" class=\"collapsible7\" style=\"margin-bottom:4px;\" onclick=\"window.location.href='$baseurl/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review'\">Bid Agenda</button>
			
			<button type=\"button\" class=\"collapsible7\" style=\"margin-bottom:4px;\" onclick=\"window.location.href='$baseurl/addrole_add_opportunity.php'\">Add</button>
        
			<button type=\"button\" class=\"collapsible7\">Search</button>
			");
			print("
            <div class=\"content7\">");
                          
                
				$search_this= '';
if(!empty($_GET['search'])) { $search_this = $_GET['search']; $_SESSION['search'] = '?search=' . $search_this; } else { $_SESSION['search'] = ''; }
	
				$request_uri = $_SERVER['REQUEST_URI'];
				$base_page = explode('.php', $request_uri);
				if(!empty($search_this) && ($base_page[0] == 'addrole_opportunities')) {
				//print ("<script>alert('base $base_page[0]')</script>");
				//print ("<script>alert('$request_uri')</script>");
				print("<script>window.top.location.href = '$baseurl/addrole_opportunities.php?search=$search_this';</script>"); 
				}
															 

				print("
                <form action='addrole_opportunities.php' method='get' enctype='multipart/form-data' style='margin:0px; padding:0px;'>
					<fieldset style='margin-bottom:10px; border:1px solid #e4e4e4;' title='ID, Agency, Title, Incumbent, Requestor' alt='ID, Agency, Title, Incumbent, Requestor'><legend style='border:1px solid #e4e4e4e;font-weight:500; font-size:13px;' >
					
					<div class='tooltip' style='font-weight:700;'>Search<!--<span class='tooltiptext'>Tooltip text</span>--></div>
					
					</legend>
                    <input name='search' type='text' value='$search_this' style='font-size:13px;width: 200px; padding-left:8px; font-weight:700;'>
					</fieldset>
					
					<!-- <fieldset style='margin-bottom:10px; border:1px solid #e4e4e4;'><legend style='border:1px solid #e4e4e4e;font-weight:700; font-size:13px;'><span style=''>Opportunity Type(s)</span></legend>
            		
					<label class='container'><input type='checkbox' name='ot1' value='draft' $ot1_checked> Draft RFP</label>
					<label class='container'><input type='checkbox' name='ot2' value='industry' $ot2_checked> Industry Day</label><BR>
					<label class='container'><input type='checkbox' name='ot3' value='rfi' $ot3_checked> RFI</label>
					<label class='container'><input type='checkbox' name='ot4' value='rfq' $ot4_checked> RFQ</label>
					<label class='container'><input type='checkbox' name='ot5' value='rfp' $ot5_checked> RFP</label>
					
					</fieldset>
					
					<fieldset style='margin-bottom:10px; border:1px solid #e4e4e4;'><legend style='border:1px solid #e4e4e4e;font-weight:700; font-size:13px;'><span style=''>Contract Vehicle(s)</span></legend>
                    
					$qy_vehicle
					</fieldset> -->
					
					<fieldset style='margin-bottom:10px; border:1px solid #e4e4e4;'><legend style='border:1px solid #e4e4e4e;font-weight:700; font-size:13px;'>Date Range</legend>
                    
					<div for='range_from' style='width:70px;display:inline-block'>Date From:</div>
					<input style='width:90px; border:1px solid #cbcbcb; padding:5px; font-size:12px;' name='range_from' id='range_from' autocomplete='off' onkeyup='dateslashes(this);' type='text' minlength='10' pattern='.{0}|.{10,}' placeholder='MM/DD/YYYY' onkeypress='return event.charCode >= 48 && event.charCode <= 57' title='10 character minimum' maxlength='10' max='2100-12-31' value='" . "" . "' /> <span style='margin-left:10px'> <span style='color:#d4d4d4' onclick='from_click();'> &#x1F4C5;</span></span>
					
  
  					<div style='height:10px;'></div>
					<div for='range_to' style='width:70px;display:inline-block'>Date To:</div>
  
  
  
  					<input style='width:90px; border:1px solid #cbcbcb; padding:5px; font-size:12px;' name='range_to' id='range_to' autocomplete='off' onkeyup='dateslashes(this);' type='text' minlength='10' pattern='.{0}|.{10,}' placeholder='MM/DD/YYYY' onkeypress='return event.charCode >= 48 && event.charCode <= 57' title='10 character minimum' maxlength='10' max='2100-12-31' value='" . "" . "' /> <span style='margin-left:10px'> <span style='color:#d4d4d4' onclick='range_click();'> &#x1F4C5;</span></span>
  
					</fieldset>
					
           			<input name='' type='submit' value='Apply' style='float:right' />
                </form>
				<a style='color:blue; font:bold;' href='advanced_search.php'>Advanced search</a>
                
            </div>");
			?>
			
            <?php /*print_r($_GET);*/ 
		//<input type='date' max='2100-12-31' id='range_to' name='range_to' value='$range_to' style='font-size:13px;width: 200px; padding-left:8px; font-weight:700;'>
		//<input type='date' max='2100-12-31' id='range_from' name='range_from' value='$range_from' style='font-size:13px;width: 200px; padding-left:8px; font-weight:700;'>
			?>
<script>
function dateslashes() {

	var sdp = document.getElementById('range_to');
    var sdp_length = sdp.value.length;
	var remove_extras_stp = "";
    //alert(sdp_length);

	 			if (sdp_length == 2){
					sdp.value = sdp.value + "/";
                }
				else if (sdp_length == 5){
                    sdp.value = sdp.value + "/";
                }
				if (sdp_length>10) {
					//alert('too much'); 
					remove_extras_stp = sdp.value.slice(0,-1); //"123"; //sdp.text.slice(0,-1);
					//alert("EXTRA " + remove_extras_stp);
					sdp.value = remove_extras_stp;
					//sdp.value = innerHTML.slice(0, -1); 
					}
				
	var sdp = document.getElementById('range_from');
    var sdp_length = sdp.value.length;
	var remove_extras_stp = "";
    //alert(sdp_length);

	 			if (sdp_length == 2){
					sdp.value = sdp.value + "/";
                }
				else if (sdp_length == 5){
                    sdp.value = sdp.value + "/";
                }
				if (sdp_length>10) {
					remove_extras_stp = sdp.value.slice(0,-1); //"123"; //sdp.text.slice(0,-1);
					sdp.value = remove_extras_stp;
					}
				
	
}
</script>
<script>
	function range_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('range_to').focus();
		document.getElementById('range_to').click();
	}
	 function from_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('range_from').focus();
		document.getElementById('range_from').click();
	} 
         
      
</script>