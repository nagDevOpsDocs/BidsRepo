<?php include_once("./includes/connect_portal123.php"); ?>
<link rel="stylesheet" href="<?php echo $baseurl; ?>/styles/style-topbar.css">
<div style='position: fixed; background-color: #1d1c24; width: 100%;z-index:5;'>
<div><?php
session_start();
$getusrdet = mysqli_fetch_array(mysqli_query($mysqli_link22,"SELECT firstname,lastname,myfav_bids FROM users WHERE user_id='".$_SESSION['user_id']."'"));
$name = $getusrdet[0].' '.$getusrdet[1];
//echo $name; exit;
		$getmngr = mysqli_query($mysqli_link,"SELECT manager_name FROM state_managers WHERE manager_name LIKE '%$name%'"); ?>
		<div style="display: inline;top:15px; left:20px; position:relative; font-size:20px; font-weight:700; color:#fff; font-family:'Segoe UI';">BidPortal</div>

		<div class="btn-group" style='float:right; font-size:15px; font-weight:700; padding-top: 10px; padding-left: 10px;'><ul id="nav">
		  <li><button type="button" class="collapsible"><img src="<?php echo $baseurl; ?>/images/menu-ico.png" style="margin-right: 10px; margin-top: 7px; margin-bottom: 10px;"></button>
			<ul>
			<li><a href="<?php echo $baseurl; ?>/addrole_add_opportunity.php">Manage Ops</a></li>
			<?php if(mysqli_num_rows($getmngr) > 0) { ?>
			  <li><a href="<?php echo $baseurl; ?>/agenda.php?search=&_mode=Agenda&mngr=rusvk54m">Assigned List</a></li>
			  <?php } ?>
			  <li><a href="<?php echo $baseurl; ?>/agenda.php?search=&_mode=Agenda&favlist=jklms27v">Favourite List</a></li>
			  <li><a href="<?php echo $baseurl; ?>/advanced_search.php">Advanced Search</a></li>
			  <li><a href="<?php echo $baseurl; ?>/changepwd.php">Change Password</a></li>
			  <li><a href="<?php echo $baseurl; ?>/logout.php">Logout</a></li>
			</ul>
			</li>
		</ul></div>
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