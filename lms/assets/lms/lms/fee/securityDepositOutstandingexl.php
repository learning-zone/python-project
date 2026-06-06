<?php
	session_start();
	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: attachment; filename=RefundableFeeReport.xls");
	include("../db.php");
	$a_year=$_POST['a_year'];

	$cdt1=01;
	$cmt1=04;
	$cyr1=$a_year;
	$cdt2=31;
	$cmt2=03;
	$cyr2=$a_year+1;
	$fromdate="$cyr1-$cmt1-$cdt1";
	$todate="$cyr2-$cmt2-$cdt2";

	$fmyr=$cdt1."-".$cmt1."-".$cyr1;
	$toyr=$cdt2."-".$cmt2."-".$cyr2;
	$fmyr1=$cyr1."-".$cmt1."-".$cdt1;
	$toyr1=$cyr2."-".$cmt2."-".$cdt2;
	
?>
<html>
<head>
<title>Fee Summary</title>
</head>
<body>

<table border='1' class='forumline' align='center' width='90%' cellspacing='0' cellpadding='1'>
<tr>
  <td align='center' class='head' colspan='6'>Student wise Refundable Fee Report  
</td>
</tr>
<tr height='30'>
<td height="28" align='center' nowrap Class="rowpic">Sl No</td>
<td Class="rowpic" align='center' nowrap>Student ID</td>
<td Class="rowpic" align='center' nowrap>Admission Id</td>
<td Class="rowpic" align='center' nowrap>Student Name</td>
<td Class="rowpic" align='center' nowrap><?=$_SESSION['semname']?></td>

<td Class="rowpic" align='center' nowrap>Security Deposit</td>
</tr>
<?php
// 	 
	$rs=execute("SELECT a.amount, b.course_yearsem, b.admission_id, b.first_name, b.last_name, b.student_id FROM `fee_refundable` a, student_m b where b.id=a.student_id and a.status=0 and a.refunded=1  order by b.course_yearsem, b.first_name ");
$sno=1;
$fg=0;
$tot=0;
for($i=0;$i<rowcount($rs);$i++)
{
	$r=fetcharray($rs);
	
	$cyr=$r[academic_year];
	$currency=$r[currencyType];
	
	$currencydes=fetchrow(execute("select code from fee_m_currency_code where id='1'"));
	$currencydes1=fetchrow(execute("select code from fee_m_currency_code where id=1"));
		$fg=1;
		if($sno<10)
			$sno="0".$sno;
			$ndate=explode('-', $r[paymentDate]);
		echo "<tr height='23'><td align='center'>$sno</td>";
		?>
        <td align="center"><?php echo $r[student_id] ?></A>		
		  </td>
<td align="center"><?php echo $r[admission_id] ?></A>		
		  </td>
		<td>&nbsp;&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?php echo $r[last_name]?></td>
		<?php
		$cname=fetcharray(execute("select year_name from course_year where year_id='$r[course_yearsem]'"));
		$secname=fetcharray(execute("select section_name from class_section where id='$r[class_section_id]'"));
		/// $secname[0]
		echo "<td align='center'>$cname[0] </td>";
		
		echo "<td align='right'> $currencydes[0] $r[amount]</td></tr>";
		$tot=$tot+$r['amount'];
		$sno++;
	
}
$total=fetchrow(execute("SELECT sum(amount) FROM `fee_refundable` where status=0 and refunded=1"));
		echo "<tr height='23' ><td colspan='5' align='right' ><strong>Total</strong></td><td align='right'><strong> $currencydes[0] $tot</strong></td></tr>";

?>
</table>
</form></body>
</html>