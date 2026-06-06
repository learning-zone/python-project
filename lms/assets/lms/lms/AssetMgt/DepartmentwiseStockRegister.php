<html>
<?php
session_start();
include("../db.php");

$print = $_POST['print'];
$dept = $_POST['dept'];
$FinancialYear=$FinYear."-".($FinYear+1);
$FYearStart=$FinYear."-04-01";
$FYearEnd=($FinYear+1)."-03-31";
// VARIABLE DECLARATION BEGINS.
$current_date = date("d-m-Y");		// FOR STORING THE CURRENT DATE.
$serial = 1;
$total_lines = 0;
$j = 0;
?>
<FORM NAME="tempfrm" METHOD="POST" ACTION="DepartmentwiseStockRegister.php">
<?php
$s1=fetcharray(execute("select * from dept_no where dpt_id=$dept"),0);
$sql="select * from asset_master";
$rs=execute($sql);
?>
<SCRIPT>
function printReport()
{
	prn.style.display='none';
	print(this.form);
	prn.style.display="";
}
</script>
<body>
<table class=forumline align=center>
<tr><td Class="head" colspan=8 align="center">Departmentwise Stock Register</td></tr>
<tr><td Class="row3" colspan=8 align="left">Department : <?=$s1["Dept"]?></td></tr>
<tr><td Class="rowpic">Sl No</td><td Class="Label">Item Description</td><td Class="rowpic">Quantity On Hand</td>
<td Class="rowpic">Unit Price</td><td Class="rowpic">Total Cost</td><td Class="rowpic">Supplier Name & Address</td>
<td Class="rowpic">Remarks</td></tr>
<?php
$slno=1;
for($i=0;$i<rowcount($rs);$i++)
{
	$r=fetcharray($rs,$i);
	//***************** For Working Items / Assets*********************//
	$sql1="select a.* from individual_asset_details a,";
	$sql1.=" PurchaseOrderMaster c where a.asset_id=$r[id] and a.PO_ID=c.id and ";
	$sql1.=" a.conditions='Working' and a.status='false' and a.dept_id=$dept";
	//echo "<br>".$sql1; 
	$rs1=execute($sql1) or die(error_description()."error1");
	$QOH=rowcount($rs1);
	$sql2="select distinct a.unitprice,c.name,c.address from individual_asset_details a,";
	$sql2.=" VendorMaster_Assets c,PurchaseOrderMaster f,";
	$sql2.=" PurchaseOrderDetails d where a.asset_id=$r[id] and a.PO_ID=d.PO_ID and ";
	$sql2.=" a.conditions='Working' and a.status='false' and a.dept_id=$dept and f.id=d.PO_ID and f.vendor_id=c.id";
// 	echo "<br>".$sql2;
	$rs2=execute($sql2) or die(error_description()."error2");

	$r2=fetcharray($rs2);
	if(rowcount($rs2)<>0)
	{
		$ff=$QOH*$r2[unitprice];
		$addr[1] = trim($r2["name"]);
		$tempaddr = $r2["address"];
		echo "<tr><td>$slno</td><td>$r[asset_name]</td><td>$QOH</td>";
		echo "<td align=right>$r2[unitprice]</td><td 
		align=right>".($QOH*$r2[unitprice])."</td>";
		echo "<td>$r2[name]<br>$r2[address]</td><td>&nbsp;</td></tr>";
		$slno++;
	}
	//******************************************************************//
	//***************Items sent on Deputation **************************//
	$sql1="select a.* from individual_asset_details a,";
	$sql1.=" PurchaseOrderMaster c where a.asset_id=$r[id] and a.PO_ID=c.id and ";
	$sql1.=" a.conditions='Deputation' and a.status='true' and a.dept_id=$dept";
	$rs1=execute($sql1) or die(error_description()."error1");
	$QOH=rowcount($rs1);
	$sql2="select distinct a.unitprice,c.name,c.address from individual_asset_details a,";
	$sql2.=" VendorMaster_Assets c,PurchaseOrderMaster f,";
	$sql2.=" PurchaseOrderDetails d where a.asset_id=$r[id] and a.PO_ID=d.PO_ID and ";
	$sql2.=" a.conditions='Deputation' and a.status='true' and a.dept_id=$dept and f.id=d.PO_ID and f.vendor_id=c.id";
	$rs2=execute($sql2) or die(error_description()."error2");
	$r2=fetcharray($rs2);
	if(rowcount($rs2)<>0)
	{
		$ff=$QOH*$r2[unitprice];
		echo "<tr><td>$slno</td><td>$r[asset_name]</td><td>$QOH</td>";
		echo "<td align=right>$r2[unitprice]</td><td align=right>".($QOH*$r2[unitprice])."</td>";
		echo "<td>$r2[name]<br>$r2[address]</td><td>On Deputation</td></tr>";
		$slno++;
	}
	//*****************************************************************//
	//******************Stock Details of Existing / Old Assets *********//
	//***************** For Working Items / Assets*********************//
	$sql1="select a.* from individual_asset_details a ";
	$sql1.=" where a.asset_id=$r[id] and ";
	$sql1.=" a.conditions='Working' and a.status='false' and a.dept_id=$dept and a.AssetStatus='Old'";
	//echo $sql1;
	$rs1=execute($sql1) or die(error_description()."error1");
	$QOH=rowcount($rs1);
	if(rowcount($rs1)>=1)
	{
		$sql2="select distinct a.current_value,c.name,c.address from individual_asset_details a,";
		$sql2.=" VendorMaster_Assets c where a.asset_id=$r[id] and ";
		$sql2.=" a.conditions='Working' and a.status='false' and a.dept_id=$dept and a.vendor=c.id";
		$rs2=execute($sql2) or die(error_description()."error2");
		$r2=fetcharray($rs2);
		if(rowcount($rs2)<>0)
		{
			$ff=$QOH*$r2[current_value];
			$addr[1] = trim($r2["name"]);
			$tempaddr = $r2["address"];
			echo "<tr><td>$slno</td><td>$r[asset_name]</td><td>$QOH</td>";
			echo "<td align=right>$r2[current_value]</td><td align=right>".($QOH*$r2[current_value])."</td>";
			echo "<td>$r2[name]<br>$r2[address]</td><td>&nbsp;</td></tr>";
			$slno++;
		}
	}
	//******************************************************************//
	//***************Items sent on Deputation **************************//
	$sql1="select a.* from individual_asset_details a ";
	$sql1.=" where a.asset_id=$r[id] and ";
	$sql1.=" a.conditions='Deputation' and a.status='true' and a.dept_id=$dept and a.AssetStatus='Old'";
	$rs1=execute($sql1) or die(error_description()."error1");
	$QOH=rowcount($rs1);
	$sql2="select distinct a.current_value,c.name,c.address from individual_asset_details a,";
	$sql2.=" VendorMaster_Assets c where a.asset_id=$r[id] and ";
	$sql2.=" a.conditions='Deputation' and a.status='true' and a.dept_id=$dept and a.vendor=c.id";
	$rs2=execute($sql2) or die(error_description()."error2");
	$r2=fetcharray($rs2);
	if(rowcount($rs2)<>0)
	{
		$ff=$QOH*$r2[current_value];
		echo "<tr><td>$slno</td><td>$r[asset_name]</td><td>$QOH</td>";
		echo "<td align=right>$r2[current_value]</td><td align=right>".($QOH*$r2[current_value])."</td>";
		echo "<td>$r2[name]<br>$r2[address]</td><td>On Deputation</td></tr>";
		$slno++;
	}
	//***********************End of Existing Assets / Old Assets Stock Details ****************//
}	
?>
</table>
<BR><DIV ALIGN='center' id='prn'><INPUT TYPE='BUTTON' NAME='print' VALUE='PRINT THE REPORT' CLASS='bgbutton' onclick='printReport()'></DIV>
</form>
</body>
</html>
