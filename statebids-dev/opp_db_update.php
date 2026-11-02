<?php
//print("YEP ...");
//exit();

$this_page_name="AJAX OPPORTUNITY UPDATE";
include("./includes/connect_portal123.php");
$secure_webpage=0;
////include($_SERVER['DOCUMENT_ROOT'] . "include/it_loader.php");

print("<style>
.samewidth { width:240px; font-weight:700;}
</style>");
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

//$which_update_id=$_GET['which_update_id'];
/* portal.ardentinc.com/bids-test/opp_db_update.php?opp_bidopp=70098PR220070162++8%28a%291&opp_response=DRAFT+RFP&opp_requestor=Katherine+West&opp_title=USCG+Government+Purchase+Card+Program&opp_due=TBD&opp_released=opp_released&opp_pop=Period%3A+1+Base+Year+%2B+4+Option+Years%3CBR%3EPlace%3A+USCG+HQ%2C+Washington+DC&opp_synopsis=opp_synopsis&opp_proposal=VOLUME+1%3CBR%3EFactor+1+-+Corporate+Experience+%28Description+of+relevant+and+recent+corporate+experience%29%3CBR%3EFactor+2+-+Key+Personnel+Qualifications+%28Resumes+and+LOCs%29%3CBR%3EFactor+3+-+Past+Performance+%28At+least+3%2C+can+come+from+subs%29%3CBR%3EVOLUME+2%3CBR%3EPrice&opp_pricing=FFP&opp_recruiting=LCATS%3A%3CBR%3ESenior+Project+Manager+%28KEY%29%3CBR%3EProject+Manager%3CBR%3EProgram+Analysts+%28i%2C+ii%2C+iii%29&opp_gaps=&opp_decision=&opp_opportunity_id=1&token=3ac9793a4cf144fe1afb17a850b91b4908d60f1d */

if (isset($_GET['opp_opportunity_id'])) { $opp_opportunity_id = $_GET['opp_opportunity_id']; } else { $opp_opportunity_id=0; }
if (isset($_GET['opp_bidopp'])) { $opp_bidopp = $_GET['opp_bidopp']; } else { $opp_bidopp=0; }
if (isset($_GET['opp_response'])) { $opp_response = $_GET['opp_response']; } else { $opp_response=0; }
if (isset($_GET['opp_requestor'])) { $opp_requestor = $_GET['opp_requestor']; } else { $opp_requestor=0; }
if (isset($_GET['opp_title'])) { $opp_title = $_GET['opp_title']; } else { $opp_title=0; }
if (isset($_GET['opp_due'])) { $opp_due = $_GET['opp_due']; } else { $opp_due=0; }
if (isset($_GET['opp_released'])) { $opp_released = $_GET['opp_released']; } else { $opp_released=0; }
if (isset($_GET['opp_pop'])) { $opp_pop = $_GET['opp_pop']; } else { $opp_pop=0; }
if (isset($_GET['opp_synopsis'])) { $opp_synopsis = $_GET['opp_synopsis']; } else { $opp_synopsis=0; }
if (isset($_GET['opp_proposal'])) { $opp_proposal = $_GET['opp_proposal']; } else { $opp_proposal=0; }
if (isset($_GET['opp_pricing'])) { $opp_pricing = $_GET['opp_pricing']; } else { $opp_pricing=0; }
if (isset($_GET['opp_recruiting'])) { $opp_recruiting = $_GET['opp_recruiting']; } else { $opp_recruiting=0; }

if (isset($_GET['opp_gaps'])) { $opp_gaps = $_GET['opp_gaps']; } else { $opp_gaps=0; }
if (isset($_GET['opp_decision'])) { $opp_decision = $_GET['opp_decision']; } else { $opp_decision=0; }
	

//print("hello " . $opp_opportunity_id);

//$mysqli_link = mysqli_connect('portal.ardentinc.com',$db_user, $db_password,'bidsnew');

$query = "UPDATE state_excel_test SET bidopp='$opp_bidopp', response='$opp_response', requestor='$opp_requestor', title='$opp_title', due='$opp_due', released='$opp_released', pop='$opp_pop', synopsis='$opp_synopsis', proposal='$opp_proposal', pricing='$opp_pricing', recruiting='$opp_recruiting', gaps='$opp_gaps', decision='$opp_decision'  
WHERE opportunity_id = $opp_opportunity_id";
//print $query;
$result = mysqli_query($mysqli_link, $query);

//print $query;

//header("Location: https://ardentinc.com/bids-test/"); 
//exit();
?>