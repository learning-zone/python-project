<?php
session_start();
include("../db.php");
if($_POST)
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];  
	$intl=$_POST['intl'];
	$a_year=$_POST['a_year'];
	$studfname=$_POST['studfname'];
	$app_no=$_POST['app_no'];
    $stundentid=$_POST['stundentid'];
    $receiptno=$_POST['receiptno'];

	if(!$intl)
	$intlcol='RED';
	
	if(!$a_year)
	$a_yearcol='RED';
}
else
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
?>

<html>
<head>
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>

<script LANGUAGE="JavaScript">
function frm_reload()
{
	document.frm.action='confee.php';
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
<table class='forumline' align='center' width='90%'><tr>
  <td Class="Head" colspan='5' align='center'>Student wise Late Fee Report</td></tr>
  <tr>
	<td>&nbsp;&nbsp;<font color="<?=$a_yearcol?>">Academic Year * </font> </td>
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
              </select></td>
	<td nowrap>&nbsp;&nbsp;<font color="<?=$intlcol?>">No Of Installment *</font></td>
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
    <tr height='30'>
        <td>&nbsp;&nbsp;Student Name</td>
        <td>
        <input type="text" name="studfname" id="studfname" value="<?=$studfname?>" >
        </td>
        <td>&nbsp;&nbsp;Student Id</td>
        
        <td><input type="text"  name='stundentid' value="<?=$stundentid?>" ></td>
    </tr>
    <tr height='30'>
        <td>&nbsp;&nbsp;Application No</td>
        <td>
        <input type="text" name="app_no" id="app_no" value="<?=$app_no?>" >
        </td>
        <td><span class="rowpic">&nbsp;&nbsp;Receipt No</span></td>
        <td><input type="text"  name='receiptno' value="<?=$receiptno?>" ></td>
    </tr>
    
</table><br>
<div align='center'>
<input type="submit" class='bgbutton' value="Submit" name="studdet">
</div><br>
<?php
if(!$intl)
die();
//$studfname=$_POST['studfname'];
	//$app_no
$studfname=$_POST['studfname'];
	$app_no=$_POST['app_no'];
    $stundentid=$_POST['stundentid'];
    $receiptno=$_POST['receiptno'];	
	
$sql="select a.student_id, a.first_name, a.last_name, a.admission_type, c.division , a.academic_year, a.class_section_id ,b.id, b.currencyType, 
b.amount , b.clearedDate, b.amountCleared, b.receipt ,b.modeOfPament, b.paymentDate,b.admissionCat from student_m a , fee_m_collect b,fee_apply_fee_student c where  a.id=b.studentId and b.accYear='$a_year' and b.installmentId='$intl' and ((currencyType=1 and modeOfPament!=1) or (currencyType!=1)) 
and a.id=c.student_id and  c.acc_year='$a_year' and  c.status='1' and  b.status='1'";
	if($receiptno)
	{
		$sql.=" and b.receipt='$receiptno' ";
	}
	else
	{
		if($sem!=0)
		{
			$sql.=" and  c.division='$sem' ";
		}
		if($studfname)
		{
			$sql.=" and ( a.first_name like '%$studfname%' or  a.last_name like '%$studfname%' ) ";
		}
		if($app_no)
		{
			$sql.=" and  a.admission_id='$app_no' ";
		}
		if($stundentid)
		{
			$sql.=" and  a.student_id='$stundentid' ";
		}
	}
	
	$sql.=" order by a.course_admitted, a.course_yearsem, a.class_section_id, a.first_name";
	$rs=execute($sql);
	if(rowcount($rs)==0)
	{
		echo "<b>No Student Records Found !!</b>";
		die();
	}

	 $adate=date("d/m/Y");

?>
<table border=1 class=forumline align=center width='90%' cellspacing='0' cellpadding='1'>
<tr>
  <td align='center' class='head' colspan='8'>Student wise Late Fee Report  
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
</tr>
<?php
$sno=1;
$fg=0;
for($i=0;$i<rowcount($rs);$i++)
{
	$r=fetcharray($rs);
	$cyr=$r[academic_year];
	$currency=$r[currencyType];
	
	$slabinfo=fetchrow(execute("select slab_id from fee_slab_student where status='1'  and student_id='$r[id]' and acc_year='$a_year' "));

	$slabinfo1=fetchrow(execute("select b.t_due_date from fee_m_descrption a, fee_m_descrption_inst_total b where a.status='1' and  a.adm_cat='$r[admissionCat]'  and a.class='$r[division]' and a.accyear='$slabinfo[0]' and a.no_of_instal=b.inst_id and  a.uid=b.uid "));
			
	if($slabinfo1[0])
	{
		
		echo $slabinfo1[0]."- $r[paymentDate] <br>";
		$currencydes=fetchrow(execute("select code from fee_m_currency_code where id='$currency'"));
		$currencydes1=fetchrow(execute("select code from fee_m_currency_code where id=1"));
		$fg=1;
		if($sno<10)
			$sno="0".$sno;
		echo "<tr height='23'><td align='center'>$sno</td>";
		?><td align="center">
        <A HREF="javascript:OpenWind('feerep.php?recordid=<?=$r[id]?>&course=<?=$r[course_admitted]?>&sem=<?=$r[division]?>&recordid=<?=$r[id]?>');"><?=$r[student_id]?></A>		
		  </td>
		<td>&nbsp;&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>
		<?php
		$cname=fetcharray(execute("select year_name from course_year where year_id='$r[division]'"));
		$secname=fetcharray(execute("select section_name from class_section where id='$r[class_section_id]'"));
		/// $secname[0]
		echo "<td align='center'>$cname[0]</td>";
		
		echo "<td align='center'>$r[receipt]</td>";
		echo "<td align='center'>$r[amount] $currencydes[0]</td>";
		echo "<td align='right'>$r[amountCleared] $currencydes1[0] ( $r[clearedDate] )</td></tr>";
		
		$sno++;
	}
}
?>
</table>

</form>
</body>
</html>