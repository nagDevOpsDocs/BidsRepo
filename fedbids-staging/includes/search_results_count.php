<?php
include("./includes/connect_portal123.php");
$secure_webpage=0;
//$mysqli_link = mysqli_connect('portal.ardentinc.com',$db_user, $db_password,'bidsnew');

$query = "SELECT COUNT(*)   
FROM full_03_poc  
WHERE company_name LIKE '%$search_this%' 
OR website LIKE '%$search_this%' 
OR poc_name LIKE '%$search_this%' 
OR poc_email LIKE '%$search_this%'  
OR poc_phone LIKE '%$search_this%'  
ORDER BY company_id";

$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$search_results_companies = $row[0];
	}

$query = "SELECT COUNT(*)   
FROM poc  
WHERE company_name LIKE '%$search_this%' 
OR website LIKE '%$search_this%' 
OR poc_name LIKE '%$search_this%' 
OR poc_email LIKE '%$search_this%'  
OR poc_phone LIKE '%$search_this%' 
OR poc_title LIKE '%$search_this%'  
ORDER BY company_id";
//print $query;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$search_results_company_contacts = $row[0];
	}
	
$query = "SELECT COUNT(*)   
FROM government_contacts  
WHERE gov_contact_agency LIKE '%$search_this%' 
OR gov_contact_name LIKE '%$search_this%' 
OR gov_contact_email LIKE '%$search_this%' 
OR gov_contact_phone LIKE '%$search_this%'  
OR gov_contact_title LIKE '%$search_this%'  
ORDER BY gov_contact_id";
//print $query;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$search_results_gov_contacts = $row[0];
	}
	
/*$query = "SELECT COUNT(*)  
FROM temp_opportunities  
WHERE opportunity_details LIKE '%$search_this%' 
OR bidnumber LIKE '%$search_this%' 
OR opportunity_description LIKE '%$search_this%' 
OR opportunity_title LIKE '%$search_this%'  
OR agency LIKE '%$search_this%' 
OR naics LIKE '%$search_this%' 
OR url LIKE '%$search_this%'  
ORDER BY opportunity_id";*/
$query = "SELECT COUNT(*) 
FROM bp_transfer   
WHERE state LIKE '%$search_this%' 
OR projecttitle LIKE '%$search_this%' 
OR dept LIKE '%$search_this%' 
OR url LIKE '%$search_this%' 
OR mastercontracts LIKE '%$search_this%' 
OR status LIKE '%$search_this%' 
OR bidnumber LIKE '%$search_this%' 
OR source LIKE '%$search_this%'";
//print $query;
$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
	$search_results_opportunities = $row[0];
	}
/*print("
counting ...
");*/
//<div style='display: inline;/*background-color:red;*/ top:7px;left: 32%;position:relative;font-size:15px;font-weight:700;color:#fff;'>$search_area</div>
//$search_results_gov_contacts = 1234;
//$search_results_company_contacts = 43;
//$search_results_companies = 487;
//$search_results_opportunities = 1743;
?>