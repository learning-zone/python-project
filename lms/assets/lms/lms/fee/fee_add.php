<?php
	session_start();
	include("../db.php");
	
	$ttransopotation_no_month=10; //enter the number of month 
	$coverval=$_POST['coverval'];
	
	$stud_id=$_REQUEST['stud_id'];
	$course=$_REQUEST['course'];
	$sem=$_REQUEST['sem'];
	$adm_id=$_REQUEST['adm_id'];
	
	$stud_yr=$_REQUEST['stud_yr'];  //student current accadamic year
	$admited_yr=$_REQUEST['admited_yr']; //student admited year
	$a_year=$_REQUEST['a_year']; //student paying accadamic year where he is going to pay fee
	
	
	$r=fetcharray(execute("select a.id,a.student_id,a.first_name,a.last_name,a.admission_type,a.course_admitted,a.course_yearsem,a.academic_year,a.class_section_id,a.adm_yr from student_m a,fee_apply_fee_student b  where a.archive='N' and b.acc_year='$a_year' and a.id=b.student_id and b.status='1' and b.division='$sem' and a.id='$stud_id'"));

	$admitedyear=$r[adm_yr];

	$slab_id=fetchrow(execute("select slab_id from fee_slab_student where status='1' and  student_id='$r[id]' and acc_year='$a_year'"));
	$chkstud=fetchrow(execute("select uid, currency from fee_m_descrption where status='1' and   adm_cat='$r[admission_type]'  and class='$sem' and accyear='$slab_id[0]' "));
			
	
	$uid=$chkstud[0];

// To get master information from the master table
	
	$fee12=execute("select uid,no_of_instal, currency from  fee_m_descrption where uid='$uid'");
	while($r2=fetcharray($fee12))
	{
		$no_of_instal=$r2[1];
		$currency=$r2[2];
	}
	$installid=fetchrow(execute("select count(installmentId) from fee_m_collect  where studentId='$stud_id' and accYear=$a_year and status=1"));
	
		if(!$installid[0])
		$instalment=1;
		elseif($installid[0]==$no_of_instal)
		die("No Due");// all the installment amount cleared
		else
		$instalment=$installid[0]+1;




$currentclass=fetcharray(execute("select year_name from course_year where year_id='$r[course_yearsem]'"));

$newclass=fetcharray(execute("select year_name from course_year where year_id='$sem'"));


	
	//fetching installmentId key
	
		
	
	// reciving post data
	$oexeamt=$_POST['oexeamt'];
	$oldbalamt=$_POST['oldbalamt'];
	$pydt=$_POST['pydt'];
	$pymt=$_POST['pymt'];
	$pyyr=$_POST['pyyr'];
	$paymenttype=$_POST['paymenttype'];
	$fnamt=$_POST['fnamt'];
	$cenamt=$_POST['cenamt'];
	
	
	
	
	// to get currency code
	$currencydes=fetchrow(execute("select codeL , codeR from fee_m_currency_code where id='$currency'"));
	
	//find the total amount and payment date  
		$sql=execute("select amount, f_due_date, t_due_date from  fee_m_descrption_inst_total where inst_id='$instalment' and uid='$uid' and sts=1 ");
	while($rm1=fetcharray($sql))
	{
		$amt=$rm1[0];
		$f_due_date=$rm1[1];
		$t_due_date=$rm1[2];
	}
	

	
	$systemdate=date("Y-m-d");


?>
<!DOCTTYPE html>
<html>
<head>
<title>Fee Receipt</title>
<script type="text/javascript">
function reloadMe()
{
	document.frm.action="fee_add.php";
	document.frm.submit();
}
</script>
<script type="text/javascript">
function genrpt1()
{

//	var tot=<?=$amt?>;
	var tot=parseInt(document.getElementById("amt1").value);

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
	}

}
function rptval(conver)
{
	if(isNaN(conver) || conver=='0')
	{
		alert("Conversion value not update");
	}
	else
	{
		document.frm.action="fee_add.php";
		document.frm.submit();
	}
}
function totcal()
{
	var tot=parseInt(document.getElementById("amt1").value);
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
function addcheck(str)
{
	
	var url="sessionfile.php";
	
	url=url+"?q="+str;
	url=url+"&sid="+Math.random();
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}

</script>

</head>

<form name="frm"  action="" method="post">
<body>
<input type='hidden' name='course' value='<?=$course?>'>
<input type='hidden' name='sem' value='<?=$sem?>'>
<input type='hidden' name='adm_id' value='<?=$adm_id?>'>
<input type='hidden' name='stud_id' value='<?=$stud_id?>'>
<input type='hidden' name='stud_yr' value='<?=$stud_yr?>'>

<input type='hidden' name='a_year' value='<?=$a_year?>'>
<input type='hidden' name='currencyType' value='<?=$currency?>'>
<input type='hidden' name='admited_yr' value='<?=$admited_yr?>'>
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
$sel4="";
if($paymenttype==1)
	$sel1="selected";
elseif($paymenttype==2)
	$sel2="selected";
elseif($paymenttype==3)
	$sel3="selected";
elseif($paymenttype==4)
	$sel4="selected";


?>
<input type='hidden' name='oexeamt' value='<?=$oexeamt?>'>
<input type='hidden' name='oldbalamt' value='<?=$oldbalamt?>'>

<br>
<table border='1' width='70%' align='center' cellspacing='0' cellpadding='1' class='forumline'>
	<tr>
    	<td colspan='4' align='center' class='head'>Fee Payment Details</td>
    </tr>
	<tr>
    	<td colspan="2">&nbsp;&nbsp;Student Name : <?=$r[2].' '.$r[3]?></td>
   
    	<td colspan="2">&nbsp;&nbsp;Current <?=$_SESSION['semname']?> : <?=$currentclass[0]?></td>
    </tr>
	<tr>
    	<td colspan="2">&nbsp;&nbsp;Paying Fee for <?=$_SESSION['semname']?> <?=$newclass[0]?></td>
    	<td colspan="2">&nbsp;&nbsp;<?php
        if($currency>1)
		{
			echo "Would you like to convert native currency";
			$sql2=execute("select eur,  usd  from  `fee_collection_settings` where `accyear`='$a_year'");
			while($r=fetcharray($sql2))
			{
				$eur=$r['eur'];
				$usd=$r['usd'];
				
				if($currency==2)
				$valamt=$usd;
				if($currency==3)
				$valamt=$eur;				
			}
			if($coverval)
			$checked='checked';
			else
			$checked='';
			
			?>
            <input type="checkbox" name="coverval" value="<?=$valamt?>" onClick="rptval(<?=$valamt?>)" <?=$checked?>>
            <?php	
		}
		if(!$coverval)
		$coverval=1;
		?>
        </td>
    </tr>

	<tr>
   	  <td nowrap>&nbsp;&nbsp;Payment Date</td>
		<td nowrap>
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
			for($i=$cyr-8;$i<=$cyr+2;$i++)
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
        	<select name="paymenttype" onChange="reloadMe()">
                <option value="">-- Select --</option>
                <option value="1" <?=$sel1?>>Cash</option>
                <option value="2" <?=$sel2?>>Demand Draft</option>
                <option value="3" <?=$sel3?>>Bank Cheque</option>
                <option value="4" <?=$sel4?>>Tele Transfer</option>
            </select>
        	<select name="noofcheck" onChange="addcheck(this.value)">
                <option value="0">No of Cheque</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
             	 <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              	<option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                </select>

		</td>
	</tr></table>

<div id="txtHint9" class="inline">   
</div>
<!--<br>
<div align="center">
<input type='button' class='bgbutton' name='sub1' value='Submit'>
</div>-->
<br>
<?php
if(!$paymenttype)
die();

	?>
        <table align="center" border="1" cellpadding="0" cellspacing="5" width="70%">
            <tr>
              <td width="5%" align="center" class="head" nowrap>Sl No</td>
              <td align="center" class="head">Fee Head</td>
              <td width="10%" colspan="2" align="center" class="head" nowrap>Fee Paid</td>
            </tr>
    	<?php
		$maxtot=0;
		$stiddet=fetchrow(execute("select discount_id from  fee_discount_student where student_id='$stud_id' and status='1' and acc_year='$a_year'"));
			$i=1;
			// retriving fee details from fee head 
			$sql44= execute("SELECT fee_id,fee_name, ftype FROM fee_type WHERE status=1 ORDER BY fee_id");
			while($rm2=fetcharray($sql44))
			{
					$flag=1;
					if($rm2[2]==1)
					{
						/*$feests=fetchrow(execute("select cleared from `fee_m_head_total` where feeHead='$rm2[0]' and studentId='$stud_id' and status=1"));
						if($feests[0]==1)
						$flag=0;
						*/
						$feest3=fetchrow(execute("select id from  `fee_m_head_inst_collected` where studentId='$stud_id' and status=1 limit 1"));
						if($feest3[0])
						$flag=0;
						
					
					}
					$feeval=fetchrow(execute("select amount from  fee_m_descrption_val where uid='$uid' and fee_head='$rm2[0]' and inst_id='$instalment'"));
					if(!$flag)
					{
						$amt=$amt-$feeval[0];
					}
					if($flag)
					{
						if($feeval[0])
						$val=$feeval[0];
						else
						$val=0;
						
						$sumval=$sumval+$val;
						if($val and $val!='0.00')
						{
							
							$feeval1=fetchrow(execute("select discountAmt,curType from  fee_discount_det where admissionType='$adm_id' and disscountType='$stiddet[0]' and feeHead='$rm2[0]' and status='1' "));
							
							echo "<tr><input type='hidden' name='feeType[]' value='$rm2[0]'>
								<input type='hidden' name='feeRecVal[]' value='$val'>
								<td valign='top' align='center'>$i .</td>
								<td align=''>&nbsp;&nbsp;";
								echo $rm2[1];
								echo "&nbsp;&nbsp;";
								$val2=0;
								if($feeval1[1]==1)
								{
									$val2=round(($val*$feeval1[0]/100),2);
								}
								if($feeval1[1]==2)
								{
									$val2=round($feeval1[0],2);
								}
								if($val2)
								{
									$val3=explode('.',$val2);
									if(sizeof($val3)<2)
									$val2=$val2.'.00';
								}
								if($val2)
								{
									$feeval2=fetchrow(execute("select name from  `fee_discount_head` where  id='$stiddet[0]' and status='1' "));					if($feeval2[0])
									echo "<br>&nbsp;&nbsp;Discount $feeval2[0]&nbsp;&nbsp;";
								}
								$val=$coverval*$val;
								echo "</td><td align='right'  nowrap>";
								echo $val." &nbsp;&nbsp;";
								$val7=$val;
								if($val2)
								{
									echo "<br> - $val2 &nbsp;&nbsp;";
									$maxtot=$maxtot+$val2;
									$val7=$val7-$val2;
								}
								echo "<input type='hidden' name='feeRecValdis[]' value='$val2'>";
								$val9=explode('.',$val7);
								if(sizeof($val9)<2)
								$val7=$val7.'.00';
								echo "</td><td  valign='bottom' align='right' >$val7&nbsp;&nbsp;</td>
						   	</tr>";
						   	$i++;
							$val2=0;
							$val7=0;
						}
					}
				}

				
	if(!$fine)
	$fine=0;
	echo "<tr><td colspan=4><br></td></tr>";		
	if($t_due_date<$systemdate)
	{
			?>
            <tr>
              <td colspan="3" align='right'><font color="#FF0000">Fine Amount</font>&nbsp;&nbsp;</td>
              <td align='right' nowrap ><input type="text" name="fine" id="fine" value="<?=$fine?>" style="text-align:right" width="10" size='10'  onBlur="totcal()">&nbsp;&nbsp;
              </td>
            </tr>
      <?php      
	}
	else
	echo '<input type="hidden" name="fine" id="fine" value="0">';
	
 				$amt=$coverval*$amt;
				
				$amt1=$amt;
				$amt2=explode('.',$amt1);
				if(sizeof($amt2)<2)
				$amt1=$amt1.'.00';

				$val3=explode('.',$maxtot);
				if(sizeof($val3)<2)
				$maxtot=$maxtot.'.00';
				if(!$maxtot)
				$maxtot='0.00';
				
				$amt=$amt-$maxtot;
				
				$amtt=explode('.',$amt);
				if(sizeof($amtt)<2)
				$amt=$amt.'.00';
				
			?>
            <tr>
                <td colspan="3" align='right'>Total&nbsp;&nbsp;</td><input type='hidden' name='totalamt' value='<?=$amt1?>'>
              <td align='right' nowrap><?=$amt1?>&nbsp;&nbsp;
            	</td>
            </tr>
             <tr>
              <td colspan="3" align='right'>Total Discount&nbsp;&nbsp;</td><input type='hidden' name='totaldiscount' value='<?=$maxtot?>'>
              <td align='right' nowrap><?=$maxtot?>&nbsp;&nbsp;
            	</td>
            </tr>
		<tr><td colspan=4><br></td></tr>		

            <tr>
              <td colspan="3" align='right'><strong>Grand Total</strong>&nbsp;&nbsp;</td>
              <input type="hidden" name="amt1" id="amt1" value="<?=$amt?>" >
              <td align='right' nowrap><?=$currencydes[0]?><input type="text" name="amt" id="amt" value="<?=$amt?>" style="text-align:right" width="10" size='10' readonly><?=$currencydes[1]?>&nbsp;&nbsp;
            	</td>
            </tr>
            <tr>
              <td colspan="4" align="center"><textarea name="remk" cols="50" rows="5"></textarea></td>
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
</body>
</form>

</html>