<html>
<head>
<script language="JavaScript">
	function RefreshMe()
	{
		document.frm.action="SendAssetsToService.php";
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
$srtb=fetcharray(execute("select * from users where username='$user'"));
$PersonName == $srtb[0];
//echo "shashi".$PersonName;
?>
<body>
<form name="frm" method="post" action="InsSendAssetsForService.php">
<table class=forumline align=center>
<tr><td Class="head" colspan=2 align='center'>Send Assets For Servicing to Vendors</td></tr>
<tr><td>Select Department</td><td><select name="dept" OnChange="RefreshMe()">
<option value=''>Select Department</option>
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

<table class=forumline align=center>
<?php

if($dept!='')
{

$qry1=execute("select a.*,d.location from individual_asset_details a,dept_no b,assetstatusmaster c,location_master d where a.dept_id='$dept' and a.dept_id=b.dpt_id  and a.conditions='Service' and a.status='false' and a.location_id=d.id and a.dept_id=d.dept_id") or die("select a.*,d.location from individual_asset_details a,dept_no b,assetstatusmasterc,location_master d where a.dept_id=$dept and a.dept_id=b.dpt_id  and a.conditions='Service' and a.status='false' and a.location_id=d.id and a.dept_id=d.dept_id");

if(rowcount($qry1)>0)
	{
	?>
	<tr><td Class="rowpic">select</td><td Class="rowpic">Asset Code</td><td Class="rowpic">Location</td></tr>
	<?php
	}
  for($i=0;$i<rowcount($qry1);$i++)
{
	$r1=fetcharray($qry1,$i);
	echo "<tr><td><input type=checkbox name=id[] value='$r1[id]_$r1[location_id]' checked></td>";
	echo "<td>$r1[item_code]</td><td>$r1[location]</td></tr>";
}
?>
</table>
<?php
}
?>
<table class=forumline align=center>
<tr><td>Comments</td><td><textarea name="comments" cols="15" rows="5" wrap></textarea></td>
<tr><td>Vendor</td>
<td><select name="vendor">
<?php

	$sql=execute("select * from vendormaster_assets order by name") or die(error_description());

	for($i=0;$i<rowcount($sql);$i++)
	{
		$r=fetcharray($sql);
		echo "<option value=$r[id]>$r[name]</option>";
	}
?>
</select>
</td></tr>

</table>
<input type="hidden" name="PersonName" value="<?=$user?>">
<div align=center>
<input type="submit" value="Save Details" class=bgbutton>
</div>
</form>
</body>
</html>

