<html>
<head>
<script language="JavaScript">
	function RefreshMe()
	{
		document.frm.action="ReturnAssetsToVendors.php";
		document.frm.submit();
	}
</script>
</head>
<?php
session_start();

require("../db.php");
require("../urlaccess.php");
$vendor = $_POST['vendor'];
$vendor_id = $_POST['vendor_id'];
$issuing_person = $_POST['issuing_person'];

$sql=execute("select * from vendormaster_assets");

?>
<body>
<form name="frm" method="post" action="InsReturnAssetsToVendors.php">
<table class=forumline align=center>
<tr><td Class="head" colspan=2>Return Assets to Vendors</td></tr>
<tr><td class=rowpic>Select Vendor</td><td><select name="vendor" onChange="RefreshMe()">
<option value='0'>Select Vendor</option>
<?php
	for($i=0;$i<rowcount($sql);$i++)
	{
		$r=fetcharray($sql,$i);

		if($r[id]==$vendor)
		{
			echo "<option value=$r[id] selected>$r[name]</option>";
		}
		else
		{
			echo "<option value=$r[id]>$r[name]</option>";
		}
	}
?>
</select>
</td></tr>
</table>
<?php
if($vendor!=0)
{
?>
<table class=forumline align=center>
<tr><td Class="rowpic">Select</td><td Class="rowpic">Asset Name</td>
<td Class="rowpic">Quantity</td><td Class="rowpic">Reason for Return</td>
<td Class="rowpic">Location</td>
</tr>
<?php

	$sql2="select distinct a.asset_id,d.asset_name,a.location_id from individual_asset_details a,";
	$sql2.=" purchaseordermaster c,asset_master d where a.PO_ID=c.id and ";
	$sql2.=" c.vendor_id=$vendor and  a.status='false' and a.asset_id=d.id ";//a.reason='$reason'
	
	$rs2=execute($sql2) or die(error_description());
	for($i=0;$i<rowcount($rs2);$i++)
	{
	$r2=fetcharray($rs2,$j);

	$AssetId=$r2["asset_id"];

	$sql3="select a.* from individual_asset_details a,";
	$sql3.=" purchaseordermaster c,asset_master d where a.PO_ID=c.id and ";
	$sql3.=" c.vendor_id=$vendor and a.conditions='Return' and a.status='false' and a.asset_id=d.id and a.asset_id=$r2[asset_id] and a.location_id=$r2[location_id]";

	$rs3=execute($sql3) or die(error_description());

	$qty=rowcount($rs3);

	$sql4=execute("select * from reasons_for_return where asset_id=$r2[asset_id] and location_id=$r2[location_id]");
	$rs4=fetcharray($sql4);

	$sql5=execute("select * from location_master where id=$r2[location_id]");
	$rs5=fetcharray($sql5);

	echo "<tr><td><input type=checkbox name=id[] value='$r2[asset_id]_$r2[location_id]'></td>";
	echo "<td>$r2[asset_name]</td><td><input type=text size=5 name='qty$r2[asset_id]_$r2[location_id]' value=$qty readonly></td>";
	echo "<td><textarea name='reason$r2[asset_id]_$r2[location_id]' cols=15 rows=3 wrap>$rs4[reason]</textarea></td><td>$rs5[location]</td></tr>";
	}
?>
<tr><td colspan=5 align=center><input type="submit" value="Generate Gate Pass" class=bgbutton></td></tr>
</table>
<?php
}
?>
<input type="hidden" name="vendor_id" value="<?=$vendor?>">
<input type="hidden" name="issuing_person" value="<?=$user?>">
</form>
</body>
</html>
