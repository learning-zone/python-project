<html>
<head>
<title>Non-Karnatak/Foreign Student report</title>
<?php
include("../../db.php");
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=STUDENTDETAILS.xls");
?>
</head>
<form name='frm' method='post'>
<table class='forumline' align='center' border=1>
<tr><td align='center' class='row3' colspan=32>TABLE - III</td></tr>
<tr><td class='head' align=center colspan=32 nowrap>COURSE WISE NUMBER OF NON-KARNATAKA AND FOREIGN STUDENTS STUDYING DURING THE YEAR : <?=$gr?></td></tr>
<tr><td class='head' align=center colspan=32 nowrap><b>NAME OF INSTITUTION : DAYANANDA SAGAR COLLEGE OF ENGINEERING, BANGALORE - 78</b></td></tr>
<tr><td class='row3' rowspan=3>SN</td><td class='row3' rowspan=3 align='center'>COURSE</td><td	align='center' class='row3' colspan=6 nowrap>NUMBER OF STUDENTS - I YEAR</td><td	align='center' class='row3' colspan=6 nowrap>NUMBER OF STUDENTS - II YEAR</td><td	align='center' class='row3' colspan=6 nowrap>NUMBER OF STUDENTS - III YEAR</td><td	align='center' class='row3' colspan=6 nowrap>NUMBER OF STUDENTS - IV YEAR</td><td	align='center' class='row3' colspan=6 nowrap>NUMBER OF STUDENTS - V YEAR</td></tr>
<tr><td class='row3' colspan=2 align='center'>NON-KAR</td><td class='row3' colspan=2 align='center'>FOREIGN</td><td class='row3' colspan=2 align='center'>TOTAL</td><td class='row3' colspan=2 align='center'>NON-KAR</td><td class='row3' colspan=2 align='center'>FOREIGN</td><td class='row3' colspan=2 align='center'>TOTAL</td><td class='row3' colspan=2 align='center'>NON-KAR</td><td class='row3' colspan=2 align='center'>FOREIGN</td><td class='row3' colspan=2 align='center'>TOTAL</td><td class='row3' colspan=2 align='center'>NON-KAR</td><td class='row3' colspan=2 align='center'>FOREIGN</td><td class='row3' colspan=2 align='center'>TOTAL</td><td class='row3' colspan=2 align='center'>NON-KAR</td><td class='row3' colspan=2 align='center'>FOREIGN</td><td class='row3' colspan=2 align='center'>TOTAL</td></tr>
<tr><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td><td class='row3' align='center'>B</td><td class='row3' align='center'>G</td></tr>
<?
$adg=execute("select a.* from course_m a,coursehead b where a.head_id=b.id and a.head_id=1 order by course_id");
$sno=1;
while($ss=fetcharray($adg))
{
	echo "<tr><td>$sno</td><td>$ss[course_abbr]</td>";

	$wert=fetcharray(execute("select count(id) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('I Sem','I SEM','Ist Sem','Ist SEM','II Sem','II SEM','IInd Sem','IInd SEM') and a.archive='N' and (a.edu_state!=14 or a.edu_state not like 'KAR%') and a.nationality=1"));
	$wer=fetcharray(execute("select count(id) from student_m a,course_year b where a.gender='F' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('I Sem','I SEM','Ist Sem','Ist SEM','II Sem','II SEM','IInd Sem','IInd SEM') and a.archive='N' and (a.edu_state!=14 or a.edu_state not like 'KAR%') and a.nationality=1"));
	
	$fwert=fetcharray(execute("select count(id) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('I Sem','I SEM','Ist Sem','Ist SEM','II Sem','II SEM','IInd Sem','IInd SEM') and a.archive='N' and a.nationality!=1"));
	$fwer=fetcharray(execute("select count(id) from student_m a,course_year b where a.gender='F' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('I Sem','I SEM','Ist Sem','Ist SEM','II Sem','II SEM','IInd Sem','IInd SEM') and a.archive='N' and a.nationality!=1"));

	$cor_totm=$wert[0]+$fwert[0];
	$cor_totf=$wer[0]+$fwer[0];

	echo "<td align='right'>$wert[0]</td><td align='right'>$wer[0]</td><td align='right'>$fwert[0]</td><td align='right'>$fwer[0]</td><td align='right'>$cor_totm</td><td align='right'>$cor_totf</td>";

	$wert1=fetcharray(execute("select count(id) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('III Sem','III SEM','IIIrd Sem','IIIrd SEM','IV Sem','IV SEM','IVth Sem','IVth SEM') and a.archive='N' and (a.edu_state!=14 or a.edu_state not like 'KAR%') and a.nationality=1"));
	$wer1=fetcharray(execute("select count(id) from student_m a,course_year b where gender='F' and course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('III Sem','III SEM','IIIrd Sem','IIIrd SEM','IV Sem','IV SEM','IVth Sem','IVth SEM') and a.archive='N' and (a.edu_state!=14 or a.edu_state not like 'KAR%') and a.nationality=1"));
	
	$fwert1=fetcharray(execute("select count(id) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('III Sem','III SEM','IIIrd Sem','IIIrd SEM','IV Sem','IV SEM','IVth Sem','IVth SEM') and a.archive='N' and a.nationality!=1"));
	$fwer1=fetcharray(execute("select count(id) from student_m a,course_year b where gender='F' and course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('III Sem','III SEM','IIIrd Sem','IIIrd SEM','IV Sem','IV SEM','IVth Sem','IVth SEM') and a.archive='N' and a.nationality!=1"));

	$cor_tot1m=$wert1[0]+$fwert1[0];
	$cor_tot1f=$wer1[0]+$fwer1[0];

	echo "<td align='right'>$wert1[0]</td><td align='right'>$wer1[0]</td><td align='right'>$fwert1[0]</td><td align='right'>$fwer1[0]</td><td align='right'>$cor_tot1m</td><td align='right'>$cor_tot1f</td>";

	$wert2=fetcharray(execute("select count(id) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('V Sem','V SEM','Vth Sem','V SEM','VI Sem','VI SEM','VIth Sem','VIth SEM') and a.archive='N' and (a.edu_state!=14 or a.edu_state not like 'KAR%') and a.nationality=1"));
	$wer2=fetcharray(execute("select count(id) from student_m a,course_year b where gender='F' and course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('V Sem','V SEM','Vth Sem','Vth SEM','VI Sem','VI SEM','VIth Sem','VIth SEM') and a.archive='N' and (a.edu_state!=14 or a.edu_state not like 'KAR%') and a.nationality=1"));
	
	$fwert2=fetcharray(execute("select count(id) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('V Sem','V SEM','Vth Sem','V SEM','VI Sem','VI SEM','VIth Sem','VIth SEM') and a.archive='N' and a.nationality!=1"));
	$fwer2=fetcharray(execute("select count(id) from student_m a,course_year b where gender='F' and course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('V Sem','V SEM','Vth Sem','Vth SEM','VI Sem','VI SEM','VIth Sem','VIth SEM') and a.archive='N' and a.nationality!=1"));

	$cor_tot2m=$wert2[0]+$fwert2[0];
	$cor_tot2f=$wer2[0]+$fwer2[0];

	echo "<td align='right'>$wert2[0]</td><td align='right'>$wer2[0]</td><td align='right'>$fwert2[0]</td><td align='right'>$fwer2[0]</td><td align='right'>$cor_tot2m</td><td align='right'>$cor_tot2f</td>";

	$wert3=fetcharray(execute("select count(id) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('VII Sem','VII SEM','VIIth Sem','VII SEM','VIII Sem','VIII SEM','VIIIth Sem','VIIIth SEM') and a.archive='N' and (a.edu_state!=14 or a.edu_state not like 'KAR%') and a.nationality=1"));
	$wer3=fetcharray(execute("select count(id) from student_m a,course_year b where gender='F' and course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('VII Sem','VII SEM','VIIth Sem','VIIth SEM','VIII Sem','VIII SEM','VIIIth Sem','VIIIth SEM') and a.archive='N' and (a.edu_state!=14 or a.edu_state not like 'KAR%') and a.nationality=1"));
	
	$fwert3=fetcharray(execute("select count(id) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('VII Sem','VII SEM','VIIth Sem','VII SEM','VIII Sem','VIII SEM','VIIIth Sem','VIIIth SEM') and a.archive='N' a.nationality!=1"));
	$fwer3=fetcharray(execute("select count(id) from student_m a,course_year b where gender='F' and course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('VII Sem','VII SEM','VIIth Sem','VIIth SEM','VIII Sem','VIII SEM','VIIIth Sem','VIIIth SEM') and a.archive='N' and a.nationality!=1"));

	$cor_tot3m=$wert3[0]+$fwert3[0];
	$cor_tot3f=$wer3[0]+$fwer3[0];

	echo "<td align='right'>$wert3[0]</td><td align='right'>$wer3[0]</td><td align='right'>$fwert3[0]</td><td align='right'>$fwer3[0]</td><td align='right'>$cor_tot3m</td><td align='right'>$cor_tot3f</td>";

	if($ss[0]==13)
	{
		$wert4=fetcharray(execute("select count(id) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('IX Sem','IX SEM','IXth Sem','IX SEM','X Sem','X SEM','Xth Sem','Xth SEM') and a.archive='N' and (a.edu_state!=14 or a.edu_state not like 'KAR%') and a.nationality=1"));
		$wer4=fetcharray(execute("select count(id) from student_m a,course_year b where gender='F' and course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('IX Sem','IX SEM','IXth Sem','IXth SEM','X Sem','X SEM','Xth Sem','Xth SEM') and a.archive='N' and (a.edu_state!=14 or a.edu_state not like 'KAR%') and a.nationality=1"));
	
		$fwert4=fetcharray(execute("select count(id) from student_m a,course_year b where a.gender='M' and a.course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('IX Sem','IX SEM','IXth Sem','IX SEM','X Sem','X SEM','Xth Sem','Xth SEM') and a.archive='N' and a.nationality!=1"));
		$fwer4=fetcharray(execute("select count(id) from student_m a,course_year b where gender='F' and course_admitted='$ss[0]' and b.head_id=$ss[head_id] and a.course_yearsem=b.year_id and b.year_name in ('IX Sem','IX SEM','IXth Sem','IXth SEM','X Sem','X SEM','Xth Sem','Xth SEM') and a.archive='N' and a.nationality!=1"));

		$cor_tot4m=$wert4[0]+$fwert4[0];
		$cor_tot4f=$wer4[0]+$fwer4[0];
		$gwert4+=$wert4[0];
		$gwer4+=$wer4[0];
		$gfwert4+=$fwert4[0];
		$gfwer4+=$fwer4[0];
		$gcor_tot4m+=$cor_tot4m;
		$gcor_tot4f+=$cor_tot4f;

		echo "<td align='right'>$wert4[0]</td><td align='right'>$wer4[0]</td><td align='right'>$fwert4[0]</td><td align='right'>$fwer4[0]</td><td align='right'>$cor_tot4m</td><td align='right'>$cor_tot4f</td></tr>";
	}
	else
		echo "<td align='right'>---</td><td align='right'>---</td><td align='right'>---</td><td align='right'>---</td><td align='right'>---</td><td align='right'>---</td></tr>";
	
	$gwert+=$wert[0];
	$gwer+=$wer[0];
	$gfwert+=$fwert[0];
	$gfwer+=$fwer[0];
	$gcor_totm+=$cor_totm;
	$gcor_totf+=$cor_totf;
	$gwert1+=$wert1[0];
	$gwer1+=$wer1[0];
	$gfwert1+=$fwert1[0];
	$gfwer1+=$fwer1[0];
	$gcor_tot1m+=$cor_tot1m;
	$gcor_tot1f+=$cor_tot1f;
	$gwert2+=$wert2[0];
	$gwer2+=$wer2[0];
	$gfwert2+=$fwert2[0];
	$gfwer2+=$fwer2[0];
	$gcor_tot2m+=$cor_tot2m;
	$gcor_tot2f+=$cor_tot2f;
	$gwert3+=$wert3[0];
	$gwer3+=$wer3[0];
	$gfwert3+=$fwert3[0];
	$gfwer3+=$fwer3[0];
	$gcor_tot3m+=$cor_tot3m;
	$gcor_tot3f+=$cor_tot3f;
	$sno++;
}
?>
<tr><td align='right' colspan=2>TOTAL : </td><td align=right><?=$gwert?></td><td align=right><?=$gwer?></td><td align=right><?=$gfwert?></td><td align=right><?=$gfwer?></td><td align=right><?=$gcor_totm?></td><td align=right><?=$gcor_totf?></td><td align=right><?=$gwert1?></td><td align=right><?=$gwer1?></td><td align=right><?=$gfwert1?></td><td align=right><?=$gfwer1?></td><td align=right><?=$gcor_tot1m?></td><td align=right><?=$gcor_tot1f?></td><td align=right><?=$gwert2?></td><td align=right><?=$gwer2?></td><td align=right><?=$gfwert2?></td><td align=right><?=$gfwer2?></td><td align=right><?=$gcor_tot2m?></td><td align=right><?=$gcor_tot2f?></td><td align=right><?=$gwert3?></td><td align=right><?=$gwer3?></td><td align=right><?=$gfwert3?></td><td align=right><?=$gfwer3?></td><td align=right><?=$gcor_tot3m?></td><td align=right><?=$gcor_tot3f?></td><td align=right><?=$gwert4?></td><td align=right><?=$gwer4?></td><td align=right><?=$gfwert4?></td><td align=right><?=$gfwer4?></td><td align=right><?=$gcor_tot4m?></td><td align=right><?=$gcor_tot4f?></td></tr>
</table>
</form>
</html>