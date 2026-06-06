<html>
<head><title>ASSETWISE REPORT</TITLE></HEAD>
<?php
session_start();
include("../db.php");
$filename = $_POST['filename'];
$print = $_POST['print'];
$FinancialYear=$FinYear."-".($FinYear+1);
$FYearStart=$FinYear."-04-01";
$FYearEnd=($FinYear+1)."-03-31";
// VARIABLE DECLARATION BEGINS.
$current_date = date("d-m-Y");		// FOR STORING THE CURRENT DATE.
$j = 0;
$sql="select * from asset_master order by asset_name ASC";
$rs=execute($sql) or die(error_description());
?>
<FORM NAME="tempfrm" METHOD="POST" ACTION="ViewDepreciationReport.php">
<?php
$CollegeName=fetcharray(execute("select * from college"));
$Caption=strtoupper($CollegeName["col_name"]);
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
<TABLE class=forumline align=center>
<tr><td Class="head" COLSPAN=5 ALIGN=CENTER>ASSETWISE REPORT</TD></TR>
<TR><TD Class="rowpic">SL No</td><td Class="rowpic">Particulars</td><td Class="rowpic">Asset Code</td><td Class="rowpic">Qty</td><td Class="rowpic">Value</td></tr>
<?php
$slno=1;
for($i=0;$i<rowcount($rs);$i++)
{
	$AssetValue=0;
	$r=fetcharray($rs,$i);
	$sql1="select a.* from individual_asset_details a where a.asset_id=$r[id] and a.conditions='Working' and a.status='false'";
	$rs1=execute($sql1) or die(error_description());
	$sql22=execute("select * from asset_sub_group where id=$r[asset_group_id]");
	$rs22=fetcharray($sql22);
	if(rowcount($rs1)>=1)
	{
		echo "<tr><td>$slno</td><td>$r[asset_name]</td><td>$rs22[asset_code]</td>";
		$AssetValue=0;
		for($j=0;$j<rowcount($rs1);$j++)
		{
			$r1=fetcharray($rs1,$j);
			$AssetValue=$AssetValue+$r1[current_value];
		}
		$mm=rowcount($rs1);
		echo "<td>".$mm."</td><td align=right>".number_format($AssetValue,"2",".",",")."</td></tr>";
		$slno++;
	}
	$TotalAssetValue=$TotalAssetValue+$AssetValue;
}
echo "<tr><td Class=Block colspan=4>Total</td><td align=right>".number_format($TotalAssetValue,"2",".",",")."</td></tr>";
?>
</table>
<BR><DIV ALIGN='center' id='prn'><INPUT TYPE='BUTTON' NAME='print' VALUE='PRINT THE REPORT' CLASS='bgbutton' onclick='printReport()'></DIV>
</body>
</html>
