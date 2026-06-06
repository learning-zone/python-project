<?php
require_once("../db.php");
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$branchName=$_POST['branchName'];
$semName=$_POST['semName'];
?>
<html>
<BODY>

<br>
<form method="POST" action="deposit_holder_report.php" onSubmit="return getName()" name="frm">
<table width="47%" class="forumline" align="center">
<tr>
<td Class="head" align="center" colspan='2'>View Deposit Holder Details</td>
</tr>
<?
	$rsBR = execute("SELECT course_id,coursename  FROM course_m");
	$countBR = rowcount($rsBR);
	if(!$countBR)
	{
		die("<div class='label'>Please enter Branch details.</div>");
	}
	
	$rsSM = execute("select * from course_year");
	$countSM = rowcount($rsSM);
	if(!$countSM)
	{
		die("<div class='label'>Please enter Semester details.</div>");
	}
?>
	<tr>
    <td>&nbsp;&nbsp;&nbsp;School Division</td>
	<td><select name="branch">
	<option value=0>-------Select-------</option>
	<?php
	for($i=0;$i<$countBR;$i++)
	{
		$rBR = fetcharray($rsBR,$i);
		echo("<option value='$rBR[0]'>$rBR[1]</option>\n");
	}
	?>
	</select>
	</td>
	</tr>
	
	<tr>
	<td>&nbsp;&nbsp;&nbsp;Class </td>
	<td><select name="sem">
	<option value=0>--Select--</option>
	<?php
	for($i=0;$i<$countSM;$i++)
	{
		$rSM = fetcharray($rsSM,$i);
		echo("<option value='$rSM[0]'>$rSM[1]</option>\n");
	}
	?>
    </select>
	</td>
	</tr>

	<tr>
	</tr>
</table>
<br>
<div align="center"><input type="submit" value="<<  Generate Report  >>" class="bgbutton"></div>
<input type="hidden" name="branchName">
<input type="hidden" name="semName">
</form>

<script language="JavaScript">
	function getName()
	{
        document.frm.branchName.value = document.frm.branch.options[document.frm.branch.selectedIndex].text;
		document.frm.semName.value = document.frm.sem.options[document.frm.sem.selectedIndex].text;
		return true;
	}
	function frm_reload()
	{
		document.frm.action='view_deposit_holder_det.php';
		document.frm.submit();
	}

</script>
</body>
</html>