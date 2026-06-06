<html>
<head>
<title>Fee Receipt</title>
<?php
//echo "hai";
session_start();
include("../db.php");
$stud_id=$_POST['stud_id'];
$course=$_POST['course'];
$sem=$_POST['sem'];
$adm_id=$_POST['adm_id'];
$stud_yr=$_POST['stud_yr'];
$oexeamt=$_POST['oexeamt'];
$oldbalamt=$_POST['oldbalamt'];
$pydt=$_POST['pydt'];
$pymt=$_POST['pymt'];
$pyyr=$_POST['pyyr'];
$pdt=$_POST['pdt'];
$pmt=$_POST['pmt'];
$pyr=$_POST['pyr'];
$paymenttype=$_POST['paymenttype'];
$amt=$_POST['amt'];
$fnamt=$_POST['fnamt'];
$cenamt=$_POST['cenamt'];
$bname=$_POST['bname'];
$bdet=$_POST['bdet'];
$ddno=$_POST['ddno'];
$fineamt=$_POST['fineamt'];
$ttldedamt=$_POST['ttldedamt'];
$ttlpdamt=$_POST['ttlpdamt'];
$balamt=$_POST['balamt'];
$exeamt=$_POST['exeamt'];
$pdoldbalamt=$_POST['pdoldbalamt'];
$remk=$_POST['remk'];
include("numbers-words.php");
?>
<script language="javascript" type="text/javascript">
function dataprint()
{
	prn.style.display = "none";
	window.print(this.form);
}
function clswnd()
{
	window.close();
}
function showKeyCode(e)
{
	var keycode = e;
	if(keycode == 116)
	{
		event.keyCode = 0;
		event.returnValue = false;
		return false;
	}
}
</script>
</head>
<body oncontextmenu="return false;" onkeydown='showKeyCode(event.keyCode)'>
<form name="frm" method='post'>
<?php
$dddate=$pydt."-".$pymt."-".$pyyr;
$dddate1=$pyyr."-".$pymt."-".$pydt;
$dddate2=$pdt."-".$pmt."-".$pyr;
$dddate3=$pyr."-".$pmt."-".$pdt;

$cdate1=date("d-m-Y");
$tdt=date("Y-m-d");
$cyr=$stud_yr;
$sql=fetcharray(execute("select max(id) from fee_payment"));
$docid=$sql[0]+1;
$docid=$_SESSION['SchoolCode']."/FR/".$docid;
$sql=fetcharray(execute("select first_name,last_name,student_id,course_yearsem,admission_id from student_m where id=$stud_id"));
$sql1=fetcharray(execute("select course_abbr from course_m where course_id=$course"));
$sql2=fetcharray(execute("select year_name from course_year where year_id='$sql[course_yearsem]'"));
if($paymenttype==1)
	$modepay="Cash";
elseif($paymenttype==2)
	$modepay="Demand Draft";
elseif($paymenttype==3)
	$modepay="Bank Cheque";

$uid=fetcharray(execute("select id from users where username='$user'"));

if($balamt>0)
	$pstatus=1;
else
	$pstatus=0;

$ck=execute("select id from fee_dmd where studid='$stud_id' and pid='$course' and sid='$sem' and admid='$adm_id' and dmdsts='0' and accyr='$cyr' ");
if(rowcount($ck)>0)
{
	$fchid=fetcharray($ck);
	$insidd=$fchid[0];
}
else
{
	$sql4=execute("insert into fee_dmd (studid,pid,sid,admid,ins_dt,uid,accyr) values ('$stud_id','$course','$sem','$adm_id','$tdt','$uid[0]','$cyr')") or die ("Failed to update data22");
	$insidd=fetchInsertId();
}
$chkstud=execute("select id from fee_master where studid='$stud_id' and status=0 ");
$rcntt=rowcount($chkstud);

if($rcntt>0)
{
	$sql5=execute("select * from fee_head where course_id='$course' and year_id='$sem' and admission_type='$adm_id' and accyr='$cyr' and status=1 and ftype!=1 order by fid");
}
else
{
	$cks=fetcharray(execute("select academic_year,adm_yr from student_m where id='$stud_id'"));
	if($cks[0]==$cks[1])
		$sql5=execute("select * from fee_head where course_id='$course' and year_id='$sem' and admission_type='$adm_id' and accyr='$cyr' and status=1 order by fid");
	else
		$sql5=execute("select * from fee_head where course_id='$course' and year_id='$sem' and admission_type='$adm_id' and accyr='$cyr' and status=1 and ftype!=1 order by fid");
	
}

$sql4=execute("insert into fee_master (dmdid,studid,pid,sid,admid,fnamt,cenamt,balamt,exeamt,accyr,pstatus,bfbalamt,bfexeamt) values ('$insidd','$stud_id','$course','$sem','$adm_id','$fnamt','$cenamt','$balamt','$exeamt','$cyr','$pstatus','$oldbalamt','$oexeamt')") or die ("Failed to update data2");
$insid=fetchInsertId();

$sql3="insert into fee_payment (fmid,studid,pid,sid,tmid,admid,docid,bfexeamt,bfbalamt,pdamt,docamt,mop,pay_dt,bkid,brchdet,ddno,dddt,fnamt,cenamt,balamt,exeamt,ins_dt,remks,uid,accyr) values ('$insid','$stud_id','$course','$sem','1','$adm_id','$docid','$oexeamt','$oldbalamt','$amt','$ttlpdamt','$paymenttype','$dddate1','$bname','$bdet','$ddno','$dddate3','$fineamt','$cenamt','$balamt','$exeamt','$tdt','".addslashes($remk)."','$uid[0]','$cyr')";
execute($sql3) or die("Failed to insert data1");

if($oexeamt>0)
{
	$upsql=execute("update fee_master set exeamt=0 where studid='$stud_id' and exeamt > 0 and id !='$insid'") or die ("Failed to clear old excess payment");
}
if($oldbalamt>0)
{
	$upsql=execute("update fee_master set balamt=0,pstatus=0 where studid='$stud_id' and balamt > 0 and id !='$insid'") or die ("Failed to clear old balance payment");
}
$tmprd="Jun - Sep ".$cyr;
?>
<table align='center' width='100%' border='1' cellspacing='0' cellpadding='0' class='forumline'>
<tr><td>
<table align='center' width='100%' border='0' cellspacing='0' cellpadding='0' class='forumline'>
<tr><td colspan='2'>
<table align='center' width='100%'cellspacing='0' cellpadding='0' border='1'>
<tr><td align='left' width='85'><img src="../images/logo.jpg" width='85' height='100' border='0'></img></td>
<td align='center'><table border='0' align='center' width='100%' cellspacing='0' cellpadding='0'>
<tr><td align='center' style='font-size:20px;' nowrap><b><?php echo collegename(); ?></td></tr>
<tr><td align='center' style='font-size:10px;' nowrap>(Recognised by Govt. of Karnataka)</td></tr>
<tr><td align='center' style='font-size:10px;' nowrap>M.E.S. Road, Bangalore - 560013</b></td></tr>
</table></td></tr>
</table></td></tr>
<tr><td colspan='2' valign='top' align='right' style='font-size:10px;'><u>Office Copy</u>&nbsp;&nbsp;</td></tr>
<tr height='25'><td colspan='2' align='center'><font size='2.5'><u>FEE RECEIPT : <?=$tmprd?></u></font></td></tr>
<tr><td align='left'>&nbsp;&nbsp;Receipt No : <?=$docid?></td><td align='right'>Date : <?=$dddate?>&nbsp;&nbsp;</td></tr>
<tr><td colspan='2'>&nbsp;&nbsp;Name : <?=$sql[0]?> <?=$sql[1]?></td></tr>
<tr><td>&nbsp;&nbsp;Class : <?=$sql2[0] ?></td><td align='right'>Admn No : <?=$sql[4] ?>&nbsp;&nbsp;</td>
<tr><td>&nbsp;&nbsp;Roll No : <?=$sql[2]?></td><td align='right'>Payment Mode : <?=$modepay?>&nbsp;&nbsp;</td></tr>
<?php
if($paymenttype==2 or $paymenttype==3)
{
	$bankname=fetcharray(execute("select bank_st_name from bank_details where id='$bname'"));
	echo "<tr><td>&nbsp;&nbsp;Bank Name : $bankname[0]</td>";
	echo "<td align='right'>Branch : $bdet&nbsp;&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;&nbsp;DD/Cheque No. : $ddno</td>";
	echo "<td align='right'>DD/Cheque Date : $dddate2&nbsp;&nbsp;</td></tr>";
}
?>
<tr><td colspan='2'>
<table class='forumline' border='1' align='center' width='100%' cellspacing='0' cellpadding='0'>
<tr><td align='center' width='10%' rowspan='2'>Sl No</td><td align='center' rowspan='2'>Particulars</td><td align='center' colspan='2' width='25%'>Amount</td></tr>
<tr><td align='center' width='17%'>Rs.</td><td align='center' width='3%'>Ps.</td></tr>
<?php
$dtl1=0;
$dtl2=0;
$dtl3=0;
$dpd=0;
$sno=1;
for($i=0;$i<rowcount($sql5);$i++)
{
	$r=fetcharray($sql5);
	$d1="T1dmd".$r[fid];
	$d2=$r[amount1];
	$d3="T2dmd".$r[fid];
	$d4=$r[amount2];
	$d5="T3dmd".$r[fid];
	$d6=$r[amount3];
	if($d2>0)
	{
		$sql6=execute("update fee_dmd set $d1='$d2',$d3='$d4',$d5='$d6' where id='$insidd' ") or die ("Failed to update data-3");
		$dtl1+=$d2;
		$dtl2+=$d4;
		$dtl3+=$d6;
	}
	$aa="pd".$r[fid];
	$a=$_POST['pdfee'.$r[fid]];
	if($a>0)
	{
		$dpd+=$a;
		$sql3="update fee_payment set $aa=$a where docid='$docid'";
		execute($sql3) or die ("Failed to update data3");
		if($sno<10)
			$sno="0".$sno;
		echo "<tr><td align='center'>$sno</td>";
		$sql8=fetcharray(execute("select fee_name from fee_type where fee_id='$r[fid]'"));
		echo "<td>&nbsp;&nbsp;$sql8[0]</td>";
		echo "<td align='right'>$a</td><td align='center'>00</td></tr>";
		$sno++;
	}
}
$sql4="update fee_master set dtfee1='$dtl1',dtfee2='$dtl2',dtfee3='$dtl3',ptfee1='$dpd' where id='$insid'";
execute($sql4) or die ("Failed to update data3");
if($dedtptfee>0)
{
	$sql6=execute("update fee_master set dtptfee1='$dedtptfee',dtptfee2='$dedtptfee',dtptfee3='$dedtptfee' where id='$insid' ") or die ("Failed to update data-3");
	//$dtl+=$dedtptfee;
}
if($pdtptfee>0)
{
	$sql3="update fee_payment set pdtptfee='$pdtptfee' where docid='$docid'";
	execute($sql3) or die ("Failed to update data3");

	$sql3="update fee_master set ptptfee1='$pdtptfee' where id='$insid'";
	execute($sql3) or die ("Failed to update data33");
}
$ttlamt=$dpd;
if($oldbalamt>0)
{
	$ttlamt+=$oldbalamt;
	echo "<tr><td colspan='2' align='right'>Old Balance Cleared&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right'>$oldbalamt</td><td align='center'>00</td>";
}
if($fineamt>0)
{
	$ttlamt+=$fineamt;
	echo "<tr><td colspan='2' align='right'>Fine Amount&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right'>$fineamt</td><td align='center'>00</td>";
}
if($oexeamt>0)
{
	$ttlamt-=$oexeamt;
	echo "<tr><td colspan='2' align='right'>Old Excess Payment Cleared&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right'>- $oexeamt</td><td align='center'>00</td>";
}
if($amt>$ttlamt)
{
	$keyfg=1;
	if($exeamt>0)
	{
		$ttlamt+=$exeamt;
		echo "<tr><td colspan='2' align='right'>Excess Payment&nbsp;&nbsp;&nbsp;</td>";
		echo "<td align='right'>$exeamt</td><td align='center'>00</td>";
	
		if($cenamt>0)
		{
			$ttlamt-=$cenamt;
			echo "<tr><td colspan='2' align='right'>Concession Amount&nbsp;&nbsp;&nbsp;</td>";
			echo "<td align='right'>- $cenamt</td><td align='center'>00</td>";
		}
	}
}
echo "<tr><td colspan='2' align='right'>Paid Amount&nbsp;&nbsp;&nbsp;</td><td align='right'>$ttlamt</td><td align='center'>00</td></tr>";
$amt_str = number_to_words($ttlamt);

if($balamt>0)
{
	echo "<tr><td colspan='2' align='right'>Balance Amount&nbsp;&nbsp;&nbsp;</td><td align='right'>$balamt</td><td align='center'>00</td></tr>";
}
?>
</td></tr></table></td></tr>
<tr><td colspan='2'><div id='a1' align='left'>&nbsp;&nbsp;Remarks : <?=stripslashes($remk)?></div></td></tr>
<tr><td colspan='2'><br><div id='a1' align='center'>&nbsp;&nbsp;Received Rupees : <?=strtoupper($amt_str)?> ONLY.</div></td></tr>
<tr><td colspan='2'><br><br><br><br><div id='a2' align='right'>Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>
</table></td>
<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
<table align='center' width='100%' cellspacing='0' cellpadding='0' class='forumline'>
<tr><td colspan='2'>
<table align='center' width='100%'cellspacing='0' cellpadding='0' border='1'>
<tr><td align='left' width='85'><img src="../images/logo.jpg" width='85' height='100' border='0'></img></td>
<td align='center'><table border='0' align='center' width='100%' cellspacing='0' cellpadding='0'>
<tr><td align='center' style='font-size:20px;' nowrap><b><?php echo collegename(); ?></td></tr>
<tr><td align='center' style='font-size:10px;' nowrap>(Recognised by Govt. of Karnataka)</td></tr>
<tr><td align='center' style='font-size:10px;' nowrap><?php echo collegeadress(); ?></b></td></tr>
</table></td></tr>
</table></td></tr>
<tr><td colspan='2' valign='top' align='right' style='font-size:10px;'><u>Student Copy</u>&nbsp;&nbsp;</td></tr>
<tr height='25'><td colspan='2' align='center'><font size='2.5'><u>FEE RECEIPT : <?=$tmprd?></u></font></td></tr>
<tr><td align='left'>&nbsp;&nbsp;Receipt No : <?=$docid?></td><td align='right'>Date : <?=$dddate?>&nbsp;&nbsp;</td></tr>
<tr><td colspan='2'>&nbsp;&nbsp;Name : <?=$sql[0]?> <?=$sql[1]?></td></tr>
<tr><td>&nbsp;&nbsp;Class : <?=$sql2[0] ?></td><td align='right'>Admn No : <?=$sql[4] ?>&nbsp;&nbsp;</td>
<tr><td>&nbsp;&nbsp;Roll No : <?=$sql[2]?></td><td align='right'>Payment Mode : <?=$modepay?>&nbsp;&nbsp;</td></tr>
<?php
if($paymenttype==2 or $paymenttype==3)
{
	$bankname=fetcharray(execute("select bank_st_name from bank_details where id='$bname'"));
	echo "<tr><td>&nbsp;&nbsp;Bank Name : $bankname[0]</td>";
	echo "<td align='right'>Branch : $bdet&nbsp;&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;&nbsp;DD/Cheque No. : $ddno</td>";
	echo "<td align='right'>DD/Cheque Date : $dddate2&nbsp;&nbsp;</td></tr>";
}
?>
<tr><td colspan='2'>
<table class='forumline' border='1' align='center' width='100%' cellspacing='0' cellpadding='0'>
<tr><td align='center' width='10%' rowspan='2'>Sl No</td><td align='center' rowspan='2'>Particulars</td><td align='center' colspan='2' width='25%'>Amount</td></tr>
<tr><td align='center' width='17%'>Rs.</td><td align='center' width='3%'>Ps.</td></tr>
<?php
if($rcntt>0)
{
	$sql5=execute("select * from fee_head where course_id='$course' and year_id='$sem' and admission_type='$adm_id' and accyr='$cyr' and status=1 and ftype!=1 order by fid");
}
else
{
	$sql5=execute("select * from fee_head where course_id='$course' and year_id='$sem' and admission_type='$adm_id' and accyr='$cyr' and status=1 order by fid");
}
$sno=1;
for($i=0;$i<rowcount($sql5);$i++)
{
	$r=fetcharray($sql5);
	$aa="pd".$r[fid];
	$a=$_POST['pdfee'.$r[fid]];
	if($a>0)
	{
		if($sno<10)
			$sno="0".$sno;
		echo "<tr><td align='center'>$sno</td>";
		$sql8=fetcharray(execute("select fee_name from fee_type where fee_id='$r[fid]'"));
		echo "<td>&nbsp;&nbsp;$sql8[0]</td>";
		echo "<td align='right'>$a</td><td align='center'>00</td></tr>";
		$sno++;
	}
}
if($oldbalamt>0)
{
	echo "<tr><td colspan='2' align='right'>Old Balance Cleared&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right'>$oldbalamt</td><td align='center'>00</td>";
}
if($fineamt>0)
{
	echo "<tr><td colspan='2' align='right'>Fine Amount&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right'>$fineamt</td><td align='center'>00</td>";
}
if($oexeamt>0)
{
	echo "<tr><td colspan='2' align='right'>Old Excess Payment Cleared&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right'>- $oexeamt</td><td align='center'>00</td>";
}
if($keyfg==1)
{
	if($exeamt>0)
	{
		echo "<tr><td colspan='2' align='right'>Excess Payment&nbsp;&nbsp;&nbsp;</td>";
		echo "<td align='right'>$exeamt</td><td align='center'>00</td>";
		if($cenamt>0)
		{
			echo "<tr><td colspan='2' align='right'>Concession Amount&nbsp;&nbsp;&nbsp;</td>";
			echo "<td align='right'>- $cenamt</td><td align='center'>00</td>";
		}
	}
}
echo "<tr><td colspan='2' align='right'>Paid Amount&nbsp;&nbsp;&nbsp;</td><td align='right'>$ttlamt</td><td align='center'>00</td></tr>";
if($balamt>0)
{
	echo "<tr><td colspan='2' align='right'>Balance Amount&nbsp;&nbsp;&nbsp;</td><td align='right'>$balamt</td><td align='center'>00</td></tr>";
}
?>
</td></tr></table></td></tr>
<tr><td colspan='2'><div id='a1' align='left'>&nbsp;&nbsp;Remarks : <?=stripslashes($remk)?></div></td></tr>
<tr><td colspan='2'><br><div id='a1' align='center'>&nbsp;&nbsp;Received Rupees : <?=strtoupper($amt_str)?> ONLY.</div></td></tr>
<tr><td colspan='2'><br><br><br><br><div id='a2' align='right'>Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>
</table></td></tr>

<?php
if($pdtptfee>0)
{	
	echo "<tr height='40'><td colspan='5'>&nbsp;</td></tr>";
	?>
	<tr><td>
	<table align='center' width='100%' border='0' cellspacing='0' cellpadding='0' class='forumline'>
	<tr><td colspan='2'>
	<table align='center' width='100%'cellspacing='0' cellpadding='0' border='1'>
	<tr><td align='left' width='85'><img src="../images/logo.jpg" width='85' height='100' border='0'></img></td>
	<td align='center'><table border='0' align='center' width='100%' cellspacing='0' cellpadding='0'>
	<tr><td align='center' style='font-size:20px;' nowrap><b><?php echo collegename(); ?></td></tr>
	<tr><td align='center' style='font-size:10px;' nowrap>(Recognised by Govt. of Karnataka)</td></tr>
	<tr><td align='center' style='font-size:10px;' nowrap>M.E.S. Road, Bangalore - 560013</b></td></tr>
	</table></td></tr>
	</table></td></tr>
	<tr><td colspan='2' valign='top' align='right' style='font-size:10px;'><u>Office Copy</u>&nbsp;&nbsp;</td></tr>
	<tr height='25'><td colspan='2' align='center'><font size='2.5'><u>FEE RECEIPT : <?=$tmprd?></u></font></td></tr>
	<tr><td align='left'>&nbsp;&nbsp;Receipt No : <?=$docid?></td><td align='right'>Date : <?=$dddate?>&nbsp;&nbsp;</td></tr>
	<tr><td colspan='2'>&nbsp;&nbsp;Name : <?=$sql[0]?> <?=$sql[1]?></td></tr>
	<tr><td>&nbsp;&nbsp;Class : <?=$sql2[0] ?></td><td align='right'>Admn No : <?=$sql[4] ?>&nbsp;&nbsp;</td>
	<tr><td>&nbsp;&nbsp;Roll No : <?=$sql[2]?></td><td align='right'>Payment Mode : <?=$modepay?>&nbsp;&nbsp;</td></tr>
	<?php
	if($paymenttype==2 or $paymenttype==3)
	{
		$bankname=fetcharray(execute("select bank_st_name from bank_details where id='$bname'"));
		echo "<tr><td>&nbsp;&nbsp;Bank Name : $bankname[0]</td>";
		echo "<td align='right'>Branch : $bdet&nbsp;&nbsp;</td></tr>";
		echo "<tr><td>&nbsp;&nbsp;DD/Cheque No. : $ddno</td>";
		echo "<td align='right'>DD/Cheque Date : $dddate2&nbsp;&nbsp;</td></tr>";
	}
	$amt_str = number_to_words($pdtptfee);
	?>
	<tr><td colspan='2'>
	<table class='forumline' border='1' align='center' width='100%' cellspacing='0' cellpadding='0'>
	<tr><td align='center' width='10%' rowspan='2'>Sl No</td><td align='center' rowspan='2'>Particulars</td><td align='center' colspan='2' width='25%'>Amount</td></tr>
	<tr><td align='center' width='17%'>Rs.</td><td align='center' width='3%'>Ps.</td></tr>
	<tr><td align='center'>01</td><td nowrap>&nbsp;&nbsp;Transportation Fee</td><td align='right'><?=$pdtptfee?></td>
	<td align='center'>00</td></tr>
	<tr><td colspan='2' align='right'>Paid Amount&nbsp;&nbsp;&nbsp;</td><td align='right'><?=$pdtptfee?></td><td align='center'>00</td></tr>
	</td></tr></table></td></tr>
	<tr><td colspan='2'><div id='a1' align='center'>&nbsp;&nbsp;Received Rupees : <?=strtoupper($amt_str)?> ONLY.</div></td></tr>
	<tr><td colspan='2'><br><br><br><br><div id='a2' align='right'>Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>
	</table></td>
	<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
	<table align='center' width='100%' cellspacing='0' cellpadding='0' class='forumline'>
	<tr><td colspan='2'>
	<table align='center' width='100%'cellspacing='0' cellpadding='0' border='1'>
	<tr><td align='left' width='85'><img src="../images/logo.jpg" width='85' height='100' border='0'></img></td>
	<td align='center'><table border='0' align='center' width='100%' cellspacing='0' cellpadding='0'>
	<tr><td align='center' style='font-size:20px;' nowrap><b><?php echo collegename(); ?></td></tr>
	<tr><td align='center' style='font-size:10px;' nowrap>(Recognised by Govt. of Karnataka)</td></tr>
	<tr><td align='center' style='font-size:10px;' nowrap>M.E.S. Road, Bangalore - 560013</b></td></tr>
	</table></td></tr>
	</table></td></tr>
	<tr><td colspan='2' valign='top' align='right' style='font-size:10px;'><u>Student Copy</u>&nbsp;&nbsp;</td></tr>
	<tr height='25'><td colspan='2' align='center'><font size='2.5'><u>FEE RECEIPT : <?=$tmprd?></u></font></td></tr>
	<tr><td align='left'>&nbsp;&nbsp;Receipt No : <?=$docid?></td><td align='right'>Date : <?=$dddate?>&nbsp;&nbsp;</td></tr>
	<tr><td colspan='2'>&nbsp;&nbsp;Name : <?=$sql[0]?> <?=$sql[1]?></td></tr>
	<tr><td>&nbsp;&nbsp;Class : <?=$sql2[0] ?></td><td align='right'>Admn No : <?=$sql[4] ?>&nbsp;&nbsp;</td>
	<tr><td>&nbsp;&nbsp;Roll No : <?=$sql[2]?></td><td align='right'>Payment Mode : <?=$modepay?>&nbsp;&nbsp;</td></tr>
	<?php
	if($paymenttype==2 or $paymenttype==3)
	{
		$bankname=fetcharray(execute("select bank_st_name from bank_details where id='$bname'"));
		echo "<tr><td>&nbsp;&nbsp;Bank Name : $bankname[0]</td>";
		echo "<td align='right'>Branch : $bdet&nbsp;&nbsp;</td></tr>";
		echo "<tr><td>&nbsp;&nbsp;DD/Cheque No. : $ddno</td>";
		echo "<td align='right'>DD/Cheque Date : $dddate2&nbsp;&nbsp;</td></tr>";
	}
	$amt_str = number_to_words($pdtptfee);
	?>
	<tr><td colspan='2'>
	<table class='forumline' border='1' align='center' width='100%' cellspacing='0' cellpadding='0'>
	<tr><td align='center' width='10%' rowspan='2'>Sl No</td><td align='center' rowspan='2'>Particulars</td><td align='center' colspan='2' width='25%'>Amount</td></tr>
	<tr><td align='center' width='17%'>Rs.</td><td align='center' width='3%'>Ps.</td></tr>
	<tr><td align='center'>01</td><td nowrap>&nbsp;&nbsp;Transportation Fee</td><td align='right'><?=$pdtptfee?></td>
	<td align='center'>00</td></tr>
	<tr><td colspan='2' align='right'>Paid Amount&nbsp;&nbsp;&nbsp;</td><td align='right'><?=$pdtptfee?></td><td align='center'>00</td></tr>
	</td></tr></table></td></tr>
	<tr><td colspan='2'><div id='a1' align='center'>&nbsp;&nbsp;Received Rupees : <?=strtoupper($amt_str)?> ONLY.</div></td></tr>
	<tr><td colspan='2'><br><br><br><br><div id='a2' align='right'>Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>
	</table></td></tr>
	<?php
}
//acount intigration code strats

$u1=execute("select * from ac_voucher where iIdx_vouchermaster=1");
		$ru1=rowcount($u1);
		if($ru1>0)
		{
			$n1=$ru1/2;
			if($n1>9)
			{
				$n2='00'.($n1+1);
			}
			else
			{
				$n2='000'.($n1+1);
			}
		}
		else
		{
			$n2='0001';
		}



$cashdetBal=execute("select fopbal from ac_ledger where iIdx_ledger=1");
$traildetBal=execute("select fopbal from ac_ledger where iIdx_ledger=34");
$cashdetBal1=fetchrow($cashdetBal);
$traildetBal1=fetchrow($traildetBal);


$newcashdetBal1=$cashdetBal1[0]-$ttlamt;
$newtraildetBal1=$traildetBal1[0]+$ttlamt;
$newRemarks=strtoupper($amt_str);


execute("update ac_ledger set fopbal='$newcashdetBal1' where iIdx_ledger=1");
execute("update ac_ledger set fopbal='$newtraildetBal1' where iIdx_ledger=34");

execute("INSERT INTO ac_opbal (opdate, Vledger, fopbal, iId_grp, vins, Dr_Cr, iIdx_organization) VALUES
('$dddate1', 'TUTION FEES', $newcashdetBal1, 16, 'Bangalore School', 'Cr', 1),
('$dddate1', 'Cash', $newtraildetBal1, 21, 'Bangalore School', 'Dr', 1)");


execute("INSERT INTO ac_voucher ( iIdx_ledger, iIdx_vouchermaster, iIdx_institution, ddate, Dr_Cr, particulars, chequedd_no, chequedd_date, fdebit, fcredit, vvoucherno, vnarration, acc, iIdx_group, istatus, iIdx_organization, vbillno, dbilldate) VALUES
(1, 2, 1, '$dddate1', 'Cr', 'To TUTION FEES', '', '0000-00-00', '0.00', '$ttlamt', '$n2', '$newRemarks', 'TUTION FEES', 16, 0, 1, '$docid', '$dddate1'),
(34, 2, 1, '$dddate1', 'Dr', 'By Cash', '', '0000-00-00', '$ttlamt', '0.00', '$n2', '$newRemarks', 'Cash', 21, 0, 1, '$docid', '$dddate1')");


//acount intigration code ends

?>
</table></td></tr></table><br>
<div id="prn" align='center'><Input Type="button" Value="<< Print >>" class='bgbutton' onClick="dataprint()">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name='clse' value="<< Close >>" class='bgbutton' onClick="clswnd()"></div>
</body>
</html>