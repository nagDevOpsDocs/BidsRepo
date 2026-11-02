<?php 
if ($button_page_reference == "opportunities") { $button_is_active1 = "thispagebutton"; } else { $button_is_active1 = ""; }
if ($button_page_reference == "government") { $button_is_active2 = "thispagebutton"; } else { $button_is_active2 = ""; }
if ($button_page_reference == "companies") { $button_is_active3 = "thispagebutton"; } else { $button_is_active3 = ""; }
if ($button_page_reference == "contacts") { $button_is_active4 = "thispagebutton"; } else { $button_is_active4 = ""; }

$searchsuffix = "";
if (isset($_SESSION['search'])) { $searchsuffix = $_SESSION['search']; }


      /*<button onclick=\"window.location.href='index.php" . $searchsuffix . "';\" class='button $button_is_active1'><i class='fa fa-money' style='font-size:16px;padding-right:10px;'></i>Opportunities<span class='search_results2' style=''>$search_results_opportunities</span></button>*/
      
print ("<button onclick=\"window.location.href='companies.php" . $searchsuffix . "';\" class='button $button_is_active3'><i class='fa fa-handshake-o' style='font-size:16px;padding-right:10px;'></i>Companies<span class='search_results2' style=''>$search_results_companies</span></button>
      <button onclick=\"window.location.href='contacts.php" . $searchsuffix . "';\" class='button $button_is_active4'><i class='fa fa-address-card-o' style='font-size:16px;padding-right:10px;'></i>Contacts<span class='search_results2' style=''>$search_results_company_contacts</span></button>
      "); 
	  
	  /*<button onclick=\"window.location.href='government.php" . $searchsuffix . "';\" class='button $button_is_active2'><i class='fa fa-star-o' style='font-size:16px;padding-right:10px;'></i>Government Contacts<span class='search_results2' style=''>$search_results_gov_contacts</span></button>*/
	  
	  ?>
