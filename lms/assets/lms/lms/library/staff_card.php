<?php
	session_start();
	include("../db.php");
?>
<html>
<body>
<?php
	$rs = execute("SELECT * FROM staff_det");
	$num = rowcount($rs);
	if($num > 0)
	{
	?>
	<form method='post' action="staff_card1.php" name="frm1" >
	<table class='forumline' align='center'>
		<tr>
			<td Class="Head" colspan='7' align='center'>Search Staff Detials</td>
		</tr>
		<tr>
			<td>Staff Id:</td>
			<td><input type='text' name='app_no' value=""></td>
			<td>Staff First Name:</td>
			<td><input type='text' name='studfname' value=""></td>
		</tr>
		<tr>
			<td align='center' colspan='4'>Department:<select name="branch" >
				<option value="0">---------------Select---------------</option>
					<?php
						$sql="select dpt_id,Dept from dept_no";
						$rs=execute($sql) or die(error_description());
						for($i=0;$i<rowcount($rs);$i++)
						{
						  $r=fetcharray($rs);

							if($branch==$r[dpt_id])
							{
								?>
								<option value="<?=$r[dpt_id]?>" selected><?php echo $r[Dept] ?></option>
								<?php
							}
							else
							{
								?>
								<option value="<?php echo $r[dpt_id] ?>"><?=$r[Dept]?></option>
								<?php
							}
						}
					?>
				</select>
			</td>
		</tr>
	</table>
	<div align=center><td><input type="submit" class='bgbutton' value="Submit" name="studdet"></td></div>
	<table align=center border=0>
		<tr>
			<td><u> Note:</u> </td>
			<td>Enter or select any one from above or all</td>
		</tr>
	</form>
	<?php
		}
	else
		{
		?>
		<td>No staffid Record</td>
		<?php
		}
	?>
</body>
</html>