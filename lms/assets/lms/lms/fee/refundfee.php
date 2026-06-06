<html>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<?php
session_start();
include("../db.php");
?>
<script language='javascript'>
function reload()
{
	document.frm.action='refundfee.php';
	document.frm.submit();
} 
function loanchk()
{
	var lamt=parseInt(document.getElementById("lnscl").value);
	var samt=parseInt(document.getElementById("scl").value);
	if(lamt>samt)
	{
		alert("Loan Amount cannot be greater than Scholarship Amount");
		document.getElementById("lnscl").value=0;
		return false;
	}
}
function refundfee()
{
	if(document.frm.reftype.value=='')
	{
		alert("Please Select Type of Refund");
		return false;
	}
	if(document.frm.refmode.value=='')
	{
		alert("Please Select Mode of Refund");
		return false;
	}
	if(document.frm.refmode.value=='2' && document.frm.bkid.value=='')
	{
		alert("Please Select Bank");
		return false;
	}
	if(document.frm.refmode.value=='2' && document.frm.chno.value=='')
	{
		alert("Please Enter Cheque No.");
		return false;
	}
	document.frm.action="refundfee1.php";
	document.frm.submit();
		
}
</script>
<style>
	.text{text-align:right;}
</style>
</head>
<body>
<form name="frm" method="post">
<input type='hidden' name='stud_id' value='<?=$stud_id?>'>
<input type='hidden' name='course' value='<?=$course?>'>
<input type='hidden' name='sem' value='<?=$sem?>'>
<input type='hidden' name='adm_id' value='<?=$adm_id?>'>
<?php
$cyr1=$curyr1;
$sql=fetcharray(execute("select first_name,last_name,student_id from student_m where id=$stud_id"));
$sql1=fetcharray(execute("select course_abbr from course_m where course_id=$course"));
$sql2=fetcharray(execute("select year_name from course_year where year_id=$sem"));
$sql3=fetcharray(execute("select sum(balamt) from fee_master where studid=$stud_id and status=0"));
if($sql3[0]=='')
	die ("<font color='brown'><b>Fee Payment not made by this Student..</b></font>");
if($sql3[0]>0)
{
	$dueamt=$sql3[0];
	echo "<div><font color='red' size='3'><b>This Student has to pay the balance amount of $sql3[0] rupees..</b></font><div><br>";
}
?>
<table border=1 class=forumline align=center cellspacing='0' cellpadding='1' width='80%'>
<tr><td align='center' class='head' colspan='4'><font size="4"><b>Refund Fee</b></font></td></tr>
<tr><td nowrap colspan='2'>&nbsp;&nbsp;Name : <?=$sql[0]?> <?=$sql[1]?></td><td nowrap colspan='2'>&nbsp;&nbsp;SR Number : <?=$sql[2]?></td></tr>
<tr><td nowrap colspan='2'>&nbsp;&nbsp;Program : <?=$sql1[0]?></td><td nowrap colspan='2'>&nbsp;&nbsp;Year : <?=$sql2[0]?></td></tr>
<tr><td colspan='2' align='right'>Refund Type&nbsp;&nbsp;</td><td colspan='2'><select name='reftype' onchange='reload()'>
<option value=''>-:- Select Type -:-</option>
<?php
$sel1="";
$sel2="";
$sel3="";
$sel4="";
if($reftype==1)
	$sel1="selected";
elseif($reftype==2)
	$sel2="selected";
elseif($reftype==3)
	$sel3="selected";
elseif($reftype==4)
	$sel4="selected";	
?>
<option value='3' <?=$sel3?>>Execess Payment</option>
<option value='1' <?=$sel1?>>Advance Payment</option>
<option value='2' <?=$sel2?>>Admission Cancelled</option>
<option value='4' <?=$sel4?>>Loan on Scholarship</option>
</select></td></tr>
<?php
if($reftype!="")
{
	if($reftype==1)
	{
		if($dueamt>0)
		{
			echo "</table><br>";
			die("<font color='brown'><b>Refund of Advance payment not allowed ..</b></font>");
		}
		$sno=1;
		$ttlamt=0;
		$flg=0;
		echo "<tr><td align='center'>Sl No</td>";
		echo "<td align='center'>Fee Name</td>";
		echo "<td align='center' colspan='2'>Amount</td></tr>";
		$sql1=execute("select fee_id,fee_name from fee_type where refund=1");
		while($rs=fetcharray($sql1))
		{
			$a="pfee".$rs[0];
			$sql=execute("select sum($a) as pfee from fee_master where studid='$stud_id' and pid='$course' and refundsts=0");
			$r=fetcharray($sql);
			if($r[pfee]>0)
			{
				$flg=1;
				if($sno<10)
					$sno="0".$sno;
				echo "<tr><td align='center'>$sno</td><td>&nbsp;&nbsp;$rs[1]</td><td colspan='2' align='right'>$r[pfee]</td></tr>";
				$sno++;
				$ttlamt+=$r[pfee];
			}
		}
		if($flg==0)
		{
			echo "</table><br>";
			die("<font color='brown'><b>Advance Fees not Paid or already refunded to this Student..</b></font>");
		}
		if($refcharge=='')
			$refcharge=0;
		$ttlamt-=$refcharge;
		$sql=fetcharray(execute("select max(id) from fee_master where studid='$stud_id' and pid='$course' and refundsts=0"));
		$mid=$sql[0];
		echo "<tr><td colspan='2' align='right'>Refund Charges &nbsp;&nbsp;</td><td colspan='2' align='right'><input type='text' name='refcharge' value='$refcharge' class='text' onchange='reload()'></td></tr>";
		echo "<tr><td colspan='2' align='right'>Total Refund Amount &nbsp;&nbsp;</td><td colspan='2' align='right'>$ttlamt</td></tr>";
	}
	elseif($reftype==2)
	{
		$sql=execute("select * from fee_master where studid='$stud_id' and status=0 and accyr='$cyr1'");
		if(rowcount($sql)>0)
		{
			$r=fetcharray($sql);
			$ttldfee=0;
			$ttlpfee=0;
			$mid=$r[id];
			$rs=fetcharray(execute("select max(fee_id) from fee_type"));
			for($i=1;$i<=$rs[0];$i++)
			{
				$a="dfee".$i;
				$dfee=$r[$a];
				$b="pfee".$i;
				$pfee=$r[$b];
				$ttldfee+=$dfee;
				$ttlpfee+=$pfee;
			}
			echo "<tr><td align='center' colspan='2'>Description</td><td align='center' colspan='2'>Amount</td></tr>";
			echo "<tr><td colspan='2' align='right'>Demanded Amount&nbsp;&nbsp;</td><td colspan='2' align='right'>$ttldfee</td></tr>";
			if($r[sclamt]>0)
			{
				echo "<tr><td colspan='2' align='right'>Scholoarship Received&nbsp;&nbsp;</td><td colspan='2' align='right'>$r[sclamt]</td></tr>";
				$ttlpfee-=$r[sclamt];
			}
			echo "<tr><td colspan='2' align='right'>Paid Amount&nbsp;&nbsp;<br>(Minus indicates loan outstanding)&nbsp;&nbsp;</td><td colspan='2' align='right'>$ttlpfee</td></tr>";
			$ttlamt=$ttlpfee;
			$exeamt=$r[exeamt];
			if($exeamt>0)
			{
				echo "<tr><td colspan='2' align='right'>Execess Payment&nbsp;&nbsp;</td><td colspan='2' align='right'>$exeamt</td></tr>";
				$ttlamt+=$exeamt;
			}
			if($ttlamt <= 0)
			{
				echo "</table><br>";
				if($ttlamt<0)
					die("<font color='brown'><b>Refund not allowed due to loan outstanding ..</b></font>");
				else
					die("<font color='brown'><b>Refund not allowed ..</b></font>");
			}
			$s1=execute("select refchg,refamt,reftype from refundfee where mid='$mid' and reftype=1");
			if(rowcount($s1)>0)
			{
				$s2=fetcharray($s1);
				{
					$refamt1=$s2[0]+$s2[1];
					$refdamt+=$refamt1;
				}
			}
			if($refdamt>0)
			{
				echo "<tr><td colspan='2' align='right'>Already Refunded Amount&nbsp;&nbsp;</td><td colspan='2' align='right'>$refdamt</td></tr>";
				$ttlamt-=$refdamt;
			}
			if($refcharge=='')
				$refcharge=0;
			$ttlamt-=$refcharge;
			echo "<tr><td colspan='2' align='right'>Refund Charges &nbsp;&nbsp;</td><td colspan='2' align='right'><input type='text' name='refcharge' value='$refcharge' class='text' onchange='reload()'></td></tr>";
			echo "<tr><td colspan='2' align='right'>Total Refund Amount &nbsp;&nbsp;</td><td colspan='2' align='right'>$ttlamt</td></tr>";
		}
		else
		{
			echo "</table><br>";
			die("<font color='brown'><b>Fee not paid or already cancelled the admission ..</b></font>");
		}
	}
	elseif($reftype==3)
	{
		if($dueamt>0)
		{
			echo "</table><br>";
			die("<font color='brown'><b>Refund of Execess Payment not allowed ..</b></font>");
		}
		$sql=execute("select id,exeamt from fee_master where studid='$stud_id' and status=0 and accyr='$cyr1'");
		if(rowcount($sql)>0)
		{
			$r=fetcharray($sql);
			$mid=$r[id];
			$exeamt=$r[exeamt];
			if($exeamt>0)
			{
				echo "<tr><td align='center' colspan='2'>Description</td><td align='center' colspan='2'>Amount</td></tr>";
				echo "<tr><td colspan='2' align='right'>Execess Payment Made&nbsp;&nbsp;</td><td colspan='2' align='right'>$exeamt</td></tr>";
				$ttlamt=$exeamt;
				if($refcharge=='')
					$refcharge=0;
				$ttlamt-=$refcharge;
				echo "<tr><td colspan='2' align='right'>Refund Charges &nbsp;&nbsp;</td><td colspan='2' align='right'><input type='text' name='refcharge' value='$refcharge' class='text' onchange='reload()'></td></tr>";
				echo "<tr><td colspan='2' align='right'>Total Refund Amount &nbsp;&nbsp;</td><td colspan='2' align='right'>$ttlamt</td></tr>";
			}
			else
			{
				echo "</table><br>";
				die("<font color='brown'><b>No execess payment to refund ..</b></font>");
			}
		}
		else
		{
			echo "</table><br>";
			die("<font color='brown'><b>Fee not paid or already cancelled the admission ..</b></font>");
		}
	}
	elseif($reftype==4)
	{
		$sql=execute("select * from fee_master where studid='$stud_id' and status=0 and accyr='$cyr1'");
		if(rowcount($sql)>0)
		{
			$r=fetcharray($sql);
			if($r[sclamt]==0)
			{
				echo "</table><br>";
				die("<font color='brown'><b>Scholarship not received ..</b></font>");
			}
			if($r[lsclamt]>0)
			{
				echo "</table><br>";
				die("<font color='brown'><b>Loan on Scholarship already paid ..</b></font>");
			}
			$ttldfee=0;
			$ttlpfee=0;
			$mid=$r[id];
			$rs=fetcharray(execute("select max(fee_id) from fee_type"));
			for($i=1;$i<=$rs[0];$i++)
			{
				$a="dfee".$i;
				$dfee=$r[$a];
				$b="pfee".$i;
				$pfee=$r[$b];
				$ttldfee+=$dfee;
				$ttlpfee+=$pfee;
			}
			echo "<tr><td align='center' colspan='2'>Description</td><td align='center' colspan='2'>Amount</td></tr>";
			echo "<tr><td colspan='2' align='right'>Demanded Amount&nbsp;&nbsp;</td><td colspan='2' align='right'>$ttldfee</td></tr>";
			if($r[sclamt]>0)
			{
				echo "<tr><td colspan='2' align='right'>Scholoarship Received&nbsp;&nbsp;</td><td colspan='2' align='right'>$r[sclamt]</td></tr>";
				echo "<input type='hidden' name='sclp' id='scl' value='$r[sclamt]'>";
				$ttlpfee-=$r[sclamt];
			}
			if($sclamt=='')
				$sclamt=0;
			echo "<tr><td colspan='2' align='right'>Paid Amount&nbsp;&nbsp;</td><td colspan='2' align='right'>$ttlpfee</td></tr>";
			echo "<tr><td colspan='2' align='right'>Loan granted on Scholarship&nbsp;&nbsp;</td><td colspan='2' align='right'><input type='text' name='sclamt' id='lnscl' value='$sclamt' class='text' onchange='loanchk()'></td></tr>";
		}
		else
		{
			echo "</table><br>";
			die("<font color='brown'><b>Fee not paid or already cancelled the admission ..</b></font>");
		}
	}
	echo "<tr><td colspan='4' align='center'><font color='brown'>Refund Details</font></td></tr>";	
	$sel1="";
	$sel2="";
	if($refmode==1)
		$sel1="selected";
	elseif($refmode==2)
		$sel2="selected";
	if($reftype==4)
	{
		echo "<input type='hidden' name='ttlamt' value='$sclamt'>";
		echo "<input type='hidden' name='refcharge' value='0'>";
	}	
	else
		echo "<input type='hidden' name='ttlamt' value='$ttlamt'>";
	?>
	<input type='hidden' name='mid' value='<?=$mid?>'>
	<tr><td nowrap>&nbsp;&nbsp;Refund Mode</td><td><select name='refmode' onchange='reload()'>
	<option value=''>-:- Select Mode -:-</option>
	<option value='1' <?=$sel1?>>Cash</option>
	<option value='2' <?=$sel2?>>Bank Cheque</option>
	</select></td>
	<?php
	if($refmode==1 or $refmode=='')
		echo "<td colspan='2'>&nbsp;</td</tr>";
	elseif($refmode==2)
	{
		echo "<td>&nbsp;&nbsp;Bank Name</td>";
		echo "<td><select name='bkid'>";
		echo "<option value=''>-:- Select Bank -:-</option>";
		$sql=execute("select id,bank_name from bank_details where status=1");
		while($rs1=fetcharray($sql))
		{
			echo "<option value='$rs1[0]'>$rs1[1]</option>";
		}
		echo "<tr><td>&nbsp;&nbsp;Cheque No</td><td><input type='text' name='chno' value=''></td>";
		$cdt=date('d');
		$cmt=date('m');
		$cyr=date('Y');
		?>
		<td  nowrap>&nbsp;&nbsp;Cheque Date</td>
		<td><select name='pdt'>
		<?php
		if($pdt=='')
			$pdt=$cdt;
		for($i=1;$i<=31;$i++)
		{
			if($i<10)
				$i="0".$i;
			if($i==$pdt)
				echo "<option value=$i selected>$i</option>";
			else
				echo "<option value=$i>$i</option>";
		}
		?>
		</select><select name='pmt'>
		<?php
		if($pmt=='')
			$pmt=$cmt;
		for($i=1;$i<=12;$i++)
		{
			if($i<10)
				$i="0".$i;
			if($i==$pmt)
				echo "<option value=$i selected>" . MonthName($i) . "</option>";
			else
				echo "<option value=$i>" . MonthName($i) . "</option>";
		}
		?>
		</select><select name='pyr'>
		<?php
		if($pyr=='')
			$pyr=$cyr;
		for($i=$cyr-1;$i<=$cyr+1;$i++)
		{
			if($i==$pyr)
				echo "<option value=$i selected>$i</option>";
			else
				echo "<option value=$i>$i</option>";
		}
		echo "</select></td></tr>";		
	}
}
?>
</table><br><br>
<div align="center"><input type="button" name='clse' value="<< Apply >>" class='bgbutton' onclick="refundfee()"></div>
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