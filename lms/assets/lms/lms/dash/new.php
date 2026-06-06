<?php
	session_start();
	include("../db.php");
	
	$fdate=$_GET['adate'];
	
	$tdate=$_GET['adate'];

?>
<html>
<head>
<title>MySchool</title>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<Script language="JavaScript">

	function RefreshMe(val)
	{
		document.frm.action="teacher_lesson_plan_update.php";
		document.frm.submit();
	}
	function frmsub1(val)
	{
		document.frm.action="teacher_lesson_plan_update.php?action=del&idval="+val;
		document.frm.submit();

	}

function OpenWind3(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
	
</script>
</head>
<body class='bodyline'>
<form method="post" name="frm" ENCTYPE='multipart/form-data'>
<table align='center' class='forumline' cellpadding="10" cellspacing="10" border=1 width='90%' >
<?php
	$user=$_SESSION['user'];
	$academicYear=$_SESSION['AcademicYear'];
	$sem=$_SESSION['sem'];
	$studentdet=fetcharray(execute("select id, class_section_id from student_m where student_id='$user'"));
	$class_section=$studentdet[1];
	$studentid=$studentdet[0];
	$subel=execute(" select subject_id, subject_name, elective, sub_type from subject_m where course_year_id='$sem'");
$k=1;
while($r122=fetcharray($subel))
{
	$subject=$r122['subject_id'];
	$subject_type=$r122['sub_type'];
	$flag=1;
	if($r122['elective']=='Y')
	{
		$sql123=rowcount(execute("select id from student_course  where stu_id='' and sub='$subject' and acc_year='$accyear'"));
		if(!$sql123)
		$flag=0;
	}
	
	$subject_id_dis=fetchrow(execute("select subject_name from subject_m where subject_id='$subject'"));
	$subject_type_dis=fetchrow(execute("select subtype_name from subjecttype where subtype_id='$subject_type'"));
	$section_name=fetchrow(execute("select section_name from class_section where id='$class_section'"));
	$course_year=fetchrow(execute("select year_name from course_year where year_id='$sem'"));
	if($flag==1)
	{		

	$subject=$subject;
		$subname=$subject_type_dis;
		
		$section=$class_section;
	
		if($sem=='9' or $sem=='10' or $sem=='11')
		$colspan23=4;
		else
		$colspan23=6;

		$sql=execute("select id, chapter from lesson_chapter where class='$sem' and subj='$subject'  ");
		while($r=fetcharray($sql))
		{
$k=1;
			$chapter=$r[0];
			$chaptername=$r[1];
			$subject_id_dis=fetchrow(execute("select subject_name from subject_m where subject_id='$subject'"));
			$sqlk=execute("select id , topic from master_lesson_plan where class='$sem' and subj='$subject' and chapter='$chapter' and status=1 ");
			while($rk=fetcharray($sqlk))
			{
				$topic=$rk[0];

				//$sql2=execute("select * from teacher_lesson_plan where  class='$sem' and sec='$section' and subj='$subject' and chapter='$chapter' and topic='$topic' and (('$fdate' between r_date and to_date) or ('$tdate' between r_date and to_date) )");
				$sql2=execute("select * from teacher_lesson_plan where  class='$sem' and sec='$section' and subj='$subject' and chapter='$chapter' and topic='$topic' and (( r_date between '$fdate' and '$tdate') or (to_date  between '$fdate' and '$tdate') ) order by r_date");
				if(rowcount($sql2)>=1)
				{
					

		
		?>
		<br>
				<tr>
					<td align='center' colspan="<?=$colspan23?>" class='head' nowrap>Subject : <?=$subject_id_dis[0]?><br>Title : <?=$chaptername?></td>
		
				<tr>
					<td align='center' class='row3' nowrap>Topic/Date
					</td>
					<td align='center' class='row3' nowrap>Description
					</td>
						<?php
						if($sem=='9' or $sem=='10' or $sem=='11')
						{
						}
						else
						{
						?>
					<?php
						}
						?>
						<td align='center' class='row3' nowrap>Assignment/Assessment</td>
						<?php
						if($sem=='9' or $sem=='10' or $sem=='11')
						{
						}
						else
						{
						?>
						<td align='center' class='row3' nowrap>Remarks</td>
						<?php
						}
						?>
		<!--		<td align='center' class='row3' nowrap>Resource</td> 
					</td>-->
				</tr>
				<?php
				
						while($r6=fetcharray($sql2))
						{
							$teacher_lesson_id=$r6[0];
							echo "<tr>";
							$ffdate=explode('-',$r6[r_date]);
									
							if($ffdate[1]=='00')
							$adate='';
							else
							$adate=$ffdate[2]."/".$ffdate[1]."/".$ffdate[0];
							
							$tfdate=explode('-',$r6[to_date]);
							if($tfdate[1]=='00')
							$bdate='';
							else
							$bdate=$tfdate[2]."/".$tfdate[1]."/".$tfdate[0];
							
							
							
							?>
								<td valign="top" align="right" ><?=$rk[topic]?><br><br>
								From : <?php echo $adate?><br>To : <?php echo $bdate?></td>
							
							<?php
							echo "<td align='justify' valign='top'>$r6[description]</td>";
								if($sem=='9' or $sem=='10' or $sem=='11')
								{
								}
								else
								{
								}
								echo "<td align='justify' valign='top'>$r6[notes]</td>";
								if($sem=='9' or $sem=='10' or $sem=='11')
								{
								}
								else
								{
								echo "<td align='justify' valign='top'>$r6[details]</td>";
								}
								$teacher_lesson_id=$r6['id'];
														
							/*echo "<td align='justify' valign='top' nowrap>";
							$sql12=execute("select * from teacher_lesson_docments where teacher_lesson_id='$teacher_lesson_id' and status=1");
							while($r=fetcharray($sql12))
							{
										if($r[source]!='')
										echo "<a href='$r[source]'>$r[title]</a><br>";
							
							}
								echo "</td>";
								*/
								echo "</tr>";
							
				}
			}
			}
		}
	}
}
?>	</table>

	</form></body></html>
