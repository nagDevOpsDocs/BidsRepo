<?php 
	session_start();
	include("./includes/connect_portal123.php");
	$code   = $_POST['codeValue'];
	$query  = "SELECT naics_industry_description, ss_million_dollars, ss_employee_count FROM naics_codes WHERE naics_code = '".$code."'";
	$result = mysqli_query($mysqli_link, $query);
	$row	= mysqli_fetch_array($result, MYSQLI_NUM);
	if($row[1] != '')
	  $returnedValue = $row[1];
	else
	  $returnedValue = $row[2];

	  echo $row[0]."&".$returnedValue;
?> 