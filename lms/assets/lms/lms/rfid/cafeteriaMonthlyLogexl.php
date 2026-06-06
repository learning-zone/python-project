<?php
$file_type = "vnd.ms-excel";
$file_name= "Cafeteria Monthly Log".$_POST['adate'].".xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");
    include("../db.php");
	$yr=date("Y");
	if($_POST)
	{
		$mont=$_POST['mont'];
		$yr=$_POST['yr'];
		$utype=$_POST['utype'];
		$mtype=$_POST['mtype'];
	}
	else
	{
		$mont=date("m");
		$yr=date("Y");
		$utype=1;
		$$mtype=1;
	}
	$day=date("d");
	$mon=$mont;
	$num = cal_days_in_month(CAL_GREGORIAN, $mont, $yr); // 31
	$num1=$num+5;

	if($mtype==1)
	{	
		$adquery="and (a.att_time>'07:00:00' and a.att_time<'10:30:00')";
		$adquery1="and (att_time>'07:00:00' and att_time<'10:30:00')";
		$desname='Break Fast';
	}
	if($mtype==2)
	{
		$adquery="and (a.att_time>'11:30:00' and a.att_time<'14:30:00')";
		$adquery1="and (att_time>'11:30:00' and att_time<'14:30:00')";
		$desname='Lunch';	
	}
	if($mtype==3)
	{
		$adquery="and (a.att_time>'15:00:00' and a.att_time<'17:00:00')";
		$adquery1="and (att_time>'15:00:00' and att_time<'17:00:00')";
		$desname='Snack/Tea';
	}
	if($mtype==4)
	{
		$adquery="and (a.att_time>'19:00:00' and a.att_time<'22:30:00')";
		$adquery1="and (att_time>'19:00:00' and att_time<'22:30:00')";
		$desname='Dinner';
	}
?>
<html>
<head>
<script language="Javascript">
function reload()
{
  document.frm.action='cafeteriaMonthlyLog.php';
  document.frm.submit();
}
function RefreshMe(val)
{
	document.frm.action="cafeteriaDailyLogexcel.php";
	document.frm.submit();
}

</script>
</head>
<body>

<form name='frm' method='post' action=''>
<br>
<table align="center" border="1" width="90%">
<tr height="30">
	   <td colSpan="<?=$num1?>" align="center" class='head'>Cafeteria Monthly Log For <?=MonthName($mont)?> <?=$yr?></td>
</tr>
  <tr>
    <td colspan="<?=$num1?>" class="head">Mercedes-Benz International School</td>
  </tr>
  <tr>
    <td  colspan="<?=$num1?>" class="head">Meal Type - CommonMenu and Meal Category - <?=$desname?>					
</td>
  </tr>
<?php
if($utype==1)
{
	$disname='Class';
}
else
{
	$disname='Category';
}

	echo "<tr  bgcolor='#0066FF'>
		<td bgcolor='#0066FF'><font color='#FFFFFF'><strong>Sr.No.</strong></font></td>
		<td bgcolor='#0066FF' ><font color='#FFFFFF'><strong>Code</strong></font></td>
		<td bgcolor='#0066FF'><font color='#FFFFFF'><strong>Name</strong></font></td>
		<td bgcolor='#0066FF'><font color='#FFFFFF'><strong>$disname</strong></font></td>";
		for($i=1;$i<=$num;$i++)
		{
			$ststd="$yr-$mont-$i";
			$old_date = $ststd; // returns Saturday, January 30 10 02:06:34
			$old_date_timestamp = strtotime($old_date);
			$new_date = date('N', $old_date_timestamp);
			if($new_date==6 or $new_date==7)
			echo "<td bgcolor='#AF1232'><font color='#FFFFFF'><strong>$i</strong></td>";
			else
			echo "<td bgcolor='#0066FF'><font color='#FFFFFF'><strong>$i</strong></td>";
			$grtot[$i]=0;
		}
	echo "<td  bgcolor='#0066FF'><font color='#FFFFFF'><strong>Total</strong></td></tr>";

	$k=1;
	$stst="$yr-$mont-";
	if($utype==1)
	{
		$sql1="SELECT  a.rfidno, b.user, b.user_type, c.first_name, c.last_name, c.course_yearsem, c.student_id FROM rfid_cafeteria_check a, rfid_enrolment_user b, student_m c where b.user=c.id and a.rfidno=b.rfid and a.att_date like '".$stst."%' and b.user_type=1 and b.status=1 $adquery group by b.rfid order by c.course_yearsem, c.first_name";
		$sql1=stripslashes($sql1);
		$sql=execute($sql1);
		while($r=fetcharray($sql))
		{
			$grade=fetchrow(execute("select year_name from course_year where year_id='$r[course_yearsem]' "));
			if($k%2)
			$bgcl='#CFFCFC';
			else
			$bgcl='#FFFFFF';
			
			echo "
			<tr>
			<td align='center' bgcolor='$bgcl' >$k</td>
			<td align='center'  bgcolor='$bgcl'>$r[student_id]</td>
			<td  bgcolor='$bgcl'>&nbsp;&nbsp;$r[first_name] $r[last_name]</td>
			<td  align='center'>$grade[0]</td>";
			$countval=0;
			for($i=1;$i<=$num;$i++)
			{
				$ststd="$yr-$mont-$i";
				
				$intime=fetchrow(execute("SELECT  id FROM rfid_cafeteria_check where att_date='$ststd' and rfidno='$r[rfidno]' $adquery1  limit 1"));
				if($intime[0])
				{
					echo "<td align='center'  bgcolor='$bgcl'>&#8730;</td>";
					$countval++;
					$grtot[$i]=$grtot[$i]+1;
				}
				else
				echo "<td align='center'  bgcolor='$bgcl'>&nbsp;</td>";
			}
			echo "<td align='center'  bgcolor='$bgcl'>$countval</td></tr> ";
			$k++;
		}
	}
		if($utype==2)
		{
			$sql1="SELECT  a.rfidno, b.user, b.user_type, c.f_name, c.s_name, c.subj, c.slno FROM rfid_cafeteria_check a, rfid_enrolment_user b, staff_det c where b.user=c.id and a.rfidno=b.rfid and a.att_date like '".$stst."%' and b.user_type=2 and b.status=1 $adquery group by b.rfid order by  c.f_name";
			$sql1=stripslashes($sql1);

			$sql=execute($sql1);
			while($r=fetcharray($sql))
			{
				$grade=fetchrow(execute("select Dept from dept_no where dpt_id='$r[subj]' "));
					if($k%2)
					$bgcl='#CFFCFC';
					else
					$bgcl='#FFFFFF';

				echo "
				<tr>
				<td align='center'  bgcolor='$bgcl'>$k</td>
				<td align='center'  bgcolor='$bgcl'>$r[slno]</td>
				<td  bgcolor='$bgcl'>&nbsp;&nbsp;$r[f_name] $r[s_name]</td>
				<td  align='center' bgcolor='$bgcl'>$grade[0]</td>";
				$countval=0;
				for($i=1;$i<=$num;$i++)
				{
					$ststd="$yr-$mont-$i";

					$old_date = $ststd; // returns Saturday, January 30 10 02:06:34
					$old_date_timestamp = strtotime($old_date);
					$new_date = date('N', $old_date_timestamp);

					$intime=fetchrow(execute("SELECT  id FROM rfid_cafeteria_check where att_date='$ststd' and rfidno='$r[rfidno]'  $adquery1  limit 1"));
					if($intime[0])
					{
						echo "<td align='center' bgcolor='$bgcl'>&#8730;</td>";
						$countval++;
						$grtot[$i]=$grtot[$i]+1;
					}
					else
					echo "<td align='center' bgcolor='$bgcl'>&nbsp;</td>";
			}
				echo "<td align='center' bgcolor='$bgcl'>$countval</td></tr> ";
				$k++;
			}
		}

	echo "<tr>
		<td class='head'  bgcolor='#0066FF' colspan=4 align='right'><font color='#FFFFFF'><strong>Total</strong></font>&nbsp;&nbsp;&nbsp;</td>";
		$t=0;
		for($i=1;$i<=$num;$i++)
		{
			echo "<td class='head'  bgcolor='#0066FF'><font color='#FFFFFF'><strong>$grtot[$i]</strong></font></td>";
			$t=$t+$grtot[$i];
		}
	echo "<td class='head'  bgcolor='#0066FF'><font color='#FFFFFF'><strong>$t</strong></font></td></tr>";


		?>
</table>
</form>
<?php
function MonthName($mont)
{
	if($mont == 1) return("January");
	if($mont == 2) return("February");
	if($mont == 3) return("March");
	if($mont == 4) return("April");
	if($mont == 5) return("May");
	if($mont == 6) return("June");
	if($mont == 7) return("July");
	if($mont == 8) return("August");
	if($mont == 9) return("September");
	if($mont == 10) return("October");
	if($mont == 11) return("November");
	if($mont == 12) return("December");
}
?>

</body>

</html>
