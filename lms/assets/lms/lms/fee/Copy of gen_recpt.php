<html>
<head>
<?php
include("../db.php");
?>
<script language="javascript" type="text/javascript">
function dataprint()
{
	prn.style.display = "none";
	window.print(this.form);
	prn.style.display = "";
}
</script>
</head>
<body >
<form name="frm" method='post' action="fee_add123.php">
<?php
$cdate=date("dmy");
$cdate1=date("d-m-Y");
$cyr=date('Y');
$sql=fetcharray(execute("select max(id) from fee_payment"));
$docid=$sql[0]+1;
$docid="JSSCMS/".$docid."/".$cdate;
$sql=fetcharray(execute("select first_name,last_name,student_id from student_m where id=$stud_id"));
$sql1=fetcharray(execute("select course_abbr from course_m where course_id=$course"));
$sql2=fetcharray(execute("select year_name from course_year where year_id=$sem"));
?>
<table border='1' align=center cellspacing='0' cellpadding='0' class='forumline'>
<tr><td colspan='3' align='center'><img src="../images/feebanner.jpg" width='400' height='70'></img></td><td rowspan='7'>&nbsp;</td><td colspan='3' align='center'><img src="../images/feebanner.jpg" width='400' height='70'></img></td></tr>
<tr><td colspan='3' align='right'><font size='1'>OFFICE COPY</font></td><td colspan='3' align='right'><font size='1'>STUDENT COPY</font></td></tr>
<tr><td colspan='3' align='center'><font size='2.5'>FEE RECEIPT</font></td><td colspan='3' align='center'><font size='2.5'>FEE RECEIPT</font></td></tr>
<tr><td colspan='2' align='left'>Receipt No : <?=$docid?></td><td align='right'>Date : <?=$cdate1?></td><td colspan='2' align='left'>Receipt No : <?=$docid?></td><td align='right'>Date : <?=$cdate1?></td></tr>
<tr><td colspan='3'>Name : <?=$sql[0]?> <?=$sql[1]?></td><td colspan='3'>Name : <?=$sql[0]?> <?=$sql[1]?></td></tr>
<tr><td>Program : <?=$sql1[0]?></td><td>Year : <?=$sql2[0]?></td><td align='right'>SR Number : <?=$sql[2]?></td><td>Programe : <?=$sql1[0]?></td><td>Year : <?=$sql2[0]?></td><td align='right'>SR Number : <?=$sql[2]?></td></tr>
<tr><td colspan='7'><table class='forumline' border='1' align='center' width='100%' cellspacing='0' cellpadding='0'>
<tr><td align='center' width='5%' rowspan='2'>Sl No</td><td align='center' rowspan='2'>Particulars</td><td align='center' colspan='2' width='20%'>Amount</td><td width='1%' rowspan='10'>&nbsp;</td><td align='center' width='5%' rowspan='2'>Sl No</td><td align='center' rowspan='2'>Particulars</td><td align='center' colspan='2' width='15%'>Amount</td></tr>
<tr><td align='center' width='13%'>Rs.</td><td align='center' width='2%'>Ps.</td><td align='center' width='13%'>Rs.</td><td align='center' width='2%'>Ps.</td></tr>
<?php
$sql=execute("select fid from fee_head where course_id='$course' and year_id='$sem' and admission_type='$adm_id' and accyr='$cyr' and status=1 order by fid");
$ttlamt=0;
for($i=0;$i<$fpcnt;$i++)
{
	$r=fetcharray($sql);
	$sql1=fetcharray(execute("select fee_name from fee_type where fee_id=$r[fid]"));
	$sno=$i+1;
	if($sno<10)
		$sno="0".$sno;
	$a1="pdfee".$r[fid];
	$a=$$a1;
	$ttlamt+=$a;
	echo "<tr><td align='center'>$sno</td>";
	echo "<td>&nbsp;&nbsp;$sql1[0]</td>";
	echo "<td align='right'>$a</td><td align='center'>00</td>";
	echo "<td align='center'>$sno</td>";
	echo "<td>&nbsp;&nbsp;$sql1[0]</td>";
	echo "<td align='right'>$a</td><td align='center'>00</td></tr>";
}
if($fineamt!=0)
{
	$ttlamt+=$fineamt;
	echo "<tr><td colspan='2' align='right'>Fine Amount&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right'>$fineamt</td><td align='center'>00</td>";
	echo "<td colspan='2' align='right'>Fine Amount&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='right'>$fineamt</td><td align='center'>00</td></tr>";
}
echo "<tr><td colspan='2' align='right'>Total Amount&nbsp;&nbsp;&nbsp;</td><td align='right'>$ttlamt</td><td align='center'>00</td><td colspan='2' align='right'>Total Amount&nbsp;&nbsp;&nbsp;</td><td align='right'>$ttlamt</td><td align='center'>00</td></tr>";
?>
</td></tr></table></td></tr>
</table><br>
<div id="prn" align='center'><Input Type="button" Value="<< Print >>" class='bgbutton' onclick="dataprint()"></div>
</body>
</html>