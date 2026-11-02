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
  display: none; /* block */
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



<!-- <script>
	function addOpp(){
		window.location.href='<?php //echo $baseurl?>/addrole_add_opportunity.php';
	}
</script>
 -->

<body style="padding:0px; margin:0px; font-family:'Century Gothic', 'Segoe UI'; font-size:14px; background-color:#f1f1f1;">
<?php include('top_bar_include.php'); ?>
<DIV style="background-color:#f1f1f1; width:100%;/*height:30000px;*/">
	<DIV style="background-color:#fafafa; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid; width:20%;display:inline-block;vertical-align:top; margin-top:65px; margin-left:15px; position:fixed;">
    	
    	<div style="padding:15px; font-weight:500; color:#464864">
        <?php 
			include('left_content_include.php');			
		?>
		</div>
    
	</DIV>
    <DIV style="background-color:inherit; margin-left:21%; margin-top:50px; width:79%; /*height:1000px;*/display:inline-block;vertical-align:top;">
    	<div id="area" style="padding:15px; font-weight:500; color:#464864; font-weight:700; font-size:16px; text-align:center; color:#336600">
		
    		<iframe src="ajax_add_master_contract.php" onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+400+"px";}(this));' style="height:500px;width:100%;border:none;overflow:hidden; width:100%; background-color:#FFF; border:1px #64656e solid;border-left: 1px #babbc6 solid;border-top: 1px #babbc6 solid;"></iframe>
		</div>
	</DIV>
</DIV>
<?php include('collapse-script.php'); ?>

</body>
</html>
