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

$allteach=execute("select a.class,a.section,a.sub,a.sub_type from all_teachers a,users b,class_section c where  b.username='$user'  and a.section=c.id and c.status=1 and b.srid IN ( sub_teac2, sub_teac, home_teac)  group by a.sub,a.section order by a.class,c.codename");


$cheknam=fetcharray(execute("select shortname from users where username='$user'"));

if($cheknam[0]=='admin')
{
$sql21=execute("select grade,id,sub from class_section where status=1 group by sub,id order by grade,codename");
}
else
{
$sql21=execute("select a.class,a.section,a.sub,a.sub_type from all_teachers a,users b,class_section c where  b.username='$user'  and a.section=c.id and c.status=1 and b.srid IN ( sub_teac2, sub_teac, home_teac)  group by a.sub,a.section order by a.class,c.codename");
}
if(rowcount($allteach)==0)
	{
if($cheknam[0]!='admin')
{
$sql21=execute("select a.grade,a.section,a.sub from staff_class_group a,users b where b.username='$user' and b.srid=a.staff_id order by a.grade, a.section");	
}
	}

	if(rowcount($sql21)==0)
	{
		echo die("You don't  have attendance rights"); 
	}

if(rowcount($sql21)!=0)
{
	?>
	<form name="frm" action="" method="post" >
	<table width="80%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
	  <tr height="25">
		<td colspan="4" align="center" class="head">DAILY ATTENDANCE</td>
	  </tr>
	<tr height="25">
		<td align="center" class="row3" nowrap>Sl.No</td>
		<td align="center" class="row3" nowrap><?php echo $_SESSION['semname']; ?></td>
		<td align="center" class="row3" nowrap>Section</td>
		<td align="center" class="row3" nowrap>Action</td>
	</tr>
	<?php
	$i=1;
	while($r12=fetcharray($sql21))
	{
		//$branch1=$r12[0];
		$sql=execute("select course_id,coursename from course_m where course_id='$branch1'");
		$sem1=$r12[0];
		$yearname=fetchrow(execute("SELECT year_name FROM course_year where year_id='$sem1'"));
		
		$hedids=fetchrow(execute("SELECT head_id FROM course_year where year_id='$sem1'"));
		$branch1=$hedids[0];
		$class_section_id1=$r12[1];
		$rs_section=fetchrow(execute("select section_name,codename from class_section where id='$class_section_id1' and status=1"));
	
	?>
	<tr height="25">
		<td align="center" nowrap><?=$i?></td>
		<td align="center" nowrap><?=$yearname[0]?></td>
		<td align="center" nowrap><?=$rs_section[1]?>-<?=$rs_section[0]?></td>
		<td align="center" width="40%" nowrap>
        <?php
		$sql_id=fetchrow(execute("select type from attendance where `acc_year`='$a_year' and `class_id`='$sem1' and status=1"));
			//if($sql_id[0]==1)
			//{
		?>
        
        <a href="javascript:OpenWind2('addattendace.php?subname=DAILY&branch=<?=$branch1?>&sem=<?=$sem1?>&class_section_id=<?=$class_section_id1?>&subject=<?=$r12[2]?>&sess=s')"><input type="button" name="update" value="Modify Attendance"  class='bgbutton'></a>
        <?php
			//}
			if($sql_id[0]==2)
			{
		?>
              <a href="javascript:OpenWind2('addattendace.php?subname=MORNING&branch=<?=$branch1?>&sem=<?=$sem1?>&class_section_id=<?=$class_section_id1?>&subject=0&sess=m')"><input type="button" name="update" value="Mor Attendance"  class='bgbutton'></a>
       <a href="javascript:OpenWind2('addattendace.php?subname=NOON&branch=<?=$branch1?>&sem=<?=$sem1?>&class_section_id=<?=$class_section_id1?>&subject=0&sess=n')"><input type="button" name="update" value="Noon Attendance"  class='bgbutton'></a>
 
        <?php
			}
		?>
        </td>
	</tr>
	<?php
	$i++;
	}
		
		
	//echo "m--MORNING";
	//"n--NOON";
	//"b--BOTH";
	
	?>
	</table>
		<br>
	<?php
}
	$user=$_SESSION['user'];
	$sql=execute("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID");
if(rowcount($sql)!=0)
{	
	?>
    <br>    
       <!-- <table align='center' cellpadding="5" class='forumline' width='80%' border="1" >
    <tr height="10"><td colspan=6 align='center' class='head'>SUBJECT WISE ATTENDANCE</td></tr>
    <tr >
        <td align="center" class="row3" width="5%" nowrap>Sl No.</td>
        <td align="center" class="row3" nowrap>Subject</td>
        <td align="center" class="row3" nowrap>Subject type</td>
        <td align="center" class="row3" nowrap><?php echo $_SESSION['semname']; ?></td>
        <td align="center" class="row3" nowrap>Section</td>
        <td align="center" class="row3" nowrap>Action</td>
    </tr>-->
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
        <td align="center" width="30" nowrap><a href="javascript:OpenWind2('addattendace.php?subname=<?=$subject_id_dis[0]?>&branch=<?=$branch?>&sem=<?=$sem?>&class_section_id=<?=$class_section?>&subject=<?=$subject?>&sess=s')"><input type="button" name="update" value="Modify Attendance"  class='bgbutton'></a></td>
    </tr>
    
    <?php
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
