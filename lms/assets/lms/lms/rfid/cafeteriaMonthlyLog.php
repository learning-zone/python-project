<?php

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
		$mtype=1;
	}
	$day=date("d");
	$mon=$mont;
	
	
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
$num = cal_days_in_month(CAL_GREGORIAN, $mont, $yr); // 31
$num1 =$num +5;	
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
	document.frm.action="cafeteriaMonthlyLogexl.php";
	document.frm.submit();
}

</script>
</head>
<body>

<form name='frm' method='post' action=''>
<br>
<div align="right"><input type="button" name="ExporttoExcel" value="Export to Excel" onclick="RefreshMe()" /></div><br>
<table align="center" border="1" cellSpacing="0" width="90%">
<tr height="30">
	   <td colSpan="8" align="center" class='head'>Cafeteria Monthly Log For <?=MonthName($mont)?> <?=$yr?> </td>
</tr>
<tr>
    <td class="row3" align="center" nowrap>User Type</td>
    <td align="center">
    <select name='utype' onChange="reload()">
<?php 		
if($utype==1)
$sts='selected';
if($utype==2)
$sts1='selected';
			echo "<option value='1' $sts>Student</option>";         
			echo "<option value='2' $sts1>Staff</option>";

?>        </select>   
    </td>
    <td class="row3" align="center" nowrap>Meal Category</td>
    <td align="center">
        <select name='mtype' onChange="reload()">
<?php 		
if($mtype==1)
$sts='selected';
if($mtype==2)
$sts1='selected';
if($mtype==3)
$sts2='selected';
if($mtype==4)
$sts3='selected';
			echo "<option value='1' $sts>Break Fast</option>";         
			echo "<option value='2' $sts1>Lunch</option>";
			echo "<option value='3' $sts2>Snack/Tea</option>";         
			echo "<option value='4' $sts3>Dinner</option>";

?>        </select>   
    </td>
    <td class="row3" align="center">Year</td>
    <td align="center">
        <select name='yr' onChange="reload()">
        <?php
            $yrr=date("Y")-1;
            for($i=1;$i<=3;$i++)
            {
                if($yrr == $yr)
                    echo "<option value='$yrr' selected>" . $yrr . "</option>\n";
                else
                    echo "<option value='$yrr'>" .$yrr . "</option>\n";
                $yrr++;
            }
        ?>
        </select>
    </td>
    <td class="row3" align="center">Month</td>
    <td align="center">
        <select name='mont' onChange="reload()">
            <?php
            $d=getdate();
            $MyMonth=$mont;
            for($i=1;$i<=12;$i++)
            {
                if($i<10)
                {
                    $i='0'.$i;
                }
                if($i == $MyMonth)
                    echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
                else
                    echo "<option value='$i'>" . MonthName($i) . "</option>\n";
            }
            ?>
        </select>
    </td>
</tr></table>
<br>
<table align="center" border="1" width="90%">

  <tr>
    <td colspan="<?=$num1?>" class="head">Mercedes-Benz International School</td>
  </tr>
  <tr>
    <td colspan="<?=$num1?>" class="head">Meal Type - CommonMenu and Meal Category - <?=$desname?>					
</td>
  </tr>
<?php
$num = cal_days_in_month(CAL_GREGORIAN, $mont, $yr); // 31
if($utype==1)
{
	$disname='Class';
}
else
{
	$disname='Category';
}

	echo "<tr>
		<td class='head'>Sr.No.</td>
		<td class='head'>Code</td>
		<td class='head'>Name</td>
		<td class='head'>$disname</td>";
		for($i=1;$i<=$num;$i++)
		{
			echo "<td class='head'>$i</td>";
			$grtot[$i]=0;
		}
	echo "<td class='head'>Total</td></tr>";

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
			echo "
			<tr>
			<td align='center' >$k</td>
			<td align='center' >$r[student_id]</td>
			<td >&nbsp;&nbsp;$r[first_name] $r[last_name]</td>
			<td  align='center'>$grade[0]</td>";
			$countval=0;
			for($i=1;$i<=$num;$i++)
			{
				$ststd="$yr-$mont-$i";
				
				$intime=fetchrow(execute("SELECT  id FROM rfid_cafeteria_check where att_date='$ststd' and rfidno='$r[rfidno]' $adquery1  limit 1"));
				if($intime[0])
				{
					echo "<td align='center'>&#8730;</td>";
					$countval++;
					$grtot[$i]=$grtot[$i]+1;
				}
				else
				echo "<td align='center'>&nbsp;</td>";
			}
			echo "<td align='center'>$countval</td></tr> ";
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
				echo "
				<tr>
				<td align='center' >$k</td>
				<td align='center' >$r[slno]</td>
				<td >&nbsp;&nbsp;$r[f_name] $r[s_name]</td>
				<td  align='center'>$grade[0]</td>";
				$countval=0;
				for($i=1;$i<=$num;$i++)
				{
					$ststd="$yr-$mont-$i";
					
					$intime=fetchrow(execute("SELECT  id FROM rfid_cafeteria_check where att_date='$ststd' and rfidno='$r[rfidno]'  $adquery1  limit 1"));
					if($intime[0])
					{
						echo "<td align='center'>&#8730;</td>";
						$countval++;
						$grtot[$i]=$grtot[$i]+1;
					}
					else
					echo "<td align='center'>&nbsp;</td>";
			}
				echo "<td align='center'>$countval</td></tr> ";
				$k++;
			}
		}

	echo "<tr>
		<td class='head' colspan=4 align='right'>Total&nbsp;&nbsp;&nbsp;</td>";
		$t=0;
		for($i=1;$i<=$num;$i++)
		{
			echo "<td class='head'>$grtot[$i]</td>";
			$t=$t+$grtot[$i];
		}
	echo "<td class='head'>$t</td></tr>";


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
