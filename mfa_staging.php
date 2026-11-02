<?php
header('X-Content-Type-Options: nosniff');
session_start();
//error_reporting(E_ALL); ini_set('display_errors', '1'); 
if($_SESSION['access_level'] == "101"){include("connect_common_staging.php");}
if($_SESSION['access_level'] == "102"){include("connect_commonst.php");}
$getusrdet = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT password_updated_date FROM users WHERE user_email = '".$_SESSION['user_email']."'"));
if(isset($_POST["submit"])){
		$post_otp = trim($_POST['mfa_code']);
		//$state_federal = $_POST['bidtype'];
		//$post_otp = implode(' ', str_split($post_otp));
		if($post_otp == $_SESSION['otp']) {		
			$loggedIn = true;
			$_SESSION['loggedIn'] = $loggedIn;
			// Code to set new PWD for every 30 days Starts Here.
				$lastPasswordDate = new DateTime(date($getusrdet[0]));
				$currentDate	  = new DateTime(date('Y-m-d'));
				$interval = $currentDate->diff($lastPasswordDate);
				if(($interval->days) > 29) {
						$_SESSION['alert_message'] = "Your password expired. Please change your password.";
						if($_SESSION['access_level'] == "101"){
								header("Location: https://ardentinc.com/fedbids-staging/changepwd.php");
						}
						if($_SESSION['access_level'] == "102"){
								header("Location: https://ardentinc.com/statebids-dev/changepwd.php");
						}
				}else { $_SESSION['alert_message'] = '';
			// Code to set new PWD for every 30 days Ends Here.
					if($_SESSION['user_role'] == 'superadmin') {
						header("Location: $baseurl/fedbids-staging/users_list.php");
					}
					else if($_SESSION['user_role'] == 'user' || $_SESSION['user_role'] == 'admin')
					{
						
						if($_SESSION['isfirst_loggedin'] == 0)
						{
							if($_SESSION['access_level'] == "101"){
								header("Location: Location: https://ardentinc.com/fedbids-staging/setnewpwd.php");
							}
							if($_SESSION['access_level'] == "102"){
								header("Location: Location: https://ardentinc.com/statebids-dev/setnewpwd.php");
							}
						}
						else if($_SESSION['isfirst_loggedin'] == 1)
						{
							if($_SESSION['access_level'] == "101") {
			//					if(in_array($_SESSION['user_id'], DIRECTED_8A_USERS)) {
			//	header("Location: https://ardentinc.com/fedbids-staging/directed_8a_agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review");
			//	} else 
			//		{
							unset($_SESSION['otp']);
							header("Location: $baseurl/fedbids-staging/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review");
			//	}
							}
							if($_SESSION['access_level'] == "102"){
							unset($_SESSION['otp']);
							header("Location: $baseurl/statebids-dev/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review");
							}
						}
						
					}
			} 
		}// End of first if.
		else{ unset($_SESSION['loggedIn']);
			 $error_message = "<font color='red'>Your code doesn't match our records. Please try again.</font>";
		}
}  // End of $_POST
?>
<!DOCTYPE html>
<html>
<head>
    <title>MFA Page</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <h2 style="text-align:center">OTP Verification</h2>
    <?php if(isset($_SESSION['msg_temp'])) 
	{ echo "<p>".$_SESSION['msg_temp']."</p>"; } 
	unset($_SESSION['msg_temp']);
	?>
    <form method="post" name="loginpost" action="">
        <label for="username">One Time Passcode : </label><br>
        <input type="text" id="mfa_code" name="mfa_code" autocomplete="off" maxlength="6" required style="border:1px solid #cbcbcb; padding:5px; height:30px; width:95%"><br><br>

        <input type="submit" name="submit" value="Submit" class="action-button">&nbsp;&nbsp;&nbsp;
		<input type="button" name="cancel" value="Cancel" id="mfa_cancel" class="action-button">
    </form>
	</div>
</div>

<script>
	$(document).ready(function(){
		$("#mfa_code").focus();

		$("#mfa_cancel").click(function(){
			var type = "<?php echo $_SESSION['access_level'];?>";
			if(type == "102")
			window.location.href = "https://ardentinc.com/loginst.php";
			if(type == "101")
			window.location.href = "https://ardentinc.com/login_staging.php";
		});
	});
</script>
</body>
</html>