<?php
$cdt=date("d-m-Y");
$fname="Fee_Report_".$cdt.".xls";
include("../db1.php");
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=$fname");

if($paymode==1)
{
	$n="Cash";
	$sql="select id from fee_payment where mop=1 and recptstatus=0 and dddt between '$fmyr1' and '$toyr1' order by dddt ";
}
elseif($paymode==2)
{
	$n="Challan";
	if($bkid>0)
		$sql="select distinct(bkid) from fee_payment where mop=3 and recptstatus=0 and bkid='$bkid' and dddt between '$fmyr1' and '$toyr1' order by dddt";
	else
		$sql="select distinct(bkid) from fee_payment where mop=3 and recptstatus=0 and dddt between '$fmyr1' and '$toyr1' order by bkid";
}
elseif($paymode==3)
{
	$n="Demand Draft";
	if($bkid>0)
		$sql="select distinct(bkid) from fee_payment where mop=2 and recptstatus=0 and bkid='$bkid' and dddt between '$fmyr1' and '$toyr1' order by dddt";
	else
		$sql="select distinct(bkid) from fee_payment where mop=2 and recptstatus=0 and dddt between '$fmyr1' and '$toyr1' order by bkid";
}
$rs=execute($sql) or die(mysql_error());
if(rowcount($rs)==0)
{
	if($paymode==1)
		echo "<font color=brown><b>No Cash Payment received between $fmyr and $toyr ..!!</b></font>";
	elseif($paymode==2)
		echo "<font color=brown><b>No Challan Payment received between $fmyr and $toyr ..!!</b></font>";
	elseif($paymode==3)
		echo "<font color=brown><b>No DD Payment received between $fmyr and $toyr ..!!</b></font>";
	die();
}
else
{
	?>
	<table border='1' class='forumline' align=center cellspacing='0' cellpadding='0' width='95%'>
	<tr><td align='center' class='head' colspan='3'><font size="4"><b>Date wise <?=$n?> Payment Report<br>From : <?=$fmyr?> - To : <?=$toyr?></b></font></td></tr>
	<?php
	if($paymode>1)
	{
		$s=execute("select id from currencytype order by id");
		$rc=rowcount($s);
		for($i=1;$i<=$rc;$i++)
		{
			$gttl[$i]=0;
		}
		$no=1;
		$rcct=rowcount($rs);
		while($r=fetcharray($rs))
		{
			$sql1=fetcharray(execute("select bank_name from bank_details where id='$r[0]'"));
			$s=execute("select name from currencytype order by id");
			$rc=rowcount($s);
			?>
			<tr><td colspan='3'><table class='forumline' border='1' width='100%' cellspacing='0' cellpadding='1'>
			<tr><td colspan='<?php echo $rc+8;?>'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='brown'><b><?=$sql1[0]?></b></font></tr>
			<tr height='25'><td Class="rowpic" align='center' rowspan='2'>Sl.No</td><td Class="rowpic" align='center' rowspan='2' nowrap>Student ID</td><td Class="rowpic" align='center' rowspan='2' nowrap>Student Name</td><td Class="rowpic" align='center' rowspan='2' nowrap>Course Details</td><td Class="rowpic" align='center' rowspan='2' nowrap>Section</td><td Class="rowpic" align='center' rowspan='2' nowrap>Payment Date</td><td Class="rowpic" align='center' rowspan='2' nowrap>Challan/DD No</td><td Class="rowpic" align='center' rowspan='2' nowrap>Challan/DD Date</td><td Class="rowpic" align='center' colspan='<?=$rc?>' nowrap>Amount</td></tr><tr>
			<?php
			for($i=1;$i<=$rc;$i++)
			{
				$kk=fetcharray($s);
				$ttl[$i]=0;
				echo "<td class=row3 align='center' width='20%'>$kk[0]</td>";
			}
			echo "</tr>";
			if($paymode==2)
			{
				$sql2="select studid,pid,sid as ss,ddno,pay_dt,pdamt,curid,dddt from fee_payment where mop=3 and bkid='$r[0]' and recptstatus=0 and dddt between '$fmyr1' and '$toyr1' order by dddt";
			}
			elseif($paymode==3)
			{
				$sql2="select studid,pid,sid as ss,ddno,pay_dt,pdamt,curid,dddt from fee_payment where mop=2 and bkid='$r[0]' and recptstatus=0 and dddt between '$fmyr1' and '$toyr1' order by dddt";
			}
			$rs1=execute($sql2) or die(mysql_error());
			$sno=1;
			$ttlamt=0;
			while($r1=fetcharray($rs1))
			{
				$stddet=execute("select student_id,stud_name,section,m_name,l_name,cir_type from student_m where id='$r1[studid]'");
				if(rowcount($stddet)==0)
					$stddet=execute("select student_id,stud_name,section,m_name,l_name,cir_type from archive where id='$r1[studid]'");
				$semname=fetcharray(execute("select course_abbr from course_m where course_id='$r1[pid]'"));
				$cqry1=fetcharray(execute("select name from currencytype where id='$r1[curid]'"));
				$stdet=fetcharray($stddet);
				if($stdet[section]==0)
					$sectname="No Section";
				else
				{
					$rs3=fetcharray(execute("select section_name from class_section where id='$stdet[section]'"));
					$sectname=$rs3[0];
				}
				if($sno<10)
					$sno="0".$sno;
				echo "<tr><td align='center' width='2%'>$sno</td>";
				echo "<td width='10%'>&nbsp;&nbsp;$stdet[student_id]</td>";
				echo "<td width='35%'>&nbsp;&nbsp;$stdet[stud_name] $stdet[m_name] $stdet[l_name]</td>";
				
				if($stdet[cir_type]!=2)
				{
					if($r1[ss]==1)
						$stm="(NTA Level - 4)";
					elseif($r1[ss]==2)
						$stm="(NTA Level - 5)";
					elseif($r1[ss]==3)
						$stm="(NTA Level - 6)";
				}
				else
				{
					$stm="";
				}
				echo "<td width='15%' nowrap>&nbsp;&nbsp;$semname[0] $stm</td>";
				echo "<td width='15%' nowrap>&nbsp;&nbsp;$sectname</td>";
				$dd=explode("-",$r1[dddt]);
				$dddt=$dd[2]." ".MonthName($dd[1])." ".$dd[0];
				echo "<td width='15%' align='center'>$dddt</td>";
				echo "<td width='15%' nowrap>&nbsp;&nbsp;$r1[ddno]</td>";
				$dd=explode("-",$r1[pay_dt]);
				$dddt=$dd[2]." ".MonthName($dd[1])." ".$dd[0];
				echo "<td width='15%' align='center'>$dddt</td>";
				$s=execute("select id from currencytype order by id");
				for($i=1;$i<=$rc;$i++)
				{
					if($i==$r1[curid])
					{
						echo "<td align='right'>".number_format($r1[pdamt],0)."</b></a></td>";
						$ttl[$i]+=$r1[pdamt];
					}
					else
						echo "<td align='center'>---</td>";
				}
				echo "</tr>";
				$sno++;
			}
			echo "<tr><td align='right' colspan='8'><b>Total Amount</b>&nbsp;&nbsp;</td>";
			for($i=1;$i<=$rc;$i++)
			{
				if($ttl[$i]>0)
				{
					echo "<td align='right'><font color='blue'><b>".number_format($ttl[$i],0)."</b></font></td>";
					$gttl[$i]+=$ttl[$i];
				}
				else
					echo "<td align='center'>---</td>";
			}
			$no++;
			if($no>$rcct)
				echo "</tr>";
			else
				echo "</tr></table></td></tr>";
		}
		echo "<tr><td align='right' colspan='8'><font color='red'><b>Grand Total&nbsp;&nbsp;</b></font>";
		for($i=1;$i<=$rc;$i++)
		{
			if($gttl[$i]>0)
				echo "<td align='right'><font color='red'><b>".number_format($gttl[$i],0)."</b></font></td>";
			else
				echo "<td align='center'>---</td>";
		}
		echo "</tr></table></td></tr></table><br><br>";
	}
	else
	{
		$s=execute("select name from currencytype order by id");
		$rc=rowcount($s);
		?>
		<tr><td colspan='3'><table class='forumline' border='1' width='100%' cellspacing='0' cellpadding='1'>
		<tr height='25'><td Class="rowpic" align='center' rowspan='2'>Sl.No</td><td Class="rowpic" align='center' rowspan='2' nowrap>Student ID</td><td Class="rowpic" align='center' rowspan='2' nowrap>Student Name</td><td Class="rowpic" align='center' rowspan='2' nowrap>Course Details</td><td Class="rowpic" align='center' rowspan='2' nowrap>Section</td><td Class="rowpic" align='center' rowspan='2' nowrap>Payment Date</td><td Class="rowpic" align='center' colspan='<?=$rc?>' nowrap>Amount</td></tr><tr>
		<?php
		for($i=1;$i<=$rc;$i++)
		{
			$kk=fetcharray($s);
			$ttl[$i]=0;
			echo "<td class=row3 align='center' width='20%'>$kk[0]</td>";
		}
		echo "</tr>";
		$sql2="select studid,pid,sid as ss,pdamt,curid,dddt from fee_payment where mop=1 and recptstatus=0 and dddt between '$fmyr1' and '$toyr1' order by dddt";
		$rs1=execute($sql2) or die(mysql_error());
		$sno=1;
		while($r1=fetcharray($rs1))
		{
			$stddet=execute("select student_id,stud_name,section,m_name,l_name,cir_type from student_m where id='$r1[studid]'");
			if(rowcount($stddet)==0)
				$stddet=execute("select student_id,stud_name,section,m_name,l_name,cir_type from archive where id='$r1[studid]'");
			$semname=fetcharray(execute("select course_abbr from course_m where course_id='$r1[pid]'"));
			$cqry1=fetcharray(execute("select name from currencytype where id='$r1[curid]'"));
			$stdet=fetcharray($stddet);
			if($stdet[section]==0)
				$sectname="No Section";
			else
			{
				$rs3=fetcharray(execute("select section_name from class_section where id='$stdet[section]'"));
				$sectname=$rs3[0];
			}
			if($sno<10)
				$sno="0".$sno;
			echo "<tr><td align='center' width='2%'>$sno</td>";
			echo "<td width='10%'>&nbsp;&nbsp;$stdet[student_id]</td>";
			echo "<td width='35%'>&nbsp;&nbsp;$stdet[stud_name] $stdet[m_name] $stdet[l_name]</td>";
			
			if($stdet[cir_type]!=2)
			{
				if($r1[ss]==1)
					$stm="(NTA Level - 4)";
				elseif($r1[ss]==2)
					$stm="(NTA Level - 5)";
				elseif($r1[ss]==3)
					$stm="(NTA Level - 6)";
			}
			else
			{
				$stm="";
			}
			echo "<td width='15%' nowrap>&nbsp;&nbsp;$semname[0] $stm</td>";
			echo "<td width='15%' nowrap>&nbsp;&nbsp;$sectname</td>";
			$dd=explode("-",$r1[dddt]);
			$dddt=$dd[2]." ".MonthName($dd[1])." ".$dd[0];
			echo "<td width='15%' align='center'>$dddt</td>";
			$s=execute("select id from currencytype order by id");
			for($i=1;$i<=$rc;$i++)
			{
				if($i==$r1[curid])
				{
					echo "<td align='right'>".number_format($r1[pdamt],0)."</b></a></td>";
					$ttl[$i]+=$r1[pdamt];
				}
				else
					echo "<td align='center'>---</td>";
			}
			echo "</tr>";
			$sno++;
		}
		echo "<tr><td align='right' colspan='6'><b>Total Amount</b>&nbsp;&nbsp;</td>";
		for($i=1;$i<=$rc;$i++)
		{
			if($ttl[$i]>0)
			{
				echo "<td align='right'><font color='red'><b>".number_format($ttl[$i],0)."</b></font></td>";
				$gttl[$i]+=$ttl[$i];
			}
			else
				echo "<td align='center'>---</td>";
		}
		echo "</tr></table></td></tr>";
	}
	echo "</table><br><br>";
}
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