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
?>
<table class='forumline' border=1 align=center>
<tr height="30"><td align=center class=head colspan=4><font size='3'>CANCELLED FEE REPORT</font></TD></TR>
<tr height="25"><td align=center colspan=4><br>Program : <?=$rs[0]?> , Semester/Year : <?=$rs1[0]?></td></tr>
<tr height="25"><td align=center colspan=4><br>From : <?=$fmyr?> - To : <?=$toyr?></td></tr>
<tr height="25"><td align=center>Sl.No</td><td align=center>SR Number</td><td align=center>Name</td><td align=center>Amount</td></tr>
<?php
$sql=execute("select distinct(a.studid),b.student_id,b.first_name,b.last_name from fee_payment a,student_m b where a.pid='$pid' and a.sid='$sid' and a.ins_dt between '$fmyr1' and '$toyr1' and a.recptstatus=1 and a.studid=b.id order by b.first_name");
$sno=1;
$ttlamt=0;
while($r=fetcharray($sql))
{
	$sql1=fetcharray(execute("select sum(pdamt) from fee_payment where pid='$pid' and sid='$sid' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=1 and studid='$r[0]'"));
	$amt=number_format($sql1[0],2);
	if($sno<10)
		$sno="0".$sno;
	echo "<tr height='25'><td align='center'>$sno</td>";
	echo "<td>&nbsp;&nbsp;$r[1]</td>";
	echo "<td>&nbsp;&nbsp;$r[2] $r[3]</td>";
	echo "<td align='right'><a href='canfeerpt3.php?studid=$r[0]&pid=$pid&sid=$sid&fmyr1=$fmyr1&toyr1=$toyr1'>$amt</a></td></tr>";
	$sno++;
	$ttlamt+=$sql1[0];
}
$ttlamt=number_format($ttlamt,2)
?>
<tr><td align='right' colspan='3'>Total Amount&nbsp;&nbsp;</td><td align='right'><font color='blue'><b><?=$ttlamt?></b></font></td></tr>
</table><br>
<div id="prn" align="center"><input type="button" name="prnfeest" value="<< PRINT >>" onclick="prnfee()"></div>
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