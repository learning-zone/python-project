<html>
<head>
<?php
include("../db.php");
include("numbers-words.php");
?>
<script language="javascript" type="text/javascript">
function dataprint()
{
	prn.style.display = "none";
	window.print(this.form);
	prn.style.display = "";
}
function clswnd()
{
	window.close();
}
</script>
<style type="text/css" media="print">
@pageland { size :8.5in 11in in landscape;
			Margin:0.25in; }
			body { page:land; }
</style>
</head>
<body >
<form name="frm" method='post'>
<?php
$dddate=$pdt."-".$pmt."-".$pyr;
$dddate1=$pyr."-".$pmt."-".$pdt;
$cdate=date("dmy");
$cdate1=date("d-m-Y");
$tdt=date("Y-m-d");
$cyr=$curyr1;
$sql=fetcharray(execute("select max(id) from fee_payment"));
$docid=$sql[0]+1;
$docid="JSSCMS/".$docid."/".$cdate;
$sql=fetcharray(execute("select first_name,last_name,student_id from student_m where id=$stud_id"));
$sql1=fetcharray(execute("select course_abbr from course_m where course_id=$course"));
$sql2=fetcharray(execute("select year_name from course_year where year_id=$sem"));
if($paymenttype==1)
	$modepay="Cash";
elseif($paymenttype==2)
	$modepay="Demand Draft";
elseif($paymenttype==3)
	$modepay="Bank Challan";

$sql3="insert into fee_payment (studid,pid,sid,admid,docid,bfexeamt,pdamt,docamt,mop,pay_dt,bkid,ddno,noffeetype,fnamt,cenamt,balamt,exeamt,ins_dt,remks) values ('$stud_id','$course','$sem','$adm_id','$docid','$oexeamt','$amt','$ttlpdamt','$paymenttype','$dddate1','$bname','$ddno','$fpcnt','$fineamt','$cenamt','$balamt','$exeamt','$tdt','".addslashes($remk)."')";
execute($sql3) or die("Failed to insert data1");

if($balamt>0)
	$pstatus=1;
else
	$pstatus=0;
if($oexeamt>0)
{
	$upsql=execute("update fee_master set exeamt=0 where studid='$stud_id' and exeamt > 0") or die ("Failed to clear old excess payment");
}
$sql4=execute("insert into fee_master (studid,pid,sid,admid,fnamt,cenamt,balamt,exeamt,accyr,pstatus) values ('$stud_id','$course','$sem','$adm_id','$fnamt','$cenamt','$balamt','$exeamt','$cyr','$pstatus')") or die ("Failed to update data2");
$insid=fetchInsertId();

$sql5=execute("select fid from fee_head where course_id='$course' and year_id='$sem' and admission_type='$adm_id' and accyr='$cyr' and status=1 order by fid");
for($i=0;$i<rowcount($sql5);$i++)
{
	$r=fetcharray($sql5);
	$b1="dedfee".$r[fid];
	$b=$$b1;
	$d="dfee".$r[fid];
	$sql6=execute("update fee_master set $d=$b where id='$insid' ");
}
$upsql=execute("update student_m set feeflag='1' where id='$stud_id'") or die ("Failed");
?>
<table align=center cellspacing='0' cellpadding='0' class='forumline'>
<tr><td colspan='3' align='center'><img src="../images/feebanner.jpg" width='500' height='80'></img></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan='3' align='center'><img src="../images/feebanner.jpg" width='500' height='80'></img></td></tr>
<tr><td colspan='3' align='center'><font size='2.5'>FEE RECEIPT</font>
</td><td>&nbsp;</td><td colspan='3' align='center'><font size='2.5'>FEE RECEIPT</font></td></tr>
<tr><td colspan='3' align='right'><font size='1.5'>Office Copy&nbsp;&nbsp;</font>
</td><td>&nbsp;</td><td colspan='3' align='right'><font size='1.5'>Student Copy&nbsp;&nbsp;</font></td></tr>
<tr><td colspan='2' align='left'>&nbsp;&nbsp;Receipt No : <?=$docid?></td><td align='right'>Date : <?=$cdate1?>&nbsp;&nbsp;</td>
<td>&nbsp;</td><td colspan='2' align='left'>&nbsp;&nbsp;Receipt No : <?=$docid?></td><td align='right'>Date : <?=$cdate1?>&nbsp;&nbsp;</td></tr>
<tr><td colspan='3'>&nbsp;&nbsp;Name : <?=$sql[0]?> <?=$sql[1]?></td>
<td>&nbsp;</td><td colspan='3'>&nbsp;&nbsp;Name : <?=$sql[0]?> <?=$sql[1]?></td></tr>
<tr><td>&nbsp;&nbsp;Program : <?=$sql1[0]?></td><td>&nbsp;&nbsp;Year : <?=$sql2[0]?></td><td align='right'>SR Number : <?=$sql[2]?>&nbsp;&nbsp;</td>
<td>&nbsp;</td><td>&nbsp;&nbsp;Program : <?=$sql1[0]?></td><td>&nbsp;&nbsp;Year : <?=$sql2[0]?></td><td align='right'>SR Number : <?=$sql[2]?>&nbsp;&nbsp;</td></tr>
<tr><td>&nbsp;&nbsp;Payment Mode : <?=$modepay?></td>
<?php
if($paymenttype==2 or $paymenttype==3)
{
	$bankname=fetcharray(execute("select bank_name from bank_details where id='$bname'"));
	echo "<td colspan='2'>&nbsp;&nbsp;Bank Name : $bankname[0]</td>";
	echo "<td>&nbsp;</td><td>&nbsp;&nbsp;Payment Mode : $modepay</td>";
	echo "<td colspan='2'>&nbsp;&nbsp;Bank Name : $bankname[0]</td></tr>";
	echo "<tr><td>&nbsp;&nbsp;DD/Challan No. : $ddno</td><td colspan='2'>&nbsp;&nbsp;Dated : $dddate</td>";
	echo "<td>&nbsp;</td><td>&nbsp;&nbsp;DD/Challan No. : $ddno</td><td colspan='2'>&nbsp;&nbsp;Dated : $dddate</td></tr>";
}
else
{
	echo "<td colspan='2'>&nbsp;</td>";
	echo "<td>&nbsp;</td><td>&nbsp;&nbsp;Payment Mode : $modepay</td>";
	echo "<td colspan='2'>&nbsp;</td></tr>";
}
$sqcat=execute("select catid from fee_cat order by catid");
for($i=1;$i<=rowcount($sqcat);$i++)
{
	$ttl[$i]=0;
}
$sql=execute("select fid from fee_head where course_id='$course' and year_id='$sem' and admission_type='$adm_id' and accyr='$cyr' and status=1 order by fid");
$ttlamt=0;
for($i=1;$i<=$fpcnt;$i++)
{
	$r=fetcharray($sql);
	$sql1=fetcharray(execute("select fee_name,catid from fee_type where fee_id=$r[fid]"));
	
	$a1="pdfee".$r[fid];
	$a=$$a1;
	$ttlamt+=$a;
	$sql3="update fee_payment set fid$i=$r[fid],famt$i=$a where docid='$docid'";
	execute($sql3) or die ("Failed to update data3");
	$sql4="update fee_master set pfee$r[fid]=$a where id='$insid'";
	execute($sql4) or die ("Failed to update data3");
	$ctid=$sql1[1];
	$ttl[$ctid]=$ttl[$ctid]+$a;
}
?>
<tr><td colspan='3'>
<table border='1' class='forumline' align='center' width='100%' cellspacing='0' cellpadding='0'>
<tr><td align='center' width='10%' rowspan='2'>Sl No</td><td align='center' rowspan='2'>Particulars</td><td align='center' colspan='2' width='25%'>Amount</td></tr>
<tr><td align='center' width='17%'>Rs.</td><td align='center' width='3%'>Ps.</td></tr>
<?php
$sqcat=execute("select cat_name from fee_cat order by catid");
$sno=1;
for($i=1;$i<=rowcount($sqcat);$i++)
{
	$rcat=fetcharray($sqcat);
	if($ttl[$i]>0)
	{
		if($sno<10)
			$sno="0".$sno;
		echo "<tr><td align='center'>$sno</td>";
		echo "<td>&nbsp;&nbsp;$rcat[0]</td>";
		echo "<td align='right'>$ttl[$i]</td><td align='center'>00</td></tr>";
		$sno++;
	}
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
	}
	if($cenamt>0)
	{
		$ttlamt-=$cenamt;
		echo "<tr><td colspan='2' align='right'>Concession Amount&nbsp;&nbsp;&nbsp;</td>";
		echo "<td align='right'>- $cenamt</td><td align='center'>00</td>";
	}
}
echo "<tr><td colspan='2' align='right'>Paid Amount&nbsp;&nbsp;&nbsp;</td><td align='right'>$ttlamt</td><td align='center'>00</td></tr>";
?>
</td></tr></table></td><td>&nbsp;</td>
<td colspan='3'>
<table border='1' class='forumline' align='center' width='100%' cellspacing='0' cellpadding='0'>
<tr><td align='center' width='10%' rowspan='2'>Sl No</td><td align='center' rowspan='2'>Particulars</td><td align='center' colspan='2' width='25%'>Amount</td></tr>
<tr><td align='center' width='17%'>Rs.</td><td align='center' width='3%'>Ps.</td></tr>
<?php
$sqcat=execute("select cat_name from fee_cat order by catid");
$sno=1;
for($i=1;$i<=rowcount($sqcat);$i++)
{
	$rcat=fetcharray($sqcat);
	if($ttl[$i]>0)
	{
		if($sno<10)
			$sno="0".$sno;
		echo "<tr><td align='center'>$sno</td>";
		echo "<td>&nbsp;&nbsp;$rcat[0]</td>";
		echo "<td align='right'>$ttl[$i]</td><td align='center'>00</td></tr>";
		$sno++;
	}
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
	}
	if($cenamt>0)
	{
		echo "<tr><td colspan='2' align='right'>Concession Amount&nbsp;&nbsp;&nbsp;</td>";
		echo "<td align='right'>- $cenamt</td><td align='center'>00</td>";
	}
}
echo "<tr><td colspan='2' align='right'>Paid Amount&nbsp;&nbsp;&nbsp;</td><td align='right'>$ttlamt</td><td align='center'>00</td></tr>";
$amt_str = number_to_words($ttlamt);
?>
</td></tr></table></td></tr>
<tr><td colspan='3'><div id='a1' align='center'>&nbsp;&nbsp;Received Rupees : <?=strtoupper($amt_str)?> ONLY.</div></td>
<td>&nbsp;</td><td colspan='3'><div id='a1' align='center'>&nbsp;&nbsp;Received Rupees : <?=strtoupper($amt_str)?> ONLY.</div></td></tr>
<tr><td colspan='3'><br><br><br><div id='a2' align='right'>Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
<td>&nbsp;</td><td colspan='3'><br><br><br><div id='a2' align='right'>Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>
</table><br>
<div id="prn" align='center'><Input Type="button" Value="<< Print >>" class='bgbutton' onclick="dataprint()">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name='clse' value="<< Close >>" class='bgbutton' onclick="clswnd()"></div>
</body>
</html>