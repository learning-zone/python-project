<html>
<head>
<?php
session_start();
include("../db.php");
include("../urlaccess.php");
if($user=='')
{
	header("Location:login.php");
}
else
{
	$p_th=$_SERVER['SCRIPT_NAME'];
	$qry=execute("select * from usermenu where username='$user' and access='Yes' and linkpath='$p_th'");
	if(rowcount($qry)==0)
	{
		header("Location:login.php");
	}
}
?>
</head>
<script>
function reload()
{
	document.form2.action='dip_rpt.php';
	document.form2.submit();
}
function htmlrpt()
{

	document.form2.action="dip_rpt1.php";
	document.form2.submit();
}
function execelrpt()
{
	if(document.form2.AdmName.value=='-1')
	{
	document.form2.action="dip_rpt2.php";
	document.form2.submit();
}
}
</script>
<body>
<form Name="form2"  method="Post">
<center><table class='forumline'  align=center>
<tr><td Class="head" align='center' colspan=2 ><font size=2><b>DIPLOMA APPROVAL LIST</b></td></tr>
<?php
$rs1 = execute("SELECT * FROM admission ");
$row1 = rowcount($rs1);
if($row1 == 0)
{
	echo("<div class='label'>Admission Type not defined.</div>");
}
?>
<tr><td align=right >Admission Type : </td>
<td><select name="AdmName">
<OPTION selected value=-1>Select Admission Type </option>
<?php
for($i=0;$i<$row1;$i++)
{
	$r1 = fetcharray($rs1,$i);
	if($AdmName==$r1[id])
	{
		?>
		<option value="<?=$r1["id"]?>" selected><?=$r1["name"]?></option>
		<?php
	}
	else
	{
		?>
		<option value="<?=$r1["id"]?>"><?=$r1["name"]?></option>
		<?php
	}
}
?>
</select></td></tr>
<tr><td align=right >Course : </td>
<td><SELECT name="course" onChange="reload()">
<OPTION selected value=-1>Select course</option>
<?php
$rs = execute("SELECT course_id,coursename FROM course_m where head_id=1 order by coursename");
$row = rowcount($rs);
if($row == 0)
{
	echo("<div class='label'>No Course Details.</div>");
}
for($i=0;$i<$row;$i++)
{
	$r = fetcharray($rs);
	if($course==$r[0])
	{
		?>
		<option  value="<?=$r[0]?>" selected><?=$r[1]?></OPtion>
		<?php
	}
	else
	{
		?>
		<option  value="<?=$r[0]?>"><?=$r[1]?></OPtion>
		<?php
	}
}
?>
</SELECT></td></tr>

<tr><td align='center'>Academic Year</td>
<td><select name='cyr'>
<option value=''>select</option>
<?php
$MyYear=date('Y')-1;
$CurrentYr=date("Y")+1;
for($i=$MyYear;$i<$CurrentYr;$i++)
{
	$Fyear=$i;
	$Tyear=$i+1;
	$Tyear=substr($Tyear,2);
	$sele="";
	$wlp=$Fyear."-".$Tyear;
	//echo $wlp;
	//if($i==date('Y'))
	$sele="selected";
	if($gr==$wlp)
	{
		?>
		<option value="<?=$wlp?>" <?=$sele?> ><?=$wlp?></option>
		<?php
	}
	else
	{
		?>
		<option value="<?=$wlp?>" ><?=$wlp?></option>
		<?
	}
}
?>
</select></td></tr>
</table><br>
<div align='center'>
<input class=bgbutton type="button" name="b1" value="HTML Report" onClick="htmlrpt()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class=bgbutton type="button" name="b2" value="EXCEL Report" onClick="execelrpt()"></div>
</form>
</body>
</html>