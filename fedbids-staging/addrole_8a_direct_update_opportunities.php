<?php
session_start();
include("./includes/connect_portal123.php");
if($_SESSION['user_role']==''){ header("Location: $login");  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BidPortal | Ardent Technologies Inc</title>
<style type="text/css">
.rcs {
	font-family: 'Roboto', sans-serif;
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

.collapsible8 {
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

.active8, .collapsible8:hover {
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
button {font-family:'Roboto', sans-serif}
</style>
</head>

<body style="padding:0px; margin:0px; font-family:'Roboto', sans-serif; font-size:14px; background-color:#f1f1f1;">
<?php 
include('top_bar_include.php'); ?>	
<DIV style="background-color:#f1f1f1; width:100%;/*height:30000px;*/">
	<DIV style="background-color:#fafafa; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid; width:20%;display:inline-block;vertical-align:top; margin-top:65px; margin-left:15px; position:fixed;">
    	
    	<div style="padding:15px; font-weight:500; color:#464864">
        <!--<div style="font-weight:700; font-size:16px; background-color:#36374c; color:#FFF; text-align:center; padding-top:8px; padding-bottom:10px;margin-bottom:4px;" onclick="window.location.href='https://ardentinc.com/bids-test/addrole_home.php'">BidPortal</div>-->
        <!--
    	<br />
    	<a href="#area1" target="_self" style="font-weight:700;">Add Opportunity</a><BR><BR>
        <a href="#area2" target="_self" style="font-weight:700;">Update Opportunity</a><BR><BR>-->
        <?php 
			include('directed_8a_left_content_include.php');			
		?>
		<!--<div style="font-weight:700; font-size:16px; color:#464864; text-align:center; border-top:1px #64656e solid; padding-top:6px;">Count: 25</div>-->
		</div>
    
	</DIV>
    <?php 
	//which_update_id=" + oppid 
	if (!empty($_GET['which_update_id'])) { $which_update_id = $_GET['which_update_id']; $content_source = "ajax_8a_direct_opportunities_update_admin.php?which_update_id=$which_update_id";} else { $content_source = "ajax_8a_direct_opportunities_update_admin.php";}
	?>
    <DIV style="background-color:inherit; margin-left:21%; margin-top:50px; width:79%; height:1000px;display:inline-block;vertical-align:top;">
    	<div id="area" style="padding:15px; font-weight:500; color:#464864; font-weight:700; font-size:16px;"><!--Area Chart<BR />-->
    		<iframe src="<?php print $content_source; ?>" onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+400+"px";}(this));' style="height:500px;width:100%;border:none;overflow:hidden; width:100%; background-color:#FFF; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid;"></iframe>
		</div>
	</DIV>
    
    
</DIV>
<?php include('collapse-script.php'); ?>
</body>
</html>
<script>
/*window.onload = function() {
	alert("Loaded");
}*/
/*window.onload = function() {
  var iframe = document.getElementById('your-iframe-id');

  // add event listener to check when iframe is loaded
  iframe.addEventListener('load', function() {
    // scroll the page to the top
    window.scrollTo(0, 0);
  });
};*/
</script>