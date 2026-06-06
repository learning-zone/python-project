<?php
include("../db.php");
$amount = $_GET[amount];
$stud_id = $_GET[stud_id];
$course = $_GET[course];
$sem = $_GET[sem];
$adm_id = $_GET[adm_id];
$date = date("Y-m-d");
if($sem==1 || $sem==2)
{
	$year_id=1;
}
if($sem==3 || $sem==4)
{
	$year_id=2;
}
$v = "select max(rec_date) from stud_fee_".$course."_".$sem." where stud_id='$stud_id'";
$r =  execute($v) or die(mysql_error());
$w = fetcharray($r);

$va = "select fee_id from stud_fee_".$course."_".$sem." where act_amt!=paid_amt and stud_id='$stud_id'";
if($w[0]!="")
{
	$va.=" and rec_date='$w[0]'";
}
$re = execute($va) or die(mysql_error());
$nu = rowcount($re);
?>
<html>
<head>
	<style>
	  .text {text-align:right;}
	</style>
</head>
<form name='form' method='POST' action='fee_save.php'>
<input type='hidden' name='course' value='<?php echo $course ?>'>
<input type='hidden' name='sem' value='<?php echo $sem ?>'>
<input type='hidden' name='stud_id' value='<?php echo $stud_id ?>'>

<table border='1' align='center' width='50%' cellspacing='0' cellpadding='1'>
<tr>
	<th colspan='5' align='center'>General Receipt Of  Student Fee</th>
</tr>
<tr height='30'>
  <td>&nbsp;&nbsp; <b>Sl No </b></td>	
  <td>&nbsp;&nbsp; <b>Fee Name</b></td>
  <td align='center'><b>Fee Amount</b></td>
  <td align='center'><b>Paid Amount</b></td>
  <td align='center'><b>Balance Amount</b></td>
</tr>
<?php
if($nu==0)
{
	$var = "select id from fee_head where course_id='$course' and year_id='$year_id' and admission_type='$adm_id'";
	$res = execute($var) or die(mysql_error());
	$feeid=fetchInsertId();
	$num = rowcount($res);
	for($i=1;$i<=$num;$i++)
	{
		 $row = fetcharray($res);		
		 $var1 = "select fee_name,amount from fee_head where id=$row[id]";
		 $res1 = execute($var1) or die(mysql_error());
		 $row1 = fetcharray($res1);

		 if($amount!=0)
		 { 
			  if($amount == $row1[amount])
			  {
				$paid_amt[$i] = $amount;
				$bal_amt[$i] = '0';
				$amount = '0';
			  }
			  elseif($amount > $row1[amount])
			  {
			    $paid_amt[$i] = $row1[amount];
				$bal_amt[$i] = '0';
				$amount = $amount - $row1[amount];
			  }
			  else
			  {
				$paid_amt[$i] = $amount;
				$bal_amt[$i] = $row1[amount] - $amount;
				$amount = '0';
			  }	
		 }
		 else
		{
			$paid_amt[$i] = 0;
			$bal_amt[$i] = $row1[amount];
		}
		?>
		<input type='hidden' name='sid[]' value='<?php echo $row[id] ?>' checked>
		 <tr>
			<td>&nbsp;&nbsp; <b><?php echo $row[id] ?></b></td>	
			<td>&nbsp;&nbsp; <b>
				<?php echo $row1[fee_name] ?></b>
			</td>
			<td align='center'><b>
				<input type='text' name='act_amt<?php echo $row[id] ?>' value='<?php echo $row1[amount] ?>'>
			</b></td>
			<td align='center'><b>
				<input type='text' name='paid_amt<?php echo $row[id] ?>' value='<?php echo $paid_amt[$i] ?>'>
			</b></td>
			<td align='center'><b>
				<input type='text' name='bal_amt<?php echo $row[id] ?>' value='<?php echo $bal_amt[$i] ?>'>
			</b></td>
		 </tr>
		 <?php
	 }
}
else
{
	for($k=1;$k<=$nu;$k++)
	{
		 $ro = fetcharray($re);
		 $var3 = "select act_amt,paid_amt,bal_amt from stud_fee_".$course."_".$sem." where fee_".$feeid."='$ro[fee_id]' and stud_id='$stud_id' and ";
		 $var3.=" rec_date='$w[0]'";
		
		 $res3 = execute($var3) or die(mysql_error());
		 $row3 = fetcharray($res3);
		
		 $var4 = "select fee_name from fee_head where id='$ro[fee_id]'";
		 $res4 = execute($var4) or die(mysql_error());
		 $row4 = fetcharray($res4);
         if($amount!=0)
		 {
			 if($amount==$row3[bal_amt])
			 {
				$paid_amt[$k]=$row3[bal_amt] + $row3[paid_amt];
				$bal_amt[$k]=0;
				$amount=0;
			 }
			 elseif($amount>$row3[bal_amt])
			 {
				
				$paid_amt[$k]=$row3[bal_amt] + $row3[paid_amt];
				$bal_amt[$k]=0;
				$amount = $amount - $row3[bal_amt];			
			 }
			 else
			 {	 
				 
				 $paid_amt[$k] = $amount + $row3[paid_amt];
				 $bal_amt[$k]  = $row3[bal_amt]-$amount;
				 $amount   = 0;	 		
			 }
		 }
		 else
		{
			$paid_amt[$k]=0;
			$bal_amt[$k] = $row3[act_amt];
		}
	?>
		<input type='hidden' name='sid[]' value='<?php echo $ro[fee_id] ?>' checked>
		 <tr>
			<td>&nbsp;&nbsp; <b><?php echo $ro[fee_id] ?></b></td>	
			<td>&nbsp;&nbsp; <b>
				<?php echo $row4[fee_name] ?></b>
			</td>
			<td align='center'><b>
			<input type='text' name='act_amt<?php echo $ro[fee_id] ?>' value='<?php echo $row3[act_amt] ?>'>
			</b></td>
			<td align='center'><b>
			<input type='text' name='paid_amt<?php echo $ro[fee_id] ?>' value='<?php echo $paid_amt[$k] ?>'>
			</b></td>
			<td align='center'><b>
			<input type='text' name='bal_amt<?php echo $ro[fee_id] ?>' value='<?php echo $bal_amt[$k] ?>'>
			</b></td>
		 </tr>
	<?php
	}
}
?>
</table>
<br>
<center><input type='submit' name='submit' value='Save Details'></center>
</form>
</body>