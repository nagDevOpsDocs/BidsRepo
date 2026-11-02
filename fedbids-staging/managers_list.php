<?php
session_start();
ob_start();

include("./includes/connect_portal123.php"); 
if($_SESSION['user_role']==''){ header("Location: $login");  }

// Report all PHP errors
error_reporting(E_ALL);


if(isset($_POST["update"])){

	$name = $_POST['name'];
	$email = $_POST['email'];
	$status = $_POST['status'];
	$access_type = $_POST['access_type'];
	$uid = $_POST['uid'];


	$updqry = mysqli_query($mysqli_link,"UPDATE managers SET manager_name='".$name."',  manager_email = '".$email."', access_type='".$access_type."' manager_show = '".$status."' WHERE manager_id = '".$uid."'");


	if($updqry)
	{
		//$error_message = "Details updated successfully.";
		header("Location: managers_list.php?sid=1");
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
<link href="https://cdn.datatables.net/2.0.4/css/dataTables.dataTables.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
 <script>
$(document).ready(function() {
    $('#example').DataTable( {
		language: { search: "",
		searchPlaceholder: 'Search' },
		"lengthMenu": [[15, 40, 100, -1], [15, 40, 100, "All"]],
        "order": [[ 0, "" ]],
		"columns": [
    { "width": "30%" },
    { "width": "30%" },
    { "width": "20%" },
    { "width": "10%" }
  ]
    } );
} );

</script>
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
			<h2 style="margin-top: 0px;">Managers List</h2>
			<?php if($_GET['sid']==1) { echo "Details updated successfully"; } ?>

<?php
// Fetch data from the "users" table
$result = mysqli_query($mysqli_link,"SELECT * FROM managers");

if(mysqli_num_rows($result) > 0) { ?>
<table id="example" class="display" style="width:100%; font-family:'Roboto', sans-serif; font-size: 13px;">
<thead>
<tr style="background-color: #3c4db0; color: #ffffff;">
	<td class="tablehead1">Name</td>
	<td class="tablehead1">Email</td>
	<td class="tablehead1">Access</td>
	<td class="tablehead1">#</td>
</tr>
</thead>
<?php
    while($row = mysqli_fetch_array($result)) { 
        if($row['manager_show']!= '1') { ?>
        <tr style="color:#DAA520">
		<?php } else { ?>
		<tr>
		<?php } ?>
                <td><?php echo $row["manager_name"]; ?></td>
                <td><?php echo $row["manager_email"]; ?></td>
                <td><?php if($row["access_type"]=='F') { echo 'Federal'; } else { echo 'State'; } ?></td>
                <td><a href="<?php echo $baseurl; ?>/managers_list.php?uid=<?php echo $row['manager_id']; ?>">Edit</a></td>
              </tr>
   <?php } ?>
</table>
<?php } else { ?>
<table border='1' width="100%" cellpadding="5" cellspacing="2" style="border-collapse: collapse;" bordercolor="#cccccc">
    <tr><td colspan="">No records found</td></tr></table>
<?php } ?>

<?php if($_GET['uid']!='') { 

$updval = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT * FROM managers WHERE manager_id = '".$_GET['uid']."'"));
?>
    <form method="post" name="updform" action="">
	<br>
		<table border='0'cellpadding="5" cellspacing="2" align="center">
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name" value="<?php echo $updval['manager_name']; ?>"><input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>"></td>
			</tr>

			<tr>
				<td>Email:</td>
				<td><input type="email" name="email" value="<?php echo $updval['manager_email']; ?>"></td>
			</tr>

			<tr>
				<td>Access Type:</td>
				<td>
				<select name="access_type">
				<option value="">Select</option>
				<option value="F"<?php if($updval['access_type']=='F') { echo "selected"; } ?>>Federal</option>
				<option value="S"<?php if($updval['access_type']=='S') { echo "selected"; } ?>>State</option>
				<option value="B"<?php if($updval['access_type']=='B') { echo "selected"; } ?>>Both</option>
				</select>
				</td>
			</tr>

			<tr>
				<td>Status:</td>
				<td><select name="status">
				<option value="">Select</option>
				<option value="1"<?php if($updval['manager_show']=='1') { echo "selected"; } ?>>Active</option>
				<option value="0"<?php if($updval['manager_show']=='0') { echo "selected"; } ?>>In Active</option>
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





