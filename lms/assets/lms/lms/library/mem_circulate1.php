<?php
require_once("../db.php");
//$member=$_POST['member'];
$member = $_POST['member'];
$B1 = $_POST['B1'];
$crs = $_POST['crs'];
?>
<HTML>
<HEAD></HEAD>
<script language="javascript">
function frm_reload()
{
	document.frm.action="mem_circulate1.php";
	document.frm.submit();
}
function frm_submit()
{
	if(document.frm.crs.value=='-1')
	{
		alert("Please Select Grade/Department");
		return false;
	}
	document.frm.action="mem_circulate2.php?media=1";
	document.frm.submit();
}
</script>
<BODY>
<form method="post" action="<?php echo $action?>" name="frm">
<input type='hidden' name='member' value='<?php echo $member?>'>
<input type='hidden' name='media' value='<?php echo $media?>'>
<table class='forumline' align='center' width="47%">
	<tr>
		<td colspan='3' class='head' align='center'>Member Circulation Parameters</td>
	</tr>
	<!--
	<tr>
		<td><input type="hidden" name="member" value="<?php echo $member?>"></td>		
	</tr>
	-->
	<?php
	if ($member == 1)
		{
			?>
			<tr>
				<td align="right">Division : </td>
				<td><select name="crs">
				<option value="0">---All Courses---</option>
				<?php
				$sql1 = "SELECT * FROM course_m where status=1 order by course_id";
				$rs = execute($sql1);
				$row=rowcount($rs);
				for($i=0;$i<$row;$i++)
				{
					$r = fetcharray($rs,$i);
					?>
					<option value="<?php echo $r["course_id"]?>" ><?php echo $r["coursename"]?></option>
					<?php
				}
				?>
				</select>
			<?php
		}
	if($member == 2)
		{
			?>
			<tr>
			<td align="right">Department : </td>
			<td><select name="crs" OnChange="frm_reload()">
			<option value="0">- All Departments-</option>
			<?php
			$sql3 = "SELECT * FROM dept_no where status=1";
			$rs = execute($sql3);
			$row=rowcount($rs);
			for($i=0;$i<$row;$i++)
			{
				$r1 = fetcharray($rs,$i);
				if($r1[dpt_id]==$crs)
				{
					?>
					<option value="<?php echo $r1[dpt_id]?>" selected><?php echo $r1["Dept"]?></option>
					<?php
				}
				else
				{
					?>
					<option value="<?php echo $r1[dpt_id]?>"><?php echo $r1["Dept"]?></option>
					<?php
				}
			}
			?>
			</select></td>
		</tr>
		<?php
		}
		if($member == 3)
		{
			?>
			<tr>
			<td align="right">Department : </td>
			<td><select name="crs" OnChange="frm_reload()">
			<option value="0">- All Departments -</option>
			<?php
			$sql3 = "SELECT * FROM dept_no where status=1";
			$rs = execute($sql3);
			$row=rowcount($rs);
			for($i=0;$i<$row;$i++)
			{
				$r1 = fetcharray($rs,$i);
				if($r1[dpt_id]==$crs)
				{
					?>
					<option value="<?php echo $r1[dpt_id]?>" selected><?php echo $r1["Dept"]?></option>
					<?php
				}
				else
				{
					?>
					<option value="<?php echo $r1[dpt_id]?>"><?php echo $r1["Dept"]?></option>
					<?php
				}
			}
			?>
			</select></td>
		</tr>
		<?php
		}
	?>
	<tr>

	</tr>
	<input type="hidden" name="member" value="<?php echo $member?>">
    <input type="hidden" name="media" value="<?php echo $media?>">
</table>
<br>
		<div align='center'><input type="button" value="Submit" name="B1" onClick="frm_submit()" class='bgbutton'></div>
</form>
</BODY>
</HTML>