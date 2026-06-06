<html>
<head>
<title>Fee Receipt</title>
<?php
	include("../db.php");
	$ttransopotation_no_month=10; //enter the number of month 

	$stud_id=$_REQUEST['stud_id'];
	$course=$_REQUEST['course'];
	$sem=$_REQUEST['sem'];
	$adm_id=$_REQUEST['adm_id'];
	$stud_yr=$_REQUEST['stud_yr'];
	
	//fetching installmentId key
	$uid=fetchrow(execute("select no_of_instal from  `fee_m_descrption` where accyear='$stud_yr' and class='$sem' and adm_cat='$adm_id' and status=1"));
	
	$installid=fetchrow(execute("select count(installmentId) from fee_m_collect  where studentId='$stud_id' and accYear=$stud_yr and status=1"));
	
	
		if(!$installid[0])
		$instalment=1;
		elseif($installid[0]==$uid[0])
		die("No Due");// all the installment amount cleared
		else
		$instalment=$installid[0]+1;
	
	
	// reciving post data
	$oexeamt=$_POST['oexeamt'];
	$oldbalamt=$_POST['oldbalamt'];
	$pydt=$_POST['pydt'];
	$pymt=$_POST['pymt'];
	$pyyr=$_POST['pyyr'];
	$paymenttype=$_POST['paymenttype'];
	$fnamt=$_POST['fnamt'];
	$cenamt=$_POST['cenamt'];
	
	
	// To get master information from the master table
	$fee12=execute("select uid,no_of_instal, currency from  fee_m_descrption where class='$sem' and accyear='$stud_yr' and adm_cat='$adm_id' ");
	while($r2=fetcharray($fee12))
	{
		$uid=$r2[0];
		$no_of_instal=$r2[1];
		$currency=$r2[2];
	}
	
	// to get currency code
	$currencydes=fetchrow(execute("select code from fee_m_currency_code where id='$currency'"));
	
	//find the total amount and payment date  
	$sql=execute("select amount, f_due_date, t_due_date from  fee_m_descrption_inst_total where inst_id='$instalment' and uid='$uid' and sts=1 ");
	while($r=fetcharray($sql))
	{
		$amt=$r[0];
		$f_due_date=$r[1];
		$t_due_date=$r[2];
	}
	$systemdate=date("Y-m-d");


?>
<script language="javascript" type="text/javascript">
function genrpt2()
{
	document.frm.action="fee_add.php";
	document.frm.submit();
}

function genrpt1()
{

	var tot=<?=$amt?>;
	var fine=parseInt(document.getElementById("fine").value);
	if(isNaN(fine))
	{
		alert("Invalid amount");
		document.getElementById("fine").value=0;
	}
	else
	{
		var m=tot+fine;
		document.getElementById("amt").value=m;
		document.frm.action="gen_recpt1.php";
		document.frm.submit();
	}
}

function totcal()
{
	var tot=<?=$amt?>;
	var fine=parseInt(document.getElementById("fine").value);
	if(isNaN(fine))
	{
		alert("Invalid amount");
		document.getElementById("fine").value=0;
	}
	else
	{
		var m=tot+fine;
		document.getElementById("amt").value=m;
	}

}
</script>

</head>
<body>
<form name="frm" method='post'>
<input type='hidden' name='course' value='<?=$course?>'>
<input type='hidden' name='sem' value='<?=$sem?>'>
<input type='hidden' name='adm_id' value='<?=$adm_id?>'>
<input type='hidden' name='stud_id' value='<?=$stud_id?>'>
<input type='hidden' name='stud_yr' value='<?=$stud_yr?>'>
<input type='hidden' name='currencyType' value='<?=$currency?>'>
<input type='hidden' name='installmentId' value='<?=$instalment?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>


<?php
$cdt=date('d');
$cmt=date('m');
$cyr=date('Y');
$cyr1=$stud_yr;
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
<input type='hidden' name='oexeamt' value='<?=$oexeamt?>'>
<input type='hidden' name='oldbalamt' value='<?=$oldbalamt?>'>

<br>
<table border='1' width='70%' align='center' cellspacing='0' cellpadding='1' class='forumline'>
	<tr>
    	<td colspan='4' align='center' class='head'>Fee Payment Details</td>
    </tr>
	<tr>
   	  <td>&nbsp;&nbsp;Payment Date</td>
		<td>
        	<select name='pydt'>
			<?php
			if($pydt=='')
				$pydt=$cdt;
			for($i=1;$i<=31;$i++)
			{
				if($i<10)
					$i="0".$i;
				if($i==$pydt)
					echo "<option value=$i selected>$i</option>";
				else
					echo "<option value=$i>$i</option>";
			}
			?>
			</select><select name='pymt'>
			<?php
			if($pymt=='')
				$pymt=$cmt;
			for($i=1;$i<=12;$i++)
			{
				if($i<10)
					$i="0".$i;
				if($i==$pymt)
					echo "<option value=$i selected>" . MonthName($i) . "</option>";
				else
					echo "<option value=$i>" . MonthName($i) . "</option>";
			}
			?>
			</select><select name='pyyr'>
			<?php
			if($pyyr=='')
				$pyyr=$cyr;
			for($i=$cyr-1;$i<=$cyr+1;$i++)
			{
				if($i==$pyyr)
					echo "<option value=$i selected>$i</option>";
				else
					echo "<option value=$i>$i</option>";
			}
			?>
			</select>
		</td>
	  <td align='center' nowrap>Mode of Payment</td>
        <td nowrap>
        	<select name='paymenttype' onChange="genrpt2()">
                <option value=''>-- Select --</option>
                <option value='1' <?=$sel1?>>Cash</option>
                <option value='2' <?=$sel2?>>Demand Draft</option>
                <option value='3' <?=$sel3?>>Bank Cheque</option>
            </select>
		</td>
	</tr>
		<tr><td align='center'>Bank Name</td><td><select name='bname'>
		<option value=''>------ Select Bank ------</option>
		<?php
		$sql=execute("select id,bank_name from bank_details where status=1 order by bank_name");
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
			die("<font color=''><b>Add Bank Details first</b></font>");
		}
		?>
		</select></td>
		<td align='center' nowrap>Branch Details</td>
		<td><input type='text' name='bdet' value='<?=$bdet?>'></td></tr>
		<tr><td align='center' nowrap>DD or Cheque No.</td>
		<td><input type='text' name='ddno' value='<?=$ddno?>'></td>
		<td align='center' nowrap>DD/Cheque Date</td>
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

?>
</table>
<!--<br>
<div align="center">
<input type='button' class='bgbutton' name='sub1' value='Submit'>
</div>-->
<br>
<?php
if(!$paymenttype)
die();

echo "inside";

	?>
        <table align="center" border="1" cellpadding="0" cellspacing="5" width="70%">
            <tr>
              <td width="5%" align="center" class="head" nowrap>Sl No</td>
              <td align="center" class="head">Fee Head</td>
              <td width="10%" align="center" class="head" nowrap>Fee Paid</td>
            </tr>
    	<?php
			$i=1;
			// retriving fee details from fee head 
			$sql44= execute("SELECT fee_id,fee_name, ftype FROM fee_type WHERE status=1 ORDER BY fee_id");
			while($r=fetcharray($sql44))
			{
					$flag=1;
					if($r[2]==1)
					{
						$feests=fetchrow(execute("select cleared from `fee_m_head_total` where feeHead='$r[0]' and studentId='$stud_id' and status=1"));
						if($feests[0]==1)
						$flag=0;

					}
					if($flag)
					{
						$feeval=fetchrow(execute("select amount from  fee_m_descrption_val where uid='$uid' and fee_head='$r[0]' and inst_id='$instalment'"));
						if($feeval[0])
						$val=$feeval[0];
						else
						$val=0;
						
						$sumval=$sumval+$val;
						if($val)
						{
							echo "<tr><input type='hidden' name='feeType[]' value='$r[0]'>
								<input type='hidden' name='feeRecVal[]' value='$val'>
								<td align='center'>$i</td>
								<td align='right'>$r[1]&nbsp;&nbsp;</td>
								<td align='right''  nowrap>$val $currencydes[0]&nbsp;&nbsp;</td>
						   	</tr>";
						   	$i++;
						}
					}
				}

		
	if(!$fine)
	$fine=0;		
	if($t_due_date<$systemdate)
	{
			?>
            <tr>
              <td colspan="2" align='right'><font color="#FF0000">Fine Amount</font>&nbsp;&nbsp;</td>
              <td align='right' nowrap ><input type="text" name="fine" id="fine" value="<?=$fine?>" width="10" size='10'  onBlur="totcal()"><?=$currencydes[0]?>
              </td>
            </tr>
      <?php      
	}
       ?>     
            <tr>
              <td colspan="2" align='right'><strong>Total Fee Amount</strong>&nbsp;&nbsp;</td>
              <td align='right' nowrap><input type="text" name="amt" id="amt" value="<?=$amt?>"  width="10" size='10' readonly><?=$currencydes[0]?>
            	</td>
            </tr>
            <tr>
              <td colspan="3" align="center"><textarea name="remk" cols="50" rows="5"></textarea></td>
            </tr>
        </table>
</table>
<br>
<div align="center">
<input type="submit" name="submit" class="bgbutton" value="   Print   " onClick="genrpt1()">
</div>
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