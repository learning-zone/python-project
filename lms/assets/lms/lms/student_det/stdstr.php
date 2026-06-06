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
<HTML>
<HEAD>
<TITLE>Student Strength UG Courses</TITLE>
<script language="javascript">
function excelrpt()
{
	if(document.frm.gr.value=='')
	{
		alert("Please Select Academicyear");
		return false;
	}
	document.frm.action="excelsdsrt.php";
	document.frm.submit();
}
function htmlrpt()
{
	if(document.frm.gr.value=='')
	{
		alert("Please Select Academicyear");
		return false;
	}
	document.frm.action="htmlsdsrt.php";
	document.frm.submit();
}
</script>
</HEAD>
<BODY leftmargin=0 topmargin=0>
<form name='frm' method='post'>
<table align='center' class='forumline'>
<tr>
 <td class='head' colspan='2' align='center'>Student Strength </td>
</tr>
<tr><td align="right"><b>Course Head :</td>
<td><select name="ctype" onchange='reload()'>
          <option value='' selected>Select Course Head</option>
          <?php
$cor_hea = execute("SELECT * FROM coursehead  ");
$cor_num = rowcount($cor_hea);
for($i=0;$i<$cor_num;$i++)
{
	$cor_rs = fetcharray($cor_hea,$i);
	if($cor_rs[0]==$ctype)
	{
		echo("<option value='$cor_rs[0]' selected>$cor_rs[1]</option>\n");
	}
	else
	{
		echo("<option value='$cor_rs[0]'>$cor_rs[1]</option>\n");
	}
}
?>
        </select></td></tr>



<tr><td>Acdemic year : </td>
<td><select name='gr'>
<option value=''>select </option>
		<?php
			   $MyYear=date('Y')-5;
			   $CurrentYr=date("Y")+5;
			   for($i=$MyYear;$i<$CurrentYr;$i++)
				 {
					$Fyear=$i;
					$Tyear=$i+1;
					$Tyear=substr($Tyear,2);
					$sele="";
					if($a_year==0)
					 {
						if($i==date('Y'))
						 {
							$sele="selected";
						 }
					 }
					 else 
					 {
						 if($i==$a_year)
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