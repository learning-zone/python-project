<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','_blank,width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,toolbar=no,location=no');
}
function reload()
{
	document.frm.action='ex_FetchsubjectDet1.php';
	document.frm.submit();
	
}
</SCRIPT>
<script>
function goBack()
  {
  window.history.back()
  }
</script>
</HEAD>
<body>
<?php 
 session_start();
 require_once('../../db.php');
 $subject=$_REQUEST['subject'];
 $studentid=$_REQUEST['studentid'];
 $studentid=$_POST['studentid'];

	//print_r($_POST);
	//echo "<br>";
	//print_r($_REQUEST);

$a_year=$_SESSION['AcademicYear'];

$sql=execute("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user'");
	if(rowcount($sql)==0)
	{
		die("You don't  have rights"); 
	}

	$user=$_SESSION['user'];
	$sql=execute("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user'");
if(rowcount($sql)!=0)
{	
	?>
    <br>
<br>
    
       
        <table align='center' cellpadding="5" class='forumline' width='80%' border="1" >
    <tr height="10"><td colspan=8 align='center' class='head'>Evaluate</td></tr>
    <tr >
        <td align="center" class="row3" width="5%" nowrap>Sl No.</td>
        <td align="center" class="row3" nowrap>Subject</td>
        <td align="center" class="row3" nowrap>Subject type</td>
        <td align="center" class="row3" nowrap><?php echo $_SESSION['semname']; ?></td>
        <td align="center" class="row3" nowrap>Section</td>
        <td align="center" class="row3" nowrap>Exam</td>
        <td align="center" class="row3" nowrap>Action</td>
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
		$date1=date("Y-m-d");
		$sql3=execute("SELECT exam_name,id,exam_type FROM `online_exam_det` where class_id='$sem' and acc_year='$a_year' and section_id='$class_section' and subject_id='$subject' and status=1");
		if(rowcount($sql3)>0)
		{
			$subject_id_dis=mysql_fetch_row(execute("select subject_name from subject_m where subject_id='$subject'"));
			$subject_type_dis=mysql_fetch_row(execute("select subtype_name from subjecttype where subtype_id='$subject_type'"));
			$section_name=mysql_fetch_row(execute("select section_name from class_section where id='$class_section'"));
			$course_year=mysql_fetch_row(execute("select year_name from course_year where year_id='$sem'"));
			while($r1=fetcharray($sql3))
			{  
				
			?>	
            <tr >
                <td align="center" nowrap><?=$k?></td>
                <td align="center" nowrap><?=$subject_id_dis[0]?></td>
                <td align="center" nowrap><?=$subject_type_dis[0]?>&nbsp;[ <?php if($r1['exam_type']==1){ echo "Descriptive"; } else echo "Selective"; ?> ]</td>
                <td align="center" nowrap><?=$course_year[0]?></td>
                <td align="center" nowrap><?=$section_name[0]?></td>
                <td align="center" nowrap><?=$r1[0]?></td>
			<!-- OLD CODE	
                <td align="center" width="30" nowrap><a href="javascript:OpenWind2('Evaluate1.php?id=<?=$r1[1]?>&examname=<?=$r1[0]?>&studentid=<?=$studentid?>&time=<?=$time?>')"><input type="button" name="update" value="Evaluate"  class='bgbutton'></a></td>
				
			-->
	
			   <?php
	           #########################################  URL FOR EVALUATE PAPERS ################################################
				if($r1['exam_type']==1)
				{
				?>
                <td align="center" width="30" nowrap><a href="javascript:OpenWind2('Evaluate2.php?id=<?=$r1[1]?>&examname=<?=$r1[0]?>&studentid=<?=$studentid?>&time=<?=$time?>')"><input type="button" name="update" value="Evaluate"  class='bgbutton'></a></td>
                <?php
				}
				else if($r1['exam_type']==2)
				{
				?>
                <td align="center" width="30" nowrap><a href="javascript:OpenWind2('Evaluate1.php?id=<?=$r1[1]?>&examname=<?=$r1[0]?>&studentid=<?=$studentid?>&time=<?=$time?>')"><input type="button" name="update" value="Evaluate"  class='bgbutton'></a></td>
                <?php
				}
				?>
				<?php
				 #########################################  URL FOR VIEW REPORTS ################################################
				if($r1['exam_type']==1)
				{
				?>
                <td align="center" width="30" nowrap><a href="javascript:OpenWind2('report2.php?id=<?=$r1[1]?>&examname=<?=$r1[0]?>&studentid=<?=$studentid?>&time=<?=$time?>')"><input type="button" name="update" value="Report"  class='bgbutton'></a></td>
                <?php
				}
				else if($r1['exam_type']==2)
				{
				?>
                <td align="center" width="30" nowrap><a href="javascript:OpenWind2('report1.php?id=<?=$r1[1]?>&examname=<?=$r1[0]?>&studentid=<?=$studentid?>&time=<?=$time?>')"><input type="button" name="update" value="Report"  class='bgbutton'></a></td>
                <?php
				}
				?>
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
