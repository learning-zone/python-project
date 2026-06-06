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
	document.frm.action='ex_FetchsubjectDet1.php';
	document.frm.submit();
	
}

</SCRIPT>
</HEAD>

<body>
<?php 
session_start();
require("../db.php");
$a_year=$_SESSION['AcademicYear'];

$sql=mysql_query("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID");
	if(mysql_num_rows($sql)==0)
	{
		die("You don't  have rights"); 
	}

	$user=$_SESSION['user'];
	$sql=mysql_query("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID");
if(mysql_num_rows($sql)!=0)
{	
	?>
    <br>    
        <table align='center' cellpadding="5" class='forumline' width='80%' border="1" >
    <tr height="10"><td colspan=7 align='center' class='head'>Add Questions</td></tr>
    <tr >
        <td align="center" class="row3" width="5%" nowrap>Sl No.</td>
        <td align="center" class="row3" nowrap>Subject</td>
        <td align="center" class="row3" nowrap>Subject type</td>
        <td align="center" class="row3" nowrap><?php echo $_SESSION['semname']; ?></td>
        <td align="center" class="row3" nowrap>Section</td>
        <td align="center" class="row3" nowrap>Exam</td>
        <td align="center" class="row3" nowrap>Action</td>
    </tr>
    <?php
	$k=1;
	while($r=mysql_fetch_array($sql))
	{
		$branch=$r['course_id'];
		$sem=$r['year_id'];
		$class_section=$r['class_section_id'];
		$subject=$r['subject_id'];
		$subject_type=$r['subject_type'];
		$date1=date("Y-m-d");
		$sql3=mysql_query("SELECT exam_name,id ,exam_type FROM `online_exam_det` where class_id='$sem' and acc_year='$a_year' and section_id='$class_section' and subject_id='$subject' and status=1");
		if(mysql_num_rows($sql3)>0)
		{
			$subject_id_dis=mysql_fetch_row(mysql_query("select subject_name from subject_m where subject_id='$subject'"));
			$subject_type_dis=mysql_fetch_row(mysql_query("select subtype_name from subjecttype where subtype_id='$subject_type'"));
			$section_name=mysql_fetch_row(mysql_query("select section_name from class_section where id='$class_section'"));
			$course_year=mysql_fetch_row(mysql_query("select year_name from course_year where year_id='$sem'"));
			while($r1=mysql_fetch_array($sql3))
			{
			?>	
            <tr >
                <td align="center" nowrap><?=$k?></td>
                <td align="center" nowrap><?=$subject_id_dis[0]?></td>
                 <td align="center" nowrap><?=$subject_type_dis[0]?>&nbsp;[ <?php if($r1['exam_type']==1){ echo "Descriptive"; } else echo "Selective"; ?> ]</td>
                <td align="center" nowrap><?=$course_year[0]?></td>
                <td align="center" nowrap><?=$section_name[0]?></td>
                <td align="center" nowrap><?=$r1[0]?></td>
                <td align="center" width="30" nowrap>
                <?php
				if($r1['exam_type']==1)
				{
				?>
                <a href="javascript:OpenWind2('add_questions1.php?id=<?=$r1[1]?>&examname=<?=$r1[0]?>')"><input type="button" name="update" value="Add Questions"  class='bgbutton'></a>
                <?php
				}
				else
				{
				?>
                <a href="javascript:OpenWind2('add_questions2.php?id=<?=$r1[1]?>&examname=<?=$r1[0]?>')"><input type="button" name="update" value="Add Questions"  class='bgbutton'></a>
                <?php
				}
				?>
                </td>
            </tr>
		
		<?php
			}
		$k++;
		}
	
	}
	?>
	</table>
<?php
}
	?>
	    
    
    			
</form>	
</body>
</html>
