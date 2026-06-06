<html>
<head>
<script language="JavaScript">
	function RefreshMe()
	{
		document.frm.action="ReceiveDeputeAssets.php";
		document.frm.submit();
	}
</script>
</head>
<?php
session_start();
require("../db.php");
require("../urlaccess.php");
$isddept  = $_POST['isddept '];
$isddept3  = $_POST['isddept3 '];
$dept = $_POST['dept'];
$PersonName = $_POST['PersonName'];
$sql=execute("select * from dept_no");

?>
<body>
<form name="frm" method="post" action="InsReceiveDeputeAssets.php">
<table class=forumline align=center>
<tr><td Class="head" colspan=2>Receive Assets Sent on Deputation</td></tr>
<tr><td Class="head">Select Department</td><td><select name="dept" OnChange="RefreshMe()">
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
<?php
if($dept<>"")
{
?>
<table Class="forumline" align=center>
<tr><td Class="rowpic">select</td><td Class="rowpic">Asset Code</td><td Class="rowpic">Location</td></tr>
<?php
//echo ("select a.*,b.item_code,c.location,f.* from deputation_gatepass_details a,individual_asset_details b,location_master c,dept_no d,deputation_gatepass_master f where a.location_id=c.id and a.item_code_id=b.id and a.returned='NO' and f.issue_dept=d.dpt_id and d.dpt_id=$dept and a.completely_received !='YES'") ;
//---prevous query-----
//$qry1=execute("select a.*,b.item_code,c.location from deputation_gatepass_details a,individual_asset_details b,location_master c,dept_no d where a.location_id=c.id and a.item_code_id=b.id and a.returned='NO' and c.dept_id=d.dpt_id and d.dpt_id=$dept") or die(error_description());
//--changed query by shashidhar 
$feto=fetcharray(execute("select max(id) from deputation_gatepass_master"));
$drtym=fetcharray(execute("select gatepassno from deputation_gatepass_master where id='$feto[0]'"));
$qry1=execute("select a.*,b.item_code,b.conditions,c.location,f.* from deputation_gatepass_details a,individual_asset_details b,location_master c,dept_no d,deputation_gatepass_master f where a.location_id=c.id and a.item_code_id=b.id and a.returned='NO' and f.issue_dept=d.dpt_id and d.dpt_id=$dept and a.completely_received !='YES' and b.conditions='Deputation' and f.gatepassno='$drtym[0]' ")  or die(error_description());
//ECHO ("select a.*,b.item_code,b.condition,c.location,f.* from deputation_gatepass_details a,individual_asset_details b,location_master c,dept_no d,deputation_gatepass_master f where a.location_id=c.id and a.item_code_id=b.id and a.returned='NO' and f.issue_dept=d.dpt_id and d.dpt_id=$dept and a.completely_received !='YES' and b.condition='Deputation' and and f.gatepassno='$drtym[0]'");
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
<?
	$sqlw=execute("select *from dept_no");
	?>
<table align='center' border='1' class='forumline'>
<tr><td>Select Dept to Sending  Asset Back</td><td><select name="dept22" OnChange="RefreshMe()">
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
</table>
<input type="hidden" name="PersonName" value="<?=$user?>">
<div align=center>

<input type="submit" value="Receive Back Deputed Assets" class=bgbutton>
</div>
<input type="hidden" name="isddept" value="<?=$dept22?>">
<?}?>
</form>
</body>
</html>

