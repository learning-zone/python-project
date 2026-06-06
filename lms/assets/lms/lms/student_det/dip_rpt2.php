<html>
<head>
<?php
require("../db.php");
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=Diploma Students List.xls");
?>
</head>
<body>
<?php
if( $course==-1 || $courseyr==-1 || $AdmName==-1 )
{
	die("<font color='red'><b>Select all details...</b></font>");
}
$sql = execute("select year_name from course_year where year_id = $courseyr");
$r = fetcharray($sql);
$yr = $r["year_name"];

$sql = execute("select name from admission where id = $AdmName");
$r = fetcharray($sql);
$amd = $r["name"];

$sql = execute("select col_name from college ");
$r = fetcharray($sql);
$colname = $r["col_name"];

$dfg=fetcharray(execute("select coursename from course_m where course_id='$course'"));
$cyr=date("Y");
$cyr1=$cyr+1;
$acc=$cyr."-".(substr($cyr,2)+1);
$r1=fetcharray(execute("select intake from intake where adm_type='$AdmName' and course_id='$course' and course_year_id='$courseyr' and acad_yr='$acc'"));
$san=$r1[0];
if($san=='')
	$san=0;
$r2=fetcharray(execute("select count(id) from student_m where course_admitted='$course' and course_yearsem='$courseyr' and archive='N' and cetunder='$AdmName'"));
$admt=$r2[0];
if($admt=='')
	$admt=0;
$vac=$san-$admt;
if($vac<=0)
	$vac="NIL";
?>
<table  width="100%" align=center class=forumline border=1 cellpadding='0' cellspacing='0'>
<tr><td  align='center' class=head colspan=15><FONT SIZE='4'><b>APPROVAL LIST - <?=$yr?>ESTER</b></FONT></td></tr>
<tr><td class=row3 colspan=8>&nbsp;&nbsp;<b><u>ACADEMIC YEAR : <?=$cyr?> - <?=$cyr1?></u></b></td><td align='right' class=row3 colspan='7'><b>CATEGORY : <?=$amd?>&nbsp;&nbsp;&nbsp;&nbsp;</b></td></tr>
<tr><td class=row3 colspan=15>&nbsp;&nbsp;<b><u>COURSE : DIPLOMA</u></b></td></tr>
<tr><td class=row3 colspan=15><b>&nbsp;&nbsp;<u>Name of College : <?=$colname?></u></b></td></tr>
<tr><td class=row3 colspan=15>&nbsp;&nbsp;<b><u>Branch : <?=$dfg[0]?></u></b></td></tr>
<tr><td class=row3 colspan=5>&nbsp;&nbsp;<b><u>Sanctioned Intake : <?=$san?></u></b></td><td class=row3 colspan=5>&nbsp;&nbsp;<b><u>Actual Admitted : <?=$admt?></u></b></td><td class=row3 colspan=5>&nbsp;&nbsp;<b><u>Vacancy : <?=$vac?></u></b></td></tr>
<tr><td width="3%"  align="center" class=row2 ><b>Sl.No</b></font></td>
<td width="15%"  align="center" class=row2><b>Name of the Student</b></td>
<td width="7%"  align="center" class=row2><b>Sex</b></td>
<td width="10%" align="center"  class=row2><b>Qualifying Exam Passed</b></td>
<td width="5%"  align="center" class=row2><b>Borad</b></td>
<td width="8%"  align="center" class=row2><b>State from which Diploma Passed</b></td>
<td width="8%"  align="center" class=row2><b>K/NK /FN<b></td>
<td width="8%"  align="center" class=row2><b>Eligibility % at Diploma</b></td>
<td width="8%"  align="center" class=row2><b>Caste</b></td>
<td width="12%" align="center" class=row2><b>Category</b></td>
<td width="8%"  align="center" class=row2><b>CET Rank</b></td>
<td width="8%"  align="center" class=row2><b>Tution Fee Paid during admission</b></td>
<td width="8%"  align="center" class=row2><b>Fee Receipt No</b></td>
<td width="8%"  align="center" class=row2><b>Fee Date</b></td>
<td width="8%"  align="center" class=row2 nowrap><b>Signature of the Student</b></td>
</tr>
<?PHP
 
$sqls = "SELECT * FROM student_m WHERE  course_yearsem = ".$courseyr."  AND ";
$sqls .= "cetunder = ".$AdmName." AND course_admitted = ".$course." AND academic_year ='".$acc."' and archive='N'";
$rsst = execute($sqls);
$rows = rowcount($rsst);
$slno=1;
for($j=0;$j<$rows;$j++)
{
	$rt = fetcharray($rsst,$j);
	echo("<tr><td width='5%' align='center' valign='middle'>".$slno."</td>");
	echo("<td width='15%'  valign='middle'>". $rt["first_name"] . " ". $rt["last_name"] . "</td>");
	echo("<td align='center' valign='middle'>".$rt["gender"]."</td>");
	echo("<td align='center' valign='middle'>".$rt["last_qualifying_exam"]."</td>");
	echo("<td align='center' valign='middle'>".$rt["edu_board"]."</td>");
	$r1=fetcharray(execute("select state from state where id='$rt[edu_state]'"));
	echo("<td align='center' valign='middle'>".$r1["state"]."</td>");
	if($rt[nationality]==1)
	{
		if($rt[edu_state]==14)
			$k="K";
		else
			$k="NK";
	}
	else
		$k="FN";
	echo("<td align='center' valign='middle'>".$k."</td>");
	echo("<td align='center' valign='middle'>".$rt["total_percentage"]."</td>");
	echo("<td align='center' valign='middle'>".$rt["caste"]."</td>");
	$r1=fetcharray(execute("select name from category where id='$rt[cetcategory]'"));
	echo("<td align='center' valign='middle'>".$r1["name"]."</td>");
	echo("<td align='center' valign='middle'>".$rt["cetrank"]."</td>");
	$tfee=number_format($rt["tutionfee"],2,".","");
	echo("<td align='center' valign='middle'>".$tfee."</td>");
	echo("<td align='center' valign='middle'>".$rt["feerecptno"]."</td>");
	$feedt1=explode("-",$rt["feerecptdt"]);
	$feedt=$feedt1[2]."-".$feedt1[1]."-".$feedt1[0];
	echo("<td align='center' valign='middle'>".$feedt."</td>");
	echo ("<td>&nbsp;</td>");
	$slno=$slno+1;
}
?>
</table>
</body>
</html>