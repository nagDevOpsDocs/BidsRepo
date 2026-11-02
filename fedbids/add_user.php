<?php
session_start();
include("./includes/connect_portal123.php");
if($_SESSION['user_role']==''){ header("Location: $login");  }

//error_reporting(E_ALL);
// ini_set("display_errors", 1);

if(isset($_POST["submit"])){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	//$city = $_POST['city'];
	//$state = $_POST['state'];
	//$country = $_POST['country'];
	$email = $_POST['email'];
    $password = md5(trim($_POST['password']));
	$user_role = $_POST['role'];
	$accesslevel = $_POST['accesslevel'];

	$adddet = mysqli_query($mysqli_link,"INSERT INTO users (user_email,password,firstname,lastname,city,state,country,user_role,status,isfirst_loggedin,access_level) VALUES ('$email','$password','$fname','$lname','-','-','-','$user_role','1','0','$accesslevel')");

	if($adddet)
	{
		$error_message = "Details added successfully.";
	}
	else
	{
		$error_message = "Error in your details.";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
	<link href="styles/rcs.css" rel="stylesheet">
</head>
<body>
<?php include('top_bar_include.php'); ?>
<DIV style="background-color:#f1f1f1; width:100%;">
	<DIV style="background-color:#fafafa; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid; width:20%;display:inline-block;vertical-align:top; margin-top:65px; margin-left:15px; position:fixed;">
    	
    	<div style="padding:15px; font-weight:500; color:#464864">
        
        <?php 
			include('admin-left-menu.php');			
			?>
		</div>
    
	</DIV>
    <DIV style="background-color:inherit; margin-left:21%; margin-top:50px; width:78%; height:1000px;display:inline-block;vertical-align:top;">
    	<div id="area" style="padding:15px; color:#464864; font-size:15px;">
    		<div style="height:400px;width:100%;border:none;overflow:hidden; background-color:#FFF; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid; padding:10px">
			<h2 style="margin-top: 0px;">Add User</h2>
	<?php if(isset($error_message)) { echo "<p>$error_message</p>"; } ?>
    <form method="post" name="regform" action="">
		<table border='0'cellpadding="5" cellspacing="2">
			<tr>
				<td>First Name:</td>
				<td><input type="text" name="fname" required></td>
			</tr>
			<tr>
				<td>Last Name:</td>
				<td><input type="text" name="lname" required></td>
			</tr>
			<!-- <tr>
				<td>City:</td>
				<td><input type="text" name="city" ></td>
			</tr>
			<tr>
				<td>State:</td>
				<td><input type="text" name="state" ></td>
			</tr>
			<tr>
				<td>Country:</td>
				<td><input type="text" name="country" ></td>
			</tr> -->
			<tr>
				<td>Email:</td>
				<td><input type="email" name="email" autocomplete="off" required></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" autocomplete="off" required></td>
			</tr>
			<tr>
				<td>Role:</td>
				<td><select name="role" required>
		<option value="">Select</option>
		<option value="user">User</option>
		<option value="admin">Admin</option>
		</select></td>
			</tr>
			<tr>
				<td>Access Level:</td>
				<td><select name="accesslevel" required >
		<option value="">Select</option>
		<option value="101">Federal</option>
		<option value="102">State</option>
		<option value="103">Both</option>
		</select></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit" value="Create User" style="background-color:#6450ae; color: #fff; font-weight: 700; text-align: center; padding: 2px; width: 100px; display: inline-block;  cursor: pointer; font-size: 15px; font-family:'Roboto', sans-serif;" ></td>
			</tr>
		</table>
        
    </form>
			
			</div>
		</div>
        
    
	</DIV>
    
    
</DIV>
<?php //include('collapse-script.php'); ?>
    
</body>
</html>