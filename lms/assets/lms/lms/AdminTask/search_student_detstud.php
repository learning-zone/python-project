
<HTML>
<head>
<script language="javascript">
function send()
{
	document.frm.action="viewstudent_detstud1.php";
	document.frm.submit();
}
function getbranch()
{
	document.frm.action="search_student_detstud.php";
	document.frm.submit();
}
function go()
{
	document.frm.action="search_student_detstud.php";
	document.frm.submit();
}
</script>
<TITLE>Register of Fee Receipts</TITLE>
<?php

?>
</HEAD>
<BODY leftmargin=0 topmargin=0>
<?php
session_start();
include("../db.php");
include("urlaccess.php");
$branch = $_POST['branch'];
$sem = $_POST['sem'];
$section = $_POST['section'];
?>
<form method="POST" action="viewstudent_detstud1.php"  name="frm">
<table class='forumline' align=center>
<tr><td Class="head" align='center' colspan=3>Student Details</td></tr>
<tr><td Class="rowpic" align='center' colspan=3>View Student Details Report</td></tr>
<?
	$rsBR = execute("SELECT course_id,coursename FROM course_m");// where head_id='$cname'");
	$countBR = rowcount($rsBR);
	?>
    <tr>
    <td >Program </td><td></td><td><select name="branch" onChange="getbranch()">
	<option value=0>-------------------- Select --------------------</option>
	<?php
	for($i=0;$i<$countBR;$i++)
	{
		$rBR = fetcharray($rsBR,$i);
		if($branch==$rBR["course_id"])
		{
			echo("<option value='$rBR[0]'selected>$rBR[1]</option>\n");
		}		
		else
		{
			echo("<option value='$rBR[0]'>$rBR[1]</option>\n");
		}
	}
	echo "</select>";
	if(!$countBR)
	{
		die("<div class='label'>Please enter Branch details.</div>");
	}
	//Get semesters.
	$qq=execute("select * from course_m where course_id=$branch");
	$ff=fetcharray($qq);
	$rsSM = execute("select * from course_year where status=1 and head_id='$ff[head_id]'");
	$countSM = rowcount($rsSM);
	?>
    </td>
        </tr>
        <tr>
                    <td colspan="2">Terms</td><td><select name="sem" onchange="getbranch()">
            <option value=0>----- Select-----</option>
	<?php
		for($i=0;$i<$countSM;$i++)
		{
			$rSM = fetcharray($rsSM,$i);
			if($sem==$rSM["year_id"])
		{
			echo("<option value='$rSM[0]'selected>$rSM[1]</option>\n");
		}		
		else
		{
			echo("<option value='$rSM[0]'>$rSM[1]</option>\n");
		}
			//echo("<option value='$rSM[0]'>$rSM[1]</option>\n");
		}
	//}
	?>
	</select></td></tr>
	<!--Section-->
	<tr><td colspan="2">Section</td><td><select name="section" onChange="getbranch()">
	<?php
	$rsSecM = execute("select * from class_section");
	$countSecM = rowcount($rsSecM);
	for($i=0;$i<$countSecM;$i++)
	{
		$rSecM = fetcharray($rsSecM,$i);
		if($section==$rSecM[0])
		{
		echo("<option value='$rSecM[0]' selected>$rSecM[1]</option>\n");
	}
	else
		{
		echo("<option value='$rSecM[0]'>$rSecM[1]</option>\n");
		}
}
?>
</select></td></tr>
<!--Submit-->

<!--CORRECTION MADE BY : SIRI DATE: 23/03/04 ADSTOCK-->
<!--<td align=center><input type="submit" class='bgbutton' value="Generate Report By USN"></td>-->

</table>
<br>
<div align="center" ><input type="button" class='bgbutton' value="Generate Report" OnClick="send()";></div>
<input type="hidden" name="branchName">
<input type="hidden" name="semName">
</form>
</body>
</html>

