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
$cat=execute("select cat_name from fee_cat where status=1 order by catid");
$ncat=rowcount($cat);
$nocat=$ncat+1;
$nt=$nocat+1;
for($i=1;$i<=$nt;$i++)
{
	$tl[$i]=0;
}
?>
<table border='1' class='forumline' align=center cellspacing='0' cellpadding='1'>
<tr><td align='center' class='head' colspan='3'><font size="4"><b>Consolidated Fee Report</b></font></td></tr>
<tr height='30'><td nowrap>&nbsp;&nbsp;Program : <?=$prmname[0]?></td><td nowrap>&nbsp;&nbsp;Semester : <?=$semname[0]?></td>
<td nowrap>&nbsp;&nbsp;Section : <?=$sectname?></td></tr>
<tr><td colspan='3'><table class='forumline' border='1' width='100%' cellspacing='0' cellpadding='1'>
<tr height='25'><td Class="rowpic" align='center'>Sl.No</td><td Class="rowpic" align='center' nowrap>SR Number</td><td Class="rowpic" align='center' nowrap>Student Name</td>
<?php
for($i=0;$i<$ncat;$i++)
{
	$r=fetcharray($cat);
	$rr[$i]=$r[0];
	echo "<td Class='rowpic' align='center'>$r[0]</td>";
}
?>
<td Class='rowpic' align='center' nowrap>Total</td>
<td Class="rowpic" align='center' nowrap>Balance</td>
<td Class="rowpic" align='center' nowrap>Receipt No & Date</td>
<td Class="rowpic" align='center'>DD No & Amount</td>
<td Class="rowpic" align='center'>Challan No & Amount</td></tr>
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
	$feem=execute("select * from fee_master where studid='$r[0]' and pid='$branch' and sid='$sem' and status=0");
	if(rowcount($feem)>0)
	{
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
		$nn++;
		if($f[balamt]>0)
		{
			$balamt=number_format($f[balamt],2);
			echo "<td align='right'><font color='red'>$balamt</font></td>";
			$tl[$nn]+=$f[balamt];
		}
		else
			echo "<td align='center'>----</td>";
	
		$ff=execute("select docid,mop,bkid,ddno,pay_dt,pdamt,ins_dt from fee_payment where fmid='$f[0]' and recptstatus=0");
		$docid='';
		$dddt='';
		$chdt='';
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
				if($chdt!='')
					if($chdt!="<br>")
						$chdt=$chdt."<br>Cash-".$d[pdamt];
					else
						$chdt=$chdt."Cash-".$d[pdamt];
				else
					$chdt="Cash-".$d[pdamt];
				$dddt=$dddt."<br>";
			}
			elseif($d[mop]==2)
			{
				if($dddt!='')
					if($dddt!="<br>")
						$dddt=$dddt."<br>".$d[ddno]."/".$d[pdamt];
					else
						$dddt=$dddt."".$d[ddno]."/".$d[pdamt];
				else
					$dddt=$d[ddno]."/".$d[pdamt];
				$chdt=$chdt."<br>";
			}
			else
			{
				if($chdt!='')
					if($chdt!="<br>")
						$chdt=$chdt."<br>".$d[ddno]."/".$d[pdamt];
					else
						$chdt=$chdt."".$d[ddno]."/".$d[pdamt];
				else
					$chdt=$d[ddno]."/".$d[pdamt];
				$dddt=$dddt."<br>";
			}

		}
		if($docid!='')
			echo "<td nowrap valign='top'>$docid</td>";
		else
			echo "<td align='center'>----</td>";
		if($dddt!='')
			echo "<td nowrap valign='top'>$dddt</td>";
		else
			echo "<td align='center'>----</td>";
		if($chdt!='')
			echo "<td nowrap valign='top'>$chdt</td></tr>";
		else
			echo "<td align='center'>----</td></tr>";
	}
	else
	{
		$keyno=$nocat+4;
		for($j=0;$j<$keyno;$j++)
		{
			echo "<td align='center'>----</td>";
		}
		echo "</tr>";
	}
}
echo "<tr><td colspan='3' align='right'>Total&nbsp;&nbsp;&nbsp;</td>";
for($j=1;$j<=$nt;$j++)
{
	if($tl[$j]>0)
	{
		$amt=number_format($tl[$j],2);
		if($nt==$j)
			echo "<td align='right'><font color='red'>$amt</font></td>";
		else
			echo "<td align='right'><font color='Blue'>$amt</font></td>";
	}
	else
		echo "<td align='center'>----</td>";
}
echo "<td colspan='3'>&nbsp;</td></tr></table>";
?>
</table>