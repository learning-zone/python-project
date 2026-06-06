<html>
<head>
<script language="JavaScript">
function RefreshMe()
{
	document.frm.action="ServiceAssets.php";
	document.frm.submit();
}
</script>
</head>
<?php
	session_start();
	require("../db.php");
	$dept = $_POST['dept'];
$PersonName = $_POST['PersonName'];
$comments = $_POST['comments'];
$assetgroup = $_POST['assetgroup'];
$sh = $_POST['sh'];
$sbt = $_POST['sbt'];
$chk = $_POST['chk'];
	$sql=execute("select * from dept_no");
?>
<body>
<form name="frm" method="post" action="InsServiceAssets.php">
<table class=forumline align=center>
<tr><td Class="head" colspan=4>Send Assets For Servicing to Central Stores</td></tr>
<tr><td>Department</td><td colspan='3'><select name="dept" OnChange="RefreshMe()">
<option value='0'>Select Department</option>
<?php
for($i=0;$i<rowcount($sql);$i++)
{
	$r=fetcharray($sql);

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
if($dept!='0')
{
	$sql1=execute("select distinct a.* from asset_master a,individual_asset_details b where a.id=b.asset_id and b.conditions='Breakage' and b.status='false' and b.conditions<>'Service' and b.dept_id='$dept'");
	if(rowcount($sql1)>0 && $dept!='0')
	{
?>
	<tr><td>Asset Name</td><td colspan='3'><select name="assetgroup" OnChange="RefreshMe()">
	<option value="-1">Select Asset Name</option>
	<?php
	for($j=0;$j<rowcount($sql1);$j++)
	{
		$r1=fetcharray($sql1);
		if($r1[id]==$assetgroup)
		{
			echo "<option value='$r1[id]' selected>$r1[asset_name]</option>";
		}
		else
		{
			echo "<option value='$r1[id]'>$r1[asset_name]</option>";
		}
	}
	?>
	</select></td></tr>
	<?php
}
	else
	{?><tr><td colspan='4'><b><font color='red' size='4'>No Breakage entry found</font></b></td></tr>
	<?php
	}
}

if($assetgroup<>'')
{
	?>
	
	<?php
	$qry1=execute("select a.*,d.location from individual_asset_details a,dept_no b,assetstatusmaster c,location_master d where a.asset_id=$assetgroup and a.dept_id=$dept and a.dept_id=b.dpt_id  and  a.conditions = 'Breakage' and  a.location_id=d.id and a.dept_id=d.dept_id") or die(error_description());
	if(rowcount($qry1)>0)
	{
	?>
	<tr><td Class="rowpic">select</td><td Class="rowpic">Asset Code</td><td Class="rowpic">Location</td><td Class="rowpic">Vendor</td></tr>
	<?php
	}
for($i=0;$i<rowcount($qry1);$i++)
	{
		$r1=fetcharray($qry1,$i);
		$ftu=fetcharray(execute("select name from vendormaster_assets where id='$r1[vendor]'"));
		echo "<tr><td><input type=checkbox name=chk[] value='$assetgroup-$r1[id]'></td>";
		echo "<td>$r1[item_code]</td><td>$r1[location]</td><td>$ftu[0]</td></tr>";
	}?>
	<tr><td colspan='2'>Comments</td><td colspan='2'><textarea name="comments<?=$assetgroup?>" cols="20" rows="5" wrap></textarea></td></tr>
</table>
<br>
<input type="hidden" name="PersonName" value="<?=$user?>">
<div align=center>
<input type="submit" value="Save Details" class=bgbutton>
</div>
	<?php
}
?>


</form>
</body>
</html>

