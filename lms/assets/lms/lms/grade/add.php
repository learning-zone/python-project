<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function reload()
{
	document.frm.action='add.php';
	document.frm.submit();
}

function refresh()
{
	document.frm.action='add.php';
	document.frm.submit();
}

</SCRIPT>
</HEAD>

<body>
<form name="frm" action="" method="post">
<?php
session_start();
require("../db.php");
$accyear=$_SESSION['AcademicYear'];


// SUBJECT RIGHTS STARTS
	$user=$_SESSION['user'];
	
$sql21=execute("select a.curri_type, a.grade,	a.sect from class_teacher a,users b where b.username='$user' and a.teacher=b.srid order by a.curri_type, a.grade");

$sql=execute("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID order by a.course_id, a.year_id, a.subject_id");
	if(rowcount($sql)==0 and rowcount($sql21)==0)
	{
		echo die("You don't have rights"); 
	}
if(rowcount($sql21)!=0)
{
	while($r12=fetcharray($sql21))
	{
		$branch1[]=$r12[0];
		$br=$r12[0];
		$yearname1[]=$r12[1];
		$sm1=$r12[1];
		$sql5=execute("select subject_id from subject_m where course_id='$br' and course_year_id='$sm1' and	status=1 order by sub_pre");
		while($r=fetcharray($sql5))
		{
			$subject_id[]=$r[0];
		}
	}
}

$sql=execute("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID order by a.course_id, a.year_id, a.subject_id");
if(rowcount($sql)!=0)
{
	while($r12=fetcharray($sql))
	{
		$branch1[]=$r12[0];
		$yearname1[]=$r12[2];
		$subject_id[]=$r12[1];
	}
}

$branch2=array_unique($branch1);
$yearname2=array_unique($yearname1);
asort($yearname2);
$subject_id2=array_unique($subject_id);
//SUBJECT RIGHTS ENDS






if(!$_POST)
{
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
else
{
	$subject=$_POST['subject'];
	$exam_id=$_POST['exam_id'];
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
}
?>		<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">ADD MARKS</td>
    </tr>
<tr>
<td width="40%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td><td>&nbsp;<select name="course" onChange="reload()">
<option value=''>-- Select --</option>
<?php
	while (list(, $value) = each($branch2)) 
	{
		$j=$value;
		$sql1="select coursename from course_m where course_id='".$j."' order by course_id";
		$sqlname=fetchrow(execute($sql1));
		if($j==$course)
		{
			echo "<option value='$j' selected>$sqlname[0]</option>";
		}
		else
		{
			echo "<option value='$j'>$sqlname[0]</option>";
		}
	}

?>
</select></td></tr>

<tr>
      <td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
      <td>&nbsp;<select name="sem" onChange="reload()">
<option value="">Select</option>
<?php
	while (list(, $value) = each($yearname2)) 
	{
		$j=$value;
		$sql1="select year_name from course_year where year_id='".$j."' and head_id='".$course."' order by year_id";
		$sqlname=fetchrow(execute($sql1));
		if($j==$sem)
		{
			echo "<option value='$j' selected>$sqlname[0]</option>";
		}
		else
		{
			echo "<option value='$j'>$sqlname[0]</option>";
		}
	}
?>
</select>
</td>
</tr>
  <tr>
  <td height="28">&nbsp;Section</td><td>&nbsp;<select name='class_section_id'  onChange="reload()">
<?
$rs_section=execute("SELECT a.id, a.section_name FROM class_section a,student_m b where a.id=b.class_section_id group by b.class_section_id");
echo "<option value='-1'>--Select--</option>";
for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($class_section_id==$r_section[id])
	echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";
	else
	echo "<option value='$r_section[id]'>$r_section[section_name]</option>";

}
?>
</select>
</td>
  </tr>
  <tr>
  <td height="28">&nbsp;Term/Sem</td>
  <td>&nbsp;<select name='exam_id'  onChange="reload()">
<?
$rs_section=execute("select id, exam_name, exam_sub_name from igc_exam_year_m where acc_year='$accyear' and class='$sem' and status=1 order by order_id");
echo "<option value='-1'>--Select--</option>";
for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($exam_id==$r_section[id])
	echo "<option value='$r_section[id]' selected>$r_section[exam_name]</option>";
	else
	echo "<option value='$r_section[id]'>$r_section[exam_name]</option>";

}
?>
</select>
</td>
  </tr>
    <?
$exmname=execute("select id from igc_exam_sub_m where exam_id='$exam_id'");
$exmnamst=fetcharray($exmname);
  ?>

<tr>
	<td>&nbsp;Subject Name</td><td>&nbsp;<select name="subject" onChange="reload()">
	<option value="">Select Subject </option>
<?php
	while (list(, $value) = each($subject_id2)) 
	{
		$j=$value;
		$sql1="select subject_name from subject_m where subject_id='".$j."' and course_id='".$course."' and course_year_id='".$sem."'";
		$sqlname=fetchrow(execute($sql1));
		if($sqlname[0])
		{
			if($j==$subject)
			{
				echo "<option value='$j' selected>$sqlname[0]</option>";
			}
			else
			{
				echo "<option value='$j'>$sqlname[0]</option>";
			}
		}
	}
?>
</select>
</td>
</tr>
</table>
<br>
<?
if(!$subject)
die();
?>
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
<tr>
    <td align='center' class='head' colspan="2">Exam Master</td></tr>  
			  <tr>
				<td width="50%" align="left" class=''>&nbsp;&nbsp;<a href="javascript:OpenWind2('updatemarks.php?course=<?=$course?>&sem=<?=$sem?>&class_section_id=<?=$class_section_id?>&subject=<?=$subject?>&level=2&examid=<?=$exam_id?>')">ADD</a>
                </td>
    </table>
</form>	
</body>
</html>
