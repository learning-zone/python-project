<html>
<head>
<title>Student strength report</title>
<?php
include("../db.php");
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=STUDENTDETAILS.xls");
?>
</head>
<form name='frm' method='post'>
<table class='forumline' align='center' border=1>
<tr><td colspan='20' class='head' align='center'><font size=3><b>DAYANANDA SAGAR COLLEGE OF ENGINEERING<br>BANGALORE - 78</b></font></td></tr>
<tr><td colspan='20' class='head' align='center'><b>STUDENT STRENGTH DURING THE ACADEMIC YEAR&nbsp;&nbsp;<?=$gr?> UG Courses</b></td></tr>
<tr><td class='row3' rowspan=2>SLNO</td><td class='row3' rowspan=2>BRANCH</td>
<td class='row3' colspan='3' align='center' nowrap>I SEMESTER</td>
<td class='row3' colspan='3' align='center' nowrap>III SEMESTER</td>
<td class='row3' colspan='3' align='center' nowrap>V SEMESTER</td>
<td class='row3' colspan='3' align='center' nowrap>VII SEMESTER</td>
<td class='row3' colspan='3' align='center' nowrap>IX SEMESTER</td>
<td class='row3' colspan='3' align='center' width='10%'>TOTAL</td></tr>
<tr><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td align='center' class='row3'>TTL</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td align='center' class='row3'>TTL</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td align='center' class='row3'>TTL</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td align='center' class='row3'>TTL</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td align='center' class='row3'>TTL</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td class='row3' align='center'>TTL</td></tr>
<?
$wsd=0;
$rpo=0;
$s=1;
$dsg=execute("select a.* from course_m a ,coursehead b where a.head_id=b.id and b.cname in ('UG','ug','Ug')");
while($ss=fetcharray($dsg))
{
	echo "<tr>";
	echo "<td>$s</td><td>$ss[course_abbr]</td>";
	
	$wert=fetcharray(execute("select count(id) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('I Sem','I SEM','Ist Sem','Ist SEM','II Sem','II SEM','IInd Sem','IInd SEM') and a.archive='N' and a.academic_year='$gr'"));
	$wer=fetcharray(execute("select count(id) from student_m a,course_year b where a.gender='F' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('I Sem','I SEM','Ist Sem','Ist SEM','II Sem','II SEM','IInd Sem','IInd SEM') and a.archive='N' and a.academic_year='$gr'"));
	
	$cor_tot=$wert[0]+$wer[0];
	echo "<td align='right'>$wert[0]</td><td align='right'>$wer[0]</td><td align='right'><font color=brown>$cor_tot</font></td>";

	$wert1=fetcharray(execute("select count(*) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('III Sem','III SEM','IIIrd Sem','IIIrd SEM','IV Sem','IV SEM','IVth Sem','IVth SEM') and a.archive='N'"));
	$wer1=fetcharray(execute("select count(*) from student_m a,course_year b where gender='F' and course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('III Sem','III SEM','IIIrd Sem','IIIrd SEM','IV Sem','IV SEM','IVth Sem','IVth SEM') and a.archive='N'"));
	
	$cor_tot1=$wert1[0]+$wer1[0];
	echo "<td align='right'>$wert1[0]</td><td align='right'>$wer1[0]</td><td align='right'><font color=brown>$cor_tot1</font></td>";

	$wert2=fetcharray(execute("select count(*) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('V Sem','V SEM','Vth Sem','V SEM','VI Sem','VI SEM','VIth Sem','VIth SEM') and a.archive='N'"));
	$wer2=fetcharray(execute("select count(*) from student_m a,course_year b where gender='F' and course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('V Sem','V SEM','Vth Sem','Vth SEM','VI Sem','VI SEM','VIth Sem','VIth SEM') and a.archive='N'"));
	
	$cor_tot2=$wert2[0]+$wer2[0];
	echo "<td align='right'>$wert2[0]</td><td align='right'>$wer2[0]</td><td align='right'><font color=brown>$cor_tot2</font></td>";

	$wert3=fetcharray(execute("select count(*) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('VII Sem','VII SEM','VIIth Sem','VII SEM','VIII Sem','VIII SEM','VIIIth Sem','VIIIth SEM') and a.archive='N'"));
	$wer3=fetcharray(execute("select count(*) from student_m a,course_year b where gender='F' and course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('VII Sem','VII SEM','VIIth Sem','VIIth SEM','VIII Sem','VIII SEM','VIIIth Sem','VIIIth SEM') and a.archive='N'"));
	
	$cor_tot3=$wert3[0]+$wer3[0];
	echo "<td align='right'>$wert3[0]</td><td align='right'>$wer3[0]</td><td align='right'><font color=brown>$cor_tot3</font></td>";

	if($ss[0]==13)
	{
		$wert4=fetcharray(execute("select count(*) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('IX Sem','IX SEM','IXth Sem','IX SEM','X Sem','X SEM','Xth Sem','Xth SEM') and a.archive='N'"));
		$wer4=fetcharray(execute("select count(*) from student_m a,course_year b where gender='F' and course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('IX Sem','IX SEM','IXth Sem','IXth SEM','X Sem','X SEM','Xth Sem','Xth SEM') and a.archive='N'"));
	
		$cor_tot4=$wert4[0]+$wer4[0];
		$grd_tot4+=$wert4[0];
		$grd_totf4+=$wer4[0];
		$grd_tott4+=$cor_tot4;

		echo "<td align='right'>$wert4[0]</td><td align='right'>$wer4[0]</td><td align='right'><font color=brown>$cor_tot4</font></td>";
	}
	else
		echo "<td align='right'>---</td><td align='right'>---</td><td align='right'><font color=brown>---</font></td>";
	
	$net_totm=$wert[0]+$wert1[0]+$wert2[0]+$wert3[0]+$wert4[0];
	$net_totf=$wer[0]+$wer1[0]+$wer2[0]+$wer3[0]+$wer4[0];
	$net_tot=$net_totm+$net_totf;	

	echo "<td align='right'>$net_totm</td><td align='right'>$net_totf</td><td align='right'><font color=blue>$net_tot</font></td></tr>";

	$grd_tot+=$wert[0];
	$grd_totf+=$wer[0];
	$grd_tott+=$cor_tot;
	
	$grd_tot1+=$wert1[0];
	$grd_totf1+=$wer1[0];
	$grd_tott1+=$cor_tot1;

	$grd_tot2+=$wert2[0];
	$grd_totf2+=$wer2[0];
	$grd_tott2+=$cor_tot2;

	$grd_tot3+=$wert3[0];
	$grd_totf3+=$wer3[0];
	$grd_tott3+=$cor_tot3;
	
	$totm+=$net_totm;
	$totf+=$net_totf;
	$tot+=$net_tot;
	$s++;
}
?>

<tr><td colspan='2'>GRAND TOTAL</td>
<td align='right'><?=$grd_tot?></td><td align='right'><?=$grd_totf?></td><td align='right'><font color='brown'><?=$grd_tott?></td>
<td align='right'><?=$grd_tot1?></td><td align='right'><?=$grd_totf1?></td><td align='right'><font color='brown'><?=$grd_tott1?></td>
<td align='right'><?=$grd_tot2?></td><td align='right'><?=$grd_totf2?></td><td align='right'><font color='brown'><?=$grd_tott2?></td>
<td align='right'><?=$grd_tot3?></td><td align='right'><?=$grd_totf3?></td><td align='right'><font color='brown'><?=$grd_tott3?></td>
<td align='right'><?=$grd_tot4?></td><td align='right'><?=$grd_totf4?></td><td align='right'><font color='brown'><?=$grd_tott4?></td>
<td align='right'><?=$totm?></td><td align='right'><?=$totf?></td><td align='right'><font color='brown'><?=$tot?></td>
</tr>
</table>
</form>
</html>