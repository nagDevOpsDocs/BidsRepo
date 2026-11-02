<?php
session_start();
include("./includes/connect_portal123.php");
if($_SESSION['user_role']==''){ header("Location: $login");  }

//error_reporting(E_ALL);
// ini_set("display_errors", 1);

if(isset($_POST["submit"])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$access_type = $_POST['access_type'];
	$status = $_POST['status'];

	$adddet = mysqli_query($mysqli_link,"INSERT INTO managers (manager_name,manager_email,manager_show) VALUES ('$name','$email','$access_type','$status')") or die(mysqli_error($mysqli_link));

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
    <title>Add Manager</title>
	<link href="styles/admin.css" rel="stylesheet">
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
			<h2 style="margin-top: 0px;">Add Manager</h2>
	<?php if(isset($error_message)) { echo "<p>$error_message</p>"; } ?>
    <form method="post" name="mngrform" action="">
		<table border='0'cellpadding="5" cellspacing="2">
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name" required></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" name="email" required></td>
			</tr>
			<tr>
				<td>Access Type:</td>
				<td><select name="access_type">
				<option value="">Select</option>
				<option value="F">Federal</option>
				<option value="S">State</option>
				<option value="B">Both</option>
				</select></td>
			</tr>
			<tr>
				<td>Status:</td>
				<td><select name="status">
				<option value="">Select</option>
				<option value="1">Active</option>
				<option value="0">In Active</option>
				</select></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit" value="Add" style="background-color:#6450ae; color: #fff; font-weight: 700; text-align: center; padding: 2px; width: 100px; display: inline-block;  cursor: pointer; font-size: 15px;" ></td>
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