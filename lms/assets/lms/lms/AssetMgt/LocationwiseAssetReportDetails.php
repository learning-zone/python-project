<html>
<head><title>LOCATIONWISE ASSET REPORT</TITLE></HEAD>
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
?>
</head>
<script>
function printReport()
{
	prn.style.display='none';
	print(this.form);
	prn.style.display="";
}
</script>
<body>
<FORM NAME="tempfrm" METHOD="POST" ACTION="LocationwiseAssetReportDetails.php">
<?php
if($dept=="-1")
{
	$sql="select a.*,a.dpt_id as dept_id,b.*,b.id as location_id from dept_no a,location_master b where a.dpt_id=b.dept_id and a.Dept<>'Central Stores'";
}
else
{
	$sql="select a.*,a.dpt_id as dept_id,b.*,b.id as location_id from dept_no a,location_master b where a.dpt_id=b.dept_id and a.dpt_id=$dept ";
}
//echo $sql;
$rs=execute($sql) or die(error_description()."error9");
echo "<center><font color=blue ><b>LOCATION WISE ASSET REPORT</B></FONT></center>";
$SLNO=1;
if(rowcount($rs)>=1)
{
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs,$i);
		$sql33="select * from individual_asset_details where dept_id=$r[dept_id] and location_id=$r[location_id] and conditions='Working'";
		$rs33=execute($sql33);
		if(rowcount($rs33)>=1)
		{
			if($i==0)
			{
				echo "<br><b>Department : $r[Dept]</b><br>";
			}
			echo "<br><center><b>Location : $r[location]</b></center><br>";
			echo "<table class=forumline align=center width=375>";
			echo "<tr><td class=rowpic>Sl No</td><td class=rowpic>Particulars</td><td class=rowpic>Asset Code</td><td class=rowpic>Qty</td><td class=rowpic>Value</td><td class=rowpic>Total</td></tr>";
			$sql1=execute("select * from asset_master") or die(error_description()."error44");
			$SubTotal=0;
			for($j=0;$j<rowcount($sql1);$j++)
			{
				$r1=fetcharray($sql1,$j);
				$sql22=execute("select * from asset_sub_group where id=$r1[asset_group_id]");
				$rs22=fetcharray($sql22);
				$sql2=execute("select * from individual_asset_details where asset_id=$r1[id] and location_id=$r[location_id] and conditions='Working'") or die(error_description()."error1");
				$QOH=rowcount($sql2);
				$sql3=execute("select sum(unitprice) as Value from individual_asset_details where asset_id=$r1[id] and location_id=$r[location_id] and conditions='Working'") or die(error_description()."error2");
				//echo ("select sum(current_value) as Value from individual_asset_details where asset_id=$r1[id] and location_id=$r[location_id] and condition='Working'");
				$rs3=fetcharray($sql3);
				if(rowcount($sql2)<>0)
				{
					$flag=1;
					echo "<tr><td>$SLNO</td><td>$r1[asset_name]</td><td>$rs22[asset_code]</td>";
					echo "<td>$QOH</td><td align=right>".number_format(($rs3[Value]/$QOH),"2",".","")."</td><td align=right>".number_format(($rs3["Value"]),"2",".","")."</td></tr>";
					$SLNO++;
				}
				$SubTotal=$SubTotal+$rs3[Value];
			}
			echo "<tr><td colspan=5 align=right><font color=blue><b>Sub Total</font></b><td align=right><b><font color=blue>".number_format($SubTotal,"2",".","")."</b></font></td></tr>";
			$GrandTotal=$GrandTotal+$SubTotal;
			echo "</table>";
		}
	}
	echo "<table width=375 align=center>";
	echo "<tr><td ALIGN=RIGHT ><font color=red><b>Grand Total</b></font></td><td ALIGN=RIGHT><font color=red><b>".number_format($GrandTotal,"2",".","")."</b></font></td></tr>";
	echo "</table>";
}
?>
<BR><DIV ALIGN='center' id='prn'><INPUT TYPE='BUTTON' NAME='print' VALUE='PRINT THE REPORT' CLASS='bgbutton' onclick='printReport()'></DIV>
</form>
</body>
</html>
