<html>
<head>
<?php
session_start();
include("../db.php");
?>
<script  LANGUAGE="javascript">
function OpenWind2(k2)
{
	var finalVar;
	finalVar2=k2; 
	window.open(finalVar2,'Stud','width=850,height=650,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script>
</head>
<body>
<form method="post" name="frm">
<center>
<input type='hidden' name='cname' value='$coursename'>  
<input type='hidden' name='cyear' value='$course_year'>
<input type='hidden' name='sec' value='$section'>
<?php
$from_date = "$FYear-$FMon-$FDay";
$to_date = "$TYear-$TMon-$TDay";
$MySubCodeArray=array();
$SubjectName=array();
$a=execute("select * from course_m where course_id='$coursename'") or die("<font color=red><b>Please enter course details</b></font>");
$aa=fetcharray($a);	

$b=execute("select * from course_year where year_id='$course_year'") or die("<font color=red><b>Please enter year details</b></font>");

$bb=fetcharray($b);

$c=execute("select * from class_section where id='$section'") or die("<font color=red><b>Please enter section details</b></font>");
$cc=fetcharray($c);
?>
<table class="forumline" align="center">
<tr><td class="head" colspan=".($row3+15)." align="center">Detailed Attendance Report</td></tr>
<tr><td colspan=".($row3+15)." class="row3">Curriculum : <?=$aa[coursename]?></td></tr>
<tr><td class="row3" colspan=".($row3+15)." >Class : <?=$bb[year_name]?></td></tr>
<?php
$secid=$section;
if($secid !=0)
{
	?>
	<tr><td class="row3" colspan=".($row3+15)." >Section : <?=$cc[section_name]." Section"?></td></tr>
	<?
}
else
{
	?>
	<tr><td class="row3" colspan=".($row3+15)." >Section : <?="No Section"?></td></tr>
	<?
}
?>
<tr><td colspan=".($row3+15)." class="$row3">From:<?=date('d-m-Y',strtotime($from_date)) ?>  
	                                              To : <?=date('d-m-Y',strtotime($to_date))?> </td></tr></table> 
<br>
<table class="forumline" align="center">
<tr><td>Sl No</td><td>Name</td><td>Register No</td></tr>
<?php
$slno=1;
$g=execute("select * from student_m where course_admitted=$coursename and course_yearsem=$course_year and class_section_id=$secid and archive='N' order by student_id ");
echo "select * from student_m where course_admitted=$coursename and course_yearsem=$course_year and class_section_id=$secid and archive='N' order by student_id ";
die();

$count=rowcount($g);
for($i=0;$i<$count;$i++)
{
	$gg=fetcharray($g);
	?>
	<tr><td><?=$slno?></td><td><?=$gg[first_name]?></td><td><a href="javascript:OpenWind2 ('det_att_rep_stud2.php?id=<?=$gg[id]?>&name=<?=$gg[first_name]?>&cour=<?=$coursename?>&yr=<?=$course_year?>&sec=<?=$section?>&frm=<?=$from_date?>&to=<?=$to_date?>');"><?=$gg[student_id]?></a></td>
	<?
	$slno++;
}
?>
</table>
</center>
</form>
</body>
</html>	