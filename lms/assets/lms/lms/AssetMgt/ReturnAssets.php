<html>
<head>
<script language="JavaScript">
function RefreshMe()
{
	document.frm.action="ReturnAssets.php";
	document.frm.submit();
}
</script>
</head>
<?php
session_start();
require("../db.php");
require("../urlaccess.php");

$dept = $_POST['dept'];
$PersonName = $_POST['PersonName'];
$vendor_id = $_POST['vendor_id'];

$sql=execute("select * from dept_no where Dept!='CENTRAL STORES' ");//---modified by anuraj---
?>
<body>
<form name="frm" method="post" action="InsReturnAssets.php">
<table class=forumline align=center>
<tr><td Class="head" colspan=2>Return Assets to Central Stores</td></tr>
<tr><td class=rowpic>Select Department</td><td><select name="dept" OnChange="RefreshMe()">
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
</select></td></tr></table>
<table class=forumline align=center>
<?php
if($dept<>'')
{
	?>
	<tr><td Class="rowpic">select</td><td Class="rowpic">Asset Name</td><td Class="rowpic">Quantity</td><td Class="rowpic">Location</td><td Class="rowpic">Reason for Return</td></tr>
	<?php
	$qry=execute("select * from asset_master");
	for($j=0;$j<rowcount($qry);$j++)
	{
		$q=fetcharray($qry,$j);
		$qry2=execute("select * from location_master where dept_id=$dept");
		for($k=0;$k<rowcount($qry2);$k++)
		{
			$kr=fetcharray($qry2,$k);
			//echo ("select * from individual_asset_details a,dept_no b,assetstatusmaster c where a.asset_id=$q[id] and a.dept_id=$dept and a.asset_status_id=c.id and c.conditions<>'Installed Working Satisfactorily' and a.location_id=$kr[id] and a.dept_id=b.dpt_id and a.conditions<>'Return' and a.conditions<>'Repair' and a.conditions<>'Deputation'");
			$sql3=execute("select * from individual_asset_details a,dept_no b,assetstatusmaster c where a.asset_id=$q[id] and a.dept_id=$dept and a.asset_status_id=c.id and c.conditions<>'Installed Working Satisfactorily' and a.location_id=$kr[id] and a.dept_id=b.dpt_id and a.conditions<>'Return' and a.conditions<>'Repair' and a.conditions<>'Deputation'") or die(error_description());
			if(rowcount($sql3)<>0)
			{
				$qty=rowcount($sql3);
				echo "<tr><td><input type=checkbox name=id[] value='$q[id]_$kr[id]'></td>";
				echo "<td>$q[asset_name]</td><td><input type=text name='qty$q[id]_$kr[id]' value=$qty size=5 ></td><td>$kr[location]</td>";
				echo "<td><textarea name='reason$q[id]_$kr[id]' cols=20 rows=3 wrap></textarea></td></tr>";
			}
		}
	}
	?>
	</table>
	<?php
}
?>
<input type="hidden" name="vendor_id" value="<?=$VendorId?>">
<input type="hidden" name="PersonName" value="<?=$user?>">
<div align=center>
<input type="submit" value="Save Details" class=bgbutton>
</div>
</form>
</body>
</html>

