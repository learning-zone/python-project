<html>
<head>
<script language="JavaScript">
	function RefreshMe()
	{
		document.frm.action="IssueReturnedAssetsToDepts.php";
		document.frm.submit();
	}
</script>
</head>
<?php
session_start();
require("../db.php");
require("../urlaccess.php");

$dept = $_POST['dept'];
$sql=execute("select * from dept_no");

?>
<body>
<form name="frm" method="post" action="InsIssueReturnedAssetsToDepts.php">
<table class=forumline align=center>
<tr><td Class="head" colspan=2>Issue Returned Assets to Departments</td></tr>
<tr><td class=rowpic>Select Department</td><td><select name="dept" onChange="RefreshMe()">
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
<?if($dept<>'')
{?>
<table class=forumline align=center>
<tr><td Class=rowpic>Select</td><td Class=rowpic>Asset Name</td><td Class=rowpic>Location</td><td Class=rowpic>Quantity</td></tr>
<?php

	$sql1="select a.* from return_gatepass_details a,dept_no b, ";
	$sql1.=" location_master c where a.location_id=c.id and c.dept_id=b.dpt_id and ";
	$sql1.=" b.dpt_id=$dept and a.receive_status='YES' and a.issue_status='NO'";
	echo $sql1;
	$rs1=execute($sql1) or die(error_description());

	for($i=0;$i<rowcount($rs1);$i++)
	{
		$r=fetcharray($rs1,$i);

		$sql2=execute("select * from asset_master where id=$r[asset_id]");
		$r2=fetcharray($sql2);

		$sql3=execute("select * from location_master where id=$r[location_id]");
		$r3=fetcharray($sql3);

		echo "<tr><td><input type=checkbox name=id[] value='$r[asset_id]_$r[location_id]_$r[id]'></td>";
		echo "<td>$r2[asset_name]</td><td>$r3[location]</td>";
		echo "<td><input type=text name='qty$r[asset_id]_$r[location_id]_$r[id]' value=$r[quantity] size=5 readonly></td></tr>";
	}
echo "<tr><td colspan=4 align=center><input type=submit value='Issue Returned Materials' class=bgbutton></td></tr>";
}
?>
</table>
</form>
</html>
