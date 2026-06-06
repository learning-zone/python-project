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
$FromDay = $_POST['FromDay'];
$FromMonth = $_POST['FromMonth'];
$FromYear = $_POST['FromYear'];

$ToDay = $_POST['ToDay'];
$ToMonth = $_POST['ToMonth'];
$ToYear = $_POST['ToYear'];

$date4 = $_POST['date4'];
$date4 = date("Y-m-d", strtotime($date4));
$date3 = $_POST['date3'];
$date3 = date("Y-m-d", strtotime($date3));
//echo "*********";
if($_POST['date3'])
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


$rs_sql=execute("select a.*,b.*,c.* from h_cons_purchase_det a,h_cons_purchase_m b,h_item_master c where b.id_m=a.id_m and a.itemname_id=c.id and b.date_of_entry between '$FromDate' and '$ToDate'  and b.supplier_id='$supplier'");

if(rowcount($rs_sql)==0)
	{
		echo "<center>";
		echo "Data not found.";
		echo "<br>";
		echo "<a href=vendorwise_report.php><u>Back</u></a>";
		echo "</center>";
		die();
	}
?>
<body>
<table align='center'  class='forumline'>
<tr><td class='head' colspan='9' align='center' WIDTH='80%'>Purchase Details Vendorwise</td></tr>
<tr>
<td HEIGHT='20' WIDTH='15%' class='rowpic'>
	<b>Date</b>
</td>
<td HEIGHT='20' WIDTH='15%' class='rowpic'>
	<b>Item Name</b>
</td>
<td HEIGHT='20' WIDTH='10%' class='rowpic'>
	<b>Quantity</b>
</td>
<td HEIGHT='20' WIDTH='15%' class='rowpic'>
	<b>Quantity Type</b>
</td>
<td HEIGHT='20' WIDTH='20%' class='rowpic'>
	<b>Supplier</b>
</td>
<td HEIGHT='20' WIDTH='10%' class='rowpic'>
	<b>Bill No</b>
</td>
<td HEIGHT='20' WIDTH='15%' class='rowpic'>
	<b>Bill Date</b>
</td>
<td HEIGHT='20' WIDTH='10%' class='rowpic'>
	<b>Amount</b>
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
		$lst_date=$r_sql[date_of_entry];
		$lstyr=substr($lst_date,0,4);
		$lstmn=substr($lst_date,5,2);
		$lstday=substr($lst_date,8,2);
		echo $lstday."-".$lstmn."-".$lstyr;
		echo "</td>";
		echo "<td align='center'>";
			echo $r_sql[item_name];
		echo "</td>";
		echo "<td align='center'>";
			echo $r_sql[quantity];
		echo "</td>";
		echo "<td align='center'>";
			echo $r_sql[quantity_type];
		echo "</td>";
		echo "<td align='center'>";
			echo $supplier_name;
		echo "</td >";
		echo "<td nowrap align='center'>";
					echo $r_sql[bill_no];
		echo "</td>";
		echo "<td nowrap align='center'>";
		$sst_date=$r_sql[bill_date];
		$sstyr=substr($sst_date,0,4);
		$sstmn=substr($sst_date,5,2);
		$sstday=substr($sst_date,8,2);
		echo $sstday."-".$sstmn."-".$sstyr;
		echo "</td>";
		echo "<td nowrap align='center''>";
						echo $r_sql[total_amount];
		echo "</td>";
		
		echo "</tr>";
	}

?>
</table>
<br>
<form method="POST" name='form1'>
	  <div id="prn" align='center'><input class='bgbutton' type="button" value="   Print   " name="B1"
	  onClick="printReport()" ></div>
</form>
</body>
</html>
