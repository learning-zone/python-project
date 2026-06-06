<?php
	session_start();
	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: attachment; filename=StudentwiseFeeRegister.xls");


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

?>

<html>
<head>
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>

<script LANGUAGE="JavaScript">
function frm_reload()
{
	document.frm.action='studfeerpt.php';
	document.frm.submit();
} 

function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=700,width=1000,status=no,toolbar=no,scrollbars=yes,menubar=no,location=no');
}

</script>
</head>
<body>
<form method='post' name="frm" >

<?php

//$studfname=$_POST['studfname'];
	//$app_no
$studfname=$_POST['studfname'];
	$app_no=$_POST['app_no'];
    $stundentid=$_POST['stundentid'];
    $receiptno=$_POST['receiptno'];	
	
/*  $sql="select a.student_id, a.first_name, a.last_name, a.admission_type, c.division , a.academic_year, a.class_section_id ,b.id, b.currencyType, 
b.amountCleared , b.clearedDate, b.amountCleared, b.receipt ,b.modeOfPament, b.installmentId from student_m a , fee_m_collect b,fee_apply_fee_student c where  a.id=b.studentId and b.accYear=c.acc_year and ((currencyType=1 and modeOfPament!=1) or (currencyType!=1)) 
and a.id=c.student_id and  c.status='1' and  b.status='1' and (b.paymentDate between '$fromdate' and  '$todate' )";
	
	echo $sql.=" order by c.division , a.first_name";
*/	
/* old code 
$sql="select a.student_id, a.first_name, a.last_name, a.admission_type, c.division , a.academic_year, a.class_section_id ,b.id, b.currencyType, 
b.amountCleared , b.clearedDate, b.amountCleared, b.receipt ,b.modeOfPament, b.installmentId from student_m a , fee_m_collect b,fee_apply_fee_student c where  a.id=b.studentId and b.accYear=c.acc_year and b.amountCleared>0 
and a.id=c.student_id and  c.status='1' and  b.status='1' and (b.paymentDate between '$fromdate' and  '$todate' )";
	
$sql.=" order by c.division , a.first_name";

*/
$sql="select a.student_id, a.first_name, a.last_name, a.admission_type, c.division , a.academic_year, a.class_section_id ,b.id, b.currencyType, 
b.amountCleared , b.clearedDate, b.amountCleared, b.receipt ,b.modeOfPament, b.installmentId from student_m a , fee_m_collect b,fee_apply_fee_student c where  a.id=b.studentId and b.accYear=c.acc_year and b.amountCleared>0 
and a.id=c.student_id and  c.status='1' and  b.status='1' and (b.accYear='$a_year' or (b.paymentDate between '$fromdate' and  '$todate' ))";
$sql.=" order by c.division , a.first_name";


$rs=execute($sql);
	if(rowcount($rs)==0)
	{
		echo "<b>No Student Records Found !!</b>";
		die();
	}

	 $adate=date("d/m/Y");

?>
<table border=1 class=forumline align=center width='90%' cellspacing='0' cellpadding='1'>
<tr><td align='center' class='head' colspan='7'>Student wise  Fee Register   
</td>
</tr>
<tr height='30'>
<td height="28" align='center' nowrap Class="rowpic">Sl No</td>
<td Class="rowpic" align='center' nowrap>Student ID</td>
<td Class="rowpic" align='center' nowrap>Student Name</td>
<?php
$sqlid=execute("SELECT fee_id, fee_name FROM `fee_type` where status=1 and refund='0'");
while($r1=fetcharray($sqlid))
{
	echo "<td Class='rowpic' align='center' nowrap>$r1[1]</td>";
	
}
?>
<td Class="rowpic" align='center' nowrap>Total</td>
</tr>
<?php
$sno=1;
$fg=0;
$flag=0;
for($i=0;$i<rowcount($rs);$i++)
{
	$r=fetcharray($rs);
	
	
	$cyr=$r[academic_year];
	$currency=$r[currencyType];
	$currencydes=fetchrow(execute("select code from fee_m_currency_code where id='1'"));
	$currencydes1=fetchrow(execute("select code from fee_m_currency_code where id=1"));
	$cname=fetcharray(execute("select year_name from course_year where year_id='$r[division]'"));
	$grade=$r[division];
	if($grade!=$grade1)
	{
			if($flag)
			{
				$maxtot=0;
				$sqlid=execute("SELECT fee_id FROM `fee_type` where status=1  and refund='0'");
				while($r1=fetcharray($sqlid))
				{
					$val=$r1[0];
					$sizeval=explode('.',$detval1[$val]);
					$valsize=sizeof($sizeval);
					if($valsize==1)
					$detval1[$val]=$detval1[$val].'.00';
	
					$maxtot=$detval1[$val]+$maxtot;
				
					echo "<td align='right' >$detval1[$val]</td>";
					$detval1[$val]=0;
				}
			echo "<td align='right'>$maxtot $currencydes[0]</td></tr>";
			$flag=0;
			}
		
			
		if($i)
		{
			echo "<tr><td align='center' colspan='3'>Total</td>";
			$sqlid=execute("SELECT fee_id FROM `fee_type` where status=1  and refund='0'");
			while($r1=fetcharray($sqlid))
			{
				$val=$r1[0];
				$sizeval=explode('.',$sumval[$val]);
				$valsize=sizeof($sizeval);
				if($valsize==1)
				$sumval[$val]=$sumval[$val].'.00';
			
				echo "<td align='right' >$sumval[$val]</td>";
				$sumval[$val]=0;
			}
			$sizeval=explode('.',$sumval[0]);
			$valsize=sizeof($sizeval);
			if($valsize==1)
			$sumval[0]=$sumval[0].'.00';
		
			echo "<td align='right' >$sumval[0]</td>";
			$sumval[0]=0;
			echo "</tr>";
			echo "<tr><td align='center' colspan='7'>&nbsp;</td></tr>";
		}
		?>
		<tr><td align='center' class='rowpic' colspan='7'><?=$cname[0]?></td></tr>
		<?php



	}
	$fg=1;
		$stundetidifo=fetchrow(execute("SELECT `studentId` FROM `fee_m_collect` where `receipt`='$r[receipt]'"));
if($stundetidifo1!=$stundetidifo[0])
{

		if($flag)
		{
			$maxtot=0;
			$sqlid=execute("SELECT fee_id FROM `fee_type` where status=1  and refund='0'");
			while($r1=fetcharray($sqlid))
			{
				$val=$r1[0];
				$sizeval=explode('.',$detval1[$val]);
				$valsize=sizeof($sizeval);
				if($valsize==1)
				$detval1[$val]=$detval1[$val].'.00';

				$maxtot=$detval1[$val]+$maxtot;
			
				echo "<td align='right' >$detval1[$val]</td>";
				$detval1[$val]=0;
			}
		echo "<td align='right'>$maxtot $currencydes[0]</td></tr>";
		}
}
if($stundetidifo1!=$stundetidifo[0])
{
		
		if($sno<10)
			$sno="0".$sno;
		echo "<tr height='23'><td align='center'>$sno</td>";
		?><td align="center"><?php echo $r[student_id] ?>		
		  </td>
		<td>&nbsp;&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?php echo $r[last_name]?></td>
		<?php
		$cname=fetcharray(execute("select year_name from course_year where year_id='$r[division]'"));
		$secname=fetcharray(execute("select section_name from class_section where id='$r[class_section_id]'"));
		/// $secname[0]
		
		/*echo "<td align='center'>" ?><A HREF="javascript:OpenWind('feerep.php?recordid=<?=$r[id]?>&course=<?=$r[course_admitted]?>&sem=<?=$r[division]?>&recordid=<?=$r[id]?>');"> 
        <?php 
		echo "$r[receipt]</A></td>";
		
	*/
	
}
$stundetidifo1=$stundetidifo[0];
$flag=1;		
		
		$sumtot=0;
		$cdn=$a_year-1;
		
		$a_year=$_POST['a_year'];
		$cdt1=01;
		$cmt1=04;
		$cyr1=$a_year;
		$cdt2=31;
		$cmt2=03;
		$cyr2=$a_year+1;
		$fromdate="$cyr1-$cmt1-$cdt1";
		$todate="$cyr2-$cmt2-$cdt2";
	
		
		$cf1=($a_year-1)."-$cmt1-$cdt1";		
		$ct1=($a_year)."-$cmt2-$cdt2";		
				
		$cf2=($a_year+1)."-$cmt1-$cdt1";		
		$ct2=($a_year+2)."-$cmt2-$cdt2";		

		$sd1=fetchrow(execute("select id from fee_m_collect where  receipt='$r[receipt]' and (paymentDate between '$cf1' and  '$ct1' )"));
		$sd2=fetchrow(execute("select id from fee_m_collect where  receipt='$r[receipt]' and (paymentDate between '$fromdate' and  '$todate' )"));
		$sd3=fetchrow(execute("select id from fee_m_collect where  receipt='$r[receipt]' and (paymentDate between '$cf2' and  '$ct2' )"));
		
		$sts1=fetchrow(execute("select id from fee_m_collect where  receipt='$r[receipt]' and accYear='$cdn' "));

		$sts2=fetchrow(execute("select id from fee_m_collect where  receipt='$r[receipt]' and accYear='$a_year' "));
		
		$sts3=fetchrow(execute("select id from fee_m_collect where  receipt='$r[receipt]' and accYear='$cyr2' "));



		$sqlid=execute("SELECT fee_id FROM `fee_type` where status='1' and refund='0'");
		while($r1=fetcharray($sqlid))
		{
			$val=$r1[0];
			$detval=0;
			$instval=fetchrow(execute("SELECT sum(totalConverted) FROM `fee_m_head_inst_collected` where `receipt`='$r[receipt]' and feeHead='$r1[0]'"));
			$detval=$instval[0];
			//if acc year curent year fee paid in last financial year apart from admission fee all the fees are diplayed 
			if($sd1[0] and $sts2[0] and $r1[0]!=1)
			{
				$sumtot=$sumtot+$detval;
				$sumval[$val]=$sumval[$val]+$detval;
				$detval1[$val]=$detval1[$val]+$detval;
//				echo "<td align='right' >$detval</td>";
			}
			elseif($sts2[0] and $sd2[0]) // acc year and fee payment year both are same
			{
				$sumtot=$sumtot+$detval;
				$sumval[$val]=$sumval[$val]+$detval;
				$detval1[$val]=$detval1[$val]+$detval;
	//			echo "<td align='right' >$detval</td>";
			}
			elseif($sts3[0] and $sd2[0] and $r1[0]==1)
			{				
				$sumtot=$sumtot+$detval;
				$sumval[$val]=$sumval[$val]+$detval;
				$detval1[$val]=$detval1[$val]+$detval;
			//	echo "<td align='right' >$detval</td>";
			}
			else
			{
		//		echo "<td align='right' ></td>";
			}
		}


		$sumval[0]=$sumval[0]+$sumtot;

//		echo "<td align='right'>$sumtot $currencydes[0]</td></tr>";
		
		$sno++;
		$grade1=$r[division];

}
if($stundetidifo1!=$stundetidifo[0])
{

		if($flag)
		{
			$maxtot=0;
			$sqlid=execute("SELECT fee_id FROM `fee_type` where status=1  and refund='0'");
			while($r1=fetcharray($sqlid))
			{
				$val=$r1[0];
				$sizeval=explode('.',$detval1[$val]);
				$valsize=sizeof($sizeval);
				if($valsize==1)
				$detval1[$val]=$detval1[$val].'.00';

				$maxtot=$detval1[$val]+$maxtot;
			
				echo "<td align='right' >$detval1[$val]</td>";
				$detval1[$val]=0;
			}
		echo "<td align='right'>$maxtot $currencydes[0]</td></tr>";
		}
}
	echo "<tr><td align='center' colspan='3'>Total</td>";
			$sqlid=execute("SELECT fee_id FROM `fee_type` where status=1  and refund='0'");
			while($r1=fetcharray($sqlid))
			{

				$val=$r1[0];
				echo "<td align='right' >$sumval[$val]</td>";
				$sumval[$val]=0;
			}
			$sizeval=explode('.',$sumval[0]);
			$valsize=sizeof($sizeval);
			if($valsize==1)
			$sumval[0]=$sumval[0].'.00';
		
			echo "<td align='right' >$sumval[0]</td>";
			$sumval[0]=0;
			echo "</tr>";
			echo "<tr><td align='center' colspan='7'>&nbsp;</td></tr>";
		
		?>
		<tr><td align='center' class='rowpic' colspan='7'><?=$cname[0]?></td></tr>
		<?php
?>
</table>

</form>
</body>
</html>