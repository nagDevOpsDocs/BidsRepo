<?php
session_start();
ob_start();

include("./includes/connect_portal123.php"); 
if($_SESSION['user_role']==''){ header("Location: $login");  }

if(isset($_POST["update"])){

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	//$city = $_POST['city'];
	//$state = $_POST['state'];
	//$country = $_POST['country'];
	$email = $_POST['email'];
    $password = md5(trim($_POST['password']));
	$user_role = $_POST['role'];
	$status = $_POST['status'];
	$uid = $_POST['uid'];

	if($_POST['password'] != '')
	{
		$updqry = mysqli_query($mysqli_link22,"UPDATE users SET password='".$password."' WHERE user_id = '".$uid."'");

		$updqry = mysqli_query($mysqli_link22,"UPDATE users SET user_email='".$email."',firstname='".$fname."',lastname='".$lname."',user_role='".$user_role."', status='".$status."' WHERE user_id = '".$uid."'");
	}
	else
	{
	
		$updqry = mysqli_query($mysqli_link22,"UPDATE users SET user_email='".$email."',firstname='".$fname."',lastname='".$lname."',user_role='".$user_role."', status='".$status."' WHERE user_id = '".$uid."'");
	}
	

	if($updqry)
	{
		//$error_message = "Details updated successfully.";
		header("Location: users_list.php?sid=1");
	}
	else
	{
		$error_message = "Error in your details.";
	}
}

?>

<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BidPortal | Ardent Technologies Inc</title>
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
    		<div style="height:1000px;width:100%;border:none;overflow:hidden; background-color:#FFF; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid; padding:10px">
			<h2 style="margin-top: 0px;">Users List</h2>
			<?php if($_GET['sid']==1) { echo "Details updated successfully"; } ?>

<?php
// Fetch data from the "users" table
$result = mysqli_query($mysqli_link,"SELECT * FROM users");

if(mysqli_num_rows($result) > 0) { ?>
    <table border='1' width="100%" cellpadding="5" cellspacing="2" style="border-collapse: collapse;" bordercolor="#cccccc">
            <tr>
                <td class="tablehead1">Name</td>
                <td class="tablehead1">Email</td>
                <!-- <td class="tablehead1">City</td>
                <td class="tablehead1">State</td>
                <td class="tablehead1">Country</td> -->
                <td class="tablehead1">Role</td>
                <td class="tablehead1">#</td>
            </tr>
<?php
    while($row = mysqli_fetch_array($result)) { 
        if($row['status']!= '1') { ?>
        <tr bgcolor="#fca24e">
		<?php } else { ?>
		<tr>
		<?php } ?>
                <td><?php echo $row["firstname"].' '.$row["lastname"]; ?></td>
                <td><?php echo $row["user_email"]; ?></td>
                <!-- <td><?php //echo $row["city"]; ?></td>
                <td><?php //echo $row["state"]; ?></td>
                <td><?php //echo $row["country"]; ?></td> -->
                <td><?php echo $row["user_role"]; ?></td>
                <td><a href="<?php echo $baseurl; ?>/users_list.php?uid=<?php echo $row['user_id']; ?>">Edit</a></td>
              </tr>
   <?php } ?>
</table>
<?php } else { ?>
<table border='1' width="100%" cellpadding="5" cellspacing="2" style="border-collapse: collapse;" bordercolor="#cccccc">
    <tr><td colspan="">No records found</td></tr></table>
<?php } ?>

<?php if($_GET['uid']!='') { 

$updval = mysqli_fetch_array(mysqli_query($mysqli_link22,"SELECT * FROM users WHERE user_id = '".$_GET['uid']."'"));
?>
    <form method="post" name="updform" action="">
	<br>
		<table border='0'cellpadding="5" cellspacing="2" align="center">
			<tr>
				<td>First Name:</td>
				<td><input type="text" name="fname" value="<?php echo $updval['firstname']; ?>"><input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>"></td>
			</tr>
			<tr>
				<td>Last Name:</td>
				<td><input type="text" name="lname" value="<?php echo $updval['lastname']; ?>"></td>
			</tr>
			<!-- <tr>
				<td>City:</td>
				<td><input type="text" name="city" value="<?php //echo $updval['city']; ?>"></td>
			</tr>
			<tr>
				<td>State:</td>
				<td><input type="text" name="state" value="<?php //echo $updval['state']; ?>"></td>
			</tr>
			<tr>
				<td>Country:</td>
				<td><input type="text" name="country" value="<?php //echo $updval['country']; ?>"></td>
			</tr> -->
			<tr>
				<td>Email:</td>
				<td><input type="email" name="email" value="<?php echo $updval['user_email']; ?>"></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" ></td>
			</tr>
			<tr>
				<td>Role:</td>
				<td><select name="role" required>
		<option value="">Select</option>
		<option value="user"<?php if($updval['user_role']=='user') { echo "selected"; } ?>>User</option>
		<option value="admin"<?php if($updval['user_role']=='admin') { echo "selected"; } ?>>Admin</option>
		</select></td>
			</tr>
			<tr>
				<td>Status:</td>
				<td><select name="status" required>
		<option value="">Select</option>
		<option value="1"<?php if($updval['status']=='1') { echo "selected"; } ?>>Enable</option>
		<option value="0"<?php if($updval['status']=='0') { echo "selected"; } ?>>Disable</option>
		</select></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="update" value="Update" style="background-color:#6450ae; color: #fff; font-weight: 700; text-align: center; padding: 2px; width: 80px; display: inline-block;  cursor: pointer; font-size: 15px;"></td>
			</tr>
		</table>
        
    </form>
			<?php } ?>
			</div>
		</div>
        
    
	</DIV>
    
    
</DIV>
<?php //include('collapse-script.php'); ?>
</body>
</html>





