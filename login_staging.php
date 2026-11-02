<?php
if(strpos($_SERVER['SERVER_NAME'],"ww.")){
	$new_url = $_SERVER['SERVER_NAME'];
	$new_url = str_replace("www.","",$new_url);
	header("Location: https://ardentinc.com/login_staging.php");
}
header('X-Content-Type-Options: nosniff');
session_start();
include("connect_common_staging.php");
include_once("PHPMailer/src/Exception.php");
include_once("PHPMailer/src/PHPMailer.php");
include_once("PHPMailer/src/SMTP.php");
include_once("PHPMailer/PHPMailerAutoload.php");
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
// Check if the form has been submitted
if(isset($_POST["submit"])){
	$user_email = trim($_POST['user_email']);
    $password = md5($_POST['password']);
	if($_POST['bidtype'] != '') { $access_level = $_POST['bidtype']; } else { $access_level = '103'; }
	
	if($_POST['bidtype']=='101')
	{
		$urltype = "https://ardentinc.com/fedbids-staging/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review";
	}
	elseif($_POST['bidtype']=='102')
	{
		$urltype = "https://ardentinc.com/statebids-dev/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review";
	} 

//    $users = mysqli_query($mysqli_link, "SELECT * FROM users WHERE user_email = '".$user_email."' AND password = '".$password."' AND access_level = '".$access_level."' AND status = '1'");
//echo "SELECT * FROM users WHERE user_email = '".$user_email."' AND password = '".$password."' AND status = '1'";
	
    $users = mysqli_query($mysqli_link, "SELECT * FROM users WHERE user_email = '".$user_email."' AND password = '".$password."' AND access_level = '".$access_level."' AND status = '1'");
    
	$test=$_POST["test"];
    $number1=$_POST["no1"];
    $number2=$_POST["no2"];
    $total=$number1+$number2;
                
if($total==$test)
{
if(mysqli_num_rows($users) > 0) {
	$userdet = mysqli_fetch_array($users);
        $_SESSION['user_id'] = $userdet['user_id'];
        $_SESSION['user_name'] = $userdet['firstname']." ".$userdet['lastname'];
        $_SESSION['user_role'] = $userdet['user_role'];
        $_SESSION['user_email'] = $userdet['user_email'];
        $_SESSION['access_level'] = $userdet['access_level'];
		$_SESSION['isfirst_loggedin'] = $userdet['isfirst_loggedin'];
		$_SESSION['password_updated_date'] = $userdet['password_updated_date'];
//echo "<pre>"; print_r($_SESSION); exit;

		if($_SESSION['user_role'] == 'superadmin') {
           header("Location: https://ardentinc.com/fedbids-staging/users_list.php");
		}
		else 
		{

//MFA EMAIL SEND
					$user_email = trim($_SESSION['user_email']);
					$number =  rand(100000, 999999);
					//$number = implode(' ', str_split($number));
					$_SESSION['otp'] = $number;
		
					$ename = $userdet['lastname'].' '.$userdet['firstname'];
						$mail = new PHPMailer;
						$mail->isSMTP();                                      
						//$mail->SMTPDebug = 3;                                      
						$mail->Host = 'smtp.office365.com';  
						//$mail->Host = 'smtp-mail.outlook.com';  
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

						$mail->Subject = 'Your One-Time Passcode (Bid Portal)';
						$mail->Body  = "<table border='0' cellpadding='0' cellspacing='0' style='FONT-FAMILY:Tahoma, Helvatica, fantasy; color:#000000; FONT-SIZE: 10pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal;' width='700'><tr><td><div style='padding:20px;  border:solid 1px #33a0da; background:#f7f7f7; border-radius:10px; -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.75); -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.75); box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.75); color:#000000;'>";
						$mail->Body .= "<div style='padding-bottom:10px; color:#000066; font-weight:bold'>Hello $ename,</div>";
						$mail->Body .= "<div style='padding-bottom:10px; color:#000066; font-weight:bold'>We received a request to login to the Bid Portal. Please use the one-time passcode (OTP) below to continue:</div>";
						$mail->Body .= "<div style='padding-bottom:10px; color:#000066; font-weight:bold'>Your One Time Passcode (OTP): <span style='font-size: 30px !important; font-color: blue;'>$number</span></div>";
						$mail->Body .= "<div style='padding-bottom:10px; color:#000066; font-weight:bold'>If you did not request this code, you can safely ignore this email.</div>";
						$mail->Body .= "</div>";
						$mail->Body .= "<div style='margin-top:30px; margin-bottom:10px'>Thanks,<br/>Ardent Technologies.</div>";
						//$mail->Body .= "<div style='margin-top:30px; margin-bottom:10px'>Ardent Inc Team.</div>";
						$mail->Body .= "</td></tr></table>";
					if(!$mail->Send())
					{
					   $error_message = "<font color='red'>Please check mail id.</font>";
					   //echo "Mailer Error: " . $mail->ErrorInfo;
					   //exit;
					}else{
					$_SESSION['msg_temp'] = "<font color='blue'>OTP has been sent to your email Id.</font>";
					header("Location: https://ardentinc.com/mfa_staging.php");
					}

		   //header('Location: '.$urltype);
		   if($userdet['isfirst_loggedin']==1)
			{
				if(in_array($_SESSION['user_id'], DIRECTED_8A_USERS)) {
				header("Location: https://ardentinc.com/fedbids-staging/directed_8a_agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review");
				} else {
				header("Location: https://ardentinc.com/fedbids-staging/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review");
				}
			}
			else
			{
				header("Location: https://ardentinc.com/fedbids-staging/setnewpwd.php");
			}
		} 

				header("Location: https://ardentinc.com/mfa_staging.php");
    }
else
	{
		$error_message = "<font color='red'>Invalid email or password.</font>";
	}

}
else { 
	$error_message = "<font color='red'>Invalid captcha, please try again.</font>";
}
}
?>
<?php
    $min  = 1;
    $max  = 10;
    $num1 = rand( $min, $max );
    $num2 = rand( $min, $max );
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="fonts/fonts.css">
<style>
	html, body {
		height: 100%; 
	}
	body {
	  font-family: 'Roboto', sans-serif;
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
	.toggle-password {
		position: absolute;
		right: 10px;
		top: 50%;
		transform: translateY(-50%);
		cursor: pointer;
		color: #666;
	}
</style>
    
</head>
<body>

<div style="padding-top:50px">
	<div class="card-body">
    <h2 style="text-align:center">Login</h2>
    <?php if(isset($error_message)) { echo "<p>$error_message</p>"; } ?>
    <form method="post" name="loginpost" action="">
        <label for="username">Email</label><br>
        <input type="text" id="user_email" name="user_email" required style="border:1px solid #cbcbcb; padding:5px; height:30px; width:95%"><br><br>
        
        <label for="password">Password:</label><br>
        <div style="position: relative; width: 300px;">
			<input type="password"
				   id="password"
				   name="password"
				   class="form-control"
				   style="width: 115%; padding-right: 40px; height:33px;" required>
			<i class="fa fa-eye toggle-password"
			   style="
				   position: absolute;
				   right: -84px;
				   top: 50%;
				   transform: translateY(-50%);
				   cursor: pointer;"></i>
		</div>
		<br>

		<!-- <label for="password">Federal / State</label><br> -->
			<input type="radio" id="federal" name="bidtype" value="101" checked>
				<label for="html">Federal</label>&nbsp;<br><br>
		<!--<input type="radio" id="state" name="bidtype" value="102" required>
				<label for="css">State</label><br><br>
         <select name="bidtype" style="border:1px solid #cbcbcb; padding:5px; height:30px; width:98%" >
			<option value="">Select Type</option>
			<option value="101" selected>Federal</option>
			<option value="102">State</option>
		</select> 
		<br><br>  -->

		<label for="quiz"
			   class="col-form-label">
			<?php echo $num1 . '+' . $num2; ?> =
		
			<input type="hidden"
				   name="no1"
				   value="<?php echo $num1; ?>">
			<input type="hidden"
				   name="no2"
				   value="<?php echo $num2; ?>">
			<input type="text"
				   name="test" style="width:20%" autocomplete="off" id="quiz" required ><br><br> 

        <!-- <input type="submit" name="submit" value="Login" id="fed_login" class="action-button">
		<input type="button" name="waitbutton"  value="Please Wait..." id="button_login" class="action-button"> -->
		<!-- Ensures PHP receives $_POST["submit"] -->
 <input type="hidden" name="submit" value="Login">
<input type="submit" value="Login" id="fed_login" class="action-button">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php $baseurl; ?>/forgot-pwd.php">Forgot password</a>
    </form>
		<div style='margin-top: 5px;text-align: center;color: red;font-weight: bold;font-style: oblique;'> Best Viewed Under (1920 * 1080) Screen Resolution.</div>
	</div>
</div>

<script>
	$(document).ready(function(){
	/*	$("#fed_login").on('submit',function(){
			$(this).hide();
			$("#button_login").show();
			$('#fed_login').css('pointer-events', 'none');
		});  */
	        $("form[name='loginpost']").on("submit", function (e) {

            // Validate the captcha answer before showing Please Wait
            var number1 = parseInt($("input[name='no1']").val(), 10);
            var number2 = parseInt($("input[name='no2']").val(), 10);
            var answer = parseInt($("input[name='test']").val(), 10);

            if (answer !== number1 + number2) {
                e.preventDefault();
                alert("Invalid captcha, please try again.");
                return false;
            }

            // All validations passed
            $("#fed_login")
                .val("Please Wait...")
                .prop("disabled", true)
                .css("opacity", "0.7");
        });
// Toggle password visibility
		 $('.toggle-password').click(function () {
				var input = $(this).siblings('input');
				if (input.attr('type') === 'password') {
					input.attr('type', 'text');
					$(this)
						.removeClass('fa-eye')
						.addClass('fa-eye-slash');
				} else {
					input.attr('type', 'password');
					$(this)
						.removeClass('fa-eye-slash')
						.addClass('fa-eye');
				}
		  });
	});
</script>

</body>
</html>