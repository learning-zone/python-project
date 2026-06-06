<?php
session_start();
require_once("../db.php");
if($_POST)
{
    $B1 = $_POST['B1'];
	$crs = $_POST['crs'];
    $crsyr = $_POST['crsyr'];
    $staff = $_POST['staff'];
    $member = $_POST['member'];	
}
?>
<HTML>
<HEAD>
</HEAD>
<script language="javascript">
function frm_reload()
{
	document.frm.action="selectMember.php";
	document.frm.submit();
}
function frm_submit()
{
	document.frm.action="searchMember.php";
	document.frm.submit();
}
</script>
<BODY>
<form method="post" name="frm">
<?php
if ($member == '3')
	header("Location:searchMember.php?member=$member");
?>
<table class='forumline' align='center' width="47%">
	<tr><br/>
		<td colspan='3' class='head' align='center'>Add Member</td>
	</tr>
	<tr>
		<td><input type="hidden" name="member" value="<?=$member?>"></td>
	
<?php
if ($member == 1)
{
		?>
		
			<td>&nbsp;&nbsp;School Division</td>
			<td><select name="crs" onchange='frm_reload()'>
			<option value="-1">---  Select  ---</option>
			<?php
			$sql1 = "SELECT * FROM course_m";
			$rs = execute($sql1);
			$row=rowcount($rs);
			for($i=0;$i<$row;$i++)
				{
					$r = fetcharray($rs);
					if($crs==$r[course_id])
					{
						echo "<option value='$r[course_id]' selected>$r[coursename]</option>";
						$head_id = $r[head_id];
					}
					else
					{
						echo "<option value='$r[course_id]' >$r[coursename]</option>";
					}
				}
			?>
			</select></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;&nbsp;&nbsp;Class</td>
			<td><select name="crsyr">
			<option value="-1">---  Select  ---</option>
			<?php
			$sql2 = "SELECT * FROM course_year where status=1 and head_id='$head_id'";
			$rs1 = execute($sql2);
			$row=rowcount($rs1);
			for($i=0;$i<$row;$i++)
				{
					$r1 = fetcharray($rs1);
					?>
					<option value="<?=$r1[year_id]?>" ><?=$r1[year_name]?></option>
					<?php
				}
			?>
			</select></td>
		</tr>
		<?php
	}
else if($member == 2 )
	{
		?>
		
			<td align="center">&nbsp;&nbsp;&nbsp;Department</td>
			<td align="center"><select name="staff">
			<option value="-1">- Select a Department-</option>
			<?php
			$sql3 = "SELECT * FROM dept_no where status=1";
			//echo "SQL3=$sql3<br>";
			$rs = execute($sql3);
			$row=rowcount($rs);
			for($i=0;$i<$row;$i++)
				{
					$r = fetcharray($rs,$i);
				
					?>
					<option value="<?=$r["dpt_id"]?>" ><?=$r["Dept"]?></option>
					<?php
				}
			?>
			</select></td>
		
	<?php
	}
?>
  <tr>
      
  </tr>
	<input type="hidden" name="member" value="<?=$member?>" >
</table>
<br>
	<div align='center' colspan='2'><input type="button" value="Submit" name="B1" onClick="frm_submit()" class='bgbutton'></div>
</form>
</BODY>
</HTML>