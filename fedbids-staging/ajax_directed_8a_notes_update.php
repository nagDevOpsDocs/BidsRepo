<?php
include("./includes/connect_portal123.php");

if($_SERVER['REQUEST_METHOD'] === 'POST') {

$opp_opportunity_id = $_POST['direct_8a_notes_oppid'];

if(isset($_POST['d8notes'])) { $opp_8a_notes = htmlentities($_POST['d8notes']); } else { $opp_8a_notes=""; }

$query = "UPDATE excel_test SET notes_datateam = '$opp_8a_notes' WHERE opportunity_id = $opp_opportunity_id";

$result = mysqli_query($mysqli_link, $query);

	if($result){
	   echo "Updated successfully.";
	}
	else{
		echo "Error in details.";
	}
}
?>