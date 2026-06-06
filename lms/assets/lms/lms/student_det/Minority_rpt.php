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
	document.frm.action="excelminority.php";
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
	document.frm.action="htmlminority.php";
	document.frm.submit();
}
</script>
</head>
<body>
<form Name="frm"  method="Post">
<table class='forumline'  align=center>
<tr><td colspan=2 align='center' class='head'>MINORITY REPORT : UG COURSES</td></tr>
<tr><td >YEAR : <font color=Red>*</font></td>
<td><SELECT name="courseyr"><OPTION value='-1'>Select Year</option>
<OPTION value=1>I Year</option>
<OPTION value=2>II Year</option>
<OPTION value=3>III Year</option>
<OPTION value=4>IV Year</option>
<OPTION value=5>V Year</option>
</SELECT></td></tr>
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