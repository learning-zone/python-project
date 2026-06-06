<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=1280,height=650,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function reloadMe()
{
	//alert("Hello");
	document.frm.action='student_reports_print.php';
	document.frm.submit();
}
function OpenWind3(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}
function printReport()
{
//	prn.style.display="none";
	window.print();
}
</script>
</SCRIPT>
<style type="text/css">
table.fntstyles
{ 
  font-family: Calibri;
}
</style>

</HEAD>

<body onLoad="printReport()">
<form name="frm" action="" method="post">
<?php
session_start();
require("../db1.php");

//print_r($_POST);
$academic_year=$_SESSION['AcademicYear'];

if($_GET)
{
	$sem=$_GET['sem'];	
	$subject=$_GET['subject'];	
	$class_section_id=$_GET['class_section_id'];
}

?>
<?
if($sem=='')
{
$rs_subject1=fetcharray(execute("select course_year_id from subject_m where subject_id='$subject'"));
$sem=$rs_subject1[0];
}
?>		
<?
$rs_section=fetcharray(execute("select codename,section_name from class_section where id='$class_section_id'"));
$rs_subject=fetcharray(execute("select subject_name from subject_m where subject_id='$subject'"));
$rs_grades=fetcharray(execute("select year_name from course_year where year_id='$sem'"));

?>
 <table align='center' border="0" width="90%" cellpadding="0" cellspacing="0">
    <tr>
     <td align='center' style="font-family:Calibri; font-size:22px"><b>Class Wise Section Report</b></td>
    </tr>
</table>
	<br>

 <table align='center' border="0" width="90%" cellpadding="0" cellspacing="0" class="fntstyles">
    <tr>
     <td align='center' ><b>Course&nbsp;:&nbsp;<?=$rs_grades[0]?></b></td>
    <td align='center' ><b>Subject&nbsp;:&nbsp;<?=$rs_subject[0]?></b></td>
    <td align='center' ><b>Section&nbsp;:&nbsp;<?=$rs_section[0]?>-<?=$rs_section[1]?></b></td>
    </tr>
</table>
	<br>
    <table align='center' border="1" width="90%" cellpadding="0" cellspacing="0" class="fntstyles">
    <tr>
    <td align='center' Class="head" width="5%"  nowrap><b>Sl</b></td>
    <td align='center' Class="head"  nowrap><b>Name</b></td>
    <td align='center' Class="head"  nowrap><b>Student Id</b></td>
     <td align='center' Class="head"  nowrap><b>Elective</b></td>
    <td align='center' Class="head"  nowrap><b>Course Type</b></td>
    </tr>
    <?php
	$sql123="select a.id,a.sub,a.sub_sec,b.id,b.student_id,b.first_name,b.last_name from student_course a,student_m b where a.acc_year='$academic_year' and a.stu_id=b.id and a.sub='$subject' and b.archive='N'  and a.sub_sec='$class_section_id' group by a.stu_id order by b.first_name";	
	$rs=execute($sql123);
  ?>
     <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
	  	$subjct_info=fetchrow(execute("select subject_name,sub_type,elective from subject_m where subject_id='$subject'"));
		$section_info=fetchrow(execute("select section_name,codename from class_section where sub='$subject' and id='$class_section_id' and status=1"));
		$subjct_type=fetchrow(execute("select subtype_name from subjecttype where subtype_id='$subjct_info[1]'"));
  ?>
 <tr>
	<td align="center" nowrap><?=$i?></td>
    <td nowrap>&nbsp;<?=$r1[first_name]?>&nbsp;<?=$r1[last_name]?></td>
    <td align='center' nowrap>&nbsp;<?=$r1[student_id]?></td>
    <td align="center" nowrap><?=$subjct_info[2]?></td>
	<td align="center" nowrap><?=$subjct_type[0]?></td>
  </tr><?php
 
$i++;  
}
  ?>
    </table>
</form>	
</body>
</html>
