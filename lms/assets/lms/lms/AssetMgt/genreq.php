<?php
session_start();
require("../db.php");

?>
<html>
<head>
<script>
function refresh()
{
	document.frm.action='genreq.php';
	document.frm.submit();
}
function validate()
{
		var x=confirm("Click OK to Generate Indent");
		if(!document.getElementById('chk1').checked)
		{
			alert("Please Select the indent before modify");
			return false;
		}
		else if(x==true)
		{
			document.frm.action='Insrequirement.php';
			document.frm.submit();
		}
}
</script>
<title>Generate Requirement Indent</title>
</head>
<body><form name='frm' method='post'>
<?
$usr=execute("select id from users where username='$user'");
$u=fetcharray($usr);
$dqry=execute("select distinct(dept) from tempreqindent where user='$u[0]'");

?>

<table class='forumline' align='center'>
<tr><td class='head' colspan='4'>Generate Requirement Indent</td></tr>
<tr><td colspan='4' align='center'>Department :<select name='dept_s' onChange='refresh()'><option value='-1'>Select Department</option><?while($d=fetcharray($dqry))
{
	$dn=execute("select * from dept_no where dpt_id=$d[dept]");
	while($dd=fetcharray($dn))
	{
		if($dept_s==$dd[dpt_id])
		{
		echo "<option value=".$d[dept]." selected>$dd[Dept]</option>";
		}
		else
		{
			echo "<option value=".$d[dept].">$dd[Dept]</option>";
		}
	}
}?></select></td></tr>


	<?
	if($dept_s>0)
	{	
		$uqry=execute("select id from users where username='$user'");
	$x=fetcharray($uqry);
	$g=execute("select * from tempreqindent where dept='$dept_s' and user='$x[0]'");
	$sql=execute("select * from dept_no where dpt_id='$dept_s'");
	$y=fetcharray($sql);?>
	<tr><td class='head' align='center' colspan='4'>Requirement Indent For <?=$y[Dept]?></td></tr> 
	<tr><td align="center"><b><font color="#993333">Sl.No</font></b></td><td align="center"><b><font color="#993333">Asset Group</font></b></td><td align="center"><font color="#993333"><b>Asset Name</b></font></td><td align="center"><font color="#993333"><b>Quantity</b></font></td></tr>
	<?
		$x=0;
		while($i=fetcharray($g))
		{
			$an=execute("select * from asset_master where  id=$i[aname]");
			$s=fetcharray($an,$x);
			$z=execute("select * from asset_sub_group where id='$i[agroup]'");
			$r=fetcharray($z,$x);
	?>
			<tr>
			<td><input type='hidden' name='dep' value='<?=$dept_s?>'>
			<input type='hidden' name='dept' value='<?=$y[Dept]?>'><input type='hidden' name='college' value='indus'><input type='checkbox' name='aid[]' value='5' id='chk1' checked></td>
			<td><input type='hidden' name='agroup1[]' value='<?=$i[agroup]?>' readonly><input type='text' name='agroup[]' value='<?=$r[asset_subgroup_name]?>' readonly></td>
			<td><input type='hidden' name='aname1[]' value='<?=$i[aname]?>' ><input type='text' name='aname[]' value='<?=$s[asset_name]?>' readonly></td>
			<td><input type='text' name='qty[]' value='<?=$i[qty]?>' readonly></td>
			</tr>
	<?
			$x++;
		}
	}
	?>
<tr><td colspan='4' align='center'><input type='button' name='save' value='Save Details' class='bgbutton' onclick='validate()'></td></tr>
</table>
</form>
</body>
</html>
