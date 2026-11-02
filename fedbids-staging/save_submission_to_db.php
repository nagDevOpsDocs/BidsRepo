<?php
$this_page_name = "AJAX OPPORTUNITY UPDATE";
//include($_SERVER['DOCUMENT_ROOT'] . "/include/connect_db.php");
include("./includes/connect_portal123.php");
$secure_webpage = 1;
//include($_SERVER['DOCUMENT_ROOT'] . "/include/it_loader.php");
////include($_SERVER['DOCUMENT_ROOT'] . "include/it_loader.php");

//$mysqli_link = mysqli_connect('portal.ardentinc.com', $db_user, $db_password, 'bidsnew');

// Retrieve the value of oppSynopsis and opp_id from the POST request
$opp_proposal = $_POST['opp_proposal'];
$opp_id = $_POST['opp_id'];

// Check if the connection to the database was successful
if ($mysqli_link->connect_error) {
    die("Connection failed: " . $mysqli_link->connect_error);
}
/*else
{
	print("Connected");
}*/

function stripToNotepadValues($text) {
    $strippedText = preg_replace("/[^a-zA-Z0-9\r\n]+/", '', $text);
    return $strippedText;
}

$strippedText = stripToNotepadValues($opp_proposal);
//echo $strippedText;

// Get the content from summernote
$content = $_POST['opp_proposal'];

//print("...<BR>". $content);
// Remove unwanted HTML tags
$allowedTags = '<p><a><ul><ol><li><strong><em><b><i><BR>';
$stripped_content = strip_tags($content, $allowedTags);

function replaceCurlyQuotes($text) {
    $search = array(chr(145), chr(146), chr(147), chr(148), chr(151));
    $replace = array("'", "'", '"', '"', '-');
    $text = str_replace($search, $replace, $text);
    return $text;
}

$replaced_content = replaceCurlyQuotes($content);

//$content = $_POST["your_textbox_content"];
$sanitizedContent = filter_var($_POST['opp_proposal'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
//$opp_proposal_sanitized = mysqli_real_escape_string($mysqli_link, $sanitizedContent);
$opp_proposal_sanitized = $mysqli_link->real_escape_string($sanitizedContent);

$opp_proposal = $mysqli_link->real_escape_string($_POST['opp_proposal']);
$opp_proposal_stripped = $mysqli_link->real_escape_string($stripped_content);
$opp_proposal_replaced = $mysqli_link->real_escape_string($replaced_content);

// Sanitize the data for MySQL insertion
  //$opp_proposal = mysqli_real_escape_string($mysqli_link, $content);

//$opp_proposal_encoded = base64_encode($opp_proposal); // Encode as base64
//$query = "UPDATE excel_test SET proposal='$opp_proposal_encoded' WHERE opportunity_id=$opp_id"; 

//$result = mysqli_query($mysqli_link, $query);


$query = "UPDATE excel_test SET proposal='$opp_proposal_sanitized' WHERE opportunity_id=$opp_id"; 
$result = mysqli_query($mysqli_link, $query);
	
	if (($mysqli_link->query($query) === TRUE)) {
    echo "Data inserted successfully --- Sanitized";
		}
		

//$query = "UPDATE excel_test SET proposal='$opp_proposal' WHERE opportunity_id=$opp_id"; 
$query = "UPDATE excel_test SET proposal='$opp_proposal_replaced' WHERE opportunity_id=$opp_id";
$result = mysqli_query($mysqli_link, $query);

//print $query;

if ($mysqli_link->query($query) === TRUE) {
    echo "\r\nData inserted successfully --- RichTextFormat(RTF)";
} else {
	$failed=1;
}
/*if ($result) {
    echo "Submission Field - Successfully Updated.";
	//print("<BR>");
} else {
    echo "Update query failed: " . mysqli_error($mysqli_link);
	print("<BR> " . $query);
}*/
//$failed=0;




	
// Close the MySQL connection
$mysqli_link->close();
?>