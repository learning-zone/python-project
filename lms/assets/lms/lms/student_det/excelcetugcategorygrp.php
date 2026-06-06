<html>
<head>
<title>Student strength report</title>
<?
include("../db.php");
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=STIDENTDETAILS.xls");
?>
</head>
<form name='frm' method='post'>
<?php
if($courseyr==1 or $courseyr==2)
$cd='a';
elseif($courseyr==3 or $courseyr==4)
$cd='b';
elseif($courseyr==5 or $courseyr==6)
$cd='c';
elseif($courseyr==7 or $courseyr==8)
$cd='d';
elseif($courseyr==9 or $courseyr==10)
$cd='e';
$wyu=fetcharray(execute("select year_name from course_year where year_id=$courseyr"));
$sdg=execute("select * from category order by id");
$ss=rowcount($sdg);
$cno=($ss*2)+2;
$tcno=($ss*2)+9;
$hcno=$tcno-6;
?>
<table class='forumline' align='center' border=1>
<tr><td colspan='<?=$hcno?>' class='head' align='center'>NUMBER OF STUDENTS ON ROLLS</td>
<td colspan='6' align='left' class='head' nowrap>ANNEXURE-II<?php echo $cd ?></td></tr>
<tr><td class='head' align='center' colspan='<?=$hcno?>'>Name of the College : Dayananda Sagar College Of Engineering, Bangalore -78</td>
<td  class='head' align='left' colspan='6' nowrap>Region & College Code : 1 DS </td></td></tr>
<tr><td align='center' colspan='<?=$hcno?>' class='head'><?=$wyu[0]?>ESTER (UG COURSE)</td>
<td  class='head' align='left' colspan='6' nowrap>Year : <?=$gr?>
<tr><td class='row3' rowspan=3 align='center' nowrap>Sl<br>No</td><td class='row3' rowspan=3>Course</td>
<td class='row3' rowspan='3' align='center' nowrap>Sanc<br>Intake</td><td class='row3' align='center' rowspan=2 colspan='3'>TOT No.of<br>Students<br>Admtd</td>
<td class='row3' rowspan='3' align='center'>Vacn</td>
<td class='row3' colspan='<?=$cno?>' align='center'>No. of Students belonging to ...</td></tr><tr>
<?
for($s=1;$s<=$ss;$s++)
{
	$dc=fetcharray($sdg);
	echo "<td colspan='2' class='row3' align='center' nowrap>$dc[name]</td>";
}
?>
<td colspan='2' class='row3' align='center'>Others</td>
<tr><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td class='row3' align='center'><font color='blue'>T</font></td>
<?
for($d=1;$d<=$ss+1;$d++)
{
	echo "<td class='row3' align='center'>M</td><td class='row3' align='center'>F</td>";
}
if($courseyr==9 or $courseyr==10)
	$adg=execute("select a.* from course_m a,course_year b where a.head_id=b.head_id and b.year_id='$courseyr' and a.course_id='13'");
else
	$adg=execute("select a.* from course_m a,course_year b where a.head_id=b.head_id and b.year_id='$courseyr' order by course_id");
$e=1;
while($ss=fetcharray($adg))
{
	?>
	<tr><td><?=$e?></td><td><?=$ss[course_abbr]?></td>
	<?
	$df=fetcharray(execute("select intake from sanction_intake where course_id='$ss[0]' and course_year_id='$courseyr' and acad_yr='$gr'")); 
	//echo "<br>".("select intake from sanction_intake where course_id='$ss[0]' and course_year_id='$courseyr' and acad_yr='$gr'"); 
	if($df[0]=='')
		$df[0]=0;
	$grd_san+=$df[0];
	?>
	<td align='right'><?=$df[0]?></td>
	<?
	$wert=fetcharray(execute("select count(id) from student_m where gender='M' and course_admitted='$ss[0]' and course_yearsem='$courseyr' and archive='N'"));
	$wer=fetcharray(execute("select count(id) from student_m where gender='F' and course_admitted='$ss[0]' and course_yearsem='$courseyr' and archive='N'"));
	$ssp=$wert[0]+$wer[0];
	$wsd=$wert[0];
	$rpo=$wer[0];
	$van=$df[0]-$ssp;
	$gvan+=$van;
	echo "<td align='right'>$wert[0]</td><td align='right'>$wer[0]</td><td align='right'><font color='blue'>$ssp</font></td><td align='right'><font color='red'>$van</font></td>";
	
	$grd_totm+=$wert[0];
	$grd_totf+=$wer[0];
	$grd_tott=$grd_totm+$grd_totf;

	$wsv=0;
	$rtp=0;
	$sdgk=execute("select * from category");
	while($ww=fetcharray($sdgk))
	{
		$wert=fetcharray(execute("select count(id) from student_m where gender='M' and cetcategory='$ww[id]' and course_admitted='$ss[0]' and course_yearsem='$courseyr' and archive='N'"));

		$wer=fetcharray(execute("select count(id) from student_m where gender='F' and cetcategory='$ww[id]' and course_admitted='$ss[0]' and course_yearsem='$courseyr' and archive='N'"));

		echo "<td align='right'>$wert[0]</td><td align='right'>$wer[0]</td>";
		$wsv+=$wert[0];
		$rtp+=$wer[0];
		$gtot=$wsv+$rtp;
	}
	$wertt_o=fetcharray(execute("select count(id) from student_m where gender='M' and (cetcategory='0' || cetcategory='') and course_admitted='$ss[0]' and course_yearsem='$courseyr' and archive='N'"));
	
	$wert_o=fetcharray(execute("select count(id) from student_m where gender='F' and (cetcategory='0' || cetcategory='') and course_admitted='$ss[0]' and course_yearsem='$courseyr' and archive='N'"));

	echo "<td align='right'>$wertt_o[0]</td><td align='right'>$wert_o[0]</td></tr>";
	
	$wsv+=$wertt_o[0];
	$rtp+=$wert_o[0];
	$gtot=$wsv+$rtp;

	//echo"<td align='right'>$wsv</td><td align='right'>$rtp</td><td align='right'>$gtot</td></tr>";
	$e++;
}
?>
<tr><td colspan='2'>TOTAL :></td>
<td align='right'><?=$grd_san?></td><td align='right'><?=$grd_totm?></td><td align='right'><?=$grd_totf?></td>
<td align='right'><font color='blue'><?=$grd_tott?></font></td><td align='right'><font color='red'><?=$gvan?></font></td>
<?
$sdgk=execute("select * from category");
while($ww=fetcharray($sdgk))
{
	$wert=fetcharray(execute("select count(id) from student_m where gender='M' and cetcategory='$ww[id]' and course_yearsem='$courseyr' and archive='N'"));

	$wer=fetcharray(execute("select count(id) from student_m where gender='F' and cetcategory='$ww[id]' and course_yearsem='$courseyr' and archive='N'"));
	
	$net_totm+=$wert[0];
	$net_totf+=$wer[0];
	$net_tot=$net_totm+$net_totf;
	echo "<td align='right'>$wert[0]</td><td align='right'>$wer[0]</td>";
}
$wert_ot=fetcharray(execute("select count(*) from student_m where gender='M' and (cetcategory='0' || cetcategory='') and course_yearsem='$courseyr' and archive='N'"));

$wer_ot=fetcharray(execute("select count(*) from student_m where gender='F' and (cetcategory='0' || cetcategory='') and course_yearsem='$courseyr' and archive='N'"));

echo "<td align='right'>$wert_ot[0]</td><td align='right'>$wer_ot[0]</td>";
$net_totm+=$wert_ot[0];
$net_totf+=$wer_ot[0];
$net_tot=$net_totm+$net_totf;
?>
</tr>
</table>
</form>
</html>