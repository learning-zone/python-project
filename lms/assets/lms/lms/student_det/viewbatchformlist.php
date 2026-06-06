<?php
include("../db.php");

$res = mysql_query("select * from batch_master order by id");

//echo "select subject_name,subject_id from subject_m where sub_type=9 and course_id='$course' and course_year_id='$sem' ";
$res1 = mysql_query("select subject_name,subject_id from subject_m where sub_type=9 and course_id='$course' and course_year_id='$sem' ") or die(mysql_error());
?>
<html>
<head>
<script language='javascript'>
function reload()
{
	document.form.action='viewbatchformlist.php';
	document.form.submit();
}
function selectMe()
{
	i = document.form.length;
	for(j=0;j<i;j++)
	{
		if(document.form[j].Sel != "CheckBox")
		{
			flag = document.form[j].checked;
			document.form[j].checked = !flag;
		}
		if(document.form[j].SelectAll == "CheckBox")
		{
			flag = document.form[j].checked;
			document.form[j].checked = !flag;

		}
	}
}
</script>
</head>
<body>
<form name='form' method='POST' action='insert_batch_by_course.php' >
<input type='hidden' name='course' value='<?php echo $course ?>'>
<input type='hidden' name='sem' value='<?php echo $sem ?>'>
<input type='hidden' name='section' value='<?php echo $section ?>'>

<table border='0' class='forumline' align='center' width='60%'>
<tr>
	<td class='head' colspan='4' align='center'>Apply Students to Batch</td>
</tr>
<tr>
	<td>Batch </td>
	<td><select name='batch' onchange='reload()'>
		<option value='0'>select Batch</option>
		<?php
			while($row = mysql_fetch_array($res))
			{
				if($row[id]==$batch)
				{
					$sel = "selected";
				}
				else
				{
					$sel="";
				}
				echo "<option value='$row[id]' $sel>$row[batch_name]</option>";
			}
		?>
		</select>
		</td>
	<td>Subject</td>
	<td><select name='subj' onchange='reload()'>
		<option value='0'>select Subject</option>
		<?php
			while($row1 = mysql_fetch_array($res1))
			{
				if($row1[subject_id]==$subj)
				{
					$sel = "selected";
				}
				else
				{
					$sel="";
				}
				echo "<option value='$row1[subject_id]' $sel>$row1[subject_name]</option>";
			}
		?>
		</select>
		</td>
</tr>
</table>
<br>
<table border='0' class='forumline' align='center' width='80%'>
<tr>
	<td class='head' colspan='6' align='center'>Student Details</td>
</tr>
<tr>
	<td colspan='6' align='center' class='rowpic'><font size=2>Check Enable Here to Select All : </font><input type="checkbox" name="SelectAll" OnClick="selectMe()"></td>
</tr>
<tr>
	<td class='rowpic' ></td>
	<td class='rowpic' align='center'>Student_id</td>
	<td class='rowpic' align='center'>Student Name</td>
	<td class='rowpic' ></td>
	<td class='rowpic' align='center'>Student_id</td>
	<td class='rowpic' align='center'>Student Name</td>
</tr>
<?php
if($batch!=0 && $subj!=0)
{
	$var = "select id,student_id,usn,first_name,last_name from student_m where course_yearsem='$sem' and class_section_id='$section'";
	if($course!=0)
	{
		$var.=" and course_admitted=$course";
	}
	$var.=" and id not in(select student_id from batch_det where subject_id=$subj) order by first_name";
	
	//echo "$var<br>";
	$res = mysql_query($var) or dir(mysql_error());
	$count=0;
	$num = mysql_num_rows($res);
	if($num==0)
	{
		echo "<font color='blue'>All Students are already applied to this batch</font>";
		die();
	}
	for($i=1;$i<=$num;$i++)
	{

		$row=mysql_fetch_array($res);
		$count=$count+1;
		if($row[usn]!="")
		{
			$studId=$row[usn];
		}
		else
		{
			$studId = $row[student_id];
		}

		
		?>
			<td width='2%'><input type="checkbox" name="sel[]" value="<?php echo $row[id]?>" ></td>
			<td><?php echo $row[id] ?></td>
			<td><?php echo $row[first_name]." ".$row[last_name] ?></td>
		<?php
		if($count==2)
		{
			
			echo "</tr>";
			$count=0;
		}
	}
}
?>
</table>
<br>
<center>
	<input type='submit' name='submit1'  value='Save Details' class='bgbutton'>
</center>
</form>
</body>
</html>