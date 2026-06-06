<html>
<head>
<title>Attendance Report</title>
<?php
session_start();
include("../db.php");
?>
<script language="JavaScript">
function printReport()
{
	prn.style.display = "none";
	window.print();
	prn.style.display = "";
}
</script>
</head>
<body>
<input type='hidden' name='cname' value='$cour'>  
<input type='hidden' name='cyear' value='$yr'>
<input type='hidden' name='sec' value='$sec'>
<input type='hidden' name='frm' value='$frm'>
<input type='hidden' name='to' value='$to'>

<?php
$ts=execute("select * from course_m where course_id='$cour'");
$tsq=fetcharray($ts);

$tl=execute("select * from course_year where year_id='$yr'");
$tll=fetcharray($tl);

$q=execute("select * from class_section where id='$sec'");
$qq=fetcharray($q);

?>
<table class="forumline" align="center" width="90%">
<tr><td class="head" align="center" colspan=3>DETAILED ATTENDENCE REPORT</td></tr>
<tr><td class="row3" align="left">Student ID : <?php echo $id?></td>
<td class="row3" align="left" colspan=2>Student Name : <?php echo $name?></td></tr>
<tr><td class="row3" align="left">Course : <?php echo $tsq[coursename]?></td>
<td class="row3" align="left">Year/Sem : <?php echo $tll[year_name]?></td>
<?php
$secid=$sec;
if($secid !=0)
{
	?>
	<td class="row3">Section : <?=$qq[section_name]." Section"?></td></tr>
	<?
}
else
{
	?>
	<td class="row3">Section : <?="No Section"?></td></tr>
	<?
}
?>

<tr><td class="row3" align="center" colspan=3><font color=blue>From: <?=date('d-m-Y',strtotime($frm))?>  
To : <?=date('d-m-Y',strtotime($to))?></font></td></tr></table> 
<br>
<table class="forumline" align="center" width="60%">
<tr><td class="head" align=center colspan=24>Suject Details</td></tr>
<div align=center>
<font size="2" color=red>** TC ==> Total Class  ...    TP ==> Total Present ... -- ==> No Class</font>
</div>
<tr><td rowspan=2 align=center>DATE</td>
<?
$r=execute("select * from subject_m where course_id='$cour' and course_year_id='$yr' and status=1");
$r1=rowcount($r);
for($i=0;$i<$r1;$i++)
{
	$rr=fetcharray($r);
	echo "<td nowrap class=row3 align=center colspan=2><b>$rr[subject_code]</b></td>";
}
echo "</tr>";
echo "<tr>";
for($i=0;$i<$r1;$i++)
{

	?>
	<td class=row3 align='center'><b>TC</b></td>
	<td class=row3 align='center'><b>TP</b></td>
	<?
}
echo "</tr>";
if($yr<3)
{
	$cour1=1;
	$yr1=$sec;
}
else
{
	$cour1=$cour;
	$yr1=$yr;
}
$rt=execute("select distinct(adate) from main_att_".$cour1."_".$yr1." where adate between '$frm' and '$to' order by adate");
$count_tot=rowcount($rt);
for($hh=0;$hh<$count_tot;$hh++)
{
	$rtt=fetcharray($rt);
	?>
	<tr><td class='row3' align='center'><?php echo date("d-m-Y",strtotime($rtt[adate]))?></td>
	
	<?php
     $r=execute("select * from subject_m  where course_id='$cour' and course_year_id='$yr' and status=1");
    $r1=rowcount($r);
	for($i=0;$i<$r1;$i++)
	{
	
		$rr=fetcharray($r);	
		$acp=$tsq[course_abbr]."_".$rr[subject_id];
	    $qry_yy=execute("select cc,ca from marks_".$cour1."_".$yr1." where subid='$rr[subject_id]' and studid='$id' and secid='$sec'");
		
        $ttl1=rowcount($qry_yy);
		while($tro=fetcharray($ttl1))
		{
			$count_total1[$i]=$tro[0];
            $count_total2[$i]=$tro[1];
		}
		
		if($ttl1==0)
			echo "<td>--</td><td>--</td>";
		else
		{
			echo "<td>$ttl1</td>";
			if($ttl2 < $ttl1)
				echo "<td><font color=red>$ttl2</font></td>";
			else
				echo "<td>$ttl2</td>";
		}
	}
	echo "</tr>";
}

echo"<tr><td align=center><font color=red>Total</font></td>";
for($i=0;$i<$r1;$i++)
{
	if($count_total1[$i]==0)
		echo "<td>--</td><td>--</td>";
	else
	{
		echo "<td>$count_total1[$i]</td>";
		if($count_total1[$i] < $count_total2[$i])
			echo "<td><font color=red>$count_total1[$i]</font></td>";
		else
			echo "<td>$count_total1[$i]</td>";
		
	}
}
echo"<tr><td align=center><font color=red>Percentage</font></td>";
for($i=0;$i<$r1;$i++)
{
	if($count_total1[$i]==0)
		echo "<td align=center colspan=2>---</td>";
	else
	{
		$t_per=round(($count_total2[$i]/$count_total1[$i])*100)."%";
		echo "<td colspan=2 align=center>$t_per</td>";	
	}
}
?>
</table>
<br>	
<div id="prn" align='center'>
<input type="button" class=bgbutton value="   Print   " name="B1" onClick="printReport()"></div>
</body>
</html>