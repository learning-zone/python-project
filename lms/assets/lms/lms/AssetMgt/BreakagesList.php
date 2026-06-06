<html>
<head>
<?
	include("../db.php");
	include("../urlaccess.php");
?>
<script>
function shn()
{
	window.print();
}
</script>
</head>
<body>
<?php

	$sql="select a.*,c.item_code,b.asset_name from breakages_entry a,asset_master b,";
	$sql.=" individual_asset_details c where a.item_code_id=c.id and b.id=c.asset_id ";
	$sql.=" order by breakage_date ASC";
echo $sql;
	$rs=execute($sql) or die(error_description());

	if(rowcount($rs)<>0)
	{
?>
<table class=forumline align=center>
<tr><td Class="head" colspan=5 align=center>Breakages List</td></tr>
<tr><td Class="rowpic">Sl No </td><td Class="rowpic">Asset Code</td><td Class="rowpic">Asset Name</td>
<td Class="rowpic">Breakage Date</td><td Class="rowpic">Reason for Breakage</td></tr>
<?php
$slno=1;

	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs,$i);

echo "<tr><td>$slno</td><td>$r[item_code]</td><td>$r[asset_name]</td>";
echo "<td>".date("d-m-Y",strtotime($r[breakage_date]))."</td><td>$r[reason]</td></tr>";
	$slno++;
	}
	echo "<tr><td align='center' colspan='5'><input type='submit' class='bgbutton'  value='PRINT' onclick='return shn()'></td></tr>";
echo "</table>";

	}
	else
	{
		echo "<font color='red' size='3'><b>NO BREAKAGES RECORDS FOUND !..</b></font>";
	}
?>
</body>
</html>
