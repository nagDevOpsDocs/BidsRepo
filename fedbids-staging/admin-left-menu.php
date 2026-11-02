<?php session_start(); include("./includes/connect_portal123.php"); ?>
<style>
.admbtn {
  background-color: #3c4db0;
  color: white;
  cursor: pointer;
  padding: 14px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-weight:700;
}
</style>
<div style="font-weight:700; font-size:16px; background-color:#36374c; color:#FFF; text-align:center; padding-top:8px; padding-bottom:10px;margin-bottom:4px;">Admin Bid Portal</div>
<button type="button" class="admbtn" style="margin-bottom:4px;" 
onclick="window.location.href='<?php echo $baseurl; ?>/add_user.php'">Add User</button>
<button type="button" class="admbtn" style="margin-bottom:4px;" onclick="window.location.href='<?php echo $baseurl; ?>/users_list.php'">View / Edit Users</button>
<button type="button" class="admbtn" style="margin-bottom:4px;" onclick="window.location.href='<?php echo $baseurl; ?>/add_manager.php'">Add Manager</button>
<button type="button" class="admbtn" style="margin-bottom:4px;" onclick="window.location.href='<?php echo $baseurl; ?>/managers_list.php'">View / Edit Managers</button>
<button type="button" class="admbtn" style="margin-bottom:4px;" onclick="window.location.href='<?php echo $baseurl; ?>/changepwd.php'">Change Password</button>
<button type="button" class="admbtn" style="margin-bottom:4px;" onclick="window.location.href='<?php echo $baseurl; ?>/logout.php'">Logout</button>