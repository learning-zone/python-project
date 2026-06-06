<?php
session_start();
require_once("../db.php");

//echo "<pre>";
//print_r($_GET);
//"<BR>".print_r($_POST);
//echo "</pre>";

if($_GET)
{
	$StudID=$_REQUEST['StudID'];
	$admission_id=$_REQUEST['admission_id'];
}

if($StudID!=''){
	$_SESSION['StudID']=$StudID;
}
if($admission_id!=''){
	$_SESSION['admission_id']=$admission_id;
}


if($_SESSION['StudID']!=''){
	$StudID=$_SESSION['StudID'];
}
if($_SESSION['admission_id']!=''){
	$admission_id=$_SESSION['admission_id'];
}	
//print_r($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/tab.css" />
<style type="text/css">
<!--
  body
  {
	  font: 14px "Helvetica Neue", Helvetica, Arial, sans-serif;	
	  margin: 10px 15px;		
  }
  td
  {
	  padding:3px;
  } 
-->
</style>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<script language="javascript">
function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<title>TRANSPORTATION DETAILS</title>
</head>
<body>
<form name="frm" action="" method="post">
<input type="hidden" name="hello" value="world"/>
<div id='menu'>
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
   <ul class="tabHead"> 
     <?	
 		$details=fetcharray(execute("SELECT * FROM `student_m` WHERE `id`='$StudID' LIMIT 1"));	
      ?> 
    <table class="forumline"  align="center" width="100%">
	<tr><td valign="top"><BR>   
    <li><a href="SearchStudent.php?StudID=<?=$StudID?>" title="Student Details">Student</a></li>
    <li><a href="behaviour.php?StudID=<?=$StudID?>" title="Student Behaviour">Pastoral Care</a></li>
    <li><a href="conference_edt.php?StudID=<?=$StudID?>" title="Parent-Teacher Meeting">P/T Meeting</a></li>
    <li class="currentBtn"><a href="transport.php?StudID=<?=$StudID?>" title="Transportation Details">Transport</a></li>
    <li><a href="StudentReportCard.php?StudID=<?=$StudID?>" title="Student Report">Assessment</a></li>
    <li><a href="familys.php?StudID=<?=$StudID?>" title="Add Siblings">Family</a></li>
    <li><a href="ecContact.php?StudID=<?=$StudID?>" title="Emergency Contact">EC Contact</a></li>
  </td>
 </tr>
</table>      
 </ul>
</div></div></div>
<?PHP
				
if($StudID!='')
{

	?>
  <table class=forumline width="100%" cellspacing="1" cellpadding="1" align='center' border="1">
    <tr height="30">
    	<td align='center' Class='row3' colspan='2'>TRANSPORTATION &nbsp;&nbsp;[&nbsp;<?=$details['first_name']?>&nbsp;<?=$details['last_name']?>&nbsp;]</td>
    </tr>
    <tr height="500">
    	<td></td>
    </tr>
  <?
}
else
{
	die("<BR><center><blink>Please Select Student First...!!!<blink><center>");
}
?>
</table>
</form>
</body>
</html>
