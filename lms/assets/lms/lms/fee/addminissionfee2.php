<html>
<head>
<title>Fee Receipt</title>
<?php
	session_start();
	include("../db1.php");
	include("numbers-words.php");
	//number_to_words($ttlamt)
	$userDetails=$_SESSION['user']." ".date('d-m-Y H:i:s');
	$stud_id=$_REQUEST['stud_id'];	//student row id

	$currencydes=fetchrow(execute("select code, name from fee_m_currency_code where id='1'"));
	
	$sql=execute("SELECT * FROM `fee_m_collect_admission` where studentId='$stud_id' and status=1 ");
	while($r=fetcharray($sql))
	{	
		$noofcheck=$r['noOfddCheque'];
		$docid=$r['receipt'];
	
	
		$pd=explode('-',$r['paymentDate']);		//Payment Date
		$pamentdatedisplay="$pd[2]-$pd[1]-$pd[0]";		//Payment Date display
			
		$paymenttype=$r['modeOfPament'];		//Mode of Payment
		
		
		$totalamt=$r['amount'];  //total amout collecte without dis
		$amt=$r['amount'];  	//total paid  after discount 
		
		$totaldiscount=$r['totaldiscount']; // total discount 
		
		$remk=$r['remarks'];		//remarks
	}


//aplicaiotn pack id
$aplicaiotnpack=fetchrow(execute("SELECT `app_no` FROM `student_m_adminpack` where `reg_code`='$stud_id'"));


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


$nsql=execute("SELECT * FROM `fee_m_cheque_det` where `receiptDet`='$docid'");
	while($m1=fetcharray($nsql))
	{
		echo "<tr height='4'><td colspan=4><hr></td></tr>";
		
		$bname=$m1['bankName'];
		$bamt=$m1['amount'];
		$ddno=$m1['ddChequeNo'];
		$m2=explode('-',$m1['ddChequeDate']);
		$pdt=$m2[2];
		$pmt=$m2[1];
		$pyr=$m2[0];
		$bankname=fetchrow(execute("select bank_name from bank_details where id=$bname "));
	
		
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
