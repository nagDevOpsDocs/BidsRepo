<?php
include("./includes/connect_portal123.php");

$getres = mysqli_query($mysqli_link,"SELECT opportunity_id, contractveh_table FROM excel_test WHERE contractveh_table != ''");

if(mysqli_num_rows($getres) > 0)
{
	while($rec = mysqli_fetch_array($getres))
	{
		$getrow = explode("|||",$rec[1]);
		//$vehone = $getrow[0].'|||'.$getrow[1];
		/*if(empty($getrow[2]))
		{
			$vehtwo = '';
			$getrow = '';
		}
		else
		{
			$vehtwo = $getrow[2].'|||'.$getrow[3];
		}*/
		//echo $vehtwo.'<br>';
		mysqli_query($mysqli_link,"UPDATE excel_test SET vehicle_one='".$getrow[1]."', vehicle_two='".$getrow[3]."', contract_vehicle='".$getrow[0]."', contract_vehicle_two='".$getrow[2]."' WHERE opportunity_id='".$rec[0]."'");
	}
	echo "Completed";
}
else
{
	echo "Rows not found";
}
/*$getres = mysqli_query($mysqli_link,"SELECT opportunity_id, vehicle_one, vehicle_two, contract_vehicle, contract_vehicle_two FROM excel_test WHERE contractveh_table = ''");

if(mysqli_num_rows($getres) > 0)
{
	while($rec = mysqli_fetch_array($getres))
	{
		if($rec[4] != '')
		{
			$vehtwo = $rec[4].'|||'.$rec[2];
		}
		else
		{
			$vehtwo = '';
		}
		if($rec[3] != '')
		{
			$vehone = $rec[3].'|||'.$rec[1];
		}
		else
		{
			$vehone = '';
		}
		$vehicle = $vehone.'|||'.$vehtwo.'|||';
		echo $vehone.'ONE<br>';
		echo $vehtwo.'TWO<br>';
	}
	echo "Completed;";
}
else
{
	echo "Rows not found";
	exit;
}*/

?>