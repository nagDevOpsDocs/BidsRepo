<?php include_once("./includes/connect_portal123.php"); ?>
<link rel="stylesheet" href="<?php echo $baseurl; ?>/styles/style-topbar.css">
<div style='position: fixed; background-color: #1d1c24; width: 100%;z-index:5;  padding-top:15px;  padding-bottom:15px'>
<div>
<?php
	session_start();
	$getusrdet = mysqli_fetch_array(mysqli_query($mysqli_link,"SELECT firstname,lastname,myfav_bids FROM users WHERE user_id='".$_SESSION['user_id']."'"));
	$name = $getusrdet[0].' '.$getusrdet[1];
	//echo $name; exit;
	$getmngr = mysqli_query($mysqli_link,"SELECT manager_name FROM managers WHERE manager_name LIKE '%$name%'"); 
?>
		<div style="display: inline;top:1px; left:20px; position:relative; font-size:20px; font-weight:700; color:#fff; font-family:'Segoe UI';">BidPortal</div>

<?php //if($_SESSION['user_role']!='superadmin') { ?>
		<div class="btn-group" style='position: absolute; right: 10px; top: 4px; font-size:15px; font-weight:700;'>
		<?php if(!in_array($_SESSION['user_id'], DIRECTED_8A_USERS)) { ?>
		<ul id="nav">

		  <!-- <li><button type="button" class="collapsible"><img src="<?php echo $baseurl; ?>/images/menu-ico.png" style="margin-right: 10px; margin-top: 7px; margin-bottom: 10px;"></button>
			<ul style="margin-right: -9px;">
			<li><a href="<?php echo $baseurl; ?>/addrole_add_opportunity.php">Manage Ops</a></li>
			<?php if(mysqli_num_rows($getmngr) > 0) { ?>
			  <li><a href="<?php echo $baseurl; ?>/agenda.php?search=&_mode=Agenda&mngr=rusvk54m">Assigned List</a></li>
			  <?php } ?>
			  <li><a href="<?php echo $baseurl; ?>/agenda.php?search=&_mode=Agenda&favlist=jklms27v">Favourite List</a></li>
			  <li><a href="<?php echo $baseurl; ?>/advanced_search.php">Advanced Search</a></li>
			  <li><a href="<?php echo $baseurl; ?>/changepwd.php">Change Password</a></li>
			  <li><a href="<?php echo $baseurl; ?>/logout.php">Logout</a></li>
			</ul>
			</li> -->

		</ul>
		<?php } ?>
		</div>
		
</div>

</div>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>