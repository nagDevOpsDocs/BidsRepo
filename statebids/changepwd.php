<?php
session_start(); 
ob_start();
$msg = ''; $success = false;
include("./includes/connect_portal123.php");
if($_SESSION['user_role']=='') { header("Location: $login");  }
$uid = $_SESSION['user_id'];
if(isset($_POST['change_submit']))
{		
		$currentpassword = $_POST['cur_password'];
	 	$cur_password = md5(trim($_POST['cur_password']));
		$newpassword = md5(trim($_POST['newpassword']));
		$conf_newpassword = md5(trim($_POST['confpassword']));
		$currentDate = date('Y-m-d');
			$qry = mysqli_query($mysqli_link22, "SELECT password FROM users WHERE password='".$cur_password."' AND user_id='".$uid."'");
		   $temp = mysqli_fetch_array($qry);
	if($cur_password == $temp['password']) {
		if(trim($_POST['newpassword']) == trim($_POST['confpassword']))
		{
			if(mysqli_num_rows($qry) > 0)
			{
				$qry = "UPDATE users SET password='".$newpassword."', isfirst_loggedin='1', password_updated_date='".$currentDate."' WHERE user_id='".$uid."'";
				$update = mysqli_query($mysqli_link22, $qry) or die(mysql_error());
				if($update){
					unset($_SESSION);
					$success = true;
					$msg="<b><font color='blue'>Password has been changed successfully.</font></b>";
					//<br><br><a href='$baseurl/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review'><b>Click here</b></a> to open agenda page.";
				}
				else
				{
					$msg="<b><font color='red'>Current Password is wrong, Please enter correct one.</font></b>";
				}
			}
		}
		else
		{
			$msg="<b><font color='red'>New password and confirm password should not match, please check once.</font></b>.";
		}
	} else {
		 
			$msg="<b><font color='red'>Invalid current password.</font></b>";
	}
}
?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
    /*function validatePassword() {
        var validator = $("#pwdform").validate({
            rules: {
				cur_password: "required",
                newpassword: "required",
                confpassword: {
                    equalTo: "#newpassword"
                }
            },
            messages: {
				cur_password: "<br><font color='red'>Enter Current Password</font>",
                newpassword: " <br><font color='red'>Enter New Password</font>",
                confpassword: " <br><b><font color='red'>Enter Confirm Password Same as New Password</font></b>"
            }
        });
        
    }*/
 </script>
 
<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
	<link href="styles/admin.css" rel="stylesheet">
</head>
<body onload="document.change_pwd.cur_password.focus();">
<?php include('top_bar_include.php'); ?>
<DIV style="background-color:#f1f1f1; width:100%;">
	<DIV style="background-color:#fafafa; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid; width:20%;display:inline-block;vertical-align:top; margin-top:65px; margin-left:15px; position:fixed;">
    	
    	<!-- <div style="padding:15px; font-weight:500; color:#464864">
        <?php 
		//if($_SESSION['user_role']=='superadmin') {
		//	include('admin-left-menu.php');	
		//}
		//else
		//{
		//	include('left_content_include.php');
		//}
			?>
		</div> -->
	</DIV>
    <DIV style="background-color:inherit; /*margin-left:21%;*/ margin-top:50px; width:100%; height:1000px;display:inline-block;vertical-align:top;">
    	<div id="area" style="padding:15px; color:#464864; font-size:15px;">
    		<div style="height:400px;width:100%;border:none;overflow:hidden; background-color:#FFF; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid; padding:10px">
			<h2 style="margin-top: 0px; text-align: center;">Change Password</h2><br><br>
	<?php if(isset($msg)) { echo "<p style='text-align:center'>$msg</p>"; } ?>
	<?php if(isset($_SESSION['alert_message'])) { echo "<p style='text-align:center'>".$_SESSION['alert_message']."</p>"; } ?>
<form name="change_pwd" id="pwdform" method="post" action=""> 
		<table border="0" cellspacing="2" cellpadding="3" align="center">
			<tr><td style="text-align:right"><b>Current Password : </b></td>
					<td><input align="left" type="password" name="cur_password" id="cur_password" class="input1"></td></tr>
			<tr><td style="text-align:right"><b>New Password : </b></td>
					<td><input align="left" type="password" name="newpassword" id="newpassword" class="input1"></td></tr>
			<tr><td style="text-align:right"><b>Confirm Password : </b></td>
					<td><input align="left" type="password" name="confpassword" id="confpassword" class="input1"></td></tr>
			<tr>
               <td>&nbsp;</td><td height="30">
				 <input type="submit" name="change_submit"  id="change" value="Submit" class="sub1" style="background-color:#6450ae; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block;  cursor: pointer; font-size: 16px;" />   
               </td>
            </tr>
		</table>
</form>
				 <div id="messagearea" style="width:100%;border:none;overflow:hidden; background-color:#FFF;  display:none;text-align: center;">
					<a href='https://ardentinc.com/login.php'><b>Click here</b></a> to Login.
				 </div>
			</div>
		</div>
	</DIV>
</DIV>
<?php include('collapse-script.php'); ?>
<?php if ($success){ ?>
		<script>
			document.getElementById('pwdform').style.display = 'none';
			document.getElementById('messagearea').style.display = 'block';
		</script>
<?php } ?>
</body>
</html>