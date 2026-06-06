<html>
<body>
<?
session_start();
include("../../db.php");

$billno = $_REQUEST['billno'];
$billdate = $_REQUEST['billdate'];
$vendor = $_REQUEST['vendor'];
$idm = $_REQUEST['idm'];
//echo $billno."<br>";
//echo $billdate."<br>";
//echo $vendor."<br>";
//echo $idm;
$query_supplier="select * from h_suplier_master where id='$vendor'";
$result_supplier=fetcharray(execute($query_supplier));
?>
<table align='center'  class='forumline'>
<tr><td class='head' colspan='9' align='center'>Billwise Details</td></tr>
<tr><td class='head'>Bill No:&nbsp;&nbsp;&nbsp;&nbsp;<?=$billno?></td>
<td class='head'>Bill Date:&nbsp;&nbsp;&nbsp;&nbsp;<?=$billdate?></td>
<td class='head'>Vendor:&nbsp;&nbsp;&nbsp;&nbsp;<?=$result_supplier[name]?></td>
</tr>
</table>
<br>
<table align='center' class='forumline' width='46%'>
<tr>
<td class='rowpic'>
	Consumables
</td>
<td class='rowpic'>
	Quantity type
</td>
<td class='rowpic'>
	Quantity
</td>
<td class='rowpic'>
	Cost
</td>
</tr>

<?
$rs_sql=execute("select * from h_cons_purchase_det b where b.id_m='$idm'");
//echo "select * from h_cons_purchase_det b where b.id_m='$idm'";

	if(rowcount($rs_sql)==0)
	{
		echo "<center>";
		die("Data not found.");
		echo "</center>";
	}
	for($i=0;$i<rowcount($rs_sql);$i++)
	{
		
		$r_sql=fetcharray($rs_sql,$i);
		echo "<tr>";
		echo "<td>";
		$qr=fetcharray(execute("select item_name from h_item_master where id='$r_sql[itemname_id]'"));
		echo $qr[item_name];
		echo "</td>";
		echo "<td>";
		$sel=fetcharray(execute("select quantity_type from h_item_master where id='$r_sql[itemname_id]'"));
		echo $sel[quantity_type];
         echo "</td>";
		echo "<td>";
		echo $r_sql[quantity];
         echo "</td>";
		echo "<td align='right'>";
		echo $r_sql[amount];
         echo "</td>";
		echo "</tr>";
		
	}
	$wer=fetcharray(execute("select * from h_cons_purchase_m where id_m='$idm'"));
	$tax=$wer[tax];
	$maxtotal=$wer[total_amount];
		?>
<tr><td colspan=3 align='right'>TAX & other charges</td><td align='right'><?=number_format($tax,2,'.','')?></td></tr>
<tr><td colspan=3 align='right'>GRAND TOTAL</td><td align='right'><?=number_format($maxtotal,2,'.','')?></td></tr>
</table>
</body>
</html>