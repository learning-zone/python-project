<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</SCRIPT>
</HEAD>

<body>
<?php
session_start();
include("../db.php");
$qry=fetcharray(execute("select count(*) as n from staff_det s,app_hod a,users u where a.fid=s.id and u.S_ID=s.slno and u.username='$user'"));
if($qry[0]>0)
{
	//to get user details that is staff_id
	$res = execute("select id,S_ID from users where username='$user'");
	$row = fetcharray($res);
	
	//to get stafff rights
	$var1 = "select distinct(a.course_id),a.year_id,a.class_section_id,b.year_name,c.section_name from staff_rights a,course_year b,class_section c where staff_id='$row[id]' and a.year_id=b.year_id and a.class_section_id=c.id order by course_id";
	$res1 = execute($var1) or die(mysql_error());
	$num1 = rowcount($res1);
	?>
	<form name='form' method='POST' action="Addmarks.php">
	<table border='0' align='center' width='85%' class='forumline' cellspacing='0' cellpadding='0'>
	<tr>
		<td class='head' align='center' colspan='2'>Class Teacher Remarks </td>
	</tr>
	
	<tr >
	<td colspan='2'>
	<?php
	for($i=1;$i<=$num1;$i++)
	{
		$row1 = fetcharray($res1);
		if($row1[course_id]==0)
		{
			$coursename='First Year';
		}
		else
		{
			$row2 = fetchrow(execute("select coursename from course_m where course_id='$row1[course_id]'"));
			$coursename = $row2[0];
		}
	
	
		$var3 = "select subject_id,subject_type,batch_id,maj_id from staff_rights where staff_id='$row[id]' and course_id=";
		$var3.= " $row1[course_id] and year_id='$row1[year_id]' and class_section_id='$row1[class_section_id]' order by subject_id ";
		$res3 = execute($var3) or die(mysql_error());
		$num3 = rowcount($res3);
	
		?>
	
		<table border='0' align='center' width='95%' class='forumline' cellspacing='2' cellpadding='0'>
		<tr>
			<td align='center' class='rowpic' colspan='2' width='45%'>
				<?php echo $_SESSION['branchname']; ?> <?php echo $coursename ?>
			</td>
			<td align='center' class='rowpic' width='25%'>
				<?php echo $_SESSION['semname']; ?> <?php echo $row1[year_name] ?>
			</td>
			<td align='center' class='rowpic'width='25%'>
				Section : <?php echo $row1[section_name] ?>
			</td>
		</tr>
		<tr>
			<td align='center' width='5%'>Sl No</td>
			<td align='center'>Subject Name</td>
			<td align='center'>Subject Code </td>
			<td align='center'>Subject Type</td>
	
		</tr>
		<?php
	
			for($j=1;$j<=$num3;$j++)
			{
				$row3 = fetcharray($res3);
	
				$batch = fetchrow(execute("select batch_name from batch_master where id='$row3[batch_id]'"));
				$var4 = "select a.subject_name,a.subject_code,a.elective,a.cycle,a.sub_type,b.subtype_name from subject_m a ,";
				$var4.= " subjecttype b where a.subject_id='$row3[subject_id]' and a.sub_type=b.subtype_id";
				$res4 = execute($var4) or die(mysql_error());
				$row4 = fetcharray($res4);	
				
				if($row3[subject_type]==1)
				{
					if($row4[elective]=="Y")
					{
						$type = $row4[subtype_name]."  [Elective]";
					}
					else
					{
						$type = $row4[subtype_name];
					}
				}
				else
				{
					$type=$type = $row4[subtype_name]." <font color='red'>[$batch[0]]";
				}
	
				?>
					<tr>
						<td align='center'><?php echo $j ?></td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;
						<a href= "javascript:OpenWind2('AddreMarks1.php?course=<?php echo $row1[course_id]?>&sem=<?php echo $row1[year_id]?>&section=<?php echo $row1[class_section_id]?>&subj_id=<?php echo $row3[subject_id]?>&elective=<?php echo $row4[elective]?>&cycle=<?php echo $row4[cycle]?>&type=<?php echo $row4[sub_type]?>&batch=<?php echo $row3[batch_id] ?>')">
							
							<font color='#CC0066'><?php echo $row4[subject_name] ?>
							</a>
						</td>
						<td align='center'><?php echo $row4[subject_code] ?></td>
						<td >&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $type ?></td>
					</tr>
	
				<?php
			}
		?>
		</table>
		<br>
		<?php
	}
	?>
	</td>
	</table>
	</form>
	<?php
	}
	else
	die("<b>$user you dont have Rights to Add Internal Assessment</b>");
	?>
</body>
</html>