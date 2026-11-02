<?php
session_start();
include("./includes/connect_portal123.php");

if($_SESSION['user_role']==''){ header("Location: $login");  }

$button_page_reference = "opportunities";
$this_page_name="Ardent Capture System";

$secure_webpage=0;

$search_this= "";
if (!empty($_GET['search'])) { $search_this = $_GET['search']; $_SESSION["search"] = "?search=" . $search_this; } else { $_SESSION["search"] = ""; }
if (!empty($_GET['status'])) { $status =  " STATUS='" . $_GET['status'] . "' AND "; $_SESSION["status"] = "?status=" . $status; } else { $_SESSION["status"] = ""; $status="";}

if (!empty($_GET['cv1']) && ($_GET['cv1']==1)) { $cv1 = 1; } else { $cv1 = 0; }
if (!empty($_GET['cv2']) && ($_GET['cv2']==1)) { $cv2 = 1; } else { $cv2 = 0; }


$search_area="
<div style='z-index:3; /*background-color:red;*/ width:50%; margin-left:25%; position:fixed; text-align:center; top:9px;'></div>";

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
<body>


<?php 
$selname = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT firstname,lastname FROM users WHERE user_id='$_SESSION[user_id]'"));
$login_name = $selname[0].' '.$selname[1];

include("includes/header.php"); 
?>

<div style="height:42px;"></div>
<div id='menu_group' style="width:100%; z-index:2; /* margin-left: 2%; background-color:#404f96; */padding: 8px 2%; background-color: #f9f9f9; position: fixed; border-bottom: 1px solid #bdbdc4;-webkit-box-shadow: 0px 3px 10px -4px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 3px 10px -4px rgba(0,0,0,0.75);
box-shadow: 0px 3px 10px -4px rgba(0,0,0,0.75);">
    <div class="btn-group">
    <?php include("includes/menu_group.php"); ?>
     
    </div>
    
    <div class="btn-group" style='float:right;'> 
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
            
            <!--<button onclick="dropdownshow()" class="dropbtn">Dropdown</button>-->
              <div id="myDropdown" class="dropdown-content">
                <a href="executive.php">Executive Dashboard</a>
                <a href="proposals.php">Proposals</a>
                <a href="sales.php">Sales</a>
              </div>
            </div>
    </div>
    <!--<div style="float:right; margin-right:5px;"><i onclick="alert('hello');" title="Add New Entry" class="dropbtn fa fa-plus-circle" style='font-size: 16px;
            padding-right: 10px;
            display: inline-block;
            border-radius:0px;
            box-shadow: 0 0 2px #1f2662;
            color: #fcfcfa;
            background-image: linear-gradient( #6e83e6, #1c2445);
            padding: 0.3em 0.4em;
            margin-top: 6px;
            '></i>
    </div>-->
    <div class="btn-group" style='float:right;'>
    <button style="float:right; margin-right:5px; display:none;" onclick="modaloppadd()" class='button'><i class='fa fa-plus-circle' style='font-size:16px;padding-right:10px;'></i>Add</button>
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

<div style="clear:both; height:54px;"></div>
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

$last_company_name = "";
$company_builder = "";
$co_website_array = "";

$opportunities_found = 0;
$gov_contacts_found = 0;
$company_info_found = 0;
$company_contacts_found = 0;

//$mysqli_link = mysqli_connect('portal.ardentinc.com',$db_user, $db_password,'bidsnew');

?>


<div id="pie" style="padding:15px; font-weight:500; color:#464864; font-weight:700; font-size:16px;">Pie Chart<BR />
    		<iframe src="<?php echo $baseurl; ?>/dev/charts/pie.php" style="width:100%; height:600px; background-color:#FFF; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid;"></iframe>
		</div>


  

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
	url: "ajax_opportunities_add.php",
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
//alert("Nachos");
	//var valueb = document.getElementById('decision');
	//var comparevalue = valueb.toLowerCase();
	//var manager = document.getElementById('manager');
	//alert("Name " + namea + " Value " + valueb + " ID " + idc);
	//if ((comparevalue==='bid') || (comparevalue==='on hold')) { manager.style.display = 'block'; } else { manager.style.display = 'none'; }
</script>
<script>
var coll = document.getElementsByClassName("collapsible_bid");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
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
</body>
</html>