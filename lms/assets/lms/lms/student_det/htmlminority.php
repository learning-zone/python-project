<html>
<head>
<title>Student strength report</title>
<?php
include("../db.php");
?>
<script language="JavaScript">
function printReport()
{
	prn.style.display="none";
	window.print(this.form);
	prn.style.display="";
}
</script>
</head>
<form name='frm' method='post'>
<?php
if($courseyr==1)
	$Yrn="I YEAR";
elseif($courseyr==2)
	$Yrn="II YEAR";
elseif($courseyr==3)
	$Yrn="III YEAR";
elseif($courseyr==4)
	$Yrn="IV YEAR";
elseif($courseyr==5)
	$Yrn="V YEAR";
?>
<table class='forumline' align='center' border='1'>
<tr><td colspan='14' class='head' align='center'>TABLE - IV</td></tr>
<tr><td colspan='14' class='head' align='center'>NUMBER OF MINORITY STUDENTS ENTROLEMENT IN THE INSTITUTION - <?=$Yrn?></td></tr>
<tr><td colspan='12' class='head' align='center' nowrap><b>NAME OF INSTITUION : VIDYAVARDHAKA COLLEGE OF ENGINEERING, MYSORE</b></td><td colspan='2' class='head' align='center' nowrap><b>year : <?=$gr?></b></td></tr>
<tr><td class='row3' align='center' rowspan=3>SN</td><td class='row3' align='center' rowspan=3>COURSE</td><td class='row3' align='center' colspan=12>NUMBER OF STUDENTS ADMITTED</td></tr>
<tr><td class='row3' colspan='2' align='center' nowrap>MUSLIMS</td>
<td class='row3' colspan='2' align='center' nowrap>CHRISTIANS</td>
<td class='row3' colspan='2' align='center' nowrap>BUDDHISTS</td>
<td class='row3' colspan='2' align='center' nowrap>SIKHS</td>
<td class='row3' colspan='2' align='center' nowrap>JAINS</td>
<td class='row3' colspan='2' align='center' width='10%'>OTHER MINORITY</td></tr>
<tr><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td></tr>
<?
$wsd=0;
$rpo=0;
$s=1;
$dsg=execute("select a.* from course_m a ,coursehead b where a.head_id=b.id and b.cname in ('UG','ug','Ug')");
while($ss=fetcharray($dsg))
{
	echo "<tr>";
	echo "<td>$s</td><td nowrap>$ss[coursename]</td>";
	
	$wert=fetcharray(execute("select count(student_id) from student_m a,religion b where a.gender='M' and a.course_admitted='$ss[0]' and  a.archive='N' and a.religion=b.id and b.id=2 "));
	$wer=fetcharray(execute("select count(student_id) from student_m a,religion b where a.gender='F' and a.course_admitted='$ss[0]' and  a.archive='N' and a.religion=b.id and b.id=2 "));
	
	$wert1=fetcharray(execute("select count(student_id) from student_m a,religion b where a.gender='M' and a.course_admitted='$ss[0]' and  a.archive='N' and a.religion=b.id and b.id=5 "));
	$wer1=fetcharray(execute("select count(student_id) from student_m a,religion b where a.gender='F' and a.course_admitted='$ss[0]' and  a.archive='N' and a.religion=b.id and b.id=5 "));

	$wert2=fetcharray(execute("select count(student_id) from student_m a,religion b where a.gender='M' and a.course_admitted='$ss[0]' and  a.archive='N' and a.religion=b.id and b.id=7 "));
	$wer2=fetcharray(execute("select count(student_id) from student_m a,religion b where a.gender='F' and a.course_admitted='$ss[0]' and  a.archive='N' and a.religion=b.id and b.id=7 "));

	$wert3=fetcharray(execute("select count(student_id) from student_m a,religion b where a.gender='M' and a.course_admitted='$ss[0]' and  a.archive='N' and a.religion=b.id and b.id=6"));
	$wer3=fetcharray(execute("select count(student_id) from student_m a,religion b where a.gender='F' and a.course_admitted='$ss[0]' and  a.archive='N' and a.religion=b.id and b.id=6 "));

	$wert4=fetcharray(execute("select count(student_id) from student_m a,religion b where a.gender='M' and a.course_admitted='$ss[0]' and  a.archive='N' and a.religion=b.id and b.id=3"));
	$wer4=fetcharray(execute("select count(student_id) from student_m a,religion b where a.gender='F' and a.course_admitted='$ss[0]' and  a.archive='N' and a.religion=b.id and b.id=3"));

	$wert5=fetcharray(execute("select count(student_id) from student_m a,religion b where a.gender='M' and a.course_admitted='$ss[0]' and  a.archive='N' and a.religion=b.id and b.id not in(1,2,3,5,6,7)"));
	$wer5=fetcharray(execute("select count(student_id) from student_m a,religion b where a.gender='F' and a.course_admitted='$ss[0]' and  a.archive='N' and a.religion=b.id and b.id not in(1,2,3,5,6,7)"));

	echo "<td align='right'>$wert[0]</td><td align='right'>$wer[0]</td><td align='right'>$wert1[0]</td><td align='right'>$wer1[0]</td><td align='right'>$wert2[0]</td><td align='right'>$wer2[0]</td><td align='right'>$wert3[0]</td><td align='right'>$wer3[0]</td><td align='right'>$wert4[0]</td><td align='right'>$wer4[0]</td><td align='right'>$wert5[0]</td><td align='right'>$wer5[0]</td>";

	$grd_tot+=$wert[0];
	$grd_totf+=$wer[0];
	$grd_tot1+=$wert1[0];
	$grd_totf1+=$wer1[0];
	$grd_tot2+=$wert2[0];
	$grd_totf2+=$wer2[0];
	$grd_tot3+=$wert3[0];
	$grd_totf3+=$wer3[0];
	$grd_tot4+=$wert4[0];
	$grd_totf4+=$wer4[0];
	$grd_tot5+=$wert5[0];
	$grd_totf5+=$wer5[0];
	$s++;
}
?>
</tr>
<tr><td colspan='2' align='center'>TOTAL</td>
<td align='right'><?=$grd_tot?></td><td align='right'><?=$grd_totf?></td>
<td align='right'><?=$grd_tot1?></td><td align='right'><?=$grd_totf1?></td>
<td align='right'><?=$grd_tot2?></td><td align='right'><?=$grd_totf2?></td>
<td align='right'><?=$grd_tot3?></td><td align='right'><?=$grd_totf3?></td>
<td align='right'><?=$grd_tot4?></td><td align='right'><?=$grd_totf4?></td>
<td align='right'><?=$grd_tot5?></td><td align='right'><?=$grd_totf5?></td>
</tr>
</table><br>
<div id='prn' align='center'>
<INPUT TYPE="button" class='bgbutton' NAME="print" VALUE="PRINT THE REPORT" onclick="printReport()"></div>
</form>
</html>