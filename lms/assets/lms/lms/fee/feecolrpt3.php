<?php
$cdt=date("d-m-Y");
$fname="TPT_Fee_Report_".$cdt.".xls";
include("../db1.php");
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=$fname");
$pid=$_POST['pid'];
$sid=$_POST['sid'];
$fmyr1=$_POST['fmyr1'];
$toyr1=$_POST['toyr1'];
$feeid=$_POST['feeid'];
$fmyear=explode("-",$fmyr1);
$fmyr=$fmyear[2]."-".MonthName($fmyear[1])."-".$fmyear[0];
$toyear=explode("-",$toyr1);
$toyr=$toyear[2]."-".MonthName($toyear[1])."-".$toyear[0];
$rs=fetcharray(execute("select course_abbr from course_m where course_id='$pid'"));
$rs1=fetcharray(execute("select year_name from course_year where year_id='$sid'"));
if($feeid==1)
{
	$ft=execute("select fee_name from fee_type order by fee_id");
	$ftc=rowcount($ft)+4;
	?>
	<table class='forumline' border=1 align=center>
	<tr height="30"><td align=center class=head colspan='<?php echo $ftc+7; ?>'><?php echo collegename(); ?></TD></TR>
	<tr height="30"><td align=center class=head colspan='<?php echo $ftc+7; ?>'><font size='3'>FEE COLLECTION REPORT</font></TD></TR>
	<tr height="25"><td align=center colspan='<?php echo $ftc+7; ?>'><br>From : <?=$fmyr?> - To : <?=$toyr?></td></tr>
	<tr height="25"><td align=center rowspan='2'>Sl.No</td><td align=center rowspan='2'>Student ID</td><td align=center rowspan='2'>Student Name</td><td align=center rowspan='2'>Class & Section</td><td align=center rowspan='2'>Inst</td><td align=center rowspan='2' nowrap>Payment Details</td><td align=center colspan='<?php echo $ftc;?>'>Amount</td><td align=center rowspan='2' nowrap>Receipt Details</td></tr>
	<?php
	for($z=0;$z<rowcount($ft);$z++)
	{
		$ftpe=fetcharray($ft);
		echo "<td align='center'>$ftpe[0]</td>";
	}
	echo "<td align='center'>Transport Fee</td><td align='center'>Fine</td><td align='center'>Excess</td><td align='center'>Total</td></tr>";
	echo "</tr>";
	
	if($sid!=99)
		$sql=execute("select a.*,b.student_id,b.first_name,b.last_name,b.course_yearsem,b.class_section_id from fee_payment a,student_m b where a.sid='$sid' and a.ins_dt between '$fmyr1' and '$toyr1' and a.recptstatus=0 and a.studid=b.id order by b.first_name");
	else
		$sql=execute("select a.*,b.student_id,b.first_name,b.last_name,b.course_yearsem,b.class_section_id from fee_payment a,student_m b where a.ins_dt between '$fmyr1' and '$toyr1' and a.recptstatus=0 and a.studid=b.id order by b.first_name");

	$sno=1;
	$ttlamt=0;
	while($r=fetcharray($sql))
	{
		if($sno<10)
			$sno="0".$sno;
		echo "<tr height='25'><td align='center'>$sno</td>";
		echo "<td>&nbsp;&nbsp;$r[student_id]</td>";
		echo "<td nowrap>&nbsp;&nbsp;$r[first_name] $r[last_name]</td>";
		$clname=fetcharray(execute("select year_name from course_year where year_id='$r[course_yearsem]'"));
		$secname=fetcharray(execute("select section_name from class_section where id='$r[class_section_id]'"));
		echo "<td nowrap>&nbsp;&nbsp;$clname[0] / $secname[0]</td>";
		if($r[6]==1)
			$tname="First";
		elseif($r[6]==2)
			$tname="Second";
		elseif($r[6]==3)
			$tname="Third";
		echo "<td align='center'>$tname</td>";
		if($r[bkid]>0)
		{
			$bkn=fetcharray(execute("select bank_st_name from bank_details where id='$r[bkid]'"));
			$dddate=explode("-",$r[dddt]);
			$dte=$dddate[2]."-".$dddate[1]."-".$dddate[0];
		}
		if($r[mop]==1)
			$mp="Cash";
		elseif($r[mop]==2)
			$mp="DD : ".$bkn[0]." : ".$r[ddno]." : ".$dte;
		elseif($r[mop]==3)
			$mp="Cheque - : ".$bkn[0]." : ".$r[ddno]." : ".$dte;
		echo "<td>$mp</td>";
		$ft=execute("select fee_id from fee_type order by fee_id");
		for($z=0;$z<rowcount($ft);$z++)
		{
			$ftpe=fetcharray($ft);
			$aa="pd".$ftpe[0];
			$amt=$r[$aa];
			if($amt>0)
				echo "<td align='right'>".number_format($amt,2)."&nbsp;&nbsp;</td>";
			else
				echo "<td align='center'>----</td>";
		}
		if($r[pdtptfee]>0)
			echo "<td align='right'>".number_format($r[pdtptfee],2)."&nbsp;&nbsp;</td>";
		else
			echo "<td align='center'>----</td>";
		if($r[fnamt]>0)
			echo "<td align='right'>".number_format($r[fnamt],2)."&nbsp;&nbsp;</td>";
		else
			echo "<td align='center'>----</td>";
		if($r[exeamt]>0)
			echo "<td align='right'>".number_format($r[exeamt],2)."&nbsp;&nbsp;</td>";
		else
			echo "<td align='center'>----</td>";
		if($r[pdamt]>0)
			echo "<td align='right'>".number_format($r[pdamt],2)."&nbsp;&nbsp;</td>";
		else
			echo "<td align='center'>----</td>";
		$pd=explode("-",$r[pay_dt]);
		$pdt=$pd[2]."-".$pd[1]."-".$pd[0];
		echo "<td>$r[docid] $pdt</td></tr>";
		$sno++;
	}
	echo "<tr><td align='right' colspan='6'>Total Amount&nbsp;&nbsp;</td>";
	$ft=execute("select fee_id from fee_type order by fee_id");
	for($z=0;$z<rowcount($ft);$z++)
	{
		$ftpe=fetcharray($ft);
		$aa="pd".$ftpe[0];
		if($sid!=99)
			$q=fetcharray(execute("select sum($aa) from fee_payment where sid='$sid' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0 "));
		else
			$q=fetcharray(execute("select sum($aa) from fee_payment where ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0 "));
		if($q[0]>0)
			echo "<td align='right'>".number_format($q[0],2)."&nbsp;&nbsp;</td>";
		else
			echo "<td align='center'>----</td>";
	}
	if($sid!=99)
		$q=fetcharray(execute("select sum(pdtptfee) from fee_payment where sid='$sid' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0 "));
	else
		$q=fetcharray(execute("select sum(pdtptfee) from fee_payment where ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0 "));
	if($q[0]>0)
		echo "<td align='right'>".number_format($q[0],2)."&nbsp;&nbsp;</td>";
	else
		echo "<td align='center'>----</td>";
	if($sid!=99)
		$q=fetcharray(execute("select sum(fnamt) from fee_payment where sid='$sid' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0 "));
	else
		$q=fetcharray(execute("select sum(fnamt) from fee_payment where ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0 "));
	if($q[0]>0)
		echo "<td align='right'>".number_format($q[0],2)."&nbsp;&nbsp;</td>";
	else
		echo "<td align='center'>----</td>";
	if($sid!=99)
		$q=fetcharray(execute("select sum(exeamt) from fee_payment where sid='$sid' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0 "));
	else
		$q=fetcharray(execute("select sum(exeamt) from fee_payment where ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0 "));
	if($q[0]>0)
		echo "<td align='right'>".number_format($q[0],2)."&nbsp;&nbsp;</td>";
	else
		echo "<td align='center'>----</td>";
	if($sid!=99)
		$q=fetcharray(execute("select sum(pdamt) from fee_payment where sid='$sid' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0 "));
	else
		$q=fetcharray(execute("select sum(pdamt) from fee_payment where ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0 "));
	if($q[0]>0)
		echo "<td align='right'>".number_format($q[0],2)."&nbsp;&nbsp;</td>";
	else
		echo "<td align='center'>----</td>";
	echo "<td>&nbsp;</td></tr>";
	?>
	</table><br>
	<?php
}
else
{
	?>
	<table class='forumline' border=1 align=center>
	<tr height="30"><td align=center class=head colspan='8'><?php echo collegename(); ?></TD></TR>
	<tr height="30"><td align=center class=head colspan='8'><font size='3'>TRANSPORT FEE COLLECTION REPORT</font></TD></TR>
	<tr height="25"><td align=center colspan='8'><br>From : <?=$fmyr?> - To : <?=$toyr?></td></tr>
	<tr height="25"><td align='center'>Sl.No</td><td align='center''>Student ID</td><td align='center''>Student Name</td><td align='center'>Class & Section</td><td align='center'>Inst</td><td align='center' nowrap>Payment Details</td><td align='center'>Amount</td><td align='center' nowrap>Receipt Details</td></tr>
	<?php
	if($sid!=99)
		$sql=execute("select a.tmid,a.docid,a.mop,a.pay_dt,a.bkid,a.brchdet,a.ddno,a.dddt,a.pdtptfee,b.student_id,b.first_name,b.last_name,b.course_yearsem,b.class_section_id from fee_payment a,student_m b where a.sid='$sid' and a.ins_dt between '$fmyr1' and '$toyr1' and a.recptstatus=0 and a.studid=b.id and a.pdtptfee > 0 order by b.first_name");
	else
		$sql=execute("select a.tmid,a.docid,a.mop,a.pay_dt,a.bkid,a.brchdet,a.ddno,a.dddt,a.pdtptfee,b.student_id,b.first_name,b.last_name,b.course_yearsem,b.class_section_id from fee_payment a,student_m b where a.ins_dt between '$fmyr1' and '$toyr1' and a.recptstatus=0 and a.studid=b.id and a.pdtptfee > 0 order by b.first_name");

	$sno=1;
	$ttlamt=0;
	while($r=fetcharray($sql))
	{
		if($sno<10)
			$sno="0".$sno;
		echo "<tr height='25'><td align='center'>$sno</td>";
		echo "<td>&nbsp;&nbsp;$r[student_id]</td>";
		echo "<td nowrap>&nbsp;&nbsp;$r[first_name] $r[last_name]</td>";
		$clname=fetcharray(execute("select year_name from course_year where year_id='$r[course_yearsem]'"));
		$secname=fetcharray(execute("select section_name from class_section where id='$r[class_section_id]'"));
		echo "<td nowrap>&nbsp;&nbsp;$clname[0] / $secname[0]</td>";
		if($r[tmid]==1)
			$tname="First";
		elseif($r[tmid]==2)
			$tname="Second";
		elseif($r[tmid]==3)
			$tname="Third";
		echo "<td align='center'>$tname</td>";
		if($r[bkid]>0)
		{
			$bkn=fetcharray(execute("select bank_st_name from bank_details where id='$r[bkid]'"));
			$dddate=explode("-",$r[dddt]);
			$dte=$dddate[2]."-".$dddate[1]."-".$dddate[0];
		}
		if($r[mop]==1)
			$mp="Cash";
		elseif($r[mop]==2)
			$mp="DD : ".$bkn[0]." : ".$r[ddno]." : ".$dte;
		elseif($r[mop]==3)
			$mp="Cheque - : ".$bkn[0]." : ".$r[ddno]." : ".$dte;
		echo "<td>$mp</td>";

		if($r[pdtptfee]>0)
			echo "<td align='right'>".number_format($r[pdtptfee],2)."&nbsp;&nbsp;</td>";
		else
			echo "<td align='center'>----</td>";
		
		$pd=explode("-",$r[pay_dt]);
		$pdt=$pd[2]."-".$pd[1]."-".$pd[0];
		echo "<td>$r[docid] $pdt</td></tr>";
		$sno++;
	}
	echo "<tr><td align='right' colspan='6'>Total Amount&nbsp;&nbsp;</td>";
	
	if($sid!=99)
		$q=fetcharray(execute("select sum(pdtptfee) from fee_payment where sid='$sid' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0 "));
	else
		$q=fetcharray(execute("select sum(pdtptfee) from fee_payment where ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0 "));
	if($q[0]>0)
		echo "<td align='right'>".number_format($q[0],2)."&nbsp;&nbsp;</td>";
	else
		echo "<td align='center'>----</td>";
	echo "<td>&nbsp;</td></tr>";
	?>
	</table><br>
	<?php
}
?>
<div id="prn" align="center"><input type="button" name="prnfeest" value="<< PRINT >>" class='bgbutton' onclick="prnfee()">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" name="excelrpt" value="<< Export Excel >>" class='bgbutton' onclick="expexcel()"></div>
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