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
	document.frm.action='remark.php';
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

if(!$_POST and !$_REQUEST)
{
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];	
}
else
{
	$course=$_POST['course'];
	$sem=$_POST['sem'];
}
$examname=$_POST['examname'];
$class_section_id=$_POST['class_section_id'];
$subject=$_POST['subject'];

?>		<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Add Other Detail</td>
    </tr>
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
$rs_section=execute("select * from class_section");
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
	<td>&nbsp;Subject Name</td><td>&nbsp;<select name="subject" onChange="reload()">
	<option value="0">Select Subject </option>
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
    <tr>
    <td>&nbsp;Select Exam</td>
  <?php
$rs_ec=execute("select id, exam_name from dp_exam_sub_m where class='$sem'");
?>
    <td>&nbsp;<select name='examname' onChange="reload()">
<?
echo "<option value=''>--Select--</option>";
for($i=0;$i<rowcount($rs_ec);$i++)
{
	$r_sec=fetcharray($rs_ec,$i);
	if($r_sec['id']==$examname)
	echo "<option value='$r_sec[id]' selected>$r_sec[exam_name]</option>";
	else
	echo "<option value='$r_sec[id]'>$r_sec[exam_name]</option>";

}
?>
</select></td>
  </tr>
</table>

  <?php
  if($examname=='')
  die();

  if($class_section_id=='-1')
  die();
  if($sem=='0' || $sem=='')
	die();
  $sql123.="select id,student_id,first_name,last_name from student_m where id is not null and archive='N' and academic_year='$accyear'";
	if($course!=0)
	{
	$sql123.=" and course_admitted=$course";
	}
	if($sem!=0)
	{
	$sql123.=" and course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
	$sql123.=" and class_section_id=$class_section_id  ";
	}
	
	$sql123.=" order by gender desc,first_name";
	$rs=execute($sql123) or die(mysql_error());
  ?><br>  <table width="50%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr>
   <td width="10%"  align="center" class="head">&nbsp;Sl No.</td>
    <td width="40%" align="center" class="head">&nbsp;Name</td>
    <td width="27%" align="center" class="head">&nbsp;Student Id</td>
    <td width="23%" align="center" class="head">&nbsp;Action</td>
  </tr>
    <?
  //exam type
$exmname2=execute("select examtype from dp_exam_sub_m where id='$examname'");
$exmnamst=fetcharray($exmname2);
  ?>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
  echo "<tr height='25'>
    <td align='center' nowrap>$i</td>
    <td nowrap>&nbsp;&nbsp;$r1[first_name]</td>
    <td nowrap align='center'>&nbsp;$r1[student_id]</td>";
	
		if($exmnamst[0]=='1')
		{
		?>
    <td nowrap align='center'>&nbsp;<a href= "javascript:OpenWind2('remark1.php?course=<?=$course?>&sem=<?=$sem?>&examid=<?=$examname?>&studentid=<?=$r1[id]?>&class_section_id=<?=$class_section_id?>&subject=<?=$subject?>&stundetname=<?=$r1[first_name]?>&student_id=<?=$r1[student_id]?>')">ADD MARKS		
</a>
    </td></tr><?php
		}
		if($exmnamst[0]=='2')
		{
		?>
        <td nowrap align='center'>&nbsp;<a href= "javascript:OpenWind2('end_remark1.php?course=<?=$course?>&sem=<?=$sem?>&examid=<?=$examname?>&studentid=<?=$r1[id]?>&class_section_id=<?=$class_section_id?>&subject=<?=$subject?>&stundetname=<?=$r1[first_name]?>&student_id=<?=$r1[student_id]?>')">ADD MARKS		
</a>
    </td></tr>
        <?	
		}
$i++;  }
  ?>
</table>
</form>	
</body>
</html>
