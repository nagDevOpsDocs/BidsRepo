<?php
	$this_page_name="AJAX GET INCUMBENT NAMES";
	include("./includes/connect_portal123.php");
	$search_string = $_POST['search_string'];
	if ($search_string != '') {
		$query = "SELECT DISTINCT incumbent_name FROM incumbents_test WHERE incumbent_name LIKE '%$search_string%'";
		$result = mysqli_query($mysqli_link, $query);
		$string = array();
		while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			$string[] = $row[0];
		}
		echo json_encode($string);
	}
?>