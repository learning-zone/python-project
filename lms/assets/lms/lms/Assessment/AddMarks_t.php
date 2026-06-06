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
	document.frm.action='AddMarks_t.php';
	document.frm.submit();
}

</SCRIPT>
</HEAD>

<body>
<form name="frm" action="" method="post">
<?php
	session_start();
	require("../db.php");
	$user=$_SESSION['user'];
	$accyear=$_SESSION['AcademicYear'];

if(!$_POST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
else
{
	$exam_id=$_POST['exam_id'];
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
	$subject=$_POST['subject'];

}

$sql21=execute("select a.course_id, a.year_id,	a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID=b.S_ID");
while($r12=fetcharray($sql21))
{
	$branch1=$r12[0];
	$sem1=$r12[1];
	$class_section_id1=$r12[2];
}
if(rowcount($sql21)==0)
{
	echo "<blink><b><font >Only class teacher can Enter Marks  !!!!</font></blink></b><br>";
	die();
}
?>		<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">ADD MARKS</td>
    </tr>
     
  <tr>
    <td>&nbsp;School Division</td>
		<td>&nbsp;<select name="branch" onChange="reload()">
			<option value="0">------Select-----</option>
				<?php
					$sql="select a.course_id,a.coursename from course_m a where a.course_id='$branch1'";
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
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b,staff_rights e,users f where a.head_id=b.head_id and b.course_id='$branch'  and a.year_id=e.year_id and  f.username='$user' and e.StaffID=f.S_ID group by e.year_id");
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
  <td height="28">&nbsp;Term/Sem</td>
  <td>&nbsp;<select name='exam_id'  onChange="reload()">
<?
$rs_section=execute("select id, exam_name, exam_sub_name from exam_year_m where acc_year='$accyear' and class='$sem' and status=1 order by order_id");
echo "<option value='-1'>--Select--</option>";
for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($exam_id==$r_section[id])
	echo "<option value='$r_section[id]' selected>$r_section[exam_sub_name]</option>";
	else
	echo "<option value='$r_section[id]'>$r_section[exam_sub_name]</option>";

}
?>
</select>
</td>
  </tr>

  <?php
  if($exam_id=='')
  die();
  ?>
  <tr>
  <td height="28">&nbsp;Subject</td><td>&nbsp;<select name='subject'  onChange="reload()">
<?
$rs_section=execute("select e.id, a.subject_name,  b.section_name from subject_m a,class_section b, staff_rights e,users f  where f.username='$user' and e.StaffID=f.S_ID and e.year_id='$sem'  and a.subject_id=e.subject_id and b.id=e.class_section_id group by e.class_section_id , e.subject_id ");
echo "<option value=''>--Select--</option>";
for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($subject==$r_section[0])
	echo "<option value='$r_section[0]' selected>$r_section[section_name]-$r_section[1]</option>";
	else
	echo "<option value='$r_section[0]'>$r_section[section_name]-$r_section[1]</option>";

}
?>
</select>
</td>
  </tr>

</table>
<?php  

$rs1=execute("select sub_id from exam_m where id='$examname'"); 
while($ner1=fetcharray($rs1))
{
	$sub_id=$ner1['sub_id'];
}
$newsubid=explode(',',$sub_id);
   $rs=execute("select subject_id , class_section_id from staff_rights where id='$subject'"); 
while($ner=fetcharray($rs))
{
	$subject=$ner['subject_id'];
	$class_section_id=$ner['class_section_id'];	  
}
?>				
<br>
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
<tr>
    <td align='center' class='head'>Exam Master</td></tr>  

<?php

	$sql2=execute("select id, exam_name, exam_sub_name from exam_sub_m where exam_id='$exam_id' and section='$class_section_id' and acc_year='$accyear' and class='$sem' and status=1 and subject_id='$subject' order by order_id");
	
	while($r2=fetcharray($sql2))
	{
		
		$sql3=execute("select id, exam_name, exam_sub_name from exam_sub_sub_m where exam_id='$r2[0]' and status=1 order by order_id");
		 $num_rows = rowcount($sql3);

			echo "<tr>
    <td align='' class='row3'>$r2[1]</td></tr>";
		
		while($r3=fetcharray($sql3))
		{
			?>
          <tr>
    		<td align='' class=''><a href="javascript:OpenWind2('updatemarks.php?course=<?=$branch?>&sem=<?=$sem?>&examid=<?=$r3[0]?>&class_section_id=<?=$class_section_id?>&subject=<?=$subject?>&level=2')"><?=$r3[1]?></a></td></tr>
		<?php
 		
		}
	}




?>				

    </table>

</form>	
</body>
</html>
