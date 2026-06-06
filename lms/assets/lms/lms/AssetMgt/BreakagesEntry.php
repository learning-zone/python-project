<html>
<head>
<script language="JavaScript">
function RefreshMe()
{
	document.frm.action="BreakagesEntry.php";
	document.frm.submit();
}
</script>
</head>
<?php
session_start();
require("../db.php");
require("../urlaccess.php");
$dept = $_POST['dept'];
$assetgroup = $_POST['assetgroup'];
$PersonName = $_POST['PersonName'];

$sql=execute("select * from dept_no");
?>
<body>
<form name="frm" method="post" action="InsBreakagesEntry.php">
<table class=forumline align=center>
<tr><td Class="head" colspan=2 align='center'>Breakages Entry</td></tr>
<tr><td>Select Department</td><td><select name="dept" OnChange="RefreshMe()">
<option value="-1">Select Department</option>
<?php
for($i=0;$i<rowcount($sql);$i++)
{
	$r=fetcharray($sql,$i);
	if($r[dpt_id]==$dept)
	{
		echo "<option value=$r[dpt_id] selected>$r[Dept]</option>";
	}
	else
	{
		echo "<option value=$r[dpt_id]>$r[Dept]</option>";
	}
}
?>
</select></td></tr>
<?php
if($dept<>'')
{
	$sql1="select distinct a.* from asset_master a,individual_asset_details b ";
	$sql1.=" where a.id=b.asset_id and b.conditions='Working' and b.status='false' and ";
	$sql1.=" b.conditions<>'Service' and b.conditions<>'Deputation' and b.dept_id=$dept";
	$rs1=execute($sql1) or die(error_description());
	?>
	<tr><td>Select Asset Name</td><td><select name="assetgroup" OnChange="RefreshMe()"><option value=''>Select Asset Name</option>
	<?php
	for($i=0;$i<rowcount($rs1);$i++)
	{
		$r1=fetcharray($rs1,$i);
		if($r1[id]==$assetgroup)
		{
			echo "<option value=$r1[id] selected>$r1[asset_name]</option>";
		}
		else
		{
			echo "<option value=$r1[id]>$r1[asset_name]</option>";
		}
	}
	?>
	</select></td></tr>
	</table>
	<table class=forumline align=center>
	<?php
	if($assetgroup<>'')
	{
		?>
		<tr><td Class="rowpic">select</td><td Class="rowpic">Asset Code</td><td Class="rowpic">Location</td><td Class="rowpic">Reason</td></tr>
		<?php
		$qry1=execute("select a.*,d.location from individual_asset_details a,dept_no b,AssetStatusMaster c,location_master d where a.asset_id=$assetgroup and a.dept_id=$dept and a.dept_id=b.dpt_id and a.asset_status_id=c.id and c.conditions='Installed Working Satisfactorily' and a.conditions = 'Working' and a.status='false' and a.location_id=d.id and a.dept_id=d.dept_id") or die(error_description());
		for($i=0;$i<rowcount($qry1);$i++)
		{
			$r1=fetcharray($qry1,$i);
			echo "<tr><td><input type=checkbox name=id[] value='$r1[id]'></td>";
			echo "<td>$r1[item_code]</td><td>$r1[location]</td>";
			echo "<td><textarea name=reason$r1[id] cols=15 rows=3></textarea></tr>";
		}
		?>
		</table>
		<input type="hidden" name="PersonName" value="<?=$user?>">
		<div align=center>
		<input type="submit" value="Save Details" class=bgbutton>
		</div>
      <?}
}?>
</form>
</body>
</html>

