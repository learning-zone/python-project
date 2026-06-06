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

$sql21=execute("select a.curri_type, a.grade,	a.sect from class_teacher a,users b where b.username='$user' and a.teacher=b.srid");
$sql=execute("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID");
	if(rowcount($sql)==0 and rowcount($sql21)==0)
	{
		echo die("You don't  have attendance rights"); 
	}

	
	$user=$_SESSION['user'];
	$sql=execute("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID");
if(rowcount($sql)!=0)
{	
	?>
    <br>    
        <table align='center' cellpadding="5" class='forumline' width='80%' border="1" >
    <tr height="10"><td colspan=6 align='center' class='head'>Comment </td></tr>
    <tr >
        <td align="center" class="row3" width="5%" nowrap>Sl No.</td>
        <td align="center" class="row3" nowrap>Subject</td>
        <td align="center" class="row3" nowrap>Subject type</td>
        <td align="center" class="row3" nowrap><?php echo $_SESSION['semname']; ?></td>
        <td align="center" class="row3" nowrap>Section</td>
        <td align="center" class="row3" nowrap>Action</td>
    </tr>
        <?php
        $k=1;
        while($r=fetcharray($sql))
        {
            $branch=$r['course_id'];
        			$sem=$r['year_id'];

			
			
            $class_section=$r['class_section_id'];
            $subject=$r['subject_id'];
            $subject_type=$r['subject_type'];
            $subject_id_dis=fetchrow(execute("select subject_name from subject_m where subject_id='$subject'"));
            $subject_type_dis=fetchrow(execute("select subtype_name from subjecttype where subtype_id='$subject_type'"));
            $section_name=fetchrow(execute("select section_name from class_section where id='$class_section'"));
            $course_year=fetchrow(execute("select year_name from course_year where year_id='$sem'"));
        
        ?>	
    <tr >
        <td align="center" nowrap><?=$k?></td>
        <td nowrap><?=$subject_id_dis[0]?></td>
        <td nowrap><?=$subject_type_dis[0]?></td>
        <td align="center" nowrap><?=$course_year[0]?></td>
        <td align="center" nowrap><?=$section_name[0]?></td>
        <td align="center" width="30" nowrap><a href="javascript:OpenWind2('add_Comment.php?subname=<?=$subject_id_dis[0]?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section?>&subject=<?=$subject?>&sess=s')"><input type="button" name="update" value="Add Comment"  class='bgbutton'></a></td>
    </tr>
    
    <?php
    $k++;
		
	}
	?>
	</table>
<?php
}
	?>
	    
    
    			
</form>	
</body>
</html>
