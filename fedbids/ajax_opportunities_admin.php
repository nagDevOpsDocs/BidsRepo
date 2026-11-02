<?php
$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;
////include($_SERVER['DOCUMENT_ROOT'] . "include/it_loader.php");

print("<style>
body, input, table, td, select, textarea {font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}
.samewidth { width:240px; font-weight:700;}
.td-left { /*background: #f9f9f9;*/ background-color:#fff; /*background:none;*/ border:none; /*border: 1px #dedede solid;*/ padding: 5px;}
.select-styled { padding: 4px 5px; /*font-weight: 500;*/ border: 1px solid #cbcbcb; width:200px; font-family:'Century Gothic', 'Segoe UI'; font-size:12px;}
.font-size { font-weight:500; background-color:#f6f6f6; 
}
</style>");
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

//$which_update_id=1542; //$_GET['which_update_id'];
//$which_update_id=1542; //$_GET['which_update_id'];

if($_GET['ot1']!='') { $ot1 = "OR response LIKE '%".$_GET['ot1']."%'"; } else { $ot1 = ''; }
if($_GET['ot2']!='') { $ot2 = "OR response LIKE '%".$_GET['ot2']."%'"; } else { $ot2 = ''; }
if($_GET['ot3']!='') { $ot3 = "OR response LIKE '%".$_GET['ot3']."%'"; } else { $ot3 = ''; }
if($_GET['ot4']!='') { $ot4 = "OR response LIKE '%".$_GET['ot4']."%'"; } else { $ot4 = ''; }
if($_GET['ot5']!='') { $ot5 = "OR response LIKE '%".$_GET['ot5']."%' "; } else { $ot5 = ' '; }

$search_this= "";
if (!empty($_GET['search'])) { $search_this = $_GET['search']; $_SESSION["search"] = "?search=" . $search_this; $search_term=strtoupper($_GET['search']); } else { $_SESSION["search"] = ""; $search_term="";}
if (!empty($_GET['status'])) { $status =  " STATUS='" . $_GET['status'] . "' AND "; $_SESSION["status"] = "?status=" . $status; } else { $_SESSION["status"] = ""; $status="";}

//DATE(released) >= '2022-01-01' AND DATE(released) <= '2022-04-01'
//if (!empty($_GET['range_from'])) { $range_from_qy = " AND DATE(released) >= '2022-01-01' "; } else { $range_from_qy = ""; }

	//$search_suffix = "?opportunity_id>0";
	//$content_source = "ajax_opportunities_admin.php";
	$qy_builder = "";
	
	//if (!empty($_GET['which_update_id'])) { $search_suffix .= "&which_update_id=". $_GET['which_update_id'];}
	//if (!empty($_GET['search'])) { $search_suffix .= "&search=". $_GET['search'];}
	if (!empty($_GET['range_from'])) { 
	$range_from_date = $_GET['range_from'];
	$range_from_date_in = date("Y-m-d", strtotime($_GET['range_from']));
	$range_from_date_formatted = DateTime::createFromFormat("m/d/Y" , $range_from_date_in);
	//echo ("OK " . $range_from_date_formatted->format('Y-m-d'));
	//$range_from_date_formatted->format('Y-m-d');
	//print ("left " . $range_from_date_in . " .... " . $range_from_date_formatted . "<BR>");
	$qy_builder .= " AND DATE(released) >= '" . $range_from_date_in . "'"; 
	}
	if (!empty($_GET['range_to'])) { 
	$range_to_date = $_GET['range_to'];
	$range_to_date_in = date("Y-m-d", strtotime($_GET['range_to']));
	$range_to_date_formatted = DateTime::createFromFormat("m/d/Y" , $range_to_date_in);
	
	$qy_builder .= " AND DATE(released) <= '" . $range_to_date_in . "'"; 
	}
	
	/*$morefilters = "";
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
	if (isset($_GET['veh7'])) {  $morefilters .= " AND ((contract_vehicle LIKE '%STARS%') OR (contract_vehicle_two LIKE '%STARS%')) "; }*/
	
	if (isset($_SESSION["morefilters"])) { $morefilters=$_SESSION["morefilters"]; } else { $morefilters = ""; }
	//if (isset($_GET['veh1'])) { $morefilters="hello123"; }
	
	/*$morefilters = " AND response LIKE '%draft rfp%' ";*/
	//$morefilters = " AND response LIKE '%draft rfp%' ";
	//print("GRRRR");

if (!empty($_GET['cv1']) && ($_GET['cv1']==1)) { $cv1 = 1; } else { $cv1 = 0; }
if (!empty($_GET['cv2']) && ($_GET['cv2']==1)) { $cv2 = 1; } else { $cv2 = 0; }

if (!empty($_GET['action'])) { $action_pass=$_GET['action']; $autostart = "autostart();"; } else { $action_pass=1596; $autostart = "";}

$search_area="
<div style='z-index:3; /*background-color:red;*/ width:50%; margin-left:25%; position:fixed; text-align:center; top:9px;'><form action='' method='get' enctype='multipart/form-data' style='margin:0px; padding:0px;'>
		<input name='search' type='text' value='$search_this' style='font-size:13px;width: 200px; padding-left:8px; font-weight:700;'><select name='search_type' id='search_type' style='padding:2px 5px; font-weight:700;'>
			<option value='opportunities'>Opportunities</option>
			<option value='companies'>Companies</option>
			<option value='contacts'>Contacts</option>
		  </select><button type='submit'><i class='fa fa-search'></i></button>
  		<div onClick='ajaxshowfilter();' style='background-color: #efefef; display: inline-block; padding: 3px 8px; font-weight:700; margin-left:10px;'>Update Opportunity</div>
		
    </form></div>";
	
//print ("Hello " . $profile_first_name);
// if ($mysqli_link) { print("Connected"); }
/*exit();*/
//SELECT app_label, app_secured, label_lines, app_link, app_icon1 FROM it_apps
//$ok = "06/18/2022";
//$entry_date1->format('m/d/Y');
//$entry_date_src=strtotime('Y-m-d h:i:sa', $ok);

$entry_date2 = date("Y-m-d"); //Y-m-d h:i:sa
$entry_date1 = date('Y-m-d', strtotime($entry_date2 . ' -1 month'));

$filterarea = "";
//include("includes/filter_area.php");


$app_builder = "";
$count_results = 0;
$tr_color = "background-color:#31335f;"; /* #98e0e0 */
$tr_font_color = "color:#fff; text-align:center;";
$tr_color .= $tr_font_color;

/*$header_part = "<table class='' width='100%' align='center' cellspacing='0' cellpadding='0' style=''>";
		$header_style = "background-color:#fff; padding-top:6px;padding-bottom:7px; border-bottom:1px solid #a4a4a4;";
		$td_entry ="<tr>";  
		$td_entry .="<td class='light_grey_fade' width='33%' style='$header_style; text-align:left;'><strong>Opportunity</strong></td>";
		$td_entry .="<td class='light_grey_fade' width='34%' style='$header_style; text-align:left;'><strong>Details</strong></td>";
		$td_entry .="<td class='light_grey_fade' width='33%' style='$header_style; text-align:left;'><strong>Assignments</strong></td>";
		$td_entry .="</tr>";
$header_part .= $td_entry;*/

$header_part = "";

$table_content = "";
$extra_table_content = "";

$last_company_name = "";
$company_builder = "";
$co_website_array = "";

$opportunities_found = 0;
$gov_contacts_found = 0;
$company_info_found = 0;
$company_contacts_found = 0;

//$mysqli_link = mysqli_connect('portal.ardentinc.com',$db_user, $db_password,'bidsnew');

$query_incumbents = "SELECT count(*) FROM incumbents_test WHERE (incumbent_name LIKE '%$search_this%' OR website LIKE '%$search_this%' OR contact_parts LIKE '%$search_this%') AND opportunity_id IS NOT NULL LIMIT 50";

$result = mysqli_query($mysqli_link, $query_incumbents);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$incumbents_count = $row[0];
	}
	
$query_incumbents = "SELECT incumbent_name, website, contact_parts, reference_link, incumbent_status, opportunity_id, incumbent_id FROM incumbents_test WHERE (incumbent_name LIKE '%$search_this%' OR website LIKE '%$search_this%' OR contact_parts LIKE '%$search_this%') AND opportunity_id IS NOT NULL LIMIT 50";

$db_incumbent_results = "";
$result = mysqli_query($mysqli_link, $query_incumbents);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$db_incumbent_name = $row[0];
	$db_incumbent_name_find = str_ireplace($search_this, '<span style="background-color:yellow;">'.strtoupper($search_this).'</span>', $db_incumbent_name);
	$db_incumbent_website = $row[1];
	$db_incumbent_website_find = str_ireplace($search_this, '<span style="background-color:yellow;">'.strtoupper($search_this).'</span>', $db_incumbent_website);
	$db_contact_parts = $row[2];
	$db_contact_parts_find = str_ireplace($search_this, '<span style="background-color:yellow;">'.strtoupper($search_this).'</span>', $db_contact_parts);
	$db_reference_link = $row[3];
	$db_incumbent_status = $row[4];
	$db_opportunity_id = $row[5];
	$db_incumbent_id = $row[6];
	
	//if (strlen($db_incumbent_website)>2) {
			//FOUND REMOVE www.
			if (strlen($db_incumbent_website)<3) { $incumbent_website_ready = ""; } else {
			$db_incumbent_website = str_replace("www.","",$db_incumbent_website);
			if (((strpos($db_incumbent_website, 'http://')!== false)) || ((strpos($db_incumbent_website, 'https://')!== false))) { /*print ('http found');*/ } 
			else { $db_incumbent_website = "https://" . $db_incumbent_website; }
			
			$incumbent_website_ready = "<a title='" . $db_incumbent_website . "' style='color:#2f40a2;' href='" . $db_incumbent_website . "' target='_blank'>$db_incumbent_website</a>";
			}
			//
			if (strlen($db_reference_link)<3) { $incumbent_reference_ready = ""; } else {
			$db_reference_link = str_replace("www.","",$db_reference_link);
			if (((strpos($db_reference_link, 'http://')!== false)) || ((strpos($db_reference_link, 'https://')!== false))) { /*print ('http found');*/ } 
			else { $db_reference_link = "https://" . $db_reference_link; }
			
			$incumbent_reference_ready = "<a title='" . $db_reference_link . "' style='color:#2f40a2;' href='" . $db_reference_link . "' target='_blank'>$db_reference_link</a>";
			}
			
			//$incumbent_website_ready = "123"; //$db_incumbent_website;
			//<img style='vertical-align: middle; height:16px; width:16px; margin-left:20px; position:relative; top:-1px;' src='hyperlink.jpg' alt='$incumbent_name'>
				//$incumbent_website_ready = "12345 " . $db_incumbent_website;								
		//}
	
	
	$db_incumbent_results .= "
	<div style='border:1px solid #c1c1c1; margin-bottom:4px; width:95%; margin-left:2%;font-size:13px; font-weight:700; padding-left:5px; padding-right:5px; padding-top:5px; padding-bottom:7px; color:#141414; display:inline-block;' class=''><a target='_top' style='color:#36374c;' href='$baseurl/addrole_edit_incumbent.php?which_incumbent_id=$db_incumbent_id'><strong>$db_incumbent_name_find</strong></a><BR>
		<div style='color:#141414; font-weight:500;display:inline-block; width:100%;margin-top:14px;'>
			<div style='display:inline-block; width:150px;'>Website </div>
			<div style='display:inline-block; width:50%; text-align:left;'>$incumbent_website_ready</div>
		</div>
		
		<div style='color:#141414; font-weight:500;display:inline-block; width:100%;'>
			<div style='display:inline-block; width:150px;'>Reference Link </div>
			<div style='display:inline-block; width:50%; text-align:left;'>$incumbent_reference_ready</div>
		</div>
		<div style='color:#141414; font-weight:500;display:inline-block; width:100%;'>
			<div style='display:inline-block; width:150px;'>Status </div>
			<div style='display:inline-block; width:50%; text-align:left;'>$db_incumbent_status</div>
		</div>
	</div>
	"; 
	}


/*$query = "SELECT DATE(entrydate), opportunity_type, DATE(duedate), opportunity_title, agency, url, category, opportunity_id  FROM temp_opportunities   
WHERE opportunity_type LIKE '%$search_this%' 
OR opportunity_title LIKE '%$search_this%' 
OR agency LIKE '%$search_this%' 
OR url LIKE '%$search_this%'  
ORDER BY entrydate DESC LIMIT 200";

$query = "SELECT DATE(entrydate), state, DATE(duedate), projecttitle, dept, url, category, id, mastercontracts, status, bidnumber, source FROM atom  
WHERE state LIKE '%$search_this%' 
OR projecttitle LIKE '%$search_this%' 
OR dept LIKE '%$search_this%' 
OR url LIKE '%$search_this%' 
OR mastercontracts LIKE '%$search_this%' 
OR status LIKE '%$search_this%' 
OR bidnumber LIKE '%$search_this%' 
OR source LIKE '%$search_this%'
ORDER BY entrydate DESC LIMIT 200";*/

/*SELECT id,duedate,state,bidnumber,description,
      projecttitle,STATUS,nonsubdetails,primaryskills,
      source,mastercontracts,Dept,submissiondate,
      category,entrydate,created_by,bidtype_id,
      projectcost,incumbent,inccontract,questionsduetime,naics,setaside,
      url FROM bp_transfer ORDER BY id DESC LIMIT 50*/
$is_oasis_sb ="";
if (($cv1>0) && ($cv2==0)) { $is_oasis_sb = ""; $is_oasis_sb = " AND contract_vehicle = 'OASIS SB' "; } else { /*$is_oasis_sb ="";*/ }
if (($cv1==0) && ($cv2>0)) { $is_oasis_sb = ""; $is_oasis_sb = " AND contract_vehicle = 'OASIS 8(a)' "; } else { /*$is_oasis_a ="";*/ }

if (!empty($_GET['which_update_id'])) { $which_update_id = $_GET['which_update_id']; $specific_id=" AND opportunity_id='$which_update_id' "; } else { $specific_id=""; } 
//else { $_SESSION["search"] = ""; $content_source = "ajax_opportunities_admin.php";}
  
/*$query = "SELECT excel_test.opportunity_id, bidopp, response, requestor, excel_test.title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, contract_vehicle_two, incumbents.incumbent_name FROM excel_test   
LEFT JOIN incumbents
ON incumbents.opportunity_id = excel_test.opportunity_id 
WHERE $status (excel_test.title LIKE '%$search_this%' 
OR vehicle_one LIKE '%$search_this%' 
OR vehicle_two LIKE '%$search_this%' 
OR excel_test.opportunity_id LIKE '%$search_this%' 
OR agency LIKE '%$search_this%' 
OR requestor LIKE '%$search_this%' 
OR incumbents.incumbent_name LIKE '%$search_this%'  
) $morefilters $is_oasis_sb $specific_id $qy_builder 
GROUP BY excel_test.opportunity_id 
ORDER BY excel_test.opportunity_id DESC LIMIT 5000"; */

$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, contract_vehicle_two, last_update, contractveh_table FROM excel_test   
WHERE title LIKE '%$search_this%' 
OR vehicle_one LIKE '%$search_this%' 
OR vehicle_two LIKE '%$search_this%' 
OR contractveh_table LIKE '%$search_this%' $ot1 $ot2 $ot3 $ot4 $ot5   
OR contractveh_table LIKE '%$search_this%'  
OR agency LIKE '%$search_this%' order by opportunity_id DESC LIMIT 100";
// ORDER BY excel_test.opportunity_id ASC LIMIT 5000";
//  order by released ASC
//print $query;

$query_total = "SELECT count(*) FROM excel_test   
WHERE $status (title LIKE '%$search_this%' 
OR vehicle_one LIKE '%$search_this%' 
OR vehicle_two LIKE '%$search_this%' 
OR contractveh_table LIKE '%$search_this%' 
OR opportunity_id LIKE '%$search_this%' 
OR agency LIKE '%$search_this%' 
OR requestor LIKE '%$search_this%' 
) $morefilters $is_oasis_sb $specific_id $qy_builder
ORDER BY opportunity_id";

//if ($_GET[''])	  
	//print $query; // . "HEY";
//print ("CV1" . $cv1);

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
	$opp_opportunity_id_find = str_ireplace($search_this, '<span style="background-color:yellow;">'.strtoupper($search_this).'</span>', $opp_opportunity_id); //#8ad7ff;
	$opp_bidopp = $row[1];
	$opp_response = $row[2]; //"<option value='" . $row[2] . "'>" . $row[2] . "</option>"; //strtoupper($row[13]);= $row[2];
	$opp_requestor_db = $row[3];
	$opp_requestor = str_ireplace($search_this, '<span style="background-color:yellow;">'.strtoupper($search_this).'</span>', $opp_requestor_db); //#8ad7ff;
	$opp_title_db = str_replace("<BR>","",$row[4]);
	$opp_title = str_ireplace($search_this, '<span style="background-color:yellow;">'.strtoupper($search_this).'</span>', $opp_title_db);
	$opp_due = strtoupper($row[5]); //substr(strtoupper($row[5]),20);
	
	$release_date_db = $row[6];
	$phpdate_released = strtotime( $release_date_db );
	$opp_released = date( 'm/d/Y', $phpdate_released );
	//$opp_released = "111"; //date( 'Y-m-d', $row[6] ); //strtoupper($row[6]); //substr(strtoupper($row[6]),20);
	$opp_pop = $row[7];
	$opp_synopsis = str_replace("•<BR>","• ",$row[8]); //substr(strtoupper($row[8]),20);
	$opp_proposal = $row[9]; //substr(strtoupper($row[9]),20);
	$opp_pricing = $row[10]; //substr(strtoupper($row[10]),20);
	$opp_recruiting_in = $row[11]; //"Source"; //strtoupper($row[11]);
	
	//$a = 'How are you?';

		if (strpos($opp_recruiting_in, '|||') !== false) {
			//echo 'true';
			// 1|||A|||(KP)|||Confidential|||2|||B|||(KP)|||Secret|||3|||C||||||Top Secret|||
				//​$ok = explode("|||",$opp_recruiting);
				$ok = explode("|||",$opp_recruiting_in);
				
				$i = 0;
				$inloop = 0;
				$opp_recruiting = "";
				$temp_job = "";

				while($i < count($ok))
				{
					$inloop++;
					//if (($inloop==1) && ((count($ok)-$i)>1)) { $opp_recruiting .= "START";  } 
					if (($inloop==1) && ((count($ok)-$i)>1)) { $opp_recruiting .= "<DIV style='background-color:#fff; border-top:1px solid #d1d1d3; color:#3c4db0;'>";  }
					if ($inloop==1) { $opp_recruiting .= "<div style='width:40px; display:inline-block; vertical-align:top;'>" . $ok[$i] . " </div>"; }//."-" . $i . "-";
					if ($inloop==2) { $opp_recruiting .= "<div style='width:150px; display:inline-block; vertical-align:top;'>" . $ok[$i] . " </div>"; }//."-" . $i . "-";
					if ($inloop==3) { $temp_job = $ok[$i];/*$opp_recruiting .= "<div style='width:110px; display:inline-block; vertical-align:top;'>" . $ok[$i] . "</div>";*/ }//."-" . $i . "-";
					if ($inloop==4) { $opp_recruiting .= "<div style='width:40px; display:inline-block; vertical-align:top;'>" . $ok[$i] . "</div>"; }//."-" . $i . "-";
					if ($inloop==5) { $opp_recruiting .= "<div style='width:80px; display:inline-block; vertical-align:top;'>" . $ok[$i] . "</div>"; }//."-" . $i . "-";
					//if ($inloop==4) { $opp_recruiting .= "***<BR>"; $inloop=0; } 
					if ($inloop==5) { $opp_recruiting .= "<div style='padding-left:40px; font-weight:700;'>$temp_job</div></DIV>"; $inloop=0; }
					
					$i++;
				}
				
				//$opp_recruiting = $ok[0];
				/*for ($x = 0; $x <= 3; $x++) {
				  echo "The number is: $x <br>";
				}*/
				
		} else { $opp_recruiting = $opp_recruiting_in; }
	
	$opp_gaps = strtoupper($row[12]);
	$opp_decision = "<option hidden selected value='" . $row[13] . "'>" . $row[13] . "</option>"; //strtoupper($row[13]);
	
	$pop_parts = explode("|||",$row[14]);
	//$contract_pop = str_replace("|||",", ",$row[14]); //$contract_pop = $row[14];
	//$contract_pop = str_replace("!!!",", ",$contract_pop); //$contract_pop = $row[14];
	
	/*foreach($pop_parts as $i =>$key) {
	$contract_pop = $i.' '.$key;
	}*/
	/*if (count($pop_parts)>1) {
	$contract_pop = $pop_parts[0] . "<BR>" . $pop_parts[1] . ", " . $pop_parts[2];
	} else { $contract_pop = $row[14]; }*/
	$contract_pop_address = "";
	$pop_parts = explode("|||",$row[14]);
	$contract_pop_address =  $pop_parts[0];
	//if (count($pop_parts)==1) { $contract_pop_city = $pop_parts[1]; } else { $contract_pop_city = ""; }
	if (strpos($row[14], '|||')!== false){ $contract_pop_city = $pop_parts[1]; $contract_pop_state = $pop_parts[2]; } else { $contract_pop_state = ""; $contract_pop_city = ""; }
	$contract_pop = $contract_pop_address . "<BR>" . $contract_pop_city . ", " . $contract_pop_state;
	//$contract_pop = "-Address-" . $pop_parts[0];
	
	$contract_period = strtoupper(str_replace("Period: ","",$row[15])); 
	
	$vehicle_one = $row[16];
	$vehicle_one_find = str_ireplace($search_this, '<span style="background-color:yellow;">'.strtoupper($search_this).'</span>', $vehicle_one);
	$vehicle_two = $row[17];
	$vehicle_two_find = str_ireplace($search_this, '<span style="background-color:yellow;">'.strtoupper($search_this).'</span>', $vehicle_two);
	
	$last_update = $row[18];
	
	$proposal_ida = explode(" ", $vehicle_one); // . " " . $vehicle_two;
	$proposal_idb = explode(" ", $vehicle_two);
	$proposal_id_a = $proposal_ida[0];
	$proposal_id_b = $proposal_idb[0];
	
	//START
	$incumbent_container = "";
	$more_incumbents = "";
	$incumbent_counter = 0;
	// OR (opp LIKE '%" . $proposal_id_b . "%') 
	$extra_searcha = "";
	$extra_searchb = "";
	//OR (incumbent_name LIKE '%$search_this%') $extra_searcha
	//OR (opp LIKE '%" . $proposal_id_a . "%')
	//$extra_searcha $extra_searchb     
	if (strlen($proposal_id_a)>2) { $extra_searcha = " OR (opp LIKE '%" . $proposal_id_a . "%') "; }
	if (strlen($proposal_id_b)>2) { $extra_searchb = " OR (opp LIKE '%" . $proposal_id_b . "%') "; }
	$find_incumbents = "SELECT incumbent_id, incumbent_name, opp, incumbent_contract_taskorder, reference_link, award_amount, spend_to_date, start_date, completion_date, ultimate_completion_date, website, current_pools, oasis_pools, contact_info, in_forecast, incumbent_contract_taskorder, incumbent_status FROM incumbents_test WHERE (opportunity_id=$opp_opportunity_id)  ORDER BY incumbent_id ASC";
	//print $find_incumbents; 
	$incumbent_name = "";
	$resultb = mysqli_query($mysqli_link, $find_incumbents);
	while($rowb = mysqli_fetch_array($resultb, MYSQLI_NUM))
		{
		$incumbent_id = $rowb[0];
		$incumbent_name = strtoupper(str_replace("<BR>","",$rowb[1]));
		//$incumbent_name = strtoupper(str_replace("(","<BR>(",$incumbent_name_a));
		$incumbent_opp = $rowb[2];
		$incumbent_taskorder = $rowb[3];
		$incumbent_ref_link = $rowb[4];
		$incumbent_award_amount = $rowb[5];
		$incumbent_spend_to_date = $rowb[6];
		$incumbent_start_date = $rowb[7];
		$incumbent_completion = $rowb[8];
		$incumbent_ultimate = $rowb[9];
		$incumbent_website_url = $rowb[10];
		$current_pools = $rowb[11];
		$oasis_pools = $rowb[12];
		$contact_info = str_replace(",","<BR>",$rowb[13]);
		$contact_info = str_replace(";","<BR>",$contact_info);
		//$contact_info = $rowb[13];
		$in_forecast = $rowb[14];
		$incumbent_contract_taskorder = $rowb[15];
		$incumbent_status = $rowb[16];
		
		$incumbent_counter++;
		
		//if (strval($incumbent_award_amount)>2) { $award_amount_formatted = number_format($incumbent_award_amount,0); } else { $award_amount_formatted=""; }
		//$award_amount_formatted = money_format('$%i', $incumbent_award_amount); 
		//$award_amount_formatted = ""; number_format($incumbent_award_amount,0);
		
		
		/*if ((strpos($incumbent_website_url, 'http')!== false) && (strlen($incumbent_website_url)>2)) {
			$incumbent_website_url = str_replace("www.","",$incumbent_website_url);
		} else {
			$incumbent_website_url = "https://" . $incumbent_website_url;
			$incumbent_website_url = str_replace("www.","",$incumbent_website_url);
		}*/
		
		
		//$incumbent_website = "vertical-align: middle; height:16px; width:16px; margin-left:20px; position:relative; top:-1px;";
		
			//$full_ref_link = "<a title='" . $incumbent_ref_link . "' style='color:#3c4db0;' href='" . $incumbent_ref_link . "' target='_blank'>GovWin</a>";
		//$incumbent_container = "Incumbent " . $incumbent_name . "<BR>" . "Award Amount: " . $incumbent_award_amount; 
		/*<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Spend to Date</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_spend_to_date</div><BR>*/
		
		if ($incumbent_counter==1) {
		$incumbent_container = "
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100%);vertical-align:top; padding:8px 12px; overflow:auto; overflow-wrap:break-word; border:1px solid #d1d1d3; '>
		
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Incumbent</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_name</div><BR>
			
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Award Amount</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_award_amount</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Spend To Date</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_spend_to_date</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Reference Link</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '> </div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Current OASIS Pools</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$current_pools</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>OASIS Pools</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$oasis_pools</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Start Date</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_start_date </div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Completion Date</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_completion</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Ultimate Completion</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_ultimate</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Contract - Task Order</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_contract_taskorder</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>In Forecast</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$in_forecast</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Contact Info</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$contact_info</div><BR>
					
			
			</div>
			";			}
			
			if ($incumbent_counter>0) {
			$more_incumbents .= "<div class='incumbentvaluecss' style='display:inline-block;width:100%;vertical-align:top; /*padding:8px 12px;*/ overflow:auto; overflow-wrap:break-word; border-bottom:1px solid #f1f1f3; margin-top:4px; padding-bottom:2px;'>
		
			
			
			<div class='incumbentvaluecss' style='display:inline-block;width:100%;vertical-align:top; /*margin-bottom:7px;*/ '>
			<a href='" . "$baseurl/addrole_incumbents.php?which_update_id=$opp_opportunity_id" . "' target='top' style='text-decoration: none;'><span style='color:#dedede;'>&#9654;</span></a> <a title='" . $incumbent_ref_link . "' style='color:#3c4db0;' href='" . "$baseurl/addrole_incumbents.php?which_update_id=$opp_opportunity_id" . "' target='top'>$incumbent_name</a>
			  <span style='color:#a9a9ad;font-weight:500;'>$incumbent_status</span></div><BR>
			
			
			</div>"; //http://demoportal.ardentinc.com/addrole_incumbents.php?which_update_id=$opp_opportunity_id
			//addrole_edit_incumbent.php?which_incumbent_id=$incumbent_id
							  }			  
		}
		if (strlen($proposal_id_a)<3) { $incumbent_container=""; }
	//STOP
	
	//$phrase  = "You should eat fruits, vegetables, and fiber every day.";
	//$healthy = [" ", "RFP", "No.", "SB", "(8A)", "8(a)"];
	//$yummy   = ["", "", "", "", "", ""];
	
	//$newPhrase = str_replace($healthy, $yummy, $proposal_ids);
	
	$contract_vehicle = $row[18]; 
	$opp_status = "<option hidden selected value='" . $row[19] . "'>" . $row[19] . "</option>"; 
	$agency_db = $row[20];
	$agency = str_ireplace($search_this, '<span style="background-color:yellow;">'.strtoupper($search_this).'</span>', $agency_db); //#8ad7ff;
	$facility = $row[21]; //"<option value='" . $row[21] . "'>" . $row[21] . "</option>"; 
	$company_clearance = $row[22];
	
	$proposal_due = $row[23];
	$qa_due = $row[24];
	$reason = $row[25];
	$manager = "<option hidden selected value='" . $row[26] . "'>" . $row[26] . "</option>";
	
	$qa_timezone = $row[27];
	$proposal_timezone = $row[28];  
	$contract_vehicle_two = $row[29];
	
	$opp_synopsis_cropped =  substr($opp_synopsis,0,200); //$opp_synopsis; //
	
	//$vehicle_part = "OASIS";
	$vehicle_part = "Opp Id";
	$vehicle_id_one = $vehicle_part;
	$vehicle_id_two = $vehicle_part;
	
	if (strpos(strtolower($vehicle_one), 'sb') !== false) {
    	$vehicle_id_one .= " SB ";
	}
	if (strpos(strtolower($vehicle_one), '8(') !== false) {
    	$vehicle_id_one .= " 8(a) ";
	}
	if (strpos(strtolower($vehicle_two), 'sb') !== false) {
    	$vehicle_id_two .=  " SB ";
	}
	if (strpos(strtolower($vehicle_two), '8(') !== false) {
    	$vehicle_id_two .= " 8(a) ";
	}
	if (strlen($vehicle_two)<2) { $vehicle_id_two = ""; }
	
	/*$opp_inccontract = strtoupper($row[14]);
	$opp_questionsduetime = strtoupper($row[15]);
	$opp_naics = strtoupper($row[16]);
	$opp_setaside = strtoupper($row[17]);*/
	//$opp_primaryskills = strtoupper($row[18]);
	
	$contract_vehicle_image = "./images/vehicles/blank.png";
	
	/*if (str_contains($opp_vehicle, 'seaport')) { 
    	$contract_vehicle_image = "/images/contract-vehicles/seaport-nxg.png";
	}*/
	/*if (strpos(strtolower($opp_vehicle), 'seaport') !== false) {
    	$contract_vehicle_image = "./images/vehicles/seaport-nxg.png";
	}
	if (strpos(strtolower($opp_vehicle), 'efast') !== false) {
    	$contract_vehicle_image = "./images/vehicles/efast.png";
	}
	if (strpos(strtolower($opp_vehicle), 'gsa') !== false) {
    	$contract_vehicle_image = "./images/vehicles/gsa.png";
	}
	if (strpos(strtolower($opp_vehicle), 'fbo') !== false) {
    	$contract_vehicle_image = "./images/vehicles/sam.png";
	}
	if (strpos(strtolower($opp_vehicle), 'oasis') !== false) {
    	$contract_vehicle_image = "./images/vehicles/oasis.png";
	}
	if (strpos(strtolower($opp_vehicle), 'sandia') !== false) {
    	$contract_vehicle_image = "./images/vehicles/sandia.png";
	}*/
	
	//$opp_category .= "<BR>" . $opp_type;
	
	/*$co_set_asides = str_replace("|",", ",$co_set_asides_inline);
	$co_vehicles = str_replace("|",", ",$co_vehicle_name);
	$co_website = str_replace("www.","",$co_website);
	
	$poc_names_array = explode("|",$poc_name);
	$poc_email_array = explode("|",$poc_email);
	$poc_phone_array = explode("|",$poc_phone);
	$poc_title_array = explode("|",$poc_title);
	$poc_status_array = explode("|",$poc_status);
	$poc_id_array = explode("|",$poc_id);*/
	
	$poc_name_output = "";
	
	//$poc_count = count($poc_names_array);
	/*for ($x = 0; $x <= ($poc_count-1); $x++) {
		$poc_name_output .=  "<div onclick=\"modalcontactupdate($poc_id_array[$x], '$poc_names_array[$x]')\" style='width:100%; float:left; width:48%;'><div style='font-weight:700;'>" . $poc_names_array[$x] . "</div>";
		if(isset($poc_title_array[$x])) { $poc_name_output .=  "<div>" . $poc_title_array[$x] . "</div>"; }
		if((isset($poc_email_array[$x])) && (strlen($poc_email_array[$x])>0)) { $poc_name_output .=  "<div>" . "<a style='color:#141414;' href='mailto:$poc_email_array[$x]'><img style='height:20px;' src='images/email_icon_30.png' title='$poc_email_array[$x]'>$poc_email_array[$x]</a>" . "</div>"; }
		if((isset($poc_phone_array[$x])) && (strlen($poc_phone_array[$x])>0)) { $poc_name_output .=  "<div><a style='color:#141414;' href='tel:9373087747'><img style='height:20px;' src='images/cellphone_30.png' title='$poc_phone_array[$x]'>$poc_phone_array[$x]</a></div>
		</div>"; }
	}*/
	
	//if (($co_prime == 'Y') || ($co_prime == 'y')) { $co_prime='Prime Contractor'; } 
	
	
	/*$table_content .= "<tr onclick=\"modalcompanyupdate($opp_id, '$opp_opportunity_title')\">
	<td width='15%'><div style='overflow-wrap: break-word;'>$opp_entrydate<BR><BR>$opp_source</div></td>
	<td width='15%'><div style='overflow-wrap: break-word;'>$opp_opportunity_type<BR><BR>$opp_agency</div></td>
	<td width='40%'><div style=''>
	<div style='overflow-wrap: break-word;'>$opp_opportunity_title</div><BR>$opp_bidnumber</div></td>
	<td width='15%'><div style=\"overflow-wrap: break-word;display:inline-block; width:100%; min-height:140px;background-image: 
  url('$contract_vehicle_image');
  background-size:80px 80px;
  background-repeat:no-repeat;
  background-position: bottom right;\">$opp_vehicle</div></td>
	<td width='15%'><div style='overflow-wrap: break-word;'>$opp_duedate<BR><BR>$opp_status</div></td>
	</tr>";*/
	/*$table_content .= "<tr onclick=\"modalcompanyupdate($opp_id, '$opp_opportunity_title')\">
	<td width='10'><div style='overflow-wrap: break-word;background-color:teal;'></div></td>
	<td width='100'><div style='overflow-wrap: break-word;'>$opp_entrydate</div></td>
	<td width='70%'><div style=\"overflow-wrap: break-word;display:inline-block; width:100%; min-height:140px;background-image: 
  url('$contract_vehicle_image');
  background-size:80px 80px;
  background-repeat:no-repeat;
  background-position: bottom right;\">$opp_opportunity_title<BR>Agency:$opp_agency<BR>Source:$opp_source<BR>Type:$opp_opportunity_type</div></td>
    <td width='15%'><div style='overflow-wrap: break-word;'>$opp_duedate</div></td>
	</tr>";*/
	/*$table_content .= "<div class='slight' style='background-color:#fff;' onclick=\"modalcompanyupdate($opp_id, '$opp_opportunity_title')\">
	<div style='width:140px; background-color:blue; display:inline-block;'>$opp_entrydate</div>
	<div style='width:calc(100% - 210px); background-color:#f1f1f1; display:inline-block;'>$opp_opportunity_title</div>
	<div style='width:140px; background-color:yellow; display:inline-block;'>$opp_duedate</div>
	</div>";*/
	/*$table_content .= "<div style='min-height:60px; background-color:#fff; margin-bottom:20px;' class='slight' onclick=\"modalcompanyupdate($opp_id, '$opp_opportunity_title')\">
	<div style='width:50%; display:inline-block; background-color:yellow;'>
	$opp_entrydate 
	$opp_opportunity_type 
	$opp_duedate 
	$opp_opportunity_title 
	$opp_agency 
	$opp_url 
	 </div><div style='width:50%; display:inline-block; background-color:#e4e4e4;'> 
	$opp_category 
	$opp_id 
	$opp_vehicle 
	$opp_status 
	$opp_bidnumber 
	$opp_source </div>
	</div>";*/
	
	$extra_table_content .= "<DIV style='background-color:#FFF; border:1px solid #c1c1c1; margin-bottom:20px;padding:6px;'><div style='font-size:16px; font-weight:700; /*background-color:#f7f7f9; border:1px solid #d1d1d3;*/ padding-left:5px; padding-right:5px; padding-top:5px; padding-bottom:7px; color:#3c4db0;' class='' onclick=\"modalcompanyupdate($opp_opportunity_id, '$opp_title')\"><u><strong>$opp_title</strong></u></div>
	
	<div style='width:32%;display:inline-block; vertical-align:top;margin-right:1%;padding:5px;'>
	
		<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Vehicle(s)</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>
			<div style='width:120px; display:inline-block;'>$contract_vehicle<BR>$contract_vehicle_two</div>
			<div style='width:160px; display:inline-block;'>$vehicle_one<BR>$vehicle_two</div>
		
		</div>
		
		<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Release Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$opp_released</div><BR>
		<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Opportunity Type</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>
			$opp_response
		</div><BR>
		
		<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Proposal Due Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$proposal_due $proposal_timezone</div><BR>
		<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Q&A Due Date</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$qa_due $qa_timezone</div><BR>
		
		
		<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Agency</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$agency</div>
		
		
		
		
		
		<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Requestor Name</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$opp_requestor</div><BR>
		<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Clearance Level</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$company_clearance</div><BR>
		
		<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Certifications</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$certifications</div><BR>
		
		
		<div onclick=\"modaldescriptionupdate($opp_opportunity_id, '$opp_title')\" class='incumbentvaluecss' style='font-weight: 700; /*padding: 5px;*/ text-decoration:underline; font-size:14px; color:#3c4db0;'>Description</div>
		
		<div class='valuecss' style='display:inline-block;width:calc(100%);vertical-align:top; height:280px; margin-top:0px; padding:8px 12px; overflow:auto; overflow-wrap:break-word; border:1px solid #d1d1d3;'>$opp_synopsis</div>
		
	</div>
	
	<div style='width:33%;display:inline-block; vertical-align:top;margin-right:1%;padding:5px;'>
  			
			<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Performance Location</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>
			$facility
			
			</div><BR>
			<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Address</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$contract_pop</div><BR>
			<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Period</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$contract_period</div><BR>
			
			<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Pricing</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$opp_pricing</div><BR>
			
			<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Recruiting</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$opp_recruiting</div><BR>
			
			<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Submission Requirements</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$opp_proposal</div><BR>
			
			<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Decision</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>
				<select name='decision' id='decision' size='1' style='padding:2px 5px; width:150px;' onchange=\"blurfunctiondecision('decision',this.value, $opp_opportunity_id)\">
				  $opp_decision
				  <option value='Bid'>Bid</option>
				  <option value='On Hold'>On Hold</option>
				  <option value='Ineligible'>Ineligible</option>
				  <option value='No Bid'>No Bid</option>
				</select>
			</div>
			
			<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Assigned To</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>
				<select name='manager' id='manager' size='1' style='padding:2px 5px; width:150px;' onchange=\"blurfunctiondecision('manager',this.value, $opp_opportunity_id)\">
				  $manager
				  <option value='Genaro Cavazos'>Genaro Cavazos</option>
				  <option value='Holly Knouff'>Holly Knouff</option>
				  <option value='Jonathan Quenan'>Jonathan Quenan</option>
				  <option value='Mick Feldmeyer'>Mick Feldmeyer</option>
				  <option value='Ron Hartke'>Ron Hartke</option>
				  <option value='Rick Neetz'>Rick Neetz</option>
				</select>
			</div>
			
			
			
			
			<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Reason</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>
				<textarea id='reason$opp_opportunity_id' rows='1' style='vertical-align:top; width:calc(100%); padding-left:7px; min-height:25px; height:25px; width:300px; max-width:300px; min-width:150px;' onchange=\" blurfunctiondecision('reason',this.value, $opp_opportunity_id)\">$reason</textarea>
			</div>
			
			<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Gap(s)</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>
				<textarea id='' rows='1' style='vertical-align:top; width:calc(100%); padding-left:7px; min-height:25px; height:25px; width:300px; max-width:300px; min-width:150px;' onchange=\" blurfunctiondecision('gaps',this.value, $opp_opportunity_id)\">$opp_gaps</textarea>
			</div>
			
			<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Status</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>
				<select name='opp_status' size='1' style='padding:2px 5px; width:150px;' onchange=\"blurfunction('status',this.value, $opp_opportunity_id)\">
				  $opp_status
				  <option value='New'>New</option>
				  <option value='Working'>Working</option>
				  <option value='RFP Tracking'>RFP Tracking</option>
				  <option value='Award Monitoring'>Award Monitoring</option>
				  <option value='Archived'>Archived</option>
				</select>
			</div>
  	</div>
  
	<div style='width:32%;display:inline-block; vertical-align:top;padding:5px; min-height:450px;'>
		<div onclick=\"modalincumbentupdate($opp_opportunity_id, '$opp_title')\" class='incumbentvaluecss' style='font-weight: 700; text-decoration:underline; font-size:14px; color:#3c4db0;'>Incumbent(s)</div>
		$incumbent_container
		$more_incumbents

		
	</div>
	
</DIV>";

	
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
			<div style='display:inline-block; width:150px;'>Agency</div>
			<div style='display:inline-block; width:50%;'>$agency</div>
		</div>
		<div style='color:#141414; font-weight:500;display:inline-block; width:100%;'>
			<div style='display:inline-block; width:150px;'>Requestor </div>
			<div style='display:inline-block; width:50%;'>$opp_requestor</div>
		</div>
		
		
		<div style='color:#141414; font-weight:500;display:inline-block; width:100%;'>
			<div style='display:inline-block; width:150px;'>$contract_vehicle </div>
			<div style='display:inline-block; width:50%;'>$vehicle_one_find</div>
		</div>
		<div style='color:#141414; font-weight:500;display:inline-block; width:100%;'>
			<div style='display:inline-block; width:150px;'>$contract_vehicle_two </div>
			<div style='display:inline-block; width:50%;'>$vehicle_two_find</div>
		</div>

	</div>
	

	<div style='width:34%;font-size:13px; font-weight:700; padding-left:5px; padding-right:5px; padding-top:5px; padding-bottom:7px; color:#36374c; display:inline-block;vertical-align:top;'>
		<div onclick=\"window.parent.location.href='$baseurl/addrole_incumbents.php?which_update_id=$opp_opportunity_id'\" class='incumbentvaluecss' style='font-weight: 700; /*padding: 5px;*/ text-decoration:underline; font-size:13px; color:#36374c;'>Incumbent(s)</div>
		
		$more_incumbents

		
	</div>
	
</DIV>";
	
	
	$count_results++;
  	
	//if ($co_company_id==$start_co_id) { } else { $table_content .= "STOP " . $co_company_id . "<BR>"; /*$co_company_id = $start_co_id;*/ }
	}

	//$table_content .= "</table>";

//print("<div style='width:100%; text-align:center;'># of Rows found: $count_results</div><div style='height:10px;'></div>");

/*print("<div style='margin-left:2%; margin-right:2%;width:18%;vertical-align:top;background-color:#f1f1f1; border:1px #d1d1d1 solid; display:inline-block;position:fixed;'>FILTER</div>");*/

?>



<?php
//TITLE
print("<div style='width:98%; text-align:center;font-weight:500; color:#141414; font-size:15px;'><span style='font-weight:700;'>Searching for '$search_term'</span></div><div style='height:10px;'></div>");

print("<div style='width:98%; text-align:center;font-weight:500; color:#141414; font-size:13px;'>Opportunities (<a href='#opportunities_anchor' style='color:#141414; background-color:yellow;'>$total_results Found</a>), Incumbents (<a href='#incumbent_anchor' style='color:#141414; background-color:yellow;'>$incumbents_count Found</a>)</div><div style='height:10px;'></div>");

print("<div style='width:98%; text-align:center;font-weight:500; color:#3c4db0; font-size:15px;'><span style='font-weight:700;color:#3c4db0'><a name='opportunities_anchor' style='color:#3c4db0;'>Opportunities</a></span> ($total_results Found)</div><div style='height:10px;'></div>");


print($filterarea . "<div class='clearfix ' style='/*float:right;*/ display:inline-block;vertical-align:top;/*border:1px solid #d1d1d1;*/ width:98%; margin-left:1%;'>" . $header_part. $table_content . "</table></div>");

print("<div style='width:98%; text-align:center;font-weight:500; color:#3c4db0; font-size:15px;'><span style='font-weight:700;color:#3c4db0;'><a name='incumbent_anchor' style='color:#3c4db0;'>Incumbents</a></span> ($incumbents_count Found)</div><div style='height:10px;'></div>");

print($db_incumbent_results);
?>
<?php
print("<div style='width:98%; text-align:center;font-weight:500; color:#141414; font-size:13px;'>Opportunities (<a href='#opportunities_anchor' style='color:#141414'>$total_results Found</a>), Incumbents (<a href='#incumbent_anchor' style='color:#141414'>$incumbents_count Found</a>)</div><div style='height:10px;'></div>");

/*print("<div style='width:98%; text-align:center;font-weight:700; color:#3c4db0; font-size:13px;'>Searching for '$search_term' and Displaying: $count_results of $total_results</div><div style='height:10px;'></div>");*/
//print("<div style='width:100%; text-align:center;font-weight:700;'># of Rows found: $count_results</div><div style='height:10px;'></div>");

/*print ("<div class=\"w3-container\" id=\"projects\">
    	<h5 class=\"\" style=\"text-align:center;\">Total Events: <strong>$event_counter</strong></h5>
  	</div>");*/
?>
<?php /*print $find_incumbents;*/ ?>
<?php /*print_r($_GET);*/ ?>
  

<!-- End page content -->
</div>
<!-- Trigger/Open The Modal -->
<!--<button id="myBtn">Open Modal RCS</button>-->

<!-- The Modal -->
<!--<div id="myModal" class="modal">


  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3 style="margin:4px 0;"><span id='event-modal-header'>Modal Header</span></h3>
    </div>
    <div class="modal-body">
      <div id="ajaxevent">EMPTY</div>
    </div>

  </div>

</div>-->

<!--<div id="myFilters" class="modal">

  <div class="modal-content">
    <div class="modal-header" style='background-color:#f1f1f1; color:#141414;'>
      <span id='filterclose' onClick="filtercloseclick();" style='color:#141414;font-size:15px;' class="close">Apply</span>
      <h3 style="margin:4px 0;"><span id='event-modal-header'>Filters</span></h3>
    </div>
    <div class="modal-body">
      <div id="filterresults">EMPTY</div>
    </div>
    
  </div>

</div>-->
<!-- The Modal -->
<!--<div id="contactModal" class="modal">

  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3 style="margin:4px 0;"><span id='event-modal-header2'>Modal Header2</span></h3>
    </div>
    <div class="modal-body">
      <div id="ajaxevent">EMPTY</div>
    </div>
    
  </div>

</div>-->


<!-- Footer -->
<?php include("includes/footer.php"); ?>


<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
//var btn = document.getElementById("myBtn");
var btn = document.getElementById("eventmodal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
// data: serializedData,
/*btn.onclick = function() {
  modal.style.display = "block";
}*/
modalcompanyupdate = function(oppid, company_name) {
var oppid = oppid;
//alert(oppid);
//var company_name = "123";
var company_name = company_name;
//alert(company_name);
$.ajax({
	type: "get",
    //url: "ajax_events.php?eventid=" + eventid, 
	url: "ajax_opportunities_update.php?which_update_id=" + oppid,
	success: function(result){
    $("#ajaxevent").html(result);
  }});

//document.getElementById('event-modal-header').innerHTML = company_name + " - Company View/Update";
document.getElementById('event-modal-header').innerHTML = company_name; // + " - Company View/Update";
modal.style.display = "block";
}

var modalcontact = document.getElementById("contactModal");
modalcontactupdate = function(passpocid, passpocname) {
var passpocid = passpocid;
var passpocname = passpocname;

$.ajax({
	type: "get",
    //url: "ajax_events.php?eventid=" + eventid, 
	url: "ajax_contact_update.php?which_update_id=" + passpocid,
	success: function(result){
    $("#ajaxevent").html(result);
  }});

document.getElementById('event-modal-header').innerHTML = passpocname + " - Contact View/Update";
modal.style.display = "block";
}


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	//alert("closing ...");
	window.location.reload();
  modal.style.display = "none";
}


// Get the modal
//var modal = document.getElementById('yourModalId');
//alert("PART 1 " + modal);
// When the user clicks anywhere outside of the modal, close it
//window.onclick = function() { alert"hey"; }
window.addEventListener("click", function(event) {
	//alert("OK" + event.target);
	//if (event.target == modal) { alert("YEP"); }
	if (event.target == modal) {
        modal.style.display = "none";
    }
});

/*window.onclick = function(event) {
	alert("PART 2");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}*/

</script>
<script>


modalincumbentupdate = function(oppid, company_name) {
var oppid = oppid;
//alert(oppid);
//var company_name = "123";
var company_name = company_name;
//alert(company_name);
$.ajax({
	type: "get",
    //url: "ajax_events.php?eventid=" + eventid, 
	url: "ajax_incumbent_update.php?which_update_id=" + oppid,
	success: function(result){
    $("#ajaxevent").html(result);
  }});

//document.getElementById('event-modal-header').innerHTML = company_name + " - Company View/Update";
document.getElementById('event-modal-header').innerHTML = "Incumbent(s)"; // + " - Company View/Update";
//document.getElementById('event-modal-header').style.backgroundColor='yellow';
modal.style.display = "block";
}
</script>
<script>
modaldescriptionupdate = function(oppid, company_name) {
var oppid = oppid;
//alert(oppid);
//var company_name = "123";
var company_name = company_name;
//alert(company_name);
$.ajax({
	type: "get",
    //url: "ajax_events.php?eventid=" + eventid, 
	url: "ajax_description_update.php?which_update_id=" + oppid,
	success: function(result){
    $("#ajaxevent").html(result);
  }});

//document.getElementById('event-modal-header').innerHTML = company_name + " - Company View/Update";
document.getElementById('event-modal-header').innerHTML = "Description"; // + " - Company View/Update";
//document.getElementById('event-modal-header').style.backgroundColor='yellow';
modal.style.display = "block";
}
</script>


<script>
/* dropdown content */
function dropdownshow() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
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
}
</script>

<script>
function openCity(evt, cityName) {
	//alert("hello");
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

<script>
function showElement(x, which_element) {
	//alert("Hello " + x + " " + which_element);
	//exit();
	
	var thisElement = document.getElementById(x); /*.style.display = "block";*/
	
	//AJAX GET
	if (x.length == 0) {
		document.getElementById(x).innerHTML = ""; //getElementById("txtHint")
		return;
	  } else {
		var xmlhttp1 = new XMLHttpRequest();
		xmlhttp1.onreadystatechange = function() {
		  if (this.readyState == 4 && this.status == 200) {
			  //alert("HEY " + this.responseText);
			  	//document.getElementById(x).style.borderBottom = "1px solid red";
				document.getElementById(x).innerHTML = this.responseText; //getElementById("txtHint")
		  }
		};
		xmlhttp1.open("GET", "element_note.php?entry_id=" + x, true);
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
</script>
<script>
function addnote(x, content) {
	//alert("Hello " + x + " " + which_element);
	//exit();
	
	var thisElement = document.getElementById(x); /*.style.display = "block";*/
	
	//AJAX GET
	if (x.length == 0) {
		document.getElementById(x).innerHTML = ""; //getElementById("txtHint")
		return;
	  } else {
		var xmlhttp1 = new XMLHttpRequest();
		xmlhttp1.onreadystatechange = function() {
		  if (this.readyState == 4 && this.status == 200) {
			  //alert("HEY " + this.responseText);
			  	//document.getElementById(x).style.borderBottom = "1px solid red";
				document.getElementById('notesarea' + x).innerHTML = this.responseText; //getElementById("txtHint")
		  }
		};
		xmlhttp1.open("GET", "ajax_add_note.php?entry_id=" + x + "&content=" + content, true);
		xmlhttp1.send();
	  }
	//AJAX CLEAR
	
		/*if (thisElement.style.display === "block") 
				{
				  thisElement.style.display = "none";
				} else 
				{
				  thisElement.style.display = "block";
				}*/
	
}
</script>



<script>
// this is for the select plus options
/*var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}*/
</script>
<script>
// Get the modal
	var modalfilter = document.getElementById("myFilters");

// Get the button that opens the modal
//var btn = document.getElementById("myBtn");
	//var btn = document.getElementById("eventmodal");

// Get the <span> element that closes the modal
	//var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
// data: serializedData,
/*btn.onclick = function() {
  modal.style.display = "block";
}*/
//modalcompanyupdate = function(oppid, company_name) {
ajaxshowfilter = function() {
	//alert("hello 123");
	//var oppid = oppid;
//alert(oppid);
//var company_name = "123";
	//var company_name = company_name;
//alert(company_name);
$.ajax({
	type: "get",
    //url: "ajax_events.php?eventid=" + eventid, 
	//url: "ajax_opportunities_update.php?which_update_id=" + oppid,
	url: "ajax_show_filters.php",
	success: function(result){
    $("#filterresults").html(result);
  }});

//document.getElementById('event-modal-header').innerHTML = company_name + " - Company View/Update";
	//document.getElementById('event-modal-header').innerHTML = company_name; // + " - Company View/Update";
modalfilter.style.display = "block";
}

var modalcontact = document.getElementById("contactModal");
modalcontactupdate = function(passpocid, passpocname) {
var passpocid = passpocid;
var passpocname = passpocname;

$.ajax({
	type: "get",
    //url: "ajax_events.php?eventid=" + eventid, 
	url: "ajax_contact_update.php?which_update_id=" + passpocid,
	success: function(result){
    $("#ajaxevent").html(result);
  }});

document.getElementById('event-modal-header').innerHTML = passpocname + " - Contact View/Update";
modal.style.display = "block";
}


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	//alert("11111 closing ...");
	//window.location.reload();
		//window.location.replace("admin.php?pass3");
  modal.style.display = "none";
}


// Get the modal
//var modal = document.getElementById('yourModalId');
//alert("PART 1 " + modal);
// When the user clicks anywhere outside of the modal, close it
//window.onclick = function() { alert"hey"; }
window.addEventListener("click", function(event) {
	//alert("OK" + event.target);
	//if (event.target == modal) { alert("YEP"); }
	if (event.target == modal) {
        modal.style.display = "none";
    }
	if (event.target == modalfilter) {
		alert("closing by offset ...");
        modalfilter.style.display = "none";
    }
});

/*window.onclick = function(event) {
	alert("PART 2");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}*/

</script>
<script>
function filtercloseclick() {
	var cv_oasis_sb = document.getElementById("cv_oasis_sb").checked;
	var cv_oasis_8a = document.getElementById("cv_oasis_8a").checked;
	//alert("Hello");
	//const url = new URL("http://foo.bar/?x=1&y=2");
	//if (cv_oasis_sb == 'true') { url.searchParams.append('cv1', 'oasis sb'); }
	//if (cv_oasis_8a == 'true') { url.searchParams.append('cv2', 'oasis 8a'); }
	//alert (cv_oasis_sb);	
	
	const url = new URL(window.location.href);
	//url.searchParams.append('z', 42);
	if (cv_oasis_sb == true) { url.searchParams.append('cv1', 1); }
	if (cv_oasis_8a == true) { url.searchParams.append('cv2', 1); }
	
	if (cv_oasis_sb == false) { url.searchParams.append('cv1', 0); }
	if (cv_oasis_8a == false) { url.searchParams.append('cv2', 0); }
	//url.searchParams.append('cv1', 'oasis sb');
	//url.searchParams.append('cv2', 'oasis 8a');
	
	const newUrl = url.toString();
	//alert (newUrl);
	//alert("closing by x ... SB: " + cv_oasis_sb + " 8a: " + cv_oasis_8a);
	//window.location.reload();
	
  	modalfilter.style.display = "none";
	//window.location.href = "http://demoportal.ardentinc.com/contacts.php?search=bob&search_type=contacts";
	window.location.href = newUrl;
}
</script>
<script>
//SELECT BLUR UPDATE STATUS
function blurfunction(namea,valueb,idc) {
	var namea = namea;
	var valueb = valueb;
	var idc = idc;
	//alert("Name " + namea + " Value " + valueb + " ID " + idc);
	//alert("ajax_events_update.php?eventid=" + idc + "&eventfield=" + namea + "&eventvalue=" + valueb);
	
	$.ajax({
	type: "get",
    url: "ajax_status_update.php?oppid=" + idc + "&oppfield=" + namea + "&oppvalue=" + valueb, 
	success: function(result){
    //$("#ajaxevent").html(result);
	//alert(result);
	//alert("ajax_events_update.php?eventid=" + idc + "&eventfield=" + namea + "&eventvalue=" + valueb);
  }});
  //var x = document.getElementById("fname");
  //x.value = x.value.toUpperCase();
}
//SELECT BLUR UPDATE STATUS

function blurfunctiondecision(namea,valueb,idc) {
	var namea = namea;
	var valueb = valueb;
	var idc = idc;
	
	//var comparevalue = valueb.toLowerCase();
	//var manager = document.getElementById('manager');
	//alert("Name " + namea + " Value " + valueb + " ID " + idc);
	//if ((comparevalue==='bid') || (comparevalue==='on hold')) { manager.style.display = 'block'; } else { manager.style.display = 'none'; }
	//alert("ajax_events_update.php?eventid=" + idc + "&eventfield=" + namea + "&eventvalue=" + valueb);
	
	$.ajax({
	type: "get",
    url: "ajax_decision_update.php?oppid=" + idc + "&oppfield=" + namea + "&oppvalue=" + valueb, 
	success: function(result){
    //$("#ajaxevent").html(result);
	//alert(result);
	//alert("ajax_events_update.php?eventid=" + idc + "&eventfield=" + namea + "&eventvalue=" + valueb);
  }});
  //var x = document.getElementById("fname");
  //x.value = x.value.toUpperCase();
}
</script>
<script>
modaloppadd = function() {
//var oppid = oppid;
//alert(oppid);
//var company_name = "123";
//var company_name = company_name;
//alert(company_name);
$.ajax({
	type: "get",
    //url: "ajax_events.php?eventid=" + eventid, 
	url: "ajax_opportunities_add_admin.php",
	success: function(result){
    $("#ajaxevent").html(result);
  }});

//document.getElementById('event-modal-header').innerHTML = company_name + " - Company View/Update";
document.getElementById('event-modal-header').innerHTML = 'Add New Opportunity'; //company_name; // + " - Company View/Update";
modal.style.display = "block";
}
</script>
<script>
//AUTOSTART
function autostart() {
	var a=1;
	if (a == 1) {
	//alert("LOADED ... " + <?php print $action_pass; ?>);
	modalincumbentupdate(<?php print $action_pass; ?>, 'TITLE');
	}
	else {
	alert("GOOD ... " + a);	
	}
	a=a+1;
	//modalincumbentupdate(1593, 'TITLE');
	//window.location.replace("admin.php");
}
//alert("Nachos");
//modalincumbentupdate(1593, 'TITLE')
	//var valueb = document.getElementById('decision');
	//var comparevalue = valueb.toLowerCase();
	//var manager = document.getElementById('manager');
	//alert("Name " + namea + " Value " + valueb + " ID " + idc);
	//if ((comparevalue==='bid') || (comparevalue==='on hold')) { manager.style.display = 'block'; } else { manager.style.display = 'none'; }
</script>