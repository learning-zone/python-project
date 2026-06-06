<?php
include("../db.php");
$id=$_REQUEST['id'];
//print_r($_GET);
//print_r($_POST);
$sql_qry="select a.id as purchase_id,purchaseNo as bill_no,b.order_no,a.delivery_date,b.library,b.vendor_id ";
$sql_qry.=" from lib_purchase_m a,lib_order_m b where a.id=$id and a.order_id=b.id";

$rs_sql=execute($sql_qry);
$r_sql=fetcharray($rs_sql);
?>
<html>
<head>
<script language="JavaScript">
		function printReport()
		{
			prn.style.display = "none";
			window.print();
			prn.style.display = "";

		}
</script>
</head>
<body>
<center><h3><u>Received Purchase Report</u></h3></center>
<table width='50%' border=0 align='center'>
<tr>
   <td>Received Date :</td>
   <td><?php echo date('d-m-Y',strtotime($r_sql[delivery_date]))?></td>
</tr>
<tr>
   <td>Bill No. :</td>
   <td><?=$r_sql[bill_no]?>
<tr>
   <td>Order No :</td>
   <td><?php echo $r_sql[order_no] ?></td>
</tr>
<tr>
    <?php 
	 $rs_qry=execute("select * from library_name where id=$r_sql[library]");
     $r_qry=fetcharray($rs_qry);
	 ?>
   <td>Library :</td>
   <td><?php echo $r_qry[name] ?></td>
</tr>
<tr>
  <?php
     mysql_free_result($rs_qry);
     $rs_qry=execute("select * from lib_vendor_m where id=$r_sql[vendor_id]");
     $r_qry=fetcharray($rs_qry);
	?>
  <td>Vendor:</td>
  <td><?php echo $r_qry[Name]."<br>".$r_qry[address] ?></td>
</tr>
</table>

<br><br>
<center>
<table border=1 cellspacing=0 cellpadding=0 width='50%'>
<tr height='25'>
   <td>Sl.No.</td>
   <td>Author</td>
   <td>Publisher</td>
   <td>Title</td>
   <td>Received Copies</td>
   <td>Unit Price</td>
   <td>Amount</td>
</tr>
<?php 
$qry="select * from lib_purchase_det where purchase_id='$r_sql[purchase_id]'";
$rs=execute($qry);
if($rs)
{
	$ctr=1;
	$tot = 0;
	$tot1 = 0;
	while($row=fetcharray($rs))
	{
		echo "<tr>";
		echo "<td align=center>";
				echo "$ctr";
		echo "</td>";
		echo "<td align=center>";
			echo "$row[author]";
		echo "</td>";
		echo "<td align=center>";
			echo "$row[publisher]";
		echo "</td>";
		echo "<td align=center>";
			echo "$row[title]";
		echo "</td>";
		echo "<td align=right>";
			echo "$row[received]";
		echo "</td>";
		echo "<td align=right>";
			echo "$row[apprate]";
		echo "</td>";
		echo "<td align=right>";
			echo number_format(($row[received] * $row[apprate]),2,'.','');
		echo "</td>";
		echo "</tr>";
		$ctr++;
		$tot = $tot + $row[received];
		$tot1 = $tot1 + ($row[received] * $row[apprate]);
	}
}
echo "<tr>";
echo "<td colspan=4 align=right>";
echo "<b>Grand Total</b>";
echo "</td>";
echo "<td align=right>";
echo "<b>$tot</b>";
echo "</td>";
echo "<td>&nbsp;</td>";
echo "<td align=right><b>";
echo number_format($tot1,2,'.','');
echo "</b></td>";
echo "</tr>";
echo "</table>";
?>
<br>
		<div id="prn" align='center'><input type="button" value="   Print   " name="B1"
	  onClick="printReport()" class=bgbutton></div>
</body>
</html>