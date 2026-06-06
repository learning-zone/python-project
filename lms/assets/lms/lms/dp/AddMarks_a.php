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

	document.frm.action='AddMarks_a.php';

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

echo "<option value=''>--Select--</option>";

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

$rs_section=execute("select id, exam_name, exam_sub_name from dp_exam_year_m where class='$sem' and status=1 order by order_id");

echo "<option value=''>--Select--</option>";

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

	<td>&nbsp;Subject Name</td><td>&nbsp;<select name="subject" onChange="reload()">

	<option value="">Select Subject </option>

<?php

	$sql3=execute("select a.subject_id, a.subject_name from subject_m a,dp_exam_sub_sub_m b where a.course_id='$course' and a.course_year_id='$sem' and a.status='1' and  b.masterexam='$exam_id' and b.class='$sem' and a.subject_id=b.sub_id  and a.status=1  group by b.sub_id order by a.sub_pre ") or die(mysql_error());

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

<br>

<?php
$subject=$_POST['subject'];

	
if($subject=='0' ||  $subject=='' )
{
die();
}
?>

<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">

<tr>

    <td align='center' class='head'>Exam Master</td></tr>  



<?php



	$sql2=execute("select id, exam_name, exam_sub_name from dp_exam_sub_m where exam_id='$exam_id' and section='$class_section_id' and class='$sem' and status=1 order by order_id");

	

	while($r2=fetcharray($sql2))

	{

		

		$sql3=execute("select id, exam_name,mark exam_sub_name from dp_exam_sub_sub_m where exam_id='$r2[0]' and status=1 and sub_id='$subject' order by order_id");

		 $num_rows = rowcount($sql3);



			echo "<tr>

    <td align='' class='row3'>$r2[1]</td></tr>";

		

		while($r3=fetcharray($sql3))

		{

			?>

          <tr>

    		<td align='' class=''><a href="javascript:OpenWind2('updatemarks.php?course=<?=$course?>&sem=<?=$sem?>&exam1=<?=$exam_id?>&exam2=<?=$r2[0]?>&exam3=<?=$r3[0]?>&class_section_id=<?=$class_section_id?>&subject=<?=$subject?>&level=2')"><?=$r3[1]?></a></td></tr>

		<?php
 		

		}

	}









?>				



    </table>

</form>	

</body>

</html>

