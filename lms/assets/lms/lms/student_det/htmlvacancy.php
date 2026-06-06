<html>
<head>
<?php
session_start();
require("../db.php");
?>
<script language="javascript">
function Print()
{
	prn.style.display="none";
	window.print(this.form);
	prn.style.display="";
}
</script>
</head>
<body>
<form name="frm">
<?php
$sql2 = "select * from admission where id = $AdmName";
$rs2 = execute($sql2);
$r2 = fetcharray($rs2);
$amd = $r2["name"];
$sql2 = "select col_name from college ";
$rs2 = execute($sql2);
$r2 = fetcharray($rs2);
$colname = $r2["col_name"];
?>
<table align=center class=forumline>
<tr><td align="center" class='head' colspan=5 nowrap>Name of the College : <b><?=$colname?>, Bangalore</b></td></tr>
<tr><td align="center" class=row3 colspan=5><b>Statement of Vacancy</b></td></tr>
<tr><td align="center" class=row3 colspan=5 nowrap><b>List of Students Admitted under <?=$amd?> quota During the Year <?=$acayr?> - <?=($acayr+1)?>.</b></td></tr>
<tr><td align="center" class=rowpic rowspan=2><b>SL.NO.</b></td>
<td  align="center" class=rowpic rowspan=2><b>Course</b></td>
<td align="center" colspan=3 class=rowpic><b><font color=blue><?=$amd?></font></b></td></tr>
<tr><td align="center" class=rowpic><b>Intake</b></td><td align="center" class=rowpic><b>Admitted</b></td><td align="center" class=rowpic><b>Vacancy</b></td></td></tr>
<?php
$sql1 =mysql_query("SELECT * FROM course_m WHERE head_id='$ctype' order by course_id");
$counttemp=1;
$intaktotal=0;
$admittotal=0;
$vactotal=0;
while($row=mysql_fetch_array($sql1))
{
$sql2=mysql_query("select intake from intake where course_id='$row[course_id]' and quota='$AdmName' and course_year_id='$acayr'");
$intakedet=mysql_fetch_row($sql2);
$sql3=mysql_query("select count(id) from student_m where course_admitted='$row[course_id]' and admission_type='$AdmName' and academic_year='$acayr' and course_yearsem in (1,2) and archive='N'");
$stintakedet=mysql_fetch_row($sql3);
if($counttemp<10)
	$counttemp="0".$counttemp;
echo "<tr><td align='center'>$counttemp</td>
<td>$row[coursename]</td>
<td align=right>$intakedet[0]&nbsp;&nbsp;</td>
<td align=right>$stintakedet[0]&nbsp;&nbsp;</td>
<td align=right>";
$tempval=$intakedet[0]-$stintakedet[0];
echo "$tempval&nbsp;&nbsp;</td>
</tr>";
$intaktotal=$intaktotal+$intakedet[0];
$admittotal=$admittotal+$stintakedet[0];
$vactotal=$vactotal+$tempval;
$counttemp++;
}
?>
<tr><td align=right colspan=2>TOTAL</td>
<td align=right><font color=blue><?=$intaktotal?>&nbsp;&nbsp;</font></td>
<td align=right><?=$admittotal?>&nbsp;&nbsp;</td>
<td align=right><font color=red><?=$vactotal?>&nbsp;&nbsp;</font></td>
</table><br><br>
<div id="prn" align=center>
<input type="button" class=bgbutton value="<< Print >>" onClick="Print()"></div>
</form>
</body>
</html>