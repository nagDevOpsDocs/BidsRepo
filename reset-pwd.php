<?php
include("connect_portal123.php");
$show_form = 1;
$user_id = base64_decode($_GET['uid']);
$users = mysqli_query($mysqli_link, "SELECT user_email FROM users WHERE user_id = '".$user_id."'");
$getdet = mysqli_fetch_array($users);
$user_email = $getdet['user_email'];

if(isset($_POST["reset"]))
{
	$new_pwd = md5(trim($_POST['new_pwd']));
	$conf_pwd = md5(trim($_POST['conf_pwd']));
    
 if(mysqli_num_rows($users) > 0) 
 {
	if($new_pwd == $conf_pwd)
	{
		$resetpwd = mysqli_query($mysqli_link, "UPDATE users SET password = '".$conf_pwd."' WHERE user_id = '".$user_id."'");
		$error_message = "<font color='blue'>Password has been changed successfully</font>";
		$show_form = 0;
	}
	else
	{
		$error_message = "<font color='red'>New and Confirm Passwords are not matching, Please enter correct one</font>";
	}
 }
 else
 {
	$error_message = "<font color='red'>Record not found</font>";
 }

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
    <h2 style="text-align:center">Reset Password</h2>
    <?php if(isset($error_message)) { echo "<p>$error_message</p>"; } ?>
	<?php
	if($show_form){
		?>
    <form method="post" name="change_pwd" id="pwdform" action="">
        <label for="username">Email<font color='red'>*</font></label><br>
        <input type="text" id="user_email" name="user_email" value="<?php echo $user_email; ?>" readonly style="border:1px solid #cbcbcb; padding:5px; height:30px; width:95%"><br><br>
        <label for="username">New password<font color='red'>*</font></label><br>
        <input type="password" id="new_pwd" name="new_pwd" required style="border:1px solid #cbcbcb; padding:5px; height:30px; width:95%"><br><br>
        <label for="username">Confirm password<font color='red'>*</font></label><br>
        <input type="password" id="conf_pwd" name="conf_pwd" required style="border:1px solid #cbcbcb; padding:5px; height:30px; width:95%"><br><br>

        <input type="submit" name="reset" id="reset" value=" Update " class="action-button">&nbsp;&nbsp;
    </form>
	<?php
	}
		else{
	?>
		Click <a href="<?php $baseurl; ?>/login.php" style="text-align:right;"><b>Login</b></a> to continue...
	<?php
		}
	?>
	</div>
</div>


</body>
</html>