<html>
<head>
<?php
include("../db.php");
?>
</head>
<body>
<?php
$sql="select * from lib_order_m where order_no='$ordno'";
$rs=execute($sql);
$row=rowcount($rs);
if($row==0)
{
die("<font color=red><b>Order No. not present.</b></font>");
}
$r=fetcharray($rs,0);
$sql2=execute("select * from lib_purchase_m where order_id=$r[id]");
if(rowcount($sql2)>0)
{
die("<font color=red><b>You Can't delete this order,Because you already purchased. </font></b>");
}
$sql2=execute("delete from lib_order_det where order_id=$r[id]");
$sql1=execute("delete from lib_order_m where order_no='$ordno'");
echo ("<font color=blue><b>Purchase order details deleted sucessfully</b></font>");
?>
</body>
</html>