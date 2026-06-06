<?php
	session_start();
	include("../db.php");
	$accYear=$_GET['accYear'];
	$a_year=$accYear;
	$status=$_GET['status'];
	$feeHead=$_GET['feeHead'];
	$division=$_GET['division'];
	$fy=$accYear;
	$fy1=$accYear+1;
	$classname=fetchrow(execute("SELECT year_name FROM `course_year` where year_id='$division'"));
	$feeheadname=fetchrow(execute("SELECT fee_name FROM `fee_type` where fee_id='$feeHead'"));
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

function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=700,width=1000,status=no,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</SCRIPT>
</head>
<body>
<form name="frm" method="post">
<br>
    <table class='forumline' align='center' cellspacing="5" cellpadding="5" width="90%" border="1" >
    <tr>
    <td  align="center" colspan="4" class="head"><?=$classname[0]?> - Compressive <?=$feeheadname[0]?> Report For <?=$fy?>-<?=$fy1?>  
</td>
    </tr>
    <tr>
        <td class="head" align="center">Sl.No</td>
        <td class="head" align="center">Student Id</td>
        <td class="head" align="center">Name</td>
        <td class="head" align="center">Amount</td>
    </tr>
<?php
$k=1;
$sql1=execute("SELECT a.`student_id`, b.first_name, b.last_name,b.student_id FROM `fee_apply_fee_student` a, student_m b  where a.`acc_year`='$a_year' and a.`status`=1 and a.`division`='$division' and a.`student_id`=b.id");
while($r=fetcharray($sql1))
{
	
	$totalinst=0;
	$toamt1=0;	
	$totamt=fetchrow(execute("SELECT totalConverted,id FROM `fee_m_head_inst_collected` where accYear='$a_year' and status=1 and feeHead='$feeHead' and studentId='$r[0]'"));
	if($totamt[1])
	{
		$toamt1=$totamt[0];
		$toamt2=explode('.',$toamt1);
		if(sizeof($toamt2)<2)
		$toamt1=$toamt1.'.00';
		//accYear='$a_year'&status=1&feeHead='$headid[$i]'&division='$r[0]'
		echo "<tr>
				<td >$k</td>
				<td >$r[3]</td>
				<td >$r[1] $r[2]</td>
				<td >$toamt1</td></tr>";
		$k++;
	}
}
?>    
</table>
</form>
</body>
</html>