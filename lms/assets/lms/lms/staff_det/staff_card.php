<html>
<head>
<?php
	session_start();
	include("../db.php");
$app_no = $_POST['app_no'];
$studfname = $_POST['studfname'];
$branch = $_POST['branch'];
$stid = $_POST['stid'];
$studdet = $_POST['studdet'];
?>
<script language='javascript'>
function reload_frm()
{
	document.frm1.action='staff_card.php';
	document.frm1.submit();
}
</script>
</head>
<body>

<form method='post' action="staff_card1.php" name="frm1" >
<table class='forumline' align='center' width='50%'>
	<tr>
		<td Class="Head" colspan='4' align='center'>Search Staff Detials</td>
	</tr>
	<tr height='30'><td colspan='4' align='center'><u> Note : </u>Enter or select any one search criteria </td></tr>
	<tr height='30'>
		<td>Staff Id : </td>
		<td><input type='text' name='app_no' value="<?=$app_no?>" onchange='reload_frm()'></td>
		<td>Staff First Name : </td>
		<td><input type='text' name='studfname' value="<?=$studfname?>" onchange='reload_frm()'></td>
	</tr>
	<tr height='30'>
		<td align='center' colspan='4'>Department : <select name="branch" onchange='reload_frm()'>
			<option value=''>---------------Select---------------</option>
				<?php
					$sql="select dpt_id,Dept from dept_no";
					$rs=execute($sql) or die(error_description());
					for($i=0;$i<rowcount($rs);$i++)
					{
					  $r=mysql_fetch_array($rs);

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
</table><br>
<?php
if($app_no !='' || $studfname !='' || $branch !='')
{
	$sql="select id,slno,f_name,s_name from staff_det where active='YES'";
	if($app_no !='')
		$sql.=" and slno='$app_no'";
	if($studfname!='')
		$sql.=" and f_name like '$studname%'";
	if($branch!='')
		$sql.=" and subj='$branch'";
	$sql.=" order by f_name";
	$rs=execute($sql);
	if(rowcount($rs)>0)
	{
		?>
		<table class='forumline' align='center' border='1' cellpadding='0' cellspacing='0' width='50%'>
		<tr><td colspan='3' align='center'>Staff List</td></tr>
		<tr><td align='center' width='10%'>Select</td><td align='center' nowrap>Staff ID</td><td align='center' nowrap>Staff Name</td></tr>
		<?php
		while($r=fetcharray($rs))
		{
			echo "<tr height='30'><td align='center'><input type='checkbox' name='stid[]' value='$r[id]'></td>";
			echo "<td nowrap>&nbsp;&nbsp;$r[slno]</td>";
			echo "<td nowrap>&nbsp;&nbsp;$r[f_name]&nbsp;$r[s_name]</td></tr>";
		}
		?>
		<tr height='40'><td colspan='3' align='center'><input type="submit" class='bgbutton' value="Submit" name="studdet"></td></tr></table>
		<?php
	}
	else
	{
		echo "<div><font color='brown'><b>No Staff..</b></font></div>";
	}
}
?>
</form>
</body>
</html>