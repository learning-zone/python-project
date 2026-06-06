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
$rs=fetcharray(execute("select course_abbr from course_m where course_id='$pid'"));
$rs1=fetcharray(execute("select year_name from course_year where year_id='$sid'"));
?>
<table class='forumline' border=1 align=center>
<tr height="30"><td align=center class=head colspan=5><font size='3'>FEE DUE REPORT</font></TD></TR>
<tr height="25"><td align=center colspan=5><br>Program : <?=$rs[0]?> , Semester/Year : <?=$rs1[0]?></td></tr>
<tr height="25"><td align=center>Sl.No</td><td align=center>SR Number</td><td align=center>Name</td><td align=center>Due Amount</td><td align=center>Present Sem/Year</td></tr>
<?php
$sql=execute("select a.id,a.balamt,b.student_id,b.first_name,b.last_name,b.course_yearsem from fee_master a,student_m b where a.pid='$pid' and a.sid='$sid' and a.pstatus=1 and a.status=0 and a.studid=b.id order by b.course_yearsem,b.first_name");
$sno=1;
$ttlamt=0;
while($r=fetcharray($sql))
{
	$amt=number_format($r[1],2);
	if($sno<10)
		$sno="0".$sno;
	echo "<tr height='25'><td align='center'>$sno</td>";
	echo "<td>&nbsp;&nbsp;$r[2]</td>";
	echo "<td>&nbsp;&nbsp;$r[3] $r[4]</td>";
	echo "<td align='right'><a href='duerpt2.php?mid=$r[0]'>$amt</a></td>";
	$semname=fetcharray(execute("select year_name from course_year where year_id='$r[5]'"));
	echo "<td>&nbsp;&nbsp;$semname[0]</td></tr>";
	$sno++;
	$ttlamt+=$r[1];
}
$ttlamt=number_format($ttlamt,2)
?>
<tr><td align='right' colspan='3'>Total Amount&nbsp;&nbsp;</td><td align='right'><font color='blue'><b><?=$ttlamt?></b></font></td><td>&nbsp;</td></tr>
</table><br>
<div id="prn" align="center"><input type="button" name="prnfeest" value="<< PRINT >>" onclick="prnfee()"></div>
</form>
</body>
</html>