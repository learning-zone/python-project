<?php
session_start();
include("../db.php");
$file_type = "vnd.ms-excel";
$file_name= "hallwise.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");
?>
<HTML>

<BODY>
<?php
$temp_sem=$sem;
$temp_sec=$section;

$query1 = mysql_query("select coursename,head_id from course_m where course_id='$branch'");
$row11  = mysql_fetch_row($query1);
$new_branch = $row11[0];
$pr = $row11[1];
if($pr==1)
$prof='BE';
$query2 = mysql_query("select year_name from course_year where year_id='$sem'");
$row21  = mysql_fetch_row($query2);
$new_sem = $row21[0];

if($section!='-1')
{
	if($section==0)
	{
		$new_section = "No Section";
	}
	else
	{
		$secn=fetcharray(execute("select section_name from class_section where id='$section'"));
		$new_section=$secn[0]." - Section";
	}
}
else
{
	$var1 = "select distinct(class_section_id) from student_m where course_admitted='$branch' and course_yearsem='$sem'  order by class_section_id";
	$res1 = mysql_query($var1) or die(mysql_error());
	$num1 = mysql_num_rows($res1);
	if($num1>0)
	{
		
		for($kk=1;$kk<=$num1;$kk++)
		{
			$row1 = mysql_fetch_array($res1);
			if($row1[0]==0)
			{
				$new_sec = "No Section";
			}
			else
			{
				$secn=fetcharray(execute("select section_name from class_section where id='$row1[0]'"));
				$new_sec=$secn[0];
			}

			if($kk<$num1)
			{
				$new_section.= $new_sec." / ";
				
			}
			else
			{
				$new_section.= $new_sec;
			}
		}
	}	
}
?>
<BODY>
<FORM NAME="frm" METHOD="POST">
<INPUT TYPE="HIDDEN" NAME="branch" VALUE="<?php echo $branch ?>">
<INPUT TYPE="HIDDEN" NAME="sem" VALUE="<?php echo $sem ?>">
<INPUT TYPE="HIDDEN" NAME="section" VALUE="<?php echo $section ?>">
<INPUT TYPE="HIDDEN" NAME="ac_yr" VALUE="<?php echo $ac_yr ?>">

<table  ALIGN='center' width="70%" cellspacing="2" cellpadding="2"  class="forumline" border="0">
	<tr>
	   <td colspan='5' align='center' class='head'><?=$prof?> STUDENTS LIST <?=$ac_yr?> </td>
	</tr>
	<tr height='25'>
		<td colspan='4' nowrap><font color='blue' size='2'><b>&nbsp;Course : <?php echo $new_branch ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Semester : <?php echo $new_sem ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Section : <?php echo $new_section ?></td>
	</tr>
	<tr height='15'>
	   <td align='center'><font size='2'>Sl. No.</td>
	   <td align='center'>USN</td>
	   <td align='center'><font size='2'>Name</td>
	 </tr>
	<?php
	$var = "select student_id, usn, first_name,last_name from student_m where course_admitted='$branch' and course_yearsem='$sem' ";
	if($section!='-1')
	{
		$var.=" and class_section_id='$section'";
	}
	$var.=" order by usn";
	$res  = mysql_query($var) or die(mysql_error());
	$num = mysql_num_rows($res);
    for($i=1;$i<=$num;$i++)
		{
			$row = mysql_fetch_array($res);
			?>
			<tr height='25'>
				<td align='center'><?php echo $i ?></td>
				<td align='center'><?php echo $row[usn] ?></td>
				<td >&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row[first_name].".".$row[last_name]?></td>
			</tr>
			<?php
		}
	?>
</Table>
</body>
</html>