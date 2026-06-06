<html>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<?php
	session_start();
	include("../db.php");
?>
<SCRIPT LANGUAGE="JavaScript">
function prnfee()
{
	prn.style.display = "none";
	window.print(this.form);
	prn.style.display = " ";
}
function exportexl()
{
	document.frm.action="bankddfee2.php?branch=$branch&sem=$sem&sect=$sect";
	document.frm.submit();
}
</SCRIPT>
</head>
<body>
<form name="frm" method="post">
<input type=hidden name='branch' value='<?=$branch?>'>
<input type=hidden name='sem' value='<?=$sem?>'>
<input type=hidden name='sect' value='<?=$sect?>'>
<?php
$cyr1=$curyr1;
$prmname=fetcharray(execute("select course_abbr from course_m where course_id='$branch'"));
$semname=fetcharray(execute("select year_name from course_year where year_id='$sem'"));
if($sect==0)
	$sectname="No Section";
else
{
	$rs3=fetcharray(execute("select section_name from class_section where id='$sect'"));
	$sectname=$rs3[0]." - Section";
}
$sql="select distinct(b.bkid) from student_m a,fee_payment b where a.course_admitted='$branch' and a.course_yearsem='$sem' ";
$sql.="and a.class_section_id='$sect' and a.archive='N' and a.course_admitted=b.pid and b.mop=2 and a.id=b.studid and b.accyr='$cyr1' order by b.bkid ";
$rs=execute($sql) or die(mysql_error());
if(rowcount($rs)==0)
{
	echo "<font color=brown><b>No DD Payment..!!</b></font>";
	die();
}
else
{
	?>
	<table border='0' class='forumline' align=center cellspacing='0' cellpadding='0'>
	<tr><td align='center' class='head' colspan='3'><font size="4"><b>Bank Demand Draft Report</b></font></td></tr>
	<tr height='30'><td nowrap>&nbsp;&nbsp;Program : <?=$prmname[0]?></td><td nowrap>&nbsp;&nbsp;Semester : <?=$semname[0]?></td>
	<td nowrap>&nbsp;&nbsp;Section : <?=$sectname?></td></tr>
	<?php
	$no=1;
	while($r=fetcharray($rs))
	{
		$sql1=fetcharray(execute("select bank_name from bank_details where id='$r[0]'"));
		?>
		<tr><td colspan='3'><table class='forumline' border='1' width='100%' cellspacing='0' cellpadding='1'>
		<tr><td colspan='7'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='brown'><b><?=$sql1[0]?></b></font></tr>
		<tr height='25'><td Class="rowpic" align='center'>Sl.No</td><td Class="rowpic" align='center' nowrap>SR Number</td><td Class="rowpic" align='center' nowrap>Student Name</td><td Class="rowpic" align='center' nowrap>Demand Draft No</td><td Class="rowpic" align='center' nowrap>Demand Draft Date</td><td Class="rowpic" align='center' nowrap>Amount</td><td Class="rowpic" align='center' nowrap>Deposited Date</td></tr>	
		<?php
		$sql2="select a.student_id,a.first_name,a.last_name,b.ddno,b.pay_dt,b.pdamt from student_m a, fee_payment b where a.archive='N' ";
		$sql2.="and a.course_admitted='$branch' and a.course_yearsem='$sem' and a.class_section_id='$sect' and a.course_admitted=b.pid ";
		$sql2.="and b.mop=2 and a.id=b.studid and b.bkid='$r[0]' and b.accyr='$cyr1' order by a.first_name";
		$rs1=execute($sql2) or die(mysql_error());
		$sno=1;
		$ttlamt=0;
		while($r1=fetcharray($rs1))
		{
			if($sno<10)
				$sno="0".$sno;
			echo "<tr><td align='center' width='2%'>$sno</td>";
			echo "<td width='10%'>&nbsp;&nbsp;$r1[0]</td>";
			echo "<td width='35%'>&nbsp;&nbsp;$r1[1] $r1[2]</td>";
			echo "<td width='15%'>&nbsp;&nbsp;$r1[3]</td>";
			$dd=explode("-",$r1[4]);
			$dddt=$dd[2]." ".MonthName($dd[1])." ".$dd[0];
			echo "<td width='15%'>&nbsp;&nbsp;$dddt</td>";
			$amt=number_format($r1[5],2);
			$ttlamt+=$r1[5];
			echo "<td align='right' width='15%'>&nbsp;&nbsp;$amt</td>";
			echo "<td width='8%'>&nbsp;&nbsp;</td></tr>";
			$sno++;
			$no++;
		}
		$amt=number_format($ttlamt,2);
		$gdttl+=$ttlamt;
		echo "<tr><td align='right' colspan='5'><b>Total Amount</b>&nbsp;&nbsp;</td><td align='right'>$amt</td>";
		echo "<td>&nbsp;</td></tr></table></td></tr>";
	}
	$amt=number_format($gdttl,2);
	echo "<tr><td align='right' colspan='2'><font color='red'><b>Grand Total : Rs.</b></font></td><td><font color='red'><b>$amt</b></font></td></tr>";
	echo "</table><br><br>";
}
?>
<div id="prn" align="center"><input type="button" name="prnfeest" value="<< PRINT >>" onclick="prnfee()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" name="execelrpt" value="<< Export Excel >>" onclick="exportexl()"></div>
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