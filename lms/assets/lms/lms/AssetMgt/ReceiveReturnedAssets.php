<html>
<head>
<script language="JavaScript">
	function RefreshMe()
	{
		document.frm.action="ReceiveReturnedAssets.php";
		document.frm.submit();
	}
</script>
</head>
<?php
session_start();
require("../db.php");
$vendor = $_POST['vendor'];
require("../urlaccess.php");
$sql=execute("select * from vendormaster_assets");

?>
<body>
<form name="frm" method="post" action="InsReceiveReturnedAssets.php">
<table class='forumline' align=center>
<tr><td Class="head" colspan=2>Receive Returned Assets</td></tr>
<tr><td class=rowpic>Select Vendor</td><td><select name="vendor" onChange="RefreshMe()">
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
</table>
<?if($vendor<>'')
{?>
<table class=forumline align=center>
<tr><td Class=rowpic>Select</td><td Class=rowpic>Asset Name</td><td Class=rowpic>Location</td><td Class=rowpic>Quantity</td></tr>
<?php

	$sql1=execute("select * from return_gatepass_details where vendor_id=$vendor and receive_status='NO'") or die(error_description());

	for($i=0;$i<rowcount($sql1);$i++)
	{
		$r=fetcharray($sql1,$i);

		$sql2=execute("select * from asset_master where id=$r[asset_id]");
		$r2=fetcharray($sql2);

		$sql3=execute("select * from location_master where id=$r[location_id]");
		$r3=fetcharray($sql3);

		echo "<tr><td><input type=checkbox name=id[] value='$r[asset_id]_$r[location_id]_$r[id]'></td>";
		echo "<td>$r2[asset_name]</td><td>$r3[location]</td>";
		echo "<td><input type=text name='qty$r[asset_id]_$r[location_id]_$r[id]' value=$r[quantity] size=5></td></tr>";
	}
echo "<tr><td colspan=4 align=center><input type=submit value='Receive Returned Materials' class=bgbutton></td></tr>";}
?>
</table>
</form>
</html>
