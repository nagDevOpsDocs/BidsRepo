<?php
//ini_set ('display_errors', 1);  
//ini_set ('display_startup_errors', 1);  
//error_reporting (E_ALL);

include("./includes/connect_portal123.php");

$partner_filename = $mysqli_link->real_escape_string(basename($_FILES["file"]["name"]));
$ref_opportunity_id = $_POST['ref_opportunity_id'];

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {

$targetDir = $_SERVER['DOCUMENT_ROOT'] . '/fedbids/documents/';
  $fileName = $_FILES['file']['name'];
  $targetFile = $targetDir . basename($fileName);

 $time = time();
$targetDir = $_SERVER['DOCUMENT_ROOT'] . '/fedbids/documents/';
$target_file = $targetDir . basename($_FILES['file']['name']);
if(!empty($_FILES['file']['tmp_name'])) {
		$sourcePath = $_FILES['file']['tmp_name'];
		$file_description = pathinfo($target_file,PATHINFO_FILENAME);
		$file_extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
		$rand_value = $time.'_'.rand(1,100000);
		$ins_filename = $rand_value.'.'.$file_extension;
		$targetPath = $targetDir.$rand_value.'.'.$file_extension;
		if(move_uploaded_file($sourcePath,$targetPath)) {
			mysqli_query($mysqli_link,"INSERT INTO documents (opportunity_id, filename, filedesc, filetype, documents_username,renew_filename) VALUES ($ref_opportunity_id,'$partner_filename','$file_description','$file_extension', 'ardent_portal_email','$ins_filename')");
	}
	else
	{
		echo "Unable to upload the file, please try again.";
	}
  }
}

$partner_list = "";
$result = mysqli_query($mysqli_link,"SELECT filedesc, filetype, filetimestamp, renew_filename, document_id FROM documents WHERE opportunity_id='".$ref_opportunity_id."'");
//$result = mysqli_query($mysqli_link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
{
	$screen_filedesc = ucfirst($row[0]);
	$screen_filetype = strtoupper($row[1]);
	$screen_filetime = strtotime($row[2]);
	$renew_filename = $row[3];
	$document_id = $row[4];
	$screen_filetimeformatted = date("m/d/Y", $screen_filetime);

	$partner_list .= "<div style='padding:3px;'>
	<div style='width:68%; display:inline-block;'><a style='color:#181818;' href='$baseurl/documents/" . $renew_filename . "' target='_blank'>" . $screen_filedesc . "</a></div>
	<div style='width:15%; display:inline-block;'>$screen_filetype</div>
	<div style='width:15%; display:inline-block;'>$screen_filetimeformatted</div>
	<div style='width:15%; display:inline-block;'><button class='delete' id='delete_".$document_id."'	style='cursor:pointer;'>Delete</button></div>
	</div>";
}
print $partner_list;
?>