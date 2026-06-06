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
	document.frm.action='ReportCard.php';
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

if(!$_POST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
else
{
	$subject=$_POST['subject'];
	$exam_id=$_POST['exam_id'];
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
	$examid=$_POST['examid'];
}
	$sql123=execute("select a.subject_id from subject_m a,exam_sub_m b where a.course_id='$branch' and a.course_year_id='$sem' and a.status='1' and  b.exam_id='$exam_id' and b.section='$class_section_id' and b.acc_year='$accyear' and b.class='$sem' and a.subject_id=b.subject_id  and a.status=1  group by b.subject_id order by a.sub_pre limit 1") or die(mysql_error());
	
	$subject1=fetchrow($sql123);
	$subject=$subject1[0];

		$course=$branch;
		$examid=$_POST['examid'];

?>		<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Report Card</td>
    </tr>
     
  <tr>
    <td>&nbsp;School Division</td>
		<td>&nbsp;<select name="branch" onChange="reload()">
			<option value="0">------Select-----</option>
				<?php
					$sql="select course_id,coursename from course_m";
					$rs=execute($sql) or die(error_description());
					for($i=0;$i<rowcount($rs);$i++)
					{
					  $r=fetcharray($rs);

						if($branch==$r[course_id])
						{
							?>
							<option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>
							<?php
						}
						else
						{
							?>
							<option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>
							<?php
						}
					}
				?>
			</select>
			</td>
		
  </tr>
  <tr>
   <td>&nbsp;Class </td>
		<td>&nbsp;<select name="sem" onChange="reload()">
			<option value='0'>-----Select----</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected> $r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'> $r[year_name]</option>";
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
$rs_section=execute("select id, exam_name, exam_sub_name from exam_year_m where acc_year='$accyear' and class='$sem' and status=1 order by order_id");
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
<tr>
	<td>&nbsp;Exam</td>
	<td>&nbsp;<select name="examid" onChange="reload()">
	<option value="0">Select </option>
<?php
	$sql2=execute("select id, exam_name, exam_sub_name from exam_sub_m where exam_id='$exam_id' and section='$class_section_id' and acc_year='$accyear' and class='$sem' and status=1 and subject_id='$subject' order by order_id");
	
	while($r2=fetcharray($sql2))
	{
		$sql3=execute("select id, exam_name, exam_sub_name from exam_sub_sub_m where exam_id='$r2[0]' and status=1 order by order_id");
		while($r3=fetcharray($sql3))
		{
			if($examid==$r3[0])
			echo "<option value=$r3[0] selected> $r2[1] -> $r3[1]</option>";
			else
			echo "<option value=$r3[0] > $r2[1] -> $r3[1]</option>";
 		
		}
	}

?>
</select>
</td>
</tr>
</table>
<br>
  <?php
  if(!$examid)
  die();
  $sql123="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N'";
	if($branch!=0)
	{
	$sql123.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql123.=" and course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
	$sql123.=" and class_section_id=$class_section_id  ";
	}
	
	$sql123.=" order by first_name";
	$rs=execute($sql123) or die(mysql_error());
  ?><br>  <table width="50%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr>
    <td width="10%" class="head" nowrap>Sl No.</td>
    <td width="40%" align="center" class="head" nowrap>Name</td>
    <td width="20%" align="center" class="head" nowrap>Student Id</td>
    <td width="23%" align="center" class="head" nowrap>Action</td>
   <!-- <td width="7%" align="center">Sel</td>-->
  </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
  echo "<tr>
    <td nowrap>&nbsp;$i</td>
    <td nowrap>&nbsp;$r1[first_name] $r1[last_name]</td>
    <td nowrap align='center'>&nbsp;$r1[student_id]</td>
    <td nowrap align='center'>&nbsp;";
	?><a href="javascript:OpenWind2('ReportCard1.php?student_id=<?=$r1['id']?>&course=<?=$branch?>&sem=<?=$sem?>&examid=<?=$examid?>&class_section_id=<?=$class_section_id?>&subject=<?=$subject?>&level=2')">
	VIEW
	
</a> </td>  </tr><?php
$i++;  }
  ?>
  
</table>
</form>	
</body>
</html>
