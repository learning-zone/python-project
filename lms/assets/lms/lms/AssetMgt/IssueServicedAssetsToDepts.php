<html>
<head>
<script language="JavaScript">
	function RefreshMe()
	{
		document.frm.action="IssueServicedAssetsToDepts.php";
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
$sql=execute("select * from dept_no");

?>
<body>
<form name="frm" method="post" action="InsIssueServicedAssetsToDepts.php">
<table class=forumline align=center>
<tr><td Class="head" colspan=2>Issue Serviced Assets To Department</td></tr>
<tr><td class=rowpic>Select Vendor</td><td><select name="dept" OnChange="RefreshMe()">
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
<table class=forumline align=center>
<tr><td Class="rowpic">select</td><td Class="rowpic">Asset Code</td><td Class="rowpic">Location</td></tr>
<?php



/*select a.*,b.item_code,c.location from service_gatepass_details a,individual_asset_details b,location_master c,dept_no d where a.location_id=c.id and a.item_code_id=b.id and a.returned='YES' and a.issue_status='NO' and a.completely_received='NO' and c.dept_id=d.dpt_id and d.dpt_id=$dept*/

$qry1=("SELECT a . * FROM return_gatepass_details a, dept_no b, location_master c WHERE a.location_id = c.id AND c.dept_id = b.dpt_id
AND b.status =1 AND a.receive_status = 'YES' AND a.issue_status = 'NO'") or die(error_description());

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
<input type="hidden" name="PersonName" value="<?=$user?>">
<div align=center>
<input type="submit" value="Issue Serviced Assets to Department" class=bgbutton>
</div>
<?}?>
</form>
</body>
</html>

