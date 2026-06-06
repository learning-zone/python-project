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
$rs3=fetcharray(execute("select max(catid) from fee_cat"));
$cnt=$rs3[0]+7;
$c=$rs3[0]+5;
for($i=1;$i<=$c;$i++)
{
	$gdttl[$i]=0;
}
?>
<table class='forumline' border=1 align=center>
<tr height="30"><td align=center class=head colspan=<?=$cnt?>><font size='3'>CANCELLED FEE REPORT</font></TD></TR>
<tr height="25"><td align=center colspan=<?=$cnt?>><br>Program : <?=$rs[0]?> , Semester/Year : <?=$rs1[0]?></td></tr>
<tr height="25"><td align=center colspan=<?=$cnt?>><br>SR Number : <?=$rs2[0]?> , Name : <?=$rs2[1]?> <?=$rs2[2]?></td></tr>
<tr height="25"><td align=center colspan=<?=$cnt?>><br>From : <?=$fmyr?> - To : <?=$toyr?></td></tr>
<tr height="25"><td align=center rowspan='2'>Sl.No</td><td align=center rowspan='2'>Receipt No.</td><td align=center colspan=<?=$rs3[0]?>>Fee Category</td><td align=center rowspan='2'>BF Excess</td>
<td align=center rowspan='2'>Fine</td><td align=center rowspan='2'>Cons</td>
<td align=center rowspan='2'>Excess</td><td align=center rowspan='2'>Total Paid</td></tr>
<tr>
<?php
$rs3=execute("select * from fee_cat order by catid");
$rcnt=rowcount($rs3);
for($i=1;$i<=$rcnt;$i++)
{
	$r=fetcharray($rs3);
	echo "<td align=center>$r[cat_name]</td>";
}
echo "</tr>";
$sql=execute("select * from fee_payment where pid='$pid' and sid='$sid' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=1 and studid='$studid' order by id");
$sno=1;
while($r=fetcharray($sql))
{
	$ttlamt=0;
	for($i=1;$i<=$rcnt;$i++)
	{
		$catamt[$i]=0;
	}
	$amt=number_format($sql1[0],2);
	if($sno<10)
		$sno="0".$sno;
	echo "<tr height='25'><td align='center'>$sno</td>";
	echo "<td>&nbsp;&nbsp;$r[docid]</td>";
	for($i=1;$i<=$r[noffeetype];$i++)
	{
		$fid="fid".$i;
		$fid=$r[$fid];
		$famt="famt".$i;
		$famt=$r[$famt];
		$qry=fetcharray(execute("select catid from fee_type where fee_id='$fid'"));
		$cat=$qry[0];
		$catamt[$cat]+=$famt;
	}
	for($i=1;$i<=$rcnt;$i++)
	{
		if($catamt[$i]>0)
		{
			$ttlamt+=$catamt[$i];
			$gdttl[$i]+=$catamt[$i];
			echo "<td align='right'>$catamt[$i]</td>";
		}
		else
			echo "<td align='right'>---</td>";
	}
	if($r[bfexeamt]>0)
	{
		$ttlamt-=$r[bfexeamt];
		$gdttl[$i]+=$r[bfexeamt];
		echo "<td align='right'>$r[bfexeamt]</td>";
	}
	else
		echo "<td align='right'>---</td>";
	$i++;
	if($r[fnamt]>0)
	{
		$ttlamt+=$r[fnamt];
		$gdttl[$i]+=$r[fnamt];
		echo "<td align='right'>$r[fnamt]</td>";
	}
	else
		echo "<td align='right'>---</td>";
	$i++;
	if($r[pdamt]>$ttlamt)
	{
		if($r[cenamt]>0)
		{
			$ttlamt-=$r[cenamt];
			$gdttl[$i]+=$r[cenamt];
			echo "<td align='right'>$r[cenamt]</td>";
		}
		else
			echo "<td align='right'>---</td>";
		$i++;
		if($r[exeamt]>0)
		{
			$ttlamt+=$r[exeamt];
			$gdttl[$i]+=$r[exeamt];
			echo "<td align='right'>$r[exeamt]</td>";
		}
		else
			echo "<td align='right'>---</td>";
	}
	else
	{
		echo "<td align='right'>---</td>";
		$i++;
		echo "<td align='right'>---</td>";
	}
	$i++;
	$gdttl[$i]+=$ttlamt;
	echo "<td align='right'>$ttlamt</td></tr>";
	$sno++;
}
?>
<tr><td align='right' colspan='2'>Grand Total&nbsp;&nbsp;</td>
<?php
for($i=1;$i<=$c;$i++)
{
	echo "<td align='right'><font color='blue'><b>$gdttl[$i]</b></font></td>";
}
?>
</tr>
</table><br>
<div id="prn" align="center"><input type="button" name="prnfeest" value="<< PRINT >>" onclick="prnfee()"></div>
<div id='1'><font color='brown'><b><< <a href='canfeerpt2.php?pid=<?=$pid?>&sid=<?=$sid?>&fmyr1=<?=$fmyr1?>&toyr1=<?=$toyr1?>'>BACK</a></b></font><div>
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