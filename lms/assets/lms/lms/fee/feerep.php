<html>
<head>
<title>Fee Receipt</title>
<?php
session_start();
include("../db1.php");

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

	$a_year=$r['accYear'];		//accadamic year
	$totalAmount=$r['totalAmount'];	
	$totalDisAmount=$r['totalDisAmount'];
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
	$noofcheck=$r['noOfddCheque'];
	$rowid=$r['id'];
}
	
	$c1=explode('-',$chequeDate);
	$p1=explode('-',$pamentdate);
	$oexeamt=$_POST['oexeamt'];		//old exxcess payment
	$oldbalamt=$_POST['oldbalamt'];		// old balance payment 

	$chequeDatedis="$c1[2]-$c1[1]-$c1[0]";		//DD/Cheque Date
	$pamentdatedisplay="$p1[2]-$p1[1]-$p1[0]";		//Payment Date display
	
	$uiddet=fetchrow(execute("select uid from `fee_m_descrption` where accyear='$stud_yr' and class='$sem' and adm_cat='$adm_id' "));

	$uid=$uiddet[0];
	
	$currencydes=fetchrow(execute("select code,name from fee_m_currency_code where id='$currency'"));

$nativecode=fetcharray(execute("select code,description from fee_m_currency_code where id='1'"));


$validation=execute("select id from `fee_m_collect` where `accYear`='$stud_yr' and `studentId`='$stud_id' and  `admissionCat`='$adm_id' and `installmentId`='$installmentId'");


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

	
?>
		<table class="body"   align="center" width="90%" cellpadding="0" cellspacing="0" border="0" >
		
            <tr>
            	<td colspan="2">
                    <table class="body"  border="0" width="100%" cellpadding="2" cellspacing="0">
                    <tr height="150">
                        <td align="right" colspan="2">
                        
                        </td>
                    </tr><?php
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
		
			$feeval=fetchrow(execute("SELECT `totalAmount`  FROM `fee_m_head_inst_collected` where `receipt`='$docid' and `feeHead`='$r[0]' and `status`=1"));
			if($feeval[0])
			$val=$feeval[0];
			else
			$val=0;
			
			$sumval=$sumval+$val;
			if($val and $val!='0.00' and $val!=0)
			{	
				
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
		
?>
<tr><td colspan="4"></td></tr>
</table></div>
<table class="body"  align="center" border="0" cellpadding="2" cellspacing="0" width="90%">

<?php
if($noofcheck)
{        
echo "<tr height='150'><td colspan=4><table class='body'  align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>";
	
	$sql7=execute("SELECT `bankName`, `amount`,`ddChequeNo`,`ddChequeDate` FROM `fee_m_cheque_det` where `receiptDet`='$docid' and `status`=1");
	while($m1=fetcharray($sql7))
	{
		echo "<tr height='4'><td colspan=4><hr></td></tr>";
		$bname=$m1[0];
		$bamt=$m1[1];
		$ddno=$m1[2];
		$pd=explode('-',$m1[3]);
		
		$bankname=fetchrow(execute("select bank_name from bank_details where id=$bname "));
	
		$amtt=explode('.',$bamt);
		if(sizeof($amtt)<2)
		$bamt=$bamt.'.00';

		$checkdate="$pd[2]-$pd[1]-$pd[0]";
		echo "<tr>
		<td width='5%'  nowrap>
		$modepay No</td>
		<td nowrap> : $ddno</td>
		<td width='5%' align='right' nowrap>Amt &nbsp;&nbsp;: </td>
		<td align='right'  width='5%' nowrap>$currencydes[0]&nbsp;&nbsp;&nbsp; $bamt</td>
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
 <!--           <tr>
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
            <tr>
              <td colspan="3" align='' bgcolor="#CCCCCC">Total Amount : </td>
              
              <td align='right' bgcolor="#CCCCCC" nowrap><?=$currencydes[0]?>&nbsp;&nbsp;&nbsp;<?=$amt?>&nbsp;&nbsp;
            	</td>
            </tr>          
            <tr>
              <td  align=''>(In Words) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp:</td>
              
              <td align='' colspan="3" ><?=$currencydes[1]?>&nbsp;<?=ucwords(number_to_words($amt))?> only&nbsp;&nbsp;
            	</td>
            </tr>          
          <tr>
            <td colspan="4"  align="justify" >
                <br><strong>Subject To Realization of the Cheque</strong>   
            </td>
          </tr>
          <tr>  
            <td colspan="4"  align="justify" >  
			Fee receipt is subjected to the realization of cheque(s)<br>
			&nbsp;&nbsp;&nbsp;&nbsp; <?=$remk?>
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
		
			
			echo "<br><br>";
			
			?>
            
            
            
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
        
  
<br><br>
<div id="prn" align='center'><Input Type="button" Value=" Print " class='bgbutton' name="update" onClick="dataprint()"></div>
</form>
</body>
</html>
