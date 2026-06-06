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
function printReport()
{
//	prn.style.display="none";
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
  font-size:13px;
}
</style>

<style type="text/css">
table td.ftsize 
{ 
  font-family: Calibri;
  font-size:13px;
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
		   left:15px;
		   top:28px;
	}
</style>
</head>
<body onLoad="printReport()">
<form name='frm' method='post'>
<table border="0" width='403px' height="215px" align="center"  cellpadding="0" cellspacing="0" class="curvedEdges">
<tr>
<td align="left" nowrap colspan="3">
<b>

Mercedes-Benz International School<br>
<font size="-1">
P-26 MIDC Phase 1,<br>
Rajeev Gandhi Infotech Park<br>
Hinjewadi, Pune - 411057
</font>
</b>
</td>
<td align="left" rowspan="2" colspan="2"><img src="logo.PNG" height='90'></td>
</tr>
<tr>
<?php
$vewdet=mysql_query("select * from student_m where id='$id'");
while($viewsetss=mysql_fetch_array($vewdet))
{
	$grdes=mysql_fetch_row(mysql_query("select year_name from course_year where year_id='$viewsetss[course_yearsem]'"));
		$section=mysql_fetch_row(mysql_query("select section_name from class_section where id='$viewsetss[class_section_id]'"));	

$vewdet1=$viewsetss[dob];
$datsdet1=( date("d/M/Y", strtotime($vewdet1)) );
?>
<td align="left" style="font-size:16px" colspan="3" background="bluembis.PNG"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FFFFFF"><?=$viewsetss[first_name]?>&nbsp;<?=$viewsetss[last_name]?></font></b></td>
</tr>
<tr>
<td align="center" rowspan="6">&nbsp;&nbsp;&nbsp;</td>
<td align="center" rowspan="6" background="bluembis.PNG"><img src="<?php echo $viewsetss[img_source]?>"  height='100'></td>
<td align="left" width="150px" style="border-bottom-right-radius:25px" background="bluembis.PNG" class="ftsize" ><font color="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$viewsetss[student_id]?></font></td>
<td align="center" colspan="2"><b><font color="#0389C6" style="font-family:calibri">STUDENT</font></b></td>
</tr>
<tr>
<td align="left">&nbsp;</td>
<td align="center" colspan="2"><b><font color="#0389C6" style="font-family:calibri"><?=$grdes[0]?></font></b></td>
</tr>
<tr class="curved">
<td align="left"><b>&nbsp;<u>Emergency contact</u></b></td>
<td align="left">&nbsp;</td>
<td rowspan="4" class="ftsize"  background="buledark.PNG"><p class="vertical"><font color="#FFFFFF"><b><?=$accyeardet?>&nbsp;-&nbsp;<?=$accyeardet+1?></b></font></p></td>
</tr>
<tr class="curved">
<td align="left"><b>&nbsp;<?=$viewsetss[parent_name]?></b></td>
<td align="left"><b>:&nbsp;<?=$viewsetss[sms_mobile]?></b></td>
</tr>
<tr class="curved">
<td align="left"><b>&nbsp;<?=$viewsetss[m_name]?></b></td>
<td align="left"><b>:&nbsp;<?=$viewsetss[mnum]?></b></td>
</tr>
<tr class="curved">
<td align="left" width="50px"><b>&nbsp;Date of birth</b></td>
<td align="left" nowrap><b>:&nbsp;<?=$datsdet1?><b></td>
</tr>
<?
}
?>
</table>
</form>
</body>
</html>