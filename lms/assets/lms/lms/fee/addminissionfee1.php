<html>
<head>
<title>Fee Receipt</title>
<?php
session_start();
include("../db1.php");
include("numbers-words.php");
//number_to_words($ttlamt)
	$userDetails=$_SESSION['user']." ".date('d-m-Y H:i:s');
	$stud_id=$_POST['stud_id'];	//student row id
	
	$noofcheck=$_POST['noofcheck'];

	$currencydes=fetchrow(execute("select code, name from fee_m_currency_code where id='1'"));

	
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

if($paymenttype==2)
{
	$disname1='DD';
}
elseif($paymenttype==3)
{
	$disname1='Cheque';
}
elseif($paymenttype==4)
{
	$disname1='Tele Transfer';
}
elseif($paymenttype==5)
{
	$disname1='TID';
}
//aplicaiotn pack id
$aplicaiotnpack=fetchrow(execute("SELECT `app_no` FROM `student_m_adminpack` where `reg_code`='$stud_id'"));

$sql=fetcharray(execute("SELECT count(*) FROM `fee_m_collect_admission` where `paymentDate` between '2013-04-01' and '2014-03-31'"));
$docid=$sql[0]+1;
$docid="EM/AF/2013/".$docid;

//to check duplicate entry
$validation=execute("select receipt from `fee_m_collect_admission` where  `studentId`='$stud_id' and status=1");
if(rowcount($validation))
{
	$sql=fetcharray($validation);
	$docid=$sql[0];
}
else
{
	$sql4="INSERT INTO `fee_m_collect_admission` (`studentId`, `currencyType`,  `amount`,  `paymentDate`, `modeOfPament`, `userDetails`, `noOfddCheque`, `remarks`, `receipt`, `status`,`clearedDate`,`amountCleared`) VALUES ('$stud_id', '$currency',  '$amt',  '$pamentdate', '$paymenttype', '$userDetails', '$noofcheck', '{$remk}', '{$docid}', '1','$clearedDate','$amountCleared')";
	
	execute($sql4);
	
	$insertedid=fetchrow(execute("select id,receipt from fee_m_collect_admission where  `studentId`='$stud_id' and status=1"));

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

$sql=fetcharray(execute("select first_name,last_name,student_id,course_yearsem,admission_id, per_address, per_city, per_state, per_country, per_pincode, academic_year from student_m_online where id=$stud_id"));
$sql2=fetcharray(execute("select year_name from course_year where year_id='$sql[course_yearsem]'"));
$a_year=$sql['academic_year'];
$yer=$a_year+1;

if($paymenttype==1)
	$modepay="Cash";
elseif($paymenttype==2)
	$modepay="Demand Draft";
elseif($paymenttype==3)
	$modepay="Bank Cheque";
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
                        <th align="center" colspan="4" nowrap="nowrap" bgcolor="#CCCCCC"><font size="+1"><i>Registration  Receipt for Academic Session
<?=$a_year."-".$yer?></i></font></th>
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
                        Receipt Date : 
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
		<tr height="30">
        <td colspan='3'>BROUCHURE  AND APPLICATION PROCESSING FEES </td>
        <td align='right' ><?=$amt?></td></tr>
<tr><td  colspan='3'></td><td align='right' ></td></tr>
</table></div>
<table class="body"  align="center" border="0" cellpadding="2" cellspacing="0" width="90%">

<?php
if($noofcheck)
{        
echo "<tr height='150'><td colspan=4><table class='body'  align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>";
	for($m1=1;$m1<=$noofcheck;$m1++)
	{
		echo "<tr height='4'><td colspan=4><hr></td></tr>";
		$bname=$_POST['bname'.$m1];
		$bamt=$_POST['bamt'.$m1];
		$ddno=$_POST['ddno'.$m1];
		$pdt=$_POST['pdt'.$m1];
		$pmt=$_POST['pmt'.$m1];
		$pyr=$_POST['$pyr'.$m1];
		$bankname=fetchrow(execute("select bank_name from bank_details where id=$bname "));
	
		$amtt=explode('.',$bamt);
		if(sizeof($amtt)<2)
		$bamt=$bamt.'.00';

		$pyr=$_POST['pyr'.$m1];
		
		$checkdate="$pdt-$pmt-$pyr";
		echo "<tr>
		<td width='5%'  nowrap>
		$disname1 No</td>
		<td nowrap> : $ddno</td>
		<td width='5%' align='right' nowrap>Amt &nbsp;&nbsp;: </td>
		<td align='right'  width='5%' nowrap>$currencydes[0] &nbsp;&nbsp;&nbsp;$bamt</td>
		</tr>
		<tr>
		<td width='' nowrap>Bank Name</td>
		<td  nowrap> : $bankname[0]</td>
		<td width='right'  nowrap>$disname1 Date : </td>		
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
            <tr height="40">
              <td  colspan="4" nowrap>
              Pay Mode : <?=$modepay?><br><br><hr>
            	</td>
            </tr>          
            <tr height="40">
              <td  align=''>In Words : &nbsp;&nbsp;&nbsp;</td>
             
              <td align='' colspan="3" ><?=$currencydes[1]?>&nbsp;<?=ucwords(number_to_words($amt))?> only&nbsp;&nbsp;<br><br>
            	</td>
            </tr>          
           <tr>  
            <td colspan="4"  align="justify" >REMARKS : APPLICATION PACK NO : <?=$aplicaiotnpack[0]?> FOR THE ACADEMIC YEAR <?=$a_year."-".$yer?>  
			<br>&nbsp;&nbsp;&nbsp;<?=$remk?>
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

?>
</body>
</html>
