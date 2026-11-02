<?php
session_start();
include("./includes/connect_portal123.php");
if($_SESSION['user_role']==''){ header("Location: $login");  }
if(isset($_POST["submit"])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$accesstype = $_POST['accesstype'];

	$adddet = mysqli_query($mysqli_link,"INSERT INTO managers (manager_name,manager_email,access_type,manager_show) VALUES ('$name','$email','$accesstype','1')") or die(mysqli_error($mysqli_link));

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
    <title>BidPortal | Ardent Technologies Inc</title>
	<link href="styles/rcs.css" rel="stylesheet">
	<style type="text/css">
.rcs {
	font-family: "Roboto", sans-serif;
}
.shadow {
   -moz-box-shadow:    inset 0 0 10px #000000;
   -webkit-box-shadow: inset 0 0 10px #000000;
   box-shadow:         inset 0 0 10px #000000;
}
.shadow2 {
   -moz-box-shadow:    inset 0 0 10px #a6abb9;
   -webkit-box-shadow: inset 0 0 10px #a6abb9;
   box-shadow:         inset 0 0 10px #a6abb9;
}
a:link {color:#464864;}
a:hover {color:#464864;}
a:visited {color:#464864;}
.collapsible7 {
  background-color: #3c4db0;
  color: white;
  cursor: pointer;
  padding: 14px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-weight:700;
  /*font-size: 15px;*/
}
.active7, .collapsible7:hover {
  background-color: #2a3679;
}
.content7 {
  padding: 16px 18px;
  display: none; /* block */
  overflow: hidden;
  background-color: #fcfcfc;
  border-left:1px #e4e4e4 solid;
  border-right:1px #e4e4e4 solid;
  border-bottom:1px #e4e4e4 solid;
  font-size:12px;
}
button {font-family:"Roboto", sans-serif}
</style>
</head>
<body style="font-family:'Roboto', sans-serif;">
<?php include('top_bar_include.php'); ?>
<DIV style="background-color:#f1f1f1; width:100%;">
	<DIV style="background-color:#fafafa; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid; width:20%;display:inline-block;vertical-align:top; margin-top:65px; margin-left:15px; position:fixed;">	
    	<div style="padding:15px; font-weight:500; color:#464864">    
        <?php 
	//		include('admin-left-menu.php');		
			include('left_content_include.php');	
			?>
		</div>   
	</DIV>
    <DIV style="background-color:inherit; margin-left:21%; margin-top:50px; width:78%; height:1000px;display:inline-block;vertical-align:top;">
    	<div id="area" style="padding:15px; color:#464864; font-size:15px;">
    		<div style="height:400px;width:100%;border:none;overflow:hidden; background-color:#FFF; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid; padding:10px">
	<!--		<h2 style="margin-top: 0px;">Add Manager</h2>  -->
			<div style="text-align:center;font-size:22px;font-weight:700;color:#3c4db0;margin-bottom:15px; ">Add Manager</div>
	<?php if(isset($error_message)) { echo "<p>$error_message</p>"; } ?>
    <form method="post" name="mngrform" action="">
		<table border='0' cellpadding="5" cellspacing="2" align="center" style="font-family:'Roboto', sans-serif;">
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name" required></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" name="email" required></td>
			</tr>
			<tr>
				<td>Access:</td>
				<td><select name="accesstype" required>
				<option value="">Select</option>
				<option value="S">State</option>
				<option value="F">Federal</option>
				<option value="B">Both</option>
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