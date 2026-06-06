<?php
require_once("../db.php");
$media=$_POST['media'];
$DDay=$_POST['DDay'];
$DMon=$_POST['DMon'];
$DYear=$_POST['DYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear'];
$today="";

//print_r($_GET);
//print_r($_POST);
if(!checkdate($DMon,$DDay,$DYear)){
echo "<font color=royalblue;><b>Invalid Date.</b> </font>";
die("</td></tr></table>");
}
$today = "$DYear-$DMon-$DDay";
$tday="";
if(!checkdate($TMon,$TDay,$TYear)){
echo "<font color=royalblue;><b>Invalid To Date.</b> </font>";
die("</td></tr></table>");
}
$tday = "$TYear-$TMon-$TDay";
$sql = "SELECT c.name,a.id as p_id,a.purchaseNo,a.copies,a.delivery_date,a.amt," ;
$sql .= " a.ptype as PayType FROM lib_purchase_m a,lib_order_m b,lib_vendor_m c WHERE " ;
$sql .= " a.order_id = b.id and b.vendor_id=c.id and a.delivery_date >= '".$today."' and a.delivery_date <='".$tday."' ORDER BY a.delivery_date DESC" ;

$rs = execute($sql);
$row=rowcount($rs);
?>
<HTML>
<BODY>

<?php
if($row > 0)
{
?>
<div align="center" Class="Label"><b> Purchase Report </b><br>
<tr>
<td class="cbody">From </td>
<td class="cbody"><?=date("d-m-Y",strtotime($today))?> </td>
<td class="cbody"> To </td>
<td class="cbody"><?=date("d-m-Y",strtotime($tday))?> </td>
</tr>
<div align="left">
<table border="0" width="640" cellspacing="1" cellpadding="0" class=forumline align=center>
<tr>
<td width="81" align="center" class="rowpic">Sl No.</td>
<td width="80" align="center" class="rowpic">Invoice No.</td>
<td width="125" align="center" class="rowpic">Vendor Name</td>
<td width="83" align="center" class="rowpic">Qty</td>
<td width="73" align="center" class="rowpic">Amount</td>
<td width="115" align="center" class="rowpic">Date of Supp</td>


<td width="115" align="center" class="rowpic">Payment Type</td>
</tr>
<?php
for($i=0;$i<$row;$i++){
$r = fetcharray($rs,$i);
?>
<tr>
<?php
$deliverydate= $r["delivery_date"];

$duedate=$r["duedate"];
?>
<td width="80" align="center" class="cbody"><?=$i+1?></td>
<td width="81" align="center" class="cbody"><A href="viewPurchaseOrderDet.php?id=<?=$r["p_id"]?>"><?=$r["purchaseNo"]?></a></td>
<!--<td width="81" align="left" class="cbody"><?=$r["purchaseNo"]?></td>-->
<td width="80" align="center" class="cbody"><?=$r["name"]?></td>
<td width="83" align="right" class="cbody"><?=$r["copies"]?></td>
<td width="73" align="right" class="cbody"><?=$r["amt"]?></td>
<td width="115" align="center" class="cbody"><?=date("d-m-Y",strtotime($deliverydate))?></td>


<td width="80" align="center" class="cbody"><?=$r["PayType"]?></td>
</tr>
<?php
$tbook = $tbook + ($r["copies"]);
$tamount=$tamount+ ($r["amt"]);
}
?>
<!--</table>
<table border="0" width="620" cellspacing="1" cellpadding="0">
<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>-->
<tr>
<td  align="right" class="cbody" colspan=3><b>Total</b> </td>
<td align="right" class="cbody"><b><?=$tbook?></b></td>

<td align="right" class="cbody"><b><?=number_format($tamount,2,'.','')?></b></td>
<td></td>
<td></td>
</tr>
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