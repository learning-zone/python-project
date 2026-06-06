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
if($dtdiff>0)
{
	$sql=execute("select pdamt,bkid,brchdet,ddno,dddt from fee_payment where ins_dt between '$fmyr1' and '$toyr1' and recptstatus=0 and mop>1 order by bkid,brchdet,dddt");
	if(rowcount($sql)>0)
	{
		?>
		<div><br></div>
		<table class='forumline' border='1' align='center' width='80%'>
		<tr height="30"><td align=center class=head colspan='6'><?php echo collegename(); ?></TD></TR>
		<?php
		if($fmyr==$toyr)
		{
			?>
			<tr height="30"><td align=center class=head colspan='6'><font size='3'><u>BANK DD/CHEQUE DEPOSIT REPORT AS ON <?=$fmyr?></u></font></TD></TR>
			<?php
		}
		else
		{
			?>
			<tr height="30"><td align=center class=head colspan='6'><font size='3'><u>BANK DD/CHEQUE DEPOSIT REPORT</u></font><br>From : <?=$fmyr?> - To : <?=$toyr?></TD></TR>
			<?php
		}
		?>
		<tr height="30"><td align='center'>Sl.No</td><td align='center'>Bank Name</td><td align='center'>Branch Details</td><td align='center'>DD/Cheque No</td><td align='center'>DD/Cheque Date</td><td align='center'>Amount</td></tr>
		<?php
		$sno=1;
		$gttlamt=0;
		while($r=fetcharray($sql))
		{
			if($sno<10)
				$sno="0".$sno;
			echo "<tr height='30'><td align='center'>$sno</td>";
			$bkname=fetcharray(execute("select bank_name from bank_details where id='$r[bkid]' "));
			echo "<td nowrap>&nbsp;&nbsp;$bkname[0]</td>";
			echo "<td>&nbsp;&nbsp;$r[brchdet]</td>";
			echo "<td>&nbsp;&nbsp;$r[ddno]</td>";
			$dte=explode("-",$r[dddt]);
			$ddt=$dte[2]." ".MonthName($dte[1])." ".$dte[0];
			echo "<td>&nbsp;&nbsp;$ddt</td>";
			echo "<td align='right'>".number_format($r[pdamt],2)."&nbsp;&nbsp;</td></tr>";
			$gttlamt+=$r[pdamt];
			$sno++;
		}
		echo "<tr height='30'><td align='right' colspan='5'>Total Amount&nbsp;&nbsp;</td>";
		if($gttlamt>0)
			echo "<td align='right'>".number_format($gttlamt,2)."&nbsp;&nbsp;</td>";
		else
			echo "<td align='right'>----&nbsp;&nbsp;</td></tr>";
		?>
		</table><br>
		<div id="prn" align="center"><input type="button" name="prnfeest" value="<< PRINT >>" onclick="prnfee()"></div>
		<?php
	}
	else
		echo "<font color='blue' size='3'><b>DD/Cheques not colleted between $fmyr to $toyr ....</b></font>";
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