<?php
$button_page_reference = "opportunities";
$this_page_name="Ardent Capture System";
include("./includes/connect_portal123.php");
$secure_webpage=0;
////include($_SERVER['DOCUMENT_ROOT'] . "include/it_loader.php");

//print('hi ' . $it4gov_username);
//if ($it4gov_username == 'testuser@ardentinc.com') { header("Location: https://ardentinc.com/bids-test/admin.php");  exit(); }

$search_this= "";
if (!empty($_GET['search'])) { $search_this = $_GET['search']; $_SESSION["search"] = "?search=" . $search_this; } else { $_SESSION["search"] = ""; }
if (!empty($_GET['status'])) { $status =  " STATUS='" . $_GET['status'] . "' AND "; $_SESSION["status"] = "?status=" . $status; } else { $_SESSION["status"] = ""; $status="";}

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
	/* <input type='submit' style='font-size:13px; width: 70px; font-weight:700;' value='Search' name='submitted' id='submitted'> */
?>
<?php
//$this_page_name="UMANG EVENTS";
//$note_this = $this_page_name;
//$secure_webpage=0;

//$conn = new MySQLi('localhost', $db_user, $db_password,'it4gov');

//include($_SERVER['DOCUMENT_ROOT'] ."/../include/it_loader_subs.php");

//print($_SERVER['DOCUMENT_ROOT'] ."/../include/connect_db.php");
//include($_SERVER['DOCUMENT_ROOT'] ."/../include/connect_db.php");
//$umang_ = new MySQLi('localhost', $db_user, $db_password,'umang_events');
//$mysqli_link = mysqli_connect('localhost',$db_user, $db_password,'umang_events');
//print $db_user;
?>

<!DOCTYPE html>
<html>
<head>
<title><?php print $this_page_name; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="styles/modal.css">
<link rel="stylesheet" href="styles/1.css">
<link rel="stylesheet" href="styles/rcs.css">

<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="icon" type="image/x-icon" href="favicon.ico">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style type="text/css">
<?php include("includes/inline-styles.php"); ?>
</style>
</head>
<?php
print("
<body onLoad='$autostart'>
");
?>


<?php 
if (isset($profile_first_name)) { $login_name=$profile_first_name; } else { $login_name="Login"; }
include("includes/header.php"); 
?>

<?php 
//include("includes/search_results_count.php");
?>

<!-- Header -->
<!--<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
  <div style="background-color:#f1f1f1; text-align:center; height:280px;"><img class="w3-image" style="height:250px; margin-top:15px;" src="images/UMANG2.png"></div>
  <div class="w3-display-top w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>UMANG</b></span> <span class="w3-hide-small w3-text-dark-grey">Gujarati Association of Dayton, Ohio</span></h1>
  </div>
</header>-->

<!-- Page content -->
<!--<div class="w3-content w3-padding" style="max-width:1564px">-->


	<!--<div class="w3-container" id="projects">
    	<h3 class="" style="text-align:center;">Events</h3>
  	</div>-->
<div style="height:42px;"></div>
<div id='menu_group' style="width:100%; z-index:2; /* margin-left: 2%; background-color:#404f96; */padding: 8px 2%; background-color: #f9f9f9; position: fixed; border-bottom: 1px solid #bdbdc4;-webkit-box-shadow: 0px 3px 10px -4px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 3px 10px -4px rgba(0,0,0,0.75);
box-shadow: 0px 3px 10px -4px rgba(0,0,0,0.75);">
    <div class="btn-group">
    <?php include("includes/menu_group_add_role.php"); ?>
     
    </div>
    <?php /*print ("
    <span class='search_results' style='left:-634px'>$search_results_opportunities</span>
    <span class='search_results' style='left:-543px'>$search_results_gov_contacts</span>
    <span class='search_results' style='left:-397px'>$search_results_companies</span>
    <span class='search_results' style='left:-324px'>$search_results_company_contacts</span>");*/ ?>
    
    <!--<div class="btn-group" style='float:right;'> 
        	<div class="dropdown">
            <i onclick="dropdownshow()" title="Dashboards" class="dropbtn fa fa-bar-chart-o" style='font-size: 16px;
            padding-right: 10px;
            display: inline-block;
            border-radius: 100px;
            box-shadow: 0 0 2px #1f2662;
            color: #fcfcfa;
            background-image: linear-gradient( #6e83e6, #1c2445);
            padding: 0.35em 0.35em;
            margin-top: 5px;
            '></i>
            
            
              <div id="myDropdown" class="dropdown-content">
                <a href="executive.php">Executive</a>
                <a href="proposals.php">Proposals</a>
                <a href="sales.php">Sales</a>
              </div>
            </div>
    </div>-->
    
    <div class="btn-group" style='float:right;'>
    <button style="float:right; margin-right:5px;" onclick="modaloppadd()" class='button'><i class='fa fa-plus-circle' style='font-size:16px;padding-right:10px;'></i>Add</button>
    </div>
    
    <!--<div class="dropdown">
      <button onclick="dropdownshow()" class="dropbtn">Dropdown</button>
      <div id="myDropdown" class="dropdown-content">
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
      </div>
    </div>-->
    
    
</div>

<div style="clear:both; height:68px;"></div>
<?php
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

$query = "SELECT DATE(entrydate), opportunity_type, DATE(duedate), opportunity_title, agency, url, category, opportunity_id  FROM temp_opportunities   
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
ORDER BY entrydate DESC LIMIT 200";

/*SELECT id,duedate,state,bidnumber,description,
      projecttitle,STATUS,nonsubdetails,primaryskills,
      source,mastercontracts,Dept,submissiondate,
      category,entrydate,created_by,bidtype_id,
      projectcost,incumbent,inccontract,questionsduetime,naics,setaside,
      url FROM bp_transfer ORDER BY id DESC LIMIT 50*/
$is_oasis_sb ="";
if (($cv1>0) && ($cv2==0)) { $is_oasis_sb = ""; $is_oasis_sb = " AND contract_vehicle = 'OASIS SB' "; } else { /*$is_oasis_sb ="";*/ }
if (($cv1==0) && ($cv2>0)) { $is_oasis_sb = ""; $is_oasis_sb = " AND contract_vehicle = 'OASIS 8(a)' "; } else { /*$is_oasis_a ="";*/ }
  
$query = "SELECT opportunity_id, bidopp, response, requestor, title, due, released, pop, synopsis, proposal, pricing, recruiting, gaps, decision, contract_pop, contract_period, vehicle_one, vehicle_two, contract_vehicle, status, agency, facility, clearance_level, proposal_due, qa_due, reason, manager, qa_timezone, proposal_timezone, contract_vehicle_two FROM excel_test   
WHERE $status (bidopp LIKE '%$search_this%' 
OR response LIKE '%$search_this%' 
OR requestor LIKE '%$search_this%' 
OR title LIKE '%$search_this%' 
OR pop LIKE '%$search_this%' 
OR synopsis LIKE '%$search_this%' 
OR recruiting LIKE '%$search_this%' 
OR decision LIKE '%$search_this%') $is_oasis_sb 
ORDER BY opportunity_id DESC LIMIT 5000"; //LIMIT 50

$query_total = "SELECT count(*) FROM excel_test   
WHERE $status (bidopp LIKE '%$search_this%' 
OR response LIKE '%$search_this%' 
OR requestor LIKE '%$search_this%' 
OR title LIKE '%$search_this%' 
OR pop LIKE '%$search_this%' 
OR synopsis LIKE '%$search_this%' 
OR recruiting LIKE '%$search_this%' 
OR decision LIKE '%$search_this%') $is_oasis_sb 
ORDER BY opportunity_id";




	  
//print $query;
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
	$opp_bidopp = $row[1];
	$opp_response = $row[2]; //"<option value='" . $row[2] . "'>" . $row[2] . "</option>"; //strtoupper($row[13]);= $row[2];
	$opp_requestor = $row[3];
	$opp_title = str_replace("<BR>","",$row[4]);
	$opp_due = strtoupper($row[5]); //substr(strtoupper($row[5]),20);
	$opp_released = strtoupper($row[6]); //substr(strtoupper($row[6]),20);
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
					if (($inloop==1) && ((count($ok)-$i)>1)) { $opp_recruiting .= "<DIV style='background-color:#fff; border-top:1px solid #d1d1d3; color:#106b9a;'>";  }
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
	$vehicle_two = $row[17];
	
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
	//OR (opp LIKE '%" . $proposal_id_a . "%')
	//$extra_searcha $extra_searchb     
	if (strlen($proposal_id_a)>5) { $extra_searcha = " OR (opp LIKE '%" . $proposal_id_a . "%') "; }
	if (strlen($proposal_id_b)>5) { $extra_searchb = " OR (opp LIKE '%" . $proposal_id_b . "%') "; }
	$find_incumbents = "SELECT incumbent_id, incumbent_name, opp, incumbent_contract_taskorder, reference_link, award_amount, spend_to_date, start_date, completion_date, ultimate_completion_date, website, current_pools, oasis_pools, contact_info, in_forecast, incumbent_contract_taskorder, opportunity_id FROM incumbents_test WHERE (opportunity_id = $opp_opportunity_id)  $extra_searcha ORDER BY incumbent_id DESC"; 
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
		$incumbent_opportunity_id = $rowb[16];
		
		/*$find_incumbents_align = "SELECT incumbent_id, incumbent_name, opp, incumbent_contract_taskorder, reference_link, award_amount, spend_to_date, start_date, completion_date, ultimate_completion_date, website, current_pools, oasis_pools, contact_info, in_forecast, incumbent_contract_taskorder, opportunity_id FROM incumbents_test WHERE (opportunity_id LIKE '%" . $opp_opportunity_id . "%')  $extra_searcha ORDER BY incumbent_id DESC"; */
		if (strlen($vehicle_one)>5) {
		$find_incumbents_align = "UPDATE incumbents_test SET opportunity_id=$opp_opportunity_id WHERE incumbent_id=$incumbent_id;";
	$resultc = mysqli_query($mysqli_link, $find_incumbents_align);
		}
		else
		{
		$find_incumbents_align = "";
		}
		
		$incumbent_counter++;
		
		//if (strval($incumbent_award_amount)>2) { $award_amount_formatted = number_format($incumbent_award_amount,0); } else { $award_amount_formatted=""; }
		//$award_amount_formatted = money_format('$%i', $incumbent_award_amount); 
		//$award_amount_formatted = ""; number_format($incumbent_award_amount,0);
		if ((strpos($incumbent_website_url, 'http')!== false) && (strlen($incumbent_website_url)>2)) {
			//(strpos($haystack, $needle) !== false) 
			//FOUND REMOVE www.
			$incumbent_website_url = str_replace("www.","",$incumbent_website_url);
		} else {
			$incumbent_website_url = "https://" . $incumbent_website_url;
			$incumbent_website_url = str_replace("www.","",$incumbent_website_url);
		}
		
		$incumbent_website = "<a title='" . $incumbent_name . "' style='color:#2f40a2;' href='" . $incumbent_website_url . "' target='_blank'><img style='vertical-align: middle; height:16px; width:16px; margin-left:20px; position:relative; top:-1px;' src='hyperlink.jpg' alt='$incumbent_name'></a>";
		//$incumbent_website = "vertical-align: middle; height:16px; width:16px; margin-left:20px; position:relative; top:-1px;";
		
		$full_ref_link = "<a title='" . $incumbent_ref_link . "' style='color:#106b9a;' href='" . $incumbent_ref_link . "' target='_blank'>GovWin</a>";
		//$incumbent_container = "Incumbent " . $incumbent_name . "<BR>" . "Award Amount: " . $incumbent_award_amount; 
		/*<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>Spend to Date</div>
			<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_spend_to_date</div><BR>*/
		
		if ($incumbent_counter==1) {
		$incumbent_container = "
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100%);vertical-align:top; padding:8px 12px; overflow:auto; overflow-wrap:break-word; border:1px solid #d1d1d3; '>
		
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Incumbent</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_name $incumbent_website $incumbent_opportunity_id * $opp_opportunity_id THIS ONE</div><BR>
			
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Award Amount</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_award_amount</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Spend To Date</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$incumbent_spend_to_date</div><BR>
			
			<div class='incumbentcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px; '>Reference Link</div>
			<div class='incumbentvaluecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>$full_ref_link</div><BR>
			
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
			$more_incumbents .= "<div class='incumbentvaluecss' style='display:inline-block;width:100%;vertical-align:top; /*padding:8px 12px;*/ overflow:auto; overflow-wrap:break-word; /*border:1px solid #d1d1d3; margin-top:6px;*/ '>
		
			
			
			<div class='incumbentvaluecss' style='display:inline-block;width:100%;vertical-align:top; /*margin-bottom:7px;*/ '>$incumbent_name $incumbent_opportunity_id * $opp_opportunity_id</div><BR>
			$find_incumbents_align OK NOW<BR><BR>
			$find_incumbents
			
			</div>";				  }			  
		}
		if (strlen($proposal_id_a)<3) { $incumbent_container=""; }
	//STOP
	
	//$phrase  = "You should eat fruits, vegetables, and fiber every day.";
	//$healthy = [" ", "RFP", "No.", "SB", "(8A)", "8(a)"];
	//$yummy   = ["", "", "", "", "", ""];
	
	//$newPhrase = str_replace($healthy, $yummy, $proposal_ids);
	
	$contract_vehicle = $row[18]; 
	$opp_status = "<option hidden selected value='" . $row[19] . "'>" . $row[19] . "</option>"; 
	$agency = $row[20];
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
	
	$extra_table_content .= "<DIV style='background-color:#FFF; border:1px solid #c1c1c1; margin-bottom:20px;padding:6px;'><div style='font-size:16px; font-weight:700; /*background-color:#f7f7f9; border:1px solid #d1d1d3;*/ padding-left:5px; padding-right:5px; padding-top:5px; padding-bottom:7px; color:#106b9a;' class='' onclick=\"modalcompanyupdate($opp_opportunity_id, '$opp_title')\"><u><strong>$opp_title</strong></u> *** $opp_opportunity_id ^^^ <BR> $find_incumbents_align</div>
	
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
		
		
		<div onclick=\"modaldescriptionupdate($opp_opportunity_id, '$opp_title')\" class='incumbentvaluecss' style='font-weight: 700; /*padding: 5px;*/ text-decoration:underline; font-size:14px; color:#106b9a;'>Description</div>
		
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
		<div onclick=\"modalincumbentupdate($opp_opportunity_id, '$opp_title')\" class='incumbentvaluecss' style='font-weight: 700; text-decoration:underline; font-size:14px; color:#106b9a;'>Incumbent(s)</div>
		$incumbent_container
		$more_incumbents

		
	</div>
	
</DIV>";

	
	$table_content .= "<DIV style='background-color:#fff; border:1px solid #c1c1c1; margin-bottom:10px;padding:6px;'>
	
	<div style='font-size:13px; font-weight:700; padding-left:5px; padding-right:5px; padding-top:5px; padding-bottom:7px; color:#106b9a; width:33%; display:inline-block;' class='' onclick=\"modalcompanyupdate($opp_opportunity_id, '$opp_title')\"><u><strong>$opp_title</strong></u> *** $opp_opportunity_id<BR><div style='color:#141414; font-weight:500;'>Release Date: $opp_released</div>
	</div>
	
	
	<div style='width:33%;display:inline-block; vertical-align:top;margin-right:1%;padding:5px;'>
	
		<div class='fieldcss' style='display:inline-block;width:140px;vertical-align:top; margin-bottom:7px;'>$opp_response</div>
		<div class='valuecss' style='display:inline-block;width:calc(100% - 150px);vertical-align:top; margin-bottom:7px; '>
			<div style='width:100%; display:inline-block;'>$contract_vehicle $vehicle_one<BR>$contract_vehicle_two $vehicle_two</div>
			
		
		</div>
		
		
		
	</div>
	
	
	
	
  
	<div style='width:32%;display:inline-block; vertical-align:top;/*padding:5px;*/ '>
		<div onclick=\"modalincumbentupdate($opp_opportunity_id, '$opp_title')\" class='incumbentvaluecss' style='font-weight: 700; /*padding: 5px;*/ text-decoration:underline; font-size:13px; color:#106b9a;'>Incumbent(s)</div>
		
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
print($filterarea . "<div class='clearfix ' style='/*float:right;*/ display:inline-block;vertical-align:top;/*border:1px solid #d1d1d1;*/ width:96%; margin-left:2%;'>" . $header_part. $table_content . "</table></div>");
?>
<?php
print("<div style='width:100%; text-align:center;font-weight:700;'>Displaying: $count_results of $total_results</div><div style='height:10px;'></div>");
//print("<div style='width:100%; text-align:center;font-weight:700;'># of Rows found: $count_results</div><div style='height:10px;'></div>");

/*print ("<div class=\"w3-container\" id=\"projects\">
    	<h5 class=\"\" style=\"text-align:center;\">Total Events: <strong>$event_counter</strong></h5>
  	</div>");*/
?>


  

<!-- End page content -->
</div>
<!-- Trigger/Open The Modal -->
<!--<button id="myBtn">Open Modal RCS</button>-->

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3 style="margin:4px 0;"><span id='event-modal-header'>Modal Header</span></h3>
    </div>
    <div class="modal-body">
      <div id="ajaxevent">EMPTY</div>
    </div>
    <!--<div class="modal-footer">
      <h3>Modal Footer</h3>
    </div>-->
  </div>

</div>

<div id="myFilters" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header" style='background-color:#f1f1f1; color:#141414;'>
      <span id='filterclose' onClick="filtercloseclick();" style='color:#141414;font-size:15px;' class="close">Apply</span>
      <h3 style="margin:4px 0;"><span id='event-modal-header'>Filters</span></h3>
    </div>
    <div class="modal-body">
      <div id="filterresults">EMPTY</div>
    </div>
    <!--<div class="modal-footer">
      <h3>Modal Footer</h3>
    </div>-->
  </div>

</div>
<!-- The Modal -->
<div id="contactModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3 style="margin:4px 0;"><span id='event-modal-header2'>Modal Header2</span></h3>
    </div>
    <div class="modal-body">
      <div id="ajaxevent">EMPTY</div>
    </div>
    <!--<div class="modal-footer">
      <h3>Modal Footer</h3>
    </div>-->
  </div>

</div>


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
	//window.location.href = "https://ardentinc.com/bids-test/contacts.php?search=bob&search_type=contacts";
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
</body>
</html>