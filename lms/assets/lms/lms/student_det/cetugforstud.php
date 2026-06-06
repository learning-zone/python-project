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
<script language="javascript">
function excelrpt()
{
	if(document.frm.courseyr.value=='-1')
	{
		alert("Please Select Course Year");
		return false;
	}
	if(document.frm.gr.value=='')
	{
		alert("Please Select Academic Year");
		return false;
	}
	document.frm.action="excelcetugcategorygrp.php";
	document.frm.submit();
}
function htmlrpt()
{
	if(document.frm.courseyr.value=='-1')
	{
		alert("Please Select Course Year");
		return false;
	}
	if(document.frm.gr.value=='')
	{
		alert("Please Select Academic Year");
		return false;
	}
	document.frm.action="htmlcetugcategorygrp.php";
	document.frm.submit();
}
</script>
</head>
<body>
<form Name="frm"  method="Post" action="cetugcategorygrp.php">
<table class='forumline'  align=center>
<tr><td colspan=2 align='center' class='head'>Statement of Allot. and adm. Group wise For UG</td></tr>
<tr><td >SEMESTER : <font color=Red>*</font></td>
<td><SELECT name="courseyr"><OPTION selected value='-1'>Select Semester</option>
<?php
$rs2 = execute("SELECT a.* FROM course_year a,coursehead b where a.head_id=b.id and b.cname in ('UG','Ug','ug')");
$row2 = rowcount($rs2);
if($row2 == 0)
{
	echo("<div class='label'>No Course Year Details Found...!!</div>");
}
for($i=0;$i<$row2;$i++)
{
	$r2 = fetcharray($rs2,$i);
	if($courseyr==$r2[0])
	{
		?>
		<option  value="<?=$r2[0]?>" selected><?=$r2[1]?></OPtion>
		<?php
	}
	else
	{
		?>
		<option  value="<?=$r2[0]?>"><?=$r2[1]?></OPtion>
		<?php
	}
}
?>
</SELECT></td></tr><br>
<td >Academic Year : <font color=Red>*</font></td>
<td><select name='gr' ><option value=''>>>select<<</option>
<?php
$MyYear=date('Y')-5;
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
</table>
<br><br>
<div align="center"><input class=bgbutton type="button" value=" HTML Report " onclick='htmlrpt()'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input class=bgbutton type="button" value=" EXCEL Report " onclick='excelrpt()'></div>
</form>
</body>
</html>