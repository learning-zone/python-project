<?php
session_start();
include("../db1.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$user = $_SESSION['user'];
$a_year = $_SESSION['AcademicYear'];

if($_GET)
{
	$sem=$_REQUEST['sem'];
	$branch=$_REQUEST['branch'];
	$a_year=$_REQUEST['a_year'];
    $studfname=$_REQUEST['studfname'];
	$studlname=$_REQUEST['studlname'];
	$student_id=$_REQUEST['student_id'];
	$class_section_id=$_REQUEST['class_section_id'];
}
if($_POST)
{

	$sem=$_POST['sem'];
	$branch=$_POST['branch'];
	$app_no=$_POST['app_no'];
	$studfname=$_POST['searchField'];
	$class_section_id=$_POST['class_section_id'];
}
$adate=date('d/m/Y');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <link rel="icon" href="common/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="common/favicon.ico" type="image/x-icon" />
  <!--<link rel="stylesheet" href="common/css/style.css" type="text/css" media="screen" />-->
  <link rel="STYLESHEET" type="text/css" href="codebase/dhtmlxgrid.css">
  <link rel="stylesheet" type="text/css" href="codebase/skins/dhtmlxgrid_dhx_skyblue.css">
  <style type="text/css">
  <!--

body {

	background-image:url('../bgy.png');
	background-repeat:repeat-x,y;
	border-bottom-left-radius:13px;
	border-bottom-right-radius:13px;
	border-top-left-radius:13px;
	border-top-right-radius:13px;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;

}

a:active{ color : #0A2756;text-decoration: blink;font-weight:bold; }
a:hover		{ text-decoration: underline; color : #DD6900; }
hr	{ height: 0px; border: solid #D1D7DC 0px; border-top-width: 1px;}

.bodyline	{  border: 1px #98AAB1 ; }

.bodyline_new	{ background-color: #F1F2FA; border: 1px #98AAB1 ; }

table.forumline	{ 
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 12px;
	border:thin;
	border-spacing: 50px;
	margin-top: 0px;
	padding-top:25px;
	padding-bottom:25px;
	padding-right:50px;
	padding-left:50px;
}
table	{ 
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 12px;
	color: #404040;
	border-collapse: collapse;
	border-spacing: 0px;
	margin-top: 0px;
}

td { 

	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;font-weight: normal;
	font-size: 12px;
	color: #404040;
	padding-left: 3px;
}

td.row3	{ 
	border-bottom:thin;
	border-bottom-color:#999;
	background-color: #BEC8D1;
	font-weight:bold;
	background:#DFE0FC url('../bg4.png') repeat-x;
	text-align: center;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 12px;
	color: #404040;
}


td.head{
	border-bottom:thin;
	border-bottom-color:#999;
	font-weight:thin;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 14px;
	color: #FFFFFF;
	background-image:url('../bg1.png');
	background-repeat:repeat-x,y;
}

td.cat,td.catHead,td.catSides,td.catLeft,td.catRight,td.catBottom {
	background-image: url(images/cellpic1.gif);
	background-color:#646D7E; border-bottom:thin;
	border-bottom-color:#999;
	height: 28px;
	color:#FFF;
}
td.catHead div{
	padding:5px;
	background-color:#98AFC7; border: #FFFFFF;  height: 18px;
	color:#FFF;
	font-face:bold;
   }

td.cat,td.catHead,td.catBottom {
	height: 29px;
	border-width: 0px 0px 0px 0px;
}

td.submenu{
	border-bottom: 1px dotted #6699CC;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;font-weight: bold;
	font-size: 13px;
	color: #404040;
	background:#DFE0FC url('../bg4.png') repeat-x;
	background-color: white;
	padding-left: 3px;
}
td.thHead,td.thSides,td.thTop,td.thLeft,td.thRight,td.thBottom,td.thCornerL,td.chead,td.thCornerR {
	border: #FFFFFF; border-style: solid; height: 28px; }
td.row3Right,td.spaceRow {
	background-color: #D1D7DC; border: #FFFFFF; border-style: solid; }

th.thHead,td.catHead { font-size: 12px; border-width: 1px 1px 0px 1px; }
th.thSides,td.catSides,td.spaceRow	 { border-width: 0px 1px 0px 1px; }
th.thRight,td.catRight,td.row3Right	 { border-width: 0px 1px 0px 0px; }
th.thLeft,td.catLeft	  { border-width: 0px 0px 0px 1px; }
th.thBottom,td.catBottom  { border-width: 0px 1px 1px 1px; }
th.thTop	 { border-width: 1px 0px 0px 0px; }
th.thCornerL { border-width: 1px 0px 0px 1px; }
th.thCornerR { border-width: 1px 1px 0px 0px; }

.maintitle,h1,h2	{
	font-size: 22px; font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	text-decoration: none; line-height : 120%; color : #000000;
}


.gen { font-size : 12px; }
.genmed { font-size : 11px; }
.gensmall { font-size : 10px; }
.gen,.genmed,.gensmall { color : #000000; }
a.gen,a.genmed,a.gensmall { color: #0A2756; text-decoration: none; }
a.gen:hover,a.genmed:hover,a.gensmall:hover	{ color: #F00; oration: underline; }

tr.clsName td{
background-color:#D7D7D7;
}

.bgbutton{

	font-size: 13px;
	color: #FFFFFF;
	background:#DFE0FC url('../bg1.png') repeat-x;
	border-bottom-left-radius:5px;
	border-bottom-right-radius:5px;
	border-top-left-radius:5px;
	border-top-right-radius:5px;
}
.bgbutton:hover{
	background-color : #BEC8D1;
	color : #030B52;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 13px; font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	background:#DFE0FC url('../bg2.png') repeat-x;
 }
button{

	font-size: 13px;
	color: #FFFFFF;
	background:#DFE0FC url('../bg1.png') repeat-x;
	border-bottom-left-radius:5px;
	border-bottom-right-radius:5px;
	border-top-left-radius:5px;
	border-top-right-radius:5px;
}
button:hover{
	background-color : #BEC8D1;
	color : #030B52;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 13px; font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;	
	background:#DFE0FC url('../bg2.png') repeat-x;
 }
submit{

	font-size: 13px;
	color: #FFFFFF;
	background:#DFE0FC url('../bg1.png') repeat-x;
	border-bottom-left-radius:5px;
	border-bottom-right-radius:5px;
	border-top-left-radius:5px;
	border-top-right-radius:5px;
}
submit:hover{
	background-color : #BEC8D1;
	color : #030B52;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;	
	font-size: 13px; font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	background:#DFE0FC url('../bg2.png') repeat-x;
 }

.mainmenu		{ font-size : 11px; color : #000000 }
a.mainmenu		{ text-decoration: none; color : #0A2756; }
a.mainmenu:hover{ text-decoration: underline; color : #DD6900; }
a.mainmenu:active{color : #000000; }


.name			{ font-size : 11px; color : #000000;}


.postdetails		{ font-size : 10px; color : #000000; }

input,textarea, select {
	font-size:12px;
	color:#000033;
	border: 1px solid #B0C6EA;	
}

input.post, textarea.post, select {
	font-size:12px;
	color:#000033;
	border: 1px solid #B0C6EA;	
}
  -->
  </style>
<Script language="JavaScript">
  function OpenWind2(URL, title,w,h)
  {

	 var left = (screen.width/2)-(w/2);
     var top = (screen.height/2)-(h/2);
     var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	 
  }
</script>
<Script language="JavaScript">
  function adds_onclick()
  {
	  document.frm.action="pastoral_edt.php?Type=Add";
	  document.frm.submit();
  }
  function RefreshMe()
  {
	  document.frm.action="pastoral_edt.php";
	  document.frm.submit();
  }
</script>
<Script language="JavaScript">
  function Comments()
  {
	  document.frm.action="pastoral_edt.php?Type=comments";
	  document.frm.submit();  
  }
</script>
  <script src="codebase/dhtmlxcommon.js"></script>
  <script src="codebase/dhtmlxgrid.js"></script>		
  <script src="codebase/dhtmlxgridcell.js"></script>
  <script src="codebase/dhtmlxdataprocessor.js"></script>

</head>
<title>PASTORAL CARE</title>
<body >
<form method="post" name="frm">
<table align='center' class='forumline' width='100%'>
  <tr>
  		<td align="center" colspan="10" class="head">PASTORAL CARE</td>
  </tr>

  <BR>
<!--  <div style="overflow-x:hidden;overflow-y:scroll; height:422px">-->
  <table align="left" border="0">
  	<tr>
       <td colspan="10"><div id="gridbox" style="width:974px;height:422px;overflow:hidden"></div>

 <script>
	mygrid = new dhtmlXGridObject('gridbox');
	mygrid.setImagePath("codebase/imgs/");
	mygrid.setHeader("Sl No,Date,Event,Description,Consequences,Dentention");
	mygrid.setInitWidths("50,100,200,300,210,100")
	mygrid.setColAlign("center,left,left,left,left,left")
	<!--mygrid.setColTypes("dyn,ed,txt,price,ch,coro,ch,ro");-->
	mygrid.setColTypes("ro,ro,ro,ro,ro,ro");
	mygrid.setSkin("dhx_skyblue");
	mygrid.setColSorting("int,str,str,str,str,str")
	mygrid.init();
	mygrid.loadXML("php/get.php");	//used just for demo purposes
	
   //============================================================================================
	myDataProcessor = new dataProcessor("php/update.php"); //lock feed url
	myDataProcessor.init(mygrid); //link dataprocessor to the grid
   //============================================================================================
</script>
	</td>
   </tr>
   <tr>
<td>
<p align="center">
<input type="button"  value="Add Event" href="javascript:void(0);" onClick ="OpenWind2('pastoral_addEvent.php?student_id=<?=$student_id?>&class_section_id=<?=$class_section_id?>&branch=<?=$branch?>&sem=<?=$sem?>&studfname=<?=$studfname?>&studlname=<?=$studlname?>&a_year=<?=$a_year?>', 'OpenWind2',800,600)" class="bgbutton" style="width:90px; height:22px"></p>
</td>
</tr>
</table>
</table>
</form>
</body>
</html>
