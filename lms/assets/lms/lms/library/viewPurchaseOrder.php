<?php
require_once("../db.php");
$action=$_REQUEST['action'];
$DDay=$_POST['DDay'];
$DMon=$_POST['DMon'];
$DYear=$_POST['DYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear'];

//print_r($_GET);
//print_r($_POST);

$today="";
$tday="";
if(!checkdate($DMon,$DDay,$DYear))
{
echo "Invalid Date.";
die("</td></tr></table>");
}
$today = "$DYear-$DMon-$DDay";
if(!checkdate($TMon,$TDay,$TYear)){
echo "Invalid To.";
die("</td></tr></table>");
}
$tday = "$TYear-$TMon-$TDay";
$sql = "SELECT a.id,a.order_no,a.order_date,a.order_copies,a.order_amt,b.name FROM lib_order_m a,lib_vendor_m b WHERE  a.vendor_id = b.id and a.order_date >= '".$today."' and a.order_date <='".$tday."' ORDER BY a.order_date DESC";
$rs = execute($sql)
or die("<b>Please Enter the Date.</b>");
//echo $sql;
$row=rowcount($rs);
?>
<HTML>
<BODY>
<?php
if($row > 0){
?>
<div align="left">
<table border="0" width="500" cellspacing="2" cellpadding="0" class=forumline align='center'>
 <tr><td align=center class=head colspan=5>Purchase Order Report </td></tr>
<tr>
<td width="81" align="center" class="rowpic">Order No.</td>
<td width="132" align="center" class="rowpic">Date</td>
<td width="83" align="center" class="rowpic">Copies</td>
<td width="73" align="center" class="rowpic">Amount</td>
<td width="109" align="center" class="rowpic">Vendor</td>
</tr>
<?php
for($i=0;$i<$row;$i++){
$r = fetcharray($rs,$i);
?>
<?php
$orderdate= $r["order_date"];
?>
<tr>
<td width="81" align="center" class="cbody"><A href="viewPurchaseOrderRep.php?id=<?=$r["id"]?>"><?=$r["order_no"]?></a></td>
<td width="132" align="center" class="cbody"><?=date("d-m-Y",strtotime($orderdate))?></td>
<td width="83" align="right" class="cbody"><?=$r["order_copies"]?></td>
<td width="73" align="right" class="cbody"><?=$r["order_amt"]?></td>
<td width="109" align="center" class="cbody"><?=$r["name"]?></td>
</tr>
<?php
}
?>
</table>
</div>
<?php
}
else
{
?>
<div align="center" class="Label">
There were no Purchase Orders generated,<br> for this library, from: <?=date("d-m-Y",strtotime($today))?>&nbsp;&nbsp;&nbsp;To: <?=date("d-m-Y",strtotime($tday))?>
</div>
<?php
}
?>
</BODY>
</HTML>

