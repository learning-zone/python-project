<html>
<head>
<?php
session_start();
include("../db.php");
?>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<SCRIPT LANGUAGE="JavaScript">
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
$fmyear=explode("-",$fmyr1);
$fmyr=$fmyear[2]."-".MonthName($fmyear[1])."-".$fmyear[0];
$toyear=explode("-",$toyr1);
$toyr=$toyear[2]."-".MonthName($toyear[1])."-".$toyear[0];
$rs=fetcharray(execute("select course_abbr from course_m where course_id='$pid'"));
$rs1=fetcharray(execute("select year_name from course_year where year_id='$sid'"));
$rs2=fetcharray(execute("select student_id,first_name,last_name from student_m where id='$studid'"));
?>
<table class='forumline' border=1 align=center>
<tr height="30"><td align=center class=head colspan='6'><font size='3'>REFUNDED FEE REPORT</font></TD></TR>
<tr height="25"><td align=center colspan='6'><br>Program : <?=$rs[0]?> , Semester/Year : <?=$rs1[0]?></td></tr>
<tr height="25"><td align=center colspan='6'><br>SR Number : <?=$rs2[0]?> , Name : <?=$rs2[1]?> <?=$rs2[2]?></td></tr>
<tr height="25"><td align=center colspan='6'><br>From : <?=$fmyr?> - To : <?=$toyr?></td></tr>
<tr height="25"><td align=center>Sl.No</td><td align=center>Refund Type</td><td align=center>Refund Amonut</td><td align=center>Refund Charges</td><td align=center>Refunded Amount</td><td align=center>Refund Details</td></tr>
<?php
$sql=execute("select * from refundfee where pid='$pid' and sid='$sid' and ins_dt between '$fmyr1' and '$toyr1' and studid='$studid'");
$ttl1=0;
$ttl2=0;
$ttl3=0;
$sno=1;
while($r=fetcharray($sql))
{
	if($sno<10)
		$sno="0".$sno;
	echo "<tr><td align='center'>$sno</td>";
	if($r[reftype]==1)
		$reftype="Advance Fees";
	elseif($r[reftype]==2)
		$reftype="Cancelled Admission";
	elseif($r[reftype]==3)
		$reftype="Execess Payment";
	elseif($r[reftype]==4)
		$reftype="Scholarship Payment";
	echo "<td>&nbsp;&nbsp$reftype</td>";
	$refamt=number_format(($r[refchg]+$r[refamt]),2);
	$ttl1+=$r[refchg]+$r[refamt];
	echo "<td align='right'>$refamt</td>";
	$refch=number_format($r[refchg],2);
	$ttl2+=$r[refchg];
	echo "<td align='right'>$refch</td>";
	$refd=number_format($r[refamt],2);
	$ttl3+=$r[refamt];
	echo "<td align='right'>$refd</td>";
	if($r[refmod]==1)
		$refmode="Cash";
	elseif($r[refmod]==2)
	{
		$rs=fetcharray(execute("select bank_name from bank_details where id=$r[bkid]"));
		$chdt=explode("-",$r[chdt]);
		$chdt=$chdt[2]."-".MonthName($chdt[1])."-".$chdt[0];
		$refmode="Bank Cheque, ".$rs[0].", ".$r[chno].", ".$chdt;
	}
	echo "<td>&nbsp;&nbsp$refmode</td></tr>";
	$sno++;
}
$ttl1=number_format($ttl1,2);
$ttl2=number_format($ttl2,2);
$ttl3=number_format($ttl3,2);
echo "<tr><td colspan='2' align='right'>Total Amount&nbsp;&nbsp;</td>";
echo "<td align='right'><font color='blue'><b>$ttl1</b></font></td>";
echo "<td align='right'><font color='blue'><b>$ttl2</b></font></td>";
echo "<td align='right'><font color='blue'><b>$ttl3</b></font></td>";
echo "<td>&nbsp;</td></tr>";
?>
</table><br>
<div id="prn" align="center"><input type="button" name="prnfeest" value="<< PRINT >>" onclick="prnfee()"></div>
<div id='1'><font color='brown'><b><< <a href='reffeerpt2.php?pid=<?=$pid?>&sid=<?=$sid?>&fmyr1=<?=$fmyr1?>&toyr1=<?=$toyr1?>'>BACK</a></b></font><div>
<?php
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