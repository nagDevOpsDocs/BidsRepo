<?php
$business_entity_name = ''; $errorMessage = '';
session_start();
include("./includes/connect_portal123.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  if (empty($_POST["business_entity_name"])) {
		$errorMessage = "Please provide contract vehicle name.";
	  } else {
		$business_entity_name = ($_POST["business_entity_name"]);
	  }
}

if(isset($_POST['submit']))
	{ 
		if($errorMessage == '') {
		 $status = mysqli_query($mysqli_link,"INSERT INTO business_entities (entity_name, entity_show) VALUES ('$business_entity_name', 1)");
			if($status)
			{
//				$message = "Contract Vehicle added successfully.";
				echo "<script type='text/javascript'>alert('Business Entity added successfully.');</script>";
			}
			else
			{
//				$message = "Adding Contract Vehicle Failed.";
				echo "<script type='text/javascript'>alert('Business Entity addition failed.');</script>";
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
  </style>
  </head>
 <body style="font-family:'Roboto', sans-serif";>

<div style="text-align:center;font-size:22px;font-weight:700;color:#3c4db0;margin-bottom:15px; ">Add Business Entity</div>

<?php //if(isset($message)) { echo "<div style='text-align: center; color: blue; font-weight: bold;'>$message<style></div>"; } ?>

<form name="ContractVehAddForm" id="ContractVehAddForm" action="" method="post">
	<table width='100%' border='0' cellspacing='5' cellpadding='5'>
		<tr><td width='189'><strong> Business Entity Name</strong> <span style='font-size:16px; font-weight:700; color:#3c4db0;' title='Required Field'>*</span></td><td class='td-left'>
	<input style='width:360px; border:1px solid #cbcbcb; padding:5px; border-left:5px solid #3c4db0;' name='business_entity_name' id='business_entity_name' autocomplete='off' type='text' />
	<span style='margin-left: 18px; color: red; font-weight: bold;'><?php if(isset($errorMessage)){echo $errorMessage;}?></span>
	</td></tr>

		<tr>
			<td colspan="2">
				<input style="50px; padding:4px 16px; width:100px; font-weight: 700; margin-left: 360px;" type="submit" name="submit" value="Add" /> 
			</td>
		</tr>
	</table>
</form>

<!-- <table width='80%' border='1' cellspacing='5' cellpadding='5' align="center">
<tr align="center"> Contract Vehicle List</tr>
<?php
	// $query = mysqli_query($mysqli_link,"SELECT vehicle_name FROM contract_vehicles WHERE vehicle_show = 1 ORDER BY vehicle_name");
	// $i = 1;
	// while($row = mysqli_fetch_array($query, MYSQLI_NUM)){
	//		$contract_vehicle_name = $row[0];	
?>
	<tr>
		<td><?php //echo $i; ?></td>
		<td><?php //echo $contract_vehicle_name;?></td>
	</tr>
<?php	//$i ++; 
	//   }
?>
</table> -->
</body>
</html>