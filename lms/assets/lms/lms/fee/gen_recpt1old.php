<html>
<head>
<title>Fee Receipt</title>
<?php
session_start();
include("../db1.php");
include("numbers-words.php");
//number_to_words($ttlamt)
	$admited_yr=$_POST['admited_yr']; //student admited year
	$userDetails=$_SESSION['user']." ".date('d-m-Y H:i:s');
	$course=$_POST['course'];	//branch name
	$sem=$_POST['sem'];		//semister		
	$adm_id=$_POST['adm_id'];	//admision ID
	$stud_id=$_POST['stud_id'];		//student row id
	$stud_yr=$_POST['stud_yr'];		//accadamic year
	$oexeamt=$_POST['oexeamt'];		//old exxcess payment
	$oldbalamt=$_POST['oldbalamt'];		// old balance payment 
	$currency=$_POST['currencyType'];		//currency type
	$installmentId=$_POST['installmentId'];		//installmentId 	
	$noofcheck=$_POST['noofcheck'];
	$feeRecValdis=$_POST['feeRecValdis']; // discount amount per head

	$fine=round($_POST['fine'],2);		//fine
	$uid=$_POST['uid'];
	$currencydes=fetchrow(execute("select code from fee_m_currency_code where id='$currency'"));

	
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

$studentdiscountid=fetchrow(execute("select discount_id from  fee_discount_student where student_id='$stud_id' and status='1' order by acc_year desc limit 1"));



$sql=fetcharray(execute("select id from `fee_m_collect` order by id  DESC limit 1"));
$docid=$sql[0]+1;
$docid="CS/FR/".$docid;

//to check duplicate entry
$validation=execute("select id from `fee_m_collect` where `accYear`='$stud_yr' and `studentId`='$stud_id' and  `admissionCat`='$adm_id' and `installmentId`='$installmentId' and status=1");
if(rowcount($validation))
{
	$sql=fetcharray($validation);
	$docid=$sql[0];
	$docid="CS/FR/".$docid;

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
</script>
</head>
<body oncontextmenu="return false;" onkeydown='showKeyCode(event.keyCode)'>
<form name="frm" method='post'>
<?php
$dddate=$pydt."-".$pymt."-".$pyyr;

$dddate1=$pyyr."-".$pymt."-".$pydt;
$dddate2=$pdt."-".$pmt."-".$pyr;
$dddate3=$pyr."-".$pmt."-".$pdt;

$cdate1=date("d-m-Y");
$tdt=date("Y-m-d");
$cyr=$stud_yr;

$sql=fetcharray(execute("select first_name,last_name,student_id,course_yearsem,admission_id from student_m where id=$stud_id"));
$sql1=fetcharray(execute("select course_abbr from course_m where course_id=$course"));
$sql2=fetcharray(execute("select year_name from course_year where year_id='$sql[course_yearsem]'"));
if($paymenttype==1)
	$modepay="Cash";
elseif($paymenttype==2)
	$modepay="Demand Draft";
elseif($paymenttype==3)
	$modepay="Bank Cheque";

$userid=fetcharray(execute("select id from users where username='$user'"));

?>
<table align="center" width="100%" cellpadding="20" cellspacing="20" border="0">
<tr>
	<td align="center" width="50%">
    <!--office coppy code starts-->
		<table align="center" width="100%" cellpadding="0" cellspacing="0" border="1" >
			<tr>
            	<td nowrap>
     				<img src="../images/logo.PNG" border="0" height="100" width="85">
                </td>
                <td valign="middle" align="center" >
     			   <?=$_SESSION['SchoolName']?><br>
                   <?=$_SESSION['SchoolAddress']?>
                </td>
            </tr>
            <tr>
            	<td colspan="2">
                    <table border="0" width="100%">
                    <tr>
                        <td align="right" colspan="2">
                        <u>Office copy</u><br>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2">
                        <u><strong>FEE RECEIPT</strong></u><br><br>
                        </td>
                    </tr>
                    
                	<tr>
                    	<td width="50%" nowrap>
                        Receipt No : <?=$docid?>
                        </td>
                    	<td width="50%" nowrap>
                        Date : <?=$pamentdatedisplay?>
                        </td>
                    </tr>    
                	<tr>
                    	<td colspan="2" nowrap>
                        Name : <?=$sql[0].' '.$sql[1]?>
                        </td>
                    </tr>    
                	<tr>
                    	<td width="50%" nowrap>
                        <?=$_SESSION['semname']?> : <?=$sql2[0]?>
                        </td>
                    	<td width="50%" nowrap>
                        Admn No : <?=$sql[2]?>
                        </td>
                    </tr>    
                	<tr>
                    	<td width="50%" nowrap>
                        Installment : <?=$installmentId?>
                        </td>
                    	<td width="50%" nowrap>
                        Payment Mode : <?=$modepay?>
                        </td>
                    </tr>    
                </table>
                </td>
            </tr>           
        </table> 
<?php
if($noofcheck)
{        
 ?>       <table align="center" border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
<td align='center' width="40" nowrap>Sl No</td>
<td align='center' nowrap>Bank Name</td>
<td align='center' nowrap>Amount ( <?=$currencydes[0]?> )</td>
<td align='center' nowrap>DD or Cheque No.</td>
<td align='center' nowrap>DD/Cheque Date</td>		
</tr>
		<?php
        for($m1=1;$m1<=$noofcheck;$m1++)
        {
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
			<td align='center' nowrap>$m1</td>
			<td  nowrap>$bankname[0]</td>
			<td align='right' nowrap>$bamt</td>
			<td nowrap>$ddno</td>
			<td nowrap>$checkdate</td>
			</tr>
";            
        }
	?>
     </table> 
    <?php
	}
	?>
          
  
        <table align="center" border="1" cellpadding="5" cellspacing="0" width="100%">
          <tr>
            <td align="center" width="40" nowrap>Sl No</td>
            <td  align="center">Particulars</td>
            <td  align="center" colspan="2" width="20%">Amount</td>
          </tr>
		<?php
		$maxtot=0;
		$stiddet=fetchrow(execute("select discount_id from  fee_discount_student where student_id='$stud_id' and status='1' order by acc_year desc limit 1"));
        $i=1;
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
			
				$feeval=fetchrow(execute("select amount from  fee_m_descrption_val where uid='$uid' and fee_head='$r[0]' and inst_id='$installmentId'"));
				if($feeval[0])
				$val=$feeval[0];
				else
				$val=0;
				
				$sumval=$sumval+$val;
				if($val)
				{	
					$feeval1=fetchrow(execute("select discountAmt,curType from  fee_discount_det where admissionType='$adm_id' and disscountType='$stiddet[0]' and feeHead='$r[0]' and status='1' "));
							
							echo "<tr>
								
								<td valign='top' align='center'>$i .</td>
								<td align=''>&nbsp;&nbsp;";
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
									$feeval2=fetchrow(execute("select name from  `fee_discount_head` where  id='$stiddet[0]' and status='1' "));					if($feeval2[0])
									echo "<br>&nbsp;&nbsp;Discount $feeval2[0]&nbsp;&nbsp;";
								}
								echo "</td><td align='right'  nowrap>";
								echo "$val &nbsp;&nbsp;";
								$val7=$val;
								if($val2)
								{
									echo "<br> - $val2 &nbsp;&nbsp;";
									$maxtot=$maxtot+$val2;
									$val7=$val7-$val2;
								}
								
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
              <td align='right' nowrap ><?=$fine?>&nbsp;&nbsp;
              </td>
            </tr>
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

            <tr>
              <td colspan="3" align='right'><strong>Grand Total</strong>&nbsp;&nbsp;</td>
              
              <td align='right' nowrap><?=$currencydes[0]?>&nbsp;<?=$amt?>&nbsp;&nbsp;<?=$currencydes[1]?>
            	</td>
            </tr>          
          <tr>
            <td colspan="4"  align="justify" nowrap>
            	<br>
                &nbsp;&nbsp;<strong>Remarks :</strong> &nbsp;&nbsp; <?=$remk?>
                <br><br>
                &nbsp;&nbsp;<strong>Amount in words :</strong> 
                <div align="center"><?=number_to_words($amt)?> only</div>
                <br><br>
                <div align="right">Signature&nbsp;&nbsp;</div>
                
                &nbsp;&nbsp; 
            </td>
          </tr>
                  
        </table>  
        

   <!--office coppy code ends-->
    <td align="center" width="50%">
    
        <!--student coppy code starts-->
		<table align="center" width="100%" cellpadding="0" cellspacing="0" border="1" >
			<tr>
            	<td nowrap>
     				<img src="../images/logo.PNG" border="0" height="100" width="85">
                </td>
                <td valign="middle" align="center" >
     			   <?=$_SESSION['SchoolName']?><br>
                   <?=$_SESSION['SchoolAddress']?>
                </td>
            </tr>
            <tr>
            	<td colspan="2">
                    <table border="0" width="100%">
                    <tr>
                        <td align="right" colspan="2">
                        <u>Student copy</u><br>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2">
                        <u><strong>FEE RECEIPT</strong></u><br><br>
                        </td>
                    </tr>
                    
                	<tr>
                    	<td width="50%" nowrap>
                        Receipt No : <?=$docid?>
                        </td>
                    	<td width="50%" nowrap>
                        Date : <?=$pamentdatedisplay?>
                        </td>
                    </tr>    
                	<tr>
                    	<td colspan="2" nowrap>
                        Name : <?=$sql[0].' '.$sql[1]?>
                        </td>
                    </tr>    
                	<tr>
                    	<td width="50%" nowrap>
                        <?=$_SESSION['semname']?> : <?=$sql2[0]?>
                        </td>
                    	<td width="50%" nowrap>
                        Admn No : <?=$sql[2]?>
                        </td>
                    </tr>    
                	<tr>
                    	<td width="50%" nowrap>
                        Installment : <?=$installmentId?>
                        </td>
                    	<td width="50%" nowrap>
                        Payment Mode : <?=$modepay?>
                        </td>
                    </tr>    
                </table>
                </td>
            </tr>           
        </table> 
<?php
if($noofcheck)
{        
 ?>                <table align="center" border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
<td align='center' width="40" nowrap>Sl No</td>
<td align='center' nowrap>Bank Name</td>
<td align='center' nowrap>Amount ( <?=$currencydes[0]?> )</td>
<td align='center' nowrap>DD or Cheque No.</td>
<td align='center' nowrap>DD/Cheque Date</td>		
</tr>
		<?php
        for($m1=1;$m1<=$noofcheck;$m1++)
        {
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
			<td align='center' nowrap>$m1</td>
			<td  nowrap>$bankname[0]</td>
			<td align='right' nowrap>$bamt</td>
			<td nowrap>$ddno</td>
			<td nowrap>$checkdate</td>
			</tr>
";            
        }
        ?>
     </table> 
    <?php
	}
	?>    


        <table align="center" border="1" cellpadding="5" cellspacing="0" width="100%">
          <tr>
            <td align="center" width="40" nowrap>Sl No</td>
            <td  align="center">Particulars</td>
            <td  align="center" colspan="2" width="20%">Amount</td>
          </tr>
		<?php
		
		$stiddet=fetchrow(execute("select discount_id from  fee_discount_student where student_id='$stud_id' and status='1' order by acc_year desc limit 1"));
        $i=1;
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
			
				$feeval=fetchrow(execute("select amount from  fee_m_descrption_val where uid='$uid' and fee_head='$r[0]' and inst_id='$installmentId'"));
				if($feeval[0])
				$val=$feeval[0];
				else
				$val=0;
				
				$sumval=$sumval+$val;
				if($val)
				{	
					$feeval1=fetchrow(execute("select discountAmt,curType from  fee_discount_det where admissionType='$adm_id' and disscountType='$stiddet[0]' and feeHead='$r[0]' and status='1' "));
							
							echo "<tr>
								
								<td valign='top' align='center'>$i .</td>
								<td align=''>&nbsp;&nbsp;";
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
									$feeval2=fetchrow(execute("select name from  `fee_discount_head` where  id='$stiddet[0]' and status='1' "));					if($feeval2[0])
									echo "<br>&nbsp;&nbsp;Discount $feeval2[0]&nbsp;&nbsp;";
								}
								echo "</td><td align='right'  nowrap>";
								echo "$val &nbsp;&nbsp;";
								$val7=$val;
								if($val2)
								{
									echo "<br> - $val2 &nbsp;&nbsp;";
									
									$val7=$val7-$val2;
								}
								
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
              <td align='right' nowrap ><?=$fine?>&nbsp;&nbsp;
              </td>
            </tr>
      <?php      
	}
			?>
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

            <tr>
              <td colspan="3" align='right'><strong>Grand Total</strong>&nbsp;&nbsp;</td>
              
              <td align='right' nowrap><?=$currencydes[0]?>&nbsp;<?=$amt?>&nbsp;&nbsp;<?=$currencydes[1]?>
            	</td>
            </tr>   
          <tr>
            <td colspan="4"  align="justify">
            	<br>
                &nbsp;&nbsp;<strong>Remarks :</strong> &nbsp;&nbsp; <?=$remk?>
                <br><br>
                &nbsp;&nbsp;<strong>Amount in words :</strong> 
                <div align="center"><?=number_to_words($amt)?> only</div>
                <br><br>
                <div align="right">Signature&nbsp;&nbsp;</div>
                
                &nbsp;&nbsp; 
            </td>
          </tr>
                  
        </table>  
   <!--Student coppy code ends-->
    </td>
</tr>
</table>

</form>
<div id="prn" align='center'><Input Type="button" Value=" Print " class='bgbutton' onClick="dataprint()">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<Input Type="button" Value=" Send SMS " class='bgbutton' onClick="">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<Input Type="button" Value=" Send Mail " class='bgbutton' onClick="">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name='clse' value=" Close " class='bgbutton' onClick="clswnd()"></div>
<?php
$sql=fetcharray(execute("select id from `fee_m_collect` order by id  DESC limit 1"));
$docid=$sql[0]+1;
$docid="CS/FR/".$docid;




//to check duplicate entry
$validation=execute("select id from `fee_m_collect` where `accYear`='$stud_yr' and `studentId`='$stud_id' and  `admissionCat`='$adm_id' and `installmentId`='$installmentId' and status=1");
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
		
	$sql4="INSERT INTO `fee_m_collect` ( `accYear`, `studentId`, `admissionCat`, `currencyType`, `installmentId`, `amount`,  `totalAmount`, `totalDisAmount`, `discountType`,`fine`, `paymentDate`, `modeOfPament`, `userDetails`, `noOfddCheque`, `remarks`, `receipt`, `status`,`clearedDate`,`amountCleared`) VALUES ('$stud_yr', '$stud_id', '$adm_id', '$currency', '$installmentId', '$amt', '$totalamt', '$totaldiscount', '$studentdiscountid[0]', '$fine', '$pamentdate', '$paymenttype', '$userDetails', '$noofcheck', '{$remk}', '{$docid}', '1','$clearedDate','$amountCleared')";
	execute($sql4);
	
	
	$insertedid=fetchrow(execute("select id,receipt from fee_m_collect where `accYear`='$stud_yr' and `studentId`='$stud_id' and `admissionCat`='$adm_id' and `currencyType`='$currency' and `installmentId`='$installmentId' and status=1"));

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
			$sqlinst="INSERT INTO `fee_m_head_inst_collected` (`uid`, `accYear`, `instId`, `receipt`, `studentId`, `feeHead`, `totalAmount`, `totalConverted`, `currency`, `status`,`totalAmountDet`, `totalDisAmount`, `discountType`) VALUES ('$uid', '$stud_yr', '$installmentId', '$docid', '$stud_id', '$feeType1', '$feeRecValfinal', '$feeRecValfinal', '$currency', '1','$feeRecVal1', '$feeRecValdis1','$studentdiscountid[0]')";
		}
		else
		{
			$sqlinst="INSERT INTO `fee_m_head_inst_collected` (`uid`, `accYear`, `instId`, `receipt`, `studentId`, `feeHead`, `totalAmount`, `totalConverted`, `currency`, `status`,`totalAmountDet`, `totalDisAmount`, `discountType`) VALUES ('$uid', '$stud_yr', '$installmentId', '$docid', '$stud_id', '$feeType1', '$feeRecValfinal', '', '$currency', '1','$feeRecVal1', '$feeRecValdis1','$studentdiscountid[0]')";

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
				execute("INSERT `fee_m_head_total` (`uid`, `accYear`, `studentId`, `feeHead`,  `oneTime`, `totalCollected`, `refund`, `refundAmount`, `cleared`, `status`) VALUES ('$uid', '$stud_yr', '$stud_id', '$feeType1', '$refund[1]', '$feeRecVal1', '$refund[0]', '', '1', '1')");
			}
			else
			{
				execute("INSERT `fee_m_head_total` (`uid`, `accYear`, `studentId`, `feeHead`, `oneTime`, `totalCollected`, `refund`, `refundAmount`, `cleared`, `status`) VALUES ('$uid', '$stud_yr', '$stud_id', '$feeType1',  '$refund[1]', '$feeRecVal1', '$refund[0]', '', '', '1')");		
			}
		}
		
	
	}
	

}
?>
</body>
</html>
