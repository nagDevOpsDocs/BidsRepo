<?php 
	session_start();
	//error_reporting(E_ALL); ini_set('display_errors', '1'); 
	include("./includes/connect_portal123.php");

	
// Read raw input
$json = file_get_contents("php://input");

// Convert JSON to PHP array
$data = json_decode($json, true);

// Access value
$name = $data['name'];
//VEHICLE PULL
//$vehicle_list = "";
//$vehicle_checkboxes = "";

$vehicle_query = "SELECT vehicle_id, vehicle_name FROM state_contract_vehicles WHERE groupBy = '".$name."' AND vehicle_show=1 ORDER BY vehicle_name";
$vehicle_result = mysqli_query($mysqli_link, $vehicle_query);
while($row = mysqli_fetch_array($vehicle_result, MYSQLI_NUM))
    {
	$db_vehicle_name = $row[1];
	//$vehicle_list .= "<option value='$db_vehicle_name'>$db_vehicle_name</option>";
	/*	if (isset($_GET['vehicle']))  
		{  
			if(in_array($db_vehicle_name, $_GET['vehicle']))
			{
				$vehicle_checkboxes .= "<input type='checkbox' class='vehicles' id='$db_vehicle_name' name='vehicle[]' value='$db_vehicle_name' checked>
							  <label for='vehicle[]'> $db_vehicle_name</label><br>";
			}
			else
			{
				$vehicle_checkboxes .= "<input type='checkbox' class='vehicles' id='$db_vehicle_name' name='vehicle[]' value='$db_vehicle_name'>
							  <label for='vehicle[]'> $db_vehicle_name</label><br>";
			}
		}
		else
		{ */
			$vehicle_checkboxes .= "<input type='checkbox' class='vehicles' id='$db_vehicle_name' name='vehicle[]' value='$db_vehicle_name'>
							  <label for='vehicle[]'> $db_vehicle_name</label><br>";
//		}
	}
	 echo $vehicle_checkboxes;
?>