<html>
<head>
<title>Addl Fee Receipt</title>
<?php
session_start();
include("../db.php");
include("numbers-words.php");
$course=$_POST['course'];
$sem=$_POST['sem'];
$mid=$_POST['mid'];
$stud_id=$_POST['stud_id'];
$adm_id=$_POST['adm_id'];
$cexeamt=$_POST['cexeamt'];
$paymenttype=$_POST['paymenttype'];
$pdt=$_POST['pdt'];
$pmt=$_POST['pmt'];
$pyr=$_POST['pyr'];
$amt=$_POST['amt'];
$fnamt=$_POST['fnamt'];
$fineamt=$_POST['fineamt'];
$ttldedamt=$_POST['ttldedamt'];
$ttlpdamt=$_POST['ttlpdamt'];
$cenamt=$_POST['cenamt'];
$balamt=$_POST['balamt'];
$exeamt=$_POST['exeamt'];
$remk=$_POST['remk'];
$actbalamt=$_POST['actbalamt'];
$ffd=$_POST['ffd'];

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

$dddate=$_POST['pdt']."-".$_POST['pmt']."-".$_POST['pyr'];
$dddate1=$_POST['pyr']."-".$_POST['pmt']."-".$_POST['pdt'];
$cdate=date("dmy");
$tdt=date("Y-m-d");
$cyr=$_SESSION['AcademicYear'];;
$sql=fetcharray(execute("select max(id) from fee_payment"));
$docid=$sql[0]+1;
$docid=$_SESSION['SchoolCode']."/FR/".$docid;

$sql=fetcharray(execute("select first_name,last_name,student_id,course_admitted,course_yearsem from student_m where id=$stud_id"));
$sql1=fetcharray(execute("select course_abbr from course_m where course_id=$sql[course_admitted]"));
$sql2=fetcharray(execute("select year_name from course_year where year_id=$sql[course_yearsem]"));

if($paymenttype==1)
	$modepay="Cash";
elseif($paymenttype==2)
	$modepay="Demand Draft";
elseif($paymenttype==3)
	$modepay="Bank Challan";
$uid=fetcharray(execute("select id from users where username='$user'"));
$msg="ADITIONAL FEE RECEIPT";

if($actbalamt<0)
	$actbalamt=0;
$sql3="insert into fee_payment (fmid,studid,pid,sid,admid,docid,bfexeamt,pdamt,docamt,mop,pay_dt,bkid,ddno,fnamt,cenamt,balamt,exeamt,ins_dt,remks,uid,accyr) values ('$mid','$stud_id','$course','$sem','$adm_id','$docid','0','$amt',$ttlpdamt,'$paymenttype','$dddate1','$bname','$ddno','$fineamt','$cenamt','$actbalamt','$exeamt','$tdt','".addslashes($remk)."','$uid[0]','$cyr')";

execute($sql3) or die("Failed to insert data1");

if($actbalamt>0)
	$pstatus=1;
else
	$pstatus=0;

$rs=fetcharray(execute("select fnamt,cenamt from fee_master where id='$mid'"));
$fnamt1=$rs[fnamt]+$fnamt;
$cenamt1=$rs[cenamt]+$cenamt;
$exeamt1=$exeamt;

$sql4=execute("update fee_master set fnamt='$fnamt1',cenamt='$cenamt1',balamt='$actbalamt',exeamt='$exeamt1',pstatus='$pstatus' where id='$mid'") or die ("Failed to update data2");
?>
<table align='center' cellspacing='0' cellpadding='0' class='forumline'>
<tr><td>
<table align='center' cellspacing='0' cellpadding='0' class='forumline'>
<tr><td colspan='2'>
<table class='forumline' border='1' align='center' width='100%' cellspacing='0' cellpadding='0'>
<tr><td align='center'><img src="../images/logo.jpg" width='100' height='100' border='1'></img></td>
<td align='center' style='font-size:14px;' nowrap><b>
<?php 
echo $_SESSION['SchoolName'];
echo "<br>".$_SESSION['SchoolAddress'];

 ?></b></td></tr>
</table></td></tr>
<tr><td colspan='2' valign='top' align='right' style='font-size:10px;'><u>Office Copy</u>&nbsp;&nbsp;</td></tr>
<tr height='25'><td colspan='2' align='center'><font size='2.5'><u>ADDITIONAL FEE RECEIPT</u></font></td></tr>
<tr><td align='left'>&nbsp;&nbsp;Receipt No : <?=$docid?></td><td align='right'>Date : <?=$dddate?>&nbsp;&nbsp;</td></tr>
<tr><td colspan='2'>&nbsp;&nbsp;Name : <?=$sql[0]?> <?=$sql[1]?></td></tr>
<tr><td>&nbsp;&nbsp;Course : <?=$sql1[0]?></td><td align='right'>Semester : <?=$sql2[0]?>&nbsp;&nbsp;</td>
<tr><td>&nbsp;&nbsp;Student ID : <?=$sql[2]?></td><td align='right'>Payment Mode : <?=$modepay?>&nbsp;&nbsp;</td></tr>
<?php
if($paymenttype==2 or $paymenttype==3)
{
	$bankname=fetcharray(execute("select bank_st_name from bank_details where id=$bname"));
	echo "<tr><td>&nbsp;&nbsp;Bank Name : $bankname[0]</td>";
	echo "<td align='right'>DD/Challan No. : $ddno&nbsp;&nbsp;</td></tr>";
}
$pdcatttl='';
$ids='';
while(list(,$Value) = each($ffd))
{
	if($ids=='')
		$ids=$Value;
	else
		$ids=$ids.",".$Value;
	$a=$_POST["pdfee".$Value];
	if($a>0)
	{
		$b="pd".$Value;
		$ttlamt+=$a;
		$sql6=fetcharray(execute("select catid from fee_type where fee_id=$Value"));
		$ctid=$sql6[0];
		$pdcatttl[$ctid]+=$a;
		$sql3="update fee_payment set $b=$a where docid='$docid'";
		execute($sql3) or die ("Failed to update data3");
	}
}
?>
<tr><td colspan='2'><table class='forumline' border='1' align='center' width='100%' cellspacing='0' cellpadding='0'>
<tr><td align='center' width='10%' rowspan='2'>Sl No</td><td align='center' rowspan='2'>Particulars</td><td align='center' colspan='2' width='25%'>Amount</td></tr>
<tr><td align='center' width='17%'>Rs.</td><td align='center' width='3%'>Ps.</td></tr>
<?php
$sql5=execute("select * from fee_master where id='$mid'");
$r=fetcharray($sql5);
$tpdfee=$r[ttlpd];
$ccsql=execute("select distinct(catid) from fee_type where fee_id in ($ids) order by catid") or die ("Failed to update data4");
$sno=1;
for($i=0;$i<rowcount($ccsql);$i++)
{
	$rr=fetcharray($ccsql);
	$aa=$rr[0];
	$sql8=fetcharray(execute("select cat_name from fee_cat where catid=$aa"));
	$a=$pdcatttl[$aa];
	if($a>0)
	{
		$pp="pfee".$aa;
		$pdfeeamt=$r[$pp]+$a;
		$tpdfee+=$a;
		$sql4="update fee_master set $pp='$pdfeeamt' where id='$mid'";
		execute($sql4) or die ("Failed to update data3");

		$sql4="update fee_payment set pdcat".$aa."='$a' where docid='$docid'";
		execute($sql4) or die ("Failed to update data4");

		if($sno<10)
			$sno="0".$sno;
		echo "<tr><td align='center'>$sno</td>";
		echo "<td>&nbsp;&nbsp;$sql8[0]</td>";
		echo "<td align='right'>$a</td><td align='center'>00</td></tr>";
		$sno++;
	}
}
$sql4="update fee_master set ttlpd='$tpdfee' where id='$mid'";
execute($sql4) or die ("Failed to update data5");
if($fineamt!=0)
{
	$ttlamt+=$fineamt;
	echo "<tr><td colspan='2' align='right'>Fine Amount&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right'>$fineamt</td><td align='center'>00</td>";
}
if($cexeamt>0)
{
	$ttlamt-=$cexeamt;
	echo "<tr><td colspan='2' align='right'>Old Excess Payment Cleared&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right'>- $cexeamt</td><td align='center'>00</td>";
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
if($actbalamt>0)
{
	echo "<tr><td colspan='2' align='right'>Balance Amount&nbsp;&nbsp;&nbsp;</td><td align='right'>$actbalamt</td><td align='center'>00</td></tr>";
}
?>
</td></tr></table></td></tr>
<tr><td colspan='2'><div id='a1' align='center'>&nbsp;&nbsp;Received Rupees : <?=strtoupper($amt_str)?> ONLY.</div></td></tr>
<tr><td colspan='2'><br><br><br><br><div id='a2' align='right'>Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>
</table></td>
<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
<table align='center' cellspacing='0' cellpadding='0' class='forumline'>
<tr><td colspan='2'>
<table class='forumline' border='1' align='center' width='100%' cellspacing='0' cellpadding='0'>
<tr><td align='center'><img src="../images/logo.jpg" width='100' height='100' border='1'></img></td>
<td align='center' style='font-size:14px;' nowrap><b>Vidyavardhaka College of Engineering<br>Gokulam 3rd Stage, Mysore<br>Phone : 0821-4276200<br>E-Mail : ao@vvce.ac.in</b></td></tr>
</table></td></tr>
<tr><td colspan='2' valign='top' align='right' style='font-size:10px;'><u>Student Copy</u>&nbsp;&nbsp;</td></tr>
<tr height='25'><td colspan='2' align='center'><font size='2.5'><u>ADDITIONAL FEE RECEIPT</u></font></td></tr>
<tr><td align='left'>&nbsp;&nbsp;Receipt No : <?=$docid?></td><td align='right'>Date : <?=$dddate?>&nbsp;&nbsp;</td></tr>
<tr><td colspan='2'>&nbsp;&nbsp;Name : <?=$sql[0]?> <?=$sql[1]?></td></tr>
<tr><td>&nbsp;&nbsp;Course : <?=$sql1[0]?></td><td align='right'>Semester : <?=$sql2[0]?>&nbsp;&nbsp;</td>
<tr><td>&nbsp;&nbsp;Student ID : <?=$sql[2]?></td><td align='right'>Payment Mode : <?=$modepay?>&nbsp;&nbsp;</td></tr>
<?php
if($paymenttype==2 or $paymenttype==3)
{
	echo "<tr><td>&nbsp;&nbsp;Bank Name : $bankname[0]</td>";
	echo "<td align='right'>DD/Challan No. : $ddno&nbsp;&nbsp;</td></tr>";
}
?>
<tr><td colspan='2'>
<table class='forumline' border='1' align='center' width='100%' cellspacing='0' cellpadding='0'>
<tr><td align='center' width='10%' rowspan='2'>Sl No</td><td align='center' rowspan='2'>Particulars</td><td align='center' colspan='2' width='25%'>Amount</td></tr>
<tr><td align='center' width='17%'>Rs.</td><td align='center' width='3%'>Ps.</td></tr>
<?php
$ccsql=execute("select distinct(catid) from fee_type where fee_id in ($ids) order by catid") or die ("Failed to update data4");
$sno=1;
for($i=0;$i<rowcount($ccsql);$i++)
{
	$rr=fetcharray($ccsql);
	$aa=$rr[0];
	$sql8=fetcharray(execute("select cat_name from fee_cat where catid=$aa"));
	$a=$pdcatttl[$aa];
	if($a>0)
	{
		if($sno<10)
			$sno="0".$sno;
		echo "<tr><td align='center'>$sno</td>";
		echo "<td>&nbsp;&nbsp;$sql8[0]</td>";
		echo "<td align='right'>$a</td><td align='center'>00</td></tr>";
		$sno++;
	}
}
if($fineamt>0)
{
	echo "<tr><td colspan='2' align='right'>Fine Amount&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right'>$fineamt</td><td align='center'>00</td>";
}
if($cexeamt>0)
{
	echo "<tr><td colspan='2' align='right'>Old Excess Payment Cleared&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right'>- $cexeamt</td><td align='center'>00</td>";
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
if($actbalamt>0)
{
	echo "<tr><td colspan='2' align='right'>Balance Amount&nbsp;&nbsp;&nbsp;</td><td align='right'>$actbalamt</td><td align='center'>00</td></tr>";
}
?>
</td></tr></table></td></tr>
<tr><td colspan='2'><div id='a1' align='center'>&nbsp;&nbsp;Received Rupees : <?=strtoupper($amt_str)?> ONLY.</div></td></tr>
<tr><td colspan='2'><br><br><br><br><div id='a2' align='right'>Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>
</table></td></tr></table><br>
<div id="prn" align='center'><Input Type="button" Value="<< Print >>" class='bgbutton' onClick="dataprint()">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name='clse' value="<< Close >>" class='bgbutton' onClick="clswnd()"></div>
</body>
</html>