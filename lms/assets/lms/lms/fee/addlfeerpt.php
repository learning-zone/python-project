<?php
session_start();
include("../db.php");
if($_POST)
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];  
	$intl=$_POST['intl'];
	$a_year=$_POST['a_year'];
}
else
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}

if(isset($_POST['studdet1']))
{

	$course=$branch;
	$sid=$_POST['sid'];
	for($mk=0;$mk<sizeof($sid);$mk++)
	{
		$recordid=$sid[$mk];
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
			
			$c1=explode('-',$chequeDate);
			$p1=explode('-',$pamentdate);
			$oexeamt=$_POST['oexeamt'];		//old exxcess payment
			$oldbalamt=$_POST['oldbalamt'];		// old balance payment 
		
			$chequeDatedis="$c1[2]-$c1[1]-$c1[0]";		//DD/Cheque Date
			$pamentdatedisplay="$p1[2]-$p1[1]-$p1[0]";		//Payment Date display
			
			$uiddet=fetchrow(execute("select uid from `fee_m_descrption` where accyear='$stud_yr' and class='$sem' and adm_cat='$adm_id' "));
		
			$uid=$uiddet[0];
			
			$currencydes=fetchrow(execute("select code from fee_m_currency_code where id='$currency'"));
		
		$nativecode=fetcharray(execute("select code,description from fee_m_currency_code where id='1'"));
		
		
		$validation=execute("select id from `fee_m_collect` where `accYear`='$stud_yr' and `studentId`='$stud_id' and  `admissionCat`='$adm_id' and `installmentId`='$installmentId'");

$feerecid=fetcharray(execute("select conversion_rate,	bankCharges from fee_m_conversion_rate where c_date='$clearedDate' and currency='$currency'"));
	
		$adate=$_POST['adate'];
		$a=explode('/',$adate);
		$clearedDate="$a[2]-$a[1]-$a[0]";
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
	}
		$sqlnewid=execute("SELECT id, totalAmount FROM `fee_m_head_inst_collected`  where uid='$uid' and accYear='$stud_yr' and instId='$installmentId' and studentId='$stud_id' ");
	while($m1=fetcharray($sqlnewid))
	{
		if($_POST['date'.$d2])
		{
			$amt=$m1[1];
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
		alert("Updated successfully ");
    </script>
    <?php	

}






?>

<html>
<head>
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>

<script LANGUAGE="JavaScript">

function frm_reload()
{
	document.frm.action='addlfeerpt.php';
	document.frm.submit();
} 
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=700,width=1000,status=no,toolbar=no,scrollbars=yes,menubar=no,location=no');
}

</script>
</head>
<body>
<form method='post' name="frm" >
<table class='forumline' align='center' width='90%'><tr><td Class="Head" colspan='5' align='center'> Reconciliation </td></tr>
<tr>
<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
	<td>
		<select name="branch" onchange='frm_reload()'>
		<option value="0">---- Select ----</option>
			<?php
				$sql="select course_id,coursename from course_m order by head_id,coursename";
				$rs=execute($sql);
				for($i=0;$i<rowcount($rs);$i++)
				{
				  $r=fetcharray($rs);

					if($branch==$r[course_id])
					{
						?>
						<option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>
						<?php
					}
					else
					{
						?>
						<option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>
						<?php
					}
				}
			?>
		</select>
	</td>
		<td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
	<td><select name="sem" onchange='frm_reload()'>
		<option value='0'>------ Select -----</option>
		<?php
			$rs1=execute("select * from course_m where course_id=$branch");
			$hdid=fetcharray($rs1);
			$hd_id=$hdid[head_id];
			$rs=execute("SELECT year_name,year_id FROM course_year where head_id='$hd_id'");
			while($r=fetcharray($rs))
			{
				if($sem==$r[year_id])
				{
					echo "<option value='$r[year_id]' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
				}
				else
				{
					echo "<option value='$r[year_id]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
				}
			}
		?>
		</select>
	</td></tr>
  <tr>
	<td>&nbsp;&nbsp;Academic Year   </td>
	<td align='' >
    <select name="a_year" id="a_year" OnChange='frm_reload()'>
                <option value='0'>Select Year</option>
                <?php
				   $MyYear=date('Y')-10;
				   $CurrentYr=date("Y")+2;
				   for($i=$MyYear;$i<$CurrentYr;$i++)
					 {
						$Fyear=$i;
						$Tyear=$i+1;
						$Tyear=substr($Tyear,2);
						$sele="";
						if($a_year=='')
						{
							if($i==date('Y'))
							$sele="selected";
						}
						else
						{
							if($i==$a_year)
							$sele="selected";
						}

						?>
					<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>- <?=$Tyear?></option>
						<?php
					 }
						   ?>
              </select>

	<td nowrap>&nbsp;&nbsp;No Of Installment </td>
		<td align="left"><select name='intl' OnChange=go()>
        		<option value=''>-- Select --</option>
				<?php
                for($k=1;$k<=12;$k++)
				{
				if($k==$intl)
                echo"<option value='$k' selected>$k</option>";
				else
				echo"<option value='$k'>$k</option>";
				}
                ?>  
		</select>
        </td>
  </tr>
    
</table><br>
<div align='center'>
<input type="submit" class='bgbutton' value="Submit" name="studdet">
</div><br>
<?php
if(!$intl)
die();
		
$sql="select a.student_id, a.first_name, a.last_name, a.admission_type, c.division , a.academic_year, a.class_section_id ,b.id, b.currencyType, b.amount , b.clearedDate, b.amountCleared, b.receipt ,b.modeOfPament from student_m a , fee_m_collect b,fee_apply_fee_student c where  a.id=b.studentId and b.accYear='$a_year' and b.installmentId='$intl' and ((currencyType=1 and modeOfPament!=1) or (currencyType!=1)) and a.id=c.student_id and  c.acc_year='$a_year' and  c.status='1' and  b.status='1'";
	if($reciptid)
	{
		$sql.=" and b.receipt='$reciptid'";
	}
	else
	{
		if($sem!=0)
		{
			$sql.=" and  c.division='$sem";
		}
	}
	$sql.=" order by  c.division , a.first_name";
	$rs=execute($sql);
	if(rowcount($rs)==0)
	{
		echo "<b>No Student Records Found !!</b>";
		die();
	}
	
	 $adate=date("d/m/Y");

?>
<table border=1 class=forumline align=center width='90%' cellspacing='0' cellpadding='1'>
<tr><td align='center' class='head' colspan='8'>Student Details &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Reconciliation Date : 
                       <input type='text' name='adate' value='<?=$adate?>' size="10"  readonly >
                        <a href="javascript:showCal('Calendar1')"><img src='../images/calendar.jpg' align='absmiddle' ></a>
</td>
</tr>
<tr height='30'>
<td height="28" align='center' nowrap Class="rowpic">Sl No</td>
<td Class="rowpic" align='center' nowrap>Student ID</td>
<td Class="rowpic" align='center' nowrap>Student Name</td>
<td Class="rowpic" align='center' nowrap><?php echo $_SESSION['semname']; ?></td>
<td Class="rowpic" align='center' nowrap>Receipt No</td>
<td Class="rowpic" align='center' nowrap>Received</td>
<td Class="rowpic" align='center' nowrap>Reconciliation Date and Amount</td>
<td Class="rowpic" align='center' nowrap>Sel</td>
</tr>
<?php
$sno=1;
$fg=0;
for($i=0;$i<rowcount($rs);$i++)
{
	$r=fetcharray($rs);
	$cyr=$r[academic_year];
	$currency=$r[currencyType];
	$currencydes=fetchrow(execute("select code from fee_m_currency_code where id='$currency'"));
	$currencydes1=fetchrow(execute("select code from fee_m_currency_code where id=1"));
		$fg=1;
		if($sno<10)
			$sno="0".$sno;
		echo "<tr height='23'><td align='center'>$sno</td>";
		?><td align="center">
        <?php
		if($r['modeOfPament']!=1)
		{
		?>
        <A HREF="javascript:OpenWind('convert.php?recordid=<?php echo $r[id]?>&course=<?php echo $r[course_admitted] ?>&sem=<?php echo $r[division] ?>');"><?php echo $r[student_id] ?></A>		
		  <?php
		}
		else
		{
			echo $r[student_id];
		}
          ?>
          </td>
		<td>&nbsp;&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?php echo $r[last_name]?></td>
		<?php
		$cname=fetcharray(execute("select year_name from course_year where year_id='$r[division]'"));
		$secname=fetcharray(execute("select section_name from class_section where id='$r[class_section_id]'"));
		echo "<td align='center'>$cname[0] </td>";
		echo "<td align='center'>$r[receipt]</td>";
		echo "<td align='center'>$r[amount] $currencydes[0]</td>";
		echo "<td align='right'>$r[amountCleared] $currencydes1[0] ( $r[clearedDate] )</td>";
		
		echo "<td align='center'>";
		
		if($r['modeOfPament']==1)
		echo "<input type='checkbox' name='sid[]' value='$r[id]'>";
		else
		
		echo "&nbsp;</td></tr>";
		
		$sno++;
	
}
?>
</table>
<br>
<div align='center'>
<input type="submit" class='bgbutton' value="update" name="studdet1">
</div><br>
</form>
</body>
</html>