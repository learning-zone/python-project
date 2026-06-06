<html>
<head>
<?php
session_start();
include("../db.php");
?>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<SCRIPT LANGUAGE="JavaScript">
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=600,width=750,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function prnfee()
{
	prn.style.display = "none";
	window.print(this.form);
	prn.style.display = "";
}
</script>
</head>
<body>
<form name='frm' method='post'>
<?php
$fmyr=$cdt1." ".MonthName($cmt1)." ".$cyr1;
$toyr=$cdt2." ".MonthName($cmt2)." ".$cyr2;
$fmyr1=$cyr1."-".$cmt1."-".$cdt1;
$toyr1=$cyr2."-".$cmt2."-".$cdt2;
$dtdiff=date_diff($toyr1,$fmyr1,d);
if($dtdiff>=0)
{
	?>
	<table class='forumline' border=1 align=center>
	<tr height="30"><td align=center class=head colspan=7><font size='3'><u>FEE COLLECTION SUMMARY</u></font></TD></TR>
	<tr height="30"><td align=center colspan=7>From : <?=$fmyr?> - To : <?=$toyr?></TD></TR>
	<tr height="30"><td align=center>Sl.No</td><td align=center>Program</td><td align=center>Semester/Year</td><td align=center>Collected Amount</td><td align=center>Cancelled Amount</td><td align=center>Refunded Amount</td><td align=center>Net Collected Amount</td></tr>
	<?php
	$sql=execute("select course_id,course_abbr,head_id from course_m where status=1 order by head_id,course_id");
	$sno=1;
	$ttlamt1=0;
	$ttlamt2=0;
	$ttlamt3=0;
	$ttlamt=0;
	while($r=fetcharray($sql))
	{
		$sql1=execute("select year_id,year_name from course_year where head_id='$r[head_id]' and status=1 and year_id in (1,3,5,8)");
		while($r1=fetcharray($sql1))
		{
			$sql2=fetcharray(execute("select sum(pdamt) from fee_payment where pid='$r[0]' and sid='$r1[0]' and ins_dt between '$fmyr1' and '$toyr1' "));
			$amt=number_format($sql2[0],2);
			if($sno<10)
				$sno="0".$sno;
			echo "<tr height='30'><td align='center'>$sno</td>";
			echo "<td>&nbsp;&nbsp;$r[course_abbr]</td>";
			echo "<td>&nbsp;&nbsp;$r1[year_name]</td>";
			if($amt>0)
				echo "<td align='right'><a href=javascript:OpenWind('feesum2.php?pid=$r[0]&sid=$r1[0]&fmyr1=$fmyr1&toyr1=$toyr1')>$amt</a></td>";
			else
				echo "<td align='right'>----</td>";
			$ttlamt1+=$sql2[0];
			$sql3=fetcharray(execute("select sum(pdamt) from fee_payment where pid='$r[0]' and sid='$r1[0]' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=1"));
			$amt1=number_format($sql3[0],2);
			if($amt1>0)
				echo "<td align='right'><a href=javascript:OpenWind('canfeerpt2.php?pid=$r[0]&sid=$r1[0]&fmyr1=$fmyr1&toyr1=$toyr1')>$amt1</a></td>";
			else
				echo "<td align='right'>----</td>";
			$ttlamt2+=$sql3[0];
			$sql4=fetcharray(execute("select sum(refamt) from refundfee where pid='$r[0]' and sid='$r1[0]' and ins_dt between '$fmyr1' and '$toyr1'"));
			$amt2=number_format($sql4[0],2);
			if($amt2>0)
				echo "<td align='right'><a href=javascript:OpenWind('reffeerpt2.php?pid=$r[0]&sid=$r1[0]&fmyr1=$fmyr1&toyr1=$toyr1')>$amt2</a></td>";
			else
				echo "<td align='right'>----</td>";
			$ttlamt3+=$sql4[0];
			$netcol=$sql2[0]-$sql3[0]-$sql4[0];
			$ttlamt+=$netcol;
			$netcol=number_format($netcol,2);
			if($netcol>0)
				echo "<td align='right'><font color='blue'><b>$netcol</b></font></td></tr>";
			else
				echo "<td align='right'>----</td></tr>";
			$sno++;
		}
	}
	$ttlamt=number_format($ttlamt,2);
	$ttlamt1=number_format($ttlamt1,2);
	$ttlamt2=number_format($ttlamt2,2);
	$ttlamt3=number_format($ttlamt3,2);
		?>
		<tr><td align='right' colspan='3'>Total Amount&nbsp;&nbsp;</td><td align='right'><font color='blue'><b><?=$ttlamt1?></b></font></td><td align='right'><font color='blue'><b><?=$ttlamt2?></b></font></td><td align='right'><font color='blue'><b><?=$ttlamt3?></b></font></td><td align='right'><font color='blue'><b><?=$ttlamt?></b></font></td></tr>
		</table><br>
		<div id="prn" align="center"><input type="button" name="prnfeest" value="<< PRINT >>" onclick="prnfee()"></div>
		<?php
}
else
	echo "<font color='red' size='3'><b>Invalid date selection....</b></font>";
function MonthName($mon)
{
        if($mon == 1) return("Jan");
        if($mon == 2) return("Feb");
        if($mon == 3) return("Mar");
        if($mon == 4) return("Apr");
        if($mon == 5) return("May");
        if($mon == 6) return("Jun");
        if($mon == 7) return("Jul");
        if($mon == 8) return("Aug");
        if($mon == 9) return("Sep");
        if($mon == 10) return("Oct");
        if($mon == 11) return("Nov");
        if($mon == 12) return("Dec");
}
?>
</form>
</body>
</html>