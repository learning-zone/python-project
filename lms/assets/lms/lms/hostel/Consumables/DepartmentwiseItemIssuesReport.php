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
include("../../db.php");
$dept = $_POST['dept'];
$date4 = $_POST['date4'];
$date4 = date("Y-m-d", strtotime($date4));
$date3 = $_POST['date3'];
$date3 = date("Y-m-d", strtotime($date3));

if($_POST['date3'])
{
	$itemid=$_POST['item'];
	$college=$_POST['college'];
	$dept=$_POST['dept'];
	$FinancialYear=$FinYear."-".($FinYear+1);
	
	$FromDate=$date3;
	$ToDate=$date4;
	if(date_diff($FromDate,$ToDate,'d') > 0)
	die("<b> Invalid To date </b>");
	$current_date = date("d-m-Y");		
	$rs_sql=execute("SELECT * FROM college");
	$r_sql=fetcharray($rs_sql);
	$college_name=$r_sql[col_name];
	$Caption=$college_name;
	$j = 0;
}
?>
</head>

<?php
if($dept=='-1')
{
	//echo "inside if";	
	$rs_sql=execute("select a.*,b.*,c.*,d.* from h_issue_consumable d,h_cons_purchase_det a,h_cons_purchase_m b,h_item_master c where a.itemname_id=c.id and d.issued_date between '$FromDate' and '$ToDate' and d.itemname=c.id and a.id_m=b.id_m group by d.department_id,d.issue_id order by d.issued_date asc");
	
}
else
{
	$rs_sql=execute("select a.*,b.*,c.*,d.* from h_issue_consumable d,h_cons_purchase_det a,h_cons_purchase_m b,h_item_master c where a.itemname_id=c.id and d.issued_date between '$FromDate' and '$ToDate' and d.itemname=c.id and d.department_id='$dept' and a.id_m=b.id_m");
}
if(rowcount($rs_sql)==0)
{
	echo "<center>";
		echo "Data not found.";
		echo "<br>";
		echo "<a href=DeptwiseIssues.php><u>Back</u></a>";
		echo "</center>";
		die();
}
?>
<body>

<table align='center'  class='forumline' border="1" width="120%" cellspacing="0" cellpadding="0">
<tr><td class='head' colspan='8' align='center'>DEPARTMENTWISE ITEM ISSUE DETAILS</td></tr>
<tr>
<td HEIGHT='20' WIDTH='12%' class='rowpic'><b>Date</b></td>
<td HEIGHT='20' WIDTH='15%' class='rowpic'><b>Item Name</b></td>
<td HEIGHT='20' WIDTH='10%' class='rowpic'><b>Quantity</b></td>
<td HEIGHT='20' WIDTH='13%' class='rowpic'><b>Quantity Type</b></td>
<td HEIGHT='20' WIDTH='15%' class='rowpic'><b>Department</b></td>
<td HEIGHT='20' WIDTH='13%' class='rowpic'><b>Issued to</b></td>
<td HEIGHT='20' WIDTH='14%' class='rowpic'><b>Issued By</b></td>
<td HEIGHT='20' WIDTH='18%' class='rowpic'><b>Amount</b></td></tr>

<?
for($i=0;$i<rowcount($rs_sql);$i++)
{
	$r_sql=fetcharray($rs_sql);
	$ratq=$r_sql[unit_price];
	$issuqt=$r_sql[issued_qty];
	$query_supplier="select * from h_suplier_master";
	
	$result_supplier=execute($query_supplier);
	while($qdata=fetcharray($result_supplier))
	{
		$supplier_name=$qdata[1];
	}
	$query_dept="select * from dept_no where dpt_id='$r_sql[department_id]'";
	$result_dept=execute($query_dept);
	while($qd=fetcharray($result_dept))
	{
		$dept_name=$qd[0];
	}
	if($i%2)
               echo "        <tr class='clsname' height='25'> ";
               else
               echo "        <tr height='25'> ";
	echo "<td align='center'>";
	
	$sst_date=$r_sql[issued_date];
	$sstyr=substr($sst_date,0,4);
	$sstmn=substr($sst_date,5,2);
	$sstday=substr($sst_date,8,2);
	echo $sstday."-".$sstmn."-".$sstyr;
	echo "</td>";
	echo "<td align='center'>";
	echo "&nbsp;".$r_sql[item_name];
	echo "</td>";
	echo "<td align='center'>";
	echo "&nbsp;".$r_sql[issued_qty];
	echo "</td>";
	echo "<td align='center'>";
	echo "&nbsp;".$r_sql[quantity_type];
	echo "</td>";
	echo "<td nowrap align='center'>";
	echo "&nbsp;".$dept_name;
	echo "</td >";
	echo "<td nowrap align='center'>";
	echo "&nbsp;".$r_sql[issued_to];
	echo "</td >";
	echo "<td nowrap align='center'>";
	echo "&nbsp;".$r_sql[issued_by];
	echo "</td >";
	echo "<td align='center'>";
	$stamt1=$ratq*$issuqt."&nbsp;";
	echo $stamt1;
	echo "</td>";
	echo "</tr>";
	$maxtotal+=$stamt1;
	
}
?>
<tr height='25'><td colspan=7 align='right'>TOTAL</td><td align='right'><?=number_format($maxtotal,2,'.','')."&nbsp;"?></td></tr>
<tr height='25'><td colspan=7 align='right'>GRAND TOTAL</td>
<td align='right'><?=number_format($maxtotal,2,'.','')."&nbsp;"?></td></tr>
</table>
<br><form method="POST" name='form1'><div id="prn" align='center'>
<input class='bgbutton' type="button" value="   Print   " name="B1" onClick="printReport()" ></div>
</form>
</body>
</html>