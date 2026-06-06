<?php
session_start();
require("../db.php");
//header("Refresh: 5");
$yr=$_POST['yr'];
$mont=$_POST['mont'];
if(!$mont)
{
	$yr=date("Y");
	$mont=date("m");
}
?>
<HTML>
<HEAD>
<TITLE>Student List</TITLE>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
<script type="text/JavaScript">

function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=700,width=1000,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function printReport()
{
	prn.style.display="none";
	window.print();
}
function reload()
{
  document.frm.action='View_Attendance.php';
  document.frm.submit();
}
</script>
</HEAD>
<BODY >
<form method="POST" name="frm">
<?php
	$adate=date("d/m/Y");
?>
<table width="70%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">MONTHLY ATTENDANCE REPORT</td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;Year</td>
        <td>&nbsp;&nbsp;<select name='yr' onChange="reload()">
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
  </select></td>
    </tr>  
    <tr>
        <td>&nbsp;&nbsp;Month</td>
        <td>&nbsp;&nbsp;<select name='mont' onChange="reload()">
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
    </tr>  
</table> 

<br>
<?php
$num = cal_days_in_month(CAL_GREGORIAN, $mont, $yr); // 31

for($i=1;$i<=$num;$i++)
{
	$date1[]="$yr-$mont-$i";
	$date2[]="$i-$mont-$yr";
}
?>
<table width="70%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0"><tr>
	<td align="center" class="head">Date</td>
    <td align="center" nowrap="nowrap" class="head">Total Student</td>
    <td align="center" nowrap="nowrap" class="head">Total Present</td>
</tr><?php
$m=1;

for($i=0;$i<sizeof($date1);$i++)
{
	$ct=0;
	$cpt=0;
	echo "<tr><td align='center' >$date2[$i]</td>";
	for($j=1;$j<17;$j++)
	{
		$tablename="att_".$j;
		$sql=execute("select stu_id from $tablename where att_date='$date1[$i]' group by stu_id");
		while($r=fetcharray($sql))
		{
			$desc=fetchrow(execute("select id from $tablename where mor=1 and stu_id='$r[0]' and att_date='$date1[$i]' limit 1"));
			if($desc[0])
			$ct++;
			
			$cpt++;
		}
	}
	echo "<td align='center' >$cpt</td><td align='center' >$ct</td></tr>";
	
}
	echo "</table>";
	
	
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
<br>
<div align="center" id="prn"><input class="bgbutton" type="button"  onChange="printReport()" name="open" value="Print Report" ></div><br>

</form>
</body>
</html>