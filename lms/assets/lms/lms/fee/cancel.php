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
	$stud_yr=$r['accYear'];		//accadamic year

	$adm_id=$r['admissionCat'];	//admision ID
	$stud_id=$r['studentId'];		//student row id
	$currency=$r['currencyType'];		//currency type
	$installmentId=$r['installmentId'];		//installmentId 
	$fine=$r['fine'];		//fine
	$amt=$r['amount'];  	//total paid
	$remk=$r['remarks'];		//remarks
	$paymenttype=$r['modeOfPament'];		//Mode of Payment
	$bname=$r['bankName'];		//Bank Name
	$bdet=$r['bankDetails'];		//Branch Details
	$ddno=$r['ddChequeNo'];		//DD or Cheque No.
	$chequeDate=$r['ddChequeDate'];		//DD/Cheque Date
	$pamentdate=$r['paymentDate'];		//Payment Date	
	$docid=$r['receipt'];
	$amountCleared=$r['amountCleared'];
}

	$c2=explode('-',$pamentdate);
	$pamentdatedisplay="$c2[2]-$c2[1]-$c2[0]";
	
	
	$c1=explode('/',$adate);
	
	$oexeamt=$_POST['oexeamt'];		//old exxcess payment
	$oldbalamt=$_POST['oldbalamt'];		// old balance payment 

	$canceldate="$c1[2]-$c1[1]-$c1[0]";		//DD/Cheque Date
			//Payment Date display
	
	$uiddet=fetchrow(execute("select uid from `fee_m_descrption` where accyear='$stud_yr' and class='$sem' and adm_cat='$adm_id' "));

	$uid=$uiddet[0];
	
	$currencydes=fetchrow(execute("select code ,name from fee_m_currency_code where id='$currency'"));

$nativecode=fetchrow(execute("select code,description from fee_m_currency_code where id='1'"));


$validation=execute("select id from `fee_m_collect` where `accYear`='$stud_yr' and `studentId`='$stud_id' and  `admissionCat`='$adm_id' and `installmentId`='$installmentId'");


if($_POST['update'])
{
	$cancelationdet=$_POST['cancelationdet'];
	//updates fee collection status 0
	execute("update `fee_m_collect` set remarks_cancel='$cancelationdet' , status='0',date_cancel='$canceldate' where id='$recordid'");
	
	$val1=fetchrow(execute("select accYear, installmentId, studentId from `fee_m_collect` where id='$recordid' "));
	//updates  fee installment status 0
	
	execute("update `fee_m_head_inst_collected` set status='0' where accYear='$val1[0]' and instId='$val1[1]' and studentId='$val1[2]'");
	//fetchig date and makin 
	
	$nsql=execute("select feeHead, totalAmount, id from `fee_m_head_inst_collected` where accYear='$val1[0]' and instId='$val1[1]' and studentId='$val1[2]'");
	while($r=fetcharray($nsql))
	{
		$vartot=$r[1];
		$totc=fetchrow(execute("select totalCollected from  `fee_m_head_total` where accYear='$val1[0]' and studentId='$val1[2]' and feeHead='$r[0]'"));
		if($totc[0] and $vartot)
		{
			$famt=$totc[0]-$vartot;
			execute("update `fee_m_head_total` set totalCollected='$famt' , cleared=0 where accYear='$val1[0]' and studentId='$val1[2]' and feeHead='$r[0]'");
		}
	}
	
	// Reducing student count from master 
	execute("update fee_m_descrption set `no_of_student`=(`no_of_student`-1) where uid='$uid'");

	// Reducing student count from instalment collected  
	execute("update `fee_m_descrption_inst_total` set `no_of_student`=(`no_of_student`-1) where uid='$uid' and inst_id='$installmentId''");

	
	?>
    <script language="javascript">
		window.opener.location.reload();
		alert("Fee Receipt Cancelled ");
    	window.close();
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
$sql2=fetcharray(execute("select year_name from course_year where year_id='$sem'"));
if($paymenttype==1)
	$modepay="Cash";
elseif($paymenttype==2)
	$modepay="Demand Draft";
elseif($paymenttype==3)
	$modepay="Bank Cheque";

$userid=fetcharray(execute("select id from users where username='$user'"));

?>

    <!--office coppy code starts-->
		<table align="center" width="80%" cellpadding="5" cellspacing="5" border="1" >

            <tr>
            	<td colspan="2">
                    <table border="0" cellpadding="5" cellspacing="5" width="100%">
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
                        Cancelation Date : 
                          <input type='text' name='adate' value='<?=$adate?>' size="10"  readonly >
                        <a href="javascript:showCal('Calendar1')"><img src='../images/calendar.jpg' align='absmiddle' ></a>
                        </td>
                    	<td width="50%" nowrap>
                        Payment Mode : <?=$modepay?>
                        </td>
                    </tr>
                </table>
                </td>
            </tr>           
        </table> 
       <table height="200" align="center" border="1" cellpadding="0" cellspacing="0" width="80%">
          <tr height="30">
            <td valign='top' align="center" width="10%" nowrap>Sl No</td>
            <td  align="center" nowrap>Particulars</td>
            <td  align="center" width="20%" nowrap>Amount</td>
          </tr>
		<?php
        $i=1;
        $sql44= execute("SELECT fee_id,fee_name FROM fee_type WHERE status=1 ORDER BY fee_id");
        while($r=fetcharray($sql44))
        {
			$feeval=fetchrow(execute("SELECT totalAmount FROM `fee_m_head_inst_collected` where receipt='$docid' and feeHead='$r[0]' and  status=1"));
			if($feeval[0]>0)
			{
				$val=$feeval[0];
			
			
				$sumval=$sumval+$val;
				
				echo "<tr>
				<td valign='top' align='center' width='10%'>$i</td>
				<td valign='top' align='left'>&nbsp;&nbsp;$r[1]</td>
				<td valign='top' align='right'>$val $currencydes[0]&nbsp;&nbsp;</td>
				</tr>";
				$i++;
			}
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
                &nbsp;&nbsp;<strong> (In Words) </strong> 
                <div align="center"> <?=$currencydes[1]?>&nbsp;<?=ucwords(number_to_words($amt))?> only&nbsp;&nbsp;</div>
                <br><br>
                <div align="right">Signature&nbsp;&nbsp;</div>
                
                &nbsp;&nbsp; 
            </td>
          </tr>
          <tr>
            <td colspan="3"  align="center">
            <strong> Reason for cancelation  </strong><BR>            <textarea name="cancelationdet" cols="60" rows="4" ></textarea>
            </td>
          </tr>
                  
        </table>  
   <!--office coppy code ends-->
  
<br>
<div id="prn" align='center'><Input Type="submit" Value=" Update " class='bgbutton' name="update"></div>
</form>
</body>
</html>
