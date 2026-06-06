<html>
<head>
<script language="JavaScript">
	function RefreshMe()
	{
		document.frm.action="ReceiveServicedAssets.php";
		document.frm.submit();
	}
</script>
</head>
<?php
session_start();
require("../db.php");

$PersonName = $_POST['PersonName'];
$vendor = $_POST['vendor'];
$sql=execute("select * from VendorMaster_Assets order by name");

?>
<body>
<form name="frm" method="post" action="InsReceiveServicedAssets.php">
<table class=forumline align=center>
<tr><td Class="head" colspan=2>Receive Assets Sent For Servicing</td></tr>
<tr><td>Select Vendor</td><td><select name="vendor" OnChange="RefreshMe()">
<option value="-1">Select Vendor</option>
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
<?php
if($vendor<>"")
{
?>
<table class=forumline align=center>
<tr><td Class="rowpic">select</td><td Class="rowpic">Asset Code</td><td Class="rowpic">Location</td></tr>
<?php
	$feto=fetcharray(execute("select max(id) from service_gatepass_master"));
$drtym=fetcharray(execute("select gatepassno from service_gatepass_master where id='$feto[0]'"));
//echo ("select a.*,b.*,c.location,f.vendor_id from service_gatepass_details a,individual_asset_details b,location_master c,PurchaseOrderMaster d,service_gatepass_master f where a.location_id=c.id and a.item_code_id=b.id and a.returned='NO' and d.id=b.PO_ID and f.vendor_id=$vendor and b.condition='Service' and f.gatepassno='$drtym[0]'");
$qry1=execute("select a.*,b.item_code,c.location,f.vendor_id from service_gatepass_details a,individual_asset_details b,location_master c,PurchaseOrderMaster d,service_gatepass_master f where a.location_id=c.id and a.item_code_id=b.id and a.returned='NO' and d.id=b.PO_ID and f.vendor_id=$vendor and b.conditions='Service' and f.gatepassno='$drtym[0]'") or die(error_description());

if(rowcount($qry1)<>0)
{
for($i=0;$i<rowcount($qry1);$i++)
{
	$r1=fetcharray($qry1,$i);
	echo "<tr><td><input type=checkbox name=id[] value='$r1[id]_$r1[item_code_id]' checked></td>";
	echo "<td>$r1[item_code]</td><td>$r1[location]</td></tr>";
}
}

?>
</table>
<div align=center>
<input type="submit" value="Receive Back Serviced Assets" class=bgbutton>
</div>
<?}?>
<input type="hidden" name="PersonName" value="<?=$user?>">

</form>
</body>
</html>

