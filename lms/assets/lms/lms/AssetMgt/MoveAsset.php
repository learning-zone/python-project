<html>
<head><title>Movement of Asset</title>
<Script language="JavaScript">

	function MoveAsset()
	{
		document.frm.action="SaveMoveDetails.php";
		document.frm.submit();
	}
</script>
</head>
<?php
	session_start();
	include("../db.php");
	
	$ano = $_POST['ano'];
$search_asset = $_POST['search_asset'];
$moveDay = $_POST['moveDay'];
$moveMonth = $_POST['moveMonth'];
$moveYear = $_POST['moveYear'];
$SourceLocation = $_POST['SourceLocation'];
$asset_id = $_POST['asset_id'];
$asset_no = $_POST['asset_no'];
$location_id = $_POST['location_id'];
$dept_id = $_POST['dept_id'];
$autoid = $_POST['autoid'];
$shashi= $_POST['shashi'];

	$d=explode("-",date("d-m-Y"));
?>
<body>
<form method="post" name="frm">
<table class='forumline' align=center>
<tr><td Class="head" colspan=2>Movement of Asset</td></tr>
<tr><td class=>Enter Asset Number</td><td><input type="text" name="ano" value="<?=$ano?>">
<input type="submit" name="search_asset" value="Search Asset" class="bgbutton"></td></tr>
</table>
<?php
if(isset($search_asset))
{

	$sql="select a.*,a.id as autoid,b.*,b.id as assetid,c.*,c.dept_id as deptid from individual_asset_details a,asset_master b,";
	$sql.=" location_master c where a.item_code='".strtoupper($ano)."' and a.conditions='Working' ";
	$sql.=" and a.status='false' and a.asset_id=b.id and a.location_id=c.id";
	echo $sql;

	$rs=execute($sql) or die(error_description());

	if(rowcount($rs)==0)
	{
		echo "<font color=red><b>Asset Not Found !!</b></font>";
		die();
	}
	else
	{
		$r=fetcharray($rs);

		$SourceLocation=$r["location_id"];

		echo "<table class=forumline align=center>";
		echo "<tr><td class=rowpic>Asset No & Description</td><td class=rowpic>$r[item_code]==>$r[asset_name]</td></tr>";
		echo "<tr><td class=rowpic>Current Location</td><td>$r[location]</td></tr>";

		$sql1="select * from location_master where id<>$r[location_id] and location<>'Central Stores'";

		echo "<tr><td>Move Asset To </td><td><select name=to_location>";

		$rs1=execute($sql1);

		for($i=0;$i<rowcount($rs1);$i++)
		{
			$r1=fetcharray($rs1,$i);

			echo "<option value='$r1[id]-$r1[dept_id]'>$r1[location]</option>";
		}
		echo "</select></td></tr>";
?>
<tr><td>Date of Movement</td>
<td>
<input type="text" name="moveDay" size="2" maxlength="2" value="<?=$d[0]?>">
<input type="text" name="moveMonth" size="2" maxlength="2" value="<?=$d[1]?>">
<input type="text" name="moveYear" size="4" maxlength="4" value="<?=$d[2]?>">
</td>
</tr>
<tr><td>Remarks</td><td><textarea name='shashi' cols='20' rows='2'></textarea></td></tr>
<tr><td colspan=2 align=center><input type="button" value="Move Asset" onClick="MoveAsset()" class=bgbutton></td></tr>
</table>
<?php

	}
}
?>
<input type="hidden" name="SourceLocation" value="<?=$SourceLocation?>">
<input type="hidden" name="asset_id" value="<?=$r[assetid]?>">
<input type="hidden" name="asset_no" value="<?=$ano?>">
<input type="hidden" name="location_id" value="<?=$r[location_id]?>">
<input type="hidden" name="dept_id" value="<?=$r[deptid]?>">
<input type="hidden" name="autoid" value="<?=$r[autoid]?>">
</form>
</body>
</html>
