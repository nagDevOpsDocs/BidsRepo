<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BidPortal | Ardent Technologies Inc</title>
<style type="text/css">
.rcs {
	font-family: "Century Gothic", "Segoe UI";
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
  display: block;
  overflow: hidden;
  background-color: #fcfcfc;
  border-left:1px #e4e4e4 solid;
  border-right:1px #e4e4e4 solid;
  border-bottom:1px #e4e4e4 solid;
  font-size:12px;
}
button {font-family:'Century Gothic'}
</style>

</head>

<body style="padding:0px; margin:0px; font-family:'Century Gothic', 'Segoe UI'; font-size:14px; background-color:#f1f1f1;">	
<?php include('top_bar_include.php'); ?>	
<DIV style="background-color:#f1f1f1; width:100%;/*height:30000px;*/">
	<DIV style="background-color:#fafafa; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid; width:20%;display:inline-block;vertical-align:top; margin-top:65px; margin-left:15px; position:fixed;">
    	
    	<div style="padding:15px; font-weight:500; color:#464864">
        <!--<div style="font-weight:700; font-size:16px; background-color:#36374c; color:#FFF; text-align:center; padding-top:8px; padding-bottom:10px;margin-bottom:4px;" onclick="window.location.href='https://ardentinc.com/bids-test/addrole_home.php'">BidPortal</div>-->
        <!--
    	<br />
    	<a href="#area1" target="_self" style="font-weight:700;">Add Opportunity</a><BR><BR>
        <a href="#area2" target="_self" style="font-weight:700;">Update Opportunity</a><BR><BR>-->
        <!--<button type="button" class="collapsible7" style="margin-bottom:4px;" onclick="window.location.href='https://ardentinc.com/bids-test/addrole_add_opportunity.php'">Add Opportunity</button>
        
        <button type="button" class="collapsible7">Update Opportunity</button>-->
            <?php
	$search_suffix = "?opportunity_id>0";
	$content_source = "ajax_opportunities_admin.php";
	$range_from="";
	$range_to="";
	$search_term="All";
	
	if (!empty($_GET['which_update_id'])) { $search_suffix .= "&which_update_id=". $_GET['which_update_id']; }
	if (!empty($_GET['search'])) { $search_suffix .= "&search=". $_GET['search'];  $search_term=$_GET['search'];}
	
	if (isset($_GET['ot1'])) { $search_suffix .= "&ot1=". $_GET['ot1']; } 
	if (isset($_GET['ot2'])) { $search_suffix .= "&ot2=". $_GET['ot2']; } 
	if (isset($_GET['ot3'])) { $search_suffix .= "&ot3=". $_GET['ot3']; } 
	if (isset($_GET['ot4'])) { $search_suffix .= "&ot4=". $_GET['ot4']; } 
	if (isset($_GET['ot5'])) { $search_suffix .= "&ot5=". $_GET['ot5']; } 
	
	if (isset($_GET['veh1'])) { $search_suffix .= "&veh1=". $_GET['veh1']; } 
	if (isset($_GET['veh2'])) { $search_suffix .= "&veh2=". $_GET['veh2']; } 
	if (isset($_GET['veh3'])) { $search_suffix .= "&veh3=". $_GET['veh3']; } 
	if (isset($_GET['veh4'])) { $search_suffix .= "&veh4=". $_GET['veh4']; } 
	if (isset($_GET['veh5'])) { $search_suffix .= "&veh5=". $_GET['veh5']; } 
	if (isset($_GET['veh6'])) { $search_suffix .= "&veh6=". $_GET['veh6']; } 
	if (isset($_GET['veh7'])) { $search_suffix .= "&veh7=". $_GET['veh7']; } 
	//if (!empty($_GET['range_from'])) { $search_suffix .= "&range_from=". $_GET['range_from']; $range_from=$_GET['range_from'];} else {$range_from=""; }
	//if (!empty($_GET['range_to'])) { $search_suffix .= "&range_to=". $_GET['range_to']; $range_to=$_GET['range_to'];} else { $range_to=""; }


			include('left_content_include.php');
			?>
					<!--<div style="font-weight:700; font-size:16px; color:#464864; text-align:center; border-top:1px #64656e solid; padding-top:6px;">Count: 25</div>-->
		</div>
    
	</DIV>
    <?php 
	//which_update_id=" + oppid 
	
	//!empty($_GET['range_from'])) { $range_from_qy = " DATE(released) >= '2022-01-01' ";
	/*if (!empty($_GET['which_update_id'])) { $which_update_id = $_GET['which_update_id']; 
		if (!empty($_GET['search'])) { $search_this = $_GET['search']; $search_suffix = "&search=$search_this";} 
	$content_source = "ajax_opportunities_admin.php?which_update_id=$which_update_id" . $search_suffix;} else 
	{ 
		if (!empty($_GET['search'])) { $search_this = $_GET['search']; $search_suffix = "?search=$search_this";} 
		$content_source = "ajax_opportunities_admin.php" . $search_suffix;
	}*/
	$content_source .= $search_suffix; 
	?>
    <DIV style="background-color:inherit; margin-left:21%; margin-top:50px; width:79%; height:1000px;display:inline-block;vertical-align:top;">
    	<div id="area" style="padding:15px; font-weight:500; color:#464864; font-weight:700; font-size:16px;"><!--Area Chart<BR />-->
    		<iframe src="<?php print $content_source; ?>" onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));' style="height:1000px;width:100%;border:none;overflow:hidden; width:100%; background-color:#FFF; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid;"></iframe>
		</div>
        
    
	</DIV>
    
    
</DIV>
<?php include('collapse-script.php'); ?>
</body>
</html>