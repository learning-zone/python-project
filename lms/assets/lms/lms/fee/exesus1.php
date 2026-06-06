<html>
<head>
<?php
session_start();
include("../db.php");
?>
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
if($pid>0)
{
	$rs=fetcharray(execute("select coursename from course_m where course_id='$pid'"));
	$strmname=fetcharray(execute("select year_name from course_year where year_id='$stmid'"));
	?>
	<table class='forumline' border=1 align=center>
	<tr height="30"><td align=center class=head colspan=4><font size='3'>EXCESS PAYMENT REPORT</font></TD></TR>
	<tr height="25"><td align=center colspan=4><b>&nbsp;&nbsp;Course : <?=$rs[0]?> - <?=$strmname[0]?></b></td></tr>
	<tr height="25"><td class='row3' align=center>Sl.No</td><td class='row3' align=center>Student ID</td><td class='row3' align=center>Student Name</td><td class='row3' align=center nowrap>Excess Amount</td></tr>
	<?php
	$sql=execute("select a.id,a.exeamt,b.student_id,b.first_name,b.last_name from fee_master a,student_m b where a.pid='$pid' and a.sid='$stmid' and a.exeamt>0 and a.status=0 and a.studid=b.id order by b.first_name");
	$sno=1;
	$ttlamt=0;
	while($r=fetcharray($sql))
	{
		$amt=number_format($r[1],0);
		if($sno<10)
			$sno="0".$sno;
		echo "<tr height='25'><td align='center'>$sno</td>";
		echo "<td>&nbsp;&nbsp;$r[2]</td>";
		echo "<td>&nbsp;&nbsp;$r[3] $r[4] $r[5]</td>";
		if($amt>0)
			echo "<td align='right'><b>$amt&nbsp;&nbsp;</b></td></tr>";
		else
			echo "<td align='center'>---</td></tr>";
		$sno++;
		$ttlamt+=$r[1];
	}
	$ttlamt=number_format($ttlamt,0)
	?>
	<tr><td align='right' colspan='3'>Total Amount in <?=$rs2[0]?>&nbsp;&nbsp;</td><td align='right'><font color='blue'><b><?=$ttlamt?>&nbsp;&nbsp;</b></font></td></tr>
	</table><br><br>
	<?php
}
else
{
	$sql=execute("select distinct(a.pid),a.sid,b.coursename,c.year_name from fee_master a,course_m b,course_year c where a.exeamt>0 and a.status=0 and a.pid=b.course_id and a.sid=c.year_id order by a.pid,a.sid");
	?>
	<table class='forumline' border=1 align=center>
	<tr height="30"><td align=center class=head colspan=4><font size='3'>EXCESS PAYMENT REPORT</font></TD></TR>
	<?php
	$gttlamt=0;
	while($r=fetcharray($sql))
	{
		?>
		<tr><td colspan='4' nowrap><font color='blue'><b>&nbsp;&nbsp;<?=$r[2]?> - <?=$r[3]?></b></font></td></tr>
		<tr height="25"><td class='row3' align=center>Sl.No</td><td class='row3' align=center>Student ID</td><td class='row3' align=center>Student Name</td><td class='row3' align=center nowrap>Excess Amount</td></tr>
		<?php
		$sql5=execute("select a.id,a.exeamt,b.student_id,b.first_name,b.last_name from fee_master a,student_m b where a.pid='$r[0]' and a.sid='$r[1]' and a.exeamt>0 and a.status=0 and a.studid=b.id order by b.first_name");
		$sno=1;
		$ttlamt=0;
		while($r1=fetcharray($sql5))
		{
			$amt=number_format($r1[1],0);
			if($sno<10)
				$sno="0".$sno;
			echo "<tr height='25'><td align='center'>$sno</td>";
			echo "<td>&nbsp;&nbsp;$r1[2]</td>";
			echo "<td>&nbsp;&nbsp;$r1[3] $r1[4] $r1[5]</td>";
			if($amt>0)
				echo "<td align='right'><b>$amt&nbsp;&nbsp;</b></td></tr>";
			else
				echo "<td align='center'>---</td></tr>";
			$sno++;
			$ttlamt+=$r1[1];
		}
		$gttlamt+=$ttlamt;
		$ttlamt=number_format($ttlamt,0)
		?>
		<tr><td align='right' colspan='3'>Total Amount&nbsp;&nbsp;</td><td align='right'><font color='blue'><b><?=$ttlamt?>&nbsp;&nbsp;</b></font></td></tr>
		<?php
	}
	$gttlamt=number_format($gttlamt)
	?>
	<tr><td class='row3' colspan='4'>&nbsp;</td></tr>
	<tr><td align='right' colspan='3'><font color='red'><b>Grand Total Amount in <?=$rs2[0]?>&nbsp;&nbsp;</b></font></td><td align='right'><font color='blue'><b><?=$gttlamt?>&nbsp;&nbsp;</b></font></td></tr>
	</table><br><br>
	<?php
}
?>
<div id="prn" align="center"><input type="button" name="prnfeest" value="<< PRINT >>" onclick="prnfee()"></div>
</form>
</body>
</html>
