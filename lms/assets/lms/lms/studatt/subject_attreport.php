<?php
session_start();
require("../db.php");
//header("Refresh: 5");

?>
<HTML>
<HEAD>

<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
<script type="text/JavaScript">
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=700,width=1000,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function printReport()
{
	prn.style.display="none";
	window.print();
}
</script>
</HEAD>
<BODY >
<form method="POST" name="frm">
<?php

if($_POST['adate']=='')
{
	$adate=date("d/m/Y");
	$bdate=date("d/m/Y");
?>
<table width="80%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Subject wise Attendance Report</td>
    </tr>
   <tr>
		<td nowrap>&nbsp;&nbsp;From &nbsp;<input type="text" readonly="" name="adate" value="<?php echo $adate?>" >&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		<td nowrap>
        &nbsp;&nbsp;To &nbsp;<input type="text" readonly="" name="bdate" value="<?php echo $bdate?>" >&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
	</tr>  
</table> 

<br>
<div align="center"><input class="bgbutton" type="submit" name="open" value="View" ></div><br>       
<?php
}
else
{
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$user=$_SESSION['user'];
	$a_year=$_SESSION['AcademicYear'];
	$sql=execute("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID");
if(rowcount($sql)!=0)
{	
	?>
    <br>
<div><a href="subject_attreport.php?back=true"><input class="bgbutton" type="button" name="open" value="Back" ></a></div><br>       

    <br>    
        <table align='center' cellpadding="5" class='forumline' width='80%' border="1" >
    <tr height="10"><td colspan=6 align='center' class='head'>Subject wise Attendance Report For <?=$adate." - ".$bdate?></td></tr>
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

			$sql_id=fetchrow(execute("select type from attendance where `acc_year`='$a_year' and `class_id`='$sem' and status=1"));
			if($sql_id[0]==3)
			{
			
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
        <td align="center" width="30" nowrap><a href="javascript:OpenWind('addattendaceReport.php?subname=<?=$subject_id_dis[0]?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section?>&subject=<?=$subject?>&sess=s&adate=<?=$adate?>&bdate=<?=$bdate?>')"><input type="button" name="update" value="View Report"  class='bgbutton'></a>
        <a href="addattendaceReportexl.php?subname=<?=$subject_id_dis[0]?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section?>&subject=<?=$subject?>&sess=s&adate=<?=$adate?>&bdate=<?=$bdate?>"><input type="button" name="update" value="Export To Excel"  class='bgbutton'></a></td>
    </tr>
    
    <?php
    $k++;
		}
	}
	?>
	</table>
<?php
}
}
?>
</form>
</body>
</html>