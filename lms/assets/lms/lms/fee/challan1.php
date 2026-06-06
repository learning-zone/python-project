<strong><?php
	session_start();
	include("../db1.php");
	include("numbers-words.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MySchool</title>
<style >
.head1
{
	border-bottom-left-radius:5px;
	border-bottom-right-radius:5px;
	border-top-left-radius:5px;
	border-top-right-radius:5px;

}
body
{

	font-family:"Times New Roman", Times, serif
	font-size:14px;
	//font-weight:bold;
}
</style>
</head>

<body><br><br>
<?php
	$stud_id=$_REQUEST['stud_id'];
	$a_year=$_REQUEST['a_year'];
	$sem=$_REQUEST['sem'];
	$stud_yr=$a_year;
	
	$sql2=execute("select * from  `fee_invoice_settings` where `accyear`='$a_year'");
	while($r=fetcharray($sql2))
	{
		$date1=$r['invoicedate'];
		$date2=$r['duedate'];
		$eur=$r['eur'];
		$usd=$r['usd'];
		$rmk1=$r['remark1'];
		$rmk2=$r['remark2'];
		$rmk3=$r['remark3'];
		
		$d3=explode('-',$date1);
		$adate="$d3[2]/$d3[1]/$d3[0]";
		
		$d4=explode('-',$date2);
		$bdate="$d4[2]/$d4[1]/$d4[0]";
		
	}
	
	$r=fetcharray(execute("select a.id,a.student_id,a.first_name,a.last_name,a.admission_type,a.course_admitted,a.course_yearsem,a.academic_year,a.class_section_id,a.adm_yr from student_m a,fee_apply_fee_student b  where a.archive='N' and b.acc_year='$a_year' and a.id=b.student_id and b.status='1' and b.division='$sem' and a.id='$stud_id'"));

	$admitedyear=$r[adm_yr];

	$slab_id=fetchrow(execute("select slab_id from fee_slab_student where status='1' and  student_id='$r[id]' and acc_year='$a_year'"));
	$chkstud=fetchrow(execute("select uid, currency from fee_m_descrption where status='1' and   adm_cat='$r[admission_type]'  and class='$sem' and accyear='$slab_id[0]' "));
			
	
	//fetching installmentId key

	$fee12=execute("select uid,no_of_instal, currency from  fee_m_descrption where uid='$chkstud[0]'");
	while($r2=fetcharray($fee12))
	{
		$uid=$r2[0];
		$no_of_instal=$r2[1];
		$currency=$r2[2];
	}
	
	if($currency==2)
	$curvalue=$usd;
	if($currency==3)
	$curvalue=$eur;
	
	$instalment=$installid[0]+1;	
	
	
	$date1=date("Y-m-d");
	
	
	//$maxidrec=fetchrow(execute("select invoiceid, invoiceDate from `fee_m_descrption_invoice` where academicYear='$a_year' and studentId='$stud_id' and class='$sem' and no_of_instal='$instalment'"));
	$maxidrec=fetchrow(execute("select invoiceid, invoiceDate from `fee_m_descrption_invoice` where academicYear='$a_year' and studentId='$stud_id' and class='$sem' and no_of_instal='$instalment'"));

	if($maxidrec[0])
	{
		$invoiceid=$maxidrec[0];
		$invoicedate=$maxidrec[1];
	}
	else
	{
		$maxid=fetchrow(execute("select max(invId) from `fee_m_descrption_invoice`"));
		$invId=$maxid[0]+1;
		$invoiceid="INV/$stud_yr"."$stud_id/$invId";
		$invoicedate=date("d-m-Y");
		execute("INSERT INTO `fee_m_descrption_invoice` (`uid`, `academicYear`, `studentId`, `invId`, `class`, `adm_cat`, `no_of_instal`, `invoiceid`, `invoiceDate`, `status`) VALUES ('$uid', '$a_year','$stud_id' ,'$invId' ,'$sem', '$r[admission_type]', '$instalment', '$invoiceid', '$date1', '1')");
	}
	
	$installid=fetchrow(execute("select count(installmentId) from fee_m_collect  where studentId='$r[id]' and accYear=$a_year and status=1"));



	// to get currency code
	//echo "select code from fee_m_currency_code where id='$currency'";
	$currencydes=fetchrow(execute("select code, name, id from fee_m_currency_code where id='$currency'"));
	
	//find the total amount and payment date  
	$sql=execute("select amount, f_due_date, t_due_date from  fee_m_descrption_inst_total where inst_id='$instalment' and uid='$uid' and sts=1 ");
	while($r1=fetcharray($sql))
	{
		$amt=$r1[0];
		$f_due_date=$r1[1];
		$t_due_date=$r1[2];
	}
	$systemdate=date("Y-m-d");


$sql=fetcharray(execute("select first_name,last_name,student_id,course_yearsem,admission_id,class_section_id from student_m where id=$stud_id"));

$sql2=fetcharray(execute("select year_name from course_year where year_id='$sem'"));





$bank=fetchrow(execute("SELECT * FROM `bank_details` LIMIT 1"));
$school=fetchrow(execute("SELECT * FROM `college` LIMIT 1"));
$yer=$stud_yr+1;
?>
<table width="90%" align="center" border="0" cellspacing="0" cellpadding="5">
<tr height="100">
<td>
</td>
</tr>
<tr>
    <th align="center" nowrap="nowrap" bgcolor="#CCCCCC"><font size="+2"><i>Invoice For Academic Year  <?="$stud_yr-$yer"?></i></font></th>
  </tr></table><br>
<table width="90%" align="center" border="0" cellspacing="0" cellpadding="5">
   <tr>
    <td align="right">
    	<table border="0" width="100%" cellspacing="2">
            <tr>
                <td align="right" nowrap><strong>
                Invoice Date : 
                </strong></td>
                <td align="left"  width="10%" nowrap>
                  <strong>
                  <?=$adate?>
                </strong></td>
            </tr>
            <tr>
                <td align="right" nowrap><strong>
                Invoice No. :
                </strong></td>
                <td align="left"  width="10%" nowrap>
                  <strong>
                  <?=$invoiceid?>
                </strong></td>
            </tr>
		</table>
    </td>
  </tr>
  <tr>
    <td>
    	<table border="0" width="100%">
            <tr>
                <td width="5%" valign="top" align="center" nowrap>
                To
                </td>
                <td align="justify"><br>
                <?php
				$stdet=fetcharray(execute("select parent_name, cor_address, cor_city, cor_state, cor_country, cor_pincode,m_name from student_m where id=$stud_id"));				echo "$stdet[0] <br> $stdet[1] , <br>$stdet[2] $stdet[3] $stdet[4]  $stdet[5]";	
				?>
                </td>
                <td width="10%" valign="top" align="center" nowrap>&nbsp;
               
                </td>
            </tr>
		</table>
	</tr>
</table>   
<table width="90%" align="center" class="head1" border="3" cellspacing="0" cellpadding="5">

    
  <tr>
    <td>
    	<table border="0" width="100%">
            <tr>
                <td width="10%" nowrap>
                Admn No 
                </td>
                <td width="70%"> : <?=$sql[admission_id]?>
                </td>
                <td width="10%" nowrap>
                Due Date 
                </td>
                <td width="15%" nowrap="nowrap"> : <?=$bdate?>
                </td>

            </tr>
          <tr>
                <td  nowrap>
                Name
                </td>
                <td> : <?=$sql[0].' '.$sql[1]?>
                </td>
                <td width="25%" nowrap>
                Category
                </td>
				<?php
				$admission_type=fetchrow(execute("SELECT short_name FROM `admission` where id='$r[admission_type]'"));
				?>
                <td nowrap="nowrap"> : <?=$admission_type[0]?>
                </td>

            </tr>    
 
 			<tr>
                <td  nowrap>
                Mother
                </td>
                <td> : <?=$stdet[m_name]?>
                </td>
                <td width="25%" nowrap>
                Currency
                </td>

                <td nowrap="nowrap"> : <?=$currencydes[1]?>
                </td>
            </tr>   
           <tr>
                <td  nowrap>
                <?=$_SESSION['semname']?>
                </td>
                <td> : <?=$sql2[0]?>
                </td>
                <?php
				
                if($currencydes[2]==1)
					echo "<td  nowrap></td><td></td>";
				else
				echo "<td  nowrap>Xchg. Rate</td><td> : $curvalue</td>";
                ?>
          </tr>    
                 
       </table>
     </td>
     </tr>
     </table><br>
     <table width="90%" align="center" class="head1" border="3" cellspacing="0" cellpadding="5">

    <tr>
        <td nowrap="nowrap">
        <table height="250" align="center" background="http://www.ecole.myschoolone.com/renew/images/EcoleWatermark.png" border="0" cellpadding="5" cellspacing="0" width="100%">
                <tr bgcolor="#CCCCCC">
                  
                  <td height='30' valign='top'  ><strong>Fee Head</strong></td>
                  <td height='30' valign='top'  width="10%" align="center" class="head" nowrap><strong>Amount</strong></td>
                </tr>
            <?php
                $i=1;
				$sumval=0;
                // retriving fee details from fee head 
                $sql44= execute("SELECT fee_id,fee_name, ftype FROM fee_type WHERE status=1 ORDER BY fee_id");
                while($r11=fetcharray($sql44))
                {
                        $flag=1;
                        if($r11[2]==1)
                        {
                            $feests=fetchrow(execute("select cleared from `fee_m_head_total` where feeHead='$r11[0]' and studentId='$stud_id' and status=1"));
                            if($feests[0]==1)
                            $flag=0;
    
                        }
						
						$val2=0;
						$val=0;
					   
						$feeval=fetchrow(execute("select amount from  fee_m_descrption_val where uid='$uid' and fee_head='$r11[0]' and inst_id='$instalment'"));
						if($feeval[0])
						$val=$feeval[0];
						else
						$val=0;
                            
						if(!$flag)
						{
							$amt=$amt-$feeval[0];
						}
						else
							$amt=$amt+$feeval[0];
							
							
						$stiddet=fetchrow(execute("select discount_id from  fee_discount_student where student_id='$r[id]' and status='1' and acc_year='$a_year'"));
					
					
					$feeval1=fetchrow(execute("select discountAmt, curType from  fee_discount_det where admissionType='$r[admission_type]' and disscountType='$stiddet[0]' and feeHead='$r11[0]' and status='1' "));
					
						
						if($feeval1[1]==1)
						{
							$val2=round(($val*$feeval1[0]/100),2);
						}
						if($feeval1[1]==2)
						{
							$val2=round($feeval1[0],2);
						}
						$val=$val-$val2;
					
						
						if($val>0)
						{
							
							echo "<tr>
								
								<td valign='top' >&nbsp;&nbsp;$r11[1] </td>
								<td align='right'' valign='top'   nowrap> ".$currencydes[0]." $val&nbsp;&nbsp;</td>
							</tr>";
							$i++;
							$sumval=$sumval+$val;
						}
                        
                    }
    
            
        if(!$fine)
        $fine=0;		
        if($t_due_date<$systemdate)
        {
                ?>
                
          <?php      
        }
		if($currency==1)
		{
           ?>     
                <tr height="30" bgcolor="#CCCCCC">
                  <td colspan="" align='right'><strong><strong>Total</strong></strong>&nbsp;&nbsp;</td>
                  <td align='right' nowrap><?=$currencydes[0]?> <?=$sumval?>&nbsp;&nbsp;</td>
                </tr>
           <?php
		}
		if($currency!=1)
		{
			 $totalval=$curvalue*$sumval;
		    ?>
            <tr height="30" >
                  <td colspan="" align='right'>Total&nbsp;&nbsp;</td>
                  <td align='right' nowrap><?=$currencydes[0]?> <?=$sumval?>&nbsp;&nbsp;</td>
                </tr>
               <tr height="30">
                  <td colspan="" align='right'><?=$currencydes[0]?> <?=$sumval?> IS CONVERTED TO Rs(INR)</td>
                  <td align='right' nowrap><b>&#x20B9;</b> <?=$totalval?>&nbsp;&nbsp;</td>
                </tr><tr height="30" bgcolor="#CCCCCC">
                  <td colspan="" align='right'><strong><strong>Total</strong></strong>&nbsp;&nbsp;</td>
                  <td align='right' nowrap><b>&#x20B9;</b> <?=$totalval?>&nbsp;&nbsp;</td>
                </tr>
	
		  <?php 
		  $sumval=$totalval;
		   }
		   ?>     
                
            </table>
  </tr>
  </table>
 <br>
 <table width="90%" align="center" border="0" cellspacing="0" cellpadding="5">

 <tr>
    <td height="40" align="justify" colspan="3">Amount (In Words) : Rs (INR)  <?=ucwords(number_to_words($sumval))?> only </td>
  </tr>
  <tr>
  <td align="justify" nowrap="nowrap" colspan="3">
  <p style="height:15"><?=$rmk1?></p>
    <p  style="height:15"><?=$rmk2?></p>
    <p  style="height:15"><?=$rmk3?></p></strong>
    </td>
  </tr>
  <tr>
      <td>
      </td>
      <td>
      </td>
      <td><br>
      </td>
  </tr>
    <tr height="2">
      <td width="25%"><hr>
      </td>
      <td width="50%">
      </td>
      <td width="25%"><hr />
      </td>
  </tr>
    <tr>
      <td align="center">Admission office 
      </td>
      <td>
      </td>
      <td  align="center">Prepared By
      </td>
  </tr>
</table>
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
</html>