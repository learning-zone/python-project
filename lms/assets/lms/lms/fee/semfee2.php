<?php
$cdt=date("d-m-Y");
$fname="Fee_Report_".$cdt.".xls";
include("../db1.php");
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=$fname");

$prmname=fetcharray(execute("select course_abbr from course_m where course_id='$branch'"));
$semname=fetcharray(execute("select year_name from course_year where year_id='$sem'"));
if($sect==0)
	$sectname="No Section";
else
{
	$rs3=fetcharray(execute("select section_name from class_section where id='$sect'"));
	$sectname=$rs3[0]." - Section";
}
$sql="select id,student_id,first_name,last_name from student_m where archive='N'";
$sql.=" and course_admitted='$branch' and course_yearsem='$sem' and class_section_id='$sect'";
$sql.=" order by first_name";
$rs=execute($sql) or die(mysql_error());
if(rowcount($rs)==0)
{
	echo "<font color=brown><b>No Student Records !!</b></font>";
	die();
}
$cat=execute("select cat_name from fee_cat where status=1");
$ncat=rowcount($cat);
$nocat=$ncat+1;
$nt=$nocat*2+3;
for($i=1;$i<=$nt;$i++)
{
	$tl[$i]=0;
}
?>
<table border='1' class='forumline' align=center cellspacing='0' cellpadding='1'>
<tr><td align='center' class='head' colspan='3'><font size="4"><b>Semester wise Fee Report</b></font></td></tr>
<tr height='30'><td nowrap>&nbsp;&nbsp;Program : <?=$prmname[0]?></td><td nowrap>&nbsp;&nbsp;Semester : <?=$semname[0]?></td>
<td nowrap>&nbsp;&nbsp;Section : <?=$sectname?></td></tr>
<tr><td colspan='3'><table class='forumline' border='1' width='100%' cellspacing='0' cellpadding='1'>
<tr height='25'><td Class="rowpic" align='center' rowspan='2'>Sl.No</td><td Class="rowpic" align='center' rowspan='2' nowrap>SR Number</td><td Class="rowpic" align='center' rowspan='2' nowrap>Student Name</td><td Class="rowpic" align='center' colspan=<?=$nocat?> nowrap>Demanded</td><td Class="rowpic" align='center' colspan=<?=$nocat?> nowrap>Paid</td><td Class="rowpic" align='center' rowspan='2' nowrap>Concession</td><td Class="rowpic" align='center' rowspan='2' nowrap>Balance</td><td Class="rowpic" align='center' rowspan='2' nowrap>Excess</td><td Class="rowpic" align='center' rowspan='2' nowrap>Recipt No & Date</td><td Class="rowpic" align='center' rowspan='2' nowrap>Payment Details</td></tr>
<?php
for($i=0;$i<$ncat;$i++)
{
	$r=fetcharray($cat);
	$rr[$i]=$r[0];
	echo "<td Class='rowpic' align='center' nowrap>$r[0]</td>";
}
echo "<td Class='rowpic' align='center' nowrap>Total DMD</td>";
for($i=0;$i<$ncat;$i++)
{
	echo "<td Class='rowpic' align='center' nowrap>$rr[$i]</td>";
}
echo "<td Class='rowpic' align='center' nowrap>Total PD</td>";
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
	$feem=execute("select * from fee_master where studid='$r[0]' and pid='$branch' and sid='$sem' and status=0");
	if(rowcount($feem)>0)
	{
		$f=fetcharray($feem);
		for($j=1;$j<=$ncat;$j++)
		{
			$dmdttl[$j]=0;
			$pdttl[$j]=0;
		}
		$sql1=fetcharray(execute("select max(fee_id) from fee_type"));
		for($j=1;$j<=$sql1[0];$j++)
		{
			$catid=fetcharray(execute("select catid from fee_type where fee_id=$j"));
			$cid=$catid[0];
			$damt="dfee".$j;
			$dmdamt=$f[$damt];
			$pamt="pfee".$j;
			$pdamt=$f[$pamt];
			$dmdttl[$cid]+=$dmdamt;
			$pdttl[$cid]+=$pdamt;
		}
		$ttldmd=0;
		for($j=1;$j<=$ncat;$j++)
		{
			$amt=number_format($dmdttl[$j],2);
			$ttldmd+=$dmdttl[$j];
			$tl[$j]+=$dmdttl[$j];
			echo "<td align='right'>$amt</td>";
		}
		$nn=$j;
		$tl[$nn]+=$ttldmd;
		$ttldmdamt=number_format($ttldmd,2);
		echo "<td align='right'>$ttldmdamt</td>";
		$ttlpd=0;
		for($j=1;$j<=$ncat;$j++)
		{
			$amt=number_format($pdttl[$j],2);
			$ttlpd+=$pdttl[$j];
			$nn++;
			$tl[$nn]+=$pdttl[$j];
			echo "<td align='right'>$amt</td>";
		}
		$nn++;
		$tl[$nn]+=$ttlpd;
		$ttlpdamt=number_format($ttlpd,2);
		echo "<td align='right'>$ttlpdamt</td>";
		$nn++;
		if($f[cenamt]>0)
		{
			$conamt=number_format($f[cenamt],2);
			echo "<td align='right'>$conamt</td>";
			$tl[$nn]+=$f[cenamt];
			
		}
		else
			echo "<td align='center'>----</td>";
		$nn++;
		$bb=$nn;
		if($f[balamt]>0)
		{
			$balamt=number_format($f[balamt],2);
			echo "<td align='right'><font color='red'>$balamt</font></td>";
			echo "<td align='center'>----</td>";
			$tl[$nn]+=$f[balamt];
			$nn++;
		}
		else
		{
			echo "<td align='center'>----</td>";
			$nn++;
			if($f[exeamt]>0)
			{
				$exeamt=number_format($f[exeamt],2);
				echo "<td align='right'><font color='green'>$exeamt</font></td>";
				$tl[$nn]+=$f[exeamt];
			}
			else
				echo "<td align='center'>----</td>";
		}
		$ff=execute("select docid,mop,bkid,ddno,pay_dt from fee_payment where fmid='$f[0]' and recptstatus=0");
		$docid='';
		$bkdt='';
		while($d=fetcharray($ff))
		{
			if($docid=='')
				$docid=$d[0]." ".$docdt;
			else
				$docid=$docid."<br>".$d[0];
			
			if($d[mop]==1)
			{
				if($bkdt=='')
					$bkdt="Cash";
				else
					$bkdt=$bkdt."<br>Cash";
			}
			else
			{
				$dd=fetcharray(execute("select bank_name from bank_details where id='$d[bkid]'"));
				$ddt=explode("-",$d[pay_dt]);
				$dddt=$ddt[2]."/".$ddt[1]."/".$ddt[0];
				if($bkdt=='')
					$bkdt=$dd[0]." ".$d[ddno]." ".$dddt;
				else
					$bkdt=$bkdt."<br>".$dd[0]." ".$d[ddno]." ".$dddt;
			}
		}
		if($docid!='')
			echo "<td>$docid</td>";
		else
			echo "<td align='center'>----</td>";
		if($bkdt!='')
			echo "<td>$bkdt</td></tr>";
		else
			echo "<td align='center'>----</td></tr>";
	}
	else
	{
		$keyno=($nocat*2)+5;
		for($j=0;$j<$keyno;$j++)
		{
			echo "<td align='center'>----</td>";
		}
		echo "</tr>";
	}
}
echo "<tr><td colspan='3' align='right'>Total&nbsp;&nbsp;&nbsp;</td>";
for($j=1;$j<=$nn;$j++)
{
	if($tl[$j]>0)
	{
		$amt=number_format($tl[$j],2);
		if($bb==$j)
			echo "<td align='right'><font color='red'>$amt</font></td>";
		elseif(($bb+1)==$j)
			echo "<td align='right'><font color='green'>$amt</font></td>";
		else
			echo "<td align='right'><font color='Blue'>$amt</font></td>";
	}
	else
		echo "<td align='center'>----</td>";
}
echo "<td colspan='2'>&nbsp;</td></tr></table>";
?>
</table>