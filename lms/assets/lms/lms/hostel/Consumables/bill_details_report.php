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
<?
session_start();
//
include("../../db.php");
$supplier = $_POST['supplier'];
$date4 = $_POST['date4'];
$date4 = date("Y-m-d", strtotime($date4));
$date3 = $_POST['date3'];
$date3 = date("Y-m-d", strtotime($date3));


$billno = $_POST['billno'];
$billdate = $_POST['billdate'];
$vendor = $_POST['vendor'];
$idm = $_POST['idm'];
//echo "*********";
if(isset($_POST['date3']))
{
	$supplier=$_POST['supplier'];
$FinancialYear=$FinYear."-".($FinYear+1);

$FromDate=$date3;
$ToDate=$date4;
if(date_diff($FromDate,$ToDate,'d') > 0)
die("<b> Invalid To date </b>");
$current_date = date("d-m-Y");		// FOR STORING THE CURRENT DATE.
$rs_sql=execute("SELECT * FROM college");
$r_sql=fetcharray($rs_sql);
$college_name=$r_sql[col_name];
$Caption=$college_name;
$j = 0;
}
?>
</head>



<?
if($supplier=='')
{
$rs_sql=execute("select * from h_cons_purchase_m b where b.date_of_entry between '$FromDate' and '$ToDate'");
}
else
{
$rs_sql=execute("select * from h_cons_purchase_m b where b.date_of_entry between '$FromDate' and '$ToDate'  and b.supplier_id='$supplier'");
}
	if(rowcount($rs_sql)==0)
	{
		echo "<center>";
		echo "Data not found.";
		echo "<br>";
		echo "<a href=bill_details.php><u>Back</u></a>";
		echo "</center>";
		die();
	}
	
	?>
    <body>
<table width="45%" align='center'  class='forumline'>
<tr><td class='head' colspan='20' align='center' width='100%'>Bill Details</td></tr>
<tr>
<td height='20' width='25%' class='rowpic'>
	<b>Supplier</b>
</td>
<td height='20' width='20%' class='rowpic'>
	<b>Bill No</b>
</td>
<td height='20' width='30%' class='rowpic'>
	<b>Bill Date</b>
</td>
<td height='20' width='25%' class='rowpic'>
	<b>Total Amount</b>
</td>
</tr>
    <?
	for($i=0;$i<rowcount($rs_sql);$i++)
	{
		$r_sql=fetcharray($rs_sql,$i);
	
$query_supplier="select * from h_suplier_master where id='$r_sql[supplier_id]'";
$result_supplier=execute($query_supplier);
while($qdata=fetcharray($result_supplier))
		{
$supplier_name=$qdata[1];
		}
		if($i%2)
               echo "        <tr class='clsname' height='25'> ";
               else
               echo "        <tr height='25'> ";
		echo "<td align='center'>";
			echo $supplier_name;
		echo "</td>";
		echo "<td nowrap align='center'>";
		?>
<a href="billwise_details.php?billno=<?=$r_sql[bill_no]?>&billdate=<?=$r_sql[bill_date]?>&vendor=<?=$r_sql[supplier_id]?>&idm=<?=$r_sql[id_m]?>"><?=$r_sql[bill_no]?></a>
					<?
		echo "</td>";
		echo "<td nowrap align='center'>";
		$sst_date=$r_sql[bill_date];
		$sstyr=substr($sst_date,0,4);
		$sstmn=substr($sst_date,5,2);
		$sstday=substr($sst_date,8,2);
		echo $sstday."-".$sstmn."-".$sstyr;
		echo "</td>";
		echo "<td nowrap align='center'>";
						echo $r_sql[total_amount];
		echo "</td>";
		
		echo "</tr>";



	}

?>
</table>
<br>
<form method="POST" name=form1>
	  <div id="prn" align='center'><input class=bgbutton type="button" value="   Print   " name="B1"
	  onClick="printReport()" ></div>
</form>
</body>
</html>
