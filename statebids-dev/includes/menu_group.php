<?php 
if ($button_page_reference == "opportunities") { $button_is_active1 = "thispagebutton"; } else { $button_is_active1 = ""; }
if ($button_page_reference == "government") { $button_is_active2 = "thispagebutton"; } else { $button_is_active2 = ""; }
if ($button_page_reference == "companies") { $button_is_active3 = "thispagebutton"; } else { $button_is_active3 = ""; }
if ($button_page_reference == "contacts") { $button_is_active4 = "thispagebutton"; } else { $button_is_active4 = ""; }

$searchsuffix = "";
if (isset($_SESSION['search'])) { $searchsuffix = $_SESSION['search']; }
	  $searchsuffix = "";
	  print("
	  <button onclick=\"window.location.href='$baseurl/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review" . $searchsuffix . "';\" class='button'>
	  Bid Agenda</button>
      ");
	  ?>