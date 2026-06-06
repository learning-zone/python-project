<html>
<head>
<title>Cancel Fee Receipt</title>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<?php
	session_start();
	include("../db.php");
?>
</head>
<body>
<?php
$cyr=$temp_year_detalis;
$sql="select id,docid,pdamt,pay_dt from fee_payment where studid='$stud_id' and recptstatus=0 and accyr='$cyr' order by id desc";
$rs=execute($sql) or die(mysql_error());
if(rowcount($rs)==0)
{
	echo "<font color=brown><b>No Fee Details for this Student !!</b></font>";
	die();
}
$rs1=fetcharray(execute("select student_id,first_name,last_name,course_admitted,course_yearsem from student_m where id='$stud_id'"));
$rs2=fetcharray(execute("select course_abbr from course_m where course_id=$rs1[3]"));
$rs3=fetcharray(execute("select year_name from course_year where year_id=$rs1[4]"));
?>
<form name="frm" method="post">
<table border=1 class=forumline align=center width='50%' cellspacing='0' cellpadding='1'>
<tr><td align='center' class='head' colspan='5'><font size="4"><b>Fee Payment Details</b></font></td></tr>
<tr><td nowrap>&nbsp;Student ID</td><td nowrap>&nbsp;<?=$rs1[0]?></td><td nowrap>&nbsp;Student Name</td><td nowrap>&nbsp;<?=$rs1[1]?> <?=$rs1[2]?></td></tr>
<tr><td nowrap>&nbsp;Course</td><td nowrap>&nbsp;<?=$rs2[0]?></td>
<td>&nbsp;Semester</td><td>&nbsp;<?=$rs3[0]?></td></tr>
<tr><td align='center' colspan='5'><font color='brown'><b>*** Click on Receipt No to Cancel the Fee Receipt ***</b></font></td></tr>
<tr height='30'>
<td align='center' Class="rowpic" nowrap>Sl No</td>
<td align='center' Class="rowpic" nowrap>Receipt No.</td>
<td align='center' Class="rowpic" nowrap>Payment Date</td>
<td align='center' Class="rowpic" nowrap>Remited Amount</td></tr>
<?php
$sno=1;
for($i=0;$i<rowcount($rs);$i++)
{
	 $r=fetcharray($rs);
	 $rptdt1=explode("-",$r[3]);
	 $rptdt=$rptdt1[2]."-".$rptdt1[1]."-".$rptdt1[0];
	 if($sno<10)
		 $sno="0".$sno;
	?>
	<tr height='23'>
	<td align='center'><?=$sno?></td>
		<td nowrap>&nbsp;
		   <A HREF="cancelfee.php?mid=<?php echo $r[0]?>"><?php echo $r[1] ?></A>		
		  </td>
		<td align='center' nowrap><?=$rptdt?></td>
		<td align='right'><?=$r[2]?>-00</td>
	</tr>
	<?php
	$sno++;
}
?>
</table>
</form>
</body>
</html>