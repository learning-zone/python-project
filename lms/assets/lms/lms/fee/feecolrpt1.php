<html>
<head>
<?php
session_start();
include("../db.php");
$cdt1=$_POST['cdt1'];
$cmt1=$_POST['cmt1'];
$cyr1=$_POST['cyr1'];
$cdt2=$_POST['cdt2'];
$cmt2=$_POST['cmt2'];
$cyr2=$_POST['cyr2'];
?>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<SCRIPT LANGUAGE="JavaScript">
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=700,width=1200,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
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
$fmyr=$cdt1." ".MonthName($cmt1)." ".$cyr1;
$toyr=$cdt2." ".MonthName($cmt2)." ".$cyr2;
$fmyr1=$cyr1."-".$cmt1."-".$cdt1;
$toyr1=$cyr2."-".$cmt2."-".$cdt2;
if($cyr1>$cyr2)
	$dtdiff=0;
elseif($cyr1==$cyr2)
{
	if($cmt1>$cmt2)
		$dtdiff=0;
	elseif($cmt1==$cmt2)
	{
		if($cdt1>$cdt2)
			$dtdiff=0;
		else
			$dtdiff=1;
	}
	else
		$dtdiff=1;
}
else
$dtdiff=1;
//$dtdiff=date_diff($toyr1,$fmyr1,d);
if($dtdiff>0)
{
	$sql=execute("select distinct(a.pid),a.sid,c.year_name from fee_payment a,course_m b,course_year c where a.ins_dt between '$fmyr1' and '$toyr1' and a.recptstatus=0 and a.pid=b.course_id and a.sid=c.year_id order by a.pid,a.sid");

	if(rowcount($sql)>0)
	{
		$ft=execute("select fee_name from fee_type order by fee_id");
		$ftc=rowcount($ft)+4;
		?>
		<table class='forumline' border=1 align=center>
		<tr height="30"><td align=center class=head colspan='<?php echo $ftc+2; ?>'><?php echo collegename(); ?></TD></TR>
		<?php
		if($fmyr==$toyr)
		{
			?>
			<tr height="30"><td align=center class=head colspan='<?php echo $ftc+2; ?>'><font size='3'><u>FEE COLLECTION REPORT AS ON <?=$fmyr?></u></font></TD></TR>
			<?php
		}
		else
		{
			?>
			<tr height="30"><td align=center class=head colspan='<?php echo $ftc+2; ?>'><font size='3'><u>FEE COLLECTION REPORT</u></font><br>From : <?=$fmyr?> - To : <?=$toyr?></TD></TR>
			<?php
		}
		?>
		<tr height="30"><td align=center rowspan='2'>Sl.No</td><td align=center rowspan='2'>Class</td><td align='center' colspan='<?php echo $ftc;?>'>Amount</td></tr><tr>
		<?php
		for($z=0;$z<rowcount($ft);$z++)
		{
			$ftpe=fetcharray($ft);
			echo "<td align='center'>$ftpe[0]</td>";
		}
		//echo "<td align='center'>Transport Fee</td>";
		echo "<td align='center'>Fine</td><td align='center'>Excess</td><td align='center'>Total</td></tr>";
		$sno=1;
		$gttlamt=0;
		$gttl[]=0;
		while($r=fetcharray($sql))
		{
			$ttlamt=0;
			$n=0;
			if($sno<10)
				$sno="0".$sno;
			echo "<tr height='30'><td align='center'>$sno</td>";
			echo "<td>&nbsp;&nbsp;$r[year_name]</td>";
			$ft=execute("select fee_id from fee_type order by fee_id");
			for($z=0;$z<rowcount($ft);$z++)
			{
				$ftpe=fetcharray($ft);
				$kd="pd".$ftpe[0];
				//echo "select sum($kd) from fee_payment where pid='$r[0]' and sid='$r[1]' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0<br>";
				$sql1=fetcharray(execute("select sum($kd) from fee_payment where pid='$r[0]' and sid='$r[1]' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0"));
				if($sql1[0]>0)
				{
					echo "<td align='right'>".number_format($sql1[0],2)."&nbsp;&nbsp;</td>";
					$ttlamt+=$sql1[0];
					$gttl[$n]+=$sql1[0];
				}
				else
					echo "<td align='right'>----&nbsp;&nbsp;</td>";
				$n++;
			}
			$sql1=fetcharray(execute("select sum(pdtptfee) from fee_payment where pid='$r[0]' and sid='$r[1]' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0"));
			if($sql1[0]>0)
			{
				echo "<td align='right'><a href=javascript:OpenWind('feecolrpt2.php?pid=$r[0]&sid=$r[1]&fmyr1=$fmyr1&toyr1=$toyr1&feeid=2')>".number_format($sql1[0],2)."</a>&nbsp;&nbsp;</td>";
				$ttlamt+=$sql1[0];
				$gttl[$n]+=$sql1[0];
			}
			else
				echo "<td align='right'>----&nbsp;&nbsp;</td>";
			$n++;
			$sql1=fetcharray(execute("select sum(fnamt) from fee_payment where pid='$r[0]' and sid='$r[1]' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0"));
			$amt=number_format($sql1[0],2);
			if($sql1[0]>0)
			{
				echo "<td align='right'>".number_format($sql1[0],2)."&nbsp;&nbsp;</td>";
				$ttlamt+=$sql1[0];
				$gttl[$n]+=$sql1[0];
			}
			else
				echo "<td align='right'>----&nbsp;&nbsp;</td>";
			$n++;
			$sql1=fetcharray(execute("select sum(exeamt) from fee_payment where pid='$r[0]' and sid='$r[1]' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0"));
			$amt=number_format($sql1[0],2);
			if($sql1[0]>0)
			{
				echo "<td align='right'>".number_format($sql1[0],2)."&nbsp;&nbsp;</td>";
				$ttlamt+=$sql1[0];
				$gttl[$n]+=$sql1[0];
			}
			else
				echo "<td align='right'>----&nbsp;&nbsp;</td>";
			$sql1=fetcharray(execute("select sum(pdamt) from fee_payment where pid='$r[0]' and sid='$r[1]' and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0"));
			$amt=number_format($sql1[0],2);
			if($sql1[0]>0)
			{
				echo "<td align='right'><a href=javascript:OpenWind('feecolrpt2.php?pid=$r[0]&sid=$r[1]&fmyr1=$fmyr1&toyr1=$toyr1&feeid=1')>".number_format($sql1[0],2)."</a>&nbsp;&nbsp;</td></tr>";
				$gttlamt+=$sql1[0];
			}
			else
				echo "<td align='right'>----&nbsp;&nbsp;</td></tr>";
			$sno++;
		}
		echo "<tr height='30'><td align='right' colspan='2'>Total Amount&nbsp;&nbsp;</td>";
		$ft=execute("select fee_id from fee_type order by fee_id");
		for($z=0;$z<rowcount($ft);$z++)
		{
			$sk=$z+1;
			$amt=$gttl[$z];
			if($amt>0)
				echo "<td align='right'>".number_format($amt,2)."&nbsp;&nbsp;</td>";
			else
				echo "<td align='right'>----&nbsp;&nbsp;</td>";
		}
		$amt=$gttl[$sk];
		if($amt>0)
			echo "<td align='right'><a href=javascript:OpenWind('feecolrpt2.php?sid=99&fmyr1=$fmyr1&toyr1=$toyr1&feeid=2')>".number_format($amt,2)."</a>&nbsp;&nbsp;</td>";
		else
			echo "<td align='right'>----&nbsp;&nbsp;</td>";
		$sk++;
		$amt=$gttl[$sk];
		if($amt>0)
			echo "<td align='right'>".number_format($amt,2)."&nbsp;&nbsp;</td>";
		else
			echo "<td align='right'>----&nbsp;&nbsp;</td>";
		$sk++;
		$amt=$gttl[$sk];
		if($amt>0)
			echo "<td align='right'>".number_format($amt,2)."&nbsp;&nbsp;</td>";
		else
			echo "<td align='right'>----&nbsp;&nbsp;</td>";
		if($gttlamt>0)
			echo "<td align='right'><a href=javascript:OpenWind('feecolrpt2.php?sid=99&fmyr1=$fmyr1&toyr1=$toyr1&feeid=1')>".number_format($gttlamt,2)."</a>&nbsp;&nbsp;</td>";
		else
			echo "<td align='right'>----&nbsp;&nbsp;</td></tr>";
		?>
		</table><br>
		<table class='forumline' border=1 align=center width='40%'>
		<tr height="30"><td align=center class=head colspan='3'><font size='3'><u>PAYMENT WISE FEE COLLECTION REPORT</u></font><br>From : <?=$fmyr?> - To : <?=$toyr?></TD></TR>
		<tr height="30"><td align='center'>Sl.No</td><td align='center'>Payment Type</td><td align='center''>Amount</td></tr>
		<?php
		$sno=1;
		$ttlamt1=0;
		$sql1=fetcharray(execute("select sum(pdamt) from fee_payment where mop=1 and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0"));
		if($sno<10)
			$sno="0".$sno;
		echo "<tr height='30'><td align='center'>$sno</td><td>&nbsp;&nbsp;Cash Payment</td><td align='right'>";
		if($sql1[0]>0)
		{
			echo "".number_format($sql1[0],2)."&nbsp;&nbsp;</td></tr>";
			$ttlamt1+=$sql1[0];
		}
		else
			echo "----&nbsp;&nbsp;</td></tr>";
		$sno++;
		$sql1=fetcharray(execute("select sum(pdamt) from fee_payment where mop=2 and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0"));
		if($sno<10)
			$sno="0".$sno;
		echo "<tr height='30'><td align='center'>$sno</td><td>&nbsp;&nbsp;Demand Draft Payment</td><td align='right'>";
		if($sql1[0]>0)
		{
			echo "".number_format($sql1[0],2)."&nbsp;&nbsp;</td></tr>";
			$ttlamt1+=$sql1[0];
		}
		else
			echo "----&nbsp;&nbsp;</td></tr>";
		$sno++;
		$sql1=fetcharray(execute("select sum(pdamt) from fee_payment where mop=3 and ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0"));
		if($sno<10)
			$sno="0".$sno;
		echo "<tr height='30'><td align='center'>$sno</td><td>&nbsp;&nbsp;Challan Payment</td><td align='right'>";
		if($sql1[0]>0)
		{
			echo "".number_format($sql1[0],2)."&nbsp;&nbsp;</td></tr>";
			$ttlamt1+=$sql1[0];
		}
		else
			echo "----&nbsp;&nbsp;</td></tr>";

		echo "<tr height='30'><td align='center' colspan='2'>Total Payment</td><td align='right'>";
		if($ttlamt1>0)
		{
			echo "".number_format($ttlamt1,2)."&nbsp;&nbsp;</td></tr>";
		}
		else
			echo "----&nbsp;&nbsp;</td></tr>";
		?>
		</table><br>
		<div id="prn" align="center"><input type="button" name="prnfeest" value="<< PRINT >>" onclick="prnfee()"></div>
		<?php
	}
	else
		echo "<font color='blue' size='3'><b>Fees not colleted between $fmyr to $toyr ....</b></font>";
}
else
	echo "<font color='red' size='3'><b>Invalid date selection....</b></font>";
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