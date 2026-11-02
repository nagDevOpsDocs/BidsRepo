<?php
include("./includes/connect_portal123.php");


if($_GET['dec'] != '')
{
	$dec = $_GET['dec'];
}
else
{
	$dec = '';
}

if($_GET['veh'] != '')
{
	$veh = $_GET['veh'];
}
else
{
	$veh = '';
}

if($_GET['dateqry'] != '')
{
	$dateqry = $_GET['dateqry'];
}
else
{
	$dateqry = '';
}

$cur_date = date("d-m-Y h:i:sa");
$export_filename = "$cur_date.xls";

$header = '';
$arr = array(
'S No',
'Title',
'Released',
'Proposal Due',
'Decision',
'Manager');

for($i = 0; $i < 6; $i++)
{
 	 $header .= $arr[$i]."\t"; 
}

	$i = 0;  
	$j = 0; 
	$k = 1;
		
 $qry = mysqli_query($mysqli_link, "SELECT title,released,proposal_due,decision, manager FROM state_excel_test WHERE opportunity_id>0 $dec $veh");


	if(mysqli_num_rows($qry)>0)
	{
		
		while($res = mysqli_fetch_array($qry)){

		/*
		$contrctveh_in = $res[0];
		$contrctveh = "";

		if (strpos($contrctveh_in, '|||') !== false) {
				$ok = explode("|||",$contrctveh_in);
				$i = 0;
				$temp_variable = "";
				while($i<count($ok)){
					if($ok[$i] or $ok[$i+1]){
						$temp_variable .= $ok[$i]."&nbsp;-&nbsp;".$ok[$i+1]."<br/>";	
					}
					$i = $i+2;
				}
		}		
		 else { 
			 $contrctveh = $temp_variable; 
		}
		 */

			$data = "";
			$line = "";
		
		$val1 = str_replace('"', '""', $k);
		$data .= '"' . $val1 . '"' . "\t";
		
		$val2 = str_replace('"', '""', $res[0]);
		$data .= '"' . $val2 . '"' . "\t";
		
		$val3 = str_replace('"', '""', $res[1]);
		$data .= '"' . $val3 . '"' . "\t";

		$val4 = str_replace('"', '""', $res[2]);
		$data .= '"' . $val4 . '"' . "\t";

		$val5 = str_replace('"', '""', $res[3]);
		$data .= '"' . $val5 . '"' . "\t";

		$val6 = str_replace('"', '""', $res[4]);
		$data .= '"' . $val6 . '"' . "\t";
		
		$line .= $data;
		$data1 .= trim($line)."\n";

		$k++;
		}	
	}	

$data2 = str_replace("\r", "", $data1);	
$size = $header."\n".$data2;  
header("Content-type: application/octet-stream");
//header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$export_filename");
header("Cache-Control: public");
header("Content-length: ".strlen($size));
header("Pragma: no-cache");
header("Expires: 0");
echo $header."\n".$data2;
?>