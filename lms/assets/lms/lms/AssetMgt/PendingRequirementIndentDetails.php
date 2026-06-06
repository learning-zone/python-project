<html>
<head>
<?php
session_start();
require("../db.php");
$FromDay = $_POST['FromDay'];
$FromMon = $_POST['FromMon'];
$FromYear = $_POST['FromYear'];
$ToDay = $_POST['ToDay'];
$ToMon = $_POST['ToMon'];
$ToYear = $_POST['ToYear'];
?>
<script language="JavaScript">

function printReport()
{
	prn.style.display='none';
	print(this.form);
	prn.style.display="";
}
</script>
</head>
<body>
<?php

$FromDate="$FromYear-$FromMon-$FromDay";
$ToDate="$ToYear-$ToMon-$ToDay";

$sql="select a.*,b.Dept,c.asset_name from requirementindent a,";
$sql.="dept_no b,asset_master c where a.asset_id=c.id ";
$sql.=" and a.dept_id=b.dpt_id and a.POStatus='Pending' and a.quotation_status='NO'";
$sql.=" and a.RDate between '$FromDate' and '$ToDate'";

$rs=execute($sql) or die($sql);

if(rowcount($rs)>=1)
{
?>
<table class=forumline align=center>
<tr><td colspan=6 Class="head" align=center><font face='Lucida Sans' size='3'>List of Pending Requirement Indents between <?php echo date("d-m-Y",strtotime($FromDate))?> and <?php echo date("d-m-Y",strtotime($ToDate))?></font></td></tr>
<tr><td Class="rowpic"><font face='Lucida Sans' size='1.8'>Sl No</font></td><td Class="rowpic" align=center><font face='Lucida Sans' size='1.8'>Indent No</font></td><td Class="rowpic"><font face='Lucida Sans' size='1.8'>Indent Date</font></td><td Class="rowpic"align=center><font face='Lucida Sans' size='1.8'>Asset Name</font></td><td Class="rowpic"><font face='Lucida Sans' size='1.8'>Quantity</font></td><td Class="rowpic"align=center ><font face='Lucida Sans' size='1.8'>Department</font></td></tr>
<?php
$slno=1;
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs,$i);
?>
<tr><td><?php echo $slno?></td><td><?php echo $r[RINumber]?></td><td><?php echo date("d-m-Y",strtotime($r[RDate]))?></td><td><?php echo $r[asset_name]?></td><td><?php echo $r[quantity]?></td><td><?php echo $r[Dept]?></td></tr>
<?php
	$slno++;
	}
}
else
{
	echo "<font color=blue><b>There are no Requirement Indents Placed !!</b></font>";

}
?>

</table>
<BR><DIV ALIGN='center' id='prn'><INPUT TYPE='BUTTON' NAME='print' VALUE='Print' CLASS='bgbutton' onclick='printReport()'></DIV>
</body>
</html>
