<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no,directories=no');
	
	//window.open(popurl,"","width=340, height=300, left=45, top=15, scrollbars=yes, menubar=no,resizable=no,directories=no,location=no");
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
	include("../db.php");
	$per00=$_SESSION['per00'];
	$user=$_SESSION['user'];
	if($per00==1)
	{
		echo "This link will work only for student's  ";
		die();
	}
	?>
    <br>    
        <table align='center' cellpadding="5" class='forumline' width='80%' border="1" >
    <tr height="10"><td colspan=7 align='center' class='head'>Online Assessment</td></tr>
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
	
	$mod="select * from student_m where student_id='$user' and archive='N'";
	$mod1=mysql_query($mod);
	while($mod2=mysql_fetch_array($mod1))
	{
		$stuid=$mod2[3];
		$stuname=$mod2['first_name'];
		$branch=$mod2['course_admitted'];
		$sem=$mod2['course_yearsem'];
		$a_year=$mod2['academic_year'];
		$studentid=$mod2[0];
		$class_section=$mod2['class_section_id'];
		$stundetname=$mod2['first_name'];
		$admissionid=$mod2[1];
		$student_id=$mod2[3];
	}
	$k=1;
	$sql=mysql_query("select subject_name, subject_id, sub_type, elective from subject_m where course_year_id='$sem' and status=1 ");
	while($r=mysql_fetch_array($sql))
	{
		$subject=$r['subject_id'];
		$subject_type=$r['sub_type'];
		$date1=date("Y-m-d");
		
		$sql3=mysql_query("SELECT exam_name, id, time_limit, exam_type, exam_date FROM `online_exam_det` where class_id='$sem' and acc_year='$a_year' and section_id='$class_section' and subject_id='$subject' and status=1");
		if(mysql_num_rows($sql3)>0)
		{
				
			$subject_id_dis=$r['subject_name'];
			$subject_type_dis=mysql_fetch_row(mysql_query("select subtype_name from subjecttype where subtype_id='$subject_type'"));
			$section_name=mysql_fetch_row(mysql_query("select section_name from class_section where id='$class_section'"));
			$course_year=mysql_fetch_row(mysql_query("select year_name from course_year where year_id='$sem'"));
			while($r1=mysql_fetch_array($sql3))
			{ 
			
			     $exam_date=$r1['exam_date'];  
			?>	
            <tr>
                <td align="center" nowrap><?=$k?></td>
                <td align="center" nowrap><?=$subject_id_dis?></td>
                <td align="center" nowrap><?=$subject_type_dis[0]?>&nbsp;[ <?php if($r1['exam_type']==1){ echo "Descriptive"; } else echo "Selective"; ?> ]</td>
                <td align="center" nowrap><?=$course_year[0]?></td>
                <td align="center" nowrap><?=$section_name[0]?></td>
                <td align="center" nowrap><?=$r1[0]?></td>
                <td align="center" width="30" nowrap>
                <?php
				if($r1['exam_type']==1)
				{
				?>
                <a href="javascript:OpenWind2('add_ans.php?id=<?=$r1[1]?>&examname=<?=$r1[0]?>&time=<?=$r1[2]?>&student_id=<?=$studentid?>&exam_date=<?=$exam_date?>')"><input type="button" name="update" value="Attend Exam/Result"  class='bgbutton'></a>
                <?php
				}
				else
				{
				?>
                <a href="javascript:OpenWind2('add_ans1.php?id=<?=$r1[1]?>&examname=<?=$r1[0]?>&time=<?=$r1[2]?>&student_id=<?=$studentid?>&exam_date=<?=$exam_date?>')"><input type="button" name="update" value="Attend Exam/Result"  class='bgbutton'></a>
                <?php
				}
				?>
                </td>
            </tr>
		
		<?php
			}
		$k++;
		}

	?>
<?php
}
	?>
	</table>    		
</form>	
</body>
</html>
