<html>
<head>
<?php
session_start();
require("../db.php");
$FromDay = $_POST['FromDay'];
$FromMon = $_POST['FromMon'];
$FromYear = $_POST['FromYear'];
$ToDay = $_POST['ToDay'];
$ToMon = $_POST['ToMon'];
$ToYear = $_POST['ToYear'];
$submit = $_POST['submit'];
$PONumber = $_POST['PONumber'];
$PODate = $_POST['PODate'];
$r = $_POST['r'];
$PONumber = $_POST['PONumber'];
$PODate = $_POST['PODate'];
$status = $_POST['status'];

?>
<script>
function shashi()
{
	window.print();
}
</script>
</head>
<body>
<?php

$FromDate="$FromYear-$FromMon-$FromDay";
$ToDate="$ToYear-$ToMon-$ToDay";

$sql="select a.*,b.name from PurchaseOrderMaster a,";
$sql.=" VendorMaster_Assets b where a.POType='NEW' ";
$sql.=" and a.vendor_id=b.id and a.PODate between '$FromDate' and '$ToDate'";

$rs=execute($sql) or die(error_description());

?>
<table class=forumline align=center border='1'>
<tr><td colspan=7 Class="head" align=center>List of Purchase Orders Generated between <?=date("d-m-Y",strtotime($FromDate))?> and <?=date("d-m-Y",strtotime($ToDate))?></td></tr>
<tr><td Class="rowpic">Purchase Order No</td><td Class="rowpic">Purchase Order Date</td><td Class="rowpic">Raised By</td>
<td Class="rowpic">Additional Charges</td><td Class="rowpic">Total Bill Amount</td><!--<td Class="rowpic">Status</td>--><td Class="rowpic">Vendor Name</td></tr>
<?php
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs,$i);
?>
<tr><td><a href="PurchaseOrderDetails.php?id=<?=$r[id]?>&PONumber=<?=$r[PONumber]?>&PODate=<?=$r[PODate]?>&status=<?=$r[status]?>"><?=$r["PONumber"]?></a></td><td><?=date("d-m-Y",strtotime($r["PODate"]))?></td><td><?=$r["raised_by"]?></td>
<td align=right><?=$r["additional_charges"]?></td><td align=right><?=$r["total_bill_amount"]?></td><!--<td><?=$r["status"]?></td>--><td><?=$r["name"]?></td>
</tr>
<?php
	}
?>
</table>
<table align='center'> 
<tr><td><input type='submit'  value='PRINT' class='bgbutton' onclick='return shashi()'></td></tr>
</table>
</body>
</html>
