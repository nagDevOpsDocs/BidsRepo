<?php
print("

.slight {
	background: red;
    background: -moz-linear-gradient(top,#fff 80%,#f7f7f7 100%);
    background: -webkit-linear-gradient(top,#fff 80%,#f7f7f7 100%);
    background: linear-gradient(to bottom,#fff 80%,#f7f7f7 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff',endColorstr='#f7f7f7',GradientType=0);
	/*min-height:100px;*/
}

td { border-right:1px solid #eaeaea; /*padding:12px;*/
	vertical-align:top;

    /*position: relative;
    height: auto;
    font-family: 'Roboto Condensed',sans-serif;
    font-family: var(--neo-font-family-condensed);*/
    /*font-size: 11px;*/
    background: #fff;
    background: -moz-linear-gradient(top,#fff 80%,#f7f7f7 100%);
    background: -webkit-linear-gradient(top,#fff 80%,#f7f7f7 100%);
    background: linear-gradient(to bottom,#fff 80%,#f7f7f7 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff',endColorstr='#f7f7f7',GradientType=0);
    /*border-left: 1px solid #d8d8d8;
    border-right: 1px solid #d8d8d8;*/
    border-bottom: 1px dotted #d1d1d1;
    /*padding: 15px 20px;*/
	}
tr:nth-child(even) {background-color:#f4f4f4;}
tr:nth-child(odd) {background-color:#fff;}
tr:hover { background-color:#CEE0F7; /*color:#fff;*/ } /*#43489e #406eb3 #9cc1ed*/
/*body { font-family:\"Segoe UI\", Tahoma; font-size:13px; margin:0px; padding:0px;}*/
th { font-weight:bold; }
.clearfix {overflow: auto; }

/*@font-face {
	font-family: capturefont;
  	src: url(sansation_light.woff);
}*/
.filter_header { color:#747576; font-weight:700; }



.div_base {
    width: 96%;
	margin-left:2%;
    min-height: 90px;
    /* vertical-align: middle; */
    /* padding: 30px 0; */
    text-align: center;
    /* margin-top: 20px; */
}
#div0 { background-color:#eaeaea; border:1px solid #d1d1d1; display: none; }
#div1 { background-color:#eaeaea; border:1px solid #d1d1d1; display: none; }
#div2 { background-color:#eaeaea; border:1px solid #d1d1d1; display: none; }
#div3 { background-color:#ebeff5; display:none; }
#div4 { background-color:yellow; display:none; }
#div5 { background-color:orange; display:none; }
/*select { font-family: 'FontAwesome' }*/



.box {
  /*position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);*/
}

.box select {
  background-color: #0563af;
  color: white;
  padding: 8px;
  width: 160px;
  border: none;
  font-size: 16px;
  box-shadow: 0 2px 2px rgba(0, 0, 0, 0.4);
  -webkit-appearance: button;
  appearance: button;
  outline: none;
}

.box::before {
  /*content: \"\f13a\";*/
  /*font-family: FontAwesome;
  position: absolute;*/
  top: 0;
  right: 0;
  /*width: 20%;*/
  height: 100%;
  text-align: center;
  font-size: 28px;
  line-height: 45px;
  color: rgba(255, 255, 255, 0.5);
  background-color: rgba(255, 255, 255, 0.1);
  pointer-events: none;
}

.box:hover::before {
  color: rgba(255, 255, 255, 0.6);
  background-color: rgba(255, 255, 255, 0.2);
}

.box select option {
  padding: 30px;
}
/* To remove border radius */
    option {
      height: 20px;
      -webkit-border-radius: 0;
      border: 0;
      outline: 1px solid #ccc;
      outline-offset: -1px;
    }

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

/*.slider:before {
  position: absolute;
  content: \"\";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}*/
.slider:before {
	position: absolute;
    content: \"\";
    height: 14px;
    width: 26px;
    left: 3px;
    bottom: 4px;
    top: 3px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    border: 1px solid #141414;
}

input:checked + .slider {
  /*background-color: #2196F3;*/
  background-color: #365c95;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}


.table_border {    
	border-bottom: 2px solid #c9c9d0;
	border-right: 2px solid #c9c9d0;
    border-left: 1px solid #c9c9d0;
    border-top: 1px solid #c9c9d0;
}
.table_border_top {    
	border-bottom: none; /*2px solid #c9c9d0;*/ 
	border-right: 2px solid #c9c9d0;
    border-left: 1px solid #c9c9d0;
    border-top: 1px solid #c9c9d0;
}
.table_border_middle {    
	border-bottom: none; /*2px solid #c9c9d0;*/ 
	border-right: 2px solid #c9c9d0;
    border-left: 1px solid #c9c9d0;
    border-top: none; /*2px solid #c9c9d0;*/
}
.table_border_bottom {    
	border-bottom: 2px solid #c9c9d0; 
	border-right: 2px solid #c9c9d0;
    border-left: 1px solid #c9c9d0;
    border-top: none; /*2px solid #c9c9d0;*/
}

.table_border2 {
	border-bottom: 2px solid #233857; 
	border-right: 2px solid #233857;
    border-left: 1px solid #233857;
    border-top: 1px solid #233857;
}


/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  padding-bottom: 100px;
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #fff;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.app_border { border:1px solid #d0d0d0; width:240px;}
.dash_border { border:1px solid #d0d0d0; width:190px;}
.app_border:hover { /*border:1px solid #344056;*/ }
/*.app_border:hover .app{ color:#344056; background-color:#344056;}*/
.app { color:#808086; background-color:#f0f0f0; /*#ececee;*/}
.app:hover { color:#3d3d3f; /*background-color:#3d3d3f;*/ /*#1D7592; /*transform: scale(1.5);*/}

.app_grow { width:34px; height:34px;}
.app_border:hover .app_grow {/*transform: scale(1.5); position:relative;left:0px; top:-10px;*/}

.hovertr:hover2 {/*background-color:#1F6DA7;*//*color:#fff;*/ font-weight:700; color:#1F6DA7; /*#141414;*/
/* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#ffffff+0,f3f3f3+50,ededed+51,ffffff+100;White+Gloss+%232 */
}
.hovertr:hover {background-color:#36C; /*#1F6DA7;*/ /*#3E4055;*/ /*#1F6DA7;*/ color:#fff; font-weight:700; /*color:#1F6DA7;*/ /*#141414;*/
/* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#ffffff+0,f3f3f3+50,ededed+51,ffffff+100;White+Gloss+%232 */
}
.feather_gradient{
background: #ffffff; /* Old browsers */
background: -moz-linear-gradient(top,  #ffffff 0%, #f3f3f3 50%, #ededed 51%, #ffffff 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,  #ffffff 0%,#f3f3f3 50%,#ededed 51%,#ffffff 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,  #ffffff 0%,#f3f3f3 50%,#ededed 51%,#ffffff 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ffffff',GradientType=0 ); /* IE6-9 */

/*background-color:#1F6DA7;*/ /*#3A4058;*/ 
/*text-shadow: 1px 1px 1px rgba(0, 0, 0, 1);*/
}

.btn-group .button {
	background-color: #ffffff;
    border-top:1px solid #d2d2d5;
	border-left:1px solid #d2d2d5;
	border-right:3px solid #d2d2d5;
	border-bottom:3px solid #d2d2d5;
    color: #7f7f87;
    padding: 6px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    float: left;
    margin-right:5px;
	border-radius:0px;
}

.btn-group .thispagebutton {/*background-color:#4c5fb9; color:#fff;*/ border-bottom:3px solid #293466; color: #293466;}

.btn-group .button:not(:last-child) {
  /*border-right: none;*/ /* Prevent double borders */
}

.btn-group .button:hover {
  background-color: #384893; color:#fff;
}



.show {display: block;}


.select_color { background-color: #f0f0f0; color:#1f1f21; border:1px solid #c1c1cc; /* #76818b; #8698a9; #303b72; #8698a9; */ }
.select_color:hover { background-color: #4a5cb3; color:#fff; border:1px solid #c1c1cc; border: 1px solid #7e7e84; /*#515b64;*/ }


/*.bidbutton { background: linear-gradient(#3093e7, #173a85); background-color:red;}
.bidbutton:hover { background: linear-gradient(#3198ef, #1d56d0); }*/

");
?>
