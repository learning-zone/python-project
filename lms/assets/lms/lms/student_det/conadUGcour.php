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
	document.frm.action="excelviewcatwisefy.php";
	document.frm.submit();
}
function htmlrpt()
{
	if(document.frm.gr.value=='')
	{
		alert("Please Select Academic Year");
		return false;
	}
	document.frm.action="htmlviewcatwisefy.php";
	document.frm.submit();
}
</script>
</HEAD>
<TITLE>Consolidated Admission to UG Courses</TITLE>

<BODY leftmargin=0 topmargin=0>
<form name='frm' method='post'>
<table align='center' class='forumline'>
<tr><td class='head' colspan='2'>COURSE WISE ADMISSION REPORT : UG Courses (FIRST YEAR)</td></tr>
<tr><td align='center'>Academic Year</td>
<td><select name="gr" onchange="go()">
		<option value="0"> select academic year</option>
		<?php
			   $MyYear=date('Y')-5;
			   $CurrentYr=date("Y")+5;
			   for($i=$MyYear;$i<$CurrentYr;$i++)
			   {
					$Fyear=$i;
					$Tyear=$i+1;
					$Tyear=substr($Tyear,2);
					$sele="";
					if($gr==0)
					 {
						if($i==date('Y'))
						 {
							$sele="selected";
						 }
					 }
					 else 
					 {
						 if($i==$gr)
						$sele="selected";
					 }	 
					 ?>
				  		<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>-<?=$Tyear?></option>
					<?php
				}
	   ?>
             </select></td></tr>
</table><br><br>
<div align="center"><input class=bgbutton type="button" value=" HTML Report " onclick='htmlrpt()'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input class=bgbutton type="button" value=" EXCEL Report " onclick='excelrpt()'></div>
</form>
</html>
