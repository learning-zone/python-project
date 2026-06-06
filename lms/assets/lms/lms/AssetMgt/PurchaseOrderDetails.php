<html>
<head>
<?php
session_start();
//require("../urlaccess.php");
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
$id = $_POST['id'];
$r = $_REQUEST['r'];
$PONumber = $_REQUEST['PONumber'];
$PODate = $_REQUEST['PODate'];
$status = $_REQUEST['status'];
?>
Purchase Order No : <?=$PONumber?>    Date : <?=date("d-m-Y",strtotime($PODate))?><br>

<?php
/*SELECT a . * , b . *
FROM PurchaseOrderDetails a, asset_master b
WHERE a.asset_id = b.id
AND a.PO_ID = '4'*/
$sql ="select a.*,b.* from PurchaseOrderDetails a, asset_master b WHERE a.asset_id = b.id AND a.PO_ID = '4'";
//<!--$sql="select a.*,b.* from PurchaseOrderDetails a,asset_master b where a.asset_id=b.id and a.PO_ID='$id'";
//echo $sql;-->
$rs=execute($sql) or die(error_description());

?>
</head>
<body>
<table class=forumline>
<tr><td colspan=5 Class="head">List of Materials / Items Ordered</td></tr>
<tr><td Class="rowpic">Sl No</td>
<td Class="rowpic">Asset Name</td>
<td Class="rowpic">Quantity</td>
<td Class="rowpic">Unit Price</td>
<td Class="rowpic">Total Cost</td>
</tr>
<?php
$slno=1;

for($j=0;$j<rowcount($rs);$j++)
{
$r=fetcharray($rs,$j);
?>
<tr><td><?=$slno?></td><td><?=$r["asset_name"]?></td><td><?=$r["quantity"]?></td>
<td><?=$r["unitprice"]?></td><td><?=$r["totalprice"]?></td></tr>
<?php
$slno++;
}
?>
</table>
</body>
</html>


