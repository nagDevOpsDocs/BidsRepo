<?php
$icons_on_the_right = "<div class='btn-group' style='float:right;'> 
                <div class='dropdown'>
                <i onclick='dropdownshow()' title='Dashboards' class='dropbtn fa fa-bar-chart-o' style='font-size: 16px;
                padding-right: 10px;
                display: inline-block;
                /* border-radius: 100px; */
                /* box-shadow: 0 0 2px #1f2662; */
                color: #fcfcfa;
                background-image: linear-gradient( #3ae2f3, #0b6069);
                padding: 0.35em 0.35em;
                margin-top: 5px;
                '></i>
                
                <!--<button onclick='dropdownshow()' class='dropbtn'>Dropdown</button>-->
                  <div id='myDropdown' class='dropdown-content'>
                    <a href='executive.php'>Executive</a>
                    <a href='proposals.php'>Proposals</a>
                    <a href='sales.php'>Sales</a>
                  </div>
                </div>
        </div>
        <div class='btn-group' style='float:right;'> 
                <div class='dropdown'>
                <i onclick='dropdownshow2()' title='History' class='dropbtn fa fa-history' style='
                margin-right: 4px;
                width: 30px;
                text-align: center;
                font-size: 16px;
                padding-right: 10px;
                display: inline-block;
                /* border-radius: 100px; */
                /* box-shadow: 0 0 2px #1f2662; */
                color: #fcfcfa;
                background-image: linear-gradient( #3ae2f3, #0b6069);
                padding: 0.35em 0.35em;
                margin-top: 5px;
                '></i>
                
                <!--<button onclick='dropdownshow()' class='dropbtn'>Dropdown</button>-->
                  <div id='myDropdown2' class='dropdown-content'>
                    <a href='executive.php'>Executive</a>
                    <a href='proposals.php'>Proposals</a>
                    <a href='sales.php'>Sales</a>
                  </div>
                </div>
        </div>
        <div class='btn-group' style='float:right;'> 
                <div class='dropdown'>
                <i onclick='dropdownshow3()' title='Settings' class='dropbtn fa fa-gear' style='
                margin-right: 4px;
                width: 30px;
                text-align: center;
                font-size: 16px;
                padding-right: 10px;
                display: inline-block;
                /* border-radius: 100px; */
                /* box-shadow: 0 0 2px #1f2662; */
                color: #fcfcfa;
                background-image: linear-gradient( #3ae2f3, #0b6069);
                padding: 0.35em 0.35em;
                margin-top: 5px;
                '></i>
                
                <!--<button onclick='dropdownshow()' class='dropbtn'>Dropdown</button>-->
                  <div id='myDropdown2' class='dropdown-content'>
                    <a href='executive.php'>Executive</a>
                    <a href='proposals.php'>Proposals</a>
                    <a href='sales.php'>Sales</a>
                  </div>
                </div>
        </div>";

//background-image:url(\"images/backgrounds/blueportal.jpg\");
print("
<div style='position:fixed; width:100%;z-index:2;' class=\"topnav\" id=\"myTopnav\"> 
	  <div style=\"display: inline;/*background-color:red;*/top:9px; left:30px; position:relative; font-size:15px; font-weight:700; color:#fff; font-family:'Segoe UI';
	  \">BidPortal</div>
	  
	  
	  
      <a href=\"logout.php\" class=\"w3-bar-item w3-button hidethis\">Logout</a>
      <a href=\"#\" class=\"w3-bar-item w3-button active\" style=\"font-family:'Segoe UI';\">$login_name</a>
      
      <!--<a href=\"membership.php\" class=\"w3-bar-item w3-button\">Membership</a>
      <a href=\"#contact\" class=\"w3-bar-item w3-button active\">Sponsors</a>
      <a href=\"#about\" class=\"w3-bar-item w3-button\">Advertisers</a>
      <a href=\"\\\" class=\"w3-bar-item w3-button\">Events</a>-->
      
      <a href=\"javascript:void(0);\" class=\"icon\" onclick=\"myFunction()\">
    <i class=\"fa fa-bars\"></i>
  		</a>
</div>
$search_area
");
//<div style='display: inline;/*background-color:red;*/ top:7px;left: 32%;position:relative;font-size:15px;font-weight:700;color:#fff;'>$search_area</div>
?>