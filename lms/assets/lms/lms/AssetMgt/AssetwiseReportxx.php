<html>
<head><title>ASSETWISE REPORT</TITLE></HEAD>
<?php
session_start();
include("../db.php");

$print = $_POST['print'];
$subass = $_GET['subass'];
$filename = $_POST['filename'];

$FinYear=date("Y");
$FinancialYear=$FinYear."-".($FinYear+1);
$FYearStart=$FinYear."-04-01";
$FYearEnd=($FinYear+1)."-03-31";
// VARIABLE DECLARATION BEGINS.
$current_date = date("d-m-Y");		// FOR STORING THE CURRENT DATE.
?>
<FORM NAME="tempfrm" METHOD="POST" ACTION="ViewDepreciationReport.php">
<?php
$sql="select * from asset_master where asset_group_id='$subass'";
//$sql="select * from asset_master order by asset_name ASC ";
//echo $sql;
$rs=execute($sql) or die(error_description());
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
<TABLE class=forumline colspan=4 align=center>
<tr><td Class="head" COLSPAN=4 ALIGN=CENTER> LIST OF ASSET IN LOCATION</TD></TR>
<TR><TD Class="rowpic">SL No</td><td Class="rowpic">Particulars</td><td Class="rowpic">Asset Code</td><td Class="rowpic">Location</td></tr>
<?php
$slno=1;
for($i=0;$i<rowcount($rs);$i++)
{
	$r=fetcharray($rs,$i);
	$sql22=execute("select * from asset_sub_group where id=$r[asset_group_id]");
	//$sql22=execute("select * from asset_sub_group where id='$subass'");
	$rs22=fetcharray($sql22);
	$sql1="select a.*,b.location from individual_asset_details a,location_master b where b.location<>'Central Stores' and a.location_id=b.id and a.asset_id=$r[id] and a.conditions='Working' group by a.location_id ";
	$rs1=execute($sql1) or die(error_description());
	if(rowcount($rs1)>=1)
	{
		echo "<tr><td>$slno</td><td>$r[asset_name]</td><td>$rs22[asset_code]</td>";
		echo "<td>";
		$fld4="";
		for($j=0;$j<rowcount($rs1);$j++)
		{
			$r1=fetcharray($rs1,$j);
			echo "$r1[location]<br>";
		}
		echo "</td></tr>";
		$slno++;
	}
}
?>
</table>
<BR><DIV ALIGN='center' id='prn'><INPUT TYPE='BUTTON' NAME='print' VALUE='PRINT THE REPORT' CLASS='bgbutton' onclick='printReport()'></DIV>
</form>
</body>
</html>
