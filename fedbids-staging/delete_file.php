<?php
session_start();
//ini_set ('display_errors', 1); ini_set ('display_startup_errors', 1); error_reporting (E_ALL);
include("./includes/connect_portal123.php");
$file_id = $_POST['id'];
$ref_opportunity_id = $_POST['oppId'];
$deleted_status = mysqli_query($mysqli_link,"DELETE FROM documents WHERE document_id = ".$file_id);

$getemail = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT user_email FROM users WHERE user_id='".$_SESSION['user_id']."'"));
$profile_email = $getemail[0];

$visitor_ip = $_SERVER['REMOTE_ADDR'];
$now = date('Y-m-d H:i:s');

$query = mysqli_query($mysqli_link,"INSERT INTO history_log (history_opp_id, history_username, history_ip, history_timestamp, history_field, old_value, new_value) VALUES ($ref_opportunity_id, '$profile_email', '$visitor_ip', '$now', 'File', '', 'Deleted')");

$result = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT renew_filename FROM documents WHERE document_id = ".$file_id));
$file_name_on_server = $result[0];

unlink($_SERVER['DOCUMENT_ROOT'].'/fedbids-staging/documents/'.$file_name_on_server);


$partner_list = "";
$result = mysqli_query($mysqli_link,"SELECT filedesc, filetype, filetimestamp, renew_filename, document_id FROM documents WHERE opportunity_id=".$ref_opportunity_id);
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
	<div style='width:50%; display:inline-block;'><a style='color:#181818;' href='$baseurl/documents/" . $renew_filename . "' target='_blank'>" . $screen_filedesc . "</a></div>
	<div style='width:15%; display:inline-block;'>$screen_filetype</div>
	<div style='width:15%; display:inline-block;'>$screen_filetimeformatted</div>
	<div style='width:15%; display:inline-block;'><button class='delete' id='delete_".$document_id."' style='cursor: pointer;'>Delete</button></div>
	</div>";
}
print $partner_list;
?>