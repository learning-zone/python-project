<html>
<head>
<title>Addl Fee Receipt</title>
<?php
include("../db.php");
?>
<script language="javascript" type="text/javascript">
function reload()
{
	document.frm.action="addlfeerpt1.php";
	document.frm.submit();
}
</script>
<style>
	.text{text-align:right;}
</style>
</head>
<body>
<form name="frm" method='post' action="addaddlfee.php">
<input type='hidden' name='course' value='<?=$course?>'>
<input type='hidden' name='sem' value='<?=$sem?>'>
<input type='hidden' name='mid' value='<?=$mid?>'>
<input type='hidden' name='stud_id' value='<?=$stud_id?>'>
<input type='hidden' name='adm_id' value='<?=$adm_id?>'>
<?php
$cdt=date('d');
$cmt=date('m');
$cyr=date('Y');

$sel1="";
$sel2="";
$sel3="";
if($paymenttype==1)
	$sel1="selected";
elseif($paymenttype==2)
	$sel2="selected";
elseif($paymenttype==3)
	$sel3="selected";
?>
<table border='1' width=80% align=center cellspacing='0' cellpadding='1' class='forumline'>
<tr><td colspan='4' align='center' class='head'>Additional Fee Payment Details</td></tr>
<tr><td align='center'>Mode of Payment</td><td><select name='paymenttype' onchange="reload()">
<option value=''>-- Select --</option>
<option value='1' <?=$sel1?>>Cash</option>
<option value='2' <?=$sel2?>>Demand Draft</option>
<option value='3' <?=$sel3?>>Bank Challan</option>
</select></td>
<?php
if($paymenttype!='')
{
	echo "<td align='center'>Amount Paid Rs.</td>";
	echo "<td><input type='text' name='amt' value='$amt'></td></tr>";
	if($paymenttype==2 or $paymenttype==3)
	{
		?>
		<tr><td align='center'>Bank Name</td><td><select name='bname'>
		<option value=''>------ Select Bank ------</option>
		<?php
		$sql=execute("select id,bank_name from bank_details where status=1");
		if(rowcount($sql)>0)
		{
			for($i=0;$i<rowcount($sql);$i++)
			{
				$r=fetcharray($sql);
				if($bname==$r[0])
					echo "<option value=$r[0] selected>$r[1]</option>";
				else
					echo "<option value=$r[0]>$r[1]</option>";
			}
		}
		else
		{
			die("<font color='blue'><b>Add Bank Details first</b></font>");
		}
		?>
		</select></td>
		<td align='center'>DD or Challan No.</td>
		<td><input type='text' name='ddno' value='<?=$ddno?>'></td></tr>
		<tr><td align='center' colspan='2'>DD/Challan Date</td>
		<td colspan='2'><select name='pdt'>
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
		?>
		</select></td></tr>
		<?php
	}
	?>
	<tr><td colspan='6' align='center'><input type='button' class='bgbutton' name='sub1' value='Submit' onclick="reload()"></td></tr>
	<?php
}
?>
</table><br>
<?php
if($amt!='')
{
	$amt1=$amt-$fnamt;
	$ttldedamt=0;
	$ttlpdamt=0;
	$fpcnt=0;
	?>
	<table border='1' class='forumline' align='center' width='80%'>
	<tr><td align='center'>Sl No</td><td align='center'>Fee Name</td><td align='center'>Balance Fee Amount</td><td align='center'>Fee Paid</td></tr>
	<?php
	$sql=execute("select * from fee_master where id='$mid'");
	$r=fetcharray($sql);
	$conamt=$r[cenamt];
	$r1=fetcharray(execute("select max(fee_id) from fee_type"));
	$sno=1;
	for($i=1;$i<=$r1[0];$i++)
	{
		$dfee="dfee".$i;
		$pfee="pfee".$i;
		if($r[$dfee]>$r[$pfee])
		{
			if($conamt>0)
				$ddfee=$r[$dfee]-$r[$pfee]-$conamt;
			else
				$ddfee=$r[$dfee]-$r[$pfee];
			
			if($ddfee>0)
			{
				$conamt=0;
				if($sno<10)
				$sno="0".$sno;
				echo "<tr><td align='center'>$sno</td>";
				$sql1=fetcharray(execute("select fee_name from fee_type where fee_id=$i"));
				echo "<td>&nbsp;&nbsp;$sql1[0]</td><td align='center'><input type=text name='dedfee$i' value='$ddfee' class='text' readonly></td>";
				
				$feeamt=$ddfee;
				$ttldedamt+=$ddfee;
				if($amt1!=0)
				{
					$amt2=$amt1-$ddfee;
					if($amt2>0)
					{
						echo "<td align='center'><input type=text name='pdfee$i' value='$ddfee' class='text' readonly></td></tr>";
						$amt1=$amt2;
						$ttlpdamt+=$ddfee;
						$fpcnt++;
					}
					else
					{
						echo "<td align='center'><input type=text name='pdfee$i' value='$amt1' class='text' readonly></td></tr>";
						$ttlpdamt+=$amt1;
						$amt1=0;
						$fpcnt++;
					}
				}
				else
					echo "<td align='center'><input type=text name='pdfee$i' value='$amt1' class='text' readonly></td></tr>";
				$sno++;
			}
			else
			{
				$conamt=$r[$pfee]+$conamt-$r[$dfee];
			}
		}
	}
	echo "<tr><td colspan='2' align='center'>Fine Amount</td>";
	if($fnamt=='')
		$fnamt=0;
	echo "<td align='center'><input type=text name='fnamt' value='$fnamt' class='text' onchange='reload()'></td>";
	$ttldedamt+=$fnamt;
	$ttlpdamt+=$fnamt;
	echo "<td align='center'><input type=text name='fineamt' value='$fnamt' class='text' readonly></td></tr>";
	echo "<tr><td colspan='2' align='center'>Total Amount</td>";
	echo "<td align='center'><input type=text name='ttldedamt' value='$ttldedamt' class='text' readonly></td>";
	echo "<td align='center'><input type=text name='ttlpdamt' value='$ttlpdamt' class='text' readonly></td></tr>";
	echo "<tr><td colspan='3' align='right'>Fee Concession&nbsp;&nbsp;&nbsp;</td>";
	if($cenamt=='')
		$cenamt=0;
	echo "<td align='center'><input type=text name='cenamt' value='$cenamt' class='text' onchange='reload()'></td>";
	$bal=$ttldedamt-$amt-$cenamt;
	if($bal<0)
	{
		$exeamt=$amt-$ttldedamt+$cenamt;
		$balamt=0;
	}
	else
	{
		$exeamt=0;
		$balamt=$bal;
	}
	echo "<tr><td colspan='3' align='right'>Balance Payment&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='center'><input type=text name='balamt' value='$balamt' class='text' readonly></td>";
	echo "<tr><td colspan='3' align='right'>Excess Payment&nbsp;&nbsp;&nbsp;</td>";
	echo "<td align='center'><input type=text name='exeamt' value='$exeamt' class='text' readonly></td></tr>";
	echo "<tr><td colspan='2' align='center'>Remarks</td><td colspan='2' align='center'><textarea name='remk' cols='50' rows='5'></textarea></td></tr>";
	echo "<tr height='50'><td colspan='4' align='center'><input type='submit' class='bigbotton' name='sub2' value='Generate Fee Receipt' ></td></tr>";
}
?>
<input type='hidden' name='fpcnt' value='<?=$fpcnt?>'>
</table>
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