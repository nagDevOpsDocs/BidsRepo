<?php
$contract_veh_name = ''; $errorMessage = ''; $errorMessage1 = ''; $group = '';
session_start();
//error_reporting(E_ALL); ini_set('display_errors', '1'); 
include("./includes/connect_portal123.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  if (empty($_POST["master_contract_name"])) {
		$errorMessage = "Please provide master contract name.";
	  } else {
		$master_contract_name = ($_POST["master_contract_name"]);
	  }
	  if (empty($_POST["group"])) {
		$errorMessage1 = "Please provide group name.";
	  } else {
		$group = $_POST['group'];
	  }
}

if(isset($_POST['submit']))
	{ 
		if($errorMessage == '') {
		 $status = mysqli_query($mysqli_link,"INSERT INTO state_contract_vehicles (vehicle_name, vehicle_show, groupBy) VALUES ('$master_contract_name', 1, '$group')");
			if($status)
			{
//				$message = "Contract Vehicle added successfully.";
				echo "<script type='text/javascript'>alert('Master contract added successfully.');</script>";
			}
			else
			{
//				$message = "Adding Contract Vehicle Failed.";
				echo "<script type='text/javascript'>alert('Master contract addition failed.');</script>";
			}
		}
	}
?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>BidPortal</title>

  <style type="text/css">
	#div2 {float:left; margin-left:50px; width:130px;}
	body, input, table, td {font-family: 'Roboto', sans-serif; font-size:12px;}
  </style>
  </head>
 <body style="font-family:'Roboto', sans-serif";>

<div style="text-align:center;font-size:22px;font-weight:700;color:#3c4db0;margin-bottom:15px; margin-top:20px ">Add Contract Vehicle</div>

<?php //if(isset($message)) { echo "<div style='text-align: center; color: blue; font-weight: bold;'>$message<style></div>"; } ?>

<form name="ContractVehAddForm" id="ContractVehAddForm" action="" method="post">
	<table border='0' cellspacing='5' cellpadding='5' align="center">
		<tr>
			<td><b>Master Contract Name</b> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td>
			<td>
				<input style='width:344px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' name='master_contract_name' id='master_contract_name' autocomplete='off' type='text' required/>
				<span style='margin-left: 18px; color: red; font-weight: bold;'><?php if(isset($errorMessage)){echo $errorMessage;}?></span>
			</td>
		</tr>
		<tr>
			<td><strong>Group By</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span>
			</td>
			<td>
				<select style='width:360px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' name='group' id='group' required>
						<option value="">--Select--</option>
						<option value="Project">Project</option>
						<option value="Staffing">Staffing</option>
						<option value="Others">Others</option>
				</select> 
			</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td>
				<input style="50px; padding:4px 16px; width:100px; font-weight: 700;" type="submit" name="submit" value="Add" /> 
			</td>
		</tr>
	</table>
</form>

</body>
</html>