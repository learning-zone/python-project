<html>
<head><title>Asset Movement Register</title>

<script>
function shn()
{
	window.print();
}
</script>


</head>
<?php
	session_start();
	include("../db.php");
	$FromDay = $_POST['FromDay'];
$FromMon = $_POST['FromMon'];
$FromYear = $_POST['FromYear'];
$ToDay = $_POST['ToDay'];
$ToMon = $_POST['ToMon'];
$ToYear = $_POST['ToYear'];
$dept = $_POST['dept'];

	$FromDate="$FromYear-$FromMon-$FromDay";
	$ToDate="$ToYear-$ToMon-$ToDay";

	if($dept=="-1")
	{
		$sql="select * from asset_movement_register where date_of_movement ";
		$sql.=" between '$FromDate' and '$ToDate'";
	}
	else
	{
		$sql="select a.* from asset_movement_register a,dept_no b,";
		$sql.=" location_master c where a.from_location=c.id and c.dept_id=b.dpt_id ";
		$sql.=" and b.dpt_id=$dept and a.date_of_movement between '$FromDate' and '$ToDate'";
	}

	$rs=execute($sql) or die(error_description());

?>
<body>
<table class=forumline align=center>
<tr><td Class="head" colspan="7" align="center">Asset Movement Register</td></tr>
<tr>
<td Class="rowpic">Sl No</td><td Class="rowpic">Asset No.</td><td Class="rowpic">From Location</td>
<td Class="rowpic">To Location</td><td Class="rowpic">Date of Movement</td><td Class="rowpic">Gate Pass No</td><td Class="rowpic">Remarks</td></tr>
<?php
$slno=1;
	for($i=0;$i<rowcount($rs);$i++)
	{

		$r=fetcharray($rs,$i);

		$sql1=execute("select * from location_master where id=$r[from_location]");
		$rs1=fetcharray($sql1);

		$sql2=execute("select * from location_master where id=$r[to_location]");
		$rs2=fetcharray($sql2);

?>
<tr><td><?=$slno?></td><td><?=$r["asset_no"]?></td><td><?=$rs1["location"]?></td>
<td><?=$rs2["location"]?></td><td><?=date("d-m-Y",strtotime($r["date_of_movement"]))?></td>
<td><?=$r[gatepass]?></td><td><?=$r[remarks]?></td>
</tr>
<?php
	$slno++;
	}
echo "<tr><td align='center' colspan='7'><input type='submit' class='bgbutton'  value='PRINT' onclick='return shn()'></td></tr>";
?>
</table>
</body>
</html>
