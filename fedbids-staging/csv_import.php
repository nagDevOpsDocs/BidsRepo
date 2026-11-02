<?php
//ini_set('display_errors', '1'); error_reporting(E_ALL);
include("./includes/connect_portal123.php");
	$fname	  = "./naics_codes_and_size_standards.csv";
    $filename =  $fname;
      if(file_exists($filename)) { 
		  $count	 = 0;
		  $dot_count = 0;
          $file		 = fopen($filename, "r");

           while(($importdata = fgetcsv($file, 10000, ",")) !== FALSE) {
					if(trim($importdata[0]) != '')
					$data['naics_code'] = trim($importdata[0]);

					if(trim($importdata[1]) != '')
					$data['naics_industry_description'] = trim($importdata[1]);
 
					if(trim($importdata[2]) != '')
					$data['ss_million_dollars'] = trim($importdata[2]);
 
					if(trim($importdata[3]) != '')
					$data['ss_employee_count'] = trim($importdata[3]);
 
					$data = array(
					  'naics_code'						  => $importdata[0],
					  'naics_industry_description'		  => $importdata[1],
					  'ss_million_dollars'				  => $importdata[2],
					  'ss_employee_count'				  => $importdata[3]
					);
					$code		 = $data['naics_code'];
					$description = $data['naics_industry_description'];
					$md			 = $data['ss_million_dollars'];
					$ec			 = $data['ss_employee_count'];

				  $res = mysqli_query($mysqli_link,"INSERT INTO naics_codes (naics_code, naics_industry_description, ss_million_dollars, ss_employee_count) VALUES ('$code', '$description', '$md', '$ec')");

					  if($res) { echo  $count+1 . "  Record(s) Copied. <br/>";}
					  $count++;
		   } 
			echo "<h3>Import completed.</h3><br />Total Imported Records = ".$count; 
			fclose($file);
        }
		else{
			echo "Source file is Not found! - <b>{$fname}</b>";
		}
?>