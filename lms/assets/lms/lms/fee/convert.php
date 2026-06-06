<html>
<head>
<title>Reconciliation</title>
<?php
session_start();
include("../db.php");

include("numbers-words.php");
//number_to_words($ttlamt)
	$recordid=$_REQUEST['recordid'];
	$course=$_REQUEST['course'];	//branch name
	$sem=$_REQUEST['sem'];		//semister
		
	$adate=date("d/m/Y");
	//$adate='21/12/2012';
$sql=execute("select * from fee_m_collect where id='$recordid'");
while($r=fetcharray($sql))
{
	$rowid=$r['id']; //row id
	$stud_yr=$r['accYear'];		//accadamic year
	$stud_id=$r['studentId'];		//student row id
	$uid=$r['uid'];
	$adm_id=$r['admissionCat'];	//admision ID
	$currency=$r['currencyType'];		//currency type
	$installmentId=$r['installmentId'];		//installmentId 
	$amt=$r['amount'];  	//total paid
	$totalAmount=$r['totalAmount'];  	//total amount before discount
	$totalDisAmount=$r['totalDisAmount'];  	// total discount amount
	$discountType=$r['discountType'];  	// discount type id
	$fine=$r['fine'];		//fine
	$pamentdate=$r['paymentDate'];		//Payment Date	
	$paymenttype=$r['modeOfPament'];		//Mode of Payment
	$userDetails=$r['userDetails'];  //user details
	$noOfddCheque=$r['noOfddCheque']; //number of check
	
//	$bname=$r['bankName'];		//Bank Name
//	$bdet=$r['bankDetails'];		//Branch Details
//	$ddno=$r['ddChequeNo'];		//DD or Cheque No.
	$clearedDate=$r['clearedDate']; // check cleared date
	$chequeDate=$r['ddChequeDate'];		//DD/Cheque Date
	$remk=$r['remarks'];		//remarks
	$docid=$r['receipt'];
	$amountCleared=$r['amountCleared'];
}
	
	$c1=explode('-',$chequeDate);
	$p1=explode('-',$pamentdate);
	$oexeamt=$_POST['oexeamt'];		//old exxcess payment
	$oldbalamt=$_POST['oldbalamt'];		// old balance payment 

	$chequeDatedis="$c1[2]-$c1[1]-$c1[0]";		//DD/Cheque Date
	$pamentdatedisplay="$p1[2]-$p1[1]-$p1[0]";		//Payment Date display
	
	$uiddet=fetchrow(execute("select uid from `fee_m_descrption` where accyear='$stud_yr' and class='$sem' and adm_cat='$adm_id' "));

	$uid=$uiddet[0];
	
	$currencydes=fetchrow(execute("select code from fee_m_currency_code where id='$currency'"));
	$currencydes1=fetchrow(execute("select code from fee_m_currency_code where id='1'"));

$nativecode=fetcharray(execute("select code,description from fee_m_currency_code where id='1'"));


$validation=execute("select id from `fee_m_collect` where `accYear`='$stud_yr' and `studentId`='$stud_id' and  `admissionCat`='$adm_id' and `installmentId`='$installmentId'");


if($_POST['update'])
{

	
	$d2=3;
	$sqlnewid=execute("SELECT id, amount FROM `fee_m_cheque_det` where receiptId='$rowid'");
	while($m1=fetcharray($sqlnewid))
	{
		if($_POST['date'.$d2])
		{
			$amt=$m1[1];
			$date1=$_POST['date'.$d2];
			$a=explode('/',$date1);
			$clearedDate="$a[2]-$a[1]-$a[0]";
			unset($a);
			if($currency==1)
			{
				$amountCleared=$amt;
			}
			else
			{
				$row=fetcharray(execute("select conversion_rate,	bankCharges from fee_m_conversion_rate where c_date='$clearedDate' and currency='$currency'"));
				$currenrate=$amt*$row[0];
				$bancharge=$currenrate*$row[1];
				$amountCleared=$currenrate-$bancharge;
				$amountCleared=round($amountCleared,2);
		
			}
			execute("update `fee_m_cheque_det` set clearedDate='$clearedDate', cleared='$amountCleared' where id ='$m1[0]'");
		}
	}

	$mamonunt=fetchrow(execute("select amount from `fee_m_collect` where id='$recordid'"));
	$amt=$mamonunt[0];
	if($currency==1)
	{
		$amountCleared=$amt;
	}
	else
	{
		$row=fetcharray(execute("select conversion_rate,	bankCharges from fee_m_conversion_rate where c_date='$clearedDate' and currency='$currency'"));
	
		$currenrate=$amt*$row[0];
		$bancharge=$currenrate*$row[1];
		$amountCleared=$currenrate-$bancharge;
		$amountCleared=round($amountCleared,2);

	}
	execute("update `fee_m_collect` set clearedDate='$clearedDate' , amountCleared='$amountCleared' where id='$recordid'");
	
	
	$sqlnewid=execute("SELECT id, totalAmount FROM `fee_m_head_inst_collected`  where uid='$uid' and accYear='$stud_yr' and instId='$installmentId' and studentId='$stud_id' ");
	while($m1=fetcharray($sqlnewid))
	{
		if($_POST['date'.$d2])
		{
			$amt=$m1[1];
			$date1=$_POST['date'.$d2];
			$a=explode('/',$date1);
			$clearedDate="$a[2]-$a[1]-$a[0]";
			unset($a);
			if($currency==1)
			{
				$amountCleared=$amt;
			}
			else
			{
				$row=fetcharray(execute("select conversion_rate,	bankCharges from fee_m_conversion_rate where c_date='$clearedDate' and currency='$currency'"));
				$currenrate=$amt*$row[0];
				$bancharge=$currenrate*$row[1];
				$amountCleared=$currenrate-$bancharge;
				$amountCleared=round($amountCleared,2);
		
			}
			execute("update `fee_m_head_inst_collected` set totalConverted='$amountCleared' where id ='$m1[0]'");
		}
	}
	?>
    <script language="javascript">
		window.opener.location.reload();
		alert("Updated successfully ");
    </script>
    <?php	

}
?>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>

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
<body >
<form name="frm" method='post'>

<input type='hidden' name='course' value='<?=$course?>'>
<input type='hidden' name='sem' value='<?=$sem?>'>
<input type='hidden' name='recordid' value='<?=$recordid?>'>



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
elseif($paymenttype==4)
	$modepay="Tele Transfer";


$userid=fetcharray(execute("select id from users where username='$user'"));

?>

    <!--office coppy code starts-->
		<table align="center" width="80%" cellpadding="0" cellspacing="0" border="1" >
            <tr>
            	<td colspan="2">
                    <table border="0" width="100%">
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
 if($noOfddCheque)
 {       
?>                <table align="center" border="1" cellpadding="5" cellspacing="0" width="80%">
<tr>
<td align='center' width="40" nowrap>Sl No</td>
<td align='center' nowrap>Bank Name</td>
<td align='center' nowrap>Amount ( <?=$currencydes[0]?> )</td>
<td align='center' nowrap>DD or Cheque No.</td>
<td align='center' nowrap>DD/Cheque Date</td>		
<td align='center' nowrap>Reconciliation Date</td>	
<td align='center' nowrap>Cleared Amount ( <?=$currencydes1[0]?> )</td>  	
</tr>
		<?php
		$m2=1;
		$d2=3;
		$totalcolected=0;
		$totalconverted=0;
		$sqlnewid=execute("SELECT * FROM `fee_m_cheque_det` where receiptId='$rowid'");
        while($m1=fetcharray($sqlnewid))
		{
            $bname=$m1['bankName'];
            $bamt=$m1['amount'];
            $ddno=$m1['ddChequeNo'];
            $pychdate=$m1['ddChequeDate'];
			$cleared=$m1['cleared'];
            $totalcolected=$totalcolected+$bamt;
			$totalconverted=$totalconverted+$cleared;

			
			$ch1=explode('-',$pychdate);
			$bankname=fetchrow(execute("select bank_name from bank_details where id=$bname "));
		
            			
            $checkdate="$ch1[2]-$ch1[1]-$ch1[0]";
			echo "<tr>
			<td align='center' nowrap>$m2</td>
			<td  nowrap>$bankname[0]</td>
			<td align='right' nowrap>$bamt</td>
			<td nowrap>$ddno</td>
			<td nowrap>$checkdate";
			$d1=explode('-',$m1['clearedDate']);
			if($d1[2]!='0000')
			$clrdate="$d1[2]/$d1[1]/$d1[0]";
			else
			$clrdate='';
			echo "</td><td nowrap>";
			?>
			<input type='text' name='date<?=$d2?>' value='<?=$clrdate?>' size="10"   >
                        <a href="javascript:showCal('Calendar<?=$d2?>')"><img src='../images/calendar.jpg' align='absmiddle' ></a>
			<?php
			echo "</td><td align='right' nowrap>
			$cleared</td></tr>";
			$m2++;
			$d2++;
					

        }
        ?>
<tr>
<td align='right'   colspan="2" nowrap>Total Amount </td>
<td align='right' nowrap><?=$currencydes[0]." $totalcolected"?></td>
<td align='right' colspan="3" nowrap>Total Cleared </td>
<td align='right'  nowrap><?=$currencydes[1]." $totalconverted"?></td>
</tr>

     </table> 
    <?php
	}
	?>           
<!--       <table align="center" border="1" cellpadding="0" cellspacing="0" width="80%">
          <tr>
            <td align="center" width="10%">Sl No</td>
            <td  align="center">Particulars</td>
            <td  align="center" width="20%">Amount</td>
          </tr>
		<?php
        $i=1;
        $sql44= execute("SELECT fee_id,fee_name FROM fee_type WHERE status=1 ORDER BY fee_id");
        while($r=fetcharray($sql44))
        {
			$feeval=fetchrow(execute("select amount from  fee_m_descrption_val where uid='$uid' and fee_head='$r[0]' and inst_id='$installmentId'"));
			if($feeval[0])
			$val=$feeval[0];
			else
			$val=0;
			
			$sumval=$sumval+$val;
			
			echo "<tr>
			<td align='center' width='10%'>$i</td>
			<td  align='left'>&nbsp;&nbsp;$r[1]</td>
			<td  align='right'>$val $currencydes[0]&nbsp;&nbsp;</td>
			</tr>";
			$i++;
        }
		if($fine)
		{
		?> 
          <tr>
            <td colspan="2"  align="right">Fine Amount&nbsp;&nbsp;</td>
            <td  align="right"><?=round($fine,2).' '.$currencydes[0]?>&nbsp;&nbsp;</td>
          </tr>
          <?php
		}
		?> 
          <tr>
            <td colspan="2"  align="right"><strong>Total&nbsp;&nbsp;</strong></td>
            <td  align="right"><?=$amt.' '.$currencydes[0]?>&nbsp;&nbsp;</td>
          </tr>
          <?php
          if($amountCleared)
          {
			?>
          <tr>
            <td colspan="2"  align="right"><strong><?=$nativecode[1]?>&nbsp;&nbsp;</strong></td>
            <td  align="right"><?=round($amountCleared,2).' '.$nativecode[0]?>&nbsp;&nbsp;</td>
          </tr>
          
		  	<?php
		  }
		  ?>
          <tr>
            <td colspan="3"  align="justify">
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
  
<br>
<div id="prn" align='center'><Input Type="submit" Value=" Update " class='bgbutton' name="update"></div>
</form>
</body>
</html>
