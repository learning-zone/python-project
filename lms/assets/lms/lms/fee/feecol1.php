<?php
session_start();
include("../db.php");

if($_POST['financial'])
{
	$a_year=$_POST['a_year'];

	$cdt1=01;
	$cmt1=04;
	$cyr1=$a_year;
	$cdt2=31;
	$cmt2=03;
	$cyr2=$a_year+1;
	$fromdate="$cyr1-$cmt1-$cdt1";
	$todate="$cyr2-$cmt2-$cdt2";

}
else
{
	$cdt1=$_POST['cdt1'];
	$cmt1=$_POST['cmt1'];
	$cyr1=$_POST['cyr1'];
	$fromdate="$cyr1-$cmt1-$cdt1";
	
	$cdt2=$_POST['cdt2'];
	$cmt2=$_POST['cmt2'];
	$cyr2=$_POST['cyr2'];
	
	$todate="$cyr2-$cmt2-$cdt2";
}

?>
<html>
<head>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=600,width=750,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
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
//$dtdiff=date_diff($toyr1,$fmyr1,d);


$sqlar=execute("select id, description, code from `fee_m_currency_code`");
$curdet=fetcharray($sqlar);
$lenth=rowcount($sqlar);


		?>
		<table class='forumline' border=1 width="80%" align=center>
            <?php
            if($_POST['financial'])
			{
				?>
				<tr height="30">
					<td align=center class=head colspan=<?=$lenth+3?>>
					Financial-Year Wise Fee Report<br>From : <?=$fmyr?> To : <?=$toyr?>
					</TD>
				</TR>
				<?php
			}
			else
			{
				?>
				<tr height="30">
					<td align=center class=head colspan=<?=$lenth+3?>>
					FEE COLLECTION REPORT<br>From : <?=$fmyr?> To : <?=$toyr?>
					</TD>
				</TR>
				<?php
			}
			
			?>
            <tr>
                <td rowspan="2" align=center>Sl.No</td>
                <td rowspan="2" align=center>Name</td>
                <td rowspan="2" align=center>Receipt</td>
                <td align=center colspan="<?=$lenth+1?>">Amount</td>
            </tr>
            <tr>
			<?php
            $sqlar=execute("select id, description, code from `fee_m_currency_code`");

            while($r=fetcharray($sqlar))
            {
                echo "<td align='center'>$r[1]</td>";
            }
            ?>
            </tr>
		<?php
		$i=1;
		
		
		$sql1=execute("select studentId, admissionCat,	currencyType,	installmentId, amount, modeOfPament, receipt, amountCleared from `fee_m_collect` where paymentDate between '$fromdate' and  '$todate' and status=1");
		while($r=fetcharray($sql1))
		{
			$student=fetcharray(execute("select first_name, last_name from student_m where id='$r[0]'"));
			echo "
			<tr>
				<td align='center'>
				$i
				</td> 
				<td>&nbsp;&nbsp;
				$student[0] $student[1]
				</td> 
				<td align='center'>
				$r[receipt]
				</td>
			";
			$sqlar1=execute("select id, description, code from `fee_m_currency_code`");

            while($r1=fetcharray($sqlar1))
            {
                $newamt=$r['amount'];
				$currency=$r['currencyType'];
				$amountCleared=$r['amountCleared'];
				
				
				if($r[currencyType]==1 and $r[currencyType]==$r1[0])
				{
					echo "<td align='right'>&nbsp;$newamt $r1[2]&nbsp;</td>";
					if($newamt)
					{
						$nid=$r1[0];
						$tot[$nid]=$tot[$nid]+$newamt;
					}
				}
				elseif($r1[0]==1 and $r[currencyType]!=1)
				{
					echo "<td align='right'>&nbsp;$amountCleared  $r1[2]&nbsp;</td>";
					if($amountCleared)
					{
						$nid=$r1[0];
						$tot[$nid]=$tot[$nid]+$amountCleared;
					}
				}
				elseif($r1[0]!=1 and $r[currencyType]==$r1[0])
				{
					echo "<td align='right'>&nbsp;$newamt $r1[2]&nbsp;</td>";
					if($newamt)
					{
						$nid=$r1[0];
						$tot[$nid]=$tot[$nid]+$newamt;
					}
				}
				else
				echo "<td align='center'></td>";
				
				
				//if($r1[0]==$r[currencyType] and $r[currencyType]!=1)
				//echo "<td align='center'>$newamt $r1[2]</td>";
				
				//else
				
            }
			
			
			
			$i++;
		}
		?>
		<tr>
        	<td align='right' colspan='3'>Total Amount&nbsp;&nbsp;</td>
            <?php
			$sqlar1=execute("select id, description, code from `fee_m_currency_code`");

            while($r1=fetcharray($sqlar1))
            {
				
				$nid=$r1[0];
                $newamt=$tot[$nid];
				if(!$newamt)
				$newamt='0.00';
				echo "<td align='right'>&nbsp;$newamt $r1[2]&nbsp;</td>";
			}
			?>
        </tr>
		
        </table><br>
		<div id="prn" align="center"><input type="button" name="prnfeest" class="bgbutton" value="PRINT" onClick="prnfee()"></div>
		<?php
	
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