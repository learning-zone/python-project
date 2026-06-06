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
	document.frm.action="canadmrpt2.php?branch=$branch&sem=$sem";
	document.frm.submit();
}
</SCRIPT>
</head>
<body>
<form name="frm" method="post">
<input type=hidden name='branch' value='<?=$branch?>'>
<input type=hidden name='sem' value='<?=$sem?>'>
<?php
$accyr=$curyr1;
$prmname=fetcharray(execute("select course_abbr from course_m where course_id='$branch'"));
$semname=fetcharray(execute("select year_name from course_year where year_id='$sem'"));
$sql="select a.mid,a.refamt,a.refmod,a.bkid,a.chno,a.chdt,b.student_id,b.first_name,b.last_name ";
$sql.="from refundfee a,student_m b where a.pid='$branch' and a.sid='$sem' and a.reftype=2 and a.accyr='$accyr' ";
$sql.="and a.studid=b.id and a.pid=b.course_admitted and a.sid=b.course_yearsem and b.archive='N' order by b.first_name";
$rs=execute($sql) or die(mysql_error());
if(rowcount($rs)==0)
{
	echo "<font color=brown><b>No Student Records !!</b></font>";
	die();
}
$cat=execute("select cat_name from fee_cat where status=1 order by catid");
$ncat=rowcount($cat);
$nt=$ncat+2;
for($i=1;$i<=$nt;$i++)
{
	$tl[$i]=0;
}
?>
<table border='1' class='forumline' align=center cellspacing='0' cellpadding='1'>
<tr><td align='center' class='head' colspan='2'><font size="4"><b>Admission Cancelled Report</b></font></td></tr>
<tr height='30'><td nowrap>&nbsp;&nbsp;Program : <?=$prmname[0]?></td><td nowrap>&nbsp;&nbsp;Semester : <?=$semname[0]?></td></tr>
<tr><td colspan='2'><table class='forumline' border='1' width='100%' cellspacing='0' cellpadding='1'>
<tr height='25'><td Class="rowpic" align='center' rowspan='2'>Sl.No</td><td Class="rowpic" align='center' nowrap rowspan='2'>SR Number</td><td Class="rowpic" align='center' nowrap rowspan='2'>Student Name</td>
<?php
for($i=0;$i<$ncat;$i++)
{
	$r=fetcharray($cat);
	$rr[$i]=$r[0];
	echo "<td Class='rowpic' align='center' rowspan='2'>$r[0]</td>";
}
?>
<td Class='rowpic' align='center' nowrap rowspan='2'>Total</td>
<td Class="rowpic" align='center' colspan='2'>Payment Details</td>
<td Class="rowpic" align='center' colspan='3'>Refund Details</td></tr>
<tr><td Class="rowpic" align='center' nowrap>Receipt No & Date</td>
<td Class="rowpic" align='center'>DD/Challan No,Date  & Amount</td>
<td Class="rowpic" align='center'>Cheque No</td>
<td Class="rowpic" align='center'>Cheque Date</td>
<td Class="rowpic" align='center'>Amount</td></tr>
<?php
for($i=0;$i<rowcount($rs);$i++)
{
	$r=fetcharray($rs);
	$sno=$i+1;
	if($sno<10)
		$sno="0".$sno;
	?>
	<tr height='23'><td align='center'><?=$sno?></td>
	<td>&nbsp;&nbsp;<?php echo $r[student_id] ?></td>
	<td nowrap>&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?php echo $r[last_name]?></td>
	<?php
	$feem=execute("select * from fee_master where id='$r[0]'");
	$f=fetcharray($feem);
	for($j=1;$j<=$ncat;$j++)
	{
		$pdttl[$j]=0;
	}
	$sql1=fetcharray(execute("select max(fee_id) from fee_type"));
	for($j=1;$j<=$sql1[0];$j++)
	{
		$catid=fetcharray(execute("select catid from fee_type where fee_id=$j"));
		$cid=$catid[0];
		$pamt="pfee".$j;
		$pdamt=$f[$pamt];
		$pdttl[$cid]+=$pdamt;
	}
	$ttlpd=0;
	for($j=1;$j<=$ncat;$j++)
	{
		$nn=$j;
		$amt=number_format($pdttl[$j],2);
		$ttlpd+=$pdttl[$j];
		$tl[$nn]+=$pdttl[$j];
		echo "<td align='right'>$amt</td>";
	}
	$nn++;
	$ttlpdamt=number_format($ttlpd,2);
	echo "<td align='right'>$ttlpdamt</td>";
	$tl[$nn]+=$ttlpd;

	$ff=execute("select docid,mop,bkid,ddno,pay_dt,pdamt,ins_dt from fee_payment where fmid='$f[0]' and recptstatus=0");
	$docid='';
	$dddt='';
	while($d=fetcharray($ff))
	{
		$indt=explode("-",$d[ins_dt]);
		$insdt=$indt[2]."/".$indt[1]."/".$indt[0];
		if($docid=='')
			$docid=$d[0].",".$insdt;
		else
			$docid=$docid."<br>".$d[0].",".$insdt;
		
		if($d[mop]==1)
		{
			if($dddt=='')
				$dddt="Cash-".$d[pdamt];
			else
				$dddt=$dddt."<br>Cash-".$d[pdamt];
		}
		else
		{
			if($dddt=='')
			{
				if($d[mop]==2)
					$dddt="DD-".$d[ddno]."/".$d[pdamt];
				else
					$dddt="CH-".$d[ddno]."/".$d[pdamt];
			}
			else
			{
				if($d[mop]==2)
					$dddt=$dddt."<br>DD-".$d[ddno]."/".$d[pdamt];
				else
					$dddt=$dddt."<br>CH-".$d[ddno]."/".$d[pdamt];
			}
		}
	}
	if($docid!='')
		echo "<td nowrap>$docid</td>";
	else
		echo "<td align='center'>----</td>";
	if($dddt!='')
		echo "<td nowrap>$dddt</td>";
	else
		echo "<td align='center'>----</td>";
	if($r[refmod]==1)
		echo "<td align='center' colspan='2'>Cash</td>";
	else
	{
		echo "<td align='center' nowrap>$r[chno]</td>";
		$chdt=explode("-",$r[chdt]);
		$chdtd=$chdt[2]."/".$chdt[1]."/".$chdt[0];
		echo "<td align='center' nowrap>$chdtd</td>";
	}
	$nn++;
	$tl[$nn]+=$r[refamt];
	$amt=number_format($r[refamt],2);
	echo "<td align='right'>$amt</td></tr>";
}
echo "<tr><td colspan='3' align='right'>Total&nbsp;&nbsp;&nbsp;</td>";
for($j=1;$j<$nt;$j++)
{
	if($tl[$j]>0)
	{
		$amt=number_format($tl[$j],2);
		echo "<td align='right'><font color='Blue'>$amt</font></td>";
	}
	else
		echo "<td align='center'>----</td>";
}
echo "<td colspan='4'>&nbsp;</td>";
if($tl[$nt]>0)
{
	$amt=number_format($tl[$nt],2);
	echo "<td align='right'><font color='Blue'>$amt</font></td>";
}
else
	echo "<td align='center'>----</td>";
echo "</tr></table>";
?>
</table><br>
<div id="prn" align="center"><input type="button" name="prnfeest" value="<< PRINT >>" onclick="prnfee()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" name="execelrpt" value="<< Export Excel >>" onclick="exportexl()"></div>
</form>
</body>
</html>