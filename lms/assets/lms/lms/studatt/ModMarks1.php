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
	document.form.action='ModMarks1.php';
	document.form.submit();
}
function valid(id)
{
	var marks= <?php echo $subjectName[2] ?>;
	
	var obt_mark = document.getElementsByName("mark" + id)[0].value;
	if(obt_mark>marks)
	{
		alert("Enter Marks is more than total marks of " + marks);
		document.getElementsByName("mark" + id)[0].value="";
	}
}
</script>
</head>
<body>
<?php
if($course==0)
		{
			$table1 = "marks_0_".$sem;
		}
else
		{
			$table1 = "marks_".$course."_".$sem;
		}
		$str=execute("select distinct(accyr) from $table1 where subid='$subj_id'");
		if(rowcount($str)>0)
		{
?>
<form name='form' method='POST' action='AddMarks2.php'>
<input type='hidden' name='course' value='<?php echo $course ?>'>
<input type='hidden' name='sem' value='<?php echo $sem ?>'>
<input type='hidden' name='section' value='<?php echo $section ?>'>
<input type='hidden' name='subj_id' value='<?php echo $subj_id ?>'>
<input type='hidden' name='StudClass' value='<?php echo $StudClass ?>'>
<input type='hidden' name='batch' value='<?php echo $batch ?>'>

<table border='2' align='center' width='80%' class='forumline' cellspacing='2' cellpadding='0'>
<tr>
	<td colspan='4' class='head' align='center'>Modify I/A Marks</td>
</tr>
<tr height='25'>
	<td colspan='4'>
		Course : <font color='blur'><?php echo $courseName ?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Sem : <font color='blur'><?php echo getSem($sem) ?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Section : <font color='blur'><?php echo $sec[0] ?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Subject/Code : <font color='blur'><?php echo $subjectName[0]."/".$subjectName[1] ?></font>
	</td>
 </tr>
 <tr height='25'>
	<td colspan='1' width='40%'>
		Academic Year  :
		<select name="ayear" onchange='reloadMe()'>
		 <option value="">Select Academic Year</option>";
		<?php
		   $yr=date('Y');
		 while($y=fetcharray($str))
		  {
			 $yr=$y[accyr]+1;
			  if($y[accyr]== $ayear)
			  {
				  $sel = "selected";
			  }
			  else
			  {
				  $sel = "";
			  }
			  echo "<option value='$y[accyr]' $sel>$y[accyr]-$yr</option>";
		  }
		?>
		</select>	
	</td>
	<td colspan='2'>
		Sessionals:<font color='blur'> <?php echo $adate ?></font>
		<select name="test" onchange='reloadMe()'>
		 <option value="">Select Sessional </option>";
		<?php 
			$sessional = execute("select distinct(Sessional_Name) from Sessional_Master where course_ID='$course' and Course_Year_ID='$sem' and Academic_Year='$ayear'");
			while($row_ses = fetchrow($sessional))
			{
				if($test==$row_ses[0])
				{
					$sel1 = "selected";
				}
				else
				{
					$sel1 = "";
				}
				echo "<option value='$row_ses[0]' $sel1>$row_ses[0]</option>";
			}
		?>
		</select>
	</td>
</tr>
</table>
<br>
<table border='0' class='forumline' align='center' width='80%' class='forumline' cellspacing='2' cellpadding='0'>
<tr>
	<td class='rowpic' align='center'>Stud ID</td>
	<td class='rowpic' align='center'>Name</td>
	<td class='rowpic' align='center'>Marks</td>
	<td class='rowpic' align='center'>Stud ID</td>
	<td class='rowpic' align='center'>Name</td>
	<td class='rowpic' align='center'>Marks</td>
	<td class='rowpic' align='center'>Stud ID</td>
	<td class='rowpic' align='center'>Name</td>
	<td class='rowpic' align='center'>Marks</td>
</tr>
<tr>
<?php

	$count=0;
	for($i=1;$i<=$num;$i++)
	{
		$qry=execute("select Sessional_ID from Sessional_Master where Sessional_Name='$test'");
		$rw=fetcharray($qry);
		$session=explode('SL',$rw[0]);
		$x='assmk'.$session[1];


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
		if($Course==0)
		{
			$table1 = "marks_0_".$sem;
		}
		if($course!=0)
		{
			$table1 = "marks_".$course."_".$sem;
		}
		//echo "select $x from $table1 where studid='$row[stud_id]' and subid='$subj_id' and accyr='$ayear'";
		$str=execute("select $x from $table1 where studid='$row[stud_id]' and subid='$subj_id' and accyr='$ayear'");
		$row1=fetcharray($str);
		?>	
	
				<input type='hidden' name='att[]' value='<?php echo $row[stud_id] ?>'>
				<td align='center' ><?php echo $stud_id  ?></td>
				<td>&nbsp;&nbsp;&nbsp;<?php echo $row[first_name].".".$row[last_name] ?></td>
				<td align='center'>
			<input type='text' name='mark<?php echo $row[stud_id] ?>' value='<?=$row1[$x]?>' size='3'  onblur="valid('<?php echo $row[stud_id] ?>')">

				</td>
			
		<?php
		if($count==3)
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
<?php
if($ayear!=""&& $test!="")
{
		if($num==0)
		{
			echo "<font color='blur' size='3' ><center><blink>Marks Already Entered</blink></center></font>";
			die();
		}
}
else
{
	echo "<font color='blur' size='3' ><center><blink>Please Select Academic Year & Sessionals</blink></center></font>";
}

?>
<br>
<center>
	<input type='submit' name='submit1' value='Modify Marks' class='bgbutton'>
</center>


</form>
<?
}
else
die("<font color='red'><b>Internal Marks not Added</b></font>");
?>
</body>
</html>
