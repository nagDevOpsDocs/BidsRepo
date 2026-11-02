<?php
session_start(); 

include("./includes/connect_portal123.php");
if($_SESSION['user_role']=='') { header("Location: $login");  }

$uid = $_SESSION['user_id'];
$msg = '';
$currentDate = date('Y-m-d');
if(isset($_POST['change_submit']))
{		
$newpassword = md5(trim($_POST['newpassword']));
//$conf_newpassword = md5(trim($_POST['confpassword']));

if(trim($_POST['newpassword']) == trim($_POST['confpassword']))
	{
	$qry = "UPDATE users SET password='".$newpassword."',isfirst_loggedin='1', password_updated_date='".$currentDate."' WHERE user_id='".$uid."'";
	$update = mysqli_query($mysqli_link,$qry);
	if($update){
		$msg="<b><font color='blue'>Password has been changed successfully.</font></b><br><br><a href='$baseurl/agenda.php?search=&_mode=Agenda&_decision=&status%5B%5D=Agenda+Item&status%5B%5D=Current+Proposal+Workload&status%5B%5D=RFP+Tracking&status%5B%5D=Award+Monitoring&status%5B%5D=Archived&status%5B%5D=Under+Review'><b>Click here</b></a> to open agenda page.";
	 }
	}
	else
	{
		$errmsg="<b><font color='red'>New password and confirm password should not match,<br> please check once.</font></b>.";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Set new password</title>
	<link href="styles/admin.css" rel="stylesheet">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body onload="document.change_pwd.newpassword.focus();">
<br><br><br><br><br><br>
    <DIV style="width:35%; margin: 0 auto;">
    	<div id="area" style="padding:15px; color:#464864; font-size:15px;">
    		<div style="border:none;overflow:hidden; background-color:#FFF; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid; padding:10px">
			<h2 style="margin-top: 0px; text-align:center">Set new password</h2>
<form name="change_pwd" id="pwdform" method="post" action=""> 
		<table border="0" cellspacing="2" cellpadding="3" align="center">
		<?php if($msg != '') { ?>
			<tr><td colspan="2" style="text-align:center;"><?php echo $msg; ?></td></tr>
	<?php } else { ?>
	<tr><td colspan="2" style="text-align:center;"><?php echo $errmsg; ?></td></tr>
			<tr><td style="text-align:right"><b>New Password : </b></td>
					<td><input align="left" type="password" name="newpassword" id="newpassword" class="input1" required></td></tr>
			<tr><td style="text-align:right"><b>Confirm Password : </b></td>
					<td><input align="left" type="password" name="confpassword" id="confpassword" class="input1" required></td></tr>
			<tr>
               <td>&nbsp;</td><td height="30">
				 <input type="submit" name="change_submit" id="change" value="Submit" class="sub1" style="background-color:#6450ae; color: #fff; font-weight: 700; text-align: center; padding: 4px; width: 80px; display: inline-block;  cursor: pointer; font-size: 16px;" />   
               </td>
            </tr>
			<?php } ?>
		</table>
	</form>
			</div>
		</div>
	</DIV> 
</body>
</html>