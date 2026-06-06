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
	document.frm.action='reports_dp.php';
	document.frm.submit();
}

</SCRIPT>
</HEAD>

<body>
<form name="frm" action="" method="post">
<?php
session_start();
require("../db.php");
$accyeardet=$_SESSION['AcademicYear'];

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
$subject_id2=array_unique($subject_id);
//SUBJECT RIGHTS ENDS

if(!$_POST and !$_REQUEST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];	
}
else
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
}
$examname=$_POST['examname'];
$subject=$_POST['subject'];
$class_section_id=$_POST['class_section_id'];

?>		<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Consolidated Class Test Report (DP)</td>
    </tr>
     
  <tr>
    <td>&nbsp;<?php echo $_SESSION['branchname']; ?></td>
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
   <td>&nbsp;<?php echo $_SESSION['semname']; ?></td>
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
	<td>&nbsp;&nbsp;Select Exam</td><td>&nbsp;<select name="examname" onChange="reload()">
	<?
echo "<option value=''>--Select--</option>";
	$sql3=execute("SELECT id,exam_name FROM `dp_exam_year_m` where `class`='$sem' and status=1 ") or die(mysql_error());
	for($j=0;$j<rowcount($sql3);$j++)
	{
		$r3=fetcharray($sql3,$j);
		if($r3[0]==$examname)
		{
			echo "<option value=$r3[0] selected>$r3[1]</option>";
		}
		else
		{
			echo "<option value=$r3[0]>$r3[1]</option>";
		}
	}
?>
</select>
</td>
</tr>

<tr>
	<td>&nbsp;&nbsp;Subject Name</td><td>&nbsp;<select name="subject" onChange="reload()">
<?php
echo "<option value=''>--Select--</option>";
	$sql3=execute("select subject_id, subject_name from subject_m where course_id='$branch' and course_year_id='$sem' and status='1' order by sub_pre") or die(mysql_error());
	for($j=0;$j<rowcount($sql3);$j++)
	{
		$r3=fetcharray($sql3,$j);
		if($r3[0]==$subject)
		{
			echo "<option value=$r3[0] selected>$r3[1]</option>";
		}
		else
		{
			echo "<option value=$r3[0]>$r3[1]</option>";
		}
	}
?>
</select>
</td>
</tr>


</table>

  <?php
  if($subject=='')
  die();
  if($examname=='')
  die();
  if($class_section_id=='-1')
  die();
  if($sem=='0' || $sem=='')
	die();
  $sql123.="select id,student_id,first_name,last_name,parent_name  from student_m where id is not null and archive='N' and academic_year='$accyeardet'";
 
  
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
	
	$sql123.=" order by gender desc,first_name";
	$rs=execute($sql123) or die(mysql_error());
  ?>
  <br>
  
  
    <table width="50%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr height="25">
    <td width="10%" class="head">Sl No.</td>
    <td width="40%" align="center" class="head">Name</td>
    <td width="20%" align="center" class="head">Student Id</td>
    <td width="23%" align="center" class="head">Action</td>
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
	?><a href= "javascript:OpenWind2('reports_dp1.php?course=<?=$branch?>&sem=<?=$sem?>&subject=<?=$subject?>&examid=<?=$examname?>&studentid=<?=$r1[id]?>&class_section_id=<?=$class_section_id?>&stundetname=<?=$r1[first_name]?>&student_id=<?=$r1[student_id]?>')">Print		
</a>
&nbsp;&nbsp;
<!--<a href= "javascript:OpenWind2('reportskgword.php?course=<?=$branch?>&sem=<?=$sem?>&subject=<?=$subject?>&examid=<?=$examname?>&studentid=<?=$r1[id]?>&class_section_id=<?=$class_section_id?>&stundetname=<?=$r1[first_name]?>&student_id=<?=$r1[student_id]?>')">Export Word		
</a>--> </td> <!--<td align="center">
	<input type="checkbox" name="check[]" value="<?=$r1[id]?>" checked>
    <input type="hidden" name="stuid<?=$r1[id]?>" value="<?=$r1[student_id]?>">
     <input type="hidden" name="stuname<?=$r1[id]?>" value="<?=$r1[first_name]?>">
      <input type="hidden" name="admissionid<?=$r1[id]?>" value="<?=$r1[admission_id]?>">
    </td>-->
  </tr><?php
$i++;  }
  ?>
  
</table>
<br>
<!--<div align="center"><input type="button" name="open" value="View All" onClick="reload1()"></div>	-->			
</form>	
</body>
</html>
