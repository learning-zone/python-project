<html>
<head>
<script language="JavaScript">
	function RefreshMe()
	{
		document.frm.action="DeputeAssetsToDestination.php";
		document.frm.submit();
	}
</script>
</head>
<?php
session_start();
require("../db.php");
require("../urlaccess.php");
$dept = $_POST['dept'];
$dept22 = $_POST['dept22'];
$returnday = $_POST['returnday'];
$returnmonth = $_POST['returnmonth'];
$PersonName = $_POST['PersonName'];
$isddept = $_POST['isddept'];
$itmName = $_POST['itmName'];
$isddept3  = $_POST['isddept3 '];
$sql=execute("select * from dept_no");

?>
<body>
<form name="frm" method="post" action="InsDeputeAssetsToDestination.php">
<table class=forumline align=center>
<tr><td Class="head" colspan=2>Send Assets On Deputation From Central Stores to Destination</td></tr>
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
</select>
</td></tr>
</table>
<?php if($dept<>'')
{?>
<table class=forumline align=center>



<tr><td Class="rowpic">select</td><td Class="rowpic">Asset Code</td><td Class="rowpic">Location</td></tr>
<?php

//$qry1=execute("select a.*,d.location from individual_asset_details a,dept_no b,AssetStatusMaster c,location_master d where a.dept_id=$dept and a.dept_id=b.dpt_id and a.asset_status_id=c.id and c.condition='Installed Working Satisfactorily' and a.condition='Deputation' and a.status='false' and a.location_id=d.id and a.dept_id=d.dept_id") or die(error_description());
$qry1=execute("select a.*,d.location from individual_asset_details a,dept_no b,AssetStatusMaster c,location_master d where a.dept_id=$dept and a.dept_id=b.dpt_id and a.asset_status_id=c.id and c.conditions='Installed Working Satisfactorily' and a.conditions='Deputation' and a.status='false' and a.location_id=d.id and a.dept_id=d.dept_id") or die(error_description());
//echo ("select a.*,d.location from individual_asset_details a,dept_no b,AssetStatusMaster c,location_master d where a.dept_id=$dept and a.dept_id=b.dpt_id and a.asset_status_id=c.id and c.condition='Installed Working Satisfactorily' and a.condition='Deputation' and a.status='false' and a.location_id=d.id and a.dept_id=d.dept_id");
//echo ("select a.*,d.location,f.issue_dept from individual_asset_details a,dept_no b,AssetStatusMaster c,location_master d,deputation_gatepass_master f where a.dept_id=$dept and a.dept_id=b.dpt_id and a.asset_status_id=c.id and c.condition='Installed Working Satisfactorily' and a.condition='working' and a.status='false' and a.location_id=d.id and f.issue_dept=d.dept_id") ;
for($i=0;$i<rowcount($qry1);$i++)
{
	$r1=fetcharray($qry1,$i);
	echo "<tr><td><input type=checkbox name=id[] value='$r1[id]_$r1[location_id]' checked></td>";
	echo "<td>$r1[item_code]</td><td>$r1[location]</td></tr>";
}
?>
</table>

<table align=center class=forumline>
<?
	$sqlw=execute("select * from dept_no");

	?>
<tr><td>Select Dept to Deputing Asset</td><td><select name="dept22" OnChange="RefreshMe()">
<option value="-1">Select Department</option>
<?php
	for($t=0;$t<rowcount($sqlw);$t++)
	{
		$rf=fetcharray($sqlw,$t);

		if($rf[dpt_id]==$dept22)
		{
			echo "<option value=$rf[dpt_id] selected>$rf[Dept]</option>";
		}
		else
		{
			echo "<option value=$rf[dpt_id]>$rf[Dept]</option>";
		}
	}
?>
</select>
</td></tr>
<tr><td class=rowpic>Comments</td><td><textarea name="comments" cols="15" rows="5"  value="<?=$comments?>"></textarea></td>
<tr><td class=rowpic>Expected Return Date</td>
<td><input type="text" name="returnday" size="2" maxlength="2" value="<?=$returnday?>">-
<input type="text" name="returnmonth" size="2" maxlength="2" value="<?=$returnmonth?>">-
<input type="text" name="returnyear" size="4" maxlength="4" value="<?=$returnyear?>"><br>
<small>DD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   MM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   YYYY</small></td></tr>
</table>
<input type="hidden" name="PersonName" value="<?=$user?>">
<input type="hidden" name="isddept" value="<?=$dept22?>">
<input type="hidden" name="itmName" value="<?=$r1[item_code]?>">
<div align=center>
<input type="submit" value="Save Details" class=bgbutton>
</div>
<?php
}
?>
</form>
</body>
</html>

