<HTML>
<HEAD>
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
	if(document.frm.gr.value=='')
	{
		alert("Please Select Academic Year");
		return false;
	}
	document.frm.action="excelviewcatwise.php";
	document.frm.submit();
}
function htmlrpt()
{
	if(document.frm.gr.value=='')
	{
		alert("Please Select Academic Year");
		return false;
	}
	document.frm.action="htmlviewcatwise.php";
	document.frm.submit();
}
</script>
</HEAD>
<TITLE>Consolidated Admission to UG Courses</TITLE>

<BODY leftmargin=0 topmargin=0>
<form name='frm' method='post'>
<table align='center' class='forumline'>
<tr><td class='head' colspan='2'>COURSE WISE ADMISSION REPORT : UG Courses</td></tr>
<tr><td align='center'>Academic Year</td>
<td><select name='gr'>
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
</table><br><br>
<div align="center"><input class=bgbutton type="button" value=" HTML Report " onclick='htmlrpt()'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input class=bgbutton type="button" value=" EXCEL Report " onclick='excelrpt()'></div>
</form>
</html>
