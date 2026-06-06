<?php
session_start();
require("../db.php");
?>
<HTML>
<HEAD>
<script language="javascript">
function send()
{
	document.frm.action="viewstudent_det1.php";
	document.frm.submit();
}
function getbranch()
{
	document.frm.action="search_student_det.php";
	document.frm.submit();
}

</script>
<TITLE>Register of Fee Receipts</TITLE>
</HEAD>
<BODY leftmargin=0 topmargin=0>
<form method="POST" name="frm">
<table class='forumline' align='center'>
	<tr>
		<td Class="head" align='center' colspan='2'><font size=2><b>Student Details</b></td>
	</tr>
	<?php
		$rsBR = execute("SELECT course_id,coursename,head_id FROM course_m where status=1");
		$countBR = rowcount($rsBR);
	?>
	<tr>
		<td>School Division</td>
		<td><select name="branch" onchange="getbranch()">
		<option value='0'>Select Branch</option>
		<?php			
			for($i=0;$i<$countBR;$i++)
				{
					$rBR = fetcharray($rsBR);
					if($branch==$rBR["course_id"])
						{
							echo("<option value='$rBR[0]'selected>$rBR[1]</option>\n");
							$head_id=$rBR[head_id];
						}		
					else
						{
							echo("<option value='$rBR[0]'>$rBR[1]</option>\n");
						}
				}		
		?>
		</select></td>
	</tr>
	<?php
	if($branch=='0' || $branch=='')
	{
		$rsSM = execute("select * from course_year where status=1 and head_id=1");
	}
	else
	{
		$rsSM = execute("select * from course_year where status=1 and head_id=$head_id");
	}
	$countSM = rowcount($rsSM);	
	?>		
	<tr>
		<td>Class</td>
		<td><select name="sem" onchange="getbranch()">	
		<option value=0>Select Sem</option>
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
			}
		?>
		</select></td>
	</tr>
	<?php
	$rsSecM = execute("select * from class_section order by id");
	$countSecM = rowcount($rsSecM);	
	if($section=='0')
		$sel="selected";
	
	?>
	<tr>
		<td>Section</td>
		<td><select name="section" onchange='getbranch()'>
		<option value='-1'>Select Section</option>
		<?php
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
		</select></td>
	</tr>
	
	<tr>
		<td align="center" colspan = 2 ><input type="button" class='bgbutton' value="Report By Name" OnClick="send()";></td>
	</tr>
</table>
<input type="hidden" name="branchName">
<input type="hidden" name="semName">
</form>
</body>
</html>