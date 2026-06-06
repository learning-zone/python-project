<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function reload()
{
	document.frm.action='add_Comments.php';
	document.frm.submit();
	
}

</SCRIPT>
</HEAD>

<body>
<?php 
session_start();
require("../db.php");
	$a_year=$_SESSION['AcademicYear'];

	$user=$_SESSION['user'];

	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$class_section_id=$_REQUEST['class_section_id'];
	$subject=$_REQUEST['subject'];
	$subject_type=$_REQUEST['subject_type'];
	$subname=$_REQUEST['subname'];
	$sess=$_REQUEST['sess'];

$tablename="comments";
$sysdate=date("Y-m-d");
$sql21=execute("select a.curri_type, a.grade,	a.sect from class_teacher a,users b where b.username='$user' and a.teacher=b.srid");
while($r12=fetcharray($sql21))
{
	$branch1=$r12[0];
	$sem1=$r12[1];
	$class_section_id1=$r12[2];
}
if(rowcount($sql21)==0)
{
	echo "<blink><b><font color=''>Only class teacher can take attendance  !!!!</font></blink></b><br>";
	die();
}
if($_POST['open'])
{
	$comments=$_POST['comments'];
	$studentid=$_POST['studentid'];
	for($i=0;$i<sizeof($studentid);$i++)
	{
		$newcomment=$comments[$i];
		$sql5=execute(" select id from `comments` where `class`='$sem' and student_id='$studentid[$i]' and section_id='$class_section_id' and subject_id='$subject'");
		if(rowcount($sql5)>0)
		{
			
				$sql1="update comments set Description='$newcomment' where `class`='$sem' and student_id='$studentid[$i]' and section_id='$class_section_id' and subject_id='$subject' ";
			
		}
		else
		{
			
			$sql1="INSERT INTO `comments` (`class`, `acc_year`, `subject_id`, `section_id`, `student_id`, `Description`, `sys_date`, `status`, `username`) VALUES ('$sem', '$a_year', '$subject', '$class_section_id', '$studentid[$i]', '$newcomment', '$sysdate', 1, '$user')";
		}		
	execute($sql1);	
	}
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Comment Updated Successfully");
	</SCRIPT>
	<?php
}
	

?>		<form name="frm" action="" method="post" >
<input type="hidden" name="subname" value="<?=$subname?>">
<input type="hidden" name="branch" value="<?=$branch?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="class_section_id" value="<?=$class_section_id?>">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="sess" value="<?=$sess?>">
<br>
  <?php
  if($branch=='0')
	die();
	if($sem=='0')
	die();
	if($class_section_id=='')
	die();
   $sql123.="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N'  and academic_year='$a_year' ";
	if($branch!=0)
	{
	$sql123.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql123.=" and course_yearsem=$sem";
	}
	if($class_section_id!='-1')
	{
	$sql123.=" and class_section_id=$class_section_id  ";
	}
	
	$sql123.=" order by first_name";
	
	$rs=execute($sql123) or die(mysql_error());
  ?><br>  <table width="70%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
    <tr height="25">
    <td colspan="4" align="center" class="head"> Comment For <?=$subname?></td>
  </tr>
  <tr>
    <td width="" class="row3" nowrap>Sl No.</td>
    <td width="" align="center" class="row3" nowrap>Name</td>
    <td width="" align="center" class="row3" nowrap>Student Id</td>
    <td width="" align="center" class="row3" nowrap>Comment</td>

  </tr>
  <?php
  $i=1;
while($r1=fetcharray($rs))
{ 
	 
	$elective=fetchrow(execute("select elective FROM `subject_m` where subject_id='$subject'"));
	if($elective[0]=="N")
	{
		$sql5=execute("select Description from `comments` where `class`='$sem' and student_id='$r1[id]' and section_id='$class_section_id' and subject_id='$subject'");
		
		$desce=fetchrow($sql5);
		
		echo "<tr>
		<td nowrap>&nbsp;$i&nbsp;</td>
		<td nowrap>&nbsp;$r1[first_name] $r1[last_name]&nbsp;</td>
		<td nowrap align='center'>&nbsp;$r1[student_id]&nbsp;</td>
		";
		?>
		<td align="center">&nbsp;
		<textarea rows="3" cols="70" name="comments[]"><?=$desce[0]?></textarea>&nbsp;
		<input type="hidden" name="studentid[]" value="<?php echo $r1[id]; ?>" >
		</td>
		</tr>
		<?php
		$i++;  
	}
	else
	{
		$stu=fetchrow(execute("select id FROM `student_course` where class='$sem' and sub_sec='$class_section_id' and sub='$subject' and stu_id='$r1[id]'"));
		if($stu[0])
		{
			$sql5=execute("select Description from `comments` where `class`='$sem' and student_id='$r1[id]' and section_id='$class_section_id' and subject_id='$subject'");
			
			$desce=fetchrow($sql5);
			
			echo "<tr>
			<td nowrap>&nbsp;$i&nbsp;</td>
			<td nowrap>&nbsp;$r1[first_name] $r1[last_name]&nbsp;</td>
			<td nowrap align='center'>&nbsp;$r1[student_id]&nbsp;</td>
			";
			?>
			<td align="center">&nbsp;
			<textarea rows="3" cols="70" name="comments[]"><?=$desce[0]?></textarea>&nbsp;
			<input type="hidden" name="studentid[]" value="<?php echo $r1[id]; ?>" >
			</td>
			</tr>
			<?php
			$i++;  
		}
	}
}
?>
  
</table>
<br>				
<div align="center"><input type="submit" name="open" value="UPDATE" class="bgbutton" ></div><br>
</form>	
</body>
</html>
