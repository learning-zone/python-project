<html>
<HEAD>
  <?php
	session_start();
	require("../db.php");
	
	$accyear=$_SESSION['AcademicYear'];
	
		$course=$_REQUEST['course'];
		$sem=$_REQUEST['sem'];
		$examid=$_REQUEST['examid'];
		$class_section_id=$_REQUEST['class_section_id'];
	//	$subject=$_REQUEST['subject'];
		$level=$_REQUEST['level'];
		$student_id=$_REQUEST['student_id'];
		$tablename="marks_".$accyear."_"."$sem";

//id check

	$sql123=execute("select a.subject_id from subject_m a,exam_sub_m b where a.course_id='$course' and a.course_year_id='$sem' and a.status='1' and  b.exam_id='$examid' and b.section='$class_section_id' and b.acc_year='$accyear' and b.class='$sem' and a.subject_id=b.subject_id   group by b.subject_id order by a.sub_pre limit 1") or die(mysql_error());
	
	$subject1=fetchrow($sql123);
	$subject=$subject1[0];
	
//
		if($level==2)
		{	
		
			
			$mxam=execute("select mark from exam_sub_sub_m where id='$examid'");	
			$maxmark=fetchrow($mxam);
			
			$sql1=execute("select exam_id from exam_sub_sub_m where id='$examid'");	
			$exm1=fetchrow($sql1);
			$sql2=execute("select exam_id from exam_sub_m where id='$exm1[0]' ");
			$exm2=fetchrow($sql2);
			
			$sql2=execute("select id from exam_year_m where acc_year='$accyear' and class='$sem' and status=1 order by order_id");	
			$j=1;
			while($r=fetchrow($sql2))
			{
				
				if($exm2[0]==$r[0])
				{
					$semname=$j;
					$mainid=$r[0];
				}
				$j++;			
			}
			$sql3=execute("select id from exam_sub_m where exam_id='$mainid' and subject_id='$subject' order by order_id");	
			$k=1;
			while($r1=fetchrow($sql3))
			{
				if($exm1[0]==$r1[0])
				{
					//$semname=$k;
					$subsemid=$k;
					$examsub=$r1[0];
				}
				$k++;			
			}
			$sql3=execute("select id from exam_sub_sub_m where exam_id='$examsub' order by order_id");	
			$m=1;
			while($r1=fetchrow($sql3))
			{
				if($examid==$r1[0])
				$testid=$m;
				$m++;			
			}

		}
//$examsub=$subsemid;
$examsub=1;
$newmaxmark=$maxmark[0];

?>
<SCRIPT LANGUAGE="JavaScript">
function reload()
{
	document.frm.action='updatemarks.php';
	document.frm.submit();
}
</SCRIPT>
</HEAD>

<body>
<form name="frm" action="" method="post">

<?php
echo "	<input type='hidden' name='course' value='$course'>
		<input type='hidden' name='sem' value='$sem'>
		<input type='hidden' name='examid' value='$examid'>
		<input type='hidden' name='class_section_id' value='$class_section_id'>
		<input type='hidden' name='subject' value='$subject'>
		<input type='hidden' name='level' value='$level'>
		<input type='hidden' name='student_id' value='$student_id'>";
			
		$sql123="select id,student_id,first_name,last_name from student_m where id='$student_id'";		

  	$subel=execute(" select elective from subject_m where subject_id='$subject'");
	$subel1=fetchrow($subel);
	$rs=execute($sql123) or die(mysql_error());
  ?><br>  
<div align="center"><h3><?php echo $_SESSION['SchoolName']; ?></h3>
<h4><?php echo $_SESSION['SchoolAddress']; ?></h4></div>
<br>
<table width="90%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td class="head" align="center" nowrap>Group</td>
    <td class="head" align="center" nowrap>Subject</td>
    <td class="head" align="center" nowrap>Marks(50)</td>
    <td class="head" align="center" nowrap>% Scored</td>
    <td class="head" align="center" nowrap>Grade</td>
    <td width="35%" class="head" align="center" nowrap>Remarks</td>
  </tr>
<?php
$k=1;
$query1=execute("SELECT id , group_name FROM `subject_group` where status=1 order by order_id");
while($rr1=fetcharray($query1))
{
	$query2=execute("SELECT subject_id FROM `subject_group_det` where status=1 and group_id='$rr1[0]' and sem='$sem' order by subject_id");
	while($rr2=fetcharray($query2))
	{
		
		$query3=execute("SELECT subject_name, elective FROM `subject_m` where status=1 and subject_id='$rr2[0]' and course_year_id='$sem' ");
		while($rr3=fetcharray($query3))
		{
			if($rr3[1]=='Y')
			{
				$query4=execute("SELECT id FROM `student_course` where  sub='$rr2[0]' and acc_year='$accyear' and stu_id='$student_id' group by stu_id");
				while($rr4=fetcharray($query4))
				{	
					$query5=execute("select mark, status,remarks,grade from $tablename where  student_id='$student_id' and subject_id='$rr2[0]' and sem_id='$mainid' and int_id='$examsub' and tst_id='$testid'"); 
					$row1=rowcount($query5);
					if($row1)	 	 					
					{
						while($rr5=fetcharray($query5))
						{
							echo "<tr>
							<td>&nbsp;$rr1[1]</td>
							<td>&nbsp;$rr3[0]</td>
							<td>&nbsp;$rr5[mark]</td>
							<td>&nbsp;</td>
							<td>&nbsp;$rr5[grade]</td>
							<td align='justify'>&nbsp;$rr5[remarks]</td>
						  </tr>";
						}
					}
					else
					{
							echo "<tr>
							<td>&nbsp;$rr1[1]</td>
							<td>&nbsp;$rr3[0]</td>
							<td>&nbsp;$rr5[mark]</td>
							<td>&nbsp;</td>
							<td>&nbsp;$rr5[grade]</td>
							<td align='justify'>&nbsp;$rr5[remarks]</td>
						  </tr>";

					}
				}
			}
			else
			{
					$query5=execute("select mark, status,remarks,grade from $tablename where  student_id='$student_id' and subject_id='$rr2[0]' and sem_id='$mainid' and int_id='$examsub' and tst_id='$testid'"); 	 	 					
					$row1=rowcount($query5);
					if($row1)	 	 					
					{
						while($rr5=fetcharray($query5))
						{
							echo "<tr>
							<td>&nbsp;$rr1[1]</td>
							<td>&nbsp;$rr3[0]</td>
							<td>&nbsp;$rr5[mark]</td>
							<td>&nbsp;</td>
							<td>&nbsp;$rr5[grade]</td>
							<td align='justify'>&nbsp;$rr5[remarks]</td>
						  </tr>";
						}
					}
					else
					{
							echo "<tr>
							<td>&nbsp;$rr1[1]</td>
							<td>&nbsp;$rr3[0]</td>
							<td>&nbsp;$rr5[mark]</td>
							<td>&nbsp;</td>
							<td>&nbsp;$rr5[grade]</td>
							<td align='justify'>&nbsp;$rr5[remarks]</td>
						  </tr>";

					}
			}
		$k++;
		}	

	}	
}
?>
   <tr>
    <td>Attendance</td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td>No. Of Detentions</td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td height="22">Conduct</td>
    <td colspan="5" align="justify">&nbsp;</td>
  </tr>
  <tr>
    <td>Behaviour</td>
    <td colspan="5" align="justify">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="6">Grade Threshold<br>
    A*=90-100 A=80-89 B=70-79 C=60-69 D=50-59 E=40-49 NA= Grade not awarded</td>
  </tr>
</table>

</form>	
</body>
</html>

