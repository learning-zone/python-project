<html>
<head>
<title>Cancel Fee Receipt</title>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<?php
session_start();
include("../db.php");
?>
<script language='javascript'>
function cancelrcpt()
{
	if(confirm("Are you sure you want to Cancel Receipt ??"))
	{
		document.frm.action="cancel_feercpt.php";
		document.frm.submit();
	}
	else
		return false;
}
</script>
</head>
<body>
<form name="frm" method="post">
<input type='hidden' name='mid' value='<?=$mid?>'>
<?php
$sql="select * from fee_payment where id='$mid' ";
$rs=execute($sql) or die(mysql_error());
$r=fetcharray($rs);
$oldbal=$r[bfbalamt];
$oldexe=$r[bfexeamt];
if($oldbal>0 || $oldexe>0)
{
	$chsql=execute("select id from fee_payment where fmid='$r[fmid]' and id > '$mid' and recptstatus=0");
	if(rowcount($chsql)>0)
	{
		echo "<font color='red' size='3'><b>Cancel all other fee receipt(s) before cancelling this fee receipt... </b></font>";
		echo "<br><br><br><br><div id='1'><font color='brown'><b><< <a href='cancelfee1.php?stud_id=$r[studid]'>BACK</a></b></font><div>";
		die();
	}
}
$rs1=fetcharray(execute("select student_id,first_name,last_name,course_admitted from student_m where id='$r[studid]'"));
$rs2=fetcharray(execute("select course_abbr from course_m where course_id=$r[pid]"));
$rs3=fetcharray(execute("select year_name from course_year where year_id=$r[sid]"));
if($r[mop]==1)
	$mop="Cash";
elseif($r[mop]==2)
	$mop="Bank Draft";
elseif($r[mop]==3)
	$mop="Bank Challan";
$pdt1=explode("-",$r[pay_dt]);
$pdt=$pdt1[2]."-".$pdt1[1]."-".$pdt1[0];
?>
<table border=1 class=forumline align=center cellspacing='0' cellpadding='1'>
<tr><td align='center' class='head' colspan='4'><font size="4"><b>Fee Receipt Details</b></font></td></tr>
<tr><td nowrap>&nbsp;Receipt No</td><td nowrap>&nbsp;<?=$r[docid]?></td><td nowrap>&nbsp;Payment Date</td><td nowrap>&nbsp;<?=$pdt?></td></tr>
<tr><td nowrap>&nbsp;Student ID</td><td nowrap>&nbsp;<?=$rs1[0]?></td><td nowrap>&nbsp;Student Name</td><td nowrap>&nbsp;<?=$rs1[1]?> <?=$rs1[2]?></td></tr>
<tr><td nowrap>&nbsp;Course</td><td nowrap>&nbsp;<?=$rs2[0]?></td><td nowrap>&nbsp;Semester</td><td nowrap>&nbsp;<?=$rs3[0]?></td></tr>
<tr><td nowrap>&nbsp;Mode of Payment</td><td nowrap colspan='3'>&nbsp;<?=$mop?></td></tr>
<?php
if($r[mop]!=1)
{
	$rs4=fetcharray(execute("select bank_st_name from bank_details where id=$r[bkid]"));
	?>
	<tr><td nowrap>&nbsp;Bank Name</td><td nowrap>&nbsp;<?=$rs4[0]?></td><td nowrap>&nbsp;DD/Challan No</td><td nowrap>&nbsp;<?=$r[ddno]?></td></tr>
	<?php
}
?>
<tr><td colspan='4'>
<table width="100%" class='forumline' border='1'>
<tr height='30'>
<td align='center' Class="rowpic" nowrap>Sl No</td>
<td align='center' Class="rowpic" nowrap>Fee Name</td>
<td align='center' Class="rowpic" nowrap>Amount</td>
<?php
$fsq=execute("select catid,cat_name from fee_cat where status=1");
$ttlfamt=0;
$sno=1;
for($i=1;$i<=rowcount($fsq);$i++)
{
	$ff=fetcharray($fsq);
	$famt1="pdcat".$ff[0];
	$famt=$r[$famt1];
	if($famt>0)
	{
		if($sno<10)
			$sno="0".$sno;
		$ttlfamt+=$famt;
		?>
		<tr height='23'>
		<td align='center'><?=$sno?></td>
		<td nowrap>&nbsp;<?php echo $ff[1] ?></td>
		<td align='right' nowrap><?=$famt?>-00&nbsp;&nbsp;</td></tr>
		<?php
		$sno++;
	}
}
if($r[fnamt]>0)
{
	$ttlfamt+=$r[fnamt];
	echo "<tr><td colspan='2' align='right'>Fine&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right' nowrap>$r[fnamt]-00&nbsp;&nbsp;</td></tr>";
}
if($r[bfexeamt]>0)
{
	$ttlfamt-=$r[bfexeamt];
	echo "<tr><td colspan='2' align='right'>Old Execess Payment&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right' nowrap>- $r[bfexeamt]-00&nbsp;&nbsp;</td></tr>";
}
if($r[cexeamt]>0)
{
	$ttlfamt-=$r[cexeamt];
	echo "<tr><td colspan='2' align='right'>Old Execess Payment&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right' nowrap>- $r[cexeamt]-00&nbsp;&nbsp;</td></tr>";
}
if($r[pdamt]>$ttlfamt)
{
	if($r[exeamt]>0)
	{
		$ttlfamt+=$r[exeamt];
		echo "<tr><td colspan='2' align='right'>Excess Payment&nbsp;&nbsp;&nbsp;</td>";
		echo "<td align='right' nowrap>$r[exeamt]-00&nbsp;&nbsp;</td></tr>";	
	}
	if($r[cenamt]>0)
	{
		$ttlfamt-=$r[cenamt];
		echo "<tr><td colspan='2' align='right'>Concession Amount&nbsp;&nbsp;&nbsp;</td>";
		echo "<td align='right' nowrap>$r[cenamt]-00&nbsp;&nbsp;</td></tr>";
	}
}
echo "<tr><td colspan='2' align='right'>Paid Amount&nbsp;&nbsp;&nbsp;</td>";
echo "<td align='right' nowrap>$ttlfamt-00&nbsp;&nbsp;</td></tr>";
?>
</td></tr></table>
</table><br><br>
<div align="center"><input type="button" name='clse' value="<< Cancel Receipt >>" class='bgbutton' onclick="cancelrcpt()"></div>
<div id='1'><font color='brown'><b><< <a href='cancelfee1.php?stud_id=<?=$r[studid]?>'>BACK</a></b></font><div>
</form>
</body>
</html>