<html>
<head>
<?php
session_start();
include("../db.php");
include("../urlaccess.php");
?>
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
}
</script>
</head>
<body>
<form name='frm' method='post'>
<?php
$sql=execute("select distinct(a.pid),a.sid,b.coursename,c.year_name from fee_master a,course_m b,course_year c where a.exeamt>0 and a.status=0 and a.pid=b.course_id and a.sid=c.year_id order by a.pid,a.sid");

if(rowcount($sql)>0)
{
	?>
	<table class='forumline' border=1 align=center width='70%'>
	<tr height="30"><td align=center class=head colspan='4'><font size='3'>EXCESS PAYMENT REPORT</font></TD></TR>
	<tr height="30"><td class='row3' align=center >Sl.No</td><td class='row3' align=center >Course</td>
<td class='row3' align=center >Semester</td><td class='row3' align=center>Excess Amount</td></tr>
	<?php
	$sno=1;
	$ttl=0;
	while($r=fetcharray($sql))
	{
		if($sno<10)
			$sno="0".$sno;
		echo "<tr height='30'><td align='center'>$sno</td>";
		echo "<td nowrap>&nbsp;&nbsp;$r[2]</td>";
		echo "<td nowrap>&nbsp;&nbsp;$r[3]</td>";
		$sql1=fetcharray(execute("select sum(a.exeamt) from fee_master a,student_m b where a.pid='$r[0]' and a.sid='$r[1]' and a.exeamt>0 and a.status=0 and a.studid=b.id"));
			$amt=$sql1[0];
			if($amt>0)
			{
				echo "<td align='right'><a href=javascript:OpenWind('exesus1.php?pid=$r[0]&stmid=$r[1]')><b>".number_format($amt,0)."</b></a>&nbsp;&nbsp;</td>";
				$ttl+=$amt;
			}
			else
				echo "<td align='center'>---</td>";
		echo "</tr>";
		$sno++;
	}
	echo "<tr><td align='right' colspan='3'>Total Amount&nbsp;&nbsp;</td>";
	if($ttl>0)
	echo "<td align='right'><a href=javascript:OpenWind('exesus1.php?pid=0')><font color='blue'><b>".number_format($ttl,0)."</b></font></a>&nbsp;&nbsp;</td>";
		else
			echo "<td align='center'>---</td>";
	echo "</tr>";
	?>
	</table><br>
	<div id="prn" align="center"><input type="button" name="prnfeest" value="<< PRINT >>" onclick="prnfee()"></div>
	<?php
}
else
	echo "<font color='blue' size='3'><b>No Excess Payments ...</b></font>";
?>
</form>
</body>
</html>
