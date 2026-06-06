<html>
<head>
<title>Fee Receipt</title>
<?php
session_start();
include("../db1.php");
include("numbers-words.php");
//number_to_words($ttlamt)
	$coverval=$_POST['coverval'];
	$admited_yr=$_POST['admited_yr']; //student admited year
	$userDetails=$_SESSION['user']." ".date('d-m-Y H:i:s');
	$course=$_POST['course'];	//branch name
	$sem=$_POST['sem'];		//semister		
	$adm_id=$_POST['adm_id'];	//admision ID
	$stud_id=$_POST['stud_id'];	//student row id
	$stud_yr=$_POST['stud_yr'];	//accadamic year
	$oexeamt=$_POST['oexeamt'];	//old exxcess payment
	$oldbalamt=$_POST['oldbalamt'];		// old balance payment 
	$currency=$_POST['currencyType'];		//currency type
	$installmentId=$_POST['installmentId'];		//installmentId 	
	$a_year=$_POST['a_year'];
	
	$noofcheck=$_POST['noofcheck'];
	$feeRecValdis=$_POST['feeRecValdis']; // discount amount per head

	$adm_id=$_REQUEST['adm_id'];
	$stud_yr=$_REQUEST['stud_yr'];
	$admited_yr=$_REQUEST['admited_yr'];

	$fine=round($_POST['fine'],2);		//fine
	$uid=$_POST['uid'];
	$currencydes=fetchrow(execute("select code, name from fee_m_currency_code where id='$currency'"));

	
	$pydt=$_POST['pydt'];	
	$pymt=$_POST['pymt'];
	$pyyr=$_POST['pyyr'];
	$pamentdate="$pyyr-$pymt-$pydt";		//Payment Date
	$pamentdatedisplay="$pydt-$pymt-$pyyr";		//Payment Date display
		
	$paymenttype=$_POST['paymenttype'];		//Mode of Payment
	$bname=$_POST['bname'];		//Bank Name
	$bdet=$_POST['bdet'];		//Branch Details
	$ddno=$_POST['ddno'];		//DD or Cheque No.
	
	$pdt=$_POST['pdt'];
	$pmt=$_POST['pmt'];
	$pyr=$_POST['pyr'];
	$chequeDate="$pyr-$pmt-$pdt";		//DD/Cheque Date
	$chequeDatedis="$pdt-$pmt-$pyr";		//DD/Cheque Date
	
	$totalamt=$_POST['totalamt'];  //total amout collecte without dis
	$amt=$_POST['amt'];  	//total paid  after discount 
	$amtt=explode('.',$amt);
	if(sizeof($amtt)<2)
	$amt=$amt.'.00';
	$totaldiscount=$_POST['totaldiscount']; // total discount 
	
	$amtt=explode('.',$fine);
	if(sizeof($amtt)<2)
	$fine=$fine.'.00';
	
	$remk=$_POST['remk'];		//remarks
	
	$feeType=$_POST['feeType'];
	$feeRecVal=$_POST['feeRecVal'];
	
	$receipt='dd';

/*
$finaceyear=fetchrow(execute("SELECT * FROM `fee_financial_year`"));
if($pymt>$finaceyear[0])
$newacc=$pyyr+($finaceyear[1]);
elseif($pymt<$finaceyear[0])
$newacc=$pyyr+($finaceyear[2]);
elseif($pymt==$finaceyear[0])
$newacc=$pyyr+($finaceyear[3]);

$newacc1=$newacc+1;

$fstartdate
$fenddate

$studentdiscountid=fetchrow(execute("select discount_id from  fee_discount_student where student_id='$stud_id' and status='1' and acc_year='$a_year'"));

*/

$sql=fetcharray(execute("SELECT count(*) FROM `fee_m_collect` where `paymentDate` between '2013-04-01' and '2014-03-31'"));
$docid=$sql[0]+1;
$docid="EM/FR/2013/".$docid;

//to check duplicate entry
$validation=execute("select receipt from `fee_m_collect` where `accYear`='$a_year' and `studentId`='$stud_id' and  `admissionCat`='$adm_id' and `installmentId`='$installmentId' and status=1");
if(rowcount($validation))
{
	$sql=fetcharray($validation);
	$docid=$sql[0];
}
?>
<script language="javascript" type="text/javascript">
function dataprint()
{
	prn.style.display = "none";
	window.print(this.form);
}
function clswnd()
{
	window.close();
}
function showKeyCode(e)
{
	var keycode = e;
	if(keycode == 116)
	{
		event.keyCode = 0;
		event.returnValue = false;
		return false;
	}
}
function exportexl()
{
		document.frm.action="gen_recpt1.php?stsexl=1";
}
</script>
<style >
.body
{

	font-family:"Times New Roman", Times, serif;
	font-size:14px;
	//font-weight:bold;
	
	//
}
body
{

	font-family:"Times New Roman", Times, serif;
	font-size:14px;
	//font-weight:bold;
	
	//
}
</style>
</head>
<body class="body">
<form name="frm" method='post'>
<?php
$dddate=$pydt."-".$pymt."-".$pyyr;

$dddate1=$pyyr."-".$pymt."-".$pydt;
$dddate2=$pdt."-".$pmt."-".$pyr;
$dddate3=$pyr."-".$pmt."-".$pdt;

$cdate1=date("d-m-Y");
$tdt=date("Y-m-d");
$cyr=$a_year;

$sql=fetcharray(execute("select first_name,last_name,student_id,course_yearsem,admission_id, cor_address, cor_city, cor_state, cor_country, cor_pincode from student_m where id=$stud_id"));
$sql1=fetcharray(execute("select course_abbr from course_m where course_id=$course"));
$sql2=fetcharray(execute("select year_name from course_year where year_id='$sem'"));
if($paymenttype==1)
	$modepay="Cash";
elseif($paymenttype==2)
	$modepay="Demand Draft";
elseif($paymenttype==3)
	$modepay="Cheque";
elseif($paymenttype==4)
	$modepay="Tele Transfer";

$userid=fetcharray(execute("select id from users where username='$user'"));
for($mk=1;$mk<3;$mk++)
{
	if($mk==1)
	$printname='School Copy';
	else
	$printname='Student Copy';
	
?>
		<table class="body"   align="center" width="90%" cellpadding="0" cellspacing="0" border="0" >
		
            <tr>
            	<td colspan="2">
                    <table class="body"  border="0" width="100%" cellpadding="2" cellspacing="0">
                    <tr height="150">
                        <td align="right" colspan="2">
                        
                        </td>
                    </tr>	<?php
				$yer=$a_year+1;
				?>
                        <th align="center" colspan="4" nowrap="nowrap" bgcolor="#CCCCCC"><font size="+1"><i>Fee Receipt for Academic  Session <?=$a_year."-".$yer?></i></font></th>
                    <tr colspan="4" nowrap="nowrap"><td><br></td></tr>
                    
                	<tr>
                    	<td width="10%" nowrap>
                        Receipt No : 
                        </td>
						<td width="60%" nowrap>
						<?=$docid?>
                        </td>
                    	<td width="10%" nowrap>
                        </td>
						<td width="20%" nowrap>
                        Date : 
						<?=$pamentdatedisplay?>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="4"><hr>
                        </td>
                    </tr>        
                	<tr>
                    	<td nowrap>
                        Name &nbsp;&nbsp;&nbsp;&nbsp;: </td>
						<td colspan="3" nowrap><?=$sql[0].' '.$sql[1]?>
                        </td>
                    </tr>    
                	<tr>
                    	<td valign="top" rowspan="3" nowrap>
                        Address :
                        </td>
                        <td align="justify" rowspan="3" >
                        <?=$sql[5].' '.$sql[6].' '.$sql[7].' '.$sql[8].' '.$sql[9]?>
                        </td>
                    	<td nowrap>
                        </td>
						<td nowrap>
                        <?=$_SESSION['semname']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
						<?=$sql2[0]?>
                        </td>
                    </tr>    
                	<tr>
                    
                    	<td nowrap>
                       
						</td>
						<td nowrap>
						Currency : 
						<?=$currencydes[1]?>
                        </td>
                    </tr>
                    
                    <tr>
                    
                    	<td nowrap>
                       
						</td>
						<td nowrap>
						<?php
						if($coverval)
						{
                        	echo "Xchg.Rate : $coverval";
						}?></td>
                    </tr>       
                </table>
              </td>
          </tr>           
        </table> 
  <div style="background-image:url(http://www.ecole.myschoolone.com/renew/images/EcoleWatermark1.png)">
        <table class="body"  align="center" border="0" cellpadding="5" cellspacing="0" width="90%" height="170">
          <tr height="30">
            
            <td align="" colspan="3" bgcolor="#CCCCCC">Particulars</td>
            <td  align="center" bgcolor="#CCCCCC"  width="20%">Amount</td>
          </tr>
		<?php
		$maxtot=0;
		$stiddet=fetchrow(execute("select discount_id from  fee_discount_student where student_id='$stud_id' and status='1' and acc_year='$a_year'"));
        $i=1;
        $sql44= execute("SELECT fee_id,fee_name, ftype FROM fee_type WHERE status=1 ORDER BY fee_id");
        while($r=fetcharray($sql44))
        {
			$flag=1;
			if($r[2]==1)
			{
				/*$feests=fetchrow(execute("select cleared from `fee_m_head_total` where feeHead='$r[0]' and studentId='$stud_id' and status=1"));
				if($feests[0]==1)
				$flag=0;
				*/
				$feest3=fetchrow(execute("select id from  `fee_m_head_inst_collected` where studentId='$stud_id' and status=1 limit 1"));
				if($feest3[0])
				$flag=0;
			}
			if($flag)
			{
			
				$feeval=fetchrow(execute("select amount from  fee_m_descrption_val where uid='$uid' and fee_head='$r[0]' and inst_id='$installmentId'"));
				if($feeval[0])
				$val=$feeval[0];
				else
				$val=0;
				
				$sumval=$sumval+$val;
				if($val and $val!='0.00' and $val!=0)
				{	
					$feeval1=fetchrow(execute("select discountAmt,curType from  fee_discount_det where admissionType='$adm_id' and disscountType='$stiddet[0]' and feeHead='$r[0]' and status='1' "));
							
							echo "<tr height='30'>
								<td  valign='top'  colspan='3'>&nbsp;&nbsp;";
								echo $r[1];
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
									$feeval2=fetchrow(execute("select name from  `fee_discount_head` where  id='$stiddet[0]' and status='1' "));					//if($feeval2[0])
									//echo "<br>&nbsp;&nbsp;Discount $feeval2[0]&nbsp;&nbsp;";
								}
								//echo "</td><td align='right'  nowrap>";
								//echo "$val &nbsp;&nbsp;";
								$val7=$val;
								if($val2)
								{
									echo "<br> - $val2 &nbsp;&nbsp;";
									$maxtot=$maxtot+$val2;
									$val7=$val7-$val2;
								}
								if($coverval)
								$val7=$val7*$coverval;
								
								$val9=explode('.',$val7);
								if(sizeof($val9)<2)
								$val7=$val7.'.00';
								echo "</td><td  valign='top'  valign='bottom' align='right' >$val7&nbsp;&nbsp;</td>
						   	</tr>";
						   	$i++;
							$val2=0;
							$val7=0;

				}
			}
        }
if($coverval)
{
		
		$conval=round($amt/$coverval);
		echo "<tr ><td  colspan='3' valign='bottom'> $currencydes[1] $conval IS CONVERTED TO Rs (INR) </td><td align='right' valign='top' > &nbsp;</td></tr>";
}
		echo "<tr ><td  colspan='3' valign='bottom'> &nbsp; </td><td align='right' valign='top' > &nbsp;</td></tr>";

?>
    </table>
        <table class="body"  align="center" border="0" cellpadding="5" cellspacing="0" width="90%" height="10">
          <tr><td  colspan='3' valign="bottom"></td><td align='right' valign="top" ></td></tr>
      </table>
  </div>
<table class="body"  align="center" border="0" cellpadding="2" cellspacing="0" width="90%">

<?php
if($noofcheck)
{   
if($coverval)
$currencydes1=fetchrow(execute("select code, name from fee_m_currency_code where id=1"));
     
echo "<tr height='150'><td colspan=4><table class='body'  align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>";
	for($m1=1;$m1<=$noofcheck;$m1++)
	{
		echo "<tr height='4'><td colspan=4><hr></td></tr>";
		$bname=$_POST['bname'.$m1];
		$bamt=$_POST['bamt'.$m1];
		$ddno=$_POST['ddno'.$m1];
		$pdt=$_POST['pdt'.$m1];
		$pmt=$_POST['pmt'.$m1];
		
		$bankname=fetchrow(execute("select bank_name from bank_details where id=$bname "));
	
		$amtt=explode('.',$bamt);
		if(sizeof($amtt)<2)
		$bamt=$bamt.'.00';

		$pyr=$_POST['pyr'.$m1];
		
		$checkdate="$pdt-$pmt-$pyr";
		echo "<tr>
		<td width='5%'  nowrap>
		$modepay No</td>
		<td nowrap> : $ddno</td>
		<td width='5%' align='right' nowrap>Amt &nbsp;&nbsp;: </td>
		<td align='right'  width='5%' nowrap>$currencydes1[0] &nbsp;&nbsp;&nbsp;&nbsp;$bamt</td>
		</tr>
		<tr>
		<td width='' nowrap>Bank Name</td>
		<td  nowrap> : $bankname[0]</td>
		<td width='right'  nowrap>$modepay Date : </td>		
		<td align='right' nowrap>$checkdate</td>
		</tr>";

	}
		echo "<tr height='4'><td colspan=4><hr></td></tr>";
	echo " </table>    </td></tr> ";            
	
}
		
	if(!$fine)
	$fine=0;

	if($t_due_date<$systemdate)
	{
			?><!--
            <tr>
              <td colspan="3" align='right'><font color="#FF0000">Fine Amount</font>&nbsp;&nbsp;</td>
              <td align='right' nowrap ><?=$fine?>&nbsp;&nbsp;
              </td>
            </tr>-->
      <?php      
	}
	       ?>     
            <?php
				$amt1=$totalamt;
				$amt2=explode('.',$amt1);

				if(sizeof($amt2)<2)
				$amt1=$amt1.'.00';

				$val3=explode('.',$maxtot);
				if(sizeof($val3)<2)
				$maxtot=$maxtot.'.00';

				if(!$maxtot)
				$maxtot='0.00';
				
				//$amt=$amt-$maxtot;
				
				$amtt=explode('.',$amt);
				if(sizeof($amtt)<2)
				$amt=$amt.'.00';
				
			?>
 <!-- 
    <tr>
        <td colspan="3" align='right'>Total&nbsp;&nbsp;</td>
        <td align='right' nowrap><?=$amt1?>&nbsp;&nbsp;
        </td>
    </tr>
    <tr>
        <td colspan="3" align='right'>Total Discount&nbsp;&nbsp;</td>
        <td align='right' nowrap><?=$maxtot?>&nbsp;&nbsp;
        </td>
    </tr>
    <tr><td colspan=4><br></td></tr>		
-->
</table>
<table class="body"  align="center" border="0" cellpadding="2" cellspacing="0" width="90%">
  <tr>
    <td colspan="3" align='' bgcolor="#CCCCCC">Total Amount : </td>
    
    <td align='right' bgcolor="#CCCCCC" nowrap>
	<?php
    if($coverval)
	{	
		$currencydes2=fetchrow(execute("select code, name from fee_m_currency_code where id=1"));

		echo $currencydes2[0];
	}else
	echo $currencydes2[0];
	?> &nbsp;&nbsp;&nbsp;&nbsp;<?=$amt?>&nbsp;&nbsp;
      </td>
  </tr>          
  <tr>
    <td  align=''>(In Words) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp:</td>
    
    <td align='' colspan="3" >
	<?php
	if($coverval)
	{
	?>
	Rs (INR) &nbsp;<?=ucwords(number_to_words($amt))?> only&nbsp;&nbsp;
    <?php
	}
	else
	{
	?>
    <?=$currencydes2[1]?>&nbsp;<?=ucwords(number_to_words($amt))?> only&nbsp;&nbsp;
    <?php
	}
	?>    
        
      </td>
  </tr>          
  <tr>
    <td colspan="4"  align="justify" >
      <br><strong>Subject To Realization of the Cheque</strong>   
      </td>
  </tr>
  <tr>  
    <td colspan="4"  align="justify" >  
      Fee receipt is subjected to the realization of cheque(s)&nbsp;&nbsp;&nbsp<br>&nbsp;&nbsp;&nbsp<?=$remk?>
      <br>
      <?php
            if($noofcheck==0)
			echo "<br><br><br><br>";
			elseif($noofcheck==1)
			echo "<br><br><br>";
			elseif($noofcheck==2)
			echo "<br><br>";
			elseif($noofcheck==3)
			echo "<br>";
			
			
			?>
      <br><br>
      
      </td>
  </tr>
  <tr>
    <td align="center" width="190" nowrap><hr><br>Admission office
      </td>
    <td>
      </td>
    <td>
      </td>
    <td  align="center"  width="190" nowrap><hr><br>Receivers Signature
      </td>
  </tr>
  <tr>
    <td colspan="4"  align="center" nowrap><br> 
      <font style="font-size:12px"><?=$printname?></font>	             
      </td>
  </tr>
</table> 
        
        <div style="page-break-after:always;"> </div>
<?php       
}
?>        
</form>
<div id="prn" align='center'><Input Type="button" Value=" Print " class='bgbutton' onClick="dataprint()"><!--
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<Input Type="button" Value=" Send SMS " class='bgbutton' onClick="">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<Input Type="button" Value=" Send Mail " class='bgbutton' onClick="">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name='clse' value=" Close " class='bgbutton' onClick="clswnd()">--></div>
<?php

//to check duplicate entry
$validation=execute("select id from `fee_m_collect` where `accYear`='$a_year' and `studentId`='$stud_id' and  `admissionCat`='$adm_id' and `installmentId`='$installmentId' and status=1");
if(!rowcount($validation))
{
	$feestBlock=fetchrow(execute("select no_of_student from `fee_m_descrption` where uid='$uid'"));
	$feestBlock1=$feestBlock[0]+1;
	execute("update `fee_m_descrption` set no_of_student='$feestBlock1' where uid='$uid' ");
	
	$feestBlockInst=fetchrow(execute("select no_of_student from `fee_m_descrption_inst_total` where uid='$uid' and inst_id='$installmentId'"));
	$feestBlockInst1=$feestBlockInst[0]+1;
	
	execute("update `fee_m_descrption_inst_total` set no_of_student='$feestBlockInst1' where uid='$uid' and inst_id='$installmentId'");
	
	//to check if currancy type is native currancy and payment mode is cash this ll update the details
	if($currency==1 and $paymenttype==1)
	{
		$clearedDate=$pamentdate;
		$amountCleared=$amt;
	}
	
	//INSERT INTO `renew_sis`.`fee_m_collect` (`id`, `accYear`, `studentId`, `admissionCat`, `currencyType`, `installmentId`, `amount`, `totalAmount`, `totalDisAmount`, `discountType`, `fine`, `paymentDate`, `modeOfPament`, `userDetails`, `noOfddCheque`, `amountCleared`, `remarks`, `receipt`, `status`, `remarks_cancel`, `date_cancel`) VALUES (NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		
	$sql4="INSERT INTO `fee_m_collect` ( `accYear`, `studentId`, `admissionCat`, `currencyType`, `installmentId`, `amount`,  `totalAmount`, `totalDisAmount`, `discountType`,`fine`, `paymentDate`, `modeOfPament`, `userDetails`, `noOfddCheque`, `remarks`, `receipt`, `status`,`clearedDate`,`amountCleared`) VALUES ('$a_year', '$stud_id', '$adm_id', '$currency', '$installmentId', '$amt', '$totalamt', '$totaldiscount', '$studentdiscountid[0]', '$fine', '$pamentdate', '$paymenttype', '$userDetails', '$noofcheck', '{$remk}', '{$docid}', '1','$clearedDate','$amountCleared')";
	execute($sql4);
	
	
	$insertedid=fetchrow(execute("select id,receipt from fee_m_collect where `accYear`='$a_year' and `studentId`='$stud_id' and `admissionCat`='$adm_id' and `currencyType`='$currency' and `installmentId`='$installmentId' and status=1"));

	for($m1=1;$m1<=$noofcheck;$m1++)
	{
		$bname=$_POST['bname'.$m1];
		$bamt=$_POST['bamt'.$m1];
		$ddno=$_POST['ddno'.$m1];
		$pdt=$_POST['pdt'.$m1];
		$pmt=$_POST['pmt'.$m1];
		
		$amtt=explode('.',$bamt);
		if(sizeof($amtt)<2)
		$bamt=$bamt.'.00';

		$pyr=$_POST['pyr'.$m1];
		$checkdate="$pyr-$pmt-$pdt";
		
		execute("INSERT INTO `fee_m_cheque_det` (`receiptId`, `receiptDet`,  `bankName`, `amount`, `ddChequeNo`, `ddChequeDate`, `status`) VALUES ('$insertedid[0]', '$insertedid[1]', '$bname', '$bamt', '$ddno', '$checkdate', '1')");
		
		
	}

	
	for($i=0;$i<sizeof($feeRecVal);$i++)
	{
		$feeType1=$feeType[$i]; // fee head id 
		$feeRecVal1=$feeRecVal[$i];  // total amount to be paid before discount 
		$feeRecValdis1=$feeRecValdis[$i]; // discount amount 
		//echo "$feeRecValdis1 <br>";
		$feeRecValfinal=$feeRecVal1-$feeRecValdis1; //paid amount
		//this code ll insert the  value each fee head vice data
		
		if($paymenttype==1 and $currency==1)
		{
			$sqlinst="INSERT INTO `fee_m_head_inst_collected` (`uid`, `accYear`, `instId`, `receipt`, `studentId`, `feeHead`, `totalAmount`, `totalConverted`, `currency`, `status`,`totalAmountDet`, `totalDisAmount`, `discountType`,`paymentDate`) VALUES ('$uid', '$a_year', '$installmentId', '$docid', '$stud_id', '$feeType1', '$feeRecValfinal', '$feeRecValfinal', '$currency', '1','$feeRecVal1', '$feeRecValdis1','$studentdiscountid[0]', '$pamentdate')";
		}
		else
		{
			$sqlinst="INSERT INTO `fee_m_head_inst_collected` (`uid`, `accYear`, `instId`, `receipt`, `studentId`, `feeHead`, `totalAmount`, `totalConverted`, `currency`, `status`,`totalAmountDet`, `totalDisAmount`, `discountType`,`paymentDate`) VALUES ('$uid', '$a_year', '$installmentId', '$docid', '$stud_id', '$feeType1', '$feeRecValfinal', '', '$currency', '1','$feeRecVal1', '$feeRecValdis1','$studentdiscountid[0]', '$pamentdate')";

		}
		execute($sqlinst);
		
		
		//this code ll insert total amount of the data

		$refund=fetcharray(execute("select refund, ftype from fee_type where fee_id='$feeType1'"));
		
		//fee head wise total amount to be paid
		$feeheadtotal=fetchrow(execute("select amount from `fee_m_descrption_head_total` where uid='$uid' and head_id='$feeType1' and sts=1"));			
		
		//fee head wise total amount  paid by student
		$feePaidheadtotal=fetchrow(execute("select sum(totalAmount) from `fee_m_head_inst_collected` where studentId='$stud_id' and feeHead='$feeType1' and status=1"));	
		$fee1amt=fetcharray(execute("select totalCollected, cleared from `fee_m_head_total` where feeHead='$feeType1' and studentId='$stud_id' and status=1"));
		if($fee1amt[0])
		{

			if(!$fee1amt[1])
			{	
				if($feePaidheadtotal[0]==$feeheadtotal[0] and $refund[1]==1)
				{
					$sql15="update `fee_m_head_total` set totalCollected='$feePaidheadtotal[0]', cleared=1 where feeHead='$feeType1' and studentId='$stud_id' and status=1";
				}
				else
				{
					$sql15="update `fee_m_head_total` set totalCollected='$feePaidheadtotal[0]' where feeHead='$feeType1' and studentId='$stud_id' and status=1";	
				}
				execute($sql15);
			}
		}
		else
		{

			if($feeRecVal1==$feeheadtotal[0] and $refund[1]==1)
			{
				execute("INSERT `fee_m_head_total` (`uid`, `accYear`, `studentId`, `feeHead`,  `oneTime`, `totalCollected`, `refund`, `refundAmount`, `cleared`, `status`) VALUES ('$uid', '$a_year', '$stud_id', '$feeType1', '$refund[1]', '$feeRecVal1', '$refund[0]', '', '1', '1')");
			}
			else
			{
				execute("INSERT `fee_m_head_total` (`uid`, `accYear`, `studentId`, `feeHead`, `oneTime`, `totalCollected`, `refund`, `refundAmount`, `cleared`, `status`) VALUES ('$uid', '$a_year', '$stud_id', '$feeType1',  '$refund[1]', '$feeRecVal1', '$refund[0]', '', '', '1')");		
			}
		}
		
	
	}
	

}
?>
</body>
</html>
