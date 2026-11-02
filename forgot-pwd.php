<?php
//include("connect_commonst.php");
include("connect_portal123.php");

include_once("PHPMailer/src/Exception.php");
include_once("PHPMailer/src/PHPMailer.php");
include_once("PHPMailer/src/SMTP.php");
include_once("PHPMailer/PHPMailerAutoload.php");

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

$show_form = 1;

if(isset($_POST["changepwd"])){
	$user_email = trim($_POST['user_email']);

    $users = mysqli_query($mysqli_link, "SELECT user_id,firstname,lastname FROM users WHERE user_email = '".$user_email."' AND status = 1");
	$userdet = mysqli_fetch_array($users);

	$ename = $userdet['lastname'].' '.$userdet['firstname'];
	$user_id = base64_encode($userdet['user_id']);

if(mysqli_num_rows($users) > 0) {
		$mail = new PHPMailer;
		$mail->isSMTP();                                      
		//$mail->SMTPDebug = 1;                                      
		$mail->Host = 'smtp.office365.com';  
		$mail->SMTPAuth = true;                               
		$mail->Username = 'noreply@ardentinc.com';                 
		//$mail->Password = 'Otp#@!2026';                           
		$mail->Password = 'H@llo2023%$#@!';                           
		$mail->SMTPSecure = 'tls';                             
		$mail->Port = 587; 
		$mail->setFrom('noreply@ardentinc.com', 'Ardent Technologies.');
		$mail->addAddress($user_email);  
		//$mail->addCC('nageswararao.v@ardentinc.com', 'Nageswararao.');  
		$mail->isHTML(true);                                  

		$mail->Subject = 'Password change request';
		$mail->Body  = "<table border='0' cellpadding='0' cellspacing='0' style='FONT-FAMILY:Tahoma, Helvatica, fantasy; color:#000000; FONT-SIZE: 10pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal;' width='700'><tr><td><div style='padding:20px;  border:solid 1px #33a0da; background:#f7f7f7; border-radius:10px; -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.75); -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.75); box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.75); color:#000000;'>";
		$mail->Body .= "<div style='padding-bottom:10px; color:#000066; font-weight:bold'>Dear $ename,</div>";
		$mail->Body .= "<div style='line-height:28px;'>Welcome to the BidPortal<br><a href='$baseurl/reset-pwd.php?uid=$user_id'>click here</a> to reset your password </div>";
		$mail->Body .= "</div>";
		$mail->Body .= "<div style='margin-top:30px; margin-bottom:10px'>Regards<br>Admin Team</div>";
		$mail->Body .= "</td></tr></table>";

		if(!$mail->Send())
		{
			$errmsg = "<font color='red'>Please check mail id.</font>";
		   //echo "Mailer Error: " . $mail->ErrorInfo;
		   //exit;
		}
		else
		{
			$errmsg = "<font color='blue'>Mail has been sent to your email Id.</font>";
			$show_form = 0;
		}

	}
	else 
	{
		   $error_message = "<font color='red'>Invalid email.</font>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>

<style>
html, body {
height: 100%; 
}

	body {
  font-family:'Segoe UI', Tahoma, Arial;
  background-image: url("images/background1.jpg");
   
     background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  margin:0px;
  padding:0px;
	}
.mt-5, .my-5{
margin-top:16px !important;
}


.action-button {
	font-size:14px; padding:5px 10px; border:1px solid #bdc2cb; margin-top:12px; background-color:#247fb6; color:#FFF;
}
.action-button:hover {
	font-size:14px;
	padding:5px 10px;
	border:1px solid #bdc2cb;
	margin-top:12px;
	
	background-color:#2794d4;
	color:#FFF;
}
.card-body {
	    opacity: 95%;
    border: 1px solid #c2c4cb;
	margin:0 auto;
	width:400px;
	padding:15px;
	background:#fff;
}

    </style>
    
</head>
<body>

<div style="padding-top:50px">
	<div class="card-body">
    <h2 style="text-align:center">Forgot Password</h2>
    <?php if(isset($errmsg)) { echo "<p>$errmsg</p>"; } ?>

	<?php
	if($show_form){
	?>
    <form method="post" name="fpwd" action="">
        <label for="username">Email</label><br>
        <input type="text" id="user_email" name="user_email" required style="border:1px solid #cbcbcb; padding:5px; height:30px; width:95%"><br><br>
        <input type="hidden" id="user_tedt" name="user_test" value="1">

        <input type="submit" name="changepwd" value="Submit" class="action-button">
    </form>
	<?php
	}
		?>
	</div>
</div>


</body>
</html>