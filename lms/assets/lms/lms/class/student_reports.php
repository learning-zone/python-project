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
	document.frm.action='student_reports.php';
	document.frm.submit();
}
function OpenWind3(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}

</SCRIPT>
</HEAD>

<body>
<form name="frm" action="" method="post">
<?php
session_start();
require("../db.php");

//print_r($_POST);
$academic_year=$_SESSION['AcademicYear'];
if(!$_POST and !$_REQUEST)
{
	$course=$_SESSION['course'];
	$sem=$_SESSION['sem'];	
}
else
{
	$course=$_POST['course'];
	$subject=$_POST['subject'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
	
}
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
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2" align="center" class="head">Student Class Reports</td>
</tr>    
<tr>
      <td>&nbsp;&nbsp;Course</td>
      <td>&nbsp;<select name="sem" onChange="reloadMe()">
<option value="">Select</option>
<?php
    $rs=execute("select year_name,year_id from course_year order by year_id");
	
    while($r=fetcharray($rs))
    {
        if($sem==$r[year_id])
        {
            echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
        }
            else
        {
            echo "<option value='$r[year_id]'>$r[year_name]</option>";
        }
    }
    ?>
</select>
</td>
</tr>
  <tr>
	<td>&nbsp;&nbsp;Subject</td><td>&nbsp;<select name="subject" onChange="reloadMe()">
	<option value="">Select Subject </option>
<?
        	$rs_sub=execute("select * from subject_m a,course_year b where a.course_year_id='$sem' and b.year_id='$sem' and a.status=1 group by a.subject_id order by b.year_id");
		
        while($r_sub=fetcharray($rs_sub))
        {
            if($subject==$r_sub[subject_id])
            	echo "<option value='$r_sub[subject_id]' selected>$r_sub[subject_name]</option>";
            else
            	echo "<option value='$r_sub[subject_id]'>$r_sub[subject_name]</option>";
		}
    ?>
</select>
</td>
</tr>
<tr>
  <td height="28">&nbsp;&nbsp;Section</td><td>&nbsp;<select name='class_section_id'  onChange="reloadMe()">
<?
$rs_section=execute("select * from class_section where status=1 and sub='$subject'  and grade='$sem'");
echo "<option value='-1'>--Select--</option>";
for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($class_section_id==$r_section[id])
	echo "<option value='$r_section[id]' selected>$r_section[codename]-$r_section[section_name]</option>";
	else
	echo "<option value='$r_section[id]'>$r_section[codename]-$r_section[section_name]</option>";

}
?>
</select>
</td>
  </tr>
</table>
<br>
    <?php
	$sql123="select a.id,a.sub,a.sub_sec,b.id,b.student_id,b.first_name,b.last_name from student_course a,student_m b where a.acc_year='$academic_year' and a.stu_id=b.id and a.sub='$subject' and a.sub_sec='$class_section_id' group by a.stu_id order by b.first_name";	
	$rs=execute($sql123);
	if(rowcount($rs)>0)
{
  ?>
   <table align='center' border="1" width="70%">
    <tr>
    <td align='center' Class="head" width="5%"  nowrap>Sl</td>
    <td align='center' Class="head"  nowrap>Name</td>
    <td align='center' Class="head"  nowrap>Student Id</td>
    <td align='center' Class="head"  nowrap>Section</td>
    <td align='center' Class="head"  nowrap>Course</td>
     <td align='center' Class="head"  nowrap>Elective</td>
    <td align='center' Class="head"  nowrap>Course Type</td>
    </tr>
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
	<td align="center" nowrap><?=$section_info[1]?>-<?=$section_info[0]?></td>
    <td align="center" nowrap><?=$subjct_info[0]?></td>
    <td align="center" nowrap><?=$subjct_info[2]?></td>
	<td align="center" nowrap><?=$subjct_type[0]?></td>
  </tr><?php
 
$i++;  
}
  ?>
    </table>
    <br>
    <div align=center>
    <a href="javascript:void(0);" onClick ="OpenWind3('student_reports_print.php?sem=<?=$sem?>&subject=<?=$subject?>&class_section_id=<?=$class_section_id?>', 'OpenWind3',800,500)">
    <INPUT TYPE="button" class='bgbutton' NAME="print" VALUE="PRINT "></a>
</div>
<?
	}
?>
</form>	
</body>
</html>
