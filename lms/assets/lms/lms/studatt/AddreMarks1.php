<?php
include("../db.php");

if($course>=0)
	{
		
		$table = "marks"."_".$course."_".$sem;
		if($batch==0)
		{
			if($elective=='Y')
			{
					$var = "select a.id as stud_id,a.student_id,a.usn,a.first_name,a.last_name,b.student_id from student_m a,elective b";
					$var.=" where b.subject_id='$subj_id' and a.id=b.student_id and a.course_admitted='$course' and course_yearsem='$sem'";
					$var.=" and class_section_id='$section' and a.id not  in (select studid from marks_".$course."_".$sem.") order by first_name";
			}
			else
			{
				$var = "select id as stud_id,student_id,usn,first_name,last_name from student_m where course_admitted='$course' ";
				$var.=" and course_yearsem='$sem' and class_section_id='$section' order by first_name";
			}
		}
		else
		{
			$var = "select a.id as stud_id,b.id,b.usn,b.first_name,b.last_name from batch_det a,student_m b where ";
			$var.= "a.batch_id='$batch' and a.subject_id='$subj_id' and b.course_yearsem='$sem' and b.class_section_id='$section'";
			$var.=" and b.course_admitted='$course' and a.student_id=b.id order by b.first_name";
		}
		$res = execute($var) or die(mysql_error());
		$num = rowcount($res);
		if($course==0)
		$courseName='First YEAR';
		else
		{
			$cr=fetcharray(execute("select coursename from course_m where course_id='$course'"));
			$courseName = $cr[0];
		}
	}


$sec = fetchrow(execute("select section_name from class_section where id='$section'"));
$subjectName = fetchrow(execute("select subject_name,subject_code,total_marks from subject_m where subject_id='$subj_id'"));
function getsem($i)
{
	$yr=fetcharray(execute("select year_name from course_year where year_id='$i'"));
	return $yr[0];
}
?>
<html>
<head>
<script language='javascript'>
function reloadMe()
{
	document.form.action='AddreMarks1.php';
	document.form.submit();
}
</script>
</head>
<body>
<form name='form' method='POST' action='AddreMarks2.php'>
<input type='hidden' name='course' value='<?php echo $course ?>'>
<input type='hidden' name='sem' value='<?php echo $sem ?>'>
<input type='hidden' name='section' value='<?php echo $section ?>'>
<input type='hidden' name='subj_id' value='<?php echo $subj_id ?>'>
<input type='hidden' name='StudClass' value='<?php echo $StudClass ?>'>
<input type='hidden' name='batch' value='<?php echo $batch ?>'>


<table border='2' align='center' width='80%' class='forumline' cellspacing='2' cellpadding='0'>
<tr>
	<td colspan='4' class='head' align='center'>Add  Remarks</td>
</tr>
<tr height='25'>
	<td colspan='4'>
		<font color='blur' size="+1">Curriculam : <?php echo $courseName ?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<font color='blur'  size="+1">Class : <?php echo getSem($sem) ?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<font color='blur'  size="+1">Section : <?php echo $sec[0] ?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 <font color='blur'  size="+1">Subject/Code :<?php echo $subjectName[0]."/".$subjectName[1] ?></font>
	</td>
 </tr>
 
</table>
<br>
<table border='0' class='forumline' align='center' width='80%'  cellspacing='2' cellpadding='0'>
<tr>
	<td class='rowpic' align='center'>Stud ID</td>
	<td class='rowpic' align='center'>Name</td>
	<td class='rowpic' align='center'>Remarks</td>
	<td class='rowpic' align='center'>Stud ID</td>
	<td class='rowpic' align='center'>Name</td>
	<td class='rowpic' align='center'>Remarks</td>
	
</tr>
<tr>
<?php

	$count=0;
	for($i=1;$i<=$num;$i++)
	{
		$qry=execute("select Sessional_ID from Sessional_Master where Sessional_Name='$test'");
		$rw=fetcharray($qry);
		$session=explode('SL',$rw[0]);
	    $row = fetcharray($res);
		$count = $count + 1;
		if($row[usn]!=0)
		{
			$stud_id=$row[usn];
		}
		else
		{
			$stud_id=$row[student_id];
		}
	
		$str=execute("select remks from $table where studid='$row[stud_id]' and subid='$subj_id' and accyr='$ayear'");
		
		
	
		$row1=fetcharray($str);
		?>	
	
				<input type='hidden' name='att[]' value='<?php echo $row[stud_id] ?>'>
				<td nowrap align='center' >&nbsp;&nbsp;<?php echo $stud_id  ?>&nbsp;&nbsp;</td>
				<td nowrap>&nbsp;&nbsp;&nbsp;<?php echo $row[first_name].".".$row[last_name] ?></td>
				<td nowrap align='center'>
				<textarea rows="2" cols="20" name="remks[]"><?php echo $row1[remks] ?></textarea>
			   </td>
			
		<?php
		if($count==2)
		{
			echo "</tr>";
			$count=0;
		}
	}
		if($count!=0)
		echo "<td colspan=6></td></tr>";

?>

</table>
<br>
<br>

<?php
if(rowcount($str)>0)
{
	?>
	<center>
		<input type='submit' name='submit1' value='Modify ReMarks' class='bgbutton'>
	</center>
	<?php
}
else
{
	?>
	<center>
	<input type='submit' name='submit1' value='Add ReMarks' class='bgbutton'>
	</center>
	<?php
}
?>
</form>
</body>
</html>
