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
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script> -->
  
<link href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
	  
<!--  Code for MultiSelect Boxes starts Here.-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
   <script src="<?php echo $baseurl; ?>/includes/js/bootstrap-multiselect.js"></script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

<script>
  $(document).ready(function() {
		$('#domains').multiselect({
			includeSelectAllOption: false,
		});
  });
</script>
<!--  Code for MultiSelect Boxes Ends Here.  -->
 <style>
 .btn-default {
	width:200px;
	text-align:left;
	border-radius: 0px;
 }
 .btn-default .caret{
	display:none
 }
  label { font-weight:500 !important; }
  .note-editable {
    font-family: "Roboto", sans-serif !important;
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

  .multiselect-container>li>a>label {
    margin: 0;
    height: 100%;
    cursor: pointer;
    font-weight: 400;
    padding: 3px 9px 3px 25px;
   }
  </style>

<style>
body, input, table, td {font-family:"Roboto", sans-serif; font-size:12px;}
.samewidth { width:240px; font-weight:700;}
.td-left { /*background: #f9f9f9;*/ background-color:#fff; /*background:none;*/ border:none; /*border: 1px #dedede solid;*/ padding: 5px;}
.select-styled { padding: 4px 5px; /*font-weight: 500;*/ border: 1px solid #cbcbcb; width:200px; font-family:"Roboto", sans-serif; font-size:12px;}
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
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

//$which_update_id=1542; //$_GET['which_update_id'];
//$which_update_id=1542; //$_GET['which_update_id'];
print("<div style='text-align:center;font-size: 18px;font-weight: 700;color: #3c4db0;'>Opportunity - Add</div>");

$form_portion = "<form id='addform' action='opp_db_addnew_admin.php' method='post' onsubmit='return requiredfields();'>";
$form_table = $form_portion . "<table width='100%' border='0' cellspacing='5' cellpadding='5'>";
$form_update_content = "";

$state_dropdown="<select name='contract_state' id='contract_state' size='1' class='select-styled' style='width:60px;'>
				  <option value=''></option>
				  ";
$state_dropdown2="<select name='contract_state2' size='1' class='select-styled' style='width:60px;'>
				  <option value=''></option>
				  ";
$vehicles_dropdown="<select name='contract_vehicle' id='contract_vehicle' autocomplete='off' size='1' class='select-styled' style='border-left:5px solid #3c4db0;'>
				  <option value=''></option>";
$vehicles_dropdown2="<select name='contract_vehicle_two' size='1' autocomplete='off' class='select-styled'>
				  <option value=''></option>";

//$mysqli_link = mysqli_connect('portal.ardentinc.com',$db_user, $db_password,'bidsnew');

$query = "SELECT state_abbrev FROM states ORDER BY state_abbrev ";
//print $query;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
		$state_dropdown .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
		$state_dropdown2 .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
	}
	$state_dropdown .= "</select>";
	$state_dropdown2 .= "</select>";
	
$query = "SELECT vehicle_name FROM contract_vehicles WHERE vehicle_show=1 ORDER BY vehicle_name ";
//print $query;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
		$vehicles_dropdown .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
		$vehicles_dropdown2 .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
		/*	if($row[0] == '711th'){
				$vehicles_dropdown .= "<option value='DLA JETS 2.0'>DLA JETS 2.0</option>";
				$vehicles_dropdown2 .= "<option value='DLA JETS 2.0'>DLA JETS 2.0</option>";
			}
			else if($row[0] == 'GSA MAS Schedule'){
				$vehicles_dropdown .= "<option value='OASIS+ SB'>OASIS+ SB</option>";
				$vehicles_dropdown2 .= "<option value='OASIS+ SB'>OASIS+ SB</option>";
			} */
	}

	$vehicles_dropdown .= "</select>";
	$vehicles_dropdown2 .= "</select>";

$naics_query = "SELECT naics_code FROM naics_codes ORDER BY naics_code";
$result1 = mysqli_query($mysqli_link, $naics_query);
$naics_code_dropdown = "";
while($row = mysqli_fetch_array($result1, MYSQLI_NUM))
    {
		$naics_code_dropdown .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
	}

//$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status FROM excel_test  
//WHERE opportunity_id = $which_update_id";
//print $query;

	$form_update_content .= "<tr><td width='160'><strong>Title</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'><div class='popup' onclick=''>
	<input style='width:600px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' name='opp_title' id='opp_title' autocomplete='off' type='text' required value='' /><span class='popuptext' id='myPopup1' onkeyup='clearpopup()'>Title - Required Field</span>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' name='agenda_show_status' id='agenda_show_status' value='1' ><strong>&nbsp;Don't show in Agenda</strong></div></td></tr>";
	$form_update_content .= "<tr><td><strong>Contract Vehicle(s)</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'><div class='popup' onclick=''>
	$vehicles_dropdown
	<span class='popuptext' id='myPopup2'>Contract Vehicle(s) - Required Field</span></div>

	<input style='width:153px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0; display: none;' name='other_vehicle_name' id='other_vehicle_name' autocomplete='off' type='text' value=''/>

	<div style='font-weight:700; width:27px; display:inline-block; /*vertical-align:top;*/ margin-left:10px;'>ID <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></div>
	<div class='popup' onclick=''>
	<input style='width:153px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' name='opp_vehicle_one' id='opp_vehicle_one' autocomplete='new-password' type='text' value=''/>
	<span class='popuptext' id='myPopup3'>ID - Required Field</span></div>

	<div style='font-weight:700; width:66px; display:inline-block; /*vertical-align:top;*/margin-left:10px;'><strong>Set-Aside</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></div>
	<div class='popup' onclick=''>
	<select name='set_aside' id='set_aside' size='1' class='select-styled' style='border-left:5px solid #3c4db0;'>
				  <option value=''></option>
				  <option value='8(a) Competed'>8(a) Competed</option>
				  <option value='8(a) Sole-Source'>8(a) Sole-Source</option>
				  <option value='HUBZone'>HUBZone</option>
				  <option value='Woman Owned'>Woman Owned</option>
				  <option value='Unrestricted'>Unrestricted</option>
				  <option value='Small Business'>Small Business</option>
				  <option value='SDVOSB'>SDVOSB</option>
	</select>

	<div style='background-color: #e4e4e4;
    padding: 4px;
    width: 80px;
    text-align: center; margin-top:10px;
    font-weight: 700; display:inline-block; margin-left: 20px; margin-bottom:10px; cursor: pointer;' onclick='contractveh_add();'>Add</div></td>
	</td></tr>";



  $form_update_content .="<tr><td colspan='2'><DIV name='contractveh_address' id='contractveh_address'></div>
		<input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='contractveh_table' id='contractveh_table' type='hidden' value='' /></td></tr>";
//add button code ends here
	
	$form_update_content .= "<tr><td><strong>Domains</strong> </td><td class='td-left'>
		<select name='domains[]' id='domains' multiple='multiple' style='border-left:5px solid #3c4db0;'>
				  <!--<option value=''></option>-->
				  <option value='Business Administration'>Business Administration</option>
				  <option value='Enterprise Solutions'>Enterprise Solutions</option>
				  <option value='Environmental Services'>Environmental Services</option>
				  <option value='Facilities'>Facilities</option>
				  <option value='Financial Services'>Financial Services</option>
				  <option value='Human Capital'>Human Capital</option>
				  <option value='Intelligence Services'>Intelligence Services</option>
				  <option value='Logistics'>Logistics</option>
				  <option value='Management and Advisory'>Management and Advisory</option>
				  <option value='Marketing and Public Relations'>Marketing and Public Relations</option>
				  <option value='Research and Development'>Research and Development</option>
				  <option value='Social Services'>Social Services</option>
				  <option value='Technical and Engineering'>Technical and Engineering</option>
		</select>
	<div style='font-weight:700; width:52px; display:inline-block; vertical-align:top; margin-left:10px;'>NAICS<br/>Code <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></div>
	<input style='width:204px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' name='naics_code' id='naics_code' autocomplete='new-password' type='text' value='' list='naics_codes' required/>

			<datalist id='naics_codes'>
				$naics_code_dropdown
			</datalist> 

	<div style='font-weight:700; width:153px; display:inline-block; vertical-align:top; margin-left:10px;'>Size Standards (\$M / E#)
	<span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></div>
	<input style='width:111px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0; text-align: center;' name='size_standard' id='size_standard' autocomplete='off' type='text' value='' readonly />
	</td></tr>";

	$form_update_content .= "<tr><td><strong>Release Date</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' required type='date' id='opp_released' name='opp_released'></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Opportunity Type</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'>
	<div class='popup' >
	<select name='opp_response' id='opp_response' size='1' class='select-styled' style='border-left:5px solid #3c4db0;' required>
				  <option value=''></option>
				  <option value='Industry Day'>Industry Day</option>
				  <option value='RFI'>RFI</option>
				  <option value='Draft RFP'>Draft RFP</option>
				  <option value='RFP'>RFP</option>
				  <option value='RFQ'>RFQ</option>
				  <option value='Forecast'>Forecast</option>
				</select> <span class='popuptext' id='myPopup5'>Opportunity Type - Required Field</span></div></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Submission Due Date</strong><span style='font-size:16px; font-weight:700; color:#3c4db0;'>*</span></td><td class='td-left'>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' type='date' id='proposal_date' name='proposal_date'>
	
	<input style='margin-left:10px;width:100px; border:1px solid #cbcbcb; padding:4px;' autocomplete='off' type='time' id='proposal_time' name='proposal_time' onchange='showproposal()'>
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
	</select> </span> </td></tr>";

	$form_update_content .= "<tr><td><strong>RFP Release Date</strong> <!--<span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span>--></td><td class='td-left'>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='opp_rfp_date' name='opp_rfp_date'>
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Award Date</strong> <!--<span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span>--></td><td class='td-left'>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='opp_award_date' name='opp_award_date'></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Est. PoP Start Date</strong></td><td class='td-left'>
	<input style='width:200px;; border:1px solid #cbcbcb; padding:5px;' type='date' id='est_pop_start_date' name='est_pop_start_date'></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Department</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='agency'  autocomplete='new-password' type='text' value='' /></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Agency</strong></td><td class='td-left'><input style='width:600px; border:1px solid #cbcbcb; padding:5px;' name='subagency'  autocomplete='new-password' type='text' value='' /></td></tr>";	
	
	$form_update_content .= "<tr><td><strong>Requestor Name</strong></td><td class='td-left'><input style='width:404px; border:1px solid #cbcbcb; padding:5px;' name='opp_requestor' autocomplete='new-password' type='text' value='' /></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Facility Clearance</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'>
		<select name='clearance_level' size='1' class='select-styled' style='border-left:5px solid #3c4db0;' required>
				  <option value=''></option>
				  <option value='Not Applicable'>Not Applicable</option>
				  <option value='Secret'>Secret</option>
				  <option value='Secret w/ Safeguarding'>Secret w/ Safeguarding</option>
				  <option value='Top Secret'>Top Secret</option>
				  <option value='Top Secret w/ Safeguarding'>Top Secret w/ Safeguarding</option>
		</select>
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Certifications</strong></td><td class='td-left'><input style='width:404px; border:1px solid #cbcbcb; padding:5px;' name='certifications' autocomplete='new-password' type='text' value='' /></td></tr>";

//	$form_update_content .= "<tr><td><strong>Opportunity Link</strong></td><td class='td-left'><input style='width:404px; border:1px solid #cbcbcb; padding:5px;' name='opportunity_link' id='opportunity_link' autocomplete='off' type='text' value='' /></td></tr>";

//	$form_update_content .= "<tr><td><strong>SharePoint Link</strong></td><td class='td-left'><input style='width:404px; border:1px solid #cbcbcb; padding:5px;' name='sharepoint_link' id='sharepoint_link' autocomplete='off' type='text' value='' /></td></tr>";
	
	$form_update_content .= "<tr><td><strong>Solicitation Docs</strong></td><td class='td-left'><input style='width:404px; border:1px solid #cbcbcb; padding:5px;' name='solicitation_docs' id='solicitation_docs' autocomplete='off' type='text' value='' /></td></tr>";
	
	$form_update_content .= "<tr>
        <td><strong>Description</strong></td>
        <td>

			<div style='width:86%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='opp_synopsis' name='opp_synopsis'></textarea>
			</div>	
        </td>
      </tr>";
	
	$form_update_content .= "<tr><td><strong>Performance Location</strong></td><td class='td-left'>
	<select name='facility' size='1' class='select-styled'>
				  <option value=''></option>
				  <option value='Federal Facility'>Federal Facility</option>
				  <option value='Contractor Facility'>Contractor Facility</option>
				</select></td></tr>";
	 
	 			$form_update_content .= "<tr><td><strong>Address</strong></td><td class='td-left'><input style='width:400px; border:1px solid #cbcbcb; padding:5px;' name='contract_pop' id='contract_pop' autocomplete='new-password' type='text' value='' />
	 <div style='font-weight:700; width:50px; display:inline-block; vertical-align:top; margin-left:10px;'>City</div><input style='width:200px; border:1px solid #cbcbcb; padding:5px;' name='contract_city' id='contract_city' autocomplete='new-password' type='text' value='' />
	 <div style='font-weight:700; width:50px; display:inline-block; vertical-align:top; margin-left:10px;'>State</div>$state_dropdown"; /*</td></tr>*/
	 
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
 	
	
	<!-- <fieldset style='width:46px; display:inline-block; border:1px solid #eaeaea; vertical-align: top;'>
  		<legend  style='font-size: 13px; font-weight: 700;'>Quantity</legend>
		<input name='periodqty' id='periodqty' autocomplete='new-password' maxlength='6' onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' value='' style='width:60px; border:1px solid #cbcbcb; padding:5px;'/>
	</fieldset> -->
 
 	
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
	  
	  $form_update_content .= "
	  <div style='display:inline-block;padding:5px 10px;vertical-align:top;'><div style='font-weight:700;'>Evaluation</div>
		  <select name='pricing_eval' class='select-styled'>
	  <option value=''></option>
	  <option value='LPTA'>LPTA</option>
	  <option value='Best Value'>Best Value</option>
		  </select>
	  </div>
	  
	
	<input border:1px solid #cbcbcb; padding:5px;' id='opp_pricing' name='opp_pricing' type='hidden' value='' /></td></tr>";
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
	
	$form_update_content .= "<tr><td><strong>Submission Requirements</strong></td><td class='td-left'>
			<div style='width:86%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='opp_proposal' name='opp_proposal'></textarea>
			</div>
	
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Gaps (Research Team)</strong></td><td class='td-left'>
			<div style='width:86%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='gaps_datateam' name='gaps_datateam'></textarea>
			</div>
	</td></tr>";
	
	$form_update_content .= "<tr><td><strong>Notes (Research Team)</strong></td><td class='td-left'>
			<div style='width:86%; height: 400px; background: #fff; vertical-align: top;'>
				<textarea id='notes_datateam' name='notes_datateam'></textarea>
			</div>
	</td></tr>";
	
	$extra_buttons_top = "
	<div style='display:inline-block; width:48%; text-align:center;'><input style='padding:4px 16px;  width:100px; font-weight: 700; cursor: pointer;' type='submit' value='Save'></div>
	<div style='display:inline-block; width:48%; text-align:center;'><input style='margin-left: 50px; padding:4px 16px; width:100px; font-weight: 700; cursor: pointer;' type='submit' value='Next'></div>";
	
	print ($form_table . $extra_buttons_top . $form_update_content . "</table>");
?>

<input type="hidden" name="opp_opportunity_id" value="<?php print $opp_opportunity_id; ?>"/>

<!--<input type="hidden" name="<= ASCsrf::getTokenName() ?>" value="<= ASCsrf::getToken() ?>">-->
<div>
<div style="display:inline-block; width:48%; text-align:center;"><input style="margin-top: 18px; padding:4px 16px;  width:100px; font-weight: 700; cursor: pointer;" type="submit" value="Save"></div>
<div style="display:inline-block; width:48%; text-align:center;"><input style="margin-left: 50px; padding:4px 16px; width:100px; font-weight: 700; cursor: pointer;" type="submit" value="Next"></div>

</div>
</form>
</html>
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

<!-- Initialize Summernote -->

<script>
function pricing_update() {
	//var pricingmod = document.getElementById('opp_pricing').value;
	//pricingmod = "";
	//if document.getElementById('pricing1')
	var pricing_text = "";
	document.getElementById('opp_pricing').value = "";
	//var p1=document.getElementById('pricing1').checked; 
	if (document.getElementById('pricing1').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing1').value + '<BR>'; }
	/*if (document.getElementById('pricing2').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing2').value + '<BR>'; }
	if (document.getElementById('pricing3').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing3').value + '<BR>'; }
	if (document.getElementById('pricing4').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing4').value + '<BR>'; }*/
	if (document.getElementById('pricing5').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing5').value + '<BR>'; }
	/*if (document.getElementById('pricing6').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing6').value + '<BR>'; }
	if (document.getElementById('pricing7').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing7').value + '<BR>'; }
	if (document.getElementById('pricing8').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing8').value + '<BR>'; }
	if (document.getElementById('pricing9').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing9').value + '<BR>'; }
	if (document.getElementById('pricing10').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing10').value + '<BR>'; }*/
	if (document.getElementById('pricing11').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing11').value + '<BR>'; }
	if (document.getElementById('pricing12').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing12').value + '<BR>'; }
	if (document.getElementById('pricing13').checked==true) { document.getElementById('opp_pricing').value += document.getElementById('pricing13').value + '<BR>'; }
	//if (p1.checked){ pricing_text += document.getElementById('pricing1').value; }
	//document.getElementById('opp_pricing').innerhtml = pricing_text;
	//var p2=document.getElementById('pricing2'); if (p2.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing2').value; }
	/*var p3=document.getElementById('pricing3'); if (p3.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing3').value; }
	var p4=document.getElementById('pricing4'); if (p4.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing4').value; }
	var p5=document.getElementById('pricing5'); if (p5.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing5').value; }
	var p6=document.getElementById('pricing6'); if (p6.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing6').value; }
	var p7=document.getElementById('pricing7'); if (p7.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing7').value; }
	var p8=document.getElementById('pricing8'); if (p8.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing8').value; }
	var p9=document.getElementById('pricing9'); if (p9.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing9').value; }
	var p10=document.getElementById('pricing10'); if (p10.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing10').value; }
	var p11=document.getElementById('pricing11'); if (p11.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing11').value; }
	var p12=document.getElementById('pricing12'); if (p12.checked){ document.getElementById('opp_pricing').value += document.getElementById('pricing12').value; }*/
	//document.getElementById('opp_pricing').value = document.getElementById('pricing1').value;
	//alert('Nice ' + p1);	
	//if (p1==true) { alert("OK" + document.getElementById('pricing1').value); }
	//alert(document.getElementById('opp_pricing').value);
	
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
<!-- add contact veh code start by rajini -->
<script>   
function contractveh_add(){
	var contract_veh		   = document.getElementById("contract_vehicle").value;
	var contract_veh_id		   = document.getElementById("opp_vehicle_one").value;
	var contract_veh_set_aside = document.getElementById("set_aside").value;
	if(contract_veh == "") {
		alert("Select Contract Vehicle.");
		return false;
	}
	if(contract_veh_id == "") {
		alert("Enter Opp. ID.");
		return false;
	}
	if(contract_veh_set_aside == "") {
		alert("Select Set-Aside.");
		return false;
	}

	const divadd = document.createElement("div");
	const node = document.createTextNode(""); 
	divadd.style.color = "#a269c6"; border:"1px solid #8c4fb5";
	divadd.style.border = "1px solid #d4d4d4";
	divadd.style.width = "90%";

	//divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='addr_a_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("contract_vehicle").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:260px; border:none;' ></DIV>";
	
	if(contract_veh != "Other"){
		divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='addr_a_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("contract_vehicle").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:190px; border:none;' ></DIV>";
	}else{
		divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='addr_a_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("other_vehicle_name").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:190px; border:none;' ></DIV>";
	}

	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='addr_b_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("opp_vehicle_one").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:260px; border:none;' ></DIV>";

	divadd.innerHTML += "<div style='display:inline-block; padding:5px 10px;'><input type='text' name='address_c_" + Math.floor(Math.random() * 2048) + "' value='" + document.getElementById("set_aside").value + "' readonly='readonly' style='padding:2px 5px; font-weight:700; color:#3c4db0; width:155px; border:none;' ></DIV>";


	divadd.innerHTML += "<span style='background-color:#a04071; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block; margin-left: 14px; float:right; margin-right:20px; margin-top:3px; cursor: pointer;' onclick='this.parentElement.remove();refresh_contractvehaddr();'> Remove </span>";
	//divadd.setAttribute("id","newarea");
	divadd.appendChild(node);
	const element = document.getElementById("contractveh_address");
	
	element.appendChild(divadd);
	
	//PASS TO INPUT
	var combinedtext = "";
	  var inputs, index;

		inputs = document.getElementsByTagName('input');
		for (index = 0; index < inputs.length; index++) {
			
			if(inputs[index].name.indexOf('addr_a') == 0) {
					combinedtext = combinedtext + inputs[index].value + "|||";
			}else if(inputs[index].name.indexOf('addr_b') == 0) {
					combinedtext = combinedtext + inputs[index].value;
			}else if(inputs[index].name.indexOf('address_') == 0) {
					combinedtext = combinedtext + "+" + inputs[index].value + "|||";
			}
		}
	
	//alert(inputs.length);
	//document.getElementById('car').value="1234567890abc";	
	document.getElementById('contractveh_table').value=combinedtext;
	
	//CLEAR INPUT ZONE
	document.getElementById('contract_vehicle').value="";
	document.getElementById('other_vehicle_name').value="";
	document.getElementById('opp_vehicle_one').value="";
	document.getElementById('set_aside').value="";
	document.getElementById('other_vehicle_name').style.display = "none";
	document.getElementById('other_vehicle_name').removeAttribute("required");
}
function refresh_contractvehaddr() {
//PASS TO INPUT
	var combinedtext = "";
	  var inputs, index;

		inputs = document.getElementsByTagName('input');
		for (index = 0; index < inputs.length; ++index) {
			
			
			if(inputs[index].name.indexOf('addr_') == 0) {
						//alert("# of inputs " + inputs.length + " OK " + inputs[index].name + " VAL " + inputs[index].value);
					combinedtext += inputs[index].value + "|||";
				}
		}
	
	document.getElementById('contractveh_table').value=combinedtext;	
}
</script>
<!-- code end contact veh -->
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
  //opp_response
  //opp_released
  //contract_vehicle
  //opp_vehicle_one
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
         
      
</script>
<script>
	function hello4() {
	alert("OK4");
	}
</script>
<script>
    $(document).ready(function() {
      $('#opp_response').change(function() {
        var opp_type = $('#opp_response').val();
			if(opp_type == 'Draft RFP' || opp_type == 'Forecast'){
				$('#proposal_date').prop('required',false);
				$('#proposal_time').prop('required',false);
			}else{
				$('#proposal_date').prop('required',true);
				$('#proposal_time').prop('required',true);
			}
      });

	  $('#opp_response').change(function() {
        var opp_type1 = $('#opp_response').val();
			if(opp_type1 != 'Forecast'){
				$('#opp_released').prop('required',true);
			}else{
				$('#opp_released').prop('required',false);
			}
      });
    });

    // Put Summernote into edit mode
    function saveContent() {
      $('#content').html($('#summernote').summernote('code'));
      $('#summernote').summernote('destroy');
      $('#summernote').hide();
      $('#content').show();
    }

	function save1() {
		alert("SAVE 001");
		var save1 = document.getElementById('save1');
		save1.style.display="none";
		var edit1 = document.getElementById('edit1');
		edit1.style.display="inline-block";
		
	  var markup = $('.click2edit').summernote('code');
	  $('.click2edit').summernote('destroy');
	};

		$(document).ready(function() {
		$('#naics_code').change(function() {
			var code = $('#naics_code').val();
				$.ajax({
						url		: 'ajax_get_size_standards.php',
						method	: 'POST',
						data: {
							codeValue: code,
						},
						success: function(data) {
								const myArray = data.split("&");
								$('#size_standard').val(myArray[1]);
								$('#naics_code').prop('title', myArray[0]);
						},
						error: function(jqXHR, textStatus, errorThrown) {
							console.log(textStatus, errorThrown);
						}
				});
		});
	});

	$(document).ready(function() {
		$("#contract_vehicle").change(function () {
			var vehicleValue = $("#contract_vehicle").val();
			if(vehicleValue == 'Other') {
				$("#other_vehicle_name").prop('required', true);
				$("#other_vehicle_name").show();
			}else{
				$("#other_vehicle_name").removeAttr("required");
				$("#other_vehicle_name").hide();
			}
		});
	});
  </script>