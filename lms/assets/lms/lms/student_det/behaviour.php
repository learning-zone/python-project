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
	$StudID=$_GET['StudID'];
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
  <link rel="STYLESHEET" type="text/css" href="codebase/dhtmlxgrid.css">
  <link rel="stylesheet" type="text/css" href="codebase/skins/dhtmlxgrid_dhx_skyblue.css">
  <link rel="stylesheet" type="text/css" href="css/tab.css" />
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
<Script language="JavaScript">
  function OpenWind2(URL, title,w,h)
  {

	 var left = (screen.width/2)-(w/2);
     var top = (screen.height/2)-(h/2);
     var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	 
  }
</script>
  <script src="codebase/dhtmlxcommon.js"></script>
  <script src="codebase/dhtmlxgrid.js"></script>		
  <script src="codebase/dhtmlxgridcell.js"></script>
  <script src="codebase/dhtmlxdataprocessor.js"></script>
</head>
<title>PASTORAL CARE</title>
<body>
<form method="post" name="frm">
<div id='menu'>
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
   <ul class="tabHead"> 
     <?	
 		$details=fetcharray(execute("SELECT * FROM `student_m` WHERE `id`='$StudID' LIMIT 1"));	
      ?> 
    <table class="forumline"  align="center" width="100%" bgcolor="#FFFFFF">
	<tr><td valign="top"><BR>   
    <li><a href="SearchStudent.php?StudID=<?=$StudID?>" title="Student Details">Student</a></li>
    <li class="currentBtn">
    <a href="behaviour.php?StudID=<?=$StudID?>" title="Student Behaviour">Pastoral Care</a></li>
    <li><a href="conference_edt.php?StudID=<?=$StudID?>" title="Parent-Teacher Meeting">P/T Meeting</a></li>
    <li><a href="transport.php?StudID=<?=$StudID?>" title="Transportation Details">Transport</a></li>
    <li ><a href="StudentReportCard.php?StudID=<?=$StudID?>" title="Student Report">Assessment</a></li>
    <li><a href="familys.php?StudID=<?=$StudID?>" title="Add Siblings">Family</a></li>
    <li><a href="ecContact.php?StudID=<?=$StudID?>" title="Emergency Contact">EC Contact</a></li>
  </td>
 </tr>
</table>      
 </ul>
</div></div></div>
<table align='center' class='forumline' width='100%' bgcolor="#FFFFFF">
  <tr height="20">
 <td align="center" colspan="10" class="row3">PASTORAL CARE &nbsp;&nbsp;[&nbsp;<?=$details['first_name']?>&nbsp;<?=$details['last_name']?>&nbsp;]</td>
        <td align="center" class="row3">
        <a href="javascript:void(0);" onClick ="OpenWind2('pastoral_addEvent.php?StudID=<?=$StudID?>', 'OpenWind2',1000,800)"><img src="../images/add1.png" height="28" width="28" title="Add New" align="absmiddle"  /></a></p>
        </td>
  </tr>
  <table align="left" border="0" bgcolor="#FFFFFF">
  	<tr>
       <td colspan="10"><div id="gridbox" style="width:1030px;height:470px;overflow:hidden"></div>
	<?
		if($StudID){
			$_SESSION['StudID']=$StudID;
		}else{
			$_SESSION['StudID']='';
		}
	?>
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
</td>
</tr>
</table>
</table>
</form>
</body>
</html>
