<?php
	session_start();
	include("./includes/connect_portal123.php");
	//ini_set('display_errors', '1'); error_reporting(E_ALL);
	$referer = $_SERVER['HTTP_REFERER'];
	$this_page_name="AJAX OPPORTUNITY UPDATE";
	include("./includes/connect_portal123.php");
	$secure_webpage=0;

	include_once("../PHPMailer/src/Exception.php");
	include_once("../PHPMailer/src/PHPMailer.php");
	include_once("../PHPMailer/src/SMTP.php");
	include_once("../PHPMailer/PHPMailerAutoload.php");

	 use PHPMailer\PHPMailer\PHPMailer;
	 use PHPMailer\PHPMailer\SMTP;
	 use PHPMailer\PHPMailer\Exception;

	$managers = $_POST['managers'];
	$opp_id   = $_POST['opportunityId'];
	
	$mail = new PHPMailer;
		$mail->isSMTP();                                      
		//$mail->SMTPDebug = 3;                                      
		$mail->Host = 'smtp.office365.com';  
		$mail->SMTPAuth = true;                               
		$mail->Username = 'notification@ardentinc.com';                 
		$mail->Password = 'Reply2023(*&^%$#@!';                           
		$mail->SMTPSecure = 'tls';                             
		$mail->Port = 587; 
		$mail->setFrom('notification@ardentinc.com', 'AI Bid Notification');
		//$mail->addAddress('aibids@ardentinc.com', 'AI Bids');  
		for ($i=0; $i<count($managers);$i++) {
			//echo $managers[$i]."<br/>";
			$mail->addAddress($managers[$i]);  
		}
		//$mail->addAddress('nageswararao.v@ardentinc.com', 'Nageswararao.');  
		//$mail->addCC('nageswararao.v@ardentinc.com', 'Nageswararao.');
		$mail->isHTML(true);                                  
		$mail->Subject = 'New AI Opportunity Added.';
	
// Header Part.
		$mail->Body .= "Hi Team,";
		$mail->Body .= "<br/><br/>A new bid has been added to the portal under the AI category.";
		$mail->Body .= "<br/><br/>Please review the bid details at your convenience.<br/>";

		/*$mail->Body .= "<table border='0.5' style='width: 100%; background-color: #f4f5fb; font-weight: normal; font-family: Segoe UI, Century Gothic; font-size: 11px;'>";
		$mail->Body .= "<tr>";
		$mail->Body .= "<td style='color:#fff; font-weight:bold; background-color:#3c3cb3'>Release</td>";
		$mail->Body .= "<td style='color:#fff; font-weight:bold; background-color:#3c3cb3'>Submission</td>";
		$mail->Body .= "<td style='color:#fff; font-weight:bold; background-color:#3c3cb3'>Type</td>";
		$mail->Body .= "<td style='color:#fff; font-weight:bold; background-color:#3c3cb3'>Bid #</td>";
		$mail->Body .= "<td style='color:#fff; font-weight:bold;background-color:#3c3cb3'>State/Agency</td>";
		$mail->Body .= "<td style='color:#fff; font-weight:bold; background-color:#3c3cb3'>Title</td>"; 
		$mail->Body .= "<td style='color:#fff; font-weight:bold; background-color:#3c3cb3'>Assigned to</td>";
		$mail->Body .= "<td style='color:#fff; font-weight:bold; background-color:#3c3cb3'>Added By</td>";
		$mail->Body .= "</tr>";
// Data Part.
		$mail->Body .= "<tr>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'>".date('m/d/Y',strtotime($_POST['opp_released']))."</td>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'>".date('m/d/Y',strtotime($_POST['proposal_date']))."</td>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'>".$_POST['staffing']."</td>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'><a href='$baseurl/addrole_view_opportunities.php?which_update_id=".$lastid."' target='_blank'>".$_POST['opp_vehicle_one']."</a></td>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'>".$_POST['state'] ."/". $_POST['agency']."</td>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'><a href='$baseurl/addrole_view_opportunities.php?which_update_id=".$lastid."' target='_blank'>".$_POST['opp_title']."</a></td>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'>".$_POST['manager'] ."</td>";
		$mail->Body .= "<td style='color:black; font-weight:bold;'>".$addedby."</td>";
		$mail->Body .= "</tr></table>";*/
		if(!$mail->Send())
		{
			//$error_message = "<font color='red'>Please check mail id</font>";
		   echo "Mailer Error: " . $mail->ErrorInfo;
		   exit;
		}
?>

