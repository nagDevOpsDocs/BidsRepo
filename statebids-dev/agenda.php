<?php
session_start();
//error_reporting(E_ALL); ini_set('display_errors', '1'); 
include("./includes/connect_portal123.php");
//if($_SESSION['access_level']!='102' && $_SESSION['access_level']!='103'){ header("Location: $login");  }
if(!$_SESSION['loggedIn'] || $_SESSION['loggedIn'] == '') { header("Location: $login");  exit();}
$srch_val = http_build_query($_GET,'','&');
$this_page_name="Agenda"; ?>
<!DOCTYPE html>
<html 'en-US'>
<head>
<title><?php print $this_page_name; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="styles/modal.css">
<link rel="stylesheet" href="styles/1.css">
<link rel="stylesheet" href="styles/rcs.css">
<link rel="stylesheet" href="styles/pagination.css">
<link rel="stylesheet" href="fonts/fonts.css">
<link rel="stylesheet" href="styles/search.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style type="text/css">
<?php /*include("includes/inline-styles.php"); */ ?>
/*.bid_edit { display:none; }*/
/*.bid_show { display:block; }
.light_grey_fade2 {
    background: #ffffff;
    background: -moz-linear-gradient(top, #ffffff 0%, #f1f1f1 50%, #e1e1e1 51%, #f6f6f6 100%);
    background: -webkit-linear-gradient(top, #ffffff 0%,#f1f1f1 50%,#e1e1e1 51%,#f6f6f6 100%);
    background: linear-gradient(to bottom, #ffffff 0%,#f1f1f1 50%,#e1e1e1 51%,#f6f6f6 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0);
}*/
.active_bar, .opp_container:hover { background-color: #3b51b1; color: #fff; font-weight: 700; font-size: 12px; }
.active_bar { background-color: #3b51b1 !important; color: #fff !important; font-weight: 700; font-size: 12px; }
.opp_container { font-size: 12px; border-bottom: 1px solid #efeff1; 
    border-left: 1px solid #c4c5c8;
    border-right: 2px solid #848484; cursor: pointer;}
/*.bidbuttonhighlight { background: linear-gradient(#3093e7, #173a85); }
.bidbuttonhighlight2 { background: linear-gradient(#FFF, #f0f0f0); }
.bidbuttonhighlight:hover { background: linear-gradient(#3198ef, #1d56d0); }*/

/*---------------------------- Added for sorting purpose Starts Here. ------------------------------------*/

.arrows {
    display: inline-flex;
    flex-direction: column;
    margin-left: 4px;
    line-height: 10px;
    font-size: 11px;
}
.arrows span {
    color: rgba(255,255,255,0.4); /* inactive */
}

.sortable {
    cursor: pointer;
    position: relative;
}
.sortable.asc .up {
    color: #fff;
}
.sortable.desc .down {
    color: #fff;
}

.sortable1 {
    cursor: pointer;
    position: relative;
}
.sortable1.asc .up {
    color: #fff;
}
.sortable1.desc .down {
    color: #fff;
}

.sortable2 {
    cursor: pointer;
	position: relative;
}
.sortable2.asc .up {
    color: #fff;
}

.sortable2.desc .down {
    color: #fff;
}

.sortable3 {
    cursor: pointer;
	position: relative;
}
.sortable3.asc .up {
    color: #fff;
}

.sortable3.desc .down {
    color: #fff;
}

.sortable4 {
    cursor: pointer;
	position: relative;
}
.sortable4.asc .up {
    color: #fff;
}

.sortable4.desc .down {
    color: #fff;
}

.sortable5 {
    cursor: pointer;
	position: relative;
}
.sortable5.asc .up {
    color: #fff;
}

.sortable5.desc .down {
    color: #fff;
}

.sortable6 {
    cursor: pointer;
	position: relative;
}
.sortable6.asc .up {
    color: #fff;
}

.sortable6.desc .down {
    color: #fff;
}

.div-table {
    display: flex;
    border-bottom: 1px solid #ddd;
    padding: 8px;
}
.div-table.header {
    background: #293466;
    color: white;
    font-weight: bold;
}

.div-table.row {
    background: #fff;
	color:#000;
}
.div-table.row:hover { background-color: #3b51b1; color: #fff; cursor: pointer; font-size: 12px; }


.div-table1 {
    display: flex;
    border-bottom: 1px solid #ddd;
    padding: 8px;
}
.div-table1.header {
    background: #293466;
    color: white;
    font-weight: bold;
}
.div-table1.row {
    background: #fff;
	color:#000;
}
.div-table1.row:hover { background-color: #3b51b1; color: #fff; cursor: pointer; font-size: 12px; }

.div-table2 {
    display: flex;
    border-bottom: 1px solid #ddd;
    padding: 8px;
}
.div-table2.header {
    background: #293466;
    color: white;
    font-weight: bold;
}
.div-table2.row {
    background: #fff;
	color:#000;
}
.div-table2.row:hover { background-color: #3b51b1; color: #fff; cursor: pointer; font-size: 12px; }

.div-table3 {
    display: flex;
    border-bottom: 1px solid #ddd;
    padding: 8px;
}
.div-table3.header {
    background: #293466;
    color: white;
    font-weight: bold;
}
.div-table3.row {
    background: #fff;
	color:#000;
}
.div-table3.row:hover { background-color: #3b51b1; color: #fff; cursor: pointer; font-size: 12px; }

.div-table4 {
    display: flex;
    border-bottom: 1px solid #ddd;
    padding: 8px;
}
.div-table4.header {
    background: #293466;
    color: white;
    font-weight: bold;
}
.div-table4.row {
    background: #fff;
	color:#000;
}
.div-table4.row:hover { background-color: #3b51b1; color: #fff; cursor: pointer; font-size: 12px; }

.div-table5 {
    display: flex;
    border-bottom: 1px solid #ddd;
    padding: 8px;
}
.div-table5.header {
    background: #293466;
    color: white;
    font-weight: bold;
}
.div-table5.row {
    background: #fff;
	color:#000;
}
.div-table5.row:hover { background-color: #3b51b1; color: #fff; cursor: pointer; font-size: 12px; }

.div-table6 {
    display: flex;
    border-bottom: 1px solid #ddd;
    padding: 8px;
}
.div-table6.header {
    background: #293466;
    color: white;
    font-weight: bold;
}
.div-table6.row {
    background: #fff;
	color:#000;
}
.div-table6.row:hover { background-color: #3b51b1; color: #fff; cursor: pointer; font-size: 12px; }

.col {
    flex: 1;
}
/*---------------------------- Added for sorting purpose Ends Here. --------------------------------------*/
/* Added for blinking Starts here. */
.blink {
  animation: blink-animation 1s linear 45;
  animation-fill-mode: forwards; 
}

@keyframes blink-animation {
  50% {
    opacity: 0;
  }
}
/* Added for blinking ends here. */

.hidden {
   display: none;
}
.hidden1 {
   display: block;
}
</style>
<link rel="stylesheet" href="<?php echo $baseurl; ?>/styles/style.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>
<?php
$getusrdet = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT firstname,lastname,user_role,myfav_bids,password_updated_date FROM users WHERE user_id='".$_SESSION['user_id']."'"));
$name = $getusrdet[0].' '.$getusrdet[1];

//search area filteration
$ascdesc = "";
//$order = isset($_GET['sort'])?$_GET['sort']:'released';
$order = isset($_GET['sort'])?$_GET['sort']:'proposal_due';

$ascdesc = isset($_GET['ascdesc'])?$_GET['ascdesc']:'ASC';
switch(strtoupper($ascdesc))
  {
  case 'DESC': 
	  $ascdesc = 'ASC';
	  $ascstyle = "<i class='fa fa-sort' aria-hidden='true'></i>";
  break;
  case 'ASC': 
	  $ascdesc = 'DESC'; 
	  $ascstyle = "<i class='fa fa-sort' aria-hidden='true'></i>";
  break;
  default: 
	  $ascdesc = 'DESC';
	  $ascstyle = "<i class='fa fa-sort' aria-hidden='true'></i>";
  break;
  }

//manager name pull for serach query
if($_GET['mngr']!='') {
	$mngrname .= " AND manager = '" .$name. "' ";
	$favtext .= "<div style='padding-left:400px; font-size:18px; color:#3c4db0'>Assigned List</div>";
}
else
{
	$mngrname .= '';
	$favtext .= '';
}
// ***************************** Printing Search Query Starts Here. ********************** //
$search_string = '';
if($_GET['search'] != ''){
	$search_string .= "<strong>Text : </strong>".$_GET['search'];
}else{//elseif($_GET['search'] == 'IS'){
//	$search_string .= "<strong>Incumbent Text : </strong>".$_GET['search'];;
//}
	$search_string .= "";
}
if($_GET['vehicle'] != '') {
	$vehicle_string = "<strong>&nbsp;&nbsp;Vehicle(s) : </strong>";
	for($i=0;$i<(count($_GET['vehicle']));$i++){
		if($i == count($_GET['vehicle'])-1){
			$vehicle_string .= $_GET['vehicle'][$i];
		}else{
			$vehicle_string .= $_GET['vehicle'][$i]." , ";
		}
	}
}else{
	$vehicle_string .= '';
}

if(($_GET['criteriatype'] != '') && ($_GET['criteriatype'] != 'Others')) {
	$type_string = "<strong>&nbsp;&nbsp;Bid Category : </strong>";
//	for($i=0;$i<(count($_GET['type']));$i++) {
//		if($i == count($_GET['type'])-1) {
			$type_string .= $_GET['criteriatype'];
//			$type_string .= $_GET['criteriatype'][$i];
//		}else {
//			$type_string .= $_GET['criteriatype']." , ";
//			$type_string .= $_GET['type'][$i]." , ";
//		}
//	}
}elseif(($_GET['criteriatype'] != '') && ($_GET['criteriatype'] == 'Others')){
	$type_string = "<strong>&nbsp;&nbsp;Bid Category : </strong>";
	$type_string .= $_GET['criteriatype'];
//			$type_string .= '';
}else{
	$type_string .= '';
}

if($_GET['decision'] != '') {
	$decision_string = "<strong>&nbsp;&nbsp;Decision(s) : </strong>";
	for($i=0;$i<count($_GET['decision']);$i++){
		if($i == count($_GET['decision'])-1){
			$decision_string .= $_GET['decision'][$i];
		}else{
			$decision_string .= $_GET['decision'][$i]." , ";
		}
	}
}else{
	$decision_string .= '';
}

if($_GET['bidcategory'] != '') {
	$bidcategory_string = "<strong>&nbsp;&nbsp;Bid Category(s) : </strong>";
	for($i=0;$i<count($_GET['bidcategory']);$i++){
		if($i == count($_GET['bidcategory'])-1){
			$bidcategory_string .= $_GET['bidcategory'][$i];
		}else{
			$bidcategory_string .= $_GET['bidcategory'][$i]." , ";
		}
	}
}else{
	$bidcategory_string .= '';
}

if($_GET['bidtype'] != '') {
	$bidtype_string = "<strong>&nbsp;&nbsp;Bid Type(s) : </strong>";
	for($i=0;$i<count($_GET['bidtype']);$i++){
		if($i == count($_GET['bidtype'])-1){
			$bidtype_string .= $_GET['bidtype'][$i];
		}else{
			$bidtype_string .= $_GET['bidtype'][$i]." , ";
		}
	}
}else{
	$bidtype_string .= '';
}
/*
if($_GET['submitted'] == 'Submitted') {
	$phase_string = "<strong>&nbsp;&nbsp;Phase : </strong>" . $_GET['submitted'];	
}
if($_GET['archived'] == 'Archived'){
	$phase_string = "<strong>&nbsp;&nbsp;Phase : </strong>" . $_GET['archived'];
}
if(($_GET['archived'] == 'Archived') && ($_GET['submitted'] == 'Submitted')){
	$phase_string = "<strong>&nbsp;&nbsp;Phase : </strong>" . $_GET['submitted']." & ".$_GET['archived'];
} */

if($_GET['bnpphase'] != '') {
	$phase_string = "<strong>&nbsp;&nbsp;Phase : </strong>";
	$phase_string .= $_GET['bnpphase'];
}else{
	$phase_string .= '';
} 

if($_GET['addedBy'] != '') {
	$addedBy_string = "<strong>&nbsp;&nbsp;Added By : </strong>";
	$addedBy_string .= $_GET['addedBy'];
}else{
	$addedBy_string .= '';
} 

if($_GET['assignedTo1'] != '') {
	$assignedTo_string = "<strong>&nbsp;&nbsp;Assigned To : </strong>";
	$assignedTo_string .= $_GET['assignedTo1'];
}else{
	$assignedTo_string .= '';
}
// Filter Label for states starts here.
if($_GET['state'] != '') {
	$state_string = "<strong>&nbsp;&nbsp;State : </strong>";
	$state_string .= $_GET['state'];
}else{
	$state_string .= '';
}
// Filter Label for states ends here.
if($_GET['groupBy'] != '') {
	$groupBy_string = "<strong>&nbsp;&nbsp;Group By : </strong>";
	$groupBy_string .= $_GET['groupBy'];
}else{
	$groupBy_string .= '';
}

$date_search_string = '';
if($_GET['st_datesearch'] != ''){

	if($_GET['sdate'] != '') {
		$sdate = date('Y-m-d',strtotime($_GET['sdate']));
	}
	else
	{
		$sdate = '2014-01-01';
	}

	if($_GET['edate'] != '') {
		$edate = date('Y-m-d',strtotime($_GET['edate']));
	}
	else
	{
		$edate = date('Y-m-d');
	}

	if($_GET['st_datesearch'] == 'DD'){
	
		if($edate == date('Y-m-d')) {
			$edate = '2030-12-31';
		}

		$date_search_string = "&nbsp;&nbsp;<strong>Due Date : </strong>".date('m/d/Y',strtotime($sdate))." <strong> To </strong> ".date('m/d/Y',strtotime($edate));
	}
	if($_GET['st_datesearch'] == 'BD'){
		$date_search_string = "&nbsp;&nbsp;<strong>Bid Added Date : </strong>".date('m/d/Y',strtotime($sdate))." <strong> To  </strong> ".date('m/d/Y',strtotime($edate));
	}
	if($_GET['st_datesearch'] == 'LD'){
		$date_search_string = "&nbsp;&nbsp;<strong>Last Updated Date : </strong>".date('m/d/Y',strtotime($sdate))." <strong> To  </strong> ".date('m/d/Y',strtotime($edate));
	}
	if($_GET['st_datesearch'] == 'AD'){
		$date_search_string = "&nbsp;&nbsp;<strong>Awarded Date : </strong>".date('m/d/Y',strtotime($sdate))." <strong> To  </strong> ".date('m/d/Y',strtotime($edate));
	}
	if($_GET['st_datesearch'] == 'QD'){
		$date_search_string = "&nbsp;&nbsp;<strong>Question Date : </strong>".date('m/d/Y',strtotime($sdate))." <strong> To  </strong> ".date('m/d/Y',strtotime($edate));
	}
	if($_GET['st_datesearch'] == 'RD'){
		$date_search_string = "&nbsp;&nbsp;<strong>Release Date : </strong>".date('m/d/Y',strtotime($sdate))." <strong> To  </strong> ".date('m/d/Y',strtotime($edate));
	}
}
// ************************** Printing Search Query Ends Here. ************************* //
if($_GET['st_datesearch'] != '') {
// Search by proposal due date.
	if($_GET['st_datesearch'] == 'DD'){
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{   
			$proposal_due_date = " AND (DATE(proposal_due) BETWEEN '".$sdate."' AND '".$edate."')";
		}
		else
		{
			$proposal_due_date = '';
		} 
	}
// Search by Bid Added Date.
	if($_GET['st_datesearch'] == 'BD'){
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{   
			$bid_added_date = " AND (DATE(creation_timestamp) BETWEEN '".$sdate."' AND '".$edate."')";
		}
		else
		{
			$bid_added_date = '';
		} 
	}
// Search by Last Updated Date.
	if($_GET['st_datesearch'] == 'LD'){
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{   
			$last_updated_date = " AND ((last_update) BETWEEN '".$sdate."' AND '".$edate."')";
		}
		else
		{
			$last_updated_date = '';
		} 
	}
//Search by Award Date.
	if($_GET['st_datesearch'] == 'AD')
	{
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{    
			$releaseddate = " AND ((award_date) BETWEEN '".$sdate."' AND '".$edate."')";
		}
		else
		{
			$releaseddate = '';
		} 
	}     
//Search by QA Date.
	if($_GET['st_datesearch'] == 'QD')
	{
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{    
			$qa_date = " AND (DATE(qa_due) BETWEEN '".$sdate."' AND '".$edate."')";
		}
		else
		{
			$qa_date = '';
		} 
	}  
//Search by Release Date.
	if($_GET['st_datesearch'] == 'RD')
	{
		$_GET['_mode'] = 'Opportunities';
		if($sdate != '' || $edate != '') 	
		{    
			$release_date = " AND (DATE(released) BETWEEN '".$sdate."' AND '".$edate."')";
		}
		else
		{
			$release_date = '';
		} 
	} 	
}
/*
if($_GET['sdate']!='') {
$sdate = date('Y-m-d',strtotime($_GET['sdate']));
}
else
{
$sdate = '2020-01-01';
}

if($_GET['edate']!='') {
$edate = date('Y-m-d H:i:s',strtotime($_GET['edate']));
}
else
{
$edate = date('Y-m-d H:i:s');
}


if($_GET['sdate']!='' || $_GET['edate']!='') 	
	{
		$_GET['_mode'] = 'Opportunities';
		$releaseddate = " AND (DATE(creation_timestamp) BETWEEN '".$sdate."' AND '".$edate."')";
	}
	else
	{
		$releaseddate = '';
	}
*/
$fav_str = array();
if($_GET['favlist'] != '') {
	if($getusrdet['myfav_bids'] != '') {
		$fav_bids_arr = json_decode($getusrdet['myfav_bids'], TRUE);
		$bids_array	  = array_keys($fav_bids_arr);
		if(count($bids_array) != 0) {
			$fav_str = "(";
			$fav_str .= implode(', ', $bids_array);
			$fav_str .= ")"; 
			$favlist .= " AND opportunity_id IN ".$fav_str;
			$favtext .= "<div style='padding-left:400px; font-size:18px; color:#3c4db0'>Favorite List</div>";
		}else{
			$favlist .= " AND opportunity_id IN (0)";
			$favtext .= "<div style='padding-left:400px; font-size:18px; color:#3c4db0'>Favorite List is Empty.</div>";
		}
	}
}

if($_GET['favshow'] == "yes") { $checked = "checked='checked'"; }
if($_POST['vehtype']!='') {
	$vehtype .= " AND subagency = '".$_POST['vehtype']."'";
}
else
{
	$vehtype .= '';
}

if($_POST['cpwl_vehtype']!='') {
	$cpwl_vehtype .= " AND subagency = '".$_POST['cpwl_vehtype']."'";
}
else
{
	$cpwl_vehtype .= '';
}

// Capturing POST variables of assigned & addedby and assigned to a variable Starts Here.
if($_POST['assigned']!='') {
	$assigned .= " AND vehicle_two = '".$_POST['assigned']."'";
}
else
{
	$assigned .= '';
}

if($_POST['added']!='') {
	$added .= " AND requestor = '".$_POST['added']."'";
}
else
{
	$added .= '';
}
// Capturing POST variables of assigned & addedby and assigned to a variable Ends Here.
if(($_GET['bidcategory']!='') && ($_GET['bidcategory']!='Others')) {
	$_GET['_mode'] = 'Opportunities';
	$crtype .= " AND (bid_category = '".$_GET['bidcategory']."')";
}elseif(($_GET['bidcategory']!='') && ($_GET['bidcategory']=='Others')) {   
	//$_GET['bidcategory'] = "";
	//$crtype .= " AND bid_category = ' ' ";
	//$crtype .= " AND (bid_category != 'COTS/Available Software' AND 
	//			bid_category != 'License/Hardware Procurement' AND bid_category != 'Website Development' AND 
	//			bid_category != 'Non-IT' AND bid_category != 'Sole Source' AND bid_category != 'LMS' AND 
	//			bid_category != 'Scanning/Digitization' AND bid_category != 'SWA') ";
	$_GET['_mode'] = 'Opportunities';
	$crtype .= " AND (bid_category = 'Others')";
}else{
	$crtype .= "";
}

if($_GET['bnpphase']!='') {
	$_GET['_mode'] = 'Opportunities';
	$sttype .= " AND status='".$_GET['bnpphase']."'";
	$is_bnp = 1;
	$bnp_phase = $_GET['bnpphase'];
}
else
{
	$sttype .= '';
	$is_bnp = 0;
	$bnp_phase = '';
}

if($_GET['addedBy']!='') {
	$_GET['_mode'] = 'Opportunities';
	$addedBy1 .= " AND requestor='".$_GET['addedBy']."'";
}
else
{
	$addedBy1 .= '';
}

if($_GET['assignedTo1']!='') {
	$_GET['_mode'] = 'Opportunities';
	$assigned1 .= " AND vehicle_two='".$_GET['assignedTo1']."'";
}
else
{
	$assigned1 .= '';
}

// Code to filter states starts here.
if($_GET['state']!='') {
	$_GET['_mode'] = 'Opportunities';
	$state1 .= " AND agency='".$_GET['state']."'";
}
else
{
	$state1 .= '';
}
// Code to filter states ends here.

if($_GET['groupBy']!='') {
	$_GET['_mode'] = 'Opportunities';
	$group .= " AND subagency='".$_GET['groupBy']."'";
}
else
{
	$group .= '';
}

if($_POST['vehtype']=='Staffing') { $staffing = "selected='selected'"; }
if($_POST['vehtype']=='Project') { $project = "selected='selected'"; }
if($_POST['vehtype']=='Others') { $others = "selected='selected'"; }

if($_POST['cpwl_vehtype']=='Staffing') { $cpwl_staffing = "selected='selected'"; }
if($_POST['cpwl_vehtype']=='Project') { $cpwl_project = "selected='selected'"; }

if($_POST['assigned']=='Prasad Devarakonda') { $pdSelected = "selected='selected'"; }
if($_POST['assigned']=='Rama Krishna') { $rkSelected = "selected='selected'"; }

// Code to Fetch the User Details for Added By Filter Starts Here.
$getusrdetails = mysqli_query($mysqli_link,"SELECT user_id,firstname FROM users WHERE access_level = 102 AND STATUS=1;
");
while($users_row = mysqli_fetch_array($getusrdetails, MYSQLI_NUM)){
	$usersSelect .= "<option value='".$users_row[0]."'". (($_POST['added'] == $users_row[0]) ? "selected='selected'" : "").">".$users_row[1]."</option>";	
}
$getusrdetails1 = mysqli_query($mysqli_link,"SELECT user_id,firstname FROM users WHERE access_level = 102 AND STATUS=1;
");
while($users_row = mysqli_fetch_array($getusrdetails1, MYSQLI_NUM)){
	$usersSelect1 .= "<option value='".$users_row[0]."'". (($_GET['addedBy'] == $users_row[0]) ? "selected='selected'" : "").">".$users_row[1]."</option>";	
}
if($_GET['assignedTo1'] =='Prasad Devarakonda') { $pdSelected1 = "selected='selected'"; }
if($_GET['assignedTo1'] =='Rama Krishna') { $rkSelected1 = "selected='selected'"; }

if($_GET['groupBy'] =='Project') { $projectSelected = "selected='selected'"; }
if($_GET['groupBy'] =='Staffing') { $staffingSelected = "selected='selected'"; }
if($_GET['groupBy'] =='Others') { $othersSelected = "selected='selected'"; }
// Code to Fetch the User Details for Added By Filter Ends Here.

//Query to fetch states starts here.
$states_query = mysqli_query($mysqli_link,"SELECT state_abbrev FROM states");
while($states_row = mysqli_fetch_array($states_query, MYSQLI_NUM)){
	$state .= "<option value='".$states_row[0]."'". (($_GET['state'] == $states_row[0]) ? "selected='selected'" : "").">".$states_row[0]."</option>";	
}
//Query to fetch states ends here.

$search_this= ""; $urlsearch = "";
if(!empty($_GET['search'])) { 
	$_GET['_mode'] = 'Opportunities';
	$urlsearch = $_GET['search']; 
	$_SESSION["search"]=$urlsearch;
	$queryurlsearch = " AND (vehicle_one LIKE '%$urlsearch%' OR contract_vehicle LIKE '%$urlsearch%' OR title LIKE '%$urlsearch%' OR agency LIKE '%$urlsearch%' OR pop LIKE '%$urlsearch%' OR synopsis LIKE '%$urlsearch%' OR recruiting LIKE '%$urlsearch%') ";
}else {
	$urlsearch = ""; $queryurlsearch=""; $urlmode=" AND status_value>0 "; 
}

$vehicles_selected=0;
$for_each_vehicle = 0;
if(isset($_GET['vehicle'])) { $vehicles_selected=count($_GET['vehicle']); 
		$queryvehicle = ""; 
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['vehicle'] as $vehselected) 
			{
				$for_each_vehicle++;
				if ($for_each_vehicle==1) { $queryvehicle .= " AND (contract_vehicle LIKE '%" . $vehselected . "%'"; }
				if ($for_each_vehicle> 1) { $queryvehicle .= " OR contract_vehicle LIKE '%" . $vehselected . "%'"; }
			}
			$queryvehicle .= ")";
		} 
	else { $queryvehicle = ""; }

$decision_selected=0;
$for_each_decision = 0;
if(isset($_GET['decision'])) { $decision_selected=count($_GET['decision']); 
		$querydecision = ""; 
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['decision'] as $dec_selected) 
			{
				$for_each_decision++;
				if($for_each_decision==1) { $querydecision .= " AND (decision='$dec_selected'"; }
				if($for_each_decision > 1) { $querydecision .= " OR decision='$dec_selected'"; }
			}
			$querydecision .= ")"; 
		} 
	else { $querydecision = ""; }


$bidcategory_selected=0;
$for_each_bidcategory = 0;
if(isset($_GET['bidcategory'])) { $bidcategory_selected=count($_GET['bidcategory']); 
		$querybidcategory = ""; 
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['bidcategory'] as $bid_category_selected) 
			{
				$for_each_bidcategory++;
				if($for_each_bidcategory==1) { $querybidcategory .= " AND (bid_category='$bid_category_selected'"; }
				if($for_each_bidcategory > 1) { $querybidcategory .= " OR bid_category='$bid_category_selected'"; }
			}
			$querybidcategory .= ")"; 
		} 
	else { $querybidcategory = ""; }

	$bidcategoryArray = array();
		foreach($_GET['bidcategory'] as $selected_bidcategory) {
				switch($selected_bidcategory){
					case 'Sole Source':
							array_push($bidcategoryArray,'Sole Source');
							break;
					case 'COTS/Available Software':
							array_push($bidcategoryArray,'COTS/Available Software');
							break;
					case 'License/Hardware Procurement':
							array_push($bidcategoryArray,'License/Hardware Procurement');
							break;
					case 'Website Development':
							array_push($bidcategoryArray,'Website Development');
							break;
					case 'SoftWare/App Development':
							array_push($bidcategoryArray,'SoftWare/App Development');
							break;
					case 'Non-IT':
							array_push($bidcategoryArray,'Non-IT');
							break;
					case 'LMS':
							array_push($bidcategoryArray,'LMS');
							break;
					case 'Scanning/Digitization':
							array_push($bidcategoryArray,'Scanning/Digitization');
							break;
					case 'Artificial Intelligence':
							array_push($bidcategoryArray,'Artificial Intelligence');
							break;
					case 'Others':
							array_push($bidcategoryArray,'Others');
							break;
					default:
						    break;
				}
		}

$bidtype_selected=0;
$for_each_bidtype = 0;
if(isset($_GET['bidtype'])) { $bidtype_selected=count($_GET['bidtype']); 
		$querybidtype = ""; 
		$_GET['_mode'] = 'Opportunities';
		foreach($_GET['bidtype'] as $bid_type_selected) 
			{
				$for_each_bidtype++;
				if($for_each_bidtype==1) { $querybidtype .= " AND (response='$bid_type_selected'"; }
				if($for_each_bidtype > 1) { $querybidtype .= " OR response='$bid_type_selected'"; }
			}
			$querybidtype .= ")"; 
		} 
	else { $querybidtype = ""; }


$queryurlmode="";
if(!empty($_GET['_mode']))  { $urlmode = $_GET['_mode']; } else { $queryurlmode=" AND status_value>0 "; }
	if($urlmode=='Opportunities') { $queryurlmode=" AND status_value>-1 "; }
	if($urlmode=='Agenda') { $queryurlmode=" AND status_value>0 "; }
// Re Arranging the Header fields for the Agenda Portion Starts Here. 
$header_all = "<div class='div-table header'>
					<div class='sortable' data-col='sno' style='display:inline-block; width:40px;								vertical-align:top;'>#<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
					</div>
					<div class='sortable' data-col='release' style='display:inline-block; width:114px;								vertical-align:top;'>Release <span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
					</div>
					<div class='sortable' data-col='submission' style='display:inline-block; width:108px;								vertical-align:top;'>Submission <span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
					</div>
					<div class='sortable' data-col='type' style='display:inline-block; width:120px;								vertical-align:top;'>Type <span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
					</div>
					<div class='sortable' data-col='bidno' style='display:inline-block; width:119px;								vertical-align:top;'>Bid # <span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
					</div>
					<div class='sortable' data-col='state' style='display:inline-block; width:120px;								vertical-align:top;'>State/Agency <span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
					</div>
					<div class='sortable' data-col='title' style='display:inline-block; width: calc(100% -									933px);vertical-align:top;'>Title 
										<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
					</div>
					<div class='sortable' data-col='assignedto' style='display:inline-block; width:160px;'>Assigned to 
										<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
					</div>
					<div class='sortable' data-col='addedby' style='display:inline-block; width:120px;									vertical-align:top;'>Added By 
										<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
					</div>
					<div class='sortable' data-col='priority' style='display:inline-block; width:120px;									vertical-align:top;'>Priority 
										<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
					</div>
				</div>";
// Re Arranging the Header fields for the Agends Portion Starts Here. 
$urlcontainer = "";
if ($urlmode=='Opportunities') { $urlcontainer = "<div class='title_bar'>$header_all</div>"; }
//MANAGERS PULL
$manager_list = "";
$manager_query = "SELECT manager_name FROM managers WHERE manager_show=1 ORDER BY manager_name";
$manager_result = mysqli_query($mysqli_link, $manager_query);
while($row = mysqli_fetch_array($manager_result, MYSQLI_NUM))
    {
	$db_manager_name = $row[0];
	$manager_list .= "<option value='$db_manager_name'>$db_manager_name</option>";
	}
//VEHICLE PULL
/*
$vehicle_list = "";
$vehicle_checkboxes = "";
$vehicle_query = "SELECT vehicle_id, vehicle_name FROM state_contract_vehicles WHERE vehicle_show=1 ORDER BY vehicle_name";
$vehicle_result = mysqli_query($mysqli_link, $vehicle_query);
while($row = mysqli_fetch_array($vehicle_result, MYSQLI_NUM))
    {
	$db_vehicle_name = $row[1];
	//$vehicle_list .= "<option value='$db_vehicle_name'>$db_vehicle_name</option>";
		if (isset($_GET['vehicle']))  
		{
			if(in_array($db_vehicle_name, $_GET['vehicle']))
			{
				$vehicle_checkboxes .= "<input type='checkbox' class='vehicles' id='vehicle[]' name='vehicle[]' value='$db_vehicle_name' checked>
							  <label for='vehicle[]'> $db_vehicle_name</label><br>";
			}
			else
			{
				$vehicle_checkboxes .= "<input type='checkbox' class='vehicles' id='vehicle[]' name='vehicle[]' value='$db_vehicle_name'>
							  <label for='vehicle[]'> $db_vehicle_name</label><br>";
			}
		}
		else
		{
			$vehicle_checkboxes .= "<input type='checkbox' class='vehicles' id='vehicle[]' name='vehicle[]' value='$db_vehicle_name'>
							  <label for='vehicle[]'> $db_vehicle_name</label><br>";
		}
	} */
//Decision List
$decision_checkboxes = "";
$decision_query = mysqli_query($mysqli_link,"SELECT decision_id,decision_name FROM state_decision WHERE decision_show=1 ORDER BY decision_name");

foreach($decision_query as $dec_item)
    {
	$db_decision_name = $dec_item['decision_name'];
	$db_decision_id = $dec_item['decision_id'];				  
		if (isset($_GET['decision']))  
		{
			if(in_array($db_decision_name, $_GET['decision']))
			{
			//echo "Option1 was checked!";
				$decision_checkboxes .= "<input class='criteria' type='checkbox' id='decision_{$db_decision_id}' name='decision[]' value='$db_decision_name' checked><label for='decision[]'> $db_decision_name</label><br>";
			}
			else
			{
				$decision_checkboxes .= "<input class='criteria' type='checkbox' name='decision[]' value='$db_decision_name'><label for='decision[]'> $db_decision_name</label><br>";
			}
		}
		else
		{
			$decision_checkboxes .= "<input class='criteria' type='checkbox' id='decision[]' name='decision[]' value='$db_decision_name'>
							  <label for='decision[]'> $db_decision_name</label><br>";
		}
	}
// End of Decision List
//BidType List Starts Here.
$bidtype_checkboxes = "";
$bidtype_query = mysqli_query($mysqli_link,"SELECT tbl_id, bid_name FROM state_bidtype WHERE bid_show=1 ORDER BY bid_name");

foreach($bidtype_query as $bidtype)
    {
	$db_bidtype_name = $bidtype['bid_name'];
	$db_bidtype_id = $bidtype['tbl_id'];				  
		if (isset($_GET['bidtype']))  
		{
			if(in_array($db_bidtype_name, $_GET['bidtype']))
			{
			//echo "Option1 was checked!";
				$bidtype_checkboxes .= "<input class='bidtype' type='checkbox' id='bidtype_{$db_bidtype_id}' name='bidtype[]' value='$db_bidtype_name' checked><label for='bidtype[]'> $db_bidtype_name</label><br>";
			}
			else
			{
				$bidtype_checkboxes .= "<input class='bidtype' type='checkbox' name='bidtype[]' value='$db_bidtype_name'><label for='bidtype[]'> $db_bidtype_name</label><br>";
			}
		}
		else
		{
			$bidtype_checkboxes .= "<input class='bidtype' type='checkbox' id='bidtype[]' name='bidtype[]' value='$db_bidtype_name'>
							  <label for='bidtype[]'> $db_bidtype_name</label><br>";
		}
	
	}
// End of BidType List
?>
<body>
<?php 
if (isset($profile_first_name)) { $login_name=$profile_first_name; } else { $login_name="Login"; }
//include("includes/header.php"); 
				$lastPasswordDate = new DateTime(date($getusrdet[4]));
				$currentDate	  = new DateTime(date('Y-m-d'));
				$interval = $currentDate->diff($lastPasswordDate);
				if(($interval->days > 23) and ($interval->days <= 29)) {
					$pwd_exp_string = "Your password expires in ".(30-$interval->days)." day(s).";
				}else{
					$pwd_exp_string = "";
				}
?>

<div style="position:fixed; width:100%; z-index:2; height:100px; cursor:pointer" class="topnav" id="myTopnav"> 
	  <div style="display: inline;top:9px; left:15px; position:relative; font-size:15px; font-weight:700; color:#fff; float:left; font-family:'Segoe UI';"><a href="<?php echo $baseurl; ?>/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review">BidPortal</a></div>
</div>

<div style="z-index:3; width:73%; margin-left:25%; position:fixed; text-align:center; top:9px;">
  		<div style="display: inline; float: right; position:relative; font-size:15px; font-weight:700; color:#fff; font-family:'Segoe UI"> <span id="pwd_exp_string_id"><font color="#ffff00"><?php echo $pwd_exp_string;?>&nbsp;&nbsp;</font></span>
		<?php
		if($_SESSION['access_level']=='103') { ?>
		<a href="#" onclick="switchToTab1(); return false;" style="color:#fff; text-decoration: none;">Switch to Federal</a>&nbsp;|&nbsp;<?php } echo $name; ?></div>  
		<!--Go to Federal</a>&nbsp;|&nbsp;-->	
</div>

<form id='bidportal' action='' method='get' style='margin:0px; padding:0px;'>
<div style="height:42px;"></div>
<div id='menu_group' style="width: 98%;
    margin-left: 1%;
    z-index: 2;
    padding: 1px 8px;
    background-color: rgba(0,0,0,0.1);
    position: fixed;
    -webkit-box-shadow: inset 0px 0px 17px -1px rgba(0,0,0,.7);
    -moz-box-shadow: inset 0px 0px 17px -1px rgba(0,0,0,.7);
    box-shadow: inset 0px 0px 17px -1px rgba(0,0,0,.7);">

    <div class="btn-group">
	<?php
		$getmngr = mysqli_query($mysqli_link,"SELECT manager_name FROM managers WHERE manager_name LIKE '%$name%'"); ?>
		<div class="btn-group" style='float:left; font-size:15px; font-weight:700; padding-top: 10px; padding-left: 2px;'>
			<ul id="nav">
				<li>
				<button type="button" class="collapsible"><img src="<?php echo $baseurl; ?>/images/menu-ico.png" style="/*margin-right: 10px;*/ margin-top: 7px;"></button>

			<div class="content">
			<ul>
			<li><a href="<?php echo $baseurl; ?>/add_master_contract.php" target="_blank">Add Master Contract</a></li>
			<li><a href="<?php echo $baseurl; ?>/addrole_add_opportunity.php" target="_blank">Manage Ops</a></li>
			<?php if(mysqli_num_rows($getmngr) > 0) { ?>
			  <li><a href="<?php echo $baseurl; ?>/agenda.php?search=&_mode=Agenda&mngr=rusvk54m">Assigned List</a></li>
			  <?php } ?>
			  <li><a href="<?php echo $baseurl; ?>/agenda.php?search=&_mode=Agenda&favlist=jklms27v">Favourite List</a></li>
			  <li><a href="<?php echo $baseurl; ?>/advanced_search.php" target="_blank">Advanced Search</a></li>
			  <li><a href="<?php echo $baseurl; ?>/changepwd.php">Change Password</a></li>
			  <li><a href="<?php echo $baseurl; ?>/logout.php">Logout</a></li>
			</ul>
			</li>
		</ul></div>

        <div style="display:inline-block;">
<!-- Search Filter Starts Here.-->
            <div class="btn-group" style='float:left;'> 
                <div style='font-weight:700; color:#fff; font-size:12px; color:#c6c7d8; padding-top:22px; margin-right: -59px'><input type="text" name="search" id="search" placeholder="Search text.." autocomplete="off" style="width:63%" value="<?php if($_GET['search'] != '') {echo $_GET['search'];} else { echo "";} ?>"></div>
			</div>
<!-- Search Filter Ends Here.-->
<!-- Date Filter Starts Here.-->
            <div class="btn-group" style='float:left;'> 
				<select name="st_datesearch" id="st_datesearch" style='margin-right: -2px;'>
					<option value="">Select Date Type</option>
					<option value="DD"<?php if($_GET['st_datesearch']=='DD') { echo "selected"; }  ?>>Due </option>
					<option value="BD"<?php if($_GET['st_datesearch']=='BD') { echo "selected"; }  ?>>Bid added</option>
					<option value="LD"<?php if($_GET['st_datesearch']=='LD') { echo "selected"; }  ?>>Last updated</option>
					<option value="AD"<?php if($_GET['st_datesearch']=='AD') { echo "selected"; }  ?>>Awarded</option>
					<option value="QD"<?php if($_GET['st_datesearch']=='QD') { echo "selected"; }  ?>> Questions Due</option>
					<option value="RD"<?php if($_GET['st_datesearch']=='RD') { echo "selected"; }  ?>> Release</option>
				</select>

				<div style=" padding-top:3px; font-size:12px;">
					<input style="width: 42%; margin-right: -5px;" type="date" name="sdate" id="sdate" value="<?php if(isset($_GET['sdate'])) { echo $_GET['sdate']; } else { echo ""; }  ?>" placeholder="Start date"  autocomplete="off" >&nbsp;
					<input style="width: 42%;" type="date" name="edate" id="edate" value="<?php if(isset($_GET['edate'])) { echo $_GET['edate']; } else { echo ""; }  ?>"  placeholder="End date" autocomplete="off">
				</div>
        	</div>
<!-- Date Filter Ends Here.-->
<?php $stlevels = mysqli_query($mysqli_link,"SELECT * FROM state_status_levels WHERE status_show != '0'"); ?>
<!-- No bid criteria filter Starts Here.-->
          <div class="btn-group" id='criteria' style="float:left; margin-left: -32px;"> 
                <div style='font-weight:700; color:#fff; font-size:12px; color:#c6c7d8; padding-top:5px;'>Bid Category</div>
				<div class="dropdown">
					<div name="_status99" id="_status99" onclick="dropbidcriteria()" class="dropbtnopen3" style='width:81px;
    /*margin-left: 5px;*/ display: inline-block; background: #fff; padding-left: 4px;
    border: 1px solid #2a2d3a; padding-bottom: 1px;  margin-top:2px;margin-right: -3px;'>
                <?php print ($bidcategory_selected . " Selected" ); ?>
                </div>
                  <div id="myDropdown99" class="dropdown-content1" style="top:26px; left:-1px; padding-left:5px; padding-top:4px; font-size:12px; background-color:#fff;">
                  		<input class='bidcategory' type='checkbox' id='bidcategory_{$db_bidtype_id}' name='bidcategory[]' value='Sole Source' <?php if(in_array('Sole Source', $bidcategoryArray)) echo 'checked'; ?>><label for='bidcategory[]'> Sole Source</label><br>
                  		<input class='bidcategory' type='checkbox' id='bidcategory_{$db_bidtype_id}' name='bidcategory[]' value='COTS/Available Software' <?php if(in_array('COTS/Available Software', $bidcategoryArray)) echo 'checked'; ?>><label for='bidcategory[]'> COTS/Available Software</label><br>
                  		<input class='bidcategory' type='checkbox' id='bidcategory_{$db_bidtype_id}' name='bidcategory[]' value='License/Hardware Procurement' <?php if(in_array('License/Hardware Procurement', $bidcategoryArray)) echo 'checked'; ?>><label for='bidcategory[]'> License/Hardware Procurement</label><br>
                  		<input class='bidcategory' type='checkbox' id='bidcategory_{$db_bidtype_id}' name='bidcategory[]' value='Website Development' <?php if(in_array('Website Development', $bidcategoryArray)) echo 'checked'; ?>><label for='bidcategory[]'> Website Development</label><br>
                  		<input class='bidcategory' type='checkbox' id='bidcategory_{$db_bidtype_id}' name='bidcategory[]' value='SoftWare/App Development' <?php if (in_array('SoftWare/App Development', $bidcategoryArray)) echo 'checked'; ?>><label for='bidcategory[]'> SoftWare/App Development</label><br>
						<input class='bidcategory' type='checkbox' id='bidcategory_{$db_bidtype_id}' name='bidcategory[]' value='Non-IT' <?php if (in_array('Non-IT', $bidcategoryArray)) echo 'checked'; ?>><label for='bidcategory[]'> Non-IT</label><br>
                  		<input class='bidcategory' type='checkbox' id='bidcategory_{$db_bidtype_id}' name='bidcategory[]' value='LMS' <?php if (in_array('LMS', $bidcategoryArray)) echo 'checked'; ?>><label for='bidcategory[]'> LMS</label><br>
                  		<input class='bidcategory' type='checkbox' id='bidcategory_{$db_bidtype_id}' name='bidcategory[]' value='Scanning/Digitization' <?php if (in_array('Scanning/Digitization', $bidcategoryArray)) echo 'checked'; ?>><label for='bidcategory[]'> Scanning/Digitization</label><br>
                  		<input class='bidcategory' type='checkbox' id='bidcategory_{$db_bidtype_id}' name='bidcategory[]' value='Artificial Intelligence' <?php if (in_array('Artificial Intelligence', $bidcategoryArray)) echo 'checked'; ?>><label for='bidcategory[]'> Artificial Intelligence</label><br>
                  		<input class='bidcategory' type='checkbox' id='bidcategory_{$db_bidtype_id}' name='bidcategory[]' value='Others' <?php if (in_array('Others', $bidcategoryArray)) echo 'checked'; ?>><label for='bidcategory[]'> Others</label><br>
    					<input type="submit" class='select_color' style="float: right; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="Apply">
                        <input type="button" onclick="select_bidcategory_all_boxes();" class='select_color' style="float: left; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="All">
                        <input type="button" onclick="select_bidcategory_no_boxes();" class='select_color' style="float: left; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="None">	
                  </div>
				</div>
			</div>
<!-- No bid criteria filter Ends Here.-->
<!-- Opp / Bid Type Filter Starts Here.-->
<div class="btn-group" id='Opp_type' style="float:left;"> 
            <div style='font-weight:700; color:#fff; font-size:12px; color:#c6c7d8; padding-top:5px;margin-left: 5px;'>Bid Type</div>
				<div class="dropdown">
                <div name="_status9" id="_status9" onclick="dropbidtype()" class="dropbtnopen2" style='width: 70px;
    margin-left: 5px; display: inline-block; background: #fff; padding-left: 4px;
    border: 1px solid #2a2d3a; padding-bottom: 1px;  margin-top:2px;margin-right: -3px;'>
                <?php print ($bidtype_selected . " Selected" ); ?>
                </div>
                  <div id="myDropdown9" class="dropdown-content1" style="top:26px; left:-1px; padding-left:5px; padding-top:4px; font-size:12px; background-color:#fff;">
                  		<?php print $bidtype_checkboxes; ?>
    					<input type="submit" class='select_color' style="float: right; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="Apply">
                        <input type="button" onclick="select_bidtype_all_boxes();" class='select_color' style="float: left; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="All">
                        <input type="button" onclick="select_bidtype_no_boxes();" class='select_color' style="float: left; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="None">	
                  </div>
                </div>
</div>
<!-- Opp / Bid Type Filter Ends Here.-->
<!-- Group By Filter Starts Here. -->
			<div class="btn-group" style='float:left; margin-left: 5px;'> 
                <div style='font-weight:700; color:#fff; font-size:12px; color:#c6c7d8; padding-top:5px;'>Group By</div>
				<div class="dropdown">
				<select name="groupBy" id="groupBy" style="height:23px; width:72px;margin-right: -2px;" onchange="getMCValues();">
				<option value="">--Select--</option>
				<option value='Project' <?php echo $projectSelected; ?>>Project</option>
				<option value='Staffing' <?php echo $staffingSelected; ?>>Staffing</option>
				<option value='Others' <?php echo $othersSelected; ?>>Others</option>
				</select>
				</div>
			</div>
<!-- Group By Filter Ends Here. -->
<!-- Decision filterStarts Here. -->
          <div class="btn-group" style='float:left;'> 
                <div style='font-weight:700;color:#fff;font-size:12px;color:#c6c7d8;padding-top:4px;margin-left: 5px;'>Decision</div>
                <div class="dropdown">
                <div name="_status3" id="_status3" onclick="dropdecision()" class="dropbtnopen1" style='width: 70px;
    margin-left: 5px; display: inline-block; background: #fff; padding-left: 4px;
    border: 1px solid #2a2d3a; padding-bottom: 1px;  margin-top:2px;'>
                <?php print ($decision_selected . " Selected" ); ?>
                </div>
                  <div id="myDropdown5" class="dropdown-content1" style="top:26px; left:-1px; padding-left:5px; padding-top:4px; font-size:12px; background-color:#fff;">
                  		<?php print $decision_checkboxes; ?>
    					<input type="submit" class='select_color' style="float: right; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="Apply">
                        <input type="button" onclick="select_dec_all_boxes();" class='select_color' style="float: left; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="All">
                        <input type="button" onclick="select_dec_no_boxes();" class='select_color' style="float: left; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="None">	
                  </div>
                </div>
        	</div>
<!-- Decision filter Ends Here.-->
<!-- Phase filter Starts Here. -->
          <div class="btn-group" style='float:left; margin-left: 5px;'> 
                <div style='font-weight:700; color:#fff; font-size:12px; color:#c6c7d8; padding-top:5px;'>Phase</div>
				<div class="dropdown">
				<select name="bnpphase" style="height:23px; width:85px; margin-right: -2px; margin-left: -3px;">
				<option value="">--Select--</option>
				<?php while($rec = mysqli_fetch_array($stlevels)) { ?>
				<option value="<?php echo $rec['status_name']; ?>"<?php if($_GET['bnpphase']==$rec['status_name']) { echo "selected"; }  ?>><?php echo $rec['status_name']; ?></option>
				<?php } ?>
				</select>
				</div>
			</div>
<!-- Phase filter Ends Here. -->
<!-- Added By Filter Starts Here. -->
			<div class="btn-group" style='float:left; margin-left: 5px;'> 
                <div style='font-weight:700; color:#fff; font-size:12px; color:#c6c7d8; padding-top:5px;'>Added By</div>
				<div class="dropdown">
				<select name="addedBy" style="height:23px; width:72px;margin-right: -2px;">
				<option value="">--Select--</option>
				<?php echo $usersSelect1; ?>
				</select>
				</div>
			</div>
<!-- Added By Filter Ends Here. -->
<!-- Assigned To Filter Starts Here. -->
			<div class="btn-group" style='float:left; margin-left: 5px;'> 
                <div style='font-weight:700; color:#fff; font-size:12px; color:#c6c7d8; padding-top:5px;'>Assigned To</div>
				<div class="dropdown">
				<select name="assignedTo1" style="height:23px; width:80px;margin-right: -2px;">
				<option value="">--Select--</option>
				<option value='Prasad Devarakonda' <?php echo $pdSelected1; ?>>Prasad Devarakonda</option>
				<option value='Rama Krishna' <?php echo $rkSelected1; ?>>Rama Krishna</option>
				</select>
				</div>
			</div>
<!-- Assigned To Filter Ends Here. -->		
<!-- Date filter -->
	  <div class="btn-group" style='float:left;'>
		<div style='font-weight:700; color:#fff; font-size:12px; color:#c6c7d8; padding-top:4px; margin-left: 5px;'>Master Contracts</div>
		<div class="dropdown">
              <div name="_status2" id="_status2" onclick="dropvehicle();" class="dropbtnopen" style='width: 100px;
    margin-left: 5px; display: inline-block; background: #fff; padding-left: 4px;
    border: 1px solid #2a2d3a; padding-bottom: 1px; margin-top:2px;'>
                <?php print ($vehicles_selected . " Selected" ); ?>
             </div>
             <div id="myDropdown4" class="dropdown-content1" style="top:26px; left:-1px; padding-left:5px; padding-top:4px; font-size:12px; background-color:#fff; height:270px; overflow-y:auto;">
                  	<div id="dynamic_mc_values"></div>	
						<?php print $vehicle_checkboxes; ?>
    					<input type="submit" class='select_color' style="float: right; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="Apply">
                        <input type="button" onclick="select_all_boxes();" class='select_color' style="float: left; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="All">
                        <input type="button" onclick="select_no_boxes();" class='select_color' style="float: left; 
    margin-right: 4px; margin-bottom: 4px; border-radius: 5px; font-size: 12px; padding-bottom:2px;" value="None">	
              </div>
         </div>  
		 </div>

		 <div style="float:left; margin-left: 3px; margin-top:2px">
				<div style='font-weight:700; color:#fff; font-size:12px; color:#c6c7d8; padding-top:4px;'>State</div>
				<select name="state" id="state" style="height:22px; width:65px;margin-right: -2px;">
				<option value="">--Select--</option>
				<?php echo $state; ?>
				</select>
		 </div>

			 <div style="float:left"> <input type="checkbox" name="favourite_bids" id="favourite_bids" style="margin-left: 18px; width: 15px;height: 15px; margin-right: 4px; float: left;" <?php echo $checked;?>><span style="color:#ffff00">My Favorites</span> <br><input type="submit" name="datesubmit" id="datesubmit" class='select_color' style=" 
border-radius: 5px; font-size: 12px; padding-bottom:2px; font-weight: bold; margin-left: 16px;margin-top:4px;" value="Submit">
			 
			 
			 </div> 

			 

			
		 </div>  
		 
	</div>
	</form>	
		
<!--<div class="btn-group" style='float:right; font-size:15px; padding-top: 10px; padding-left: 10px;'>
	 <form action="advanced_search.php" method="GET" class="search-form">
		<input type="search" name="searchtext" autocomplete="off" required style="width:100px"> 
		<div class="go"><input type="submit" value="GO" class="go-button"></div>
		<i class="fa fa-search"></i>
	 </form>
	</div>-->
    </div>
</div>

<div style="clear:both; height:58px;"></div>
<!-- </form> -->
<?php
$entry_date2 = date("Y-m-d"); //Y-m-d h:i:sa
$entry_date1 = date('Y-m-d', strtotime($entry_date2 . ' -1 month'));

$filterarea = "";
//include("includes/filter_area.php");

$app_builder = "";
$count_results = 0;
$type_change = 0;
$tr_color = "background-color:#31335f;"; /* #98e0e0 */
$tr_font_color = "color:#fff; text-align:center;";
$tr_color .= $tr_font_color;

$header_part = "";

$table_content = "<DIV>$urlcontainer</div>";

$table_content_new = ""; 

$header_cpw = "<div class='div-table1 header'>
				<div class='sortable1' data-col='sno' style='display:inline-block; width:40px; vertical-align:top;'>#<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable1' data-col='due' style='display:inline-block; width:130px; vertical-align:top;'>Proposal Due<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<!--<div style='display:inline-block; width:110px; vertical-align:top;'>&nbsp;</div>-->
				<div class='sortable1' data-col='vehicle' style='display:inline-block; width:81px; vertical-align:top;'>Vehicle<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable1' data-col='type' style='display:inline-block; width:72px; vertical-align:top;'>Type<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable1' data-col='bidno' style='display:inline-block; width:92px; vertical-align:top;'>Bid #<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable1' data-col='agency' style='display:inline-block; width:135px; vertical-align:top;'>State/Agency<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable1' data-col='title' style='display:inline-block; width: calc(100% - 810px);vertical-align:top;'>Title<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable1' data-col='manager' style='display:inline-block; width:160px;'>Manager<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable1' data-col='addedby' style='display:inline-block; width:120px; vertical-align:top;'>Added By<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable1' data-col='priority' style='display:inline-block; width:120px; vertical-align:top;'>Priority<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				</div>";

$header_rfp = "<div class='div-table2 header'>
				<div class='sortable2' data-col='sno' style='display:inline-block; width:40px; vertical-align:top;'>#<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable2' data-col='rfprelease' style='display:inline-block; width:114px; vertical-align:top;'>RFP Release<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<!--<div style='display:inline-block; width:108px; vertical-align:top;'>&nbsp;</div>-->
				<div class='sortable2' data-col='vehicle' style='display:inline-block; width:113px; vertical-align:top;'>Vehicle<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable2' data-col='type' style='display:inline-block; width:72px; vertical-align:top;'>Type<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable2' data-col='bidno' style='display:inline-block; width:119px; vertical-align:top;'>Bid #<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable2' data-col='state' style='display:inline-block; width:120px; vertical-align:top;'>State/Agency<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable2' data-col='title' style='display:inline-block; width: calc(100% - 835px);vertical-align:top;'>Title<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable2' data-col='manager' style='display:inline-block; width:160px;'>Manager<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable2' data-col='addedby' style='display:inline-block; width:120px; vertical-align:top;'>Added By<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable2' data-col='priority' style='display:inline-block; width:120px; vertical-align:top;'>Priority<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
			   </div>";

$header_award = "<div class='div-table3 header'>
				<div class='sortable3' data-col='sno' style='display:inline-block; width:40px; vertical-align:top;'>#<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable3' data-col='awarddate' style='display:inline-block; width:114px; vertical-align:top;'>Award Date<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<!-- <div style='display:inline-block; width:110px; vertical-align:top;'>Est. PoP Start</div> -->
				<div class='sortable3' data-col='vehicle' style='display:inline-block; width:108px; vertical-align:top;'>Vehicle<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable3' data-col='type' style='display:inline-block; width:72px; vertical-align:top;'>Type<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable3' data-col='bidno' style='display:inline-block; width:91px; vertical-align:top;'>Bid #<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable3' data-col='state' style='display:inline-block; width:120px; vertical-align:top;'>State/Agency<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable3' data-col='title' style='display:inline-block; width: calc(100% - 826px);vertical-align:top;'>Title<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable3' data-col='manager' style='display:inline-block; width:160px;'>Manager<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable3' data-col='addedby' style='display:inline-block; width:120px;vertical-align:top;'>Added By<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				<div class='sortable3' data-col='priority' style='display:inline-block; width:120px;vertical-align:top;'>Priority<span class='arrows'>
											<span class='up'>▲</span>
											<span class='down'>▼</span></span>
				</div>
				</div>";

$header_search = "<div style='display:inline-block; width:27px; vertical-align:top;'>#</div>
				<div style='display:inline-block; width:81px; vertical-align:top;'>
				<a href='?".$srch_val."&sort=released&ascdesc=".$ascdesc."'>Release $ascstyle</a></div>
				<!--<div style='display:inline-block; width:81px; vertical-align:top;'>
				<a href='?".$srch_val."&sort=creation_timestamp&ascdesc=".$ascdesc."'>Bid Added $ascstyle</a></div>-->
				<div style='display:inline-block; width:126px; vertical-align:top;'>
				<a href='?".$srch_val."&sort=proposal_due&ascdesc=".$ascdesc."'>Due $ascstyle</a></div>
				<!-- <div style='display:inline-block; width:120px; vertical-align:top;'>
				<a href='?".$srch_val."&sort=contract_vehicle&ascdesc=".$ascdesc."'>Vehicle $ascstyle</a></div> -->
				<div style='display:inline-block; width:63px; vertical-align:top;'>
				<a href='?".$srch_val."&sort=subagency&ascdesc=".$ascdesc."'>Type $ascstyle</a></div>
				<div style='display:inline-block; width:108px; vertical-align:top;'>
				<a href='?".$srch_val."&sort=vehicle_one&ascdesc=".$ascdesc."'>Bid # $ascstyle</a></div>
				<div style='display:inline-block; width:135px; vertical-align:top;'>
				<a href='?".$srch_val."&sort=agency&ascdesc=".$ascdesc."'>State/Agency $ascstyle</a></div>
				<div style='display:inline-block;  width:432px;'><a href='?".$srch_val."&sort=title&ascdesc=".$ascdesc."'>Title $ascstyle</a></div>
				<div style='display:inline-block; width:144px;'><a href='?".$srch_val."&sort=vehicle_two&ascdesc=".$ascdesc."'>Assigned To $ascstyle</a></div>
				<!--<div style='display:inline-block; width:80px;'><a href='?".$srch_val."&sort=requestor&ascdesc=".$ascdesc."'>Added By $ascstyle</a></div>-->
				<div style='display:inline-block;  width:72px; vertical-align:top;'>
				<a href='?".$srch_val."&sort=decision&ascdesc=".$ascdesc."'>Criteria $ascstyle</a></div>";

$table_content_a = "<div class='bp_label' style='display: inline-flex; padding:15px 0px'>Agenda Item&nbsp;<div id='agendaItemCount' style='margin-right:5px'></div><form name='vehpost' method='post' action=''>
    <select name='vehtype' onchange='this.form.submit()' style='font-weight:300 !important'>
      <option value=''>All</option>
      <option value='Staffing' $staffing>Staffing</option>
      <option value='Project' $project>Project</option>
      <option value='Others' $others>Others</option>
    </select>
</form> 
<!----------------------- Added For Filters Assigned To & Added By Starts Here. --------------------------->
&nbsp;&nbsp; Assigned To &nbsp;&nbsp <form name='assignedTo' method='post' action=''>
    <select name='assigned' onchange='this.form.submit()' style='font-weight:300 !important'>
      <option value=''>--Select--</option>
      <option value='Prasad Devarakonda' $pdSelected>Prasad Devarakonda</option>
      <option value='Rama Krishna' $rkSelected>Rama Krishna</option>
    </select>
</form> 
&nbsp;&nbsp; Added By &nbsp;&nbsp <form name='addedBy' method='post' action=''>
    <select name='added' onchange='this.form.submit()' style='font-weight:300 !important'>
      <option value=''>--Select--</option>
		$usersSelect
    </select>
</form> 
<!------------------------ Added For Filters Assigned To & Added By Ends Here. ---------------------------->
$favtext</div><div class='title_bar'>$header_all</div>";
$table_content_b = "<div class='bp_label' style='margin-top:20px;'><form name='cpwl_post' method='post' action=''></div>
   <div class='bp_label' style='display: inline;'>Current Proposal Workload&nbsp;<span id='cpwItemCount' style='display: inline;'><span></div><div style='display: inline;'><select name='cpwl_vehtype' onchange='this.form.submit()' style='font-weight:300 !important; margin-bottom: 7px;'>
      <option value=''>All</option>
      <option value='Staffing' $cpwl_staffing>Staffing</option>
      <option value='Project' $cpwl_project>Project</option>
    </select>
</form> </div><div class='title_bar'>$header_cpw</div>";

$table_content_c = "<div class='bp_label' style='margin-top:20px;'>Prioritize Tracking&nbsp;<span id='rfpItemCount'><span></div><div class='title_bar'>$header_rfp</div>";

$table_content_d = "<div class='bp_label' style='margin-top:20px;'>Award Monitoring&nbsp;<span id='amItemCount'><span></div><div class='title_bar'>$header_award</div>";

$table_content_e = "<div class='bp_label' style='margin-top:20px;'>Under Review&nbsp;<span id='urItemCount'><span></div><div class='title_bar'>$header_cpw</div>";

$header_label = 'Search Details';
if($bnp_phase != '')
$header_label = $bnp_phase;

//$table_content_opp = "<div class='bp_label' /*style='margin-top:20px;*/'>Search Results</div><div class='title_bar title_bar1'>$header_search</div>";
$table_content_opp = "<div class='title_bar title_bar1'>$header_search</div>";

//AGENDA MODE
//if($urlmode=='Agenda') { $queryvehicle=""; }
  
//INCLUDE
include("agenda_insert.php");

if($urlmode=='Agenda')
{
print($filterarea . "<div style='padding-bottom: 30px;'><div class='clearfix ' style='display:inline-block;vertical-align:top;width:96%; margin-left:2%;'>" . $header_part . $table_content_a . $table_content_b . $table_content_c . $table_content_d . $table_content_e . "</table>&nbsp;</div></div>");
}

if($urlmode=='Opportunities')
{
if(isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
	} else {
		$page_no = 1;
        }

	$total_records_per_page = 50;
    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

    $total_no_of_pages = ceil($total_results / $total_records_per_page);
	$second_last = $total_no_of_pages - 1;

echo "<div class='bp_label'>Searching for :: ". $search_string . $vehicle_string . $type_string . $decision_string . $phase_string . $addedBy_string . $assignedTo_string . $groupBy_string . $date_search_string. $bidcategory_string . $bidtype_string . $state_string. "</div>";
?>

<div style="clear:both"></div>
<div id="pagination_div">
<div style="display:flex; margin-top: 20px;">
<?php if($total_results > 0) {  ?>
<div style='padding: 10px 0px 0px; border-top: dotted 1px #CCC; margin-left: 2%; width: 15%; margin-top: -18px;'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
<!-- &nbsp;&nbsp;&nbsp;&nbsp;Total Records: <?php echo $total_results; ?></strong>-->
</div>
<?php } ?>
<div style='width:63%; text-align:center; font-weight:700; color:#464758; margin-top: -27px;'>
	<ul class="pagination">
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?".$srch_val."&page_no=$previous_page'"; } ?>>Previous</a>
	</li>      
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}
	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?".$srch_val."&page_no=1'>1</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?".$srch_val."&page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?".$srch_val."&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";    }
		else {
        echo "<li><a href='?".$srch_val."&page_no=1'>1</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>  
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) {
	echo "href='?".$srch_val."&page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?".$srch_val."&page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
	} ?>
</ul>
</div>
<!--  Top Pagination Starts Here.   -->
<div style='width:18%; text-align:right; font-weight:700; color:#464758;'>
<?php
$count_results = 50;
if(($urlmode != 'Agenda') && ($total_results >= 50)){
	if($page_no < $total_no_of_pages){
		print("<strong>Displaying&nbsp;:&nbsp; ".(($page_no-1)*($count_results)+1)." - ".($page_no)*$count_results." &nbsp;of &nbsp;$total_results</strong>");
	}
	if($page_no == $total_no_of_pages){
		print("<strong>Displaying&nbsp;:&nbsp; ".(($page_no-1)*($count_results)+1)." - ".$total_results." &nbsp;of &nbsp;$total_results</strong>");
	}
}
 else if(($urlmode != 'Agenda') && ($total_results < $count_results)){
	print("<strong>Displaying&nbsp;:&nbsp;  ".$total_results." &nbsp;of &nbsp;$total_results</strong>");
}
?>
	</div>
</div>
</div> <!-- Pagination Div ends Here. -->
<div style="clear:both"></div>
<!--  Top Pagination Ends Here.      -->
<!-- Search DropDown for Text & Incumbents.  -->
<?php if($_GET['dualsearch'] == '') { ?>
	<?php echo $filterarea; ?><div style='/*padding-bottom: 30px;*/'>
	<div class='bp_label' style='margin-left: 18px; margin-bottom: 5px;'>Search Results</div>

	<a style="float: right;" href="export_csv.php?title=<?=trim($_GET['search']);?>&datesearch=<?=$_GET['st_datesearch'];?>&sdate=<?=$_GET['sdate'];?>&edate=<?=$_GET['edate'];?>&<?=http_build_query(['bidcategory' => $_GET['bidcategory']]);?>&<?=http_build_query(['bidtype' => $_GET['bidtype']]);?>&groupBy=<?=$_GET['groupBy'];?>&<?=http_build_query(['decision' =>
    $_GET['decision']]);?>&bnpphase=<?=$_GET['bnpphase'];?>&addedBy=<?=$_GET['addedBy'];?>&assignedTo1=<?=$_GET['assignedTo1'];?>&<?=http_build_query(['vehicle' => $_GET['vehicle']]);?>&state=<?=$_GET['state'];?>"><b>Export to CSV</b></a>

	<div class='clearfix clearfix1' style='display:inline;vertical-align:top;width:98%; margin-left:2%;'><?php echo  
	$header_part . $table_content_opp; ?></div></div></table>
<?php } ?>

<?php if($_GET['dualsearch'] == 'IS') { ?>
	<?php echo $filterarea; ?><div style='padding-bottom: 30px;'><div class='clearfix' style='display:inline-block;vertical-align:top;width:98%; margin-left:2%;'><?php echo  
	$table_content_opp . $incumbents_filter_data; ?></div></div></table>
<?php }?>
<!-- Ends Here.   ----->
<div style="display:flex; margin-top: 10px;">
<?php if($total_results > 0) { ?>
<div id="page_counter" style='padding: 10px 0px 0px; border-top: dotted 1px #CCC; margin-left: 2%; width: 15%'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
<!-- &nbsp;&nbsp;&nbsp;&nbsp;Total Records: <?php echo $total_results; ?>-->
</div>
<?php } ?>
<div style='width:63%; text-align:center; font-weight:700; color:#464758;'>
<ul class="pagination">
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?".$srch_val."&page_no=$previous_page'"; } ?>>Previous</a>
	</li>      
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}
	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?".$srch_val."&page_no=1'>1</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?".$srch_val."&page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?".$srch_val."&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";    }	
		else {
        echo "<li><a href='?".$srch_val."&page_no=1'>1</a></li>";
		echo "<li><a href='?".$srch_val."&page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?".$srch_val."&page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) {
	echo "href='?".$srch_val."&page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?".$srch_val."&page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
	} ?>
</ul>
</div>
<?php }  ?>

<div style='width:18%; text-align:right; font-weight:700; color:#464758;'>
<?php
//echo $count_results.'--'.$total_results;
$count_results = 50;
if(($urlmode != 'Agenda') && ($total_results >= 50)){
	if($page_no < $total_no_of_pages){
		print("<strong>Displaying&nbsp;:&nbsp; ".(($page_no-1)*($count_results)+1)." - ".($page_no)*$count_results." &nbsp;of &nbsp;$total_results</strong>");
	}
	if($page_no == $total_no_of_pages){
		print("<strong>Displaying&nbsp;:&nbsp; ".(($page_no-1)*($count_results)+1)." - ".$total_results." &nbsp;of &nbsp;$total_results</strong>");
	}
}
 else if(($urlmode != 'Agenda') && ($total_results < $count_results)){
	print("<strong>Displaying&nbsp;:&nbsp;  ".$total_results." &nbsp;of &nbsp;$total_results</strong>");
}
?>
</div>
</div>
<div style="clear:both"></div>
<!-- End page content -->
</div>

<!-- Footer -->
<?php include("includes/footer.php"); ?>

<script>
/*function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}*/
</script>

<script>
/*function dropdownshow2() {
  document.getElementById("myDropdown2").classList.toggle("show");
}

window.onclick = function(event) {
if (!event.target.matches('.dropbtn')) {
var dropdowns = document.getElementsByClassName("dropdown-content");
var i;
for (i = 0; i < dropdowns.length; i++) {
  var openDropdown = dropdowns[i];
  if (openDropdown.classList.contains('show')) {
	openDropdown.classList.remove('show');
  }
}
}
}*/

function dropvehicle() {
<?php 
	if($_GET['vehicle'] != "") {
	  
	for($i=0; $i<count($_GET['vehicle']);$i++) { ?>

//		var veh = "<?php echo $_GET['vehicle'][$i]; ?>";
		document.getElementById("<?php echo $_GET['vehicle'][$i]; ?>").checked = true;

<?php } 
	}else{
?>
		document.getElementById("<?php echo $_GET['vehicle'][$i]; ?>").checked = false;
<?php	
	}
?>
	
document.getElementById("myDropdown4").classList.toggle("show");
document.getElementById('search').value = '';
document.getElementById("_mode").value = "Opportunities";
document.getElementById("ur").checked = false;

var ele=document.getElementsByName('vehicle[]');  
	for(var i=0; i<ele.length; i++)
	{  
		   if(ele[i].type=='checkbox')
		   {  
				//if (i == 1) { ele[i].checked=true; }  else { ele[i].checked=false; }
				if (ele[i].value == 'Undecided') { ele[i].checked=true; }  else { ele[i].checked=false; }
		   }
	}  
}

function dropdecision() {
	document.getElementById("myDropdown5").classList.toggle("show");
	document.getElementById('search').value = '';
	document.getElementById("_mode").value = "Opportunities";
	document.getElementById("ur").checked = false;

	var ele=document.getElementsByName('decision[]'); 
	for(var i=0; i<ele.length; i++)
	{  
		   if(ele[i].type=='checkbox')
		   {  
				//if (i == 1) { ele[i].checked=true; }  else { ele[i].checked=false; }
				if (ele[i].value == 'Undecided') { ele[i].checked=true; }  else { ele[i].checked=false; }
		   }
	} 
}


function dropbidcriteria() {
	document.getElementById("myDropdown99").classList.toggle("show");
	document.getElementById('search').value = '';
	document.getElementById("_mode").value = "Opportunities";
	document.getElementById("ur").checked = false;

	var ele=document.getElementsByName('bidcategory[]'); 
	for(var i=0; i<ele.length; i++)
	{  
		   if(ele[i].type=='checkbox')
		   {  
				//if (i == 1) { ele[i].checked=true; }  else { ele[i].checked=false; }
				if (ele[i].value == 'Undecided') { ele[i].checked=true; }  else { ele[i].checked=false; }
		   }
	} 
}


function dropbidtype() {
	document.getElementById("myDropdown9").classList.toggle("show");
	document.getElementById("myDropdown9").classList.add("hidden1");
	document.getElementById('search').value = '';
	document.getElementById("_mode").value = "Opportunities";
	document.getElementById("ur").checked = false;

	var ele=document.getElementsByName('bidtype[]'); 
	for(var i=0; i<ele.length; i++)
	{  
		   if(ele[i].type=='checkbox')
		   {  
				//if (i == 1) { ele[i].checked=true; }  else { ele[i].checked=false; }
				if (ele[i].value == 'Undecided') { ele[i].checked=true; }  else { ele[i].checked=false; }
		   }
	} 
}
// Code To Hide and Show The 'Master Contracts' & 'Decision' & 'BidType' DropDowns Starts Here.
document.onclick = function(event) {
	 if ((event.target.matches('.dropbtnopen')) || (event.target.matches('.vehicles'))) { 
		 document.getElementById("myDropdown4").classList.add('hidden1');
		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
		  var openDropdown = dropdowns[i];
		  if (openDropdown.classList.contains('show')) {
		  }
		}
	  }else if((!event.target.matches('.dropbtnopen')) || (!event.target.matches('.vehicles'))) {
			document.getElementById("myDropdown4").classList.remove('hidden1');
			document.getElementById("myDropdown4").classList.add('hidden');
	  }


	  if ((event.target.matches('.dropbtnopen1')) || (event.target.matches('.criteria'))) { 
			document.getElementById("myDropdown5").classList.add('hidden1');
			var dropdowns1 = document.getElementsByClassName("dropdown-content");
			var i;
				for (i = 0; i < dropdowns1.length; i++) {
					var openDropdown1 = dropdowns1[i];
						if (openDropdown1.classList.contains('show')) {
						}
				}
	   }else if((!event.target.matches('.dropbtnopen1')) || (!event.target.matches('.criteria'))) {
		   	document.getElementById("myDropdown5").classList.remove('hidden1');
			document.getElementById("myDropdown5").classList.add('hidden');
	   }
	
	   
	   if ((event.target.matches('.dropbtnopen2')) || (event.target.matches('.bidtype'))) { 
		 document.getElementById("myDropdown9").classList.add('hidden1');
		var dropdowns2 = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns2.length; i++) {
		  var openDropdown2 = dropdowns2[i];
		  if (openDropdown2.classList.contains('show')) {
		  }
		}
	  }else if((!event.target.matches('.dropbtnopen2')) || (!event.target.matches('.bidtype'))) {
			document.getElementById("myDropdown9").classList.remove('hidden1');
			document.getElementById("myDropdown9").classList.add('hidden');
	  }


	  if ((event.target.matches('.dropbtnopen3')) || (event.target.matches('.bidcategory'))) { 
		 document.getElementById("myDropdown99").classList.add('hidden1');
		var dropdowns3 = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns3.length; i++) {
		  var openDropdown3 = dropdowns3[i];
		  if (openDropdown3.classList.contains('show')) {
		  }
		}
	  }else if((!event.target.matches('.dropbtnopen3')) || (!event.target.matches('.bidcategory'))) {
			document.getElementById("myDropdown99").classList.remove('hidden1');
			document.getElementById("myDropdown99").classList.add('hidden');
	  }
}  
// Code To Hide and Show The 'Master Contracts' & 'Decision' & 'BidType' DropDowns Ends Here.

$(document).on('keyup', function(e) {
  if (e.key == "Escape") {
	  	document.getElementById("myDropdown4").classList.remove('hidden1');
		document.getElementById("myDropdown4").classList.add('hidden');
		document.getElementById("myDropdown5").classList.remove('hidden1');
		document.getElementById("myDropdown5").classList.add('hidden');
		document.getElementById("myDropdown9").classList.remove('hidden1');
		document.getElementById("myDropdown9").classList.add('hidden');
		document.getElementById("myDropdown99").classList.remove('hidden1');
		document.getElementById("myDropdown99").classList.add('hidden');
  }
});
</script>

<script>
$("#sdate,#edate").click(function(){
	var datetype = $("#st_datesearch").val();
	if(datetype == ''){
		alert("Please select date type.");
	}
});
$(document).ready(function(){
	$("#st_datesearch").change(function(){
		var datetype = $("#st_datesearch").val();
		if(datetype == '')
		 {  
			$("#sdate").attr("readonly", true);
			$("#edate").attr("readonly", true);
			$("#sdate").val('');
			$("#edate").val('');
		 }
		 else
		 {
			$("#sdate").attr("readonly", false);
			$("#edate").attr("readonly", false);
		 }
	});
	$("#st_datesearch").trigger("change");
});
/*
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
*/  
/* criteria dropdown slecttion click event */

if($("#decision_4").prop('checked') == true){
	$('#criteria').show();
}
/*
$('.criteria').click(function() {
	var chk = $(this).val();
	if(chk == 'No Bid' && $(this).prop("checked"))
	{
		$('#criteria').show();
	}
	else
	{
		$('#criteria').hide();
		$('#criteria').value('');
	}
});
*/
//JQuery code to toggle fav bids starts here.
$(document).ready(function(){
	$("#favourite_bids").click(function(){
		var status = $("#favourite_bids").is(':checked');
		if(status){	
			window.location.href= "<?php echo $baseurl; ?>"+"/agenda.php?search=&_mode=Agenda&favlist=jklms27v&favshow=yes";
		}else{	
			window.location.href = "<?php echo $baseurl; ?>"+"/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review";
		}
	});
});
//JQuery code to toggle fav bids ends here.
function blurfunction(namea,valueb,idc) {
	var namea = namea;
	var valueb = valueb;
	var idc = idc;
	if (namea=='decision') {
		if (valueb == "Bid") {
			document.getElementById("opp_status" + idc).value = "Current Proposal Workload";	
		}
		if ((valueb == "Review") || (valueb == "Review")) { 
			document.getElementById("opp_status" + idc).value = "Under Review";	
		}
		if ((valueb == "Prioritize") || (valueb == "Prioritize")) { 
			document.getElementById("opp_status" + idc).value = "Prioritize Tracking";	
		}
		if ((valueb == "Cancelled") || (valueb == "Cancelled")) {
			document.getElementById("opp_status" + idc).value = "Archived";	
			document.getElementById("is_awarded" + idc).value = "Cancelled";	
		}

		if (valueb == "") {
			//document.getElementById("submitbtn" + idc).disabled = true;	
			document.getElementById("opp_status" + idc).value = "Agenda Item";
		}
		else
		{
			document.getElementById("submitbtn" + idc).disabled = false;	
		}

		if((valueb == "No Bid") || (valueb == "No Bid")) {
			document.getElementById('is_archived' + idc).checked = true;
			document.getElementById("opp_status" + idc).value = "Archived";		
			document.getElementById("criteriatype" + idc).style.display = "block";	
//			document.getElementById("reason" + idc).setAttribute('required', '');
		}
		else{
//			document.getElementById("reason" + idc).removeAttribute('required');
			document.getElementById('is_archived' + idc).checked = false;
			document.getElementById("criteriatype" + idc).style.display = "none";
			document.getElementById("criteriatype" + idc).checked = false;
		}
	}
	else
	{
		document.getElementById("decision_edit" + idc).disabled = false;
	}

  if (namea=='manager') {  
		document.getElementById("managertitle" + idc).innerHTML=valueb;
  }
}
/* favourite code starts here */
function blurfavsubmitted(chkval,idc) {
 	if(chkval == true || chkval == 'true'){
		$('#div_fav_'+idc).html("<a style='cursor:pointer;' onclick='blurfavsubmitted(false, "+idc+")'><img src='images/star-blue.gif' border='0' title='Click to remove from Favourite' style='width:18px; margin-bottom: 5px;' /></a>");
				$('#div_favcommnt_'+idc).show();
				$('#div_favreason_'+idc).show();

	}
	else if(chkval == false || chkval == 'false'){

	$.ajax({
	type: "get",
    url: "ajax_favbid_add.php?oppid=" + idc + "&unflag=1", 
	success: function(result){
		alert('Removed from Favourite');
		document.getElementById("txtarea_fav_reason_" + idc).value = '';
	}
  });	


		$('#div_fav_'+idc).html("<a style='cursor:pointer;' onclick='blurfavsubmitted(true, "+idc+")'><img src='images/star-gray.gif' border='0' title='Click to add to Favourite' style='width:18px; margin-bottom: 5px;' />	</a>");
				$('#div_favcommnt_'+idc).hide();
				$('#div_favreason_'+idc).hide();

	}
}

function favsubmitted(idc) {
	//var id = idc;
	var reason = document.getElementById("txtarea_fav_reason_" + idc).value;
	$.ajax({
	type: "get",
    url: "ajax_favbid_add.php?oppid=" + idc + "&reason=" + reason, 
	success: function(result){

	if(result == true || result == 'true'){
		$('#div_fav_'+idc).html("<a style='cursor:pointer;' onclick='blurfavsubmitted(false, "+idc+")'><img src='images/star-blue.gif' border='0' title='Click to remove from Favourite' style='width:18px; margin-bottom: 5px;' /></a>");
		alert('Added to the Favourite');

	}
	else if(result == false || result == 'false'){
		$('#div_fav_'+idc).html("<a style='cursor:pointer;' onclick='blurfavsubmitted(true, "+idc+")'><img src='images/star-gray.gif' border='0' title='Click to add to Favourite' style='width:18px; margin-bottom: 5px;' />	</a>");
	}
  }});
}
/* favourite code ends here */

function blursubmitted(namea,valueb,idc) {
	var namea = namea;
	var valueb = valueb;
	var idc = idc;
	var whichphase = 0;
	//var thisajaxurl = "ajax_status_update.php?oppid=";

	valuedecision = document.getElementById('decision_edit' + idc).value;
//	valueopptype = document.getElementById('opptypeedit' + idc).value;

	if (namea=='is_submitted') { valuesubmitted = document.getElementById('is_submitted' + idc).checked; valueb=valuesubmitted; }
	if (namea=='is_archived') { valuearchived = document.getElementById('is_archived' + idc).checked; valueb=valuearchived; }
	
	if ((namea=='is_submitted') && (valuedecision=='Bid') && (valuesubmitted==true)) 
		{ //alert ("Type " + valueopptype + " valueb " + valueb + " namea " + namea);
			//thisajaxurl = "ajax_phase_update.php?oppid=";
		/*	if ((valueopptype=='RFI') || (valueopptype=='Draft RFP')) { whichphase=1; document.getElementById("opp_status" + idc).value = "RFP Tracking"; }
			if ((valueopptype=='RFP') || (valueopptype=='RFQ')) { whichphase=2; */
				document.getElementById("opp_status" + idc).value = "Award Monitoring"; //}
			//if (whichphase==1) { namea = "phase1";  } 
			//if (whichphase==2) { namea = "phase2";  } 
		} 
	if ((namea=='is_submitted') && (valuedecision=='Bid') && (valuesubmitted==false)) 
		{ //alert ("Type " + valueopptype + " valueb " + valueb + " namea " + namea);
			//thisajaxurl = "ajax_phase_update.php?oppid=";
		/*	if ((valueopptype=='RFI') || (valueopptype=='Draft RFP')) { whichphase=1; document.getElementById("opp_status" + idc).value = "RFP Tracking"; }
			if ((valueopptype=='RFP') || (valueopptype=='RFQ')) { whichphase=2; */
				document.getElementById("opp_status" + idc).value = "Current Proposal Workload"; //}
			//if (whichphase==1) { namea = "phase1";  } 
			//if (whichphase==2) { namea = "phase2";  } 
		}
}
</script>

<script>
var coll = document.getElementsByClassName("collapsible_bid");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
	  //alert("FIX");
    this.classList.toggle("active_bid");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>

<script>
function showajaxopp(x) {
//alert("Search " + document.getElementById('search').value);
passthissearch = document.getElementById('search').value;
var thisElement = document.getElementById(x); 
var current_bar = document.getElementById("opportunity_container" + x);

// Chat GPT Code.

// Get the next/bottom div
if (current_bar) {
var bottom_bar = current_bar.nextElementSibling;
if (bottom_bar) {
// Save bottom div position
var before = bottom_bar.getBoundingClientRect();
// Chat GPT Code.
current_bar.classList.toggle("active_bar");  // old code.
// Chat GPT Code.
// Get bottom div's new position
var after = bottom_bar.getBoundingClientRect();

// Calculate movement
var difference = after.top - before.top;

// Restore bottom div position
bottom_bar.style.transform =
    "translateY(" + (-difference) + "px)";
}
}
// Chat GPT Code.



//AJAX GET
if (x.length == 0) {
document.getElementById(x).innerHTML = ""; 
return;
} else {
var xmlhttp1 = new XMLHttpRequest();
xmlhttp1.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
document.getElementById(x).innerHTML = this.responseText; 
initTinyMCE();
$("#accordion").accordion();
}
};
xmlhttp1.open("GET", "opportunity_details.php?bp=" + x + "&search=" + passthissearch, true);
xmlhttp1.send();
}


//AJAX CLEAR

if (thisElement.style.display === "block") 
{
  thisElement.style.display = "none";
} else 
{
  thisElement.style.display = "block";
}

}

function initTinyMCE() {

	 /* tinymce.init({
        selector: '.reason_txtarea',  // Apply TinyMCE to all textareas with class "editor"
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
        forced_root_block: 'div',
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
        ],
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i'
        ]
    }); */
	setTimeout(() => {
	tinymce.remove('.reason_txtarea'); // clear broken instances
	tinymce.init({
		selector: '.reason_txtarea',  // Target the textarea inside #editorDiv
		paste_as_text: true,
		paste_remove_styles: true,
		//content_style: "{ margin: 0; }",
		//selector: 'textarea',  // Target the textarea inside #editorDiv
		height: 450,  // Set height of the editor area
		menubar: false,  // Disable menu bar
		plugins: ['lists link image textcolor colorpicker textpattern'],  // Include plugins you need
		toolbar: 'undo redo | styleselect | bold italic | fontsizeselect | bullist numlist | forecolor backcolor | alignleft aligncenter alignright alignjustify fontselect',  // Define toolbar buttons
		statusbar: false,  // Hide status bar at the bottom
		fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
		setup: function (editor) {
		  // Sync content with textarea on change/blur
		  editor.on('change', function () {
			editor.save();
		  });
		}
	});  
	}, 0); 
}


function validateTinyMCE() {
    const content = tinymce.get('reason_txtarea').getContent({ format: 'text' }).trim();
    if (content === '') {
      alert('Please fill out the field.');
      return false; // Prevent form submission
    }
    return true;
  }

// -------------------- validating decision with 'NoBid Criteria' & Reason for NObid--------------------//
	function validate(id){
		var decisionValue = document.getElementById('decision_edit'+id).value;
		var criteriaValue = document.getElementById('criteriatype_edit'+id).value;
		var no_bid_reason = document.getElementById('reason'+id).value;

		if(decisionValue == 'No Bid' && no_bid_reason == ''){
			alert('Please provide reason for nobid.');
			return false;
		}
		if(decisionValue == 'No Bid' && criteriaValue == ''){
			alert('Please select NoBid Criteria.');
			return false;
		}
		else{
			return true;
		}
	}
// --------------- validating decision with 'NoBid Criteria' & Reason for NObid Ends Here.---------------//

function select_all_boxes(){ 
//alert("All");
var ele=document.getElementsByName('vehicle[]');  
for(var i=0; i<ele.length; i++)
{  
   if(ele[i].type=='checkbox')
   {  
		ele[i].checked=true;  
   }
}  
} 
function select_no_boxes(){ 
//alert("None");

var ele=document.getElementsByName('vehicle[]');  
for(var i=0; i<ele.length; i++)
{  
   if(ele[i].type=='checkbox')
   {  
		ele[i].checked=false;  
   }
}
}
function select_dec_all_boxes(){ 
//alert("All");
var ele=document.getElementsByName('decision[]');  
for(var i=0; i<ele.length; i++)
{  
   if(ele[i].type=='checkbox')
   {  
		ele[i].checked=true;  
   }
}  
} 
function select_dec_no_boxes(){ 
//alert("None");
var ele=document.getElementsByName('decision[]');  
for(var i=0; i<ele.length; i++)
{  
   if(ele[i].type=='checkbox')
   {  
		ele[i].checked=false;  
   }
}
}
function select_bidtype_all_boxes(){ 
//alert("All");
var ele=document.getElementsByName('bidtype[]');  
for(var i=0; i<ele.length; i++)
{  
   if(ele[i].type=='checkbox')
   {  
		ele[i].checked=true;  
   }
}  
}
function select_bidtype_no_boxes(){ 
//alert("All");
var ele=document.getElementsByName('bidtype[]');  
for(var i=0; i<ele.length; i++)
{  
   if(ele[i].type=='checkbox')
   {  
		ele[i].checked=false;  
   }
}  
}

function select_bidcategory_all_boxes(){ 
//alert("All");
var ele=document.getElementsByName('bidcategory[]');  
for(var i=0; i<ele.length; i++)
{  
   if(ele[i].type=='checkbox')
   {  
		ele[i].checked=true;  
   }
}  
}
function select_bidcategory_no_boxes(){ 
//alert("All");
var ele=document.getElementsByName('bidcategory[]');  
for(var i=0; i<ele.length; i++)
{  
   if(ele[i].type=='checkbox')
   {  
		ele[i].checked=false;  
   }
}  
}
</script>

<script>
var coll = document.getElementsByClassName("collapsiblehistory");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("activehistory");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>

<script>
  function toggleHistory(element) {
    var content = element.querySelector('.collapsible-content-history');
    content.classList.toggle('active-history');
  }
</script>
<script>
  function toggleDocuments(element) {
    var content = element.querySelector('.collapsible-content-documents');
    content.classList.toggle('active-documents');
  }
</script>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}

var expanded = false;
function showCheckboxes(opp_id) { 
  var checkboxes = document.getElementById("selectMultipleManagers" + opp_id);
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
} 
</script>
<script type="text/javascript" src="<?php echo $baseurl; ?>/tinymce/tinymce.min.js"></script>

<!--  ------------------- javascript code for sorting columns starts here.   -------------------------- -->
<script>
let sortColumn = "";
let sortDir = 1;

document.querySelectorAll(".sortable").forEach(header => {

  header.addEventListener("click", function () {
    let col = this.dataset.col;

    // reset all headers
    document.querySelectorAll(".sortable").forEach(h => {
      h.classList.remove("asc", "desc");
    });

    // toggle direction
    if (sortColumn === col) {
      sortDir *= -1;
    } else {
      sortDir = 1;
      sortColumn = col;
    }

    this.classList.add(sortDir === 1 ? "asc" : "desc");

    let rows = Array.from(document.querySelectorAll(".div-table.row"));

    rows.sort((a, b) => {
      let x = a.dataset[col];
      let y = b.dataset[col];

      if (!isNaN(x)) {
        return sortDir * (parseFloat(x) - parseFloat(y));
      }
      return sortDir * x.localeCompare(y);
    });

    let body = document.getElementById("tableBody");
    body.innerHTML = "";
    rows.forEach(r => body.appendChild(r));
  });

});
</script>

<script>
let sortColumn1 = "";
let sortDir1 = 1;

document.querySelectorAll(".sortable1").forEach(header => {

  header.addEventListener("click", function () {
    let col = this.dataset.col;

    // reset all headers
    document.querySelectorAll(".sortable1").forEach(h => {
      h.classList.remove("asc", "desc");
    });

    // toggle direction
    if (sortColumn1 === col) {
      sortDir1 *= -1;
    } else {
      sortDir1 = 1;
      sortColumn1 = col;
    }

    this.classList.add(sortDir1 === 1 ? "asc" : "desc");

    let rows = Array.from(document.querySelectorAll(".div-table1.row"));

    rows.sort((a, b) => {
      let x = a.dataset[col];
      let y = b.dataset[col];

      if (!isNaN(x)) {
        return sortDir1 * (parseFloat(x) - parseFloat(y));
      }
      return sortDir1 * x.localeCompare(y);
    });

    let body = document.getElementById("tableBody1");
    body.innerHTML = "";
    rows.forEach(r => body.appendChild(r));
  });

});
</script>

<script>
let sortColumn2 = "";
let sortDir2 = 1;

document.querySelectorAll(".sortable2").forEach(header => {

  header.addEventListener("click", function () {
    let col = this.dataset.col;

    // reset all headers
    document.querySelectorAll(".sortable2").forEach(h => {
      h.classList.remove("asc", "desc");
    });

    // toggle direction
    if (sortColumn2 === col) {
      sortDir2 *= -1;
    } else {
      sortDir2 = 1;
      sortColumn2 = col;
    }

    this.classList.add(sortDir2 === 1 ? "asc" : "desc");

    let rows = Array.from(document.querySelectorAll(".div-table2.row"));

    rows.sort((a, b) => {
      let x = a.dataset[col];
      let y = b.dataset[col];

      if (!isNaN(x)) {
        return sortDir2 * (parseFloat(x) - parseFloat(y));
      }
      return sortDir2 * x.localeCompare(y);
    });

    let body = document.getElementById("tableBody2");
    body.innerHTML = "";
    rows.forEach(r => body.appendChild(r));
  });

});
</script>

<script>
let sortColumn3 = "";
let sortDir3 = 1;

document.querySelectorAll(".sortable3").forEach(header => {

  header.addEventListener("click", function () {
    let col = this.dataset.col;

    // reset all headers
    document.querySelectorAll(".sortable3").forEach(h => {
      h.classList.remove("asc", "desc");
    });

    // toggle direction
    if (sortColumn3 === col) {
      sortDir3 *= -1;
    } else {
      sortDir3 = 1;
      sortColumn3 = col;
    }

    this.classList.add(sortDir3 === 1 ? "asc" : "desc");

    let rows = Array.from(document.querySelectorAll(".div-table3.row"));

    rows.sort((a, b) => {
      let x = a.dataset[col];
      let y = b.dataset[col];

      if (!isNaN(x)) {
        return sortDir3 * (parseFloat(x) - parseFloat(y));
      }
      return sortDir3 * x.localeCompare(y);
    });

    let body = document.getElementById("tableBody3");
    body.innerHTML = "";
    rows.forEach(r => body.appendChild(r));
  });

});
</script>

<script>
let sortColumn4 = "";
let sortDir4 = 1;

document.querySelectorAll(".sortable4").forEach(header => {

  header.addEventListener("click", function () {
    let col = this.dataset.col;

    // reset all headers
    document.querySelectorAll(".sortable4").forEach(h => {
      h.classList.remove("asc", "desc");
    });

    // toggle direction
    if (sortColumn4 === col) {
      sortDir4 *= -1;
    } else {
      sortDir4 = 1;
      sortColumn4 = col;
    }

    this.classList.add(sortDir4 === 1 ? "asc" : "desc");

    let rows = Array.from(document.querySelectorAll(".div-table4.row"));

    rows.sort((a, b) => {
      let x = a.dataset[col];
      let y = b.dataset[col];

      if (!isNaN(x)) {
        return sortDir4 * (parseFloat(x) - parseFloat(y));
      }
      return sortDir4 * x.localeCompare(y);
    });

    let body = document.getElementById("tableBody4");
    body.innerHTML = "";
    rows.forEach(r => body.appendChild(r));
  });

});
</script>

<script>
let sortColumn5 = "";
let sortDir5 = 1;

document.querySelectorAll(".sortable5").forEach(header => {

  header.addEventListener("click", function () {
    let col = this.dataset.col;

    // reset all headers
    document.querySelectorAll(".sortable5").forEach(h => {
      h.classList.remove("asc", "desc");
    });

    // toggle direction
    if (sortColumn5 === col) {
      sortDir5 *= -1;
    } else {
      sortDir5 = 1;
      sortColumn5 = col;
    }

    this.classList.add(sortDir5 === 1 ? "asc" : "desc");

    let rows = Array.from(document.querySelectorAll(".div-table5.row"));

    rows.sort((a, b) => {
      let x = a.dataset[col];
      let y = b.dataset[col];

      if (!isNaN(x)) {
        return sortDir5 * (parseFloat(x) - parseFloat(y));
      }
      return sortDir5 * x.localeCompare(y);
    });

    let body = document.getElementById("tableBody5");
    body.innerHTML = "";
    rows.forEach(r => body.appendChild(r));
  });

});
</script>

<script>
let sortColumn6 = "";
let sortDir6 = 1;

document.querySelectorAll(".sortable6").forEach(header => {

  header.addEventListener("click", function () {
    let col = this.dataset.col;

    // reset all headers
    document.querySelectorAll(".sortable6").forEach(h => {
      h.classList.remove("asc", "desc");
    });

    // toggle direction
    if (sortColumn6 === col) {
      sortDir6 *= -1;
    } else {
      sortDir6 = 1;
      sortColumn6 = col;
    }

    this.classList.add(sortDir6 === 1 ? "asc" : "desc");

    let rows = Array.from(document.querySelectorAll(".div-table6.row"));

    rows.sort((a, b) => {
      let x = a.dataset[col];
      let y = b.dataset[col];

      if (!isNaN(x)) {
        return sortDir6 * (parseFloat(x) - parseFloat(y));
      }
      return sortDir6 * x.localeCompare(y);
    });
    let body = document.getElementById("tableBody6");
    body.innerHTML = "";
    rows.forEach(r => body.appendChild(r));
  });
});
</script>
<!------------------------- javascript code for sorting columns ends here.   ---------------------------->
<script>
	function getMCValues(){
		var selectedValue = document.getElementById("groupBy").value;
		var xhr = new XMLHttpRequest();
			xhr.open("POST", "ajax_get_master_contracts.php", true);
			xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4 && xhr.status === 200) {
					document.getElementById('dynamic_mc_values').innerHTML = xhr.responseText;
				}
			};
		var data = JSON.stringify({
		  name: selectedValue
		});
		xhr.send(data);
	}
</script>

<?php if($_GET['groupBy'] != '') { ?>
<script>
	var newValue = "<?php echo $_GET['groupBy']; ?>";
	$('#groupBy').val(newValue).trigger('change');
</script>
<?php } ?>

<script>
window.name = "TAB_TWO";
function switchToTab1() {
    var tab1 = window.open("https://ardentinc.com/fedbids-staging/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review", "TAB_ONE");

    if (tab1 && !tab1.closed) {
        tab1.focus();
    }
}
</script>
<script>
	$(document).ready(function() {
		$("#agendaItemCount").html("(<?php echo $agenda_count;?>)");
		$("#cpwItemCount").html("(<?php echo $cpw_count;?>)");
		$("#rfpItemCount").html("(<?php echo $rfp_count;?>)");
		$("#amItemCount").html("(<?php echo $am_count;?>)");
		$("#urItemCount").html("(<?php echo $ur_count;?>)");
		$("#dpItemCount").html("(<?php echo $dp_count;?>)");
	});
</script>
</body>
</html>