<html>
<head>
<script language='javascript'>
function printReport()
{
	prn.style.display='none';
	print(this.form);
	prn.style.display='';

}
</script>
</head>
<?php
include("../db.php");
$cour = $_POST['cour'];
$year = $_POST['year'];
$sec = $_POST['sec'];
?>
<table align='center' class='forumline' width="90%" border="1">
<?
$whp=fetcharray(execute("select coursename from course_m where course_id='$cour'"));
$whp1=fetcharray(execute("select year_name from course_year where year_id='$year'"));
?>
<tr><td class='head' align='center' colspan='3'>View Staff Rights For  <?=$whp1[0] .",".$whp[0]?></td></tr>
<tr>
<td class="rowpic">SLNO</td>
<td class="rowpic">STAFF NAME </td>
<td class="rowpic">SUBJECT NAME</td></tr>
<?
$sub=execute("select distinct(a.subject_id),a.* from staff_rights a where a.course_id='$cour' and a.year_id='$year' and a.class_section_id='$sec' group by a.subject_id,a.staffid");
$t=1;
$i=0;
while($ss=fetcharray($sub))
{ 
if($i%2)
		echo "        <tr class='clsname'> ";
		else
		echo "        <tr> ";
$i++;
echo "<td align='center' width='10%'>$t</td>";
$wwdn=execute("select f_name,s_name from staff_det where slno='$ss[StaffID]'");
$bb=fetcharray($wwdn);
echo "<td width='25%'>&nbsp;&nbsp;&nbsp;&nbsp;$bb[0] &nbsp;$bb[1]</td>";
$bmp=execute("select subject_name from subject_m where subject_id='$ss[subject_id]'");
$zzb=fetcharray($bmp);
	echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$zzb[0]</td>";
$t++;
}
echo "</tr>";
?>
</table><br>
<div align='center' id='prn'>
<input type='button' name='print' value='PRINT THE REPORT' onclick='printReport()' class='bgbutton'></div>

</html>
