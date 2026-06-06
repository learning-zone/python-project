<?php
session_start();	
include("../db1.php");
$stid=$_POST['stid'];
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$app_no=$_POST['app_no'];
$accyeardet=$_SESSION['AcademicYear'];
$un=$_POST['un'];
$studfname=$_POST['studfname'];
$id=$_GET['id'];
?>
<html>
<head>
<script language="JavaScript">
function prn()
		{
			pr1.style.display = "none";
			window.print();
		}
</script>
<style type="text/css">
table.curvedEdges 
{ 
  font-family: Calibri;
  border-radius:13px;
}
</style>

<style type="text/css">
table tr.curved 
{ 
  font-family: Calibri;
  font-size:14px;
}
</style>

<style type="text/css">
table td.ftsize 
{ 
  font-family: Calibri;
  font-size:14px;
}
</style>

<style type="text/css">
	p.vertical
	 {
		   writing-mode:tb-lr;
		   -webkit-transform:rotate(270deg);
		   -moz-transform:rotate(270deg);
		   -o-transform: rotate(270deg);
		   white-space:nowrap;
		   display:block;
		   bottom:0;
		   width:10px;
		   height:40px; 
		   position:relative;
		   left:24px;
		   top:37px;
	}
</style>
</head>
<body>
<form name='frm' method='post'>
<table border="0" width='403px' height="245px" align="center"  cellpadding="0" cellspacing="0" class="curvedEdges">
<tr>
<td align="left" nowrap colspan="4">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr><td width="4%"></td><td>
<b><font style="font-family:'Times New Roman', Times, serif">
Mercedes-Benz International School<br>
<font size="-2">
P-26 MIDC PHASE 1,<BR>
RAJEEV GANDHI INFOTECH PARK,<BR>
HINJEWADI, PUNE - 411057 
</font></font>
</b></td>
</tr></table>
</td>
<td align="center" rowspan="2" colspan="4" width="10%"><img src="logo.PNG"  height='100'></td>

</tr>
<tr height="40">
<?php

$vewdet=mysql_query("select * from student_m where id='$id'");
while($viewsetss=mysql_fetch_array($vewdet))
{
	$grdes=mysql_fetch_row(mysql_query("select year_name from course_year where year_id='$viewsetss[course_yearsem]'"));
		$section=mysql_fetch_row(mysql_query("select section_name from class_section where id='$viewsetss[class_section_id]'"));	

$vewdet1=$viewsetss[dob];
$datsdet1=( date("d/M/Y", strtotime($vewdet1)) );

?>
<td align="left" style="font-size:17px" colspan="4"  background="bule.png"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FFFFFF"><?=$viewsetss[first_name]?>&nbsp;<?=$viewsetss[last_name]?></font></b></td>

</tr>
<tr height="12%">
<td align="center" rowspan="7" width="10px"></td>

<td align="center" rowspan="7" background="bule.png" width="125">
<table border="0" align="center"  cellpadding="1" cellspacing="0" width="100%"  height="100%">
<tr>
<td align="center" valign="top">
<img src="<?php echo $viewsetss[img_source]?>" height="138">
</td>
</tr>
</table>
</td>
<td align="left" width="70px" style="border-bottom-right-radius:20px" background="bule.png" class="ftsize" ><font color="#FFFFFF">&nbsp;<strong><?=$viewsetss[student_id]?></strong></font></td>
<td>&nbsp;</td>
<td align="center" colspan="4"><font color="#0093DD" size="2" style="font-family:'Arial Black', Gadget, sans-serif"><strong>STUDENT</strong></font></td>
</tr>

<td align="center" nowrap colspan="5" >
<table border="0" align="center"  cellpadding="0" cellspacing="0" width="100%"  height="100%">
<tr height="20%">
<td colspan="2"></td>
<td colspan="2" align="center" valign="top"><font color="#0093DD" size="2" style="font-family:'Arial Black', Gadget, sans-serif"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$grdes[0]?></strong></font></td>
</tr>
<tr>
<td width="3%"><b>&nbsp;</b></td>
<td align="left" colspan="2" >
<font  style="font-size:13px"><b>
<u>Emergency contact</u>
</b>
</font>
</td>
<td rowspan="4" class="ftsize"  background="buledark.PNG" width="12%"><p class="vertical"  style="width:4px"><font color="#FFFFFF" size="3"><b><?=$accyeardet?>&nbsp;-&nbsp;<?=$accyeardet+1?></b></font></p></td>
</tr>
<tr class="curved">
<td><b>&nbsp;</b></td>
<td><b>&nbsp;<?=$viewsetss[parent_name]?></b></td>
<td><b>:&nbsp;<?=$viewsetss[sms_mobile]?></b></td>
</tr>
<tr class="curved">
<td><b>&nbsp;</b></td>
<td><b>&nbsp;<?=$viewsetss[m_name]?></b></td>
<td><b>:&nbsp;<?=$viewsetss[mnum]?></b></td>
</tr>
<tr class="curved">
<td><b>&nbsp;</b></td>
<td><b>&nbsp;Date of birth</b></td>
<td><b>:&nbsp;<?=$datsdet1?></b></td>
</tr>
</table>
</td>
</tr>
</table>
<?
}
?>
</form>
<div id=pr1 align=center><INPUT TYPE="button" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>
</div>
</body>
</html>