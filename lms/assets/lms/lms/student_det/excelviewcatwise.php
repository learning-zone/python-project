<html>
<head>
<title>Castewise report</title>
<?
include("../db.php");
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=FYSTUDENTREPORT.xls");
?>
</head>
<form name='frm' method='post'>
<table class='forumline' align='center'>
<tr><td align='center' class='row3' colspan=10>TABLE - II</td><td class='row3' nowrap>Annexure IIa</td></tr>
<tr><td class='head' align=center colspan=11>COURSE WISE NUMBER OF STUDENTS ADMITTED TO I YEAR/SEMESTER</td></tr>
<tr><td class='head' align=center colspan=10 nowrap>NAME OF INSTITUTION :  VIDYAVARDHAKA COLLEGE OF ENGINEERING, MYSORE </td><td class='head' nowrap>YEAR : <?=$gr?></td></tr>
<tr><td class='row3' rowspan=3>SLNO</td><td class='row3' rowspan=3 align='center'>COURSE</td><td	align='center' class='row3' colspan=10 nowrap>NUMBER OF STUDENTS ADMITTED TO  All SEMESTER</td></tr>
<tr><td class='row3' colspan=2 align='center'>SC</td><td class='row3' colspan=2 align='center'>ST</td><td class='row3' colspan=2 align='center'>OTHERS</td><td class='row3' colspan=2 align='center'>TOTAL</td><td class='row3' align='center' rowspan=2>GRAND TOTAL</td></tr>
<tr><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td class='row3' align='center'>M</td>
<td class='row3' align='center'>F</td></tr>
<?
$adg=execute("select a.* from course_m a,coursehead b where a.head_id=b.id and a.head_id=1 order by course_id");
$sno=1;
while($ss=fetcharray($adg))
{
	echo "<tr><td>$sno</td><td>$ss[coursename]</td>";

	$srt=fetcharray(execute("select intake from sanction_intake"));
	if($srt[0]=='')
	 $srt[0]=0;
     $scm=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]'  and (quota_id=26 or quota_id=27 or quota_id=28 or quota_id=29) and gender='M'"));
	$stm=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]' and (quota_id=31 or quota_id=32 or quota_id=33 ) and gender='M'"));
	$scf=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]'  and (quota_id=26 or quota_id=27 or quota_id=28 or quota_id=29) and gender='F'"));
	$stf=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]'  and (quota_id=31 or quota_id=32 or quota_id=33 ) and gender='F'"));
	$tof=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]' and gender='M'"));
	$tom=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]'  and gender='F'"));
	$sno++;
	$grandtot=$tof[0]+$tom[0];
	$otherf=$tof[0]-$scf[0]-$stf[0];
	
	$otherm=$tom[0]-$scm[0]-$stm[0];
	$tscm+=$scm[0];
	$tscf+=$scf[0];
	$tstm+=$stm[0];
	$tstf+=$stf[0];
	$tomm+=$tom[0];
	$tomf+=$tof[0];
?>
	<td align=center><?=$scm[0]?></font></td><td align=right><?=$scf[0]?></td>
	
      <td align=right><?=$stm[0]?></td><td align=right><?=$stf[0]?></td><td align=right>
	<?=$otherm?></td><td align=right><?=$otherf?></td><td align=right><?=$tom[0]?></td><td align=right><?=$tof[0]?></td>
	<td align=center><font color=blue><?=$grandtot?></font></td></tr>
	<?
}
?>
<tr><td align='center' colspan=2>TOTAL :</td>

<td align=right><?=$tscm?></td><td align=right><?=$tscf?></td><td align=right><?=$tstm?></td><td align=right><?=$tstf?></td><td align=right><?php echo $tomm-$tscm-$tstm; ?></td><td align=right><?php echo $tomf-$tscf-$tstf; ?></td><td align=right><?=$tomm?></td><td align=right><?= $tomf?></td><td align=center><font color=blue><? echo $tomm+$tomf; ?></font></td></tr>
</table>
</form>
</html>