<?php
session_start();
$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;
?>
<!DOCTYPE html>
<html>
<head>
<script src="<?php echo $baseurl; ?>/tinymce/tinymce.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
  
<link href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet">

  <style>
  label { font-weight:500 !important; }
  .note-editable {
    font-family: 'Segoe UI' !important;
    font-size: 10px !important;
	font-weight:500;
  }
  .button_base_edit {
	display:inline-block;
	width: 50px;
    background: #e9e9e9;
    font-size: 11px;
    font-weight: 700;
    text-align: center;
    border-radius: 4px;
  }
  .button_base_save {
    display: none;
  	width: 50px;
    background: #e9e9e9;
    font-size: 11px;
    font-weight: 700;
    text-align: center;
    border-radius: 4px;
  }
  td, th { padding-left: 20px !important; }


body, input, table, td {font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}
.samewidth { width:240px; font-weight:700;}
.td-left { background-color:#fff; border:none; padding: 5px;}
.select-styled { padding: 4px 5px; border: 1px solid #cbcbcb; width:200px; font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}
.font-size { font-weight:500; background-color:#f6f6f6; }

.tox .tox-statusbar__text-container.tox-statusbar__text-container--flex-start {
    display: none !important;
}

.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* The actual popup */
.popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #3c4db0;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: '';
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #3c4db0 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
</style>
</head>
<?php
print("<div style='text-align:center;font-size: 18px;font-weight: 700;color: #3c4db0;'>Opportunity - Add</div>");

$form_portion = "<br><form id='addform' name='addform' action='opp_db_addnew_admin.php' method='post'>";
$form_table = $form_portion . "<table width='100%' border='0' cellspacing='5' cellpadding='5'>";
$form_update_content = "";

$state_dropdown="<select name='contract_state' id='contract_state' size='1' class='select-styled' style='width:60px;'><option value=''></option>";
$state_dropdown2="<select name='contract_state2' size='1' class='select-styled' style='width:60px;'><option value=''></option>";

$state_dropdown_d="<select name='state' size='1' class='select-styled' style='width:60px;' required><option value=''></option>";
$state_dropdown_d2="<select name='state2' size='1' class='select-styled' style='width:60px;'><option value=''></option>";

$vehicles_dropdown="<select name='contract_vehicle' id='contract_vehicle' autocomplete='off' size='1' class='select-styled'>
				  <option value=''></option>";
$vehicles_dropdown2="<select name='contract_vehicle_two' size='2' autocomplete='off' class='select-styled'>
				  <option value=''></option>";

//$mysqli_link = mysqli_connect('portal.ardentinc.com',$db_user, $db_password,'bidsnew');

$query = "SELECT state_abbrev FROM states ORDER BY state_abbrev ";
//print $query;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
		$state_dropdown .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
		$state_dropdown2 .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
		$state_dropdown_d .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
		$state_dropdown_d2 .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
	}
	$state_dropdown .= "</select>";
	$state_dropdown2 .= "</select>";
	$state_dropdown_d .= "</select>";
	$state_dropdown_d2 .= "</select>";
	
$query = "SELECT vehicle_name FROM state_contract_vehicles WHERE vehicle_show=1 ORDER BY vehicle_name";
//print $query;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
		$vehicles_dropdown .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
		$vehicles_dropdown2 .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
	}
	$vehicles_dropdown .= "<option value='Others'>Others</option></select>";
	$vehicles_dropdown2 .= "</select>";

$btype_dropdown="<select name='opp_response' id='opp_response' size='1' class='select-styled' style='width:200px;' required><option value=''></option>";

$bidtype_qry = "SELECT bid_name FROM state_bidtype WHERE bid_show=1 ORDER BY bid_name";
$btype_result = mysqli_query($mysqli_link, $bidtype_qry);
while($res = mysqli_fetch_array($btype_result, MYSQLI_NUM))
    {
		$btype_dropdown .= "<option value='" . $res[0] . "'>" . $res[0] . "</option>";
		$btype_dropdown2 .= "<option value='" . $res[0] . "'>" . $res[0] . "</option>";
	}
	$btype_dropdown .= "</select>";
	$btype_dropdown2 .= "</select>";



	$form_update_content .= "<tr><td width='160'><strong>Title</strong> <span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span></td><td class='td-left'><div class='popup' onclick=''>
	<input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='opp_title' autocomplete='off' type='text' required /></div>
	</td></tr>";
	$form_update_content .= "<tr><td><strong>Master Contracts</strong> <!-- <span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span> --></td><td class='td-left'><div class='popup'>
	$vehicles_dropdown &nbsp;&nbsp; 

	<input style='width:204px; border:1px solid #cbcbcb; padding:5px; display:none;' name='other_master_contract' id='other_master_contract' type='text' />

	<strong>State</strong>&nbsp; <span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span> $state_dropdown_d
    </div>
	<div style='font-weight:700; display:inline-block; vertical-align:top; margin-left:10px;'>ID <span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span></div>&nbsp;
	<div class='popup'>
	<input style='width:204px; border:1px solid #cbcbcb; padding:5px;' name='opp_vehicle_one' id='opp_vehicle_one' type='text' required /></div>
	</td></tr>";

  $form_update_content .="<tr><td colspan='2'><DIV name='contractveh_address' id='contractveh_address'></div>
		<input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='contractveh_table' id='contractveh_table' type='hidden' value='' /></td></tr>";
//add button code ends here
	
	$form_update_content .= "<tr><td><strong>Release Date</strong><span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span></td><td class='td-left'>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='opp_released' name='opp_released' required />
	</td></tr>";
	
$form_update_content .= "<tr><td><strong>Opportunity Type</strong> <span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span></td><td class='td-left'>
	<div class='popup'> 
	$btype_dropdown &nbsp;&nbsp;&nbsp;&nbsp;
	<span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span>
	<input type='radio' name='staffing' id='Staffing' value='Staffing' required>Staffing &nbsp;
	<span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span>
	<input type='radio' name='staffing' id='Project' value='Project' required>Project &nbsp;
	<span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span>
	<input type='radio' name='staffing' id='Others' value='Others' required>Others
    </div>
	</td></tr>";

	$form_update_content .= "<tr><td><strong>Assign to</strong> <span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span></td><td class='td-left'>
	<div class='popup' >
	<select name='manager' id='manager' size='1' class='select-styled' required>
	  <option value=''></option>
	  <option value='Prasad Devarakonda'>Prasad Devarakonda</option>
	  <option value='Rama Krishna'>Rama Krishna</option>
	</select></div></td></tr>";
// Code To Add Submission Mode Field Starts Here.
	$form_update_content .= "<tr><td><strong>Submission Mode</strong> <span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span></td><td class='td-left'>
	  <input type='checkbox' id='submission_postal' name='submission_mode[]' class='submissionMode' value='Postal' required>
	  <label for='recruiting_keypersonnel'> Postal</label>&nbsp;&nbsp;&nbsp;
	  <input type='checkbox' id='submission_email' name='submission_mode[]'  class='submissionMode' value='EMail' required>
	  <label for='recruiting_keypersonnel'> EMail</label>&nbsp;&nbsp;&nbsp;
	  <input type='checkbox' id='submission_online' name='submission_mode[]' class='submissionMode' value='Online' required>
	  <label for='recruiting_keypersonnel'> Online</label></td></tr>";
// Code To Add Submission Mode Field Ends Here.
	$form_update_content .= "<tr><td><strong>Submission Due Date</strong> <span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span></td><td class='td-left'>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='proposal_date' name='proposal_date' required>
	
	<input style='margin-left:10px;width:100px; border:1px solid #cbcbcb; padding:4px;' autocomplete='off' type='time' id='proposal_time' name='proposal_time' onchange='showproposal()' >
	<span id='proposal_timezone' style='display:none;font-weight:700; margin-left:10px;'> Timezone 
	<select name='proposal_timezone' id='' size='1' class='select-styled' style='margin-left:10px;'>
				  <option value='Not Provided'>Not Provided</option>
				  <option value='Atlantic Time (AT)'>Atlantic Time (AT)</option>
				  <option selected value='Eastern Time (ET)'>Eastern Time (ET)</option>
				  <option value='Central Time (CT)'>Central Time (CT)</option>
				  <option value='Mountain Time (MT)'>Mountain Time (MT)</option>
				  <option value='Pacific Time (PT)'>Pacific Time (PT)</option>
				  <option value='Alaskan Time (AKT)'>Alaskan Time (AKT)</option>
				  <option value='Hawaii-Aleutian Time (HT)'>Hawaii-Aleutian Time (HT)</option>
				  <option value='Local Time'>Local Time</option>
	</select> </span> </td></tr>";
	
	$form_update_content .= "<tr><td><strong>Q&A Due Date</strong></td><td class='td-left'>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='qa_date' name='qa_date'>
	
	
	<input style='margin-left:10px; width:100px; border:1px solid #cbcbcb; padding:4px;' type='time' id='qa_time' name='qa_time' onchange='qatimezone()'>
	<span id='qa_timezone' style='display:none;font-weight:700; margin-left:10px;'> Timezone 
	<select name='qa_timezone' id='' size='1' class='select-styled' style='margin-left:10px;'>
				  <option value='Not Provided'>Not Provided</option>
				  <option value='Atlantic Time (AT)'>Atlantic Time (AT)</option>
				  <option selected value='Eastern Time (ET)'>Eastern Time (ET)</option>
				  <option value='Central Time (CT)'>Central Time (CT)</option>
				  <option value='Mountain Time (MT)'>Mountain Time (MT)</option>
				  <option value='Pacific Time (PT)'>Pacific Time (PT)</option>
				  <option value='Alaskan Time (AKT)'>Alaskan Time (AKT)</option>
				  <option value='Hawaii-Aleutian Time (HT)'>Hawaii-Aleutian Time (HT)</option>
				  <option value='Local Time'>Local Time</option>
	</select> </span> </td></tr>";
	
	$form_update_content .= "<tr><td><strong>Intent to Bid</strong></td><td class='td-left'>
	<div class='popup'>&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='radio' name='intension' id='intent_yes' value='Yes'>Yes &nbsp;
	<input type='radio' name='intension' id='intent_no' value='No' checked>No
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<span id='mandatory_show' style='font-size:16px; font-weight:700; color:red; display:none' title='Required Field'>*</span>
	&nbsp;<input style='width:200px;; border:1px solid #cbcbcb; padding:5px; display:none' type='date' id='intent_bid_date' name='intent_bid_date'>
    </div>
	</td></tr>";

	$form_update_content .= "<tr><td><strong>RFP Release Date</strong></td><td class='td-left'>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='opp_rfp_date' name='opp_rfp_date'>
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Award Date</strong></td><td class='td-left'>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='opp_award_date' name='opp_award_date'></td></tr>";



	$form_update_content .= "<tr><td><strong>Bid Category</strong> <span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span> </td><td class='td-left'>
		<select name='bid_category' id='bid_category' size='1' class='select-styled'	style='width:200px;' required>
			<option value=''></option>
			<option value='Sole Source'>Sole Source</option>
			<option value='COTS/Available Software'>COTS/Available Software</option>
			<option value='License/Hardware Procurement'>License/Hardware Procurement</option>
			<option value='Website Development'>Website Development</option>
			<option value='SWA'>SoftWare/App Development</option>
			<option value='Non-IT'>Non-IT</option>
			<option value='LMS'>LMS</option>
			<option value='Scanning/Digitization'>Scanning/Digitization</option>
			<option value='Artificial Intelligence'>Artificial Intelligence</option>
			<option value='Others'>Others</option>
		</select>
	<!--<input type='checkbox' name='bid_category' value='LMS'>&nbsp;LMS &nbsp;-->
	<!--<input type='radio' name='bid_category' value='Top Secret'>Top Secret-->
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Priority</strong></td><td class='td-left'>
		<select name='priority' id='priority' size='1' class='select-styled' style='width:200px;'>
			<option value='No Priority' selected>No Priority</option>
			<option value='Priority 1'>Priority 1</option>
			<option value='Priority 2'>Priority 2</option>
			<option value='Priority 3'>Priority 3</option>		
			<option value='Priority 4'>Priority 4</option>		
		</select>
	</td></tr>";

	$form_update_content .= "<tr><td><strong>Est/Actual</strong> <span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span></td><td class='td-left'>
	<select name='est_actual' id='est_actual' size='1' class='select-styled' style='width:200px;' required>
		<option value=''></option>
		<option value='Estimate'>Estimate</option>
		<option value='Actual'>Actual</option>
	</select>
	</td></tr>";

	$form_update_content .= "<tr><td><strong>Department/Agency</strong> <span style='font-size:16px; font-weight:700; color:red;' title='Required Field'>*</span></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='agency' autocomplete='off' type='text' required/></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Certifications</strong></td><td class='td-left'><input style='width:404px; border:1px solid #cbcbcb; padding:5px;' name='certifications' autocomplete='off' type='text' /></td></tr>";

	$form_update_content .= "<tr><td><strong>URL</strong></td><td class='td-left'><input style='width:404px; border:1px solid #cbcbcb; padding:5px;' name='weburl' autocomplete='off' type='text' /></td></tr>";
// Code To Add Pre-Proposal Conference Field Starts Here.
	$form_update_content .= "<tr><td><strong>Pre-Proposal Conference </strong></td><td class='td-left'>
	<div class='popup'>
	<input type='radio' name='pp_conference' id='pp_conference_yes' value='Yes'>Yes &nbsp;
	<input type='radio' name='pp_conference' id='pp_conference_no' value='No' checked>No
	&nbsp;&nbsp;&nbsp;
	<span id='mandatory_field' style='display:none;'>
	<strong>Mandatory  </strong>
	<div class='popup'>
	<input type='radio' name='mandatory' id='mandatory_yes' value='Yes'>Yes &nbsp;
	<input type='radio' name='mandatory' id='mandatory_no' value='No'>No
	&nbsp;
	<!--<span id='mandatory_show' style='font-size:16px; font-weight:700; color:red; display:none' title='Required Field'>*</span>-->
	<input style='width:126px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='pp_conference_date' name='pp_conference_date' value=''>
	<input style='margin-left:10px; width:92px; border:1px solid #cbcbcb; padding:4px;' type='time' id='pp_conf_time' name='pp_conf_time' onchange='function_pp_conf_timezone()'>
	<span id='pp_conf_timezone_id' style='display:none;font-weight:700; margin-left:10px;'>  
	<select name='pp_conf_timezone' id='' size='1' class='select-styled' style='margin-left:10px; width: 180px;'>
				  <option value='Not Provided'>Not Provided</option>
				  <option value='Atlantic Time (AT)'>Atlantic Time (AT)</option>
				  <option value='Eastern Time (ET)'>Eastern Time (ET)</option>
				  <option value='Central Time (CT)'>Central Time (CT)</option>
				  <option value='Mountain Time (MT)'>Mountain Time (MT)</option>
				  <option value='Pacific Time (PT)'>Pacific Time (PT)</option>
				  <option value='Alaskan Time (AKT)'>Alaskan Time (AKT)</option>
				  <option value='Hawaii-Aleutian Time (HT)'>Hawaii-Aleutian Time (HT)</option>
				  <option value='Local Time'>Local Time</option>
	</select> </span>

	</span>
    </div>
	</td></tr>";
// Code To Add Pre-Proposal Conference Field Ends Here.
	$form_update_content .= "<tr>
        <td><strong>Description</strong></td>
        <td>
			<div style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='opp_synopsis' name='opp_synopsis'></textarea>
			</div>	
        </td>
      </tr>";
	 
	 $form_update_content .= "<tr><td><strong>Performance Location</strong></td><td class='td-left'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='contract_pop' id='contract_pop' autocomplete='new-password' type='text' value='' />
	 <div style='font-weight:700; width:50px; display:inline-block; vertical-align:top; margin-left:10px;'>City</div><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='contract_city' id='contract_city' autocomplete='new-password' type='text' value='' />
	 <div style='font-weight:700; width:50px; display:inline-block; vertical-align:top; margin-left:10px;'>State</div>$state_dropdown"; 
	 
	 $form_update_content .="<div style='background-color: #e4e4e4;
    padding: 4px;
    width: 80px;
    text-align: center; margin-top:10px;
    font-weight: 700; display:inline-block; margin-left: 20px; margin-bottom:10px; cursor: pointer;' onclick='address_table();
  '>Add</div>";
	 
	 $form_update_content .="<DIV name='opp_address' id='opp_address'></div>
		<input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='combined_table' id='combined_table' type='hidden' value='' /></td></tr>";
	 
	$form_update_content .= "<tr><td><strong>Period</strong></td><td class='td-left'>
	<fieldset style='width:134px; display:inline-block; border:1px solid #eaeaea; vertical-align: top;'>
  		<legend  style='font-size: 13px; font-weight: 700;'>Transition In</legend>
		<input name='trans_in_qty' id='trans_in_qty' autocomplete='new-password' maxlength='6' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' value='' style='width:40px; border:1px solid #cbcbcb; padding:5px;'/>
		
	<select name='trans_in_time' size='1' class='select-styled' style='width:80px;'>
	  <option value=''></option>
	  <option value='DAY(S)'>DAY(S)</option>
	  <option value='WEEK(S)'>WEEK(S)</option>
	  <option value='MONTH(S)'>MONTH(S)</option>
	</select>
	
	</fieldset>
	
	<span style='color: #e6e7ed; font-weight: 700; font-size: 20px;'>+</span> 
	
	<fieldset style='width:210px; display:inline-block; border:1px solid #eaeaea; vertical-align: top;'>
  		<legend  style='font-size: 13px; font-weight: 700;'>Base</legend>
		<select name='perioda' size='1' class='select-styled' style='width:60px;'>
	  <option value=''></option>
	  <option value='1'>1</option>
	  <option value='2'>2</option>
	  <option value='3'>3</option>
	  <option value='4'>4</option>
	  <option value='5'>5</option>
	  <option value='6'>6</option>
	  <option value='7'>7</option>
	  <option value='8'>8</option>
	  <option value='9'>9</option>
	  <option value='10'>10</option>
	  <option value='11'>11</option>
	  <option value='12'>12</option>
	</select> 
<!-- <span style='color: #3c4db0;font-weight: 700;'>BASE</span> --> 
	<select name='periodb' size='1' class='select-styled' style='width:100px;'>
		<option value=''></option>
	  <option value='MONTH(S)'>MONTH(S)</option>
	  <option value='YEAR(S)'>YEAR(S)</option>
	</select>
	</fieldset>
 <span style='color: #e6e7ed; font-weight: 700; font-size: 20px;'>+</span>  
 
 	<fieldset style='width:225px; margin-left:20px; display:inline-block; border:1px solid #eaeaea; vertical-align: top;'>
  		<legend  style='font-size: 13px; font-weight: 700;'>Option</legend>
		<select name='periodc' size='1' class='select-styled' style='width:60px;'>
	  <option value=''></option>
	  <option value='1'>1</option>
	  <option value='2'>2</option>
	  <option value='3'>3</option>
	  <option value='4'>4</option>
	  <option value='5'>5</option>
	  <option value='6'>6</option>
	  <option value='7'>7</option>
	  <option value='8'>8</option>
	  <option value='9'>9</option>
	  <option value='10'>10</option>
	  <option value='11'>11</option>
	  <option value='12'>12</option>
	</select> 
 <!-- <span style='color: #3c4db0;font-weight: 700;'>OPTION</span> -->
	<select name='periodd' size='1' class='select-styled' style='width:100px;'>
	  <option value=''></option>
	  <option value='MONTH(S)'>MONTH(S)</option>
	  <option value='YEAR(S)'>YEAR(S)</option>
	</select>
		
	</fieldset>
	
	<span style='color: #e6e7ed; font-weight: 700; font-size: 20px;'>+</span> 
	
	<fieldset style='width:136px; display:inline-block; border:1px solid #eaeaea; vertical-align: top;'>
  		<legend style='font-size: 13px; font-weight: 700;'>EOS</legend>
		<input name='eos_qty' id='eos_qty' autocomplete='new-password' maxlength='6' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' value='' style='width:40px; border:1px solid #cbcbcb; padding:5px;'/>
		
	<select name='eos_time' size='1' class='select-styled' style='width:80px;'>
	  <option value=''></option>
	  <option value='DAY(S)'>DAY(S)</option>
	  <option value='WEEK(S)'>WEEK(S)</option>
	  <option value='MONTH(S)'>MONTH(S)</option>
	</select>
	
	</fieldset>
	
	
	</td></tr>";
	
	/*$form_update_content .= "<tr><td><strong></strong></td><td class='td-left'>
	
 
 	<fieldset style='width:196px; display:inline-block; border:1px solid #eaeaea;'>
  		<legend>Transition In</legend>
		<input name='trans_in_qty' id='trans_in_qty' autocomplete='new-password' maxlength='6' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' value='' style='width:60px; border:1px solid #cbcbcb; padding:5px;'/>
		
	<select name='trans_in_time' size='1' class='select-styled' style='width:100px;'>
	  <option value=''></option>
	  <option value='DAY(S)'>DAY(S)</option>
	  <option value='WEEK(S)'>WEEK(S)</option>
	  <option value='MONTH(S)'>MONTH(S)</option>
	</select>
	
	</fieldset>
	
	<fieldset style='width:196px; display:inline-block; border:1px solid #eaeaea;'>
  		<legend>EOS</legend>
		<input name='eos_qty' id='eos_qty' autocomplete='new-password' maxlength='6' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' value='' style='width:60px; border:1px solid #cbcbcb; padding:5px;'/>
		
	<select name='eos_time' size='1' class='select-styled' style='width:100px;'>
	  <option value=''></option>
	  <option value='DAY(S)'>DAY(S)</option>
	  <option value='WEEK(S)'>WEEK(S)</option>
	  <option value='MONTH(S)'>MONTH(S)</option>
	</select>
	
	</fieldset>
 
 	
	
	
	
	</td></tr>";*/
	
	
	
	$form_update_content .= "<tr><td><strong>Pricing</strong></td><td class='td-left'>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Fixed-Price</div>
	  <input type='checkbox' id='pricing1' name='pricing1' value='Firm Fixed-Price (FFP)' onclick=\"pricing_update();\">
	  <label for='pricing1'> Firm Fixed-Price (FFP)</label><br>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Cost-Reimbursement</div>
	  <input type='checkbox' id='pricing5' name='pricing5' value='Cost-Reimbursement Actual Cost' onclick=\"pricing_update();\">
	  <label for='pricing5'> Cost-Reimbursement Actual Cost</label><br>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Time and Materials (T&M)</div>
	  <input type='checkbox' id='pricing11' name='pricing11' value='Time and Materials (T&M)' onclick=\"pricing_update();\">
	  <label for='pricing11'> Time and Materials (T&M)</label>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Labor Hour (L-H)</div>
	  <input type='checkbox' id='pricing12' name='pricing12' value='Labor Hour (LH)' onclick=\"pricing_update();\">
	  <label for='pricing12'> Labor Hour (L-H)</label>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Cost Plus Fixed Fee (CPFF)</div>
	  <input type='checkbox' id='pricing13' name='pricing13' value='Cost Plus Fixed Fee (CPFF)' onclick=\"pricing_update();\">
	  <label for='pricing13'> Cost Plus Fixed Fee (CPFF)</label>
	  </div>";
	  /*<div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Pricing Evaluation</div>
	  <input type='checkbox' id='pricing13' name='pricing13' value='LPTA (Lowest Price Technically Acceptable)' onclick=\"pricing_update();\">
	  <label for='pricing11'> LPTA (Lowest Price Technically Acceptable)</label>
	  </div>*/
	  
	  $form_update_content .= "
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Evaluation</div>
		  <select name='pricing_eval' class='select-styled'>
	  <option value=''></option>
	  <option value='LPTA'>LPTA</option>
	  <option value='Best Value'>Best Value</option>
		  </select>
	  </div>
	  
	
	<input style='width:100%; border:1px solid #cbcbcb; padding:5px;' id='opp_pricing' name='opp_pricing' type='hidden' value='' /></td></tr>";
	/*$form_update_content .= "<tr><td><strong>Recruiting:</strong></td><td><input style='width:100%; border:1px solid #cbcbcb; padding:5px;' name='opp_recruiting' type='text' value='$opp_recruiting' /></td></tr>";*/
	$form_update_content .= "<tr><td><strong>Recruiting</strong></td><td class='td-left'>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>FTE(s)</div>
		  <input name='recruitinga' id='recruitinga' autocomplete='new-password' maxlength='6' type='text' value='' style='width:60px; border:1px solid #cbcbcb; padding:5px;'/>
	  </div>
	  <div style='display:inline-block;padding:5px 7px;vertical-align:top;'><div style='font-weight:700;'>Hour(s)</div>
		  <input name='recruitinge' id='recruitinge' autocomplete='new-password' maxlength='6' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' value='' style='width:60px; border:1px solid #cbcbcb; padding:5px;'/>
	  </div>
	  <div style='display:inline-block;padding:5px 2px;vertical-align:top;'><div style='font-weight:700;'>Labor Category</div>
	  <input name='recruitingb' id='recruitingb' autocomplete='new-password' type='text' value='' style='width:220px; border:1px solid #cbcbcb; padding:5px;'/>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700; width:100px;'>Personnel</div>
	  <input type='checkbox' id='recruiting_keypersonnel' name='recruiting_keypersonnel' value='Key Personnel'>
	  <label for='recruiting_keypersonnel'> KP</label>
	  <input type='checkbox' id='recruiting_sca' name='recruiting_sca' value='SCA Personnel'>
	  <label for='recruiting_keypersonnel'> SCA</label>
	  </div>
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Clearance</div>
		  <select name='recruitingd' id='recruitingd' size='1' class='select-styled' style='width:128px;'>
					  <option value=''></option>
					  <option value='Not Applicable'>Not Applicable</option>
					  <option value='Public Trust'>Public Trust</option>
					  <option value='Confidential'>Confidential</option>
					  <option value='Secret (T3)'>Secret (T3)</option>
					  <option value='Top-Secret (T5)'>Top-Secret (T5)</option>
					  <option value='Top-Secret w/SCI'>Top-Secret w/SCI</option>
					  

		  </select>
	  </div>
	  
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'></div>
		  
  
  <div style='background-color: #e4e4e4;
    padding: 4px;
    width: 80px;
    text-align: center; margin-top:10px;
    font-weight: 700; cursor: pointer;' onclick='recruiting_table();
  '>Add</div>
	  </div>
	  <DIV name='opp_recruiting' id='opp_recruiting'></div>
		<input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='combined' id='combined' type='hidden' value='' />
	
	</td></tr>";
	
	/*$form_update_content .="<table id='myTable' onclick='alert(\"Hello\");addTableRow();'><tr><td>1</td><td>2</td></tr>
  <tr><td>3</td><td>4</td></tr></table>";*/
  
  /*<textarea style='width:90%; border:1px solid #cbcbcb; padding:5px;font-family:\"Century Gothic\", \"Segoe UI\"; font-size:12px;' name='opp_proposal' cols='10' rows='10'></textarea>*/
	
	$form_update_content .= "<tr><td><strong>Submission Requirements</strong></td><td class='td-left'>
			<div style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='opp_proposal' name='opp_proposal'></textarea>
			</div>
	
	</td></tr>";
	
	/*<textarea style='width:90%; border:1px solid #cbcbcb; padding:5px;font-family:\"Century Gothic\", \"Segoe UI\"; font-size:12px;' name='gaps_datateam' cols='10' rows='10'></textarea>*/
	
	$form_update_content .= "<tr><td><strong>Gaps (Research Team)</strong></td><td class='td-left'>
	
			<div style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='gaps_datateam' name='gaps_datateam'></textarea>
			</div>
	
	</td></tr>";
	
	/*<textarea style='width:90%; border:1px solid #cbcbcb; padding:5px;font-family:\"Century Gothic\", \"Segoe UI\"; font-size:12px;' name='notes_datateam' cols='10' rows='10'></textarea>*/
	
	$form_update_content .= "<tr><td><strong>Notes (Research Team)</strong></td><td class='td-left'>
	
			<div style='width:90%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='notes_datateam' name='notes_datateam'></textarea>
			</div>
	
	</td></tr>";
	
	/*$form_update_content .= "<tr><td><strong>Add to Agenda</strong></td><td class='td-left'><input type='checkbox' id='add_to_agenda' name='add_to_agenda' checked value='1'></td></tr>";*/
	

	
	/*$form_update_content .= "<tr><td><strong>Gap(s)</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='opp_gaps' type='text' value='' /></td></tr>";*/
	
	/*$form_update_content .= "<tr><td><strong>Decision</strong></td><td><input style='width:100%; border:1px solid #cbcbcb; padding:5px;' name='opp_decision' type='text' value='' /></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Status</strong></td><td><select name='opp_status' size='1' style='padding:2px 5px; font-weight:500;'>
				  <option value='Unreviewed'>Unreviewed</option>
				  <option value='New'>New</option>
				  <option value='Working'>Working</option>
				  <option value='RFP Tracking'>RFP Tracking</option>
				  <option value='Award Monitoring'>Award Monitoring</option>
				  <option value='Archived'>Archived</option>
				</select></td></tr>";*/
	
	/*$form_update_content .= "<tr><td><strong>Contract Ref:</strong></td><td>$db_inccontract</td></tr>";
	$form_update_content .= "<tr><td><strong>Q&A Due:</strong></td><td>$db_questionsduetime</td></tr>";
	$form_update_content .= "<tr><td><strong>NAICS:</strong></td><td>$db_naics</td></tr>";*/
	
	/*$form_update_content .= "<tr><td><strong>Description:</strong></td><td>$db_description</td></tr>";
	$form_update_content .= "<tr><td><strong>Sub:</strong></td><td>$db_nonsubdetails</td></tr>";
	$form_update_content .= "<tr><td><strong>Extras:</strong></td><td>$db_primaryskills</td></tr>";
	$form_update_content .= "<tr><td><strong>Created By:</strong></td><td>$db_created_by</td></tr>";*/
	
	//$extra_buttons_top = "<div style='display:inline-block; width:90%; text-align:right;'><input style='margin-left: 50px; padding:4px 16px; width:100px; font-weight: 700; cursor: pointer;' type='submit' value='Submit'></div>";
	
	print ($form_table . $extra_buttons_top . $form_update_content . "</table>");
?>

<input type="hidden" name="opp_opportunity_id" value="<?php print $opp_opportunity_id; ?>"/>
<div>
<div style="display:inline-block; width:90%; text-align:center;"></div>
<div style="display:inline-block; width:90%; text-align:center;">
	<input type="hidden" name="submit" value="Submit">
	<input style="margin-left: 50px; padding:4px 16px; width:100px; font-weight: 700; cursor: pointer;" type="submit" id="opp_submit" value="Submit">
	<!-- <input style="margin-left: 50px; padding:4px 16px; width:100px; font-weight: 700; cursor: pointer; display: none;" type="button" name="display_text" id="display_text" value="Please Wait....."> -->
</div>

</div>
</form>
</html>

<!-- Initialize Summernote -->
<script>
  tinymce.init({
  selector: 'textarea',
  height: 250,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'template paste textcolor colorpicker textpattern imagetools codesample toc help'
  ],
  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
  image_advtab: true,
  forced_root_block : 'div',
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    //'//www.tinymce.com/css/codepen.min.css'
  ]
});
  </script>
<script>
function pricing_update() {
	var pricing_text = "";
	document.getElementById('opp_pricing').value = "";
	//var p1=document.getElementById('pricing1').checked; 
	if (document.getElementById('pricing1').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing1').value + '<BR>'; }
	
	if (document.getElementById('pricing5').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing5').value + '<BR>'; }
	
	if (document.getElementById('pricing11').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing11').value + '<BR>'; }
	if (document.getElementById('pricing12').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing12').value + '<BR>'; }
	if (document.getElementById('pricing13').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing13').value + '<BR>'; }
}
</script>
<script>
function addTableRow() {
    var table = document.querySelector("#myTable");
    var totalrows = document.querySelectorAll("#myTable tr").length;
    var row = table.insertRow(totalrows);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = "NEW CELL1";
    cell2.innerHTML = "NEW CELL2";
}
function recruiting_table() {
	//alert("Nice");
	//CREATE DIV
	const divadd = document.createElement("div");
	//const node = document.createTextNode("aaa " + Math.floor(Math.random() * 255)); //0 thru 255);
	const node = document.createTextNode(""); //0 thru 255);
	divadd.style.color = "#a269c6"; //"#a269c6"; //background-color:#a269c6; width:90%; border:1px solid #8c4fb5;
	divadd.style.border = "1px solid #d4d4d4";
	divadd.style.width = "90%";
	
// Added by Rao.
var hoursVal;
var hrs_val = document.getElementById("recruitinge").value;
if(hrs_val != ""){
	hoursVal = hrs_val;
}else{
	hoursVal = 0;
}

var fteVal;
var fte_val = document.getElementById("recruitinga").value;
if(fte_val != ""){
	fteVal = fte_val;
}else{
	fteVal = 0;
}

//Ends Here.	
	
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='pt_a_" + Math.floor(Math.random() * 2048) + "' value='" + fteVal + " FTE(s)' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:60px; border:none;'></DIV>";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='pt_e_" + Math.floor(Math.random() * 2048) + "' value='" + hoursVal + " HRS' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:60px; border:none;'></DIV>";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;margin-left:4px;'><input type='text' name='pt_b' value='" + document.getElementById("recruitingb").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:220px; border:none;'></DIV>";
	
	var kptext = "";			
	var kp=document.getElementById("recruiting_keypersonnel"); if (document.getElementById("recruiting_keypersonnel").checked == true){ kptext = "(KP)"; }  
	var scatext = "";			
	var sca=document.getElementById("recruiting_sca"); if (document.getElementById("recruiting_sca").checked == true){ kptext = "(SCA)"; } 
	//recruiting_sca
	
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='pt_c' value='" + kptext + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:70px; border:none;'></DIV>";
	    /* float: right; */
    
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='pt_d' value='" + document.getElementById("recruitingd").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:180px; border:none; margin-left:7px;'></DIV>";
	
	divadd.innerHTML += "<span style='background-color:#a04071; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 14px; cursor: pointer;' onclick='this.parentElement.remove();refresh_table();'> Remove </span>";
	//divadd.setAttribute("id","newarea");
	divadd.appendChild(node);
	const element = document.getElementById("opp_recruiting");
	
	element.appendChild(divadd);
	
	//PASS TO INPUT
	var combinedtext = "";
	  var inputs, index;

		inputs = document.getElementsByTagName('input');
		for (index = 0; index < inputs.length; ++index) {
			
			
			if(inputs[index].name.indexOf('pt_') == 0) {
					//eles.push(inputs[i]);
						//alert("# of inputs " + inputs.length + " OK " + inputs[index].name + " VAL " + inputs[index].value);
					//alert ("&" + inputs[index].name + "=" + inputs[index].value);
					combinedtext += inputs[index].value + "|||";
				}
		}
	
	//alert(inputs.length);
	//document.getElementById('car').value="1234567890abc";	
	document.getElementById('combined').value=combinedtext;
	
	//CLEAR INPUT ZONE
	document.getElementById('recruitinga').value="";
	document.getElementById('recruitinge').value="";
	document.getElementById('recruitingb').value="";
	document.getElementById('recruiting_keypersonnel').checked = false;
	document.getElementById('recruiting_sca').checked = false;
	document.getElementById('recruitingd').value="";
}
function address_table(){
	var contract_pop = document.getElementById("contract_pop").value;
	//alert("Nice " + contract_pop);
	//exit();
	//CREATE DIV
	const divadd = document.createElement("div");
	//const node = document.createTextNode("aaa " + Math.floor(Math.random() * 255)); //0 thru 255);
	const node = document.createTextNode(""); //0 thru 255);
	divadd.style.color = "#a269c6"; //"#a269c6"; //background-color:#a269c6; width:90%; border:1px solid #8c4fb5;
	divadd.style.border = "1px solid #d4d4d4";
	divadd.style.width = "90%";
	
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='adp_a_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("contract_pop").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:260px; border:none;'></DIV>";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='adp_b_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("contract_city").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:260px; border:none;'></DIV>";
	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='adp_c_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("contract_state").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:60px; border:none;'></DIV>";
	
	divadd.innerHTML += "<span style='background-color:#a04071; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 14px; float:right; margin-right:20px; margin-top:3px; cursor: pointer;' onclick='this.parentElement.remove();refresh_addr();'> Remove </span>";
	//divadd.setAttribute("id","newarea");
	divadd.appendChild(node);
	const element = document.getElementById("opp_address");
	
	element.appendChild(divadd);
	
	//PASS TO INPUT
	var combinedtext = "";
	  var inputs, index;

		inputs = document.getElementsByTagName('input');
		for (index = 0; index < inputs.length; ++index) {
			
			
			if(inputs[index].name.indexOf('adp_') == 0) {
					//eles.push(inputs[i]);
						//alert("# of inputs " + inputs.length + " OK " + inputs[index].name + " VAL " + inputs[index].value);
					//alert ("&" + inputs[index].name + "=" + inputs[index].value);
					combinedtext += inputs[index].value + "|||";
				}
		}
	
	//alert(inputs.length);
	//document.getElementById('car').value="1234567890abc";	
	document.getElementById('combined_table').value=combinedtext;
	
	//CLEAR INPUT ZONE
	document.getElementById('contract_pop').value="";
	document.getElementById('contract_city').value="";
	document.getElementById('contract_state').value="";
	//document.getElementById('recruiting_keypersonnel').checked = false;
	//document.getElementById('recruitingd').value="";
}
function refresh_table() {
//PASS TO INPUT
	var combinedtext = "";
	  var inputs, index;

		inputs = document.getElementsByTagName('input');
		for (index = 0; index < inputs.length; ++index) {
			
			
			if(inputs[index].name.indexOf('pt_') == 0) {
						//alert("# of inputs " + inputs.length + " OK " + inputs[index].name + " VAL " + inputs[index].value);
					combinedtext += inputs[index].value + "|||";
				}
		}
	
	document.getElementById('combined').value=combinedtext;	
}
function refresh_addr() {
//PASS TO INPUT
	var combinedtext = "";
	  var inputs, index;

		inputs = document.getElementsByTagName('input');
		for (index = 0; index < inputs.length; ++index) {
			
			
			if(inputs[index].name.indexOf('adp_') == 0) {
						//alert("# of inputs " + inputs.length + " OK " + inputs[index].name + " VAL " + inputs[index].value);
					combinedtext += inputs[index].value + "|||";
				}
		}
	
	document.getElementById('combined_table').value=combinedtext;	
}
</script>
<script>
function validateForm() {
  var x = document.forms["myForm"]["fname"].value;
  if (x == "") {
    alert("Name must be filled out");
    return false;
  }
}
</script>
<script>
function showproposal(){
	//alert('hello111');
	document.getElementById("proposal_timezone").style.display = "inline-block";
}
function qatimezone(){
	//alert('qa'); qa_timezone
	document.getElementById("qa_timezone").style.display = "inline-block";
}
// Code To Add PP Conf. Timezone function Starts Here.
function function_pp_conf_timezone(){
	document.getElementById("pp_conf_timezone_id").style.display = "inline-block";
}
// Code To Add PP Conf. Timezone function Ends Here.
</script>
<script>

function requiredfields() {
	//alert("Required Fields");
  var x = document.forms["addform"]["opp_title"].value;
  if (x == "") {
	popup1();
	setTimeout(popup1, 5000);
	document.forms["addform"]["opp_title"].focus();
    return false;
  }
  
  var x = document.forms["addform"]["opp_released"].value;
  if (x == "") {
    //alert("Release Date must be filled out (Required Field)");
	popup4();
	setTimeout(popup4, 5000);
	document.forms["addform"]["opp_released"].focus();
    return false;
  }
  var x = document.forms["addform"]["opp_response"].value;
  if (x == "") {
    //alert("Opportunity Type must be filled out (Required Field)");
	popup5();
	setTimeout(popup5, 5000);
	document.forms["addform"]["opp_response"].focus();
    return false;
  }
} 
</script>
<script>
function dateslashes() {

	var sdp = document.getElementById('opp_released');
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
				
	var sdp = document.getElementById('proposal_date');
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
				
	var sdp = document.getElementById('qa_date');
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
	
	var sdp = document.getElementById('opp_award_date');
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
					
	var sdp = document.getElementById('opp_rfp_date');
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
	
	var sdp = document.getElementById('est_pop_start_date');
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
function popup1() {
  var popup1 = document.getElementById('myPopup1');
  popup1.classList.toggle('show');
   //document.getElementById('myPopup1').fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
}
function popup2() {
  var popup2 = document.getElementById('myPopup2');
  popup2.classList.toggle('show');
}
function popup3() {
  var popup3 = document.getElementById('myPopup3');
  popup3.classList.toggle('show');

}
function popup4() {
  var popup4 = document.getElementById('myPopup4');
  popup4.classList.toggle('show');

}
function popup5() {
  var popup5 = document.getElementById('myPopup5');
  popup5.classList.toggle('show');

}
function popup6() {
  var popup6 = document.getElementById('myPopup6');
  popup6.classList.toggle('show');

}
function popup7() {
  var popup7 = document.getElementById('myPopup7');
  popup7.classList.toggle('show');

}
</script>
<script>
	function qa_due_date_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('qa_date').focus();
		document.getElementById('qa_date').click();
	}
	 function proposal_date_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('proposal_date').focus();
		document.getElementById('proposal_date').click();
	} 
	function opp_award_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('opp_award_date').focus();
		document.getElementById('opp_award_date').click();
	}
	function opp_rfp_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('opp_rfp_date').focus();
		document.getElementById('opp_rfp_date').click();
	}
	function opp_released_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('opp_released').focus();
		document.getElementById('opp_released').click();
	}
	function est_pop_start_date_click() {
		//alert("2");
	//document.getElementById('range_to').datepicker('show');
		document.getElementById('est_pop_start_date').focus();
		document.getElementById('est_pop_start_date').click();
	} 
// JS Code to Display and Hide the fields Intent Bid Date & PP Conf Mandatory & PP Conf Date & Timezone Starts Here.
		document.getElementById('intent_yes').addEventListener('click', function() {	
			document.getElementById('intent_bid_date').style.display = 'inline-block';
			document.getElementById('mandatory_show').style.display = 'inline-block';
			document.getElementById('intent_bid_date').setAttribute('required', true);
		});
		document.getElementById('intent_no').addEventListener('click', function() {
			document.getElementById('intent_bid_date').style.display = 'none';
			document.getElementById('mandatory_show').style.display = 'none';
			document.getElementById('intent_bid_date').removeAttribute('required');
		});
		document.getElementById('pp_conference_yes').addEventListener('click', function() {	
			document.getElementById('mandatory_field').style.display = 'inline-block';
		});
		document.getElementById('pp_conference_no').addEventListener('click', function() {	
			document.getElementById('mandatory_field').style.display = 'none';
		});
// JS Code to Display and Hide the fields Intent Bid Date & PP Conf Mandatory & PP Conf Date & Timezone Ends Here.		

// JQuery code to Validate Duplicate Bid IDs Starts Here.
$(document).ready(function() {
	$('#opp_vehicle_one').blur(function() {
		 var idValue = $('#opp_vehicle_one').val();

		$.ajax({
			url: 'validate_duplicate_id.php', 
			type: 'POST', 
			data: { 
				name: idValue
			},
			success: function(response) {
					if(response >= 1){
						alert("Entered ID already exists.");
						$('#opp_vehicle_one').val('');
						return false;
					}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				// This function is executed if there's an error with the request
				console.error('Error:', textStatus, errorThrown);
			}
        });
	});

	$('.submissionMode').click(function() {
		var submissionModeCount = 0;
			 submissionModeCount = $(".submissionMode:checked").length;
			if(submissionModeCount > 0){
				$(".submissionMode").attr("required",false);
			}else{
				$(".submissionMode").attr("required",true);
			}
	}); 

	$('#Staffing').click(function() {
		$('#manager').val('Rama Krishna');
	});
	$('#Project').click(function() {
		$('#manager').val('Prasad Devarakonda');
	});
	$('#Others').click(function() {
		$('#manager').val('');
	});
});
// JQuery code to Validate Duplicate Bid IDs Ends Here.
</script>

<script>
	$(document).ready(function() {
		$("#contract_vehicle").change(function(){
			var contract_name = $("#contract_vehicle").val();
			if(contract_name == 'Others'){
				$("#other_master_contract").show();
				$("#other_master_contract").prop('required', true);
			}else{
				$("#other_master_contract").hide();
				$("#other_master_contract").prop('required', false);
			}
		});
	

/*	$('#opp_submit').on('click', function() {
		$('#display_text').show();
		$('#opp_submit').hide();
	}); */

	$("form[name='addform']").on("submit", function (e) {
            $("#opp_submit")
                .val("Please Wait...")
                .prop("disabled", true)
                .css("opacity", "0.7");
    });

});
</script>