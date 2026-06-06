<?php
	session_start();
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

$fmyr=$cdt1." ".MonthName($cmt1)." ".$cyr1;
$toyr=$cdt2." ".MonthName($cmt2)." ".$cyr2;
$fmyr1=$cyr1."-".$cmt1."-".$cdt1;
$toyr1=$cyr2."-".$cmt2."-".$cdt2;
?>
<html>
<head>
<SCRIPT LANGUAGE="JavaScript">
function prnfee()
{
	prn.style.display = "none";
	window.print(this.form);
	prn.style.display = " ";
}
function exportexl()
{
	document.frm.action="semfee2.php?branch=$branch&sem=$sem&sect=$sect";
	document.frm.submit();
}
</SCRIPT>
</head>
<body>
<form name="frm" method="post">
<br>
    <table class='forumline' align='center' cellspacing="5" cellpadding="5" width="90%" border="1" >
<?php  

$feehead=execute("SELECT `feeHead` FROM `fee_m_head_inst_collected` where (paymentDate between '$fromdate' and  '$todate' ) and `status`=1 and feeHead!='0' group by `feeHead`  order by `feeHead`");
$in=rowcount($feehead);  
$colspan=$in*2+2;
?>
    <tr>
    	<td Class="head" colspan='<?=$colspan?>' align='center'>
       Financial-Year Wise Fee Report<br>From : <?=$fmyr?> To : <?=$toyr?></td>
    </tr>
<?php  

echo "<tr><td rowspan='2'  align='center' >".$_SESSION['semname']."</td>";
while($r=fetcharray($feehead))
{
	$headid[]=$r[0];
	$feename=fetchrow(execute("SELECT fee_name FROM `fee_type` where fee_id='$r[0]'"));
	echo "<td colspan='2'  align='center'>$feename[0]</td>";
}
echo "<td rowspan='2'  align='center' >Total</td></tr>";

	echo "<tr>";
	for($i=0;$i<sizeof($headid);$i++)
	{
		echo "<td  align='center'>INR</td><td  align='center'>Count</td>";
	}
	echo "</tr>";

$sql1=execute("SELECT `division` FROM `fee_apply_fee_student` where `acc_year`='$a_year' and `status`=1 group by `division` order by `division`");
while($r=fetcharray($sql1))
{
	$classname=fetchrow(execute("SELECT year_name FROM `course_year` where year_id='$r[0]'"));
	$totalinst=0;
	echo "<tr><td  align=''>&nbsp;&nbsp;$classname[0]</td>";
	for($i=0;$i<sizeof($headid);$i++)
	{
		
		$k=0;
		$toamt1=0;
		$sql2=execute("SELECT a.totalConverted FROM `fee_m_head_inst_collected` a, `fee_apply_fee_student` b where (a.paymentDate between '$fromdate' and  '$todate' ) and a.status=1 and a.feeHead='$headid[$i]' and a.studentId=b.student_id and b.`acc_year`='$a_year' and b.`status`=1 and b.division='$r[0]'");
		while($totamt=fetcharray($sql2))
		{
			
				$toamt1=$toamt1+$totamt[0];
				$k++;
			
		}
		$toamt2=explode('.',$toamt1);
		if(sizeof($toamt2)<2)
		$toamt1=$toamt1.'.00';
		echo "<td align='right'>$toamt1</td><td  align='center'>$k</td>";
		$totalinst=$toamt1+$totalinst;
		
	}
		$totalinst1=explode('.',$totalinst);
		if(sizeof($totalinst1)<2)
		$totalinst=$totalinst.'.00';
	echo "<td  align='right'>$totalinst</td></tr>";
}

echo "<tr><td  align=''>&nbsp;&nbsp;Total</td>";
	for($i=0;$i<sizeof($headid);$i++)
	{
		
		$totamt=fetchrow(execute("SELECT sum(a.totalConverted) FROM `fee_m_head_inst_collected` a,fee_apply_fee_student b where (a.paymentDate between '$fromdate' and  '$todate' ) and a.status=1 and a.feeHead='$headid[$i]' and  a.accYear=b.acc_year and b.status=1 and a.studentId=b.student_id"));
		
		$totalinst1=explode('.',$totamt[0]);

		if(sizeof($totalinst1)<2)
		$grandtot=$totamt[0].'.00';
		else
		$grandtot=$totamt[0];
		
		echo "<td align='right'>$grandtot</td><td  align='center'></td>";
		$got=$got+$grandtot;
	}
		$totalinst1=explode('.',$got);
		if(sizeof($totalinst1)<2)
		$got=$got.'.00';
	echo "<td align='right'>$got</td></tr>";
	
	
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
</table>
</form>
</body>
</html>