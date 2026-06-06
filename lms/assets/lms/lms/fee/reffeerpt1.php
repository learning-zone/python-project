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
	$sql=execute("select distinct(a.pid),a.sid,b.course_abbr,c.year_name from refundfee a,course_m b,course_year c where a.ins_dt between '$fmyr1' and '$toyr1' and a.pid=b.course_id and a.sid=c.year_id order by a.pid,a.sid");

	if(rowcount($sql)>0)
	{
		?>
		<table class='forumline' border=1 align=center>
		<tr height="30"><td align=center class=head colspan=4><font size='3'><u>REFUNDED FEE REPORT</u></font><br>From : <?=$fmyr?> - To : <?=$toyr?></TD></TR>
		<tr height="30"><td align=center>Sl.No</td><td align=center>Program</td><td align=center>Semester/Year</td><td align=center>Amount</td></tr>
		<?php
		$sno=1;
		$ttlamt=0;
		while($r=fetcharray($sql))
		{
			$sql1=fetcharray(execute("select sum(refamt) from refundfee where pid='$r[0]' and sid='$r[1]' and ins_dt between '$fmyr1' and '$toyr1'"));
			$amt=number_format($sql1[0],2);
			if($sno<10)
				$sno="0".$sno;
			echo "<tr height='30'><td align='center'>$sno</td>";
			echo "<td>&nbsp;&nbsp;$r[course_abbr]</td>";
			echo "<td>&nbsp;&nbsp;$r[year_name]</td>";
			echo "<td align='right'><a href=javascript:OpenWind('reffeerpt2.php?pid=$r[0]&sid=$r[1]&fmyr1=$fmyr1&toyr1=$toyr1')>$amt</a></td></tr>";
			$sno++;
			$ttlamt+=$sql1[0];
		}
		$ttlamt=number_format($ttlamt,2);
		?>
		<tr><td align='right' colspan='3'>Total Amount&nbsp;&nbsp;</td><td align='right'><font color='blue'><b><?=$ttlamt?></b></font></td></tr>
		</table><br>
		<div id="prn" align="center"><input type="button" name="prnfeest" value="<< PRINT >>" onclick="prnfee()"></div>
		<?php
	}
	else
		echo "<font color='blue' size='3'><b>Fees not colleted between $fmyr to $toyr ....</b></font>";
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