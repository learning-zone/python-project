<?php
session_start();
include("../db.php");

?>
<HTML>
<HEAD>
</HEAD>
	<SCRIPT LANGUAGE="JavaScript">
		function gencast()
		{
			document.frm.action="DetailSex.php";
			document.frm.submit();
		}
		function go()
		{
			document.frm.action="sexwise.php";
		document.frm.submit();
		}
	</SCRIPT>
<BODY leftmargin=0 topmargin=0>
<form method="POST" action="BriefSex.php" onSubmit="return getName()" name="frm">
<br>
<table class='forumline' width="400" align=center>
	<tr>
		<td colspan=2 Class="head" align='center'><font size=2><b>SEX WISE LIST</b></td>
	</tr>
	<?php
	$rsBR = execute("SELECT course_id,coursename  FROM  course_m ");
	$countBR = rowcount($rsBR);	
	if(!$countBR)
		{
			die("<div class='label'>Please enter Branch details.</div>");
		}
	$rsSM = execute("select * from course_year where head_id='$branch' and  status=1 ");
	$countSM = rowcount($rsSM);
	
	?>
	<tr>
		<td>&nbsp;&nbsp;School Division</td>
		<td><select name="branch" onChange="go()">
		<option value=0>---All---</option>
		<?php
			for($i=0;$i<$countBR;$i++)
			{
				$rBR = fetcharray($rsBR,$i);
				if($branch==$rBR[0])
				echo("<option value='$rBR[0]' selected>$rBR[1]</option>\n");
				else
				echo("<option value='$rBR[0]' >$rBR[1]</option>\n");
			}
		?>
		</select></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;Class</td>
		<td><select name="sem">
		<option value=0>--Select--</option>
		<?php
			for($i=0;$i<$countSM;$i++)
			{
				$rSM = fetcharray($rsSM,$i);
				echo("<option value='$rSM[0]'>$rSM[1]</option>\n");
			}
		?>
		</select></td>
	</tr>
	<?php
	$sql2="select * from category";
	$rs=execute($sql2);
	$countSM=rowcount($rs);
	?>
	
</table>
<BR>
<div align=center>
	<input class='bgbutton' type="submit" value="submit"></div>
	<input type="hidden" name="branchName">
	<input type="hidden" name="semName">
</form>
<script language="JavaScript">
function getName()
{
	document.frm.branchName.value = document.frm.branch.options[document.frm.branch.selectedIndex].text;		document.frm.semName.value = document.frm.sem.options[document.frm.sem.selectedIndex].text;
	return true;
}
</script>
</body>
</html>